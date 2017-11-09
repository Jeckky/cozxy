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

}
