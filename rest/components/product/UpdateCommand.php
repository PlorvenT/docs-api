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

/**
 * Class UpdateCommand
 * @package rest\components\product
 */
class UpdateCommand extends ProductCommand
{
    public function run($data)
    {
        /** @var Product $product */
        $product = Product::findOne(['guid' => $this->guid]);
        if ($product) {
            $product->title = $data['title'];
            $product->h1 = $data['h1'];
            $product->short_description = $data['short_description'];
            $product->meta_description = $data['meta_description'];
            $product->description = $data['description'];
            $product->pdf_url = $data['pdf_url'];
            $product->certificates = $this->mirrorImages($data['certificates']);
            $product->installation_content = $data['installation_content'];
            $product->features_content = $data['features_content'];
            $product->sizes_content = $data['sizes_content'];

            $product = $this->uploadFiles($product);

            if ($product->save()) {
                $this->processSizes($product->id, $data['sizes']);
            }
        }
    }
}