<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\helpers;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\models\costfit\AuthAssignment;
use common\models\costfit\AuthItemChild;

/**
 * Description of menuBackend
 *
 * @author it
 */
class menuBackend {
    /*
     * หา Menu กับ Group และ User ที่เหมือนกันและได้รับสิทธิ์
     */

    public static function getMenuRbac() {
        $query = new \yii\db\Query;
        $query = AuthItemChild::find()
                ->select('*')
                ->join('INNER JOIN', 'auth_assignment', 'auth_item_child.parent = auth_assignment.item_name')
                ->join('LEFT JOIN', 'auth_item', 'auth_item.name = auth_assignment.item_name')
                ->where('auth_assignment.user_id = ' . Yii::$app->user->identity->userId)
                ->andWhere('auth_item.description = 1')
                ->groupBy('parent');
        $command = $query->createCommand();
        $data = $command->queryAll();
        return $data;
    }

    public static function getMenuSystem() {
        $backendMenuArrayRbac = [];
        $backendMenuArray = [];
        $getMenuRbac = menuBackend::getMenuRbac();
        foreach ($getMenuRbac as $r => $rbac) {
            $backendMenuArrayRbac[$r] = $rbac['parent'];
//echo $backendMenuArrayRbac[$r];
            $dataProvider = \common\models\costfit\Menu::find()->where("parent_id = 0 and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
            foreach ($dataProvider as $k => $menu) {
//echo $menu->assignment;
                $backendMenuArray[$r][$k]['label'] = $menu->name;
                $backendMenuArray[$r][$k]['url'] = [$menu->link];
                $childs = \common\models\costfit\Menu::find()->where("parent_id = $menu->menuId  and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
//in_array($value->item_name, $test
                if (isset($childs) && count($childs) > 0) {
                    foreach ($childs as $j => $child) {
                        $childs2 = \common\models\costfit\Menu::find()->where("parent_id = $child->menuId and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
// $test = explode(',', $model->assignment);
                        if (isset($childs2) && count($childs2) > 0) {
                            foreach ($childs2 as $l => $child2) {

                                $backendMenuArray[$r][$k]["items"][$j]["label"] = $child->name;
                                $backendMenuArray[$r][$k]["items"][$j]["items"][$l] = ['label' => $child2->name, 'url' => [$child2->link]];
                            }
                        } else {
                            $backendMenuArray[$r][$k]["items"][$j]['label'] = $child->name;
                            $backendMenuArray[$r][$k]["items"][$j]['url'] = [$child->link];
                        }
                    }
                } else {
                    $backendMenuArray[$r][$k]['label'] = $menu->name;
                    $backendMenuArray[$r][$k]['url'] = [$menu->link];
                }
            }
        }

        return $backendMenuArray;
    }

    public static function getMenuSystem1Bk() {
        $backendMenuArrayRbac = [];
        $backendMenuArray = [];
        $getMenuRbac = menuBackend::getMenuRbac();
        foreach ($getMenuRbac as $r => $rbac) {
            $backendMenuArrayRbac[$r] = $rbac['parent'];
//echo $backendMenuArrayRbac[$r];
            $dataProvider = \common\models\costfit\Menu::find()->where("parent_id = 0 and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
            foreach ($dataProvider as $k => $menu) {
//echo $menu->assignment;
                $backendMenuArray[$k]['label'] = $menu->name;
                $childs = \common\models\costfit\Menu::find()->where("parent_id = $menu->menuId  and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
//in_array($value->item_name, $test
                if (isset($childs) && count($childs) > 0) {
                    foreach ($childs as $j => $child) {
                        $childs2 = \common\models\costfit\Menu::find()->where("parent_id = $child->menuId and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
// $test = explode(',', $model->assignment);
                        if (isset($childs2) && count($childs2) > 0) {
                            foreach ($childs2 as $l => $child2) {
                                $backendMenuArray[$k]["items"][$j]["label"] = $child->name;
                                $backendMenuArray[$k]["items"][$j]["items"][$l] = ['label' => $child2->name, 'url' => [$child2->link]];
                            }
                        } else {
                            $backendMenuArray[$k]["items"][$j]['label'] = $child->name;
                            $backendMenuArray[$k]["items"][$j]['url'] = [$child->link];
                        }
                    }
                } else {
                    $backendMenuArray[$k]['url'] = [$menu->link];
                }
            }
        }
        return $backendMenuArray;
    }

    public static function getUser() {
        $getUserAssignment = \common\models\costfit\AuthAssignment::find()
                        ->where("user_id=" . Yii::$app->user->identity->userId)->all();
        foreach ($getUserAssignment as $key => $items) {
            $value[$key] = $items->item_name;
        }
        $assignmentConfig = array(0 => 'Partner', 1 => 'Content');
        $assignmentLogin = $value;
        $result = array_intersect($assignmentConfig, $assignmentLogin);
        if (count($result) > 1) {
            foreach ($result as $key => $value) {
                $auth = $value;
                if ($auth == 'Partner' || $auth == 'Content') {
                    $result = 'Partner-Content';
                } else {
                    $result = 'no';
                }
            }
        } else {
            foreach ($result as $key => $value) {
                $auth = $value;
                if ($auth == 'Partner') {
                    $result = 'Partner';
                } else if ($auth == 'Content') {
                    $result = 'Content';
                } else {
                    $result = 'no';
                }
            }
        }

        return $result;
    }

}
