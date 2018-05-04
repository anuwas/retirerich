<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\invoice */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $this->beginPage() ?>
<html lang="en">
<head>
    <style>
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 4px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        .table > thead > tr > th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }
        .table > tbody + tbody {
            border-top: 2px solid #ddd;
        }
        .table .table {
            background-color: #fff;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #ddd;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }
        .table-hover > tbody > tr:hover {
            background-color: #f5f5f5;
        }
        table col[class*="col-"] {
            position: static;
            display: table-column;
            float: none;
        }
        table td[class*="col-"],
        table th[class*="col-"] {
            position: static;
            display: table-cell;
            float: none;
        }
        .table > thead > tr > td.active,
        .table > tbody > tr > td.active,
        .table > tfoot > tr > td.active,
        .table > thead > tr > th.active,
        .table > tbody > tr > th.active,
        .table > tfoot > tr > th.active,
        .table > thead > tr.active > td,
        .table > tbody > tr.active > td,
        .table > tfoot > tr.active > td,
        .table > thead > tr.active > th,
        .table > tbody > tr.active > th,
        .table > tfoot > tr.active > th {
            background-color: #f5f5f5;
        }
        .table-hover > tbody > tr > td.active:hover,
        .table-hover > tbody > tr > th.active:hover,
        .table-hover > tbody > tr.active:hover > td,
        .table-hover > tbody > tr:hover > .active,
        .table-hover > tbody > tr.active:hover > th {
            background-color: #e8e8e8;
        }

        .table-responsive {
            min-height: .01%;
            overflow-x: auto;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
            width:100%;
        }
        td,
        th {
            padding: 0;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            width: 1170px;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
            float: left;
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        h1,h2,h3,h4,h5,h6{margin:0 0 5px; padding:0;}
    </style>
</head>
<body>
<?php $this->beginBody() ?>


<!-- Mail Template Start -->

<div class="row" id="tblForPrint">
    <div class="col-md-12 text-center">

        <img width="100px" src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/template_logo.png"  alt="hexatravel"><br>
        <a href="http://www.hexatravel.com/" target="_blank">www.hexatravel.com</a>
        <h5 style="font-size:20px; color:#222; font-weight:500; padding:0; margin:0;">Invoice</h5>
    </div>


    <table class="table table-bordered" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%">Invoice to</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%"><?php echo $booking->client->client_name;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%">Invoice No</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%"><?php echo $model->invoice_no;?></td>
        </tr>
        <tr>
            <td  style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" rowspan="3">Billing Address</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"  rowspan="3"><?php echo $booking->client->address_other;?><br><?php echo $booking->client->address;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" >Invoice Date</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" > <?php echo date('F d, Y',strtotime($model->invoice_date));?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Invoice Due Date</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">
                <?php
                $today=$model->invoice_date;
                $next_date= date('F d, Y', strtotime($today. ' + 14 days'));
                echo $next_date;
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Booking Reference No</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo $booking->booking_ref;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">PAN</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">AADCD7460P</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" colspan="2"></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">GSTIN</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">09AADCD7460P1Z1</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Client Reference No</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo $booking->client_ref;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Place of Supply &amp; State Code</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $booking->client->state;?> -&nbsp; <?php echo $booking->client->state_code;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">PAN No</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $booking->client->pan_number;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">&nbsp;</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">&nbsp;</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">GSTIN</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo $booking->client->gst_number;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Account Holder</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Hexa Tours &amp; Travels Pvt Ltd</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Service Category</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Tour operator services</td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Account No</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">10882560000730</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">SAC Code</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">&nbsp;</td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">IFSC Code</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">HDFC0001088</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">&nbsp;</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">&nbsp;</td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Bank Name</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">HDFC Bank,&nbsp; Behala Branch , Kolkata</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">&nbsp;</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">&nbsp;</td>
        </tr>
        </tbody>
    </table>
    <h5 style="font-size:17px; margin-top: 3px; color:#222; font-weight:500;">This Invoice has been raised against the following service -</h5>
    <table class="table table-bordered" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" width="25%">Amount Details</td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Service Type</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo $booking->service_type;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">No Of Nights</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo $booking->no_of_night;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Guest Name</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $booking->salutation.'. '.$booking->guest_name;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Rate per Night (<?=$booking_currency?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $booking->booking_rate_per_night;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Check In Date</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php echo date('F d, Y',strtotime($booking->check_in));?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Total Booking Value (<?=$booking_currency?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">
                <?php
                $book_tot =  $booking->no_of_night * $booking->booking_rate_per_night;
                echo $book_tot;
                ?>

            </td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Check Out Date</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo date('F d, Y',strtotime($booking->check_out));?></td>
            <?php if(($booking_currency != 'INR') && ($model->invoice_currency == 'INR')){?>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Rate of Exchange (ROE) </td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $model->exchane_rate;?></td>
            <?php } ?>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" rowspan="2">Service Venue</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" rowspan="2"><?php echo $booking->hotel->hotel_name;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Total Booking Value (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php
                if(($booking_currency != 'INR') && ($model->invoice_currency == 'INR')){
                    $fi_book_tot = $model->exchane_rate * $book_tot;

                    echo  $fi_book_tot;


                }
                else{
                    $fi_book_tot = $book_tot;
                    echo  $fi_book_tot;
                }

                ?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Booking Fee (<?php if(!empty($model->invoice_currency )){ echo strtoupper($model->invoice_currency);} else{ echo strtoupper($booking_currency);}?>)<b><?php if($model->invoice_currency =='INR' ||$model->invoice_currency =='' ){echo "[".$agent."]" ;}?></b></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $model->cipla_fee;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" rowspan="3">Venue Address</td>
            <td rowspan="3"><?php echo $booking->hotel->address;?><br><?php echo $booking->hotel->address_other;?></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Value incl Booking Fee (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"> <?php
                $val_fee = $fi_book_tot + $model->cipla_fee;
                echo $val_fee;
                ?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">Extra Charges (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php echo $model->card_charges;?></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Net Invoice Value (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">
                <?php $netinvoice = $val_fee + $model->card_charges;
                echo $netinvoice;
                ?>

            </td>
        </tr>
        <?php if(($booking->type_of_biling != 'Direct') && ($model->invoice_currency =='INR' ||$model->invoice_currency =='' )){?>
            <tr>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">SGST (<?php echo $sgst;?> %)</td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php if($booking->hotel->state_code == 19){ echo  $sgst_val = $sgst/100* floatval( $model->cipla_fee ); }?></td>
            </tr>
            <tr>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">CGST (<?php echo $cgst;?> %)</td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php if($booking->hotel->state_code == 19){ echo  $cgst_val=$cgst/100* floatval( $model->cipla_fee ); }?></td>
            </tr>
            <tr>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">IGST (<?php echo $igst;?> %) <b>[<?php echo $gst_type;?>]</b> </td>
                <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"><?php
                    if($igst =='5') {
                        $finaligst = ( $igst / 100 ) * floatval( $netinvoice );
                    }
                    if($igst =='18'){
                        $finaligst = ( $igst / 100 ) * floatval( $model->cipla_fee );
                    }
                    if($booking->hotel->state_code != 19){
                        echo round($finaligst,2);
                    }
                    ?>
                </td>
            </tr>
        <?php }?>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;">Gross Invoice Value (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;"><?php //echo $model->total;?>
                <?php if($model->invoice_currency =='INR' || $model->invoice_currency =='' ){if($booking->hotel->state_code == 19){$grossVAL = round($netinvoice,2) + round($sgst_val+$cgst_val ,2);}else{
                    $grossVAL = round($netinvoice,2) + round($finaligst,2);
                }
                }
                else{$grossVAL = round($netinvoice,2);}
                echo $grossVAL;
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;">(rounded off to nearest Rs.)</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;"></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" colspan="2">Net Amt. Payable (<?php if(!empty($model->invoice_currency)){ echo strtoupper($model->invoice_currency);} else{echo strtoupper($booking_currency);}?>)) in word:</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px;" colspan="2">
                <?php
                $number = sprintf($grossVAL);
                $no = round($number,2);
                $point = round($number - $no, 2) * 100;
                $hundred = null;
                $digits_1 = strlen($no);
                $i = 0;
                $str = array();
                $words = array('0' => '', '1' => 'one', '2' => 'two',
                    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                    '7' => 'seven', '8' => 'eight', '9' => 'nine',
                    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                    '13' => 'thirteen', '14' => 'fourteen',
                    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                    '60' => 'sixty', '70' => 'seventy',
                    '80' => 'eighty', '90' => 'ninety');
                $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                while ($i < $digits_1) {
                    $divider = ($i == 2) ? 10 : 100;
                    $number = floor($no % $divider);
                    $no = floor($no / $divider);
                    $i += ($divider == 10) ? 1 : 2;
                    if ($number) {
                        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                        $str [] = ($number < 21) ? $words[$number] .
                            " " . $digits[$counter] . $plural . " " . $hundred
                            :
                            $words[floor($number / 10) * 10]
                            . " " . $words[$number % 10] . " "
                            . $digits[$counter] . $plural . " " . $hundred;
                    } else $str[] = null;
                }
                $str = array_reverse($str);
                $result = implode('', $str);
                ///$points = ($point) ?
                //"." . $words[$point / 10] . " " .
                //$words[$point = $point % 10] : '';
                //echo $result . "Rupees  " . $points . " Paise";
                echo "<b>".ucfirst($result)." Rupees </b> ";
                ?>
                <!--(Rupees Five Thousand Four Hundred Forty Two Only)--></td>
        </tr>
        <tr>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" colspan="2">GST Payable on reverse charges:</td>
            <td style="padding-right: 4px; padding-left: 4px; padding-bottom: 4px; padding-top: 4px; background: #f2f2f2;" colspan="2">No</td>

        </tr>
        </tbody>
    </table>

    <h5 style="font-size:17px; margin-top: 3px; color:#222; font-weight:500;">Payment Invoice before due date mentioned above</h5>


    <ul>
        <li style="list-style:none;">1) Cash should be paid only to the cashier against official receipt.</li>


        <li style="list-style:none;">2) A/C Payee Cheques/DD should be in name of Hexa Tours &amp; Travels Pvt. Ltd.</li>


        <li style="list-style:none;">3) For Cheque Receipts: Subject to realisation of Cheque and on an Agreement that no stop payment instructions will be given by purchaser at any time for any reason.</li>


        <li style="list-style:none;">4) We reserve the right to charge interest @ 12% P.A. on over due Bills.</li>

    </ul>
    <p style="text-align:center;">*****This is a computer generated document and does not require a signature*****</p>
    <div class="col-md-12 text-center">

        <!-- <h4 style="font-size:22px; color:#015197; font-weight:600;">Hexa Tours &amp; Travels Private Limited</h4>-->
        <p style="font-size:15px; color:#222;">Hexa Tours &amp; Travels Private Limited<br>
            Regd. Office: Diamond Heritage, Unit NO H605A, 16, Strand Road, Kolkata, West Bengal 700001<br>
            CIN: U63040WB2012PTC184349</p>
    </div>

    <!--Mail Template End-->

</div>
<!--Mail Template End-->
                                                    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
