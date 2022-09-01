
<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_summary_list extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'security'));

        $this->load->model('Project_summary_list_model');
        $this->allowedModule = array(1 => true, 3 => false, 6 => false, 2 => false, 5 => false, 7 => false, 4 => false);
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }


    function index(){
       
       $project_group_id = $this->input->post('project_group_id');
       $project_category_id = $this->input->post('project_category_id');
       $project_area_id = $this->input->post('project_area_id');
       $project_wing_id = $this->input->post('project_wing_id');
       $project_division_id = $this->input->post('project_division_id');
       $project_list_type = $_REQUEST['project_list_type'];
       $circle_id = $this->session->userdata('circle_id');
       $division_id = $this->session->userdata('division_id');

       if($project_list_type == 'Total Projects'){
        $page_title = 'Total Projects';
        $project_list = $this->Project_summary_list_model->get_total_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }
       elseif($project_list_type =='Ongoing Projects'){
        $page_title = 'Ongoing Projects';
        $project_list = $this->Project_summary_list_model->get_ongoing_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_ongoing_summary_list_view';
       }
       elseif($project_list_type == 'Completed Projects'){
        $page_title = 'Completed Projects';
        $project_list = $this->Project_summary_list_model->get_completed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }
       elseif($project_list_type == 'Overview Planning Projects'){
        $page_title = 'Planning Projects';

         $project_list = $this->Project_summary_list_model->get_planning_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
         $page_view = 'dashboard/project_summary_list_view';
       }
       elseif($project_list_type == 'Overview Tendering Projects'){
        $page_title = 'Tendering Projects';
        $project_list = $this->Project_summary_list_model->get_tendering_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }
       elseif($project_list_type == 'Overview Construction Projects'){
        $page_title = 'Construction Projects';
        $project_list = $this->Project_summary_list_model->get_construction_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_construction_summary_list_view';
       }
       elseif($project_list_type=='Overview Completed Projects'){
        $page_title = 'Completed Projects';
        $project_list = $this->Project_summary_list_model->get_overview_completed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }
       elseif($project_list_type=='Delayed Project'){
        $page_title = 'Delayed Projects';
        $project_list = $this->Project_summary_list_model->get_delayed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_delayed_summary_list_view';
       }
       elseif($project_list_type=='Overview Pre Construction'){
        $page_title = 'Pre Construction Projects';
        $project_list = $this->Project_summary_list_model->get_pre_construction_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }

    elseif($project_list_type == 'puri Projects') {
        $page_title = 'Puri Projects';
        $project_list = $this->Project_summary_list_model->get_puri_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
    }
    elseif($project_list_type == 'nonpuri Projects') {
        $page_title = 'nonpuri Projects';
        $project_list = $this->Project_summary_list_model->get_nonpuri_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view';
    }

    elseif($project_list_type == 'Circle1') {
        $page_title = 'Circle1 Projects';
        $project_list = $this->Project_summary_list_model->get_circle1_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view_circle';
    }
    
    elseif($project_list_type == 'Circle2') {
        $page_title = 'Circle2 Projects';
        $project_list = $this->Project_summary_list_model->get_circle2_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view_circle';
    }

    elseif($project_list_type == 'Circle3') {
        $page_title = 'Circle3 Projects';
        $project_list = $this->Project_summary_list_model->get_circle3_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $page_view = 'dashboard/project_summary_list_view_circle';
    }

    elseif($project_list_type == 'Overview Division Projects'){
        $page_title = 'Division Projects';
        $project_list = $this->Project_summary_list_model->get_division_project_data($division_id);
        $page_view = 'dashboard/project_division_list_view';
       }


    elseif($project_list_type == 'Closed Issue') {
        $page_title = 'Closed Issue Projects';
        $project_list = $this->Project_summary_list_model->get_closed_project_data();
        $page_view = 'dashboard/project_summary_list_view_issue';
    }

    elseif($project_list_type == 'Open Issue') {
        $page_title = 'Open Issue Projects';
        $project_list = $this->Project_summary_list_model->get_open_project_data();
        $page_view = 'dashboard/project_summary_list_view_issue_open';
    }
       else{
        $page_title = 'Total Projects';
        $project_list = $this->Project_summary_list_model->get_total_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
        $page_view = 'dashboard/project_summary_list_view';
       }

       $data['project_list'] = $project_list;
       $data['project_list_type'] = $page_title;
       $this->load->common_template($page_view, $data);

    }


    function delay_details(){
        $project_id=base64_decode($_REQUEST['project_id']);
         $user_id = $this->session->userdata('id');
        $data['project_id']=$project_id;
        $data['user_id']=$user_id;
        $data['project_deatail'] = $this->Project_summary_list_model->get_delayed_project_details_data($project_id);
        $data['project_delayed_deatail'] = $this->Project_summary_list_model->get_delayed_project_details_till_date_data($project_id);
       $proj_rel_id = $this->Project_summary_list_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        $data['project_creation_users'] = $this->Project_summary_list_model->get_project_creation_users($proj_rel_id,$user_id);
       $this->load->common_template('dashboard/project_delay_details_view', $data);
    }


    function send_communication_data(){
         $data = array('success'=> false,'messages'=>array());
        $this->load->library('form_validation');
        $this->form_validation->set_rules('stakeholder_id','Stakeholder','trim|required');
        $this->form_validation->set_rules('remarks','Remarks','trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
        if($this->form_validation->run() == TRUE) 
        {
            
            $stakeholder_id = $this->input->post('stakeholder_id');
            $remarks = $this->input->post('remarks');
            $project_id = $this->input->post('project_id');
            $user_id = $this->session->userdata('id');
            $addData = array(
                'project_id' => $project_id, 
                'sent_to' => $stakeholder_id, 
                'sent_by' => $user_id, 
                'remarks' => $remarks, 
                'created_by' => $user_id, 
                'created_at' => date('Y-m-d H:i:s') 
            );

            /* seen by status Upadate */

            $updateData = array('seen_by_user' => 'Y');
            $update = $this->Project_summary_list_model->update_md_seen_by_status($project_id,$updateData);

            /* email Send to stakeholder */
            $this->load->model('Outgoing_model');
            $userData = $this->Project_summary_list_model->organization_user_details($stakeholder_id);
            $sender_details = $this->Project_summary_list_model->organization_user_details($user_id);
            $name = $userData[0]['firstname'].' '.$userData[0]['lastname'];
            $mailSubject ="Project Monitoring Dashboard - Clarification Required ";
            $project_deatail = $this->Project_summary_list_model->get_delayed_project_details_data($project_id);
            $this->Outgoing_model->sendEmailtoStakeholder($userData[0]['email'],$name, $mailSubject, $project_deatail,$sender_details,$remarks);

            /*End  email Send to stakeholder */



            $add = $this->Project_summary_list_model->insertAllData($addData, 'project_delayed_communication');
                if($add)
                {
                    $data['success'] = true;
                }
           
        }
        else
        {
            foreach($_POST as $key => $value){
                $data['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($data);
    }


    function get_communication_area(){
        $project_id = $this->input->post('project_id');
        $user_id = $this->input->post('user_id');
        $data['get_communication_data'] = $this->Project_summary_list_model->get_communication_data($project_id);
        $this->load->view('dashboard/project_delay_communication_view',$data);
    }


    function get_not_seen_count_data($project_id){
        $str = '';
        $user_id = $this->session->userdata('id');
        $get_communication_last_status = $this->Project_summary_list_model->get_md_communication_last_status($project_id);
        if($get_communication_last_status == 'N'){
           $str = $this->Project_summary_list_model->get_project_not_seen_count($project_id); 
       }else{
         $str = '';
       }
        
        return $str;
    }


    function change_seen_status(){
         $project_id = $this->input->post('project_id');
         $user_id = $this->session->userdata('id');
         /* seen by status Upadate */

        $updateData = array('seen_by_user' => 'Y');
        $update = $this->Project_summary_list_model->update_md_seen_by_status($project_id,$updateData);

        echo 'success';
    }


    function get_project_total_data($project_id){
        return $project_total_data = $this->Project_summary_list_model-> get_project_total_data($project_id);
    }

   




}