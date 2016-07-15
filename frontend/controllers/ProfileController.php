<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Profile controller
 */
class ProfileController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | My Profile';
        $this->subTitle = 'Home';
        $this->subSubTitle = "My Profile";
//return $this->render('profile_layouts');
        return $this->render('profile');
    }

    public function actionPayment() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | ช่องทางการชำระเงิน';
        $this->subTitle = 'Home';
        $this->subSubTitle = "ช่องทางการชำระเงิน";
        return $this->render('@app/views/payment/payment');
    }

    public function actionOrder() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Order History';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Order History";
        return $this->render('@app/views/profile/order_history');
    }

    public function actionShippingAddress() {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";

        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        //$loginForm = new \common\models\LoginForm();

        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        $model->isDefault = 0;
        return $this->render('@app/views/profile/add_address', ['model' => $model]);
    }

    public function actionBillingsAddress() {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";

        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        //$loginForm = new \common\models\LoginForm();

        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        $model->type = 0;

        return $this->render('@app/views/profile/add_address', ['model' => $model]);
    }

    public function actionAddPaymentMethod() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Payment Method';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Payment Method";
        return $this->render('@app/views/profile/add_payment_method');
    }

    public function actionEditInfo() {

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Contact Information';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Contact Information";

        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();

        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];

            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }

        return $this->render('@app/views/profile/edit_info', ['model' => $model]);
    }

    // CONTROLLER
    public function actionChildStates() {
        $out = [];
        //echo $_POST['depdrop_parents'];
        //exit();
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\States::find()->andWhere(['countryId' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['stateId'], 'name' => $account['stateName']];
                    if ($i == 0) {
                        $selected = $account['stateId'];
                    }
                }
                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    // CONTROLLER
    public function actionChildAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\Cities::find()->andWhere(['stateId' => $id])->asArray()->all();

            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['cityId'], 'name' => $account['cityName']];
                    if ($i == 0) {
                        $selected = $account['cityId'];
                    }
                }
                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

    // CONTROLLER
    public function actionChildDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $list = \common\models\dbworld\District::find()->andWhere(['cityId' => $id])->asArray()->all();
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $account) {
                    $out[] = ['id' => $account['districtId'], 'name' => $account['localName']];
                    if ($i == 0) {
                        $selected = $account['districtId'];
                    }
                }

                // Shows how you can preselect a value
                echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
            //echo 'no';
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected..' => '']);
    }

}
