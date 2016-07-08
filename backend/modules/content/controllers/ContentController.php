<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\costfit\Content;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends ContentMasterController {

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
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex() {
        if (isset($_GET["contentGroupId"])) {
            $query = Content::find()->where("contentGroupId = " . $_GET["contentGroupId"]);
        } else {
            $query = Content::find();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Content();
        if (isset($_GET["contentGroupId"])) {
            $model->contentGroupId = $_GET["contentGroupId"];
        }
        if (isset($_POST["Content"])) {
            $model->attributes = $_POST["Content"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("Content[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "Content";
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
            if ($model->save()) {
                if (isset($imageObj) && $imageObj->saveAs($urlFile)) {
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
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["Content"])) {
            $model->attributes = $_POST["Content"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            $imageObj = \yii\web\UploadedFile::getInstanceByName("Content[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "Content";
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
                if (isset($_POST["Content"]["imageOld"])) {
                    $model->image = $_POST["Content"]["imageOld"];
                }
            }


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
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
