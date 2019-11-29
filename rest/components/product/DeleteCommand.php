<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 20:45
 */
declare(strict_types=1);

namespace rest\components\product;

use common\models\Product;
use yii\web\NotFoundHttpException;

/**
 * Class DeleteCommand
 * @package rest\components\product
 */
class DeleteCommand extends ProductCommand
{
    /**
     * @param array $data
     * @return mixed|void
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function run($data)
    {
        $product = Product::findOne(['guid' => $this->guid]);
        if ($product) {
            $product->delete();
        } else {
            throw new NotFoundHttpException('Item with guid:"' . $this->guid . '" not found.');
        }
    }
}
