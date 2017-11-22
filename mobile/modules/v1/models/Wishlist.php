<?php

namespace mobile\modules\v1\models;

use Yii;
use \common\models\costfit\master\WishlistMaster;
use common\models\costfit\Wishlist as WishlistModel;

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
class Wishlist extends WishlistModel {

    public $marketPrice;
    public $sellingPrice;
    public $image;
    public $title;
}
