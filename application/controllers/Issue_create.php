<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue_create extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Document_upload_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function manage()
    {
		
        //$this->load->common_template('communication/document_upload');
        $user_id = $this->session->userdata('id');
        $project_id = base64_decode($_REQUEST['project_id']);
        $id = $_REQUEST['id'];
        $data['id'] = $id;
        $data['user_id'] = $user_id; 
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $data['communications'] = $this->Document_upload_model->fetch_communication();
        $data['doc_owner'] = $this->Document_upload_model->fetch_doc_owner($project_id);
        $projectData_exist_flag = $this->Document_upload_model->checkProjectExits($project_id);
        $data['get_communication'] = $this->Document_upload_model->getdocuments($id,$project_id);
       // $data['get_documents'] = $this->Document_upload_model->documents_data($project_id);
        
        //echo $id;
        $this->form_validation->set_rules('issue_name', 'Issue Name', 'required'); 
        
           /*** Form Validation Rules***/
        if ($this->form_validation->run() == FALSE) {
            
            
            $this->load->common_template('communication/document_upload', $data);

        }
        
        else{ 
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            
            $db_data['project_id'] = $project_id;
            $db_data['communication_type'] = $_REQUEST['communication_type'];
            $db_data['issue_name'] = $_REQUEST['issue_name'];
            $db_data['issuer_name'] = $_REQUEST['issuer_name'];
            $db_data['addressee_name'] = $_REQUEST['addressee_name'];
            $db_data['timeline'] = $_REQUEST['timeline'];
            $db_data['synopsis'] = $_REQUEST['synopsis'];
            $db_data['entered_by'] = $user_id;

                $EE_last_data =$this->Document_upload_model->save_communication($db_data);
            
            $doc_counts = count($_REQUEST['document_name']);
            $doc_name = $_REQUEST['document_name'];
            $doc_owner = $_REQUEST['document_owner'];
            $doc_date = $_REQUEST['date'];
            $hidden_doc = $_REQUEST['file_hidden'];
            $config['upload_path']          = 'uploads/files/doc_upload/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
            $config['max_size']             = 2000000;
            for($i=0; $i < $doc_counts; $i++) {

                 $filename = rand(11,999999). time().'_'.$_FILES['files']['name'][$i];
                 $this->load->library('upload', $config);

                 $_FILES['images']['name']= $filename;
                 $_FILES['images']['tmp_name']= $_FILES['files']['tmp_name'][$i];
                 

                  $this->upload->do_upload('images');
     if(!empty($doc_name[$i])) {

                   $filename = $this->upload->data("file_name");
                    $addData = array(
                    'project_id' => $project_id, 
                    'communication_id' => $EE_last_data,
                    'document_name' => $doc_name[$i], 
                    'document_owner' => $doc_owner[$i],
                    'document_date' => $doc_date[$i],
                    'communication_file' => $filename, 
                    'entered_by' => $user_id
                );

              $this->Document_upload_model->add_documents($addData);
    }

            }
 
          }

         $this->session->set_flashdata('success', 'Communications Data saved successfully');
        
         if($project_id){

                //redirect('Document_upload/manage?project_id=' . base64_encode($project_id) .'&id='.$EE_last_data);
                redirect('Communication/project_lists');
            }
        }

    }
	

}
?>