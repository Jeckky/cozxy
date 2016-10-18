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
//            'baseUrl' => '/cost.fit-test/frontend/web',
//            'scriptUrl' => '/cost.fit-test/frontend/web/index.php',
//            'enablePrettyUrl' => true,
//            'showScriptName' => FALSE,
//        ],
//        'urlManagerBackend' => [
//            'class' => 'yii\web\urlManager',
//            'baseUrl' => '/cost.fit-test/backend/web',
//            'scriptUrl' => '/cost.fit-test/backend/web/index.php',
//            'enablePrettyUrl' => true,
//            'showScriptName' => FALSE,
//        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'online@daiigroup.com',
                'password' => 'jmjoitnalfkzqfhg',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ],
            /* 'frontend*' => [
              'class' => 'yii\i18n\PhpMessageSource',
              'basePath' => '@common/messages',
              ],
              'backend*' => [
              'class' => 'yii\i18n\PhpMessageSource',
              'basePath' => '@common/messages',
              ], */
            ]
        ],
    ],
    'language' => 'TH',
    'sourceLanguage' => 'US',
];
