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

    public static function productSearch($search_hd, $n, $cat = FALSE)
    {
        $products = [];

        $whereArray = [];

        if (isset($search_hd)) {
            \Yii::$app->db->createCommand("CREATE FUNCTION `strip_tags`(\$str text) RETURNS text
                                        BEGIN
                                            DECLARE \$start, \$end INT DEFAULT 1;
                                            LOOP
                                                SET \$start = LOCATE('<', \$str, \$start);
                                                IF (!\$start) THEN RETURN \$str; END IF;
                                                SET \$end = LOCATE('>', \$str, \$start);
                                                IF (!\$end) THEN SET \$end = \$start; END IF;
                                                SET \$str = INSERT(\$str, \$start, \$end - \$start + 1, '');
                                            END LOOP;
                                        END;")->execute();
            $pCanSale = \common\models\costfit\ProductSuppliers::find()
            ->select('*')
            ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.status=1 and product_suppliers.approve='approve' and product_suppliers.result > 0 and product_price_suppliers.price > 0")
            ->andFilterWhere(['OR',
//                ['REGEXP', 'product_suppliers.title', trim($search_hd)],
//                ['REGEXP', 'product_suppliers.description', trim($search_hd)],
//                ['LIKE', 'product_suppliers.title', trim($search_hd)],
//                ['LIKE', 'strip_tags(product_suppliers.description)', trim($search_hd)],
                ['LIKE', 'product_suppliers.title', $search_hd],
                ['LIKE', 'strip_tags(product_suppliers.description)', $search_hd],
            ])
//->andWhere('group by product_suppliers.productSuppId ')
            ->groupBy(' product_suppliers.productSuppId ')
            ->orderBy(new \yii\db\Expression('rand()'))
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
            ->join("LEFT JOIN", "product_price_suppliers", "product_price_suppliers.productSuppId = product_suppliers.productSuppId")
            ->where("product_suppliers.status=1 and product_suppliers.approve='approve' and product_suppliers.result = 0 and product_price_suppliers.price = 0")
            ->andFilterWhere(['OR',
//                ['REGEXP', 'product_suppliers.title', trim($search_hd)],
//                ['REGEXP', 'product_suppliers.description', trim($search_hd)],
//                ['LIKE', 'product_suppliers.title', trim($search_hd)],
//                ['LIKE', 'product_suppliers.description', trim($search_hd)],
                ['LIKE', 'product_suppliers.title', $search_hd],
                ['LIKE', 'strip_tags(product_suppliers.description)', $search_hd],
            ])
            //->andWhere('group by product_suppliers.productSuppId ')
            ->groupBy(' product_suppliers.productSuppId ')
            ->orderBy(new \yii\db\Expression('rand()'))
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

        $product = \common\models\costfit\CategoryToProduct::find()
        ->select('ps.*,pps.*,category_to_product.*')
        ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
        ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
        ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
        ->where("ps.brandId  = $brandId AND product.approve = 'approve' AND pps.status = 1")
        ->andWhere(($status == 'sale') ? 'pps.price > 0 AND ps.result > 0' : 'pps.price = 0 AND ps.result = 0')
        ->groupBy('ps.productSuppId')
        ->all();


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
            ->select('ps.*,pps.*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
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
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
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

    public static function productSearchCategoryNotSale($n, $cat = FALSE, $mins = FALSE, $maxs = FALSE)
    {
        $products = [];
        $whereArray = [];
        if ($cat != FALSE && $mins == FALSE && $maxs == FALSE) {

            $whereArray = [];
            $whereArray["category_to_product.categoryId"] = $cat;
            $whereArray["ps.approve"] = "approve";
            $whereArray["pps.status"] = "1";
            //$whereArray["ps.result"] = "0";
            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere(["=", "ps.result", 0])
            ->andWhere(["=", "pps.price", 0])
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
            ->select('*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray2)
            ->andWhere('ps.result > 0')
            ->andWhere('pps.price > 0')
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
            $whereArray["ps.approve"] = "approve";
            $whereArray["pps.status"] = "1";
            //$whereArray["ps.result"] = "0";
            $pCanSale = \common\models\costfit\CategoryToProduct::find()
            ->select('ps.*,pps.*')
            ->join("LEFT JOIN", "product", "product.productId = category_to_product.productId")
            ->join("LEFT JOIN", "product_suppliers ps", "ps.productId=product.productId")
            ->join("LEFT JOIN", "product_price_suppliers pps", "pps.productSuppId = ps.productSuppId")
            ->where($whereArray)
            ->andWhere(["=", "ps.result", 0])
            ->andWhere(["=", "pps.price", 0])
            //->orderBy(new \yii\db\Expression('rand()'))
            //->orderBy(['pps.price' => SORT_DESC, 'rand()' => SORT_DESC])
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

}
