<?php

namespace app\components;

use Yii;
use yii\base\Component;

class ServiceEndpointComponent extends Component
{
	public $serviceHelper;
	public $return;


	function __construct()
	{
		$this->serviceHelper = new ServicehelperComponent();
		$this->return = array();
	}

	public function Login($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.Login with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'Login')) {
			$this->return = $this->serviceHelper->LoginHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.Login. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));

	}

	public function registerCustomer($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.registerCustomer with Input parameter ' . $inputJSON, 'service');

		
if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->RegisterCustomerHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}


		print_r(json_encode($this->return));
	}

	public function CustomerOTP($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.registerCustomer with Input parameter ' . $inputJSON, 'service');

		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->CustomerOTPHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}


		print_r(json_encode($this->return));
	}

	/*public function SendOTP($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.SendOTP with Input parameter ' . $inputJSON, 'service');

		if (ServicevalidationComponent::checkUser($inputJSON, 'SendOTP')) {
			$this->return = $this->serviceHelper->SendOTPHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.SendOTP. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}


		print_r(json_encode($this->return));
	}*/

	public function GetCustomerByPhoneEmail($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.GetCustomerByPhoneEmail with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->GetCustomerByPhoneEmailHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.GetCustomerByPhoneEmail. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function EnrollCustomer($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.EnrollCustomer with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->EnrollCustomerHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function MatchOTP($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->MatchOTPHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function SkipOTP($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->SkipOTPHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RegisterBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RegisterOutlet with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RegisterBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RegisterOutlet($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RegisterOutlet with Input parameter ' . $inputJSON, 'service');
		//if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RegisterOutletHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		/*} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}*/
		print_r(json_encode($this->return));
	}

	public function RegisterUser($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RegisterUser with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RegisterUserHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCoupon($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.CreateCoupon with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->CreateCouponHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RemoveCoupon($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RemoveCoupon with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RemoveCouponHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RedeemCoupon($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RedeemCoupon with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RedeemCouponHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}


	public function PutUserPurchase($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.PutUserPurchase with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->PutUserPurchaseHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function ListOutlet($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListOutlet with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->ListOutletHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function ListCustomerByOutletId($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->ListCustomerByOutletIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCouponListByCustomer($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.GetCouponListByCustomer with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->GetCouponListByCustomerHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.GetCouponListByCustomer. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function GetSubscriptionList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.GetCouponListByCustomer with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->GetSubscriptionListHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.GetCouponListByCustomer. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function BuySubscription($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->BuySubscriptionHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function PaymentSuccess($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->PaymentSuccessHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCustomGroup($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->CreateCustomGroupHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCustomGroupByCustomerId($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->CreateCustomGroupByCustomerIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function AddCustomerToGroup($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->AddCustomerToGroupHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RemoveCustomerFromGroup($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RemoveCustomerFromGroupHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetGroupCustomerList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetGroupCustomerListHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetGroupListByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetGroupListByBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCustomerGroupByVisitCount($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->CreateCustomerGroupByVisitCountHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCustomerGroupByPurchaseAmount($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->CreateCustomerGroupByPurchaseAmountHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}
		print_r(json_encode($this->return));
	}

	public function CreateCampaignByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->CreateCampaignByBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetTemplateBodyById($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetTemplateBodyByIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetRawTemplateList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetRawTemplateListHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetTemplateListByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetTemplateListByBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function ScheduleCampaign($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->ScheduleCampaignHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCampaignListByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->GetCampaignListByBrandHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}

		print_r(json_encode($this->return));
	}

	public function GetCampaignDetails($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetCampaignDetailsHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function ListBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->ListBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCurrentSubscriptionByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetCurrentSubscriptionByBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCouponsByBrand($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetCouponsByBrandHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetOutletDetailByOutletId($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetOutletDetailByOutletIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCustomerDetailsById($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetCustomerDetailsByIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function ChangeCustomerOPTStatus($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->ChangeCustomerOPTStatusHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}

		print_r(json_encode($this->return));
	}

	public function sendOnlyOTPtoCustomer($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->sendOnlyOTPtoCustomerHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCustomerOutlets($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetCustomerOutletsHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetCustomerPurchaseHistory($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');

		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->GetCustomerPurchaseHistoryHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}

		print_r(json_encode($this->return));
	}


	public function registerMarchant($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.registerMarchant with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerMarchant')) {
			if (ServicevalidationComponent::checkUniqueEmailMarchent($inputJSON, 'registerMarchant')) {
				if (ServicevalidationComponent::checkUniquePhoneMarchent($inputJSON, 'registerMarchant')) {
					$this->return = $this->serviceHelper->registerMarchantHelper($inputJSON);
				} else {
					Yii::info('Inside ServiceEndpointComponent.registerMarchant. Duplicate Mobile found', 'service');
					$this->return = array('status' => 'Fail', 'msg' => 'Mobile Already Exist');
				}
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerMarchant. Duplicate email found', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Email Already Exist');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerMarchant. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	/*
	public function registerCustomer($inputJSON){
			Yii::info('Inside ServiceEndpointComponent.registerCustomer with Input parameter '.$inputJSON, 'service');
			if(ServicevalidationComponent::commonCheckParam($inputJSON,'registerCustomer')){
					if(ServicevalidationComponent::checkToken($inputJSON,'registerCustomer')){
							$this->return=$this->serviceHelper->registerCustomerHelper($inputJSON);
					}else{
							Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Token Missing Exception', 'service');
							$this->return=array('status'=>'Fail','msg'=>'Token Unauthorised or Missing');
					}

			}else{
					Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
					$this->return=array('status'=>'Fail','msg'=>'Input Parameter Missing');
			}
			print_r(json_encode($this->return));
	}
	*/
	public function marchantLogin($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.marchantLogin with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'marchantLogin')) {
			$this->return = $this->serviceHelper->marchantLoginHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function customerList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.customerList with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'customerList')) {
			if (ServicevalidationComponent::checkToken($inputJSON, 'customerList')) {
				$this->return = $this->serviceHelper->customerList($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.customerList. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.customerList. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function customerListDateRange($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.customerListDateRange with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'customerList')) {
			if (ServicevalidationComponent::checkToken($inputJSON, 'customerList')) {
				$this->return = $this->serviceHelper->customerListDateRange($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.customerListDateRange. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.customerListDateRange. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function addStore($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.addStore with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddStore')) {
			if (ServicevalidationComponent::checkOnlyToken($inputJSON, 'AddStore')) {
				$this->return = $this->serviceHelper->addStore($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.addStore. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.addStore. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function storeList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.storeList with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddStore')) {
			if (ServicevalidationComponent::checkOnlyToken($inputJSON, 'AddStore')) {
				$this->return = $this->serviceHelper->storeList($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.storeList. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.storeList. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function copyCustomer($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.copyCustomer with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddStore')) {
			if (ServicevalidationComponent::checkOnlyToken($inputJSON, 'AddStore')) {
				$this->return = $this->serviceHelper->copyCustomer($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.copyCustomer. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.copyCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function GetOutletSalesAccounts($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.GetOutletSalesAccounts with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'GetOutletSalesAccounts')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'GetOutletSalesAccounts')) {
				$this->return = $this->serviceHelper->GetOutletSalesAccountsHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.GetOutletSalesAccounts. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.GetOutletSalesAccounts. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function AddOutletSalesAccount($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.AddOutletSalesAccount with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddOutletSalesAccount')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'AddOutletSalesAccount')) {
				$this->return = $this->serviceHelper->AddOutletSalesAccountHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.AddOutletSalesAccount. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.AddOutletSalesAccount. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function DeleteOutletSalesAccount($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.DeleteOutletSalesAccount with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddOutletSalesAccount')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'AddOutletSalesAccount')) {
				$this->return = $this->serviceHelper->DeleteOutletSalesAccountHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.DeleteOutletSalesAccount. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.DeleteOutletSalesAccount. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function RechargeSMSEmail($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddOutletSalesAccount')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'AddOutletSalesAccount')) {
				$this->return = $this->serviceHelper->RechargeSMSEmailHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function DeleteCustomerGroup($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'AddOutletSalesAccount')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'AddOutletSalesAccount')) {
				$this->return = $this->serviceHelper->DeleteCustomerGroupHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail. Rendering Token Missing Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'Token Unauthorised or Missing');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.RechargeSMSEmail. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function PutCustomerAddonData($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.ListCustomerByOutletId with Input parameter ' . $inputJSON, 'service');

		if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
			$this->return = $this->serviceHelper->PutCustomerAddonDataHelper($inputJSON);
		} else {
			Yii::info('Inside ServiceEndpointComponent.RegisterOutlet. Rendering UserId Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
		}

		print_r(json_encode($this->return));
	}

	public function GetSalesAppLabels($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->GetSalesAppLabelsHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function ExecuteSalesAppLabelById($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->ExecuteSalesAppLabelByIdHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}

	public function StartCampaign($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->StartCampaign($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}
	
	public function CityList($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->CityListHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}
	
		public function OutletListByCity($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->OutletListByCityHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}
	
		public function RechargeComponent($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RechargeComponentHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}
	
		public function RechargeSmsPrice($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RechargeSmsPriceHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}
	
		public function RechargeEmailPrice($inputJSON)
	{
		Yii::info('Inside ServiceEndpointComponent.MatchOTP with Input parameter ' . $inputJSON, 'service');
		if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
			if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
				$this->return = $this->serviceHelper->RechargeEmailPriceHelper($inputJSON);
			} else {
				Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering UserId Exception', 'service');
				$this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
			}

		} else {
			Yii::info('Inside ServiceEndpointComponent.registerCustomer. Rendering Parameter Missing Exception', 'service');
			$this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
		}
		print_r(json_encode($this->return));
	}


    public function GetBrandImage($inputJSON)
    {
        Yii::info('Inside ServiceEndpointComponent.GetBrandImage with Input parameter ' . $inputJSON, 'service');
        if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
            if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
                $this->return = $this->serviceHelper->GetBrandImageHelper($inputJSON);
            } else {
                Yii::info('Inside ServiceEndpointComponent.GetBrandImage. Rendering UserId Exception', 'service');
                $this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
            }

        } else {
            Yii::info('Inside ServiceEndpointComponent.GetBrandImage. Rendering Parameter Missing Exception', 'service');
            $this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
        }
        print_r(json_encode($this->return));
    }

    public function PutBrandImage($inputJSON)
    {
        Yii::info('Inside ServiceEndpointComponent.PutBrandImage with Input parameter ' . $inputJSON, 'service');
        if (ServicevalidationComponent::commonCheckParam($inputJSON, 'registerCustomer')) {
            if (ServicevalidationComponent::checkUser($inputJSON, 'registerCustomer')) {
                $this->return = $this->serviceHelper->PutBrandImageHelper($inputJSON);
            } else {
                Yii::info('Inside ServiceEndpointComponent.PutBrandImage. Rendering UserId Exception', 'service');
                $this->return = array('status' => 'Fail', 'msg' => 'UserId not valid');
            }

        } else {
            Yii::info('Inside ServiceEndpointComponent.PutBrandImage. Rendering Parameter Missing Exception', 'service');
            $this->return = array('status' => 'Fail', 'msg' => 'Input Parameter Missing');
        }
        print_r(json_encode($this->return));
    }

}