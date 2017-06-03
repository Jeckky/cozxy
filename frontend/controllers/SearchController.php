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
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $categoryId = $params['categoryId'];
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $productCanSell = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, FALSE, FALSE)]);
        $category = $_GET['c'];
        return $this->render('index', compact('productCanSell', 'category', 'categoryId'));
    }

    public function actionCozxyProduct() {
        //$category = Yii::$app->request->post('search');
        //$productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, FALSE)]);
        //return $this->render('index', compact('productCanSell', 'category'));
        $category = Yii::$app->request->post('search');

        $productCanSell = new ArrayDataProvider(['allModels' => DisplaySearch::productSearch($category, 9, FALSE)]);

        return $this->render('index', compact('productCanSell', 'category'));
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

        $productCanSell = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchBrand($brandId, 9, FALSE)]);

        return $this->render('brand', compact('productCanSell', 'brandName'));
    }

    public function actionFilterPrice() {
        $mins = Yii::$app->request->post('mins');
        $maxs = Yii::$app->request->post('maxs');
        $categoryId = Yii::$app->request->post('categoryId');
        // echo 'mins : ' . $mins . ', maxs : ' . $maxs;

        $productFilterPrice = new ArrayDataProvider(['allModels' => DisplaySearch::productSearchCategory(9, $categoryId, $mins, $maxs)]);
        //echo '<pre>';
        //print_r($productFilterPrice);
        return TRUE;
    }

}
