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
 * Products controller
 */
class ProductsController extends MasterController {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($name = NULL, $id = null) {
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'Shop - filters left 3 cols ';
        $this->subSubTitle = 'Shop - single item v2';
        return $this->render('products', ['name' => $name, 'id' => $id]);
    }

}
