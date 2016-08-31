<?php

namespace frontend\controllers;

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

/**
 * Tracking controller
 */
class ContactUsController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cost.fit | contact us';
        $this->subTitle = 'contact us';
        $this->subSubTitle = 'Delivery';
        if (isset($_POST['email'])) {
            $model = new \common\models\costfit\ContactUs();
            $model->fullname = $_POST['name'];
            $model->email = $_POST['email'];
            $model->message = $_POST['message'];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');
        }
        return $this->render('@app/views/contactus/contactus');
    }

}
