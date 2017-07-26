<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductShelfMaster;

/**
 * This is the model class for table "product_shelf".
 *
 * @property string $productShelfId
 * @property string $title
 * @property integer $userId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductShelf extends \common\models\costfit\master\ProductShelfMaster {

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

    public static function wishListGroup() {
        if (Yii::$app->user->id) {
            $shelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type!=3")
                    ->orderBy('type')
                    ->addOrderBy('updateDateTime DESC')
                    ->all();
            if (isset($shelf) && count($shelf) > 0) {
                return $shelf;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function wishListGroupModal() {
        if (Yii::$app->user->id) {
            $shelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type=2")
                    ->orderBy('type')
                    ->addOrderBy('updateDateTime DESC')
                    ->all();
            if (isset($shelf) && count($shelf) > 0) {
                return $shelf;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function favoriteStories() {
        if (Yii::$app->user->id) {
            $shelf = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type=3")
                    ->addOrderBy('updateDateTime DESC')
                    ->one();
            if (isset($shelf)) {
                return $shelf;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function defaultWishlist() {
        if (Yii::$app->user->id) {
            $defalueWishlist = ProductShelf::find()->where("userId=" . Yii::$app->user->id . " and status=1 and type=1")
                    ->orderBy('createDateTime DESC')
                    ->one();
            if (isset($defalueWishlist)) {
                return $defalueWishlist;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function isAddToWishList($productId, $productShelfId) {
        if (Yii::$app->user->id) {
            $wishList = Wishlist::find()->where("userId=" . Yii::$app->user->id . " and productId=" . $productId . " and productShelfId=" . $productShelfId . " and status=1")
                    ->orderBy('createDateTime')
                    ->all();
            if (isset($wishList) && count($wishList) > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
