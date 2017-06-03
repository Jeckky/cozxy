<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\Address;
use common\models\costfit\User;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductPost;
use common\helpers\Base64Decode;

/**
 * ContactForm is the model behind the contact form.
 */
class DisplayMyWishList extends Model {

    public static function productWishList($productId) {
        if (isset(Yii::$app->user->id)) {
            $productPost = \common\models\costfit\Wishlist::find()->where('userId=' . Yii::$app->user->id . ' and productId=' . $productId)->one();
            if (isset($productPost)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
