<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

/**
 * Description of CozxyCalculatesCart
 * Create Date 21/09/2017
 * @author it
 * mode จะประกอบไปด้วย
  PHP_ROUND_HALF_UP : ถึง 5 ปัดขึ้น
  PHP_ROUND_HALF_DOWN : ต่อให้ถึง 5 ก็ปัดลง
  PHP_ROUND_HALF_EVEN : จำนวนเต็มเป็นเลขคี่และถึง 5 ปัดขึ้น
  PHP_ROUND_HALF_ODD : จำนวนเต็มเป็นเลขคู่และถึง 5 ปัดขึ้น
 */
class CozxyCalculatesCart {
    /*
     * ภาษีมูลค่าเพิ่ม
     */

    public static function FormulaVAT($TotalExVat) {
        $result = $TotalExVat * 0.07;
        return round($result, 0, PHP_ROUND_HALF_UP);
    }

    /*
     * ราคาสินค้าไม่รวมภาษี
     */

    public static function FormulaTotalExVat($total) {
        $result = $total / 1.07;
        return round($result, 0, PHP_ROUND_HALF_UP);
    }

    /*
     * สวนลดพิเศษ : Coupon
     */

    public static function FormulaExtraSaving() {

    }

    /*
     * ราคาสินค้ารวมภาษีมูลค่าเพิ่ม
     */

    public static function FormulaSubTotal($TotalExVat, $vat) {
        $result = $TotalExVat + $vat;
        return $result;
    }

}
