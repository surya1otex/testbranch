<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_government_land_alienation extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Land_alienation_model');
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
        $data['districts'] = $this->Land_alienation_model->fetch_district();
 
		
		
        $projectData_exist_flag = $this->Land_alienation_model->checkProjectExits($project_id);
		
        $data['get_landalienation'] = $this->Land_alienation_model->getlandalianation($project_id);

        $data['alianation_location_data'] = $this->Land_alienation_model->alianation_location_data($project_id);
        $data['approval_date'] = $this->Land_alienation_model->admin_approval_date($project_id);

        //echo $data['approval_date'];
	
        $this->form_validation->set_rules('total_area', 'Total Area', 'required'); 
		
		   /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
			
			
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_government_land_alienation', $data);

        }
		
		else{ 
		
		
			
		$submit = $this->input->post('submit');
		if($submit == 'Submit'){


			
            $db_data['project_id'] = $project_id;
            $db_data['total_land'] = $_REQUEST['total_area'];
            $db_data['department_id'] = $_REQUEST['department_id'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_alienation_proposed'] = $_REQUEST['status_alienation_proposed'];
            $db_data['status_relinquishment_proposal'] = $_REQUEST['status_relinquishment_proposal'];
            $db_data['progress_land_alienated'] = ($_REQUEST['progress_land_alienated'] == '') ? NULL : $_REQUEST['progress_land_alienated'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            $db_data['progress_land_required_aa'] = $_REQUEST['land_required_aa'];
           // $db_data['progress_amount_utilised'] = ($_REQUEST['amount_utilised'] == '') ? NULL : $_REQUEST['amount_utilised'];
            $db_data['progress_amount_utilised'] = ($_REQUEST['amount_utilised'] == '') ? NULL : str_replace(',','',$_REQUEST['amount_utilised']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['fund_utilised'] == '') ? NULL : $_REQUEST['fund_utilised'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
			
			 // File upload
	if (!is_dir('uploads/files/land_alienation')) {
                    mkdir('./uploads/files/land_alienation');
                 }
	

	
	  $config['upload_path']          = 'uploads/files/land_alienation/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
	
	
	
	
	
	if($_FILES["file_alienation_proposed"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_alienation_proposed']['name'];
        $this->load->library('upload', $config);
        $file_alienation_proposed = $this->upload->do_upload('file_alienation_proposed');
        if (!$file_alienation_proposed){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_government_land_alienation/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_alienation_proposed = $this->upload->data("file_name");
        }
		
			$db_data['file_alienation_proposed'] = $file_alienation_proposed;
    }
	else {
		
		if (!empty ($_REQUEST['file_alienation_proposed_hidden'])) {
			
			$db_data['file_alienation_proposed'] = $_REQUEST['file_alienation_proposed_hidden'];
			
		}
		
	}
	

    if($_FILES["file_relinquishment_proposal"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_relinquishment_proposal']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_relinquishment_proposal = $this->upload->do_upload('file_relinquishment_proposal');
        if (!$file_relinquishment_proposal){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_government_land_alienation/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_relinquishment_proposal = $this->upload->data("file_name");
        }
		
			$db_data['file_relinquishment_proposal'] = $file_relinquishment_proposal;
		
    }
	else {
		
		if (!empty ($_REQUEST['file_relinquishment_proposal_hidden'])) {
			
			$db_data['file_relinquishment_proposal'] = $_REQUEST['file_relinquishment_proposal_hidden'];
			
		}
		
	}
			
		
			 if(!empty($projectData_exist_flag)){  //UPDATE
				 
				$landalianation_id = $data['get_landalienation'][0]['id'];
				$EE_last_data_update =$this->Land_alienation_model->updatealianation($db_data,$landalianation_id);

			 }
			 
			 
			 else { //ADD
			
				//$EE_last_data =$this->Land_alienation_model->savealienation($db_data);


try
{
    $EE_last_data = $this->Land_alienation_model->savealienation($db_data);

    // This is not useful.
    if ( ! $result)
    {
        throw new Exception();
    }
}
catch (Exception $e)
{
    // Do something
}

			
			 }
		












			//location update

          $dist_id_count = count($_REQUEST['dist_id']);
          $tehsil_id_arr = $this->input->post('tehsil_id');
          $dist_id_arr = $this->input->post('dist_id');


      
      if (!empty($data['alianation_location_data'])) {
        
        $del_location_data =$this->Land_alienation_model->removelist($project_id);
            
      }
      
        for ($i=0; $i < $dist_id_count; $i++) { 
              
          if(!empty($tehsil_id_arr[$i]))
            {
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
           
               if($dist_id_arr[$i] != 0) {
        
                    $addData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $EE_last_data,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'entered_by' => $user_id
                );


         if(!empty($projectData_exist_flag)){  //UPDATE
         
        $landalination_id = $data['get_landalienation'][0]['id'];  
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $landalination_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'entered_by' => $user_id
                );
          
        
    $this->Land_alienation_model->addLandalianation_location($UaddData);
         }
         else
         {
        
    $this->Land_alienation_model->addLandalianation_location($addData);
        
         }
 }
                
            }
		  
			
		
		
		}
			
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
		
		 if($project_id){

                redirect('Pre_consttruction_activity_government_land_alienation/manage?project_id=' . base64_encode($project_id));
            }
		
		}
		
		
        
    }
	
  function gettehsil_list(){
      $dist_id = $this->input->post('distId');
  if($dist_id!=''){
    $data['all_tehsil'] = $this->Land_alienation_model->fetch_tahasil($dist_id);
    echo  json_encode($data);
  }else{
          
  }
    }
  function gettehsilSelection_data($dist_id,$tahsils_id){
    $r = '';
    if($tahsils_id != 0 || $tahsils_id != ''){

    
    $tahsils_id_n = str_replace(":",",",$tahsils_id);
    $tahsils_id_arr = explode(',', $tahsils_id_n);
    $all_tehsil = $this->Land_alienation_model->fetch_tahasil($dist_id);
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
