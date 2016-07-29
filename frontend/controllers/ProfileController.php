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
use yii\data\ActiveDataProvider;

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

        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'profile';
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];
            $model->password = $_POST["User"]['newPassword'];  // Normal Password
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password); // Convert Password
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('profile', ['model' => $model]);
    }

    public function actionPayment() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        echo $this->iSLogin();
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

        $query = \common\models\costfit\Order::find()->where("userId ='" . Yii::$app->user->id . "'");

        //$query->orderBy('createDateTime desc');
        $model_list = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('@app/views/profile/order_history', compact('model_list'));
    }

    public function actionDataAddress() {
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";
        $model = new \common\models\costfit\Address(['scenario' => 'shipping_address']);
        //$loginForm = new \common\models\LoginForm();
        $model->type = 1; // default Address First
        $status_address = Yii::$app->controller->action->id;
        if ($status_address == 'billings-address') {
            $label = 'Default billings address';
            $model->isDefault = 1;  // TYPE_BILLING = 1; // ที่อยู่จัดส่งเอกสาร
        } elseif ($status_address == 'shipping-address') {
            $label = 'Default shipping  address';
            $model->isDefault = 2; // TYPE_SHIPPING = 2; // ที่อยู่จัดส่งสินค้า
        } else {
            $label = "";
            $model->isDefault = "";
        }
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
        $model->type = \common\models\costfit\Address::TYPE_SHIPPING; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Default shipping  address';
        $model->isDefault = 0;

        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/add_address', ['model' => $model, 'label' => $label]);
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
        $model->type = \common\models\costfit\Address::TYPE_BILLING; // default Address First
        $status_address = Yii::$app->controller->action->id;

        $label = 'Default billings address';
        $model->isDefault = 0;

        if (isset($_POST['Address'])) {
            $model->attributes = $_POST['Address'];
            $model->userId = Yii::$app->user->id;
            $model->createDateTime = new \yii\db\Expression("NOW()");
            if ($model->save(FALSE)) {
                $this->redirect(Yii::$app->homeUrl . 'profile');
            }
        }
        return $this->render('@app/views/profile/add_address', ['model' => $model, 'label' => $label]);
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

    public function actionGetAddress() {

        $model = \common\models\costfit\Address::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        if (isset($_POST["User"])) {
            $model->attributes = $_POST['User'];
        }
        //echo '<pre>';
        //print_r($model);
        return $this->render('@app/views/profile/add_shipping-address', ['model' => $model]);
    }

    public function actionReset() {
        $request = Yii::$app->request;
        $token = $request->post('token');
        // $loginForm = new common\models\User();
        //$loginForm->login();

        if (Yii::$app->security->validatePassword($token, \Yii::$app->user->identity->password_hash)) {
            // Password Match
            echo TRUE;
        } else {
            //No Match
            echo FALSE;
        }


        // $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "' and password_hash ='" . $token . "'   ")->one();
        //if (count($model) == 1) {
        //echo TRUE;
        //} else {
        //echo FALSE;
        //}
    }

}
