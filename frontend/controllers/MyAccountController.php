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
        //echo '<pre>';
        //print_r($model->scenario);
        //exit();
        if ($model->load(Yii::$app->request->post())) {

        } else {
            return $this->render('@app/themes/cozxy/layouts/my-account/_form_personal_detail', compact('model'));
        }
    }

    public function actionNewBilling() {
        return $this->render('@app/themes/cozxy/layouts/my-account/_form_billing');
    }

    public function actionChangePassword() {
        return $this->render('@app/themes/cozxy/layouts/my-account/_form_change_password');
    }

}
