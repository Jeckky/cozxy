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
use common\helpers\Suppliers;
use common\models\costfit\ProductSuppliers;

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

        $model = \common\models\costfit\ProductPost::find()->where("productSuppId=" . $_GET["productSupplierId"])->one();
        if (!isset($model)) {
            $model = new \common\models\costfit\ProductPost();
        }

        return $this->render('@app/views/reviews/create', compact("model"));
    }

    public function actionSeeReview() {

        $this->title = 'Cozxy.com | See Review';
        $this->subTitle = 'ชื่อ content';

        $productId = $_GET['productId'];
        $productSupplierId = $_GET['productSupplierId'];
        /*
         * Get Product Suppliers
         * create date : 14/01/2017
         * create by : taninut.bm
         */
        $getPrductsSupplirs = Suppliers::GetProductSuppliersHelpers($productSupplierId);
        $supplierPrice = ProductSuppliers::productPriceSupplier($productSupplierId);
        if (\Yii::$app->user->id != '') {
            $productPost = \common\models\costfit\ProductPost::find()->limit(6)->all();
            $productPostViewMem = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id)->limit(6)->all();
        } else {
            $productPostView = NULL;
            $productPostViewMem = NULL;
        }
        //echo '<pre>';
        //print_r($getPrductsSupplirs);
        //exit();
        $model = \common\models\costfit\Product::find()->where("productId =" . $productId)->one();
        $this->title = 'Cozxy.com | Products';
        $this->subTitle = $model->attributes['title'];
        $this->subSubTitle = '';
        return $this->render('@app/views/reviews/see', compact("productPostViewMem", "productPost", "model", "getPrductsSupplirs", "productSupplierId", "supplierPrice"));
    }

}
