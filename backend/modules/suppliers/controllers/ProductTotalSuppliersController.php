<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ProductTotalSuppliersController extends SuppliersMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'products'],
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreate() {
        $productSuppId = Yii::$app->request->get('productSuppId');
        if (Yii::$app->user->identity->type != 4) {
            header("location: /auth");
            exit(0);
        }

        $model = $this->findModel($productSuppId);

        if (isset($_POST['ProductSuppliers'])) {
            //quantity , result
            $model1 = ProductSuppliers::find()->where('productSuppId=' . $productSuppId)->one();
            $model->attributes = $_POST["ProductSuppliers"];
            $quantity = $_POST['ProductSuppliers']['quantity'];
            $model->userId = Yii::$app->user->identity->userId;
            $model->quantity = $_POST['ProductSuppliers']['quantity'] + $model1->quantity;
            $model->result = $_POST['ProductSuppliers']['quantity'] + $model1->result;

            if ($model->save(FALSE)) {
                //return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-suppliers/?productSuppId=' . $model->productSuppId);
            }
            return $this->redirect(Yii::$app->homeUrl . 'suppliers/product-suppliers/?productSuppId=' . $model->productSuppId);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Finds the ProductSuppliers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductSuppliers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductSuppliers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
