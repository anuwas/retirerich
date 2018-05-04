<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\SiteUser */
/* @var $form yii\widgets\ActiveForm */
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
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Import User
                    </h2>

                </div>
                <div class="body">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>

                    <div class="panel-body">

                        <input type="hidden" id="appuser-appuser_id" class="form-control" name="Appuser[appuser_id]">



                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name">Excel File</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="">
                                        <input type="file" name="UploadForm[resource]" id="uploadform-iresource">
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <!-- <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>-->
                            <input name="submit" id="submit" value="Submit" type="submit" class="btn bg-deep-purple waves-effect">
                            <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/appuser/list" class="btn btn-white waves-effect">Cancel</a>
                        </div>
                    </div>
	                <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- #END# Horizontal Layout -->
</div>

    <script type="text/javascript">
        $(function () {
            var myfile="";
            $('#uploadform-iresource').on( 'change', function() {
                myfile= $( this ).val();
                var ext = myfile.split('.').pop();
                if(ext=="xlsx" || ext=="xls"){
                    return true;
                } else{
                    alert("Please Upload Only .xls OR .xlsx File.");
                    $('#uploadform-iresource').val('');
                    return false;
                }
            });

        });

    </script>