<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';

foreach ($dailyReports as $key => $dailyReportData) {
	$dailyReportHtml = '';
	$i = 1;
	foreach ($dailyReportData as $dailyReport) {
		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $dailyReport['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDeptNameQuery = $this->db->query('SELECT dept_name FROM `department` WHERE dept_no = ' . $dailyReport['dept_no'] . '');
		$getDeptName = $getDeptNameQuery->row();

		$dailyReportHtml .= '<tr>
            <td>' . $i . '</td>
            <td>' . $dailyReport['ack_no'] . '</td>
            <td>' . $dailyReport['name'] . '</td>
            <td>' . $appType->app_type . '</td>
            </tr>';
		$i++;
	}

	$html[$key] = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>CAMS</title>
                    <style>
                    .infoTable td {
                        padding: 5px;
                    }
                    </style>
                </head>
                <body>
                    <h2 style="text-align:center;">Computerized Application Monitoring System</h2>
                    <h3 style="text-align:center;color:#800000">UT ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN DIU</h3>
                    <p style="text-align:center;"><b>DAILY REPORT for : </b>' . date("d-m-Y", strtotime($date)) . '</p>

                    <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                        <tr>
                            <td colspan="4" style="text-align:center"><b>Applications received on behalf of ' . $getDeptName->dept_name . '</b></td>
                        </tr>
                        <tr>
                            <td><b>Sr. No.</b></td>
                            <td><b>ACK No.</b></td>
                            <td><b>Applicant Name</b></td>
                            <td><b>Nature of Application</b></td>
                        </tr>' . $dailyReportHtml . '</table>
                    <p style="text-align:center;font-weight:bold">Total Applications Received are : ' . ($i - 1) . '</p>
                    <br>

                    <table style="width:100%;">
                        <tr>
                            <td><b>PRO, CAMS<b></td>
                            <td style="text-align:right;"><b>Receivers Signature</b></td>
                        </tr>
                    </table>
                </body>
                </html>';
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('{DATE j-m-Y}||Page No. {PAGENO}');

foreach ($dailyReports as $key => $dailyReportData) {
	$mpdf->AddPage();
	$mpdf->WriteHTML($html[$key]);
}

$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
