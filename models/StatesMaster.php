<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "states_master".
 *
 * @property string $id
 * @property string $name
 * @property int $code
 * @property string $add_on
 */
class StatesMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'integer'],
            [['add_on'], 'safe'],
            [['name'], 'string', 'max' => 100],
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
            'add_on' => 'Add On',
        ];
    }

    /**
     * @inheritdoc
     * @return StatesMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatesMasterQuery(get_called_class());
    }
}
