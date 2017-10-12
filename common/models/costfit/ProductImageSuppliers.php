<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductImageSuppliersMaster;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product_image_suppliers".
 *
 * @property string $productImageId
 * @property string $productId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $imageThumbnail1
 * @property string $imageThumbnail2
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductImageSuppliers extends \common\models\costfit\master\ProductImageSuppliersMaster {

    /**
     * @inheritdoc
     */
    public $productId;

    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function upload() {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function findMaxOrdering($productSuppId) {
        $max = ProductImageSuppliers::find()->where("productSuppId = $productSuppId")->max("ordering");
        if (!isset($max)) {
            $max = 0;
        }
        return $max;
    }

    public function getProductSupp() {
        return $this->hasOne(ProductSuppliers::className(), ['productSuppId' => 'productSuppId']);
    }

    public static function productImages($productSuppId) {
        $images = ProductImageSuppliers::find()->where("productSuppId = $productSuppId")
                ->orderBy("ordering ASC")
                ->all();
        if (isset($images) && count($images) > 0) {
            return $images;
        } else {
            return 0;
        }
    }

}
