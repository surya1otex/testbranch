<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','stepsbar_helper'));
        $this->load->model('Project_model');
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
    /*Project Steps*/

    public function project_conceptualisation(){

        $data = [];
        $user_id = $this->session->userdata('id');
		$data['sectors'] = $this->Project_model->getProjectSector();
        $data['project_type'] = $this->Project_model->getAllProjectType();
        $data['project_approvers'] = $this->Project_model->get_org_users();
        $data['groups'] = $this->Project_model->getProjectGroup();
        $data['project_area'] = $this->Project_model->getAllDistrict();
        $data['project_location'] = $this->Project_model->getAllArea();
        $data['project_destinations'] = [];

        $project_id = base64_decode($_REQUEST['project_id']);
        $entry_type =$_REQUEST['type'];

        $data['preparation_status'] = $this->Project_model->checkProjectExits($project_id);
        $data['project_id'] = $project_id;

        /* check already data inserted or not */
        $check_entered = 0;
        if($entry_type == 'new'){
            $check_entered = $this->Project_model->check_prooject_value_exist_or_not_in_tbl('project_conceptualisation_stage','proj_rel_id',$project_id);

        }
        if($check_entered > 0){
            $this->session->set_flashdata('danger', 'This data already inserted!!');
            redirect('project_list/pip_conceptualisation');
        }
        
        $check_project_entered_on_concept = $this->Project_model->check_prooject_value_exist_or_not_in_tbl('project_conceptualisation_stage','id',$project_id);

        $data['concept_status'] = $check_project_entered_on_concept;
        $data['entry_type'] = $entry_type;

        if($entry_type != 'new'){
        $data['result'] = $this->Project_model->getProjectConceptualisationDetails($project_id);
        $data['steps_files'] = $this->Project_model->getFiles($project_id,'project_conceptualisation_stage_document');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'project_creator_id');
       $project_creation_id = $this->Project_model->getSpecificdata('project_creation','id',$project_id,'entered_by');
       
        $approver_id = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approver_id');
       if($project_creator_id == $user_id || $approver_id == $user_id || $project_creation_id == $user_id){
        

       }else{
        redirect('home/page_access');
       }



        /* =====End Checking for if this project this user created or not ======*/

        }else{
            $data['result'] = $this->Project_model->getProjectCreationDetails($project_id);
            $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
            $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');
        }

        // echo "<pre>";
        // print_r($this->input->post());
        // die();
        $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
			//echo "1"; die;
          $this->form_validation->set_rules('project_name', 'Project name', 'required'); 
          $this->form_validation->set_rules('expected_approval_date', 'Expected Approval Date', 'required'); 
      }
	  	else{
			
			//echo "2"; die;
        //echo "<pre>"; print_r($data['steps_files']); die;
        /*** Form Validation Rules ***/
        $this->form_validation->set_rules('project_name', 'Project name', 'required');
        $this->form_validation->set_rules('project_group', 'Project’s group', 'required');
        $this->form_validation->set_rules('location_id', 'Project Location', 'required');
        $this->form_validation->set_rules('submission_date', 'Submission Date', 'required');
        $this->form_validation->set_rules('concept_prepared_by', 'Concept Prepared By', 'required');

        $this->form_validation->set_rules('concpt_submited_status', 'Concept Submited Status', 'required');
        $this->form_validation->set_rules('expected_approval_date', 'Expected Approval Date', 'required');
        $this->form_validation->set_rules('approving_authority', 'Approving Authority', 'required');
        $this->form_validation->set_rules('estimate_total_cost', 'Estimated project cost', 'required|numeric');
        
      
        // if (!empty($_REQUEST['approve_date'])) {
        //     $this->form_validation->set_rules('approve_date', 'Approve Date', 'required|callback__aa_datechecker');
        // }

    }

        /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
			//echo "2"; die;

            $this->load->common_template('project/project_conceptualisation', $data);

        }
		else{

			//echo "3"; die;
            $db_data['project_name'] = $this->checkEmptyValue($_REQUEST['project_name']);
            $db_data['project_group'] = $this->checkEmptyValue($_REQUEST['project_group']);
            $db_data['location_id'] = $this->checkEmptyValue($_REQUEST['location_id']);
            $db_data['submission_date'] = $this->checkEmptyValue($_REQUEST['submission_date']);
            $db_data['concept_prepared_by'] = $this->checkEmptyValue($_REQUEST['concept_prepared_by']);
            $db_data['concpt_submited_status'] = $this->checkEmptyValue($_REQUEST['concpt_submited_status']);
            $db_data['expected_approval_date'] = $this->checkEmptyValue($_REQUEST['expected_approval_date']);
            $db_data['approving_authority'] = $this->checkEmptyValue($_REQUEST['approving_authority']);
            $db_data['estimate_total_cost'] = $this->checkEmptyValue($_REQUEST['estimate_total_cost']);
            // $db_data['aa_date'] = $this->checkEmptyValue($_REQUEST['approve_date']);
            /*$status = ($_REQUEST['project_dropped'] == 'N') ? 'Y' : 'N';
            if( $_REQUEST['project_dropped'] == 'Y'){

                $db_data['drop_date'] = $this->checkEmptyValue($_REQUEST['drop_date']);
                $db_data['drop_reason'] = $this->checkEmptyValue($_REQUEST['reason']);
                $db_data['drop_remarks'] = $this->checkEmptyValue($_REQUEST['remarks']);
            }*/
            //$db_data['approver_id']  = $this->checkEmptyValue($_REQUEST['project_approver']);
            $db_data['approver_id']  = $user_id;
            
            $db_data['modified_by'] = 0;
            if($draft == 'D'){
              $db_data['draft_mode'] = 'Y';
              }else{
                $db_data['draft_mode'] = 'N';
              }  

            



            /**Update Project data**/
            
            if($entry_type != 'new'){
				
				
				
				  $project_creation_data = $this->Project_model->getProjectConceptualisationDetails($project_id);

                 $db_data['project_sector'] = $project_creation_data['project_sector'];
                 $db_data['project_type'] = $project_creation_data['project_type'];
                 //$db_data['project_destination'] = $project_creation_data['location'];
                 //$db_data['location_id'] = $project_creation_data['location'];
                 $db_data['wing_id'] = $project_creation_data['wing_id'];
                 $db_data['division_id'] = $project_creation_data['division_id'];
				
				
                $db_approve_status = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'R'){
                    $db_data['approve_status'] = 'N';
                }


                $this->Project_model->updateProjectConceptualisationDetails($db_data,$project_id);


                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_model->getFiles($project_id,'project_conceptualisation_stage_document');
                
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
                        $get_old_file_name = $this->Project_model->getSpecificdata('project_conceptualisation_stage_document','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_model->deleteData('document_id', $diff, 'project_conceptualisation_stage_document');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_conceptualisation_stage_document');

                /* end file update */
                if($draft == 'D'){
                $this->session->set_flashdata('success', 'Project Record Saved as draft successfully');
                }else{
                 $this->session->set_flashdata('success', 'Project Record Updated successfully');   
                }
                
            }else{
				
				  $project_creation_data = $this->Project_model->get_project_creation_data($project_id);

                 $db_data['project_sector'] = $project_creation_data['circle_id'];
                 $db_data['project_type'] = $project_creation_data['cat_id'];
                 //$db_data['project_destination'] = $project_creation_data['location'];
                 //$db_data['location_id'] = $project_creation_data['location'];
                 $db_data['wing_id'] = $project_creation_data['wing_id'];
                 $db_data['division_id'] = $project_creation_data['division_id'];
				
                /**Insert Project data**/
                $db_data['project_creator_id'] = $this->session->userdata('id');
                $db_data['proj_rel_id'] = $project_id;
/*echo "<pre>";
print_r($db_data);
                
die;*/
                $project_id = $this->Project_model->addProjectConceptualisation($db_data);
                /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_conceptualisation_stage_document');

                /* file upload */
                if($draft == 'D'){
                $this->session->set_flashdata('success', 'Project Record Saved as draft successfully');
                }else{
                 $this->session->set_flashdata('success', 'Project Data saved successfully');   
                }
                
            }


            if($project_id){
                redirect('project_list/pip_conceptualisation');
                //redirect('Project/project_conceptualisation?project_id=' . base64_encode($project_id));
            }
        }

    }


    /* Callback approval date greter than expected date 16-08-2021 */
        // function expected_approval_date_check(){
        //     $submission_date = $this->input->post('submission_date');
        //     $expected_approval_date = $this->input->post('expected_approval_date');
        //     if (strtotime($expected_approval_date) < strtotime($submission_date) ){

        //     $this->form_validation->set_message('expected_approval_date_check', 'Expected date for Approval must be Greater than Submission date');
            
        //     return false;
        // }else{
        //   return true;  
        // }
        // }
    /* End Callback approval date greter than expected date 16-08-2021 */




    public function project_preparation(){

        $data = [];
        $user_id = $this->session->userdata('id');
        $data['project_id'] =  $_REQUEST['project_id'];
        $project_id = base64_decode($_REQUEST['project_id']);
        if(empty($project_id)){
            redirect('Project/project_conceptualisation');
        }


        $project_exist_flag = $this->Project_model->checkProjectExits($project_id);
        $data['preparation_status'] = $project_exist_flag;

        $data['user_type'] = $this->Procurement_model->getAllUserType();
        $data['user_name'] = $this->Procurement_model->getAllUserName();
        $data['project_approvers'] = $this->Project_model->get_org_users();
        $data['source_of_fund'] = $this->Project_model->get_source_fund();
        $data['result'] = $this->Project_model->getProjectPreparationDetails($project_id);

        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'project_creator_id');
       
        $project_approver_id = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

        $project_conceptualisation_app_status = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
       if ($project_conceptualisation_app_status != 'Y') {
           redirect('project/project_conceptualisation?project_id='.base64_encode($project_id));
       }
       elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        

       }else{
        redirect('home/page_access');
       }



        /* =====End Checking for if this project this user created or not ======*/
        


        $data['steps_files'] = $this->Project_model->getFiles($project_id,'project_preparation_stage_documents');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');
        
        $data['brakup_details']  = $this->Project_model->get_amount_brakup($project_id);
        $data['super_visor_dtl'] = $this->Procurement_model->getProjectUsers($project_id);

        $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('consult_appointed', 'Consultant appointed', 'required');
            
        }else{

        //echo "<pre>"; print_r($data['super_visor_dtl']); die;
        $this->form_validation->set_rules('consult_appointed', 'Consultant appointed', 'required');
        //$this->form_validation->set_rules('project_approver', 'Project approvers', 'required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');

        if( $_REQUEST['consult_appointed'] == 'Y'){

            $this->form_validation->set_rules('consultant_id', 'Consultant id', 'required');
            $this->form_validation->set_rules('consultant_name', 'Consultant name', 'required');
            $this->form_validation->set_rules('designation',   'Designation', 'required');
            $this->form_validation->set_rules('consultant_project',   'Consultant project number', 'required');
        }
        if( $_REQUEST['dpr_submit'] == 'Y'){
            //echo "<pre>"; print_r($_REQUEST); die;
            $this->form_validation->set_rules('dpr_approved', 'DPR approved', 'required');
            $this->form_validation->set_rules('dpr_cost', 'DPR cost', 'required');
        }
        if( $_REQUEST['approval_received'] == 'Y'){
            $this->form_validation->set_rules('approval_cost', 'Approval cost', 'required');
            $this->form_validation->set_rules('approval_date', 'Approval date ', 'required');
            $this->form_validation->set_rules('file_no', 'File number', 'required');
        }

    }
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_preparation', $data);
        }else{


            $db_data['consultant_appointed'] =  $this->checkEmptyValue($_REQUEST['consult_appointed']);
            $db_data['consultant_id'] =  $this->checkEmptyValue($_REQUEST['consultant_id']);
            $db_data['consultant_name '] =  $this->checkEmptyValue($_REQUEST['consultant_name']);
            $db_data['designation'] =  $this->checkEmptyValue($_REQUEST['designation']);
            $db_data['consulant_project_no'] =  $this->checkEmptyValue($_REQUEST['consultant_project']);
            $db_data['DPR_submitted'] =  $this->checkEmptyValue($_REQUEST['dpr_submit']);
            $db_data['DPR_approved'] =  $this->checkEmptyValue($_REQUEST['dpr_approved']);
            $db_data['DPR_cost'] =  $this->checkEmptyValue($_REQUEST['dpr_cost']);
            $db_data['approval_received'] =  $this->checkEmptyValue($_REQUEST['approval_received']);
            $db_data['approval_cost'] =  $this->checkEmptyValue($_REQUEST['approval_cost']);
            $db_data['approval_date'] =  $this->checkEmptyValue($_REQUEST['approval_date']);
            $db_data['file_number'] =  $this->checkEmptyValue($_REQUEST['file_no']);
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

                $db_approve_status = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'approve_status');
                if($db_approve_status == 'R'){
                    $db_data['approve_status'] = 'N';
                }

                $this->Project_model->updateProjectPreparationDetails($db_data,$project_id);


                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_model->getFiles($project_id,'project_preparation_stage_documents');
                
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
                        $get_old_file_name = $this->Project_model->getSpecificdata('project_preparation_stage_documents','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_model->deleteData('document_id', $diff, 'project_preparation_stage_documents');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_preparation_stage_documents');

                /* end file update */

                $this->session->set_flashdata('success', 'Project Record Updated successfully');



            }else{
                /**Insert Project data**/
                $db_data['project_id'] =  $project_id;
                $db_data['project_creator_id'] = $this->session->userdata('id');
                $this->Project_model->addProjectPreparation($db_data);


                /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_preparation_stage_documents');

                /* file upload */
                $this->session->set_flashdata('success', 'Project Data saved successfully');

            }

            /** Source of Fund **/
            /*if( !empty($_REQUEST['approval_received'] ) && ($_REQUEST['approval_received'] == 'Y')) {
                //echo "<pre>"; print_r($_REQUEST); //die;
                $this->Project_model->delete_old_data($project_id);
                foreach ($_REQUEST['source_of_fund'] as $key => $id) {
                    if ($_REQUEST['fund_amount'][$key] > 0) {
                        $aa_breake_up_details['source_of_fund_id'] = $id;
                        $aa_breake_up_details['amount'] = $_REQUEST['fund_amount'][$key];
                        $aa_breake_up_details['project_id'] = $project_id;
                        $aa_breake_up_details['created_by'] = $this->session->userdata('id');
                        $this->Project_model->insert_aa_mount_breakup($aa_breake_up_details);

                    }
                }
            }*/
            $post_user_type = $_REQUEST['user_type'];
            $post_user_name = $_REQUEST['user_name'];
            /** Project Users **/
            foreach ($post_user_type as $key => $val) {

                if ($val == 'Select User Type' || $post_user_name[0] == 'Select User Name') {
                    unset($_REQUEST['user_type']);
                    unset($_REQUEST['user_name']);
                    break;
                }
                $insert_arr[] = array('user_id' => $post_user_name[$key],
                    'designation_id' => $val,
                    'project_id' => $project_id,
                    'status' => 'Y');


            }
            $this->Project_model->insert_Project_users($insert_arr, $project_id);

            
            redirect('Project/project_preparation?project_id=' . base64_encode($project_id));
        }


    }
    public function project_initiation_conceptualisation(){
        $data = [];
        $data['result'] = $this->Project_model->get_project_conceptualisation_list( $this->session->userdata('id') );

        $this->load->common_template('project/project_initiation_conceptualisation', $data);
    }
    public function project_initiation_preparation(){
        $data = [];
        $data['result'] = $this->Project_model->get_project_preparation_list( $this->session->userdata('id') );

        $this->load->common_template('project/project_initiation_preparation', $data);
    }
    public function initiation_planning_approval(){
        $data = [];
        $data['result'] = $this->Project_model->get_initiation_planning_approval_list( $this->session->userdata('id') );

        $this->load->common_template('project/initiation_planning_approval', $data);
    }
    public function project_pre_tender($data = [])
    {
        $data = [];

         $data['project_id'] = base64_decode($_REQUEST['project_id']);
         $project_id = $data['project_id'];
         $user_id = $this->session->userdata('id');


		 
		// print_r($data);
	 
        if(empty($data['project_id'])){
			
            redirect('Project/project_conceptualisation');
        }

        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_creator_id');
       
        $project_approver_id = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

        $project_preparation_app_status = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'approve_status');
       if ($project_preparation_app_status != 'Y') {
           redirect('project/project_preparation?project_id='.base64_encode($project_id));
       }
       elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        

       }else{
        redirect('home/page_access');
       }



        /* =====End Checking for if this project this user created or not ======*/

        $project_exist_flag = $this->Project_model->checkProjectExits($data['project_id'],'project_pre_tender_stage');
        $data['project_pre_tender_status'] = $project_exist_flag;
        $data['project_tender_status'] = $this->Project_model->checkProjectExits($data['project_id'],'project_tender_stage');
        $data['project_agreement_status'] = $this->Project_model->checkProjectExits($data['project_id'],'project_aggrement_stage');

        $data['result'] = $this->Project_model->getProjectPreTenderDetails($data['project_id']);
        $data['steps_files'] = $this->Project_model->getFiles($data['project_id'],'project_pretender_stage_documents');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

        /*** Form Validation Rules ***/
                $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('tender_call_no', 'Tender call number', 'required');
            if(!empty( $_REQUEST['rfp_publish_date'])){
          $this->form_validation->set_rules('rfp_publish_date', 'RFP publish date', 'required|callback__pre_tender_rfp_publish_date_checker');  
        }
        if(!empty($_REQUEST['rfp_closing_date'])){
         $this->form_validation->set_rules('rfp_closing_date', 'RFP closing date', 'required|callback__pre_tender_rfp_closing_date_checker');   
        }
        if(!empty($_REQUEST['tender_approval_date'])){
         $this->form_validation->set_rules('tender_approval_date', 'Date of tender approval', 'required|callback__tender_approval_datechecker['.$project_id.']');   
        }
            
        }else{


        $this->form_validation->set_rules('tender_call_no', 'Tender call number', 'required');
        $this->form_validation->set_rules('tender_approval_date', 'Date of tender approval', 'required');

        if(!empty($_REQUEST['tender_approval_date'])){
         $this->form_validation->set_rules('tender_approval_date', 'Date of tender approval', 'callback__tender_approval_datechecker['.$project_id.']');   
        }
        $this->form_validation->set_rules('tender_doc_approval', 'Approval obtained for tender document', 'required');
        $this->form_validation->set_rules('rfp_publish_date', 'RFP publish date', 'required'); 

        if(!empty( $_REQUEST['rfp_publish_date'])){
          $this->form_validation->set_rules('rfp_publish_date', 'RFP publish date', 'callback__pre_tender_rfp_publish_date_checker');  
        }

        $this->form_validation->set_rules('rfp_closing_date', 'RFP closing date', 'required'); 

         if(!empty($_REQUEST['rfp_closing_date'])){
         $this->form_validation->set_rules('rfp_closing_date', 'RFP closing date', 'required|callback__pre_tender_rfp_closing_date_checker');   
        }

        
        $this->form_validation->set_rules('project_re_tender', 'Project Re-tendered', 'required');
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        if( $_REQUEST['project_re_tender'] == 'Y'){
            $this->form_validation->set_rules('retender_reason', 'Reason for re-tendering', 'required');
        }
    }
        /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_pre_tender', $data);

        }else {



            $data_project_conceptual = $this->Project_model->getProjectConceptualisationDetails($data['project_id']);
            $data_project_preparation = $this->Project_model->getProjectPreparationDetails($data['project_id']);

            $project_db_pre_tender_status = $this->Project_model->getSpecificdata('project_pre_tender_stage','project_id',$project_id,'approve_status');

            if($_REQUEST['project_re_tender']  == 'Y' && $project_exist_flag==true && $project_db_pre_tender_status == 'Y'){

                
                $step_no = 3;
                $last_date_of_approval = $this->Project_model->get_last_date_from_approval($project_id,$step_no,'approval_date');

                $arr['project_id'] = base64_decode($_REQUEST['project_id']);
                $arr['project_code'] = $data_project_conceptual['project_code'];
                $arr['project_type'] = $data_project_conceptual['project_type'];
                $arr['project_name'] = $data_project_conceptual['project_name'];
                $arr['project_group'] = $data_project_conceptual['project_group'];
                $arr['project_sector'] = $data_project_conceptual['project_sector'];
                $arr['project_destination'] = $data_project_conceptual['project_destination'];
                $arr['project_area'] = $data_project_conceptual['project_area'];
                $arr['aa_date'] = $data_project_conceptual['aa_date'];
                
                
                $arr['estimate_total_cost'] = $data_project_conceptual['estimate_total_cost'];
                
                 $arr['file_no'] = $data_project_preparation['file_number'];
                
                $arr['tender_call_no'] = $_REQUEST['tender_call_no'];
                //$arr['tender_approval_date'] = $_REQUEST['tender_approval_date'];
                $arr['tender_document_approved'] =$_REQUEST['tender_doc_approval'];
                $arr['rfp_publishing_date'] = $_REQUEST['rfp_publish_date'];
                $arr['rfp_closing_date'] = $_REQUEST['rfp_closing_date'];
                $arr['re_tender_status'] = $_REQUEST['project_re_tender'];
                $arr['remarks_for_retender'] = $_REQUEST['retender_reason'];
                $arr['remarks_pre_tender'] = $_REQUEST['remarks'];
                $arr['tender_document_approval_date'] = $last_date_of_approval;
                //$arr['approve_status_pre_tender'] = !empty($_REQUEST['approve_status']) ? $_REQUEST['approve_status'] : 'N';
                $this->Project_model->insertTenderHistory($arr);
                $this->Project_model->deletePreTender(base64_decode($_REQUEST['project_id']));

                


                /* new code by somnath*/
                $db_data['tender_call_no'] =  $this->checkEmptyValue($_REQUEST['tender_call_no']);
                
                $db_data['tender_approval_date'] =  $this->checkEmptyValue($_REQUEST['tender_approval_date']);
                $db_data['tender_document_approved'] =  $this->checkEmptyValue($_REQUEST['tender_doc_approval']);
                $db_data['rfp_publishing_date'] =  $this->checkEmptyValue($_REQUEST['rfp_publish_date']);
                $db_data['rfp_closing_date'] =  $this->checkEmptyValue($_REQUEST['rfp_closing_date']);
                $db_data['re_tender_status'] =  $this->checkEmptyValue($_REQUEST['project_re_tender']);
                $db_data['remarks_for_retender'] =  $this->checkEmptyValue($_REQUEST['retender_reason']);
                $db_data['remarks'] =  $this->checkEmptyValue($_REQUEST['remarks']);
                $db_data['created_by'] =  $this->session->userdata('id');
                $db_data['modified_by'] =  $this->session->userdata('id');

                $db_data['project_id'] = $data['project_id'];
                $db_data['project_creator_id'] =  $this->session->userdata('id');
                $this->Project_model->addProjectPreTender($db_data);

                $doc_arr = $this->Project_model->getFiles($project_id,'project_pretender_stage_documents');

                
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
                        $get_old_file_name = $this->Project_model->getSpecificdata('project_pretender_stage_documents','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_model->deleteData('document_id', $diff, 'project_pretender_stage_documents');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_pretender_stage_documents');
                




                $this->session->set_flashdata('success', 'Project Record Updated successfully');
				redirect('Project/project_pre_tender?project_id=' . base64_encode($data['project_id']));


            }else{
                $db_data['tender_call_no'] =  $this->checkEmptyValue($_REQUEST['tender_call_no']);
                
                $db_data['tender_approval_date'] =  $this->checkEmptyValue($_REQUEST['tender_approval_date']);
                $db_data['tender_document_approved'] =  $this->checkEmptyValue($_REQUEST['tender_doc_approval']);
                $db_data['rfp_publishing_date'] =  $this->checkEmptyValue($_REQUEST['rfp_publish_date']);
                $db_data['rfp_closing_date'] =  $this->checkEmptyValue($_REQUEST['rfp_closing_date']);
                $db_data['re_tender_status'] =  $this->checkEmptyValue($_REQUEST['project_re_tender']);
                $db_data['remarks_for_retender'] =  $this->checkEmptyValue($_REQUEST['retender_reason']);
                $db_data['remarks'] =  $this->checkEmptyValue($_REQUEST['remarks']);
                $db_data['created_by'] =  $this->session->userdata('id');

                if($draft == 'D'){
                  $db_data['draft_mode'] = 'Y';
                  }else{
                    $db_data['draft_mode'] = 'N';
                  } 
                //$db_data['status'] =  'Y';
                
                /**Update Project data**/
                if($project_exist_flag){
                    $db_data['modified_by'] =  $this->session->userdata('id');
                    $db_approve_status = $this->Project_model->getSpecificdata('project_pre_tender_stage','project_id',$data['project_id'],'approve_status');
                    if($db_approve_status == 'R'){
                        $db_data['approve_status'] = 'N';
                    }
                    $this->Project_model->updateProjectPreTenderDetails($db_data,$data['project_id']);

                    /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_model->getFiles($project_id,'project_pretender_stage_documents');
                
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
                        $get_old_file_name = $this->Project_model->getSpecificdata('project_pretender_stage_documents','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_model->deleteData('document_id', $diff, 'project_pretender_stage_documents');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_pretender_stage_documents');

                /* end file update */
                $this->session->set_flashdata('success', 'Project Record Updated successfully');


                }else{
                    /**Insert Project data**/
                    $db_data['project_id'] = $data['project_id'];
                    $db_data['project_creator_id'] =  $this->session->userdata('id');
                    $this->Project_model->addProjectPreTender($db_data);
                    /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_pretender_stage_documents');

                /* file upload */
                $this->session->set_flashdata('success', 'Project Data Added successfully');

                }
            }

            

            redirect('Project/project_pre_tender?project_id=' . base64_encode($data['project_id']));
        }

    }
    public function project_tender($data = [])
    {
        $data = [];
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $user_id = $this->session->userdata('id');
        $project_id = $data['project_id'];
        if(empty($data['project_id'])){
            redirect('Project/project_conceptualisation');
        }


        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_creator_id');
       
        $project_approver_id = $this->Project_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

        $pre_tender_app_status = $this->Project_model->getSpecificdata('project_pre_tender_stage','project_id',$project_id,'approve_status');
       if ($pre_tender_app_status != 'Y') {
        
           redirect('project/project_pre_tender?project_id='.base64_encode($project_id));
       }elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        

       }else{
        redirect('home/page_access');
       }



        /* =====End Checking for if this project this user created or not ======*/


        $data['project_pre_tender_status'] = $this->Project_model->checkProjectExits($data['project_id'],'project_pre_tender_stage');
        $data['project_tender_status'] = $this->Project_model->checkProjectExits($data['project_id'],'project_tender_stage');
        $data['project_agreement_status'] = $this->Project_model->checkProjectExits($data['project_id'],'project_aggrement_stage');


        $data['result'] = $this->Project_model->getProjectTenderDetails($data['project_id']);
        $data['steps_files'] = $this->Project_model->getFiles($data['project_id'],'project_tender_stage_documents');


        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

       //echo "<pre>"; print_r($data['result']); die;
        /*** Form Validation Rules ***/
         $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('rfp_publish_date', 'Final RFP publish date', 'required');
            if(!empty($_REQUEST['rfp_publish_date'])){
            $this->form_validation->set_rules('rfp_publish_date', 'Final RFP publish date', 'required|callback__tender_rfp_publish_date_checker['.$project_id.']');
        }
        if(!empty($_REQUEST['rfp_closing_date'])){
            $this->form_validation->set_rules('rfp_closing_date', 'Final RFP closing date', 'callback__tender_rfp_closing_datechecker');
        }
        if(!empty($_REQUEST['tech_opening_date'])){
            $this->form_validation->set_rules('tech_opening_date', 'Technical bid opening date', 'callback__tender_tech_opening_datechecker');
        }

        if(!empty($_REQUEST['finance_open_date'])){
            $this->form_validation->set_rules('finance_open_date', 'Financial bid opening date', 'callback__tender_finance_open_datechecker');
        }

        if(!empty($_REQUEST['tender_ly_date'])){
            $this->form_validation->set_rules('tender_ly_date', 'Tender LOI issue date', 'callback__tender_tender_ly_datechecker');
        }

        }else{
        $this->form_validation->set_rules('rfp_publish_date', 'Final RFP publish date', 'required');
            if(!empty($_REQUEST['rfp_publish_date'])){
            $this->form_validation->set_rules('rfp_publish_date', 'Final RFP publish date', 'required|callback__tender_rfp_publish_date_checker['.$project_id.']');
        }
        $this->form_validation->set_rules('rfp_closing_date', 'Final RFP closing date', 'required');
        if(!empty($_REQUEST['rfp_closing_date'])){
            $this->form_validation->set_rules('rfp_closing_date', 'Final RFP closing date', 'callback__tender_rfp_closing_datechecker');
        }
        $this->form_validation->set_rules('tech_opening_date', 'Technical bid opening date', 'required');
        if(!empty($_REQUEST['tech_opening_date'])){
            $this->form_validation->set_rules('tech_opening_date', 'Technical bid opening date', 'callback__tender_tech_opening_datechecker');
        }
        $this->form_validation->set_rules('finance_open_date', 'Financial bid opening date', 'required');
        if(!empty($_REQUEST['finance_open_date'])){
            $this->form_validation->set_rules('finance_open_date', 'Financial bid opening date', 'callback__tender_finance_open_datechecker');
        }
        $this->form_validation->set_rules('tender_ly_date', 'Tender LOI issue date', 'required');
        if(!empty($_REQUEST['tender_ly_date'])){
            $this->form_validation->set_rules('tender_ly_date', 'Tender LOI issue date', 'callback__tender_tender_ly_datechecker');
        }
        //$this->form_validation->set_rules('remarks', 'Remarks', 'required');
        }

        /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_tender', $data);

        }else{

            $db_data['final_date_rfp_publish'] =  $this->checkEmptyValue($_REQUEST['rfp_publish_date']);
            $db_data['final_date_rfp_close'] =  $this->checkEmptyValue($_REQUEST['rfp_closing_date']);;
            
            $db_data['tech_bid_opening_date'] =  $this->checkEmptyValue($_REQUEST['tech_opening_date']);
            $db_data['finance_bid_opening_date'] =  $this->checkEmptyValue($_REQUEST['finance_open_date']);
            $db_data['tender_ly_date'] =  $this->checkEmptyValue($_REQUEST['tender_ly_date']);
            $db_data['remarks'] =  $this->checkEmptyValue($_REQUEST['remarks']);
           // $db_data['status'] =  'Y';
            if($draft == 'D'){
          $db_data['draft_mode'] = 'Y';
          }else{
            $db_data['draft_mode'] = 'N';
          } 

            $project_exist_flag = $this->Project_model->checkProjectExits($data['project_id'],'project_tender_stage');
            /**Update Project data**/
            if($project_exist_flag){
                $db_data['modified_by'] =  $this->session->userdata('id');

                $db_approve_status = $this->Project_model->getSpecificdata('project_tender_stage','project_id',$data['project_id'],'approve_status');
                if($db_approve_status == 'R'){
                    $db_data['approve_status'] = 'N';
                }
                $this->Project_model->updateProjectTenderDetails($db_data,$data['project_id']);

                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_model->getFiles($project_id,'project_tender_stage_documents');
                
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
                        $get_old_file_name = $this->Project_model->getSpecificdata('project_tender_stage_documents','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_model->deleteData('document_id', $diff, 'project_tender_stage_documents');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_tender_stage_documents');

                /* end file update */
                $this->session->set_flashdata('success', 'Project Record Updated successfully');


            }else{
                /**Insert Project data**/
                $db_data['modified_by'] =  0;
                $db_data['project_id'] = $data['project_id'];
                $db_data['created_by'] = $this->session->userdata('id');
                $db_data['project_creator_id'] =  $this->session->userdata('id');
                $this->Project_model->addProjectTender($db_data);

                 /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_tender_stage_documents');

                /* file upload */

                $this->session->set_flashdata('success', 'Project Data saved successfully');

            }
            
            $data_project_preparation = $this->Project_model->getProjectPreparationDetails($data['project_id']);
            redirect('Project/project_tender?project_id=' . base64_encode($data['project_id']));
        }



    }
    
    public function project_initiation_pre_tender(){
        $data = [];
        $data['result'] = $this->Project_model->get_project_pre_tender_list( $this->session->userdata('id') );
        //echo "<pre>"; print_r($data['result']); die;
        $this->load->common_template('project/project_initiation_pre_tender', $data);
    }
    public function project_initiation_tender(){
        $data = [];
        $data['result'] = $this->Project_model->get_project_tender_list( $this->session->userdata('id') );

        $this->load->common_template('project/project_initiation_tender', $data);
    }
    public function project_initiation_agreement(){
        $data = [];
        $data['result'] = $this->Project_model->get_project_agreement_list( $this->session->userdata('id') );

        $this->load->common_template('project/project_initiation_agreement', $data);
    }
    public function checkEmptyValue($value)
    {
        return !empty($value) ? $value : NULL;
    }

    public function update_approval( $project_id, $approvrer_id){

        $project_approver_data['project_id']  = $project_id;
        $project_approver_data['requester_id']  = $this->session->userdata('id');
        $project_approver_data['approver_id']  = $approvrer_id;
        $project_approver_data['project_step_no']  = $project_steps;
        $project_approver_data['created_by']  = $this->session->userdata('id');
        $project_approver_data['created_on']  = date('y-m-d');
        $project_approver_data['type']  = "Project";

        $this->Project_model->addProjectApproval($project_approver_data);
    }
    public function  submit_approval(){

        $data['request_id'] = base64_decode($_REQUEST['request_id']);
        $temp = $this->Project_model->get_approval_project_id( $data['request_id'] );

        $data['project_details'] = $this->Project_model->get_project_details($temp[0]['project_id'] );
        //$planning_approvers = $this->Project_model->get_planning_approver( $temp[0]['project_id'] );
        /*for( $i = 0; $i < count($planning_approvers) ; $i++){
            if($planning_approvers[$i]['user_type'] == 2){
                $user_details = $this->Project_model->get_level2_details( $planning_approvers[$i]['id']);
                $name = $user_details[0]['name'];
            }else if ($planning_approvers[$i]['user_type'] == 3){
                $user_details = $this->Project_model->get_level3_details( $planning_approvers[$i]['id'] );
                $name = $user_details[0]['firstname']." ".$name = $user_details[0]['lastname'];;
            }
            $planning_approvers[$i]['name'] = $name;
        }
        $data['planning_approvers'] = $planning_approvers;*/
        $area_name = $this->Project_model->get_project_area($temp[0]['project_area']);
        $data['project_area_name'] = $area_name[0]['name'];

        $project_type =$this->Project_model->get_project_type($temp[0]['project_type']);
        $data['project_type_name'] = $project_type[0]['project_type'];
        $request_details = $this->Project_model->get_project_approval_details($data['request_id']);

        $date_request = new DateTime($request_details[0]['date_request']);

        $data['request']['request_on'] = $date_request->format('jS M Y');
        if($request_details[0]['user_type'] == 3){
            $user_details = $this->Project_model->get_level3_details($request_details[0]['id']);
            $data['request']['requester'] = $user_details[0]['firstname']. " ". $user_details[0]['lastname'];
        }
        $_REQUEST['request_type'] = base64_decode($_REQUEST['request_type']);
        if( $_REQUEST['request_type'] == 'Approve' ){

            $data['tittle'] = "Approve";
        }else{
            $data['tittle'] = "Reject";
        }

        $request_id =  base64_decode($_REQUEST['request_id']);
        $approval_data['remarks'] = $_REQUEST['remarks'];


        /*if( $_REQUEST['request_type'] == 'Approve' ) {
             $this->form_validation->set_rules('planning_approver', 'Planning Approvers', 'required');
        }*/

        $this->form_validation->set_rules('approve_date', 'Approve Date', 'required');

        if ($this->form_validation->run() == FALSE  ) {

            $this->load->common_template('project/project_approval', $data);

        } else {

            if( !empty($_FILES['attachment'])) {
                $config['upload_path'] = 'uploads/attachment/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx";
                $config['max_size'] = 2000000;
                //$config['file_name'] = $_FILES['attachment']['name'] . "_" . time();
                $this->load->library('upload', $config);
                $data = [];
                $flie_upload_error_flag = 0;

                if (!$this->upload->do_upload('attachment') && !empty($_FILES['attachment']['name'])) {
                    $data['flie_upload_error_flag'] = $flie_upload_error_flag;

                } else {
                    $file_data = $this->upload->data();

                }
            }

            if (!empty($_REQUEST['request_type']) && $_REQUEST['request_type'] == 'Approve') {

                $approval_data['approval_status'] = 'Y';
                $approval_data['approval_date'] = $_REQUEST['approve_date'];

                $project_data['status'] = 'Y';
                $project_data['approve_status'] = 'Y';
                $project_data['project_id'] = $temp[0]['project_id'];
                //$project_data['planning_approver_id'] = $_REQUEST['planning_approver'];

            } else {

                $project_data['status'] = 'N';
                $project_data['approve_status'] = 'N';
                $project_data['project_id'] = $temp[0]['project_id'];
                //$project_data['planning_approver_id'] = $_REQUEST['planning_approver'];

                $approval_data['approval_date'] = $_REQUEST['approve_date'];
                $approval_data['approval_status'] = 'N';
            }
            if( $temp[0]['project_step_no'] <= 2 ){

                $this->Project_model->updateProjectInitiationDetails($project_data);

            }else{
                $this->Project_model->updateProjectDetails($project_data);
            }
           // $this->Project_model->updateProjectDetails($project_data);
            $approval_data['attachment'] = !empty($_FILES['attachment']) ? $file_data['file_name'] : "";
            //echo "<pre>"; print_r($approval_data); echo $request_id; die;
            $this->Project_model->submit_approval($approval_data, $request_id);
            $this->session->set_flashdata('message', 'Data updated Successfully');
            redirect('Project/approval');
        }
    }
    public function approval(){

        $data['result'] = $this->Project_model->get_approval_project_list($this->session->userdata('id'));
       //echo "<pre>"; print_r($data['result']); die;
        $data['user_details'] = $this->Project_model->get_org_user_details($this->session->userdata('id'));
        $this->load->common_template('project/approval_list', $data);
    }
    public function project_approval(){

        $data['request_id'] = base64_decode($_REQUEST['request_id']);
        $temp = $this->Project_model->get_approval_project_id( $data['request_id'] );
        $data['project_details'] = $this->Project_model->get_project_details($temp[0]['project_id'] );
        /*$planning_approvers = $this->Project_model->get_planning_approver( $temp[0]['project_id'] );
        for( $i = 0; $i < count($planning_approvers) ; $i++){
            if($planning_approvers[$i]['user_type'] == 2){
                $user_details = $this->Project_model->get_level2_details( $planning_approvers[$i]['id']);
                $name = $user_details[0]['name'];
            }else if ($planning_approvers[$i]['user_type'] == 3){
                $user_details = $this->Project_model->get_level3_details( $planning_approvers[$i]['id'] );
                $name = $user_details[0]['firstname']." ".$name = $user_details[0]['lastname'];;
            }
            $planning_approvers[$i]['name'] = $name;
        }
        $data['planning_approvers'] = $planning_approvers;*/
        $area_name = $this->Project_model->get_project_area($temp[0]['project_area']);
        $data['project_area_name'] = $area_name[0]['name'];

        $project_type =$this->Project_model->get_project_type($temp[0]['project_type']);
        $data['project_type_name'] = $project_type[0]['project_type'];
        $request_details = $this->Project_model->get_project_approval_details($data['request_id']);

        $date_request = new DateTime($request_details[0]['date_request']);

        $data['request']['request_on'] = $date_request->format('jS M Y');
        if($request_details[0]['user_type'] == 3){
            $user_details = $this->Project_model->get_level3_details($request_details[0]['id']);
            $data['request']['requester'] = $user_details[0]['firstname']. " ". $user_details[0]['lastname'];
        }

        $data['tittle'] = "Approve";
        $this->load->common_template('project/project_approval', $data);

    }
    /* Project List */
    public function project_list()
    {
        $data['project_deatail'] = $this->Project_model->get_project_details('','','');
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
        $this->load->common_template('project/project_list', $data);
    }
    /* Project Approval List */

    /* Physical Planning List */
    public function physical_planning(){

        $data['project_deatail'] = $this->Project_model->get_project_physical_list($this->session->userdata('id'));

        $this->load->common_template('project/physical_planning_list', $data);
    }
    /* User wise Project List */
    public function entry(){

        $data['project_deatail'] = $this->Project_model->get_entry_project_details($this->session->userdata('id'));
       // echo "<pre>";print_r($data['project_deatail']); die;
        for ( $i = 0; $i < count($data['project_deatail']); $i++){
            $temp = $this->Project_model->get_final_approval_status($data['project_deatail'][$i]['id']);
            $data['project_deatail'][$i]['approval_status'] = $temp[0]['approval_status'];
        }

        $this->load->common_template('project/entry_list', $data);
    }
    /*Project view details */
    public function project_view(){

        $project_id = base64_decode($_REQUEST['project_id']);
        $res = $this->Procurement_model->getProjectDetails($project_id);
        $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
        $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
        $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
        $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
        $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
        $data['result'] = $res;
        $arr = $this->Procurement_model->getTenderDetails($project_id);
        $data['result_tender'] = $arr[0];

        $this->load->common_template('project/project_view', $data);

    }
    public function project_reject(){

        $data['request_id'] = base64_decode($_REQUEST['request_id']);
        $temp = $this->Project_model->get_approval_project_id( $data['request_id'] );
        $data['project_details'] = $this->Project_model->get_project_details($temp[0]['project_id'] );
        $planning_approvers = $this->Project_model->get_planning_approver( $temp[0]['project_id'] );

        for( $i = 0; $i < count($planning_approvers) ; $i++){
           if ($planning_approvers[$i]['user_type'] == 3){
                $user_details = $this->Project_model->get_level3_details( $planning_approvers[$i]['id'] );
                $name = $user_details[0]['firstname']." ".$name = $user_details[0]['lastname'];;
            }
            $planning_approvers[$i]['name'] = $name;
        }
        $data['planning_approvers'] = $planning_approvers;
        $area_name = $this->Project_model->get_project_area($temp[0]['project_area']);
        $data['project_area_name'] = $area_name[0]['name'];

        $project_type =$this->Project_model->get_project_type($temp[0]['project_type']);
        $data['project_type_name'] = $project_type[0]['project_type'];
        $request_details = $this->Project_model->get_project_approval_details($data['request_id']);

        $date_request = new DateTime($request_details[0]['date_request']);
        $data['request']['request_on'] = $date_request->format('jS M Y');
         if($request_details[0]['user_type'] == 3){
            $user_details = $this->Project_model->get_level3_details($request_details[0]['id']);
            $data['request']['requester'] = $user_details[0]['firstname']. " ". $user_details[0]['lastname'];
        }
        $data['tittle'] = "Reject";

        $this->load->common_template('project/project_approval', $data);

    }
    public function get_project_monitoring_type( $project_id){
        $data = $this->Project_model->get_project_monitoring_type( $project_id);
        return !empty($data['type_monitoring']) ? $data['type_monitoring'] : 'Work Item';
    }


    /*Add project Second  Step*/
    public function pre_tender_stage($data = [])
    {
        $form_type_arr = array(
            'pre_tender_stage' => ['tender_call_no', 'tender_document_approval_date', 'tender_document_approved', 'rfp_publishing_date', 'rfp_closing_date', 're_tender_status'],
            'basic_stage' => ['project_sector', 'project_group', 'project_name', 'project_code', 'project_destination',
                'project_area', 'estimate_total_cost', 'aa_date', 'project_type', 'file_no'],

        );

        $data = [];
        $project_id = base64_decode($_REQUEST['project_id']);
        if (!empty($project_id)) {
            $data['steps_status_arr'] = $this->project_steps_submit_status($project_id);
            $data['status_arr'] = $this->project_steps_submit_status($project_id);

            $data['project_id'] = $project_id;
            $data['tender_histroy'] = $this->Project_model->getTenderHistory($project_id);

            $data['submit_status'] = $this->checkFormStatus($project_id, $form_type_arr['pre_tender_stage']);
            $res = $this->Procurement_model->getProjectDetails($project_id);

            $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
            $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
            $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
            $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
            $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
            $data['result'] = $res;
            $arr = $this->Procurement_model->getTenderDetails($project_id);
            $data['result_tender'] = $arr[0];

        } else {
            redirect('Project/project_initiation');
        }
        $this->form_validation->set_rules('tender_call_no', 'Tender call Number', 'required');

        if (!empty($_REQUEST['tender_document_approval_date'])) {
            $this->form_validation->set_rules('tender_document_approval_date', 'Date of Tender Approval', 'required|callback__tender_datechecker');
        }
        if (!empty($_REQUEST['rfp_publishing_date'])) {
            $this->form_validation->set_rules('rfp_publishing_date', 'RFP publish date', 'required|callback__rfp_publish_datechecker');
        }
        if (!empty($_REQUEST['rfp_closing_date'])) {

            $this->form_validation->set_rules('rfp_closing_date', 'RFP closing date', 'required|callback__rfp_closing_datechecker');
        }


        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/tender_stage', $data);

        } else {

            $data = [];

            $data['tender_call_no'] = $this->checkEmptyValue($_REQUEST['tender_call_no']);
            $data['tender_document_approval_date'] = $this->checkEmptyValue($_REQUEST['tender_document_approval_date']);
            $data['tender_document_approved'] = $this->checkEmptyValue($_REQUEST['tender_document_approved']);
            $data['rfp_publishing_date'] = $this->checkEmptyValue($_REQUEST['rfp_publishing_date']);
            $data['rfp_closing_date'] = $this->checkEmptyValue($_REQUEST['rfp_closing_date']);
            $data['re_tender_status'] = $this->checkEmptyValue($_REQUEST['re_tender_status']);
            $data['remarks_for_retender'] = $this->checkEmptyValue($_REQUEST['remarks_for_retender']);
            $data['remarks_pre_tender'] = $this->checkEmptyValue($_REQUEST['remarks_pre_tender']);
            //$data['status'] = 'N';
            $this->update_approval( $project_id,$res['approver_id']);
            if ($data['re_tender_status'] == 'Y') {
                $tender_data = $data;
                if (!empty($_REQUEST['project_id'])) {
                    $tender_data['project_id'] = base64_decode($_REQUEST['project_id']);
                    $project_basic_detail = $this->Project_model->getProjectBasicDetails($project_id, $form_type_arr['basic_stage']);
                    unset($_REQUEST['tender_id']);
                    unset($_REQUEST['re_tender_status']);

                    $insert_arr = array_merge($project_basic_detail[0], $_REQUEST);
                    $insert_arr['project_id'] = base64_decode($_REQUEST['project_id']);
                    $update_pre_tender_data = array_fill_keys(array_values($form_type_arr['pre_tender_stage']), '');
                    $update_pre_tender_data['remarks_for_retender'] = '';
                    unset($insert_arr['/Project/pre_tender_stage']);
                    $this->Project_model->insertTenderHistory($insert_arr);
                    $this->Project_model->updatePretenderData($project_id, $update_pre_tender_data);
                    $this->Project_model->deleteTender(base64_decode($_REQUEST['project_id']));

                    redirect('Project/project_initiation?project_id=' . $_REQUEST['project_id']);
                } else {
                    redirect('Project/project_initiation');
                }

            } else {
                if (!empty($_REQUEST['project_id'])) {
                    $data['project_id'] = base64_decode($_REQUEST['project_id']);

                    $result = $this->Project_model->updateProjectDetails($data);

                } else {
                    redirect('Project/project_initiation');
                }

                if ($result) {

                    redirect('Project/pre_tender_stage?project_id=' . $_REQUEST['project_id']);

                }
            }

        }


    }
    /*Add project Third Step*/
    public function tender_stage($data = [])
    {

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $form_type_arr = array(
            'tender_stage' => array('revised_rfp_publishing_date', 'revised_rfp_closing_date', 'final_date_rfp_publish', 'final_date_rfp_close',
                'tech_bid_opening_date', 'finance_bid_opening_date', 'tender_ly_date'
            )
        );

        if (!empty($project_id)) {

            $data['steps_status_arr'] = $this->project_steps_submit_status($project_id);
            $data['project_id'] = $project_id;
            $data['tender_histroy'] = $this->Project_model->getTenderHistory($project_id);
            $data['status_arr'] = $this->project_steps_submit_status($project_id);
            $data['submit_status'] = $this->checkFormStatus($project_id, $form_type_arr['tender_stage'], 'tender_details');
            $res = $this->Procurement_model->getProjectDetails($project_id);
            $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
            $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
            $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
            $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
            $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
            $data['result'] = $res;

            $arr = $this->Procurement_model->getTenderDetails($project_id);
            $data['result_tender'] = $arr[0];

            $data['tender_id'] = $data['result_tender']['id'];
        } else {
            redirect('Project/project_initiation');
        }

        $this->form_validation->set_rules('revised_rfp_publish_date', 'Revised RFP publish date', 'required|callback__revised_rfp_publish_datechecker');

        if (!empty($_REQUEST['revised_rfp_closing_date'])) {

            $this->form_validation->set_rules('revised_rfp_closing_date', 'Revised RFP closing date', 'required|callback__revised_rfp_closing_datechecker');
        }
        if (!empty($_REQUEST['final_date_rfp_publish'])) {

            $this->form_validation->set_rules('final_date_rfp_publish', 'Final RFP publish date', 'required|callback__final_date_rfp_publish_datechecker');
        }
        if (!empty($_REQUEST['final_date_rfp_publish'])) {

            $this->form_validation->set_rules('final_date_rfp_close', 'Final RFP closing date', 'required|callback__final_date_rfp_close_datechecker');
        }
        if (!empty($_REQUEST['tech_bid_opening_date'])) {

            $this->form_validation->set_rules('tech_bid_opening_date', 'Technical bid opening date', 'required|callback__tech_bid_opening_date_datechecker');
        }
        if (!empty($_REQUEST['finance_bid_opening_date'])) {

            $this->form_validation->set_rules('finance_bid_opening_date', 'Financial bid opning date', 'required|callback__finance_bid_opening_date_datechecker');
        }
        if (!empty($_REQUEST['tender_ly_date'])) {

            $this->form_validation->set_rules('tender_ly_date', 'Tender LY Issue Date', 'required|callback__tender_ly_date_datechecker');
        }

        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/tender_stage_final', $data);
        } else {

            $data = [];
            $data['revised_rfp_publishing_date'] = $this->checkEmptyValue($_REQUEST['revised_rfp_publish_date']);
            $data['revised_rfp_closing_date'] = $this->checkEmptyValue($_REQUEST['revised_rfp_closing_date']);
            $data['final_date_rfp_publish'] = $this->checkEmptyValue($_REQUEST['final_date_rfp_publish']);
            $data['final_date_rfp_close'] = $this->checkEmptyValue($_REQUEST['final_date_rfp_close']);
            $data['finance_bid_opening_date'] = $this->checkEmptyValue($_REQUEST['finance_bid_opening_date']);
            $data['tech_bid_opening_date'] = $this->checkEmptyValue($_REQUEST['tech_bid_opening_date']);
            $data['tender_ly_date'] = $this->checkEmptyValue($_REQUEST['tender_ly_date']);

            $data['project_id'] = base64_decode($_REQUEST['project_id']);
            $this->update_approval( $project_id,$res['approver_id']);
            if (!empty($_REQUEST['project_id']) && !empty($_REQUEST['tender_id'])) {
                $data['tender_id'] = base64_decode($_REQUEST['tender_id']);
                $result = $this->Project_model->updateTenderDetails($data);

            } else {

                $result = $this->Project_model->addTenderDetails($data);
            }
        }
        if ($result) {

            redirect('Project/tender_stage?project_id=' . $_REQUEST['project_id']);

        }

    }
    /*Add project Fourth & final Step*/
    public function agreement_stage($data = [])
    {

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $form_type_arr = array(
            'agreement_stage' => array('other_bidder_details', 'bg_validity_date', 'bg_amount', 'representative_name',
                'bidder_details', 'agreement_end_date', 'agreement_cost', 'agreement_date', 'project_start_date', 'project_end_date', 'monitoring_frequency','type_monitoring')
        );
        if (!empty($project_id)) {

            $data['steps_status_arr'] = $this->project_steps_submit_status($project_id);
            $data['project_id'] = $project_id;
            $data['tender_histroy'] = $this->Project_model->getTenderHistory($project_id);
            $data['status_arr'] = $this->project_steps_submit_status($project_id);
            $data['submit_status'] = $this->checkFormStatus($project_id, $form_type_arr['agreement_stage'], 'tender_details');
            $res = $this->Procurement_model->getProjectDetails($project_id);
            $res['group_name'] = $this->Procurement_model->getGroupName($res['project_group']);
            $res['sector_name'] = $this->Procurement_model->getSectorName($res['project_sector']);
            $res['project_type_name'] = $this->Procurement_model->getProjectTypeName($res['project_type']);
            $res['project_destination_name'] = $this->Procurement_model->getDestinationName($res['project_destination']);
            $res['project_area_name'] = $this->Procurement_model->getAreaName($res['project_area']);
            $data['result'] = $res;

            $arr = $this->Project_model->getTenderDetails($project_id);
            $data['result_tender'] = $arr[0];

            $data['tender_id'] = $data['result_tender']['id'];
        } else {
            redirect('Project/project_initiation');
        }
        $this->form_validation->set_rules('agreement_date', 'Agreement Date', 'required');
        if (!empty($_REQUEST['agreement_date'])) {

            $this->form_validation->set_rules('agreement_date', 'Agreement date', 'required|callback__agreement_datechecker');
        }
        if (!empty($_REQUEST['agreement_cost'])) {

            $this->form_validation->set_rules('agreement_cost', 'Agreement Cost', 'numeric');
        }
        if (!empty($_REQUEST['bg_validity_date'])) {

            $this->form_validation->set_rules('bg_validity_date', 'BG Validity', 'required|callback__bg_validity_datechecker');
        }

        if (!empty($_REQUEST['agreement_end_date']) && !empty($_REQUEST['agreement_date'])) {

            $this->form_validation->set_rules('agreement_end_date', 'Agreement end date', 'required|callback__datechecker');
        }
        if (!empty($_REQUEST['project_start_date'])) {

            $this->form_validation->set_rules('project_start_date', 'Project Start Date', 'required|callback__project_start_datechecker');
        }
        if (!empty($_REQUEST['project_end_date'])) {

            $this->form_validation->set_rules('project_end_date', 'Project End Date', 'required|callback__project_end_datechecker');
        }


        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/agreement_stage', $data);
        } else {
            $data = [];
            $project_start_date = !empty($_REQUEST['project_start_date']) ? $_REQUEST['project_start_date'] : $this->checkEmptyValue($_REQUEST['agreement_date']);
            $project_end_date = !empty($_REQUEST['project_end_date']) ? $_REQUEST['project_end_date'] : $this->checkEmptyValue($_REQUEST['agreement_end_date']);
            $data['agreement_date'] = $this->checkEmptyValue($_REQUEST['agreement_date']);
            $data['agreement_cost'] = $this->checkEmptyValue($_REQUEST['agreement_cost']);
            $data['agreement_end_date'] = $this->checkEmptyValue($_REQUEST['agreement_end_date']);
            $data['bidder_details'] = $this->checkEmptyValue($_REQUEST['bidder_details']);
            $data['representative_name'] = $this->checkEmptyValue($_REQUEST['representative_name']);
            $data['bg_amount'] = $this->checkEmptyValue($_REQUEST['bg_amount']);
            $data['bg_validity_date'] = $this->checkEmptyValue($_REQUEST['bg_validity_date']);
            $data['other_bidder_details'] = $this->checkEmptyValue($_REQUEST['other_bidder_details']);
            $data['project_start_date'] = $this->checkEmptyValue($project_start_date);
            $data['project_end_date'] = $this->checkEmptyValue($project_end_date);
            $data['monitoring_frequency'] = $this->checkEmptyValue($_REQUEST['monitoring_type']);
            $data['type_monitoring'] = $this->checkEmptyValue($_REQUEST['monitoring_type_item']);
            $submit_status = $this->checkFormStatus($project_id, $form_type_arr['agreement_stage'], 'tender_details');
            if ($submit_status) {
                $data['status'] = 'Y';
            }else{
                $data['status'] = 'N';
            }
            $data['tender_id'] = base64_decode($_REQUEST['tender_id']);
            $result = $this->Project_model->updateTenderDetails($data);
            $this->update_approval( $project_id,$res['approver_id']);


        }

        if ($result) {
            //$submit_status = $this->checkFormStatus($project_id, $form_type_arr['agreement_stage'], 'tender_details');
            if ($submit_status) {
                redirect('Project/project_sucess?project_id=' . $_REQUEST['project_id']);
            } else {
                redirect('Project/agreement_stage?project_id=' . $_REQUEST['project_id']);
            }

        }

    }

    /*Project Success Page*/
    public function project_sucess()
    {
        // Getting Project Details
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_detail'] = $this->Project_model->get_project_data($project_id);

        $data['project_users'] = $this->Project_model->get_project_users($project_id);
        $data['tender_histroy'] = $this->Project_model->getTenderHistory($project_id);
        $res = $this->Project_model->getProjectDetails($project_id);
        $res['group_name'] = $this->Project_model->getGroupName($res['project_group']);
        $res['sector_name'] = $this->Project_model->getSectorName($res['project_sector']);
        $res['project_type_name'] = $this->Project_model->getProjectTypeName($res['project_type']);
        $res['project_destination_name'] = $this->Project_model->getDestinationName($res['project_destination']);
        $res['project_area_name'] = $this->Project_model->getAreaName($res['project_area']);
        $data['result'] = $res;
        $arr = $this->Project_model->getTenderDetails($project_id);
        $data['result_tender'] = $arr[0];

        $this->load->common_template('project/project_success',$data);
    }
    public function get_project_history(){
        $project_id = $_REQUEST['project_id'];
        $data['project_history'] = $this->Project_model->get_project_history($project_id);

        for( $i = 0 ; $i < count($data['project_history']); $i++){
            $approver_id = $data['project_history'][$i]['approver_id'];

            $approver_user_type = $this->Project_model->get_user_type($approver_id);
            if( $approver_user_type == 3){
                $approver_details = $this->Project_model->get_level3_details($approver_id);
            }
            $data['project_history'][$i]['approver_details'] = $approver_details[0];
            $requester_id = $data['project_history'][$i]['requester_id'];
            $requester_user_type = $this->Project_model->get_user_type($requester_id);
            if( $requester_user_type == 3){
                $requester_details = $this->Project_model->get_level3_details($requester_id);
            }
            $data['project_history'][$i]['requester_details'] = $requester_details[0];

        }

        $this->load->ajax_templete('project/project_history', $data);
    }

    /** Custom Validation methods **/
    public function _rfp_publish_datechecker($date)
    {

        if (strtotime($_REQUEST['rfp_publishing_date']) < strtotime($_REQUEST['tender_document_approval_date'])) {

            $this->form_validation->set_message('_rfp_publish_datechecker', 'RFP publish date should be greater than Tender Approval Date');
            return false;
        }

        return true;
    }

    public function _rfp_closing_datechecker($date)
    {

        if (strtotime($_REQUEST['rfp_closing_date']) < strtotime($_REQUEST['rfp_publishing_date'])) {

            $this->form_validation->set_message('_rfp_closing_datechecker', 'RFP closing date should be greater or same of RFP publishing Date');
            return false;
        }

        return true;
    }

    public function _tender_datechecker($date)
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $result = $this->Project_model->getProjectAADate($project_id);
        $aa_date = $result[0]['aa_date'];
        $tender_document_approval_date = $_REQUEST['tender_document_approval_date'];

        if (strtotime($tender_document_approval_date) < strtotime($aa_date) || strtotime($_REQUEST['tender_document_approval_date']) > strtotime(date('Y-m-d'))) {
            $this->form_validation->set_message('_tender_datechecker', 'Tender approval date should be past date and  greater than AA Date.');
            return false;
        }
        return true;
    }

    public function _datechecker($date)
    {

        $agreement_start_date = $_REQUEST['agreement_date'];
        $agreement_end_date = $_REQUEST['agreement_end_date'];
        if (strtotime($agreement_start_date) >= strtotime($agreement_end_date)) {
            $this->form_validation->set_message('_datechecker', 'Agreement end date should be greater than Agreement date');
            return false;
        }
        return true;

    }

    public function _aa_datechecker($date)
    {
        // echo $date;
        // die();
        if ($date > date('Y-m-d') ){

            $this->form_validation->set_message('_aa_datechecker', 'AA Date cannot be a future date');
            return false;
        }else{
          return true;  
        }

        
    }

    public function _revised_rfp_publish_datechecker($date)
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $result = $this->Project_model->getProjectRFPClosing($project_id);
        $rfp_closing_date = $result[0]['rfp_closing_date'];
        if (strtotime($_REQUEST['revised_rfp_publish_date']) < strtotime($rfp_closing_date)) {
            $this->form_validation->set_message('_revised_rfp_publish_datechecker', 'Revised RFP Publish Date should be greater that RFP closing date.');
            return false;
        }
        return true;
    }

    public function _revised_rfp_closing_datechecker($date)
    {

        if (strtotime($_REQUEST['revised_rfp_closing_date']) < strtotime($_REQUEST['revised_rfp_publish_date'])) {
            $this->form_validation->set_message('_revised_rfp_closing_datechecker', 'Revised RFP closing Date should be greater than Revised RFP Publish Date.');
            return false;
        }
        return true;
    }

    public function _final_date_rfp_publish_datechecker($data)
    {

        if (strtotime($_REQUEST['final_date_rfp_publish']) < strtotime($_REQUEST['revised_rfp_closing_date'])) {

            $this->form_validation->set_message('_final_date_rfp_publish_datechecker', 'Final RFP publish date should be greater than Revised RFP closing Date.');
            return false;
        }
        return true;
    }

    public function _final_date_rfp_close_datechecker($data)
    {

        if (strtotime($_REQUEST['final_date_rfp_close']) < strtotime($_REQUEST['final_date_rfp_publish'])) {

            $this->form_validation->set_message('_final_date_rfp_close_datechecker', 'Final RFP closing date should be greater than Revised RFP publish Date.');
            return false;
        }
        return true;
    }

    public function _tech_bid_opening_date_datechecker($data)
    {

        if (strtotime($_REQUEST['tech_bid_opening_date']) < strtotime($_REQUEST['final_date_rfp_close'])) {

            $this->form_validation->set_message('_tech_bid_opening_date_datechecker', 'Technical bid opening date should be greater than Final RFP closing date.');
            return false;
        }
        return true;
    }

    public function _finance_bid_opening_date_datechecker($data)
    {

        if (strtotime($_REQUEST['finance_bid_opening_date']) < strtotime($_REQUEST['tech_bid_opening_date'])) {

            $this->form_validation->set_message('_finance_bid_opening_date_datechecker', 'Financial bid opning date should be greater or same of Technical bid opening date.');
            return false;
        }
        return true;
    }

    public function _tender_ly_date_datechecker($data)
    {

        if (strtotime($_REQUEST['tender_ly_date']) < strtotime($_REQUEST['finance_bid_opening_date'])) {

            $this->form_validation->set_message('_tender_ly_date_datechecker', 'Tender LY Issue Date should be greater than Financial bid opning date.');
            return false;
        }
        return true;
    }

    public function _agreement_datechecker($date)
    {

        $project_id = base64_decode($_REQUEST['project_id']);
        $result = $this->Project_model->getProjectFinancialOpeningDate($project_id);
        if (strtotime($_REQUEST['agreement_date']) < strtotime($result[0]['finance_bid_opening_date'])) {

            $this->form_validation->set_message('_agreement_datechecker', 'Agreement Date should be greater than Financial bid opning date.');
            return false;
        }
        return true;
    }

    public function _bg_validity_datechecker($date)
    {
        $agreement_start_date = $_REQUEST['agreement_date'];
        $agreement_end_date = $_REQUEST['agreement_end_date'];
        $bg_validity_date = $_REQUEST['bg_validity_date'];

        if (!(strtotime($bg_validity_date) >= strtotime($agreement_start_date)) || !(strtotime($bg_validity_date) <= strtotime($agreement_end_date))) {

            $this->form_validation->set_message('_bg_validity_datechecker', 'Bg validity Date should be in between agreement start date and agreement end date.');
            return false;
        }
        return true;
    }

    public function _project_start_datechecker($date)
    {

        if (strtotime($_REQUEST['project_start_date']) < strtotime($_REQUEST['agreement_date'])) {
            $this->form_validation->set_message('_project_start_datechecker', 'Project Start date should be same or greater than Agreement date');
            return false;
        }
        return true;
    }

    public function _project_end_datechecker($date)
    {

        if (strtotime($_REQUEST['project_end_date']) < strtotime($_REQUEST['agreement_end_date'])) {
            $this->form_validation->set_message('_project_end_datechecker', 'Project end date should be same or greater than Agreement end date');
            return false;
        }
        return true;
    }
    /* Validation methods */


    public function getDestination()
    {
        if ($_REQUEST['area_id']) {
            $destination_arr = $this->Project_model->getTehsilsByDistrict($_REQUEST['area_id']);

            $html = ' <select id="project_destination" name="project_destination" class="form-control show-tick">
                      <option value="">Select Tehsil</option>';

            foreach ($destination_arr as $destination) {
                $html .= "<option value=" . $destination['id'] . ">" . $destination['tahsil_name'] . "</option>";
            }
        }
        echo json_encode($html);
        exit;
    }

    /* Project Add */
    public function project_add()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        if (!empty($project_id)) {
            $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
            //$data['count_revised_end_date']=$this->Project_model->get_count_revised_end_date($project_id);
        }
        $data['project_area'] = $this->Project_model->get_project_area();
        $data['project_type'] = $this->Project_model->get_project_type();
        $data['project_tsu'] = $this->Project_model->get_tsu();
        $data['project_supervisor'] = $this->Project_model->get_designing_supervisor_master();
        $data['project_agency'] = $this->Project_model->get_agency_master();
        $data['project_ngo'] = $this->Project_model->get_ngo_master();
        if (!empty($_REQUEST['submit'])) {
            if (!empty($_REQUEST['project_id'])) {
                $revised_end_date = date('Y-m-d', strtotime($_REQUEST['end_date']));
                if ($revised_end_date < $data['project_deatail'][0]['project_end_date']) {
                    $this->session->set_flashdata('message', 'Revised end date should not be less than previous end date');
                    redirect('Project/project_list');
                }
            }
            $project_detail = array();
            $project_detail['project_name'] = $_REQUEST['project_name'];
            $project_detail['project_unique_no'] = $_REQUEST['project_unique_no'];
            $project_detail['project_area'] = $_REQUEST['project_area'];
            $project_detail['project_destination'] = $_REQUEST['project_destination'];
            $project_detail['project_type'] = $_REQUEST['project_type'];
            $project_detail['estimate_total_cost'] = $_REQUEST['project_amount'];
            $project_detail['display_amount'] = $_REQUEST['display_amount'];
            $project_detail['project_tsu'] = $_REQUEST['tsu'];
            $project_detail['project_implementing_agency'] = $_REQUEST['agency'];
            $project_detail['project_supervisor'] = $_REQUEST['superviser'];
            $project_detail['project_ngo'] = $_REQUEST['ngo'];
            $project_detail['project_start_date'] = date('Y-m-d', strtotime($_REQUEST['start_date']));
            $project_detail['project_end_date'] = date('Y-m-d', strtotime($_REQUEST['end_date']));
            $project_detail['status'] = "Y";
            $project_detail['created_by'] = $this->session->userdata('id');
            $project_detail['created_on'] = Date('Y-m-d');
            $project_detail['modified_by'] = $this->session->userdata('id');
            if (!empty($_REQUEST['project_id'])) {
                $where = array('id' => base64_decode($_REQUEST['project_id']));
                $this->Project_model->updateDataCondition('project_detail', $project_detail,
                    $where);

                $this->session->set_flashdata('message', 'Data updated Successfully');
            } else {
                $project_detail['project_original_end_date'] = date('Y-m-d', strtotime($_REQUEST['end_date']));
                $this->Project_model->add('project_detail', $project_detail);
                $this->session->set_flashdata('message', 'Data added Successfully');
            }
            $extended_end_date = array();
            $extended_end_date['project_id'] = base64_decode($_REQUEST['project_id']);
            $extended_end_date['extended_end_date '] = date('Y-m-d', strtotime($_REQUEST['end_date']));
            $extended_end_date['created_by'] = $this->session->userdata('id');
            $extended_end_date['created_on'] = Date('Y-m-d');
            $extended_end_date['modified_by'] = $this->session->userdata('id');
            $this->Project_model->add('project_end_date_revision', $extended_end_date);

            redirect('Project/project_list');

        } else {
            $this->load->common_template('project/project_add', $data);
        }
    }
    /* Project Add End*/

    /* Project Destination */
    public function get_destination()
    {
        $area_id = $_REQUEST['area_id'];
        $destination = $this->Project_model->get_project_destination($area_id);
        $html = "";
        //$html.="<option value=''>Select Project Destination</option>";
        foreach ($destination as $des) {
            $html .= "<option value='" . $des['id'] . "'>" . $des['name'] . "</option>";
        }
        echo $html;
        die;
    }

    /* Project Destination End*/
    public function project_sector($sector_id)
    {
        return $this->Project_model->get_sector_id($sector_id);
    }

    public function project_group($group_id)
    {
        return $this->Project_model->get_group_id($group_id);
    }

    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Project_model->get_project_type($type_id);
    }
    /* Project Type End */

    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Project_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Project_model->project_destination($destination_id);
    }
    /* Project Area End */


    /* Project other setting */
    public function project_other_setting()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_other_setting_detail'] = $this->Project_model->get_project_other_setting_list($project_id);

        /* Call for project status bar*/
        $data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
        /* Call for project status bar*/


        if (!empty($_REQUEST['other_setting_id'])) {
            $other_setting_id = base64_decode($_REQUEST['other_setting_id']);
            $data['other_setting_id'] = $other_setting_id;
            $data['project_other_setting_detail_edit'] = $this->Project_model->get_project_other_setting_list($project_id, $other_setting_id);
        }

        $this->load->common_template('project/project_other_setting', $data);
    }
    /* Project other setting End*/

    /* Function for projects and plan status bar*/
    public function project_plan_monitoring_status_bar($project_id = NULL, $type = Null)
    {
        if ($type == "Planning") {
            $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
            $project_wise_total_activity_amt = $this->Project_model->get_project_wise_total_activity_amt($project_id);

            /* $project_wise_total_activity_planned_amt = $this->Project_model->get_project_wise_total_activity_planned_amt($project_id);
             $data['activity_percentage']=ceil(($project_wise_total_activity_planned_amt[0]['total_planned_amount']/$project_wise_total_activity_amt[0]['total_amount']) *
                 100);*/

            $data['activity_percentage'] = ceil(($project_wise_total_activity_amt[0]['total_amount'] / $data['project_deatail'][0]['estimate_total_cost']) * 100);

            $project_wise_total_activity_planned_amt = $this->Project_model->get_project_wise_total_activity_planned_amt($project_id);

            $project_work_item_deatail = $this->Project_model->get_project_work_item_details($project_id);
            if (!empty($project_work_item_deatail)) {
                $sum_fin_budget = 0;
                $sum_fin_planned = 0;
                foreach ($project_work_item_deatail as $work_item_deatail) {
                    $sum_fin_budget = $sum_fin_budget + $work_item_deatail['amount'];
                    $financial_planned = $this->Project_model->get_work_item_financial_planned_amount($project_id, $work_item_deatail['work_item_id']);
                    $sum_fin_planned = $sum_fin_planned + $financial_planned[0]['target_amount'];
                }
            }


            $data['workitem_percentage'] = ceil(($sum_fin_planned / $project_wise_total_activity_amt[0]['total_amount']) * 100);

            $total_no_of_activity = $this->Project_model->total_no_activity_with_respect_project($project_id);
            $total_no_of_work_item = $this->Project_model->total_no_work_item_with_respect_project($project_id);
            $data['total_work_item_with_activity_count'] = $total_no_of_activity[0]['activity_count'] * $total_no_of_work_item[0]['work_item_count'];


            $total_no_of_physical_planned_activity = $this->Project_model->no_of_physical_planned_activity_with_respect_project($project_id);
            $data['planned_physical_activity_count'] = $total_no_of_physical_planned_activity[0]['planned_physical_activity_count'];

            $total_no_of_financial_planned_activity = $this->Project_model->no_of_financial_planned_activity_with_respect_project($project_id);
            $data['planned_financial_activity_count'] = $total_no_of_financial_planned_activity[0]['planned_financial_activity_count'];
            return $data;
        }
    }
    /* Function for projects and plan status bar End*/

    /* Project other setting */
    public function add_project_other_setting()
    {
        if (!empty($_REQUEST['submit'])) {
            $project_id = base64_decode($_REQUEST['project_id']);
            $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
            $total_amount = (($data['project_deatail'][0]['estimate_total_cost'] * $_REQUEST['percentage']) / 100);
            $other_setting = array();
            $other_setting['project_id'] = $project_id;
            $other_setting['charge_name'] = $_REQUEST['title'];
            $other_setting['charge_percentage'] = $_REQUEST['percentage'];
            $other_setting['total_amount'] = $total_amount;
            $other_setting['status'] = $_REQUEST['status'];
            $other_setting['created_by'] = $this->session->userdata('id');
            $other_setting['created_on'] = Date('Y-m-d');
            $other_setting['modified_by'] = $this->session->userdata('id');
            if (empty($_REQUEST['other_setting_id'])) {
                $this->Project_model->add('project_other_charges', $other_setting);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['other_setting_id']));
                $this->Project_model->updateDataCondition('project_other_charges', $other_setting, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Project/project_other_setting?project_id=' . $_REQUEST['project_id']);
        }
    }
    /* Project other setting End*/

    /* Project other setting Delete*/
    public function delete_other_setting()
    {
        $other_setting_id = base64_decode($_REQUEST['other_setting_id']);
        $deleteClause = array('id' => $other_setting_id);
        $this->Project_model->deleteRecord('project_other_charges', $deleteClause);
        $this->session->set_flashdata('message', 'Data deleted Successfully');
        redirect('Project/project_other_setting?project_id=' . $_REQUEST['project_id']);
    }
    /* Project other setting Delete End*/

    /* Project activity */
    public function project_activity()
    {

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
        $data['project_id'] = $project_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_activity_deatail'] = $this->Project_model->get_project_activity_list($project_id, 0);
        $data['project_other_setting_detail'] = $this->Project_model->get_project_other_setting_details($project_id);

        $data['project_wise_total_activity_amt'] = $this->Project_model->get_project_wise_total_activity_amt($project_id);

        $data['project_wise_total_activity_planned_amt'] = $this->Project_model->get_project_wise_total_activity_planned_amt($project_id);

        /* Call for project status bar*/
        //$data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
        /* Call for project status bar*/
        $data['counters'] = $this->project_counters($project_id);

        if (!empty($_REQUEST['activity_id'])) {
            $activity_id = base64_decode($_REQUEST['activity_id']);
            $data['activity_id'] = $activity_id;
            $data['project_activity_detail_edit'] = $this->Project_model->get_project_activity_list($project_id, $activity_id);
        }

        $this->load->common_template('project/project_activity', $data);
    }
    /* Project activity End*/

    /* Get project work item wise break up */
    function get_workitem_wise_breakup()
    {
        $project_id = $_REQUEST['project_id'];
        $activity_id = $_REQUEST['activity_id'];
        $type = $_REQUEST['type'];
        $html = '';

        if ($type == "financial" || $type == "activity") {
            $project_activity_wise_financial_planning_main = $this->Project_model->project_activity_wise_financial_planning_main($project_id, $activity_id);
            $html .= '<div class="block-header"><h4>Activity: ' . $_REQUEST['activity_name'] . '</h4>
                </div>';
            $html .= '<div class="block-header">Financial Planing</div>';
            $html .= '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Sl No</th>
                                <th style="text-align: center;">Work Item Name</th>
                                <th style="text-align: center;">Planned Amount</th>
                            </tr>
                        </thead>
            <tbody>';
            if (!empty($project_activity_wise_financial_planning_main)) {

                $i = 1;
                foreach ($project_activity_wise_financial_planning_main as $planning_main) {
                    $work_item_id = $planning_main['project_work_item_id'];
                    $work_item = $this->Project_model->get_work_item_list($work_item_id);
                    $html .= '<tr><td>' . $i . '</td></td><td>' . $work_item[0]['work_item_description'] . '</td><td style="text-align: right;">' . number_format($planning_main['total_activity_budget_amount'], 2) . '</td></tr>';
                    $i++;
                }
            } else {
                $html .= '<tr><td colspan="3">No data available</td></tr>';
            }
            $html .= '</table>';
        }

        if ($type == "physical" || $type == "activity") {
            $project_activity_wise_physical_planning_main = $this->Project_model->project_activity_wise_physical_planning_detail($project_id, $activity_id);
            $html .= '<div class="block-header">Physical Planing</div>';
            $html .= '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Sl No</th>
                                <th style="text-align: center;">Work Item Name</th>
                                <th style="text-align: center;">Planned Quantity</th>
                            </tr>
                        </thead>
            <tbody>';
            if (!empty($project_activity_wise_physical_planning_main)) {
                $i = 1;
                foreach ($project_activity_wise_physical_planning_main as $phy_planning_main) {
                    $work_item_id = $phy_planning_main['project_work_item_id'];
                    $work_item = $this->Project_model->get_work_item_list($work_item_id);

                    $unit = $this->Project_model->get_unit_detail($phy_planning_main['activity_quantity_unit_id']);
                    $html .= '<tr><td>' . $i . '</td></td><td>' . $work_item[0]['work_item_description'] . '</td><td style="text-align: right;">' . $phy_planning_main['total_activity_quantity'] . ' ' . $unit[0]['unit_name'] . '</td></tr>';
                    $i++;
                }
            } else {
                $html .= '<tr><td colspan="3">No data available</td></tr>';
            }
            $html .= '</table>';
        }
        echo $html;
    }
    /* Get project work item wise break up End*/

    /* Project activity Delete*/
    public function delete_activity()
    {
        $activity_id = base64_decode($_REQUEST['activity_id']);
        $deleteClause = array('id' => $activity_id);
        $this->Project_model->deleteRecord('project_activities', $deleteClause);
        $this->session->set_flashdata('message', 'Data deleted Successfully');
        redirect('Project/project_activity?project_id=' . $_REQUEST['project_id']);
    }
    /* Project activity Delete End*/

    /* Project planned amount*/
    public function get_planned_amount($project_id, $project_activity_id)
    {
        return $this->Project_model->get_planned_amount_data($project_id, $project_activity_id);
    }
    /* Project planned amount End*/


    /* Add Project other setting */
    public function add_project_activity()
    {
        if (!empty($_REQUEST['submit'])) {
            $project_id = base64_decode($_REQUEST['project_id']);
            $project_activity = array();
            $project_activity['project_id'] = $project_id;            $project_activity['particulars'] = $_REQUEST['particular'];
            $project_activity['amount'] = $_REQUEST['amount'];
            $project_activity['status'] = $_REQUEST['status'];
            $project_activity['created_by'] = $this->session->userdata('id');
            $project_activity['created_on'] = Date('Y-m-d');
            $project_activity['modified_by'] = $this->session->userdata('id');
            if (empty($_REQUEST['activity_id'])) {
                $this->Project_model->add('project_activities', $project_activity);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('id' => base64_decode($_REQUEST['activity_id']));
                $this->Project_model->updateDataCondition('project_activities', $project_activity, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }
            redirect('Project/project_activity?project_id=' . $_REQUEST['project_id']);
        }
    }
    /* Add Project other setting End*/

    /* Project work item */
    public function project_work_item()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['work_item_list'] = $this->Project_model->get_work_item_list('');
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_other_setting_detail'] = $this->Project_model->get_project_other_setting_details($project_id);

        /* Call for project status bar*/
        //$data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
        $data['counters'] = $this->project_counters($project_id);
        /* Call for project status bar*/

        $this->load->common_template('project/project_work_item', $data);
    }
    /* Project work item */

    /* Project work item physical target*/
    public function work_item_physical_target($project_id, $work_item_id)
    {
        return $this->Project_model->get_work_item_physical_target($project_id, $work_item_id);
    }
    /* Project work item physical target End*/

    /*Project work item financial planned*/
    public function work_item_financial_planned_amount($project_id, $work_item_id)
    {
        return $this->Project_model->get_work_item_financial_planned_amount($project_id, $work_item_id);
    }
    /*Project work item financial planned End*/
    public function _duplicate_work_item_check()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $check_total = $this->Project_model->check_dupliacte_work_item_project( $project_id,$_REQUEST['work_item'] );
        if( $check_total[0]['total'] > 0  ){
            $this->form_validation->set_message('_duplicate_work_item_check', 'WorkItem already exits.');
            return false;
        }
        return true;
    }

    /* Add Project work item */
    public function add_project_work_item()
    {
        $project_id = base64_decode($_REQUEST['project_id']);

        if (!empty($_REQUEST['work_item'])) {
            $this->form_validation->set_rules('work_item', 'Work Item Name', 'required|callback__duplicate_work_item_check');
        }

        if ($this->form_validation->run() == FALSE) {
            $mtype = $this->get_project_monitoring_type($project_id);
            $this->session->set_flashdata('error_message', $mtype.' already exits.');
            $this->session->set_flashdata('work_item_id', $_REQUEST['work_item']);
            redirect('Project/project_work_item?project_id=' . $_REQUEST['project_id']);
        }else if (!empty($_REQUEST['submit'])) {
            //$project_id = base64_decode($_REQUEST['project_id']);

            $work_item = array();
            $work_item['project_id'] = $project_id;
            $work_item['work_item_id'] = $_REQUEST['work_item'];
            $work_item['total_quantity'] = $_REQUEST['total_quantity'];
            $work_item['amount'] = $_REQUEST['amount'];
            $work_item['status'] = 'Y';
            $work_item['created_by'] = $this->session->userdata('id');
            $work_item['created_on'] = Date('Y-m-d');
            $work_item['modified_by'] = $this->session->userdata('id');
            $this->Project_model->add('project_work_items', $work_item);
            $this->session->set_flashdata('message', 'Data Added Successfully');
            redirect('Project/project_work_item?project_id=' . $_REQUEST['project_id']);
        }
    }
    /* Project other setting End*/

    /* Project work item name */
    public function work_item($work_item_id)
    {

        return $this->Project_model->get_work_item_list($work_item_id);
    }
    /* Project work item name End*/


    /*Financial Listing*/
    public function financial_listing()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $project_work_item_id = base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id'] = $project_id;
        $data['project_work_item_id'] = $project_work_item_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_activity_deatail'] = $this->Project_model->get_project_activity_details($project_id);
        /* Call for project status bar*/
        $data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
        /* Call for project status bar*/
        $this->load->common_template('project/financial_listing', $data);
    }
    /*Financial Listing End*/

    /*Financial Budget Amount*/
    function get_financial_budget($project_id, $project_work_item_id)
    {
        return $this->Project_model->get_financial_budget_data($project_id, $project_work_item_id);
    }
    /*Financial Budget Amount End*/

    /*Financial Listing details*/
    public function get_financial_main($project_id, $project_work_item_id, $project_activity_id)
    {
        return $this->Project_model->get_project_financial_details($project_id, $project_work_item_id, $project_activity_id);
    }
    /*Financial Listing details End*/

    /*Project work item financial planned with activity wise*/
    public function work_item_financial_planned_amount_with_workitem_activity($project_id, $work_item_id, $project_activity_id)
    {
        return $this->Project_model->get_work_item_financial_planned_amount_with_workitem_activity($project_id, $work_item_id, $project_activity_id);
    }
    /*Project work item financial planned with activity wise End*/

    /* Add Project Financial*/
    public function add_financial_planning()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $project_work_item_id = base64_decode($_REQUEST['project_work_item_id']);
        $project_activity_id = base64_decode($_REQUEST['project_activity_id']);
        $project_financial_id = base64_decode($_REQUEST['project_financial_id']);
        $data['project_id'] = $project_id;
        $data['project_work_item_id'] = $project_work_item_id;
        $data['project_activity_id'] = $project_activity_id;
        $data['project_financial_id'] = $project_financial_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_deatail'] = $this->Project_model->get_project_activity_details($project_id);

        $data['project_financial_planning_detail'] = $this->Project_model->project_financial_planning_detail($project_id, $project_work_item_id, $project_activity_id);

        $work_item_master = $this->Project_model->get_work_item_list($project_work_item_id);
        $data['work_item_type'] = $this->Project_model->get_work_item_type_master($work_item_master[0]['type_id']);

        if (!empty($_REQUEST['submit'])) {
            // Sum of month wise budgeted amount
            $sum_month_wise_amt = 0;
            for ($i = 0; $i < count($_REQUEST['month']); $i++) {
                if (!empty($_REQUEST['target'][$i])) {
                    $sum_month_wise_amt = $sum_month_wise_amt + $_REQUEST['target'][$i];
                }
            }
            // Sum of month wise budgeted amount

            $budget_amt = $this->Project_model->get_financial_budget_data($_REQUEST['project_id'], $_REQUEST['work_item_id']);
            $planned_amt = $this->Project_model->get_work_item_financial_planned_amount($_REQUEST['project_id'], $_REQUEST['work_item_id']);

            $remaining_amt = $budget_amt[0]['amount'] - $planned_amt[0]['target_amount'];

            if ($sum_month_wise_amt > $remaining_amt) {
                $this->session->set_flashdata("message", "Planned amount should not exceed budget amount");
                redirect('Project/add_financial_planning?project_id=' . base64_encode($_REQUEST['project_id']) . '&project_work_item_id=' . base64_encode($_REQUEST['work_item_id']));
            }

            $financial_planning = array();
            $financial_planning['project_id'] = $_REQUEST['project_id'];
            $financial_planning['project_work_item_id'] = $_REQUEST['work_item_id'];
            $financial_planning['project_activity_id'] = $_REQUEST['activity_id'];
            $financial_planning['status'] = 'Y';
            $financial_planning['created_by'] = $this->session->userdata('id');
            $financial_planning['created_on'] = Date('Y-m-d');
            $financial_planning['modified_by'] = $this->session->userdata('id');

            if (empty($_REQUEST['project_financial_id'])) {
                $financial_planning_main_id = $this->Project_model->add('project_financial_planning_main', $financial_planning);
                $this->session->set_flashdata('message', 'Data Added Successfully');
            } else {
                $where = array('project_id' => $_REQUEST['project_id'], 'project_work_item_id' => $_REQUEST['work_item_id'], 'project_activity_id' => $_REQUEST['activity_id']);
                $this->Project_model->updateDataCondition('project_financial_planning_main', $financial_planning, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }

            $total_financial_planning = 0;
            /*echo '<pre>';
            print_r($_REQUEST);
            die;*/

            for ($i = 0; $i < count($_REQUEST['month']); $i++) {
                $financial_planning_detail = array();
                $financial_planning_detail['project_id'] = $_REQUEST['project_id'];

                $financial_planning_detail['project_work_item_id'] = $_REQUEST['work_item_id'];
                $financial_planning_detail['project_activity_id'] = $_REQUEST['activity_id'];
                $financial_planning_detail['month_name'] = $_REQUEST['month'][$i];
                $financial_planning_detail['month_date'] = date('Y-m-d', strtotime($_REQUEST['month'][$i]));
                $financial_planning_detail['target_amount'] = $_REQUEST['target'][$i];
                $financial_planning_detail['status'] = 'Y';
                $financial_planning_detail['created_by'] = $this->session->userdata('id');
                $financial_planning_detail['created_on'] = Date('Y-m-d');
                $financial_planning_detail['modified_by'] = $this->session->userdata('id');

                if (empty($_REQUEST['project_financial_id'])) {
                    $financial_planning_detail['project_financial_planning_id'] = $financial_planning_main_id;
                    $this->Project_model->add('project_financial_planning_detail', $financial_planning_detail);
                    $this->session->set_flashdata('message', 'Data Added Successfully');
                } else {
                    $financial_planning_detail['project_financial_planning_id'] = $_REQUEST['project_financial_id'];

                    $where = array('id' => $_REQUEST['financial_planning_detail_id'][$i]);
                    $this->Project_model->updateDataCondition('project_financial_planning_detail', $financial_planning_detail, $where);

                    $this->session->set_flashdata('message', 'Data updated Successfully');
                }
                if (!empty($_REQUEST['target'][$i])) {
                    $total_financial_planning = $total_financial_planning + $_REQUEST['target'][$i];
                }
                unset($financial_planning_detail);
            }


            $financial_planning['total_activity_budget_amount'] = $total_financial_planning;
            $where = array('project_id' => $_REQUEST['project_id'], 'project_work_item_id' => $_REQUEST['work_item_id'], 'project_activity_id' => $_REQUEST['activity_id']);
            $this->Project_model->updateDataCondition('project_financial_planning_main', $financial_planning, $where);

            redirect('Project/financial_listing?project_id=' . base64_encode($_REQUEST['project_id']) . '&project_work_item_id=' . base64_encode($_REQUEST['work_item_id']));


        } else {
            $this->load->common_template('project/project_add_financial_planning', $data);
        }

    }
    /* Add Project Financial End*/

    /* Add Project Financial*/
    public function work_activity($activity_id)
    {
        return $this->Project_model->project_activity_name($activity_id);
    }
    /* Add Project Financial End*/

    /* Add Project Financial Month wise target*/
    public function get_activity_month_details()
    {
        $project_id = $_REQUEST['project_id'];
        $work_item_id = $_REQUEST['work_item_id'];
        $activity_id = $_REQUEST['activity_id'];
        $project_financial_planning_detail = $this->Project_model->project_financial_planning_detail($project_id, $work_item_id, $activity_id);

        $html = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Sl No</th>
                    <th style="text-align: center;">Month Name</th>
                    <th style="text-align: center;">Amount</th>
                </tr>
            </thead>
            <tbody>';
        if (!empty($project_financial_planning_detail)) {
            $i = 1;
            $sum = 0;
            $html .= '<div class="block-header"><h4>Work Item: ' . $_REQUEST['workitem_name'] . '</h4>
            </div><div class="block-header"><h4>Activity: ' . $_REQUEST['activity_name'] . '</h4>
            </div>';
            foreach ($project_financial_planning_detail as $planning_detail) {

                $html .= '<tr><td>' . $i . '</td></td><td>' . $planning_detail['month_name'] . '</td><td style="text-align: right;">' . number_format($planning_detail['target_amount'], 2) . '</td></tr>';
                $sum = $sum + $planning_detail['target_amount'];
                $i++;
            }
        }
        $html .= '<tr><td colspan="2" style="text-align: center;"><b>Total Amount :</b></td><td style="text-align: right;">' . number_format($sum, 2) . '</td></tr></tbody>';
        $html .= '</table>';
        echo $html;
    }
    /* Add Project Financial Month wise target End*/

    /*Physical Listing*/
    public function physical_listing()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $project_work_item_id = base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id'] = $project_id;
        $data['project_work_item_id'] = $project_work_item_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_activity_deatail'] = $this->Project_model->get_project_activity_details($project_id);
        /* Call for project status bar*/
       // $data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
        $data['counters'] = $this->project_counters($project_id);

        /* Call for project status bar*/
        $this->load->common_template('project/physical_listing', $data);
    }
    /*Physical Listing End*/
    public function project_counters( $project_id ){

        $arr['total_work_item'] = $this->Project_model->get_total_work_items( $project_id );
        $arr['total_planned_work_item'] = $this->Project_model->get_total_planned_work_items( $project_id );
        $arr['total_activity'] = $this->Project_model->get_total_activity( $project_id );
        $arr['total_planned_activity'] = $this->Project_model->get_total_planned_activity( $project_id );
        $total_used_activity = $this->Project_model->get_total_activities_used( $project_id );
        $total_sum_used_activity = 0;
        foreach ($total_used_activity as $val ){
            $total_sum_used_activity += $val['Total_planned_activity'];
        }
        $arr['total_used_activity'] = $total_sum_used_activity;
        return $arr;
    }
    /*Physical Listing details*/
    public function get_physical_main($project_id, $project_work_item_id, $project_activity_id)
    {
        return $this->Project_model->get_project_physical_details($project_id, $project_work_item_id, $project_activity_id);
    }
    /*Physical Listing details End*/

    /* Add Project Physical*/
    public function add_physical_planning()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $project_work_item_id = base64_decode($_REQUEST['project_work_item_id']);
        $project_activity_id = base64_decode($_REQUEST['project_activity_id']);
        $project_physical_id = base64_decode($_REQUEST['project_physical_id']);

        $data['project_monitoring_frequency'] = $this->Project_model->get_project_monitoring_frequency($project_id);

        $data['project_id'] = $project_id;
        $data['project_work_item_id'] = $project_work_item_id;
        $data['project_activity_id'] = $project_activity_id;
        $data['project_physical_id'] = $project_physical_id;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_deatail'] = $this->Project_model->get_project_activity_details($project_id);

        if ($data['project_monitoring_frequency'] == 4) {
            $data['custom_monitoring_details'] = $this->Project_model->get_custom_project_monitoring_details($project_id, $project_work_item_id, $project_activity_id, $project_physical_id);

        }
        $data['unit_detail'] = $this->Project_model->get_unit_detail();

        $data['project_physical_planning_detail'] = $this->Project_model->project_physical_planning_detail($project_id, $project_work_item_id, $project_activity_id);

        $data['project_physical_planning_main'] = $this->Project_model->project_physical_planning_main($project_id, $project_work_item_id, $project_activity_id);

        if (!empty($data['project_physical_planning_main'])) {
            $data['unit_id'] = $this->Project_model->get_unit_detail($data['project_physical_planning_main'][0]['activity_quantity_unit_id']);
        }

        $work_item_master = $this->Project_model->get_work_item_list($project_work_item_id);
        $data['work_item_type'] = $this->Project_model->get_work_item_type_master($work_item_master[0]['type_id']);


        if (!empty($_REQUEST['submit'])) {

            $physical_planning = array();
            $physical_planning['project_id'] = $_REQUEST['project_id'];
            $physical_planning['project_work_item_id'] = $_REQUEST['work_item_id'];
            $physical_planning['project_activity_id'] = $_REQUEST['activity_id'];
            $physical_planning['activity_quantity_unit_id'] = $_REQUEST['unit_id'];
            $physical_planning['status'] = 'Y';
            $physical_planning['created_by'] = $this->session->userdata('id');
            $physical_planning['created_on'] = Date('Y-m-d');
            $physical_planning['modified_by'] = $this->session->userdata('id');

            /*Creating Physical plan in main table*/
            if (empty($_REQUEST['project_physical_id'])) {
                $physical_planning_main_id = $this->Project_model->add('project_physical_planning_main', $physical_planning);

            } else {

                $where = array('project_id' => $_REQUEST['project_id'],
                    'project_work_item_id' => $_REQUEST['work_item_id'],
                    'project_activity_id' => $_REQUEST['activity_id']
                );

                $this->Project_model->updateDataCondition('project_physical_planning_main', $physical_planning, $where);
                $this->session->set_flashdata('message', 'Data updated Successfully');
            }

            $total_physical_planning = $monitoring_frequency = 0;

            $data['project_monitoring_frequency'] = $this->Project_model->get_project_monitoring_frequency($_REQUEST['project_id']);

            if ($data['project_monitoring_frequency'] == 'W') {
                $monitoring_frequency = $_REQUEST['week'];
            } else if ($data['project_monitoring_frequency'] == 'F') {
                $monitoring_frequency = $_REQUEST['half_month'];
            } else if ($data['project_monitoring_frequency'] == 'M') {
                $monitoring_frequency = $_REQUEST['month'];
            } else if ($data['project_monitoring_frequency'] == 'C') {
                $monitoring_frequency = $_REQUEST['custom_date'];
            }


            for ($i = 0; $i < count($monitoring_frequency); $i++) {

                $physical_planning_detail = array();
                $physical_planning_detail['project_id'] = $_REQUEST['project_id'];
                $physical_planning_detail['project_physical_planning_id'] = $physical_planning_main_id;
                $physical_planning_detail['project_work_item_id'] = $_REQUEST['work_item_id'];
                $physical_planning_detail['project_activity_id'] = $_REQUEST['activity_id'];

                if ($data['project_monitoring_frequency'] == 'W') {
                    $physical_planning_detail['month_name'] = date("F", strtotime($_REQUEST['week'][$i]));
                    $physical_planning_detail['month_date'] = date('Y-m-d', strtotime($_REQUEST['week'][$i]));
                }
                if ($data['project_monitoring_frequency'] == 'F') {
                    $physical_planning_detail['month_name'] = date("F", strtotime($_REQUEST['fortnight'][$i]));
                    $physical_planning_detail['month_date'] = date('Y-m-d', strtotime($_REQUEST['fortnight'][$i]));
                }

                if ($data['project_monitoring_frequency'] == 'M') {
                    $physical_planning_detail['month_name'] = $_REQUEST['month'][$i];
                    $physical_planning_detail['month_date'] = date('Y-m-d', strtotime($_REQUEST['month'][$i]));
                }

                $physical_planning_detail['target_quantity'] = (!empty($_REQUEST['target'][$i])) ? $_REQUEST['target'][$i] : 0 ;
                $physical_planning_detail['unit_id'] = $_REQUEST['unit_id'];
                $physical_planning_detail['status'] = 'Y';
                $physical_planning_detail['created_by'] = $this->session->userdata('id');
                $physical_planning_detail['created_on'] = Date('Y-m-d');
                $physical_planning_detail['modified_by'] = $this->session->userdata('id');

                if ($data['project_monitoring_frequency'] == 'C') {
                    $physical_planning_detail['month_name'] = $_REQUEST['custom_date'][$i];
                    $physical_planning_detail['month_date'] = date('Y-m-d', strtotime($_REQUEST['custom_date'][$i]));
                    /* add physcial plan details in details table */
                    if ($_REQUEST['physical_planning_detail_id'][$i] == 0 && !empty($_REQUEST['project_physical_id'])) {

                        $physical_planning_main_id = $this->Project_model->get_physical_plan_details($_REQUEST['project_id'], $_REQUEST['work_item_id'], $_REQUEST['activity_id']);
                        $physical_planning_detail['project_physical_planning_id'] = $physical_planning_main_id;
                        $this->Project_model->add('project_physical_planning_detail', $physical_planning_detail);
                    }
                }

                if (empty($_REQUEST['project_physical_id'])) {
                    $physical_planning_detail['project_physical_planning_id'] = $physical_planning_main_id;
                    $this->Project_model->add('project_physical_planning_detail', $physical_planning_detail);
                    $this->session->set_flashdata('message', 'Data Added Successfully');
                } else {

                    $physical_planning_detail['project_physical_planning_id'] = $_REQUEST['project_physical_id'];
                    $where = array('id' => $_REQUEST['physical_planning_detail_id'][$i]);

                    $this->Project_model->updateDataCondition('project_physical_planning_detail', $physical_planning_detail, $where);
                    $this->session->set_flashdata('message', 'Data updated Successfully');
                }


                if (!empty($_REQUEST['target'][$i])) {
                    $total_physical_planning = $total_physical_planning + $_REQUEST['target'][$i];
                }
            }


            $physical_planning['total_activity_quantity'] = $total_physical_planning;
            $where = array('project_id' => $_REQUEST['project_id'], 'project_work_item_id' => $_REQUEST['work_item_id'], 'project_activity_id' => $_REQUEST['activity_id']);
            $this->Project_model->updateDataCondition('project_physical_planning_main', $physical_planning, $where);

            redirect('Project/physical_listing?project_id=' . base64_encode($_REQUEST['project_id']) . '&project_work_item_id=' . base64_encode($_REQUEST['work_item_id']));


        } else {
            $this->load->common_template('project/project_add_physical_planning', $data);
        }

    }
    /*Add Project Physical End*/

    /*Get unit*/
    public function get_unit($unit_id)
    {
        return $this->Project_model->get_unit_detail($unit_id);
    }
    /*Get unit End*/


    /* Get Project Physical Month wise target*/
    public function get_physical_month_details_old()
    {
        $project_id = $_REQUEST['project_id'];
        $work_item_id = $_REQUEST['work_item_id'];
        $activity_id = $_REQUEST['activity_id'];
        $project_physical_planning_detail = $this->Project_model->project_physical_planning_detail($project_id, $work_item_id, $activity_id);
        $html = '<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Sl No</th>
                    <th style="text-align: center;">Month Name</th>
                    <th style="text-align: center;">Quantity</th>
                </tr>
            </thead>
            <tbody>';
        /*if (!empty($project_physical_planning_detail)) {
            $i = 1;
            $sum = 0;
            $html .= '<div class="block-header"><h4>Work Item: ' . $_REQUEST['workitem_name'] . '</h4>
            </div><div class="block-header"><h4>Activity: ' . $_REQUEST['activity_name'] . '</h4>
            </div>';
            foreach ($project_physical_planning_detail as $planning_detail) {
                $quantity_name = $this->Project_model->get_unit_detail($planning_detail['unit_id']);
                $html .= '<tr><td>' . $i . '</td></td><td>' . $planning_detail['month_name'] . '</td><td style="text-align: right;">' . $planning_detail['target_quantity'] . ' ' . $quantity_name[0]['unit_name'] . '</td></tr>';
                $sum = $sum + $planning_detail['target_quantity'];
                $i++;
            }
        }
        $html .= '<tr><td colspan="2" style="text-align: center;"><b>Total Quantity :</b></td><td style="text-align: right;">' . number_format($sum, 2) . ' ' . $quantity_name[0]['unit_name'] . '</td></tr></tbody>';
        $html .= '</table>';
        echo $html;*/

    }
    public function get_physical_month_details()
    {
        $project_id = $_REQUEST['project_id'];
        $work_item_id = $_REQUEST['work_item_id'];
        $activity_id = $_REQUEST['activity_id'];
        $data['ajax_request'] =  TRUE;
        $data['project_deatail'] = $this->Project_model->get_project_details($project_id);
        $data['project_physical_planning_detail'] = $this->Project_model->project_physical_planning_detail($project_id, $work_item_id, $activity_id);

        if($data['project_physical_planning_detail'][0]['monitoring_frequency'] == 'W'){
            $templete = 'weekly_monitoring';
        }else if($data['project_physical_planning_detail'][0]['monitoring_frequency'] == 'F'){
            $templete = 'half_month_monitoring';
        }else if($data['project_physical_planning_detail'][0]['monitoring_frequency'] == 'M'){

            $templete = 'monthly_monitoring';
        }else if($data['project_physical_planning_detail'][0]['monitoring_frequency'] == 'C'){
            $templete = 'custom_monitoring';
        }

        $this->load->ajax_templete('project/'.$templete, $data);
    }
    /* Get Project Physical Month wise target End*/


    /* Project Dashboard */
    public function porject_dashboard()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $data['financial_module_permission'] = $this->financial_module_permission[0]['view'];
        // Getting Project Details
        $data['project_detail'] = $this->Project_model->get_project_data($project_id);

        $data['project_users'] = $this->Project_model->get_project_users($project_id);
        $data['tender_histroy'] = $this->Project_model->getTenderHistory($project_id);
        $res = $this->Project_model->getProjectDetails($project_id);
        $res['group_name'] = $this->Project_model->getGroupName($res['project_group']);
        $res['sector_name'] = $this->Project_model->getSectorName($res['project_sector']);
        $res['project_type_name'] = $this->Project_model->getProjectTypeName($res['project_type']);
        $res['project_destination_name'] = $this->Project_model->getDestinationName($res['project_destination']);
        $res['project_area_name'] = $this->Project_model->getAreaName($res['project_area']);
        $data['result'] = $res;
        $arr = $this->Project_model->getTenderDetails($project_id);
        $data['result_tender'] = $arr[0];
        // Getting Project Details

        $data['work_item_categories'] = $this->Project_model->get_work_item_categories();
        $data['project_work_item'] = $this->Project_model->get_project_work_item($project_id);
        $data['project_activity'] = $this->Project_model->get_all_activity_details($project_id, $data['project_work_item'][0]['work_item_id']);
        $arr = [];
        for ($a = 0; $a <= count($data['project_work_item']); $a++) {
            $arr[$data['project_work_item'][$a]['work_item_id']] = $this->Project_model->get_all_activity_details($project_id, $data['project_work_item'][$a]['work_item_id']);
        }

        $data['project_planned_amount_ar'] = $this->Project_model->get_project_planned_amount_details($project_id);
        $data['project_released_amount_ar'] = $this->Project_model->get_project_released_amount_details($project_id);
        $data['project_planned_amount'] = $this->IND_money_format($data['project_planned_amount_ar'][0]['total_planned_amount']);
        $data['project_released_amount'] = $this->IND_money_format($data['project_released_amount_ar'][0]['total_released_amount']);
        $data['project_pending_amount'] = $this->IND_money_format($data['project_planned_amount_ar'][0]['total_planned_amount'] - $data['project_released_amount_ar'][0]['total_released_amount']);
        $data['project_activity_details_ar'] = $this->Project_model->get_project_activity_details($project_id);
        $project_activity_details_ar = array();
        $activity_detail_ar = array();
        if (!empty($data['project_activity_details_ar'])) {

            foreach ($data['project_activity_details_ar'] as $key => $value) {

                $project_activity_details_ar[$key]['activity_name'] = $value['particulars'];
                $project_activity_details_ar[$key]['activity_budget_amount'] = $this->IND_money_format($value['amount']);
                $activity_detail_ar = $this->Project_model->get_project_activity_financial_details($project_id, $value['id']);
                $project_activity_details_ar[$key]['activity_planned_amount'] = $this->IND_money_format($activity_detail_ar[0]['total_activity_budget_amount']);
                $project_activity_details_ar[$key]['activity_released_amount'] = $this->IND_money_format($activity_detail_ar[0]['total_activity_allotted_amount']);
                $project_activity_details_ar[$key]['activity_pending_amount'] = $this->IND_money_format($activity_detail_ar[0]['total_activity_budget_amount'] - $activity_detail_ar[0]['total_activity_allotted_amount']);

            }
        }

        $data['project_user_data'] = $this->Project_model->get_project_user_data($project_id);
        $data['approver_result'] = $this->project_details_user_details($project_id,'approver_id');
        //print_r($approver_result);
        $data['planning_approver_result'] = $this->project_details_user_details($project_id,'planning_approver_id');
        $data['project_creator_result'] = $this->project_details_user_details($project_id,'project_creator_id');

        $data['project_activity_financial_details_ar'] = $project_activity_details_ar;

        $data['source_of_fund'] = $this->Project_model->get_source_of_fund_data_result($project_id);

        $this->load->inner_template('project/porject_dashboard', $data);
    }

    /* Project Dashboard End*/
    public function get_physical_project_performance()
    {
        $arr = $this->Project_model->get_all_activity_details($_REQUEST['project_id'], $_REQUEST['work_item_id']);
        $categories = $target = $complete = [];
        for ($i = 0; $i < count($arr); $i++) {

            /*$activity_name = $arr[$i]['activity_name'];
            $tar = 100;//(int)$arr[$i]['target'] ;
            $done = round(($arr[$i]['achived']/$arr[$i]['target'])*100 );
            $actual_target = (int)$arr[$i]['target'] ;
            $actual_achived = (int)$arr[$i]['achived'] ;

            if($done >= 100 ){
                $tar = '';
            }
            $categories[$i] = $activity_name. "(" .$arr[$i]['unit_name'] .")";
            $target[$i] = $tar;
            $complete[$i] = $done;*/
            $activity_name = $arr[$i]['activity_name'];
            $categories[$i] = $activity_name . "(" . $arr[$i]['unit_name'] . ")";
            $details = $this->get_physical_main($_REQUEST['project_id'], $_REQUEST['work_item_id'], $arr[$i]['activity_id']);
            $totalTaget = $details[0]['total_activity_quantity'];
            $result = $this->Project_model->get_achive_till_date($_REQUEST['project_id'], $_REQUEST['work_item_id'], $arr[$i]['activity_id']);
            $achivedTillDate = $result[0]['AchvedTillDate'];
            $targetTillDate = $this->get_taget_till_date($_REQUEST['project_id'], $_REQUEST['work_item_id'], $arr[$i]['activity_id']);

            $target[$i] = round(($targetTillDate / $totalTaget) * 100);
            $done[$i] = round(($achivedTillDate / $totalTaget) * 100);
            $left[$i] = ($target[$i] - $done[$i]);
        }


        $data['categories'] = $categories;
        $data['target'] = $target;
        $data['complete'] = $done;
        $data['left'] = $left;


        echo json_encode($data);
        exit();
    }

    public function get_taget_till_date($project_id, $work_item_id, $activity_id)
    {

        $result = $this->Project_model->get_taget_till_date($project_id, $work_item_id, $activity_id);
        return $result[0]['TagetTillDate'];

    }

    public function get_activity_dropdown($work_item_id = '', $project_id = '')
    {

        $req_project_id = !empty($_REQUEST['project_id']) ? $_REQUEST['project_id'] : $project_id;
        $req_work_item_id = !empty($_REQUEST['work_item_id']) ? $_REQUEST['work_item_id'] : $work_item_id;

        $activity_arr = $this->Project_model->get_all_activity_details($req_project_id, $req_work_item_id);

        $html = ' <select id="activity_id" name="activity_id" class="form-control show-tick">
                      <option value="">Select Activity</option>';
        if (!empty($activity_arr)) {

            foreach ($activity_arr as $activity) {
                $html .= "<option value=" . $activity['activity_id'] . ">" . $activity['activity_name'] . "</option>";
            }
        }

        echo json_encode($html);
        exit;
    }

    function get_project_summary_xhr()
    {

        $project_id = $_REQUEST['project_id'];
        $data['project_detail'] = $this->Project_model->get_project_data($project_id);
        $start_date = date('Y-m-d', strtotime($_REQUEST['start_date']));
        $end_date = date('Y-m-d', strtotime($_REQUEST['end_date']));

        $data['project_planned_amount_ar'] = $this->Project_model->get_project_planned_amount_details($project_id, $start_date, $end_date);
        $data['project_released_amount_ar'] = $this->Project_model->get_project_released_amount_details($project_id, $start_date, $end_date);

        $jsonData['project_planned_amount'] = $this->IND_money_format($data['project_planned_amount_ar'][0]['total_planned_amount']);
        $jsonData['project_released_amount'] = $this->IND_money_format($data['project_released_amount_ar'][0]['total_released_amount']);
        $jsonData['project_pending_amount'] = $this->IND_money_format($data['project_planned_amount_ar'][0]['total_planned_amount'] - $data['project_released_amount_ar'][0]['total_released_amount']);


        echo json_encode($jsonData);
        exit();
    }

    function IND_money_format($number)
    {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for ($i = 0; $i < $length; $i++) {
            if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
                $delimiter .= ',';
            }
            $delimiter .= $money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if ($decimal != '0') {
            $result = $result . $decimal;
        }

        return $result;
    }

    function get_project_work_item_xhr()
    {
        //echo "<pre>"; print_r($_REQUEST); //die();
        $project_id = $_REQUEST['project_id'];
        //$project_id = base64_decode($_REQUEST['project_id']);
        $work_item_type_id = $_REQUEST['work_item_type_id'];

        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Project_model->get_project_work_items($project_id, $work_item_type_id);
        //echo "<pre>"; print_r($data['project_work_item_details']); die();


        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Project_model->get_physical_activity_main($project_id, $work_item_id);
                //echo "<pre>"; print_r($data['physical_activity']); die();
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Project_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        //echo "<pre>"; print_r($valueActivity); die();
                        //echo "<pre>"; print_r($data['financial_activity_details']); die();
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['financial_total_planned'] = $data['financial_activity_details'][0]['total_planned'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['financial_total_released'] = $data['financial_activity_details'][0]['total_released'];
                        

                        // Getting Activity Physical Details
                        $data['physical_activity_details'] = $this->Project_model->get_physical_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                    
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_planned'] = $data['physical_activity_details'][0]['total_planned'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_released'] = $data['physical_activity_details'][0]['total_released'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_activity_quantity'] =  $valueActivity['total_activity_quantity'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_activity_allotted_quantity'] =  $valueActivity['total_activity_allotted_quantity'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['target_date'] =  $this->Project_model->get_report_work_target_date($project_id,$valueActivity['project_activity_id'],$work_item_id);

                        // Getting Physical Activity Unit Details
                        $data['physical_activity_unit_details'] = $this->Project_model->get_physical_activity_unit_details($project_id, $work_item_id, $valueActivity['project_activity_id']);
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_qty_unit_name'] = $data['physical_activity_unit_details'][0]['unit_name'];

                    }
                }


            }
        

            $html = '';
            if (!empty($project_work_item_details_ar)) {
                foreach ($project_work_item_details_ar as $key => $value) {

                    $accordian_id = $key + 1;
                    $work_item_name = $value['work_item_name'];
                    $work_item_id = $value['work_item_id'];

                    $html .= '<div class="panel panel-col-teal">
                    <div class="panel-heading" role="tab" id="heading' . $accordian_id . '">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse' . $accordian_id . ' "aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-align-justify"></i> ' . $work_item_name . '
                            </a>
                        </h4>
                    </div>
                    <div id="collapse' . $accordian_id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $accordian_id . '">
                        <div class="panel-body p-5" style="font-size: 11px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activities</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Unit</th>';
                    if ($this->financial_module_permission[0]['view']) {

                        $html .= '<th colspan = "2" style = "text-align: center; vertical-align: middle;" > Financial</th >';
                    }
                    $html .= '<th colspan="3" style="text-align: center; vertical-align: middle;">Physical</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Completion Date</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Last Reported</th>
                                    </tr><tr class="bg-blue-grey">';
                    if ($this->financial_module_permission[0]['view']) {
                        $html .= '<th style="text-align: center; vertical-align: middle;">Planned Amount</th>
                                            <th style="text-align: center; vertical-align: middle;">Released Amount</th>';
                    }
                    $html .= '<th style="text-align: center; vertical-align: middle;">Target</th>
                        <th style="text-align: center; vertical-align: middle;">Achieved</th>
                        <th style="text-align: center; vertical-align: middle;">Progress (%)</th>
                                            </tr></thead><tbody>';
                    // echo '<pre>'; print_r($value['activity_details']);
                    // die();
                    if (!empty($value['activity_details'])) {
                        foreach ($value['activity_details'] as $keyActivity => $valueActivity) {

                            $sl = $keyActivity + 1;
                            $activity_name = $valueActivity['activity_name'];
                            $activity_id = $valueActivity['activity_id'];

                            $financial_total_planned = $valueActivity['financial_total_planned'];
                            $financial_total_released = $valueActivity['financial_total_released'];
                            $physical_total_planned = round($valueActivity['physical_total_planned']);
                            $physical_total_released = round($valueActivity['physical_total_released']);

                            if($physical_total_activity_quantity){
                            $physical_total_activity_quantity = $valueActivity['physical_total_activity_quantity'];  
                          }else{
                            $physical_total_activity_quantity = '0.00 ';
                          }

                             
                             if($physical_total_activity_allotted_quantity){
                              $physical_total_activity_allotted_quantity = $valueActivity['physical_total_activity_allotted_quantity'];
                            }else{
                              $physical_total_activity_allotted_quantity = '0.00 ';
                            }
                             
                             $target_date = $valueActivity['target_date'];


                             //$progress_per = ($physical_total_activity_allotted_quantity/$physical_total_activity_quantity)*100;

                             $progress_per = $physical_total_activity_quantity != 0 ? round($physical_total_activity_allotted_quantity/$physical_total_activity_quantity*100) : '';


                             $last_reported = $this->get_reported_date($project_id,$work_item_id,$activity_id);
                             if(!empty($last_reported) && $last_reported != '0000-00-00'){
                                $l_date =  date('d M, Y', strtotime($last_reported));
                             }else{
                                $l_date = 'NA';
                             }
                            $html .= '<tr style="text-align: center; vertical-align: middle;">
                                                    <td>' . $sl . '</td>
                                                    <td >' . $activity_name . '</td>
                                                    <td >' . $valueActivity['physical_qty_unit_name'] . '</td>';
                            if ($this->financial_module_permission[0]['view']) {
                                $html .= '<td >' . $financial_total_planned . ' <i class="fa fa-rupee-sign"></i></td>
                                         <td >' . $financial_total_released . ' <i class="fa fa-rupee-sign"></i></td>';
                            }
                            $html .= '<td >' . $physical_total_activity_quantity . '</td>
                                     <td >' . $physical_total_activity_allotted_quantity . '</td>
                                     <td >' . $progress_per . '</td>
                                     <td >' . date('d M, Y', strtotime($target_date)) . '</td>
                                     <td >' . $l_date . '</td>
                                   </tr>';
                        }
                    } else {
                        //$html .='<tr colspan="5"><td>No Data Available</td></tr>';
                        $html .= '<tr colspan="5">No Data Available</tr>';
                    }


                    $html .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';

                }
            }

        } else {
            $html .= 'No Data Available';
        }

        //echo "<br>project_work_item_details_ar: <pre>"; print_r($project_work_item_details_ar); die();
        echo $html;
        die();
    }

    /* HighChart - Project Performance*/
    function get_project_performance_xhr()
    {
        $data['financial_progress_monthly_ar'] = $this->Project_model->get_financial_progress_monthly($_REQUEST['project_id'], $_REQUEST['start_date'], $_REQUEST['end_date']);

        $fin_progress_ar = array();
        if (!empty($data['financial_progress_monthly_ar'])) {
            foreach ($data['financial_progress_monthly_ar'] as $key => $value) {
                $fin_progress_ar[$key]['month_name'] = $value['month_name'];
                $fin_progress_ar[$key]['month_timestamp'] = strtotime($value['month_name']);
                $fin_progress_ar[$key]['total_budget_monthly'] = $value['total_budget_monthly'];
                $fin_progress_ar[$key]['total_allotted_monthly'] = $value['total_allotted_monthly'];
            }
        }
        $this->sortBy('month_timestamp', $fin_progress_ar);
        $filtered_fin_progress_ar = array();
        if (!empty($fin_progress_ar)) {
            $count = 0;
            foreach ($fin_progress_ar as $key => $value) {
                if ($value['month_timestamp'] <= time()) {
                    $filtered_fin_progress_ar[$count]['period'] = date("Y-m", $value['month_timestamp']);
                    $filtered_fin_progress_ar[$count]['month_date'] = $value['month_name'];
                    $filtered_fin_progress_ar[$count]['planned'] = (int)$value['total_budget_monthly'];
                    $filtered_fin_progress_ar[$count]['released'] = (int)$value['total_allotted_monthly'];
                    $count++;
                }
            }
            // if(count($filtered_fin_progress_ar) > 6){
            //     $sliced_array = array_slice($filtered_fin_progress_ar, 0, 5);
            //     echo json_encode($sliced_array); die();
            // }else{
            //     echo json_encode($filtered_fin_progress_ar); die();
            // }
            echo json_encode($filtered_fin_progress_ar);
            die();
        }
        die();
    }

    public function get_project_activity_performance_xhr()
    {
       // $project_details = $this->Project_model->get_project_details($_REQUEST['project_id']);
        $data['physical_progress_monthly_ar'] = $this->Project_model->get_physical_progress_monthly($_REQUEST['project_id'], $_REQUEST['activity_id'],'','',$_REQUEST['work_item_id']);

        $fin_progress_ar = array();
        if (!empty($data['physical_progress_monthly_ar'])) {

            foreach ($data['physical_progress_monthly_ar'] as $key => $value) {
                 $from_date = new DateTime($value['month_date']);
                $fin_progress_ar[$key]['month_name'] =  $from_date->format('M y');
                $fin_progress_ar[$key]['month_timestamp'] = strtotime($value['month_name']);
                $fin_progress_ar[$key]['total_budget_monthly'] = $value['total_budget_monthly'];
                $fin_progress_ar[$key]['total_allotted_monthly'] = $value['total_allotted_monthly'];
                $fin_progress_ar[$key]['unit_name'] = $value['unit_id'];
            }
        }

        //$this->sortBy('month_timestamp', $fin_progress_ar);
        $filtered_fin_progress_ar = array();
        if (!empty($fin_progress_ar)) {
            $count = 0;
            foreach ($fin_progress_ar as $key => $value) {

                    $filtered_fin_progress_ar[$count]['period'] = date("Y-m", $value['month_timestamp']);
                    $filtered_fin_progress_ar[$count]['month_date'] = $value['month_name'];
                    $filtered_fin_progress_ar[$count]['planned'] = (int)$value['total_budget_monthly'];
                    $filtered_fin_progress_ar[$count]['released'] = (int)$value['total_allotted_monthly'];
                    $count++;

            }

            echo json_encode($filtered_fin_progress_ar);
            exit();
        }
        exit();
    }

    /* #END HighChart - Project Performance*/
    function get_unit_name()
    {
        $unit_name = $this->Project_model->get_unit_name($_REQUEST['project_id'], $_REQUEST['activity_id']);
        echo $unit_name[0]['name'];
        exit();
    }

    function sortBy($field, &$array, $direction = 'asc')
    {
        usort($array, create_function('$a, $b', '
            $a = $a["' . $field . '"];
            $b = $b["' . $field . '"];

            if ($a == $b) return 0;

            $direction = strtolower(trim($direction));

            return ($a ' . ($direction == 'desc' ? '>' : '<') . ' $b) ? -1 : 1;
        '));

        return true;
    }

    public function get_reported_date($project_id,$work_item_id,$activity_id){
        return $this->Project_model->get_reported_date($project_id,$work_item_id,$activity_id);
    }

    public function project_details_user_details($project_id,$rfld){
        $user_id = $this->Project_model->get_project_details_required_field($project_id,$rfld);
      $user_type = $this->Project_model->getSpecificdata('user','id',$user_id,'user_type');

        $r_arr = array();
        if($user_type == 2){
        
            $r_arr['Username'] = "NAME";
            $r_arr['Email'] = "--";
            $r_arr['Mobile'] = "--";
   
        }else{
          $user_details = $this->Project_model->project_details_user_details_data($user_id);
          foreach ($user_details as $key) {
            $r_arr['Username'] = $key->firstname.' '.$key->lastname;
            $r_arr['Email'] = $key->email;
            $r_arr['Mobile'] = $key->mobile;
        }  
        }
        return $r_arr;
    }

    
    function get_vendor_data($project_id){
        $result_vendor = $this->Project_model->get_vendor_data($project_id);

        $claimedTilldate = $releasedtTilldate = $vendor_name = [];
                    for($k = 0 ; $k < count($result_vendor) ; $k++ ){
                    $vendor = $result_vendor[$k]['vendor'];
                    $vendor_id = $result_vendor[$k]['vendor_id'];                   
                                       
                   
            $row_claim =  $this->Project_model->get_invoice_data($project_id,$vendor_id);
           
            $tot_cnt = count($row_claim);
            $claim_amnt = [];
                for($i = 0 ; $i < count($row_claim) ; $i++ ){
               
                     $claim_amnt[$i] = $row_claim[$i]['claimed_amnt'];
               
            }           
            $SUMclaim_amount = array_sum($claim_amnt);
                   
            $row_released =  $this->Project_model->get_invoicereleased_data($project_id,$vendor_id);
           
            $tot_Rcnt = count($row_released);
            $release_amnt = [];
                for($p = 0 ; $p < count($row_released) ; $p++ ){
               
                     $release_amnt[$p] = $row_released[$p]['released_amnt'];
               
            }           
            $SUMreleased_amount = array_sum($release_amnt);
             
             $vendor_name[$k] =  $vendor;
             $claimedTilldate[$k] =  (int)$SUMclaim_amount;
             $releasedtTilldate[$k] =  (int)$SUMreleased_amount;
                   
                }
       
        $data['vendor'] = $vendor_name;
        $data['claimed'] = $claimedTilldate;
        $data['released']= $releasedtTilldate;

        return $data;
    }


    function get_financial_data($project_id){
        $result_financial = $this->Project_model->get_financial_data($project_id);

        
        return $result_financial;
    }


    


    function file_upload_data()
    {
        

        $file_name = $this->input->post('file_name');

        if( !empty($_FILES['file1'])) {
            if (!is_dir('uploads/temp/')) {
                      mkdir('./uploads/temp', 0777, TRUE);

                  }
                $config['upload_path'] = 'uploads/temp/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx|xlsx|xls";
                $config['max_size'] = 50000000;
               // $config['max_size'] = 2000000;
                $f_name = preg_replace('/\s+/', '_', $_FILES['file1']['name']);
                $fileName = rand(11,999999).'_'.$f_name;
                    
                $config['file_name'] = $fileName;
                $this->load->library('upload', $config);
                

                if ($this->upload->do_upload('file1') && !empty($_FILES['file1']['name'])) {
                    
                    //echo base_url().'uploads/attachment/'.$fileName;
                    //echo 'File Name: '.$file_name.'<br>File: '.$fileName;
                    $file_link = base_url().'uploads/temp/'.$fileName;

                    $path = 'uploads/temp/'.$fileName;
                    $file_size = formatSizeUnits(filesize($path));
                    
                    $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                    $input_data = '<input type="hidden" name="hidden_file_name[]" value="'.$file_name.'"><input type="hidden" name="hidden_file_url[]" value="'.$fileName.'">';
                    echo "<tr>$input_data<td>$file_name</td><td>$file_size</td><td>$file_d_link</td>";

                } else {
                    //echo $this->upload->display_errors();
                    echo "No";

                }
            }else{
                echo "No";
            }
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
                $this->Project_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }




       


/* Call Back function use for date valiadtion */

function _tender_approval_datechecker($tender_approval_date,$project_id){

    $get_project_aa_date = $this->Project_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'aa_date');

    if ($tender_approval_date > date('Y-m-d') ){

            $this->form_validation->set_message('_tender_approval_datechecker', 'Date of tender approval cannot be a future date');
            return false;
        }elseif ($tender_approval_date < $get_project_aa_date) {
          $this->form_validation->set_message('_tender_approval_datechecker', 'Date of tender approval cannot be less than AA Date');
          return false;
        }else{
          return true;  
        }
}


function _pre_tender_rfp_publish_date_checker($rfp_publish_date){
     
     $tender_approval_date = $this->input->post('tender_approval_date');
    
    if (strtotime($tender_approval_date) >= strtotime($rfp_publish_date) ){

            $this->form_validation->set_message('_pre_tender_rfp_publish_date_checker', 'RFP publish date must be Greater than Tender Approval Date');
            
            return false;
        }else{
          return true;  
        }
}


function _pre_tender_rfp_closing_date_checker($rfp_closing_date){
        $rfp_publish_date = $this->input->post('rfp_publish_date');
    
    if (strtotime($rfp_publish_date) > strtotime($rfp_closing_date) ){

            $this->form_validation->set_message('_pre_tender_rfp_closing_date_checker', 'RFP closing date must be Greater than or same RFP publish date');
            
            return false;
        }else{
          return true;  
        }
}


function _tender_rfp_publish_date_checker($rfp_publish_date,$project_id){
    $get_project_tender_rfp_closing_date = $this->Project_model->getSpecificdata('project_pre_tender_stage','project_id',$project_id,'rfp_closing_date');

    if ($rfp_publish_date < $get_project_tender_rfp_closing_date) {
          $this->form_validation->set_message('_tender_rfp_publish_date_checker', 'Final RFP Publish Date Must be Greater than RFP Closing Date');
          return false;
        }else{
          return true;  
        }
}


function _tender_rfp_closing_datechecker($rfp_closing_date){
    $rfp_publish_date = $this->input->post('rfp_publish_date');
    if(strtotime($rfp_publish_date) >= strtotime($rfp_closing_date)){
       $this->form_validation->set_message('_tender_rfp_closing_datechecker', 'Final RFP Closing Date Must be Greater than Final RFP Publish Date');
          return false; 
    }else{
        return true;
    }

}


function _tender_tech_opening_datechecker($tech_opening_date){
    $rfp_closing_date = $this->input->post('rfp_closing_date');
    if(strtotime($rfp_closing_date) >= strtotime($tech_opening_date)){
       $this->form_validation->set_message('_tender_tech_opening_datechecker', 'Technical Bid Opening Date Must be Greater than Final RPF closing Date');
          return false; 
    }else{
        return true;
    }
}

function _tender_finance_open_datechecker($finance_open_date){
        $tech_opening_date = $this->input->post('tech_opening_date');
        if(strtotime($tech_opening_date) > strtotime($finance_open_date)){
       $this->form_validation->set_message('_tender_finance_open_datechecker', 'Financial Bid Opening Date Must be Greater than or Same date of Technical Bid Opening Date');
          return false; 
    }else{
        return true;
    }
}

function _tender_tender_ly_datechecker($tender_ly_date){
    $finance_open_date = $this->input->post('finance_open_date');
        if(strtotime($finance_open_date) >= strtotime($tender_ly_date)){
       $this->form_validation->set_message('_tender_tender_ly_datechecker', 'Tender LOI Issue Date Must be Greater than Financial Bid Opening Date');
          return false; 
    }else{
        return true;
    }
}



/* agreement stage call back function for date validation*/

function _agree_agreement_datechecker($agreement_date,$project_id){
    $get_project_tender_rfp_closing_date = $this->Project_model->getSpecificdata('project_tender_stage','project_id',$project_id,'finance_bid_opening_date');

    if ($agreement_date <= $get_project_tender_rfp_closing_date) {
          $this->form_validation->set_message('_agree_agreement_datechecker', 'Agreement Date Must be Greater than Financial Bid Opening Date');
    return false;
    }else{
      return true;  
    }
}

function _agree_agreement_end_datechecker($agreement_end_date){
    $agreement_date = $this->input->post('agreement_date');
        if(strtotime($agreement_date) >= strtotime($agreement_end_date)){
       $this->form_validation->set_message('_agree_agreement_end_datechecker', 'Agreement end Date Must be Greater Than Agreement Date');
          return false; 
    }else{
        return true;
    }
}

function _agree_bg_validitychecker($bg_validity){

    $agreement_date = $this->input->post('agreement_date');
    $agreement_end_date = $this->input->post('agreement_end_date');

    if(strtotime($bg_validity) <= strtotime($agreement_date)){
       $this->form_validation->set_message('_agree_bg_validitychecker', 'BG Validity Must be Greater Than Agreement Date');
          return false; 
    }elseif (strtotime($bg_validity) >= strtotime($agreement_end_date)) {
        $this->form_validation->set_message('_agree_bg_validitychecker', 'BG Validity Must be Less Than Agreement End Date');
          return false; 
    }
    else{
        return true;
    }


}

function _agree_project_startchecker($project_start){
    $agreement_date = $this->input->post('agreement_date');
    $agreement_end_date = $this->input->post('agreement_end_date');

    if(strtotime($project_start) < strtotime($agreement_date)){
       $this->form_validation->set_message('_agree_project_startchecker', 'Project start date Must be Greater Than or same Agreement Date');
          return false; 
    }elseif (strtotime($project_start) > strtotime($agreement_end_date)) {
        $this->form_validation->set_message('_agree_project_startchecker', 'Project start date Must be Less Than or Same Agreement End Date');
          return false; 
    }
    else{
        return true;
    }

}

function _agree_project_end_datechecker($project_end_date){
    

    $agreement_end_date = $this->input->post('agreement_end_date');


    if (strtotime($project_end_date) < strtotime($agreement_end_date)) {
        $this->form_validation->set_message('_agree_project_end_datechecker', 'Project End Date  should be Same / greater than Agreement end  Date');
          return false; 
    }
    else{
        return true;
    }
}


  /* End Call Back function use for date valiadtion */



 

}

?>
