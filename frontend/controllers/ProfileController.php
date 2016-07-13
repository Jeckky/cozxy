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

    public function actionAddAddress() {
        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }
        $this->layout = "/content_profile";
        $this->title = 'Cost.fit | Default Shipping Assdress';
        $this->subTitle = 'Home';
        $this->subSubTitle = "Default Shipping Assdress";
        return $this->render('@app/views/profile/add_address');
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

}
