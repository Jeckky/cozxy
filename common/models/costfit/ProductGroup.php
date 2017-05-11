<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductGroupMaster;

/**
 * This is the model class for table "product_group".
 *
 * @property string $productGroupId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Product[] $products
 */
class ProductGroup extends \common\models\costfit\master\ProductGroupMaster {

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

    public static function productSupplierGroup() {
        $productGroup = ProductGroup::find()->where("status=1 and userId=" . Yii::$app->user->identity->userId)->all();
        return $productGroup;
    }

}
