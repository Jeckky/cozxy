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
 * Description of Booth
 * Create By Taninut.bm
 * Create Date : 7/03/2017
 * @author it
 */
class KPayment
{

    //put your code here
    public static function getResultMessage($code)
    {
        switch ($code) {
            case "00":
                return ["Approved", "ชาระเงินสาเร็จ"];
                break;
            case "01":
                return ["Refer to Card Issuer", "โปรดติดต่อธนาคารผู้ออกบัตร"];
                break;
            case "03":
                return ["Invalid Merchant ID", "ไม่อนุญาติให้รับบัตรประเภทนี้"];
                break;
            case "05":
                return ["Do Not Honour", "โปรดติดต่อธนาคารผู้ออกบัตร"];
                break;
            case "12":
                return ["Invalid Transaction", "รายการผิดพลาดเนื่องจากระบบธนาคารไม่พร้อมให้บริการ"];
                break;
            case "13":
                return ["Invalid Amount", "จานวนเงินไม่ถูกต้อง"];
                break;
            case "14":
                return ["Invalid Card Number", "หมายเลขบัตรเครดิตไม่ถูกต้อง"];
                break;
            case "17":
                return ["Customer Cancellation", "ลูกค้ายกเลิกการทารายการ"];
                break;
            case "19":
                return ["Re-enter Transaction", "รายการชาระเงินซ้า"];
                break;
            case "30":
                return ["Format Error", "รายการผิดพลาดเนื่องจากระบบธนาคารไม่พร้อมให้บริการ"];
                break;
            case "41":
                return ["Lost Card - Pick Up", "บัตรได้รับการแจ้งสูญหาย"];
                break;
            case "43":
                return ["Stolen Card - Pick Up", "บัตรถูกขโมย"];
                break;
            case "50":
                return ["Invalid Payment Condition", "เงื่อนไขการชาระเงินไม่ถูกต้อง"];
                break;
            case "51":
                return ["Insufficient Funds", "วงเงินบัตรเครดิตไม่พอ"];
                break;
            case "54":
                return ["Expired Card", "ใส่วันที่บัตรหมดอายุผิด"];
                break;
            case "58":
                return ["Transaction not Permitted to Terminal", "ธนาคารผู้ออกบัตรไม่อนุญาตให้ใช้บัตรนี้มาชาระเงิน"];
                break;
            case "91":
                return ["Issuer or Switch is Inoperative", "ระบบของธนาคารผู้ออกบัตรไม่พร้อมให้บริการ"];
                break;
            case "94":
                return ["Duplicate Transmission", "รายการชาระเงินซ้า"];
                break;
            case "96":
                return ["System Malfunction", "รายการผิดพลาดเนื่องจากระบบธนาคารไม่พร้อมให้บริการ"];
                break;
            case "xx":
                return ["Transaction Timeout", "รายการผิดพลาดเนื่องจากระบบธนาคารไม่พร้อมให้บริการ"];
                break;
        }
    }

}
