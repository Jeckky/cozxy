<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostRatingMaster;

/**
 * This is the model class for table "product_post_rating".
 *
 * @property string $productPostRatingId
 * @property string $productPostId
 * @property string $userId
 * @property integer $score
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPostRating extends \common\models\costfit\master\ProductPostRatingMaster {

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

}
