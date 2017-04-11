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
        $productSupplierId = Yii::$app->request->get('productSupplierId');
        $score = Yii::$app->request->post('score');
        $productId = Yii::$app->request->get('productId');
        $model = \common\models\costfit\ProductPost::find()->where("productSuppId=" . $_GET["productSupplierId"])->one();

        $model = new \common\models\costfit\ProductPost(['scenario' => 'review_post']);
        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->productSuppId = $productSupplierId;
            $model->brandId = NULL;
            $model->userId = Yii::$app->user->identity->userId;
            $model->description = $_POST["ProductPost"]['description'];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->save(FALSE);
            $product_post_rating = new \common\models\costfit\ProductPostRating();
            $productPostId = Yii::$app->db->lastInsertID;
            $product_post_rating->productPostId = $productPostId;
            $product_post_rating->userId = Yii::$app->user->identity->userId;
            $product_post_rating->score = $score;
            $product_post_rating->updateDateTime = new \yii\db\Expression('NOW()');
            $product_post_rating->createDateTime = new \yii\db\Expression('NOW()');
            $product_post_rating->save(FALSE);
            return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
        } else {
            //return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
        }

        return $this->render('@app/views/reviews/create', compact("model"));
    }

    public function actionSeeReview() {
        //echo Yii::$app->controller->action->id;
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
        $productPost = \common\models\costfit\ProductPost::find()->groupBy(['productSuppId'])->all();
        if (\Yii::$app->user->id != '') {
            //$productPostViewMem = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . ' and productSuppId=' . $productSupplierId)->limit(6)->all();
            $productPostViewMem = \common\models\costfit\ProductPost::find()->where('productSuppId=' . $productSupplierId)->limit(6)->all();
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
