<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Fund;
use app\models\FundSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * FundController implements the CRUD actions for Fund model.
 */
class FundController extends Controller
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
     * Lists all Fund models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fund model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fund model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fund();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fund model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fund model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Fund model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Fund the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fund::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	public function actionList(){
		$this->view->title = 'CRM - Fund List';
		$this->layout = 'admin';

		$model=Fund::find()->where(['active' => 1])->orderBy('id DESC')->all();
		return $this->render('list', ['model' => $model ]);
	}

	public function actionNewfund()
	{
		$this->view->title = 'CRM - Add Fund';
		$this->layout = 'admin';

		$model = new Fund();

		if ($model->load(Yii::$app->request->post())) {

			if($model->save()) {
				$session = new Session();
				$session->open();
				$session['Add'] = 'Add';
				return $this->redirect(Yii::$app->request->baseUrl . '/admin/fund/list');
			}
		} else {
			return $this->render('newfund', ['model' => $model]);
		}
	}

	public function actionUpdatefund($id){
		$this->view->title = 'CRM - Update Fund';
		$this->layout = 'admin';

		$imgmodel = new UploadForm();
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())){

			$model->save();

			$session = new Session();
			$session->open();
			$session['Update']='Update';
			return $this->redirect(Yii::$app->request->baseUrl.'/admin/fund/list');
		}else{
			return $this->render('updatefund',['model' => $model]);
		}
	}

	public function actionDeleteproductcategory($id)
	{
		// Appuser::findOne($id)->delete();
		$model = Fund::findOne(['id' => $id]);
		$model->active = 0;
		$model->save();

		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl.'/admin/fund/list');
	}

	public function actionBulkdelete()
	{
		$data = Yii::$app->request->post();
		$idArr = $data['checked_id'];
		foreach($idArr as $id){
			$model = Fund::findOne(['id' => $id]);
			$model->delete();
		}
		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl . '/admin/fund/list');
	}
}
