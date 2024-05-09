<?php
 
class Cams_model extends CI_Model
{
 
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }
 
    public function checkLogin($email, $password, $district) 
    {
        $hashedPassword   = hash('sha256', $password);

        $this->db->where('email', $email);
        $this->db->where('password', $hashedPassword);
        $this->db->where('district', $district);
        $query = $this->db->get('users');
        return $query;
    }

    public function get_department()
    {
        $departments = $this->db->get("department")->result();
        return $departments;
    }

    public function get_app_type()
    {
        $app_type = $this->db->get("app_type")->result();
        return $app_type;
    }

    public function store()
    {    
        $data = [
            'ack_no ' => $this->input->post('ack_number'),
            'name' => $this->input->post('name'),
            'dept_no' => $this->input->post('department'),
            'app_code' => $this->input->post('type_of_application'),
            'date' => $this->input->post('date'),
            'due_date' => $this->input->post('due_date'),
            'status' => 'Pending',
            'remark' => $this->input->post('remark'),
            'address' => $this->input->post('address'),
        ];
 
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->insert($table , $data);
        return $result;
    }

    public function get_last_ack_no()
    {
        $table = "applications_".$this->session->userdata('district');
        $last_ack_no = $this->db->select('ack_no')->order_by('ack_no',"desc")->limit(1)->get($table)->row();
        return $last_ack_no;
    }

    public function get_all_applications()
    {
        $table = "applications_".$this->session->userdata('district');
        $applications = $this->db->order_by('ack_no','desc')->limit(1000)->get($table)->result();
        return $applications;
    }

    public function get($id)
    {
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->get_where($table , ['ack_no' => $id ])->row();
        return $result;
    }

    public function update($id)
    {
        if(!empty($this->input->post('grant_date')))
        {
            $status = "Granted";
        }
        else if(!empty($this->input->post('rejected_date')))
        {
            $status = "Rejected";
        }
        else
        {
            $status = "Pending";
        }

        $data = [
            'name' => $this->input->post('name'),
            'dept_no' => $this->input->post('department'),
            'app_code' => $this->input->post('type_of_application'),
            'date' => $this->input->post('date'),
            'due_date' => $this->input->post('due_date'),
            'query_date' => $this->input->post('query_date'),
            'grant_date' => $this->input->post('grant_date'),
            'rejected_date' => $this->input->post('rejected_date'),
            'status' => $status,
            'remark' => $this->input->post('remark'),
            'address' => $this->input->post('address'),
        ];
 
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->where('ack_no',$id)->update($table , $data);
        return $result;
    }

    public function delete($id)
    {
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->delete($table , array('ack_no' => $id));
        return $result;
    }

    public function change_password($email)
    {
        $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
        $hashedPassword   = hash('sha256', $this->input->post('c_password') . $salt);

        $data = [
            'password' => $hashedPassword,
        ];
        
        $result = $this->db->where('email',$email)->update('users',$data);
        return $result;
    }

    public function create_new_user()
    {    
        $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
        $hashedPassword   = hash('sha256', $this->input->post('password') . $salt);

        $data = [
            'email' => $this->input->post('email'),
            'user_type' => $this->input->post('user_type'),
            'district' => $this->input->post('district'),
            'password' => $hashedPassword
        ];
 
        $result = $this->db->insert('users', $data);
        return $result;
    }

    public function get_users_list()
    {
        $users = $this->db->where('district',$this->session->userdata('district'))->get("users")->result();
        return $users;
    }

    public function get_user_data($id)
    {
        $result = $this->db->get_where('users', ['id' => $id ])->row();
        return $result;
    }

    public function update_user($id)
    {
        if(!empty($this->input->post('password')))
        {
            $salt     = 'rm%@sfl2@14g_#5dusr*$hgofaq!@jtsw#hjsy!@5@tw&34qmzx@07';
            $hashedPassword   = hash('sha256', $this->input->post('password') . $salt);
            $passwordQuery = " ,`password`='".$hashedPassword."' ";
        }
        else
        {
            $passwordQuery = " ";
        }    
        $updateUserQuery = "UPDATE `users` SET `email`='".$this->input->post('email')."',`district`='".$this->input->post('district')."', `user_type`='".$this->input->post('user_type')."' $passwordQuery  WHERE `id`='".$id."'";
        $result = $this->db->query($updateUserQuery);
        return $result;    
    }

    public function delete_user($id)
    {
        $result = $this->db->delete('users', array('id' => $id));
        return $result;
    }

    public function get_departments_list()
    {
        $department = $this->db->get("department")->result();
        return $department;
    }

    public function get_last_department_no()
    {
        $last_dept_no = $this->db->select('dept_no')->order_by('dept_no ',"desc")->limit(1)->get('department')->row();
        return $last_dept_no;
    }

    public function add_department()
    {    
        $data = [
            'dept_no' => $this->input->post('dept_no'),
            'dept_name' => $this->input->post('dept_name'),
            'ho_desig' => $this->input->post('ho_desig')
        ];
 
        $result = $this->db->insert('department', $data);
        return $result;
    }

    public function get_department_data($id)
    {
        $result = $this->db->get_where('department', ['dept_no' => $id ])->row();
        return $result;
    }

    public function update_department($id)
    {
        $data = [
            'dept_name' => $this->input->post('dept_name'),
            'ho_desig' => $this->input->post('ho_desig'),
        ];
 
        $result = $this->db->where('dept_no',$id)->update('department',$data);
        return $result;
    }

    public function delete_department($id)
    {
        $result = $this->db->delete('department', array('dept_no' => $id));
        return $result;
    }

    public function get_application_types()
    {
        $app_type = $this->db->get("app_type")->result();
        return $app_type;
    }

    public function get_last_app_code()
    {
        $last_app_code = $this->db->select('app_code')->order_by('app_code ',"desc")->limit(1)->get('app_type')->row();
        return $last_app_code;
    }

    public function add_application_type()
    {    
        $data = [
            'app_code' => $this->input->post('app_code'),
            'app_type' => $this->input->post('app_type'),
            'dept_no' => $this->input->post('dept_no'),
            'no_days' => $this->input->post('no_days')
        ];
 
        $result = $this->db->insert('app_type', $data);
        return $result;
    }

    public function get_app_type_data($id)
    {
        $result = $this->db->get_where('app_type', ['app_code' => $id ])->row();
        return $result;
    }

    public function update_app_type($id)
    {
        $data = [
            'app_type' => $this->input->post('app_type'),
            'dept_no' => $this->input->post('dept_no'),
            'no_days' => $this->input->post('no_days'),
        ];
 
        $result = $this->db->where('app_code',$id)->update('app_type',$data);
        return $result;
    }

    public function delete_application_type($id)
    {
        $result = $this->db->delete('app_type', array('app_code' => $id));
        return $result;
    }

    public function get_no_of_days($appType,$department)
    {
        $result = $this->db->get_where('app_type', ['app_code' => $appType , 'dept_no' => $department ])->row();
        return $result;
    }

    public function get_daily_report($date)
    {
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->get_where($table , ['date' => $date])->result();
        return $result;
    }

    public function get_queried_applicants($department)
    {
        $table = "applications_".$this->session->userdata('district');
        $getQueriedApplicants = "SELECT * FROM $table WHERE (`query_date` != '' OR  `query_date` != NULL) AND `dept_no`='".$department."';";
        $getQueriedApplicants = $this->db->query($getQueriedApplicants);
        $result =$getQueriedApplicants->result_array();
        return $result;
    }

    public function get_rejected_applicants($fromDate, $toDate)
    {
        $table = "applications_".$this->session->userdata('district');
        $getRejectedApplicantsQuery = "SELECT * FROM $table WHERE `date` BETWEEN '".$fromDate."' AND '".$toDate."' AND `status` = 'Rejected';";
        $getRejectedApplicants = $this->db->query($getRejectedApplicantsQuery);
        $result =$getRejectedApplicants->result_array();
        return $result;
    }

    public function get_pending_applicants($fromDate, $toDate)
    {
        $table = "applications_".$this->session->userdata('district');
        $getPendingApplicantsQuery = "SELECT * FROM $table WHERE `date` BETWEEN '".$fromDate."' AND '".$toDate."' AND `status` = 'Pending';";
        $getPendingApplicants = $this->db->query($getPendingApplicantsQuery);
        $result =$getPendingApplicants->result_array();
        return $result;
    }

    public function get_granted_applicants($fromDate, $toDate)
    {
        $table = "applications_".$this->session->userdata('district');
        $getGrantedApplicantsQuery = "SELECT * FROM $table WHERE `date` BETWEEN '".$fromDate."' AND '".$toDate."' AND `status` = 'Granted';";
        $getGrantedApplicants = $this->db->query($getGrantedApplicantsQuery);
        $result =$getGrantedApplicants->result_array();
        return $result;
    }

    public function get_general_info_dept_wise($department)
    {
        $table = "applications_".$this->session->userdata('district');
        $result = $this->db->get_where($table , ['dept_no' => $department ])->result();
        return $result;
    }

    public function dept_wise_yearly_detailed_report()
    {
        $table = "applications_".$this->session->userdata('district');
        $getDeptWiseYearlyDetailedReport = "SELECT COUNT(`status`) AS status_count,status, dept_no, YEAR(`date`) AS year FROM $table GROUP BY YEAR(`date`) , status, dept_no;";
        $deptWiseYearlyDetailedReport = $this->db->query($getDeptWiseYearlyDetailedReport);
        $result = $deptWiseYearlyDetailedReport->result_array();
        return $result;
    }
}
?>