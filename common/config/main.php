<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => TRUE,
            'showScriptName' => false,
            'rules' => [
            // your rules go here
            ],
        // ...
        ],
//        'urlManagerFrontend' => [
//            'class' => 'yii\web\urlManager',
//            'baseUrl' => '/cost.fit/frontend/web',
//            'scriptUrl' => '/cost.fit/frontend/web/index.php',
//            'enablePrettyUrl' => true,
//            'showScriptName' => FALSE,
//        ],
//        'urlManagerBackend' => [
//            'class' => 'yii\web\urlManager',
//            'baseUrl' => '/cost.fit/backend/web',
//            'scriptUrl' => '/cost.fit/backend/web/index.php',
//            'enablePrettyUrl' => true,
//            'showScriptName' => FALSE,
//        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ]
            ]
        ],
    ],
];
