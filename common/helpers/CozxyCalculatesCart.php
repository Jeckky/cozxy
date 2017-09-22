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
    /*
     * ภาษีมูลค่าเพิ่ม VAT 7%
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
        $result = ( $TotalExVat + $vat);
        return $result;
    }

    public static function FormulaTotal($total, $coupon) {
        $result = ( $total - $coupon);
        return round($result, 0, PHP_ROUND_HALF_UP);
    }

}
