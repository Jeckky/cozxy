<?php

namespace common\models\costfit\master;

use Yii;

/**
* This is the model class for table "package".
*
    * @property string $packageId
    * @property string $packageTypeId
    * @property string $title
    * @property string $description
    * @property string $width
    * @property string $height
    * @property string $depth
    * @property string $weight
    * @property string $maxWeight
    * @property string $image
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/
class PackageMaster extends \common\models\ModelMaster
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'package';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['packageTypeId', 'title', 'createDateTime'], 'required'],
            [['packageTypeId', 'status'], 'integer'],
            [['description'], 'string'],
            [['width', 'height', 'depth', 'weight', 'maxWeight'], 'number'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'packageId' => Yii::t('package', 'Package ID'),
    'packageTypeId' => Yii::t('package', 'Package Type ID'),
    'title' => Yii::t('package', 'Title'),
    'description' => Yii::t('package', 'Description'),
    'width' => Yii::t('package', 'Width'),
    'height' => Yii::t('package', 'Height'),
    'depth' => Yii::t('package', 'Depth'),
    'weight' => Yii::t('package', 'Weight'),
    'maxWeight' => Yii::t('package', 'Max Weight'),
    'image' => Yii::t('package', 'Image'),
    'status' => Yii::t('package', 'Status'),
    'createDateTime' => Yii::t('package', 'Create Date Time'),
    'updateDateTime' => Yii::t('package', 'Update Date Time'),
];
}
}
