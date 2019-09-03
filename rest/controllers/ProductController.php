<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 02.09.2019
 * Time: 21:58
 */
declare(strict_types=1);

namespace rest\controllers;

use rest\components\Controller;
use rest\controllers\actions\product\PushProductsAction;
use rest\controllers\actions\product\GetProductsAction;

/**
 * Class ProductController
 * @package rest\controllers
 */
class ProductController extends Controller
{
    const ACTION_PUSH_PRODUCTS = 'push-products';
    const ACTION_GET_PRODUCTS = 'content-get-products';
    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            self::ACTION_PUSH_PRODUCTS => [
                'class' => PushProductsAction::class
            ],
            self::ACTION_GET_PRODUCTS => [
                'class' => GetProductsAction::class
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs(): array
    {
        return [
            self::ACTION_PUSH_PRODUCTS => ['POST'],
            self::ACTION_GET_PRODUCTS => ['GET'],
        ];
    }
}
