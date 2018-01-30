<?php

namespace mobile\modules\v1\controllers;

use common\models\costfit\Category;
use common\models\costfit\CategoryToProduct;
use common\models\costfit\Product;
use common\models\costfit\ProductPriceSuppliers;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\User;
use common\models\ModelMaster;
use mobile\modules\v1\models\ProductPostComparePrice;
use mobile\modules\v1\models\Wishlist;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class ProductController extends \common\controllers\MasterController
{
    public function beforeAction($action)
    {
//        if ($action->id == 'for-sale' || $action->id=='not-sale' || $action->id=='view') {
        if(in_array($action->id, ['for-sale', 'not-sale', 'view', 'isbn', 'search', 'similar', 'related'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

//    public function actionIndex($hash) // Return Product List In Category
    public function actionForSale() // Return Product List In Category
    {
        if(isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
//        $params = ModelMaster::decodeParams($hash);
//        print_r($params);exit();
        $categoryId = $_POST['categoryId'];

//        $ctps = CategoryToProduct::find()->select("* ,ps.productSuppId as productSupplierId")
//            ->join("LEFT JOIN", 'product p', "category_to_product.productId = p.productId")
//            ->join("LEFT JOIN", 'product_suppliers ps', "ps.productId = p.productId")
////        ->where(['category_to_product.categoryId' => $params['categoryId']])
//            ->where(['category_to_product.categoryId' => $categoryId])
//            ->andWhere("ps.productId in (SELECT productId FROM product_suppliers ps
//                                    LEFT JOIN product_price_suppliers pps ON pps.productSuppId = ps.productSuppId
//                                         WHERE ps.approve='approve'
//                                         and ps.status=1
//                                         and ps.result>0
//                                         ORDER BY pps.price ASC
//                                    )"
//            )
//            ->orderBy('p.title')
//            ->all();

        $products = Product::forSale($categoryId)->all();


        $ps = [];

        $i = 0;
        foreach($products as $product) {
//            $pso = \common\models\costfit\ProductSuppliers::find()
//                ->where("productId = $product->productId AND productSuppId = $product->productSuppId")->one();
//            if(!isset($pso))
//                continue;

//            $res['productId'] = $pso->productId;
//            $res['productSupplierId'] = $pso->productSuppId;

            $ps[$i]['productId'] = $product->productId;
            $ps[$i]['productSuppId'] = $product->productSuppId;

            $ps[$i]['title'] = $product->title;
            $ps[$i]['isbn'] = $product->isbn;
            $ps[$i]['code'] = $product->code;
//            $ps[$i]['shortDescription'] = $product->shortDescription;

            $sd = strip_tags($product->shortDescription);
            $sd = mb_substr($sd, 0, 60) . '...';
//            $ps[$i]['shortDescription'] = $sd;

//            $ps[$i]['description'] = $product->description;
//            $ps[$i]['specification'] = $product->specification;
            $ps[$i]['width'] = $product->width;
            $ps[$i]['height'] = $product->height;
            $ps[$i]['depth'] = $product->depth;
            $ps[$i]['weight'] = $product->weight;
            $ps[$i]['price'] = \common\models\costfit\ProductSuppliers::productPrice($product->productSuppId);
            $ps[$i]['brand'] = isset($product->brand) ? $product->brand->title : NULL;
            $ps[$i]['sale_price'] = $product->product->price;
            $ps[$i]['on_wish_list'] = false;
            $ps[$i]['supplierId'] = $product->userId;

            $hash = [
                'categoryId' => $product->categoryId,
                'productId' => $product->productId,
                'brandId' => $product->brandId,
            ];

//            $ps[$i]['hash'] = ModelMaster::encodeParams($hash);

            //product images
            $j = 0;
            $pis = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = $product->productSuppId")->all();
            foreach($pis as $pi) {
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

    public function actionNotSale() // Return Product List In Category
    {
        if(isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
//        $params = ModelMaster::decodeParams($hash);
//        print_r($params);exit();
        $categoryId = $_POST['categoryId'];

//        $ctps = CategoryToProduct::find()->select("* ,ps.productSuppId as productSupplierId")
//            ->join("LEFT JOIN", 'product p', "category_to_product.productId = p.productId")
//            ->join("LEFT JOIN", 'product_suppliers ps', "ps.productId = p.productId")
////        ->where(['category_to_product.categoryId' => $params['categoryId']])
//            ->where(['category_to_product.categoryId' => $categoryId])
//            ->andWhere("ps.productId in (SELECT productId FROM product_suppliers ps
//                                    LEFT JOIN product_price_suppliers pps ON pps.productSuppId = ps.productSuppId
//                                         WHERE ps.approve='approve'
//                                         and ps.status=1
//                                         and ps.result>0
//                                         ORDER BY pps.price ASC
//                                    )"
//            )
//            ->orderBy('p.title')
//            ->all();

        $products = Product::notSale($categoryId)->all();


        $ps = [];

        $i = 0;
        foreach($products as $product) {
//            $pso = \common\models\costfit\ProductSuppliers::find()
//                ->where("productId = $product->productId AND productSuppId = $product->productSuppId")->one();
//            if(!isset($pso))
//                continue;

//            $res['productId'] = $pso->productId;
//            $res['productSupplierId'] = $pso->productSuppId;

            $ps[$i]['productId'] = $product->productId;

            $ps[$i]['title'] = $product->title;
            $ps[$i]['isbn'] = $product->isbn;
            $ps[$i]['code'] = $product->code;
//            $ps[$i]['shortDescription'] = $product->shortDescription;

            $sd = strip_tags($product->shortDescription);
            $sd = mb_substr($sd, 0, 60) . '...';
//            $ps[$i]['shortDescription'] = $sd;

//            $ps[$i]['description'] = $product->description;
//            $ps[$i]['specification'] = $product->specification;
            $ps[$i]['width'] = $product->width;
            $ps[$i]['height'] = $product->height;
            $ps[$i]['depth'] = $product->depth;
            $ps[$i]['weight'] = $product->weight;
            $ps[$i]['brand'] = isset($product->brand) ? $product->brand->title : NULL;
            $ps[$i]['sale_price'] = $product->price;
            $ps[$i]['on_wish_list'] = false;
            $ps[$i]['supplierId'] = $product->userId;

            //product images
            $j = 0;
            $pis = \common\models\costfit\ProductImage::find()->where("productId = $product->productId")->all();
            foreach($pis as $pi) {
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

    public function actionFindProduct($hash) // With ProductId Or ISBN (Barcode)
    {
        $res = [];
        if(isset($_SERVER['HTTP_ORIGIN'])) {
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

        $p = \common\models\costfit\ProductSuppliers::find()->select("* , pps.price ,product_suppliers.description as description , product_suppliers.specification as tags,tags")
            ->join("LEFT JOIN", 'product_price_suppliers pps', "pps.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.isbn = '$isbn' AND product_suppliers.approve='approve' and product_suppliers.status=1 AND product_suppliers.result>0")
            ->orderBy(["pps.price" => SORT_ASC])
            ->one();

        if(isset($p)) {
            $res['productId'] = $p->productId;
            $res['productSuppId'] = $p->productSuppId;
            $res['title'] = $p->title;
            $res['isbn'] = $p->isbn;
            $res['code'] = $p->code;
//            $res['shortDescription'] = $p->shortDescription;

            $sd = strip_tags($p->shortDescription);
            $sd = mb_substr($sd, 0, 60) . '...';
            $res['shortDescription'] = $sd;

            $res['description'] = $p->description;
            $res['specification'] = $p->specification;
            $res['width'] = $p->width;
            $res['height'] = $p->height;
            $res['depth'] = $p->depth;
            $res['weight'] = $p->weight;
            $res['price'] = $p->price;
            $res['brand'] = isset($p->brand) ? $p->brand->title : NULL;
            $res['salePrice'] = false;
            $res['on_wish_list'] = false;
            $res['supplierId'] = $p->userId;
            $res['receiveType'] = $p->receiveType;


            $j = 0;
            $pis = \common\models\costfit\ProductImageSuppliers::find()->where("productSuppId = $p->productSuppId")->all();
            foreach($pis as $pi) {
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
        sleep(3);
        print_r(Json::encode($res));
    }

    public function actionIsbn($isbn)
    {
        $product = Product::findProductByIsbn($isbn);
        $res = $product->attributes;
        $res['brand'] = $product->brand->title;
        $res['category'] = $product->category->title;
        $res['shortDescription'] = strip_tags($product->shortDescription);

        $productSuppliers = ProductSuppliers::findCheapest($product->productId);
        if(isset($productSuppliers)) {
            $productPriceSupplier = ProductPriceSuppliers::latestPrice($productSuppliers->productSuppId);
            $res['salePrice'] = $productPriceSupplier->price;
        }

        return Json::encode($res);
    }

    public function actionView()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $userId = -1;

        if(isset($contents['token'])) {
            $userModel = User::find()->where(['auth_key'=>$contents['token']])->one();
            if(isset($userModel)) {
                $userId = $userModel->userId;
            }
        }

        $id = $contents['id'];
        $res = [];
        $product = Product::findProductById($id);

        $res = $product->attributes;
        $res['brand'] = $product->brand->title;
        $res['category'] = $product->category->title;
        $res['shortDescription'] = strip_tags($product->shortDescription);

        $productSuppliers = ProductSuppliers::findCheapest($id);
        if(isset($productPriceSupplier)) {
            $productPriceSupplier = ProductPriceSuppliers::latestPrice($productSuppliers->productSuppId);
            $res['salePrice'] = $productPriceSupplier->price;
        }
        $res['shareUrl'] = Url::home(true).'product/'.ModelMaster::encodeParams(['productId'=>$id]);
        $res['isWishlist'] = self::isWishlist($product->productId, $userId);
        $res['worldPrice'] = self::worldPrice($id);
        $res['localPrice'] = self::localPrice($id);

        header('Content-Type: application/json');
        return Json::encode($res);
    }

    public function actionSearch()
    {
        $searchText = $_POST['text'];
    }

    private static function isWishlist($productId, $userId)
    {
        $count = Wishlist::find()->where(['productId'=>$productId, 'userId'=>$userId])->count();

        return ($count > 0) ? true : false;
    }

    public function actionSimilar()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $productId = $contents['id'];

        $productModels = self::randomProduct();

        $res = [];
        $i = 0;
        foreach($productModels as $productModel) {
            if(!$productModel->images) {
                continue;
            }

            $res[$i] = self::prepareSimilarProduct($productModel);

            $i++;
        }
        header('Content-Type: application/json');
        echo Json::encode($res);
    }



    public function actionRelated()
    {
        $contents = Json::decode(file_get_contents("php://input"));
        $productId = $contents['id'];

        $productModels = self::randomProduct();

        $res = [];
        $i = 0;
        foreach($productModels as $productModel) {
            if(!$productModel->images) {
                continue;
            }

            $res[$i] = self::prepareSimilarProduct($productModel);

            $i++;
        }
        header('Content-Type: application/json');
        echo Json::encode($res);
    }

    private static function randomProduct()
    {
        return Product::find()
            ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
            ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
            ->leftJoin('brand b', 'b.brandId=product.brandId')
//            ->leftJoin('category c', 'c.categoryId=product.categoryId')
            ->where(['product.status'=>1, 'product.approve'=>'approve'])
            ->andWhere(['ps.status'=>1, 'ps.approve'=>'approve'])
            ->andWhere('ps.result > 0')
            ->andWhere('pps.price > 0')
            ->andWhere('ps.productId is not null')
            ->andWhere('b.brandId is not null')
//            ->andWhere('c.categoryId is not null')
            ->orderBy('RAND()')
            ->limit(6)
            ->all();
    }

    private static function prepareSimilarProduct($productModel)
    {
        return [
            'brand' => $productModel->brand->title,
            'productId' => $productModel->productId,
            'title' => trim($productModel->title),
            'image' => Url::home(true).$productModel->images->imageThumbnail1
        ];
    }

    private static function worldPrice($productId)
    {
        $worldPrice = ProductPostComparePrice::find()->where(['productId'=>$productId])->orderBy('RAND()')->one();

        return (isset($worldPrice)) ? $worldPrice->price : null;
    }

    private static function localPrice($productId)
    {
        $worldPrice = ProductPostComparePrice::find()->where(['productId'=>$productId])->orderBy('RAND()')->one();

        return (isset($worldPrice)) ? $worldPrice->price : null;
    }

}
