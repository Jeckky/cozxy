<?php

namespace backend\modules\dashboard\controllers;

use common\helpers\Notifications;

class DashboardController extends DashboardMasterController {

    public function behaviors() {
        return [
            'access' => [
                //'class' => \yii\filters\AccessControl::className(),
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
        $circulations = \common\models\costfit\Order::findAllYearCirculationWithYear(date("Y"));
        $orderToday = \common\models\costfit\Order::findAllTodayOrder();
        $todaySummary = \common\models\costfit\Order::find()->where("status = " . \common\models\costfit\Order::ORDER_STATUS_FINANCE_APPROVE)->sum("summary");

        /*
         * Update : 18/1/2017
         * By : Taninut.Bm
         * email : taninut.b@gmail.com , sodapew17@gmail.com
         */
        $newUser = Notifications::DashboarMovementNewUser();

        $newOrder = Notifications::DashboarMovementNewOrder();

        $userCount = Notifications::DashboarMovementuserCount();
        // User //
        $userlastvisitDate = Notifications::DashboarMovementuserlastvisitDate();
        // บัตรเครดิต //
        $orderLast = Notifications::DashboarMovementorderLast();
        $orderLastYes = Notifications::DashboarMovementorderLastYes();
        //echo 'xx:' . $userCount;
        $userVisit = Notifications::DashboarMovementuserVisit();
        //' SELECT sum(summary) FROM costfit_test.`order`  where status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)';
        $orderLastDay = Notifications::DashboarMovementorderLastDay();
        $orderLastWeek = Notifications::DashboarMovementorderLastWeek();
        $orderLastMONTH = Notifications::DashboarMovementorderLastMONTH();
        return $this->render('index', compact('orderLastYes', 'orderLastDay', 'orderLastWeek', 'orderLastMONTH', 'userVisit', 'circulations', 'orderToday', 'todaySummary', 'earnToday', 'newUser', 'newOrder', 'userCount', 'userlastvisitDate', 'orderLast'));
    }

    public function actionFlowchart($id) {
        return $this->render('flowchart', compact('id'));
    }

}
