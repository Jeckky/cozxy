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

/**
 * Description of BeOurPartner
 *
 * @author it
 */
class TestController extends MasterController {

    //put your code here
    public function actionIndex() {
        $Order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id)->orderBy('orderId desc')->one();
        //echo '<pre>';
        //print_r($Order->attributes);
        $total = round($Order->total);
        $TotalExVat = CozxyCalculatesCart::FormulaTotalExVat($total);
        $vat = CozxyCalculatesCart::FormulaVAT($TotalExVat);
        $SubTotal = CozxyCalculatesCart::FormulaSubTotal($TotalExVat, $vat);
        echo '<br>Total : ' . number_format($total, 2);
        echo '<br>TotalExVat : ' . number_format($TotalExVat, 2);
        echo '<br>Vat : ' . number_format($vat, 2);
        //echo '<br>Sum Total : ' . $TotalExVat + $vat;
        echo "<br> sum :" . number_format($SubTotal, 2);
    }

}
