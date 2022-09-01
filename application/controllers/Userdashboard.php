<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Userdashboard extends MY_Controller
{   public $financial_module_permission;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('Userdashboard_model');
        //$this->load->model('Procurement_model');
        $this->load->model('Analytics_model');
        $this->load->model('User_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
        $this->financial_module_permission = $this->user_access_details(8);

    }


    /*User Dashboard End*/
    public function  hod_dashboard(){
		
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Userdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Userdashboard_model->login_roledata( $role_id );
        

       // $temp = $this->get_all_permission_module($user_id);
       // $data['master_module'] = $temp;

        $this->load->common_template('dashboard/user_dashboard', $data);
    }
	
	public function modalwelcomemsgDetails(){

		
        $user_id = $this->session->userdata('id');		
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Userdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Userdashboard_model->login_roledata( $role_id );
				$this->load->view('dashboard/welcome_message_modal_view', $data);
		}
		
    public function  co_dashboard(){
		
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Userdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Userdashboard_model->login_roledata( $role_id );
		//$redirect_url = $data['role_details'][0]['default_page']; 
		
		
		
		// All rejected data of 5 stages
       	$data['rejectedData'] = $this->Userdashboard_model->get_peoject_rejected_data($user_id);
		
       	//$data['project_pending_data_prep'] = $this->Userdashboard_model->get_pip_preparation_pending_projects_list_data($user_id);
       	// $data['project_pending_data_pretender'] = $this->Userdashboard_model->get_pp_pre_tender_pending_projects_list_data($user_id);
       	 $data['project_pending_data_tender'] = $this->Userdashboard_model->get_pp_tender_pending_projects_list_data($user_id);
       	 $data['project_pending_data_aggre'] = $this->Userdashboard_model->get_pp_agreement_pending_projects_list_data($user_id);

         $data['project_pending_data_dpr'] = $this->Userdashboard_model->get_pp_dpr_pending_projects_list_data($user_id);

         $data['project_pending_data_administrative_approval'] = $this->Userdashboard_model->get_pp_administrative_approval_pending_projects_list_data($user_id);
         $data['project_pending_data_pre_construction'] = $this->Userdashboard_model->get_pp_pre_construction_pending_projects_list_data($user_id);

        $this->load->common_template('dashboard/co_dashboard', $data);
		
		
    }
	
	

	public function get_project_history_data(){
        $project_id = $_REQUEST['project_id'];
        $stage_id = $_REQUEST['stage_id'];
        $data['project_history'] = $this->Userdashboard_model->get_project_history_data($project_id,$stage_id);

       for( $i = 0 ; $i < count($data['project_history']); $i++){
            $approver_id = $data['project_history'][$i]['approver_id'];

            $approver_user_type = $this->Userdashboard_model->get_user_type($approver_id);
            if($approver_user_type == 2){
                $approver_details = $this->Userdashboard_model->get_level2_details($approver_id);
            }else if( $approver_user_type == 3){
                $approver_details = $this->Userdashboard_model->get_level3_details($approver_id);
            }
            $data['project_history'][$i]['approver_details'] = $approver_details[0];
            $requester_id = $data['project_history'][$i]['requester_id'];
            $requester_user_type = $this->Userdashboard_model->get_user_type($requester_id);
            if($requester_user_type == 2){
                $requester_details = $this->Userdashboard_model->get_level2_details($requester_id);
            }else if( $requester_user_type == 3){
                $requester_details = $this->Userdashboard_model->get_level3_details($requester_id);
            }
            $data['project_history'][$i]['requester_details'] = $requester_details[0];

        }

        $this->load->view('dashboard/project_history', $data);
    }
		
    public function  pic_dashboard(){
		
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Userdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Userdashboard_model->login_roledata( $role_id );
		
		
		// All approved data 
        $data['approved_project'] = $this->Userdashboard_model->get_pf_planning_project_list($user_id);
        

       // $temp = $this->get_all_permission_module($user_id);
       // $data['master_module'] = $temp;

        $this->load->common_template('dashboard/pic_dashboard', $data);
    }
	
	// PIA DASHBOARD START	
    public function  pia_dashboard(){
		
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Userdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Userdashboard_model->login_roledata( $role_id );
		
		
		// All rejected data of 5 stages
       	$data['pendingapprovalData'] = $this->Userdashboard_model->get_peoject_pending_data($user_id);
        

       // $temp = $this->get_all_permission_module($user_id);
       // $data['master_module'] = $temp;

        $this->load->common_template('dashboard/pia_dashboard', $data);
    }
	
	// PIC DASHBOARD START
	public function project_area($area_id)
    {
        return $this->Userdashboard_model->get_project_area($area_id);
    }

 public function project_type($type_id)
    {
        return $this->Userdashboard_model->get_project_type($type_id);
    }
	
	 
	
    function count_data_against_project($tbl,$field1,$value1,$field2,$value2){
      return $this->Userdashboard_model->count_data_against_project($tbl,$field1,$value1,$field2,$value2);
    }
	
	// PIA DASHBOARD END


	  // Logout from admin page
    public  function logout() {
    	$this->session->set_flashdata('message', 'Logout Successfully');
        $this->session->unset_userdata($Login_details);
        $this->session->sess_destroy();
	    redirect('Home');
		
    }
}

?>