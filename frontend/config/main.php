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
            'enableSession' => true
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
                'profile/transfer-confirm/<hash>' => 'profile/transfer-confirm',
                'payment/print-purchase-order/<hash>/<title>' => 'payment/print-purchase-order',
                'payment/print-receipt/<hash>/<title>' => 'payment/print-receipt',
                'payment/print-pay-in/<hash>/<title>' => 'payment/print-pay-in',
                'profile/shipping-address/<hash>' => 'profile/shipping-address',
                'profile/billings-address/<hash>' => 'profile/billings-address',
                'products/<hash>' => 'products/index',
                'checkout/confirm-checkout/<hash>' => 'checkout/confirm-checkout',
                'checkout/confirmation/<hash>' => 'checkout/confirmation',
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
                    //'class' => 'yii\authclient\clients\Google',
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '51351302330-9bnvl3nmdqmdspqece4rlbc71br0o5sh.apps.googleusercontent.com',
                    'clientSecret' => 'N739bef0DKOS7VUKT4DKmAL2',
//                    'scope' => 'https://www.googleapis.com/auth/userinfo.email',
                    'scope' => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
                    'returnUrl' => 'http://localhost/cost.fit-frontend/site/auth?authclient=google',
                ]
            ],
        ],
    ],
    'params' => $params,
];
