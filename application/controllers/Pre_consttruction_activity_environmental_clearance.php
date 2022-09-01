<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_environmental_clearance extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Environmental_clearance_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function manage()
    {
        
        $user_id = $this->session->userdata('id');
        $project_id = base64_decode($_REQUEST['project_id']); 
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        
    $projectData_exist_flag = $this->Environmental_clearance_model->checkProjectExits($project_id);
        
        $data['get_env_clearance'] = $this->Environmental_clearance_model->get_env_clearance($project_id);

    
        $this->form_validation->set_rules('target_end_date', 'Target end date','required'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_environmental_clearance', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_EIA'] = $_REQUEST['status_EIA'];
            $db_data['status_online_application'] = $_REQUEST['status_online_application'];
            $db_data['status_OSCPCB_scrunity'] = $_REQUEST['status_OSCPCB_scrunity'];
            $db_data['status_ec_received'] = $_REQUEST['status_ec_received'];
            $db_data['status_fund_for_ec'] = $_REQUEST['status_fund_for_ec'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
            
             // File upload
    	if (!is_dir('uploads/files/env_clearance')) {
                    mkdir('./uploads/files/env_clearance');
                 }
    

    
      $config['upload_path']          = 'uploads/files/env_clearance/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_EIA"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_EIA']['name'];
        $this->load->library('upload', $config);
        $file_EIA = $this->upload->do_upload('file_EIA');
        if (!$file_EIA){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_EIA = $this->upload->data("file_name");
        }
        
            $db_data['file_EIA'] = $file_EIA;
    }
    else {
        
        if (!empty ($_REQUEST['file_EIA_hidden'])) {
            
            $db_data['file_EIA'] = $_REQUEST['file_EIA_hidden'];
            
        }
        
    }
    

    if($_FILES["file_application"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_application']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_application = $this->upload->do_upload('file_application');
        if (!$file_application){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_application = $this->upload->data("file_name");
        }
        
            $db_data['file_application'] = $file_application;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_application_hidden'])) {
            
            $db_data['file_application'] = $_REQUEST['file_application_hidden'];
            
        }
        
    }
    if($_FILES["file_OSCPCB"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_OSCPCB']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_OSCPCB = $this->upload->do_upload('file_OSCPCB');
        if (!$file_OSCPCB){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_OSCPCB = $this->upload->data("file_name");
        }
        
            $db_data['file_OSCPCB'] = $file_OSCPCB;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_OSCPCB_hidden'])) {
            
            $db_data['file_OSCPCB'] = $_REQUEST['file_OSCPCB_hidden'];
            
        }
        
    }        
    if($_FILES["file_EC"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_EC']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_EC = $this->upload->do_upload('file_EC');
        if (!$file_EC){
            $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_EC = $this->upload->data("file_name");
        }
        
            $db_data['file_EC'] = $file_EC;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_EC_hidden'])) {
            
            $db_data['file_EC'] = $_REQUEST['file_EC_hidden'];
            
        }
        
    }
    if($_FILES["file_fund_deposit"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_fund_deposit']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_fund_deposit = $this->upload->do_upload('file_fund_deposit');
        if (!$file_fund_deposit){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_fund_deposit = $this->upload->data("file_name");
        }
        
            $db_data['file_fund_deposit'] = $file_fund_deposit;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_fund_deposit_hidden'])) {
            
            $db_data['file_fund_deposit'] = $_REQUEST['file_fund_deposit_hidden'];
            
        }
        
    }
  
        if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $env_clearance_id = $data['get_env_clearance'][0]['id'];

                $EE_last_data_update =$this->Environmental_clearance_model->update_env_clearance($db_data,$env_clearance_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Environmental_clearance_model->save_env_clearance($db_data);
            
             }
        
        
        }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
    
    

}  
 

?>
