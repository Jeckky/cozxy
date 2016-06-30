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
        //           'baseUrl' => '/areawow-frontend',
        //           'scriptUrl' => '/areawow-frontend/index.php',
        //           'enablePrettyUrl' => true,
        //           'showScriptName' => FALSE,
        //       ],
        //       'urlManagerBackend' => [
        //           'class' => 'yii\web\urlManager',
        //           'baseUrl' => '/areawow-backend',
        //           'scriptUrl' => '/areawow-backend/index.php',
        //           'enablePrettyUrl' => true,
        //           'showScriptName' => FALSE,
        //       ],
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
