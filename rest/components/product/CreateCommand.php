<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 20:53
 */
declare(strict_types=1);

namespace rest\components\product;

use common\models\Product;
use yii\web\UnprocessableEntityHttpException;

/**
 * Class CreateCommand
 * @package rest\components\product
 */
class CreateCommand extends EditableModelCommand
{
    /**
     * @param $data
     * @return mixed|void
     */
    public function run($data)
    {
        $product = new Product();
        $product->guid = $data['id'];

        $this->setProductAttributes($product, $data);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($product->save()) {
                $this->processSizes($product->id, $data['sizes']);
                $transaction->commit();
            } else {
                throw new UnprocessableEntityHttpException('Item not created. ' . print_r($product->errors, true));
            }
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}