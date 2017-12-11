<?php

namespace mobile\modules\v1\models;

use Yii;
use \common\models\costfit\ProductPost as ProductPostModel;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "product_post".
 *
 * @property string $productPostId
 * @property string $productSuppId
 * @property string $brandId
 * @property string $userId
 * @property string $description
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPost extends ProductPostModel
{
    public $viewCount;
    public $stars;


}
