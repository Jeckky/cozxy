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
class Category extends \common\models\costfit\master\CategoryMaster
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

    public function getChilds()
    {
        return $this->hasMany(Category::className(), ['parentId' => 'categoryId']);
    }

    public function getCategoryWithParentArray()
    {
        $res = [];
        foreach ($this->find()->all() as $item) {
            $title = $item->title;
            for ($i = 1; $i <= 5; $i++) {

            }
        }
        return $res;
    }

    public static function findAllSaveCategory($returnType = 1, $isRandom = TRUE, $limit = 6)
    {
        if ($isRandom) {
            $query = Category::find()
            ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
            ->where('sc.type = 1')
            ->orderBy(new \yii\db\Expression('rand()'))
            ->limit($limit);
        } else {
            $query = Category::find()
            ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
            ->where('sc.type = 1')
            ->LIMIT($limit);
        }
        if ($returnType == 1) {
            return new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $limit,
                ],
            ]);
        } else {
            return $query->all();
        }
    }

    public static function findAllPopularCategory($returnType = 1, $isRandom = TRUE, $limit = 6)
    {
        if ($isRandom) {
            $query = Category::find()
            ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
            ->where('sc.type = 2')
            ->limit($limit);
            //->orderBy(new \yii\db\Expression('rand()'));
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'parentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parentId' => 'categoryId']);
    }

    public static function findAllLastLevelCategory()
    {
        $res = [];
        $cats = Category::find()->where("parentId is null")->all();

        foreach ($cats as $cat) {
            $catText = "";
            if (isset($cat->childs)) {
                $catText.="" . $cat->title;
                foreach ($cat->childs as $child1) {
                    if (isset($child1->childs)) {
                        $catText.="->" . $child1->title;
                        foreach ($child1->childs as $child2) {
                            if (isset($child2->childs)) {
                                $catText.="->" . $child2->title;
                                $res[$child2->categoryId] = $catText;
                            } else {
                                $catText.="->" . $child2->title;
                                $res[$child2->categoryId] = $catText;
                            }
                        }
                    } else {
                        $catText.="->" . $child1->title;
                        $res[$child1->categoryId] = $catText;
                    }
                }
            } else {
                $res[$cat->categoryId] = $cat->title;
            }
        }

        return $res;
    }

}
