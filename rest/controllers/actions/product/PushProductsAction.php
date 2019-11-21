<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 02.09.2019
 * Time: 22:00
 */
declare(strict_types=1);

namespace rest\controllers\actions\product;

use rest\components\product\CommandFactory;
use rest\services\ParseContentService;
use Yii;
use yii\base\Action;

/**
 * Class PushProductsAction
 * @package rest\controllers\actions\product
 */
class PushProductsAction extends Action
{
    /**
     * @var ParseContentService
     */
    private $parseContentService;

    /**
     * PushProductsAction constructor.
     * @param $id
     * @param $controller
     * @param array $config
     */
    public function __construct($id, $controller, $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->parseContentService = new ParseContentService();
    }

    public function run()
    {
        $products = \Yii::$app->request->post('products');
        if ( isset ($products['item']) ) {
        	foreach ( $products['item'] as $item ) {
		        $command = CommandFactory::create($item);
		        if ($command) {
			        $command->run($item);
		        }
	        }
        }
//        $installationContent = \Yii::$app->request->post('products')['item']['installation_content'];
//        $installationContent = $this->parseContentService->mirrorImageInContent($installationContent);
//        var_dump($installationContent);
//        die();
//
//        $newName = $this->parseContentService->saveFile($pdf);
//        return $newName;
        Yii::$app->response->setStatusCode(200);

        return ['status' => 'success'];
    }
}
