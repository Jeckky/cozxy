<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\helpers\CozxyCalculatesCart;
use frontend\models\DisplaySearch;

/**
 * Description of BeOurPartner
 *
 * @author it
 */
class TestController extends MasterController {

    //put your code here
    public function actionIndex() {
        $Order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id)->orderBy('orderId desc')->one();
        if (isset($Order->orderId)) {
            $OrderItemSumTotal = \common\models\costfit\OrderItem::find()->where('orderId=' . $Order->orderId)->sum('total');
        } else {
            $OrderItemSumTotal = 0;
        }
        if (isset($Order->couponId)) {
            $coupon = \common\models\costfit\Coupon::find()->where('couponId=' . $Order->couponId)->one();
            $couponValue = $coupon->discountValue;
        } else {
            $couponValue = 0;
        }
        //echo '<pre>';
        //print_r($Order->attributes);
        $total = CozxyCalculatesCart::FormulaTotal();
        $TotalExVat = CozxyCalculatesCart::FormulaTotalExVat();
        $vat = CozxyCalculatesCart::FormulaVAT();
        $SubTotal = CozxyCalculatesCart::FormulaSubTotal();

        echo '<br>Total : ' . number_format($total, 2);
        echo '<br>TotalExVat : ' . number_format($TotalExVat, 2);
        echo '<br>Vat : ' . number_format($vat, 2);
        echo '<br>coupon : ' . $couponValue;
        //echo '<br>Sum Total : ' . $TotalExVat + $vat;
        echo "<br> sum :" . number_format($SubTotal, 2);
    }

    public function actionCategory() {
        return $this->render('index');
    }

    public function actionSubscribe() {
        return $this->render('subscribe');
    }

    public function actionElasticSearch() {
        //  --url 'http://45.76.157.59:3000/search?text=dry%20skin&brand_id=67,68&category_id=16'
        $ConfigpParameter = $this->ConfigpParameter('searching');
        $Eparameter = array(
            'search' => $ConfigpParameter['search'],
            'status' => $ConfigpParameter['status'],
            'brandId' => $ConfigpParameter['brandId'],
            'categoryId' => $ConfigpParameter['categoryId'],
            'mins' => $ConfigpParameter['mins'],
            'maxs' => $ConfigpParameter['maxs'],
            'size' => 12,
            'pages' => $ConfigpParameter['pages']
        );

        $searchElastic = \common\helpers\ApiElasticSearch::searchProduct($Eparameter);
        $productFilterBrand = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($ConfigpParameter['categoryId'])]);

        $perPage = round($searchElastic['total'] / 12, 0, PHP_ROUND_HALF_UP);
        //echo 'perPage : ' . $perPage;
        $dataProvider = new ArrayDataProvider([
            //'key' => 'productid',
            'allModels' => $searchElastic['data'],
            /* 'sort' => [
              'attributes' => ['total', 'took', 'size', 'page', 'data'],
              ], */
            'pagination' => [
                'pageSize' => $searchElastic['size'],
            ],
        ]);

        //$productid[] = '';
        foreach ($dataProvider->allModels as $key => $value) {
            $productid[] = $value['productid'];
        }
        if (isset($productid) && count($productid) > 0) {
            $productid = $productid;
        } else {
            $productid = NULL;
        }

        //$productid .= $productid;
        //$productid = substr($productid, 0, -1);
        //print_r($productid);
        $catPrice = ''; // DisplaySearch::findAllPriceSearch($ConfigpParameter['search'], $productid);

        $item_per_page = 12; //$searchElastic['size'];
        $current_page = isset($ConfigpParameter['pages']) ? $ConfigpParameter['pages'] : 1;
        $total_records = $searchElastic['total'];
        $total_pages = $perPage;
        //search=&brandName=3,51,42&mins=100&maxs=100&categoryId=&pages=18
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $ConfigpParameter['search'], $ConfigpParameter['brandId'], $ConfigpParameter['mins'], $ConfigpParameter['maxs'], $ConfigpParameter['categoryId']);

        if (isset($ConfigpParameter['pages'])) {
            return $this->renderAjax('@app/themes/cozxy/layouts/product/_product_item_rev1_json_render', compact('paginate', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
        } else {
            if (isset($_GET['type'])) {
                return $this->renderAjax('@app/themes/cozxy/layouts/product/_product_item_rev1_json_render', compact('paginate', 'ConfigpParameter', 'dataProvider', 'searchElastic', 'productFilterBrand', 'catPrice', 'perPage'));
            } else {
                return $this->render('@app/views/search/index_search_json_1', compact('paginate', 'ConfigpParameter', 'searchElastic', 'dataProvider', 'productFilterBrand', 'catPrice', 'perPage'));
            }
        }
    }

    public function ConfigpParameter($type) {

        $mins = Yii::$app->request->get('mins');
        $maxs = Yii::$app->request->get('maxs');
        if ($mins == 100 && $maxs == 100) {
            $mins = '';
            $maxs = '';
        }
        $brand = Yii::$app->request->get('brand');
        $size = Yii::$app->request->get('size');
        $pages = Yii::$app->request->get('page');
        $status = 1;
        //print_r($brand);
        $categoryId = Yii::$app->request->get('categoryId');
        //$search = Yii::$app->request->get('search');
        $search = Yii::$app->request->get('search');
        if (isset($search)) {
            $search = Yii::$app->request->get('search');
        } else {
            $search = Yii::$app->request->post('search');
        }
        $brandName = Yii::$app->request->get('brandName');
        if ($type == 'searching') {
            $brandId = Yii::$app->request->get('brandName');
        } else {
            if (isset($_GET['brandName']) && !empty($_GET['brandName']) && $_GET['brandName'] != '') {
                $brand = Yii::$app->request->get('brandName');
                $brandId = substr($brand, 0, -1);
            } else {
                $brandId = NULL;
            }
        }

        if ($categoryId != 'undefined') {
            $categoryId = Yii::$app->request->get('categoryId');
            $site = 'category';
        } else {
            $categoryId = NULL;
            $site = 'brand';
        }

        $Eparameter = array(
            'search' => $search,
            'status' => $status,
            'brandId' => $brandId,
            'categoryId' => $categoryId,
            'mins' => $mins,
            'maxs' => $maxs,
            'size' => $size,
            'pages' => $pages,
            'site' => $site
        );
        return $Eparameter;
    }

    public function actionEPaginate() {

        $page = $_GET['page'];
        $search = $_GET['search'];
        $brandName = $_GET['brandName'];
        $mins = $_GET['mins'];
        $maxs = $_GET['maxs'];
        $category = $_GET['category'];
        $Trecords = $_GET['Trecords'];
        $Tpages = $_GET['Tpages'];
        $item_per_page = 12;
        $current_page = $page;
        $total_records = $Trecords;
        $total_pages = $Tpages;
        $paginate = \common\helpers\ApiElasticSearch::paginate($item_per_page, $current_page, $total_records, $total_pages, $search, $brandName, $mins, $maxs, $category);
        echo $paginate;
    }

    public function actionGetData() {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, 'https://www.cozxy.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        echo $data;
        exit();
    }

    public function actionData() {
        
    }

}
