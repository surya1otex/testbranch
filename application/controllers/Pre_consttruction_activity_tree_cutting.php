<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_tree_cutting extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Tree_cutting_model');
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
        $data['districts'] = $this->Tree_cutting_model->fetch_district();
        $data['forest_id'] =  $this->Tree_cutting_model->fetch_forest();
        $data['ofdc_id'] = $this->Tree_cutting_model->fetch_ofdc();
        
    $projectData_exist_flag = $this->Tree_cutting_model->checkProjectExits($project_id);
        
        $data['tree_cutting'] = $this->Tree_cutting_model->gettreecutting($project_id);

        $data['treecutting_location_data'] = $this->Tree_cutting_model->treecutting_location_data($project_id);
    
        $this->form_validation->set_rules('noof_trees_tobe_cut', 'No of Tree to be cut','required|numeric'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_tree_cutting', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['noof_trees_tobe_cut'] = $_REQUEST['noof_trees_tobe_cut'];
            $db_data['forest_division_id'] = $_REQUEST['forest_division_id'];
            $db_data['ofdc_division_id'] = $_REQUEST['ofdc_division_id'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_joint_verification'] = $_REQUEST['joint_verification'];
            $db_data['status_enumeration'] = $_REQUEST['status_enumeration'];
            $db_data['status_cutting_permission'] = $_REQUEST['status_cutting_permission'];
            $db_data['status_fund_for_tree_cutting'] = $_REQUEST['status_fund_for_tree_cutting'];
            $db_data['status_tender_awarded'] = $_REQUEST['status_tender_awarded'];
            $db_data['progress_noof_trees_cut'] = ($_REQUEST['progress_noof_trees_cut'] == '') ? NULL : $_REQUEST['progress_noof_trees_cut'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            $db_data['progress_tree_cutting_required_for_aa_done'] = $_REQUEST['progress_tree_cutting_required_for_aa_done'];
            $db_data['progress_amount_utilised'] = str_replace(',','',$_REQUEST['progress_amount_utilised']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['progress_fund_utilised'] == '') ? NULL : $_REQUEST['progress_fund_utilised'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
            
             // File upload
           	if (!is_dir('uploads/files/tree_cutting')) {
                    mkdir('./uploads/files/tree_cutting');
                 }
    

    
      $config['upload_path']          = 'uploads/files/tree_cutting/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_joint_verification"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_joint_verification']['name'];
        $this->load->library('upload', $config);
        $file_joint_verification = $this->upload->do_upload('file_joint_verification');
        if (!$file_joint_verification){
            $error = array('error' => $this->upload->display_errors());
              $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
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
    

    if($_FILES["file_enumeration"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_enumeration']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_enumeration = $this->upload->do_upload('file_enumeration');
        if (!$file_enumeration){
            $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_enumeration = $this->upload->data("file_name");
        }
        
            $db_data['file_enumeration'] = $file_enumeration;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_enumeration_hidden'])) {
            
            $db_data['file_enumeration'] = $_REQUEST['file_enumeration_hidden'];
            
        }
        
    }
    if($_FILES["file_cutting_permission"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_cutting_permission']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_cutting_permission = $this->upload->do_upload('file_cutting_permission');
        if (!$file_cutting_permission){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_cutting_permission = $this->upload->data("file_name");
        }
        
            $db_data['file_cutting_permission'] = $file_cutting_permission;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_cutting_permission_hidden'])) {
            
            $db_data['file_cutting_permission'] = $_REQUEST['file_cutting_permission_hidden'];
            
        }
        
    }        
    if($_FILES["file_fund_for_tree_cutting"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_fund_for_tree_cutting']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_fund_for_tree_cutting = $this->upload->do_upload('file_fund_for_tree_cutting');
        if (!$file_fund_for_tree_cutting){
            $error = array('error' => $this->upload->display_errors());
              $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_fund_for_tree_cutting = $this->upload->data("file_name");
        }
        
            $db_data['file_fund_for_tree_cutting'] = $file_fund_for_tree_cutting;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_fund_for_tree_cutting_hidden'])) {
            
            $db_data['file_fund_for_tree_cutting'] = $_REQUEST['file_fund_for_tree_cutting_hidden'];
            
        }
        
    }
    if($_FILES["file_tender_awarded"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_tender_awarded']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_tender_awarded = $this->upload->do_upload('file_tender_awarded');
        if (!$file_tender_awarded){
            $error = array('error' => $this->upload->display_errors());
              $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_tender_awarded = $this->upload->data("file_name");
        }
        
            $db_data['file_tender_awarded'] = $file_tender_awarded;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_tender_awarded_hidden'])) {
            
            $db_data['file_tender_awarded'] = $_REQUEST['file_tender_awarded_hidden'];
            
        }
        
    }
  
        if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $treecutting_id = $data['tree_cutting'][0]['id'];

                $EE_last_data_update =$this->Tree_cutting_model->update_treecutting($db_data,$treecutting_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Tree_cutting_model->savetreecutting($db_data);
            
             }
        
             
            //location update

          $dist_id_count = count($_REQUEST['dist_id']);
          $tehsil_id_arr = $this->input->post('tehsil_id');
          $dist_id_arr = $this->input->post('dist_id');


      
      if (!empty($data['treecutting_location_data'])) {
        
        $del_location_data =$this->Tree_cutting_model->removelist($project_id);
            
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
         
        $treecutting_id = $data['tree_cutting'][0]['id'];  
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $treecutting_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'entered_by' => $user_id
                );
          
        
    $this->Tree_cutting_model->treecutting_location($UaddData);
         }
         else
         {
        
    $this->Tree_cutting_model->treecutting_location($addData);
        
         }
 }
                
            }
          
            
        
        
        }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_consttruction_activity_tree_cutting/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
  function gettehsil_list(){
      $dist_id = $this->input->post('distId');
  if($dist_id!=''){
    $data['all_tehsil'] = $this->Tree_cutting_model->fetch_tahasil($dist_id);
    echo  json_encode($data);
  }else{
          
  }
    }
  function gettehsilSelection_data($dist_id,$tahsils_id){
    $r = '';
    if($tahsils_id != 0 || $tahsils_id != ''){

    
    $tahsils_id_n = str_replace(":",",",$tahsils_id);
    $tahsils_id_arr = explode(',', $tahsils_id_n);
    $all_tehsil = $this->Tree_cutting_model->fetch_tahasil($dist_id);
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
