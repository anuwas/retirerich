<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Appuser;

/**
 * AppuserSearch represents the model behind the search form of `app\models\Appuser`.
 */
class AppuserSearch extends Appuser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appuser_id', 'active'], 'integer'],
            [['user_type', 'username', 'password', 'emp_code', 'emp_dob', 'emp_anniversary', 'name', 'email', 'mobile', 'created_date'], 'safe'],
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
        $query = Appuser::find();

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
            'appuser_id' => $this->appuser_id,
            'emp_dob' => $this->emp_dob,
            'emp_anniversary' => $this->emp_anniversary,
            'created_date' => $this->created_date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'user_type', $this->user_type])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'emp_code', $this->emp_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
