<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
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
	            $session = Yii::$app->session;
	            if(isset($session['Falseemail'])=='Falseemail')
	            {
		            echo"<div class='alert alert-danger' style='text-align: center;'>Email Already Used!</div>";
		            unset($session['Falseemail']);
	            }
	            ?>
	            <?php
	            if(isset($session['Falsepassword'])=='Falsepassword')
	            {
		            echo"<div class='alert alert-danger' style='text-align: center;'>Password and Confirm Password Not Matched!</div>";
		            unset($session['Falsepassword']);
	            }
	            ?>
				<?php $form = ActiveForm::begin(); ?>
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        <h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" class="form-control" placeholder="Name" name="CustomerMaster[customer_name]" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="email" class="form-control" placeholder="Email" name="CustomerMaster[customer_email]" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
	                    <?= $form->field($model, 'dob', ['template' => '<div class=\"\" style="margin-left: 15px; ">{input}</div>'])->widget(\yii\jui\DatePicker::classname(),[
		                    'language' => 'en', 'clientOptions' => [ 'dateFormat' => 'dd/mm/yy', 'changeMonth' => 'true','changeYear' => 'true', 'yearRange' =>'1950:2025', 'maxDate' => 'new Date()', ],
		                    'options' => ['class' => 'form-control', 'placeholder' => 'DD/MM/YYYY', 'readOnly'=>'readOnly'],
	                    ]) ?>
                        <div class="form-control-feedback">
                            <i class="icon-calender2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" class="form-control" placeholder="Password" name="CustomerMaster[password]" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="CustomerMaster[confirm_password]" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
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
	                /*	                // click refresh button on page load
										$this->registerJs( 'refresh-captcha',
											'$(document).ready(function(){$("#refresh-captcha").click();});' );
										*/?>
	                <?php $this->registerJs("
    $('#refresh-captcha').on('click', function(e){
        e.preventDefault();

        $('#my-captcha-image').yiiCaptcha('refresh');
    })
"); ?>

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary btn-block">Sign Up <i class="icon-circle-right2 position-right"></i></button>
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