<?php

namespace backend\modules\report\controllers;

use yii\data\ActiveDataProvider;
use backend\controllers\BackendMasterController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\costfit\Order;

class FuturePlanReportController extends ReportMasterController
{

    public function actionIndex()
    {
        $model = \common\models\costfit\OrderItem::find()->select("*,sum(quantity) as sumQuantity  , DATEDIFF(sendDateTime,date(NOW())) as remainDay")
        ->where(" sendDateTime is not null AND DATEDIFF(sendDateTime,date(NOW())) <= " . \common\models\costfit\OrderItem::FUTURE_DAY_TO_SHOW)
        ->orderBy("remainDay ASC")
        ->groupBy("productId");
        $filterArray[] = 'and';
        if (isset($_GET['fromDate'])) {
            $filterArray[] = ['>=', 'date(createDateTime)', $_GET['fromDate']];
        }
        if (isset($_GET['toDate'])) {
            $filterArray[] = ['<=', 'date(createDateTime)', $_GET['toDate']];
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
