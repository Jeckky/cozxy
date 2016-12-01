<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductSuppliersMaster;

/**
 * This is the model class for table "product_suppliers".
 *
 * @property string $productId
 * @property string $userId
 * @property string $productGroupId
 * @property string $brandId
 * @property string $categoryId
 * @property string $isbn
 * @property string $code
 * @property string $title
 * @property string $optionName
 * @property string $shortDescription
 * @property string $description
 * @property string $specification
 * @property string $width
 * @property string $height
 * @property string $depth
 * @property string $weight
 * @property string $price
 * @property string $unit
 * @property string $smallUnit
 * @property string $tags
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductSuppliers extends \common\models\costfit\master\ProductSuppliersMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'image', 'Smart Price', 'firstname', 'lastname', 'bTitle', 'cTitle', 'uTitle', 'smuTitle'
        ]);
    }

    public function getBrand() {
        return $this->hasOne(Brand::className(), ['brandId' => 'brandId']);
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

}
