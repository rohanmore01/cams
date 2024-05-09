<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';


if (!empty($getQueriedApplicants)) {
	$i = 1;
	foreach ($getQueriedApplicants as $QueriedApplicant) {
		$diff = strtotime($QueriedApplicant['query_date']) - strtotime($QueriedApplicant['date']);
		$noOfDays = abs(round($diff / 86400));

		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $QueriedApplicant['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDepartmentQuery = $this->db->query('SELECT dept_name FROM `department` WHERE `dept_no` = ' . $QueriedApplicant['dept_no'] . '');
		$department = $getDepartmentQuery->row();

		$queriedApplicantHtml .= '<tr>
                <td>' . $i . '</td>
                <td>' . $QueriedApplicant['ack_no'] . '<br>' . $QueriedApplicant['name'] . '</td>
                <td>' . $appType->app_type . '<br>' . $QueriedApplicant['remark'] . '</td>
                <td>' . date("d-m-Y", strtotime($QueriedApplicant['date'])) . '<br>' . date("d-m-Y", strtotime($QueriedApplicant['due_date'])) . '<br>' . date("d-m-Y", strtotime($QueriedApplicant['query_date'])) . '</td>
                <td>' . $noOfDays . '</td>
                </tr>';
		$i++;
	}

	$html = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CAMS</title>
            <style>
            .infoTable td {
                padding: 2px;
            }
            </style>
        </head>
        <body>
            <h2 style="text-align:center;">Computerized Application Monitoring System</h2>
            <h3 style="text-align:center;color:#800000">UT ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN DIU</h3>

            <table>
                <tr>
                    <td style="text-align:left;font-size:12px;width:53%">Department : ' . $department->dept_name . '</td>
                    <td style="text-align:center;font-weight:bold;font-size:15px;">List of Queried Applicants</td>
                    <td style="text-align:right"></td>
                </tr>
            </table>
            <br>
            <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                <tr>
                    <td><b>Sr.<br>No</b></td>
                    <td><b>ACK No /<br>Name of Applicant</b></td>
                    <td><b>Application For /<br>Remark</b></td>
                    <td><b>Application Date /<br>Due Date /<br>Query Date</b></td>
                    <td><b>No. of days <br>taken to <br>raise query</b></td>
                </tr>' . $queriedApplicantHtml . '
                </table>
                <p style="text-align:center;font-weight:bold">Total Queried Applicants : ' . ($i - 1) . '</p>
        </body>
        </html>';

	$mpdf = new \Mpdf\Mpdf();
	$mpdf->SetHeader('Report Date : {DATE j-m-Y}||Page No. {PAGENO}');
	$mpdf->WriteHTML($html);
	$file = uniqid() . '.pdf';
	$mpdf->Output($file, 'I');
} else {
	$mpdf = new \Mpdf\Mpdf();
	$mpdf->SetHeader('Report Date : {DATE j-m-Y}||Page No. {PAGENO}');
	$mpdf->WriteHTML('<h1 style="text-align:center;">No Record Found</h1>');
	$file = uniqid() . '.pdf';
	$mpdf->Output($file, 'I');
}
