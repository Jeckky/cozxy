<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductImageSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductImageSuppliersController implements the CRUD actions for ProductImageSuppliers model.
 */
class ProductImageSuppliersController extends SuppliersMasterController {

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
     * Lists all ProductImageSuppliers models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductImageSuppliers::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImageSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductImageSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductImageSuppliers();
        if (isset($_POST["ProductImageSuppliers"])) {
            $model->attributes = $_POST["ProductImageSuppliers"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "ProductImageSuppliers";
                $file = $imageObj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->image = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            }
            $imageThumbnail1Obj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[imageThumbnail1]");
            if (isset($imageThumbnail1Obj) && !empty($imageThumbnail1Obj)) {
                $folderName = "ProductImageSuppliers";
                $file = $imageThumbnail1Obj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->imageThumbnail1 = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            }
            $imageThumbnail2Obj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[imageThumbnail2]");
            if (isset($imageThumbnail2Obj) && !empty($imageThumbnail2Obj)) {
                $folderName = "ProductImageSuppliers";
                $file = $imageThumbnail2Obj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->imageThumbnail2 = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            }
            if ($model->save()) {
                if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                if (isset($imageThumbnail1Obj) && $imageThumbnail1Obj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                if (isset($imageThumbnail2Obj) && $imageThumbnail2Obj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductImageSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductImageSuppliers"])) {
            $model->attributes = $_POST["ProductImageSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "ProductImageSuppliers";
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
                if (isset($_POST["ProductImageSuppliers"]["imageOld"])) {
                    $model->image = $_POST["ProductImageSuppliers"]["imageOld"];
                }
            }
            $imageThumbnail1Obj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[imageThumbnail1]");
            if (isset($imageThumbnail1Obj) && !empty($imageThumbnail1Obj)) {
                $folderName = "ProductImageSuppliers";
                $file = $imageThumbnail1Obj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->imageThumbnail1 = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            } else {
                if (isset($_POST["ProductImageSuppliers"]["imageThumbnail1Old"])) {
                    $model->imageThumbnail1 = $_POST["ProductImageSuppliers"]["imageThumbnail1Old"];
                }
            }
            $imageThumbnail2Obj = \yii\web\UploadedFile::getInstanceByName("ProductImageSuppliers[imageThumbnail2]");
            if (isset($imageThumbnail2Obj) && !empty($imageThumbnail2Obj)) {
                $folderName = "ProductImageSuppliers";
                $file = $imageThumbnail2Obj->name;
                $filenameArray = explode('.', $file);
                $urlFolder = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName . "/";
                $fileName = \Yii::$app->security->generateRandomString(10) . '.' . $filenameArray[1];
                $urlFile = $urlFolder . $fileName;
                $model->imageThumbnail2 = '/' . 'images/' . $folderName . "/" . $fileName;
                if (!file_exists($urlFolder)) {
                    mkdir($urlFolder, 0777);
                }
            } else {
                if (isset($_POST["ProductImageSuppliers"]["imageThumbnail2Old"])) {
                    $model->imageThumbnail2 = $_POST["ProductImageSuppliers"]["imageThumbnail2Old"];
                }
            }


            if ($model->save()) {
                if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                if (isset($imageThumbnail1Obj) && $imageThumbnail1Obj->saveAs($urlFile)) {
                    //Do Some Thing
                }
                if (isset($imageThumbnail2Obj) && $imageThumbnail2Obj->saveAs($urlFile)) {
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
     * Deletes an existing ProductImageSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductImageSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductImageSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductImageSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
