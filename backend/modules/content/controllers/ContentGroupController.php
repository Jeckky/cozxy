<?php

namespace backend\modules\content\controllers;

use Yii;
use common\models\costfit\ContentGroup;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentGroupController implements the CRUD actions for ContentGroup model.
 */
class ContentGroupController extends ContentMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContentGroup models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ContentGroup::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContentGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ContentGroup();
        if (isset($_POST["ContentGroup"])) {
            $model->attributes = $_POST["ContentGroup"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $imageObj = \yii\web\UploadedFile::getInstanceByName("ContentGroup[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "ContentGroup";
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
     * Updates an existing ContentGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ContentGroup"])) {
            $model->attributes = $_POST["ContentGroup"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');

            $imageObj = \yii\web\UploadedFile::getInstanceByName("ContentGroup[image]");
            if (isset($imageObj) && !empty($imageObj)) {
                $folderName = "ContentGroup";
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
                if (isset($_POST["ContentGroup"]["imageOld"])) {
                    $model->image = $_POST["ContentGroup"]["imageOld"];
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
     * Deletes an existing ContentGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContentGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ContentGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ContentGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
