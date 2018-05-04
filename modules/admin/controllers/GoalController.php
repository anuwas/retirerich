<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Goal;
use app\models\GoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
/**
 * GoalController implements the CRUD actions for Goal model.
 */
class GoalController extends Controller
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
     * Lists all Goal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goal model.
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
     * Creates a new Goal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goal model.
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
     * Deletes an existing Goal model.
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
     * Finds the Goal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	public function actionList(){
		$this->view->title = 'CRM - Customer Goal List';
		$this->layout = 'admin';

		$model=Goal::find()->where(['active' => 1])->orderBy('id DESC')->all();
		return $this->render('list', ['model' => $model ]);
	}

	public function actionDeletegoal($id)
	{
		// Appuser::findOne($id)->delete();
		$model = Goal::findOne(['id' => $id]);
		$model->active = 0;
		$model->save();

		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl.'/admin/goal/list');
	}

	public function actionBulkdelete()
	{
		$data = Yii::$app->request->post();
		$idArr = $data['checked_id'];
		foreach($idArr as $id){
			$model = Goal::findOne(['id' => $id]);
			$model->delete();
		}
		$session = new Session();
		$session->open();
		$session['Update']='Update';
		return $this->redirect(Yii::$app->request->baseUrl . '/admin/goal/list');
	}
}
