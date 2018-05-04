<?php

namespace app\modules\admin\controllers;

use Yii;

use app\models\Appuser;
use app\models\AppuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * AppuserController implements the CRUD actions for Appuser model.
 */
class AppuserController extends Controller
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
        $searchModel = new AppuserSearch();
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
        $model = new Appuser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->appuser_id]);
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
            return $this->redirect(['view', 'id' => $model->appuser_id]);
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
     * @return Appuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Appuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionList(){
    	$this->view->title = 'CRM - User List';
    	$this->layout = 'admin';
    
    	$model=Appuser::find()->where(['active' => 1])->orderBy('appuser_id DESC')->all();
    	return $this->render('list', ['model' => $model ]);
    }

    public function actionNewappuser()
    {
        $this->view->title = 'CRM - Add User';
        $this->layout = 'admin';

        $model = new Appuser();


        if ($model->load(Yii::$app->request->post())) {
	        if($model->save()) {
		        $session = new Session();
		        $session->open();
		        $session['Add'] = 'Add';
		        return $this->redirect(Yii::$app->request->baseUrl . '/admin/appuser/list');
	        }
	        else{
		        $session = new Session();
		        $session->open();
		        $session['False'] = 'False';
		        return $this->redirect(Yii::$app->request->baseUrl . '/admin/appuser/list');
	        }
        } else {
            return $this->render('newappuser', ['model' => $model]);
        }
    }

    public function actionUpdateappuser($id){
        $this->view->title = 'CRM - Update User';
        $this->layout = 'admin';



        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){
            $model->save();

	        $session = new Session();
	        $session->open();
	        $session['Update']='Update';
            return $this->redirect(Yii::$app->request->baseUrl.'/admin/appuser/list');
        }else{
            return $this->render('updateappuser',['model' => $model]);
        }
    }
    
     public function actionDeleteappuser($id)
    {
       // Appuser::findOne($id)->delete();
        $model = Appuser::findOne(['appuser_id' => $id]);
        $model->active = 0;
        $model->save();

	    $session = new Session();
	    $session->open();
	    $session['Update']='Update';
        return $this->redirect(Yii::$app->request->baseUrl.'/admin/appuser/list');
    }

	public function actionBulkdelete()
	{
		$data = Yii::$app->request->post();
		$idArr = $data['checked_id'];
		foreach($idArr as $id){
			$model = Appuser::findOne(['appuser_id' => $id]);
			$model->delete();
		}
		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl . '/admin/appuser/list');
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
			return $this->redirect(Yii::$app->request->baseUrl.'/admin/appuser/list');
		}else{
			return $this->render('importuser',['model' => $model,]);
		}
	}
}
