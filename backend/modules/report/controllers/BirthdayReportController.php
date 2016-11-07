<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;
use common\models\costfit\User;

class BirthdayReportController extends ReportMasterController {

    public function actionIndex() {
        $thisMonth = substr(date('Y-m-d'), 5, -3);
        $model = User::find()->where("type=1 and status=1 and birthDate!=''");
        $filterArray[] = 'and';
        //throw new \yii\base\Exception($_GET['fromDate']);
        if (isset($_GET['fromDate']) && !empty($_GET['fromDate'])) {
            $fromeDate = $_GET['fromDate'] + 1;
            $model = User::find()->where("type=1 and status=1 and birthDate!=''");
            $filterArray[] = ['>=', 'month(birthDate)', $fromeDate];
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $toDate = $_GET['toDate'] + 1;
                $filterArray[] = ['<=', 'month(birthDate)', $toDate];
            }
        } else {
            if (isset($_GET['toDate']) && !empty($_GET['toDate'])) {
                $toDate = $_GET['toDate'] + 1;
                $filterArray[] = ['<=', 'month(birthDate)', $toDate];
            } else {
                $model = User::find()->where("type=1 and status=1 and birthDate!='' and month(birthDate)='" . $thisMonth . "'");
            }
        }

        $model->andFilterWhere($filterArray);
        $model->orderBy('birthDate');
        $provider = new ActiveDataProvider([
            'query' => $model,
        ]);
        $models = $provider->getModels();
        return $this->render('index', [
            'model' => $models,
            'thisMonth' => $thisMonth
        ]);
    }

    public function actionCreate() {
        return $this->render('create');
    }

    public function actionDelete() {
        return $this->render('delete');
    }

}
