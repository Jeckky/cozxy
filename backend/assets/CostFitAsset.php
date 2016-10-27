<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main CostFit application asset bundle.
 */
class CostFitAsset extends AssetBundle
{

    public $sourcePath = '@backend/themes/costfit/assets';
    //public $baseUrl = '@web';

    public $css = [
        'stylesheets/bootstrap.min.css',
        'stylesheets/pixel-admin.min.css',
        'stylesheets/pages.min.css',
        'stylesheets/widgets.min.css',
        'stylesheets/rtl.min.css',
        'stylesheets/themes.min.css'
    ];
    public $js = [
        'javascripts/jquery-2.1.3.min.js',
        'javascripts/ie.min.js',
        'javascripts/bootstrap.min.js',
        'javascripts/pixel-admin.min.js',
        'javascripts/cozxy/cozxy-unity.js',
    ];

}
