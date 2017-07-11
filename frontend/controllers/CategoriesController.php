<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
use yii\data\ArrayDataProvider;

/**
 * Description of CategoriesController
 *
 * @author it
 */
class CategoriesController extends MasterController {

    //put your code here
    public static function actionTree() {
        $status = false;
        $message = '';
        $data = (object) [];
        $model = \common\models\costfit\Category::find()->where('parentId IS  NULL')->asArray()->orderBy([
            'parentId' => SORT_ASC //Need this line to be fixed
        ])->all();
        $cattree = self::CreateTree($model);
        // echo '<pre>';
        //print_r($cattree);
        return $cattree;
        die;
        if ($model) {
            return ['status' => true, 'message' => 'All Child Categories Listing',
                'data' => $model];
        } else {
            return ['status' => false, 'message' => 'Child Categories not found',
                'data' => $data];
        }
    }

    public static function actionTreeSub() {
        $status = false;
        $message = '';
        $data = (object) [];
        $model = \common\models\costfit\Category::find()->where('status = 1')->asArray()->orderBy([
            'parentId' => SORT_ASC //Need this line to be fixed
        ])->all();
        /* $model = \common\models\costfit\ProductSuppliers::find()
          ->select('`product_suppliers`.categoryId , `category`.`parentId`, `category`.title ,product_suppliers.productSuppId,product_suppliers.productId')
          ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
          ->where("`product_suppliers`.approve = 'approve' and `category`.status = 1")
          ->groupBy('`product_suppliers`.categoryId')
          ->asArray()->orderBy([
          '`category`.`parentId`' => SORT_ASC //Need this line to be fixed
          ])->all(); */
        $cattree = self::CreateTree($model);
        // echo '<pre>';
        //print_r($cattree);
        return $cattree;
        die;
        if ($model) {
            return ['status' => true, 'message' => 'All Child Categories Listing',
                'data' => $model];
        } else {
            return ['status' => false, 'message' => 'Child Categories not found',
                'data' => $data];
        }
    }

    public static function CreateTree($tree, $parentId = 0) {
        $branch = [];
        foreach ($tree as $element) {
            if ($element['parentId'] == $parentId) {
                $children = self::CreateTree($tree, $element['categoryId']);
                if ($children) {
                    $element['Children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

}
