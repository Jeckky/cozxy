<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-mobile',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'mobile\controllers',
    'modules' => [
        'v1' => [
            'class' => 'mobile\modules\v1\V1',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-mobile',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-mobile', 'httpOnly' => true],
            'loginUrl'=>null,
            'enableSession'=>false
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
//	        'enableStrictParsing' => false,

	        'rules' => [
//                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                'v1/product/<id:\d+>'=>'v1/product/view',
                'v1/product/isbn/<isbn:\w+>'=>'v1/product/isbn'
            ],
        ],
    ],
    'params' => $params,
];
