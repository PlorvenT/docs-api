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

/**
 * Class CreateCommand
 * @package rest\components\product
 */
class CreateCommand extends ProductCommand
{
    /**
     * @param $data
     * @return mixed|void
     */
    public function run($data)
    {
        $product = new Product();

        $product->guid = $data['id'];
        $product->title = $data['title'];
        $product->h1 = $data['h1'];
        $product->short_description = $data['short_description'];
        $product->meta_description = $data['meta_description'];
        $product->description = $data['description'];
        $product->pdf_url = $data['pdf_url'];
        $product->certificates = $this->mirrorCertificates($data['certificates']);
        $product->installation_content = $data['installation_content'];
        $product->features_content = $data['features_content'];
        $product->sizes_content = $data['sizes_content'];

        $product = $this->uploadFiles($product);

        $product->save();
    }

    /**
     * @param Product $product
     * @return Product
     */
    private function uploadFiles($product)
    {
        $product->pdf_url = $this->parseContentService->saveFile($product->pdf_url);
        $product->installation_content = $this->parseContentService->mirrorImageInContent($product->installation_content);
        $product->features_content = $this->parseContentService->mirrorImageInContent($product->features_content);
        $product->sizes_content = $this->parseContentService->mirrorImageInContent($product->sizes_content);

        return $product;
    }

    /**
     * @param $certificates
     * @return mixed
     */
    private function mirrorCertificates($certificates)
    {
        foreach ($certificates as &$certificate) {
            if (isset($certificate['images']['item']['guid'])){
                $certificate['images']['item']['guid'] = $this->parseContentService->saveFile($certificate['images']['item']['guid']);
            }
        }
        return $certificates;
    }
}