<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductImageSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductImageSuppliersController implements the CRUD actions for ProductImageSuppliers model.
 */
class ProductImageSuppliersController extends SuppliersMasterController {

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
     * Lists all ProductImageSuppliers models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductImageSuppliers::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImageSuppliers model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductImageSuppliers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

    }

    /**
     * Updates an existing ProductImageSuppliers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {

    }

    /**
     * Deletes an existing ProductImageSuppliers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $productSuppId = Yii::$app->request->get('productSuppId');
        $id = Yii::$app->request->get('id');
        $this->findModel($id)->delete();
        //return $this->redirect(['product-suppliers/image-form?productSuppId=' . $productSuppId]);
        return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-suppliers/image-form?productSuppId=' . $productSuppId);
    }

    /**
     * Finds the ProductImageSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductImageSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductImageSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
