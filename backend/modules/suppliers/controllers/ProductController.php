<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\helpers\Suppliers;

class ProductController extends SuppliersMasterController {

    public function actionIndex() {
        $userSuppliers = Suppliers::GetUserSuppliers();
        $productCountents = Suppliers::GetUserContents();
        return $this->render('index', [
            'userSuppliers' => $userSuppliers, 'productCountents' => $productCountents
        ]);
    }

}
