<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "auth_rule".
*
    * @property string $name
    * @property resource $data
    * @property integer $created_at
    * @property integer $updated_at
    *
            * @property AuthItem[] $authItems
    */
class AuthRuleMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'auth_rule';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'name' => Yii::t('auth_rule', 'Name'),
    'data' => Yii::t('auth_rule', 'Data'),
    'created_at' => Yii::t('auth_rule', 'Created At'),
    'updated_at' => Yii::t('auth_rule', 'Updated At'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthItems()
    {
    return $this->hasMany(AuthItemMaster::className(), ['rule_name' => 'name']);
    }
}
