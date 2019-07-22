<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 12:22
 */
declare(strict_types=1);

namespace rest\controllers\actions\order;

use rest\models\view\Order;
use yii\base\Action;
use yii\data\ActiveDataProvider;

/**
 * Class IndexAction
 * @package rest\controllers\actions\order
 */
class IndexAction extends Action
{
    public function run()
    {
        $orderQuery = Order::find();

        $dataProvider = new ActiveDataProvider();
        $dataProvider->query = $orderQuery;

        return $dataProvider;
    }
}
