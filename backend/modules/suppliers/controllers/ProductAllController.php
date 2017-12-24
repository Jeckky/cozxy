<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;
use yii\data\ActiveDataProvider;
use common\helpers\Suppliers;

class ProductAllController extends SuppliersMasterController {

    public function actionIndex() {

        $userId = Yii::$app->request->get('userId');

        $user = \common\helpers\Suppliers::GetUser($userId);
        $productParner = 'select *
from product as p
left join product_suppliers as ps on p.productId=ps.productId
left join product_price_suppliers as pps on ps.productSuppId=pps.productSuppId
where p.status=1
AND p.approve=‘approve’
AND ps.status=1
AND p.parentId is not null
AND ps.approve=‘approve’
AND ps.productId is not null
AND ps.result >0
AND pps.status=1
AND pps.price > 0 and userId=' . $userId;
        $product = Product::find()
                ->leftJoin('product_suppliers ps', 'product.productId=ps.productId')
                ->leftJoin('product_price_suppliers pps', 'ps.productSuppId=pps.productSuppId')
                ->where("product.status=1 AND product.approve='approve'
                        AND ps.status=1
                        AND product.parentId is not null
                        AND ps.approve='approve'
                        AND ps.productId is not null
                        AND ps.result >0
                        AND pps.status=1
                        AND pps.price > 0 ");
        //->andWhere('product.userId=' . $userId);
        $dataProvider = new ActiveDataProvider([
            //'query' => Product::find()->where('userId=' . $userId)->orderBy('product.productId desc'),
            'query' => $product,
            'pagination' => [
                'pageSize' => 10000,
            ],
        ]);

        return $this->render('index_1', [
                    'dataProvider' => $dataProvider, 'user' => $user
        ]);
    }

    public function actionIndex1() {

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
