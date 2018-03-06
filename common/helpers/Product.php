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
        $lastCode = ProductSuppliers::find()->where("code is not null and code!='' ")->orderBy("code DESC")->one();
        if (isset($lastCode)) {
            $char = $lastCode->code;
            $productCode = $char;
            $productCode++;
        } else {
            $char = 'AA0AA00';
            $productCode = $char;
        }
        return $productCode;
    }

    public static function generateProductCode2() {
        $lastCode = \common\models\costfit\Product::find()->where("code is not null and code!='' ")->orderBy("code DESC")->one();
        if (isset($lastCode)) {
            $char = $lastCode->code;
            $productCode = $char;
            $productCode++;
        } else {
            $char = 'AA0AA00';
            $productCode = $char;
        }
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
