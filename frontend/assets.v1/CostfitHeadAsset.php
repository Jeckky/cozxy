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
class CostfitHeadAsset extends AssetBundle {

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $sourcePath = '@app/themes/costfit/assets';
    public $css = [
    ];
    public $js = [
        'js/libs/modernizr.custom.js',
        'js/plugins/respond.js',
    ];

}
