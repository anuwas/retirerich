<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductCategory;
use app\models\ProductCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * ProductCategoryController implements the CRUD actions for ProductCategory model.
 */
class ProductCategoryController extends Controller
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
     * Lists all ProductCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductCategory model.
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
     * Creates a new ProductCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductCategory model.
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
     * Deletes an existing ProductCategory model.
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
     * Finds the ProductCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProductCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	public function actionList(){
		$this->view->title = 'CRM - Service List';
		$this->layout = 'admin';

		$model=ProductCategory::find()->where(['active' => 1])->orderBy('id DESC')->all();
		return $this->render('list', ['model' => $model ]);
	}

	public function actionNewproductcategory()
	{
		$this->view->title = 'CRM - Add Service';
		$this->layout = 'admin';

		$model = new ProductCategory();
		$imgmodel = new UploadForm();

		if ($model->load(Yii::$app->request->post())) {
			$uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
			if($uploadedfile){

				$imgmodel->imageFile=$uploadedfile;
				$filename=$imgmodel->productcategoryUpload();
				$model->filename=$filename;
			}

			if($model->save()) {
				$session = new Session();
				$session->open();
				$session['Add'] = 'Add';
				return $this->redirect(Yii::$app->request->baseUrl . '/admin/product-category/list');
			}
			else{
				$session = new Session();
				$session->open();
				$session['False'] = 'False';
				return $this->redirect(Yii::$app->request->baseUrl . '/admin/product-category/list');
			}
		} else {
			return $this->render('newproductcategory', ['model' => $model]);
		}
	}

	public function actionUpdateproductcategory($id){
		$this->view->title = 'CRM - Update Service';
		$this->layout = 'admin';

		$imgmodel = new UploadForm();
		$model = $this->findModel($id);

		if($model->load(Yii::$app->request->post())){
			$uploadedfile = UploadedFile::getInstance($imgmodel, 'resource');
			if($uploadedfile){

				$imgmodel->imageFile=$uploadedfile;
				$filename=$imgmodel->productcategoryUpload();
				$model->filename=$filename;
			}
			$model->save();

			$session = new Session();
			$session->open();
			$session['Update']='Update';
			return $this->redirect(Yii::$app->request->baseUrl.'/admin/product-category/list');
		}else{
			return $this->render('updateproductcategory',['model' => $model]);
		}
	}

	public function actionDeleteproductcategory($id)
	{
		// Appuser::findOne($id)->delete();
		$model = ProductCategory::findOne(['id' => $id]);
		$model->active = 0;
		$model->save();

		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl.'/admin/product-category/list');
	}

	public function actionBulkdelete()
	{
		$data = Yii::$app->request->post();
		$idArr = $data['checked_id'];
		foreach($idArr as $id){
			$model = ProductCategory::findOne(['id' => $id]);
			$model->delete();
		}
		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl . '/admin/product-category/list');
	}
}
