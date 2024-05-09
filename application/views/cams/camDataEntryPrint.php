<?php
ob_start();
require_once 'application/mpdf_library/autoload.php';

$db = $this->load->database();
$getDepartmentQuery = $this->db->query('SELECT dept_name FROM `department` WHERE `dept_no` = ' . $camDataEntry->dept_no . '');
$department = $getDepartmentQuery->row();

$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE `app_code` = ' . $camDataEntry->app_code . '');
$appType = $getAppTypeQuery->row();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <style>
    .infoTable td {
        padding: 10px;
    }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Computerized Application Monitoring System</h2>
    <h3 style="text-align:center;color:#800000">UT ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN DIU</h3>

    <table style="width:100%;">
    <tr>
        <td style="width:11%;">Date :</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->date)) . '</td>
        <td style="text-align:right;">Department Copy</td>
    </tr>
    <tr>
        <td>ACK No :</td>
        <td>' . $camDataEntry->ack_no . '</td>
        <td style="text-align:right;">(To be retained by the Department)</td>
    </tr>
    </table>
    <hr style="color:black">

    <table style="width:100%;border-collapse:collapse;" border="1" class="infoTable">
    <tr>
        <td style="font-weight:bold;width:17%">Name</td>
        <td>' . $camDataEntry->name . '</td>
        <td style="font-weight:bold;width:22%">Application Date</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->date)) . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Department</td>
        <td>' . $department->dept_name . '</td>
        <td style="font-weight:bold;width:22%">Due Date</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->due_date)) . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Applied For</td>
        <td colspan="3">' . $appType->app_type . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Address</td>
        <td colspan="3">' . $camDataEntry->address . '</td>
    </tr>
    </table>
    <br>
    <br>
    <table style="width:100%;">
        <tr>
            <td><b>PRO, CAMS<b></td>
            <td style="text-align:right;">Designed at NIC, Silvassa</td>
        </tr>
    </table>
    <br>
    <br>
    --------------------------------------------------------------------------------------------------------------------------------------------------------

    <h2 style="text-align:center;">Computerized Application Monitoring System</h2>
    <h3 style="text-align:center;color:#800000">UT ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN DIU</h3>

    <table style="width:100%;">
    <tr>
        <td style="width:11%;">Date :</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->date)) . '</td>
        <td style="text-align:right;">Applicant Copy</td>
    </tr>
    <tr>
        <td>ACK No :</td>
        <td>' . $camDataEntry->ack_no . '</td>
    </tr>
    </table>
    <hr style="color:black">

    <table style="width:100%;border-collapse:collapse;" border="1" class="infoTable">
    <tr>
        <td style="font-weight:bold;width:17%">Name</td>
        <td>' . $camDataEntry->name . '</td>
        <td style="font-weight:bold;width:22%">Application Date</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->date)) . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Department</td>
        <td>' . $department->dept_name . '</td>
        <td style="font-weight:bold;width:22%">Due Date</td>
        <td>' . date("d-m-Y", strtotime($camDataEntry->due_date)) . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Applied For</td>
        <td colspan="3">' . $appType->app_type . '</td>
    </tr>
    <tr>
        <td style="font-weight:bold;width:17%">Address</td>
        <td colspan="3">' . $camDataEntry->address . '</td>
    </tr>
    </table>
    <br>
    Note:
    <ol>
    <li>The Status of your application shall be indicated on the notice.</li>
    <li>Working Hours: 10:00 AM - 4:00 PM (Monday to Friday)</li>
    </ol>
    <br>
    <table style="width:100%;">
    <tr>
        <td><b>PRO, CAMS<b></td>
        <td style="text-align:right"><img src="' . base_url() . 'application/uploads/beti-bachao.png" alt=""  width="50" height="50"></td>
    </tr>
    </table>
    <br>
    <table style="width:100%;">
    <tr>
        <td style="font-size:12px;"><b>Please contact us at TollFree No. 1800-2334003 for status Inquiry<b></td>
        <td style="text-align:right">Designed at NIC, Silvassa</td>
    </tr>
    </table>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
