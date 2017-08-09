<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use common\helpers\Yii;

/**
 * Description of Email
 * Create Date : 24/02/2017
 * Create By : Taninut.BM
 * @author it
 */
class Email {

    //put your code here
    public static function mailRegisterConfirm($toMail, $url) {//ส่งถึงสมาชิกให้ยืนยันอีเมล์
        \Yii::$app->mail->compose('register_confirm', ['url' => $url])
        //Yii::$app->mail->compose('register_confirm', ['url' => $url])
        ->setTo($toMail)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject('Cozxy Email Verification')
        ->send();
    }

    //put your code here
    public static function mailForgetPassword($toMail, $url) {
        \Yii::$app->mail->compose('forget_password', ['url' => $url])
        ->setTo($toMail)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject('Forget Password Confirm')
        ->send();
    }

    public static function mailOrderMember($toMail, $Subject, $url, $type, $adress, $orderList, $receiveType) {//ส่งรายการ Order ให้สมาชิก
        \Yii::$app->mail->compose('orderToMember', ['url' => $url, 'type' => $type, 'adress' => $adress, 'order' => $orderList, 'receiveType' => $receiveType])
        ->setTo($toMail)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($Subject)
        ->send();
    }

    public static function topUpSuccess($Subject, $username, $toMail, $url, $point, $money, $paymentMethod) {
        \Yii::$app->mail->compose('topupSuccess', ['url' => $url, 'username' => $username, 'point' => $point, 'money' => $money, 'paymentMethod' => $paymentMethod])
        ->setTo($toMail)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($Subject)
        ->send();
    }

    public static function topUpBillpayment($Subject, $username, $toMail, $url, $point, $money, $paymentMethod, $bank) {
        \Yii::$app->mail->compose('billpaymentTopup', ['url' => $url, 'username' => $username, 'point' => $point, 'money' => $money, 'paymentMethod' => $paymentMethod, 'bank' => $bank])
        ->setTo($toMail)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($Subject)
        ->send();
    }

    public static function mailPoToCozxy($SubjectCozxy, $mailToCozxy, $urlFroCozxy) {
        \Yii::$app->mail->compose('poToCozxy', ['url' => $urlFroCozxy])
        ->setTo($mailToCozxy)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($SubjectCozxy)
        ->send();
    }

    public static function mailPoToSupplier($SubjectSupp, $username, $toMailSupp, $urlFroSupplier) {
        \Yii::$app->mail->compose('poToSupplier', ['url' => $urlFroSupplier, 'username' => $username])
        ->setTo($toMailSupp)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($SubjectSupp)
        ->send();
    }

    public static function mailContactCozxy($Subject, $customerMail, $customerName, $customerPhone, $customerMsg) {
        \Yii::$app->mail->compose('contactCozxy', ['customerMail' => $customerMail, 'customerName' => $customerName, 'customerPhone' => $customerPhone, 'customerMsg' => $customerMsg])
        ->setTo('online@cozxy.com')//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($Subject)
        ->send();
    }

    public static function mailReturnResult($mailTo, $ticketNo, $currentPoint, $returnPoint, $orderNo, $username, $status, $remark, $booth, $listReturn) {
        $Subject = 'Result for retun product.';
        \Yii::$app->mail->compose('cozxyReturn', ['ticketNo' => $ticketNo, 'currentCoin' => $currentPoint, 'returnCoin' => $returnPoint, 'orderNo' => $orderNo, 'username' => $username, 'status' => $status, 'remark' => $remark, 'booth' => $booth, 'listReturn' => $listReturn])
        ->setTo($mailTo)//tomail
        ->setFrom('cozxy@cozxy.com')
        ->setSubject($Subject)
        ->send();
    }

}
