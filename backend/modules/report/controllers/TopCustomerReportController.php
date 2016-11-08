<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class TopCustomerReportController extends ReportMasterController {

    public function actionIndex() {

        $model = \common\models\costfit\Order::find()->select("*,sum(summary) as sumSummary")
        ->where("status >= " . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . " AND status <>" . Order::ORDER_STATUS_FINANCE_REJECT)
        ->orderBy("sumSummary DESC")
        ->groupBy("userId");
        $filterArray[] = 'and';
        if (isset($_GET['fromDate'])) {
            $filterArray[] = ['>=', 'date(paymentDateTime)', $_GET['fromDate']];
        }
        if (isset($_GET['toDate'])) {
            $filterArray[] = ['<=', 'date(paymentDateTime)', $_GET['toDate']];
        }
        $model->andFilterWhere($filterArray);

        $provider = new ActiveDataProvider([
            'query' => $model,
        ]);
        $models = $provider->getModels();
        return $this->render('index', [
            'model' => $models
        ]);
    }

    public function actionCreate() {
        return $this->render('create');
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
