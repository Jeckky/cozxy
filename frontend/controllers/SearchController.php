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

}
