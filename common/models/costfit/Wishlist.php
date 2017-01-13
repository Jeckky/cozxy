<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\WishlistMaster;

/**
 * This is the model class for table "wishlist".
 *
 * @property string $wishlistId
 * @property string $userId
 * @property integer $productId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Wishlist extends \common\models\costfit\master\WishlistMaster {

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
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }

    public function getProductSuppliers() {
        return $this->hasOne(ProductSuppliers::className(), ['productSuppId' => 'productId']);
    }

    public static function isExistingList($productId) {
        if (isset(\Yii::$app->user->id)) {
            $ws = \common\models\costfit\Wishlist::find()->where("productId =" . $productId . " AND userId = " . \Yii::$app->user->id)->one();
            if (isset($ws)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
