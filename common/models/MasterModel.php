<?php

namespace common\models;

use Yii;
//use yii\behaviors\TimestampBehavior;
//use yii\db\Expression;

class MasterModel extends \yii\db\ActiveRecord
{
//date thai type
    const DATE_THAI_TYPE_FULL = 1;
    const DATE_THAI_TYPE_SHORT = 2;

    //status
    const STATUS_ACTIVE = 0x1;
    const STATUS_INACTIVE = 0x2;

    public $searchText;

    /*
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createDateTime',
                'updatedAtAttribute' => 'updateDateTime',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
     */

    /**
     * @param $fileName
     * @param $text
     * @param string $mode
     */
    public function writeToFile($fileName, $text, $mode = 'w+')
    {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $text);
        fclose($handle);
    }
}
