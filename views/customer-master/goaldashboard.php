<?php

/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
?>

<?php
$session = Yii::$app->session;
$cusyear = $session['loggedUser']['dob'];
$UID = $session['loggedUser']['id'];
$atoms = explode("-", $cusyear);
$year = $atoms[0];
$date = date("Y-m-d");// current date
$today = new DateTime();
$birthdate = new DateTime($cusyear);
$interval = $today->diff($birthdate);
$currYear =  $interval->format('%y');
$currMonth = $interval->format('%m');
$months = $interval->format('%m') + 12 * $interval->format('%y');
$currAge = $months / 12;
//$test = strtotime(date("Y-m-d", strtotime($date)) . " +306 month");
//echo $date = date("Y-m-d",$test);
//exit;

?>

<style>
    .error_message{
        color: #FF0000;
    }
</style>



<div class="page-header myhead">
    <div class="breadcrumb-line">
        <ul class="breadcrumb col-md-8 col-xs-offset-2">
	        <?php
	        $i=1;
	        foreach ($model as $value) {
	            //$code = $value->filename;
		        //$filename = end(explode(".", $code));
		        $basename = substr($value->filename, 0, strrpos($value->filename, "."));
		       $code = substr($basename, strrpos($basename, '_') + 1);
	        ?>
            <li class="active text-center"><a href="#" data-toggle="modal" data-target="#modal_<?php echo $code;?>" class="  label-rounded "><img alt="" src="<?php echo Yii::getAlias('@web').'/uploads/product_category/'.$value->filename;?>" width="50px;"></a><br> <?php echo $value->name;?></li>
		        <?php
		        $i++;
	        }
	        ?>
        </ul>
    </div>
</div>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Main charts -->
            <div class="row">
                <div class="col-lg-8 col-xs-offset-2" style="background:rgba(5, 85, 148, 0.7); padding: 20px; position: absolute; z-index: -10;">
<?php if($countusergoal == ''){ ?>
                    <h3 class="blue-text text-center">YOUR GOAL TIMELINE</h3>
                           <h4 class="blue-text text-center">YOU HAVEN'T SET ANY GOALS</h4><br/>
                            <p class="text-muted text-center">Click on the goal icons to start planning</p>
<?php } else {?>
                    <!-- Traffic sources -->
                    <div class="timeline timeline-center" >
                        <div class="timeline-container">

                            <!-- /sales stats -->
	                        <?php
	                        $i=0;
	                        $class = '';
	                        foreach ($goal_product as $goalvalue) {


		                        if ( $i%2  != 0 ) $class .= ' post-even';
		                        else $class = '';

	                        ?>
                            <!-- Blog post -->
                            <div class="timeline-row <?php echo $class;?>">
                                <div class="timeline-icon">
                                    <img src="assets/images/demo/users/face12.jpg" alt="">
                                </div>

                                <div class="timeline-time" style="color:#fff;">
                                    <span class="text-muted" style="color:#fff; font-size:20px;">2047</span>
                                </div>

                                <div class="panel panel-flat timeline-content">
                                    <div class="panel-heading">
                                        <h6 class="panel-title text-capitalize text-center">RETIREMENT</h6>
                                    </div>
                                    <div class="panel-body">

                                        <blockquote>
                                            <p>Target : 6.32 Cr <span class="pull-right"><img src="assets/images/demo/users/face1.jpg" class="img-circle img-md" alt=""></span></p>
                                        </blockquote>
                                    </div>
                                    <div class="panel-footer panel-footer-transparent">
                                        <div class="heading-elements">
                                            <ul class="list-inline list-inline-condensed heading-text">
                                                <li><a href="javascript:void(0)" class="text-default"><i class="icon-eye4 position-left"></i> VIEW</a></li>
                                                <li><a href="javascript:void(0)" class="text-default"><i class="icon-pencil7 position-left"></i> EDIT</a></li>
                                                <li><a href="javascript:void(0)" class="text-default"><i class="icon-comment-discussion position-left"></i> REMOVE</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /blog post -->

<?php  $i++;} ?>

                        </div>
                    </div>
                    <!-- /traffic sources -->
                    <div class="col-md-12 text-center" ><button type="button" class="btn btn-success btn-rounded">PROCEED TO PLANNING</button></div>
                  <?php } ?>
                </div>
            </div>
            <!-- /main charts -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

