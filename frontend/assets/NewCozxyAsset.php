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
class NewCozxyAsset extends AssetBundle {

    // public $sourcePath = '@app/themes/cozxy/assets';
    public $basePath = '@webroot/themes/cozxy';
    public $baseUrl = '@web/themes/cozxy';
    public $css = [
        'cssNew/cozxy.v2.css',
    ];
    public $js = [
        'jsNew/cozxy.v2.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];

}
