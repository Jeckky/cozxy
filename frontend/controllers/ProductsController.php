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
use common\models\costfit\ProductSuppliers;
use common\helpers\CozxyUnity;
use common\helpers\Suppliers;

/**
 * Products controller
 */
class ProductsController extends MasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update'],
                'rules' => [
// deny all POST requests
                    [
                        'allow' => false,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($hash) {
        //throw new \yii\base\Exception('aaa');
        //return Yii::$app->getResponse()->redirect('register/login');
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);
        $term = \common\models\costfit\ContentGroup::find()->where("lower(title)='term'")->one();
        $terms = '';
        if (isset($term)) {
            $terms = \common\models\costfit\Content::find()->where("contentGroupId=" . $term->contentGroupId)->one();
        }
        $productId = $params['productId'];
        $productSupplierId = $params['productSupplierId'];
        /*
         * Product Views - Frontend
         */
        $productViews = new \common\models\costfit\ProductPageViews();
        $productViews->productSuppId = $productSupplierId;
        $productViews->userId = Yii::$app->user->identity->userId;
        $productViews->updateDateTime = new \yii\db\Expression('NOW()');
        $productViews->createDateTime = new \yii\db\Expression('NOW()');
        $productViews->save(FALSE);
        /*
         * Get Product Suppliers
         * create date : 14/01/2017
         * create by : taninut.bm
         */
        $getPrductsSupplirs = Suppliers::GetProductSuppliersHelpers($productSupplierId);
        $price = ProductSuppliers::productPriceSupplier($productSupplierId);

        if ($productId != '') {
            $model = \common\models\costfit\Product::find()->where("productId =" . $productId)->one();
            $productPostView = \common\models\costfit\ProductPost::find()->groupBy(['productSuppId'])->orderBy('productPostId desc')->limit(6)->all();
            if (\Yii::$app->user->id != '') {
                $productPostViewMem = \common\models\costfit\ProductPost::find()->where('userId=' . Yii::$app->user->id)->orderBy('productPostId desc')->limit(6)->all();
            } else {
                $productPostView = NULL;
                $productPostViewMem = NULL;
            }

            //echo '<pre>';
            //print_r($productPostView);
            //exit();
            if (count($model) > 0) {
                $this->title = 'Cozxy.com | Products';
                $this->subTitle = $model->attributes['title'];
                $this->subSubTitle = '';
                return $this->render('products_all', ['model' => $model, 'term' => $terms, 'productSupplierId' => $productSupplierId, ''
                    . 'getPrductsSupplirs' => $getPrductsSupplirs, 'supplierPrice' => $price, 'productPost' => $productPostView, 'productPostViewMem' => $productPostViewMem]);
            } else {
                return $this->render('@app/views/error/error');
            }
        } else {
            return $this->render('@app/views/error/error');
        }
    }

    public function actionChangeOption() {
        $productId = Yii::$app->request->post('productId');
        $model = \common\models\costfit\Product::find()->where("productId = " . $productId)->one();
        $res = [];
        $res["productId"] = $model->productId;
        $res["productName"] = $model->title;
        $res['oldPrice'] = number_format($model->price, 2) . " ฿";
        $res["price"] = number_format($model->calProductPrice($model->productId, 1), 2) . " ฿";
        $res["productItem"] = $this->renderPartial('product_catalog_item', ['model' => $model, 'productId' => $_POST["productId"], 'type' => 'ajax']);
        $res["productTabs"] = $this->renderPartial('product_tabs_widget', ['model' => $model]);
        $res["productPriceTable"] = $this->renderPartial('_product_price_table', ['model' => $model]);
        $res["productImage"] = $this->renderPartial('_product_image_loadding', ['model' => $model]);
        //echo count($model->productImages);
        foreach ($model->productImages as $image) {
            //$xx = '<div class = "ms-slide-bgcont" style = "height: 100%; opacity: 1;"><img src = "/Cozxy.com-frontend//images/ProductImage/6FegsyR3cy.png" alt = "e" style = "height: 484px; width: 618.444px; margin-top: 0px; margin-left: -34px;"></div>';
            $productImagex[] = '<img src = "' . Yii::$app->homeUrl . $image->image . '" data-src = "' . Yii::$app->homeUrl . $image->image . '" alt = "' . $image->title . '"/>'
            ;
        }
        foreach ($model->productImages as $image) {
            $productImagexx[] = '<img class = "ms-thumb" src = "' . Yii::$app->homeUrl . $image->imageThumbnail2 . '" data-src = "' . Yii::$app->homeUrl . $image->imageThumbnail2 . '" alt = "' . $image->title . '"/>'
            ;
        }
        $res["image"] = $productImagex;
        $res["imageThumbnail2"] = $productImagexx;
        return \yii\helpers\Json::encode($res);
    }

    public function actionGetProductShippingPrice() {
        $productId = Yii::$app->request->post('productId');
        $fastId = Yii::$app->request->post('fastId');
        $minDate = 99;
        $findMinDates = \common\models\costfit\ProductShippingPrice::find()->where("productId =" . $productId . " and shippingTypeId!=" . $fastId)->all();
        if (isset($findMinDates) && !empty($findMinDates)) {
            foreach ($findMinDates as $findMinDate) {
                $model = \common\models\costfit\ShippingType::find()->where("shippingTypeId=" . $findMinDate->shippingTypeId)->one();
                if (isset($model)) {
                    if ($model->date < $minDate) {
                        $minDate = $model->shippingTypeId;
                    }
                }
            }
        } else {
            $minDate = $fastId;
        }
        echo $minDate;
    }

    public function actionGetDefultProductShippingPrice() {
        $productId = Yii::$app->request->post('productId');
        $default = \common\models\costfit\Product::getShippingTypeId($productId);
        echo $default;
    }

}
