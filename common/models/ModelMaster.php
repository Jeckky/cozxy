<?php

namespace common\models;

use Yii;

class ModelMaster extends \yii\db\ActiveRecord {

    const DATE_THAI_TYPE_FULL = 1;
    const DATE_THAI_TYPE_SHORT = 2;
    const TAB_TYPE_PHOTO = 1;
    const TAB_TYPE_DETAIL = 2;
    const TAB_TYPE_AMENITY = 3;
    const TAB_TYPE_MAP = 4;
    const TAB_TYPE_STREET_VIEW = 5;
    const USER_ASSET_TYPE_OWNER = 1;
    const USER_ASSET_TYPE_AGENCY = 2;

    public $searchText;
    public $monthFull = [
        1 => 'มกราคม',
        'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน',
        'ตุลาคม',
        'พฤศจิกายน',
        'ธันวาคม',
    ];
    public $monthShort = [
        1 => 'ม.ค.',
        'ก.พ.',
        'มี.ค.',
        'เม.ย.',
        'พ.ค.',
        'มิ.ย.',
        'ก.ค.',
        'ส.ค.',
        'ก.ย.',
        'ต.ค.',
        'พ.ย.',
        'ธ.ค.',
    ];

    public function writeToFile($fileName, $text, $mode = 'w+') {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $text);
        fclose($handle);
    }

    public function thaiDate($date, $type = self::DATE_THAI_TYPE_FULL) {
        $d = explode('-', $date);
        $year = $d[0] + 543;
        $month = ($type == self::DATE_THAI_TYPE_FULL) ? $this->monthFull[(int) $d[1]] : $this->monthShort[(int) $d[1]];
        $date = (int) $d[2];

        return $date . ' ' . $month . ' ' . $year;
    }

    public function getMonthText($month, $type = 1) {
        return ($type == 1) ? $this->monthFull[$month] : $this->monthShort[$month];
    }

    public static function getTabTypeArray() {
        return [
            self::TAB_TYPE_PHOTO => 'Photo',
            self::TAB_TYPE_DETAIL => 'Detail',
            self::TAB_TYPE_AMENITY => 'Amenity',
            self::TAB_TYPE_MAP => 'Map',
            self::TAB_TYPE_STREET_VIEW => 'Street View',
        ];
    }

    public function getTabTypeText($type) {
        $tabTypeArray = self::getTabTypeArray();
        return $tabTypeArray[$type];
    }

    public function getUserAssetTypeArray() {
        return [
            self::USER_ASSET_TYPE_OWNER => 'เจ้าของทรัพย์สิน',
            self::USER_ASSET_TYPE_AGENCY => 'นายหน้า',
        ];
    }

    public function userAssetTypeText($type) {
        $userAssetTypeArray = $this->userAssetTypeArray;
        return $userAssetTypeArray[$type];
    }

    public function createTitle() {
        if (strpos($this->title, "/") === FALSE) {
            $title = explode(' ', $this->title);
        } else {
            $title = explode('/', $this->title);
        }
        return implode('-', $title);
    }

    public static function encodeParams($params) {
//        return urlencode(base64_encode(base64_encode(Yii::$app->getSecurity()->encryptByPassword(json_encode($params), Yii::$app->params['secureKey']))));

        $text = json_encode($params);
        $enc = mcrypt_encrypt(MCRYPT_BLOWFISH, Yii::$app->params['secureKey'], $text, MCRYPT_MODE_ECB, Yii::$app->params['secureVi']);
        $enc = str_replace(array('+', '/'), array('-', '_'), base64_encode($enc));
        return rawurlencode($enc);
    }

    public static function decodeParams($hash) {
//	    return json_decode(Yii::$app->getSecurity()->decryptByPassword(base64_decode(base64_decode(urldecode($hash))), Yii::$app->params['secureKey']), true);
        $hash = str_replace(array('-', '_'), array('+', '/'), $hash);
        $enc = base64_decode($hash);
        $enc = mcrypt_decrypt(MCRYPT_BLOWFISH, Yii::$app->params['secureKey'], $enc, MCRYPT_MODE_ECB, Yii::$app->params['secureVi']);
        return json_decode(trim($enc), true);
    }

    public static function encodeParamsBrand($params) {
//        return urlencode(base64_encode(base64_encode(Yii::$app->getSecurity()->encryptByPassword(json_encode($params), Yii::$app->params['secureKey']))));

        $text = json_encode($params);
        $enc = mcrypt_encrypt(MCRYPT_BLOWFISH, Yii::$app->params['secureKey'], $text, MCRYPT_MODE_ECB, Yii::$app->params['secureVi']);
        $enc = str_replace(array('+', '/'), array('-', '_'), base64_encode($enc));
        //$enc = str_replace('-', '_', base64_encode(str_replace(array('+', '/'), array('-', ''), $enc)));
        return rawurlencode($enc);
    }

}
