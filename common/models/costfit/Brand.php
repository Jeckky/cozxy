<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\BrandMaster;

/**
 * This is the model class for table "brand".
 *
 * @property string $brandId
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property integer $parentId
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Brand extends \common\models\costfit\master\BrandMaster
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
        return array_merge(parent::attributeLabels(), [
            'Access'
        ]);
    }

    public function getRootCategorys()
    {
        return $this->hasMany(Category::className(), ['brandId' => 'brandId'], ["parentId" => 0]);
    }

}
