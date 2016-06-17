<?php

namespace common\models;

use Yii;

class ModelMaster extends \yii\db\ActiveRecord
{
    const DATE_THAI_TYPE_FULL = 1;
    const DATE_THAI_TYPE_SHORT = 2;

    public $searchText;

    public $monthFull = [
        1=>'มกราคม',
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
        1=>'ม.ค.',
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

    public function writeToFile($fileName, $text, $mode='w+')
    {
        $handle = fopen($fileName,$mode);
        fwrite($handle, $text);
        fclose($handle);
    }

    public function thaiDate($date, $type=self::DATE_THAI_TYPE_FULL)
    {
        $d = explode('-', $date);
        $year = $d[0]+543;
        $month = ($type==self::DATE_THAI_TYPE_FULL) ? $this->monthFull[(int)$d[1]] : $this->monthShort[(int)$d[1]];
        $date = (int)$d[2];

        return $date . ' ' . $month . ' ' . $year;
    }

    public function getMonthText($month, $type=1)
    {
        return ($type==1) ? $this->monthFull[$month] : $this->monthShort[$month];
    }
}
