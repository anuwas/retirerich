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
            padding: 5px;
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
        .clearfix{clear:both;}
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Mail Template Start -->
<div class="row">
    <div style="text-align: center;background: white;width: auto;">
        <img width="100px" src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/template_logo.png"  alt="hexatravel"><br>
        <a href="http://www.hexatravel.com/" target="_blank">www.hexatravel.com</a>
    </div>
    <div class="clearfix"></div>
    <div style="border:2px solid #000; padding:5px;">
        <h5 style="font-size:20px; color:#f00; font-weight:700;">ATTENTION HOTEL:</h5>
        <ul>
            <li style="list-style:none;">1) This booking is already prepaid.</li>


            <li style="list-style:none;">2) Do not charge the guest under any circumstances for the below mentioned inclusions.</li>


            <li style="list-style:none;">3) GUESTS WILL BE RESPONSIBLE FOR INCIDENTALS CHARGES OR ANY EXTRA SERVICES TAKEN ONLY DURING THE STAY.</li>
        </ul>
    </div>
    <br><br>
    <h5 style="font-size:20px; color:#222; font-weight:bold; padding:0; margin:0; text-align:center;">Hotel Confirmation Voucher</h5>		<br>
    <table class="table table-bordered" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td colspan="2" style="background:#025298; font-weight:400; font-size:22px; color:#fff; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Guest Confirmation Details:</td>
        </tr>
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Guest Name&nbsp; :</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;"><?php if(!empty($model->guest_name)){echo $model->salutation.'. '.$model->guest_name;}?></td>
        </tr>
        <tr>
            <td style="background:#f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Confirmation No :</td>
            <td style="background:#f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: 700;"><?php echo $model->confirmation;?></td>
        </tr>
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Check In Date :<br /></td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;"><?php echo date('F d, Y',strtotime($model->check_in));?></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Check-In Time:<br />
            </td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;">3 PM</td>
        </tr>
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Check_Out Date :<br /></td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;"><?php echo date('F d, Y',strtotime($model->check_out));?></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Check-Out Time :<br />
            </td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;">12 Noon</td>
        </tr>

        <tr >
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Room Type :</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $model->room_type;?></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Rate Inclusions:</td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $model->rate_inclusions;?></td>
        </tr>
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Total No. of Nights:</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $model->no_of_night;?></td>
        </tr>

        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Cancellation Policy:</td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; color: #f00; font-size: 16px; font-weight: bold;"><?php echo $model->cancellation_policy;?></td>
        </tr>
        <tr>
            <td colspan="2" style="background:#025298; font-weight:600; font-size:25px; color: #fff;">&nbsp;</td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hotel Name :</td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px; font-size: 15px; font-weight: bold;"><?php echo $hotel->hotel_name;?></td>
        </tr>
        <tr >
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hotel Address :</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php if(!empty($hotel->address)){echo $hotel->address;',' ;}if(!empty($hotel->address_other)){echo $hotel->address_other; ',' ;} if(!empty($hotel->city)){echo $hotel->city;',';} if($hotel->zipcode){echo $hotel->zipcode;',';} if(!empty($hotel->state)){echo $hotel->state;',';} if(!empty($hotel->countries0->name)) {echo $hotel->countries0->name;}?></td>
        </tr>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hotel Amenities :</td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $hotel->amenities;?></td>
        </tr>
        <tr >
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hotel Contact No:</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $hotel->contact_number;?></td>
        </tr>
        <?php if(!empty($hotel->remark)){?>
            <tr >
                <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hotel Remark:</td>
                <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><?php echo $hotel->remark;?></td>
            </tr>
        <?php } ?>
        <tr>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Emergency Contact:</td>
            <td style="background: #f2f2f2; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Hexa Travel , Mobile No : +91-8584069800</td>
        </tr>
        <tr>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">Note:</td>
            <td style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;">For security purposes, Hotel will be asked to provide a valid government or state- issued photo ID at check-in.</td>
        </tr>
        </tbody>
    </table>
    <h4 style="font-size:15px; color:#015197; font-weight:600; text-align:center;">Phone No: +913340046588 /+918584069800 Mail Id: info@hexatravel.com</h4>
</div>
<!--Mail Template End-->
                                                    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
