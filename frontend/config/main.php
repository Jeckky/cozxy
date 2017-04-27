<?php

$params = array_merge(
require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
        [
            'class' => 'common\components\LanguageSelector',
            'supportedLanguages' => ['en-US', 'th-TH'], //กำหนดรายการภาษาที่ support หรือใช้ได้
        ]
    ],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module'
        ],
        'mobile' => [
            'class' => '\frontend\modules\mobile\Mobile'
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/images/story',
            'uploadUrl' => '@web/images/story',
            'imageAllowExtensions' => ['jpg', 'png', 'gif', 'jpeg'],
        ],
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
                //Custom Rule
//                '<controller:\w+>/<hash>' => '<controller>/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<hash>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<hash>/<title>' => '<controller>/<action>',
                'products/<hash>' => 'products/index',
                //Custom Rule
                'profile/purchase-order/<hash>' => 'profile/purchase-order',
                'profile/transfer-confirm/<hash>' => 'profile/transfer-confirm',
                'payment/print-purchase-order/<hash>/<title>' => 'payment/print-purchase-order',
                'payment/print-receipt/<hash>/<title>' => 'payment/print-receipt',
//                'payment/print-pay-in/<hash>/<title>' => 'payment/print-pay-in',
//                'profile/shipping-address/<hash>' => 'profile/shipping-address',
                'profile/billings-address/<hash>' => 'profile/billings-address',
                'checkout/confirm-checkout/<hash>' => 'checkout/confirm-checkout',
//                'checkout/edit-checkout/<hash>' => 'checkout/edit-checkout',
                'checkout/confirmation/<hash>' => 'checkout/confirmation',
//                'checkout/reverse-order-to-cart/<hash>' => 'checkout/reverse-order-to-cart',
//                'profile/picking-point/<hash>' => 'profile/picking-point',
//mobile
//                'mobile/product/<hash>' => 'mobile/product',
//                'mobile/product/product/<hash>' => 'mobile/product/product',
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
//            'forceCopy' => TRUE
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
                    'class' => 'yii\authclient\clients\Google',
                    //'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '51351302330-9bnvl3nmdqmdspqece4rlbc71br0o5sh.apps.googleusercontent.com',
                    'clientSecret' => 'N739bef0DKOS7VUKT4DKmAL2',
                    // 'scope' => 'https://www.googleapis.com/auth/userinfo.email',
                    'scope' => 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email',
                    'returnUrl' => 'http://localhost/Cozxy.com-frontend/site/auth?authclient=google',
                ]
            ],
        ],
    ],
    'params' => $params,
];
