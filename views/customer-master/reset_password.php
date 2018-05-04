<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<!-- Page container -->
<div class="page-container">


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Simple login form -->
			<div class="col-md-6 col-xs-offset-3" style="margin-top: 70px;">

				<?php
				if(isset($msg)==false)
				{
					echo"<div class='alert alert-danger'>password and confirm password does not match!</div>";

				}
				?>
				<?php $form = ActiveForm::begin(); ?>
				<div class="panel panel-body login-form">
					<div class="text-center">
						<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
						<h5 class="content-group">Reset Your Password<small class="display-block"></small></h5>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input name="new_password" id="new_password" type="password" placeholder="PASSWORD"  class="form-control" />
						<div class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input name="confirm_password" id="confirm_password" type="password" placeholder="Confirm PASSWORD" class="form-control" />
						<div class="form-control-feedback">
							<i class="icon-lock2 text-muted"></i>
						</div>
					</div>

					<div class="form-group">

						<button type="submit" class="btn btn-primary btn-block">Submit <i class="icon-circle-right2 position-right"></i></button>
					</div>

				</div>
				<?php ActiveForm::end(); ?>
				<!-- /simple login form -->
			</div>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>