<?php

namespace frontend\modules\fakedata\models;

use Yii;
use \common\models\costfit\master\ProductMaster;
use common\helpers\Base64Decode;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property string $productId
 * @property string $userId
 * @property string $productGroupId
 * @property string $categoryId
 * @property string $code
 * @property string $title
 * @property string $description
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property ProductGroup $productGroup
 * @property Category $category
 * @property User $user
 * @property ProductPrice[] $productPrices
 * @property ProductPromotion[] $productPromotions
 * @property StoreProduct[] $storeProducts
 * @property StoreProductOrderItem[] $storeProductOrderItems
 */
class Product extends \common\models\costfit\Product
{
    public $salePrice;
    public $marketPrice;
    public $thumbnail;
    public $productSupplierId;
    public $maxQnty;
    public $supplierId;
    public $receiveType;

    public static function saleProduct()
    {
        return self::find()
            ->select('product.productId, product.price as marketPrice, pps.price as salePrice, product.title as title, product.brandId, product.categoryId, product.receiveType, ps.result as maxQnty, ps.userId as supplierId, ps.productSuppId as productSupplierId')
            ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
            ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
            ->leftJoin('brand b', 'product.brandId=b.brandId')
            ->where('product.parentId is not null')
            ->andWhere(['product.status' => 1, 'product.approve' => 'approve', 'ps.status' => 1, 'ps.approve' => 'approve', 'pps.status'=>1])
            ->andWhere('pps.price > 0')
            ->andWhere('b.brandId is not null')
            ->limit(12)
            ->all();
    }

    public static function notSaleProduct()
    {
        return self::find()
            ->select('product.productId, product.price as marketPrice, product.title as title, product.brandId, product.categoryId, product.receiveType, ps.result as maxQnty, ps.userId as supplierId, ps.productSuppId as productSupplierId')
            ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
            ->leftJoin('brand b', 'product.brandId=b.brandId')
            ->where('product.parentId is not null')
            ->andWhere(['product.status' => 1, 'product.approve' => 'approve'])
            ->andWhere('ps.productId is null')
            ->andWhere('b.brandId is not nulla')
            ->limit(12)
            ->all();
    }
}
