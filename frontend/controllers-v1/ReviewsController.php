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

        if (Yii::$app->user->isGuest == 1) {
            return Yii::$app->response->redirect(Yii::$app->homeUrl);
        }

        $this->layout = "/content_profile";
        $this->title = 'Cozxy.com | My stories';
        $this->subTitle = 'reviews';
        $this->subSubTitle = "My reviews";
        $productPost = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . ' and product_post.status =1')->groupBy(['productSuppId'])->orderBy('productPostId desc')->all();
        $model = \common\models\costfit\User::find()->where("userId ='" . Yii::$app->user->id . "'")->one();
        $model->scenario = 'profile';

        return $this->render('reviews', ['model' => $model, 'productPost' => $productPost]);
    }

    public function actionCreateReview() {

        $this->title = 'Cozxy.com | Create Review';
        $this->subTitle = 'ชื่อ content';
        $productSupplierId = Yii::$app->request->post('productSupplierId');
        $score = Yii::$app->request->post('score');
        $productId = Yii::$app->request->post('productId');
        $productPostId = Yii::$app->request->post('productPostId');
        //$model = \common\models\costfit\ProductPost::find()->where("productSuppId=" . $productSupplierId)->one();
        //$model = new \common\models\costfit\ProductPost(['scenario' => 'review_post']);
        $product_post_rating = new \common\models\costfit\ProductPostRating(['scenario' => 'review_post']);
        if (isset($score)) {
            //echo $score;
            //$productPostId = $productPostId;
            $product_post_rating->productPostId = $productPostId;
            $product_post_rating->userId = Yii::$app->user->identity->userId;
            $product_post_rating->score = $score;
            $product_post_rating->updateDateTime = new \yii\db\Expression('NOW()');
            $product_post_rating->createDateTime = new \yii\db\Expression('NOW()');
            $product_post_rating->save(FALSE);

            return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productPostId=' . $productPostId . '&productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
        } else {
            //return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
        }

        //return $this->render('@app/views/reviews/create', compact("model"));
    }

    public function actionCreatePost() {

        $this->title = 'Cozxy.com | Create Review';
        $this->subTitle = 'ชื่อ content';
        $request = Yii::$app->request;
        $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/story/';
        if (!file_exists($urlFolder)) {
            mkdir($urlFolder, 0777);
        }
        $urlFolderUser = \Yii::$app->getBasePath() . '/web/' . 'images/story/' . Yii::$app->user->id . "/";
        if (!file_exists($urlFolderUser)) {
            mkdir($urlFolderUser, 0777);
        }
        if ($request->isGet) { /*  ตรวจสอบว่าเป็น GET */
            $productSupplierId = Yii::$app->request->get('productSupplierId');
            $productId = Yii::$app->request->get('productId');
        }
        if ($request->isPost) { /* ตรวจสอบว่าเป็น POST */
            $productSupplierId = Yii::$app->request->post('productSupplierId');
            $productId = Yii::$app->request->post('productId');
        }

        $score = Yii::$app->request->post('score');

        $model = \common\models\costfit\ProductPost::find()->where("productSuppId=" . $productSupplierId . " AND userId =" . Yii::$app->user->id . ' and product_post.status =1')->one();
        if (!isset($model)) {
            $model = new \common\models\costfit\ProductPost(['scenario' => 'review_post']);
        }

        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->productSuppId = $productSupplierId;
            $model->brandId = NULL;
            $model->userId = Yii::$app->user->identity->userId;
            $model->description = $_POST["ProductPost"]['description'];
            $action = isset($_POST['action']) ? $_POST['action'] : NULL;
            if ($action == "draft") {
                $model->status = \common\models\costfit\ProductPost::STATUS_DRAFT;
            } else {
                $model->status = \common\models\costfit\ProductPost::STATUS_PUBLIC;
            }
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->save(FALSE);

            return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productPostId=' . Yii::$app->db->lastInsertID . '&productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
            //return $this->redirect(Yii::$app->homeUrl . 'products/' . $params['productSupplierId']);
        } else {
            //return $this->redirect(Yii::$app->homeUrl . 'reviews/see-review?productSupplierId=' . $productSupplierId . '&productId=' . $productId . '');
        }

        return $this->render('@app/views/reviews/create', compact("model", "productSupplierId", "productId"));
    }

    public function actionSeeReview() {
        //echo Yii::$app->controller->action->id;
        $this->title = 'Cozxy.com | See Review';
        $this->subTitle = 'ชื่อ content';

        $productId = $_GET['productId'];
        $productSupplierId = $_GET['productSupplierId'];
        $productPostId = $_GET['productPostId'];
        $getPrductsSupplirs = Suppliers::GetProductSuppliersHelpers($productSupplierId);
        $supplierPrice = ProductSuppliers::productPriceSupplier($productSupplierId);
        $productPost = \common\models\costfit\ProductPost::find()->where('productSuppId =' . $productSupplierId . " AND status =1")->orderBy((!Yii::$app->user->isGuest) ? '(CASE WHEN userId = ' . Yii::$app->user->id . ' THEN 1 ELSE 2 END)' : "productPostId DESC");
        $productPost = new \yii\data\ActiveDataProvider([
            'query' => $productPost,
            'pagination' => array('pageSize' => 10),
        ]);
        //$productPost = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)->all();
        $productPostId = Yii::$app->request->get('productPostId');

        /*
         * Product Views - Frontend
         */
        $productViews = new \common\models\costfit\ProductPageViews();
        $productViews->productSuppId = $productSupplierId;
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : '0';
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);
        //echo '<pre>';
        //print_r($getPrductsSupplirs);
        //exit();
        $model = \common\models\costfit\Product::find()->where("productId =" . $productId)->one();

        $this->title = 'Cozxy.com | Products';
        $this->subTitle = $model->attributes['title'];
        $this->subSubTitle = '';

        return $this->render('@app/views/reviews/see', compact("productPostId", "productPost", "model", "getPrductsSupplirs", "productSupplierId", "supplierPrice"));
    }

    public function actionViewsPosts() {
        //productPostId: productPostId, productSuppId: productSuppId, productId: productId
        $productPostId = Yii::$app->request->post('productPostId');
        $productSuppId = Yii::$app->request->post('productSuppId');
        $productId = Yii::$app->request->post('productId');
        $txt = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId . ' and productSuppId=' . $productSuppId)->one();
        //echo '<pre>';
        //print_r($txt['attributes']);
        //exit();
        return \yii\helpers\Json::encode($txt['attributes']);
        //echo 'test';
    }

    public function actionSeeRating() {
        $productId = $_GET['productId'];
        $productSupplierId = $_GET['productSupplierId'];
        $productPostId = $_GET['productPostId'];

        $model = \common\models\costfit\Product::find()->where("productId =" . $productId)->one();
        $modelSupp = \common\models\costfit\ProductSuppliers::find()->where("productSuppId =" . $productSupplierId)->one();
        $modelSuppPrice = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId =" . $productSupplierId)
        ->where('status =1')
        ->orderBy('productPriceId desc')->limit(1)
        ->one();
        $this->title = 'Cozxy.com | Products';
        $this->subTitle = $model->attributes['title'];
        $this->subSubTitle = '';

        $productPost = \common\models\costfit\ProductPost::find()->where('productPostId =' . $productPostId . ' and product_post.status =1')->one();
        //$productPost = \common\models\costfit\ProductPost::find()->where('productPostId=' . $productPostId)->all();

        if (\Yii::$app->user->id != '') {
            $productPostViewMem = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id . '  and productPostId = ' . $productPostId . ' and productSuppId=' . $productSupplierId . ' and product_post.status =1')->limit(6)->all();
            //$productPostViewMem = \common\models\costfit\ProductPostRating::find()->where('productPostId=' . $productPostId)->all();
        } else {
            $productPostView = NULL;
            $productPostViewMem = NULL;
        }
        /*
         * Product Views - Frontend
         */
        $productViews = new \common\models\costfit\ProductPostView();
        $productViews->productPostId = $productPostId;
        $productViews->userId = isset(Yii::$app->user->identity->userId) ? Yii::$app->user->identity->userId : NULL;
        $cookies = Yii::$app->request->cookies;
        if (isset($cookies['orderToken'])) {
            $productViews->token = $cookies['orderToken']->value;
        } else {
            $productViews->token = NULL;
        }
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);
        //echo '<pre>';
        //print_r($getPrductsSupplirs);
        //exit();

        return $this->render('@app/views/reviews/rating', compact("modelSuppPrice", "modelSupp", "productPostId", "productPostViewMem", "productPost", "model", "productSupplierId"));
    }

    public function actionSeeMore() {
        $productPost = new \yii\data\ActiveDataProvider([
            'query' => \common\models\costfit\ProductPost::find()->where("status = 1")->orderBy((!Yii::$app->user->isGuest) ? '(CASE WHEN userId = ' . Yii::$app->user->id . ' THEN 1 ELSE 2 END)' : "productPostId DESC")
        ]);
        //$this->title = 'Cozxy.com | Products';
        //$this->subTitle = $model->attributes['title'];
        //$this->subSubTitle = '';

        return $this->render('@app/views/reviews/see-all', compact("productPost"));
    }

}
