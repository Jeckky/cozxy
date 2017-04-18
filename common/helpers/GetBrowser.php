<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;

/**
 * Description of GetBrowser
 *
 * @author it
 * 27/12/2016 By Taninut.Bm
 */
class GetBrowser {

    //put your code here
    public static function Browser() {

        $ExactBrowserNameUA = $_SERVER['HTTP_USER_AGENT'];

        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR = "Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR = "Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR = "Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR = "Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/") == false and strpos(strtolower($ExactBrowserNameUA), "chrome/") == false) {
            // SAFARI
            $ExactBrowserNameBR = "Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR = "OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }

    public static function UserAgent() {
        $iPod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
        //file_put_contents('./public/upload/install_log/agent', $_SERVER['HTTP_USER_AGENT']);
        if ($iPad || $iPhone || $iPod || $android) {
            return 'mobile';
            //} else if ($android) {
            //return 'android';
        } else {
            return 'computer';
        }
    }

}
