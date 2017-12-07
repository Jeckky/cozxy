<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use common\models\dbworld\States;
use common\models\ModelMaster;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use \common\models\costfit\Order;
use common\helpers\RewardPoints;
use common\helpers\PickingPoint;
use common\helpers\Email;
use common\helpers\Local;
use common\models\costfit\UserPoint;
use common\models\costfit\PointUsed;
use frontend\models\DisplayMyAddress;
use yii\data\ArrayDataProvider;
use common\helpers\CozxyCalculatesCart;

/**
 * Description of ShipCozxtBox
 *
 * @author cozxy
 */
class ShipCozxyBoxController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login?cz=' . time());
        }

        $pickingPointActive = \common\models\costfit\PickingPoint::find()->where('status =1');
        $pickingPointActiveShow = new \yii\data\ActiveDataProvider([
            'query' => $pickingPointActive,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 100,
            ]
        ]);
        $orderId = (isset($_POST['orderId']) && !empty($_POST['orderId'])) ? $_POST['orderId'] : $this->view->params['cart']['orderId'];
        $order = Order::find()->where(['orderId' => $orderId])->one();
        if (isset($order->pickingId) && !empty($order->pickingId)) {
            $pickingPoint = \common\models\costfit\PickingPoint::find()->where(['pickingId' => $order->pickingId, 'status' => 1])->one();
            if (count($pickingPoint) <= 0) {
                $pickingPoint = new \common\models\costfit\PickingPoint();
            }
        } else {
            $pickingPoint = new \common\models\costfit\PickingPoint();
            $defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId])->orderBy('isDefault desc')->one();

            if (isset($defaultAddress)) {
                $order->addressId = $defaultAddress->addressId;
            }
            //echo count($pickingPoint) . '<pre>';
            //print_r($pickingPoint);
            //echo '<pre>';
            //print_r($pickingPointActive);

            return $this->render('/checkout/shipCozxyBox', compact('pickingPointActiveShow', 'getUserInfo', 'NewBilling', 'model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash', 'pickingPoint', 'defaultAddress'));
        }
    }

}
