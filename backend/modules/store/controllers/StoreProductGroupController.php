<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProductGroup;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreProductGroupController implements the CRUD actions for StoreProductGroup model.
 */
class StoreProductGroupController extends StoreMasterController {

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
     * Lists all StoreProductGroup models.
     * @return mixed
     */
    public function actionIndex() {
        $baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
        if (!isset(Yii::$app->user->identity->userId)) {
            return $this->redirect($baseUrl . '/auth');
        }
        $query = StoreProductGroup::find()->where("status=1");
        $passQc = StoreProductGroup::find()->where("status!=1 order by receiveDate DESC")->all();
        if (isset($_GET['fromDate']) && $_GET['fromDate'] != '') {
            //throw new \yii\base\Exception('aaa');
            if (isset($_GET['toDate']) && $_GET['toDate'] != '') {
                $passQc = StoreProductGroup::find()->where("receiveDate BETWEEN '" . $_GET['fromDate'] . "' and '" . $_GET['toDate'] . "' and status!=1 order by receiveDate DESC")->all();
            } else {
                $passQc = StoreProductGroup::find()->where("receiveDate>='" . $_GET['fromDate'] . "' and status!=1 order by receiveDate DESC")->all();
            }
        } else {
            // throw new \yii\base\Exception('bbbb');
            if (isset($_GET['toDate']) && $_GET['toDate'] != '') {
                $passQc = StoreProductGroup::find()->where("receiveDate<='" . $_GET['toDate'] . "' and status!=1 order by receiveDate DESC")->all();
            } else {
                $passQc = StoreProductGroup::find()->where("status!=1 order by receiveDate DESC")->all();
            }
        }
        //throw new \yii\base\Exception('cccc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'passQc' => $passQc
        ]);
    }

    /**
     * Displays a single StoreProductGroup model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreProductGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StoreProductGroup();
        if (isset($_POST["StoreProductGroup"])) {
            $model->attributes = $_POST["StoreProductGroup"];
            $model->poNo = StoreProductGroup::genPoNo();
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
     * Updates an existing StoreProductGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["StoreProductGroup"])) {
            $model->attributes = $_POST["StoreProductGroup"];
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
     * Deletes an existing StoreProductGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoreProductGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StoreProductGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StoreProductGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
