<?php

namespace common\controllers;

use frontend\models\Employee;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class MasterController extends Controller {

    public $breadcrumbs = [];

    //public $layout = '/content';

    public function writeToFile($fileName, $string, $mode = 'w+') {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }

}
