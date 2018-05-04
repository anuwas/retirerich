<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goal;

/**
 * GoalSearch represents the model behind the search form of `app\models\Goal`.
 */
class GoalSearch extends Goal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'pro_cat_id', 'created_by', 'active'], 'integer'],
            [['goal_type', 'investment_amount', 'goal_amount', 'goal_period', 'sip_amount', 'lumsum_amount', 'goal_start_date', 'goal_end_date', 'sip_date', 'investment_start_date', 'investment_end_date', 'created_date', 'modified_date', 'goal_status'], 'safe'],
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
        $query = Goal::find();

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
            'customer_id' => $this->customer_id,
            'pro_cat_id' => $this->pro_cat_id,
            'goal_start_date' => $this->goal_start_date,
            'goal_end_date' => $this->goal_end_date,
            'sip_date' => $this->sip_date,
            'investment_start_date' => $this->investment_start_date,
            'investment_end_date' => $this->investment_end_date,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'created_by' => $this->created_by,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'goal_type', $this->goal_type])
	        ->andFilterWhere(['like', 'investment_amount', $this->investment_amount])
            ->andFilterWhere(['like', 'goal_amount', $this->goal_amount])
            ->andFilterWhere(['like', 'goal_period', $this->goal_period])
            ->andFilterWhere(['like', 'sip_amount', $this->sip_amount])
            ->andFilterWhere(['like', 'lumsum_amount', $this->lumsum_amount])
            ->andFilterWhere(['like', 'goal_status', $this->goal_status]);

        return $dataProvider;
    }
}
