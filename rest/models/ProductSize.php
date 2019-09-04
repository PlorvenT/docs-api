<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 04.09.2019
 * Time: 9:14
 */
declare(strict_types=1);

namespace rest\models;

/**
 * Class ProductSize
 * @package rest\models
 */
class ProductSize extends \common\models\ProductSize
{
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['id']);
        unset($fields['product_id']);
        return $fields;
    }
}