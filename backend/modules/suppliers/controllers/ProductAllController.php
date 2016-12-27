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
            ->select('`product_suppliers`.* ,  (SELECT product_price_suppliers.price  FROM costfit_test.product_price_suppliers
            where product_price_suppliers.productSuppId = product_suppliers.productSuppId and product_price_suppliers.status = 1  limit 1)
            AS `priceSuppliers`')
            ->where('userId=' . $userId)->orderBy('product_suppliers.productSuppId desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
