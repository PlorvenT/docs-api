<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 11:16
 */
declare(strict_types=1);

namespace rest\controllers;

use rest\components\Controller;
use rest\controllers\actions\order\CreateAction;
use rest\controllers\actions\order\IndexAction;
use rest\controllers\actions\order\DeleteAction;
use rest\controllers\actions\order\ViewAction;

/**
 * Class OrderController
 * @package rest\controllers
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class
            ],
            'create' => [
                'class' => CreateAction::class
            ],
            'view' => [
                'class' => ViewAction::class
            ],
            'delete' => [
                'class' => DeleteAction::class
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'create' => ['POST'],
            'delete' => ['DELETE'],
        ];
    }
}
