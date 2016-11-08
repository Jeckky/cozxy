<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductImage;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductImageController implements the CRUD actions for ProductImage model.
 */
class ProductImageController extends ProductMasterController {

    public function behaviors() {
        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductImage models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductImage::find()->where("productId =" . $_GET["productId"]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImage model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductImage();
        if (isset($_GET['productId'])) {
            $model->productId = $_GET["productId"];
        }
        if (isset($_POST["ProductImage"])) {
            $model->attributes = $_POST["ProductImage"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductImage[image]");

            if (isset($imageObj) && !empty($imageObj)) {
                $imageObjImage = Yii::$app->image->load($imageObj->tempName);
//                throw news \yii\base\Exception(print_r($imageObjImage, true));
                $folderName = "ProductImage"; //  Size 553 x 484
                $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
                $folderThumbnail2 = "thumbnail2"; // Size 137 x 130
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                //Image Size 553 x 484 field image
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
                $model->image = 'images/' . $folderName . "/" . $fileName;
                //Image Size 553 x 484 field image
                //
                //Image Size 356 x 390 field imageThumbnail1
                $urlFolder1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/" . $folderThumbnail1 . "/";
                $fileName1 = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile1 = $urlFolder1 . $fileName1;
                if (!file_exists($urlFolder1)) {
                    mkdir($urlFolder1, 0777);
                }
                $model->imageThumbnail1 = 'images/' . $folderName . "/" . $folderThumbnail1 . "/" . $fileName1;
                //Image Size 356 x 390 field  imageThumbnail1
                //
                //Image Size 137 x 130  field  imageThumbnail2
                $urlFolder2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/" . $folderThumbnail2 . "/";
                $fileName2 = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile2 = $urlFolder2 . $fileName2;
                if (!file_exists($urlFolder2)) {
                    mkdir($urlFolder2, 0777);
                }
                $model->imageThumbnail2 = 'images/' . $folderName . "/" . $folderThumbnail2 . "/" . $fileName2;
                //Image Size 137 x 130  field  imageThumbnail2
            //
            }
            if ($model->save()) {
                if (isset($imageObj)) {
                    //Image Size 553 x 484 field image

                    $imageObjImage->resize(553, 484);
                    $imageObjImage->save($urlFile);
                    //Image Size 553 x 484 field image
                    //
                    //Image Size 356 x 390 field imageThumbnail1
                    $imageObjImage->resize(356, 390);
                    $imageObjImage->save($urlFile1);
                    //Image Size 356 x 390 field imageThumbnail1
                    //
                    //Image Size 137 x 130  field  imageThumbnail2
                    $imageObjImage->resize(137, 130);
                    $imageObjImage->save($urlFile2);
                    //Image Size 137 x 130  field  imageThumbnail2
                }
                return $this->redirect(['index?productId=' . $model->productId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductImage"])) {
            $model->attributes = $_POST["ProductImage"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductImage[image]");

            if (isset($imageObj) && !empty($imageObj)) {
                $imageObjImage = Yii::$app->image->load($imageObj->tempName);
//                throw new \yii\base\Exception(print_r($imageObjImage, true));
                $folderName = "ProductImage"; //  Size 553 x 484
                $folderThumbnail1 = "thumbnail1"; // Size 356 x 390
                $folderThumbnail2 = "thumbnail2"; // Size 137 x 130
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                //Image Size 553 x 484 field image
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
                $model->image = 'images/' . $folderName . "/" . $fileName;
                //Image Size 553 x 484 field image
                //
                //Image Size 356 x 390 field imageThumbnail1
                $urlFolder1 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/" . $folderThumbnail1 . "/";
                $fileName1 = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile1 = $urlFolder1 . $fileName1;
                if (!file_exists($urlFolder1)) {
                    mkdir($urlFolder1, 0777);
                }
                $model->imageThumbnail1 = 'images/' . $folderName . "/" . $folderThumbnail1 . "/" . $fileName1;
                //Image Size 356 x 390 field  imageThumbnail1
                //
                //Image Size 137 x 130  field  imageThumbnail2
                $urlFolder2 = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/" . $folderThumbnail2 . "/";
                $fileName2 = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile2 = $urlFolder2 . $fileName2;
                if (!file_exists($urlFolder2)) {
                    mkdir($urlFolder2, 0777);
                }
                $model->imageThumbnail2 = 'images/' . $folderName . "/" . $folderThumbnail2 . "/" . $fileName2;
                //Image Size 137 x 130  field  imageThumbnail2
            } else {
                if (isset($_POST["ProductImage"]["imageOld"])) {
                    $model->image = $_POST["ProductImage"]["imageOld"];
                }
                if (isset($_POST["ProductImage"]["imageThumbnail1Old"])) {
                    $model->imageThumbnail1 = $_POST["ProductImage"]["imageThumbnail1Old"];
                }
                if (isset($_POST["ProductImage"]["imageThumbnail2Old"])) {
                    $model->imageThumbnail2 = $_POST["ProductImage"]["imageThumbnail2Old"];
                }
            }


            if ($model->save()) {
                if (isset($imageObj)) {
                    //Image Size 553 x 484 field image
                    $imageObjImage->resize(553, 484);
//                    $imageObjImage->crop(500, 500);
//                    $watermark = Yii::$app->image->load(\Yii::$app->basePath . "/web/images/ProductImage/Q0mGZ5bBQ5.png");
//                    $imageObjImage->watermark($watermark, NULL, NULL, $opacity = 30);
                    $imageObjImage->save($urlFile);
                    //Image Size 553 x 484 field image
                    //
                    //Image Size 356 x 390 field imageThumbnail1
                    $imageObjImage->resize(356, 390);
                    $imageObjImage->save($urlFile1);
                    //Image Size 356 x 390 field imageThumbnail1
                    //
                    //Image Size 137 x 130  field  imageThumbnail2
                    $imageObjImage->resize(137, 130);
                    $imageObjImage->save($urlFile2);
                    //Image Size 137 x 130  field  imageThumbnail2
                }
                return $this->redirect(['index?productId=' . $model->productId]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
