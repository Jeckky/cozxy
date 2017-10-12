<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductImageMaster;
use common\helpers\Base64Decode;

/**
 * This is the model class for table "product_image".
 *
 * @property string $productImageId
 * @property string $productId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductImage extends \common\models\costfit\master\ProductImageMaster {

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

    public function thumbnail($productId, $thumbnail = 1) {
        $model = $this->find()->where(['productId' => $productId])->orderBy('ordering')->one();
        if (!isset($model)) {
            return Base64Decode::DataImageSvg('Svg260x260');
        }
        return ($thumbnail == 1) ? $model->imageThumbnail1 : $model->imageThumbnail2;
    }

    public static function productMasterImage($productId) {
        $images = ProductImage::find()->where("productId = $productId")
                ->orderBy("ordering ASC")
                ->all();
        if (isset($images) && count($images) > 0) {
            return $images;
        } else {
            return 0;
        }
    }

    public static function findMaxOrdering($productId) {
        $max = ProductImage::find()->where("productId = $productId")->max("ordering");
        if (!isset($max)) {
            $max = 0;
        }
        return $max;
    }

}
