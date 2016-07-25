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

        $this->title = 'Cost.fit | Search Cost.fit';
        $this->subTitle = 'Home';
        $this->subSubTitle = 'search';

        $sortName = "ASC";
        $sortPrice = "ASC";
        if (isset($_POST['sortName'])) {
            $sortName = $_POST['sortName'];
        }
        if (isset($_POST['sortPrice'])) {
            $sortPrice = $_POST['sortPrice'];
        }
        //$search_hd = $_POST['search_hd'];
        $products = \common\models\costfit\Product::find()
        ->andFilterWhere(['OR',
            ['LIKE', 'product.title', $_POST['search_hd']],
            ['LIKE', 'product.description', $_POST['search_hd']],
            ['LIKE', 'product.specification', $_POST['search_hd']]
        ])
        ->orderBy("title $sortName , price $sortPrice")
        ->all();

        return $this->render('@app/views/search/searchcostfit', compact('products', 'sortName', 'sortPrice'));
    }

}
