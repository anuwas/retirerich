<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_master".
 *
 * @property string $id
 * @property string $customer_name
 * @property string $firstname
 * @property string $lastname
 * @property string $gender
 * @property string $marital_status
 * @property string $dob
 * @property string $customer_email
 * @property string $phone
 * @property string $password
 * @property string $otp
 * @property string $created_date
 * @property string $modified_date
 * @property int $active
 *
 * @property Goal[] $goals
 */
class CustomerMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_master';
    }

	public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dob', 'created_date', 'modified_date'], 'safe'],
            [['active'], 'integer'],
	        ['captcha', 'required'],
	        ['captcha', 'captcha'],
            [['customer_name', 'firstname', 'lastname', 'gender', 'marital_status', 'customer_email', 'phone', 'password'], 'string', 'max' => 255],
            [['otp'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Customer Name',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'dob' => 'Dob',
            'customer_email' => 'Customer Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'otp' => 'Otp',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['customer_id' => 'id']);
    }


	public function beforeSave($insert)
	{
		$this->dob = date('Y-m-d', strtotime( $this->dob));
		return true;
	}

    /**
     * @inheritdoc
     * @return CustomerMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerMasterQuery(get_called_class());
    }
}
