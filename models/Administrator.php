<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrator".
 *
 * @property integer $administratorid
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $active
 * @property string $lastLogin
 * @property string $role
 *
 * @property Administrator[] $administrator
 */
class Administrator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['active'], 'integer'],
            [['lastLogin'], 'safe'],
            [['name', 'email', 'password','role'], 'string', 'max' => 145],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'administratorid' => 'Administratorid',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'active' => 'Active',
            'lastLogin' => 'Last Login',
        ];
    }

    /**
     * @inheritdoc
     * @return AdministratorQuery the active query used by this AR class.
     */
    public function getQuery()
    {
        return $this->hasMany(Query::className(), ['assignto_employee' => 'administratorid']);
    }
    public static function find()
    {
        return new AdministratorQuery(get_called_class());
    }
}
