<?php

namespace backend\modules\suppliers\controllers;

use Yii;
use common\helpers\Suppliers;

class ProductController extends SuppliersMasterController {

    public function actionIndex() {
        $userSuppliers = Suppliers::GetUserSuppliers();
        $productCountents = Suppliers::GetUserContents();
        //echo '<pre>';
        //print_r($userSuppliers);
        //exit();
        return $this->render('index', [
                    'userSuppliers' => $userSuppliers, 'productCountents' => $productCountents
        ]);
    }

}
