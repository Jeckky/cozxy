<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupOptionValueMaster;

/**
 * This is the model class for table "product_group_option_value".
 *
 * @property string $productGroupOptionValueId
 * @property string $productGroupOptionId
 * @property string $productId
 * @property string $value
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $productGroupTemplateOptionId
 *
 * @property ProductGroupOption $productGroupOption
 * @property Product $product
 */
class ProductGroupOptionValue extends \common\models\costfit\master\ProductGroupOptionValueMaster {

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
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupTemplateOption() {
        return $this->hasOne(ProductGroupTemplateOption::className(), ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupp() {
        return $this->hasOne(ProductSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public static function findProductOptionsArray($productSuppId) {
        $res = [];
        $options = ProductGroupOptionValue::find()->where("productSuppId = $productSuppId")->groupBy("productGroupTemplateOptionId")->all();
        foreach ($options as $o) {
            $optionValues = ProductGroupOptionValue::find()
            ->join("LEFT JOIN", "product p", "p.productId = product_group_option_value.productId")
            ->join("LEFT JOIN", "product pg", "pg.productId = p.parentId")
            ->where("productGroupTemplateOptionId = $o->productGroupTemplateOptionId AND pg.productId = " . $o->productSupp->product->parentId)
            ->andWhere("product_group_option_value.productSuppId IS NOT NULL")
            ->groupBy("value")
            ->all();
            foreach ($optionValues as $value) {
                $res[$o->productGroupTemplateOptionId][$value->productGroupOptionValueId] = $value->value;
            }
        }


        return $res;
    }

}
