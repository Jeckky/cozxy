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
class CheckoutAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/cozxy/assets';
    public $css = [
        'css/checkout.css',
    ];
    public $js = [
        'js/checkout.js'
    ];
    public $depends = [
        'frontend\assets\CozxyAsset',
    ];
}
