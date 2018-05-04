<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Administrator;

/**
 * AdministratorSearch represents the model behind the search form about `app\models\Administrator`.
 */
class AdministratorSearch extends Administrator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['administratorid', 'active'], 'integer'],
            [['name', 'email', 'password', 'role', 'lastLogin'], 'safe'],
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
        $query = Administrator::find();

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
            'administratorid' => $this->administratorid,
            'active' => $this->active,
            'lastLogin' => $this->lastLogin,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
