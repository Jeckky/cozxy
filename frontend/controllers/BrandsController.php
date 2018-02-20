<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use common\models\costfit\Brand;

class BrandsController extends MasterController {

    public $layout = '@app/themes/cozxy/layoutsV2/main';

    public function actionIndex() {
        /* Query เอา Brand ที่ Sum Result มากที่สุด จำนวน 20 Brand */
        $brand = Brand::popularBrands(24);
        //$brand = Brand::popularBrands();
        //$brand = Brand::allAvailableBrands();
        $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        //foreach ($alphabet as $value) {
        //$testBrands[$value] = \common\models\costfit\Brand::find()->select('title')->where('title like "' . $value . '%"')->all();
        //}
        //echo '<pre>';
        //print_r($testBrands);
        //exit();
        return $this->render('index', compact('brand', 'alphabet', 'testBrands'));
    }

}
