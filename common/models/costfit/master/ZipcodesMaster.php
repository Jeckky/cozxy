<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "zipcodes".
 *
 * @property string $zipcodeId
 * @property string $districtCode
 * @property string $zipcode
 */
class ZipcodesMaster extends \common\models\ModelMaster {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'zipcodes';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('dbWorld');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['districtCode', 'zipcode'], 'required'],
            [['districtCode', 'zipcode'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'zipcodeId' => Yii::t('zipcodes', 'Zipcode ID'),
            'districtCode' => Yii::t('zipcodes', 'District Code'),
            'zipcode' => Yii::t('zipcodes', 'Zipcode'),
        ];
    }

}
