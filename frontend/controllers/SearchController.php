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
 * Search controller
 */
class SearchController extends MasterController
{

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($title, $hash)
    {
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->layout = "/content_left";
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'ชื่อ search';

        /*
        if (isset($_GET["category"])) {
            $products = \common\models\costfit\Product::find()
            ->join("INNER JOIN", "category_to_product ctp", 'ctp.productId = product.productId')
            ->where("ctp.categoryId=" . $_GET["category"]);
//            ->groupBy("ctp.productId");
        } else {
            $products = \common\models\costfit\Product::find();
        }
        */

        $products = \common\models\costfit\Product::find()
            ->join("INNER JOIN", "category_to_product ctp", 'ctp.productId = product.productId')
            ->where("ctp.categoryId=" . $params['categoryId']);

        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
        ]);

        return $this->render('search', compact('products'));
    }

}
