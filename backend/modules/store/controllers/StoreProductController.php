<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProduct;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreProductController implements the CRUD actions for StoreProduct model.
 */
class StoreProductController extends StoreMasterController {

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
     * Lists all StoreProduct models.
     * @return mixed
     */
    public function actionIndex() {
        $storeProductGroupId = '';
        if (isset($_GET["storeId"])) {
            $query = StoreProduct::find()->where("storeId=" . $_GET["storeId"]);
        } else {
            if (isset($_GET['storeProductGroupId'])) {
                $query = StoreProduct::find()->where("storeProductGroupId=" . $_GET["storeProductGroupId"]);
                $storeProductGroupId = $_GET['storeProductGroupId'];
            } else {
                $query = StoreProduct::find();
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Displays a single StoreProduct model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $storeProductGroupId = '';
        $model = new StoreProduct();
        if (isset($_GET["storeId"])) {
            $model->storeId = $_GET["storeId"];
        }
        if (isset($_GET['storeProductGroupId'])) {
            $model->storeProductGroupId = $_GET['storeProductGroupId'];
            $storeProductGroupId = $_GET['storeProductGroupId'];
        }
        if (isset($_POST["StoreProduct"])) {
            $model->attributes = $_POST["StoreProduct"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $model->total = $model->quantity * $model->price;

            if ($model->save()) {
                $this->updateStoreProductGroupSummary($model->storeProductGroupId);

                return $this->redirect(['index',
                            'storeId' => $model->storeId,
                            'storeProductGroupId' => $storeProductGroupId
                ]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Updates an existing StoreProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $storeProductGroupId = '';
        $model = $this->findModel($id);
        if (isset($_GET['storeProductGroupId'])) {
            $storeProductGroupId = $_GET['storeProductGroupId'];
        }
        if (isset($_POST["StoreProduct"])) {
            $model->attributes = $_POST["StoreProduct"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $model->total = $model->quantity * $model->price;

            if ($model->save()) {
                $this->updateStoreProductGroupSummary($model->storeProductGroupId);
                return $this->redirect(['index', 'storeId' => $model->storeId, 'storeProductGroupId' => $_GET['storeProductGroupId']]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'storeProductGroupId' => $storeProductGroupId
        ]);
    }

    /**
     * Deletes an existing StoreProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = StoreProduct::find()->where("storeProductId='" . $id . "'")->one();
        $store = $model->storeId;
        $storeProductGroupId = $model->storeProductGroupId;
        $model->delete();
        return $this->redirect(['index', 'storeId' => $store, 'storeProductGroupId' => $storeProductGroupId]);
    }

    /**
     * Finds the StoreProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return StoreProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheck() {
        if (isset($_GET['storeProductGroupId'])) {
            $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $_GET['storeProductGroupId'] . "'")->one();
        }
        $msError = '';
        $errorId = '';
        if (isset($_POST["check"])) {
            $inPo = StoreProduct::find()->where("storeProductId='" . $_POST['storeProductId'] . "'")->one();
            if ($_POST["check"][$inPo->storeProductId] == 1) {
                $inPo->importQuantity = $inPo->quantity;
                $inPo->status = 2;
                $inPo->save(FALSE);
                $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "' and status=1")->one();
            } else {
                if (!empty($_POST["remark"][$inPo->storeProductId]) && !empty($_POST["quantity"][$inPo->storeProductId])) {
                    if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity < $inPo->quantity) {
                        $inPo->importQuantity = $_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 3;
                        $inPo->save(FALSE);
                        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "' and status=1")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity == $inPo->quantity) {
                        $inPo->importQuantity = $inPo->quantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 2;
                        $inPo->save(FALSE);
                        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "' and status=1")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity > $inPo->quantity) {
                        $msError = 'input wrong quantity';
                        $errorId = $inPo->storeProductId;
                        $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "' and status=1")->one();
                    }
                } else {
                    $msError = 'Empty import quantity or remark ';
                    $errorId = $inPo->storeProductId;
                    $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "' and status=1")->one();
                }
            }
        } else if (isset($_POST["storeProductGroupId"])) {//if click submit but not choose
            $msError = 'Not selected';
            $errorId = $_POST["storeProductId"];
            $model = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId='" . $_POST["storeProductGroupId"] . "' and status=1")->one();
        }

        return $this->render('check', ['model' => $model,
                    'msError' => $msError,
                    'errorId' => $errorId
        ]);
    }

    public function updateStoreProductGroupSummary($productStoreGroupId) {
        $summary = 0;
        $stg = \common\models\costfit\StoreProductGroup::find()->where("storeProductGroupId =" . $productStoreGroupId)->one();
        foreach ($stg->storeProducts as $sp) {
            $summary+= $sp->total;
        }
        $stg->summary = $summary;
        $stg->save();
    }

}
