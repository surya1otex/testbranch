<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project_tender_publishing extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','stepsbar_helper'));
        $this->load->model('Project_tender_publishing_model');
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

         $data['project_id'] = base64_decode($_REQUEST['project_id']);
         $project_id = $data['project_id'];
         $user_id = $this->session->userdata('id');


		 
		// print_r($data);
	 
        if(empty($data['project_id'])){
			
            redirect('Project/project_conceptualisation');
        }

      

        $project_exist_flag = $this->Project_tender_publishing_model->checkProjectExits($data['project_id'],'project_tender_stage');
        $data['project_tender_status'] = $project_exist_flag;
        //$data['project_tender_status'] = $this->Project_tender_publishing_model->checkProjectExits($data['project_id'],'project_tender_stage');
        //$data['project_agreement_status'] = $this->Project_tender_publishing_model->checkProjectExits($data['project_id'],'project_aggrement_stage');

        $data['result'] = $this->Project_tender_publishing_model->getProjectTenderDetails($data['project_id']);
        $data['steps_files'] = $this->Project_tender_publishing_model->getFiles($data['project_id'],'project_tender_stage_documents');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

        /*** Form Validation Rules ***/
                $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('tender_ref_no', 'Tender Reference number', 'required');
            $this->form_validation->set_rules('tender_name', 'Tender Name', 'required');
              
        }else{

            $this->form_validation->set_rules('tender_ref_no', 'Tender Reference number', 'required');
            $this->form_validation->set_rules('tender_name', 'Tender Name', 'required');
            //$this->form_validation->set_rules('tender_publishing_date', 'Tender Publishing Date', 'required|callback__tender_publishing_date_checker');
            $this->form_validation->set_rules('tender_publishing_date', 'Tender Publishing Date', 'required');
            $this->form_validation->set_rules('tender_start_date', 'Tender Start Date', 'required');
            $this->form_validation->set_rules('bid_submission_date', 'Bid Submission date', 'required');

            

            

    	}
        /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_tender_publishing', $data);

        }else {

				/*echo "<pre>";
				print_r($_REQUEST);
				echo "</pre>";
				die();*/
           // $data_project_conceptual = $this->Project_tender_publishing_model->getProjectConceptualisationDetails($data['project_id']);
           // $data_project_preparation = $this->Project_tender_publishing_model->getProjectPreparationDetails($data['project_id']);

            $project_db_pre_tender_status = $this->Project_tender_publishing_model->getSpecificdata('project_tender_stage','project_id',$project_id,'approve_status');

          // start
		   $db_data['project_id'] = base64_decode($_REQUEST['project_id']);
				
				if($draft == 'D'){
                  $db_data['draft_mode'] = 'Y';
                  }else{
                    $db_data['draft_mode'] = 'N';
                  } 
                
                $db_data['tender_ref_no'] = $_REQUEST['tender_ref_no'];
                $db_data['tender_name'] =$this->checkEmptyValue($_REQUEST['tender_name']);
                $db_data['tender_short_name'] = $this->checkEmptyValue($_REQUEST['tender_short_name']);
                $db_data['tender_type_coverage'] = $this->checkEmptyValue($_REQUEST['tender_type_coverage']);
                $db_data['tender_type_geography'] = $this->checkEmptyValue($_REQUEST['tender_type_geography']);
                $db_data['tender_type_precurement'] = $this->checkEmptyValue($_REQUEST['tender_type_precurement']);
                $db_data['tender_type_execution'] = $this->checkEmptyValue($_REQUEST['tender_type_execution']);
                $db_data['tender_publishing_date'] = $this->checkEmptyValue($_REQUEST['tender_publishing_date']);
                $db_data['tender_start_date'] = $this->checkEmptyValue($_REQUEST['tender_start_date']);
                $db_data['bid_submission_date'] = $this->checkEmptyValue($_REQUEST['bid_submission_date']);
                $db_data['pre_bid_conf_venue'] = $this->checkEmptyValue($_REQUEST['pre_bid_conf_venue']);
                $db_data['pre_bid_conf_date'] = $this->checkEmptyValue($_REQUEST['pre_bid_conf_date']);
                $db_data['pre_bid_conf_time'] = $this->checkEmptyValue($_REQUEST['pre_bid_conf_time']);
                $db_data['bid_submission_last_date'] = $this->checkEmptyValue($_REQUEST['bid_submission_last_date']);
                $db_data['bid_submission_last_time'] = $this->checkEmptyValue($_REQUEST['bid_submission_last_time']);
                //$db_data['put_tender_value'] = $this->checkEmptyValue($_REQUEST['put_tender_value']);
                $db_data['put_tender_value'] = $this->checkEmptyValue(str_replace(',','',$_REQUEST['put_tender_value']));

               // $db_data['created_by'] =  $this->session->userdata('id');
                
                /**Update Project data**/
                if($project_exist_flag){
                    $db_data['modified_by'] =  $this->session->userdata('id');
                    $db_approve_status = $this->Project_tender_publishing_model->getSpecificdata('project_tender_stage','project_id',$data['project_id'],'approve_status');
                    if($db_approve_status == 'R'){
                        $db_data['approve_status'] = 'N';
                    }
                    $this->Project_tender_publishing_model->updateProjectTenderPunlishingDetails($db_data,$data['project_id']);

                    /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_tender_publishing_model->getFiles($project_id,'project_tender_stage_documents');
                
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
                        $get_old_file_name = $this->Project_tender_publishing_model->getSpecificdata('project_tender_stage_documents','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_tender_publishing_model->deleteData('document_id', $diff, 'project_tender_stage_documents');

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
                    $db_data['project_id'] = $data['project_id'];
                    $db_data['created_by'] =  $this->session->userdata('id');
                    $this->Project_tender_publishing_model->addProjectTenderPublishing($db_data);
                    /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_tender_stage_documents');

                /* file upload */
                $this->session->set_flashdata('success', 'Project Data Added successfully');

                }
           
            

            redirect('project_list/pip_tender_publishing');
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
                $this->Project_tender_publishing_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }


    /* start call back function use for date validation */

    function _tender_publishing_date_checker($tender_publishing_date){
        $tender_start_date = $this->input->post('tender_start_date');
        $project_id = base64_decode($_REQUEST['project_id']);
        $administrative_approval_date = $this->Project_tender_publishing_model->getSpecificdata('project_administrative_approval_stage','project_id',$project_id,'administrative_approval_date');

        if (strtotime($tender_publishing_date) < strtotime($administrative_approval_date)) {
            $this->form_validation->set_message('_tender_publishing_date_checker', 'Tender Publishing Date should be Same / greater than Administrative Approval Date');
              return false; 
        }else{
            return true;
        }
    }



    function _tender_start_date_checker($tender_start_date){
        $tender_publishing_date = $this->input->post('tender_publishing_date');
        if(strtotime($tender_publishing_date) > strtotime($tender_start_date)){
            $this->form_validation->set_message('_tender_start_date_checker', 'Tender Start Date should be Same / greater than Tender Publishing Date');
              return false; 
        }else{
            return true;
        }
    }


    function _bid_submission_date_checker($bid_submission_date){
        $tender_publishing_date = $this->input->post('tender_publishing_date');
        if(strtotime($tender_publishing_date) > strtotime($bid_submission_date)){
            $this->form_validation->set_message('_bid_submission_date_checker', 'Bid Submission date should be Same / greater than Tender Publishing Date');
              return false; 
        }else{
            return true;
        }
    }

  /* End Call Back function use for date valiadtion */



 

}

?>
