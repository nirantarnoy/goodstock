<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form of `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_group_id', 'payment_term', 'payment_type', 'delivery_type', 'sale_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'description'], 'safe'],
              [['globalSearch'],'string'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Customer::find();

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
            'id' => $this->id,
            'customer_group_id' => $this->customer_group_id,
            'payment_term' => $this->payment_term,
            'payment_type' => $this->payment_type,
            'delivery_type' => $this->delivery_type,
            'sale_id' => $this->sale_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

         if($this->globalSearch != ''){
            $query->orFilterWhere(['like','name',$this->globalSearch])
                  ->orFilterWhere(['like','description',$this->globalSearch]);
        }

        return $dataProvider;
    }
}
