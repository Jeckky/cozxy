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
 * history controller
 */
class TestController extends MasterController {

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        $this->title = 'Cost.fit | test case';
        $this->subTitle = 'test case ';
        $this->subSubTitle = 'test case';
        $searchModel = new \common\models\costfit\Order();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        // http://dixonsatit.github.io/2014/11/30/install-krajee-yii2-grid.html

        return $this->render('test', compact('dataProvider', 'searchModel'));
    }

    public function actionCategories() {
        $categories = \common\models\costfit\Category::find()->all(); // ->andWhere('level<3')
        $list = [];

        foreach ($categories as $category) {
            // if record is root it may have the **null** value (for correct foreign keys)
            // but you can specify this in  **emptyParentAttributeValue** property
            $list[$category->parentId ? $category->parentId : 0][] = $category;
        }

        //echo '<pre>';
        //print_r($list[0]);

        foreach ($list[0] as $category) {
            echo $category->title . '[' . $category->categoryId . '] <br>';
            //echo $list[$category->categoryId];
            //echo '<pre>';
            //print_r($list[$category->categoryId]);

            foreach ($list[$category->categoryId] as $subCategory) {
                echo ' - ' . $subCategory->title;
            }
        }
    }

}
