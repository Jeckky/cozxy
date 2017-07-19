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
    /*
     * ค้าหาใบ PO
     * Date : 19/07/2017
     * By Taninut.Bm
     * Email : taninut,b@cozxy.com
     */

    public static function CheckPo($PoNo) {

        $products = [];
        $poInfo = \common\models\costfit\Po::find()->where('poNo="' . $PoNo . '"')->one();

        $products['poInfo'] = [
            'poId' => $poInfo['poId'],
            'supplierId' => \common\helpers\Inbound::SearchSuppliersName($poInfo['supplierId']), // หาชื่อ Suppliers
            'poNo' => $poInfo['poNo'],
            'summary' => $poInfo['summary'],
            'receiveDate' => $poInfo['receiveDate'],
            'receiveBy' => \common\helpers\Inbound::SearchSuppliersName($poInfo['receiveBy']), // หาชื่อผู้ตรวจรับ,
            'arranger' => \common\helpers\Inbound::SearchSuppliersName($poInfo['arranger']), // หาชื่อผู้จัดเรียง,
            'status' => \common\models\costfit\Po::getStatusText($poInfo['status']),
            'createDateTime' => $poInfo['createDateTime']
        ];

        return $products;
    }

    /*
     * ค้าหา Items Po ว่ามีสินค้าอะไรบ้าง
     * Date : 19/07/2017
     * By Taninut.Bm
     * Email : taninut,b@cozxy.com
     */

    public static function CheckPoItems($PoNo) {

        $products = [];
        $po = \common\models\costfit\Po::find()->where('poNo="' . $PoNo . '"')->one();
        $poItems = \common\models\costfit\PoItem::find()->where('poId="' . $poInfo['poId'] . '"')->all();

        foreach ($productPost as $value) {
            $products[$value->poId] = [
                'poId' => $poInfo['poId'],
            ];
        }

        return $products;
    }

    /*
     * ค้าหาชื่อ User ของ Type ต่างๆ
     * Date : 19/07/2017
     * By Taninut.Bm
     * Email : taninut,b@cozxy.com
     */

    public static function SearchSuppliersName($supplierId) {
        if (isset($supplers) && !empty($supplers)) {
            $supplers = \common\models\costfit\User::find()->where('userId=' . $supplierId)->one();
            return isset($supplers['firstname']) ? $supplers['firstname'] : 'ไม่ระบชื่อ' . '&nbsp;' . isset($supplers['lastname']) ? $supplers['lastname'] : 'ไม่ระบุนามสกุล';
        } else {
            return FALSE;
        }
    }

}
