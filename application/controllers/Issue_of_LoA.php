<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue_of_LoA extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Issue_of_LoA_model');
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

        $projectData_exist_flag = $this->Issue_of_LoA_model->checkProjectExits($project_id);
        $data['get_issueofloa'] = $this->Issue_of_LoA_model->getissueofloa($project_id);

        $data['fetch_issueofloa'] = $this->Issue_of_LoA_model->fetchissueofloa($project_id);

        $data['fetch_negoofloa'] = $this->Issue_of_LoA_model->fetchnegoofloa($project_id);

       // $this->form_validation->set_rules('negotiation_bid_value', 'Negotiated Bid Value', 'required|greater_than[0]'); 

         $this->form_validation->set_rules('successful_bidder_ref_no', 'Bidder Ref No/Name', 'required');


        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('tendering/issue_of_loa', $data);

        }

        else{

            $submit = $this->input->post('submit');
            if($submit == 'Submit'){

                 $db_data['project_id'] = $project_id;
                 $db_data['successful_bidder_ref_no'] = $_REQUEST['successful_bidder_ref_no'];
                 $db_data['negotiation_meeting_date'] = $_REQUEST['negotiation_meeting_date'];
                 //$db_data['negotiation_bid_value'] = $_REQUEST['negotiation_bid_value'];
                 $db_data['negotiation_bid_value'] = str_replace(',','',$_REQUEST['negotiation_bid_value']);
                 $db_data['loa_issue_date'] = $_REQUEST['loa_issue_date'];
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

                 // File upload

                 if (!is_dir('uploads/files/loa')) {
                    mkdir('./uploads/files/loa');
                 }

                 $config['upload_path']          = 'uploads/files/loa/';
                 $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
                 $config['max_size']             = 2000000;

                 if($_FILES["loa_document"]["name"]){
                    $config["file_name"] = rand(11,999999). time().'_'.$_FILES['loa_document']['name'];
                    $this->load->library('upload', $config);
                    $loa_document = $this->upload->do_upload('loa_document');
                    if (!$loa_document){
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata("error", ".");
                    }else{
                    $loa_document = $this->upload->data("file_name");
                    }

                    $db_data['loa_document'] = $loa_document;
                }
                else {

                    // if (!empty ($_REQUEST['file_alienation_proposed_hidden'])) {

                    // $db_data['file_alienation_proposed'] = $_REQUEST['file_alienation_proposed_hidden'];

                    // }

                }

                if(!empty($projectData_exist_flag)){  //UPDATE
                 
                    $issueofloa_id = $data['get_issueofloa'][0]['id'];
        
                    $EE_last_data_update =$this->Issue_of_LoA_model->updateissueofloa($db_data,$issueofloa_id);

               }

                else { //ADD

                    $EE_last_data =$this->Issue_of_LoA_model->saveissueofloa($db_data);
                }

            }

            $this->session->set_flashdata('success', 'Issue of Loa saved successfully');

                  if($project_id){
                       redirect('Issue_of_LoA/manage?project_id=' . base64_encode($project_id));
                    }
            }
        
        
    }
   
 
}
?>
