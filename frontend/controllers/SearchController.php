<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use frontend\models\FakeFactory;
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
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, $categoryId)]);
        $category = $_GET['c'];
        return $this->render('index', compact('productCanSell', 'category'));
    }

    public function actionCozxyProduct() {
        $category = Yii::$app->request->post('search');
        $productCanSell = new ArrayDataProvider(['allModels' => FakeFactory::productForSale(9, FALSE)]);
        return $this->render('index', compact('productCanSell', 'category'));
    }

}
