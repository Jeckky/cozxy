<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryToProductMaster;

/**
 * This is the model class for table "category_to_product".
 *
 * @property string $id
 * @property string $categoryId
 * @property string $productId
 * @property integer $level
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class CategoryToProduct extends \common\models\costfit\master\CategoryToProductMaster
{

    /**
     * @inheritdoc
     */
//    public $maxPrice;
//    public $minPrice;

    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'minPrice',
            'maxPrice',
            'productSupplierId', 'productSuppId', 'productId', 'title', 'price', 'result', 'brand', 'image', 'imageThumbnail1', 'imageThumbnail2'
            , 'brandName', 'brandId', 'description', 'receiveType', 'userId'
        ]);
    }

    /**
     * relation
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public static function saveCategoryToProduct($categoryId, $productId)
    {
        $model = new CategoryToProduct();
        CategoryToProduct::deleteAll("productId = " . $productId);

        $category = Category::find()->where("categoryId=" . $categoryId)->one();
        $model->categoryId = $categoryId;
        $model->productId = $productId;
        $model->createDateTime = new \yii\db\Expression("NOW()");
        $model->save();
        $me = $category;
        while (isset($me->parent)) {
            $parent = $me->parent;
            $catToProduct = new CategoryToProduct();
            $catToProduct->productId = $productId;
            $catToProduct->categoryId = $parent->categoryId;
            $catToProduct->createDateTime = new \yii\db\Expression("NOW()");
            $catToProduct->save();
            $me = $parent;
        }
    }
}
