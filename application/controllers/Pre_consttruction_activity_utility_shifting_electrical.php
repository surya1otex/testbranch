<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_utility_shifting_electrical extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Utility_shift_elec_model');
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
        $data['districts'] = $this->Utility_shift_elec_model->fetch_district();
        
       $projectData_exist_flag = $this->Utility_shift_elec_model->checkProjectExits($project_id);
        
        $data['division_id'] = $this->Utility_shift_elec_model->fetch_divisons();
        $data['get_utility_elec'] = $this->Utility_shift_elec_model->get_utilityahift_elec($project_id);
        $data['utility_location_data'] = $this->Utility_shift_elec_model->utilityelectrical_location_data($project_id);
    
        $this->form_validation->set_rules('poles_tobe_shifted', 'Poles to be Shifted','required|numeric'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_utility_shifting_electrical', $data);

        }
        
        else{ 
        
        
            
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['poles_tobe_shifted'] = $_REQUEST['poles_tobe_shifted'];
            $db_data['new_lines_tobe_installed'] = ($_REQUEST['new_lines_tobe_installed'] == '') ? NULL : $_REQUEST['new_lines_tobe_installed'];
            $db_data['target_end_date'] = $_REQUEST['target_end_date'];
            $db_data['status_joint_verification'] = $_REQUEST['status_joint_verification'];
            $db_data['status_approval_fund_received'] = $_REQUEST['status_approval_fund_received'];
            $db_data['status_new_line_charged'] = $_REQUEST['status_new_line_charged'];
            $db_data['status_tender_awarded'] = $_REQUEST['status_tender_awarded'];
            $db_data['progress_noof_poles_shifted'] = ($_REQUEST['progress_noof_poles_shifted'] == '') ? NULL : $_REQUEST['progress_noof_poles_shifted'];
            $db_data['progress_%'] = ($_REQUEST['progress'] == '') ? NULL : $_REQUEST['progress'];
            $db_data['progress_electrical_utility_shifting'] = $_REQUEST['progress_electrical_utility_shifting'];
            $db_data['progress_amount_utilised'] =  str_replace(',','',$_REQUEST['progress_amount_utilised']);
            $db_data['progress_fund_utilised'] = ($_REQUEST['progress_fund_utilised'] == '') ? NULL : $_REQUEST['progress_fund_utilised'];
            $db_data['remarks'] = $_REQUEST['remarks'];
            $db_data['entered_by'] = $user_id;
            
            
             // File upload
       	if (!is_dir('uploads/files/utility_electrical')) {
                    mkdir('./uploads/files/utility_electrical');
                 }    
    

    
      $config['upload_path']          = 'uploads/files/utility_electrical/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
    $config['max_size']             = 2000000;
    
    
    
    
    
    if($_FILES["file_joint_verification"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_joint_verification']['name'];
        $this->load->library('upload', $config);
        $file_joint_verification = $this->upload->do_upload('file_joint_verification');
        if (!$file_joint_verification){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_electrical/manage?project_id=' . base64_encode($project_id));
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
    

    if($_FILES["file_new_line_charged"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_new_line_charged']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_new_line_charged = $this->upload->do_upload('file_new_line_charged');
        if (!$file_new_line_charged){
            $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_electrical/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_new_line_charged = $this->upload->data("file_name");
        }
        
            $db_data['file_new_line_charged'] = $file_new_line_charged;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_new_line_charged_hidden'])) {
            
            $db_data['file_new_line_charged'] = $_REQUEST['file_new_line_charged_hidden'];
            
        }
        
    }
    if($_FILES["file_approval_fund_received"]["name"]){
        $config["file_name"] = rand(11,999999). time().'_'.$_FILES['file_approval_fund_received']['name'];
        $this->load->library('upload', $config);
        // if($_FILES["file_relinquishment_proposal"]["name"]){
        //     $this->upload->initialize($config);
        // }else{
        //     $this->load->library('upload', $config);
        // }
        $file_approval_fund_received = $this->upload->do_upload('file_approval_fund_received');
        if (!$file_approval_fund_received){
            $error = array('error' => $this->upload->display_errors());
               $this->session->set_flashdata("danger", "The file you are trying to upload has an extension that is not allowed");
            redirect('Pre_consttruction_activity_utility_shifting_electrical/manage?project_id=' . base64_encode($project_id));
        }else{
            $file_approval_fund_received = $this->upload->data("file_name");
        }
        
            $db_data['file_approval_fund_received'] = $file_approval_fund_received;
        
    }
    else {
        
        if (!empty ($_REQUEST['file_approval_fund_received_hidden'])) {
            
            $db_data['file_approval_fund_received'] = $_REQUEST['file_approval_fund_received_hidden'];
            
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
            $this->session->set_flashdata("error", "" );
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
                 
                $treecutting_id = $data['get_utility_elec'][0]['id'];

                $EE_last_data_update =$this->Utility_shift_elec_model->update_utility_elec($db_data,$treecutting_id);

             }
             
             
             else { //ADD
            
                $EE_last_data =$this->Utility_shift_elec_model->save_utility_electrical($db_data);
            
             }
        
             
            //location update

            if (!empty($data['utility_location_data'])) {
                
                $del_location_data =$this->Utility_shift_elec_model->deleteUtility_location($project_id);
                        
            }

          $dist_id_count = count($_REQUEST['dist_id']);
          $dist_id_arr = $this->input->post('dist_id');
          $division_id_arr = $this->input->post('division_id');
          $discom_id_arr = $this->input->post('discom_id');

        for ($i=0; $i < $dist_id_count; $i++) { 
              
          if(!empty($discom_id_arr[$i]))
            {
            $a_id = implode(",", $discom_id_arr[$i]);
            if($a_id != ''){
            $discom_id = $a_id;
            }else{
            $discom_id = 0;
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
                    'electrical_division_id' => $division_id_arr[$i],
                    'discom_name' => $discom_id,
                    'entered_by' => $user_id
                );


         if(!empty($projectData_exist_flag)){  //UPDATE
         
        $utilityshift_id = $data['get_utility_elec'][0]['id'];
        
                    $UaddData = array(
                    'project_id' => $project_id, 
                    'relation_id' => $utilityshift_id,
                    'district_id' => $dist_id_arr[$i], 
                    'electrical_division_id' => $division_id_arr[$i],
                    'discom_name' => $discom_id,
                    'entered_by' => $user_id
                );
          
        
    $this->Utility_shift_elec_model->addutility_electric_location($UaddData);
         }
         else
         {
        
    $this->Utility_shift_elec_model->addutility_electric_location($addData);
        
         }
 }
                
            }


// End of location details
        
        
    }
            
                $this->session->set_flashdata('success', 'Pre Construction Activities Data saved successfully');
        
         if($project_id){

                redirect('Pre_consttruction_activity_utility_shifting_electrical/manage?project_id=' . base64_encode($project_id));
            }
        
        }
        
        
        
    }
    
    function getelectrical_divison(){
        $dist_id = $this->input->post('distId');
    if($dist_id!=''){
        $data['all_divison'] = $this->Utility_shift_elec_model->fetch_divison($dist_id);
        echo  json_encode($data);
    }else{
                    
    }
    }
    function getdiscom_list(){
        $division_id = $this->input->post('division_id');
        if($division_id != ''){
            $data['all_discom'] = $this->Utility_shift_elec_model->discom_listing($division_id);
        echo  json_encode($data);
        }else{

        }
    }
   

  function getseldivision($district_id,$division_id) {
 

    if($district_id != 0 || $division_id != 0) {

       $seldivisions = $this->Utility_shift_elec_model->fetch_divison($district_id);

            foreach ($seldivisions as $key) {

                if($key->division_id == $division_id) {
                     $s = 'selected';
                 }
                 else {
                     $s = '';
                 }

                  $r .= '<option value="'.$key->division_id.'" '.$s.'>'.$key->division_name.'</option>';
               
            }

       }

       else {
        $r = '';
      }

      echo $r;

  } 

  function getdiscom_data($division_id,$discom_id){
    $r = '';
    if($discom_id != 0 || $discom_id != ''){

    
    $discom_id_n = str_replace(":",",",$discom_id);
    $discom_id_arr = explode(',', $discom_id_n);
    $all_discom = $this->Utility_shift_elec_model->fetch_discom($division_id);
    if(is_array($all_discom)){
      foreach ($all_discom as $key) {
        if(in_array($key->id, $discom_id_arr)){
          $s = 'selected';
        }else{
          $s = '';
        }
        $r .= '<option value="'.$key->id.'" '.$s.'>'.$key->discom_name.'</option>';
      }
    }

    }else{
      $r = '';
    }

    echo $r;
  }


}  
 

?>
