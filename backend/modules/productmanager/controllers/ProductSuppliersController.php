<?php

namespace backend\modules\productmanager\controllers;

use common\models\costfit\ProductPriceSuppliers;
use Yii;
use backend\modules\productmanager\models\ProductSuppliers;
use backend\modules\productmanager\models\search\ProductSuppliers as ProductSuppliersSearch;
use backend\modules\productmanager\controllers\ProductManagerMasterController;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductSuppliersController implements the CRUD actions for ProductSuppliers model.
 */
class ProductSuppliersController extends ProductManagerMasterController
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
     * Lists all ProductSuppliers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSuppliersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductSuppliers model.
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
     * Creates a new ProductSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductSuppliers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->productSuppId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->productSuppId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductSuppliers model.
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
     * Finds the ProductSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionStock($id)
    {
        $model = $this->findModel($id);

        if(isset($_POST['ProductSuppliers']['addStock'])) {
            $addStock = $_POST['ProductSuppliers']['addStock'];
            $model->result += $addStock;
            $model->quantity += $addStock;
            $model->save(false);

            return $this->redirect(Url::home().'productmanager/product/view?id='.$model->product->parent->productId);
        }

        return $this->render('stock', compact('model'));
    }

    public function actionPrice($id)
    {
        $model = $this->findModel($id);
        $productPriceSuppliers = new ProductPriceSuppliers();

        if(isset($_POST['ProductPriceSuppliers']['price'])) {
            $newPrice = $_POST['ProductPriceSuppliers']['price'];

            //disable current price
            if(isset($model->productPriceSuppliers)) {
                $currentPrice = $model->productPriceSuppliers;
                $currentPrice->status = 2;
                $currentPrice->save(false);
            }

            //create new price
            $productPriceSuppliers->price = $newPrice;
            $productPriceSuppliers->status = 1;
            $productPriceSuppliers->productSuppId = $id;
            $productPriceSuppliers->createDateTime = new Expression('NOW()');
            $productPriceSuppliers->updateDateTime = new Expression('NOW()');
            $productPriceSuppliers->save(false);

            return $this->redirect(Url::home().'productmanager/product/view?id='.$model->product->parent->productId);
        }

        return $this->render('price', compact('model', 'productPriceSuppliers'));
    }
}
