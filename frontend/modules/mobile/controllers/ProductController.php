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
//        print_r($params);exit();

        $ctps = CategoryToProduct::find()->select("* ,ps.productSuppId as productSupplierId")
        ->join("LEFT JOIN", 'product p', "category_to_product.productId = p.productId")
        ->join("LEFT JOIN", 'product_suppliers ps', "ps.productId = p.productId")
        ->where(['category_to_product.categoryId' => $params['categoryId']])
        ->andWhere("ps.productId in (SELECT productId FROM product_suppliers ps
                                    LEFT JOIN product_price_suppliers pps ON pps.productSuppId = ps.productSuppId
                                         WHERE ps.approve='approve'
                                         and ps.status=1
                                         and ps.result>0
                                         ORDER BY pps.price ASC
                                    )"
        )
        ->orderBy('p.title')
        ->all();


        $ps = [];

        $i = 0;
        foreach ($ctps as $ctp) {


            $pso = \common\models\costfit\ProductSuppliers::find()
            ->where("productId = $ctp->productId AND productSuppId = $ctp->productSupplierId")->one();
            if (!isset($pso))
                continue;

//            $res['productId'] = $pso->productId;
//            $res['productSupplierId'] = $pso->productSuppId;

	        $res[$i]['productId'] = $pso->productId;
	        $res[$i]['productSupplierId'] = $pso->productSuppId;

	        $ps[$i]['title'] = $pso->title;
            $ps[$i]['isbn'] = $pso->isbn;
            $ps[$i]['code'] = $pso->code;
//            $ps[$i]['shortDescription'] = $pso->shortDescription;

            $sd = strip_tags($pso->shortDescription);
            $sd = mb_substr($sd, 0, 60).'...';
	        $ps[$i]['shortDescription'] = $sd;

            $ps[$i]['description'] = $pso->description;
            $ps[$i]['specification'] = $pso->specification;
            $ps[$i]['width'] = $pso->width;
            $ps[$i]['height'] = $pso->height;
            $ps[$i]['depth'] = $pso->depth;
            $ps[$i]['weight'] = $pso->weight;
            $ps[$i]['price'] = \common\models\costfit\ProductSuppliers::productPrice($pso->productSuppId);
            $ps[$i]['brand'] = isset($pso->brand) ? $pso->brand->title : NULL;
	        $ps[$i]['sale_price'] = false;
	        $ps[$i]['on_wish_list'] = false;

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
            	$ps[$i]['thumb'] = $pi->imageThumbnail1;
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
/*
        $params = ModelMaster::decodeParams($hash);
//	    $params["isbn"] = $_GET["isbn"];
        $isbn = $params["isbn"];
        if (isset($params["productId"])) {
            $productId = $params["productId"];
            $p = \common\models\costfit\ProductSuppliers::find()->select("* , pps.price")
            ->join("LEFT JOIN", 'product_price_suppliers pps', "pps.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.isbn = '$isbn' AND product_suppliers.approve='approve' and product_suppliers.status=1 AND product_suppliers.result>0")
            ->orderBy("pps.price ASC")
            ->one();
        } else {
            $res["error"] = "Not Use ProductId";
        }

        if (isset($params["isbn"])) {
            $isbn = $params["isbn"];
            $p = \common\models\costfit\ProductSuppliers::find()->select("* , pps.price")
            ->join("LEFT JOIN", 'product_price_suppliers pps', "pps.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.isbn = '$isbn' AND product_suppliers.approve='approve' and product_suppliers.status=1 AND product_suppliers.result>0")
            ->orderBy("pps.price ASC")
            ->one();
        } else {
            $res["error"] = "Not Use isbn";
        }
	    */
		$isbn = $hash;

	    $p = \common\models\costfit\ProductSuppliers::find()->select("* , pps.price")
		    ->join("LEFT JOIN", 'product_price_suppliers pps', "pps.productSuppId = product_suppliers.productSuppId")
		    ->where("product_suppliers.isbn = '$isbn' AND product_suppliers.approve='approve' and product_suppliers.status=1 AND product_suppliers.result>0")
		    ->orderBy("pps.price ASC")
		    ->one();

        if (isset($p)) {

            $res['productId'] = $p->productId;
            $res['productSupplierId'] = $p->productSuppId;
            $res['title'] = $p->title;
            $res['isbn'] = $p->isbn;
            $res['code'] = $p->code;
//            $res['shortDescription'] = $p->shortDescription;

	        $sd = strip_tags($p->shortDescription);
	        $sd = mb_substr($sd, 0, 60).'...';
	        $res['shortDescription'] = $sd;

            $res['description'] = $p->description;
            $res['specification'] = $p->specification;
            $res['width'] = $p->width;
            $res['height'] = $p->height;
            $res['depth'] = $p->depth;
            $res['weight'] = $p->weight;
            $res['price'] = $p->price;
            $res['brand'] = isset($p->brand) ? $p->brand->title : NULL;
	        $res['sale_price'] = false;
	        $res['on_wish_list'] = false;


            $j = 0;
            $pis = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = $p->productSuppId")->all();
            foreach ($pis as $pi) {
                $res['images'][$j] = [
                    'url' => $pi->image,
                    'urlTn1' => $pi->imageThumbnail1,
                    'urlTn2' => $pi->imageThumbnail2,
                ];
                $j++;
            }
        } else {
            $res["error"] = "Not Found Product";
        }
        print_r(Json::encode($res));
    }

}