<!--TAX Saving Start-->
<div id="modal_TAX" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <form method="POST" action="" id="taxform">
                    <input type="hidden" id="retirement_age" value="60" >
                    <input type="hidden" id="current_age" name="current_age" value="<?php echo $currAge;?>">
                    <input type="hidden" id="investCorp" name="invest_amount"  value="">
                    <input type="hidden" id="taxInflationRate" value="0.08" >
                    <input type="hidden" id="dob" value="<?php echo $year;?>" >

                    <input type="hidden" name="goalType" class="goalType input_field"/>
                    <input type="hidden" name="corpRqd" id="taxcorpRqd" value="0"/>
                    <input type="hidden" name="name" value="Tax Saving"/>
                    <input type="hidden" name="netCorp" id="taxnetCorp" value="0"/>
                    <input type="hidden" name="loanRqd" value="0"/>
                    <input type="hidden" name="loanAmt" value="0"/>
                    <input type="hidden" name="defaultGoalPk" class="defaultGoalPk"/>
                    <input type="hidden" name="loanEMI" value="0"/>
                    <input type="hidden" name="loanIntrt" value="0"/>
                    <input type="hidden" name="acmpMonth" id="taxAcmpMonth" value=""/>
                    <input type="hidden" name="acmpYear" id="taxAcmpYear"/>
                    <input type="hidden" name="goalTypeCode" id="goalType" class="tax_goal_type" value="1"/>
                    <input type="hidden" id="endyear" value="<?php echo $months;?>">
                    <input type="hidden" id="Duration" value="">
                    <input type="hidden" name="existingAmtRqd" class="existingAmtRqd"/>
                    <input type="hidden" name="existingAmtRqdFreq" class="amtRqdFreqInput"/>
                    <input type="hidden" name="existingAcmpMonth" class="taxExistingAcmpMonth"/>
                    <input type="hidden" name="existingAcmpYear" class="taxExistingAcmpYear"/>
                    <input type="hidden" name="goaldfdate" class="goaldfdate"/>
                    <input type="hidden" name="corpus" id="Corpus" class="goaldfdate"/>
                    <input type="hidden" name="SipAmount" id="SIP" class="goaldfdate"/>
                    <input type="hidden" name="LumsumAmount" id="Lumsum" class="goaldfdate"/>
                    <input type="hidden" name="goalFor" value="0" />
                    <input type="hidden" name="goalStatus" class="goalStatus" />
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0" required> as
                        <label class="radio-inline">
                            <input type="radio" name="amtRqdFreq" class="amtRqdFreq" id="monthlyAmtRqdFreq" value="Monthly" data-value="1" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="amtRqdFreq"  class="amtRqdFreq" id="onetimeAmtRqdFreq" value="OneTime" data-value="2">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small-txt text-left">
                                <p class="pull-left tax-chart tax-chart-calculation" style="display:none;"><small><a id="tax-coach-speak-01" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="coach-questions">See how tax saving mutual funds (ELSS) are better suited for you</a></small></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-txt text-right">
                                <p class="pull-right tax-chart" style="display:none;"><small><a id="tax-coach-speek-question" class="coach-questions" href="#">Should I invest in Insurance policies for tax savings?</a></small></p>
                            </div>
                        </div>
                    </div>
            </div>
            </form>

            <div class="row collapse" id="collapseExample">
                <button type="button" class="close dashboard01-close tax-table-close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div class="col-md-12">
                    <div class="table-responsive table-txt">
                <table class="responsive table table-bordered table-success tax-table">
                    <tbody>
                    <tr>
                        <th>INVESTMENT CLASS</th>
                        <th>RISK</th>
                        <th>HISTORICAL RETURNS</th>
                        <th>LOCK-IN</th>
                        <th>TIME TILL RETIREMENT</th>
                        <th>INVESTED AMOUNT</th>
                        <th>EXPECTED VALUE</th>
                        <th>TAXABILITY</th>
                    </tr>
                    <tr class="FXD " >
                        <td>Fixed Deposits</td>
                        <td>No Market Risk</td>
                        <td class="FXD_return" data-rate="6">6%</td>
                        <td>5 years</td>
                        <td class="frequency">24</td>
                        <td class="invested_amount"></td>
                        <td class="FXD_fvresult"></td>
                        <td>Taxable</td>
                    </tr>
                    <tr class="INS " >
                        <td>ULIPs</td>
                        <td>Market Risk</td>
                        <td class="INS_return" data-rate="9">9%</td>
                        <td>20-25 years</td>
                        <td class="frequency">24</td>
                        <td class="invested_amount"></td>
                        <td class="INS_fvresult"></td>
                        <td>Tax-free</td>
                    </tr>
                    <tr class="PPF " >
                        <td>PPF</td>
                        <td>No Market Risk</td>
                        <td class="PPF_return" data-rate="8">8%</td>
                        <td>15 years</td>
                        <td class="frequency">24</td>
                        <td class="invested_amount"></td>
                        <td class="PPF_fvresult"></td>
                        <td>Tax-free</td>
                    </tr>
                    <tr class="ELSS success highlight txt-heighlight" >
                        <td>ELSS</td>
                        <td>Market Risk</td>
                        <td class="ELSS_return" data-rate="14">14%</td>
                        <td>3 years</td>
                        <td class="frequency">24</td>
                        <td class="invested_amount"></td>
                        <td class="ELSS_fvresult"></td>
                        <td>Tax-free</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <p class="tax-note">*Market Risk: Investment values fluctuate.</p>
        </div>
    </div>



            <div class="modal-footer text-center" style="margin-top:20px;">
                <p class="error_message"></p>
                <button type="button" class="btn btn-success btn-rounded" id="tax_proceed_btn">PROCEED</button>
                <button type="button" class="btn btn-success btn-rounded" id="tax_submit_btn" style="display:none;">CREATE MY GOAL</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--TAX Saving END-->

