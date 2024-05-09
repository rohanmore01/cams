<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cams extends CI_Controller {
 
  public function __construct() 
  {
    parent::__construct(); 
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('Cams_model', 'cams');
  }

  public function index()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['applications'] = $this->cams->get_all_applications();
      
      $this->load->view('layout/header');
      $this->load->view('cams/index.php', $data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }   
  }

  public function login()
  {
   
    if($this->input->post('submit-login-form'))
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $district = $this->input->post('district');

      $check_login = $this->cams->checkLogin($email, $password, $district);

      if($check_login->num_rows() > 0) 
      { 
        $userData = $check_login->result_array();

        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('email', $email);
        $this->session->set_userdata('district', $district);
        $this->session->set_userdata('user_type', $userData[0]['user_type']);
        $this->session->set_flashdata('msg', 'Login Done Sucessfully');
        redirect(base_url());
      } 
      else 
      {
        $this->session->set_userdata('logged_in', false);
        $this->session->set_flashdata('msg', 'Invalid Login Credentials');
        redirect(base_url().'login');            
      }
    }

    $this->load->view('layout/header');
    $this->load->view('cams/login.php');
    $this->load->view('layout/footer');
  }

  public function camDataEntry()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['departments'] = $this->cams->get_department();
      $data['app_types'] = $this->cams->get_app_type();
      $data['last_ack_no'] = $this->cams->get_last_ack_no();

      if($this->input->post('submit-cam-data-entry-form'))
      {
        $this->cams->store();
        $this->session->set_flashdata('msg', "Entry Saved Successfully");
        redirect(base_url());
      }

      $this->load->view('layout/header');
      $this->load->view('cams/camDataEntry.php', $data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }  
  }

  public function about()
  { 
    $this->load->view('layout/header');
    $this->load->view('cams/about.php');
    $this->load->view('layout/footer');
  }

  public function logout() 
  {
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('user_type');
    $this->session->unset_userdata('district');
    $this->session->set_flashdata('msg', 'Logout Done Successfully');
    redirect(base_url().'login');
  }

  public function camDataEntryEdit($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['camDataEntry'] = $this->cams->get($id);
      $data['departments'] = $this->cams->get_department();
      $data['app_types'] = $this->cams->get_app_type();

      if($this->input->post('submit-cam-data-edit-form'))
      {
        $this->cams->update($id);
        $this->session->set_flashdata('msg', "Entry Updated Successfully");
        redirect(base_url());
      }

      $this->load->view('layout/header');
      $this->load->view('cams/camDataEntryEdit.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function camDataEntryDelete($id) 
  {
    $this->cams->delete($id);
    $this->session->set_flashdata('msg', "Entry Deleted Successfully");
    redirect(base_url());
  }

  public function ChangeCurrentPassword() 
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if(isset($_POST['submit-change-password-form']))
      {
        $email = $this->session->userdata('email');
        $this->cams->change_password($email);
        $this->session->set_flashdata('msg', "Password Changed Successfully");
        redirect(base_url());
      }
      $this->load->view('layout/header');
      $this->load->view('cams/ChangeCurrentPassword.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function CreateNewUser()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if(isset($_POST['submit-create-user-form']))
      {
        $this->cams->create_new_user();
        $this->session->set_flashdata('msg', "User Created Successfully");
        redirect(base_url().'UsersList');
      }
  
      $this->load->view('layout/header');
      $this->load->view('cams/CreateNewUser.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function UsersList()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['users_list'] = $this->cams->get_users_list();

      $this->load->view('layout/header');
      $this->load->view('cams/UsersList.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function EditUser($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['get_user_data'] = $this->cams->get_user_data($id);
    
      if($this->input->post('submit-edit-user-form'))
      {
        $this->cams->update_user($id);
        $this->session->set_flashdata('msg', "User Updated Successfully");
        redirect(base_url().'UsersList');
      }

      $this->load->view('layout/header');
      $this->load->view('cams/editUser.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DeleteUser($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->cams->delete_user($id);
      $this->session->set_flashdata('msg', "User Deleted Successfully");
      redirect(base_url().'UsersList');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DepartmentMaster()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['departments_list'] = $this->cams->get_departments_list();

      $this->load->view('layout/header');
      $this->load->view('cams/DepartmentMaster.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function AddDepartment()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-department-add-form'))
      {
        $this->cams->add_department();
        $this->session->set_flashdata('msg', "Department Added Successfully");
        redirect(base_url().'DepartmentMaster');
      }

      $data['last_department_no'] = $this->cams->get_last_department_no();
      $this->load->view('layout/header');
      $this->load->view('cams/AddDepartment.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function EditDepartment($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-department-edit-form'))
      {
        $this->cams->update_department($id);
        $this->session->set_flashdata('msg', "Department Updated Successfully");
        redirect(base_url().'DepartmentMaster');
      }

      $data['get_department_data'] = $this->cams->get_department_data($id);
      $this->load->view('layout/header');
      $this->load->view('cams/EditDepartment.php', $data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DeleteDepartment($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->cams->delete_department($id);
      $this->session->set_flashdata('msg', "Department Deleted Successfully");
      redirect(base_url().'DepartmentMaster');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ApplicationTypes()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['application_types'] = $this->cams->get_application_types();

      $this->load->view('layout/header');
      $this->load->view('cams/ApplicationTypes.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function AddApplicationType()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-add-application-type-form'))
      {
        $this->cams->add_application_type();
        $this->session->set_flashdata('msg', "Application Type Added Successfully");
        redirect(base_url().'ApplicationTypes');
      }

      $data['last_app_code'] = $this->cams->get_last_app_code();
      $data['departments'] = $this->cams->get_department();
      $this->load->view('layout/header');
      $this->load->view('cams/AddApplicationType.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function EditApplicationType($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-edit-application-type-form'))
      {
        $this->cams->update_app_type($id);
        $this->session->set_flashdata('msg', "Application Type Updated Successfully");
        redirect(base_url().'ApplicationTypes');
      }

      $data['get_app_type_data'] = $this->cams->get_app_type_data($id);
      $data['departments'] = $this->cams->get_department();
      $this->load->view('layout/header');
      $this->load->view('cams/EditApplicationType.php', $data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DeleteApplicationType($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->cams->delete_application_type($id);
      $this->session->set_flashdata('msg', "Application Type Deleted Successfully");
      redirect(base_url().'ApplicationTypes');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function getCamsDueDate()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $appType = $this->input->post('appType');
      $department = $this->input->post('department');
      $numberOfDays = $this->cams->get_app_type_data($appType,$department);
      $todayDate = date("Y-m-d");

      $plusDateTimeStamp = strtotime("+$numberOfDays->no_days day", strtotime($todayDate));
      $endDate = date("Y-m-d", $plusDateTimeStamp);

      $start = new DateTime($todayDate);
      $end = new DateTime($endDate);
      $days = $start->diff($end, true)->days;

      $sundayCount = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
      $saturdayCount = intval($days / 6) + ($start->format('N') + $days % 6 >= 6);

      $sundaySaturdayCount = $sundayCount + $saturdayCount;

      $finalEndDate = strtotime("$sundaySaturdayCount day", strtotime($endDate));
      $finalEndDate = date("Y-m-d", $finalEndDate);
      $finalEndDate = strtotime("-1 day", strtotime($finalEndDate));
      echo date("Y-m-d", $finalEndDate);
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function camDataEntryPrint($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['camDataEntry'] = $this->cams->get($id);
      $this->load->view('layout/header');
      $this->load->view('cams/camDataEntryPrint.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function camDataEntryDepartmentCopyPrint($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['camDataEntry'] = $this->cams->get($id);
      $this->load->view('layout/header');
      $this->load->view('cams/camDataEntryDepartmentCopyPrint.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DailyReport()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->load->view('layout/header');
      $this->load->view('cams/DailyReport.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DailyReportPrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-daily-report-form'))
      {
        $data['date'] = $this->input->post('date');
        $dailyReportData = $this->cams->get_daily_report($data['date']);
        
        $data['dailyReports'] = $this->group_by('dept_no', $dailyReportData);
        
        $this->load->view('layout/header');
        $this->load->view('cams/DailyReportPrint.php',$data);
        $this->load->view('layout/footer');
      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfQueriedApplicants()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['departments'] = $this->cams->get_department();
      $this->load->view('layout/header');
      $this->load->view('cams/ListOfQueriedApplicants.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfQueriedApplicantsPrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-list-of-queried-applicants-form'))
      {
        $department = $this->input->post('department');
        $data['getQueriedApplicants'] = $this->cams->get_queried_applicants($department);
        
        $this->load->view('layout/header');
        $this->load->view('cams/ListOfQueriedApplicantsPrint.php', $data);
        $this->load->view('layout/footer');
      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfRejectedApplicationDepartmentwise()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->load->view('layout/header');
      $this->load->view('cams/ListOfRejectedApplicationDepartmentwise.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfRejectedApplicationDepartmentwisePrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-list-of-rejected-application-form'))
      {
        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');
        $rejectedApplication = $this->cams->get_rejected_applicants($fromDate, $toDate);
        $data['rejectedApplications'] = $this->group_by('dept_no', $rejectedApplication);

        $this->load->view('layout/header');
        $this->load->view('cams/ListOfRejectedApplicationDepartmentwisePrint.php',$data);
        $this->load->view('layout/footer');

      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function group_by($key, $data) 
  {
    $result = array();
    foreach($data as $val) 
    {
      (array)$val;
      $val = (array) $val;
      if(array_key_exists($key, $val)){
      
          $result[$val[$key]][] = $val;
      }else{
          $result[""][] = $val;
      }
    } 
    return $result;
  }

  public function ListOfPendingApplicationForAllDepartments()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->load->view('layout/header');
      $this->load->view('cams/ListOfPendingApplicationForAllDepartments.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfPendingApplicationForAllDepartmentsPrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-list-of-pending-application-form'))
      {
        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');
        $pendingApplication = $this->cams->get_pending_applicants($fromDate, $toDate);
        $data['pendingApplications'] = $this->group_by('dept_no', $pendingApplication);
        $data['fromDate'] = $fromDate;
        $data['toDate'] = $toDate;
        $data['todayDate'] = date('Y-m-d');
        
        $this->load->view('layout/header');
        $this->load->view('cams/ListOfPendingApplicationForAllDepartmentsPrint.php',$data);
        $this->load->view('layout/footer');

      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfGrantedApplicationForAllDepartments()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $this->load->view('layout/header');
      $this->load->view('cams/ListOfGrantedApplicationForAllDepartments.php');
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function ListOfGrantedApplicationForAllDepartmentsPrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-list-of-granted-application-form'))
      {
        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');
        $grantedApplication = $this->cams->get_granted_applicants($fromDate, $toDate);
        $data['grantedApplications'] = $this->group_by('dept_no', $grantedApplication);
        
        $this->load->view('layout/header');
        $this->load->view('cams/ListOfGrantedApplicationForAllDepartmentsPrint.php',$data);
        $this->load->view('layout/footer');

      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function DepartmentWiseYearlyDetailedReport()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $deptWiseYearlyDetailedReport = $this->cams->dept_wise_yearly_detailed_report();
      $data['deptWiseYearlyDetailedReport'] = $this->group_by('dept_no', $deptWiseYearlyDetailedReport);
      
      
        $result = array();
        foreach($data['deptWiseYearlyDetailedReport'] as $dept => $deptWiseYearlyDetailedReportData) 
        {
            foreach ($deptWiseYearlyDetailedReportData as $val) 
            {
              (array)$val;
              $val = (array) $val;
              if(array_key_exists('year', $val))
              {
              
                  $result[$dept][$val['year']][] = $val;
              }
              else
              {
                  $result[$dept][""][] = $val;
              }
            }     
        }
        
      $data['deptWiseYearlyDetailedReport'] = $result;

      $this->load->view('layout/header');
      $this->load->view('cams/DepartmentWiseYearlyDetailedReport.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function YearlyDepartmentDetailedReport()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $yearlyDepartmentDetailedReport = $this->cams->dept_wise_yearly_detailed_report();
      $data['yearlyDepartmentDetailedReport'] = $this->group_by('year', $yearlyDepartmentDetailedReport);

      $result = array();
      foreach($data['yearlyDepartmentDetailedReport'] as $year => $yearlyDepartmentDetailedReportData) 
      {
          foreach ($yearlyDepartmentDetailedReportData as $val) 
          {
            (array)$val;
            $val = (array) $val;
            if(array_key_exists('dept_no', $val))
            {
            
                $result[$year][$val['dept_no']][] = $val;
            }
            else
            {
                $result[$year][""][] = $val;
            }
          }     
      }        
      $data['yearlyDepartmentDetailedReport'] = $result;

      $this->load->view('layout/header');
      $this->load->view('cams/YearlyDepartmentDetailedReport.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function GeneralInformationDepartmentWise()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['departments'] = $this->cams->get_department();
      $this->load->view('layout/header');
      $this->load->view('cams/GeneralInformationDepartmentWise.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function GeneralInformationDepartmentWisePrint()
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      if($this->input->post('submit-general-information-form'))
      {
        $department = $this->input->post('department');
        $generalInfoDeptWise = $this->cams->get_general_info_dept_wise($department);
        $data['generalInfoDeptWise'] = $this->group_by('app_code', $generalInfoDeptWise);
        
        $this->load->view('layout/header');
        $this->load->view('cams/GeneralInformationDepartmentWisePrint.php',$data);
        $this->load->view('layout/footer');
      }
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function camDataEntryDetail($id)
  {
    $logged_in = $this->session->userdata('logged_in');
    if($logged_in)
    {
      $data['camDataEntry'] = $this->cams->get($id);
      $this->load->view('layout/header');
      $this->load->view('cams/camDataEntryDetail.php',$data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

  public function searchByAckNo()
  {
    $logged_in = $this->session->userdata('logged_in');

    if($logged_in)
    {
      $ackNo = $this->input->get('ackNo');
      $data['applicantData'] = $this->cams->get($ackNo);
      
      $this->load->view('layout/header');
      $this->load->view('cams/index.php', $data);
      $this->load->view('layout/footer');
    }
    else
    {
      redirect(base_url().'login');
    }
  }

}