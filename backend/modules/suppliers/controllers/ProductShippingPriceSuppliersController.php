<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductShippingPriceSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductShippingPriceSuppliersController implements the CRUD actions for ProductShippingPriceSuppliers model.
 */
class ProductShippingPriceSuppliersController extends SuppliersMasterController {

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
     * Lists all ProductShippingPriceSuppliers models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductShippingPriceSuppliers::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductShippingPriceSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductShippingPriceSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductShippingPriceSuppliers();
        if (isset($_POST["ProductShippingPriceSuppliers"])) {
            $model->attributes = $_POST["ProductShippingPriceSuppliers"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            $date = \common\models\costfit\ShippingType::find()->where("shippingTypeId=" . $_POST["ProductShippingPriceSuppliers"]["shippingTypeId"])->one();
            $model->date = $date->date;
            if ($model->save()) {
                return $this->redirect(['product-price-suppliers/index?productSuppId=' . $_GET['productSuppId']]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductShippingPriceSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductShippingPriceSuppliers"])) {
            $model->attributes = $_POST["ProductShippingPriceSuppliers"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');
            $date = \common\models\costfit\ShippingType::find()->where("shippingTypeId=" . $_POST["ProductShippingPriceSuppliers"]["shippingTypeId"])->one();
            $model->date = isset($date->date) ? $date->date : 0;
            if ($model->save()) {
                return $this->redirect(['product-price-suppliers/index?productSuppId=' . $model->productSuppId]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductShippingPriceSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['product-price-suppliers/index?productSuppId=' . $_GET['productSuppId']]);
    }

    /**
     * Finds the ProductShippingPriceSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductShippingPriceSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductShippingPriceSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
