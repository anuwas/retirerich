<?php

namespace app\controllers;

use yii\db\Query;
use app\models\Merchant;
use app\models\SubscriptionPackage;
use app\models\PromotionGroup;
use app\models\CustomerOutletVisit;
use app\models\Campaign;
use app\models\SubscriptionPurchase;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	
    	
    	/* $date=new \DateTime();
    	$dt=date('Y-m-d-h-m-s');
    	echo $dt;
    	echo base64_decode('Ymlzd2FzQGdtYWlsLmNvbS0xLTIwMTctMDMtMTEtMDQtMDMtNDk='); */
    	$status=array();
    	/* $leadsCount = Lead::find()
    	->select(['COUNT(*) AS cnt'])
    	->where('approved = 1')
    	->groupBy(['promoter_location_id', 'lead_type_id'])
    	->all(); */
    	
    	//$connection = \Yii::$app->db;
    	//$list= $connection->createCommand('select count(*) as cnt,sum(purchase_amount) as totamt,customer_id from onengage.customer_outlet_visit where brand_id=:brand group by customer_id')->bindValue('brand',1)->queryAll();
    	
    	$status=array();
    	//$curlstatus = file_get_contents('http://203.212.70.200/smpp/sendsms?username=onengageapp&password=onengageapp123&to=9007711694&from=ThankU&text=test');
    	
    	$url = 'http://203.212.70.200/smpp/sendsms';
    	
    	$fields = array(
    			'username'      => "onengageapp",
    			'password'      => "onengageapp123",
    			'to'    => "9007711694",
    			'from'      => "ThankU",
    			'text'      => "Hi anupam"
    	);
    	
    	//open connection
    	$ch = curl_init();
    	
    	//set the url, number of POST vars, POST data
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, count($fields));
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    	
    	//execute post
    	$result = curl_exec($ch);
    	
    	//close connection
    	curl_close($ch);
    	
    	var_dump($result);
    	$result = ob_get_clean();
    	echo $result;
    	 
    	//print_r($status);
    }

}
