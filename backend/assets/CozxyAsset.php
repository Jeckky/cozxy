<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main CostFit application asset bundle.
 */
class CozxyAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/bootstrap.min.css',
        'css/pixeladmin.min.css',
        'css/widgets.min.css',
        'css/pages.css',
//        'css/themes.min.css',
        'css/chat.css'
    ];
    public $js = [
        'js/jquery.min.js',
//        'js/ie.min.js',
        'js/bootstrap.min.js',
        //'js/pixel-admin.min.js',
//        'js/cozxy-pixel-admin.min.js',
        'js/pixeladmin.min.js',
        'js/cozxy/cozxy-unity.js', //by Taninut.Bm, Master codeding
        //'js/cozxy/cozxy-unity.min.js', // By Taninut.bm , create date 06/02/2017 , ย่อขนาด บีบอัดไฟล์
        'js/cozxy/cozxy-printer.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
