<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 22.07.2019
 * Time: 14:58
 */
declare(strict_types=1);

namespace rest\models\search;

use common\models\Client;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\db\ActiveQuery;

class ClientForm extends Model
{
    public $date;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['date', 'datetime', 'format' => 'php:Y-m-d', 'message' => 'Дожно быть в формате Y-m-d'],
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function getDataProvider()
    {
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $this->getQuery(),
                'sort' => $this->getSort(),
            ]
        );

        return $dataProvider;
    }


    /**
     * @return ActiveQuery
     */
    protected function getQuery(): ActiveQuery
    {
        $query = Client::find();

        if ($this->date) {
            $query->andWhere(['>=', 'createdAt', $this->date]);
        }

        return $query;
    }

    protected function getSort(): Sort
    {
        return new Sort();
    }
}