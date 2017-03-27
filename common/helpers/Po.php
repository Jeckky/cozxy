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
 * Description of Po
 *
 * @author it , Taninut.Bm
 * create date : 27/03/2017
 * Support Suppliers.
 * emial : taninut.b@cozxy.com , sodapew17@gmial.com
 */
class Po {
    /*
     * หารายการของใบ Po
     */

    public static function PoSuppliers_Bk($token) {
        $poSuppliers = \common\models\costfit\Order::find()
        ->select('`order`.orderId,`order`.userId,`order`.orderNo,`order`.invoiceNo ,`order`.updateDateTime, `order`.`status`,
          `order_item`.orderItemId,`order_item`.productSuppId, `product_suppliers`.userId')
        ->joinWith(['orderItems'])
        ->join('LEFT JOIN', 'product_suppliers', 'product_suppliers.productSuppId = order_item.productSuppId')
        ->where("`order`.status = " . \common\models\costfit\Order::ORDER_STATUS_CREATEPO . " and  `product_suppliers`.userId = " . $token)
        ->groupBy(['`order`.orderNo'])
        ->all();

        return isset($poSuppliers) ? $poSuppliers : NULL;
    }

    public static function Posuppliers($token) {
        $poSuppliers = \common\models\costfit\StoreProductGroup::find()
        ->where("status = " . \common\models\costfit\StoreProductGroup::STATUS_IMPORT_DATA . " and  supplierId = " . $token)
        ->all();
        return isset($poSuppliers) ? $poSuppliers : NULL;
    }

}
