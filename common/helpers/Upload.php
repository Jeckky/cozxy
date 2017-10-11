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
 * Upload 15/12/2016 By Taninut.Bm
 */
class Upload
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//
        ];
    }

    /*
     * Upload ครั้งละรูป
     */

    public static function UploadBasic($fileName, $folderName, $uploadPath, $width, $height)
    {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        if(isset($file)) {
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile
            $thumbFile = $uploadPath . '/' . $newFileName;
            $saveThumb1 = Image::thumbnail($originalFile, $width, $height)->save($thumbFile, ['quality' => 80]); // thumbnail file

            return $newFileName;
        } else {
            return NULL;
        }
    }

    /*
     * Upload ครั้งละหลายรูป Demo
     * ยังไม่ได้เทส
     * 6/1/2017
     */

    public static function UploadMultiple($fileName, $folderName, $uploadPath, $width, $height)
    {
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;

        if(isset($_FILES['image'])) {
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

    public static function UploadSuppliers($model)
    {
//$uploadPath = Yii::getAlias('@root') . '/uploads/';
        $folderName = "ProductImageSuppliers"; //  Size 553 x 484
        $folderThumbnail = "thumbnail"; // Size 553 x 484
        $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
        $folderThumbnail2 = "thumbnail2"; // Size 137 x 130

        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        $uploadPath1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail;
        $uploadPath2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail1;
        $uploadPath3 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . '/' . $folderThumbnail2;
        if(isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $original_name = $file->baseName;
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;

            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile

            $thumbFile0 = $uploadPath . '/' . $newFileName; // Size 553 x 484
            $thumbFile1 = $uploadPath1 . '/' . $newFileName;
            $thumbFile2 = $uploadPath2 . '/' . $newFileName; // Size 356 x 390
            $thumbFile3 = $uploadPath3 . '/' . $newFileName; // Size 137 x 130

            /* $saveThumb0 = Image::thumbnail($originalFile, 553, 484)->save($thumbFile0, ['quality' => 80]);
              $saveThumb2 = Image::thumbnail($originalFile, 356, 390)->save($thumbFile2, ['quality' => 80]); // thumbnail file
              $saveThumb3 = Image::thumbnail($originalFile, 137, 130)->save($thumbFile3, ['quality' => 80]); // thumbnail file */
            $saveThumb0 = Image::thumbnail($originalFile, 1500, 1000)->save($thumbFile0, ['quality' => 100]);
            $saveThumb2 = Image::thumbnail($originalFile, 262, 262)->save($thumbFile2, ['quality' => 100]); // thumbnail file
            $saveThumb3 = Image::thumbnail($originalFile, 131, 131)->save($thumbFile3, ['quality' => 100]); // thumbnail file
            //mage::getImagine()->open($originalFile)->thumbnail(new Box(553, 484))->save($thumbFile1, ['quality' => 90]);

            $model->image = 'images/' . $folderName . '/' . $newFileName; // Size 553 x 484
            $model->imageThumbnail1 = 'images/' . $folderName . '/' . $folderThumbnail1 . '/' . $newFileName; // Size 356 x 390
            $model->imageThumbnail2 = 'images/' . $folderName . '/' . $folderThumbnail2 . '/' . $newFileName; // Size 137 x 130
            if((new \ReflectionClass($model))->getShortName() != "ProductImage") {
                $model->productSuppId = Yii::$app->request->get('id');
                $model->ordering = \common\models\costfit\ProductImageSuppliers::findMaxOrdering($model->productSuppId) + 1;
            }
            //$model->original_name = $file->name;
            $model->title = 'suppliers';
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if($model->save(FALSE)) {
                echo \yii\helpers\Json::encode($file);
            } else {
                echo \yii\helpers\Json::encode($model->getErrors());
            }
            //}
        } else {

            /* return $this->render('upload', [
              'model' => $model,
              ]); */
            echo "No Detect Image Upload";
        }

        return false;
    }

    /*
     * Upload File csv ของ Category ครั้งละไฟล์
     * Create date : 16/1/2017
     * By Taninut.BM
     * emial : taninut.b@cozxy.com , sodapew17@gmial.com
     */

    public static function UploadCSVCategory($fileName, $folderName, $uploadPath)
    {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        //echo '<pre>';
        /*
          yii\web\UploadedFile Object
          (
          [name] => import product - cozxy - category.csv
          [tempName] => C:\Users\it\AppData\Local\Temp\php33F9.tmp
          [type] => application/octet-stream
          [size] => 1341
          [error] => 0
          )
         */
        $ext = explode('.', $file->name);
        //echo current($ext) . "<br>"; //: Run example » แสดงค่าของ ตัวแรก
        //echo end($ext); //Run example » แสดงค่าของ ตัวสุดท้าย
        if(end($ext) == 'csv') {
            $upload = $file->saveAs($uploadPath . '/' . $newFileName);
            if($upload) {
                $row = 1;
                define('CSV_PATH', $uploadPath);
                $csv_file = CSV_PATH . '/' . $newFileName;
                $handle = fopen($csv_file, "r");
                //print_r($handle);
                //exit();
                if($handle) {
                    $row = 1;
                    //echo '<pre>';
                    while(($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                        //print_r(fgetcsv($handle, 1000, ","));
                        if($row > 1) {
                            $newModel = new \common\models\costfit\ImportCategory;
                            $hasil = explode(",", $line[0]);
                            //print_r($hasil[1]);
                            $getModel = \common\models\costfit\ImportCategory::find()->where('categoryId=' . $hasil[0])->one();
                            if(isset($getModel)) {
                                //echo 'Yes';
                                //$getModel->categoryId = isset($hasil[0]) ? $hasil[0] : '';
                                $getModel->title = isset($hasil[1]) ? $hasil[1] : '';
                                $getModel->parentId = isset($hasil[2]) ? $hasil[2] : '';
                                $getModel->save(FALSE);
                            } else {
                                //echo 'No !!';
                                $newModel->categoryId = isset($hasil[0]) ? $hasil[0] : '';
                                $newModel->title = isset($hasil[1]) ? $hasil[1] : '';
                                $newModel->parentId = isset($hasil[2]) ? $hasil[2] : '';
                                //print_r($newModel);
                                $newModel->save(FALSE);
                            }
                        }
                        $row++;
                    }
                }
                fclose($handle);

                return 'success';
            }
        } else {
            return 'warning';
        }
    }

    /*
     * Upload File csv ของ Brand ครั้งละไฟล์
     * Create date : 16/1/2017
     * By Taninut.BM
     * emial : taninut.b@cozxy.com , sodapew17@gmial.com
     */

    public static function UploadCSVBrand($fileName, $folderName, $uploadPath)
    {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $ext = explode('.', $file->name);
        if(end($ext) == 'csv') {
            $upload = $file->saveAs($uploadPath . '/' . $newFileName);
            if($upload) {
                $row = 1;
                define('CSV_PATH', $uploadPath);
                $csv_file = CSV_PATH . '/' . $newFileName;
                $handle = fopen($csv_file, "r");
                if($handle) {
                    $row = 1;
                    //echo '<pre>';
                    while(($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                        //print_r($line);
                        if($row > 1) {
                            $newModel = new \common\models\costfit\ImportBrand;
                            $hasil = explode(",", $line[0]);
                            $getModel = \common\models\costfit\ImportBrand::find()->where('brandId=' . $hasil[0])->one();
                            if(isset($getModel)) {
                                //echo 'Yes';
                                //$getModel->categoryId = isset($hasil[0]) ? $hasil[0] : '';
                                $getModel->brandId = isset($hasil[0]) ? $hasil[0] : '';
                                $getModel->save(FALSE);
                            } else {
                                //echo 'No !!';
                                //print_r($hasil);
                                $newModel->brandId = isset($hasil[0]) ? $hasil[0] : '';
                                $newModel->title = isset($hasil[1]) ? $hasil[1] : '';
                                $newModel->save(FALSE);
                            }
                            //exit();
                        }
                        $row++;
                    }
                }
                fclose($handle);

                return 'success';
            }
        } else {
            return 'warning';
        }
    }

    /*
     * Upload File csv ของ Product ครั้งละไฟล์
     * Create date : 16/1/2017
     * By Taninut.BM
     * emial : taninut.b@cozxy.com , sodapew17@gmial.com
     */

    public static function UploadCSVProduct($fileName, $folderName, $uploadPath)
    {
        $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
        $ext = explode('.', $file->name);
        if(end($ext) == 'csv') {
            $upload = $file->saveAs($uploadPath . '/' . $newFileName);
            if($upload) {
                $row = 1;
                define('CSV_PATH', $uploadPath);
                $csv_file = CSV_PATH . '/' . $newFileName;
                $handle = fopen($csv_file, "r");
                if($handle) {
                    $row = 1;
                    while(($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                        //print_r($line);
                        if($row > 1) {
                            $newModel = new \common\models\costfit\ImportProduct();
                            $hasil = explode(",", $line[0]);
                            //print_r($hasil[1]);
                            /*
                             * product, brandId,categoryId,isbn,code,title,optionName,shortDescription,description,specification,
                             * width,height,depth,weight,price,unit,smallUnit,tags
                             */

                            $getModel = \common\models\costfit\ImportProduct::find()->where('productId=' . $hasil[0])->one();
                            if(isset($getModel)) {
                                //echo 'Yes';
                                $getModel->brandId = isset($hasil[1]) ? $hasil[1] : '';
                                $getModel->categoryId = isset($hasil[2]) ? $hasil[2] : '';
                                $getModel->isbn = isset($hasil[3]) ? $hasil[3] : '';
                                $getModel->code = isset($hasil[4]) ? $hasil[4] : '';
                                $getModel->title = isset($hasil[5]) ? $hasil[5] : '';
                                $getModel->optionName = isset($hasil[6]) ? $hasil[6] : '';
                                $getModel->shortDescription = isset($hasil[7]) ? $hasil[7] : '';
                                $getModel->description = isset($hasil[8]) ? $hasil[8] : '';
                                $getModel->specification = isset($hasil[9]) ? $hasil[9] : '';
                                $getModel->width = isset($hasil[10]) ? $hasil[10] : '';
                                $getModel->height = isset($hasil[11]) ? $hasil[11] : '';
                                $getModel->depth = isset($hasil[12]) ? $hasil[12] : '';
                                $getModel->weight = isset($hasil[13]) ? $hasil[13] : '';
                                $getModel->price = isset($hasil[14]) ? $hasil[14] : '';
                                $getModel->unit = isset($hasil[15]) ? $hasil[16] : '';
                                $getModel->smallUnit = isset($hasil[16]) ? $hasil[16] : '';
                                $getModel->tags = isset($hasil[17]) ? $hasil[17] : '';
                                $getModel->save(FALSE);
                            } else {
                                //echo 'No!!';
                                $newModel->productId = isset($hasil[0]) ? $hasil[0] : '';
                                $newModel->brandId = isset($hasil[1]) ? $hasil[1] : '';
                                $newModel->categoryId = isset($hasil[2]) ? $hasil[2] : '';
                                $newModel->isbn = isset($hasil[3]) ? $hasil[3] : '';
                                $newModel->code = isset($hasil[4]) ? $hasil[4] : '';
                                $newModel->title = isset($hasil[5]) ? $hasil[5] : '';
                                $newModel->optionName = isset($hasil[6]) ? $hasil[6] : '';
                                $newModel->shortDescription = isset($hasil[7]) ? $hasil[7] : '';
                                $newModel->description = isset($hasil[8]) ? $hasil[8] : '';
                                $newModel->specification = isset($hasil[9]) ? $hasil[9] : '';
                                $newModel->width = isset($hasil[10]) ? $hasil[10] : '';
                                $newModel->height = isset($hasil[11]) ? $hasil[11] : '';
                                $newModel->depth = isset($hasil[12]) ? $hasil[12] : '';
                                $newModel->weight = isset($hasil[13]) ? $hasil[13] : '';
                                $newModel->price = isset($hasil[14]) ? $hasil[14] : '';
                                $newModel->unit = isset($hasil[15]) ? $hasil[16] : '';
                                $newModel->smallUnit = isset($hasil[16]) ? $hasil[16] : '';
                                $newModel->tags = isset($hasil[17]) ? $hasil[17] : '';
                                $newModel->save(FALSE);
                            }
                        }
                        $row++;
                    }
                }
                fclose($handle);

                return 'success';
            }
        }

        return 'warning';
    }

    public static function UploadProductImage($model, $ordering)
    {
        $imagePath = 'images/ProductImage/';
        $thumbnail1Path = $imagePath . 'thumbnail1/';
        $thumbnail2Path = $imagePath . 'thumbnail2/';

        $uploadBasePath = Yii::$app->basePath . '/web/';
        $uploadPath = $uploadBasePath . $imagePath;
        $uploadPath1 = $uploadBasePath . $thumbnail1Path;
        $uploadPath2 = $uploadBasePath . $thumbnail2Path;
        if(isset($_FILES['image'])) {
            $file = \yii\web\UploadedFile::getInstanceByName('image');
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;

            $file->saveAs($uploadPath . $newFileName);
            $originalFile = $uploadPath . $newFileName; // originalFile

            $thumbFile = $uploadPath . $newFileName;
            $thumbFile1 = $uploadPath1 . $newFileName;
            $thumbFile2 = $uploadPath2 . $newFileName;

            Image::thumbnail($originalFile, 1500, 1000)->save($thumbFile, ['quality' => 100]); // large image
            Image::thumbnail($originalFile, 262, 262)->save($thumbFile1, ['quality' => 80]); // thumbnail 1 file
            Image::thumbnail($originalFile, 131, 131)->save($thumbFile2, ['quality' => 80]); // thumbnail 2 file

            $model->image = $imagePath . $newFileName;
            $model->imageThumbnail1 = $thumbnail1Path . $newFileName;
            $model->imageThumbnail2 = $thumbnail2Path . $newFileName;
            $model->ordering = $ordering;
            $model->title = $file->baseName;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if($model->save(FALSE)) {
                echo \yii\helpers\Json::encode($file);
            } else {
                echo \yii\helpers\Json::encode($model->getErrors());
            }
            //}
        } else {

            /* return $this->render('upload', [
              'model' => $model,
              ]); */
            echo "No Detect Image Upload";
        }

        return false;
    }

}
