<?php

namespace backend\modules\picking\controllers;

use Yii;
use common\models\costfit\PickingPoint;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PickingController implements the CRUD actions for PickingPoint model.
 */
class PickingController extends PickingMasterController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PickingPoint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PickingPoint::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PickingPoint model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PickingPoint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PickingPoint();
        /*
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
          // return $this->redirect(['view', 'id' => $model->pickingId]);
          } else {
          return $this->render('create', [
          'model' => $model,
          ]);
          //echo 'test 2';
          } */
        if (isset($_POST["PickingPoint"])) {

            $model->attributes = $_POST["PickingPoint"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save(FALSE)) {
                //return $this->redirect(['index']);
                return $this->redirect(['view', 'id' => $model->pickingId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PickingPoint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pickingId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PickingPoint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PickingPoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PickingPoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PickingPoint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVirtual()
    {
        $model = new PickingPoint();
        $pickingPoints = PickingPoint::find()->all();
        return $this->render('virtual', [
            'model' => $model,
            'pickingPoints' => $pickingPoints,
        ]);
    }

}
