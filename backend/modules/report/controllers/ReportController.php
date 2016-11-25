<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class ReportController extends ReportMasterController {

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
        if (isset($_GET['fromDate']) && !empty($_GET['fromDate'])) {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                // throw new \yii\base\Exception($_GET['toDate']);
                $model = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            } else {
                $model = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)>='" . $_GET['fromDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            }
        } else {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $model = Order::find()->where("date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("date(paymentDateTime)<='" . $_GET['toDate'] . "' and status>=5")->orderBy("paymentDateTime DESC");
            } else {
                $model = Order::find()->where("status>=5 order by paymentDateTime DESC")->all();
                $query = Order::find()->where("status>=5")->orderBy("paymentDateTime DESC");
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
                    'model' => $model,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate() {
        return $this->render('create');
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
