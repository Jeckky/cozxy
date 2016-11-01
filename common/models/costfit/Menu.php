<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\MenuMaster;

/**
 * This is the model class for table "menu".
 *
 * @property string $menuId
 * @property string $levelId
 * @property string $name
 * @property string $link
 * @property integer $parent
 * @property integer $sort
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Menu extends \common\models\costfit\master\MenuMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributes() {
        return array_merge(parent::attributes(), [
            'parents',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    //parentMennu
    static public function getparentMenus($parent) {
        $items = Menu::find()->where("menuId =" . $parent)->one();
        if (isset($items)) {
            return $items;
        } else {
            return '';
        }
    }

}
