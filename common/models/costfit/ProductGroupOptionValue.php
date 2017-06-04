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
class ProductGroupOptionValue extends \common\models\costfit\master\ProductGroupOptionValueMaster
{

    /**
     * @inheritdoc
     */
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
     * @return \yii\db\ActiveQuery
     */
    public function getProductGroupTemplateOption()
    {
        return $this->hasOne(ProductGroupTemplateOption::className(), ['productGroupTemplateOptionId' => 'productGroupTemplateOptionId']);
    }

    public static function findProductOptionsArray($productSuppId)
    {

    }

}
