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
class Locker
{

//put your code here


    public static function Open($locker, $num)
    {
//        throw new \yii\base\Exception($locker->ip);
        $masterKey = \common\models\costfit\Configuration::find()->where("title = 'lockerMasterKey'")->one();
        $params = array('iLockerHQ17', // generalprofile lockercode
            'Cozxy Locker Demo', // generalprofile lockername
            'Cozxy-01', // serialnumber
            $num, // number lockers
            $masterKey->value, // masterkey
            'nimita', // username unlock
            $locker->ip); // locker url
        $result = self::call_webapi("open_locker", $params);
        switch ($result['header']) {
            case 200 :
                return $result['body'];
            default:
                header('Error: ' . $result['error'], true, $result['header']);
                return array('Error' => $result['header'] . ' ' . $result['error']);
        }
    }

    public static function call_webapi($api, $params)
    {
        // Check authen
//        $auth = $this->customauth->auth_login();
//        if ($auth != null) {
//        $url = APIPATH . "/" . $api;
        $url = "http://$params[6]/iLockerWebAPI/index_api.php/$api";
//        throw new \yii\base\Exception(print_r($params, true));
        $token = base64_encode('admin' . ':' . 'admin');
        $result = self::get_result_from_api($url, $token, $params);
//        } else {
//            $result = array("header" => 401, "error" => 'Unauthorized');
//        }
        return $result;
    }

    public static function get_result_from_api($url, $token, $data)
    {
        $curl = curl_init();
//        throw new \yii\base\Exception(json_encode($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . $token
        ));

        $curl_response = curl_exec($curl);
        $curl_httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//        throw new \yii\base\Exception(print_r($curl_response, true));
        curl_close($curl);

        $result = self::get_result_from_http_code($curl_httpcode, $curl_response, $data);

        return $result;
    }

    public static function get_result_from_http_code($http_code, $http_response, $data)
    {
        $resp_decode = json_decode($http_response);
        $resp = array();
        if (isset($resp_decode) && count($resp_decode) > 0) {
            foreach ($resp_decode as $key => $value) {
                $resp[$key] = $value;
            }
            switch ($http_code) {
                case 200:
                    return array("header" => $http_code, "body" => $resp);
                default:
                    return array("header" => $http_code, "error" => $resp["message"]);
            }
        } else {
            throw new \yii\base\Exception(print_r($data, TRUE));
        }
    }

    public static function Open2($locker, $num)
    {
//        throw new \yii\base\Exception($locker->ip);
        $masterKey = \common\models\costfit\Configuration::find()->where("title = 'lockerMasterKey'")->one();
        $params = array('iLockerHQ17', // generalprofile lockercode
            'Cozxy Locker Demo', // generalprofile lockername
            'Cozxy-01', // serialnumber
            $num, // number lockers
            $masterKey->value, // masterkey
            'nimita', // username unlock
            $locker->ip); // locker url
        $result = self::call_webapi2("open_locker", $params);
        switch ($result['header']) {
            case 200 :
                return $result['body'];
            default:
                header('Error: ' . $result['error'], true, $result['header']);
                return array('Error' => $result['header'] . ' ' . $result['error']);
        }
    }

    public static function call_webapi2($api, $params)
    {
        // Check authen
//        $auth = $this->customauth->auth_login();
//        if ($auth != null) {
//        $url = APIPATH . "/" . $api;
        $url = "http://$params[6]/ilocker/iLockerWebAPI/index_api.php/$api";
//        throw new \yii\base\Exception(print_r($params, true));
        $token = base64_encode('admin' . ':' . 'admin');
        $result = self::get_result_from_api($url, $token, $params);
//        } else {
//            $result = array("header" => 401, "error" => 'Unauthorized');
//        }
        return $result;
    }

}
