<?php

namespace backend\modules\dashboard\controllers;

use common\helpers\Notifications;

class DashboardController extends DashboardMasterController {

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
        $circulations = \common\models\costfit\Order::findAllYearCirculationWithYear(date("Y"));
        $orderToday = \common\models\costfit\Order::findAllTodayOrder();
        $todaySummary = \common\models\costfit\Order::find()->where("status = " . \common\models\costfit\Order::ORDER_STATUS_FINANCE_APPROVE)->sum("summary");

        $newUser = Notifications::DashboarMovementNewUser(); //\common\models\costfit\User::find()->where('date(createDateTime)>=date_add(curdate(),interval  0 day)')->all();

        $newOrder = Notifications::DashboarMovementNewOrder(); /* \common\models\costfit\Order::find()
          ->select('`order`.`orderId`, `order`.`userId` ,`oi`.firstname , `oi`.lastname ,
          `order`.`orderNo`, `order`.`userId`, `order`.`totalExVat`, `order`.`total`, `order`.`summary`,
          `order`.`status`, `order`.`paymentDateTime`, `order`.`createDateTime` ')
          ->join('LEFT JOIN', 'user oi', 'oi.userId = order.userId')
          ->where('order.status in (2,3,4,5)  and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->all(); */



        $userCount = Notifications::DashboarMovementuserCount(); //\common\models\costfit\User::find()->count();
        // User //
        $userlastvisitDate = Notifications::DashboarMovementuserlastvisitDate(); //\common\models\costfit\User::find()->where('date(lastvisitDate)>=date_add(curdate(),interval  0 day)')->count();
        // บัตรเครดิต //
        $orderLast = Notifications::DashboarMovementorderLast(); //\common\models\costfit\Order::find()->where('status = 3 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count(); //and createDateTime >= now() - INTERVAL 1 DAY
        $orderLastYes = Notifications::DashboarMovementorderLastYes(); //\common\models\costfit\Order::find()->where('status >= 5 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count();
        //echo 'xx:' . $userCount;
        $userVisit = Notifications::DashboarMovementuserVisit(); /* \common\models\costfit\UserVisit::find()->select('count(user_visit.visitId) as countVisit ,user_visit.userId ,`oi`.firstname , `oi`.lastname, `oi`.email')
          ->join('LEFT JOIN', 'user oi', 'oi.userId = user_visit.userId')
          ->where(' date(user_visit.lastvisitDate)>=date_add(curdate(),interval  0 day)  group by user_visit.userId  order by  COUNT(user_visit.visitId) desc limit 5')->all(); */

        //' SELECT sum(summary) FROM costfit_test.`order`  where status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)';
        $orderLastDay = Notifications::DashboarMovementorderLastDay(); /* \common\models\costfit\Order::find()
          ->where('`order`.status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)')->sum('summary');
          //'SELECT sum(summary) fROM costfit_test.`order` where status => 5 and date(createDateTime)>=date_add(curdate(),interval -1 week)  '; */
        $orderLastWeek = Notifications::DashboarMovementorderLastWeek(); /* \common\models\costfit\Order::find()
          ->where('`order`.status >= 5 and   createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW()')->sum('summary');
          //'SELECT sum(summary)  FROM costfit_test.`order`  where status => 5 and MONTH(date_add(curdate(),interval  0 day))-1 <= MONTH(date_add(curdate(),interval  1 MONTH))'; */
        $orderLastMONTH = Notifications::DashboarMovementorderLastMONTH(); /* \common\models\costfit\Order::find()
          ->where(' `order`.status >= 5   and  MONTH(curdate()) = MONTH(createDateTime) and year(createDateTime) = year(curdate()) ')->sum('summary');
         */
        return $this->render('index', compact('orderLastYes', 'orderLastDay', 'orderLastWeek', 'orderLastMONTH', 'userVisit', 'circulations', 'orderToday', 'todaySummary', 'earnToday', 'newUser', 'newOrder', 'userCount', 'userlastvisitDate', 'orderLast'));
    }

    public function actionFlowchart($id) {
        return $this->render('flowchart', compact('id'));
    }

}
