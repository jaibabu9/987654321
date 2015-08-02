<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'timeZone' => 'Asia/Calcutta',
    'modules' => [
        'mongogii' =>[
            'class' => 'yii\gii\Module',
            'generators' =>[
                'mongoDbModel' =>[
                    'class' => 'yii\mongodb\gii\model\Generator'
                ]
            ],
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/medieasy',
        ],
        'session' => [
            'name' => 'FSID',
            'savePath' => __DIR__ . '/../config/tmp',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
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
            'baseUrl' => '/medieasy',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'rules' => []
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/medieasy/backend/web',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'viewPath' => '@backend/mail',
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'ursdineshr@gmail.com',
                'password' => '', //password here
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
    ],
    'params' => $params,
];
