<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class ReportController extends ReportMasterController {

    public function actionIndex() {

        if (isset($_GET['fromDate'])) {
            if (isset($_GET['toDate'])) {
                $model = Order::find()->where("substr(paymentDateTime,0,-9)>='" . $_GET['fromDate'] . "' or substr(paymentDateTime,0,-9)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
            } else {
                $model = Order::find()->where("substr(paymentDateTime,0,-9)>='" . $_GET['fromDate'] . "' or status>=5 order by paymentDateTime DESC")->all();
            }
        } else {
            if (isset($_GET['toDate'])) {
                $model = Order::find()->where("substr(paymentDateTime,0,-9)>='" . $_GET['fromDate'] . "' or substr(paymentDateTime,0,-9)<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
            } else {
                $model = Order::find()->where("status>=5 order by paymentDateTime DESC")->all();
            }
        }
        return $this->render('index', [
                    'model' => $model
        ]);
    }

    public function actionCreate() {
        return $this->render('create');
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
