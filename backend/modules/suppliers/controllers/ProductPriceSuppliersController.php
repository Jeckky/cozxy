<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductPriceSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductPriceSuppliersController implements the CRUD actions for ProductPriceSuppliers model.
 */
class ProductPriceSuppliersController extends SuppliersMasterController {

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
     * Lists all ProductPriceSuppliers models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->orderBy('status desc'),
        ]);

        $dataProvider1 = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductShippingPriceSuppliers::find()->where('productSuppId=' . $_GET['productSuppId']),
        ]);

        $productSupp = \common\models\costfit\ProductSuppliers::find()->where('productSuppId=' . $_GET['productSuppId'])->one();

        return $this->render('index', [
            'dataProvider' => $dataProvider, 'dataProvider1' => $dataProvider1, 'productSupp' => $productSupp
        ]);
    }

    /**
     * Displays a single ProductPriceSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPriceSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPriceSuppliers();
        $rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            \common\models\costfit\ProductPriceSuppliers::updateAll(['status' => 0], ['productSuppId' => $_GET['productSuppId']]);
            $model->status = 1;
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                //return $this->redirect(['product-price-suppliers/index?productSuppId=' . $_GET['productSuppId']]);
                return $this->redirect('/suppliers/product-suppliers/image-form?productSuppId=' . $model->productSuppId);
            }
        }
        return $this->render('create', [
            'model' => $model, 'rankingPrice' => $rankingPrice
        ]);
    }

    /**
     * Updates an existing ProductPriceSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $rankingPrice = \common\models\costfit\ProductPriceSuppliers::rankingPrice();
        $model = $this->findModel($id);
        if (isset($_POST["ProductPriceSuppliers"])) {
            $model->attributes = $_POST["ProductPriceSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['product-price-suppliers/index?productSuppId=' . $model->productSuppId]);
            }
        }
        return $this->render('update', [
            'model' => $model, 'rankingPrice' => $rankingPrice
        ]);
    }

    /**
     * Deletes an existing ProductPriceSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['product-price-suppliers/index?productSuppId=' . $_GET['productSuppId']]);
    }

    /**
     * Finds the ProductPriceSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductPriceSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPriceSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
