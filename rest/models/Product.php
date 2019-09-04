<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 21:22
 */
declare(strict_types=1);

namespace rest\models;

/**
 * Class Product
 * @package rest\models
 */
class Product extends \common\models\Product
{
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['id']);
        $fields['sizes'] = function () {
            return $this->sizes ? $this->sizes : [];
        };
        return $fields;
    }

    public function extraFields()
    {
        return ['sizes'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSizes()
    {
        return $this->hasMany(ProductSize::class, ['product_id' => 'id']);
    }
}