<!--REtirement  Start-->
<div id="modal_RET" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">RETIREMENT</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>



            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--REtirement  END-->

<!--HOME Start-->
<div id="modal_HOME" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>




            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--HOME END-->

<!--CAR Start-->
<div id="modal_CAR" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>




            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--CAR END-->

<!--VACation  Start-->
<div id="modal_VAC" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>



            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--VACation  END-->

<!--EDucation  Start-->
<div id="modal_EDU" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>




            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--EDucation Saving END-->

<!--Marriage  Start-->
<div id="modal_MRG" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>




            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--Marriage  END-->

<!--HEALTH  Start-->
<div id="modal_HEALTH" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">TAX SAVING</h6>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <p class="text-center">I want to invest <i class="fa fa-inr"></i> <input style="display:inline-block; width:30%;" type="text" class="form-control input_field inrFormat text-center restricted-size custom-input-text" data-maxlength="13" id="taxAmtRqd" name="amountReqd" placeholder="0"> as
                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left" checked="checked">
                            Monthly
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="radio-unstyled-inline-left">
                            Lumpsum
                        </label>
                        In Tax Saving Mutual Funds (ELSS) for this financial year.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">(Maximum deduction from taxable income allowed under Section 80C is Rs 1.5 Lakhs each Financial Year.)</p>
                    </div>
                </div>
            </div>




            <div class="modal-footer text-center" style="margin-top:20px;">
                <button type="button" class="btn btn-success btn-rounded">PROCEED</button>
            </div>
        </div>
    </div>
    <!-- /success modal -->
</div>
<!--HEALTH  END-->

