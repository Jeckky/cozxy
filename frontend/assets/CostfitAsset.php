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
class CostfitAsset extends AssetBundle
{

    public $sourcePath = '@app/themes/costfit/assets';
    public $css = [
        'masterslider/style/masterslider.css',
        'css/styles.css',
        'css/colors/color-scheme6.css',
        'css/style-reform.css', //Create By Taninut.B
    ];
    public $js = [

        'js/libs/jquery-1.11.1.min.js',
        'js/libs/jquery-ui-1.10.4.custom.min.js',
        'js/libs/jquery.easing.min.js',
        'js/plugins/bootstrap.min.js',
        'js/plugins/smoothscroll.js',
        'js/plugins/jquery.validate.min.js',
        'js/plugins/icheck.min.js',
        'js/plugins/jquery.placeholder.js',
        'js/plugins/jquery.stellar.min.js',
        'js/plugins/jquery.touchSwipe.min.js',
        'js/plugins/jquery.shuffle.min.js',
        'js/plugins/lightGallery.min.js',
        'js/plugins/owl.carousel.min.js',
        'js/plugins/masterslider.min.js',
        'js/plugins/jquery.nouislider.min.js',
        'mailer/mailer.js',
        'js/scripts.js',
        'js/cost.fit.js.reform.js',
        'js/cost.fit.unity.js',
        'js/404.js',
        'js/plugins/smoothscroll.js',
        'js/plugins/jquery.placeholder.js',
    ];

}
