<?php

namespace backend\modules\productmanager\models;

use common\models\costfit\ProductGroupOptionValue;
use Yii;
use common\helpers\Base64Decode;
use yii\data\ActiveDataProvider;
use common\models\costfit\ProductSuppliers;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\costfit\Product as ProductModel;

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
class Product extends ProductModel
{

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['productGroupTemplateId', 'brandId', 'categoryId', 'title', 'shortDescription', 'description', 'specification'], 'required', 'on' => 'createProductGroup'],
            [['createDateTime'], 'default', 'value' => new Expression('NOW()')],
        ]);
    }

    public function getParent()
    {
        return $this->hasOne(Product::className(), ['productId' => 'parentId']);
    }

    public function hasProductSuppliers()
    {
        $product = Product::find()->where(['productId' => $this->productId])->one();
        $productSuppliers = null;
        if($product->parentId === NULL) {
            $productSuppliers = ProductSuppliers::find()
                ->leftJoin('product p', 'p.productId=product_suppliers.productId')
                ->where(['p.parentId' => $this->productId])
                ->one();
        } else {
            $productSuppliers = ProductSuppliers::find()
                ->leftJoin('product p', 'p.productId=product_suppliers.productId')
                ->where(['p.productId' => $this->productId])
                ->one();
        }

        $hasProductSuppliers = (count($productSuppliers) > 0) ? true : false;

        return $hasProductSuppliers;
    }
}
