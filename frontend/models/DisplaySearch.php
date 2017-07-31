<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplaySearch extends Model
{

    public $score;

    public static function productSearch($search_hd, $n, $cat = FALSE)
    {
        $products = [];

        $whereArray = [];

        if ($search_hd !== '') {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            //->addSelect('match(product_suppliers.title, product_suppliers.optionName, product_suppliers.shortDescription, product_suppliers.description) against("' . trim($search_hd) . '*" in boolean mode) as score')
            ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.status=1 and product_suppliers.approve='approve' and product_suppliers.result > 0 and product_price_suppliers.price > 0")
            ->andFilterWhere(['OR',
                //                ['REGEXP', 'product_suppliers.title', trim($search_hd)],
                //                ['REGEXP', 'product_suppliers.description', trim($search_hd)],
                ['LIKE', 'product_suppliers.title', trim($search_hd)],
                ['LIKE', 'strip_tags(product_suppliers.description)', trim($search_hd)],
            //                ['LIKE', 'product_suppliers.title', $search_hd],
            //                ['LIKE', 'strip_tags(product_suppliers.description)', $search_hd],
            ])

//            ->andWhere('match(product_suppliers.title, product_suppliers.optionName, product_suppliers.shortDescription, product_suppliers.description) against("' . trim($search_hd) . '*" in boolean mode) ')
//->andWhere('group by product_suppliers.productSuppId ')
            ->groupBy(' product_suppliers.productSuppId ')
            ->orderBy(new \yii\db\Expression('rand()'))
//            ->orderBy('score')
            ->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy(new \yii\db\Expression('rand()'))->all();
        }

        foreach ($pCanSale as $value) {
            if (isset($value->productSuppId)) {

                $price_s = isset($value->product) ? number_format($value->product->price, 2) : '';
                $price = number_format($value->price, 2);
                $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

                $products[$value->productSuppId] = [
                    'productSuppId' => $value->productSuppId,
                    'image' => $productImagesThumbnail1,
                    'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'title' => substr($value->title, 0, 35),
                    'price_s' => isset($price_s) ? $price_s : '',
                    'price' => isset($price) ? $price : '',
                    'maxQnty' => $value->result,
                    'fastId' => FALSE,
                    'productId' => $value->productId,
                    'supplierId' => $value->userId,
                    'receiveType' => $value->receiveType,
                    'wishList' => $wishList
                ];
            } else {
                $products[$value->productSuppId] = [
                    'productSuppId' => FALSE,
                    'image' => FALSE,
                    'url' => FALSE,
                    'brand' => FALSE,
                    'title' => FALSE,
                    'price_s' => FALSE,
                    'price' => FALSE,
                    'maxQnty' => FALSE,
                    'fastId' => FALSE,
                    'productId' => FALSE,
                    'supplierId' => FALSE,
                    'receiveType' => FALSE,
                    'wishList' => FALSE,
                ];
            }
        }

        return $products;
    }

    public static function productSearchNotSale($search_hd, $n, $cat = FALSE)
    {
        $products = [];

        $whereArray = [];

        if (isset($search_hd)) {

            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            //->addSelect('match(product_suppliers.title, product_suppliers.optionName, product_suppliers.shortDescription, product_suppliers.description) against("' . trim($search_hd) . '*" in boolean mode) as score')
            ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.status=1 and product_suppliers.approve='approve' and product_suppliers.result = 0 and product_price_suppliers.price = 0")
            ->andFilterWhere(['OR',
                //                ['REGEXP', 'product_suppliers.title', trim($search_hd)],
                //                ['REGEXP', 'product_suppliers.description', trim($search_hd)],
                ['LIKE', 'product_suppliers.title', trim($search_hd)],
                ['LIKE', 'product_suppliers.description', trim($search_hd)],
            //                ['LIKE', 'product_suppliers.title', $search_hd],
            //                ['LIKE', 'strip_tags(product_suppliers.description)', $search_hd],
            ])

            // ->andWhere('match(product_suppliers.title, product_suppliers.optionName, product_suppliers.shortDescription, product_suppliers.description) against("' . trim($search_hd) . '*" in boolean mode) ')
            //->andWhere('group by product_suppliers.productSuppId ')
            ->groupBy(' product_suppliers.productSuppId ')
            ->orderBy(new \yii\db\Expression('rand()'))
            //->orderBy('score')
            ->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy(new \yii\db\Expression('rand()'))->all();
        }

        foreach ($pCanSale as $value) {
            if (isset($value->productSuppId)) {

                $price_s = isset($value->product) ? number_format($value->product->price, 2) : '';
                $price = number_format($value->price, 2);
                $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
                $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

                $products[$value->productSuppId] = [
                    'productSuppId' => $value->productSuppId,
                    'image' => $productImagesThumbnail1,
                    'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                    'brand' => isset($value->brand) ? $value->brand->title : '',
                    'title' => substr($value->title, 0, 35),
                    'price_s' => isset($price_s) ? $price_s : '',
                    'price' => isset($price) ? $price : '',
                    'maxQnty' => $value->result,
                    'fastId' => FALSE,
                    'productId' => $value->productId,
                    'supplierId' => $value->userId,
                    'receiveType' => $value->receiveType,
                    'wishList' => $wishList
                ];
            } else {
                $products[$value->productSuppId] = [
                    'productSuppId' => FALSE,
                    'image' => FALSE,
                    'url' => FALSE,
                    'brand' => FALSE,
                    'title' => FALSE,
                    'price_s' => FALSE,
                    'price' => FALSE,
                    'maxQnty' => FALSE,
                    'fastId' => FALSE,
                    'productId' => FALSE,
                    'supplierId' => FALSE,
                    'receiveType' => FALSE,
                    'wishList' => FALSE,
                ];
            }
        }

        return $products;
    }

    public static function productSearchBrand($brandId, $n, $cat = FALSE, $status)
    {

        $products = [];

        if ($status == 'sale') {
            $product = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,category_to_product.*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where("ps.brandId  = $brandId AND product.approve = 'approve' AND pps.status = 1")
            ->andWhere('pps.price > 0 AND ps.result > 0')
            ->groupBy('ps.productSuppId')
            ->all();
        } else {
            $product = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,category_to_product.*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where("ps.brandId  = $brandId AND product.approve = 'approve' AND pps.status = 1")
            ->andWhere('pps.price = 0 AND ps.result = 0')
            ->groupBy('ps.productSuppId')
            ->all();
        }

        /* $product = \common\models\costfit\CategoryToProduct::find()
          ->select('ps.*,pps.*,category_to_product.*')
          ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
          ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
          ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
          ->where("ps.brandId  = $brandId AND product.approve = 'approve' AND pps.status = 1")
          ->andWhere(($status == 'sale') ? 'pps.price > 0 AND ps.result > 0' : 'pps.price = 0 AND ps.result = 0')
          ->groupBy('ps.productSuppId')
          ->all();
         */

        //if (count($product) > 0) {
        foreach ($product as $value) {
//            throw new \yii\base\Exception(print_r($value, true));
            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);
            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => substr($value->title, 0, 35),
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }
        //}


        return $products;
    }

    public static function productSearchCategory($n, $cat = FALSE, $mins = FALSE, $maxs = FALSE)
    {
        $products = [];
        $whereArray = [];
        if ($cat != FALSE && $mins == FALSE && $maxs == FALSE) {
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;

            $whereArray["ps.approve"] = "approve";
            $whereArray["pps.status"] = "1";
            if ($n != '') {
                $whereArray["limit"] = $n;
            }

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,`brand`.title as brandName ')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
            ->where($whereArray)
            ->andWhere([">", "ps.result", 0])
            ->andWhere([">", "pps.price", 0])
            //->orderBy(new \yii\db\Expression('rand()'))
            //->orderBy(['pps.price' => SORT_DESC, 'rand()' => SORT_DESC])
            ->orderBy(['pps.price' => SORT_ASC])
            //->limit($n)
            ->all();
        } elseif ($cat != FALSE && $mins != FALSE && $maxs != FALSE) {
            $whereArray2 = [];

            $whereArray2["category_to_product.categoryId"] = $cat;
            $whereArray2["ps.approve"] = "approve";
            $whereArray2["pps.status"] = "1";

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,`brand`.title as brandName ')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
            ->where($whereArray2)
            ->andWhere('ps.result > 0')
            ->andWhere('pps.price > 0')
            ->andWhere(['between', 'pps.price', $mins, $maxs])
            ->groupBy('ps.productSuppId')
            ->orderBy(['pps.price' => SORT_ASC])
            ->limit($n)->all();
        } else {
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
            . ' product_price_suppliers.price > 0')
            ->orderBy("product_price_suppliers.price ASC , " . new \yii\db\Expression('rand()'))->limit($n)->all();
        }

        foreach ($pCanSale as $value) {


            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; // number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : $value->brandName,
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productSearchCategoryNotSale($n, $cat = FALSE, $mins = FALSE, $maxs = FALSE)
    {
        $products = [];
        $whereArray = [];
        if ($cat != FALSE && $mins == FALSE && $maxs == FALSE) {

            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;
            //$whereArray["ps.approve"] = "approve";
            // $whereArray["pps.status"] = "1";
            //$whereArray["ps.result"] = "0";
            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,`brand`.title as brandName')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
            ->where($whereArray)
            //->andWhere(["=", "ps.result", 0])
            ->andWhere("IF(`ps`.`result` = 0,1,(IF(`ps`.`result` IS NULL,(IF(`product`.productId IS NULL,0,1)),0)))")
            ->andWhere('IF(`pps`.`status` = 1,1,(IF(`pps`.`status` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) ')
            ->andWhere('IF(`ps`.`approve`="approve",1,(IF(`ps`.`approve` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) = 1')
            ->andWhere(["=", "pps.price", 0])
            //->orderBy(new \yii\db\Expression('rand()'))
            //->orderBy(['pps.price' => SORT_DESC, 'rand()' => SORT_DESC])
            ->orderBy(['pps.price' => SORT_ASC])
            //->limit($n)
            ->all();
        } elseif ($cat != FALSE && $mins != FALSE && $maxs != FALSE) {
            $whereArray2 = [];

            $whereArray2["category_to_product.categoryId"] = $cat;
            //$whereArray2["ps.approve"] = "approve";
            //$whereArray2["pps.status"] = "1";

            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('*,`brand`.title as brandName')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
            ->where($whereArray2)
            ->andWhere("IF(`ps`.`result` = 0,1,(IF(`ps`.`result` IS NULL,(IF(`product`.productId IS NULL,0,1)),0)))")
            ->andWhere('IF(`pps`.`status` = 1,1,(IF(`pps`.`status` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) ')
            ->andWhere('IF(`ps`.`approve`="approve",1,(IF(`ps`.`approve` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) = 1')
            //->andWhere('ps.result > 0')
            //->andWhere('pps.price > 0')
            ->andWhere(['between', 'pps.price', $mins, $maxs])
            ->groupBy('ps.productSuppId')
            ->orderBy(['pps.price' => SORT_ASC])
            ->limit($n)->all();
        } else {
            /* $pCanSale = \common\models\costfit\ProductSuppliers::find()
              ->select('*')
              ->join(" LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
              ->where(' product_suppliers.approve="approve" and product_suppliers.result > 0 AND product_price_suppliers.status =1 AND '
              . ' product_price_suppliers.price > 0')
              ->orderBy("product_price_suppliers.price ASC , " . new \yii\db\Expression('rand()'))->limit($n)->all(); */
            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;
            //$whereArray["ps.approve"] = "approve";
            //$whereArray["pps.status"] = "1";
            //$whereArray["ps.result"] = "0";
            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*,`brand`.title as brandName')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
            ->where($whereArray)
            //->andWhere(["=", "ps.result", 0])
            //->andWhere(["=", "pps.price", 0])
            //->orderBy(new \yii\db\Expression('rand()'))
            //->orderBy(['pps.price' => SORT_DESC, 'rand()' => SORT_DESC])
            ->andWhere("IF(`ps`.`result` = 0,1,(IF(`ps`.`result` IS NULL,(IF(`product`.productId IS NULL,0,1)),0)))")
            ->andWhere('IF(`pps`.`status` = 1,1,(IF(`pps`.`status` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) ')
            ->andWhere('IF(`ps`.`approve`="approve",1,(IF(`ps`.`approve` IS NULL,(IF(`product`.productId IS NULL,0,1)),0))) = 1')
            ->orderBy(['pps.price' => SORT_ASC])
            //->limit($n)
            ->all();
        }

        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : $value->brandName,
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productSearchCategoryShowMore($s, $e, $cat = FALSE)
    {
        $products = [];
        $whereArray = [];

        $whereArray2 = [];

        $whereArray2["category_to_product.categoryId"] = $cat;
        $whereArray2["ps.approve"] = "approve";
        $whereArray2["pps.status"] = "1";

        $pCanSale = \common\models\costfit\CategoryToProduct::find()
        ->select('*')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->where($whereArray2)
        //->andWhere('ps.result > 0')
        //->andWhere('pps.price > 0')
        ->groupBy('ps.productSuppId')->limit($s, $e)->all();


        foreach ($pCanSale as $value) {
            $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->one();
            //$productPrice = \common\models\costfit\ProductPriceSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('productPriceId desc')->limit(1)->one();
            if (isset($productImages->imageThumbnail1) && !empty($productImages->imageThumbnail1)) {
                if (file_exists(Yii::$app->basePath . "/web/" . $productImages->imageThumbnail1)) {
                    $productImagesThumbnail1 = '/' . $productImages->imageThumbnail1;
                } else {
                    $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
                }
            } else {
                $productImagesThumbnail1 = \common\helpers\Base64Decode::DataImageSvg260x260(FALSE, FALSE, FALSE);
            }
            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; //number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : '',
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productFilterBrand($cat = FALSE, $brand = FALSE)
    {
        $products = [];
        $whereArray = [];


        $whereArray2 = [];

        $whereArray2["category_to_product.categoryId"] = $cat;
        $whereArray2["brand.brandId"] = $brand;
        $whereArray2["ps.approve"] = "approve";
        $whereArray2["pps.status"] = "1";

        $pCanSale = \common\models\costfit\CategoryToProduct::find()
        ->select('ps.*,pps.*,`brand`.title as brandName ')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
        ->where($whereArray2)
        ->andWhere('pps.price > 0')
        ->andWhere('ps.result > 0')
        ->groupBy('ps.productSuppId')
        ->orderBy(['pps.price' => SORT_ASC])
        ->all();


        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; // number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? $value->title : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : $value->brandName,
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productFilterAll($cat = FALSE, $brand = FALSE, $mins = FALSE, $maxs = FALSE)
    {
        $products = [];
        $whereArray2 = [];

        $whereArray2["category_to_product.categoryId"] = $cat;
        if (isset($brand)) {
            $whereArray2["brand.brandId"] = $brand;
        }
        $whereArray2["ps.approve"] = "approve";
        $whereArray2["pps.status"] = "1";


        //echo '<pre>';
        //print_r($whereArray2);
        $pCanSale = \common\models\costfit\CategoryToProduct::find()
        ->select('ps.*, pps.*, `brand`.title as brandName ')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
        ->where($whereArray2)
        ->andWhere(($maxs > 100) ? 'pps.price ' . 'between ' . $mins . ' and ' . $maxs : " 1=1")
        //->andWhere('pps.price > 0')
        //->andWhere('ps.result > 0')
        //->andWhere(['between', 'pps.price', $mins, $maxs])
        ->groupBy('ps.productSuppId')
        ->orderBy(['pps.price' => SORT_ASC])
        ->all();


        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; // number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : $value->brandName,
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function productSortAll($cat = FALSE, $brand = FALSE, $mins = FALSE, $maxs = FALSE, $status = FALSE, $sort = FALSE)
    {
        $products = [];
        $whereArray2 = [];

        $whereArray2["category_to_product.categoryId"] = $cat;
        if (isset($brand)) {
            $whereArray2["brand.brandId"] = $brand;
        }
        $whereArray2["ps.approve"] = "approve";
        $whereArray2["pps.status"] = "1";

        $sortStr = ($status == "price") ? "pps.price " : (($status == "brand") ? "brandName " : "ps.updateDateTime ");
        if ($sort == 'SORT_ASC') {
            $sortStr.= 'asc';
        } else {
            $sortStr.= 'desc';
        }


        $pCanSale = \common\models\costfit\CategoryToProduct::find()
        ->select('ps.*, pps.*, `brand`.title as brandName ')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->join("LEFT JOIN", "brand", "brand.brandId = ps.brandId")
        ->where($whereArray2)
        ->andWhere("ps.result > 0 AND pps.price > 0")
        ->andWhere(($maxs > 100) ? 'pps.price ' . 'between ' . $mins . ' and ' . $maxs : " 1=1")
        ->groupBy('ps.productSuppId')
        //->orderBy(($status == 'price') ? ['pps.price' => ($sortPrice == 'SORT_ASC') ? SORT_ASC : SORT_DESC] : (($status == 'brand') ? ['brandName' => ($sortBrand == 'SORT_ASC') ? SORT_ASC : SORT_DESC] : (($status == 'new') ? ['ps.updateDateTime' => ($sortNew == 'SORT_ASC') ? SORT_ASC : SORT_DESC] : '')))
        ->orderBy($sortStr)
        ->all();

        //throw new \yii\base\Exception($sortPrice);

        foreach ($pCanSale as $value) {

            $productImagesThumbnail1 = \common\helpers\DataImageSystems::DataImageMaster($value->productId, $value->productSuppId, 'Svg260x260');

            $price_s = isset($value->product) ? number_format($value->product->price, 2) : ''; // number_format($value->product->price, 2);
            $price = number_format($value->price, 2);

            if (Yii::$app->controller->id == 'site') {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            } else {
                $title = isset($value->title) ? substr($value->title, 0, 35) : '';
            }

            $wishList = \frontend\models\DisplayMyWishList::productWishList($value->productSuppId);

            $products[$value->productSuppId] = [
                'productSuppId' => $value->productSuppId,
                'image' => $productImagesThumbnail1,
                'url' => Yii::$app->homeUrl . 'product/' . $value->encodeParams(['productId' => $value->productId, 'productSupplierId' => $value->productSuppId]),
                'brand' => isset($value->brand) ? $value->brand->title : $value->brandName,
                'title' => $title,
                'price_s' => isset($price_s) ? $price_s : '',
                'price' => isset($price) ? $price : '',
                'maxQnty' => isset($value->result) ? $value->result : '',
                'fastId' => FALSE,
                'productId' => isset($value->productId) ? $value->productId : '',
                'supplierId' => isset($value->userId) ? $value->userId : '',
                'receiveType' => isset($value->receiveType) ? $value->receiveType : '',
                'wishList' => $wishList
            ];
        }

        return $products;
    }

    public static function findAllPrice($categoryId)
    {
        $whereArray = [];
        $whereArray["category_to_product.categoryId"] = $categoryId;

        $whereArray["ps.approve"] = "approve";
        $whereArray["pps.status"] = "1";
        $pCanSale = \common\models\costfit\CategoryToProduct::find()
        ->select('MIN(pps.price) as minPrice , MAX(pps.price) as maxPrice')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->where($whereArray)
        ->andWhere([">", "ps.result", 0])
        ->andWhere([">", "pps.price", 0])
        ->one();
        return $pCanSale;
    }

}
