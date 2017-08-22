<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'dashboard' => [
            'class' => 'backend\modules\dashboard\Dashboard',
            'defaultRoute' => 'dashboard'
        ],
        'notification' => [
            'class' => 'backend\modules\notification\Notification',
            'defaultRoute' => 'notification'
        ],
        'profile' => [
            'class' => 'backend\modules\profile\Profile',
            'defaultRoute' => 'profile',
        ],
        'management' => [
            'class' => 'backend\modules\management\Management',
            'defaultRoute' => 'management',
        ],
        'auth' => [
            'class' => 'backend\modules\auth\Auth',
            'defaultRoute' => 'auth',
        ],
        'kt-generator' => [
            'class' => 'backend\modules\KTGenerator\KTGenerator',
        ],
        'store' => [
            'class' => 'backend\modules\store\Store',
        ],
        'led' => [
            'class' => 'backend\modules\led\Led',
        ],
        'supplier' => [
            'class' => 'backend\modules\supplier\Supplier',
        ],
        'product' => [
            'class' => 'backend\modules\product\Product',
        ],
        'shipping' => [
            'class' => 'backend\modules\shipping\Shipping',
        ],
        'content' => [
            'class' => 'backend\modules\content\Content',
        ],
        'payment' => [
            'class' => 'backend\modules\payment\Payment',
        ],
        'order' => [
            'class' => 'backend\modules\order\Order',
        ],
        'user' => [
            'class' => 'backend\modules\user\User',
        ],
        'report' => [
            'class' => 'backend\modules\report\Report',
        ],
        /* 'redactor' => [
          'class' => 'yii\redactor\RedactorModule',
          'uploadDir' => '/Users/kpu/Dev/wwwroot/cozxy/frontend/web/images',
          'uploadUrl' => '@web/images',
          'imageAllowExtensions' => ['jpg', 'png', 'gif']
          ], */
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/images/story',
            'uploadUrl' => '@web/images/story',
            'imageAllowExtensions' => ['jpg', 'png', 'gif', 'jpeg'],
        ],
        'picking' => [
            'class' => 'backend\modules\picking\Picking',
        ],
        'lockers' => [
            'class' => 'backend\modules\lockers\Lockers',
        ],
        'suppliers' => [
            'class' => 'backend\modules\suppliers\Suppliers',
        ],
        'returnproduct' => [
            'class' => 'backend\modules\returnproduct\Returnproduct',
        ],
        'booth' => [
            'class' => 'backend\modules\booth\Booth',
        ],
        'topup' => [
            'class' => 'backend\modules\topup\Topup',
        ],
        'margin' => [
            'class' => 'backend\modules\margin\Margin',
        ],
        'warrantytype' => [
            'class' => 'backend\modules\warrantytype\Warrantytype',
        ],
        'warrantyperiod' => [
            'class' => 'backend\modules\warrantyperiod\Warrantyperiod',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'productpost' => [
            'class' => 'backend\modules\productpost\Productpost',
        ],
        'mimin' => [
            'class' => '\hscstudio\mimin\Module',
        ],
        'error' => [
            'class' => 'backend\modules\error\Error',
        ],
        'inbound' => [
            'class' => 'backend\modules\inbound\Inbound',
        ],
        'elastic-search' => [
            'class' => 'app\modules\elasticsearch\ElasticSearch',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            //'loginUrl' => [ 'yourcontroller/youraction'],
            'loginUrl' => ['auth/'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'error/error/index',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'order/order/view/<hash>' => 'order/order/view',
                'order/order/print-purchase-order/<hash>/<title>' => 'order/order/print-purchase-order',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/costfit'],
                'baseUrl' => '@web'
            ]
        ],
        'assetManager' => [
            'forceCopy' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [],
                    'depends' => ['\backend\assets\CostFitAsset']
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                    'js' => []
                ],
                'yii\web\YiiAsset' => [
                    'depends' => [
                        'backend\assets\CostFitAsset',
                    ]
                ]
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
        //'params' => [
// list of parameters
//'shippingScanTrayOnly' => TRUE,
//],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD', //GD or Imagick
        ],
    ],
    'as access' => [
        'class' => '\hscstudio\mimin\components\AccessControl',
        'allowActions' => [
// add wildcard allowed action here!
            'dashboard/*',
            'auth/*',
            'site/*',
            'order/*',
            'debug/*',
            'mimin/*', // only in dev mode
//            'management/*'
            'topup/*',
            'generate-model/*',
            'lockers/*'
        ],
    ],
    'params' => $params,
];
