<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $name
 * @property int $code
 * @property int $country_id
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['code', 'country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
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
            'code' => 'Code',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @inheritdoc
     * @return StatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatesQuery(get_called_class());
    }
}
