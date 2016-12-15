<?php

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * Suppliers 14/12/2016
 */
class Upload {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
        //
        ];
    }

    public static function UploadBasic($fileName, $folderName, $uploadPath, $width, $height) {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $file->saveAs($uploadPath . '/' . $newFileName);
        $originalFile = $uploadPath . '/' . $newFileName; // originalFile
        $thumbFile = $uploadPath . '/' . $newFileName;
        $saveThumb1 = Image::thumbnail($originalFile, 164, 120)->save($thumbFile, ['quality' => 80]); // thumbnail file
        return $newFileName;
    }

    public static function UploadSuppliers($model) {
        //$uploadPath = Yii::getAlias('@root') . '/uploads/';
        $folderName = "ProductImageSuppliers"; //  Size 553 x 484
        $folderThumbnail = "thumbnail"; // Size 553 x 484
        $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
        $folderThumbnail2 = "thumbnail2"; // Size 137 x 130

        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        $uploadPath1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
        $uploadPath2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail1;
        $uploadPath3 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail2;
        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;

            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile

            $thumbFile0 = $uploadPath . '/' . $newFileName; // Size 553 x 484
            $thumbFile1 = $uploadPath1 . '/' . $newFileName;
            $thumbFile2 = $uploadPath2 . '/' . $newFileName; // Size 356 x 390
            $thumbFile3 = $uploadPath3 . '/' . $newFileName; // Size 137 x 130

            $saveThumb0 = Image::thumbnail($originalFile, 553, 484)->save($thumbFile0, ['quality' => 80]);
            //$saveThumb1 = Image::thumbnail($originalFile, 553, 484)->save($thumbFile1, ['quality' => 80]); // thumbnail file
            $saveThumb2 = Image::thumbnail($originalFile, 356, 390)->save($thumbFile2, ['quality' => 80]); // thumbnail file
            $saveThumb3 = Image::thumbnail($originalFile, 137, 130)->save($thumbFile3, ['quality' => 80]); // thumbnail file
            //mage::getImagine()->open($originalFile)->thumbnail(new Box(553, 484))->save($thumbFile1, ['quality' => 90]);

            $model->image = 'images/' . $folderName . '/' . $newFileName; // Size 553 x 484
            $model->imageThumbnail1 = 'images/' . $folderName . '/' . $folderThumbnail1 . '/' . $newFileName; // Size 356 x 390
            $model->imageThumbnail2 = 'images/' . $folderName . '/' . $folderThumbnail2 . '/' . $newFileName; // Size 137 x 130
            $model->productSuppId = Yii::$app->request->get('id');
            //$model->original_name = $file->name;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                echo \yii\helpers\Json::encode($file);
            } else {
                echo \yii\helpers\Json::encode($model->getErrors());
            }
            //}
        } else {
            /* return $this->render('upload', [
              'model' => $model,
              ]); */
            echo 'Test Upload images';
        }

        return false;
    }

}
