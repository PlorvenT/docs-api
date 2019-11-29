<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 29.11.2019
 * Time: 19:59
 */
declare(strict_types=1);

namespace rest\components\product;

use common\models\Product;
use common\models\ProductSize;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnprocessableEntityHttpException;

abstract class EditableModelCommand extends ProductCommand
{
    /**
     * @param Product $product
     * @param array $data
     */
    protected function setProductAttributes($product, $data)
    {
        $product->load($data, '');
        $product->certificates = $this->mirrorImages($product->certificates);
        if (isset($data['marking_content'])) {
            $product->marking_content = $data['marking_content'];
        }

        if (isset($data['pickup_modal_content'])) {
            $product->pickup_modal_content = $data['pickup_modal_content'];
        }

        $this->uploadFiles($product);
    }

    /**
     * @param $productId
     * @param $sizes
     * @throws ServerErrorHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    protected function processSizes($productId, $sizes)
    {
        //TODO: вынести а отдельные сервивы для обработки $size['action'].
        foreach ($sizes as $size) {
            if (isset($size['guid'], $size['action'])) {
                if ($size['action'] == 'new') {
                    $productSize = new ProductSize(['product_id' => $productId]);
                    $this->setProductSizeAttributes($productSize, $size);
                    if (!$productSize->save()) {
                        throw new ServerErrorHttpException('Product size: ' . $size['guid'] . ' did not save.');
                    }
                } elseif ($size['action'] == 'update') {
                    $productSize = ProductSize::findOne(['guid' => $size['guid']]);
                    if ($productSize) {
                        $this->setProductSizeAttributes($productSize, $size);
                        if (!$productSize->save()) {
                            throw new UnprocessableEntityHttpException('Product size: ' . $size['guid'] . ' did not update.');
                        }
                    } else {
                        throw new NotFoundHttpException('Product size: ' . $size['guid'] . ' not found.');
                    }
                } elseif ($size['action'] == 'delete') {
                    $productSize = ProductSize::findOne(['guid' => $size['guid']]);
                    if ($productSize) {
                        $productSize->delete();
                    }
                }
            } else {
                throw new UnprocessableEntityHttpException('Product size "guid" and "action" are required fields.');
            }
        }
    }

    /**
     * @param ProductSize $productSize
     * @param array $data
     */
    private function setProductSizeAttributes($productSize, $data)
    {
        $productSize->load($data, '');
        $productSize->images = $this->mirrorImages($productSize->images);
        $productSize->sizes_content = $this->parseContentService->mirrorImageInContent($productSize->sizes_content);
    }

    /**
     * @param Product $product
     * @return Product
     */
    protected function uploadFiles($product)
    {
        $product->pdf_url = $this->parseContentService->saveFile($product->pdf_url);
        $product->installation_content = $this->parseContentService->mirrorImageInContent($product->installation_content);
        $product->marking_content = $this->parseContentService->mirrorImageInContent($product->marking_content);
        $product->pickup_modal_content = $this->parseContentService->mirrorImageInContent($product->pickup_modal_content);

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