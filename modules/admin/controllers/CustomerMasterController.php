<?php

namespace app\modules\admin\controllers;

use Yii;

use app\models\CustomerMaster;
use app\models\CustomerMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\UploadForm;
use yii\web\UploadedFile;

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

    /**
     * Lists all Appuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Appuser model.
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
     * Creates a new Appuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Appuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Appuser model.
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
     * Finds the Appuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionList(){
    	$this->view->title = 'CRM - Customer List';
    	$this->layout = 'admin';
    
    	$model=CustomerMaster::find()->where(['active' => 1])->orderBy('id DESC')->all();
    	return $this->render('list', ['model' => $model ]);
    }

    public function actionNewappuser()
    {
        $this->view->title = 'CRM - Add Customer';
        $this->layout = 'admin';

        $model = new CustomerMaster();


        if ($model->load(Yii::$app->request->post())) {
	        if($model->save()) {
		        $session = new Session();
		        $session->open();
		        $session['Add'] = 'Add';
		        return $this->redirect(Yii::$app->request->baseUrl . '/admin/customer-master/list');
	        }
	        else{
		        $session = new Session();
		        $session->open();
		        $session['False'] = 'False';
		        return $this->redirect(Yii::$app->request->baseUrl . '/admin/customer-master/list');
	        }
        } else {
            return $this->render('newappuser', ['model' => $model]);
        }
    }

    public function actionUpdatecustomer($id){
        $this->view->title = 'CRM - Update Customer';
        $this->layout = 'admin';


        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model->save();

	        $session = new Session();
	        $session->open();
	        $session['Update']='Update';
            return $this->redirect(Yii::$app->request->baseUrl.'/admin/customer-master/list');
        }else{
            return $this->render('updatecustomer',['model' => $model]);
        }
    }
    
     public function actionDeletecustomer($id)
    {
       // Appuser::findOne($id)->delete();
        $model = CustomerMaster::findOne(['id' => $id]);
        $model->active = 0;
        $model->save();

	    $session = new Session();
	    $session->open();
	    $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl.'/admin/customer-master/list');
    }

	public function actionBulkdelete()
	{
		$data = Yii::$app->request->post();
		$idArr = $data['checked_id'];
		foreach($idArr as $id){
			$model = CustomerMaster::findOne(['id' => $id]);
			$model->delete();
		}
		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl . '/admin/customer-master/list');
	}

	//Import
	public function actionImportuser()
	{
		$this->view->title = 'CRM - Import User';
		$this->layout = 'admin';

		$model = new Appuser();
		$imgmodel = new UploadForm();

		if($model->load(Yii::$app->request->post())){

			$uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
			if($uploadedfile){

				$imgmodel->csv=$uploadedfile;
				$filename=$imgmodel->userexcelUpload();
				// $model->filename=$filename;
			}

			$objPHPExcel = new \PHPExcel();
			$fileName = Yii::getAlias('@webroot').'/uploads/user_excel/' . $filename;
			try {
				$inputFileType = \PHPExcel_IOFactory::identify($fileName);
				$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($fileName);
			} catch (Exception $ex) {
				die('Error');
			}

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			//$row is start 2 because first row assigned for heading.
			for ($row = 1; $row <= $highestRow; ++$row) {

				$model = new Appuser();

				$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
				// var_dump($rowData);die;

				//echo json_encode($rowData);
				//var_dump($rowData);
				if($row==1)
				{
					continue;
				}


				$model->username = $rowData[0][0];
				$model->password = $rowData[0][1].'';
				$model->emp_code = $rowData[0][2].'';
				$model->emp_dob = $rowData[0][3].'';
				$model->emp_anniversary = $rowData[0][4] .'';
				$model->name = $rowData[0][5].'';
				$model->email = $rowData[0][6] .'';
				$model->mobile = $rowData[0][7].'';

				$model->save();
				// print_r($model->getErrors());

			}
			//var_dump($model);die;
			// die('okay');
			return $this->redirect(Yii::$app->request->baseUrl.'/admin/customer-master/list');
		}else{
			return $this->render('importuser',['model' => $model,]);
		}
	}
}
