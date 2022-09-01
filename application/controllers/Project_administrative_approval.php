<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project_administrative_approval extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','stepsbar_helper'));
        $this->load->model('Project_administrative_approval_model');
        $this->load->model('User_model');
        $this->load->model('Procurement_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }

        /*End fo Check whether logged in */
        $this->financial_module_permission = $this->user_access_details(8);
    }
	
	    public function checkEmptyValue($value)
    {
        return !empty($value) ? $value : NULL;
    }

    /*Project Steps*/

    public function manage(){
        $data = [];
        $user_id = $this->session->userdata('id');
        $data['project_id'] =  $_REQUEST['project_id'];
        $project_id = base64_decode($_REQUEST['project_id']);
        if(empty($project_id)){
            redirect('Project/project_conceptualisation');
        }


        $project_exist_flag = $this->Project_administrative_approval_model->checkProjectExits($project_id);
        $data['Aapproval_status'] = $project_exist_flag;

        //$data['user_type'] = $this->Procurement_model->getAllUserType();
        //$data['user_name'] = $this->Procurement_model->getAllUserName();
        //$data['project_approvers'] = $this->Project_administrative_approval_model->get_org_users();
        $data['result'] = $this->Project_administrative_approval_model->getProjectAapprovalDetails($project_id);

        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_administrative_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'project_creator_id');
       
        $project_approver_id = $this->Project_administrative_approval_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

        $project_conceptualisation_app_status = $this->Project_administrative_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
       if ($project_conceptualisation_app_status != 'Y') {
           redirect('project/project_conceptualisation?project_id='.base64_encode($project_id));
       }
       // elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        

       // }else{
       //  redirect('home/page_access');
       // }



        /* =====End Checking for if this project this user created or not ======*/
		
		

        $data['steps_files'] = $this->Project_administrative_approval_model->getFiles($project_id,'project_administrative_approval_stage_document');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');
        

        
        $data['brakup_details']  = $this->Project_administrative_approval_model->get_amount_brakup($project_id);
        $data['super_visor_dtl'] = $this->Procurement_model->getProjectUsers($project_id);

        $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('date_of_presentation', 'Date of presentation for Administrative approval', 'required');
            
        }else{

        $this->form_validation->set_rules('date_of_presentation', 'Date of presentation for Administrative approval', 'required');
        $this->form_validation->set_rules('administrative_approval_date', 'Administrative Approval date', 'required|callback_administrative_approval_date_checker');
        $this->form_validation->set_rules('file_no', 'Administrative Approval file No.', 'required');
        $this->form_validation->set_rules('final_approval_authority', 'Final Approval Authority', 'required');
        $this->form_validation->set_rules('approved_project_cost', 'Approved Project Cost', 'required');

    

    }
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_administrative_approval', $data);
        }else{


            $db_data['date_of_presentation'] =  $this->checkEmptyValue($_REQUEST['date_of_presentation']);
            $db_data['administrative_approval_date'] =  $this->checkEmptyValue($_REQUEST['administrative_approval_date']);
            $db_data['file_no'] =  $this->checkEmptyValue($_REQUEST['file_no']);
            $db_data['final_approval_authority'] =  $this->checkEmptyValue($_REQUEST['final_approval_authority']);
           // $db_data['approved_project_cost'] =  $this->checkEmptyValue($_REQUEST['approved_project_cost']);
            $db_data['approved_project_cost'] = $this->checkEmptyValue(str_replace(',','',$_REQUEST['approved_project_cost']));
            $db_data['project_approver_id'] =  $this->session->userdata('id');
            
           // $db_data['remarks'] =  $this->checkEmptyValue($_REQUEST['remarks']);
            //$db_data['status'] =  'Y';
           // echo "<pre>";print_r($db_data); die;

            if($draft == 'D'){
              $db_data['draft_mode'] = 'Y';
              }else{
                $db_data['draft_mode'] = 'N';
              }  

            
            /**Update Project data**/
            if($project_exist_flag){

                $db_approve_status = $this->Project_administrative_approval_model->getSpecificdata('project_administrative_approval_stage','project_id',$project_id,'approve_status');
                if($db_approve_status == 'R'){
                    $db_data['approve_status'] = 'N';
                }

                $this->Project_administrative_approval_model->updateProjectAApprovalDetails($db_data,$project_id);
				
				
                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_administrative_approval_model->getFiles($project_id,'project_administrative_approval_stage_document');
                
                $old_arr = array();
                if(!empty($doc_arr)){
                    foreach ($doc_arr as $doc) {
                        $old_arr[] = $doc['document_id'];
                    }
                }

                
                $db_hidden_file_id = $this->input->post('db_hidden_file_id');
                if(!empty($db_hidden_file_id)){

                $diff_result = array_diff($old_arr, $db_hidden_file_id);
                }else{
                  $diff_result =  $old_arr; 
                }
                
                if(!empty($diff_result)){
                    foreach ($diff_result as $diff) {
                        $get_old_file_name = $this->Project_administrative_approval_model->getSpecificdata('project_administrative_approval_stage_document','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_administrative_approval_model->deleteData('document_id', $diff, 'project_administrative_approval_stage_document');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_administrative_approval_stage_document');

                /* end file update */


               

                $this->session->set_flashdata('success', 'Project Record Updated successfully');



            }else{
                /**Insert Project data**/
                $db_data['project_id'] =  $project_id;
                $db_data['created_by_user_id'] = $this->session->userdata('id');
                $this->Project_administrative_approval_model->addProjectApproval($db_data);


        
                $this->session->set_flashdata('success', 'Project Data saved successfully');

            }

    

            
            redirect('project_list/pip_administrative_approval');
        }


    }

    /* callback function for date_of_presentation */
    // function date_of_presentation_checker(){
    //     $project_id = base64_decode($_REQUEST['project_id']);
    //     $date_of_presentation = $this->input->post('date_of_presentation');
    //     $dpr_start_date = $this->Project_administrative_approval_model->getSpecificdata('project_dpr_stage','project_id',$project_id,'dpr_start_date');
    //     if (strtotime($date_of_presentation) < strtotime($dpr_start_date) ){

    //         $this->form_validation->set_message('date_of_presentation_checker', 'Presentation for Administrative approval date must be Greater than Master Plan / DPR start date');
            
    //         return false;
    //     }else{
    //       return true;  
    //     }
    // }
    /* callback function for administrative_approval_date */
    function administrative_approval_date_checker(){
        $project_id = base64_decode($_REQUEST['project_id']);
        $date_of_presentation = $this->input->post('date_of_presentation');
        $administrative_approval_date = $this->input->post('administrative_approval_date');
        if (strtotime($administrative_approval_date) < strtotime($date_of_presentation) ){

            $this->form_validation->set_message('administrative_approval_date_checker', 'Administrative Approval date must be Greater than Date of presentation for Administrative approval');
            
            return false;
        }else{
          return true;  
        }
    }




     function project_info()
	    {
	    $this->load->model('Projectdashboard_model');
	    $project_id = base64_decode($_REQUEST['project_id']);
	  
		// ========= Project Information about 5 stages ===========
        // ====Project Conceptualisation details ======
        $data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
		// ============================================ 
        $data['project_preparation'] = $this->Projectdashboard_model->project_data_preparation($project_id);
        $data['project_preparation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_preparation_stage_documents','project_id',$project_id);

        $data['project_userinfo_preparation'] = $this->Projectdashboard_model->preparation_project_user_information($project_id);
        $data['sof_preparation'] = $this->Projectdashboard_model->preparation_sof($project_id);
        $data['project_pre_tender'] = $this->Projectdashboard_model->pretender_project_data($project_id);
        $data['project_pre_tender_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_pretender_stage_documents','project_id',$project_id);
        $data['tender_histroy'] = $this->Projectdashboard_model->getTenderHistory($project_id);
        $data['project_tender'] = $this->Projectdashboard_model->tender_project_data($project_id);
        $data['project_tender_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_tender_stage_documents','project_id',$project_id);
        $data['project_agreement'] = $this->Projectdashboard_model->agreement_project_data($project_id);
        $data['project_agreement_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_aggrement_stage_document','project_id',$project_id);
        $data['project_commissioning'] = $this->Projectdashboard_model->commissioning_project_data($project_id);
        // ==============For Project Pre Construction Activities==============
        $data['project_pre_construction_setting'] = $this->Projectdashboard_model->project_pre_construction_settings_data($project_id);

        $data['project_id'] =$project_id;



        // ==============End For Project Pre Construction Activities==========


		//=========== End Project Information ======================


		
		$this->load->view('dashboard/project_info_entry_page', $data);
	    }



        function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


    function file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,$table_name){
        if (!is_dir('uploads/attachment/')) {
              mkdir('./uploads/attachment', 0777, TRUE);
          }
        if(!empty($hidden_file_name)){
            foreach ($hidden_file_name as $key => $value) {

                $temp_des = 'uploads/temp/'.$hidden_file_url[$key];
                $move_des = 'uploads/attachment/'.$hidden_file_url[$key];
                if (copy($temp_des,$move_des)) {
                      unlink($temp_des);
                }
               $file_data['file_name '] = $value;
                $file_data['file_path '] = $hidden_file_url[$key];
                $file_data['project_id'] = $project_id;
                $file_data['added_by'] = $this->session->userdata('id');
                $this->Project_administrative_approval_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }




  /* End Call Back function use for date valiadtion */



 

}

?>
