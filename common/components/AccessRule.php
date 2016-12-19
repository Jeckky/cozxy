<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;

/**
 * Description of AccessRule
 * https://drivesoftcenter.net/tutorial/yii2/advance/yii2-การใช้งาน-rbac-บน-yii-2-advanced-ภาค-3
 * @author it
 */
class AccessRule extends \yii\filters\AccessRule {

//put your code here
    protected function matchRole($user) {
        $getUser = str_replace('[', '(', str_replace(']', ')', $user->identity->user_group_Id));
        echo print_r($this->roles);
        echo '<br>';
        echo print_r($getUser);

        if (empty($this->roles)) {
            return true;
        }
        echo 'xxx';
        foreach ($this->roles as $role) {
            echo 'xx : ' . $role;
            // exit();
            /*
             * User Login Only
             * เอา user_group_id จากการ login ของ  table user
             */
            $getUser = str_replace('[', '', str_replace(']', '', $user->identity->user_group_Id));
            $explodeUser = explode(',', $getUser);
            /*
             * get uri menu
             */
            $get_uri = count(explode('/', $_SERVER["REQUEST_URI"]));
            $get_menu_uri = substr($_SERVER["REQUEST_URI"], 1);
            /*
             * get user_group_id จาก table manu @$getUser
             */
            $get_menu_name = \common\models\costfit\Menu::find()->where('link= "' . $get_menu_uri . '" ')->one();
            if ($get_menu_name) {
                $link = $get_menu_name->link;
                $menuId = $get_menu_name->menuId;
                $user_group_Id = $get_menu_name->user_group_Id;
                $user_group = str_replace('[', '', str_replace(']', '', $user_group_Id));
                $get_user_group_Id = explode(',', $user_group);

                $get_menu_group = $get_user_group_Id[0];

                //throw new \yii\base\Exception(print_r($get_user_group_Id));
                //$user_group_intersect = array_intersect(settype($getUser, "array"), settype($user_group, "array"));
                //throw new \yii\base\Exception(settype($getUser, "array"));
                //throw new \yii\base\Exception(settype($getUser, "array") . 'xxx' . settype($user_group, "array") . 'xxx' . gettype($getUser) . 'xxx' . gettype($user_group));
                //if ($user_group_intersect) {
                //$user_group_intersect = $user_group_intersect[1];
                //} else {
                //$user_group_intersect = $user->identity->user_group_Id;
                //}
            } else {
                $get_menu_group = $user->identity->user_group_Id;
            }

            //throw new \yii\base\Exception($user_group_intersect[0]);

            /* ถ้า role เท่ากับ ? และ ผู้ใช้ยังไม่ได้ล๊อกอิน */
            if ($role == '?' && $user->getIsGuest()) {
                return true;
            }

            /*
             * ถ้า role เท่ากับ @ และ ผู้ใช้ยังล๊อกอินสำเร็จ
             */ else if ($role == '@' && !$user->getIsGuest()) {
                return true;
            }

            /* หรือ ถ้า ผู้ใช้ล๊อกอินสำเร็จ และ role เท่ากับ role ของ ผู้ใช้ที่ล๊อกอินอยู่
             */ elseif (!$user->getIsGuest() && $role == $get_menu_group) {
                return true;
            }
        }
        return false;
    }

}
