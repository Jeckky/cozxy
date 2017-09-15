<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductSupplierController implements the CRUD actions for productSupplier model.
 */
class ProductSupplierController extends ProductMasterController {

    /**
     * @inheritdoc
     */
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all productSupplier models.
     * @return mixed
     */
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider([
            'query' => ProductSuppliers::find()->where("productId='" . $_GET['productId'] . "'"),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single productSupplier model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new productSupplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductSupplier();
        $supplier = ArrayHelper::map(\common\models\costfit\search\Supplier::find()->all(), 'supplierId', 'name');
        if (isset($_GET["productId"])) {
            $productName = \common\models\costfit\Product::find()->where("productId='" . $_GET['productId'] . "'")->one();
            $model->productId = $_GET["productId"];
        }
        if (isset($_POST["ProductSupplier"])) {
            $model->attributes = $_POST["ProductSupplier"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'productId' => $_GET["productId"]]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'supplier' => $supplier,
                'productName' => $productName->title
            ]);
        }
    }

    /**
     * Updates an existing productSupplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $supplier = ArrayHelper::map(\common\models\costfit\search\Supplier::find()->all(), 'supplierId', 'name');
        $productName = \common\models\costfit\Product::find()->where("productId='" . $model->productId . "'")->one();
        if (isset($_POST["ProductSupplier"])) {
            $model->attributes = $_POST["ProductSupplier"];
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'productId' => $model->productId]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'supplier' => $supplier,
                'productName' => $productName->title
            ]);
        }
    }

    /**
     * Deletes an existing productSupplier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the productSupplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return productSupplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductSupplier::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionProductSuppWaitForApprove()
    {
        $newProductSupps = ProductSuppliers::newProductSupp();
        $dataProvider = new ActiveDataProvider([
            'query' => $newProductSupps,
            'pagination' => [
                'pageSize' => 8,
            ]
        ]);

        return $this->render('product_supp_wait_for_approve', compact('dataProvider'));
    }

    public function actionApproveProductSupp()
    {
        if(isset($_POST['productSuppId'])) {
            $productSupp = ProductSuppliers::find()->where(['productSuppId'=>$_POST['productSuppId']])->one();
            $productSupp->status = 1;
            $productSupp->approve = 'approve';
            $productSupp->save(false);

            return Json::encode(['result'=>true]);
        }
    }

}
