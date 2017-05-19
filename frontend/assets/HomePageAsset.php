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
class HomePageAsset extends AssetBundle {

    public $sourcePath = '@app/themes/cozxy/assets';
    public $css = [
        'css/smoothDivScroll.css',
    ];
    public $js = [
        'js/jquery-ui-1.10.3.custom.min.js',
        'js/jquery.mousewheel.min.js',
        'js/jquery.kinetic.min.js',
        'js/jquery.smoothdivscroll-1.3-min.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
