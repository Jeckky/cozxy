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
 * Search Cost Fit controller
 */
class SearchCostFitController extends MasterController
{

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $this->title = 'Cozxy.com | Search Cozxy.com';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'search';

        $sortName = "ASC";
        $sortPrice = "ASC";
        $search_hd = "";

        $search_hd = Yii::$app->request->get('search_hd');
        if (!isset($search_hd)) {
            if (isset($_POST["search_hd"]))
                $search_hd = $_POST["search_hd"];
        }

//        if (!is_array($search_hd)) {
//            $search_hd = [$search_hd];
//        }
//        $search_hd = implode("|", $search_hd);

        if (isset($_POST['sortName'])) {
            $sort = "product_suppliers.title " . $_POST['sortName'];
        } else {
            $sort = '';
        }
        if (isset($_POST['sortPrice'])) {
            $sort = "product_price_suppliers.price " . $_POST['sortPrice'];
        } else {
            $sort = '';
        }
        //$products = \common\models\costfit\Product::find()
        $products = \common\models\costfit\ProductSuppliers::find()
        ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
        ->where("product_suppliers.status=1 and product_suppliers.approve='approve' ")
        ->andFilterWhere(['OR',
            ['REGEXP', 'product_suppliers.title', trim($search_hd)],
            ['REGEXP', 'product_suppliers.description', trim($search_hd)],
//                    ['LIKE', 'product_suppliers.specification', trim($search_hd)]
        ])
        //->orderBy("title $sortName , price $sortPrice")
        ->orderBy($sort);
        //->all();


        $products = new \yii\data\ActiveDataProvider([
            'query' => $products,
            'pagination' => array('pageSize' => 12),
        ]);


        // echo '<pre>';
        // print_r($products);
        return $this->render('@app/views/search/searchcostfit', compact('products', 'sortName', 'sortPrice', 'search_hd'));
    }

}
