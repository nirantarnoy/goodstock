<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Quotation;

/**
 * QuotationSearch represents the model behind the search form of `backend\models\Quotation`.
 */
class QuotationSearch extends Quotation
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'require_date', 'customer_id', 'approve_status', 'approve_by', 'approve_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['quotation_no', 'customer_ref', 'note'], 'safe'],
            [['total_amount'], 'number'],
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
        $query = Quotation::find();

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
            'require_date' => $this->require_date,
            'customer_id' => $this->customer_id,
            'approve_status' => $this->approve_status,
            'approve_by' => $this->approve_by,
            'approve_date' => $this->approve_date,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        if($this->globalSearch != ''){
            $query->orFilterWhere(['like','quotation_no',$this->globalSearch])
                  ->orFilterWhere(['like','customer_ref',$this->globalSearch])
                  ->orFilterWhere(['like','note',$this->globalSearch]);
        }

        return $dataProvider;
    }
}
