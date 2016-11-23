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

}
