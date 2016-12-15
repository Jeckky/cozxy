<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

/**
 * Description of AccessRule
 * https://drivesoftcenter.net/tutorial/yii2/advance/yii2-การใช้งาน-rbac-บน-yii-2-advanced-ภาค-3
 * @author it
 */
class AccessRule extends \yii\filters\AccessRule {

//put your code here
    protected function matchRole($user) {
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

                return TRUE;
            }
        }
        return FALSE;
    }

}
