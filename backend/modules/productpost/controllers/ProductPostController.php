<?php

namespace backend\modules\productpost\controllers;

use Yii;
use common\models\costfit\ProductPost;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductPostController implements the CRUD actions for ProductPost model.
 */
class ProductPostController extends ProductPostMasterController {

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
     * Lists all ProductPost models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductPost::find()->where("userId = ''"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPost model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPost model.
     * If creation is successful, the browser will be redirected to the 'view

      ' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPost();
        $folderName = "story"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->title = $_POST["ProductPost"]['title'];
            //$model->shortDescription = $_POST["ProductPost"]['shortDescription'];
            $model->description = $_POST["ProductPost"]['description'];
            $model->productSelfId = 0;
            $model->userId = 0;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductPost[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $newFileName = \common\helpers\Upload::UploadBasic('ProductPost[image]', $folderName, $uploadPath, '262', '262');
                $model->image = '/' . 'images/' . $folderName . "/" . $newFileName;
            } else {
                echo 'No';
            }
            if ($model->save(FALSE)) {

                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductPost model.
     * If update is successful, the browser will be redirected to the 'view

      ' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $modelImage = $this->findModel($id);
        $folderName = "story"; //  Size 553 x 484
        $uploadPath = \Yii::$app->getBasePath() . '/web/' . 'images/' . $folderName;
        if (isset($_POST["ProductPost"])) {
            $model->attributes = $_POST["ProductPost"];
            $model->title = $_POST["ProductPost"]['title'];
            //$model->shortDescription = $_POST["ProductPost"]['shortDescription'];
            $model->description = $_POST["ProductPost"]['description'];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ProductPost[image]");

            if (isset($imageObj) && !empty($imageObj)) {
                //if ($imageObj->name != '') {
                $newFileName = \common\helpers\Upload::UploadBasic('ProductPost[image]', $folderName, $uploadPath, '262', '262');
                $model->image = '/' . 'images/' . $folderName . $newFileName;
                //}
            } else {
                //echo 'No';
                $model->image = $modelImage->image;
            }
            if ($model->save(FALSE)) {

                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductPost model.
     * If deletion is successful, the browser will be redirected to the 'index

      ' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
