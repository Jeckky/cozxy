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
                $backendMenuArray[$k]['label'] = $menu->name;
                $childs = \common\models\costfit\Menu::find()->where("parent_id = $menu->menuId and assignment is not null  and assignment like '%$backendMenuArrayRbac[$r]%'")->all();
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

            return $backendMenuArray;
        }
    }

}
