<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
?>
<style>
    [type="checkbox"]:checked.checkbox + label:before {
        border-right: 2px solid #673AB7;
        border-bottom: 2px solid #673AB7; }

</style>

    <!-- start: page -->


    <div class="container-fluid">
        <div class="block-header">
            <!-- <h2>USERS</h2>
		 <br>-->
            <ol class="breadcrumb breadcrumb-bg-white breadcrumb-col-deep-purple">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Customer Goals</a></li>
            </ol>

            </div>

        <br>
	    <?php
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
	    if (isset($session['False']) == 'False') {
		    echo "<div class='alert alert-danger' style='text-align: center;'><strong>Please Try Again!</strong></div>";
		    unset($session['False']);
	    }
	    ?>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Customer Goals
                        </h2>
                       <!-- <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>-->
                        <div style="float: right;">
                        <button class="btn bg-deep-purple waves-effect" id="bulk" style="margin-top: -43px;"><i class="material-icons">delete</i> Bulk Delete</button>

                       <!-- <a href="<?php /*echo  Yii::$app->request->baseUrl;*/?>/admin/fund/newfund" class="btn bg-deep-purple waves-effect" style="margin-top: -43px;"><i class="material-icons">add</i> ADD</a>  -->              </div>
                    </div>
                    <div class="body">
	                    <?php $form = ActiveForm::begin(['action' =>['goal/bulkdelete'], 'id' => 'goalbulkdelete', 'method' => 'post',],['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
                        <div class="table-responsive">
                            <table class="table  table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th <input type="checkbox" name="select_all" class="filled-in chk-col-deep-purple" id="select_all" value=""/><label for="select_all"></label></th>
                                    <th>Customer</th>
                                    <th>Goal</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>SIP/Lumsum(Rs.)</th>
                                    <th>Period</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                foreach ($model as $value) {

	                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i;?></td>
                                        <td align="center"><input type="checkbox" name="checked_id[]" id="md_checkbox_2<?php echo $i;?>" class="checkbox" value="<?php echo $value->id; ?>"/><label for="md_checkbox_2<?php echo $i;?>"></label></td>
                                        <td><?php echo $value->customer->customer_name;?></td>
                                        <td><?php echo $value->proCat->name;?></td>
                                        <td><?php echo $value->goal_type;?></td>
                                        <td><?php echo $value->goal_amount;?></td>
                                        <td><?php if($value->goal_type =='Monthly'){echo $value->sip_amount;} else {echo $value->lumsum_amount;}?></td>
                                        <td><?php echo $value->goal_period;?> Years</td>
                                        <td style="color: #149B36; font-weight: bold;"><?php echo $value->goal_status;?></td>
                                        <td>
                                            <a href="<?php echo Yii::$app->homeUrl.'admin/fund/updategoal?id='.$value->id;?>" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-light waves-float" title="EDIT"><i class="material-icons">edit</i></a> | <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/fund/deletegoal?id=<?php echo $value->id;?>" onClick="return confirm('Are you sure you want to delete?');" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-light waves-float" title="DELETE"><i class="material-icons">delete</i></a></td>

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
    $(document).ready(function () {
        //alert('test');
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
                alert("Please select a User.");
                return false;
            }
            return true;
        });

    });


</script>

