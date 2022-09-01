<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issues extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        /*To Check whether logged in */
        $this->load->model('Document_upload_model');
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function issue_lists()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $data['issue_list'] = $this->Document_upload_model->fetch_issues($project_id);
        $data['user_id'] = $this->session->userdata('id');
		
        $this->load->common_template('communication/issue_updation_list',$data);
    }
    public function create_issue() 
    {
        $this->load->common_template('communication/issue_create');
    }
    public function issue_details() {

        $this->load->common_template('communication/issue_details');
    }
    public function view_issue_details() {

        $this->load->common_template('communication/view_issue_details');
    }
	

}
?>