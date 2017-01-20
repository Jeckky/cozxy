<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use kartik\mpdf\Pdf;

/**
 * Description of CozxyUnity
 *
 * @author it
 * 5/1/2017 by Taninut.Bm
 */
class CozxyUnity {

    //put your code here
    /*
     * Converting timestamp to time ago in PHP e.g 1 day ago, 2 days ago…
     * Use example :
      echo time_elapsed_string('2013-05-01 00:22:35');
      echo time_elapsed_string('@1367367755'); # timestamp input
      echo time_elapsed_string('2013-05-01 00:22:35', true);
     * Output :
      4 months ago
      4 months, 2 weeks, 3 days, 1 hour, 49 minutes, 15 seconds ago
     * By Taninut.Bm
     */

    public static function TimeElapsedString($time_ago) {
        $time_ago = strtotime($time_ago);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }

    // Privacy statement output demo
    /*
     * ส่วนของ Baekend 10/1/2017
     * Move From backend
     * By Taninut.Bm
     * email : taninut.bm@cozxy.com , sodapew17@gmail.com
     */
    public static function GetMpdfDocument($content, $setHeader = FALSE, $setFooter = FALSE, $marginTop = FALSE) {
        //$orderId = Yii::$app->request->get('OrderNo');
        // $orderId = $params['orderId'];
        // get your HTML raw content without any layouts or scripts
        // $content = $this->renderPartial('purchase_order');
        // $model = YourModel::findOne($id);
        // $content = $this->renderPartial('print', [ 'model' => $model]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cozxy.com Print Purchase Order',],
            // call mPDF methods on the fly
            'marginTop' => isset($marginTop) ? $marginTop : 35,
            'methods' => [
                //'SetHeader' => ['Cozxy.com Print Purchase Order'], //Krajee Report Header
                //'SetFooter' => ['{PAGENO}'],
                'SetHeader' => $setHeader, //Krajee Report Header
                'SetFooter' => $setFooter,
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    // Privacy statement output demo
    /*
     * ส่วนของ Frontend 10/1/2017
     * url ที่เรียกใช้ : payment/print-receipt/..........
     * By Taninut.Bm
     * email : taninut.bm@cozxy.com , sodapew17@gmail.com
     */
    public static function actionMpdfDocument($content, $header, $title) {

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            //'cssInline' => 'body{font-size:9px}',
            // set mPDF properties on the fly
            // 'defaultFontSize' => 3,
            // 'marginLeft' => 10,
            // 'marginRight' => 10,
            'marginTop' => 40,
            // 'marginBottom' => 11,
            //'marginHeader' => 6,
            //'marginFooter' => 6,
            'options' => ['title' => 'Cozxy.com Print ' . $title],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$header], //Krajee Report Header
                // 'SetFooter' => ['{PAGENO}'],
                // 'SetHeader' => FALSE, //Krajee Report Header
                'SetFooter' => ['{PAGENO} / {nbpg}'],
            ]
        ]);


        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public static function GetParams($hash, $title) {
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $productIds = $params['productId'];
        return $productIds;
    }

    public static function GetTitleProductMeta($hash) {
        $productId = CozxyUnity::GetParams($hash, '');
        $getTitleProduct = \common\models\costfit\Product::find()->where("productId ='" . $productId . "'")->one();
        return $getTitleProduct;
    }

    public static function curPageURL($hash) {
        $get = CozxyUnity::GetTitleProductMeta($hash, '');
        return $get;
    }

}
