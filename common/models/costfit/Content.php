<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ContentMaster;
use yii\db\Expression;

/**
 * This is the model class for table "content".
 *
 * @property string $contentId
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $image
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Content extends \common\models\costfit\master\ContentMaster
{

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

    public static function banners()
    {
        return self::find()
            ->leftJoin('content_group cg', 'content.contentGroupId=cg.contentGroupId')
            ->where(['cg.title' => 'Banner'])
            ->andWhere(['content.status' => 1])
            ->orderBy(new Expression('rand()'))
            ->all();
    }

}
