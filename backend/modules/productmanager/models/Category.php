<?php

namespace backend\modules\productmanager\models;

use Yii;
use common\helpers\Base64Decode;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use common\models\costfit\Category as CategoryModel;

class Category extends CategoryModel
{

    public static function categoryFilter()
    {
        $res = [];
        $mainCategories = self::mainCategories();

        foreach($mainCategories as $mainCategory) {
            $res[$mainCategory->categoryId] = $mainCategory->title;

            foreach($mainCategory->childs as $subCategory) {
                $res[$subCategory->categoryId] = '----'.$subCategory->title;

                foreach($subCategory->childs as $subSubCategory) {
                    $res[$subSubCategory->categoryId] = '--------'.$subSubCategory->title;
                }
            }
        }

        return $res;
    }

    public static function mainCategories()
    {
        return self::find()
            ->where('level = 1 AND parentId is null')
            ->orderBy('title')
            ->all();
    }

}
