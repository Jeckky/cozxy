<?php

namespace backend\modules\led\controllers;

use Yii;
use common\models\costfit\Led;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LedController implements the CRUD actions for Led model.
 */
class LedController extends LedMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Led models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Led();
        $dataProvider = new ActiveDataProvider([
            'query' => Led::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Led model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Led model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Led();
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (isset($_POST["Led"])) {
            $model->attributes = $_POST["Led"];
            $model->createDateTime = new \yii\db\Expression('Now()');
            $model->updateDateTime = new \yii\db\Expression('Now()');
            $model->status = 1;
            if ($model->save(false)) {
                return $this->redirect($baseUrl . '/led/led');
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Led model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($baseUrl . '/led/led');
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Led model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        return $this->redirect($baseUrl . '/led/led');
    }

    /**
     * Finds the Led model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Led the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Led::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
