<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';

foreach ($rejectedApplications as $key => $rejectedApplicationsData) {
	$rejectedApplicationHtml = '';
	$i = 1;
	foreach ($rejectedApplicationsData as $rejectedApplication) {
		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $rejectedApplication['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDeptNameQuery = $this->db->query('SELECT dept_name FROM `department` WHERE dept_no = ' . $rejectedApplication['dept_no'] . '');
		$getDeptName = $getDeptNameQuery->row();

		$rejectedApplicationHtml .= '<tr>
            <td>' . $i . '<br>' . $rejectedApplication['ack_no'] . '</td>
            <td>' . $rejectedApplication['name'] . '<br>' . $appType->app_type . '</td>
            <td>' . $rejectedApplication['remark'] . '</td>
            <td>' . date("d-m-Y", strtotime($rejectedApplication['date'])) . '<br>' . date("d-m-Y", strtotime($rejectedApplication['due_date'])) . '</td>
            <td>' . date("d-m-Y", strtotime($rejectedApplication['rejected_date'])) . '</td>
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
                    <p style="text-align:center;font-weight:bold;">List of Rejected Application Department Wise</p>
                    <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                        <tr>
                            <td  colspan="5" style="text-align:center;"><b>Department : ' . $getDeptName->dept_name . '</b></td>
                        </tr>
                        <tr>
                            <td><b>Sr. No. /<br>ACK No.</b></td>
                            <td><b>Applicant Name /<br>Applied For</b></td>
                            <td><b>Reason</b></td>
                            <td><b>Application Date /<br>Due Date</b></td>
                            <td><b>Rejection <br>Date</b></td>
                        </tr>' . $rejectedApplicationHtml . '</table>
                        <p style="text-align:center;font-weight:bold">Total Rejected Application : ' . ($i - 1) . '</p>
                </body>
                </html>';
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('Report Date: {DATE j-m-Y}||Page No. {PAGENO}');

foreach ($rejectedApplications as $key => $rejectedApplicationsData) {
	$mpdf->AddPage();
	$mpdf->WriteHTML($html[$key]);
}

$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
