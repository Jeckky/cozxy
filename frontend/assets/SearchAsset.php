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
class SearchAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/cozxy/assets';
    public $css = [
        'jquery-ui-1.12.1/jquery-ui.min.css',
    ];
    public $js = [
        'jquery-ui-1.12.1/jquery-ui.min.js',
        'js/responsive_waterfall.js'
    ];
    public $depends = [
        'frontend\assets\CozxyAsset',
    ];
}
