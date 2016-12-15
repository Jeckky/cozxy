<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\Brand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

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
            $file = \yii\web\UploadedFile::getInstanceByName('Brand[image]');
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile
            $thumbFile = $uploadPath . '/' . $newFileName;
            $saveThumb1 = Image::thumbnail($originalFile, 164, 120)->save($thumbFile, ['quality' => 80]); // thumbnail file
            $model->attributes = $_POST["Brand"];
            $model->image = '/' . 'images/' . $folderName . "/" . $newFileName;
            $model->userId = Yii::$app->user->identity->userId;
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
        $folderName = "Brand"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_POST["Brand"])) {
            $file = \yii\web\UploadedFile::getInstanceByName('Brand[image]');
            $newFileName = \Yii::$app->security->generateRandomString() . '.' . $file->extension;
            $file->saveAs($uploadPath . '/' . $newFileName);
            $originalFile = $uploadPath . '/' . $newFileName; // originalFile
            $thumbFile = $uploadPath . '/' . $newFileName;
            $saveThumb1 = Image::thumbnail($originalFile, 164, 120)->save($thumbFile, ['quality' => 80]); // thumbnail file
            $model->attributes = $_POST["Brand"];
            $model->image = '/' . 'images/' . $folderName . "/" . $newFileName;
            $model->userId = Yii::$app->user->identity->userId;
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            /* $imageObj = \yii\web\UploadedFile::getInstanceByName("Brand[image]");
              if (isset($imageObj) && !empty($imageObj)) {
              $folderName = "Brand";
              $file = $imageObj->name;
              $filenameArray = explode('.', $file);
              $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
              $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
              $urlFile = $urlFolder . $fileName;
              $model->image = '/' . 'images/' . $folderName . "/" . $fileName;
              if (!file_exists($urlFolder)) {
              mkdir($urlFolder, 0777);
              }
              } else {
              if (isset($_POST["Brand"]["imageOld"])) {
              $model->image = $_POST["Brand"]["imageOld"];
              }
              } */


            if ($model->save()) {
                if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                    //Do Some Thing
                }
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
