<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property string $hotel_id
 * @property string $hotel_name
 * @property string $address
 * @property string $address_other
 * @property string $contact_number
 * @property string $gst_number
 * @property string $state
 * @property string $state_code
 * @property string $pan_number
 * @property string $group_name
 * @property string $star_category
 * @property string $city
 * @property string $countries
 * @property string $zipcode
 * @property string $hotel_email
 * @property int $active
 * @property string $created_date
 * @property int $corporate_rate
 * @property string $amenities
 * @property string $remark
 * @property string $tax_rate
 * @property string $tax_remark
 * @property string $cancellation_policy
 * @property string $from_day
 * @property string $to_day
 * @property string $price
 * @property string $contact_person
 * @property string $contact_email
 * @property string $payment_method
 * @property string $filename
 *
 * @property Countries $countries0
 * @property HotelBank[] $hotelbanks
 * @property Booking[] $bookings
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_name'], 'required'],
            [['active','corporate_rate','countries'], 'integer'],
            [['created_date'], 'safe'],
            [['hotel_name', 'address', 'address_other', 'contact_number', 'group_name', 'city', 'zipcode','amenities','remark','tax','tax_remark','from_day',  'to_day','price','contact_person','contact_email','payment_method', 'cancellation_policy','filename'], 'string', 'max' => 255],
            [['gst_number', 'state', 'state_code', 'pan_number', 'star_category'], 'string', 'max' => 50],
            [['hotel_email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotel_id' => 'Hotel ID',
            'hotel_name' => 'Hotel Name',
            'address' => 'Address',
            'address_other' => 'Address Other',
	        'contact_number' => 'Contact Number',
            'gst_number' => 'Gst Number',
            'state' => 'State',
            'state_code' => 'State Code',
            'pan_number' => 'Pan Number',
            'group_name' => 'Group Name',
            'star_category' => 'Star Category',
            'city' => 'City',
            'countries' => 'Country',
            'zipcode' => 'Zipcode',
            'hotel_email' => 'Hotel Email',
            'active' => 'Active',
            'created_date' => 'Created Date',
            'corporate_rate' => 'Corporate Rate',
            'amenities' => 'Amenities',
            'remark' => 'Remark',
            'tax' => 'Tax',
            'tax_remark' => 'Tax Remark',
            'cancellation_policy' => 'Cancellation Policy',
            'from_day' => 'From Day',
            'to_day' => 'To Day',
            'price' => 'Price',
            'contact_person'=>'Contact Person',
            'contact_email'=>'Contact Email',
            'payment_method'=>'Payment Method',
            'filename'=>'Filename',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelbanks()
    {
        return $this->hasMany(HotelBank::className(), ['hotel_id' => 'hotel_id']);
    }



    public function getCountries0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countries']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['hotel_id' => 'hotel_id']);
    }


    /**
     * @inheritdoc
     * @return HotelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelQuery(get_called_class());
    }
}
