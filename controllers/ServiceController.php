<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;

class ServiceController extends \yii\web\Controller
{
	public function behaviors()
	{
		return array_merge([
			'cors' => [
				'class' => Cors::className(),
				#special rules for particular action
				'actions' => [
					'index' => [
						#web-servers which you alllow cross-domain access
						'Origin' => ['*'],
						'Access-Control-Request-Method' => ['POST'],
						'Access-Control-Request-Headers' => ['*'],
						'Access-Control-Allow-Credentials' => null,
						'Access-Control-Max-Age' => 86400,
						'Access-Control-Expose-Headers' => [],
					],
					'call' => [
						#web-servers which you alllow cross-domain access
						'Origin' => ['*'],
						'Access-Control-Request-Method' => ['POST'],
						'Access-Control-Request-Headers' => ['*'],
						'Access-Control-Allow-Credentials' => null,
						'Access-Control-Max-Age' => 86400,
						'Access-Control-Expose-Headers' => [],
					],
				],
				#common rules
				'cors' => [
					'Origin' => [],
					'Access-Control-Request-Method' => [],
					'Access-Control-Request-Headers' => [],
					'Access-Control-Allow-Credentials' => null,
					'Access-Control-Max-Age' => 0,
					'Access-Control-Expose-Headers' => [],
				]
			],
		], parent::behaviors());
	}

	public function beforeAction($action)
	{

		if ($action->id == 'index') {
			$this->enableCsrfValidation = false;
		}

		return parent::beforeAction($action);
	}

	public function actionCall()
	{
		$input = array();
		Yii::$app->serviceendpointcomp->registerMarchant($input);
	}

	public function actionTest()
	{
		$marchant = Merchant::find()->where('emailid > :emailid', [':userid' => 'biswas@gmail.com'])->one();
	}

	public function actionIndex()
	{
		Yii::info('Inside ServiceController.actionCall', 'service');
		header('Content-type: application/json');
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, TRUE);

