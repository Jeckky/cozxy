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
use frontend\models\DisplayMyAddress;
use yii\data\ArrayDataProvider;

class CheckoutController extends MasterController {

    public function actionIndex() {
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        $pickingPoint_list_lockers = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_HOT)->one(); // Lockers ร้อน
        $pickingPoint_list_lockers_cool = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_LOCKERS_COOL)->one(); // Lockers เย็น
        $pickingPoint_list_booth = \common\models\costfit\PickingPoint::find()->where('type = ' . \common\models\costfit\ProductSuppliers::APPROVE_RECEIVE_BOOTH)->one(); // Booth
        $pickingPointLockers = isset($pickingPoint_list_lockers) ? $pickingPoint_list_lockers : NULL;
        $pickingPointLockersCool = isset($pickingPoint_list_lockers_cool) ? $pickingPoint_list_lockers_cool : NULL;
        $pickingPointBooth = isset($pickingPoint_list_booth) ? $pickingPoint_list_booth : NULL;
        $hash = 'add';
        return $this->render('index', compact('model', 'pickingPointLockers', 'pickingPointLockersCool', 'pickingPointBooth', 'hash'));
    }

    public function actionSummary() {
        $provinceid = Yii::$app->request->post('provinceId');
        $amphurid = Yii::$app->request->post('amphurId');
        $LcpickingId = Yii::$app->request->post('LcpickingId');
        $addressId = Yii::$app->request->post('addressId');

        if (isset($LcpickingId) && !empty($LcpickingId)) {
            $Lcpicking = \common\models\costfit\PickingPoint::find()->where('pickingId=' . $LcpickingId)->one();

            if (isset($Lcpicking->attributes) && !empty($Lcpicking->attributes)) {
                $Lcpicking = $Lcpicking->attributes;
            } else {
                $Lcpicking = Null;
            }
        } else {
            $Lcpicking = Null;
        }

        $myAddressInSummary = new ArrayDataProvider(['allModels' => DisplayMyAddress::myAddress($addressId, \common\models\costfit\Address::TYPE_BILLING)]);
        return $this->render('summary', compact('myAddressInSummary', 'Lcpicking'));
    }

    public function actionThanks() {
        return $this->render('thanks');
    }

    public function actionAddress() {
        $addressId = Yii::$app->request->post('addressId');

        if (isset($addressId) && !empty($addressId)) {
            return DisplayMyAddress::myAddress($addressId, FALSE);
        }
    }

    function actionMapImages() {
        //echo 'test map images';
        $pickingId = Yii::$app->request->post('pickingIds');
        //$pickingId = 1;
        if (isset($pickingId) && !empty($pickingId)) {
            $mapImages = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $pickingId)->one();
            //print_r($mapImages->attributes);
            if (isset($mapImages) && !empty($mapImages)) {
                return json_encode($mapImages->attributes);
            } else {
                return NULL;
            }
        }
    }

    function actionMapImagesGoogle() {
        //echo 'test map images';
        $pickingId = Yii::$app->request->post('pickingIds');
        //$pickingId = 1;
        if (isset($pickingId) && !empty($pickingId)) {
            $mapImages = \common\models\costfit\PickingPoint::find()->where('pickingId = ' . $pickingId)->one();

            if (isset($mapImages) && !empty($mapImages)) {
                return json_encode($mapImages->attributes);
            } else {
                return NULL;
            }
        }
    }

}
