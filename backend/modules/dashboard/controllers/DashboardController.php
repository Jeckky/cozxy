<?php

namespace backend\modules\dashboard\controllers;

class DashboardController extends DashboardMasterController
{

    public function actionIndex()
    {

        $circulations = \common\models\costfit\Order::findAllYearCirculationWithYear(date("Y"));
        return $this->render('index', compact('circulations'));
    }

}
