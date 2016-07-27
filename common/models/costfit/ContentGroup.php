<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ContentGroupMaster;

/**
 * This is the model class for table "content_group".
 *
 * @property string $contentGroupId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ContentGroup extends \common\models\costfit\master\ContentGroupMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    public function getContents() {
        return $this->hasMany(Content::className(), ['contentGroupId' => 'contentGroupId']);
    }

}
