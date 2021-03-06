<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\Upload;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UploadController implements the CRUD actions for Upload model.
 */
class UploadController extends SuppliersMasterController {

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
     * Lists all Upload models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Upload::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Upload model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Upload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Upload();
        if (isset($_POST["Upload"])) {
            $model->attributes = $_POST["Upload"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Upload model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Upload"])) {
            $model->attributes = $_POST["Upload"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Upload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Upload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Upload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Upload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload() {
        if (Yii::$app->user->identity->type != 2 && Yii::$app->user->identity->type != 3) {
            header("location: /auth");
            exit(0);
        }
        $productSuppId = Yii::$app->request->get('id');
        //$model = new \common\models\costfit\productImageSuppliers();
        $model = new \common\models\costfit\Upload();
        /*
         * helpers Upload
         * path : common/helpers/Upload.php
         * use : Upload::UploadSuppliers($model)
         * กรณีพิเศษ
         */
        Upload::UploadSuppliers($model);
    }

}
