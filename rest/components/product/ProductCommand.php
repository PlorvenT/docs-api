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
use yii\web\ServerErrorHttpException;

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
}
