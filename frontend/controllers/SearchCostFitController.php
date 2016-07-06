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

/**
 * Search Cost Fit controller
 */
class SearchCostFitController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cost.fit | Search Cost.fit';
        $this->subTitle = 'search';
        $search_hd = $_POST['search_hd'];

        return $this->render('@app/views/search/searchcostfit');
    }

}
