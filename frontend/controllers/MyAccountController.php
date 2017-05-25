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

class MyAccountController extends \yii\web\Controller {

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $billingAddress = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountBillingAddress('', \common\models\costfit\Address::TYPE_BILLING)]);
        $personalDetails = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountPersonalDetails('', '')]);
        $cozxyCoin = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountCozxyCoin('', '')]);
        $wishList = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountWishList('', '')]);
        $orderHistory = new ArrayDataProvider(['allModels' => DisplayMyAccount::myAccountOrderHistory('', '')]);
        return $this->render('index', compact('billingAddress', 'personalDetails', 'cozxyCoin', 'wishList', 'orderHistory'));
    }

    public function actionEditPersonalDetail() {
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
        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing');
    }

    public function actionChangePassword() {
        return $this->render('@app/themes/cozxy/layouts/my-account/_form_change_password');
    }

}
