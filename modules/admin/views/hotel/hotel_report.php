<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\invoice */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css" media="print">
    .noprint {
        display: none ;
    }

</style>
<div class="row wrapper border-bottom white-bg page-heading noprint">
    <div class="col-lg-10">
        <h2>Hotels</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Hotels</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- start: page -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title noprint">
                    <h5>Hotels</h5>

                    <div class="mb-md" style="float: right;">
                        <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/hotel" class="btn btn-primary" style="margin-top: -8px;">Hotels</a>


                    </div>
                </div>

                <div class="ibox-content">

                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal noprint']]); ?>
                    <div class="panel-body">

                        <div class="col-sm-6">

                            <div class="form-group" >
                                <label class="col-sm-2 control-label">Hotel Name</label>
                                <div class="col-sm-8">
                                    <input type="text" id="hotelname" class="form-control" name="hotelname" maxlength="200" aria-required="true" aria-invalid="true" >
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Amenities</label>
                                <div class="col-sm-8">
                                    <input type="text" id="amenities" class="form-control" name="amenities" maxlength="200" aria-required="true" aria-invalid="true" >
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">State</label>
                                <div class="col-sm-8">
                                    <select id="state" class="form-control selecttwo chosen-select" name="state" class="form-control">
                                        <option value="">SELECT</option>
                                        <?php foreach ($states as $values){?>
                                            <option value="<?php echo $values->id;?>"><?php echo $values->name;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" id="city" class="form-control" name="city" maxlength="200" aria-required="true" aria-invalid="true" >
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                        </div>



                        <div class="col-sm-12 col-sm-offset-5">
                            <button class="btn btn-primary">Submit</button>
                            <!-- <input name="submit" id="submit" value="Submit" type="submit" class="btn btn-primary"> -->
                        </div>
                    </div>


                    <?php ActiveForm::end(); ?>

                    <div class="table-responsive">
                        <?php if($inti ===0){ ?>
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Address</th>
                                    <th width="15%">Group Name</th>
                                    <th width="10%">GST</th>
                                    <th width="10%">PAN</th>
                                    <th width="10%">Amenities</th>
                                    <th width="10%">State</th>
                                    <th width="10%">City</th>


                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                foreach ($model as $value) {

                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value->hotel_name ;?></td>
                                        <td><?php echo $value->address ;?></td>
                                        <td><?php echo $value->group_name ;?></td>
                                        <td><?php echo $value->gst_number ;?></td>
                                        <td><?php echo $value->pan_number ;?></td>
                                        <td><?php echo $value->amenities ;?></td>
                                        <td><?php echo $value->state ;?></td>
                                        <td><?php echo $value->city ;?></td>



                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>

                            </table>
                        <?php }?>

                        <?php if($inti ===1){ ?>
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Address</th>
                                    <th width="15%">Group Name</th>
                                    <th width="10%">GST</th>
                                    <th width="10%">PAN</th>
                                    <th width="10%">Amenities</th>
                                    <th width="10%">State</th>
                                    <th width="10%">City</th>


                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i=1;
                                foreach ($model as $value) {

                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value['hotel_name'] ;?></td>
                                        <td><?php echo $value['address'] ;?></td>
                                        <td><?php echo $value['group_name'] ;?></td>
                                        <td><?php echo $value['gst_number'] ;?></td>
                                        <td><?php echo $value['pan_number'] ;?></td>
                                        <td><?php echo $value['amenities'] ;?></td>
                                        <td><?php echo $value['state'] ;?></td>
                                        <td><?php echo $value['city'] ;?></td>





                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>

                            </table>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>





