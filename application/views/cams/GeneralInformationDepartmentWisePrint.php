<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';

foreach ($generalInfoDeptWise as $key => $generalInfoDeptWiseData) {
	$generalInfoDeptWiseHtml = '';
	$i = 1;
	foreach ($generalInfoDeptWiseData as $generalInfoDept) {
		$db = $this->load->database();
		$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $generalInfoDept['app_code'] . '');
		$appType = $getAppTypeQuery->row();

		$getDeptNameQuery = $this->db->query('SELECT dept_name FROM `department` WHERE dept_no = ' . $generalInfoDept['dept_no'] . '');
		$getDeptName = $getDeptNameQuery->row();

		$generalInfoDeptWiseHtml .= '<tr>
            <td>' . $i . '</td>
            <td>' . $generalInfoDept['ack_no'] . '</td>
            <td>' . $generalInfoDept['date'] . '</td>
            <td>' . $generalInfoDept['due_date'] . '</td>
            <td>' . $generalInfoDept['query_date'] . '</td>
            <td>' . $generalInfoDept['grant_date'] . '</td>
            <td>' . $generalInfoDept['rejected_date'] . '</td>
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
                    <p style="text-align:center;font-weight:bold;">General Information About All Applications</p>

                    <table style="width:100%;">
                        <tr>
                            <td style="text-align:left;"><b>Department : ' . $getDeptName->dept_name . '</b></td>
                            <td style="text-align:right;"><b>Application Type : ' . $appType->app_type . '</b></td>
                        </tr>
                    </table>
                    <br>

                    <table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
                        <tr>
                            <td><b>Sr.No</td>
                            <td><b>ACK No.</td>
                            <td><b>App. Date</b></td>
                            <td><b>Due Date</b></td>
                            <td><b>Query Date</b></td>
                            <td><b>Grant Date</b></td>
                            <td><b>Rejected Date</b></td>
                        </tr>' . $generalInfoDeptWiseHtml . '</table>
                        <p style="text-align:center;font-weight:bold">Total Applications For ' . $appType->app_type . ' : ' . ($i - 1) . '</p>
                </body>
                </html>';
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('Report Date: {DATE j-m-Y}||Page No. {PAGENO}');

foreach ($generalInfoDeptWise as $key => $generalInfoDeptWiseData) {
	$mpdf->AddPage();
	$mpdf->WriteHTML($html[$key]);
}

$file = uniqid() . '.pdf';
$mpdf->Output($file, 'I');
