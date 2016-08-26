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

        //return Yii::$app->getResponse()->redirect('register/login');
        $k = base64_decode(base64_decode($hash));
        $params = \common\models\ModelMaster::decodeParams($hash);

        $productId = $params['productId'];

        if ($productId != '') {
            $model = \common\models\costfit\Product::find()->where("productId =" . $productId)->one();
            if (count($model) > 0) {
                $this->title = 'Cost.fit | Products';
                $this->subTitle = $model->attributes['title'];
                $this->subSubTitle = '';

                return $this->render('products', ['model' => $model]);
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
        $res["productItem"] = $this->renderPartial('product_catalog_item', ['model' => $model, 'productId' => $_POST["productId"]]);
        $res["productTabs"] = $this->renderPartial('product_tabs_widget', ['model' => $model]);
        $res["productPriceTable"] = $this->renderPartial('_product_price_table', ['model' => $model]);
        $res["productImage"] = $this->renderPartial('_product_image', ['model' => $model]);

        //foreach ($model->productImages as $image) {
        // $productImage = '<div class="ms-slide">'
        //  . '<img src="' . Yii::$app->homeUrl . $image->image . '" data-src="' . Yii::$app->homeUrl . $image->image . '" alt="' . $image->title . '"/>'
        // . '</div>';
        // }
        // $res["productImage"] = $productImage;
        return \yii\helpers\Json::encode($res);
    }

    public function actionGetProductShippingPrice() {
        $productId = Yii::$app->request->post('productId');
        $fastId = Yii::$app->request->post('fastId');
        $minDate = 99;
        $findMinDates = \common\models\costfit\ProductShippingPrice::find()->where("productId =" . $productId . " and shippingTypeId!=" . $fastId)->all();
        if (isset($findMinDates)) {
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

    public function actionChangeOptionTest() {
        $res = [];
        $model = \common\models\costfit\Product::find()->where("productId = " . $_POST["productId"])->one();

        $res["productId"] = $model->productId;
        $res["productName"] = $model->title;
        $res['oldPrice'] = number_format($model->price, 2) . " ฿";
        $res["price"] = number_format($model->calProductPrice($model->productId, 1), 2) . " ฿";
        $res["productItem"] = $this->renderPartial('product_catalog_item', ['model' => $model, 'productId' => $_POST["productId"]]);
        $res["productTabs"] = $this->renderPartial('product_tabs_widget', ['model' => $model]);
        $res["productPriceTable"] = $this->renderPartial('_product_price_table', ['model' => $model]);
        $res["productImage"] = $this->renderPartial('_product_image', ['model' => $model]);


        return \yii\helpers\Json::encode($res);
    }

}
