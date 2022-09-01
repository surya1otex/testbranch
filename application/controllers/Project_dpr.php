<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project_dpr extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','stepsbar_helper'));
        $this->load->model('Project_dpr_model');
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

    public function project_dpr(){
        $data = [];
        $user_id = $this->session->userdata('id');
        $data['project_id'] =  $_REQUEST['project_id'];
        $project_id = base64_decode($_REQUEST['project_id']);
        if(empty($project_id)){
            redirect('Project/project_conceptualisation');
        }


        $project_exist_flag = $this->Project_dpr_model->checkProjectExits($project_id);
        $data['dpr_status'] = $project_exist_flag;

        $data['project_approvers'] = $this->Project_dpr_model->get_org_users();
        $data['result'] = $this->Project_dpr_model->getProjectDprDetails($project_id);

        /* =====Checking for if this project this user created or not ======*/
       $project_creator_id = $this->Project_dpr_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'project_creator_id');
       
        $project_approver_id = $this->Project_dpr_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

        $project_conceptualisation_app_status = $this->Project_dpr_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
       if ($project_conceptualisation_app_status != 'Y') {
           redirect('project/project_conceptualisation?project_id='.base64_encode($project_id));
       }
       
       // elseif($project_creator_id == $user_id || $project_approver_id == $user_id){
        
       // }else{
       //  redirect('home/page_access');
       // }



        /* =====End Checking for if this project this user created or not ======*/
		
		

        $data['steps_files'] = $this->Project_dpr_model->getFiles($project_id,'project_dpr_stage_document');
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');
        

        
        $data['brakup_details']  = $this->Project_dpr_model->get_amount_brakup($project_id);
        $data['super_visor_dtl'] = $this->Procurement_model->getProjectUsers($project_id);

        $draft = $this->input->post('draft_mode');

        if($draft == 'D'){
            $this->form_validation->set_rules('dpr_prepared_by_user_id', 'User', 'required');
            
        }else{

        $this->form_validation->set_rules('dpr_prepared_by_user_id', 'User', 'required');
        $this->form_validation->set_rules('dpr_start_date', 'DPR start Date', 'required');
        $this->form_validation->set_rules('dpr_end_date', 'DPR end Date', 'required|callback__dpr_end_date_checker');
        //$this->form_validation->set_rules('dpr_submission_date', 'DPR submission Date', 'required');
        $this->form_validation->set_rules('dpr_submission_date', 'DPR submission Date', 'required|callback__dpr_submission_date_checker');

    

    }
        if ($this->form_validation->run() == FALSE) {

            $this->load->common_template('project/project_dpr', $data);
        }else{


            $db_data['dpr_prepared_by_user_id'] =  $this->checkEmptyValue($_REQUEST['dpr_prepared_by_user_id']);
            $db_data['dpr_start_date'] =  $this->checkEmptyValue($_REQUEST['dpr_start_date']);
            $db_data['dpr_end_date '] =  $this->checkEmptyValue($_REQUEST['dpr_end_date']);
            $db_data['dpr_submission_date'] =  $this->checkEmptyValue($_REQUEST['dpr_submission_date']);
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

                $db_approve_status = $this->Project_dpr_model->getSpecificdata('project_dpr_stage','project_id',$project_id,'approve_status');
                if($db_approve_status == 'R'){
                    $db_data['approve_status'] = 'N';
                }

                $this->Project_dpr_model->updateProjectDPRDetails($db_data,$project_id);
				
				
                /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_dpr_model->getFiles($project_id,'project_dpr_stage_document');
                
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
                        $get_old_file_name = $this->Project_dpr_model->getSpecificdata('project_dpr_stage_document','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_dpr_model->deleteData('document_id', $diff, 'project_dpr_stage_document');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_dpr_stage_document');

                /* end file update */


               

                if($draft == 'D'){
                $this->session->set_flashdata('success', 'Project Record Saved as draft successfully');
                }else{
                 $this->session->set_flashdata('success', 'Project Record Updated successfully');   
                }



            }else{
                /**Insert Project data**/
                $db_data['project_id'] =  $project_id;
                $db_data['created_by_user_id'] = $this->session->userdata('id');
                $this->Project_dpr_model->addProjectDPR($db_data);

                if($draft == 'D'){
                $this->session->set_flashdata('success', 'Project Record Saved as draft successfully');
                }else{
                 $this->session->set_flashdata('success', 'Project Data saved successfully');   
                }

            }

    

            
            redirect('project_list/pip_dpr');
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
                $this->Project_dpr_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }


/*start call back function for date validation */

    function _dpr_end_date_checker($dpr_end_date){
        $dpr_start_date = $this->input->post('dpr_start_date');


        if (strtotime($dpr_end_date) < strtotime($dpr_start_date)) {
            $this->form_validation->set_message('_dpr_end_date_checker', '%s should be Same / greater than Master Plan / DPR Start Date');
              return false; 
        }
        else{
            return true;
        }
    }


    function _dpr_submission_date_checker($dpr_submission_date){
        $dpr_end_date = $this->input->post('dpr_end_date');


        if (strtotime($dpr_submission_date) < strtotime($dpr_end_date)) {
            $this->form_validation->set_message('_dpr_submission_date_checker', '%s should be Same / greater than Master Plan / DPR End Date');
              return false; 
        }
        else{
            return true;
        }
    }

  /* End Call Back function use for date valiadtion */



}

?>
