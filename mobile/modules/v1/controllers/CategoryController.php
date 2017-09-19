<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\Category;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CategoryController extends \common\controllers\MasterController
{
    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                                'only' => ['index'],
                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
[
    'actions' => ['index'],
    'allow' => true,
    'roles' => ['?'],
],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'index' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}

        $categories = [];
        $cats = Category::mainCategories();

        $i = 0;
        foreach($cats as $cat) {
            $categories[$i]['name'] = $cat->parent->title;
//			$categories[$i]['id'] = Category::encodeParams(['categoryId'=>$cat->categoryId]);
//			$categories[$i]['url'] = Category::encodeParams(['categoryId'=>$cat->categoryId]);
            $categories[$i]['categoryId'] = $cat->parent->categoryId;

            if($cat->parent->childs !== []) {
                $categories[$i]['items'] = [];
                //first child
                $j = 0;
                foreach($cat->parent->subCategories() as $subCat) {
                    $categories[$i]['items'][$j]['name'] = $subCat->title;
//					$categories[$i]['items'][$j]['id'] = Category::encodeParams(['categoryId'=>$subCat->categoryId]);
//					$categories[$i]['items'][$j]['url'] = Category::encodeParams(['categoryId'=>$subCat->categoryId]);
                    $categories[$i]['items'][$j]['categoryId'] = $subCat->categoryId;

                    if($subCat->subCategories() !== []) {
                        $categories[$i]['items'][$j]['items'] = [];
                        $k = 0;
                        foreach($subCat->subCategories() as $subCat2) {
                            $categories[$i]['items'][$j]['items'][$k]['name'] = $subCat2->title;
//							$categories[$i]['items'][$j]['items'][$k]['id'] = Category::encodeParams(['categoryId'=>$subCat2->categoryId]);
//							$categories[$i]['items'][$j]['items'][$k]['url'] = Category::encodeParams(['categoryId'=>$subCat2->categoryId]);
                            $categories[$i]['items'][$j]['items'][$k]['categoryId'] = $subCat2->categoryId;

                            $k++;
                        }
                    }
                    $j++;
                }
            }

            $i++;
        }
//        $this->writeToFile('/tmp/categories', print_r($categories, true));
        header('Content-type: text/json');
        echo Json::encode($categories);
    }

}
