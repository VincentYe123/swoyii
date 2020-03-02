<?php

use app\common\StdoutTarget;
use app\component\ErrorHandle;
use yii\gii\Module;
use yii\caching\FileCache;

$params = require __DIR__.'/../../params/params.php';
$db = require __DIR__.'/db.php';

$config = [
    'id' => 'swoyii-console',
    'basePath' => dirname(__DIR__).'/../',
    'controllerNamespace' => 'app\command',
    'bootstrap' => ['log'],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'errorHandler' => [
            'class' => ErrorHandle::class,
        ],
        'log' => [
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => StdoutTarget::class,
                    'categories' => ['application'],
                    'exportInterval' => 1,
                    'logVars' => [],
                    'levels' => [
                        'info',
                        'warning',
                        'error',
                    ],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

if (YII_ENV === 'local') {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => Module::class,
    ];
}

return $config;
