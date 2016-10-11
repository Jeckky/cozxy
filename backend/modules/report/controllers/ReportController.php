<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class ReportController extends ReportMasterController {

    public function actionIndex() {
//        $a = substr('2016-10-11 17:24:16', 0, -9);
//        $b = substr('2016-08-23 17:24:16', 0, -9);
//        if ($a > $b) {
//            throw new \yii\base\Exception('a>b');
//        } else {
//            throw new \yii\base\Exception('b>a');
//        }
        //throw new \yii\base\Exception($a);
        if (isset($_GET['fromDate']) && !empty($_GET['fromDate'])) {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $model = Order::find()->where("paymentDateTime BETWEEN '" . $_GET['fromDate'] . "' and '" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
            } else {
                ;
                $model = Order::find()->where("paymentDateTime>='" . $_GET['fromDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
            }
        } else {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $model = Order::find()->where("paymentDateTime<='" . $_GET['toDate'] . "' and status>=5 order by paymentDateTime DESC")->all();
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
