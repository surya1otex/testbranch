<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project_agreement extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper','tendering_stepsbar_helper'));
        $this->load->model('Project_agreement_model');
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

    public function manage($data = [])
    {

        $data = [];
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $project_id = $data['project_id'];
        if(empty($data['project_id'])){
            redirect('Project/project_conceptualisation');
        }
        $user_id = $this->session->userdata('id');
        /* =====Checking for if this project this user created or not ======*/
       // $project_creator_id = $this->Project_agreement_model->getSpecificdata_agreement('project_preparation_stage','project_id',$project_id,'project_creator_id');
       
       //  $project_approver_id = $this->Project_agreement_model->getSpecificdata_agreement('project_preparation_stage','project_id',$project_id,'project_approver_id');

       //  $project_tender_app_status = $this->Project_agreement_model->getSpecificdata_agreement('project_tender_stage','project_id',$project_id,'approve_status');
       // if ($project_tender_app_status != 'Y') {
       //     redirect('project/project_tender?project_id='.base64_encode($project_id));
       // }
       // elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        

       // }else{
       //  redirect('home/page_access');
       // }



        /* =====End Checking for if this project this user created or not ======*/
        

        $data['result'] = $this->Project_agreement_model->getProjectAgreementDetails($data['project_id']);
        // $data['project_pre_tender_status'] = $this->Project_agreement_model->checkProjectExits($data['project_id'],'project_pre_tender_stage');
        // $data['project_tender_status'] = $this->Project_agreement_model->checkProjectExits($data['project_id'],'project_tender_stage');
         $data['project_agreement_status'] = $this->Project_agreement_model->checkProjectExits($data['project_id'],'project_aggrement_stage');

        // print_r($data['result']);
        // die();
        $data['steps_files'] = $this->Project_agreement_model->getFiles($project_id,'project_aggrement_stage_document');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');


        $data['project_approvers'] = $this->Project_agreement_model->get_org_users();
        //echo "<pre>"; print_r($data['result']); die;
        /*** Form Validation Rules ***/
        $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
             $this->form_validation->set_rules('agreement_date', 'Contract signing date', 'required');
             if(!empty($_REQUEST['agreement_date'])){
                $this->form_validation->set_rules('agreement_date', 'Contract signing date', 'required');
             }        
         
        }else{
        $this->form_validation->set_rules('agreement_date', 'Contract signing date', 'required');
        if(!empty($_REQUEST['agreement_date'])){
                $this->form_validation->set_rules('agreement_date', 'Contract signing date', 'required');
             }

         $this->form_validation->set_rules('agreement_cost', 'Contract value', 'required');
         $this->form_validation->set_rules('agreement_end_date', 'Agreement end date', 'required');
         
        $this->form_validation->set_rules('bidder_name', 'Bidder name', 'required');
         $this->form_validation->set_rules('representative_name', 'Bidders representative name');
         $this->form_validation->set_rules('bg_amount', 'PBG amount', 'required');
         $this->form_validation->set_rules('bg_validity', 'PBG submission date ', 'required');
         
        // //$this->form_validation->set_rules('bidder_name', 'Other details of bidder', 'required');
         $this->form_validation->set_rules('project_start', 'Contract Effective date', 'required');
         

         $this->form_validation->set_rules('project_planning_approver', 'Planning approver', 'required');
         $this->form_validation->set_rules('project_end_date', 'Project end date', 'required|callback__project_end_datechecker');
         
         $this->form_validation->set_rules('draft_contract_pre_status', 'Draft Contract Preparation status', 'required');
         $this->form_validation->set_rules('final_draft_contract_shared_bidder_status', 'Final Draft Contract shared to Bidder', 'required');
         $this->form_validation->set_rules('final_draft_contract_sharing_date', 'Final Draft Contract sharing date', 'required');
         $this->form_validation->set_rules('project_start', 'Contract Effective date', 'required');
         $this->form_validation->set_rules('notice_to_proceed_date', 'Notice to proceed date', 'required');
         //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
     }

        /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
           

            $this->load->common_template('project_agreement/project_agreement', $data);

        }else{


            $db_data['agreement_date'] =  $this->checkEmptyValue($_REQUEST['agreement_date']);
            $db_data['project_start_date'] =  $this->checkEmptyValue($_REQUEST['project_start']);
            $db_data['project_end_date'] =  $this->checkEmptyValue($_REQUEST['project_end_date']);
            //$db_data['agreement_cost'] =  $this->checkEmptyValue($_REQUEST['agreement_cost']);
            $db_data['agreement_cost'] = $this->checkEmptyValue(str_replace(',','',$_REQUEST['agreement_cost']));
            $db_data['agreement_end_date'] =  $this->checkEmptyValue($_REQUEST['agreement_end_date']);
            $db_data['bidder_details'] =  $this->checkEmptyValue($_REQUEST['bidder_name']);
            $db_data['representative_name'] =  $this->checkEmptyValue($_REQUEST['representative_name']);
            //$db_data['bg_amount'] =  $this->checkEmptyValue($_REQUEST['bg_amount']);
            $db_data['bg_amount'] = $this->checkEmptyValue(str_replace(',','',$_REQUEST['bg_amount']));
            $db_data['bg_validity_date'] =  $this->checkEmptyValue($_REQUEST['bg_validity']);
            $db_data['other_bidder_details'] =  $this->checkEmptyValue($_REQUEST['bidder_other_details']);
            $db_data['planning_incharge_user_id'] =  $this->checkEmptyValue($_REQUEST['project_planning_approver']);
            
            $db_data['remarks'] =  $this->checkEmptyValue($_REQUEST['remarks']);
            $db_data['draft_contract_pre_status'] =  $this->checkEmptyValue($_REQUEST['draft_contract_pre_status']);
            $db_data['final_draft_contract_shared_bidder_status'] =  $this->checkEmptyValue($_REQUEST['final_draft_contract_shared_bidder_status']);
            $db_data['final_draft_contract_sharing_date'] =  $this->checkEmptyValue($_REQUEST['final_draft_contract_sharing_date']);
            $db_data['PBG_verified'] =  $this->checkEmptyValue($_REQUEST['PBG_verified']);
            $db_data['notice_to_proceed_date'] =  $this->checkEmptyValue($_REQUEST['notice_to_proceed_date']);
            if(!empty($this->input->post('payment_schedule'))){
            $typr = implode(",",$this->input->post('payment_schedule'));
            $db_data['payment_schedule'] =  $typr;
            }else{
                $db_data['payment_schedule'] = NULL;
            }

            

            if($draft == 'D'){
          $db_data['draft_mode'] = 'Y';
          }else{
            $db_data['draft_mode'] = 'N';
            $db_data['approve_status'] =  'Y';
          } 


            $project_exist_flag = $this->Project_agreement_model->checkProjectExits($data['project_id'],'project_aggrement_stage');
            /**Update Project data**/
            if($project_exist_flag){
                $db_data['modified_by'] =  $this->session->userdata('id');

                $db_approve_status = $this->Project_agreement_model->getSpecificdata_agreement('project_aggrement_stage','project_id',$data['project_id'],'approve_status');
                // if($db_approve_status == 'R'){
                //     $db_data['approve_status'] = 'N';
                // }

                $this->Project_agreement_model->updateProjectAgreementDetails($db_data,$data['project_id']);

                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_agreement_model->getFiles($project_id,'project_aggrement_stage_document');
                
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
                        $get_old_file_name = $this->Project_agreement_model->getSpecificdata_agreement('project_aggrement_stage_document','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_agreement_model->deleteData('document_id', $diff, 'project_aggrement_stage_document');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_aggrement_stage_document');

                /* end file update */
                $this->session->set_flashdata('success', 'Project Record Updated successfully');


            }else{
                /**Insert Project data**/
                $db_data['project_id'] = $data['project_id'];
                $db_data['created_by'] = $this->session->userdata('id');
                $db_data['modified_by'] =  0;
                $db_data['project_creator_id'] =  $this->session->userdata('id');
                $this->Project_agreement_model->addProjectAgreement($db_data);

                /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_aggrement_stage_document');

                /* file upload */

                $this->session->set_flashdata('success', 'Project data saved successfully');
            }
            
            $data_project_preparation = $this->Project_agreement_model->getProjectPreparationDetails($data['project_id']);

            redirect('project_list/pp_agreement');
        }


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
                $this->Project_agreement_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }


    // function final_draft_contract_sharing_datechecker($get_date){
    //     $project_id = base64_decode($_REQUEST['project_id']);
    //     $final_draft_contract_sharing_date = $this->input->post('final_draft_contract_sharing_date');
    //     $loa_issue_date = $this->Project_agreement_model->getSpecificdata_agreement('tendering_issue_of_loa','project_id',$project_id,'loa_issue_date');

    //     if ($final_draft_contract_sharing_date < $loa_issue_date) {
    //           $this->form_validation->set_message('final_draft_contract_sharing_datechecker', 'Final Draft Contract sharing date Must be Greater than or Same LoA issue date');
    //           return false;
    //         }else{
    //           return true;  
    //         }
    // }


    // function _agreement_datechecker($get_date){
    //     $agreement_date = $this->input->post('agreement_date');
    //     $final_draft_contract_sharing_date = $this->input->post('final_draft_contract_sharing_date');
       

    //     // if ($agreement_date < $final_draft_contract_sharing_date) {
    //     //       $this->form_validation->set_message('_agreement_datechecker', 'Contract signing date Must be Greater than or Same Final Draft Contract sharing date');
    //     //       return false;
    //     //     }else{
    //     //       return true;  
    //     //     }
    // }

    // function _project_start_datechecker($get_date){
    //     $agreement_date = $this->input->post('agreement_date');
    //     $project_start = $this->input->post('project_start');
       

    //     if ($project_start < $agreement_date) {
    //           $this->form_validation->set_message('_project_start_datechecker', 'Contract Effective date Must be Greater than or Same Contract signing date');
    //           return false;
    //         }else{
    //           return true;  
    //         }
    // }

    function _project_end_datechecker($get_date){
        $project_end_date = $this->input->post('project_end_date');
        $project_start = $this->input->post('project_start');
       

        if ($project_end_date < $project_start) {
              $this->form_validation->set_message('_project_end_datechecker', 'Project end date Must be Greater than or Same Contract Effective date');
              return false;
            }else{
              return true;  
            }
    }


    // function _agreement_end_datechecker($get_date){
    //     $project_end_date = $this->input->post('project_end_date');
    //     $agreement_end_date = $this->input->post('agreement_end_date');
       

    //     if ($agreement_end_date < $project_end_date) {
    //           $this->form_validation->set_message('_agreement_end_datechecker', 'Agreement end date Must be Greater than or Same Project end date');
    //           return false;
    //         }else{
    //           return true;  
    //         }
    // }

    // function _bg_validity_datechecker($get_date){
    //     $project_id = base64_decode($_REQUEST['project_id']);
    //     $bg_validity = $this->input->post('bg_validity');
    //     $loa_issue_date = $this->Project_agreement_model->getSpecificdata_agreement('tendering_issue_of_loa','project_id',$project_id,'loa_issue_date');

    //     if ($bg_validity < $loa_issue_date) {
    //           $this->form_validation->set_message('_bg_validity_datechecker', 'PBG submission date Must be Greater than or Same LoA issue date');
    //           return false;
    //         }else{
    //           return true;  
    //         }
    // }

    // function _notice_to_proceed_datechecker($get_date){
    //     $project_id = base64_decode($_REQUEST['project_id']);
    //     $notice_to_proceed_date = $this->input->post('notice_to_proceed_date');
    //     $loa_issue_date = $this->Project_agreement_model->getSpecificdata_agreement('tendering_issue_of_loa','project_id',$project_id,'loa_issue_date');

    //     if ($notice_to_proceed_date < $loa_issue_date) {
    //           $this->form_validation->set_message('_notice_to_proceed_datechecker', 'Notice to proceed date Must be Greater than or Same LoA issue date');
    //           return false;
    //         }else{
    //           return true;  
    //         }
    // }

    function alpha_dash_space($fullname){
    if (! preg_match('/^[a-z.,A-Z\s]+$/', $fullname)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }
}




  /* End Call Back function use for date valiadtion */



 

}

?>
