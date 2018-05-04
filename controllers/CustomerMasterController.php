<?php

namespace app\controllers;

use Yii;
use app\models\CustomerMaster;
use app\models\CustomerMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\ProductCategory;
use app\models\Goal;

/**
 * CustomerMasterController implements the CRUD actions for CustomerMaster model.
 */
class CustomerMasterController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function sessionValidate(){
        $session = Yii::$app->session;
        if(!isset($session['loggedUser']['id'])){
            return Yii::$app->getResponse()->redirect(array('customer-master/login',));
        }else if($session['loggedUser']['id']==''){
            return Yii::$app->getResponse()->redirect(array('customer-master/login',));
        }
        
    }


    protected function findModel($id)
    {
        if (($model = CustomerMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


	public function actionLogin()
	{
		$this->view->title = 'Login';
		$this->layout = 'userlogin';

		$model = new CustomerMaster();

		if ($model->load(Yii::$app->request->post())) {
			//var_dump($model->customer_email);die();

			$dbuser = CustomerMaster::findOne(['customer_email' => $model->customer_email]);
			//var_dump($dbuser->phone);die;
			if ($dbuser != '') {
				if ($model->password == $dbuser->password) {
					$session = new Session();
					$session->open();
					$session['loggedUser'] = $dbuser;
					return $this->redirect(Yii::$app->request->baseUrl.'/customer-master/goaldashboard');
				} else {

				}
				$session = new Session();
				$session->open();
				$session['Invalid'] = 'Invalid';
				return $this->render('login', ['model' => $model]);
			} else {
				$session = new Session();
				$session->open();
				$session['Invalid'] = 'Invalid';
				return $this->render('login', ['model' => $model]);
			}
		}
		else{

			return $this->render('login', ['model' => $model]);
		}
	}

	public function actionLogout(){
		$session = new Session();
		$session->open();
		$session['loggedUser']='';
		return $this->redirect(Yii::$app->request->baseUrl.'/customer-master/login');
	}

	public function actionGoaldashboard(){
		$this->view->title = 'Dashboard';
		$this->layout = 'index';
        $this->sessionValidate();
		$session = Yii::$app->session;
		$UID = $session['loggedUser']['id'];

		$goal_product = Goal::find()->where(['customer_id'=>$UID,'active'=> '1'])->all();
		$countusergoal=count($goal_product);
		$result = ArrayHelper::getColumn($goal_product,'pro_cat_id');

		 //$result1 = "'" . implode ( "', '", $result ) . "'";
		 //$present = implode(',', $result);

		$model=ProductCategory::find()->where(['not in','id',$result])->all();

		//$connection = \Yii::$app->db;
		//$qb = $connection->createCommand("SELECT * FROM `product_category`  WHERE `id` NOT IN  ($result1) AND active = '1'");
		//$list = $qb->queryAll();
		return $this->render('goaldashboard',['model' => $model, 'goal_product' =>$goal_product,'countusergoal' =>$countusergoal]); 
		
	}

	public function actionRegister(){
		$this->view->title = 'Register';
		$this->layout = 'userlogin';

		$model = new CustomerMaster();

		if ($model->load(Yii::$app->request->post())){
			$data=Yii::$app->request->post();
			$customerCheckEmail = CustomerMaster::find()->where(['customer_email'=>$data['CustomerMaster']['customer_email']])->one();
			if($customerCheckEmail != null){
				$session = new Session();
				$session->open();
				$session['Falseemail'] = 'Falseemail';
				return $this->redirect(Yii::$app->request->baseUrl.'/customer-master/register');
			}
			elseif ($data['CustomerMaster']['password']!=$data['CustomerMaster']['confirm_password']){
				$session = new Session();
				$session->open();
				$session['Falsepassword'] = 'Falsepassword';
				return $this->redirect(Yii::$app->request->baseUrl.'/customer-master/register');
			}
			else{

				$model->save();
				$session = new Session();
				$session->open();
				$session['loggedUser'] = $model;
			}
			return $this->redirect(Yii::$app->request->baseUrl.'/customer-master/goaldashboard');
		}

		return $this->render('register',['model' => $model]);
	}

	public function actionForgot()
	{
		$this->view->title = 'CRM - Forgot Password';
		$this->layout = 'userlogin';
		$msg = "Type Your Email";
		$model = new CustomerMaster();
		if (Yii::$app->request->isPost) {
			$data = Yii::$app->request->post();
			$email = $data['email'];

			$check_email= CustomerMaster::find()
			                           ->select(['customer_email','id'])
			                           ->where(['customer_email' => $email])
			                           ->one();


			//var_dump($check_email->email);die;
			if($check_email !=null){
				$send_email=$check_email->email;
				$id = $check_email->administratorid;
				$this->Mailsend($send_email,$id);
				$session = new Session();
				$session->open();
				$session['Sent'] = 'Sent';
				//$msg = true;
			}else{
				$session = new Session();
				$session->open();
				$session['failed'] = 'failed';
				$msg = false;
			}


			return $this->render('forgot_password', ['msg'=>$msg,'model' => $model]);
		}

		return $this->render('forgot_password', ['msg'=>$msg,'model' => $model]);


	}
	public function Mailsend($send_email,$id){
		$to = $send_email;

		$user_id = base64_encode($id);
		//$body = '<h1></h1>' ;
		$subject = "Password Reset link";
		// $link = Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.
		$body = "<p><a target='_blank' href='http://baryon.in/retirerich/admin/administrator/reset?id=".$user_id."'>Please resete your by clicking on the link</a></p>";

		$mail =    Yii::$app->mailer->compose()
		                            ->setFrom(['noreply@baryon.in' => 'Retire Rich'])
		                            ->setSubject($subject)
		                            ->setHtmlBody($body);
		$mail->setTo($to)
		     ->send();

	}
	public function actionReset($id)
	{
		$this->view->title = 'CRM - Reset Password';
		$this->layout = 'userlogin';

		$user_id = base64_decode($id);

		$msg = '';
		if (Yii::$app->request->isPost) {
			$data = Yii::$app->request->post();
			$new_password = $data['new_password'];
			$confirm_password = $data['confirm_password'];
			if($new_password == $confirm_password ){
				$model = CustomerMaster::findOne(['id' => $user_id]);
				//var_dump($model);
				$model->password = $new_password;
				$model->save();
				$msg = true;
				return $this->redirect(['/customer-master/login']);
			}
			else{
				$msg = false;
				return $this->render('reset_password', ['msg'=>$msg]);
			}

		}
		return $this->render('reset_password', ['msg'=>$msg]);
	}


	public function actionSetgoal()
	{
		$session = Yii::$app->session;
		$UID = $session['loggedUser']['id'];
		if (Yii::$app->request->isPost)
		{

			$date = date("Y-m-d");// current date

			$model = new Goal();
			$data = Yii::$app->request->post();
			$Month = $data['EndYear'];
			$model->customer_id=$UID;
			$model->pro_cat_id=$data['proCatID'];
			$model->goal_type=$data['GoalType'];
			$model->investment_amount=$data['InvestmentAmount'];
			$model->goal_amount=$data['GoalAmount'];
			$model->goal_period=$data['GoalPeriod'];
			$model->sip_amount=$data['SipAmount'];
			$model->lumsum_amount=$data['lumsumAmount'];
			$model->created_date = date('Y-m-d');
			$model->goal_start_date = date('Y-m-d');
			$model->investment_start_date = date('Y-m-d');
			$enddate = strtotime(date("Y-m-d", strtotime($date)) . " +".$Month." month");
			$model->goal_end_date = $enddate;
			$model->investment_end_date = $enddate;
			$model->created_by=$UID;
			$model->save();

		}
	}

}
