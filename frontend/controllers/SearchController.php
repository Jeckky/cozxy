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

    public function actionIndex($title, $hash = FALSE) {
        if (isset($_GET['c']) && !empty($_GET['c'])) {
            $category = $_GET['c'];
        } else {
            $k = base64_decode(base64_decode($hash));
            $params = \common\models\ModelMaster::decodeParams($hash);
            $categoryId = $params['categoryId'];
        }

        //echo '<pre>';
        //print_r($params);
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $productCanSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchCategory('', $categoryId, '', ''),
            'pagination' => ['defaultPageSize' => 15],
        ]);

        $productNotSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchCategoryNotSale('', $categoryId, '', ''),
            'pagination' => ['defaultPageSize' => 15],
        ]);
        $productSupplierId = '';

        $productFilterBrand = new ArrayDataProvider(
        [
            'allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($categoryId)
        ]);


        return $this->render('index', compact('productCanSell', 'category', 'categoryId', 'productSupplierId', 'productNotSell', 'productFilterBrand', 'title'));
    }

    public function actionCozxyProduct() {
        //$category = Yii::$app->request->post('search');
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, FALSE)]);
        //return $this->render('index', compact('productCanSell', 'category'));
        $category = Yii::$app->request->post('search');
        $categoryId = NULL;

        $productCanSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearch($category, 18, FALSE),
            'pagination' => ['defaultPageSize' => 18],
        ]);

        $productNotSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchNotSale($category, 18, FALSE),
            'pagination' => ['defaultPageSize' => 18],
        ]);


        $productFilterBrand = new ArrayDataProvider(
        [
            'allModels' => \frontend\models\DisplayMyBrand::MyFilterBrand($categoryId)
        ]);


        return $this->render('index', compact('productCanSell', 'category', 'categoryId', 'productNotSell', 'productFilterBrand'));
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
            'allModels' => DisplaySearch::productSearchBrand($brandId, '', FALSE, 'sale')
            , 'pagination' => ['defaultPageSize' => 12]
        ]);

        $productNotSell = new ArrayDataProvider(
        [
            'allModels' => DisplaySearch::productSearchBrand($brandId, '', FALSE, 'notsale')
            , 'pagination' => ['defaultPageSize' => 12]
        ]);

        return $this->render('brand', compact('productCanSell', 'brandName', 'productNotSell'));
    }

    public function actionFilterPrice() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $categoryId = Yii::$app->request->get('categoryId');
        $brand = Yii::$app->request->post('brand');
        $FilterPrice = [];
        //$productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, $mins, $maxs)]);
        $productFilterPrice = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId, $brand, $mins, $maxs),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $category = \common\models\costfit\Category::findOne($categoryId)->title;
        return $this->renderAjax("_product_list", ['dataProvider' => $productFilterPrice, 'category' => $category, 'categoryId' => $categoryId]);
    }

    public function actionFilterBrand() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brand = Yii::$app->request->post('brand');
        $categoryId = Yii::$app->request->get('categoryId');

        $FilterPrice = [];
        $productFilterPrice = new ArrayDataProvider([
            'allModels' => DisplaySearch::productFilterAll($categoryId, $brand, $mins, $maxs),
            'pagination' => ['defaultPageSize' => 21]
        ]);
        $category = \common\models\costfit\Category::findOne($categoryId)->title;
        return $this->renderAjax("_product_list", ['dataProvider' => $productFilterPrice, 'category' => $category, 'categoryId' => $categoryId]);
    }

    public function actionSortCozxy() {
        $FilterPrice = [];
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $brand = Yii::$app->request->post('brand');
        $categoryId = Yii::$app->request->get('categoryId');
        $status = Yii::$app->request->post('status');
//        $sortBrand = Yii::$app->request->post('sortBrand');
//        $sortPrice = Yii::$app->request->post('sortPrice');
//        $sortNew = Yii::$app->request->post('sortNew');
        $sort = Yii::$app->request->post('sort');

        $productFilterPrice = new ArrayDataProvider([
            'allModels' => DisplaySearch::productSortAll($categoryId, $brand, $mins, $maxs, $status, $sort),
            'pagination' => ['defaultPageSize' => 12]
        ]);
        $sortstatus = ($status == "price") ? "price" : (($status == "brand") ? "brand" : "new");

        $category = \common\models\costfit\Category::findOne($categoryId)->title;
        return $this->renderAjax("_product_list", ['dataProvider' => $productFilterPrice, 'category' => $category, 'categoryId' => $categoryId, 'sort' => $sort, 'sortstatus' => $sortstatus]);
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
