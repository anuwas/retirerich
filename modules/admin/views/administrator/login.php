<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

    .card {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .card:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
    </style>

<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><img src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/logo.png"  alt="Retire Rich" width="50%"></a>
        <!--<small>Welcome to HYATT</small>-->
    </div>
	<?php
	if(isset($msg)=='Invalid')
	{
		echo"<div class='alert alert-danger'>Please check your Email and Password!</div>";

	}
	?>
    <div class="card">
        <div class="body">
	            <?php $form = ActiveForm::begin(['options' => ['class' => 'm-t', 'id' => 'sign_in']]); ?>
                <div class="msg">RETIRE RICH</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input name="Administrator[email]" id="administrator-email" type="text" placeholder="EMAIL" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input name="Administrator[password]" id="administrator-password" type="password" placeholder="PASSWORD" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <!--<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>-->
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <!--<a href="sign-up.html">Register Now!</a>-->
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/administrator/forgot">Forgot Password?</a>
                    </div>
                </div>
	            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>