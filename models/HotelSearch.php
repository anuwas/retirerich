<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hotel;

/**
 * HotelSearch represents the model behind the search form of `app\models\Hotel`.
 */
class HotelSearch extends Hotel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_id', 'active'], 'integer'],
            [['hotel_name', 'address', 'address_other', 'contact_number', 'gst_number', 'state', 'state_code', 'pan_number', 'group_name', 'star_category', 'city', 'country', 'zipcode', 'hotel_email', 'created_date','corporate_rate','amenities','remark','tax','tax_remark','from_day','to_day','price'], 'safe'],
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
        $query = Hotel::find();

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
            'hotel_id' => $this->hotel_id,
            'active' => $this->active,
            'created_date' => $this->created_date,
            'amenities' =>$this->amenities,
        ]);

        $query->andFilterWhere(['like', 'hotel_name', $this->hotel_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address_other', $this->address_other])
	        ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'gst_number', $this->gst_number])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'state_code', $this->state_code])
            ->andFilterWhere(['like', 'pan_number', $this->pan_number])
            ->andFilterWhere(['like', 'group_name', $this->group_name])
            ->andFilterWhere(['like', 'star_category', $this->star_category])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'hotel_email', $this->hotel_email])
            ->andFilterWhere(['like', 'corporate_rate', $this->corporate_rate])
            ->andFilterWhere(['like', 'amenities', $this->amenities])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'tax', $this->tax])
            ->andFilterWhere(['like', 'tax_remark', $this->tax_remark])
            ->andFilterWhere(['like', 'from_day', $this->from_day])
            ->andFilterWhere(['like', 'to_day', $this->to_day])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}
