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
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Funds</a></li>
        </ol>
    </div>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add Fund
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
                                    <input type="text" class="form-control" placeholder="Enter Name" name="Fund[name]" id="fund-name" required  pattern="[A-Za-z ]+" title="Only Text Allow">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">Time Limit</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Time Limit" name="Fund[year_limit]" id="fund-year_limit" required  pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="name">Amount Limit</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Amount Limit" name="Fund[amount_limit]" id="fund-amount_limit" required  pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
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
                                <input name="CustomerMaster[active]" id="radio_10" class="with-gap radio-col-deep-purple" type="radio" value="1" checked>
                                <label for="radio_10">ACTIVE</label>
                                <input name="CustomerMaster[active]" id="radio_11" class="with-gap radio-col-deep-purple" type="radio" value="0">
                                <label for="radio_11">INACTIVE</label>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <!-- <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
                            <input name="submit" value="Submit" type="submit" class="btn bg-deep-purple">-->
                            <button type="submit" class="btn bg-deep-purple">Submit</button>
                            <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/fund/list" class="btn btn-white waves-effect">Cancel</a>
                        </div>
                    </div>
	                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
</div>