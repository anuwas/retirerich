<?php

namespace app\components;


use Yii;
use yii\base\Component;
use app\models\Appuser;


class ServiceUtilComponent extends Component
{




	public function getCustomerByPhoneNumber($phone, $merchantId)
	{
		Yii::info('Inside ServiceUtilComponent.getCustomerByPhoneNumber, phone number  ' . $phone . ' , merchantId ' . $merchantId, 'service');
		$status = '';
		//$customer=Customer::find()->where(['mobile'=>$phone,'merchant_id'=>$merchantId])->count();
		$customer = Customer::find()->where(['mobile' => $phone, 'merchant_id' => $merchantId])->count();
		if ($customer > 0) {
			$status = 'duplicate';
		} else {
			$customer = Customer::find()->where(['mobile' => $phone])->count();
			if ($customer > 0) {
				$status = 'copy';
			} else {
				$status = 'new';
			}
		}

		return $status;
	}



	const CUSTOMER = 'customer';
	const SALES_PERSON = 'sales_person';
	const OUTLET = 'outlet';
	const BRAND = 'brand';


	public function sendSMS($number, $body)
	{
		$url = 'http://203.212.70.200/smpp/sendsms';

		$fields = array(
			'username' => "onengageapp",
			'password' => "onengageapp123",
			'to' => $number,
			'from' => "THANKU",
			'text' => $body
		);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//execute post
		curl_exec($ch);

		//close connection
		curl_close($ch);
	}

	/**
	 * @param $date string
	 * @return string
	 */
	public function formatDateForUI($date)
	{
		if (mb_stripos($date, ' ') > 0) {
			$dateObj = \DateTime::createFromFormat("Y-m-d", explode(' ', $date)[0]);
		} else {
			$dateObj = \DateTime::createFromFormat("Y-m-d", $date);
		}
		return $dateObj->format("d M, Y");
	}

	/**
	 * @param $date string
	 * @return string
	 */
	public function getDateMonthFromDate($date)
	{
		if (mb_stripos($date, ' ') > 0) {
			$dateObj = \DateTime::createFromFormat("Y-m-d", explode(' ', $date)[0]);
		} else {
			$dateObj = \DateTime::createFromFormat("Y-m-d", $date);
		}
		return $dateObj->format("d M");
	}

}