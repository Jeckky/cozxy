<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ProductPostImagesMaster;
use yii\db\Expression;

/**
 * This is the model class for table "product_post_images".
 *
 * @property string $imagesId
 * @property string $productPostId
 * @property string $picture
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ProductPostImages extends \common\models\costfit\master\ProductPostImagesMaster
{
    public $imageFiles;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 10, 'extensions' => 'png, jpg'],

        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), []);
    }

    public function upload($productPostId)
    {
        $i = 0;
        foreach($this->imageFiles as $imageFile) {
            $fileName = Yii::$app->security->generateRandomString(12) . $imageFile->baseName . '.' . $imageFile->extension;
            $fileUrl = 'images/story/' . $fileName;
            $filePath = Yii::$app->basePath . '/../frontend/web/images/story/' . $fileName;

            $model = new ProductPostImages();
            $model->picture = $fileUrl;
            $model->status = 2;
            $model->createDateTime = $model->updateDateTime = new Expression('NOW()');
            $model->productPostId = $productPostId;

            if($imageFile->saveAs($filePath) && $model->save()) {
                $i++;
            }
        }
        if(sizeof($this->imageFiles) == $i) {
            return true;
        }

        return false;
    }
}
