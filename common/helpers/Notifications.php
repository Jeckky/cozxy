<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Description of Notifications
 *
 * @author it
 * 4/1/2017 By Taninut.Bm
 */
class Notifications {

    //put your code here
    /*
     * การ Approve , Suppliers
     */
    public static function NotificationsApprove($productSuppId) {
        $Noti = \common\models\costfit\Notifications::find()
        ->where('id=' . $productSuppId . ' and type =' . \common\models\costfit\Notifications::NOTI_APPROVE)
        ->orderBy('notiId desc')->one();
        return isset($Noti) ? $Noti : NULL;
    }

    public static function NotificationsLoginSuppliers() {

        $NotiLogin = \common\models\costfit\Notifications::find()
        ->select('notifications.notiId ,notifications.id ,notifications.userId  ,notifications.title,notifications.type , notifications.status , notifications.createBy , notifications.createDateTime , notifications.updateDateTime ')
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = notifications.id')
        ->where(' notifications.userId=' . Yii::$app->user->identity->userId .
        ' and notifications.type =' . \common\models\costfit\Notifications::NOTI_APPROVE . ' and product_suppliers.approve != "' . \common\models\costfit\ProductSuppliers::SUPPLIERS_APPROVE . '" ')
        ->orderBy('notifications.notiId desc')->all();
        return isset($NotiLogin) ? $NotiLogin : NULL;
    }

    public static function NotificationsLoginSuppliersCount() {
        $NotiLogin = \common\models\costfit\Notifications::find()
        ->select(' notifications.notiId ,notifications.id ,notifications.userId ,notifications.title, notifications.type , notifications.status , notifications.createBy , notifications.createDateTime , notifications.updateDateTime ')
        ->join(' LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = notifications.id')
        ->where(' notifications.userId=' . Yii::$app->user->identity->userId . ' and notifications.type ='
        . \common\models\costfit\Notifications::NOTI_APPROVE . ' and product_suppliers.approve != "' . \common\models\costfit\ProductSuppliers::SUPPLIERS_APPROVE . '" ')
        ->orderBy('notifications.notiId desc')->count();
        return isset($NotiLogin) ? $NotiLogin : 0;
    }

    public static function DashboarMovementNewOrder() {
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
        return $newOrder;
    }

    public static function DashboarMovementuserCount() {
        $userCount = \common\models\costfit\User::find()->count();
        return $userCount;
    }

    public static function DashboarMovementuserlastvisitDate() {
        $userlastvisitDate = \common\models\costfit\User::find()->where('date(lastvisitDate)>=date_add(curdate(),interval  0 day)')->count();
        return $userlastvisitDate;
    }

    public static function DashboarMovementorderLast() {
        $orderLast = \common\models\costfit\Order::find()->where('status = 3 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count();
        return $orderLast;
    }

    public static function DashboarMovementorderLastYes() {
        $orderLastYes = \common\models\costfit\Order::find()->where('status >= 5 and date(order.createDateTime)>=date_add(curdate(),interval  0 day) ')->count();
        return $orderLastYes;
    }

    public static function DashboarMovementuserVisit() {
        $userVisit = \common\models\costfit\UserVisit::find()->select('count(user_visit.visitId) as countVisit ,user_visit.userId ,`oi`.firstname , `oi`.lastname, `oi`.email')
        ->join('LEFT JOIN', 'user oi', 'oi.userId = user_visit.userId')
        ->where(' date(user_visit.lastvisitDate)>=date_add(curdate(),interval  0 day)  group by user_visit.userId  order by  COUNT(user_visit.visitId) desc limit 5')->all();
        return $userVisit;
    }

    public static function DashboarMovementorderLastDay() {
        $orderLastDay = \common\models\costfit\Order::find()
        ->where('`order`.status >= 5 and  date(order.createDateTime) >= date_add(curdate(),interval  0 day) ')->sum('summary');
        return $orderLastDay;
    }

    public static function DashboarMovementorderLastWeek() {
        $orderLastWeek = \common\models\costfit\Order::find()
        ->where('`order`.status >= 5 and order.createDateTime BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() ')->sum('summary');
        return $orderLastWeek;
    }

    public static function DashboarMovementorderLastMONTH() {
        $orderLastMONTH = \common\models\costfit\Order::find()
        ->where(' `order`.status >= 5  and (NOW() - INTERVAL 1 MONTH) <= (NOW() ) ')->sum('summary');
        return $orderLastMONTH;
    }

    public static function DashboarMovementNewUser() {
        $newUser = \common\models\costfit\User::find()->where('date(createDateTime)>=date_add(curdate(),interval  0 day)')->all();
        return $newUser;
        //$newOrderSumToday = \common\models\costfit\Order::find()
        //->where('createDateTime >= now() - INTERVAL 1 DAY')->sum('summary');
        // User //
        // บัตรเครดิต //
        //and createDateTime >= now() - INTERVAL 1 DAY
        //echo 'xx:' . $userCount;
        //' SELECT sum(summary) FROM costfit_test.`order`  where status >= 5 and date(`order`.`createDateTime`)>= date_add(curdate(),interval  0 day)';
        //'SELECT sum(summary) fROM costfit_test.`order` where status => 5 and date(createDateTime)>=date_add(curdate(),interval -1 week)  ';
        //'SELECT sum(summary)  FROM costfit_test.`order`  where status => 5 and MONTH(date_add(curdate(),interval  0 day))-1 <= MONTH(date_add(curdate(),interval  1 MONTH))';
    }

}
