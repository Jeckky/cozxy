<?php

namespace common\models\costfit;

use Yii;
use \common\models\costfit\master\UserGroupsMaster;

/**
 * This is the model class for table "user_groups".
 *
 * @property string $levelId
 * @property string $name
 * @property string $parent_id
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class UserGroups extends \common\models\costfit\master\UserGroupsMaster {

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
        //'name',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), []);
    }

    static public function checkUserGroup($userGroup) {
        $CheckuserGroup = str_replace('[', '', str_replace(']', '', $userGroup));
        if ($CheckuserGroup != '') {
            //echo $userGroup;
            $userGroupx = str_replace('[', '(', str_replace(']', ')', $userGroup));
            // echo $userGroupx;
            $result = UserGroups::find()
            ->select('group_concat(name) as name')
            ->where("user_group_Id in " . $userGroupx . "  ")
            ->one();
        } else {
            $result = NULL;
        }
        //echo count($userGroup);
        /*
          $userGroup = str_replace('[', '(', str_replace(']', ')', $userGroup));
          //echo count($userGroup);
          $result = UserGroups::find()
          ->select('group_concat(name) as name')
          ->where("user_group_Id in " . $userGroup . "  ")
          ->one();
         */
        return $result;
    }

    /*
      public static function getHierarchy() {
      $options = [];

      $parents = self::find()->where("parent_id=0")->all();
      foreach ($parents as $id => $p) {
      $children = self::find()->where("parent_id=:parent_id", [":parent_id" => $p->user_group_Id])->all();
      $child_options = [];
      foreach ($children as $child) {
      $child_options[$child->user_group_Id] = $child->name;
      }
      $options[$p->name] = $child_options;
      }
      return $options;
      }

      static public function checkUserGroupTest($userGroup, $menuId) {
      $CheckuserGroup = str_replace('[', '', str_replace(']', '', $userGroup));
      if ($CheckuserGroup != '') {
      //echo $userGroup;
      $userGroupx = str_replace('[', '(', str_replace(']', ')', $userGroup));
      // echo $userGroupx;
      $result = UserGroups::find()
      ->select('group_concat(user_group_Id) as user_group_Id ,(select menu.user_group_Id from costfit_dev.menu where menuId = ' . $menuId . ') as MenuGoup')
      ->where("user_group_Id in " . $userGroupx . "  ")
      ->one();
      } else {
      $result = NULL;
      }

      return $result;
      } */
}
