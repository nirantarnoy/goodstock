<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Purchtable;

/**
 * PurchtableSearch represents the model behind the search form of `backend\models\Purchtable`.
 */
class PurchtableSearch extends Purchtable
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vendor_id', 'delivery_to', 'confirm_status', 'require_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['purch_no', 'purch_date', 'note'], 'safe'],
            [['discount_amt', 'discount_per', 'total_amount'], 'number'],
            [['globalSearch'],'string'],
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
        $query = Purchtable::find();

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
            'vendor_id' => $this->vendor_id,
            'delivery_to' => $this->delivery_to,
            'discount_amt' => $this->discount_amt,
            'discount_per' => $this->discount_per,
            'confirm_status' => $this->confirm_status,
            'require_date' => $this->require_date,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        if($this->globalSearch != ''){
            $query->orFilterWhere(['like','purch_no',$this->globalSearch]);
        }
        return $dataProvider;
    }
}
