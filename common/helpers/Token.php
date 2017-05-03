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
 * Description of Checkouts
 *
 * @author it , Taninut.Bm
 * Create Date : 27/03/2017
 */
class Token
{

    public static function getToken()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('orderToken')) {
            return $cookies->getValue('orderToken');
        } else {
            self::generateNewToken();
            $cookies = Yii::$app->request->cookies;
//            echo print_r($cookies, true);
//            throw new \yii\base\Exception(111);
//            if (!isset($cookies['orderToken'])) {
//                $cookies = Yii::$app->request->cookies;
//        }
            return $cookies->getValue('orderToken');
        }
    }

    public static function getTokenToAnothor()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('orderToken')) {
            return $cookies->getValue('orderToken');
        } else {
//            $obj->generateNewToken();
            self::generateNewToken();
            $cookies = Yii::$app->request->cookies;
//            echo print_r($cookies, true);
//            throw new \yii\base\Exception(111);
//            if (!isset($cookies['orderToken'])) {
//                $cookies = Yii::$app->request->cookies;
//        }
            return $cookies->getValue('orderToken');
        }
    }

    public static function generateNewToken()
    {
//        $cookies = Yii::$app->request->cookies;
//        if (!$cookies->has('orderToken')) {
        $cookiesNew = Yii::$app->response->cookies;
//        $cookiesNew->add(new \yii\web\Cookie([
//            'name' => 'orderToken',
//            'value' => Yii::$app->security->generateRandomString(),
////                'expire' => time() + 86400 * 365,
//        ]));

        $cookie = new \yii\web\Cookie();
        $cookie->name = "orderToken";
        $cookie->value = Yii::$app->security->generateRandomString();
//        $cookie->expire = time() + 86400 * 365;
        Yii::$app->response->cookies->add($cookie);
//            throw new \yii\base\Exception(print_r($cookiesNew, true));
//        } else {
//
//            throw new \yii\base\Exception(1234);
//        }
    }

}
