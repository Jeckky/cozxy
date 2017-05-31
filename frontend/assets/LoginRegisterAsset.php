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
class LoginRegisterAsset extends AssetBundle {

    //public $sourcePath = '@app/themes/cozxy/assets';
    public $basePath = '@webroot/themes/cozxy';
    public $baseUrl = '@web/themes/cozxy';
    public $css = [
        'css/login-register.css',
    ];
    public $js = [
        'js/login-register.js'
    ];
    public $depends = [
        'frontend\assets\CozxyAsset',
    ];

}
