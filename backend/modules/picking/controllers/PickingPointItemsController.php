<?php

namespace backend\modules\picking\controllers;

use Yii;
use common\models\costfit\PickingPointItems;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PickingPointItemsController implements the CRUD actions for PickingPointItems model.
 */
class PickingPointItemsController extends PickingMasterController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PickingPointItems models.
     * @return mixed
     */
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider([
            'query' => PickingPointItems::find()->where("pickingId = " . Yii::$app->request->get('pickingId')),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PickingPointItems model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PickingPointItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PickingPointItems();

        /*
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->pickingItemsId]);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          } */
        if (isset($_GET['pickingId'])) {
            $model->pickingId = Yii::$app->request->get('pickingId');
        }
        if (isset($_POST["PickingPointItems"])) {
            $model->attributes = $_POST["PickingPointItems"];
            $model->pickingId = $model->pickingId;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                //return $this->redirect(['index']);
                return $this->redirect(['view', 'id' => $model->pickingItemsId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PickingPointItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pickingItemsId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PickingPointItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {

        $pickingId = Yii::$app->request->get('pickingId');
        $this->findModel($id)->delete();

        return $this->redirect(['index?pickingId=' . $pickingId]);
    }

    /**
     * Finds the PickingPointItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PickingPointItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PickingPointItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
