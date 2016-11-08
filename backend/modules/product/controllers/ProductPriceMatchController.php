<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\costfit\ProductPriceMatch;
use yii\data\ActiveDataProvider;
use backend\modules\product\controllers\ProductMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductPriceMatchController implements the CRUD actions for ProductPriceMatch model.
 */
class ProductPriceMatchController extends ProductMasterController {

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
     * Lists all ProductPriceMatch models.
     * @return mixed
     */
    public function actionIndex() {
        $query = ProductPriceMatch::find();
        if (isset($_GET['productPriceMatchGroupId'])) {
            $query->andWhere("productPriceMatchGroupId = " . $_GET['productPriceMatchGroupId']);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPriceMatch model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductPriceMatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ProductPriceMatch();
        if (isset($_GET['productPriceMatchGroupId'])) {
            $model->productPriceMatchGroupId = $_GET['productPriceMatchGroupId'];
        }
        if (isset($_POST["ProductPriceMatch"])) {
            $model->attributes = $_POST["ProductPriceMatch"];
            $model->createDateTime = new \yii\db\Expression('NOW()');
            if ($model->save()) {
                return $this->redirect(['index', 'productPriceMatchGroupId' => $model->productPriceMatchGroupId]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductPriceMatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (isset($_POST["ProductPriceMatch"])) {
            $model->attributes = $_POST["ProductPriceMatch"];
            $model->updateDateTime = new \yii\db\Expression('NOW()');



            if ($model->save()) {
                return $this->redirect(['index', 'productPriceMatchGroupId' => $model->productPriceMatchGroupId]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductPriceMatch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductPriceMatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductPriceMatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ProductPriceMatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
