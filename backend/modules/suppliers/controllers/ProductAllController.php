<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use yii\data\ActiveDataProvider;

class ProductAllController extends SuppliersMasterController {

    public function actionIndex() {

        $userId = Yii::$app->request->get('userId');
        $dataProvider = new ActiveDataProvider([
            'query' => ProductSuppliers::find()
            ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
            ->where('userId=' . $userId)->orderBy('product_suppliers.productSuppId desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {

        //$images = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId =' . $id)->one();
        $dataProviderImages = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $id),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id), 'dataProviderImages' => $dataProviderImages
        ]);
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
