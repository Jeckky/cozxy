<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\FavoriteStoryMaster;

/**
 * This is the model class for table "favorite_story".
 *
 * @property string $favoriteStoryId
 * @property integer $productPostId
 * @property integer $userId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class FavoriteStory extends \common\models\costfit\master\FavoriteStoryMaster {

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

    public static function isAddToFavorite($productPostId) {
        $favorite = FavoriteStory::find()->where("userId=" . Yii::$app->user->id . " and productPostId=" . $productPostId)->one();
        if (isset($favorite)) {
            return true;
        } else {
            return false;
        }
    }

    public static function favoriteItem() {
        $favorities = FavoriteStory::find()->where("userId=" . Yii::$app->user->id . " and status=1")
                ->orderBy('updateDateTime DESC')
                ->limit(8)
                ->all();
        if (isset($favorities) && count($favorities) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function allFavoriteStories() {
        $favorites = FavoriteStory::find()->where("userId=" . Yii::$app->user->id . " and status=1")->all();
        if (isset($favorites) && count($favorites) > 0) {
            return count($favorites);
        } else {
            return false;
        }
    }

}
