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

        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            ## User Login Only
            $getUser = str_replace('[', '', str_replace(']', '', $user->identity->user_group_Id));
            $explodeUser = explode(',', $getUser);

            $get_menu_uri = substr($_SERVER["REQUEST_URI"], 1);
            //throw new \yii\base\Exception($get_menu_uri);
            $get_menu_name = \common\models\costfit\Menu::find()->where('link= "' . $get_menu_uri . '" ')->one();
            if ($get_menu_name) {
                $link = $get_menu_name->link;
                $menuId = $get_menu_name->menuId;
                $user_group_Id = $get_menu_name->user_group_Id;
                $user_group = str_replace('[', '', str_replace(']', '', $user_group_Id));
                $get_user_group_Id = explode(',', $user_group);
                $get_menu_group = $get_user_group_Id[0];
                $user_group_intersect = array_intersect($explodeUser, $get_user_group_Id);
                if ($user_group_intersect) {
                    //$user_group_intersect = TRUE;
                } else {
                    //$user_group_intersect = FALSE;
                }
            } else {
                $get_menu_group = $user->identity->user_group_Id;
            }
            //
            ///throw new \yii\base\Exception($user_group_intersect);
            //throw new \yii\base\Exception($user_group_intersect);
            //throw new \yii\base\Exception($user->identity->user_group_Id . '==' . $get_menu_name->link . '::' . $user_group[0] . '::' . $role);
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

    protected function matchRole1($user) {
        //parent::matchRole($user);
        if (empty($this->roles)) {
            return TRUE;
        }
        foreach ($this->roles as $role) {
            /*
             * ถ้า role เท่ากับ ? และ ผู้ใช้ยังไม่ได้ล็อกอิน
             */
            if ($role == '?' && $user->getIsGuest()) {
                return TRUE;
            }
            /*
             * ถ้า role เท่ากับ @ และผู้ใช้ยังล็อกอินสำเร็จ
             */ else if ($role == '@' && !$user->getIsGuest()) {

                return TRUE;
            }
            /*
             * หรือ ถ้า ผู้ใช้ล๊อกอินสำเร็จ และ role เท่ากับ role ของ ผู้ใช้ที่ล็อกอินอยู่
             */ else if (!$user->getIsGuest() && $role == $user->identity->user_group_Id) {
                $menuRe = str_replace('[', '', str_replace(']', '', $user->identity->user_group_Id));
                $memuEx = explode(',', $menuRe);
                ## User Login Only
                $user_group_Id = Yii::$app->user->identity->user_group_Id;
                $userRe = str_replace('[', '', str_replace(']', '', $user_group_Id));
                $userEx = explode(',', $userRe);
                if (array_intersect($userEx, $memuEx)) {
                    //echo '(checked)' . '::' . $value->user_group_Id;
                    //print_r(array_intersect($userEx, $memuEx));
                    return print_r(array_intersect($userEx, $memuEx));
                } else {
                    echo '(No)   ';
                    return '(No)   ';
                }
            }
        }
        return FALSE;
    }

}
