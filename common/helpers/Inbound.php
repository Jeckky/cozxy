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
 * Description of Inbound
 *
 * @author it
 */
class Inbound {

    public static function CheckPoItems($id) {

        $products = [];
        $poCheckItems = \common\models\costfit\Po::find()->where('poId=' . $id)->one();

        foreach ($poCheckItems as $items) {
            $products[$items['poId']] = [
                'poId' => $items['poId'],
                'supplierId' => $this->SearchSuppliersName($items['supplierId']), // หาชื่อ Suppliers
                'poNo' => $items['poNo'],
                'summary' => $items['summary'],
                'receiveDate' => $items['receiveDate'],
                'receiveBy' => $items['receiveBy'],
                'arranger' => $items['arranger'],
                'status' => $items['status'],
                'createDateTime' => $items['createDateTime']
            ];
        }
        return $products;
    }

    public static function SearchSuppliersName($supplierId) {
        $supplers = \common\models\costfit\User::find()->where('userId=' . $supplierId)->one();
        if (isset($supplers) && !empty($supplers)) {
            return isset($supplers['firstname']) ? $supplers['firstname'] : 'ไม่ระบชื่อ' . '&nbsp;' . isset($supplers['lastname']) ? $supplers['lastname'] : 'ไม่ระบุนามสกุล';
        } else {
            return FALSE;
        }
    }

}
