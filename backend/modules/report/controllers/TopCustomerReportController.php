<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class TopCustomerReportController extends ReportMasterController
{

    public function actionIndex()
    {
//        if (isset($_GET)) {
//            throw new \yii\base\Exception(print_r($_GET, true));
//        }
//        $str = "";
//        if (isset($_GET['fromDate']) || isset($_GET['toDate'])) {
//            if (isset($_GET['fromDate'])) {
//
//            }
//            if (isset($_GET['toDate'])) {
//
//            }
//        }
        $model = \common\models\costfit\ProductView::find()->select("*,sum(1) as sumViews")->groupBy("productId");
        $filterArray[] = 'and';
        if (isset($_GET['fromDate'])) {
            $filterArray[] = ['>=', 'date(createDateTime)', $_GET['fromDate']];
        }
        if (isset($_GET['toDate'])) {
            $filterArray[] = ['<=', 'date(createDateTime)', $_GET['fromDate']];
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

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

}
