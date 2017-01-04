<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ContentImageMaster;

/**
* This is the model class for table "content_image".
*
    * @property string $contentImageId
    * @property string $contentId
    * @property string $name
    * @property string $image
    * @property string $description
    * @property integer $status
    * @property string $createDateTime
    * @property string $updateDateTime
*/

class ContentImage extends \common\models\costfit\master\ContentImageMaster{
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
