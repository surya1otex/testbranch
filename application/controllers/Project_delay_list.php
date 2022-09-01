<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_delay_list extends MY_Controller
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

        $this->load->model('Project_delay_list_model');
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }


    function index(){
        $user_id = $this->session->userdata('id');
        $project_list = $this->Project_delay_list_model->get_stakeholder_delayed_project_data($user_id);
        $data['project_list'] = $project_list;
        $this->load->common_template('dashboard/stakeholder_delayed_list_view', $data);
    }


    function get_stakeholder_not_seen_count_data($project_id){
        $str = '';
        $user_id = $this->session->userdata('id');
        $get_communication_last_status = $this->Project_delay_list_model->get_communication_last_status($project_id,$user_id);
        if($get_communication_last_status == 'N'){
           $str = $this->Project_delay_list_model->get_stakeholder_not_seen_count($project_id,$user_id); 
       }else{
         $str = '';
       }
        
        return $str;
    }


    function delay_details(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $user_id = $this->session->userdata('id');
        $data['project_id']=$project_id;
        $data['user_id']=$user_id;
        $data['project_deatail'] = $this->Project_delay_list_model->get_stakeholder_delayed_project_details_data($project_id);
        $data['project_delayed_deatail'] = $this->Project_delay_list_model->get_stakeholder_delayed_project_details_till_date_data($project_id);
       $proj_rel_id = $this->Project_delay_list_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
       
       $this->load->common_template('dashboard/stakeholder_project_delay_details_view', $data);
    }


    function send_communication_data(){
         $data = array('success'=> false,'messages'=>array());
        $this->load->library('form_validation');
        //$this->form_validation->set_rules('stakeholder_id','Stakeholder','trim|required');
        $this->form_validation->set_rules('remarks','Remarks','trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
        if($this->form_validation->run() == TRUE) 
        {
            
            //$stakeholder_id = $this->input->post('stakeholder_id');
            $remarks = $this->input->post('remarks');
            $project_id = $this->input->post('project_id');
            $user_id = $this->session->userdata('id');
            $addData = array(
                'project_id' => $project_id,
                'sent_by' => $user_id, 
                'remarks' => $remarks, 
                'created_by' => $user_id, 
                'created_at' => date('Y-m-d H:i:s') 
            );

            /* seen by status Upadate */

            $updateData = array('seen_by_user' => 'Y');
            $update = $this->Project_delay_list_model->update_seen_by_status($project_id,$user_id,$updateData);
            /* send email */
            $this->load->model('Outgoing_model');
            $this->load->model('User_model');
            $project_deatail = $this->Project_delay_list_model->get_stakeholder_delayed_project_details_data($project_id);
            $sender_details = $this->Project_delay_list_model->organization_user_details($user_id);
            $recipient_data = $this->User_model->get_higher_level_recipient();
            $ackSubject = "Project Monitoring Dashboard - Reply Required";
            $this->Outgoing_model->sendEmail_to_MD($recipient_data, $ackSubject, $project_deatail,$sender_details,$remarks);

            /* end send EMail */


            $add = $this->Project_delay_list_model->insertAllData($addData, 'project_delayed_communication');
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


    function get_stakeholder_communication_area(){
        $project_id = $this->input->post('project_id');
        $user_id = $this->input->post('user_id');
        $data['user_id'] = $user_id;
        $data['get_communication_data'] = $this->Project_delay_list_model->get_stakeholder_communication_area($project_id,$user_id);
        $this->load->view('dashboard/stakeholder_project_delay_communication_view',$data);
    }


    function change_seen_status(){
         $project_id = $this->input->post('project_id');
         $user_id = $this->session->userdata('id');
         /* seen by status Upadate */

        $updateData = array('seen_by_user' => 'Y');
            $update = $this->Project_delay_list_model->update_seen_by_status($project_id,$user_id,$updateData);

        echo 'success';
    }



}