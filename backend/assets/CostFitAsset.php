<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main CostFit application asset bundle.
 */
class CostFitAsset extends AssetBundle {

    public $sourcePath = '@backend/themes/costfit/assets';
    //public $baseUrl = '@web';

    public $css = [
        'stylesheets/bootstrap.min.css',
        'stylesheets/pixel-admin.min.css',
        'stylesheets/pages.min.css',
        'stylesheets/widgets.min.css',
        'stylesheets/rtl.min.css',
        'stylesheets/themes.min.css',
        'stylesheets/chat.css'
    ];
    public $js = [
        'javascripts/jquery-2.1.3.min.js',
        'javascripts/ie.min.js',
        'javascripts/bootstrap.min.js',
        //'javascripts/pixel-admin.min.js',
        'javascripts/cozxy-pixel-admin.min.js',
        'javascripts/cozxy/cozxy-unity.js', //by Taninut.Bm, Master codeding
        //'javascripts/cozxy/cozxy-unity.min.js', // By Taninut.bm , create date 06/02/2017 , ย่อขนาด บีบอัดไฟล์
        'javascripts/cozxy/cozxy-printer.js',
    ];

}
