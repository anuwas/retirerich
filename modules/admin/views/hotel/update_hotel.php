<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Hotel */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row wrapper border-bottom white-bg page-heading">
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
                <div class="ibox-title">
                    <h5>Edit Hotel</h5>

                    <!--<div class="mb-md" style="float: right;">
                        <a href="<?php /*echo Yii::$app->request->baseUrl; */?>/admin/hotel" class="btn btn-primary"
                           style="margin-top: -8px;">Hotel</a>

                    </div>-->
                </div>
                <div class="ibox-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal']]); ?>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hotel Name<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-hotel_name" class="form-control" name="Hotel[hotel_name]"
                                       maxlength="200" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->hotel_name; ?>" required >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <textarea id="hotel-address" class="form-control"
                                          name="Hotel[address]" required><?php echo $model->address; ?></textarea>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address Two</label>
                            <div class="col-sm-8">
                                <textarea id="hotel-address_other" class="form-control"
                                          name="Hotel[address_other]"><?php echo $model->address_other; ?></textarea>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-8">
                                <select id="hotel-country" class="form-control  chosen-select" name="Hotel[countries]" class="form-control" required>
                                    <?php foreach ($countries as $values){?>
                                        <option value="<?php echo $values->id;?> " <?php if($values->id==$model->countries){echo "selected";}?>><?php echo $values->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">State</label>
                            <div class="col-sm-8">
                                <select data-value="<?php echo $model->state ?>" id="hotel-state" class="form-control  chosen-select"
                                        name="Hotel[state]" class="form-control" >
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-city" class="form-control" name="Hotel[city]"
                                       maxlength="200" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->city; ?>" >
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div id="SC">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">State Code</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-state_code" class="form-control" name="Hotel[state_code]"
                                       maxlength="200" aria-required="true" aria-invalid="true" readonly
                                       value="<?php echo $model->state_code; ?>">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Zip Code</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-zipcode"  class="form-control" name="Hotel[zipcode]" maxlength="200" aria-required="true" aria-invalid="true" value="<?php echo $model->zipcode; ?>">

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" id="hotel-hotel_email" class="form-control"
                                       name="Hotel[hotel_email]" maxlength="200" aria-required="true"
                                       aria-invalid="true" value="<?php echo $model->hotel_email; ?>" placeholder="Only Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Input Email">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact Person</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-contact_person" class="form-control" name="Hotel[contact_person]" maxlength="200" aria-required="true" aria-invalid="true" value="<?php echo $model->contact_person; ?>" >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact Email</label>
                            <div class="col-sm-8">
                                <input type="email" id="hotel-contact_email" class="form-control" name="Hotel[contact_email]" maxlength="200" aria-required="true" aria-invalid="true" value="<?php echo $model->contact_email; ?>" placeholder="Only Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please Input Email">

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Payment Mode</label>
                            <div class="col-sm-8">
                                <select id="hotel-payment_method" class="form-control  chosen-select" name="Hotel[payment_method]" class="form-control" >
                                    <option value="Bank Transfer" <?php if($model->payment_method=="Bank Transfer"){echo "selected";}?>>Bank Transfer</option>
                                    <option value="CCA" <?php if($model->payment_method=="CCA"){echo "selected";}?>>CCA</option>
                                </select>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-contact_number" class="form-control" name="Hotel[contact_number]" maxlength="200" aria-required="true" aria-invalid="true" value="<?php echo $model->contact_number; ?>" >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">GST No.</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-gst_number" class="form-control" name="Hotel[gst_number]"
                                       maxlength="15" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->gst_number; ?>" >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">PAN No.</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-pan_number" class="form-control" name="Hotel[pan_number]"
                                       maxlength="10" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->pan_number; ?>" >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Group Name</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-group_name" class="form-control" name="Hotel[group_name]"
                                       maxlength="200" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->group_name; ?>" >

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Star Category</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-star_category" class="form-control"
                                       name="Hotel[star_category]" maxlength="200" aria-required="true"
                                       aria-invalid="true" value="<?php echo $model->star_category; ?>" >

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Amenities</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-amenities" class="form-control" name="Hotel[amenities]"
                                       maxlength="200" aria-required="true" aria-invalid="true"
                                       value="<?php echo $model->amenities; ?>" >

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Remark</label>
                            <div class="col-sm-8">
                                <textarea id="hotel-remark" class="form-control" name="Hotel[remark]"><?php echo $model->remark; ?></textarea>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tax</label>
                            <div class="col-sm-8">
                                <input type="text" id="hotel-tax" class="form-control" name="Hotel[tax]" maxlength="200"
                                       aria-required="true" aria-invalid="true" value="<?php echo $model->tax; ?>" placeholder="Only Numbers" pattern="[0-9]+(\.[0-9]{0,2})?%?%" title="Please Input Only Numeric Values">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tax Remark</label>
                            <div class="col-sm-8">
                                <textarea id="hotel-tax_remark" class="form-control"
                                          name="Hotel[tax_remark]"><?php echo $model->tax_remark; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cancellation Policy</label>
                            <div class="col-sm-8">
            <textarea id="hotel-cancellation_policy" class="form-control" name="Hotel[cancellation_policy]"><?php echo $model->cancellation_policy; ?></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload File</label>
                            <div class="col-sm-8">

                                <input type="file" style="float: left;" name="UploadForm[resource]" id="uploadform-iresource">
                                <label style="float: left; margin-left: 31px; margin-top: 8px;">Selected File: <span style="font-size: 14px;">
                                        <?php if(!empty($model->filename)){ echo $model->filename;} else{echo "No File Selected";}?></span></label>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Corporate Rate</label>
                            <div class="col-sm-8">

                                <label class="radio-inline">
                                    <?php if ($model->corporate_rate == '1') { ?>
                                        <input type="radio" id="hotel-corporate_rate" name="Hotel[corporate_rate]"
                                               value="1" checked="checked">Yes
                                    <?php } else { ?>
                                        <input type="radio" id="hotel-corporate_rate" name="Hotel[corporate_rate]"
                                               value="1">Yes
                                    <?php } ?>
                                </label>
                                <label class="radio-inline">
                                    <?php if ($model->corporate_rate == '0') { ?>
                                        <input type="radio" id="hotel-corporate_rate" name="Hotel[corporate_rate]"
                                               value="0" checked="checked">No
                                    <?php } else { ?>
                                        <input type="radio" id="hotel-corporate_rate" name="Hotel[corporate_rate]"
                                               value="0">No
                                    <?php } ?>
                                </label>
                            </div>
                        </div>
                        <?php if ($model->corporate_rate == '1') {
                            ?>
                            <div class="col-md-11"><a href="javascript:void(0);" class="btn btn-primary"
                                                      onclick="myAppend()"><i class="fa fa-plus"></i></a></div>
                            <div class="row append">
                                <?php
                                for ($i = 0; $i < $count; $i++) {
                                    ?>

                                    <div class="col-md-11 sam123">

                                        <div class="col-sm-3">
                                            <input type="text" placeholder="Start Day" id='hotel-from_day[]'
                                                   name='Hotel[from_day][]' class="form-control"
                                                   value="<?php echo $model->from_day[$i]; ?>" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
                                        </div>

                                        <div class="col-sm-3">
                                            <input type="text" placeholder="End Day" id='hotel-to_day[]'
                                                   name='Hotel[to_day][]' class="form-control"
                                                   value="<?php echo $model->to_day[$i]; ?>" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" placeholder="Price" id='hotel-price[]'
                                                   name='Hotel[price][]' class="form-control"
                                                   value="<?php echo $model->price[$i]; ?>" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="#" class="btn btn-primary remove_row"><i
                                                        class="fa fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                }

                                ?>
                            </div>

                            <?php

                        }
                        ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">

                                <label class="radio-inline">
                                    <?php if ($model->active == '1') { ?>
                                        <input type="radio" id="hotel-active" name="Hotel[active]" value="1"
                                               checked="checked">Active
                                    <?php } else { ?>
                                        <input type="radio" id="hotel-active" name="Hotel[active]" value="1">Active
                                    <?php } ?>
                                </label>
                                <label class="radio-inline">
                                    <?php if ($model->active == '0') { ?>
                                        <input type="radio" id="hotel-active" name="Hotel[active]" value="0"
                                               checked="checked">Inactive
                                    <?php } else { ?>
                                        <input type="radio" id="hotel-active" name="Hotel[active]" value="0">Inactive
                                    <?php } ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-9 col-sm-offset-2 float_1">
                            <button class="btn btn-primary">Submit</button>
                            <!-- <input name="submit" id="submit" value="Submit" type="submit" class="btn btn-primary"> -->

                            <a href="<?php echo Yii::$app->request->baseUrl; ?>/admin/hotel" class="btn btn-primary">Cancel</a>
                        </div>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="col-md-11 sam123" id="corporate_rate_form" style="display: none;">

    <div class="col-sm-3">
        <input type="text" placeholder="Start Day" id='hotel-from_day[]'
               name='Hotel[from_day][]' class="form-control"
               value="" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
    </div>

    <div class="col-sm-3">
        <input type="text" placeholder="End Day" id='hotel-to_day[]'
               name='Hotel[to_day][]' class="form-control"
               value="" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
    </div>
    <div class="col-sm-3">
        <input type="text" placeholder="Price" id='hotel-price[]'
               name='Hotel[price][]' class="form-control"
               value="" pattern="[0-9]+(\.[0-9]{0,2})?%?" title="Please Input Only Numeric Values">
    </div>
    <div class="col-sm-3">
        <a href="#" class="btn btn-primary remove_row"><i
                    class="fa fa-minus"></i></a>
    </div>
</div>

<p id="demo"></p>

<script type="text/javascript">

    function myAppend() {
        $(".append").append("<div class='row remove123'>" + $('#corporate_rate_form').html() + "</div>");
        setRemoveListener();
    }

    $(function () {
        setRemoveListener();
    });

    function setRemoveListener() {
        $('.remove_row').off();
        $('.remove_row').on("click", function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }
</script>

<script>
    $(document).ready(function () {
        setTimeout(function() {
            var countryId = $("#hotel-country").val();
            if(countryId == 101){
                //alert(countryId);
                $('#SC').show();
            }
            else {
                //alert(countryId);
                $('#SC').hide();
            }
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/hotel/states' ?>',
                type: 'post',
                _csrf: yii.getCsrfToken(),
                data: {countryId: countryId},
                dataType: "text",
                success: function (data) {
                    var responsedata = $.parseJSON(data);

                    $('#hotel-state option').remove();
                    var oldData = $('#hotel-state').data("value");
                    var state_name=null;
                    for(var i=0;i<responsedata.length;i++){
                        var state_name = responsedata[i].states_name;
                        if (oldData == responsedata[i].states_name) {
                            $('#hotel-state').append('<option selected value="' + responsedata[i].states_name + '" >' + responsedata[i].states_name + ' </option>');
                        }
                        else {
                            $('#hotel-state').append('<option value="' + responsedata[i].states_name + '" >' + responsedata[i].states_name + ' </option>');
                        }
                    }

                    //}
                }
            }, 2000);
        });
        $("#hotel-country").on('change',function () {
            var countryId = $(this).val();

            if(countryId == 101){
                $('#SC').show();
            }
            else {
                $('#SC').hide();
            }

            //alert(checkoutDate);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl . '/admin/hotel/states' ?>',
                type: 'post',
                data: {countryId: countryId},
                dataType: "text",
                success: function (data) {
                    var responsedata = $.parseJSON(data);
                    //console.log(responsedata.states_name);
                    //alert(responsedata.states_name);

                    //if(typeof data === 'object'){
                    $('#hotel-state option').remove();
                    for(var i=0;i<responsedata.length;i++){
                        $('#hotel-state').append('<option value="'+responsedata[i].states_name+'">'+responsedata[i].states_name+'</option>');
                    }
                    $('#hotel-state').select2();
                    //}
                }

            });
        });
    });
</script>
<script type="text/javascript">
    $(function () {

        var myfile="";


        $('#uploadform-iresource').on( 'change', function() {
            myfile= $( this ).val();
            var ext = myfile.split('.').pop();
            if(ext=="pdf" || ext=="docx" || ext=="doc"){
                return true;
            } else{
                alert("Please Upload Only PDF OR Doc File.");
                $('#uploadform-iresource').val('');
                return false;
            }
        });

        $("#hotel-state").on("change", function (){


            var stateNAME=$("#hotel-state").val();
            // var stateNAME = $(".selecttwo option:selected").text();

            var formData = new FormData();
            formData.append("stateNAME", stateNAME);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl. '/admin/hotel/findstatecode' ?>',
                type: 'post',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var responsedata = $.parseJSON(data);
                    $('#hotel-state_code').val(responsedata.statecode);

                }
            });
        });
    });

</script>