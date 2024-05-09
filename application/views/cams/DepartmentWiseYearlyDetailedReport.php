<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';


if(!empty($deptWiseYearlyDetailedReport))
{
    foreach ($deptWiseYearlyDetailedReport as $deptNo => $deptWiseYearlyDetailed) 
    {
       
        $db = $this->load->database();
        $getDepartmentQuery = $this->db->query('SELECT dept_name FROM `department` WHERE `dept_no` = '.$deptNo.'');
        $department = $getDepartmentQuery->row();

        $deptWiseYearlyDetailedHtml='';
        $totalSumApplication = 0;
        $totalSumGrantedApplication = 0;
        $totalSumRejectedApplication = 0;
        $totalSumPendingApplication = 0;

        foreach ($deptWiseYearlyDetailed as $year => $deptWiseYearlyDetailedData) 
        {
            $grantedStatusCount = 0;
            $pendingStatusCount = 0;
            $rejectedStatusCount = 0;

            foreach ($deptWiseYearlyDetailedData as $value) 
            {
                if($value['status'] =='Granted')
                {
                    $grantedStatusCount = $value['status_count'];
                }
                if($value['status']  =='Pending')
                {
                    $pendingStatusCount = $value['status_count'];
                }
                if($value['status'] =='Rejected')
                {
                    $rejectedStatusCount = $value['status_count'];
                }
            }
    
            $deptWiseYearlyDetailedHtml .= '<tr>
                <td>'.$year.'</td>
                <td>'.($grantedStatusCount+$rejectedStatusCount+$pendingStatusCount).'</td>
                <td>'.$grantedStatusCount.'</td>
                <td>'.$rejectedStatusCount.'</td>
                <td>'.$pendingStatusCount.'</td>
                </tr>';

            $totalSumApplication =  $totalSumApplication + $grantedStatusCount+$rejectedStatusCount+$pendingStatusCount;
            $totalSumGrantedApplication = $totalSumGrantedApplication + $grantedStatusCount;
            $totalSumRejectedApplication = $totalSumRejectedApplication + $rejectedStatusCount;
            $totalSumPendingApplication = $totalSumPendingApplication + $pendingStatusCount;  
        }

        $tableHtml .= '<table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
        <tr>
            <td colspan="5" style="text-align:center;"><b>Department : '.$department->dept_name.'</b></td>
        </tr>
        <tr>
            <td><b>Year</b></td>
            <td><b>Total Application</b></td>
            <td><b>Total Granted</b></td>
            <td><b>Total Rejected</b></td>
            <td><b>Total Pending</b></td>
        </tr>'.$deptWiseYearlyDetailedHtml.'
        <tr>
        <td><b>Grand Total</b></td>
        <td>'.$totalSumApplication.'</td>
        <td>'.$totalSumGrantedApplication.'</td>
        <td>'.$totalSumRejectedApplication.'</td>
        <td>'.$totalSumPendingApplication.'</td>
        </tr>
        </table><br>';
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
                padding: 3px;
            }
            </style>
        </head>
        <body>
            <h2 style="text-align:center;">Computerized Application Monitoring System</h2>
            <h3 style="text-align:center;color:#800000">UT ADMINISTRATION OF DADRA & NAGAR HAVELI AND DAMAN DIU</h3>
            <p style="text-align:center;font-weight:bold;">Department Wise Summary Report</p>'
            .$tableHtml.'
        </body>
        </html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('Report Date : {DATE j-m-Y}||Page No. {PAGENO}');
$mpdf->WriteHTML($html);
$file = uniqid().'.pdf';
$mpdf->Output($file, 'I');
}
else
{
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->SetHeader('Report Date : {DATE j-m-Y}||Page No. {PAGENO}');
    $mpdf->WriteHTML('<h1 style="text-align:center;">No Record Found</h1>');
    $file = uniqid().'.pdf';
    $mpdf->Output($file, 'I');  
}
?>