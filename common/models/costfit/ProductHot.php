<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductHotMaster;

/**
 * This is the model class for table "product_hot".
 *
 * @property string $productHotId
 * @property string $productId
 * @property string $price
 * @property string $startDate
 * @property string $endDate
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductHot extends \common\models\costfit\master\ProductHotMaster {

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

    public function getProduct() {
        //return $this->hasOne(\common\models\costfit\Product::className(), ['productId' => 'productId']);
        return $this->hasOne(\common\models\costfit\ProductSuppliers::className(), ['productSuppId' => 'productId']);
    }

    public function getImages() {
        return $this->hasMany(\common\models\costfit\ProductImageSuppliers::className(), ['productSuppId' => 'productId']);
    }

    public function getPrice() {
        return $this->hasOne(\common\models\costfit\ProductPriceSuppliers::className(), ['productSuppId' => 'productId'])->where("product_price_suppliers.status=1");
    }

    public static function findAllHotProducts() {
        $query = ProductHot::find()->where('date(startDate) <= curdate() And date(endDate) >= curdate()');
        return new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
    }

}
