<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_private_land_dp extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Privateland_dp_model');
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
        $data['districts'] = $this->Privateland_dp_model->fetch_district();
 
        
        
        $projectData_exist_flag = $this->Privateland_dp_model->checkProjectExits($project_id);
        
        $data['get_prvatelanddp'] = $this->Privateland_dp_model->getprivatelanddp($project_id);

        $data['directpurchase_location_data'] = $this->Privateland_dp_model->directpurchae_location_data($project_id);
    
        $this->form_validation->set_rules('total_area', 'Total area','required|numeric'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_privateland_dp', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['total_area'] = $_REQUEST['total_area'];
            $db_data['estimated_cost'] = $_REQUEST['estmtd_cost'];
            $db_data['general_cat_land'] = ($_REQUEST['general_cat_land'] == '') ? NULL : $_REQUEST['general_cat_land'];


            $db_data['sc_land'] = ($_REQUEST['sc_land'] == '') ? NULL : $_REQUEST['sc_land'];
            $db_data['st_land'] = ($_REQUEST['st_land'] == '') ? NULL : $_REQUEST['st_land'];
            $db_data['target_end_date'] = $_REQUEST['target_end'];
            $db_data['status_negotiation_conducted'] = $_REQUEST['negotiation_con'];
            $db_data['status_dcac_meeting_held'] = $_REQUEST['dcac_meeting'];
            $db_data['status_aa_funds_approved'] = $_REQUEST['funds_approved_aa'];
            $db_data['status_land_registration'] = $_REQUEST['land_registation'];

            $db_data['progress_land_processed'] = ($_REQUEST['progress_land_processed'] == '') ? NULL : $_REQUEST['progress_land_processed'];
            $db_data['progress_%'] = ($_REQUEST['progress_percent'] == '') ? NULL : $_REQUEST['progress_percent'];
            $db_data['progress_land_required_aa'] = $_REQUEST['progress_land_required_aa'];
            //$db_data['progress_amount_utilised'] = ($_REQUEST['progress_amount_utilised'] == '') ? NULL : $_REQUEST['progress_amount_utilised'];
            $db_data['progress_amount_utilised'] = ($_REQUEST['progress_amount_utilised'] == '') ? NULL : str_replace(',','',$_REQUEST['progress_amount_utilised']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['progress_fund_utilised'] == '') ? NULL : $_REQUEST['progress_fund_utilised'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
            
             // File upload
	if (!is_dir('uploads/files/direct_purchase')) {
                    mkdir('./uploads/files/direct_purchase');
                 } 
    

    
      $config['upload_path']          = 'uploads/files/direct_purchase/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_bilateral_negotiation"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_bilateral_negotiation']['name'];
        $this->load->library('upload', $config);
        $file_bilateral_negotiation = $this->upload->do_upload('file_bilateral_negotiation');
        if (!$file_bilateral_negotiation){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_private_land_dp/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_bilateral_negotiation = $this->upload->data("file_name");
        }
        
            $db_data['file_bilateral_negotiation'] = $file_bilateral_negotiation;
    }
    else {
        
        if (!empty ($_REQUEST['file_bilateral_negotiation_hidden'])) {
            
            $db_data['file_bilateral_negotiation'] = $_REQUEST['file_bilateral_negotiation_hidden'];
            
        }
        
    }
    

    if($_FILES["file_meeting_held"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_meeting_held']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_meeting_held = $this->upload->do_upload('file_meeting_held');
        if (!$file_meeting_held){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_private_land_dp/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_meeting_held = $this->upload->data("file_name");
        }
        
            $db_data['file_meeting_held'] = $file_meeting_held;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_meeting_held_hidden'])) {
            
            $db_data['file_meeting_held'] = $_REQUEST['file_meeting_held_hidden'];
            
        }
        
    }
            
    if($_FILES["file_funds_approved"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_funds_approved']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_funds_approved = $this->upload->do_upload('file_funds_approved');
        if (!$file_funds_approved){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_private_land_dp/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_funds_approved = $this->upload->data("file_name");
        }
        
            $db_data['file_funds_approved'] = $file_funds_approved;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_funds_approved_hidden'])) {
            
            $db_data['file_funds_approved'] = $_REQUEST['file_funds_approved_hidden'];
            
        }
        
    }
        if($_FILES["file_land_registration"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_land_registration']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_land_registration = $this->upload->do_upload('file_land_registration');
        if (!$file_land_registration){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_private_land_dp/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_land_registration = $this->upload->data("file_name");
        }
        
            $db_data['file_land_registration'] = $file_land_registration;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_land_registration_hidden'])) {
            
            $db_data['file_land_registration'] = $_REQUEST['file_land_registration_hidden'];
            
        }
        
    }   
             if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $directpurchase_id = $data['get_prvatelanddp'][0]['id'];
                $EE_last_data_update =$this->Privateland_dp_model->update_priland_dp($db_data,$directpurchase_id); 
             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Privateland_dp_model->save_priland_dp($db_data);
            
             }
        
             
            //location update

          $dist_id_count = count($_REQUEST['dist_id']);
          $tehsil_id_arr = $this->input->post('tehsil_id');
          $dist_id_arr = $this->input->post('dist_id');


      
      if (!empty($data['directpurchase_location_data'])) {
        
        $del_location_data =$this->Privateland_dp_model->removelist($project_id);
            
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
         
        $directpurchase_id = $data['get_prvatelanddp'][0]['id'];  
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $directpurchase_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'entered_by' => $user_id
                );
          
        
    $this->Privateland_dp_model->direct_purchase_location($UaddData);
         }
         else
         {
        
    $this->Privateland_dp_model->direct_purchase_location($addData);
        
         }
 }
                
            }
          
            
        
        
        }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_consttruction_activity_private_land_dp/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
  function gettehsil_list(){
      $dist_id = $this->input->post('distId');
  if($dist_id!=''){
    $data['all_tehsil'] = $this->Privateland_dp_model->fetch_tahasil($dist_id);
    echo  json_encode($data);
  }else{
          
  }
    }
  function gettehsilSelection_data($dist_id,$tahsils_id){
    $r = '';
    if($tahsils_id != 0 || $tahsils_id != ''){

    
    $tahsils_id_n = str_replace(":",",",$tahsils_id);
    $tahsils_id_arr = explode(',', $tahsils_id_n);
    $all_tehsil = $this->Privateland_dp_model->fetch_tahasil($dist_id);
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
