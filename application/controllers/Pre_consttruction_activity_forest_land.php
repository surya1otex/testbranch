<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_forest_land extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Land_forest_model');
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
        $data['districts'] = $this->Land_forest_model->fetch_district();
        $data['forest_id'] =  $this->Land_forest_model->fetch_forest();
        
        
    $projectData_exist_flag = $this->Land_forest_model->checkProjectExits($project_id);
        
        $data['get_forestland'] = $this->Land_forest_model->getforestland($project_id);

        $data['forestland_location_data'] = $this->Land_forest_model->forestland_location_data($project_id);
    
        $this->form_validation->set_rules('total_area', 'Total area','required|numeric'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_forest_land', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['total_area_tobe_diverted'] = $_REQUEST['total_area'];
            $db_data['forest_division_id'] = $_REQUEST['forest_division'];
            $db_data['fund_alloted'] = $_REQUEST['fund_allot'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_application_submited'] = $_REQUEST['online_application_submit'];
            $db_data['status_fcp_uploaded'] = $_REQUEST['fcp_upload_status'];
            $db_data['status_state_govt_recomend'] = $_REQUEST['state_govt_recommend'];
            $db_data['status_goi_approval'] = $_REQUEST['gol_application'];
            $db_data['status_permission_issued'] = $_REQUEST['permission_issue'];
            $db_data['progress_land_cleared'] = ($_REQUEST['progress_land_clr'] == '') ? NULL : $_REQUEST['progress_land_clr'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            $db_data['progress_land_required_for_cleared_aa'] = $_REQUEST['land_required_clr'];
            $db_data['progress_amount_utilised'] = ($_REQUEST['ammount_utilize'] == '') ? NULL : str_replace(',','',$_REQUEST['ammount_utilize']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['fund_utilize'] == '') ? NULL : $_REQUEST['fund_utilize'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
            
             // File upload
   	if (!is_dir('uploads/files/forest_land')) {
                    mkdir('./uploads/files/forest_land');
                 }
    

    
      $config['upload_path']          = 'uploads/files/forest_land/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["app_fileupload"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['app_fileupload']['name'];
        $this->load->library('upload', $config);
        $app_fileupload = $this->upload->do_upload('app_fileupload');
        if (!$app_fileupload){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_forest_land/manage?project_id=' . base64_encode($project_id));
        }else{
            $app_fileupload = $this->upload->data("file_name");
        }
        
            $db_data['file_application_submited'] = $app_fileupload;
    }
    else {
        
        if (!empty ($_REQUEST['app_fileupload_hidden'])) {
            
            $db_data['file_application_submited'] = $_REQUEST['app_fileupload_hidden'];
            
        }
        
    }
    

    if($_FILES["file_stategovt_recommend"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_stategovt_recommend']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_stategovt_recommend = $this->upload->do_upload('file_stategovt_recommend');
        if (!$file_stategovt_recommend){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_forest_land/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_stategovt_recommend = $this->upload->data("file_name");
        }
        
            $db_data['file_state_govt_recomend'] = $file_stategovt_recommend;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_stategovt_recommend_hidden'])) {
            
            $db_data['file_state_govt_recomend'] = $_REQUEST['file_stategovt_recommend_hidden'];
            
        }
        
    }
    if($_FILES["file_permission"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_permission']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_permission = $this->upload->do_upload('file_permission');
        if (!$file_permission){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_forest_land/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_permission = $this->upload->data("file_name");
        }
        
            $db_data['file_permission_issued'] = $file_permission;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_permission_hidden'])) {
            
            $db_data['file_permission_issued'] = $_REQUEST['file_permission_hidden'];
            
        }
        
    }        
    if($_FILES["doc_fileupload"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['doc_fileupload']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $doc_fileupload = $this->upload->do_upload('doc_fileupload');
        if (!$doc_fileupload){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_forest_land/manage?project_id=' . base64_encode($project_id));
        }else{
            $doc_fileupload = $this->upload->data("file_name");
        }
        
            $db_data['file_fcp_uploaded'] = $doc_fileupload;
        
    }
    else {
        
        if (!empty ($_REQUEST['doc_fileupload_hidden'])) {
            
            $db_data['file_fcp_uploaded'] = $_REQUEST['doc_fileupload_hidden'];
            
        }
        
    }
    if($_FILES["file_gol_application"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_gol_application']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_gol_application = $this->upload->do_upload('file_gol_application');
        if (!$file_gol_application){
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata("error", "" );
        }else{
            $file_gol_application = $this->upload->data("file_name");
        }
        
            $db_data['file_goi_approval'] = $file_gol_application;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_gol_application_hidden'])) {
            
            $db_data['file_goi_approval'] = $_REQUEST['file_gol_application_hidden'];
            
        }
        
    }
  
        if(!empty($projectData_exist_flag)){  //UPDATE
                 
                $forestland_id = $data['get_forestland'][0]['id'];

                $EE_last_data_update =$this->Land_forest_model->update_forestland($db_data,$forestland_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Land_forest_model->saveforestland($db_data);
            
             }
        
             
            //location update

          $dist_id_count = count($_REQUEST['dist_id']);
          $tehsil_id_arr = $this->input->post('tehsil_id');
          $dist_id_arr = $this->input->post('dist_id');


      
      if (!empty($data['forestland_location_data'])) {
        
        $del_location_data =$this->Land_forest_model->removelist($project_id);
            
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
         
        $forestland_id = $data['get_forestland'][0]['id'];  
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $forestland_id,
                    'district_id' => $dist_id_arr[$i], 
                    'tahsils_id' => $tehsil_id, 
                    'entered_by' => $user_id
                );
          
        
    $this->Land_forest_model->forestland_purchase_location($UaddData);
         }
         else
         {
        
    $this->Land_forest_model->forestland_purchase_location($addData);
        
         }
 }
                
            }
          
            
        
        
        }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_consttruction_activity_forest_land/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
  function gettehsil_list(){
      $dist_id = $this->input->post('distId');
  if($dist_id!=''){
    $data['all_tehsil'] = $this->Land_forest_model->fetch_tahasil($dist_id);
    echo  json_encode($data);
  }else{
          
  }
    }
  function gettehsilSelection_data($dist_id,$tahsils_id){
    $r = '';
    if($tahsils_id != 0 || $tahsils_id != ''){

    
    $tahsils_id_n = str_replace(":",",",$tahsils_id);
    $tahsils_id_arr = explode(',', $tahsils_id_n);
    $all_tehsil = $this->Land_forest_model->fetch_tahasil($dist_id);
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
