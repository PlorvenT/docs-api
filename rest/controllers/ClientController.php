<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 16:44
 */

namespace rest\controllers;

use rest\components\Controller;
use rest\controllers\actions\client\IndexAction;

/**
 * Class ClientController
 * @package rest\controllers
 */
class ClientController extends Controller
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
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET'],
        ];
    }
}
