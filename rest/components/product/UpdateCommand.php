<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 21:56
 */
declare(strict_types=1);

namespace rest\components\product;

use common\models\Product;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class UpdateCommand
 * @package rest\components\product
 */
class UpdateCommand extends EditableModelCommand
{
    public function run($data)
    {
        /** @var Product $product */
        $product = Product::findOne(['guid' => $this->guid]);
        if ($product) {
            $this->setProductAttributes($product, $data);

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if ($product->save()) {
                    $this->processSizes($product->id, $data['sizes']);
                    $transaction->commit();
                } else {
                    throw new ServerErrorHttpException('Product with guid:' . $this->guid . ' not save.');
                }
            } catch (\Throwable $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        } else {
            throw new NotFoundHttpException('Product with guid:' . $this->guid . ' not found.');
        }
    }
}