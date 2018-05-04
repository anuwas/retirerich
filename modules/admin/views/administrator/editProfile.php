<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Administrator */
/* @var $form yii\widgets\ActiveForm */
$session = Yii::$app->session;
?>
<div class="container-fluid">
    <div class="block-header">
       <!-- <h2>USERS</h2>
        <br>-->
        <ol class="breadcrumb breadcrumb-bg-white breadcrumb-col-deep-purple">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Users</a></li>
        </ol>
    </div>

                        <?php
                        if($msg!='') {
	                        echo "<div class='alert alert-danger' style='text-align: center;'><strong>" . $msg . "!</strong></div>";

                        }?>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit User
                    </h2>

                </div>
                <div class="body">
	                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Name" name="Administrator[name]" id="administrator-name" required  pattern="[A-Za-z ]+" title="Only Text Allow" value="<?php echo $model->name;?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Email</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control" placeholder="Enter Email" name="Administrator[email]" id="administrator-email" value="<?php echo $model->email;?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="role">Role</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select id="administrator-role" class="form-control selecttwo chosen-select show-tick" name="Administrator[role]" class="form-control" required>
                                        <option value="">--Select--</option>
                                        <option value="Sub Admin" <?php if( $model->role == 'Sub Admin')?> selected>Sub Admin</option>
                                        <option value="Booking Agent" <?php if( $model->role == 'Booking Agent')?>>Booking Agent</option>
                                        <option value="Invoice Agent" <?php if( $model->role == 'Invoice Agent')?>>Invoice Agent</option>
                                        <option value="Commission Agent" <?php if( $model->role == 'Commission Agent')?>>Commission Agent</option>
                                        <option value="Data Entry" <?php if( $model->role == 'Data Entry')?>>Data Entry</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Old Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Enter New Password" name="Administrator[password]" id="administrator-password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">New Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Enter New Password" name="Administrator[newpassword]" id="administrator-newpassword"  value="" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Confirm Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="Administrator[confirmpassword]" id="administrator-confirmpassword"  value="" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Status</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">

                            <div class="form-group">
	                            <?php if($model->active =='1') { ?>
           <input name="Administrator[active]" id="radio_10" class="with-gap radio-col-deep-purple" type="radio" value="1" checked>
	                            <?php } else { ?>
           <input name="Administrator[active]" id="radio_10" class="with-gap radio-col-deep-purple" type="radio" value="1">
	                            <?php } ?>
                                <label for="radio_10">ACTIVE</label>

	                            <?php if($model->active =='0') { ?>
           <input name="Administrator[active]" id="radio_11" class="with-gap radio-col-deep-purple" type="radio" value="0" checked>
	                            <?php } else { ?>
           <input name="Administrator[active]" id="radio_11" class="with-gap radio-col-deep-purple" type="radio" value="0">
	                            <?php } ?>
                                <label for="radio_11">INACTIVE</label>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <!-- <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>-->
                            <input name="submit" id="submit" value="Submit" type="submit" class="btn bg-deep-purple waves-effect">
                            <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/administrator/list" class="btn btn-white waves-effect">Cancel</a>
                        </div>
                    </div>
	                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
</div>