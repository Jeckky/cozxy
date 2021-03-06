<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPriceMatchGroupMaster;

/**
 * This is the model class for table "product_price_match_group".
 *
 * @property string $productPriceMatchGroupId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPriceMatchGroup extends \common\models\costfit\master\ProductPriceMatchGroupMaster
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

    public function getProductPriceMatchs()
    {
        return $this->hasMany(ProductPriceMatch::className(), ['productPriceMatchGroupId' => 'productPriceMatchGroupId']);
    }

}
