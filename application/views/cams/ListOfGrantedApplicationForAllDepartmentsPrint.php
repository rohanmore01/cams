<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';

foreach ($grantedApplications as $key => $grantedApplicationsData) {
	$grantedApplicationHtml = '';
	$i = 1;
	foreach ($grantedApplicationsData as $grantedApplication) {
		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $grantedApplication['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDeptNameQuery = $this->db->query('SELECT dept_name FROM `department` WHERE dept_no = ' . $grantedApplication['dept_no'] . '');
		$getDeptName = $getDeptNameQuery->row();

		$grantedApplicationHtml .= '<tr>
            <td>' . $i . '</td>
            <td>' . $grantedApplication['ack_no'] . '</td>
            <td>' . $grantedApplication['name'] . '</td>
            <td>' . $appType->app_type . '</td>
            <td>' . date("d-m-Y", strtotime($grantedApplication['date'])) . '</td>
            <td>' . date("d-m-Y", strtotime($grantedApplication['grant_date'])) . '</td>
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
                    <p style="text-align:center;font-weight:bold;">List of Granted Application Department Wise</p>
                    <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                        <tr>
                            <td  colspan="6" style="text-align:center;"><b>Department : ' . $getDeptName->dept_name . '</b></td>
                        </tr>
                        <tr>
                            <td><b>Sr.No</td>
                            <td><b>ACK No.</td>
                            <td><b>Applicant Name</b></td>
                            <td><b>Application Type</b></td>
                            <td><b>App. Date</b></td>
                            <td><b>Grant Date</b></td>
                        </tr>' . $grantedApplicationHtml . '</table>
                        <p style="text-align:center;font-weight:bold">Total Granted Application : ' . ($i - 1) . '</p>
                </body>
                </html>';
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('Report Date: {DATE j-m-Y}||Page No. {PAGENO}');

foreach ($grantedApplications as $key => $grantedApplicationsData) {
	$mpdf->AddPage();
	$mpdf->WriteHTML($html[$key]);
}

$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