<script type="text/javascript">
    $(document).ready(function(){
        //alert('1');

        $("#taxAmtRqd").focus(function(){
            $(".error_message").text("");
        });

        $("#tax_proceed_btn").click(function(){
            //alert('tes');
            validateAndSubmit();
        });



        $(".amtRqdFreq").change(function(){
            $("#tax_proceed_btn").show();
            $("#tax_submit_btn").hide();
            $(".tax-chart").hide();
            $(".collapse").removeClass("in");
            $(".error_message").text("");
        });

        $("#taxAmtRqd").keyup(function(){
            var value = $("#taxAmtRqd").val();
            value = value.replace(new RegExp(',', 'g'), '');
            if(value.search(/^0/) != -1)
                $("#taxAmtRqd").val("");

            $("#tax_proceed_btn").show();
            $("#tax_submit_btn").hide();
            $(".tax-chart").hide();
            $(".collapse").removeClass("in");
        });
        $("#tax-coach-speak-01").click(function(){
            var elssCalculatedResult = $(".elss_fvresult").attr("data-fv");
            $(".tax-table").find("tbody tr.PPF, tbody tr.FXD").show();
            var retirementAge= $("#retirement_age").val();// user retirement age
            //tellCoachToSpeak("In addition to Tax Saving, your investments could <strong>contribute Rs."+shorthandCurrency(elssCalculatedResult)+" to your retirement corpus</strong> by the time you turn "+retirementAge+".", true, true);
            // $(".tax-table tbody tr.INS").removeClass("success highlight");
            $(".tax-table tbody tr.ELSS").addClass("txt-heighlight");
            tellCoachToSpeak("Your annual Tax Saving will definitely help fund your retirement goal.. See how Tax saving mutual funds are better suited for you.", true, true);
        });
        $("#tax-coach-speek-question").click(function(){
            //tellCoachToSpeak("Buying life <strong>insurance policy</strong> will help you to save tax (u/s 80C on income of Rs.1.50 Lakh) but it is a <strong>poor form of investment</strong>. Investing in life insurance policy for a long term means <strong>locking your investment for a long duration at very low rate of returns</strong>. For such a long term, you should <strong>invest in Equity Linked Saving Scheme</strong> (ELSS funds) which can deliver <strong>higher post tax return plus tax saving under section 80C</strong>.", true, true);
            $(".tax-table").find("tbody tr.PPF, tbody tr.FXD").hide();

            if($("#collapseExample").is(":visible"))
                $("#collapseExample").addClass("");
            else
                $("#collapseExample").addClass("in");

            // $(".tax-table tbody tr.INS").removeClass("success highlight");
            $(".tax-table tbody tr.ELSS").removeClass("success highlight");
            $(".tax-table tbody tr.ELSS").removeClass("txt-heighlight");
            tellCoachToSpeak("Buying Insurance will help you to save tax but it is a poor form of investment. Insurance is best suited for family protection while Tax Saving Mutual Funds are best suited for long term wealth creation.", true, true);
        });
        var CurrAge = $("#current_age").val();// user current age
        function validateAndSubmit(){

            var value = $("#taxAmtRqd").val();
            value = value.replace(new RegExp(',', 'g'), '');
            var taxAmtRqd = Number(value).toString();
           // alert(taxAmtRqd);
            if(taxAmtRqd != 0){
                var retirementAge= $("#retirement_age").val();// user retirement age

                var taxInflationRate =$("#taxInflationRate").val();//tax inflation rate
                var accompYear = parseFloat(retirementAge) - parseFloat(CurrAge);
                //alert(accompYear);
                var currentDate = new Date();
                var currentMonth = currentDate.getMonth()+1;
                var currentYear = currentDate.getFullYear();
                var amtRqdFreq = $(".amtRqdFreq:checked").attr("data-value");// get value either monthle or yearly selected
                //alert(accompYear);
                if(amtRqdFreq == 1){
                    nper = accompYear * 12;
                    $(".frequency").html(Math.round(nper)+" Months");
                    var investedAmount = Math.abs(taxAmtRqd*nper);
                    $(".invested_amount").html(shorthandCurrency(investedAmount, true));

                    // if after 15th, this value should be 0 else 1 - this is to consider current month or not
                    var additionFactor = 0;

                    var totalNumberOfMonths = ( (currentMonth >= 1 && currentMonth < (3 + additionFactor) ) ? ( (3 + additionFactor) - currentMonth) : ( 12 - currentMonth + (3 + additionFactor) ) );//(((currentYear+1) - currentYear)*12)+(3 - currentMonth); // 12 - 11 + 4 = 5
                    var taxcorpus = value * totalNumberOfMonths;
                    $("#taxcorpRqd").val(taxcorpus);
                    $("#taxnetCorp").val(taxcorpus);
                    $("#investCorp").val(investedAmount);
                    $("#Duration").val(accompYear);
                    $("#SIP").val(taxAmtRqd);
                    $("#Lumsum").val('');
                }
                else if(amtRqdFreq == 2){
                    nper = accompYear;
                    $(".frequency").html(Math.round(nper)+" Years");
                    var investedAmount = Math.abs(taxAmtRqd*nper);
                    $(".invested_amount").html(shorthandCurrency(investedAmount, true));
                    $("#taxcorpRqd").val(value);
                    $("#taxnetCorp").val(value);
                    $("#investCorp").val(investedAmount);
                    $("#Duration").val(accompYear);
                    $("#SIP").val('');
                    $("#Lumsum").val(taxAmtRqd);
                }

                $("#taxAcmpMonth").val(currentMonth);
               // $("#taxAcmpMonth").val(currentMonth);

                if(currentMonth < 4){
                    $("#taxAcmpYear").val(currentYear);
                }else{
                    $("#taxAcmpYear").val(parseInt(currentYear) + parseInt(1));
                }
                currentMonth = 3;

                /* FOR MONTHLY RATES*/
                var elss_return 			= $(".ELSS_return").attr("data-rate")/100;
                var ppf_return 				= $(".PPF_return").attr("data-rate")/100;
                var bank_fd_return 			= $(".FXD_return").attr("data-rate")/100;
                var insurance_policy_return = $(".INS_return").attr("data-rate")/100;

                if(amtRqdFreq == 1){
                   // alert('jok');
                    if(taxAmtRqd != 0 && taxAmtRqd >= 1000 && taxAmtRqd <= 100000){
                        if(taxAmtRqd % 100 == 0){
                           // alert('kolkata');
                            var elss_return = elss_return/12;
                            var ppf_return = ppf_return/12;
                            var bank_fd_return = bank_fd_return/12;
                            var insurance_policy_return = insurance_policy_return/12;
                            /* FOR MONTHLY RATES*/
                            calculateResult(elss_return,ppf_return,bank_fd_return,insurance_policy_return,nper,taxAmtRqd,retirementAge);
                        }else{
                            $(".error_message").text("Amount should be in multiples of 100");
                            $("#tax_proceed_btn").show();
                            $("#tax_submit_btn").hide();
                            $(".tax-chart").hide();
                        }
                    }else{
                        $(".error_message").text("For monthly minimum amount is 1,000 and maximum amount is 1 lakh.");
                        $("#tax_proceed_btn").show();
                        $("#tax_submit_btn").hide();
                        $(".tax-chart").hide();
                    }
                }else if(amtRqdFreq == 2){
                    if(taxAmtRqd != 0 && taxAmtRqd >= 5000 && taxAmtRqd <= 1000000){
                        if(taxAmtRqd % 500 == 0){
                            /* FOR ONE TIME RATES*/
                            calculateResult(elss_return,ppf_return,bank_fd_return,insurance_policy_return,nper,taxAmtRqd,retirementAge);
                        }else{
                            $(".error_message").text("Amount should be in multiples of 500");
                            $("#tax_proceed_btn").show();
                            $("#tax_submit_btn").hide();
                            $(".tax-chart").hide();
                        }
                    }else{
                        $(".error_message").text("For one-time minimum amount is 5,000 and maximum amount is 10 lakh.");
                        $("#tax_proceed_btn").show();
                        $("#tax_submit_btn").hide();
                        $(".tax-chart").hide();
                    }
                }
            }else{
                $(".error_message").text("Please enter valid amount.");
            }
        }

        $("#tax_submit_btn").click(function(){
           // alert('zkldhfoiw');
           // $(this).attr("disabled", "disabled");
            var proCatID=$("#goalType").val();
            var GoalType = $(".amtRqdFreq:checked").val();
            var InvestmentAmount=$("#investCorp").val();
            var GoalAmount=$("#Corpus").val();
            var GoalPeriod=$("#Duration").val();
            var EndYear = $("#endyear").val();
            var SipAmount=$("#SIP").val();
            var lumsumAmount=$("#Lumsum").val();
            //alert(GoalPeriod);
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl. '/customer-master/setgoal' ?>',
                type: 'post',
                data: {
                    proCatID:proCatID,
                    GoalType: GoalType,
                    InvestmentAmount : InvestmentAmount,
                    GoalAmount : GoalAmount,
                    GoalPeriod : GoalPeriod,
                    SipAmount : SipAmount,
                    lumsumAmount : lumsumAmount,
                    EndYear : EndYear,
                    _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
                },
                success: function (data) {
                    alert('Successfully Send !');
                    location.reload();
                }
            });
        });


        function calculateResult(elss_return,ppf_return,bank_fd_return,insurance_policy_return,nper,taxAmtRqd,retirementAge){
            $(".error_message").text("");


            /* CALCULATE FV RESULTS FOR ELSS, PPF, BANK FXD, INSURANCE POLICY */
            var elssFvResult = Math.round(ExcelFormulas.FV(elss_return, nper, -taxAmtRqd,'',1));
            var ppfFvResult = Math.round(ExcelFormulas.FV(ppf_return, nper, -taxAmtRqd,'',1));
            var bankFdFvResult = Math.round(ExcelFormulas.FV(bank_fd_return, nper, -taxAmtRqd,'',1));
            var insurancePolicyFvResult = Math.round(ExcelFormulas.FV(insurance_policy_return, nper, -taxAmtRqd,'',1));

            /* SHOW FV RESULTS FOR ELSS, PPF, BANK FXD, INSURANCE POLICY */
            $(".ELSS_fvresult").html(shorthandCurrency(elssFvResult, true));
            $(".PPF_fvresult").html(shorthandCurrency(ppfFvResult, true));
            $(".FXD_fvresult").html(shorthandCurrency(bankFdFvResult, true));
            $(".INS_fvresult").html(shorthandCurrency(insurancePolicyFvResult, true));

            /* ADD FV RESULTS FOR ELSS, PPF, BANK FXD, INSURANCE POLICY TO DATA ATTRIBUTE OF TD */
            $(".ELSS_fvresult").attr("data-fv", elssFvResult);
            $(".PPF_fvresult").attr("data-fv", ppfFvResult);
            $(".FXD_fvresult").attr("data-fv", bankFdFvResult);
            $(".INS_fvresult").attr("data-fv", insurancePolicyFvResult);
            $("#Corpus").val(elssFvResult);

            // var fvResult = Math.round(ExcelFormulas.FV(taxInflationRate, nper, '0', taxAmtRqd));

            $("#tax_proceed_btn").hide();
            $("#tax_submit_btn").show();
//alert(CurrAge);
            if(CurrAge >= 60){
                $(".tax-chart").hide();
                $(".tax-chart-calculation").hide();
            }else{
               /* var message = "You will be happy to know that in addition to your tax saving, this investment, if continued, could contribute Rs. "+shorthandCurrency(elssFvResult, true)+" to your retirement corpus by the time you turn "+retirementAge;
                tellCoachToSpeak(message, true, true);*/
                //alert('hfsd');
                $(".tax-chart").show();
                $(".tax-chart-calculation").show();
            }

        }
    });
</script>