<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\models;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Description of DisplayMyTracking
 *
 * @author it
 */
class DisplayMyTracking {

    //put your code here
    public static function productShowTracking($orderId) {
        /*
          - on process
          order status  5 6 7 8 9 10 11 12 13 14 15

          - shipping
          order status  14

          - complete
          order status 15
         */
        $products = [];
        $orderTracking = \common\models\costfit\Order::find()
        ->select(' count(`order_item`.quantity) as QIquantity , `user`.firstname ,`user`.lastname, `order`.*  ')
        ->join(" LEFT JOIN", "order_item", "order_item.orderId  = order.orderId")
        ->join(" LEFT JOIN", "user", "user.userId  = order.userId")
        ->where('order.userId=' . Yii::$app->user->id . ' and order.status >=5 and order.orderId=' . $orderId)
        ->groupBy('orderId')
        ->all();
        foreach ($orderTracking as $items) {
            $products[$items->orderId] = [
                'orderId' => $items->orderId,
                'item' => $items->QIquantity,
                'firstname' => $items->firstname,
                'lastname' => $items->lastname,
                'title' => '',
                'head' => '',
                'invoiceNo' => $items->invoiceNo,
                'updateDateTime' => $items->updateDateTime,
                'status' => $items->status,
            ];
        }
        return $products;
    }

}
