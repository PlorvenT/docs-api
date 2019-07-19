<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 19.07.2019
 * Time: 15:24
 */

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Client;

/**
 * ClientSearch represents the model behind the search form of `common\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clientSiteId', 'name', 'email', 'phone', 'companyName', 'communicateChannel', 'createdAt'], 'safe'],
            [['client1cId'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Client::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'client1cId' => $this->client1cId,
            'createdAt' => $this->createdAt,
        ]);

        $query->andFilterWhere(['like', 'clientSiteId', $this->clientSiteId])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'companyName', $this->companyName])
            ->andFilterWhere(['like', 'communicateChannel', $this->communicateChannel]);

        return $dataProvider;
    }
}
