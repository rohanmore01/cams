<?php
ob_start();
ini_set("pcre.backtrack_limit", "5000000");
require_once 'application/mpdf_library/autoload.php';


if(!empty($yearlyDepartmentDetailedReport))
{
    foreach ($yearlyDepartmentDetailedReport as $year => $yearlyDepartmentDetailed) 
    {
        $yearlyDepartmentDetailedHtml = '';

        foreach ($yearlyDepartmentDetailed as $deptNo => $yearlyDepartmentDetailedData) 
        {
            $db = $this->load->database();
            $getDepartmentQuery = $this->db->query('SELECT dept_name FROM `department` WHERE `dept_no` = '.$deptNo.'');
            $department = $getDepartmentQuery->row();
            
            $grantedStatusCount = 0;
            $pendingStatusCount = 0;
            $rejectedStatusCount = 0;

            foreach ($yearlyDepartmentDetailedData as $value) 
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
    
            $yearlyDepartmentDetailedHtml .= '<tr>
                <td>'.$department->dept_name.'</td>
                <td>'.($grantedStatusCount+$rejectedStatusCount+$pendingStatusCount).'</td>
                <td>'.$grantedStatusCount.'</td>
                <td>'.$rejectedStatusCount.'</td>
                <td>'.$pendingStatusCount.'</td>
                </tr>';
        }

        $tableHtml .= '<table style="width:100%;border-collapse:collapsed" border=1 class="infoTable">
        <tr>
            <td colspan="5" style="text-align:center;"><b>Year : '.$year.'</b></td>
        </tr>
        <tr>
            <td><b>Department Name</b></td>
            <td><b>Total Application</b></td>
            <td><b>Total Granted</b></td>
            <td><b>Total Rejected</b></td>
            <td><b>Total Pending</b></td>
        </tr>'.$yearlyDepartmentDetailedHtml.'
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
            <p style="text-align:center;font-weight:bold;">Yearly Summary Report</p>'
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