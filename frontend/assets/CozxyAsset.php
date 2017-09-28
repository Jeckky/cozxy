<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CozxyAsset extends AssetBundle {

    //public $sourcePath = '@app/themes/cozxy/assets';
    public $basePath = '@webroot/themes/cozxy';
    public $baseUrl = '@web/themes/cozxy';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/mstyle.css',
        'css/chat.css',
        'css/cozxy.css',
        'fonts/fonts.css',
    ];
    public $js = [
        'js/js.v2/jquery.js',
        'js/bootstrap.min.js',
        'js/cozxy.js',
        'jquery.growl/notify.js',
        'js/cozxy.reform.js',
        'js/cozxy.unity.js',
        'js/currency.exchange.rate.js',
        'js/cozxy.product.modal.js',
        'js/jquery.elevateZoom-3.0.8.min.js',
        'js/js.v2/cozxy.script.js',
        'fixer.io/money.js',
    //'js/currency-real-time.js',
    //'js/search-filter.js'
    ];

}