		switch ($input['action']) {
			case 'Login':
				Yii::$app->serviceendpointcomp->Login($inputJSON);
				break;
			case 'RegisterCustomer':
				Yii::$app->serviceendpointcomp->registerCustomer($inputJSON);
				break;
			case 'CustomerOTP':
				Yii::$app->serviceendpointcomp->CustomerOTP($inputJSON);
				break;
			case 'GetCustomerByPhoneEmail':
				Yii::$app->serviceendpointcomp->GetCustomerByPhoneEmail($inputJSON);
				break;
			case 'EnrollCustomer':
				Yii::$app->serviceendpointcomp->EnrollCustomer($inputJSON);
				break;
			case 'MatchOTP':
				Yii::$app->serviceendpointcomp->MatchOTP($inputJSON);
				break;
			case 'SkipOTP':
				Yii::$app->serviceendpointcomp->SkipOTP($inputJSON);
				break;
			case 'RegisterBrand':
				Yii::$app->serviceendpointcomp->RegisterBrand($inputJSON);
				break;
			case 'RegisterOutlet':
				Yii::$app->serviceendpointcomp->RegisterOutlet($inputJSON);
				break;
			case 'RegisterUser':
				Yii::$app->serviceendpointcomp->RegisterUser($inputJSON);
				break;
			case 'CreateCoupon':
				Yii::$app->serviceendpointcomp->CreateCoupon($inputJSON);
				break;
			case 'RemoveCoupon':
				Yii::$app->serviceendpointcomp->RemoveCoupon($inputJSON);
				break;
			case 'RedeemCoupon':
				Yii::$app->serviceendpointcomp->RedeemCoupon($inputJSON);
				break;
			case 'PutUserPurchase':
				Yii::$app->serviceendpointcomp->PutUserPurchase($inputJSON);
				break;
			case 'ListOutlet':
				Yii::$app->serviceendpointcomp->ListOutlet($inputJSON);
				break;
			case 'ListCustomerByOutletId':
				Yii::$app->serviceendpointcomp->ListCustomerByOutletId($inputJSON);
				break;
			case 'GetCouponListByCustomer':
				Yii::$app->serviceendpointcomp->GetCouponListByCustomer($inputJSON);
				break;
			case 'GetSubscriptionList':
				Yii::$app->serviceendpointcomp->GetSubscriptionList($inputJSON);
				break;
			case 'BuySubscription':
				Yii::$app->serviceendpointcomp->BuySubscription($inputJSON);
				break;
			case 'PaymentSuccess':
				Yii::$app->serviceendpointcomp->PaymentSuccess($inputJSON);
				break;
			case 'CreateCustomGroup':
				Yii::$app->serviceendpointcomp->CreateCustomGroup($inputJSON);
				break;
			case 'CreateCustomGroupByCustomerId':
				Yii::$app->serviceendpointcomp->CreateCustomGroupByCustomerId($inputJSON);
				break;
			case 'AddCustomerToGroup':
				Yii::$app->serviceendpointcomp->AddCustomerToGroup($inputJSON);
				break;
			case 'RemoveCustomerFromGroup':
				Yii::$app->serviceendpointcomp->RemoveCustomerFromGroup($inputJSON);
				break;
			case 'GetGroupCustomerList':
				Yii::$app->serviceendpointcomp->GetGroupCustomerList($inputJSON);
				break;
			case 'GetGroupListByBrand':
				Yii::$app->serviceendpointcomp->GetGroupListByBrand($inputJSON);
				break;
			case 'CreateCustomerGroupByVisitCount':
				Yii::$app->serviceendpointcomp->CreateCustomerGroupByVisitCount($inputJSON);
				break;
			case 'CreateCustomerGroupByPurchaseAmount':
				Yii::$app->serviceendpointcomp->CreateCustomerGroupByPurchaseAmount($inputJSON);
				break;
			case 'CreateCampaignByBrand':
				Yii::$app->serviceendpointcomp->CreateCampaignByBrand($inputJSON);
				break;
			case 'GetTemplateBodyById':
				Yii::$app->serviceendpointcomp->GetTemplateBodyById($inputJSON);
				break;
			case 'GetRawTemplateList':
				Yii::$app->serviceendpointcomp->GetRawTemplateList($inputJSON);
				break;
			case 'GetTemplateListByBrand':
				Yii::$app->serviceendpointcomp->GetTemplateListByBrand($inputJSON);
				break;
			case 'ScheduleCampaign':
				Yii::$app->serviceendpointcomp->ScheduleCampaign($inputJSON);
				break;
			case 'GetCampaignListByBrand':
				Yii::$app->serviceendpointcomp->GetCampaignListByBrand($inputJSON);
				break;
			case 'GetCampaignDetails':
				Yii::$app->serviceendpointcomp->GetCampaignDetails($inputJSON);
				break;
			case 'ListBrand':
				Yii::$app->serviceendpointcomp->ListBrand($inputJSON);
				break;
			case 'GetCurrentSubscriptionByBrand':
				Yii::$app->serviceendpointcomp->GetCurrentSubscriptionByBrand($inputJSON);
				break;
			case 'GetCouponsByBrand':
				Yii::$app->serviceendpointcomp->GetCouponsByBrand($inputJSON);
				break;
			case 'GetOutletDetailByOutletId':
				Yii::$app->serviceendpointcomp->GetOutletDetailByOutletId($inputJSON);
				break;
			case 'GetCustomerDetailsById':
				Yii::$app->serviceendpointcomp->GetCustomerDetailsById($inputJSON);
				break;
			case 'ChangeCustomerOPTStatus':
				Yii::$app->serviceendpointcomp->ChangeCustomerOPTStatus($inputJSON);
				break;
			case 'sendOnlyOTPtoCustomer':
				Yii::$app->serviceendpointcomp->sendOnlyOTPtoCustomer($inputJSON);
				break;
			case 'GetCustomerOutlets':
				Yii::$app->serviceendpointcomp->GetCustomerOutlets($inputJSON);
				break;
			case 'GetCustomerPurchaseHistory':
				Yii::$app->serviceendpointcomp->GetCustomerPurchaseHistory($inputJSON);
				break;
			case 'registerMerchant':
				Yii::$app->serviceendpointcomp->registerMarchant($inputJSON);
				break;
			case 'merchantLogin':
				Yii::$app->serviceendpointcomp->marchantLogin($inputJSON);
				break;
			case 'customerList':
				Yii::$app->serviceendpointcomp->customerList($inputJSON);
				break;
			case 'customerListDateRange':
				Yii::$app->serviceendpointcomp->customerListDateRange($inputJSON);
				break;
			case 'addStore':
				Yii::$app->serviceendpointcomp->addStore($inputJSON);
				break;
			case 'storeList':
				Yii::$app->serviceendpointcomp->storeList($inputJSON);
				break;
			case 'copyCustomer':
				Yii::$app->serviceendpointcomp->copyCustomer($inputJSON);
				break;
			case 'GetOutletSalesAccounts':
				Yii::$app->serviceendpointcomp->GetOutletSalesAccounts($inputJSON);
				break;
			case 'AddOutletSalesAccount':
				Yii::$app->serviceendpointcomp->AddOutletSalesAccount($inputJSON);
				break;
			case 'DeleteOutletSalesAccount':
				Yii::$app->serviceendpointcomp->DeleteOutletSalesAccount($inputJSON);
				break;
			case 'RechargeSMSEmail':
				Yii::$app->serviceendpointcomp->RechargeSMSEmail($inputJSON);
				break;
			/*case 'SendOTP':
				Yii::$app->serviceendpointcomp->SendOTP($inputJSON);
				break;*/
			case 'DeleteCustomerGroup':
				Yii::$app->serviceendpointcomp->DeleteCustomerGroup($inputJSON);
				break;
			case 'PutCustomerAddonData':
				Yii::$app->serviceendpointcomp->PutCustomerAddonData($inputJSON);
				break;
			case 'GetSalesAppLabels':
				Yii::$app->serviceendpointcomp->GetSalesAppLabels($inputJSON);
				break;
			case 'ExecuteSalesAppLabelById':
				Yii::$app->serviceendpointcomp->ExecuteSalesAppLabelById($inputJSON);
				break;
			case 'StartCampaign':
				Yii::$app->serviceendpointcomp->StartCampaign($inputJSON);
				break;
			case 'CityList':
				Yii::$app->serviceendpointcomp->CityList($inputJSON);
				break;
			case 'OutletListByCity':
				Yii::$app->serviceendpointcomp->OutletListByCity($inputJSON);
				break;
			case 'RechargeComponent':
				Yii::$app->serviceendpointcomp->RechargeComponent($inputJSON);
				break;
			case 'RechargeSmsPrice':
				Yii::$app->serviceendpointcomp->RechargeSmsPrice($inputJSON);
				break;
		    case 'RechargeEmailPrice':
				Yii::$app->serviceendpointcomp->RechargeEmailPrice($inputJSON);
				break;
            case 'BrandImage':
                Yii::$app->serviceendpointcomp->GetBrandImage($inputJSON);
                break;
			default:
				echo json_encode('Action Not Found');

		}

	}

}
