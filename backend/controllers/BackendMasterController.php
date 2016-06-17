<?php

namespace backend\controllers;

use Yii;
use common\controllers\MasterController;
use common\models\areawow;

/**
 * Site controller
 */
class BackendMasterController extends MasterController
{

    public $breadcrumbs = [];
//    public $layout = '/content';

    public function writeToFile($fileName, $string, $mode = 'w+')
    {
        $handle = fopen($fileName, $mode);
        fwrite($handle, $string);
        fclose($handle);
    }
}
