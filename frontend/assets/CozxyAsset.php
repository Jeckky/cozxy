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

    public $sourcePath = '@app/themes/cozxy/assets';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/mstyle.css',
        'css/cozxy.css',
        'fonts/fonts.css',
    ];
    public $js = [
        'js/jquery.js',
        'js/bootstrap.min.js',
        'js/cozxy.js',
        'js/cozxy.reform.js'
    ];

}
