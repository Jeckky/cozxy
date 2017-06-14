<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use frontend\models\DisplaySearch;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyCategory;
use yii\data\ArrayDataProvider;

class SearchController extends MasterController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($hash = FALSE) {
        $category = $_GET['c'];
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        //echo '<pre>';
        //print_r($params);
        $categoryId = $params['categoryId'];
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $productCanSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchCategory('', $categoryId, '', ''),
            'pagination' => ['defaultPageSize' => 9],
        ]);
        $productSupplierId = '';

        return $this->render('index', compact('productCanSell', 'category', 'categoryId', 'productSupplierId'));
    }

    public function actionCozxyProduct() {
        //$category = Yii::$app->request->post('search');
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, FALSE)]);
        //return $this->render('index', compact('productCanSell', 'category'));
        $category = Yii::$app->request->post('search');
        $categoryId = NULL;

        $productCanSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearch($category, 18, FALSE), 'pagination' => ['defaultPageSize' => 12],
        ]);

        return $this->render('index', compact('productCanSell', 'category', 'categoryId'));
    }

    public function actionBrand($hash = FALSE) {

        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $brandId = $params['brandId'];

        $brand = \common\models\costfit\Brand::find()->where('brandId=' . $brandId)->one();
        if (isset($brand)) {
            $brandName = $brand['title'];
        } else {
            $brandName = '';
        }

        $productCanSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchBrand($brandId, '', FALSE)
            , 'pagination' => ['defaultPageSize' => 12]
        ]);

        return $this->render('brand', compact('productCanSell', 'brandName'));
    }

    public function actionFilterPrice() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $categoryId = Yii::$app->request->post('categoryId');
        //echo 'mins : ' . $mins . ', maxs : ' . $maxs . ' ,' . $categoryId;
        $FilterPrice = [];
        $productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, $mins, $maxs)]);
        //echo '<pre>';
        //print_r($productFilterPrice->allModels);
        //exit();
        if (count($productFilterPrice->allModels) > 0) {
            foreach ($productFilterPrice->allModels as $key => $value) {
                $FilterPrice[$value['productSuppId']] = [
                    'brand' => $value['brand'],
                    'productSuppId' => $value['productSuppId'],
                    'image' => $value['image'],
                    'url' => $value['url'],
                    'brand' => $value['brand'],
                    'title' => $value['title'],
                    'price_s' => $value['price_s'],
                    'price' => $value['price'],
                    'maxQnty' => $value['maxQnty'],
                    'fastId' => $value['fastId'],
                    'productId' => $value['productId'],
                    'supplierId' => $value['supplierId'],
                    'receiveType' => $value['receiveType'],
                    'wishList' => $value['wishList']
                ];
            }
            //$FilterPrice = $FilterPrices;
        }
        //echo '<pre>';
        //print_r($productFilterPrice);
        return json_encode($FilterPrice);
    }

    public function actionShowMoreProducts() {

        $catz = Yii::$app->request->post('cat');
        $countz = (int) Yii::$app->request->post('count');
        $startz = (int) Yii::$app->request->post('starts');
        $endz = (int) Yii::$app->request->post('ends');
        /*
          starts:0
          ends:90
         * */
        $FilterPrice = [];
        if ($countz <= $endz) {
            $endzShow = $countz;
        } else {
            $endzShow = $endz;
        }
        $productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategoryShowMore($startz, $endzShow, $catz)]);

        if (count($productFilterPrice->allModels) > 0) {
            foreach ($productFilterPrice->allModels as $key => $value) {
                $FilterPrice[$value['productSuppId']] = [
                    'brand' => $value['brand'],
                    'productSuppId' => $value['productSuppId'],
                    'image' => $value['image'],
                    'url' => $value['url'],
                    'brand' => $value['brand'],
                    'title' => $value['title'],
                    'price_s' => $value['price_s'],
                    'price' => $value['price'],
                    'maxQnty' => $value['maxQnty'],
                    'fastId' => $value['fastId'],
                    'productId' => $value['productId'],
                    'supplierId' => $value['supplierId'],
                    'receiveType' => $value['receiveType'],
                    'wishList' => $value['wishList']
                ];
            }
            //$FilterPrice = $FilterPrices;
        }
        //echo '<pre>';
        //print_r($productFilterPrice);
        return json_encode($FilterPrice);
    }

}
