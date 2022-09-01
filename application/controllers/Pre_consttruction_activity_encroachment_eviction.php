<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_encroachment_eviction extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Pre_con_act_encroachment_eviction_model');
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
        $data['districts'] = $this->Pre_con_act_encroachment_eviction_model->fetch_district();
        $data['encroachment_type'] = $this->Pre_con_act_encroachment_eviction_model->fetch_encroachment();
		
		
        $projectData_exist_flag = $this->Pre_con_act_encroachment_eviction_model->checkProjectExits($project_id);
		
        $data['encroachment_data'] = $this->Pre_con_act_encroachment_eviction_model->encroachment_data($project_id);
        $data['encroachment_location_data'] = $this->Pre_con_act_encroachment_eviction_model->encroachment_location_data($project_id);
	
        $this->form_validation->set_rules('total_area', 'Area under Encroachment', 'required'); 
		
		   /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
			
			
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_encroachment_eviction', $data);

        }
		
		else{ 
		
		
		$submit = $this->input->post('submit');
		if($submit == 'Submit'){
			
            $db_data['project_id'] = $project_id;
            $db_data['total_area'] = $_REQUEST['total_area'];
            $db_data['types_of_encroachment'] = $_REQUEST['types_of_encroachment'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_joint_verification'] = $_REQUEST['status_joint_verification'];
            $db_data['status_formal_requisition'] = $_REQUEST['status_formal_requisition'];
            $db_data['status_encroachment_eviction'] = $_REQUEST['status_encroachment_eviction'];
            $db_data['status_encroachment_notice'] = $_REQUEST['status_encroachment_notice'];
            $db_data['progress_encroachment_area'] = ($_REQUEST['progress_encroachment_area'] == '') ? NULL : $_REQUEST['progress_encroachment_area'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            $db_data['progress_enroachment_area_aa'] = $_REQUEST['progress_enroachment_area_aa'];

            $db_data['progress_amount_utilised'] = ($_REQUEST['progress_amount_utilised'] == '') ? NULL :  str_replace(',','',$_REQUEST['progress_amount_utilised']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['progress_fund_utilised'] == '') ? NULL : $_REQUEST['progress_fund_utilised'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
			
			
			 // File upload
		
	

	
	$config['upload_path']          = 'uploads/attachment/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
	
	
	
	
	
	if($_FILES["file_joint_verification"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_joint_verification']['name'];
        $this->load->library('upload', $config);
        $file_joint_verification = $this->upload->do_upload('file_joint_verification');
        if (!$file_joint_verification){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", ".");
        }else{
            $file_joint_verification = $this->upload->data("file_name");
        }
		
			$db_data['file_joint_verification'] = $file_joint_verification;
    }
	else {
		
		if (!empty ($_REQUEST['file_joint_verification_hidden'])) {
			
			$db_data['file_joint_verification'] = $_REQUEST['file_joint_verification_hidden'];
			
		}
		
	}
	

    if($_FILES["file_eviction"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_eviction']['name'];
        if($_FILES["file_joint_verification"]["name"]){
            $this->upload->initialize($config);
        }else{
            $this->load->library('upload', $config);
        }
        $file_eviction = $this->upload->do_upload('file_eviction');
        if (!$file_eviction){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", "" );
        }else{
            $file_eviction = $this->upload->data("file_name");
        }
		
			$db_data['file_eviction'] = $file_eviction;
		
    }
	else {
		
		if (!empty ($_REQUEST['file_eviction_hidden'])) {
			
			$db_data['file_eviction'] = $_REQUEST['file_eviction_hidden'];
			
		}
		
	}

    if($_FILES["file_requisition"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_requisition']['name'];
        if($_FILES["file_joint_verification"]["name"]){
            $this->upload->initialize($config);
        }else if($_FILES["file_eviction"]["name"]){
            $this->upload->initialize($config);
        }else{
            $this->load->library('upload', $config);
        }
        $file_requisition = $this->upload->do_upload('file_requisition');
        if (!$file_requisition){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", "" );
        }else{
            $file_requisition = $this->upload->data("file_name");
        }
		
			$db_data['file_requisition'] = $file_requisition;
    }
	else {
		
		if (!empty ($_REQUEST['file_requisition_hidden'])) {
			
			$db_data['file_requisition'] = $_REQUEST['file_requisition_hidden'];
			
		}
		
	}

    if($_FILES["file_encroachment"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_encroachment']['name'];
        if($_FILES["file_joint_verification"]["name"]){
            $this->upload->initialize($config);
        }else if($_FILES["file_eviction"]["name"]){
            $this->upload->initialize($config);
        }else if($_FILES["file_requisition"]["name"]){
            $this->upload->initialize($config);
        }else{
            $this->load->library('upload', $config);
        }
        $file_encroachment = $this->upload->do_upload('file_encroachment');
        if (!$file_encroachment){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", "" );
        }else{
            $file_encroachment = $this->upload->data("file_name");
        }
		
			$db_data['file_encroachment'] = $file_encroachment;
    }
	else {
		
		if (!empty ($_REQUEST['file_encroachment_hidden'])) {
			
			$db_data['file_encroachment'] = $_REQUEST['file_encroachment_hidden'];
			
		}
		
	}
	
	

			
			
			 if(!empty($projectData_exist_flag)){  //UPDATE
				 
				$encroachment_eviction_id = $data['encroachment_data'][0]['id'];	
				$EE_last_data_update =$this->Pre_con_act_encroachment_eviction_model->updateEncroachment_eviction($db_data,$encroachment_eviction_id);
			 }
			 
			 
			 else { //ADD
			
				$EE_last_data =$this->Pre_con_act_encroachment_eviction_model->addEncroachment_eviction($db_data);
			
			 }
		
			 
			 
		
			 
			//location update
            $dist_id_count = count($_REQUEST['dist_id']);
	        $ulb_id_arr = $this->input->post('ulb_id');
	        $tehsil_id_arr = $this->input->post('tehsil_id');
	        $dist_id_arr = $this->input->post('dist_id');	
			
		
            $hd_row_count = count($_REQUEST['hd_row_no']);
	        $hd_row_arr = $this->input->post('hd_row_no');	
			/*echo "<pre>";
		print_r($_REQUEST);
		echo "</pre>";
		die;*/
			/*for ($c=0; $c < $hd_row_count; $c++) { 
			
			$row_no = $hd_row_arr[$c];
			//echo $hd_row_arr[$c]."<br>";
			echo $dist_id_arr[$c]."---district<br>";
			 $tehsil_id_arr[$row_no]."---tehsils<br>";
			echo $aaa_id = implode(",", $tehsil_id_arr[$row_no])."---tehsils list<br><br>";
			}*/
		
				 
			
			if (!empty($data['encroachment_location_data'])) {
				
				$del_location_data =$this->Pre_con_act_encroachment_eviction_model->deleteEncroachment_eviction_location($project_id);
						
			}
			
			
			for ($i=0; $i < $hd_row_count; $i++) { 
			
			$row_no = $hd_row_arr[$i];
              
              	if(!empty($tehsil_id_arr[$row_no]))
			  		{
						  
					  $a_id = implode(",", $tehsil_id_arr[$row_no]);
					  if($a_id != ''){
						$tehsil_id = $a_id;
					  }else{
						$tehsil_id = 0;
					  }
           		 	}
				else {
               			$tehsil_id = 0; 
            		}
					
				if(!empty($ulb_id_arr[$row_no]))
			  		{
					  $s_id = implode(",", $ulb_id_arr[$row_no]);
					  if($s_id != ''){
						$ulb_id = $s_id;
					  }else{
						$ulb_id = 0;
					  }
           		 	}
				else {
               			$ulb_id = 0; 
            		}
				if (!empty($dist_id_arr[$i])) {
                    $addData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $EE_last_data,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'ulb_id' => $ulb_id, 
                    'entered_by' => $user_id
                );
				 if(!empty($projectData_exist_flag)){  //UPDATE
				 
				$encroachment_eviction_id = $data['encroachment_data'][0]['id'];	
				
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $encroachment_eviction_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'ulb_id' => $ulb_id, 
                    'entered_by' => $user_id
                );
					
				
					$this->Pre_con_act_encroachment_eviction_model->addEncroachment_eviction_location($UaddData);
				 }
				 else
				 {
				
					$this->Pre_con_act_encroachment_eviction_model->addEncroachment_eviction_location($addData);
				
				 }
				}
                  
            }
			
			
		  
		   	/*for ($i=0; $i < $dist_id_count; $i++) { 
              
              	if(!empty($tehsil_id_arr[$i]))
			  		{
						   echo $tehsil_id_arr[$i];
						   die;
					  $a_id = implode(",", $tehsil_id_arr[$i]);
					  if($a_id != ''){
						$tehsil_id = $a_id;
					  }else{
						$tehsil_id = 0;
					  }
           		 	}
				else {
               			$tehsil_id = 0; 
            		}
					
				if(!empty($ulb_id_arr[$i]))
			  		{
					  $s_id = implode(",", $ulb_id_arr[$i]);
					  if($s_id != ''){
						$ulb_id = $s_id;
					  }else{
						$ulb_id = 0;
					  }
           		 	}
				else {
               			$ulb_id = 0; 
            		}
				
                    $addData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $EE_last_data,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'ulb_id' => $ulb_id, 
                    'entered_by' => $user_id
                );
				 if(!empty($projectData_exist_flag)){  //UPDATE
				 
				$encroachment_eviction_id = $data['encroachment_data'][0]['id'];	
				
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $encroachment_eviction_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'ulb_id' => $ulb_id, 
                    'entered_by' => $user_id
                );
					
				
					$this->Pre_con_act_encroachment_eviction_model->addEncroachment_eviction_location($UaddData);
				 }
				 else
				 {
				
					$this->Pre_con_act_encroachment_eviction_model->addEncroachment_eviction_location($addData);
				
				 }
                  
            }*/
			

		
		
		}
			
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
		
		 if($project_id){

                redirect('Pre_consttruction_activity_encroachment_eviction/manage?project_id=' . base64_encode($project_id));
            }
		
		}
		
		
        
    }
	
	function gettehsil_list(){
    	$dist_id = $this->input->post('distId');
	if($dist_id!=''){
		$data['all_tehsil'] = $this->Pre_con_act_encroachment_eviction_model->fetch_tahasil($dist_id);
		echo  json_encode($data);
	}else{
					
	}
    }
	
	    function getulb_list(){
		$dist_id = $this->input->post('dist_id');
		if($dist_id != ''){
			$data['all_ulb'] = $this->Pre_con_act_encroachment_eviction_model->Ulb_listing($dist_id);
		echo  json_encode($data);
		}else{

		}
	}


	
	
	public function fetch_tahasil()
    {
      if($this->input->post('district_id'))
     {
      echo $this->Pre_con_act_encroachment_eviction_model->fetch_tahasil($this->input->post('district_id'));
     }
    }
	
	function getulbSelection_data($dist_id,$ulb_id){
		$r = '';
		if($ulb_id != 0 || $ulb_id != ''){

		
		$ulb_id_n = str_replace(":",",",$ulb_id);
		$ulb_id_arr = explode(',', $ulb_id_n);
		$all_ulb = $this->Pre_con_act_encroachment_eviction_model->Ulb_listing($dist_id);
		if(is_array($all_ulb)){
			foreach ($all_ulb as $key) {
				if(in_array($key->id, $ulb_id_arr)){
					$s = 'selected';
				}else{
					$s = '';
				}
				$r .= '<option value="'.$key->id.'" '.$s.'>'.$key->ulb_name.'</option>';
			}
		}

		}else{
			$r = '';
		}

		echo $r;
	}
	
	
	function gettehsilSelection_data($dist_id,$tahsils_id){
		$r = '';
		if($tahsils_id != 0 || $tahsils_id != ''){

		
		$tahsils_id_n = str_replace(":",",",$tahsils_id);
		$tahsils_id_arr = explode(',', $tahsils_id_n);
		$all_tehsil = $this->Pre_con_act_encroachment_eviction_model->fetch_tahasil($dist_id);
		if(is_array($all_tehsil)){
			foreach ($all_tehsil as $key) {
				if(in_array($key->id, $tahsils_id_arr)){
					$s = 'selected';
				}else{
					$s = '';
				}
				$r .= '<option value="'.$key->id.'" '.$s.'>'.$key->tahsil_name.'</option>';
			}
		}

		}else{
			$r = '';
		}

		echo $r;
	}
	
	

}  
 

?>