<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 16:19
 */
declare(strict_types=1);

namespace rest\models\view;

use common\models\OrderDocument as CommonOrderDocument;
use yii\helpers\Url;

/**
 * Class OrderDocument
 * @package rest\models\view
 */
class OrderDocument extends CommonOrderDocument
{
    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id',
            'orderId',
            'name',
            'type',
            'statusForOrder',
            'statusForAct',
            'downloadLink' => function (OrderDocument $document) {
                $url = Url::to(['/documents/download/' . $document->fileHash]);

                return Url::base(true) . $url;
            },
        ];
    }
}