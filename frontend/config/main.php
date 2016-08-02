<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module'
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'search/<title>/<hash>' => 'search/index',
                'profile/purchase-order/<hash>' => 'profile/purchase-order',
            ],
        ],
        /**
         * Theme
         */
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/costfit'],
                'baseUrl' => '@web'
            ]
        ],
        /**
         * Assert Manager
         */
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [],
                    'depends' => ['\frontend\assets\CostfitAsset']
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
                        'frontend\assets\CostfitAsset',
                    ]
                ]
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                    'clientId' => '1660657237592929',
                    'clientSecret' => 'd4503ebb0f9b512e58d73fee8134853f',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '500504362756-3n51v4ic4aqak5vnomg8qmmar340no72.apps.googleusercontent.com',
                    'clientSecret' => 'tBiQFFFNp6DPojoTmd1oN_Ro',
//                    'scope' => 'https://www.googleapis.com/auth/userinfo.email',
                    'scope' => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
                    'returnUrl' => 'http://localhost/areawow-frontend/site/auth?authclient=google',
                ]
            ],
        ],
    ],
    'params' => $params,
];
