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
class CheckoutAsset extends AssetBundle {

    //public $sourcePath = '@app/themes/cozxy/assets';
    public $basePath = '@webroot/themes/cozxy';
    public $baseUrl = '@web/themes/cozxy';
    public $css = [
        'css/checkout.css',
    ];
    public $js = [
        'js/checkout.js',
            //'js/MapCozxyBox.js',
            //'https://maps.google.com/maps/api/js?key=AIzaSyCoAu9KrtLAc-lq1QgpJWtRP0Oyjty_-Cw&v=3.2&sensor=false&language=th&libraries=places&callback=initMap'
    ];
    public $depends = [
        'frontend\assets\CozxyAsset',
    ];

}
