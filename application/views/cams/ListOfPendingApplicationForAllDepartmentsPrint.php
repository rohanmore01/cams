<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';

foreach ($pendingApplications as $key => $pendingApplicationsData) {
	$pendingApplicationHtml = '';
	$i = 1;
	foreach ($pendingApplicationsData as $pendingApplication) {
		$diff = strtotime($todayDate) - strtotime($pendingApplication['due_date']);
		$noOfDays = round($diff / 86400);

		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $pendingApplication['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDeptNameQuery = $this->db->query('SELECT dept_name FROM `department` WHERE dept_no = ' . $pendingApplication['dept_no'] . '');
		$getDeptName = $getDeptNameQuery->row();

		$pendingApplicationHtml .= '<tr>
            <td>' . $i . '</td>
            <td>' . $pendingApplication['ack_no'] . '</td>
            <td>' . $pendingApplication['name'] . '<br>' . $appType->app_type . '</td>
            <td>' . date("d-m-Y", strtotime($pendingApplication['date'])) . '<br>' . date("d-m-Y", strtotime($pendingApplication['due_date'])) . '</td>
            <td>' . $noOfDays . '</td>
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
                    <p style="text-align:center;font-weight:bold">List Of Pending Applications</p>

                    <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                        <tr>
                            <td colspan=5 style="text-align:center;"><b>Department : ' . $getDeptName->dept_name . '</b></td>
                        </tr>
                        <tr>
                            <td><b>Sr.<br>No.</b></td>
                            <td><b>ACK.<br>No.</b></td>
                            <td><b>Applicant Name /<br>Applied For</b></td>
                            <td><b>Application Date /<br>Due Date</b></td>
                            <td><b>No. Of<br>Days</b></td>
                        </tr>' . $pendingApplicationHtml . '</table>
                        <p style="text-align:center;font-weight:bold">Total Pending Applications : ' . ($i - 1) . '</p>
                </body>
                </html>';
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('Report Date: {DATE j-m-Y}|From Date: ' . date("d-m-Y", strtotime($fromDate)) . ' - To Date: ' . date("d-m-Y", strtotime($toDate)) . '|Page No. {PAGENO}');

foreach ($pendingApplications as $key => $pendingApplicationsData) {
	$mpdf->AddPage();
	$mpdf->WriteHTML($html[$key]);
}

$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
