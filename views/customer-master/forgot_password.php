<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $model app\models\CustomerMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

    .mycaptcha{position: relative;}
    .mycaptcha input{
        width: 70%;
        float: left;}

    .mybtn{position: absolute;
        right: 150px;
        top: 6px;}
</style>
<!-- Page container -->
<div class="page-container">


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Simple login form -->
			<div class="col-md-6 col-xs-offset-3" style="margin-top: 70px;">

				<?php

				if (isset($session['Sent']) == 'Sent') {
					echo "<div class='alert alert-success' style='text-align: center;'><strong>Mail Sent Successfully Please check your email!</strong></div>";
					unset($session['Sent']);
				}elseif(isset($session['failed']) == 'failed') {
					echo "<div class='alert alert-danger' style='text-align: center;'><strong>Mail not sent!</strong></div>";
					unset($session['failed']);
				}
				?>
				<?php $form = ActiveForm::begin(); ?>
				<div class="panel panel-body login-form">
					<div class="text-center">
						<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
						<h5 class="content-group">Type Your Email<small class="display-block"></small></h5>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input type="email" class="form-control" placeholder="Email" name="email" required>
						<div class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>
                    <div class="row mycaptcha">
                        <div class="col-md-9 clearfix">
							<?= $form->field($model, 'captcha')->widget(Captcha::className(),[
								'imageOptions' => [
									'id' => 'my-captcha-image'
								], 'options' => ['placeholder' => 'Enter verification code','class' => 'form-control',
								],
							])->label(false) ?>
                        </div>
                        <div class="mybtn">
                            <img id="refresh-captcha" src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/refresh.png">
							<?php /*echo Html::button('Refresh', ['id' => 'refresh-captcha']);*/?>
                        </div>
                    </div>
					<?php
					// click refresh button on page load
					$this->registerJs( 'refresh-captcha',
						'$(document).ready(function(){$("#refresh-captcha").click();});' );
					?>
					<?php $this->registerJs("
    $('#refresh-captcha').on('click', function(e){
        e.preventDefault();

        $('#my-captcha-image').yiiCaptcha('refresh');
    })
"); ?>


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

<script>

    window.onload = hello;

    function hello()
    {
        document.getElementById('refresh-captcha').click();
    }

</script>