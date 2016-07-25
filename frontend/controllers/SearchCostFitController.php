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
        //$search_hd = $_POST['search_hd'];
        $sub1 = \common\models\costfit\Product::find()->orFilterWhere(['LIKE', 'product.title', $_POST['search_hd']]);
        $sub2 = \common\models\costfit\Product::find()->orFilterWhere(['LIKE', 'product.description', $_POST['search_hd']]);
        $sub3 = \common\models\costfit\Product::find()->orFilterWhere(['LIKE', 'product.specification', $_POST['search_hd']]);

        $products = \common\models\costfit\Product::find()->andFilterWhere(['OR', ['LIKE', 'product.title', $_POST['search_hd']], ['LIKE', 'product.description', $_POST['search_hd']]], ['LIKE', 'product.specification', $_POST['search_hd']])->all();

        return $this->render('@app/views/search/searchcostfit', compact('products'));
    }

}
