<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Test;

/**
 * TestSearch represents the model behind the search form of `app\models\Test`.
 */
class TestSearch extends Test
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'column2', 'column7'], 'integer'],
            [['column1', 'column4', 'column5', 'column6', 'column8'], 'safe'],
            [['column3'], 'number'],
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
    public function search($params, $limit)
    {
        $query = Test::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
            'pageSize' => $limit, // Set the page size to 15
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC, // Order by descending created_at
                ],
            ],
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'column2' => $this->column2,
            'column3' => $this->column3,
            'column4' => $this->column4,
            'column7' => $this->column7,
        ]);

        $query->andFilterWhere(['like', 'column1', $this->column1])
            ->andFilterWhere(['like', 'column5', $this->column5])
            ->andFilterWhere(['like', 'column6', $this->column6])
            ->andFilterWhere(['like', 'column8', $this->column8]);

        return $dataProvider;
    }
}
