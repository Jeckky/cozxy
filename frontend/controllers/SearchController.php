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
        //throw new \yii\base\Exception($title);
        $k = base64_decode(base64_decode($hash));
        $params = ModelMaster::decodeParams($hash);
//        throw new \yii\base\Exception(print_r($params, true));
        //return Yii::$app->getResponse()->redirect('register/login');
        $this->view->params['categoryId'] = $params['categoryId'];
        $this->view->params['title'] = $title;
        $this->layout = "/content";
        $this->title = 'Cozxy.com | Products';
        $this->subTitle = 'ชื่อ search';
//        throw new \yii\base\Exception(print_r($_POST, true));
        $whereArray = [];
        $whereArray["category_to_product.categoryId"] = $params['categoryId'];

        $whereArray["product.approve"] = "approve";
        //
        //$whereArray["product_price.quantity"] = 1;
        //$whereArray["pps.status"] = 1;
        $products = \common\models\costfit\CategoryToProduct::find()
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        //->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = category_to_product.productId")
        ->where($whereArray);
        //->andWhere("product.approve != 'new'");
        if (isset($_POST["min"])) {
            $products->andWhere("pps.price >=" . $_POST["min"]);
        }
        if (isset($_POST["max"])) {
            $products->andWhere("pps.price <=" . $_POST["max"]);
        }

        if (isset($params['brandId'])) {
            $idString = $params['brandId'];
            $this->view->params['brandId'] = explode(",", $idString);
            $products->andWhere("product.brandId in ($idString)");
        }
        //echo '<pre>';
        //print_r($products);
        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
            'pagination' => array('pageSize' => 8),
        ]);

        $NotSell = \common\models\costfit\ProductSuppliers::find()->where('result = 0 and approve ="approve"  order by productSuppId DESC');
        $productNotSell = new \yii\data\ActiveDataProvider([
            'query' => $NotSell, 'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        return $this->render('search', ['products' => $products, 'productNotSell' => $productNotSell, 'categoryIdBrand' => $params['categoryId']]);
    }

    public function actionPop($category)
    {
        //throw new \yii\base\Exception($category);
        $this->layout = "/content_left";
        $this->title = 'Cozxy.com | Products';
        $this->subTitle = 'ชื่อ search';
        $allCategory = \common\models\costfit\Category::find()->where("parentId='" . $category . "'")->all();
        $categoryId = $category;
        if (isset($allCategory) && !empty($allCategory)) {
            $categoryId = "";
            foreach ($allCategory as $allId):
                $categoryId .= $allId->categoryId . ",";
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

    public function actionSearchBrands()
    {
        $this->layout = "/content_left";
        $this->title = 'Cozxy.com | Products';
        $this->subTitle = 'ชื่อ search';
        $categoryId = $_POST['categoryId'];
        $cat = \common\models\costfit\Category::find()->where("categoryId=" . $categoryId)->one();
        if (isset($_POST['brandId'])) {
            $idString = implode(",", $_POST['brandId']);
        } else {
            $idString = null;
        }

        // echo 'Search Brands';
        //  $items_sub->createTitle()
        //return Yii::$app->response->redirect(Yii::$app->homeUrl . 'register/login');
        //echo $this->redirect(Yii::$app->homeUrl . 'checkout/order-thank');
        return $this->redirect(['search/' . rawurlencode($cat->createTitle()) . "/" . ModelMaster::encodeParams(['categoryId' => $categoryId, 'brandId' => $idString])]);
    }

    public function actionMultiple()
    {
        $security = new Security();
        $randomString = $security->generateRandomString();
        $randomKey = $security->generateRandomKey();
        return $this->render('multiple', [
            'randomString' => $randomString,
            'randomKey' => $randomKey,
        ]);
    }

}
