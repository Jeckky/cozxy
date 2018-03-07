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

/**
 * Description of ApiOther
 *
 * @author cozxy
 */
class ApiOtherController extends MasterController {

    public function actionFilterCatInBrand() {
        $cateId = $_POST['categories'];
        $brand = \frontend\models\DisplayMyBrand::MyFilterCatToBrand($cateId);
        $text = '';
        foreach ($brand as $value) {
            $text .= "<div class=\"sub-" . $value['brandId'] . "-brands menu-item-brands-inbrand\">
    <a class=\"fc-black\" href=\"" . Yii::$app->homeUrl . 'search/brand/' . \common\models\ModelMaster::encodeParams(['brandId' => $value['brandId']]) . "\">" . $value['title'] . "</a>
</div>";
        }
        echo $text;
//echo \yii\helpers\Json::encode($brand);
    }

    public function actionFilterCatInSubCate() {
        $cateId = $_POST['categories'];
        $subCate = \frontend\models\DisplayMyBrand::MyFilterCatToSubCate($cateId);
        foreach ($subCate as $value) {
            echo $value['title'];
        }
    }

    public function actionTestApi(){

    }


}
