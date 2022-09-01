<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_bid_conference extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        //$this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper','stepsbar_helper'));
        $this->load->model('Prebid_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function manage(){
        $user_id = $this->session->userdata('id'); 
        $project_id = base64_decode($_REQUEST['project_id']); 
        $data['project_id'] = base64_decode($_REQUEST['project_id']);

        $projectData_exist_flag = $this->Prebid_model->checkProjectExits($project_id);
        $data['fetch_country'] = $this->Prebid_model->fetch_country();
        $data['get_prebid'] = $this->Prebid_model->getprebid($project_id);

        $data['prebid_bidder_data'] = $this->Prebid_model->prebid_bidder_data($project_id);

        $data['prebid_file'] = $this->Prebid_model->prebid_file($project_id);

        $data['fetch_meeting_date'] = $this->Prebid_model->fetch_meeting_date($project_id); 

        if(!empty($_REQUEST['submit'])){ 

             $submit = $this->input->post('submit');
             if($submit == 'Submit'){
                 $db_data['project_id'] = $project_id;
                 $db_data['corrigendum_issuance_date'] = $_REQUEST['corrigendum_issue_date'];
                 if(empty($_REQUEST['approval_date'])){
                    $db_data['approval_date'] = '0000-00-00';
                    }
                    else{
                    $db_data['approval_date'] = $_REQUEST['approval_date'];
                    }

                 if(empty($_REQUEST['approval_status'])){
                        $db_data['approval_status'] = 'P';  
                    }
                    else{
                        $db_data['approval_status'] = $_REQUEST['approval_status'];
                    }
                 
                 $db_data['remarks'] = $_REQUEST['remarks'];
                 $db_data['entered_by'] = $user_id;

                 if(!empty($projectData_exist_flag)){  //UPDATE
                 
                    $prebid_id = $data['get_prebid'][0]['id'];
                    $EE_last_data =$this->Prebid_model->updateprebid($db_data,$prebid_id);
      
                 }
                 else {
                    $EE_last_data =$this->Prebid_model->saveprebid($db_data);//ADD
                   }

                 $bidder_name_count = count($_REQUEST['bidder_name']);
                 $bidder_name = $this->input->post('bidder_name');
                 $country = $this->input->post('prebid_country');
                 $state = $this->input->post('prebid_state');
                 $salutation = $this->input->post('prebid_salutation');
                 $firstname = $this->input->post('prebid_first_name');
                 $middlename = $this->input->post('prebid_middle_name');
                 $lastname = $this->input->post('prebid_last_name');
                 $mobile = $this->input->post('prebid_mobile');
                 $stdcode = $this->input->post('prebid_std_code');
                 $landnum = $this->input->post('prebid_land_phone');
                 $email = $this->input->post('prebid_email');

                 if (!empty($data['prebid_bidder_data'])) {
        
                    $del_data =$this->Prebid_model->removelist($project_id);
            
                 }

                  for ($i=0; $i < $bidder_name_count; $i++) {

                     $addData = array(
                                        'project_id' => $project_id, 
                                        'tedering_pre_bid_id' => $EE_last_data,
                                        'bidder_name' => $bidder_name[$i],
                                        'country_id' => $country[$i], 
                                        'state_id' => $state[$i], 
                                        'abbreviation' => $salutation[$i],
                                        'first_name' => $firstname[$i],
                                        'middle_name' => $middlename[$i],
                                        'last_name' => $lastname[$i],
                                        'mobile_no' => $mobile[$i],
                                        'std' => $stdcode[$i],
                                        'land_no' => $landnum[$i],
                                        'email_id' => $email[$i],
                                        'entered_by' => $user_id
                                        );

                     if(!empty($projectData_exist_flag)){//UPDATE

                                        $UaddData = array(
                                            'project_id' => $project_id, 
                                            'tedering_pre_bid_id' => $prebid_id,
                                            'bidder_name' => $bidder_name[$i],
                                            'country_id' => $country[$i], 
                                            'state_id' => $state[$i], 
                                            'abbreviation' => $salutation[$i],
                                            'first_name' => $firstname[$i],
                                            'middle_name' => $middlename[$i],
                                            'last_name' => $lastname[$i],
                                            'mobile_no' => $mobile[$i],
                                            'std' => $stdcode[$i],
                                            'land_no' => $landnum[$i],
                                            'email_id' => $email[$i],
                                            'entered_by' => $user_id
                                        ); 
                            
                            $this->Prebid_model->addbidderdata($UaddData);
                         }
                         else{

                            $this->Prebid_model->addbidderdata($addData);
                         } 

                     }

                    //document upload
                    if (!empty($data['prebid_file'])) {
        
                        $del_data_file =$this->Prebid_model->removefile($project_id);
            
                     }
                     
                     $prebid_file_count = count($_FILES['prebid_doc']['name']);
                     $prebid_file = $this->input->post('prebid_doc');
                     $prebid_fileupdate = $_REQUEST['prebid_doc_hidden'];

                     if (!is_dir('uploads/files/prebid')) {
                            mkdir('./uploads/files/prebid');
                         }
                     
                     $config['upload_path']          = 'uploads/files/prebid/';
                     $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
                     $config['max_size']             = 2000000;

                     
                     for($i=0; $i < $prebid_file_count; $i++){
                             
                             $filename = rand(11,999999). time().'_'.$_FILES['prebid_doc']['name'][$i];
                              $this->load->library('upload',$config);

                              $_FILES['file']['name'] = $filename;
                              $_FILES['file']['type'] = $_FILES['prebid_doc']['type'][$i];
                              $_FILES['file']['tmp_name'] = $_FILES['prebid_doc']['tmp_name'][$i];                            
                            
                             $this->upload->do_upload('file');

                             if(!empty($projectData_exist_flag)){//UPDATE

                                $prebid_id = $data['get_prebid'][0]['id'];

                                 if(empty($_FILES['prebid_doc']['name'][$i])) {

                                    $filename = $_REQUEST['prebid_doc_hidden'][$i];

                                 }
                                 else {
                                    
                                        $filename = $filename;
                                      }

                                 if(!empty($_REQUEST['prebid_doc_hidden'][$i]) || ($_FILES['prebid_doc']['name'][$i])) {

                                  $UaddData = array(
                                        'project_id' => $project_id, 
                                        'tedering_pre_bid_id' => $prebid_id,
                                        'document_name' => $filename,
                                        'entered_by' => $user_id
                                        );

                                 $this->Prebid_model->addbidderdatafile($UaddData);
                                }

                            }

                            else{

                                 $filename = $this->upload->data("file_name");

                                 if(!empty($_FILES['prebid_doc']['name'][$i])) {

                                     $db_data = array(
                                        'project_id' => $project_id, 
                                        'tedering_pre_bid_id' => $EE_last_data,
                                        'document_name' => $filename,
                                        'entered_by' => $user_id
                                        );


                                    $this->Prebid_model->addbidderdatafile($db_data);
                               }

                        }
                    }

               }
    

            $this->session->set_flashdata('success', 'Pre-bid Data saved successfully');
        
             if($project_id){

                redirect('Pre_bid_conference/manage?project_id=' . base64_encode($project_id));
             }
           }
           $this->load->common_template('tendering/pre_bid', $data);
      }

  function getstate_list(){
      $country_id = $this->input->post('countryId');
      if($country_id!=''){
        $data['all_states'] = $this->Prebid_model->fetch_states($country_id);
        echo  json_encode($data);
      }else{
              
      }
    }


function gettehsilSelection_data($country_id,$state_id){
      
        if($country_id != 0 || $country_id != ''){
           
            $all_states = $this->Prebid_model->fetch_states($country_id);
            
                foreach ($all_states as $key) {
                
                   ?>
                    <option value="<?php echo $key->state_id; ?>"  <?php if($key->state_id == $state_id){ echo "selected"; } ?> ><?php echo $key->state_name; ?></option>
                    <?php 
                  }  

          }
        
  }
     
}
?>