<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

use app\models\Administrator;


use yii\web\Session;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */


    public function actionIndex()
    {
        $this->view->title = 'RetireRich Admin - Dashboard';
        $this->layout = 'admin';


        $user = Administrator:: find()->where('name != :name', ['name'=> 'Administrator'])->all();
        $countuser =count($user);
        return $this->render('dashboard',['countuser' => $countuser]);
    }

    public function actionDashboard() {
	    $this->view->title = 'RetireRich Admin - Dashboard';
	    $this->layout      = 'admindefault';


	    $user      = Administrator:: find()->where( 'name != :name', [ 'name' => 'Administrator' ] )->all();
	    $countuser = count( $user );

	    return $this->render( 'dashboard', [ 'countuser' => $countuser ] );
    }
}
