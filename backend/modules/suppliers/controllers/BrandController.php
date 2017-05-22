<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\Brand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\web\UploadedFile;
//use yii\imagine\Image;
//use Imagine\Gd;
//use Imagine\Image\Box;
//use Imagine\Image\BoxInterface;
use common\helpers\Upload;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends SuppliersMasterController {

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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Brand::find()->orderBy('brandId desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
//echo Yii::$app->user->identity->userId;
        $model = new Brand();
        $folderName = "Brand"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_POST["Brand"])) {
            $model->attributes = $_POST["Brand"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->createDateTime = '0000-00-00 00:00:00';
            /*
             * Upload ครั้งละรูป
             * helpers Upload
             * path : common/helpers/Upload.php
             * use : Upload::uploadBasic($fileName, $folderName, $uploadPath, $width, $height)
             */
            //echo 'xxx : ' . isset($_POST["Brand"]['image']) ? 'Yes' : 'No';
            $imageObj = \yii\web\UploadedFile::getInstanceByName("Brand[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $newFileName = Upload::UploadBasic('Brand[image]', $folderName, $uploadPath, '112', '64');
                $model->image = '/' . 'images/' . $folderName . "/" . $newFileName;
            } else {
                echo 'No';
            }

            $model->userId = Yii::$app->user->identity->userId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                //if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                //Do Some Thing
                //}
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelImage = $this->findModel($id);
        $folderName = "Brand"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_POST["Brand"])) {
            /*
             * Upload ครั้งละรูป
             * helpers Upload
             * path : common/helpers/Upload.php
             * use : Upload::uploadBasic($fileName, $folderName, $uploadPath, $width, $height)
             */
            $model->attributes = $_POST["Brand"];
            $imageObj = \yii\web\UploadedFile::getInstanceByName("Brand[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $newFileName = Upload::UploadBasic('Brand[image]', $folderName, $uploadPath, '164', '120');
                $model->image = '/' . 'images/' . $folderName . "/" . $newFileName;
            } else {
                $model->image = $modelImage->image;
            }

            $model->userId = Yii::$app->user->identity->userId;
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            if ($model->save()) {
                //if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                //Do Some Thing
                //}
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
