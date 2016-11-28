<?php

namespace backend\modules\management\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\ProductSuppliers;
use common\models\costfit\Product;

class ApproveController extends ManagementMasterController {

    public function actionIndex() {
        $productSys = new ActiveDataProvider([
            'query' => \common\models\costfit\Product:: find()
            ->where('approve = "new"'),
        ]);

        $productSupp = new ActiveDataProvider([
            'query' => \common\models\costfit\ProductSuppliers:: find()
            ->where('approve = "new"'),
        ]);

        return $this->render('index', [
            'productSys' => $productSys, 'productSupp' => $productSupp
        ]);
        //return $this->render('index');
    }

}
