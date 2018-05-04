<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
?>


<style>
    [type="checkbox"]:checked.checkbox + label:before {
        border-right: 2px solid #673AB7;
        border-bottom: 2px solid #673AB7; }

</style>
<div class="container-fluid">
    <div class="block-header">
        <!-- <h2>USERS</h2>
	 <br>-->
        <ol class="breadcrumb breadcrumb-bg-white breadcrumb-col-deep-purple">
            <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Hotels</a></li>
        </ol>

    </div>


					<!-- start: page -->
<br>
        <?php
        $session = Yii::$app->session;
        if(isset($session['Update'])=='Update')
        {
        echo"<div class='alert alert-info' style='text-align: center;'><strong>Successfully Updated!</strong></div>";
        unset($session['Update']);
        }
        ?>
        <?php
        if(isset($session['Add'])=='Add')
        {
        echo"<div class='alert alert-success' style='text-align: center;'><strong>Successfully Addedd!</strong></div>";
        unset($session['Add']);
        }
        ?>
        <?php
        if(isset($session['False'])=='False')
        {
        echo"<div class='alert alert-danger' style='text-align: center;'><strong>Please try Again!</strong></div>";
        unset($session['False']);
        }
        ?>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Hotels
                    </h2>
                    <div style="float: right;">
                      <button class="btn bg-deep-purple waves-effect" id="bulk" style="margin-top: -43px;"><i class="material-icons">delete</i>Bulk Delete</button>
                        <a href="<?php echo Yii::getAlias('@web').'/uploads/'?>demo_csv/hotel_import_demo.csv" class="btn bg-deep-purple waves-effect" style="margin-top: -43px;">Sample<i class="material-icons">file_download</i></a>
                        <!--<a href="<?php /*echo Yii::$app->request->baseUrl; */?>/admin/hotel/export"
                           class="btn bg-deep-purple waves-effect" style="margin-top: -43px;">Export <i class="material-icons">file_download</i></a>
                        <a href="<?php /*echo Yii::$app->request->baseUrl; */?>/admin/hotel/importhotel" class="btn bg-deep-purple waves-effect" style="margin-top: -43px;"><i class="material-icons">file_upload</i> Import</a>-->
                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/hotel/newhotel" class="btn bg-deep-purple waves-effect" style="margin-top: -43px;"><i class="material-icons">add</i> ADD</a>

                    </div>
                </div>
                        <div class="body">
	                        <?php $form = ActiveForm::begin(['action' =>['hotel/bulkdelete'], 'id' => 'hotelbulkdelete', 'method' => 'post',],['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" name="select_all" id="select_all" class="filled-in chk-col-deep-purple" value=""/><label for="select_all"></label></th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead
                            <tbody>
                            <?php
                            $i=1;
                            foreach ($model as $value) {

                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i;?></td>
            <td align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $value->hotel_id; ?>"/><label for="md_checkbox_2<?php echo $i;?>"></label></td>
                                    <td><?php if(!empty($value->hotel_name)){echo $value->hotel_name;}else{ echo 'NA';}?></td>
                                    <td><?php if(!empty($value->countries)){echo $value->countries0->name;}else{echo 'NA';}?></td>
                                    <td><?php if($value->active =='1'){echo '<span class="label label-success">Active</span>';} else {echo '<span class="label label-danger">Inactive</span>';}?></td>

                                    <td>
                                        <?php if(!empty($value->filename)){?><a href="<?php echo Yii::getAlias('@web').'/uploads/'?>hotel/<?php echo $value->filename;?>" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-light waves-float" title="Download Pdf"><i class="material-icons">file_download</i></a> | <?php }?>
                                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/hotel/updatehotel?id=<?php echo $value->hotel_id;?>" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-light waves-float" title="Edit"><i class="material-icons">edit</i></a>
                                        &nbsp;|&nbsp;
                                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/hotel/deletehotel?id=<?php echo $value->hotel_id;?>" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-light waves-float" title="Delete" onClick="return confirm('Are you sure you want to delete?');"><i class="material-icons">delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
	                <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
                </div>
                <!-- #END# Exportable Table -->
            </div>

<script>
    $(document).ready(function(){

        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
        });

        $('#bulk').on('click',function(){
            var chks = document.getElementsByName('checked_id[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
                if (chks[i].checked)
                {
                    hasChecked = true;
                    break;
                }
            }
            if (hasChecked == false)
            {
                alert("Please select a Hotel.");
                return false;
            }
            return true;
        });
    });

</script>