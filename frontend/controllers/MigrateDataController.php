<?php

namespace frontend\controllers;

use common\models\costfit\Brand;
use common\models\costfit\Category;
use common\models\costfit\CleanUrl;
use common\models\costfit\Product;
use Yii;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class MigrateDataController extends \backend\controllers\BackendMasterController
{
    public function actionAllProduct()
    {
        $productModels = Product::find()->all();

        foreach($productModels as $productModel) {
            $title = self::prepareCleanUrl($productModel->title).'-'.self::generateRandomString();
            echo "<div>$title</div>";
        }
    }

    public static function prepareCleanUrl($title)
    {
        $title = strtolower($title);
        $title = preg_replace('/\s+/', ' ', $title);
        $title = str_replace(' ', '-', $title);
        $title = str_replace('.', '-', $title);
        $title = str_replace(',', '-', $title);
        $title = str_replace('/', '-', $title);
        $title = str_replace('+', '-', $title);
        $title = str_replace('(', '', $title);
        $title = str_replace(')', '', $title);
        $title = str_replace('&', '', $title);
        $title = preg_replace('/-+/', '-', $title);

        return trim($title, '-');
    }

    public static function generateRandomString($length = 8)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function actionCreateProductCleanUrl()
    {
        $productModels = Product::find()->all();

        foreach($productModels as $productModel) {
            $isDuplicateCleanUrl = true;

            while($isDuplicateCleanUrl){
                $title = self::prepareCleanUrl($productModel->title).'-'.self::generateRandomString().'.html';
                $cleanUrlModel = CleanUrl::find()->where(['cleanUrl'=>$title])->one();

                if(!isset($cleanUrlModel)) {
                    $isDuplicateCleanUrl = false;
                }
            }

            $newCleanUrlModel = new CleanUrl();
            $newCleanUrlModel->productId = $productModel->productId;
            $newCleanUrlModel->cleanUrl = $title;

            if($newCleanUrlModel->save()) {
                echo "<div>$title</div>";
            } else {
                echo 'Error : '.print_r($newCleanUrlModel->errors, true);
            }

        }
    }

    public function actionCreateCategoryCleanUrl()
    {
        $categoryModels = Category::find()->all();

        foreach($categoryModels as $categoryModel) {
            $isDuplicateCleanUrl = true;

            while($isDuplicateCleanUrl){
                $title = self::prepareCleanUrl($categoryModel->title).'-'.self::generateRandomString().'.html';
                $cleanUrlModel = CleanUrl::find()->where(['cleanUrl'=>$title])->one();

                if(!isset($cleanUrlModel)) {
                    $isDuplicateCleanUrl = false;
                }
            }

            $newCleanUrlModel = new CleanUrl();
            $newCleanUrlModel->cleanUrl = $title;
            $newCleanUrlModel->categoryId = $categoryModel->categoryId;

            if($newCleanUrlModel->save()) {
                echo "<div>$title</div>";
            } else {
                echo 'Error : '.print_r($newCleanUrlModel->errors, true);
            }

        }
    }



    public function actionCreateBrandCleanUrl()
    {
        $brandModels = Brand::find()->all();

        foreach($brandModels as $brandModel) {
            $isDuplicateCleanUrl = true;

            while($isDuplicateCleanUrl){
                $title = self::prepareCleanUrl($brandModel->title).'-'.self::generateRandomString().'.html';
                $cleanUrlModel = CleanUrl::find()->where(['cleanUrl'=>$title])->one();

                if(!isset($cleanUrlModel)) {
                    $isDuplicateCleanUrl = false;
                }
            }

            $newCleanUrlModel = new CleanUrl();
            $newCleanUrlModel->cleanUrl = $title;
            $newCleanUrlModel->brandId = $brandModel->brandId;

            if($newCleanUrlModel->save()) {
                echo "<div>$title</div>";
            } else {
                echo 'Error : '.print_r($newCleanUrlModel->errors, true);
            }

        }
    }
}
