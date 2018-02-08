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
        $brand = Brand::allAvailableBrands();
        return $this->render('index', compact('brand'));
    }

}
