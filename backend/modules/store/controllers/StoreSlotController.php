<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreSlot;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreSlotController implements the CRUD actions for StoreSlot model.
 */
class StoreSlotController extends BackendMasterController
{

    public function behaviors()
    {
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
     * Lists all StoreSlot models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_GET['storeId'])) {
            $query = StoreSlot::find()->where("storeId =" . $_GET["storeId"] . " AND level = 1");
        }

        if (isset($_GET['parentId'])) {
            if (!isset($_GET['level'])) {
                $query = StoreSlot::find()->where("parentId =" . $_GET["parentId"]);
            } else {

                $query = StoreSlot::find()->where("parentId =" . $_GET["parentId"] . " AND level =" . $_GET["level"]);
            }
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreSlot model.
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
     * Creates a new StoreSlot model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoreSlot();
        if (isset($_GET['storeId'])) {
            $model->storeId = $_GET["storeId"];
        }
        if (isset($_GET['parentId'])) {
            $model->parentId = $_GET["parentId"];
            $model->storeId = $model->parent->storeId;
        }
        if (isset($_GET['level'])) {
            $model->level = $_GET['level'];
        }
        if (isset($_POST["StoreSlot"])) {
            $model->attributes = $_POST["StoreSlot"];
            $model->createDateTime = new \yii\db\Expression('NOW()');


            if ($model->save()) {
                if (isset($_GET['storeId'])) {
                    return $this->redirect(['index', 'storeId' => $model->storeId]);
                } else {
                    if (isset($_GET["parentId"])) {
                        if (!isset($_GET['level'])) {
                            return $this->redirect(['index', 'parentId' => $model->parentId]);
                        } else {
                            return $this->redirect(['index', 'parentId' => $model->parentId, 'level' => $model->level]);
                        }
                    } else {
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StoreSlot model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST["StoreSlot"])) {
            $model->attributes = $_POST["StoreSlot"];
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
     * Deletes an existing StoreSlot model.
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
     * Finds the StoreSlot model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StoreSlot the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoreSlot::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
