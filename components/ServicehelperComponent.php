<?php

namespace app\components;


use app\models\Appuser;
use yii\base\Component;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use Yii;
class ServicehelperComponent extends Component
{
	private $serviceUitl;

	public function __construct()
	{
		$this->serviceUitl = new ServiceUtilComponent();
	}

	function LoginHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			if (isset($input['LoginCheck'])) {
				$appuser = Appuser::find()->where(['appuser_id' => $input['UserId']])->one();
				
				return ['status' => 'Success'];
			}
			$username = $input['UserName'];
			$password = $input['Password'];
			$appuser = Appuser::find()->where(['username'=>$username])->one();
			if (isset($appuser)) {
				if ($appuser->password == $password) {
					$status = array('status' => 'Success', 'msg' => 'Successfully Login','UserId' => $appuser->appuser_id, 'UserName' =>$appuser->username);
				} else {
					$status = array('status' => 'Fail', 'msg' => 'Invalid Credential, Password');
				}
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Invalid Credential, UserName');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function registerCustomerHelper($inputJSON)
	{
		try {

			$input = json_decode($inputJSON, TRUE);
			
			  $customerCheckMobile = Appuser::find()->where(['mobile'=>$input['Mobile']])->one();
			   $customerCheckEmail = Appuser::find()->where(['email'=>$input['EmailId']])->one();
			    $customerCheckusername = Appuser::find()->where(['username'=>$input['userName']])->one();
   if($customerCheckMobile != null){
			 $status = array('status' => 'Fail', 'msg' => 'Already Registger By This Mobile Number');
			 
} else if($customerCheckEmail != null) {
    $status = array('status' => 'Fail', 'msg' => 'Already Registger By This Email ID');
}
else if($customerCheckusername != null) {
    $status = array('status' => 'Fail', 'msg' => 'Already Registger By This UserName');
} else{
			$customer = new Appuser();
		
				$customer->name = $input['Name'];
				$customer->email = $input['EmailId'];
				$customer->mobile = $input['Mobile'];
				$customer->username = $input['userName'];
				$customer->password = $input['Password'];
				$customer->emp_code = $input['EmpCode'];
				$customer->emp_dob = $input['EmpDob'];
				$customer->emp_anniversary = $input['EmpAnniversary'];
			
	
			if ($customer->save()) {
			
					$status = array('status' => 'Success', 'msg' => 'Successfully Registger','UserId' => $customer->appuser_id, 'UserName' =>$customer->username);
			
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}
}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	/*function SendOTPHelper($inputJSON)
	{
		Yii::info('Inside ServicehelperComponent.CustomerOTPHelper ', 'service');
		$status = array();
		try {

			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			if ($customer) {
				$this->serviceUitl->sentOTP($customer->first_name, $customer->mobile, $customer->customer_id);
				$status = array('status' => 'Success');
			} else {
				$status = ['status' => 'Success'];
			}

		} catch (\Exception $ex) {
			Yii::error('Inside ServicehelperComponent.CustomerOTPHelper, Exception Occured ' . $ex, 'service');
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}*/

	function CustomerOTPHelper($inputJSON)
	{
		try {

			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			if ($customer) {
				if ($customer->otp == $input['OTP']) {
					$customer->opted = $input['Opted'];
					$customer->otp = '';
					$customer->otp_status = null;

					if ($customer->save()) {
						$status = array('status' => 'Success', 'CustomerId' => $customer->customer_id, 'Phone' => $customer->mobile, 'Email' => $customer->emailid, 'CustomerName' => $customer->customer_name);
					} else {
						$status = array('status' => 'Fail');
					}
				} else {
					$status = array('status' => 'Fail');
				}
			} else {
				$status = ['status' => 'Success'];
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	function GetCustomerByPhoneEmailHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$brandId = $this->serviceUitl->getBrandIdFromOutletId($input['OutletId']);
			if ($input['Mobile'] != '') {
				$customer = Customer::findOne(['mobile' => $input['Mobile'], 'brand_id'=>$brandId]);

				/*if ($customer == null) {
					$customer = Customer::findOne(['mobile' => $input['Mobile']]);
				}*/

				if ($customer != null) {
					$brandstatus = true;
					$outletstatus = false;
					$customerOutlet = CustomerOutlet::find()->where(['customer_id' => $customer->customer_id, 'outlet_id' => $input['OutletId']])->count();
					if ($customer['brand_id'] != $brandId) {
						$brandstatus = false;
					}
					if ($customerOutlet > 0) {
						$outletstatus = true;
					}


					$status = array('CustomerName' => $customer->customer_name,
						'EmailId' => $customer->emailid,
						'Mobile' => $customer->mobile,
						'Dob' => $customer->dob,
						'AniversaryDate' => $customer->aniversary_date,
						'Sex' => $customer->sex,
						'CustomerId' => $customer->customer_id,
						'FirstName' => $customer->first_name,
						'LastName' => $customer->last_name,
						'Salutation' => $customer->salutation,
						'PinCode' => $customer->pincode,
						'Cty' => $customer->cty,
						'State' => $customer->state,
						'Country' => $customer->country,
						'Workplace' => $customer->workplace,
						'MaritalStatus' => $customer->profession,
						'FatherName' => $customer->marital_status,
						'MotherName' => $customer->father_name,
						'Religion' => $customer->religion,
						'LandLineNumber' => $customer->land_line_number,
						'Language' => $customer->language,
						'opted' => $customer->opted,
						'ThisBrand' => $brandstatus,
						'ThisOutlet' => $outletstatus,
						"Profession" => $customer->profession);
				} else {
					//$status=array('CustomerName'=>'','EmailId'=>'','Mobile'=>'','Dob'=>'','AniversaryDate'=>'','Sex'=>'','CustomerId'=>'','ThisBrand'=>false,'ThisOutlet'=>false);
					$status = array('CustomerName' => '',
						'EmailId' => '',
						'Mobile' => '',
						'ThisBrand' => false,
						'ThisOutlet' => false);
				}

			}

			if ($input['Email'] != '') {
				$customer = Customer::findOne(['emailid' => $input['Email'], 'brand_id'=>$brandId]);

				/*if ($customer == null) {
					$customer = Customer::findOne(['mobile' => $input['Email']]);
				}*/
				if ($customer != null) {
					$brandstatus = true;
					$outletstatus = false;
					$customerOutlet = CustomerOutlet::find()->where(['customer_id' => $customer->customer_id, 'outlet_id' => $input['OutletId']])->count();

					if ($customer['brand_id'] != $brandId) {
						$brandstatus = false;
					}
					if ($customerOutlet > 0) {
						$outletstatus = true;
					}
					//$status=array('CustomerName'=>$customer->customer_name,'EmailId'=>$customer->emailid,'Mobile'=>$customer->mobile,'Dob'=>$customer->dob,'AniversaryDate'=>$customer->aniversary_date,'Sex'=>$customer->sex,'CustomerId'=>$customer->customer_id,'ThisBrand'=>$brandstatus,'ThisOutlet'=>$outletstatus);
					$status = array('CustomerName' => $customer->customer_name,
						'EmailId' => $customer->emailid,
						'Mobile' => $customer->mobile,
						'Dob' => $customer->dob,
						'AniversaryDate' => $customer->aniversary_date,
						'Sex' => $customer->sex,
						'CustomerId' => $customer->customer_id,
						'FirstName' => $customer->first_name,
						'LastName' => $customer->last_name,
						'Salutation' => $customer->salutation,
						'PinCode' => $customer->pincode,
						'Cty' => $customer->cty,
						'State' => $customer->state,
						'Country' => $customer->country,
						'Workplace' => $customer->workplace,
						'MaritalStatus' => $customer->profession,
						'FatherName' => $customer->marital_status,
						'MotherName' => $customer->father_name,
						'Religion' => $customer->religion,
						'LandLineNumber' => $customer->land_line_number,
						'Language' => $customer->language,
						'OtpSentStatus' => $customer->otp_status,
						'OTP' => $customer->otp,
						'opted' => $customer->opted,
						'ThisBrand' => $brandstatus,
						'ThisOutlet' => $outletstatus,
						"Profession" => $customer->profession);
				} else {
					//$status=array('CustomerName'=>'','EmailId'=>'','Mobile'=>'','Dob'=>'','AniversaryDate'=>'','Sex'=>'','CustomerId'=>'','ThisBrand'=>false,'ThisOutlet'=>false);
					$status = array('CustomerName' => '',
						'EmailId' => '',
						'Mobile' => '',
						'ThisBrand' => false,
						'ThisOutlet' => false);
				}
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}


		return $status;
	}

	function EnrollCustomerHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$outletcustomer = new CustomerOutlet();
			$outletcustomer->customer_id = $input['CustomerId'];
			$outletcustomer->outlet_id = $input['OutletId'];

			if ($outletcustomer->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Enrolled');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Enrolled');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	public function MatchOTPHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			if ($customer->otp == $input['OTP']) {
				$customer->opted = 'OptedIn';
				$customer->save();
				$status = array('status' => 'Success', 'msg' => 'Successfully Opted In');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'OTP does not match');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	public function SkipOTPHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			$customer->opted = 'OptedOut';
			if ($customer->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Opted Out');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Does not Opted Out');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}


	public function RegisterBrandHelper($inputJSON)
	{
		try {

			$input = json_decode($inputJSON, TRUE);
			$brand = new Brand();

			$brand->brand_name = $input['BrandName'];
			$brand->email = $input['EmailId'];
			$brand->phone = $input['Mobile'];
			$brand->address = $input['Address'];
			$brand->contactperson = $input['ContactPersonName'];
			$brand->merchant_id = $input['MerchantId'];

			if ($brand->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Registger', 'BrandId' => $brand->brand_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;

	}

	public function RegisterOutletHelper($inputJSON)
	{
		try {

			$input = json_decode($inputJSON, TRUE);
			if (isset($input['OutletId']) && $input['OutletId'] != 'blank') {
				$outlet = Outlet::findOne($input['OutletId']);
				if ($outlet == null) {
					return array('status' => 'Fail', 'msg' => 'Invalid ID');
				}
			} else {
				$outlet = new Outlet();
			}

			$outlet->outlet_name = $input['OutletName'];
			$outlet->brand_id = $input['BrandId'];
			$outlet->outlet_address = $input['Address'];
			$outlet->email = $input['EmailId'];
			$outlet->phone = $input['Mobile'];
			$outlet->contactperson = $input['ContactPersonName'];
			$outlet->state = $input['StateName'];
			$outlet->city = $input['CityName'];
			$outlet->lattitude = $input['Lattitude'];
			$outlet->longitude = $input['Longitude'];

			if ($outlet->save(false)) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Registger', 'OutletId' => $outlet->outlet_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => $outlet->errors);
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;

	}

	public function RegisterUserHelper($inputJSON)
	{
		try {

			$input = json_decode($inputJSON, TRUE);
			$appuser = new Appuser();

			$appuser->name = $input['Name'];
			$appuser->username = $input['UserName'];
			$appuser->password = $input['Password'];
			$appuser->user_type = $input['Type'];
			$appuser->ref_id = $input['RefId'];

			if ($appuser->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Registger', 'UserId' => $appuser->appuser_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;

	}

	function CreateCouponHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$checkCoupon = Coupon::find()->where(['coupon_code' => $input['CouponCode'], 'brand_id' => $input['BrandId']])->count();
			if ($checkCoupon > 0) {
				$status = array('status' => 'Fail', 'msg' => 'Duplicate');
			} else {

				$coupon = new Coupon();
				$coupon->coupon_description = $input['Description'];
				$coupon->coupon_code = $input['CouponCode'];
				$coupon->brand_id = $input['BrandId'];

				if ($coupon->save()) {
					$status = array('status' => 'Success', 'msg' => 'Successfully Created', 'CouponId' => $coupon->coupon_id);
				} else {
					$status = array('status' => 'Fail', 'msg' => 'Not Created');
				}
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}


	function RemoveCouponHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$coupon = Coupon::findOne(['coupon_id' => $input['CouponId']]);
			$coupon->active = 0;
			$coupon->save();
			$status = array('status' => 'Success');
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function RedeemCouponHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$customercoupon = CustomerCoupon::findOne(['customer_id' => $input['CustomerId'], 'coupon_code' => $input['CouponCode'], 'outlet_id' => $input['OutletId']]);

			$redeemCoupon = new ReedemCoupon();

			$redeemCoupon->customer_id = $customercoupon->customer_id;
			$redeemCoupon->coupon_code = $customercoupon->coupon_code;
			$redeemCoupon->outlet_id = $customercoupon->outlet_id;
			$redeemCoupon->brand_id = $customercoupon->brand_id;
			$redeemCoupon->coupon_id = $customercoupon->coupon_id;

			if ($redeemCoupon->save()) {
				$customercoupon->delete();
				$status = array('status' => 'Success', 'msg' => 'Successfully Redeem');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Redeem');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}


	public function PutUserPurchaseHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			$customervisit = new CustomerOutletVisit();
			$customervisit->customer_id = $input['CustomerId'];
			$customervisit->purchase_amount = (empty($input['Amount'])) ? 0 : $input['Amount'];
			$customervisit->visiting_date = $input['Date'];
			$customervisit->remark = $input['Remarks'];
			$customervisit->outlet_id = $input['OutletId'];
			$customervisit->brand_id = $this->serviceUitl->getBrandIdFromOutletId($input['OutletId']);

			if ($customervisit->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Visited');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Visited');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function ListOutletHelper($inputJSON)
	{
		$status = array();
		try {

			$input = json_decode($inputJSON, TRUE);
			$brandid = $input['BrandId'];
			$outlets = Outlet::find()->where(['brand_id' => $brandid])->all();

			foreach ($outlets as $values) {
				$status[] = array('OutletName' => $values->outlet_name, /*'EmailId'=>$values->email, 'Mobile'=>$values->phone,*/
					'Address' => $values->outlet_address/*, 'ContactPersonName'=>$values->contactperson*/, 'OutletId' => $values->outlet_id,'Image'=>Url::home(true).'uploads/outlet/'.(($values->filename != '')?$values->filename:'default.png'), 'Lattitude'=>$values->lattitude, 'Longitude'=>$values->longitude);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	public function ListCustomerByOutletIdHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$outletid = $input['OutletId'];
			$customers = Customer::find()->joinWith('customerOutlets')->where(['customer_outlet.outlet_id' => $outletid])->all();

			foreach ($customers as $value) {
				$status[] = array('CustomerName' => $value->customer_name,
					/*'FirstName' => $value->first_name,
					'LastName' => $value->last_name,*/
					'EmailId' => $value->emailid,
					'Mobile' => $value->mobile,
					/*'Dob' => $value->mobile,
					'AniversaryDate' => $value->aniversary_date,
					'Sex' => $value->sex,*/
					'OptStatus' => $value->opted,
					'OptedBool' => ($value->opted == 'OptedIn') ? true : false,
					'Salutation' => $value->salutation,
					/*'PinCode' => $value->pincode,
					'Cty' => $value->cty,
					'State' => $value->state,
					'Country' => $value->country,
					'Workplace' => $value->workplace,
					'MaritalStatus' => $value->profession,
					'FatherName' => $value->marital_status,
					'MotherName' => $value->father_name,
					'Religion' => $value->religion,
					'LandLineNumber' => $value->land_line_number,
					'Language' => $value->language,*/
					'RegistrationDate' => $value->created_date,
					'CustomerId' => $value->customer_id);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	public function GetCouponListByCustomerHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$coupon = CustomerCoupon::find()->joinWith('coupon')->filterWhere(['customer_coupon.coupon_code' => $input['CouponCode'], 'customer_coupon.customer_id' => $input['CustomerId'], 'customer_coupon.outlet_id' => $input['OutletId'], 'customer_coupon.brand_id' => $input['BrandId']])->all();
			foreach ($coupon as $values) {
				$status[] = array('CouponCode' => $values->coupon->coupon_code, 'CouponDescription' => $values->coupon->coupon_description);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetSubscriptionListHelper($inputJSON)
	{
		$status = array();
		try {
			//$input = json_decode($inputJSON, TRUE);

			$subscriptionpack = SubscriptionPackage::find()->joinWith('subscriptionPackageDetails')->all();
			foreach ($subscriptionpack as $values) {
				// Don't load the trial package
				if ($values->subscription_package_name == 'Trial Package') {
					continue;
				}
				$packdeial = array();
				$price = 0;
				foreach ($values->subscriptionPackageDetails as $packvalues) {
					$packdeial[$packvalues->subscriptionComponent->component_name] = $packvalues->quantity;
					$price += $packvalues->price;
				}
				$packdeial['name'] = $values->subscription_package_name;
				$packdeial['price'] = $values->price;
				$packdeial['PackageTime'] = $values->num_of_days . ' Days';
				$packdeial['id'] = $values->subscription_package_id;
				$status[] = $packdeial;
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function BuySubscriptionHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$buysubscription = new SubscriptionPurchase();
			$buysubscription->subscription_package_id = $input['SubscriptionId'];
			$buysubscription->brand_id = $input['BrandId'];
			$buysubscription->transaction_id = uniqid();


			if ($buysubscription->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Purchase', 'TransactionId' => $buysubscription->transaction_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function PaymentSuccessHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$buysubscription = SubscriptionPurchase::findOne(['transaction_id' => $input['TranscationId']]);
			$buysubscription->amount = $input['PaidAmount'];
			$buysubscription->payment_status = 1;


			if ($buysubscription->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Paid', 'TransactionId' => $buysubscription->transaction_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function CreateCustomGroupHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			// netcore API call
			$netcoreOut = $this->serviceUitl->sendNetCoreData('list', 'Add', "<Name>{$input['GroupName']}</Name><Description>{$input['GroupName']} </Description><Active>1</Active>");
			$netcoreId = $netcoreOut->OUTPUT->LID;
			// -------------------

			$group = new PromotionGroup();
			$group->group_name = $input['GroupName'];
			$group->brand_id = $input['BrandId'];
			$group->smarttech_id = $netcoreId;

			if ($group->save()) {
				$queryParams = array();
				$whereQuery = '';
				if (!empty($input['Sex'])) {
					$whereQuery .= ' and c.sex = :sex';
					$queryParams['sex'] = $input['Sex'];
				}
				if (!empty($input['PinCode'])) {
					$whereQuery .= ' and c.pincode = :pincode';
					$queryParams['pincode'] = $input['PinCode'];
				}
				if (!empty($input['Cty'])) {
					$whereQuery .= ' and c.cty = :cty';
					$queryParams['cty'] = $input['cty'];
				}
				if (!empty($input['State'])) {
					$whereQuery .= ' and c.state = :state';
					$queryParams['state'] = $input['State'];
				}
				if (!empty($input['Country'])) {
					$whereQuery .= ' and c.country = :country';
					$queryParams['country'] = $input['Country'];
				}
				if (!empty($input['Workplace'])) {
					$whereQuery .= ' and c.workplace = :workplace';
					$queryParams['workplace'] = $input['Workplace'];
				}
				if (!empty($input['Profession'])) {
					$whereQuery .= ' and c.profession = :profession';
					$queryParams['profession'] = $input['Profession'];
				}
				if (!empty($input['MaritalStatus'])) {
					$whereQuery .= ' and c.marital_status = :marital_status';
					$queryParams['marital_status'] = $input['MaritalStatus'];
				}
				if (!empty($input['Religion'])) {
					$whereQuery .= ' and c.religion = :religion';
					$queryParams['religion'] = $input['Religion'];
				}
				if (!empty($input['Language'])) {
					$whereQuery .= ' and c.language = :language';
					$queryParams['language'] = $input['Language'];
				}
				$connection = \Yii::$app->db;
				$qb = $connection
				->createCommand('select c.customer_id as customer_id from customer as c where c.brand_id=:brand_id and c.opted=:opted' . $whereQuery);

				$qb->bindValue('opted', 'OptedIn');
				$qb->bindValue('brand_id', $input['BrandId']);
				foreach ($queryParams as $param => $value) {
					$qb->bindValue($param, $value);
				}

				$list = $qb->queryAll();

				$csvName = md5(uniqid($group->group_id)) . '.csv';
				$csvFile = fopen('contact_uploads/' . $csvName, 'w');
				fputcsv($csvFile, ['MOBILE', 'EMAIL', 'PIN', 'OFFICE_ADDRESS', 'EMAIL_ID', 'CITY', 'E_MAIL', 'ANNIVERSARY', 'DOB', 'NAME', 'SEX', 'FIRST_NAME', 'LAST_NAME', 'SALUTATION', 'STATE', 'COUNTRY', 'ADDRESS', 'PROFESSION', 'MARITAL_STATUS', 'FATHER_NAME', 'MOTHER_NAME', 'RELIGION', 'LANGUAGE']);

				foreach ($list as $values) {
					$connection->createCommand('insert into group_detail (group_id,customer_id)values(' . $group->group_id . ',' . $values['customer_id'] . ')')->query();

					$customer = Customer::findOne(['customer_id' => $values['customer_id']]);
					fputcsv($csvFile, [$customer->mobile, $customer->emailid, $customer->pincode, $customer->workplace, $customer->emailid, $customer->cty, $customer->emailid, $customer->aniversary_date, $customer->dob, $customer->customer_name, $customer->sex, $customer->first_name, $customer->last_name, $customer->salutation, $customer->state, $customer->country, $customer->address, $customer->profession, $customer->marital_status, $customer->father_name, $customer->mother_name, $customer->religion, $customer->language]);
				}
				fclose($csvFile);
				$this->serviceUitl->sendNetCoreData('list', 'DataUpload', "<LID>$netcoreId</LID><Operation>Add</Operation><Path>http://www.onengage.in/onengage/contact_uploads/$csvName</Path><NotifyEmail>souvik_hazra@outlook.com</NotifyEmail><TaskPriority>2</TaskPriority><CallbackUrl>http://www.onengage.in</CallbackUrl>", false);
				$status = array('status' => 'Success', 'msg' => 'Successfully Group Created', 'GroupId' => $group->group_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function CreateCustomGroupByCustomerIdHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$group = new PromotionGroup();

			$group->group_name = $input['GroupName'];
			$group->brand_id = $input['BrandId'];
			$customerarr = $input['CustomerId'];


			if ($group->save()) {
				foreach ($customerarr as $values) {
					$customergroup = new GroupDetail();
					$customergroup->customer_id = $values;
					$customergroup->group_id = $group->group_id;
					$customergroup->save();
				}
				$status = array('status' => 'Success', 'msg' => 'Successfully Group Created', 'GroupId' => $group->group_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function AddCustomerToGroupHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$groupdetail = new GroupDetail();

			$groupdetail->group_id = $input['GroupId'];
			$groupdetail->customer_id = $input['CustomerId'];

			if ($groupdetail->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Added to group');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function RemoveCustomerFromGroupHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$groupdetail = GroupDetail::findOne(['group_id' => $input['GroupId'], 'customer_id' => $input['CustomerId']]);
			$groupdetail->delete();
			$status = array('status' => 'Success', 'msg' => 'Successfully Removed from group');

			$group = PromotionGroup::findOne(['group_id' => $input['GroupId']]);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);

			file_get_contents("http://api.netcoresmartech.com/apiv2?type=contact&activity=delete&apikey=6b8c0b49cdbbfcce6b65fb4522c9831f&data={$customer->mobile}&listid={$group->smarttech_id}");

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetGroupCustomerListHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$group = PromotionGroup::find()->joinWith('groupDetails')->where(['promotion_group.group_id' => $input['GroupId'], 'group_detail.status' => 1])->all();
			foreach ($group as $values) {
				foreach ($values->groupDetails as $detailvalue) {
					$status[] = array('CustomerId' => $detailvalue->customer_id, 'CustomerName' => $detailvalue->customer->customer_name, 'CustomerPhone' => $detailvalue->customer->mobile, 'CustomerEmail' => $detailvalue->customer->emailid);
				}
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetGroupListByBrandHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$group = PromotionGroup::find()->where(['brand_id' => $input['BrandId'], 'active' => 1])->all();
			foreach ($group as $values) {
				$status[] = array('GroupName' => $values->group_name, 'GroupId' => $values->group_id);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function CreateCustomerGroupByVisitCountHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			// netcore API call
			$netcoreOut = $this->serviceUitl->sendNetCoreData('list', 'Add', "<Name>{$input['GroupName']}</Name><Description>{$input['GroupName']} </Description><Active>1</Active>");
			$netcoreId = $netcoreOut->OUTPUT->LID;
			// -------------------

			$group = new PromotionGroup();
			$group->group_name = $input['GroupName'];
			$group->brand_id = $input['BrandId'];
			$group->smarttech_id = $netcoreId;
			if ($group->save()) {

				$queryParams = array();
				$whereQuery = '';
				if (!empty($input['Sex'])) {
					$whereQuery .= ' and c.sex = :sex';
					$queryParams['sex'] = $input['Sex'];
				}
				if (!empty($input['PinCode'])) {
					$whereQuery .= ' and c.pincode = :pincode';
					$queryParams['pincode'] = $input['PinCode'];
				}
				if (!empty($input['Cty'])) {
					$whereQuery .= ' and c.cty = :cty';
					$queryParams['cty'] = $input['cty'];
				}
				if (!empty($input['State'])) {
					$whereQuery .= ' and c.state = :state';
					$queryParams['state'] = $input['State'];
				}
				if (!empty($input['Country'])) {
					$whereQuery .= ' and c.country = :country';
					$queryParams['country'] = $input['Country'];
				}
				if (!empty($input['Workplace'])) {
					$whereQuery .= ' and c.workplace = :workplace';
					$queryParams['workplace'] = $input['Workplace'];
				}
				if (!empty($input['Profession'])) {
					$whereQuery .= ' and c.profession = :profession';
					$queryParams['profession'] = $input['Profession'];
				}
				if (!empty($input['MaritalStatus'])) {
					$whereQuery .= ' and c.marital_status = :marital_status';
					$queryParams['marital_status'] = $input['MaritalStatus'];
				}
				if (!empty($input['Religion'])) {
					$whereQuery .= ' and c.religion = :religion';
					$queryParams['religion'] = $input['Religion'];
				}
				if (!empty($input['Language'])) {
					$whereQuery .= ' and c.language = :language';
					$queryParams['language'] = $input['Language'];
				}

				$connection = \Yii::$app->db;
				$qb = $connection
				->createCommand('select count(*) as cnt,cov.customer_id as customer_id from customer_outlet_visit as cov, customer as c where c.opted = :opted and cov.customer_id = c.customer_id and cov.brand_id=:brand and cov.visiting_date >=:mindate and cov.visiting_date <=:maxdate group by customer_id' . $whereQuery)
				->bindValue('brand', $input['BrandId'])
				->bindValue('mindate', $input['FromDate'])
				->bindValue('maxdate', $input['ToDate'])
				->bindValue('opted', 'OptedIn');

				foreach ($queryParams as $param => $value) {
					$qb->bindValue($param, $value);
				}

				$list = $qb->queryAll();

				$csvName = md5(uniqid($group->group_id)) . '.csv';
				$csvFile = fopen('contact_uploads/' . $csvName, 'w');
				fputcsv($csvFile, ['MOBILE', 'EMAIL', 'PIN', 'OFFICE_ADDRESS', 'EMAIL_ID', 'CITY', 'E_MAIL', 'ANNIVERSARY', 'DOB', 'NAME', 'SEX', 'FIRST_NAME', 'LAST_NAME', 'SALUTATION', 'STATE', 'COUNTRY', 'ADDRESS', 'PROFESSION', 'MARITAL_STATUS', 'FATHER_NAME', 'MOTHER_NAME', 'RELIGION', 'LANGUAGE']);

				foreach ($list as $values) {
					if ($values['cnt'] >= $input['VisitCountMin']) {
						$connection->createCommand('insert into group_detail (group_id,customer_id)values(' . $group->group_id . ',' . $values['customer_id'] . ')')->query();

						$customer = Customer::findOne(['customer_id' => $values['customer_id']]);
						fputcsv($csvFile, [$customer->mobile, $customer->emailid, $customer->pincode, $customer->workplace, $customer->emailid, $customer->cty, $customer->emailid, $customer->aniversary_date, $customer->dob, $customer->customer_name, $customer->sex, $customer->first_name, $customer->last_name, $customer->salutation, $customer->state, $customer->country, $customer->address, $customer->profession, $customer->marital_status, $customer->father_name, $customer->mother_name, $customer->religion, $customer->language]);
					}
				}
				fclose($csvFile);
				$this->serviceUitl->sendNetCoreData('list', 'DataUpload', "<LID>$netcoreId</LID><Operation>Add</Operation><Path>http://www.onengage.in/onengage/contact_uploads/$csvName</Path><NotifyEmail>souvik_hazra@outlook.com</NotifyEmail><TaskPriority>2</TaskPriority><CallbackUrl>http://www.onengage.in</CallbackUrl>", false);
				$status = array('status' => 'Success', 'msg' => 'Successfully Created', 'GroupId' => $group->group_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Saved');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function CreateCustomerGroupByPurchaseAmountHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			// netcore API call
			$netcoreOut = $this->serviceUitl->sendNetCoreData('list', 'Add', "<Name>{$input['GroupName']}</Name><Description>{$input['GroupName']} </Description><Active>1</Active>");
			$netcoreId = $netcoreOut->OUTPUT->LID;
			// -------------------

			$group = new PromotionGroup();
			$group->group_name = $input['GroupName'];
			$group->brand_id = $input['BrandId'];
			$group->smarttech_id = $netcoreId;
			if ($group->save()) {
				$queryParams = array();
				$whereQuery = '';
				if (!empty($input['Sex'])) {
					$whereQuery .= ' and c.sex = :sex';
					$queryParams['sex'] = $input['Sex'];
				}
				if (!empty($input['PinCode'])) {
					$whereQuery .= ' and c.pincode = :pincode';
					$queryParams['pincode'] = $input['PinCode'];
				}
				if (!empty($input['Cty'])) {
					$whereQuery .= ' and c.cty = :cty';
					$queryParams['cty'] = $input['cty'];
				}
				if (!empty($input['State'])) {
					$whereQuery .= ' and c.state = :state';
					$queryParams['state'] = $input['State'];
				}
				if (!empty($input['Country'])) {
					$whereQuery .= ' and c.country = :country';
					$queryParams['country'] = $input['Country'];
				}
				if (!empty($input['Workplace'])) {
					$whereQuery .= ' and c.workplace = :workplace';
					$queryParams['workplace'] = $input['Workplace'];
				}
				if (!empty($input['Profession'])) {
					$whereQuery .= ' and c.profession = :profession';
					$queryParams['profession'] = $input['Profession'];
				}
				if (!empty($input['MaritalStatus'])) {
					$whereQuery .= ' and c.marital_status = :marital_status';
					$queryParams['marital_status'] = $input['MaritalStatus'];
				}
				if (!empty($input['Religion'])) {
					$whereQuery .= ' and c.religion = :religion';
					$queryParams['religion'] = $input['Religion'];
				}
				if (!empty($input['Language'])) {
					$whereQuery .= ' and c.language = :language';
					$queryParams['language'] = $input['Language'];
				}
				$connection = \Yii::$app->db;
				$qb = $connection
				->createCommand('select count(*) as cnt,sum(cov.purchase_amount) as totamt,cov.customer_id as customer_id from customer_outlet_visit as cov, customer as c where c.opted = :opted and cov.customer_id = c.customer_id and cov.brand_id=:brand and cov.visiting_date >=:mindate and cov.visiting_date <=:maxdate group by customer_id' . $whereQuery)
				->bindValue('brand', $input['BrandId'])
				->bindValue('mindate', $input['FromDate'])
				->bindValue('maxdate', $input['ToDate'])
				->bindValue('opted', 'OptedIn');

				foreach ($queryParams as $param => $value) {
					$qb->bindValue($param, $value);
				}

				$list = $qb->queryAll();

				$csvName = md5(uniqid($group->group_id)) . '.csv';
				$csvFile = fopen('contact_uploads/' . $csvName, 'w');
				fputcsv($csvFile, ['MOBILE', 'EMAIL', 'PIN', 'OFFICE_ADDRESS', 'EMAIL_ID', 'CITY', 'E_MAIL', 'ANNIVERSARY', 'DOB', 'NAME', 'SEX', 'FIRST_NAME', 'LAST_NAME', 'SALUTATION', 'STATE', 'COUNTRY', 'ADDRESS', 'PROFESSION', 'MARITAL_STATUS', 'FATHER_NAME', 'MOTHER_NAME', 'RELIGION', 'LANGUAGE']);

				foreach ($list as $values) {
					if ($values['totamt'] >= $input['PurchaseAmountMin']) {
						$connection->createCommand('insert into group_detail (group_id,customer_id)values(' . $group->group_id . ',' . $values['customer_id'] . ')')->query();

						$customer = Customer::findOne(['customer_id' => $values['customer_id']]);
						fputcsv($csvFile, [$customer->mobile, $customer->emailid, $customer->pincode, $customer->workplace, $customer->emailid, $customer->cty, $customer->emailid, $customer->aniversary_date, $customer->dob, $customer->customer_name, $customer->sex, $customer->first_name, $customer->last_name, $customer->salutation, $customer->state, $customer->country, $customer->address, $customer->profession, $customer->marital_status, $customer->father_name, $customer->mother_name, $customer->religion, $customer->language]);
					}
				}
				fclose($csvFile);
				$this->serviceUitl->sendNetCoreData('list', 'DataUpload', "<LID>$netcoreId</LID><Operation>Add</Operation><Path>http://www.onengage.in/onengage/contact_uploads/$csvName</Path><NotifyEmail>souvik_hazra@outlook.com</NotifyEmail><TaskPriority>2</TaskPriority><CallbackUrl>http://www.onengage.in</CallbackUrl>", false);
				$status = array('status' => 'Success', 'msg' => 'Successfully Created', 'GroupId' => $group->group_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not saved');
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function CreateCampaignByBrandHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			$campaign = new Campaign();
			$campaign->campaign_name = $input['CampaignName'];
			$campaign->template_body = $input['TemplateBody'];
			$campaign->brand_id = $input['BrandId'];
			$campaign->group_id = $input['GroupId'];
			if ($campaign->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Campaign Created', 'CampaignId' => $campaign->campaign_id);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Exception Occured InSave');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetTemplateBodyByIdHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$templateid = $input['TemplateId'];

			$template = Template::findOne($templateid);
			$status = array('status' => 'Success', 'TemplateBody' => $template->template_body);

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetRawTemplateListHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$templates = Template::find()->where(['template_type' => $input['Type']])->all();
			foreach ($templates as $value) {
				if ($value->brand_id != 0 && $input['BrandId'] != $value->brand_id) {
					continue;
				}
				$status[] = array('TemplateId' => $value->template_id, 'TemplateName' => $value->template_name);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetTemplateListByBrandHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$brandid = $input['BrandId'];

			$templates = Campaign::find()->where(['brand_id' => $brandid])->all();
			foreach ($templates as $value) {
				$status[] = array('CampaignName' => $value->campaign_name, 'CampaignDescription' => $value->campaign_description, 'TemplateBody' => $value->template_body);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function ScheduleCampaignHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$CampaignId = $input['CampaignId'];

			$campaign = Campaign::findOne(['campaign_id' => $CampaignId]);
			$campaign->start_date = $input['StartTime'];

			if ($campaign->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Secheduled');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'not saved');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCampaignListByBrandHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$campaign = Campaign::find()->filterWhere(['brand_id' => $input['BrandId']])->all();

			foreach ($campaign as $value) {
				$status[] = array('CampaignId' => $value->campaign_id, 'CampaignName' => $value->campaign_name/*, 'CampaignDescription' => $value->campaign_description, 'StartDate' => $value->start_date, 'EndDate' => $value->end_date, 'Status' => $value->status*/);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCampaignDetailsHelper($inputJSON)
	{
		$status = array();
		$customerarr = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$campaoin = Campaign::find()->joinWith('groupDetail')->where(['campaign_id' => $input['CampaignId']])->all();

			foreach ($campaoin as $values) {
				foreach ($values->groupDetail->groupDetailsCustomer as $groupDetailCustomer) {
					$customerarr[] = array('CustomerId' => $groupDetailCustomer->customer->customer_id, 'CustomerName' => $groupDetailCustomer->customer->customer_name, 'SentStatus' => null, 'SentTime' => null, 'CustomerPhone' => $groupDetailCustomer->customer->mobile, 'CustomerEmail' => $groupDetailCustomer->customer->emailid);
				}
				$status[] = array('CampaignName' => $values->campaign_name, 'GroupName' => $values->groupDetail->group_name, 'CampaignStatus' => $values->status, 'CampaignBody' => $values->template_body, 'Customers' => $customerarr);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function ListBrandHelper($inputJSON)
	{
		$status = array();
		$outlets = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$brands = Brand::find()->joinWith('outlets')->where(['merchant_id' => $input['MerchantId']])->all();
			foreach ($brands as $values) {
				foreach ($values->outlets as $outletvalues) {
					$outlets[] = array('OutletId' => $outletvalues->outlet_id, 'OutletName' => $outletvalues->outlet_name, 'Address' => $outletvalues->outlet_address, 'Email' => $outletvalues->email, 'Mobile' => $outletvalues->phone, 'Contactperson' => $outletvalues->contactperson);
				}
				$status[] = array('BrandName' => $values->brand_name, 'EmailId' => $values->email, 'Mobile' => $values->phone, 'Address' => $values->address, 'ContactPersonName' => $values->contactperson, 'Outlets' => $outlets);

			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCurrentSubscriptionByBrandHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$subscription = SubscriptionPurchase::find()->joinWith('subscriptionPackage')->where(['brand_id' => $input['BrandId'], 'service_status' => 1])->orderBy(['subscription_purchase_id' => SORT_DESC])->one();

			$expDate = \DateTime::createFromFormat('Y-m-d', $subscription->exp_date);

			$today = new \DateTime();

			if ($expDate < $today) {
				return ['SubscriptionName'=>'No Subscription', 'SubscriptionId'=>0];
			}

			$subscriptionData = BrandSubscriptionStatus::find()->where(['brand_id' => $input['BrandId']])->all();
			$subscriptionDataArr = array();
			foreach ($subscriptionData as $datum) {
				$subscriptionDataArr['d' . $datum['subscription_component_id']] = $datum['quantity'];
			}
			$status = array('SubscriptionId' => $subscription->subscription_purchase_id, 'PackageId' => $subscription->subscription_package_id,
				'SubscriptionName' => $subscription->subscriptionPackage->subscription_package_name, 'ExpDate' => $subscription->exp_date,
				'BuyingDate' => $subscription->buying_date, 'RemainingEmail' => $subscriptionDataArr['d1'], 'RemainingSMS' => $subscriptionDataArr['d2'], 'RemainingAdvertisement' => $subscriptionDataArr['d3']);

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCouponsByBrandHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$coupons = Coupon::find()->where(['active' => 1, 'brand_id' => $input['BrandId']])->all();
			foreach ($coupons as $values) {
				$status[] = array('CouponId' => $values->coupon_id, 'CouponName' => $values->coupon_name, 'CouponDescription' => $values->coupon_description, 'CouponCode' => $values->coupon_code);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetOutletDetailByOutletIdHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$outlet = Outlet::findOne(['outlet_id' => $input['OutletId']]);

			$status = array('OutletId' => $outlet->outlet_id, 'BrandId' => $outlet->brand_id, 'OutletName' => $outlet->outlet_name, 'Address' => $outlet->outlet_address, 'Email' => $outlet->email, 'Phone' => $outlet->phone, 'ContactPerson' => $outlet->contactperson,'CityName' => $outlet->city,'StateName' => $outlet->state,'Lattitude' => $outlet->lattitude,'Longitude' => $outlet->longitude);

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCustomerDetailsByIdHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$value = Customer::findOne(['customer_id' => $input['CustomerId']]);
			$status = array('CustomerName' => $value->customer_name,
				'FirstName' => $value->first_name,
				'LastName' => $value->last_name,
				'EmailId' => $value->emailid,
				'Mobile' => $value->mobile,
				'Dob' => $value->dob,
				'AniversaryDate' => $value->aniversary_date,
				'Sex' => $value->sex,
				'OptStatus' => $value->opted,
				'Salutation' => $value->salutation,
				'PinCode' => $value->pincode,
				'Cty' => $value->cty,
				'State' => $value->state,
				'Country' => $value->country,
				'Workplace' => $value->workplace,
				'Profession' => $value->profession,
				'MaritalStatus' => $value->marital_status,
				'FatherName' => $value->father_name,
				'MotherName' => $value->mother_name,
				'Religion' => $value->religion,
				'LandLineNumber' => $value->land_line_number,
				'Language' => $value->language,
				'RegistrationDate' => $value->created_date,
				'CustomerId' => $value->customer_id);


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function ChangeCustomerOPTStatusHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$value = Customer::findOne(['customer_id' => $input['CustomerId']]);
			if ($input['Opt']) {
				$value->opted = 'OptedIn';
			} else {
				$value->opted = 'OptedOut';
			}
			if ($value->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Updated');
			} else {
				$status = array('status' => 'fail', 'msg' => 'Not Updated');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function sendOnlyOTPtoCustomerHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			$this->serviceUitl->sentOTP($customer->first_name, $customer->mobile, $customer->customer_id);
			$status = array('msg' => 'OTP Sent');
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCustomerOutletsHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$customeroutlet = CustomerOutlet::find()->joinWith('outlet')->where(['customer_id' => $input['CustomerId']])->all();
			foreach ($customeroutlet as $value) {
				$status[] = array('OutletName' => $value->outlet->outlet_name, 'Address' => $value->outlet->outlet_address, 'Email' => $value->outlet->email, 'Mobile' => $value->outlet->phone, 'ContactPerson' => $value->outlet->contactperson, 'BrandId' => $value->outlet->brand_id);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	public function GetCustomerPurchaseHistoryHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$data = array();
			$customeroutlet = CustomerOutletVisit::find()->joinWith('outlet')->filterWhere(['customer_id' => $input['CustomerId'], 'outlet_id' => $input['OutletId']])->orderBy(['visiting_date' => 'DESC'])->all();
			foreach ($customeroutlet as $value) {
				$pDate = $this->serviceUitl->formatDateForUI($value->visiting_date);
				if (!isset($data[$pDate])) {
					$data[$pDate] = array();
				}
				$data[$pDate][] = array('OutletName' => $value->outlet->outlet_name, 'Address' => $value->outlet->outlet_address, 'Email' => $value->outlet->email, 'Mobile' => $value->outlet->phone, 'ContactPerson' => $value->outlet->contactperson, 'BrandId' => $value->outlet->brand_id, 'Amount' => $value->purchase_amount, 'OutletId' => $value->outlet_id);
			}
			foreach ($data as $key => $value) {
				$status[] = ['PurchaseDate' => $key, 'PurchaseData' => $value];
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}


	function registerMarchantHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$marchant = new Merchant();
			$marchant->merchant_name = $input['merchantName'];
			$marchant->contact_person_name = $input['contactPersonName'];
			$marchant->email = $input['email'];
			$marchant->mobile = $input['mobile'];
			$marchant->dept_designation = $input['deptDesignation'];
			$marchant->merchant_address = $input['merchantAddress'];
			$marchant->nature_of_business = $input['natureOfBusiness'];
			$marchant->outlet_no = 0;
			$marchant->password = md5($input['password']);
			if ($marchant->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Registger');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Registger');
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	function marchantLoginHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$email = $input['email'];
			$password = $input['password'];
			$marchant = '';
			$marchant = Merchant::find()->where('email = :email', [':email' => $email])->one();
			if (isset($marchant)) {
				if ($marchant->password == md5($password)) {
					$token = base64_encode($marchant->email . '-' . $marchant->merchant_id . '-' . date('Y-m-d-h-m-s'));
					$marchant->login_token = $token;
					$marchant->save();
					$stores = $this->serviceUitl->getStoreNoByToken($token);
					$status = array('status' => 'Success', 'msg' => 'Successfully Login, Please collect the login token', 'token' => $token, 'merchantId' => $marchant->merchant_id, 'stores' => $stores);
				} else {
					$status = array('status' => 'Fail', 'msg' => 'Invalid Credential, Password');
				}
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Invalid Credential, Email');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function customerList($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$customers = Customer::find(['merchant_id' => $input['merchantId']])->with('store')->all();
			//$customers=Customer::findAll(['merchant_id'=>$input['merchantId']]);

			foreach ($customers as $values) {
				$status[] = array('customerId' => $values->customer_id, 'customerName' => $values->customer_name, 'emailId' => $values->emailid, 'mobileNo' => $values->mobile, 'dateOfBirth' => $values->dob, 'anniversaryDate' => $values->aniversary_date, 'sex' => $values->sex, 'storeId' => $values->store_id, 'storeName' => $values->store->store_name);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function customerListDateRange($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$customers = Customer::find()->with('store')->where(['between', 'created_date', $input['startDate'] . ' 00:00:00', $input['endDate'] . ' 22:00:00'])
			->andWhere(['merchant_id' => $input['merchantId']])->all();

			foreach ($customers as $values) {
				$status[] = array('customerId' => $values->customer_id, 'customerName' => $values->customer_name, 'emailId' => $values->emailid, 'mobileNo' => $values->mobile, 'dateOfBirth' => $values->dob, 'anniversaryDate' => $values->aniversary_date, 'sex' => $values->sex, 'createdDate' => $values->created_date, 'storeId' => $values->store_id, 'storeName' => $values->store->store_name);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function addStore($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$store = new Store();
			$store->merchant_id = $this->serviceUitl->getMerchantIdByToken($input['token']);
			$store->store_name = $input['storeName'];
			$store->store_address = $input['storeAddress'];
			if ($store->save()) {
				$status = array('status' => 'Success', 'msg' => 'Successfully Addes');
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Saved');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function storeList($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);

			$merchant_id = $this->serviceUitl->getMerchantIdByToken($input['token']);
			$store = Store::find(['merchant_id' => $merchant_id])->all();
			foreach ($store as $values) {
				$status[] = array('storeName' => $values->store_name, 'storeAddress' => $values->store_address);
			}


		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function copyCustomer($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$merchant_id = $this->serviceUitl->getMerchantIdByToken($input['token']);
			$storeId = $input['storeId'];

			$previousCustomer = Customer::findOne(['mobile' => $input['mobile']]);
			$customer = new Customer();
			$customer->merchant_id = $merchant_id;
			$customer->store_id = $storeId;
			$customer->customer_name = $previousCustomer['customer_name'];
			$customer->emailid = $previousCustomer['emailid'];
			$customer->mobile = $input['mobile'];
			$customer->aniversary_date = $previousCustomer['aniversary_date'];
			$customer->dob = $previousCustomer['dob'];
			$customer->sex = $previousCustomer['sex'];
			if ($customer->save()) {

				$status = array('status' => 'Success', 'msg' => 'Customer copied', 'customerId' => $customer->customer_id, 'customerNmae' => $previousCustomer['customer_name'],
					'emailid' => $previousCustomer['emailid'], 'mobile' => $input['mobile'], 'aniversaryDate' => $previousCustomer['aniversary_date'],
					'dob' => $previousCustomer['dob'], 'sex' => $previousCustomer['sex']);
			} else {
				$status = array('status' => 'Fail', 'msg' => 'Not Copied');
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function GetOutletSalesAccountsHelper($inputJSON)
	{
		$status = array();
		try {

			$input = json_decode($inputJSON, TRUE);

			$appUsers = Appuser::findAll(['ref_id' => $input['OutletId'], 'user_type' => 'outlet', 'active' => 1]);
			foreach ($appUsers as $appUser) {
				$status[] = array('AppuserId' => $appUser->appuser_id, 'Name' => $appUser->name, 'Email' => $appUser->email, 'Mobile' => $appUser->mobile, 'Username' => $appUser->username);
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => 'Exception Occurred');
		}
		return $status;
	}

	function AddOutletSalesAccountHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			if ($input['AppuserId'] == -1) {
				$appUser = Appuser::find()->where(['username' => $input['Username']])->count();
				if ($appUser > 0) {
					$status = array('status' => 'Fail', 'msg' => 'Email already exists');
				} else {
					$appUser = new Appuser();
					$appUser->user_type = 'outlet';
					$appUser->ref_id = $input['OutletId'];
					$appUser->username = $input['Username'];
					$appUser->password = $input['Password'];
					$appUser->name = $input['Name'];
					$appUser->email = $input['Email'];
					$appUser->mobile = $input['Phone'];
					$appUser->active = 1;
					if ($appUser->save()) {
						$status = array('status' => 'Success', 'AppuserId' => $appUser->appuser_id);
					} else {
						$status = array('status' => 'fail');
					}
				}
			} else {
				$appUser = Appuser::find()->where(['username' => $input['Username']])->count();
				$appUser->password = $input['Password'];
				$appUser->name = $input['Name'];
				$appUser->email = $input['Email'];
				$appUser->mobile = $input['Phone'];
				$appUser->active = 1;

				if ($appUser->save()) {
					$status = array('status' => 'Success', 'AppuserId' => $appUser->appuser_id);
				} else {
					$status = array('status' => 'fail');
				}
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}
		return $status;
	}

	function DeleteOutletSalesAccountHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			$appUser = Appuser::findOne(['appuser_id' => $input['AppuserId']]);
			$appUser->active = 0;
			$appUser->save();

			$status = ['status' => 'Success'];

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => 'Exception Occurred');
		}
		return $status;
	}

	function RechargeSMSEmailHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			$brand = Brand::findOne(['brand_id' => $input['BrandId']]);
			if ($brand) {
				$bss = BrandSubscriptionStatus::findAll(['brand_id' => $brand->brand_id]);
				if ($bss) {
					foreach ($bss as $bs) {
						if ($bs->subscription_component_id == 1) {
							$bs->quantity += $input['EmailCount'];
							$bs->save();
						} elseif ($bs->subscription_component_id == 2) {
							$bs->quantity += $input['SMSCount'];
							$bs->save();
						}
					}
				}
			}

			$status = ['status' => 'Success'];

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => 'Exception Occurred');
		}
		return $status;
	}

	function DeleteCustomerGroupHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);

			$group = PromotionGroup::findOne(['group_id' => $input['GroupId']]);

			// netcore API call
			$this->serviceUitl->sendNetCoreData('list', 'Delete', "<LID>{$group->smarttech_id}</LID>", false);
			// -------------------

			if ($group) {
				$group->active = 0;
				$group->save();
			}

			$status = ['status' => 'Success'];

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => 'Exception Occurred');
		}
		return $status;
	}

	function PutCustomerAddonDataHelper($inputJSON)
	{
		try {
			$input = json_decode($inputJSON, TRUE);
			$customer = Customer::findOne(['customer_id' => $input['CustomerId']]);
			if ($customer) {
				$customer->dob = $input['Dob'];
				$customer->aniversary_date = $input['AniversaryDate'];
				$customer->sex = $input['Sex'];
				$customer->pincode = $input['PinCode'];
				$customer->cty = $input['Cty'];
				$customer->state = $input['State'];
				$customer->country = $input['Country'];
				$customer->workplace = $input['Workplace'];
				$customer->profession = $input['Profession'];
				$customer->marital_status = $input['MaritalStatus'];
				$customer->father_name = $input['FatherName'];
				$customer->mother_name = $input['MotherName'];
				$customer->religion = $input['Religion'];
				$customer->land_line_number = $input['LandLineNumber'];
				$customer->language = $input['Language'];

				$csvName = md5($customer->customer_id) . '.csv';
				$csvFile = fopen('contact_uploads/' . $csvName, 'w');
				fputcsv($csvFile, ['MOBILE', 'EMAIL', 'PIN', 'OFFICE_ADDRESS', 'EMAIL_ID', 'CITY', 'E_MAIL', 'ANNIVERSARY', 'DOB', 'NAME', 'SEX', 'FIRST_NAME', 'LAST_NAME', 'SALUTATION', 'STATE', 'COUNTRY', 'ADDRESS', 'PROFESSION', 'MARITAL_STATUS', 'FATHER_NAME', 'MOTHER_NAME', 'RELIGION', 'LANGUAGE']);

				fputcsv($csvFile, [$customer->mobile, $customer->emailid, $customer->pincode, $customer->workplace, $customer->emailid, $customer->cty, $customer->emailid, $customer->aniversary_date, $customer->dob, $customer->customer_name, $customer->sex, $customer->first_name, $customer->last_name, $customer->salutation, $customer->state, $customer->country, $customer->address, $customer->profession, $customer->marital_status, $customer->father_name, $customer->mother_name, $customer->religion, $customer->language]);
				fclose($csvFile);

				$this->serviceUitl->sendNetCoreData('list', 'DataUpload', "<LID>67</LID><Operation>Add</Operation><Path>http://www.onengage.in/onengage/contact_uploads/$csvName</Path><NotifyEmail>souvik_hazra@outlook.com</NotifyEmail><TaskPriority>2</TaskPriority><CallbackUrl>http://www.onengage.in</CallbackUrl>", false);

				$appUser = Appuser::find()->where(['appuser_id'=>$input['UserId']]);
				$brand = brand::find()->where(['brand_id'=>$this->serviceUitl->getBrandIdFromOutletId($appuser->ref_id)])->one();
				$this->serviceUitl->sendNetCoreData('list', 'DataUpload', "<LID>{$brand->smarttech_id}</LID><Operation>Add</Operation><Path>http://www.onengage.in/onengage/contact_uploads/$csvName</Path><NotifyEmail>souvik_hazra@outlook.com</NotifyEmail><TaskPriority>2</TaskPriority><CallbackUrl>http://www.onengage.in</CallbackUrl>", false);

				if ($customer->save()) {
					$status = array('status' => 'Success', 'msg' => 'Successfully Registger', 'CustomerId' => $customer->customer_id, 'Phone' => $customer->mobile, 'Email' => $customer->emailid, 'CustomerName' => $customer->customer_name);
				} else {
					$status = array('status' => 'Fail');
				}
			} else {
				$status = ['status' => 'Fail'];
			}

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	function GetSalesAppLabelsHelper($inputJSON)
	{
		$status = array();
		try {

			$salesAppLabels = SalesAppLabel::findAll(['active' => 1]);

			foreach ($salesAppLabels as $salesAppLabel) {
				$status[] = ['LabelName' => $salesAppLabel->label_name, 'LabelId' => $salesAppLabel->label_id, 'IsOTP' => (mb_stripos($salesAppLabel->label_name, 'OTP') !== false) ? true : false];
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	function ExecuteSalesAppLabelByIdHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$this->serviceUitl->sendSalesLabelSMS($input['LabelId'], $input['CustomerId'], $input['UserId'], $input['OutletId'], $this->serviceUitl->getBrandIdFromOutletId($input['OutletId']));
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}

	function StartCampaign($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$campName = $input['CampaignName'];
			$custGroup = $input['CustomerGroup'];
			$campType = $input['CampaignType'];
			$template = $input['Template'];
			$promoCodes = $input['Promo'];
			$campTime = \DateTime::createFromFormat('Y-m-d H:i', str_replace('T', ' ', str_replace(":00Z", "", $input["StartTime"])));
			$brandId = $input['BrandId'];

			$today = (new \DateTime())->format("Y-m-d");

			$addCount = BrandSubscriptionStatus::findOne(['subscription_component_id'=>3, 'brand_id'=>$brandId]);
			if ($campType == 1) {
				$connection = \Yii::$app->db;
				$qb = $connection
				->createCommand('select advertisement_url from advertisement where startdate<=:today and enddate>=:today and stopped=:stopped and active=:active')
				->bindValue('today', $today)
				->bindValue('stopped', 0)
				->bindValue('active', 1);

				$emailCount = BrandSubscriptionStatus::findOne(['subscription_component_id'=>1, 'brand_id'=>$brandId]);
				$userCount = GroupDetail::find()->where(['group_id'=>$custGroup])->count();

				if ($emailCount->quantity < $userCount) {
					$status = array('status' => 'Success', 'error'=>true);
				}

				$emailCount->quantity -= $userCount;
				$emailCount->save();

				$list = $qb->queryAll();
				if (sizeof($list) > 0 && $addCount->quantity > 0) {
					$add = $list[0];
					$template = str_replace("[ADVERTISEMENT]", "http://www.onengage.in/onengage/advertisement/" . $add['advertisement_url'], $template);
					$addCount->quantity -= $userCount;
					if ($addCount->quantity < 0) {
						$addCount->quantity = 0;
					}
					$addCount->save();
				} else {
					$template = str_replace("<img style=\"width: 100%\" src=\"[ADVERTISEMENT]\"/>", "", $template);
				}
				$netcoreOut = $this->serviceUitl->sendNetCoreData("message", "Add", "<Subject>$campName</Subject><FromName>Onengage</FromName><FromEmail>info@onengage.in</FromEmail><DYNAMIC>0</DYNAMIC><ReplyTo>info@isvir2017conf.com</ReplyTo><TemplateID></TemplateID><SetLimit></SetLimit><Tag></Tag><MessageHTML><![CDATA[" . str_replace("\r\n", "", $template) . "]]></MessageHTML><MessageMobile><![CDATA[]]></MessageMobile>");
				$camId = $netcoreOut->OUTPUT->MID;

				$group = PromotionGroup::findOne(['group_id' => $custGroup]);
				$this->serviceUitl->sendNetCoreData("message", "Schedule", "<MID>$camId</MID> <DeliveryYear>{$campTime->format('Y')}</DeliveryYear> <DeliveryMonth>{$campTime->format('m')}</DeliveryMonth> <DeliveryDate>{$campTime->format('d')}</DeliveryDate> <DeliveryHour>{$campTime->format('H')}</DeliveryHour> <DeliveryMinute>{$campTime->format('i')}</DeliveryMinute> <LID>{$group->smarttech_id}</LID> ");
			}

			if (sizeof($promoCodes) > 0) {
				$groupCust = GroupDetail::findAll(['group_id' => $custGroup]);
				foreach ($promoCodes as $promoCode) {
					$promoCode = Coupon::findOne(['coupon_id' => $promoCode, 'brand_id' => $brandId]);
					if ($promoCode) {
						foreach ($groupCust as $cust) {
							$cc = new CustomerCoupon();
							$cc->brand_id = $brandId;
							$cc->outlet_id = 1;
							$cc->coupon_id = $promoCode->coupon_id;
							$cc->customer_id = $cust->customer_id;
							$cc->coupon_code = $promoCode->coupon_code;
							$cc->save();
						}
					}
				}
			}

			$camp = new Campaign();
			$camp->group_id = $custGroup;
			$camp->brand_id = $brandId;
			$camp->smarttech_id = $camId;
			$camp->campaign_type = $campType;
			$camp->campaign_name = $campName;
			$camp->template_body = $template;
			$camp->save();

			$status = array('status' => 'Success', 'error'=>false);

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}
	
	function CityListHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$cityLists = Outlet::find()->select('city')->where(['brand_id' => $input['BrandId']])->distinct()->all();

			foreach ($cityLists as $cityList) {
				$status[] = ['CityName' => $cityList->city];
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}
	
	function OutletListByCityHelper($inputJSON)
	{
		$status = array();
		try {

			$input = json_decode($inputJSON, TRUE);
	//	$cityoutlets = Outlet::find()->where(['brand_id' => $input['BrandId'], 'city' => $input['City']])->all();
			$brandid = $input['BrandId'];
			$city = $input['City'];
			$cityoutlets = Outlet::find()->where(['brand_id' => $brandid, 'city' =>$city])->all();
			foreach ($cityoutlets as $value) {
				$status[] = array('OutletName' => $value->outlet_name, 'Address' => $value->outlet_address, 'OutletId' => $value->outlet_id, 'Image'=>Url::home(true).'uploads/outlet/'.(($value->filename != '')?$value->filename:'default.png'));
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}
	
	function RechargeComponentHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$rechargecomp = Recharge::findAll(['active' => 1]);

			foreach ($rechargecomp as $recharge) {
				$status[] = array('Count' => $recharge->recharge, 'SmsPrice' => $recharge->sms_price, 'EmailPrice' => $recharge->email_price, 'RechargeId' => $recharge->recharge_id);
			}
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}
	
	function RechargeSmsPriceHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$smscount = $input['SmsCount'];
			$smsprice = Recharge::findOne(['active' => 1, 'recharge' => $smscount]);
			
			$status = array('SmsPrice' => $smsprice->sms_price, 'RechargeId' => $smsprice->recharge_id);

		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}
	
	function RechargeEmailPriceHelper($inputJSON)
	{
		$status = array();
		try {
			$input = json_decode($inputJSON, TRUE);
			$emailcount = $input['EmailCount'];
			$emailprice = Recharge::findOne(['active' => 1, 'recharge' => $emailcount]);
			
			$status = array('EmailPrice' => $emailprice->email_price, 'RechargeId' => $emailprice->recharge_id);
			
		} catch (\Exception $ex) {
			$status = array('status' => 'Fail', 'msg' => $ex->getMessage());
		}

		return $status;
	}


    function GetBrandImageHelper($inputJSON)
    {

        $status = array();
        try {

            $input = json_decode($inputJSON, TRUE);
            $brandid = $input['BrandId'];
            $cityoutlets = Brand::find()->where(['brand_id' => $brandid])->one();

            $status = array('Image' => Url::home(true) . 'uploads/brandpic/' . $value->filename);

        } catch (\Exception $ex) {
            $status = array('status' => 'Fail', 'msg' => $ex->getMessage());
        }

        return $status;
    }

    function PutBrandImageHelper($inputJSON)
    {
        try {

            $input = json_decode($inputJSON, TRUE);
            $strarr=explode(",", $input['filename']);
            // $len=sizeof($strarr);
            $filename = $strarr[1];
            $modelfile = base64_decode($filename);

            //$file = 'test/'. rand(). '.png';
            $imageName = rand().".png";
            $filesave = Yii::getAlias('@webroot') . '/uploads/brandpic/'.$imageName;
            $imageSave = file_put_contents($filesave, $modelfile);

            $brand = Brand::findOne(['brand_id' => $input['BrandId']]);
            if ($brand) {
                $brand->filename=$imageName;

                $brand->save();
                if ($brand->save()) {
                    $status = array('status' => 'Success', 'msg' => 'Successfully Updated');
                } else {
                    $status = array('status' => 'Failure', 'msg' => $brand->getErrors());
                }
            } else {
                $status = ['status' => 'Fail'];
            }

        } catch (\Exception $ex) {
            $status = array('status' => 'Fail', 'msg' => $ex->getMessage());
        }

        return $status;
    }

   /* function PutBrandImageHelper($inputJSON)
    {
        try {
            $imgmodel = new UploadForm();
            $input = json_decode($inputJSON, TRUE);
            $strarr=explode(",", $file);
            // $len=sizeof($strarr);
            $filename = $strarr[1];
            $modelfile = base64_decode($filename);

            $brand = Brand::findOne(['brand_id' => $input['BrandId']]);
            if ($brand) {
                $uploadedfile = UploadedFile::getInstancesByName('filename');
                if($uploadedfile){
                    $brand->filename->saveAs(Url::home(true) . 'uploads/brandpic/'.$brand->filename->baseName.'.'.$brand->filename->extension);
                    $brand->filename=$modelfile;
                }
                $brand->save();
                if ($brand->save()) {
                    $status = array('status' => 'Success', 'msg' => 'Successfully Updated');
                } else {
                    $status = array('status' => 'Failure');
                }
            } else {
                $status = ['status' => 'Fail'];
            }

        } catch (\Exception $ex) {
            $status = array('status' => 'Fail', 'msg' => $ex->getMessage());
        }

        return $status;
    }*/
}