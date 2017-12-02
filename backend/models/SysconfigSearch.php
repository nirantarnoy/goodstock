<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sysconfig;

/**
 * SysconfigSearch represents the model behind the search form of `backend\models\Sysconfig`.
 */
class SysconfigSearch extends Sysconfig
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plant_id', 'is_currency_rate', 'is_auto_backup', 'is_negative_stock', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
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
        $query = Sysconfig::find();

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
            'plant_id' => $this->plant_id,
            'is_currency_rate' => $this->is_currency_rate,
            'is_auto_backup' => $this->is_auto_backup,
            'is_negative_stock' => $this->is_negative_stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
