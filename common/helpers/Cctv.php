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
 * Description of Local
 *
 * @author it
 */
class Cctv
{

//put your code here


    public static function SendText($url = "192.168.15.5", $port = "7002", $orderNo = "OD2017060001", $user = "kamyjap@gmail.com", $status = "1")
    {
        $curl = curl_init();
//        $url = "telnet://192.168.15.5:7001";
        $data = "!";
        $data.="Order No:" . $orderNo;
        $data.="\n";
        $data.="User :" . $user;
        $data.="\n";
        $data.="Status:" . $status;
        $data.="|";
        $data.="\r\n";

//        curl_setopt($curl, CURLOPT_PROTOCOLS, CURLPROTO_TELNET);
        curl_setopt($curl, CURLOPT_URL, $url . ":" . $port);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $data);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}
