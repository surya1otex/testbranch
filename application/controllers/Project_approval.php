<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_approval extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper'));
        $this->load->helper(array('url', 'security'));

        $this->load->model('Project_approval_model');
        //$this->load->model('Organization_model');
        $this->allowedModule = array(1 => true, 3 => false, 6 => false, 2 => false, 5 => false, 7 => false, 4 => false);
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }


    /* for listing Page */

    function pip(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
        
          $data['approvalData'] = $this->Project_approval_model->get_peoject_approval_data($user_id,$circle_id,$division_id);

           $this->load->common_template('approval/approval_list_view', $data);
    }


    /* end for listing Page */


  


public function get_project_history_data(){
        $project_id = $_REQUEST['project_id'];
        $stage_id = $_REQUEST['stage_id'];
        $data['project_history'] = $this->Project_approval_model->get_project_history_data($project_id,$stage_id);

        for( $i = 0 ; $i < count($data['project_history']); $i++){
            $approver_id = $data['project_history'][$i]['approver_id'];

            $approver_user_type = $this->Project_approval_model->get_user_type($approver_id);
            if($approver_user_type == 2){
               // $approver_details = $this->Project_approval_model->get_level2_details($approver_id);
            }else if( $approver_user_type == 3){
                $approver_details = $this->Project_approval_model->get_level3_details($approver_id);
            }
            $data['project_history'][$i]['approver_details'] = $approver_details[0];
            $requester_id = $data['project_history'][$i]['requester_id'];
            $requester_user_type = $this->Project_approval_model->get_user_type($requester_id);
            if($requester_user_type == 2){
                //$requester_details = $this->Project_approval_model->get_level2_details($requester_id);
            }else if( $requester_user_type == 3){
                $requester_details = $this->Project_approval_model->get_level3_details($requester_id);
            }
            $data['project_history'][$i]['requester_details'] = $requester_details[0];

        }

        $this->load->view('approval/project_history', $data);
    }



    function approve(){
       $enc_project_id = $_REQUEST['project_id'];
       $enc_stage_id = $_REQUEST['stage_id'];

       $project_id = base64_decode($enc_project_id);
       $stage_id = base64_decode($enc_stage_id);

       $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){
            
            $this->form_validation->set_rules('approve_date', 'Approval Date', 'required');
              
          if ($this->form_validation->run() == TRUE){
            if( !empty($_FILES['attachment'])) {
                
                $config['upload_path'] = 'uploads/attachment/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx";
                $config['max_size'] = 50000;
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

            $att = !empty($_FILES['attachment']) ? $file_data['file_name'] : "";

            if($stage_id == 1){
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('id', 'project_conceptualisation_stage', $updateData, $project_id);
            }elseif($stage_id == 2){
                 /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }

                $updateData2 = array(
                    'approve_status' => 'Y'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_preparation_stage', $updateData2, $project_id);
            }elseif ($stage_id == 3) {
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_pre_tender_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'Y'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_pre_tender_stage', $updateData2, $project_id);
            }elseif ($stage_id == 4) {
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'Y'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_tender_stage', $updateData2, $project_id);
            }elseif ($stage_id == 5) {
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_aggrement_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'Y'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_aggrement_stage', $updateData2, $project_id);
            }


            $approveData = array(
                'project_id ' => $project_id ,  
                'type ' => 'project' , 
                'project_step_no' => $stage_id , 
                'requester_id' => $this->input->post('requester_id') , 
                'approver_id' => $user_id , 
                'created_by' => $user_id , 
                'created_on' => date('Y-m-d') , 
                'approval_date' => $this->input->post('approve_date') , 
                'attachment' =>$att,
                'remarks' =>$this->input->post('remarks') ,
                'approval_status'=>'Y'
            );

            $this->Project_approval_model->insertAllData($approveData,'project_approval');

            $this->session->set_flashdata('success', 'Data Updated successfully');
             if($stage_id == 1 || $stage_id == 2){
              redirect('project_approval/pip');  
          }elseif($stage_id == 3 || $stage_id == 4 || $stage_id == 5){
            redirect('project_approval/pp');  
          }




            

            

          }


        }

        $data['project_id'] = $project_id;
        $data['stage_id'] = $stage_id;
        $data['project_details'] = $this->Project_approval_model->get_peoject_details_data($project_id);
        $this->load->common_template('approval/project_approval_view', $data);

    }


    function reject(){
       $enc_project_id = $_REQUEST['project_id'];
       $enc_stage_id = $_REQUEST['stage_id'];
       $project_id = base64_decode($enc_project_id);
       $stage_id = base64_decode($enc_stage_id);

       $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){
            
            $this->form_validation->set_rules('approve_date', 'Approval Date', 'required');
              
          if ($this->form_validation->run() == TRUE){
            if( !empty($_FILES['attachment'])) {
                $config['upload_path'] = 'uploads/attachment/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx";
                $config['max_size'] = 50000;
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

            $att = !empty($_FILES['attachment']) ? $file_data['file_name'] : "";

            if($stage_id == 1){
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'R' || $db_approve_status == 'Y'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
               $updateData = array(
                'approve_status' => 'R', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('id', 'project_conceptualisation_stage', $updateData, $project_id);

            }elseif($stage_id == 2){

                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'R' || $db_approve_status1 == 'Y'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }

                $updateData2 = array(
                    'approve_status' => 'R'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_preparation_stage', $updateData2, $project_id);
            }elseif($stage_id == 3){

                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_pre_tender_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'R' || $db_approve_status1 == 'Y'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'R'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_pre_tender_stage', $updateData2, $project_id);
            }elseif($stage_id == 4){

                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'R' || $db_approve_status1 == 'Y'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'R'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_tender_stage', $updateData2, $project_id);
            }elseif($stage_id == 5){

                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_aggrement_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'R' || $db_approve_status1 == 'Y'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

                $updateData2 = array(
                    'approve_status' => 'R'
                );
                 $this->Project_approval_model->updateData('project_id', 'project_aggrement_stage', $updateData2, $project_id);
            }

            $approveData = array(
                'project_id ' => $project_id , 
                'type ' => 'project' , 
                'project_step_no' => $stage_id , 
                'requester_id' => $this->input->post('requester_id') , 
                'approver_id' => $user_id , 
                'created_by' => $user_id , 
                'created_on' => date('Y-m-d') , 
                'approval_date' => $this->input->post('approve_date') , 
                'attachment' =>$att,
                'remarks' =>$this->input->post('remarks') ,
                'approval_status'=>'N'
            );

            $this->Project_approval_model->insertAllData($approveData,'project_approval');

            $this->session->set_flashdata('success', 'Data Updated successfully');
            if($stage_id == 1 || $stage_id == 2){
              redirect('project_approval/pip');  
          }elseif($stage_id == 3 || $stage_id == 4 || $stage_id == 5){
            redirect('project_approval/pp');  
          }
            




            

            

          }


        }

        $data['project_id'] = $project_id;
        $data['stage_id'] = $stage_id;
        $data['project_details'] = $this->Project_approval_model->get_peoject_details_data($project_id);
       
        $this->load->common_template('approval/project_reject_view', $data);
    }
	
	
    function update_status(){
       $enc_project_id = $_REQUEST['project_id'];
      $enc_stage_id = $_REQUEST['stage_id'];

       $project_id = base64_decode($enc_project_id);
       $stage_id = base64_decode($enc_stage_id);


        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $alloted_fund = $this->input->post('alloted_fund');
		
		
        $data['project_history'] = $this->Project_approval_model->get_project_history_data($project_id,$stage_id);
        
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){
            
            //$this->form_validation->set_rules('alloted_fund', 'Fund Alloted', 'required');
            //$this->form_validation->set_rules('decission_status', 'Decision status', 'required');
            //if ($stage_id == 5) {   //Administrative Approval
                if($this->input->post('approve_date') != ''){
                 $this->form_validation->set_rules('approve_date', 'Approve Date', 'callback_approve_date_checker');   
                }
                
                
            //}
            //if ($stage_id == 3) {   //Administrative Approval

                $this->form_validation->set_rules('alloted_fund', 'Alloted Fund', 'callback_alloted_fund_checker');  
                // if($this->input->post('alloted_fund') != ''){
                //  $this->form_validation->set_rules('alloted_fund', 'Alloted Fund', 'callback_alloted_fund_checker');   
                // }
                
                
           // }
              
          if ($this->form_validation->run() == TRUE){
            if( !empty($_FILES['attachment'])) {
                
                $config['upload_path'] = 'uploads/attachment/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx";
                $config['max_size'] = 50000;
                //$config['file_name'] = $_FILES['attachment']['name'] . "_" . time();
                $this->load->library('upload', $config);
                $data = [];
                $flie_upload_error_flag = 0;

                if (!$this->upload->do_upload('attachment') && !empty($_FILES['attachment']['name'])) {
                    $data['flie_upload_error_flag'] = $flie_upload_error_flag;
                    $this->session->set_flashdata('danger', 'Please upload pdf, docx, xls, xlsx, jpg, jpeg, png file and file size should be less than or same 50 MB');
                    redirect('project_approval/update_status?project_id='.$_REQUEST['project_id'].'&stage_id='.$_REQUEST['stage_id']);

                } else {
                    $file_data = $this->upload->data();

                }
            }

            $att = !empty($_FILES['attachment']) ? $file_data['file_name'] : "";

            if($stage_id == 1){		// Initial Project Profile
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('id', 'project_conceptualisation_stage', $updateData, $project_id);
				}
            }
			elseif($stage_id == 2){ 	//Identified Stackholders
                 /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }

               if ($this->input->post('decission_status') == "Y") {
               $updateData2 = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_preparation_stage', $updateData2, $project_id);
				}
            }
			elseif ($stage_id == 3) {		//DPR
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_dpr_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

				 
				if ($this->input->post('decission_status') == "Y") {
               $updateData2 = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_dpr_stage', $updateData2, $project_id);
				}
				 
				 
            }
			elseif ($stage_id == 4) {		//Pre Construction Activities
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('pre_construction_settings','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

				if ($this->input->post('decission_status') == "Y") {
                $updateData2 = array(
                    'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                );
                 $this->Project_approval_model->updateData('project_id', 'pre_construction_settings', $updateData2, $project_id);
				}
            }
			elseif ($stage_id == 5) {	//Administrative Approval
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_administrative_approval_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

				if ($this->input->post('decission_status') == "Y") {
                $updateData2 = array(
                    'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                );
                 $this->Project_approval_model->updateData('project_id', 'project_administrative_approval_stage', $updateData2, $project_id);
				}
            }
			elseif ($stage_id == 6) {	//Tender Publishing
                /* for checking if same link hit */
                $db_approve_status1 = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'approve_status');
                if($db_approve_status1 == 'Y' || $db_approve_status1 == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pp');
                }

				if ($this->input->post('decission_status') == "Y") {
                $updateData2 = array(
                    'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                );
                 $this->Project_approval_model->updateData('project_id', 'project_tender_stage', $updateData2, $project_id);
				}
            }


            $approveData = array(
                'project_id ' => $project_id ,  
                'type ' => 'project' , 
                'project_step_no' => $stage_id , 
                'requester_id' => $this->input->post('requester_id') , 
                'approver_id' => $user_id , 
                'created_by' => $user_id , 
                'created_on' => date('Y-m-d') , 
                'approval_date' => $this->input->post('approve_date') , 
                //'alloted_fund' => $this->input->post('alloted_fund') , 
                'alloted_fund' => str_replace(',','',$alloted_fund),
                'attachment' =>$att,
                'remarks' =>$this->input->post('remarks') ,
                'approval_status'=>$this->input->post('decission_status')
            );

            $this->Project_approval_model->insertAllData($approveData,'project_approval');

            $this->session->set_flashdata('success', 'Data Updated successfully');
             if($stage_id == 1 || $stage_id == 2 || $stage_id == 3 || $stage_id == 4 || $stage_id == 5 || $stage_id == 6){
              redirect('project_approval/pip');  
          }elseif($stage_id == 7 || $stage_id == 8 || $stage_id == 9){
            redirect('project_approval/pp');  
          }
 

          }


        }
		else //UPDATE DATA
		{
		   $project_approval_Tid = $this->input->post('project_approval_Tid');
            
            //$this->form_validation->set_rules('alloted_fund', 'Fund Alloted', 'required');
           // $this->form_validation->set_rules('decission_status', 'Decision status', 'required');
           // if ($stage_id == 5) {   //Administrative Approval
                if($this->input->post('approve_date') != ''){
                 $this->form_validation->set_rules('approve_date', 'Approve Date', 'callback_approve_date_checker');   
                }
                
                
            //}
            //if ($stage_id == 3) {   //Administrative Approval

                $this->form_validation->set_rules('alloted_fund', 'Alloted Fund', 'callback_alloted_fund_checker');  
                // if($this->input->post('alloted_fund') != ''){
                //  $this->form_validation->set_rules('alloted_fund', 'Alloted Fund', 'callback_alloted_fund_checker');   
                // }
                
                
            //}
              
          if ($this->form_validation->run() == TRUE){
            if( !empty($_FILES['attachment'])) {
				
                
                $config['upload_path'] = 'uploads/attachment/';
                $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx";
                $config['max_size'] = 50000;
                //$config['file_name'] = $_FILES['attachment']['name'] . "_" . time();
                $this->load->library('upload', $config);
                $data = [];
                $flie_upload_error_flag = 0;

                if (!$this->upload->do_upload('attachment') && !empty($_FILES['attachment']['name'])) {
                    $data['flie_upload_error_flag'] = $flie_upload_error_flag;
                    $this->session->set_flashdata('danger', 'Please upload right file!!');
                    redirect('project_approval/update_status?project_id='.$_REQUEST['project_id'].'&stage_id='.$_REQUEST['stage_id']);

                } else {
                    $file_data = $this->upload->data();

                }
				
            $att = !empty($_FILES['attachment']) ? $file_data['file_name'] : "";
            }
			
			$att =$this->input->post('hidden_attachment');
			
			
            if($stage_id == 1){			// Initial Project Profile
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'Please upload pdf, docx, xls, xlsx, jpg, jpeg, png file and file size should be less than or same 50 MB');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('id', 'project_conceptualisation_stage', $updateData, $project_id);
				}
            }
            elseif($stage_id == 2){		// Identified Stackholders
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_preparation_stage','id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_preparation_stage', $updateData, $project_id);
				}
            }
            elseif($stage_id == 3){		// DPR
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_dpr_stage','project_id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_dpr_stage', $updateData, $project_id);
				}
            }
            elseif($stage_id == 4){			// Pre Construction Activities
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('pre_construction_settings','project_id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'pre_construction_settings', $updateData, $project_id);
				}
            }
            elseif($stage_id == 5){		// Administrative Approval
                /* for checking if same link hit */
                $db_approve_status = $this->Project_approval_model->getSpecificdata('project_administrative_approval_stage','project_id',$project_id,'approve_status');
                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_administrative_approval_stage', $updateData, $project_id);
				}
            }
            elseif($stage_id == 6){		// Tender Publishing
                /* for checking if same link hit */
               $db_approve_status = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'approve_status');

                if($db_approve_status == 'Y' || $db_approve_status == 'R'){
                    $this->session->set_flashdata('danger', 'This data already updated!!');
                    redirect('project_approval/pip');
                }
				if ($this->input->post('decission_status') == "Y") {
               $updateData = array(
                'approve_status' => 'Y', 
                'modified_by'=>$user_id,
                'modified_on'=>date('Y-m-d')
                ); 
               $this->Project_approval_model->updateData('project_id', 'project_tender_stage', $updateData, $project_id);
				}
            }
            $updatedData = array(
                'project_id ' => $project_id ,  
                'type ' => 'project' , 
                'project_step_no' => $stage_id , 
                'requester_id' => $this->input->post('requester_id') , 
                'approver_id' => $user_id , 
                'created_by' => $user_id , 
                'created_on' => date('Y-m-d') , 
                'approval_date' => $this->input->post('approve_date') , 
                //'alloted_fund' => $this->input->post('alloted_fund') ,
                'alloted_fund' => str_replace(',','',$alloted_fund), 
                'attachment' =>$att,
                'remarks' =>$this->input->post('remarks') ,
                'approval_status'=>$this->input->post('decission_status')
            );

           // $this->Project_approval_model->insertAllData($updatedData,'project_approval');
 			$this->Project_approval_model->updateData('id', 'project_approval', $updatedData, $project_approval_Tid);
 
            $this->session->set_flashdata('success', 'Data Updated successfully');
             if($stage_id == 1 || $stage_id == 2 || $stage_id == 3 || $stage_id == 4 || $stage_id == 5 || $stage_id == 6){
              redirect('project_approval/pip');  
          }elseif($stage_id == 7 || $stage_id == 8 || $stage_id == 9){
            redirect('project_approval/pp');  
          }

            

          }


        	
		}

        $data['project_id'] = $project_id;
        $data['stage_id'] = $stage_id;
        $data['project_details'] = $this->Project_approval_model->get_peoject_details_data($project_id);
        $this->load->common_template('approval/project_approval_view', $data);

    }



    function pp(){
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          
          $data['approvalData'] = $this->Project_approval_model->get_peoject_procurement_approval_data($user_id);

           $this->load->common_template('approval/procurement_approval_view', $data);
    }


    /* Call bach function for approve_date_checker */


    function approve_date_checker(){
        $project_id = base64_decode($_REQUEST['project_id']);
        $stage_id = base64_decode($_REQUEST['stage_id']);
        $approve_date = $this->input->post('approve_date');
        // if($stage_id == 5){
        //    $db_approve_status = $this->Project_approval_model->getSpecificdata('project_administrative_approval_stage','project_id',$project_id,'administrative_approval_date'); 
        //        }elseif($stage_id == 6){
        //         $db_approve_status = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'tender_publishing_date');
        //     }elseif($stage_id == 3){
                
        //         $db_approve_status = $this->Project_approval_model->getSpecificdata('project_dpr_stage','project_id',$project_id,'dpr_submission_date');
        //     }

        if($stage_id == 6){
            $db_approve_status = $this->Project_approval_model->getSpecificdata('project_tender_stage','project_id',$project_id,'tender_publishing_date');
            }
        else{
                return true;  
            }
        
        if (strtotime($approve_date) > strtotime($db_approve_status) ){

            $this->form_validation->set_message('approve_date_checker', 'Approval Date must be smaller than Tender Publishing Date');
            
            return false;
        }else{
          return true;  
        }
    }

    function alloted_fund_checker(){
        $project_id = base64_decode($_REQUEST['project_id']);
        $alloted_fund = $this->input->post('alloted_fund');
        $estimate_total_cost = $this->Project_approval_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'estimate_total_cost');
        if ($alloted_fund > $estimate_total_cost ){

            $this->form_validation->set_message('alloted_fund_checker', '%s must be Less than Estimated Cost');
            
            return false;
        }else{
          return true;  
        }
    }


  

}