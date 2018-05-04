<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Administrator;
use app\models\AdministratorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * AdministratorController implements the CRUD actions for Administrator model.
 */
class AdministratorController extends Controller
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

    /**
     * Lists all Administrator models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdministratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Administrator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Administrator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Administrator();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->administratorid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Administrator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->administratorid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Administrator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Administrator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Administrator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Administrator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLogin()
    {
    	$this->view->title = 'ADMIN - Login';
    	$this->layout = 'adminLogin';
    	$model = new Administrator();
    	
    	if ($model->load(Yii::$app->request->post())) {
    		$admin=Administrator::findOne(['email' => $model->email,'password' => $model->password,'active'=>'1']);
    		if($admin){
    			$session = new Session();
    			$session->open();
    			$session['administrator']=$admin;
    			
    			return $this->redirect(['/admin']);
    		}else{
    			$msg='Invalid';
    			return $this->render('login', ['model' => $model,'msg'=>$msg]);
    		}
    		
    	} else {
		    $msg='';
    		return $this->render('login', ['model' => $model]);
    	}
    			
    	    	
    }
    
    public function actionLogout(){
    	$session = new Session();
    	$session->open();
    	$session['administrator']='';
    	return $this->redirect(['/admin/administrator/login']);
    }
    
    public function actionEditprofile($id){
    	$msg='';
    	$this->view->title = 'ADMIN - Profile';
    	$this->layout = 'admin';
    	$model = $this->findModel($id);
    	if ($model->load(Yii::$app->request->post()))
    	{
    		$data=Yii::$app->request->post();
    		
    		if($model->password!=$data['Administrator']['oldpassword']){
    			$msg='Password Incorrct';
    		}else if($data['Administrator']['newpassword']!=$data['Administrator']['confirmpassword'])
    		{
    			$msg='New Password and Confirm Password not same';
    		}else{
    			$model->password=$data['Administrator']['newpassword'];
    			$model->save();
    			echo $msg='Successfully Updated!';
    			
    		}
    		return $this->render('editProfile', ['model' => $model,'msg'=>$msg]);
    	}else{
    		return $this->render('editProfile', ['model' => $model,'msg'=>$msg]);
    	}
    	
    }

    public function actionList()
    {
        $this->view->title = 'ADMIN - Users';
        $this->layout = 'admin';

        $model = Administrator::find()->all();
        return $this->render('userlist',['model'=>$model]);
    }

    public function actionAdduser(){

        $this->view->title = 'ADMIN - Profile';
        $this->layout = 'admin';
        $model = new Administrator();
        if ($model->load(Yii::$app->request->post()))
        {
            $data=Yii::$app->request->post();


                $model->save();
            if($model->save()){
                $session = new Session();
                $session->open();
                $session['Add']='Add';
                return $this->redirect(Yii::$app->request->baseUrl.'/admin/administrator/list');
            }else{
                $session = new Session();
                $session->open();
                $session['False']='False';
                return $this->redirect(Yii::$app->request->baseUrl.'/admin/administrator/list');
            }


        }else{
            return $this->render('adduser',['model' => $model,]);
        }

    }

    public function actionDeleteuser($id)
    {

        $model = Administrator::findOne(['administratorid' => $id]);
        $model->active = 0;
        $model->save();

        $session = new Session();
        $session->open();
        $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl . '/admin/administrator/list');
    }

    public function actionBulkdelete()
    {
        $data = Yii::$app->request->post();
        $idArr = $data['checked_id'];
        foreach($idArr as $id){
            $model = Administrator::findOne(['administratorid' => $id]);
            $model->delete();
        }


        $session = new Session();
        $session->open();
        $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl . '/admin/administrator/list');
    }

    public function actionForgot()
    {
        $this->view->title = 'ADMIN - Forgot Password';
        $this->layout = 'adminLogin';
        $msg = "Type Your Email";

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $email = $data['email'];

            $check_email= Administrator::find()
                ->select(['email','administratorid'])
                ->where(['email' => $email])
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


            return $this->render('forgot_password', ['msg'=>$msg]);
        }

        return $this->render('forgot_password', ['msg'=>$msg]);


    }
    public function Mailsend($send_email,$id){
        $to = $send_email;

        $user_id = base64_encode($id);
        //$body = '<h1></h1>' ;
        $subject = "Password Reset link";
        // $link = Yii::$app->request->hostInfo.Yii::$app->request->baseUrl.
        $body = "<p><a target='_blank' href='http://baryon.in/hexatravel/admin/administrator/reset?id=".$user_id."'>Please resete your by clicking on the link</a></p>";

        $mail =    Yii::$app->mailer->compose()
            ->setFrom(['noreply@baryon.in' => 'Hexa Travel'])
            ->setSubject($subject)
            ->setHtmlBody($body);
        $mail->setTo($to)
            ->send();

    }
    public function actionReset($id)
    {
        $this->view->title = 'ADMIN - Reset Password';
        $this->layout = 'adminLogin';

        $user_id = base64_decode($id);

        $msg = '';
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $new_password = $data['new_password'];
            $confirm_password = $data['confirm_password'];
            if($new_password == $confirm_password ){
                $model = Administrator::findOne(['administratorid' => $user_id]);
                //var_dump($model);
                $model->password = $new_password;
                $model->save();
                $msg = true;
                return $this->redirect(['/admin/administrator/login']);
            }
            else{
                $msg = false;
                return $this->render('reset_password', ['msg'=>$msg]);
            }

        }
        return $this->render('reset_password', ['msg'=>$msg]);
    }
}
