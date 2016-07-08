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
            'class' => 'backend\modules\profile\profile',
            'defaultRoute' => 'profile',
        ],
        'management' => [
            'class' => 'backend\modules\management\management',
            'defaultRoute' => 'management',
        ],
        'auth' => [
            'class' => 'backend\modules\auth\auth',
            'defaultRoute' => 'auth',
        ],
        'kt-generator' => [
            'class' => 'backend\modules\KTGenerator\KTGenerator',
        ],
        'store' => [
            'class' => 'backend\modules\store\Store',
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
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@web/images',
            'uploadUrl' => '@web/images',
            'imageAllowExtensions' => ['jpg', 'png', 'gif']
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
            //'errorAction' => 'site/error',
            'errorAction' => 'error/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/costfit'],
                'baseUrl' => '@web'
            ]
        ],
    ],
    'params' => $params,
];
