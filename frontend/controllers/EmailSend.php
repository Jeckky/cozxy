<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\controllers;

use Yii;

class EmailSend
{

    public function mailRegisterConfirm($toMail, $url, $senderName, $recieverName, $status, $projectName)
    {//ส่งถึง พนักงานขาย
        Yii::$app->mail->compose('register_confitm', ['url' => $url])
        ->setTo($toMail)//tomail
        ->setFrom('online@daiigroup.com')
        ->setSubject('Cos.fit Register Confirm')
        ->send();
    }

    public function mailCreateProjectManager($toMail, $url, $senderName, $saleName, $status, $projectName)
    {//ส่งถึง ผู้จัดการฝ่ายทุกทคน ตามตาราง configuration
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

    public function mailSaleReport($url, $saleName, $projectName)
    {
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

    public function mailAppSaleReport($toMail, $url, $saleName, $projectName, $senderName, $status)
    {
        Yii::$app->mail->compose('approveSaleReport', ['url' => $url, '$senderName' => $senderName, 'saleName' => $saleName, 'status' => $status, 'projectName' => $projectName])
        ->setTo($toMail)//tomail
        ->setFrom('online@daiigroup.com')
        ->setSubject('จดหมายแจ้งเตือน QSAF Sale Report')
        ->send();
    }

}
