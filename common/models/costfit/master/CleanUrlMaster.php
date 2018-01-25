<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "clean_url".
 *
 * @property string $cleanUrlId
 * @property integer $status
 * @property string $productId
 * @property string $categoryId
 * @property string $brandId
 * @property string $cleanUrl
 */
class CleanUrlMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clean_url';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'productId', 'categoryId', 'brandId'], 'integer'],
            [['cleanUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cleanUrlId' => 'Clean Url ID',
            'status' => 'Status',
            'productId' => 'Product ID',
            'categoryId' => 'Category ID',
            'brandId' => 'Brand ID',
            'cleanUrl' => 'Clean Url',
        ];
    }
}
