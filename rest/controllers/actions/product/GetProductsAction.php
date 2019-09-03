<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 21:16
 */
declare(strict_types=1);

namespace rest\controllers\actions\product;

use rest\models\Product;
use yii\base\Action;

/**
 * Class GetProductsAction
 * @package rest\controllers\actions\product
 */
class GetProductsAction extends Action
{
    public function run()
    {
        $products = Product::find()->all();
        return ['products' => $products];
    }
}
