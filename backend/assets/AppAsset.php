<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/cozxy.reform.js'
    ];
    public $depends = [

        'yii\web\YiiAsset',
        'backend\assets\CostFitAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
