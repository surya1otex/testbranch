<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_special_activity extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Pre_con_act_special_activity_model');
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
        $data['agency'] = $this->Pre_con_act_special_activity_model->fetch_agency($project_id);
       // $data['encroachment_type'] = $this->Pre_con_act_encroachment_eviction_model->fetch_encroachment();
		
		
       $projectData_exist_flag = $this->Pre_con_act_special_activity_model->checkProjectExits($project_id);
		
        $data['special_activity'] = $this->Pre_con_act_special_activity_model->specialactivity_data($project_id);
       // $data['encroachment_location_data'] = $this->Pre_con_act_encroachment_eviction_model->encroachment_location_data($project_id);
	
        $this->form_validation->set_rules('name', 'Name', 'required'); 
		
		   /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
			
			
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_special_activity', $data);

        }
		
		else{ 
		
		
			
		$submit = $this->input->post('submit');
		if($submit == 'Submit'){
			
            $db_data['project_id'] = $project_id;
            $db_data['name'] = $_REQUEST['name'];
            $db_data['description'] = $_REQUEST['description'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['updated_status'] = $_REQUEST['updated_status'];
            $db_data['executing_agency'] = $_REQUEST['executing_agency'];
            $db_data['entered_by'] = $user_id;
			
			
			 // File upload
   	if (!is_dir('uploads/files/special_activity')) {
                    mkdir('./uploads/files/special_activity');
                 }
	

	
	$config['upload_path']          = 'uploads/files/special_activity/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
	
	
	
	
	
	if($_FILES["document"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['document']['name'];
        $this->load->library('upload', $config);
        $document = $this->upload->do_upload('document');
        if (!$document){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", ".");
        }else{
            $document = $this->upload->data("file_name");
        }
		
			$db_data['document'] = $document;
    }
	else {
		
		if (!empty ($_REQUEST['document_hidden'])) {
			
			$db_data['document'] = $_REQUEST['document_hidden'];
			
		}
		
	}
	

    if($_FILES["issue_related_document"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['issue_related_document']['name'];
        $this->load->library('upload', $config);


        // if($_FILES["issue_related_document"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $issue_related_document = $this->upload->do_upload('issue_related_document');
        if (!$issue_related_document){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", "" );
        }else{
            $issue_related_document = $this->upload->data("file_name");
        }
		
			$db_data['issue_related_document'] = $issue_related_document;
		
    }
	else {
		
		if (!empty ($_REQUEST['issue_related_document_hidden'])) {
			
			$db_data['issue_related_document'] = $_REQUEST['issue_related_document_hidden'];
			
		}
		
	}

			
			
			 if(!empty($projectData_exist_flag)){  //UPDATE
				 
				$special_activity_id = $data['special_activity'][0]['id'];	
				$EE_last_data_update =$this->Pre_con_act_special_activity_model->updatespeical_activity($db_data,$special_activity_id);
			 }
			 
			 
			 else { //ADD
			
				$EE_last_data =$this->Pre_con_act_special_activity_model->addspecial_activity($db_data);
			
			 }

		
		
		}
			
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
		
		 if($project_id){

                redirect('Pre_consttruction_activity_special_activity/manage?project_id=' . base64_encode($project_id));
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
