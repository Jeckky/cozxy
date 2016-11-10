<?php

namespace backend\modules\dashboard\controllers;

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

        $newUser = \common\models\costfit\User::find()->where('date(createDateTime)>=date_add(curdate(),interval  0 day)')->all();
        /*
          status 0 : "ตระกร้าสินค้า",
          status 1 :  "ลงทะเบียนผู้ใช้แล้ว",
          status 2 :'รอการชำระเงิน',
          status 3 : 'ชำระบัตรเครดิตไม่สำเร็จ',
          status 4 : 'ยืนยันชำระเงิน',
          status 5 : 'ชำระบัตรเครดิตสำเร็จ',
          status 7 : 'การเงินตรวจสอบแล้ว',
          status 13 : แพ็คเสร็จแล้ว
          status 100 : ลูกค้ารับของแล้ว
          status 8 : 'การเงินส่งกลับ',
          status 9 : 'กำลังจัดส่ง',
          status 10 : 'จัดส่งแล้ว',
          status 11 : กำลังหยิบ
          status 12 : หยิบเสร็จแล้ว
          status 13 : แพ๊กเสร็จแล้ว
          status 14 : กำลังจะส่ง
          status 15 : นำจ่าย
          status 16 : ลูกค้ารับแล้ว
          status 17 : ลูกค
         * */
        $newOrder = \common\models\costfit\Order::find()
        ->select('`order`.`orderId`, `order`.`userId` ,`oi`.firstname , `oi`.lastname ,
                `order`.`orderNo`, `order`.`userId`, `order`.`totalExVat`, `order`.`total`, `order`.`summary`,
                `order`.`status`, `order`.`paymentDateTime`, `order`.`createDateTime` ')
        ->join('LEFT JOIN', 'user oi', 'oi.userId = order.userId')
        ->where('order.status in (2,3,4,5)  and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->all();


        //$newOrderSumToday = \common\models\costfit\Order::find()
        //->where('createDateTime >= now() - INTERVAL 1 DAY')->sum('summary');

        $userCount = \common\models\costfit\User::find()->count();
        // User //
        $userlastvisitDate = \common\models\costfit\User::find()->where('date(lastvisitDate)>=date_add(curdate(),interval  0 day)')->count();
        // บัตรเครดิต //
        $orderLast = \common\models\costfit\Order::find()->where('status = 3 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count(); //and createDateTime >= now() - INTERVAL 1 DAY
        $orderLastYes = \common\models\costfit\Order::find()->where('status >= 5 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count();
        //echo 'xx:' . $userCount;
        $userVisit = \common\models\costfit\UserVisit::find()->select('count(user_visit.visitId) as countVisit ,user_visit.userId ,`oi`.firstname , `oi`.lastname, `oi`.email')
        ->join('LEFT JOIN', 'user oi', 'oi.userId = user_visit.userId')
        ->where(' date(user_visit.lastvisitDate)>=date_add(curdate(),interval  0 day)  group by user_visit.userId  order by  COUNT(user_visit.visitId) desc limit 5')->all();

        //' SELECT sum(summary) FROM costfit_test.`order`  where status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)';
        $orderLastDay = \common\models\costfit\Order::find()
        ->where('`order`.status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)')->sum('summary');
        //'SELECT sum(summary) fROM costfit_test.`order` where status => 5 and date(createDateTime)>=date_add(curdate(),interval -1 week)  ';
        $orderLastWeek = \common\models\costfit\Order::find()
        ->where('`order`.status >= 5 and date(createDateTime)>=date_add(curdate(),interval -1 week)')->sum('summary');
        //'SELECT sum(summary)  FROM costfit_test.`order`  where status => 5 and MONTH(date_add(curdate(),interval  0 day))-1 <= MONTH(date_add(curdate(),interval  1 MONTH))';
        $orderLastMONTH = \common\models\costfit\Order::find()
        ->where(' `order`.status >= 5 and MONTH(date_add(curdate(),interval  0 day))-1 <= MONTH(date_add(curdate(),interval  1 MONTH))')->sum('summary');

        return $this->render('index', compact('orderLastYes', 'orderLastDay', 'orderLastWeek', 'orderLastMONTH', 'userVisit', 'circulations', 'orderToday', 'todaySummary', 'earnToday', 'newUser', 'newOrder', 'userCount', 'userlastvisitDate', 'orderLast'));
    }

    public function actionFlowchart($id) {
        return $this->render('flowchart', compact('id'));
    }

}
