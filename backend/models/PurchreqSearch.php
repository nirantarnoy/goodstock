<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Purchreq;

/**
 * PurchreqSearch represents the model behind the search form of `backend\models\Purchreq`.
 */
class PurchreqSearch extends Purchreq
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'require_date', 'request_by', 'approve_status', 'approve_by', 'approve_date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['purchreq_no', 'reason', 'note'], 'safe'],
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
        $query = Purchreq::find();

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
            'request_by' => $this->request_by,
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
            $query->orFilterWhere(['like','purchreq_no',$this->globalSearch])
                  ->orFilterWhere(['like','reason',$this->globalSearch])
                  ->orFilterWhere(['like','note',$this->globalSearch]);
        }

        return $dataProvider;
    }
}
