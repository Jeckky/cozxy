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
 * Description of CozxyCalculatesCart
 * Create Date 21/09/2017
 * @author it
 * ฟังก์ชั่นของ PHP ที่ใช้สำหรับปัดเศษนั้น มีอยู่ทั้งหมด 3 ฟังก์ชั่น คือ floor() , ceil() และฟังก์ชั่น round() ที่ผมจะกล่าวในวันนี้
  ฟังก์ชั่น round() นั้นเราสา่มารถกำหนดได้ว่าจะเอาผลลัพธ์เป็นทศนิยมกี่ตำแหน่ง และการทำงานของฟังก์ชั่นนี้ ถ้าถึง 5 จะปัดขึ้น ถ้าน้อยกว่า 5 จะปัดลง
 * mode จะประกอบไปด้วย
  PHP_ROUND_HALF_UP : ถึง 5 ปัดขึ้น
  PHP_ROUND_HALF_DOWN : ต่อให้ถึง 5 ก็ปัดลง
  PHP_ROUND_HALF_EVEN : จำนวนเต็มเป็นเลขคี่และถึง 5 ปัดขึ้น
  PHP_ROUND_HALF_ODD : จำนวนเต็มเป็นเลขคู่และถึง 5 ปัดขึ้น

 * *
 * #############################################

 *  echo round( 1.54 );
  //2
  echo round( 1.216 ,2 );
  //1.22
  echo round( -1.555 ,2 );
  //-1.56
  echo round( -1.213,2 );
  //-1.21

 */
class CozxyCalculatesCart {

    public static function UserOrder($orderIdParams) {
        $orderIdParams = $orderIdParams;
        //echo $orderIdParams;
        //exit();
        $cartOrderId = \common\models\costfit\Order::findCartArray();
        //echo '<pre>';
        // print_r($cartOrderId);
        ///throw new \yii\base\Exception(print_r($cartOrderId['orderId'], true));

        if (isset($cartOrderId['orderId'])) {
            //echo '1';
            $Order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId=' . $cartOrderId['orderId'])->orderBy('orderId desc')->one();
            if (isset($Order->orderId)) {
                $OrderItemSumTotal = \common\models\costfit\OrderItem::find()->where('orderId=' . $Order->orderId)->sum('total');
            } else {
                $OrderItemSumTotal = 0;
            }
            if (isset($Order->couponId)) {
//              $coupon = \common\models\costfit\Coupon::find()->where('couponId=' . $Order->couponId)->one();
//              $couponValue = $coupon->discountValue;
                $couponValue = $Order->discount;
            } else {
                $couponValue = 0;
            }
        } else {
            //echo '1.1';
            //echo '1.3';
            $Order = \common\models\costfit\Order::find()->where('userId=' . Yii::$app->user->id . ' and orderId=' . $orderIdParams)->orderBy('orderId desc')->one();
            $orderId = $Order->attributes['orderId'];
            if (isset($orderId)) {
                $OrderItemSumTotal = \common\models\costfit\OrderItem::find()->where('orderId=' . $orderId)->sum('total');
            } else {
                $OrderItemSumTotal = 0;
            }
            if (isset($Order->couponId)) {
                //              $coupon = \common\models\costfit\Coupon::find()->where('couponId=' . $Order->couponId)->one();
//              $couponValue = $coupon->discountValue;
                $couponValue = $Order->discount;
            } else {
                $couponValue = 0;
            }
        }


        $OrderTotle = $OrderItemSumTotal - $couponValue;
        return round($OrderTotle, 0, PHP_ROUND_HALF_UP);
    }

    /*
      $total = CozxyCalculatesCart::FormulaTotal($OrderItemSumTotal, $couponValue);
      $TotalExVat = CozxyCalculatesCart::FormulaTotalExVat($total);
      $vat = CozxyCalculatesCart::FormulaVAT($TotalExVat);
      $SubTotal = CozxyCalculatesCart::FormulaSubTotal($TotalExVat, $vat);
     */

    public static function FormulaTotal($orderIdParams) {
        $result = \common\helpers\CozxyCalculatesCart::UserOrder($orderIdParams);
        return round($result, 0, PHP_ROUND_HALF_UP);
    }

    /*
     * ราคาสินค้าไม่รวมภาษี
     */

    public static function FormulaTotalExVat($orderIdParams) {
        $total = \common\helpers\CozxyCalculatesCart::UserOrder($orderIdParams);
        $result = $total / 1.07;
        //return round($result, 0, PHP_ROUND_HALF_UP);
        return $result;
    }

    /*
     * ภาษีมูลค่าเพิ่ม VAT 7%
     */

    public static function FormulaVAT($orderIdParams) {
        $TotalExVat = \common\helpers\CozxyCalculatesCart::FormulaTotalExVat($orderIdParams);
        $result = $TotalExVat * 0.07;
        //return round($result, 0, PHP_ROUND_HALF_UP);
        return $result;
    }

    /*
     * สวนลดพิเศษ : Coupon
     */

    public static function FormulaExtraSaving() {

    }

    /*
     * ราคาสินค้ารวมภาษีมูลค่าเพิ่ม
     */

    public static function FormulaSubTotal($orderIdParams) {
        $TotalExVat = \common\helpers\CozxyCalculatesCart::FormulaTotalExVat($orderIdParams);
        $vat = \common\helpers\CozxyCalculatesCart::FormulaVAT($orderIdParams);
        $result = ( $TotalExVat + $vat);
        return $result;
    }

    public static function TestCart() {
        echo $this->content;
    }

    public static function ShowCalculatesCartCart($orderIdParams) {

        $CozxyCalculatesCart['total'] = number_format(CozxyCalculatesCart::FormulaTotal($orderIdParams), 2);
        $CozxyCalculatesCart['TotalExVat'] = number_format(CozxyCalculatesCart::FormulaTotalExVat($orderIdParams), 2);
        $CozxyCalculatesCart['vat'] = number_format(CozxyCalculatesCart::FormulaVAT($orderIdParams), 2);
        $CozxyCalculatesCart['SubTotal'] = number_format(CozxyCalculatesCart::FormulaSubTotal($orderIdParams), 2);
        return $CozxyCalculatesCart;
    }

    public static function DiscountProduct($marketPrice, $supplierPrice) {
        //((1000-800)/1000)x100 หาเปอร์เซ็นของที่ลดไป
        //if ($marketPrice == 0) {
        if ($marketPrice != '0.00') {
            $master = ($marketPrice - $supplierPrice) / $marketPrice;
            $percen = $master * 100;
            if (round($percen, 0, PHP_ROUND_HALF_UP) >= 10) {
                return '<span class="discount"> ' . round($percen, 0, PHP_ROUND_HALF_UP) . '</span>' . '<span class="percen-discount">%</span>';
            } else {
                return 'Lessthan10';
            }
        } else {
            return 'Lessthan10';
        }
    }

}
