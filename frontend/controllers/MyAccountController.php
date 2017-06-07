<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\DisplayMyAccount;

class MyAccountController extends MasterController {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $billingAddress = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountBillingAddress('', \common\models\costfit\Address::TYPE_BILLING)]);
        $personalDetails = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountPersonalDetails('', '')]);
        $cozxyCoin = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountCozxyCoin('', '')]);
        $wishList = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountWishList('', '')]);
        $orderHistory = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountOrderHistory('', '')]);
        $productPost = new ArrayDataProvider(['allModels' => \frontend\models\DisplayMyStory::productMyaacountStories('', '', '')]);
        return $this->render('index', compact('billingAddress', 'personalDetails', 'cozxyCoin', 'wishList', 'orderHistory', 'productPost'));
    }

    public function actionEditPersonalDetail() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'editinfo'; // calling scenario of update

        if (isset($_POST["User"])) {
            $editPersonalDetail = \frontend\models\DisplayMyAccount::myAccountEditPersonalDetail($_POST["User"]);
            if ($editPersonalDetail == TRUE) {
                return $this->redirect(['/my-account']);
            } else {
                return $this->redirect(['/my-account/edit-personal-detail']);
            }
        } else {
            $birthDate = $model->birthDate;
            $historyBirthDate = [];
            if (isset($birthDate)) {
                $birthDateFull = explode(' ', $model->attributes['birthDate']);
                $birthDateShort = explode('-', $birthDateFull[0]);
                $historyBirthDate['day'] = $birthDateShort[2];
                $historyBirthDate['month'] = $birthDateShort[1];
                $historyBirthDate['year'] = $birthDateShort[0];
            } else {
                $historyBirthDate['day'] = FALSE;
                $historyBirthDate['month'] = FALSE;
                $historyBirthDate['year'] = FALSE;
            }
            return $this->render('@app/themes/cozxy/layouts/my-account/_form_personal_detail', compact('model', 'historyBirthDate'));
        }
    }

    public function actionNewBilling() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->type = \common\models\costfit\Address::TYPE_BILLING;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                return $this->redirect(['/my-account']);
            }
        }
        if (!isset($model->isDefault)) {
            $model->isDefault = 0;
        }
        $hash = 'add';
        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing', compact('model', 'hash'));
    }

    public function actionChangePassword() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'profile'; // calling scenario of update
        if (isset($_POST["User"])) {

            $editChangePassword = \frontend\models\DisplayMyAccount::myAccountChangePassword($_POST["User"]);
            if ($editChangePassword == TRUE) {
                return $this->redirect(['/my-account']);
            } else {
                return $this->redirect(['/my-account/change-password']);
            }
        } else {
            return $this->render('@app/themes/cozxy/layouts/my-account/_form_change_password', compact('model'));
        }
    }

    public function actionReset() {
        $request = Yii::$app->request;
        $token = $request->post('token');

        if (Yii::$app->security->validatePassword($token, \Yii::$app->user->identity->password_hash)) {
// Password Match
            echo TRUE;
        } else {
//No Match
            echo FALSE;
        }
    }

    public function actionEditBilling($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $addressId = $params['addressId'];
        $model = \common\models\costfit\Address::find()->where('addressId=' . $addressId)->one();
        $model->scenario = 'shipping_address';
        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($_POST["Address"]['isDefault']) {
                \common\models\costfit\Address::updateAll(['isDefault' => 0], ['userId' => Yii::$app->user->id, 'addressId' => $addressId, 'type' => \common\models\costfit\Address::TYPE_BILLING]);
                $model->isDefault = 1;
            }
            $model->userId = Yii::$app->user->id;
            $model->type = \common\models\costfit\Address::TYPE_BILLING;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                return $this->redirect(['/my-account']);
            }
        }
        if (!isset($model->isDefault)) {
            $model->isDefault = 0;
        }
        $hash = 'edit';

        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing', compact('model', 'hash'));
    }

    public function actionDeleteItemToBillingAddress() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->homeUrl . 'site/login');
        }
        $address_id = Yii::$app->request->post('addressId');
        $model = \common\models\costfit\Address::find()->where("addressId ='" . $address_id . "'")->one();
        if ($model->delete()) {
            echo 'complete';
        } else {
//$this->redirect(Yii::$app->homeUrl . 'profile');
            echo 'wrong';
        }
    }

    public function actionPurchaseOrder($hash) {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $orderId = Yii::$app->request->get('OrderNo');
        //$this->layout = "/content_profile";
        $this->title = 'Cozxy.com | Order Purchase';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order Purchase";

        //echo htmlspecialchars($orderId);
        if (isset($params['orderId'])) {
            $order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId = "' . $params['orderId'] . '" ')->one();
            $issetPoint = \common\models\costfit\UserPoint::find()->where("userId=" . $order->userId)->one();
            if (isset($issetPoint)) {
                $userPoint = $issetPoint;
            } else {
                $userPoint = $this->CreateUserPoint($order->userId);
            }
            //$orderItem = PickingPoint::GetOrderItemrGroupLockersMaster($orderId);
            return $this->render('@app/themes/cozxy/layouts/my-account/purchase_order', compact('order', 'userPoint'));
        } else {
            return $this->redirect(['my-account']);
        }
    }

}
