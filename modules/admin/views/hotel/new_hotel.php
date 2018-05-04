<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Hotel */
/* @var $form yii\widgets\ActiveForm */
?>

                    <div class="container-fluid">
                        <div class="block-header">
                                                        <!-- <h2>USERS</h2>
														 <br>-->
                                                        <ol class="breadcrumb breadcrumb-bg-white breadcrumb-col-deep-purple">
                                       <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                                       <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Hotels</a></li>
                                                        </ol>
                                                    </div>
                                                    <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            New Hotel
                        </h2>

                    </div>
                    <div class="body">
						<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class' => 'form-horizontal']]); ?>
									<div class="panel-body">
                                         <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name">Name</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" placeholder="Enter Name" name="Hotel[hotel_name]" id="hotel-hotel_name" required  pattern="[A-Za-z ]+" title="Only Text Allow">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="role">Country</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select id="hotel-country" class="form-control selecttwo chosen-select show-tick" name="Hotel[countries]" required>
                                                            <option value="">--Select--</option>
	                                                        <?php foreach ($countries as $values){?>
                                                                <option value="<?php echo $values->id;?>"><?php echo $values->name;?></option>
	                                                        <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name">Content</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="">
	                                                    <?php echo $form->field($model, 'address',['template' => '<div class=\"\" style="margin-left: 15px; ">{input}</div>'])->widget(CKEditor::className(),['editorOptions'=>['width' => '95%','allowedContent' => true, 'forcePasteAsPlainText' => true, 'language' => Yii::$app->language]]);?>
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
                        <input name="Hotel[active]" id="radio_10" class="with-gap radio-col-deep-purple" type="radio" value="1" checked>
                        <label for="radio_10">ACTIVE</label>
                        <input name="Hotel[active]" id="radio_11" class="with-gap radio-col-deep-purple" type="radio" value="0">
                        <label for="radio_11">INACTIVE</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                    <input name="submit" id="submit" value="Submit" type="submit" class="btn bg-deep-purple waves-effect">
                    <a href="<?php echo  Yii::$app->request->baseUrl;?>/admin/hotel" class="btn btn-white waves-effect">Cancel</a>
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
            console.log(stateNAME);
            // var stateNAME = $(".selecttwo option:selected").text();
            var formData = new FormData();
            formData.append("stateNAME", stateNAME);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl. '/admin/client/findstatecode' ?>',
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

<script type="text/javascript">
    $(function () {
    $("#hotel-gst_number").keyup(function (){
        var GST = $("#hotel-gst_number").val();
        var PAN = GST.substr(2, 10);
        $('#hotel-pan_number').val(PAN);
    });
    });
</script>


<script>
    $(document).ready(function () {
        $("#hotel-country").on('change',function () {
            var countryId = $(this).val();

            if(countryId == '101'){
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

                    //}
                }

            });
        });
    });
</script>
<script type="text/javascript">
    $(function () {
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
