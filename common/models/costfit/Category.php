<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\CategoryMaster;

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
class Category extends \common\models\costfit\master\CategoryMaster {

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

    public function getChilds() {
        return $this->hasMany(Category::className(), ['categoryId' => 'parentId']);
    }

    public function getCategoryWithParentArray() {
        $res = [];
        foreach ($this->find()->all() as $item) {
            $title = $item->title;
            for ($i = 1; $i <= 5; $i++) {

            }
        }
        return $res;
    }

    public static function findAllSaveCategory($returnType = 1, $isRandom = TRUE, $limit = 6) {
        if ($isRandom) {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 1')
                    ->limit($limit)
                    ->orderBy(new \yii\db\Expression('rand()'));
        } else {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 1')
                    ->limit($limit);
        }

        if ($returnType == 1) {
            return new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
        } else {
            return $query->all();
        }
    }

    public static function findAllPopularCategory($returnType = 1, $isRandom = TRUE, $limit = 6) {
        if ($isRandom) {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 2')
                    ->limit($limit)
                    ->orderBy(new \yii\db\Expression('rand()'));
        } else {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 2')
                    ->limit($limit);
        }

        if ($returnType == 1) {
            return new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
        } else {
            return $query->all();
        }
    }

}
