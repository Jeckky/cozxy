<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class PickingPointReportController extends ReportMasterController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex() {
        $model = \common\models\costfit\Order::find()
        ->select("`order`.*,sum(1) as sumPicking")
        ->join("LEFT JOIN", '`picking_point` p', '`order`.pickingId=p.pickingId')
        ->where('`order`.status >' . Order::ORDER_STATUS_E_PAYMENT_SUCCESS . ' AND `order`.status <>' . Order::ORDER_STATUS_FINANCE_REJECT)
        ->groupBy("`order`.pickingId");
        $filterArray[] = 'and';
        if (isset($_GET['fromDate'])) {
            $filterArray[] = ['>=', 'date(`order`.paymentDateTime)', $_GET['fromDate']];
        }
        if (isset($_GET['toDate'])) {
            $filterArray[] = ['<=', 'date(`order`.paymentDateTime)', $_GET['toDate']];
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
