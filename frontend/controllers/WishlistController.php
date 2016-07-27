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
 * Wishlist controller
 */
class WishlistController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->layout = 'content_right';
        $this->title = 'Cost.fit | wishlist';
        $this->subTitle = 'Wishlist';
        $this->subSubTitle = '';
        $wishlists = \common\models\costfit\Wishlist::find()->where("userId=" . \Yii::$app->user->id)->all();
        $product = \common\models\costfit\search\Product::find()->where("categoryId='3'")->all();
        return $this->render('wishlist', compact('wishlists', 'product'));
    }

}
