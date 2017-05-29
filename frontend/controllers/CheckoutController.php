<?php

namespace frontend\controllers;

use common\models\ModelMaster;
use Yii;
use yii\base\InvalidParamException;
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

class CheckoutController extends MasterController {

    public function actionIndex() {
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        $pickingPoint_list_lockers = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->one(); // Lockers ร้อน
        $pickingPoint_list_lockers_cool = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->one(); // Lockers เย็น
        $pickingPoint_list_booth = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->one(); // Booth
        $pickingPointLockers = isset($pickingPoint_list_lockers) ? $pickingPoint_list_lockers : NULL;
        $pickingPointLockersCool = isset($pickingPoint_list_lockers_cool) ? $pickingPoint_list_lockers_cool : NULL;
        $pickingPointBooth = isset($pickingPoint_list_booth) ? $pickingPoint_list_booth : NULL;
        return $this->render('index', compact('model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth'));
    }

    public function actionSummary() {
        return $this->render('summary');
    }

    public function actionThanks() {
        return $this->render('thanks');
    }

}
