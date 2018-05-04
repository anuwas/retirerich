<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fund".
 *
 * @property string $id
 * @property string $name
 * @property int $year_limit
 * @property int $amount_limit
 * @property string $created_date
 * @property int $active
 */
class Fund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fund';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_limit', 'amount_limit', 'active'], 'integer'],
            [['created_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year_limit' => 'Year Limit',
            'amount_limit' => 'Amount Limit',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @inheritdoc
     * @return FundQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FundQuery(get_called_class());
    }
}
