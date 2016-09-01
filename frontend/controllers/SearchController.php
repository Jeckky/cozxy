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
class SearchController extends MasterController {

    public $enableCsrfValidation = false;

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
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->layout = "/content_left";
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'ชื่อ search';
//        throw new \yii\base\Exception(print_r($_POST, true));
        $whereArray = [];
        $whereArray["category_to_product.categoryId"] = $params['categoryId'];
        $whereArray["product_price.quantity"] = 1;

        $products = \common\models\costfit\CategoryToProduct::find()
                ->join("LEFT JOIN", "product_price", "product_price.productId = category_to_product.productId")
                ->where($whereArray);

        if (isset($_POST["min"])) {
            $products->andWhere("product_price.price >=" . $_POST["min"]);
        }
        if (isset($_POST["max"])) {
            $products->andWhere("product_price.price <=" . $_POST["max"]);
        }

        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
        ]);


        return $this->render('search', ['products' => $products]);
    }

    public function actionPop($category) {
        //throw new \yii\base\Exception($category);
        $this->layout = "/content_left";
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'ชื่อ search';
        $allCategory = \common\models\costfit\Category::find()->where("parentId='" . $category . "'")->all();
        $categoryId = $category;
        if (isset($allCategory) && !empty($allCategory)) {
            $categoryId = "";
            foreach ($allCategory as $allId):
                $categoryId.=$allId->categoryId . ",";
            endforeach;
            $categoryId = substr($categoryId, 0, -1);
        }

        //throw new \yii\base\Exception($categoryId);
        $products = \common\models\costfit\Product::find()
                ->join("INNER JOIN", "category_to_product ctp", 'ctp.productId = product.productId')
                ->where("ctp.categoryId in($categoryId)");

        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
        ]);

        return $this->render('search', compact('products'));
    }

    public function actionSearchBrands() {
        $this->layout = "/content_left";
        $this->title = 'Cost.fit | Products';
        $this->subTitle = 'ชื่อ search';
        $categoryId = $_POST['categoryId'];
//        throw new \yii\base\Exception(print_r($_POST['brandId'], true));
        // $allBrand = "";

        $idString = implode(",", $_POST['brandId']);

        $whereArray = [];
        $whereArray["category_to_product.categoryId"] = $categoryId;
        $whereArray["product_price.quantity"] = 1;
        $whereArray["product.brandId"] = "in ($idString)";

        $products = \common\models\costfit\CategoryToProduct::find()
                ->join("LEFT JOIN", "product_price", "product_price.productId = category_to_product.productId")
                ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
                ->where($whereArray);

        //throw new \yii\base\Exception(count($products));
        //$products = \common\models\costfit\Product::find()->where("categoryId=" . $categoryId . " and brandId in(" . $idString . ")")->all();

        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
        ]);
        //throw new \yii\base\Exception($products->getCount());
        return $this->render('search', ['products' => $products]);

        //  return $this->renderPartial('search', ['products' => $products]);
        //echo $idString;
    }

}
