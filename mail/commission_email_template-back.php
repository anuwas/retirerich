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
            padding: 8px;
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
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">

                  <img width="100px" src="<?php echo Yii::getAlias('@web').'/web/assets/admin/'?>img/template_logo.png"  alt="hexatravel"><br>
                 <a href="http://www.hexatravel.com/" target="_blank">www.hexatravel.com</a>
                                                            <h5 style="font-size:20px; color:#222; font-weight:500; padding:0; margin:0;">Commission Invoice</h5>
                                                        </div>

                                                        <table class="table table-bordered" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td>Invoice to</td>
                                                                <td><?php echo $invoice->booking->hotel->hotel_name;?></td>
                                                                <td>Invoice No</td>
                                                                <td><?php echo $model->invoice_no;?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Billing Address</td>
                                                                <td align="center">#N/A</td>
                                                                <td>Invoice Date</td>
                                                                <td><?php echo date('F d, Y',strtotime($model->bill_sent_date));?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>Billing Address 2</td>
                                                                <td align="center">#N/A</td>
                                                                <td>Invoice Due Date</td>
                                                                <td><?php
                                                                    $today=$model->bill_sent_date;
                                                                    $next_date= date('F d, Y', strtotime($today. ' + 14 days'));
                                                                    echo $next_date;
                                                                    ?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>GSTIN</td>
                                                                <td align="center">#N/A</td>
                                                                <td>PAN No</td>
                                                                <td><?php echo $invoice->booking->client->gst_number;?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Place of Supply &amp; State Code</td>
                                                                <td>#N/A</td>
                                                                <td>GSTIN</td>
                                                                <td><?php echo $invoice->booking->client->gst_number;?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Service Category</td>
                                                                <td>BUSINESS AUXILIARY SERVICE - COMMISSION</td>
                                                            </tr>
                                                            <tr >
                                                                <td >&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>SAC Code</td>
                                                                <td>00440225</td>
                                                            </tr>
                                                            <tr >
                                                                <td >Account Holder</td>
                                                                <td>Hexa Tours &amp; Travels Pvt Ltd</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr >
                                                                <td>Account No</td>
                                                                <td>10882560000730</td>
                                                                <td>GST Payable on reverse charges: </td>
                                                                <td>No</td>
                                                            </tr>
                                                            <tr >
                                                                <td >IFSC Code</td>
                                                                <td>HDFC0001088</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr >
                                                                <td >Bank Name</td>
                                                                <td>HDFC Bank,&nbsp; Behala Branch , Kolkata</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                        </tbody>
                                                        </table>
                                                        <h5 style="font-size:17px; color:#222; font-weight:500;">This Invoice has been raised against the following service -</h5>
                                                        <table class="table table-bordered" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Amount Details</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Service Type</td>
                                                                <td>COMMISSION ON HOTEL ROOM BOOKING</td>
                                                                <td>No Of Nights</td>
                                                                <td>#N/A</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Confirmation No</td>
                                                                <td><?php echo $model->confirmation_no;?></td>
                                                                <td>#N/A</td>
                                                                <td>#N/A</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>#N/A</td>
                                                                <td align="center">#N/A</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Guest Name</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Service Check In Date</td>
                                                                <td>#N/A</td>
                                                                <td>Commission (%)</td>
                                                                <td><?php echo $model->commission_rate;?>%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Service Check Out Date</td>
                                                                <td>#N/A</td>
                                                                <td>Commission (INR)</td>
                                                                <td><?php echo $model->commission;?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Net Invoice Value (INR)</td>
                                                                <td><?php echo $model->total;?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>#DIV/0!</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>#DIV/0!</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>#DIV/0!</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>Gross Invoice Value (INR)</td>
                                                                <td><?php echo $model->total;?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>(rounded off to nearest Rs.)</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr >
                                                                <td>Net Amt. Payable (INR) in word:</td>
                                                                <td colspan="3"> <?php
                                                                    $number = $model->total;
                                                                    $no = round($number);
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
                                                                    $points = ($point) ?
                                                                        "." . $words[$point / 10] . " " .
                                                                        $words[$point = $point % 10] : '';
                                                                    //echo $result . "Rupees  " . $points . " Paise";
                                                                    echo $result . "Rupees  ";
                                                                    ?></td>
                                                            </tr>
                                                            <tr >
                                                                <td>(Rupees&nbsp; Only)</td>
                                                                <td colspan="3">&nbsp;</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                        </tbody>
                                                        </table>

                                                        <h5 style="font-size:17px; color:#222; font-weight:500;">Payment Invoice before due date mentioned above</h5>


                                                        <ul>
                                                            <li style="list-style:none;">1) Cash should be paid only to the cashier against official receipt.</li>


                                                            <li style="list-style:none;">2) A/C Payee Cheques/DD should be in name of Hexa Tours &amp; Travels Pvt. Ltd.</li>


                                                            <li style="list-style:none;">3) For Cheque Receipts: Subject to realisation of Cheque and on an Agreement that no stop payment instructions will be given by purchaser at any time for any reason.</li>


                                                            <li style="list-style:none;">4) We reserve the right to charge interest @ 12% P.A. on over due Bills.</li>

                                                        </ul>
                                                        <p style="text-align:center;">*****This is a computer generated document and does not require a signature*****</p>
                                                        <div class="col-md-12 text-center">

                                                            <p style="font-size:15px; color:#222;">Hexa Tours &amp; Travels Private Limited<br>
                                                                Regd. Office: Diamond Heritage, Unit NO H605A, 16, Strand Road, Kolkata, West Bengal 700001<br>
                                                                CIN: U63040WB2012PTC184349</p>
                                                        </div>
                                                </div>
                                                    <!--Mail Template End-->

                                                    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
