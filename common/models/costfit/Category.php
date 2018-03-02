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

    const CATEGORY_LEVEL_1 = 0x1;
    const CATEGORY_LEVEL_2 = 0x2;
    const CATEGORY_LEVEL_3 = 0x4;

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
        return $this->hasMany(Category::className(), ['parentId' => 'categoryId'])->orderBy('title');
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

    public static function findAllPopularCategory($returnType = 1, $isRandom = TRUE, $limit = 6) {
        if ($isRandom) {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 2')->orderBy(new \yii\db\Expression('rand()'))
                    ->limit($limit);
            //->orderBy(new \yii\db\Expression('rand()'));
        } else {
            $query = Category::find()
                    ->join("INNER JOIN", 'show_category sc', 'sc.categoryId = category.categoryId')
                    ->where('sc.type = 2')->orderBy(new \yii\db\Expression('rand()'))
                    ->limit($limit);
        }

        if ($returnType == 1) {
            return new \yii\data\ActiveDataProvider([
                'query' => $query, 'pagination' => [
                    'pageSize' => 8]
            ]);
        } else {
            //return $query->all();
            return new \yii\data\ActiveDataProvider([
                'query' => $query, 'pagination' => [
                    'pageSize' => 8]
            ]);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent() {
        return $this->hasOne(Category::className(), ['categoryId' => 'parentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories() {
        return $this->hasMany(Category::className(), ['parentId' => 'categoryId']);
    }

    public static function findAllLastLevelCategory() {
        $res = [];
        $cats = Category::find()->where("parentId is null")->all();

        foreach ($cats as $cat) {
            $catText = "";
            if (isset($cat->childs)) {
                $catText .= "" . $cat->title;
                foreach ($cat->childs as $child1) {
                    if (isset($child1->childs)) {
                        $catText .= "->" . $child1->title;
                        foreach ($child1->childs as $child2) {
                            if (isset($child2->childs)) {
                                $catText .= "->" . $child2->title;
                                $res[$child2->categoryId] = $catText;
                            } else {
                                $catText .= "->" . $child2->title;
                                $res[$child2->categoryId] = $catText;
                            }
                        }
                    } else {
                        $catText .= "->" . $child1->title;
                        $res[$child1->categoryId] = $catText;
                    }
                }
            } else {
                $res[$cat->categoryId] = $cat->title;
            }
        }

        return $res;
    }

    public static function getRootText($categoryId, $isHtml = FALSE) {
        $cat = Category::find()->where("categoryId = $categoryId")->one();
        $params = \common\models\ModelMaster::encodeParams(['categoryId' => $categoryId]);
        if ($isHtml) {
            //$text = "<span style='color:red;font-weight:bold'>" . $cat->title . "</span>";
            $text = '<a href="' . Yii::$app->homeUrl . 'search/' . $cat->createTitle() . '/' . $params . '" style="color:red; font-weight:bold">' . $cat->title . '</a>';
        } else {
            $text = '<a href="' . Yii::$app->homeUrl . 'search/' . $cat->createTitle() . '/' . $params . '">' . $cat->title . '</a>';
        }
        $parent = $cat->parent;
        for ($i = 0; $i <= 5; $i++) {
            //$params_parent = \common\models\ModelMaster::encodeParams(['categoryId' => $parent]);
            if (isset($parent)) {
                $text = '<a href="' . Yii::$app->homeUrl . 'search/' . $parent->createTitle() . '/' . $params . '">' . $parent->title . '</a>' . " > " . $text;
                $parent = $parent->parent;
            } else {
                break;
            }
        }

        return $text;
    }

    public static function findCategoryArrayWithMultiLevel() {
        $res = [];
        $cats = Category::find()
                ->select("category.*")
                ->join("LEFT JOIN", "category as parent1", "parent1.categoryId = category.parentId")
                ->join("LEFT JOIN", "category as parent2", "parent2.categoryId = parent1.parentId")
//        ->orderBy("parent2.title ASC , parent1.parentId ASC")
                ->all();
        foreach ($cats as $cat) {
            $res[$cat->categoryId] = self::getRootText($cat->categoryId);
        }

        return $res;
    }

    public static function getRootTextBackend($categoryId, $isHtml = FALSE) {
        $cat = Category::find()->where("categoryId = $categoryId")->one();
        $params = \common\models\ModelMaster::encodeParams(['categoryId' => $categoryId]);
        if ($isHtml) {
            $text = "<span style='color:red;font-weight:bold'>" . $cat->title . "</span>";
            //$text = '<a href="' . Yii::$app->homeUrl . 'search/' . $cat->createTitle() . '/' . $params . '" style="color:red; font-weight:bold">' . $cat->title . '</a>';
        } else {
            $text = $cat->title;
        }
        $parent = $cat->parent;
        for ($i = 0; $i <= 5; $i++) {
            //$params_parent = \common\models\ModelMaster::encodeParams(['categoryId' => $parent]);
            if (isset($parent)) {
                $text = $parent->title . ' > ' . $text;
                $parent = $parent->parent;
            } else {
                break;
            }
        }

        return $text;
    }

    public static function findCategoryArrayWithMultiLevelBackend() {
        $res = [];
        $cats = Category::find()
                ->select("category.*")
                ->join("LEFT JOIN", "category as parent1", "parent1.categoryId = category.parentId")
                ->join("LEFT JOIN", "category as parent2", "parent2.categoryId = parent1.parentId")
//        ->orderBy("parent2.title ASC , parent1.parentId ASC")
                ->all();
        foreach ($cats as $cat) {
            $res[$cat->categoryId] = self::getRootTextBackend($cat->categoryId);
        }

        return $res;
    }

    public static function mainCategories() {
        return self::find()
                        ->leftJoin('category_to_product ctp', 'category.categoryId=ctp.categoryId')
                        ->leftJoin('category pc', 'category.parentId=pc.categoryId')
                        ->where(['category.status' => self::STATUS_ACTIVE])
                        ->andWhere('category.parentId is not null')
                        ->andwhere('ctp.categoryId is not null')
                        ->andWhere(['category.level' => self::CATEGORY_LEVEL_2])
                        ->groupBy('category.parentId')
//            ->orderBy('category.title')
                        ->orderBy('pc.title')
                        ->all();
    }

    public function subCategories() {
        return self::find()
                        ->leftJoin('category_to_product ctp', 'category.categoryId=ctp.categoryId')
                        ->leftJoin('product p', 'p.productId=ctp.productId')
                        ->where(['category.parentId' => $this->categoryId])
                        ->andWhere('p.productId is not null')
                        ->andWhere(['p.approve' => 'approve', 'p.status' => 1])
                        ->orderBy('category.title')
                        ->groupBy('ctp.categoryId')
                        ->all();
    }

    public static function categoryId($title) {
        $category = Category::find()->where("title='" . $title . "' and status=1")->one();
        return $category->categoryId;
    }

}
