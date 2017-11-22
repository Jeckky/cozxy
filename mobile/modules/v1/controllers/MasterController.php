<?php

namespace mobile\modules\v1\controllers;

use frontend\models\Employee;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\controllers\MasterController as MasterCommonController;

/**
 * Site controller
 */
class MasterController extends MasterCommonController {

    public $breadcrumbs = [];

    //public $layout = '/content';

    public function writeToFile($fileName, $string, $mode = 'w+') {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }

}
