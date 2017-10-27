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
            $pgov = ProductGroupOptionValue::find()
            ->where("productGroupOptionValueId = $productGroupOptionValueId")
            //->andWhere('value is not null')
            ->one();
            //$productGroupValues[$i]["productGroupTemplateOptionId"] = $pgov->productGroupTemplateOptionId;
            $productGroupValues[$i]["value"] = $pgov->value;
            $productGroupValues[$i]["pGTOId"] = $pgov->productGroupTemplateOptionId;
            $productGroupValues[$i]["id"] = $productGroupOptionValueId;
            $productGroupValuesSp1[$i]["id"] = $productGroupOptionValueId;
            $productGroupValuesSp1[$i]["pGTOId"] = $pgov->productGroupTemplateOptionId;
//            if ($i < count($p)) {
//                $productGroupValues.=",";
//            }
            $i++;
        }
        $andWhereStr = "(";
        $j = 1;
        foreach ($productGroupValues as $k => $op) {
            // $andWhereStr.= "( productGroupTemplateOptionId = " . $op["productGroupTemplateOptionId"] . " AND value='" . $op["value"] . "')";
            //$andWhereStr.= "( productGroupTemplateOptionId = " . $op["pGTOId"] . " AND value='" . $op["value"] . "')";
            if ($j < count($productGroupValues)) {
                //$andWhereStr.=" OR ";
            }
            $j++;
        }
        $andWhereStr.= "( productGroupTemplateOptionId = " . $op["pGTOId"] . " AND value='" . $op["value"] . "')";
        $andWhereStr .= ")";
        /* $prodSupp = \common\models\costfit\ProductSuppliers::find()
          ->join("LEFT JOIN", "product_group_option_value pgov", "pgov.productSuppId = product_suppliers.productSuppId")
          ->join("LEFT JOIN", "product p", "p.productId = product_suppliers.productId")
          ->join("LEFT JOIN", "product pg", "pg.productId = p.parentId")
          ->where("pg.productId = $pgov->productGroupId ")
          ->andWhere($andWhereStr)
          ->groupBy("pgov.productSuppId")
          //->having("count(pgov.productSuppId) =" . count($productGroupValues))
          ->one(); */
        /* $prodSupp = \common\models\costfit\Product::find()
          ->join("LEFT JOIN", "product_group_option_value pgov", "pgov.productId = product.productId")
          //->join("LEFT JOIN", "product p", "p.productId = product.productIdx")
          ->join("LEFT JOIN", "product pg", "pg.productId = product.parentId")
          ->where("pg.productId = $pgov->productGroupId ")
          ->andWhere($andWhereStr)
          ->groupBy("pgov.productSuppId")
          //->having("count(pgov.productSuppId) =" . count($productGroupValues))
          ->one(); */

        $productMaster = ProductGroupOptionValue::find()
        ->join("LEFT JOIN", "product p", "p.productId = product_group_option_value.productId")
        ->join("LEFT JOIN", "product pg", "pg.productId = p.parentId")
        ->where("pg.productId = $pgov->productGroupId AND pg.productId = " . $pgov->product->parentId) //AND pg.productIdc = " . $pgov->product->parentId)
        ->andWhere($andWhereStr)
        ->andWhere("product_group_option_value.value IS NOT NULL")
        ->groupBy("value")
        //->orderBy("product_group_option_value.value IS NOT NULL")
        ->orderBy(['`product_group_option_value`.value' => SORT_DESC])
        //->orderBy($orderBy . $item . $value)
        ->one();


        //$token = $prodSupp->encodeParams(['productId' => $prodSupp->productId, 'productSupplierId' => $prodSupp->productSuppId, "selectedOptions" => $productGroupValues]);
        //echo '<pre>';
        //print_r($productGroupValues);
        //echo '<pre>';
        //print_r($productGroupValuesSp1);
        //exit();
        if ($productMaster->productId != '') {
            $token = $productMaster->encodeParams(['productId' => $productMaster->productId, "selectedOptions" => $productGroupValuesSp1]);
        } else {
            $token = 'no';
        }
        //$token = 'no';
        //echo '<pre>';
        //print_r(\common\models\ModelMaster::decodeParams($token));
        //echo $token;
        //exit();
        $res['token'] = $token;

        echo Json::encode($res);
    }

}
