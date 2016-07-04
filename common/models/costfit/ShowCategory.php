<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\ShowCategoryMaster;

/**
 * This is the model class for table "show_category".
 *
 * @property string $showCategoryId
 * @property string $categoryId
 * @property integer $type
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class ShowCategory extends \common\models\costfit\master\ShowCategoryMaster
{

    /**
     * @inheritdoc
     */
    const TYPE_SAVE_CAT = 1;
    const TYPE_POPULAR_CAT = 1;

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

    public function findTypeArray()
    {
        return [
            self::TYPE_SAVE_CAT => 'Save Category',
            self::TYPE_POPULAR_CAT => 'Popular Category',
        ];
    }

    public function getTypeText($type)
    {
        $res = $this->findTypeArray();
        if (isset($res[$type])) {
            return $res[$type];
        } else {
            return NULL;
        }
    }

}
