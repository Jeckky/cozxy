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
use common\models\costfit\ProductSuppliers;

/**
 * Description of Product
 *
 * @author sna
 */
class Product {

    //put your code here
    public static function generateProductCode() {
        $lastCode = ProductSuppliers::find()->where("1")->orderBy("productSuppId DESC")->one();
        if (isset($lastCode) && !empty($lastCode) && $lastCode->code != '' && $lastCode->code != null) {
            $char = $lastCode->code;
        } else {
            $char = 'AA0AA00';
        }
        $char1 = substr($char, -1); //ตัวที่ 1
        $result1 = Product::IntegerPlus($char1);
        $char2 = substr($char, -2, 1); // ตัวที่ 2
        if ($char1 == '9') {//ถ้าตัวที่ 1 = 9 ให้ + ตัวที่ 2
            $result2 = Product::IntegerPlus($char2);
        } else {
            $result2 = $char2;
        }
        $ot = $char1 . $char2; //ot - > one to two
        $char3 = substr($char, -3, 1);
        if ($ot == '99') {
            $result3 = Product::characterPlus($char3);
        } else {
            $result3 = $char3;
        }
        $oth = substr($char, 4, 3); //$oth->one to three
        $char4 = substr($char, -4, 1);
        if ($oth == 'Z99') {
            $result4 = Product::characterPlus($char4);
        } else {
            $result4 = $char4;
        }
        $of = substr($char, 3, 4); //$oth->one to three
        $char5 = substr($char, -5, 1);
        if ($of == 'ZZ99') {
            $result5 = IntegerPlus($char5);
        } else {
            $result5 = $char5;
        }
        $ofv = substr($char, 2, 5); //$ofv one to five
        $char6 = substr($char, -6, 1);
        if ($ofv == '9ZZ99') {
            $result6 = IntegerPlus($char6);
        } else {
            $result6 = $char6;
        }
        $os = substr($char, 1, 6); //$ofv one to five
        $char7 = substr($char, -7, 1);
        if ($os == 'Z9ZZ99') {
            $result7 = characterPlus($char7);
        } else {
            $result7 = $char7;
        }
        $productCode = $result7 . $result6 . $result5 . $result4 . $result3 . $result2 . $result1;
        return $productCode;
    }

    public static function IntegerPlus($num) {
        $result = $num + 1;
        if ($num == 9) {
            $result = 0;
        }
        return $result;
    }

    public static function CharacterPlus($char) {
        switch ($char) {
            case 'A':
                return 'B';
                break;
            case 'B':
                return 'C';
                break;
            case 'C':
                return 'D';
                break;
            case 'D':
                return 'E';
                break;
            case 'E':
                return 'F';
                break;
            case 'F':
                return 'G';
                break;
            case 'G':
                return 'H';
                break;
            case 'H':
                return 'I';
                break;
            case 'I':
                return 'J';
                break;
            case 'J':
                return 'K';
                break;
            case 'K':
                return 'L';
                break;
            case 'L':
                return 'M';
                break;
            case 'M':
                return 'N';
                break;
            case 'N':
                return 'O';
                break;
            case 'O':
                return 'P';
                break;
            case 'P':
                return 'Q';
                break;
            case 'Q':
                return 'R';
                break;
            case 'R':
                return 'S';
                break;
            case 'S':
                return 'T';
                break;
            case 'T':
                return 'U';
                break;
            case 'U':
                return 'V';
                break;
            case 'V':
                return 'W';
                break;
            case 'W':
                return 'X';
                break;
            case 'X':
                return 'Y';
                break;
            case 'Y':
                return 'Z';
                break;
            case 'Z':
                return 'A';
                break;
        }
    }

}
