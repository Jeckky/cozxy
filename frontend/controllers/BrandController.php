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
 * Brand controller
 */
class BrandController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($title, $hash) {
        //throw new \yii\base\Exception($title);
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
        //throw new \yii\base\Exception(print_r($params, true));
        $this->view->params['brandId'] = $params['brandId'];
        $this->view->params['title'] = $title;
        $this->layout = "/content";
        $this->title = 'Cozxy.com | search';
        $this->subTitle = 'search';
        //echo 'Search Brand :' . $params['brandId'];
        //throw new \yii\base\Exception(print_r($_POST, true));
        $whereArray = [];
        $whereArray["ps.brandId"] = $params['brandId'];

        $whereArray["product.approve"] = "approve";
        //        $whereArray["ps.results"] = "> 0";
        $whereArray["pps.status"] = "1";

        if (isset($_GET['search'])) {
            $whereArray["ps.title"] = "%" . $_GET['search'] . "%";
        }

        $products = \common\models\costfit\CategoryToProduct::find()
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->where($whereArray)
        ->andWhere([">", "ps.result", 0])
        ->orderBy("pps.price ASC");
        if (isset($_POST["min"])) {
            $products->andWhere("pps.price >=" . $_POST["min"]);
        }
        if (isset($_POST["max"])) {
            $products->andWhere("pps.price <=" . $_POST["max"]);
        }



        $whereArray2 = [];
        $whereArray2["ps.brandId"] = $params['brandId'];

        $whereArray2["product.approve"] = "approve";
        $whereArray2["ps.result"] = "0";
        $whereArray2["pps.status"] = "1";

        $NotSell = \common\models\costfit\CategoryToProduct::find()
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->where($whereArray2);

        if (isset($params['brandId'])) {
            $idString = $params['brandId'];
            $this->view->params['brandId'] = explode(",", $idString);
            $products->andWhere("product.brandId in ($idString)");
            $NotSell->andWhere("product.brandId in ($idString)");
        }

        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
            'pagination' => array('pageSize' => 8),
        ]);
        $productNotSell = new \yii\data\ActiveDataProvider([
            'query' => $NotSell, 'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('search', ['products' => $products, 'productNotSell' => $productNotSell, 'categoryIdBrand' => $params['brandId']]);
    }

}
