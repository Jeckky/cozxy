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
class ProductsController extends MasterController
{

    public function behaviors()
    {
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
    public function actionIndex()
    {
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'Shop - filters left 3 cols ';
        $this->subSubTitle = 'Shop - single item v2';
        $model = \common\models\costfit\Product::find()->where("productId =" . $_GET["productId"])->one();
        return $this->render('products', ['model' => $model]);
    }

    public function actionChangeOption()
    {
        $res = [];
        $model = \common\models\costfit\Product::find()->where("productId =" . $_POST["productId"])->one();
        $res["productItem"] = $this->renderPartial('product_catalog_item', ['model' => $model, 'productId' => $_POST["productId"]]);
        $res["productTabs"] = $this->renderPartial('product_tabs_widget', ['model' => $model]);
        $res["productImage"] = $this->renderPartial('_product_image', ['model' => $model]);
        return \yii\helpers\Json::encode($res);
    }

}
