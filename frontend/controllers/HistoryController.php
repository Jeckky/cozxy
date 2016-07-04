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
 * history controller
 */
class HistoryController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->layout = "/content_right";
        $this->title = 'Cost.fit | history';
        $this->subTitle = 'Shop - filters left 3 cols ';
        $this->subSubTitle = 'Shop - single item v1';
        return $this->render('history');
    }

}
