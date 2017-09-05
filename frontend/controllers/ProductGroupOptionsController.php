<?php

namespace frontend\controllers;

use common\models\costfit\ProductGroupOptionValue;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use frontend\models\FakeFactory;
use frontend\models\DisplayMyStory;

class ProductGroupOptionsController extends MasterController {

    public function actionIndex($hash = FALSE) {

    }

    public function actionProductByOptions($hash = false) {
        $p = $_POST;
        $productGroupValues = [];
        $i = 1;
        $pgov = NULL;
        foreach ($p as $title => $productGroupOptionValueId) {
            $pgov = ProductGroupOptionValue::find()->where("productGroupOptionValueId = $productGroupOptionValueId")->one();
            $productGroupValues[$i]["productGroupTemplateOptionId"] = $pgov->productGroupTemplateOptionId;
            $productGroupValues[$i]["value"] = $pgov->value;
            $productGroupValues[$i]["id"] = $productGroupOptionValueId;

//            if ($i < count($p)) {
//                $productGroupValues.=",";
//            }
            $i++;
        }
        $andWhereStr = "(";
        $j = 1;
        foreach ($productGroupValues as $k => $op) {
            $andWhereStr.= "( productGroupTemplateOptionId = " . $op["productGroupTemplateOptionId"] . " AND value='" . $op["value"] . "')";
            if ($j < count($productGroupValues)) {
                $andWhereStr.=" OR ";
            }
            $j++;
        }
        $andWhereStr .= ")";
        $prodSupp = \common\models\costfit\ProductSuppliers::find()
        ->join("LEFT JOIN", "product_group_option_value pgov", "pgov.productSuppId = product_suppliers.productSuppId")
        ->join("LEFT JOIN", "product p", "p.productId = product_suppliers.productId")
        ->join("LEFT JOIN", "product pg", "pg.productId = p.parentId")
        ->where("pg.productId = $pgov->productGroupId ")
        ->andWhere($andWhereStr)
        ->groupBy("pgov.productSuppId")
        ->having("count(pgov.productSuppId) =" . count($productGroupValues))
        ->one();



        //$token = $prodSupp->encodeParams(['productId' => $prodSupp->productId, 'productSupplierId' => $prodSupp->productSuppId, "selectedOptions" => $productGroupValues]);

        $token = \common\models\ModelMaster::encodeParams(['productId' => $prodSupp->productId, 'productSupplierId' => $prodSupp->productSuppId, "selectedOptions" => $productGroupValues]);

        $res['token'] = $token;

        echo Json::encode($res);
    }

}
