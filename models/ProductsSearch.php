<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'actual_qty', 'views', 'low_qty_alert', 'featured', 'visible', 'recommended', 'main_page'], 'integer'],
            [['name', 'description_sm', 'description_lg', 'brand', 'product_condition', 'status'], 'safe'],
            [['weight', 'cost', 'wholesale_price', 'retail_price', 'clearance_price', 'shipping_cost', 'vat', 'discount_rate'], 'number'],
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
        $query = Products::find();

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
            'qty' => $this->qty,
            'actual_qty' => $this->actual_qty,
            'views' => $this->views,
            'weight' => $this->weight,
            'cost' => $this->cost,
            'wholesale_price' => $this->wholesale_price,
            'retail_price' => $this->retail_price,
            'clearance_price' => $this->clearance_price,
            'shipping_cost' => $this->shipping_cost,
            'vat' => $this->vat,
            'low_qty_alert' => $this->low_qty_alert,
            'discount_rate' => $this->discount_rate,
            'featured' => $this->featured,
            'visible' => $this->visible,
            'recommended' => $this->recommended,
            'main_page' => $this->main_page,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description_sm', $this->description_sm])
            ->andFilterWhere(['like', 'description_lg', $this->description_lg])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'product_condition', $this->product_condition])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
