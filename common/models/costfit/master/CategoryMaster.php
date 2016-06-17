<?php

namespace common\models\costfit\master;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $categoryId
 * @property string $title
 * @property string $description
 * @property integer $parentId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 *
 * @property Product[] $products
 */
class CategoryMaster extends \common\models\ModelMaster
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'createDateTime'], 'required'],
            [['description'], 'string'],
            [['parentId', 'status'], 'integer'],
            [['createDateTime', 'updateDateTime'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categoryId' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'parentId' => 'Parent ID',
            'status' => 'Status',
            'createDateTime' => 'Create Date Time',
            'updateDateTime' => 'Update Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['categoryId' => 'categoryId']);
    }
}
