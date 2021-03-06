<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "auth_item".
*
    * @property string $name
    * @property integer $type
    * @property string $description
    * @property string $rule_name
    * @property resource $data
    * @property integer $status
    * @property integer $created_at
    * @property integer $updated_at
    *
            * @property AuthAssignment[] $authAssignments
            * @property AuthRule $ruleName
            * @property AuthItemChild[] $authItemChildren
            * @property AuthItemChild[] $authItemChildren0
            * @property AuthItem[] $children
            * @property AuthItem[] $parents
    */
class AuthItemMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'auth_item';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['name', 'type'], 'required'],
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['rule_name'], 'exist', 'skipOnError' => true, 'targetClass' => AuthRuleMaster::className(), 'targetAttribute' => ['rule_name' => 'name']],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'name' => Yii::t('auth_item', 'Name'),
    'type' => Yii::t('auth_item', 'Type'),
    'description' => Yii::t('auth_item', 'Description'),
    'rule_name' => Yii::t('auth_item', 'Rule Name'),
    'data' => Yii::t('auth_item', 'Data'),
    'status' => Yii::t('auth_item', 'Status'),
    'created_at' => Yii::t('auth_item', 'Created At'),
    'updated_at' => Yii::t('auth_item', 'Updated At'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthAssignments()
    {
    return $this->hasMany(AuthAssignmentMaster::className(), ['item_name' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRuleName()
    {
    return $this->hasOne(AuthRuleMaster::className(), ['name' => 'rule_name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthItemChildren()
    {
    return $this->hasMany(AuthItemChildMaster::className(), ['parent' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthItemChildren0()
    {
    return $this->hasMany(AuthItemChildMaster::className(), ['child' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getChildren()
    {
    return $this->hasMany(AuthItem::className(), ['name' => 'child'])->viaTable('auth_item_child', ['parent' => 'name']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getParents()
    {
    return $this->hasMany(AuthItem::className(), ['name' => 'parent'])->viaTable('auth_item_child', ['child' => 'name']);
    }
}
