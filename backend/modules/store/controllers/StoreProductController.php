<?php

namespace backend\modules\store\controllers;

use Yii;
use common\models\costfit\StoreProduct;
use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\StoreProductGroup;

/**
 * StoreProductController implements the CRUD actions for StoreProduct model.
 */
class StoreProductController extends StoreMasterController
{

    public function behaviors()
    {
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
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
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
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = StoreProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheck()
    {
        if (isset($_GET['storeProductGroupId'])) {
            $model = StoreProductGroup::find()->where("storeProductGroupId='" . $_GET['storeProductGroupId'] . "'")->one();
        }
        $msError = '';
        $errorId = '';
        if (isset($_POST["check"])) {
            $inPo = StoreProduct::find()->where("storeProductId='" . $_POST['storeProductId'] . "'")->one();
            if ($_POST["check"][$inPo->storeProductId] == 1) {
                $inPo->importQuantity = $inPo->quantity;
                $inPo->status = 3;
                $inPo->save(FALSE);
                $this->checkPo($inPo->storeProductGroupId);
                $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
            } else {
                if (!empty($_POST["remark"][$inPo->storeProductId]) && !empty($_POST["quantity"][$inPo->storeProductId])) {
                    if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity < $inPo->quantity) {
                        $inPo->importQuantity = $_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 2;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->storeProductGroupId);
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity == $inPo->quantity) {
                        $inPo->importQuantity = $inPo->quantity;
                        $inPo->remark = $_POST["remark"][$inPo->storeProductId];
                        $inPo->status = 3;
                        $inPo->save(FALSE);
                        $this->checkPo($inPo->storeProductGroupId);
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    } else if ($_POST["quantity"][$inPo->storeProductId] + $inPo->importQuantity > $inPo->quantity) {
                        $msError = 'input wrong quantity';
                        $errorId = $inPo->storeProductId;
                        $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                    }
                } else {
                    $msError = 'Empty import quantity or remark ';
                    $errorId = $inPo->storeProductId;
                    $model = StoreProductGroup::find()->where("storeProductGroupId='" . $inPo->storeProductGroupId . "'")->one();
                }
            }
        } else if (isset($_POST["storeProductGroupId"])) {//if click submit but not choose
            $msError = 'Not selected';
            $errorId = $_POST["storeProductId"];
            $model = StoreProductGroup::find()->where("storeProductGroupId='" . $_POST["storeProductGroupId"] . "'")->one();
        }
        return $this->render('check', ['model' => $model,
            'msError' => $msError,
            'errorId' => $errorId
        ]);
    }

    public function updateStoreProductGroupSummary($productStoreGroupId)
    {
        $summary = 0;
        $stg = StoreProductGroup::find()->where("storeProductGroupId =" . $productStoreGroupId)->one();
        foreach ($stg->storeProducts as $sp) {
            $summary+= $sp->total;
        }
        $stg->summary = $summary;
        $stg->save();
    }

    public function checkPo($id)
    {
        $checkPo = StoreProduct::find()->where("storeProductGroupId='" . $id . "' and status!=3")->all();
        if (count($checkPo) == 0) {
            $changePoStatus = StoreProductGroup::find()->where("storeProductGroupId='" . $id . "'")->one();
            $changePoStatus->status = 2;
            $changePoStatus->save(FALSE);
            return $this->redirect(['store-product-group/index']);
        }
    }

    public function actionArrange()
    {

        if (isset($_POST["StoreProduct"])) {
            $product = \common\models\costfit\Product::find()->where("isbn ='" . $_POST["StoreProduct"]['isbn'] . "'")
            ->join("LEFT JOIN", 'store_product sp', 'product.productId=sp.productId')
            ->orderBy('sp.createDateTime ASC')
            ->one();

            return $this->render('arrange', ['model' => $product,
            ]
            );
        }

        if (isset($_POST['quantity']) && isset($_POST['slot'])) {
            $slot = \common\models\costfit\StoreSlot::find()->where('barcode=' . $_POST["slot"])->one();
            StoreProduct::arrangeProductToSlot($product->storeProductId, $slot->slotId, $_POST['quantity']);
        }
        return $this->render('arrange_index');
    }

}
