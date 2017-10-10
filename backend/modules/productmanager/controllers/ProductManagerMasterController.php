<?php

namespace backend\modules\productmanager\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\controllers\MasterController;
use common\models\costfit\master;
use common\models\costfit;

/**
 * Product controller
 */
class ProductManagerMasterController extends \backend\controllers\BackendMasterController {

    public $breadcrumbs = [];
    public $layout = '/cl1';
    public $nav = [];
    public $title = 'Title';
    public $subTitle = 'Sub Title';

    public function prepareOptionArray($options) {
        $res = [];
        foreach ($options as $productGroupTemplateOptionId => $optionArray) {
            //$res[$productGroupTemplateOptionId] = explode(", ", $optionArray);
            $res[$productGroupTemplateOptionId] = $optionArray;
        }
        return $this->array_cartesian($res); // 2D array
    }

    function array_cartesian($arrays) {
        $result = array();
        $keys = array_keys($arrays);
        $arrays = array_values($arrays);

        $sizeIn = sizeof($arrays);

        $size = $sizeIn > 0 ? 1 : 0;
        foreach ($arrays as $array)
            $size = $size * sizeof($array);
        for ($i = 0; $i < $size; $i++) {
            $result[$i] = array();
            for ($j = 0; $j < $sizeIn; $j++) {
//            array_push($result[$i], current($arrays[$j]));
                $result[$i][$keys[$j]] = current($arrays[$j]);
            }

            for ($j = ($sizeIn - 1); $j >= 0; $j--) {
                if (next($arrays[$j]))
                    break;
                elseif (isset($arrays[$j]))
                    reset($arrays[$j]);
            }
        }
//        throw new \yii\base\Exception(print_r($result, TRUE));
        return $result;
    }
}
