<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 03.09.2019
 * Time: 20:44
 */
declare(strict_types=1);

namespace rest\components\product;

use common\models\Product;
use common\models\ProductSize;
use rest\services\ParseContentService;

/**
 * Class ProductCommand
 * @package rest\components\product
 */
abstract class ProductCommand
{
    /**
     * @var string
     */
    protected $guid;

    /**
     * @var ParseContentService
     */
    protected $parseContentService;

    /**
     * ProductCommand constructor.
     * @param $guid
     */
    public function __construct($guid)
    {
        $this->guid = $guid;
        $this->parseContentService = new ParseContentService();
    }

    /**
     * @param $data
     * @return mixed
     */
    abstract public function run($data);

    protected function processSizes($productId, $sizes)
    {
        foreach ($sizes as $size) {
            if (isset($size['guid'], $size['action'])) {
                if ($size['action'] == 'new') {
                    $productSize = new ProductSize();
                    $productSize->product_id = $productId;
                    $productSize->guid = $size['guid'];
                    $productSize->price = $size['price'];
                    $productSize->marking_content = $size['marking_content'];
                    $productSize->features_content = $size['features_content'];
                    $productSize->images = $this->mirrorImages($size['images']);
                    $productSize->save();
                } elseif ($size['action'] == 'update') {
                    $productSize = ProductSize::findOne(['guid' => $size['guid']]);
                    if ($productSize) {
                        $productSize->product_id = $productId;
                        $productSize->guid = $size['guid'];
                        $productSize->price = $size['price'];
                        $productSize->marking_content = $size['marking_content'];
                        $productSize->features_content = $size['features_content'];
                        $productSize->images = $this->mirrorImages($size['images']);
                        $productSize->save();
                    }
                } elseif ($size['action'] == 'delete') {
                    $productSize = ProductSize::findOne(['guid' => $size['guid']]);
                    if ($productSize) {
                        $productSize->delete();
                    }
                }
            }
        }
    }

    /**
     * @param Product $product
     * @return Product
     */
    protected function uploadFiles($product)
    {
        $product->pdf_url = $this->parseContentService->saveFile($product->pdf_url);
        $product->installation_content = $this->parseContentService->mirrorImageInContent($product->installation_content);
        $product->features_content = $this->parseContentService->mirrorImageInContent($product->features_content);
        $product->sizes_content = $this->parseContentService->mirrorImageInContent($product->sizes_content);

        return $product;
    }

    /**
     * @param $images
     * @return mixed
     */
    protected function mirrorImages($images)
    {
        foreach ($images as &$image) {
            if (isset($image['images']['item']['guid'])){
                $image['images']['item']['guid'] = $this->parseContentService->saveFile($image['images']['item']['guid']);
            }
        }
        return $images;
    }
}
