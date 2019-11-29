<?php

use rest\components\ErrorHandler;
use rest\controllers\OrderDocumentController;
use rest\controllers\ProductController;
use yii\web\JsonParser;
use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-rest',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'rest\controllers',
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'errorHandler' => [
            'class' => ErrorHandler::class
        ],
        'response' => [
            'format' => Response::FORMAT_JSON,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-rest', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the rest
            'name' => 'advanced-rest',
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'client'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'order'],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'documents' => 'order-document',
                    ],
                    'extraPatterns' => [
                        'GET {orderId}' => OrderDocumentController::ACTION_INDEX,
                        'POST {id}' => OrderDocumentController::ACTION_UPDATE,
                        'GET download/{hash}' => OrderDocumentController::ACTION_DOWNLOAD,
                    ],
                    'tokens' => [
                        '{id}' => '<id:\d+>',
                        '{orderId}' => '<orderId:\d+>',
                        '{hash}' => '<hash:[a-zA-Z0-9\\-]+>',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'content' => 'product',
                    ],
                    'extraPatterns' => [
                        'POST push-products' => ProductController::ACTION_PUSH_PRODUCTS,
                        'GET get-products' => ProductController::ACTION_GET_PRODUCTS,
                        'OPTIONS push-products' => ProductController::ACTION_OPTIONS,
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];
