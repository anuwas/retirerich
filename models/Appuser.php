<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appuser".
 *
 * @property int $appuser_id
 * @property string $user_type
 * @property string $username
 * @property string $password
 * @property string $emp_code
 * @property string $emp_dob
 * @property string $emp_anniversary
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $created_date
 * @property int $active
 */
class Appuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['emp_code'], 'required'],
            [['emp_dob', 'emp_anniversary', 'created_date'], 'safe'],
            [['active'], 'integer'],
            [['user_type', 'mobile'], 'string', 'max' => 45],
            [['username', 'password', 'name', 'email'], 'string', 'max' => 145],
            [['emp_code'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'appuser_id' => 'Appuser ID',
            'user_type' => 'User Type',
            'username' => 'Username',
            'password' => 'Password',
            'emp_code' => 'Emp Code',
            'emp_dob' => 'Emp Dob',
            'emp_anniversary' => 'Emp Anniversary',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'created_date' => 'Created Date',
            'active' => 'Active',
        ];
    }

    /**
     * @inheritdoc
     * @return AppuserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppuserQuery(get_called_class());
    }
}
