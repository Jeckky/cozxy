<?php

namespace backend\modules\suppliers\controllers;

class ProductAllController extends SuppliersMasterController {

    public function actionIndex() {
        return $this->render('index');
    }

}
