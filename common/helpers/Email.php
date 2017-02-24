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
 *
 * @author it
 */
class Email {

    //put your code here
    public static function mailRegisterConfirm($toMail, $url) {//ส่งถึงสมาชิก
        \Yii::$app->mail->compose('register_confirm', ['url' => $url])
        //Yii::$app->mail->compose('register_confirm', ['url' => $url])
        ->setTo($toMail)//tomail
        ->setFrom('online@cozxy.com')
        ->setSubject('Cozxy Register Confirm')
        ->send();
    }

}
