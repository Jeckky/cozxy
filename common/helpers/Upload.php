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
 * Suppliers 15/12/2016 By Taninut.Bm
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

    /*
     * Upload ครั้งละรูป
     */

    public static function UploadBasic($fileName, $folderName, $uploadPath, $width, $height) {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $file->saveAs($uploadPath . '/' . $newFileName);
        $originalFile = $uploadPath . '/' . $newFileName; // originalFile
        $thumbFile = $uploadPath . '/' . $newFileName;
        $saveThumb1 = Image::thumbnail($originalFile, $width, $height)->save($thumbFile, ['quality' => 80]); // thumbnail file
        return $newFileName;
    }

    /*
     * Upload ครั้งละหลายรูป Demo
     * ยังไม่ได้เทส
     * 6/1/2017
     */

    public static function UploadMultiple($fileName, $folderName, $uploadPath, $width, $height) {
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;

        if (isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile
            $thumbFile0 = $uploadPath . '/' . $newFileName; // Size $width x $height
            $saveThumb0 = Image::thumbnail($originalFile, $width, $height)->save($thumbFile0, ['quality' => 80]);

            return $newFileName;
        } else {
            echo 'Test Upload images';
        }

        return false;
    }

    /*
     * Upload ครั้งละหลายรูป ของ Suppliers
     */

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

    /*
     * Upload ครั้งละรูป
     */

    public static function UploadCSV($fileName, $folderName, $uploadPath, $width, $height) {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $file->saveAs($uploadPath . '/' . $newFileName);
        $originalFile = $uploadPath . '/' . $newFileName; // originalFile
        $thumbFile = $uploadPath . '/' . $newFileName;
        $saveThumb1 = Image::thumbnail($originalFile, $width, $height)->save($thumbFile, ['quality' => 80]); // thumbnail file
        return $newFileName;
    }

    public function actionUploadxxx() {
        $model = new CsvForm;

        if ($model->load(Yii::$app->request->post())) {
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            $filename = 'Data.' . $file->extension;
            $upload = $file->saveAs('uploads/' . $filename);
            if ($upload) {
                define('CSV_PATH', 'uploads/');
                $csv_file = CSV_PATH . $filename;
                $filecsv = file($csv_file);
                print_r($filecsv);
                foreach ($filecsv as $data) {
                    $modelnew = new Mahasiswa;
                    $hasil = explode(",", $data);
                    $nim = $hasil[0];
                    $nama = $hasil[1];
                    $jurusan = $hasil[2];
                    $angkatan = $hasil[3];
                    $alamat = $hasil[4];
                    $foto = $hasil[5];
                    $modelnew->nim = $nim;
                    $modelnew->nama = $nama;
                    $modelnew->jurusan = $jurusan;
                    $modelnew->angkatan = $angkatan;
                    $modelnew->alamat = $alamat;
                    $modelnew->foto = $foto;
                    $modelnew->save();
                }
                unlink('uploads/' . $filename);
                return $this->redirect(['site/index']);
            }
        } else {
            return $this->render('upload', ['model' => $model]);
        }
    }

}
