<?php

namespace frontend\modules\mobile\controllers;

use common\models\costfit\Category;
use common\models\costfit\CategoryToProduct;
use common\models\ModelMaster;
use yii\base\Model;
use yii\helpers\Json;

class ProductController extends \common\controllers\MasterController
{

    public function actionIndex($hash) // Return Product List In Category
    {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        $params = ModelMaster::decodeParams($hash);

        $params['categoryId'] = $_GET["categoryId"];

        $ctps = CategoryToProduct::find()->select("* ,ps.productSuppId as productSupplierId")
        ->join("LEFT JOIN", 'product p', "category_to_product.productId = p.productId")
        ->join("LEFT JOIN", 'product_suppliers ps', "ps.productId = p.productId")
        ->where(['category_to_product.categoryId' => $params['categoryId']])
        ->andWhere("ps.productId in (SELECT productId FROM product_suppliers WHERE product_suppliers.approve='approve' and product_suppliers.status=1 and product_suppliers.quantity>0 ORDER BY price DESC)")
        ->orderBy('p.title')
        ->all();


        $ps = [];

        $i = 0;
        foreach ($ctps as $ctp) {


            $pso = \common\models\costfit\ProductSuppliers::find()->where("productId = $ctp->productId AND productSuppId = $ctp->productSupplierId")->one();
//            throw new \yii\base\Exception(print_r($ps->attributes, true));
            if (!isset($pso))
                continue;

            $ps[$i]['title'] = $pso->title;
            $ps[$i]['isbn'] = $pso->isbn;
            $ps[$i]['code'] = $pso->code;
            $ps[$i]['shortDescription'] = $pso->shortDescription;
            $ps[$i]['description'] = $pso->description;
            $ps[$i]['specification'] = $pso->specification;
            $ps[$i]['width'] = $pso->width;
            $ps[$i]['height'] = $pso->height;
            $ps[$i]['depth'] = $pso->depth;
            $ps[$i]['weight'] = $pso->weight;
            $ps[$i]['price'] = $pso->price;
            $ps[$i]['brand'] = isset($pso->brand) ? $pso->brand->title : NULL;

            $hash = [
                'categoryId' => $pso->categoryId,
                'productId' => $pso->productId,
                'brandId' => $pso->brandId,
            ];

            $ps[$i]['hash'] = ModelMaster::encodeParams($hash);

            //product images
            $j = 0;
            $pis = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = $ctp->productSupplierId")->all();
            foreach ($pis as $pi) {
                $ps[$i]['images'][$j] = [
                    'url' => $pi->image,
                    'urlTn1' => $pi->imageThumbnail1,
                    'urlTn2' => $pi->imageThumbnail2,
                ];
                $j++;
            }

            $i++;
        }

        print_r(Json::encode($ps));
    }

    public function actionTest()
    {
        throw new \yii\base\Exception("Test Function");
    }

    public function actionFindProduct($hash) // With ProductId Or ISBN (Barcode)
    {
        $res = [];
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        $params = ModelMaster::decodeParams($hash);
        $params["isbn"] = $_GET["isbn"];
        if (isset($params["productId"])) {
            $productId = $params["productId"];
            $p = \common\models\costfit\ProductSuppliers::find()->where("productId = $productId AND approve='approve' and status=1 and quantity>0 ORDER BY price DESC")->one();
        } else {
            $res["error"] = "Not Found From ProductId";
        }

        if (isset($params["isbn"])) {
            $isbn = $params["isbn"];
            $p = \common\models\costfit\ProductSuppliers::find()->where("isbn = '$isbn' AND approve='approve' and status=1 quantity>0 ORDER BY price DESC")->one();
        } else {
            $res["error"] = "Not Found From isbn";
        }


        $res['title'] = $p->title;
        $res['isbn'] = $p->isbn;
        $res['code'] = $p->code;
        $res['shortDescription'] = $p->shortDescription;
        $res['description'] = $p->description;
        $res['specification'] = $p->specification;
        $res['width'] = $p->width;
        $res['height'] = $p->height;
        $res['depth'] = $p->depth;
        $res['weight'] = $p->weight;
        $res['price'] = $p->price;
        $res['brand'] = isset($p->brand) ? $p->brand->title : NULL;


        $j = 0;
        $pis = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = $ctp->productSupplierId")->all();
        foreach ($pis as $pi) {
            $res['images'][$j] = [
                'url' => $pi->image,
                'urlTn1' => $pi->imageThumbnail1,
                'urlTn2' => $pi->imageThumbnail2,
            ];
            $j++;
        }
        print_r(Json::encode($res));
    }

}
