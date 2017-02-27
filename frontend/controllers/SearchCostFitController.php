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
class SearchCostFitController extends MasterController {

    public $enableCsrfValidation = false;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cozxy.com | Search Cozxy.com';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'search';

        $sortName = "ASC";
        $sortPrice = "ASC";

        $request = Yii::$app->request;
        $search_hd = Yii::$app->request->get('search_hd');

        if ($request->isGet) { /* the request method is GET */
            if (isset($_POST['sortName'])) {
                $sortName = $_POST['sortName'];
            } else {
                $sortName = '';
            }
            if (isset($_POST['sortPrice'])) {
                $sortPrice = $_POST['sortPrice'];
            } else {
                $sortName = '';
            }
            if (isset($search_hd)) {
                //$products = \common\models\costfit\Product::find()
                $products = \common\models\costfit\ProductSuppliers::find()
                        ->where("result>0 and status=1 and approve='approve'")
                        ->andFilterWhere(['OR',
                                ['LIKE', 'product_suppliers.title', trim($search_hd)],
                                ['LIKE', 'product_suppliers.description', trim($search_hd)],
                                ['LIKE', 'product_suppliers.specification', trim($search_hd)]
                        ])
                        //->orderBy("title $sortName , price $sortPrice")
                        ->orderBy("title $sortName")
                        ->all();
            } else {
                $products = array();
            }
        }

        if ($request->isPost) { /* the request method is POST */
            //echo '<pre>';
            //print_r($_POST['sortName']);
            if (isset($_POST['sortName'])) {
                $sortName = $_POST['sortName'];
            }
            if (isset($_POST['sortPrice'])) {
                $sortPrice = $_POST['sortPrice'];
            }

            $products = \common\models\costfit\ProductSuppliers::find()
                    ->where("result>0 and status=1 and approve='approve'")
                    ->andFilterWhere(['OR',
                            ['LIKE', 'product_suppliers.title', $_POST['search_hd']],
                            ['LIKE', 'product_suppliers.description', $_POST['search_hd']],
                            ['LIKE', 'product_suppliers.specification', $_POST['search_hd']]
                    ])
                    //->orderBy("title $sortName , price $sortPrice")
                    ->orderBy("title $sortName")
                    ->all();
        }

        // echo '<pre>';
        // print_r($products);
        return $this->render('@app/views/search/searchcostfit', compact('products', 'sortName', 'sortPrice', 'search_hd'));
    }

}
