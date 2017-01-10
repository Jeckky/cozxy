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
 * Description of PaymentPrint
 *
 * @author it
 * 10/1/2017
 * By Taninut.Bm
 */
class PaymentPrint {

    //put your code here
    /*
     * ใบ​เสร็จ​/ใบ​กํากับ​ภา​ษีต้น​ฉบับ
     * url : /payment/print-receipt/????????
     * By Taninut.Bm
     */
    public static function GetPrintReceipt($userId, $orderId) {
        $order = \common\models\costfit\Order::find()->where('userId=' . $userId . ' and orderId="' . $orderId . '" ')
        ->one();
        return $order;
    }

}
