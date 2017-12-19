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
use common\helpers\CozxyMap;

/**
 * Description of ShipCozxtBox
 *
 * @author cozxy
 */
class ShipCozxyBoxController extends MasterController {

    public function actionIndex() {
        $PickingPointJson = CozxyMap::PickingPointJson();

        //print_r($PickingPointJson);
        $orderId = (isset($_POST['orderId']) && !empty($_POST['orderId'])) ? $_POST['orderId'] : $this->view->params['cart']['orderId'];

        if (!isset($orderId)) {
            return $this->redirect(Yii::$app->homeUrl);
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login?cz=' . time());
        }

        $pickingPointActiveMap = \common\models\costfit\PickingPoint::find()->where('status =1 and `latitude` is not null and `longitude` is not null')->all();
        foreach ($pickingPointActiveMap as $key => $value) {
            //echo $value[$key]->attributes . '<br>';
            //echo '<pre>';
            //print_r($value->attributes);
            $activeMap[] = $value->attributes;
        }
        //echo '<pre>';
        //print_r();
        $pickingPointActive = \common\models\costfit\PickingPoint::find()->where('status =1 and latitude is not null and longitude is not null');
        $pickingPointActiveShow = new \yii\data\ActiveDataProvider([
            'query' => $pickingPointActive,
            'pagination' => [
                'pageSize' => isset($n) ? $n : 100,
            ]
        ]);

        $order = Order::find()->where(['orderId' => $orderId])->one();
        if (isset($order->pickingId) && !empty($order->pickingId)) {
            $pickingPoint = \common\models\costfit\PickingPoint::find()->where(['pickingId' => $order->pickingId, 'status' => 1])->one();
            if (count($pickingPoint) <= 0) {
                $pickingPoint = new \common\models\costfit\PickingPoint();
            }
            $shippingChooseActive = 1; //Ship To CozxyBox
        } else if (isset($order->addressId) && !empty($order->addressId)) {
            $pickingPoint = new \common\models\costfit\PickingPoint();
            $defaultAddress = \common\models\costfit\Address::find()->where(['userId' => Yii::$app->user->identity->userId])->orderBy('isDefault desc')->one();

            if (isset($defaultAddress)) {
                $order->addressId = $defaultAddress->addressId;
            }
            //echo count($pickingPoint) . '<pre>';
            //print_r($pickingPoint);
            //echo '<pre>';
            //print_r($pickingPointActive);
            $shippingChooseActive = 2; //Ship to address
        } else {
            $pickingPoint = new \common\models\costfit\PickingPoint();
            $shippingChooseActive = 1; //Default Ship To CozxyBox
        }

        return $this->render('/checkout/shipCozxyBox', compact('shippingChooseActive', 'activeMap', 'pickingPointActiveShow', 'getUserInfo', 'NewBilling', 'model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'order', 'hash', 'pickingPoint', 'defaultAddress'));
    }

    public static function actionLocationPickUp1() {
        $stateId = $_POST['stateId'];
        $amphurId = $_POST['amphurId'];
        if (isset($stateId) && isset($amphurId)) {
            $pickingPoint = \common\models\costfit\PickingPoint::find()
                            ->where('provinceId=' . $stateId . ' and amphurId=' . $amphurId)->all();
            foreach ($pickingPoint as $key => $value) {
                $pickUp[$value['pickingId']] = [
                    'pickingId' => $value['pickingId'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'latitude' => $value['latitude'],
                    'longitude' => $value['longitude']
                ];
            }
            return print_r($pickUp);
            /* return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/locationPickUp", [
              'pickingPointActiveShow' => $pickUp,
              ]); */
            if (isset($pickingPoint)) {

                /* return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/locationPickUp", [
                  'pickingPointActiveShow' => $pickingPointActiveShow,
                  ]); */
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function actionLocationPickUp() {
        $stateId = $_POST['stateId'];
        $amphurId = $_POST['amphurId'];

        $pickingPoint = \common\models\costfit\PickingPoint::find()
                        ->where('provinceId=' . $stateId . ' and amphurId=' . $amphurId . ' and status =1')->all();
        foreach ($pickingPoint as $key => $value) {
            $pickUp[$value['pickingId']] = [
                'pickingId' => $value['pickingId'],
                'title' => $value['title'],
                'description' => $value['description'],
                'latitude' => $value['latitude'],
                'longitude' => $value['longitude']
            ];
        }
        //return print_r($pickUp);
        return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/locationPickUp", [
                    'pickingPointActiveShow' => $pickUp,
        ]);
        //return $this->renderAjax('locationPickUp', '');
    }

    // location-pick-up-click
    public function actionLocationPickUpClick() {

        $pickingId = $_POST['pickingId'];

        $pickingPoint = \common\models\costfit\PickingPoint::find()
                        ->where('pickingId=' . $pickingId)->one();
        //foreach ($pickingPoint as $key => $value) {
        $pickUp[$pickingPoint['pickingId']] = [
            'pickingId' => $pickingPoint['pickingId'],
            'title' => $pickingPoint['title'],
            'description' => $pickingPoint['description'],
            'latitude' => $pickingPoint['latitude'],
            'longitude' => $pickingPoint['longitude'],
            'provinceId' => $pickingPoint['provinceId'],
            'amphurId' => $pickingPoint['amphurId']
        ];
        //}
        //return print_r($pickUp);
        return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/locationPickUp", [
                    'pickingPointActiveShow' => $pickUp,
        ]);
        //return $this->renderAjax('locationPickUp', '');
    }

    //location-picking-point
    public function actionLocationPickingPoint() {

        $pickingId = $_POST['pickingId'];

        $pickingPoint = \common\models\costfit\PickingPoint::find()
                        ->where('pickingId=' . $pickingId)->one();
        $pickingPointAmphur = \common\models\dbworld\Cities::find()->where('stateId=' . $pickingPoint['provinceId'] . ' and cityId=' . $pickingPoint['amphurId'])->one();
        //foreach ($pickingPoint as $key => $value) {
        $pickUp = [
            'pickingId' => $pickingPoint['pickingId'],
            'title' => $pickingPoint['title'],
            'description' => $pickingPoint['description'],
            'latitude' => $pickingPoint['latitude'],
            'longitude' => $pickingPoint['longitude'],
            'longitude' => $pickingPoint['longitude'],
            'provinceId' => $pickingPoint['provinceId'],
            'amphurId' => $pickingPoint['amphurId'],
            'titleTh' => $pickingPointAmphur['localName'],
            'titleEn' => $pickingPointAmphur['cityName'],
        ];
        //}
        return json_encode($pickUp);
        /* return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/locationPickUp", [
          'pickingPointActiveShow' => $pickUp,
          ]); */
        //return $this->renderAjax('locationPickUp', '');
    }

    public function actionCozxyBoxSelect() {
        $pickingPoint = new \common\models\costfit\PickingPoint();
        return $this->renderAjax("@app/themes/cozxy/layouts/checkout/item/shipToCozxyBoxSelect", compact('pickingPoint'));
    }

}
