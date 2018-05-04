<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goal".
 *
 * @property string $id
 * @property string $customer_id
 * @property string $pro_cat_id
 * @property string $goal_type
 * @property string $investment_amount
 * @property string $goal_amount
 * @property string $goal_period
 * @property string $sip_amount
 * @property string $lumsum_amount
 * @property string $goal_start_date
 * @property string $goal_end_date
 * @property string $sip_date
 * @property string $investment_start_date
 * @property string $investment_end_date
 * @property string $created_date
 * @property string $modified_date
 * @property int $created_by
 * @property string $goal_status
 * @property int $active
 *
 * @property CustomerMaster $customer
 * @property ProductCategory $proCat
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'pro_cat_id', 'created_by', 'active'], 'integer'],
            [['goal_start_date', 'goal_end_date', 'sip_date', 'investment_start_date', 'investment_end_date', 'created_date', 'modified_date'], 'safe'],
            [['goal_type', 'investment_amount','goal_amount', 'goal_period', 'sip_amount', 'lumsum_amount'], 'string', 'max' => 255],
            [['goal_status'], 'string', 'max' => 25],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerMaster::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['pro_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['pro_cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'pro_cat_id' => 'Pro Cat ID',
            'goal_type' => 'Goal Type',
            'goal_amount' => 'Goal Amount',
            'investment_amount' => 'Investment Amount',
            'goal_period' => 'Goal Period',
            'sip_amount' => 'Sip Amount',
            'lumsum_amount' => 'Lumsum Amount',
            'goal_start_date' => 'Goal Start Date',
            'goal_end_date' => 'Goal End Date',
            'sip_date' => 'Sip Date',
            'investment_start_date' => 'Investment Start Date',
            'investment_end_date' => 'Investment End Date',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'created_by' => 'Created By',
            'goal_status' => 'Goal Status',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(CustomerMaster::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProCat()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'pro_cat_id']);
    }

    /**
     * @inheritdoc
     * @return GoalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoalQuery(get_called_class());
    }
}
