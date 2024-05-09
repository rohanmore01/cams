<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Cams';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "cams/login";
$route['camDataEntry'] = "cams/camDataEntry";
$route['logout'] = "cams/logout";
$route['about'] = "cams/about";
$route['camDataEntryDetail/(:num)'] = "cams/camDataEntryDetail/$1";
$route['camDataEntryEdit/(:num)'] = "cams/camDataEntryEdit/$1";
$route['camDataEntryDelete/(:num)'] = "cams/camDataEntryDelete/$1";
$route['ChangeCurrentPassword'] = "cams/ChangeCurrentPassword";
$route['CreateNewUser'] = "cams/CreateNewUser";
$route['UsersList'] = "cams/UsersList";
$route['EditUser/(:num)'] = "cams/EditUser/$1";
$route['DeleteUser/(:num)'] = "cams/DeleteUser/$1";
$route['DepartmentMaster'] = "cams/DepartmentMaster";
$route['AddDepartment'] = "cams/AddDepartment";
$route['EditDepartment/(:num)'] = "cams/EditDepartment/$1";
$route['DeleteDepartment/(:num)'] = "cams/DeleteDepartment/$1";
$route['ApplicationTypes'] = "cams/ApplicationTypes";
$route['AddApplicationType'] = "cams/AddApplicationType";
$route['EditApplicationType/(:num)'] = "cams/EditApplicationType/$1";
$route['DeleteApplicationType/(:num)'] = "cams/DeleteApplicationType/$1";
$route['getCamsDueDate'] = "cams/getCamsDueDate";
$route['camDataEntryPrint/(:num)'] = "cams/camDataEntryPrint/$1";
$route['camDataEntryDepartmentCopyPrint/(:num)'] = "cams/camDataEntryDepartmentCopyPrint/$1";
$route['DailyReport'] = "cams/DailyReport";
$route['DailyReportPrint'] = "cams/DailyReportPrint";
$route['ListOfQueriedApplicants'] = "cams/ListOfQueriedApplicants";
$route['ListOfQueriedApplicantsPrint'] = "cams/ListOfQueriedApplicantsPrint";
$route['ListOfRejectedApplicationDepartmentwise'] = "cams/ListOfRejectedApplicationDepartmentwise";
$route['ListOfRejectedApplicationDepartmentwisePrint'] = "cams/ListOfRejectedApplicationDepartmentwisePrint";
$route['ListOfPendingApplicationForAllDepartments'] = "cams/ListOfPendingApplicationForAllDepartments";
$route['ListOfPendingApplicationForAllDepartmentsPrint'] = "cams/ListOfPendingApplicationForAllDepartmentsPrint";
$route['ListOfGrantedApplicationForAllDepartments'] = "cams/ListOfGrantedApplicationForAllDepartments";
$route['ListOfGrantedApplicationForAllDepartmentsPrint'] = "cams/ListOfGrantedApplicationForAllDepartmentsPrint";
$route['DepartmentWiseYearlyDetailedReport'] = "cams/DepartmentWiseYearlyDetailedReport";
$route['YearlyDepartmentDetailedReport'] = "cams/YearlyDepartmentDetailedReport";
$route['GeneralInformationDepartmentWise'] = "cams/GeneralInformationDepartmentWise";
$route['GeneralInformationDepartmentWisePrint'] = "cams/GeneralInformationDepartmentWisePrint";
$route['get_ajax_applicants'] = "cams/get_ajax_applicants";
$route['searchByAckNo'] = "cams/searchByAckNo";