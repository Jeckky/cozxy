<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "auth_item_child".
*
    * @property string $parent
    * @property string $child
    *
            * @property AuthItem $parent0
            * @property AuthItem $child0
    */
class AuthItemChildMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'auth_item_child';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItemMaster::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItemMaster::className(), 'targetAttribute' => ['child' => 'name']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'parent' => Yii::t('auth_item_child', 'Parent'),
    'child' => Yii::t('auth_item_child', 'Child'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParent0()
    {
    return $this->hasOne(AuthItemMaster::className(), ['name' => 'parent']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getChild0()
    {
    return $this->hasOne(AuthItemMaster::className(), ['name' => 'child']);
    }
}
