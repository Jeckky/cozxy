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
 * Coupon controller
 */
class ReviewsController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cozxy.com | content';
        $this->subTitle = 'ชื่อ content';
        return $this->render('@app/views/content/content');
    }

    public function actionCreateReview() {

        $this->title = 'Cozxy.com | Create Review';
        $this->subTitle = 'ชื่อ content';
        return $this->render('@app/views/reviews/create');
    }

    public function actionSeeReview() {

        $this->title = 'Cozxy.com | See Review';
        $this->subTitle = 'ชื่อ content';
        return $this->render('@app/views/reviews/see');
    }

}
