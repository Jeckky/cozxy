<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\SectionMaster;

/**
* This is the model class for table "section".
*
    * @property string $sectionId
    * @property string $title
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class Section extends \common\models\costfit\master\SectionMaster{
/**
* @inheritdoc
*/
public function rules()
{
return array_merge(parent::rules(), []);
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return array_merge(parent::attributeLabels(), []);
}
}
