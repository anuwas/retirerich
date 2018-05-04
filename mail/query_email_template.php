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
            margin-bottom: 20px;
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
            margin-bottom: 0;
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
        .clearfix{clear:both;}
    </style>
</head>


<body>
<?php $this->beginBody() ?>
<?php $l=0;$j=1; foreach ($list as $values) {

    ?>
    <table class="table table-bordered" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr style="height:15pt">
            <td width="279" nowrap="" colspan="3" style="margin:0;text-align:center;background:#015398;padding:3px; color:#fff; font-size:18px; font-weight: bold;">
                Option <?php echo $j;?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="147" nowrap="" rowspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px; width:110.35pt; ">
                Check-In
            </td>
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; ">
                Date
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php echo date('F d, Y',strtotime($model->check_in));?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; ">
                Time
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
               3 PM
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="147" nowrap="" rowspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:110.35pt; background:#f2f2f2;">
                Check-Out
            </td>
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; background:#f2f2f2;">
                Date
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt;  background:#f2f2f2;">
                <?php echo date('F d, Y',strtotime($model->check_out));?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; background:#f2f2f2;">
                Time
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt;  background:#f2f2f2;">
                12 Noon
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="147" nowrap="" rowspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:110.35pt; ">
                No. of
            </td>
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; ">
                Adult
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php if(!empty($model->no_of_guest_adult)){echo $model->no_of_guest_adult;}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="123" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:91.9pt; ">
                Children
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php if(!empty($model->no_of_guest_children)){echo $model->no_of_guest_children;}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt;background:#f2f2f2;">
                No. of Nights
            </td>
            <td width="279" nowrap="" style="padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                <?php $no_of_night=date_diff(date_create($model->check_in),date_create($model->check_out));echo $no_of_night->format("%a");?>

            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; ">
                No. of Rooms
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php if(!empty($model->no_of_room)){echo $model->no_of_room;}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; background:#f2f2f2;">
                Payment Options
            </td>
            <td width="279" nowrap="" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2; font-size:13px;; font-weight: bold;">
                <?php if(!empty($values['payment_method'])){echo $values['payment_method'];}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:17.25pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; ">
                Hotel Name
            </td>
            <td width="279" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; font-size:13px;; font-weight: bold;">
                <?php if(!empty($values['hotel_name'])){echo $values['hotel_name'];}else{ echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:24.75pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; background:#f2f2f2;">
                Address
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                <?php if(!empty($values['address'])){echo $values['address'];}',';if(!empty($values['city'])){echo $values['city'];}',';if(!empty($values['state'])){echo $values['state'];}',';if(!empty($country_name->name)){echo $country_name->name;}',';if(!empty($values['zipcode'])){echo $values['zipcode'];}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; ">
                Project address
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php if(!empty($values['address_other'])){echo $values['address_other'];}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; background:#f2f2f2;">
                Room Type
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                <?php if($quotation_room_type[$l]!=''){ echo $quotation_room_type[$l];} else {echo "NA";}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; ">
                Room Rate Per Night
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; font-size:13px;; font-weight: bold;">
                <?php if(!empty($quotation_tax[$l])){$room_rate =$quotation_tax[$l]/100*($quotation_rate[$l])+$quotation_rate[$l];echo round($room_rate,2); }else{echo  $quotation_rate[$l];};?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt;  background:#f2f2f2; ">
                Taxes
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                <?php if($quotation_tax[$l]!=''){ echo 'Included';} else {echo "NA";}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt;  ">
                Breakfast
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; ">
                <?php if($quotation_breakfast[$l]=='1'){ echo 'Included';} if($quotation_breakfast[$l]=='0') {echo "Excluded";}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; background:#f2f2f2;">
                Internet/Wi-Fi
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                <?php if($quotation_wifi[$l]=='1'){ echo  'Included';} if($quotation_wifi[$l]=='0') {echo "Excluded";}?>
            </td>
        </tr>
        <tr>
            <td nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; ">
                Cancellation/Amendment Policy
            </td>
            <td valign="top" style="width:209pt; margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;">
                <?php if(!empty($quotation_cancellation[$l])){echo $quotation_cancellation[$l];}else{echo 'NA';}?>
            </td>
        </tr>
        <tr style="height:15pt">
            <td width="270" nowrap="" colspan="2" style="margin:0;padding-top: 3px; padding-bottom: 3px; padding-left: 3px; padding-right: 3px;width:202.25pt; background:#f2f2f2;">
                NOTE :
            </td>
            <td width="279" nowrap="" valign="bottom" style="margin:0;padding-top: 3px; padding-bottom: 3px; font-size:13px; font-weight: bold; padding-left: 3px; padding-right: 3px;width:209pt; background:#f2f2f2;">
                Early check in & Late checkout subject to room availability as per hotel policy
            </td>
        </tr>
        </tbody>
    </table>




    <div style="padding-top: 5px;"></div>
    <?php $j++;$l++;}?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
