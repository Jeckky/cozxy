<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "bank_name".
*
    * @property string $bankNameId
    * @property string $title
    * @property string $description
    * @property string $logo
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
    *
            * @property Bank[] $banks
    */
class BankNameMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'bank_name';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['title', 'logo', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['logo'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'bankNameId' => Yii::t('bank_name', 'Bank Name ID'),
    'title' => Yii::t('bank_name', 'Title'),
    'description' => Yii::t('bank_name', 'Description'),
    'logo' => Yii::t('bank_name', 'Logo'),
    'status' => Yii::t('bank_name', 'Status'),
    'createDateTime' => Yii::t('bank_name', 'Create Date Time'),
    'updateDateTime' => Yii::t('bank_name', 'Update Date Time'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getBanks()
    {
    return $this->hasMany(BankMaster::className(), ['bankNameId' => 'bankNameId']);
    }
}
