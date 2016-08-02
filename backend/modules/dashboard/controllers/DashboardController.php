<?php

namespace backend\modules\dashboard\controllers;

class DashboardController extends DashboardMasterController
{

    public function actionIndex()
    {

        $circulations = \common\models\costfit\Order::findAllYearCirculationWithYear(date("Y"));
        $orderToday = \common\models\costfit\Order::findAllTodayOrder();
        $todaySummary = \common\models\costfit\Order::find()->where("status = " . \common\models\costfit\Order::ORDER_STATUS_FINANCE_APPROVE)->sum("summary");
        return $this->render('index', compact('circulations', 'orderToday', 'todaySummary'));
    }

    public function actionFlowchart($id)
    {
        return $this->render('flowchart', compact('id'));
    }

}
