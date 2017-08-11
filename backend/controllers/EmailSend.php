<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;

class EmailSend {

    public function mailSendPassword($toMail, $userName, $password, $location, $img, $url, $address, $lat, $long) {//ส่งรหัสผ่านที่ใช้ในการรับของให้ลูกค้า
        Yii::$app->mail->compose('sendPassword', ['userName' => $userName, 'password' => $password, 'location' => $location, 'img' => $img, 'url' => $url, 'address' => $address, 'lat' => $lat, 'long' => $long])
                ->setTo($toMail)//tomail
                ->setFrom('online@daiigroup.com')
                ->setSubject('Cozxy.com')
                ->send();
    }

    public function mailCreateProjectManager($toMail, $url, $senderName, $saleName, $status, $projectName) {//ส่งถึง ผู้จัดการฝ่ายทุกทคน ตามตาราง configuration
        $manager = \common\models\salesreport\Configuration::find()->where("code='manager'")->one();
        $managerAll = explode(',', $manager->value);
        foreach ($managerAll as $isManager) {
            $managerMail = \common\models\daiichi\Employee::find()->where("username='" . $isManager . "'")->all();
            foreach ($managerMail as $mail) {
                Yii::$app->mail->compose('mailCreateProjectManager', ['managerName' => $mail->fnTh . ' ' . $mail->lnTh, 'url' => $url, '$senderName' => $senderName, 'saleName' => $saleName, 'status' => $status, 'projectName' => $projectName])
                        ->setTo($mail->email . "@daiigroup.com")//$mail->email."@daiigroup.com"
                        ->setFrom('online@daiigroup.com')
                        ->setSubject('จดหมายแจ้งเตือน QSAF Sale Report')
                        ->send();
            }
        }
    }

    public function mailSaleReport($url, $saleName, $projectName) {
        $manager = \common\models\salesreport\Configuration::find()->where("code='manager'")->one();
        $managerAll = explode(',', $manager->value);
        foreach ($managerAll as $isManager) {
            $managerMail = \common\models\daiichi\Employee::find()->where("username='" . $isManager . "'")->all();
            foreach ($managerMail as $mail) {
                Yii::$app->mail->compose('sendSaleReport', ['managerName' => $mail->fnTh . ' ' . $mail->lnTh, 'url' => $url, 'saleName' => $saleName, 'projectName' => $projectName])
                        ->setTo($mail->email . "@daiigroup.com")//$mail->email."@daiigroup.com"
                        ->setFrom('online@daiigroup.com')
                        ->setSubject('จดหมายแจ้งเตือน QSAF Sale Report')
                        ->send();
            }
        }
    }

    public function mailAppSaleReport($toMail, $url, $saleName, $projectName, $senderName, $status) {
        Yii::$app->mail->compose('approveSaleReport', ['url' => $url, '$senderName' => $senderName, 'saleName' => $saleName, 'status' => $status, 'projectName' => $projectName])
                ->setTo($toMail)//tomail
                ->setFrom('online@daiigroup.com')
                ->setSubject('จดหมายแจ้งเตือน QSAF Sale Report')
                ->send();
    }

}
