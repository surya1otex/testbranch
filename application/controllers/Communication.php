<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Communication extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('Communication_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function project_lists()
{
$circle_id = $this->session->userdata('circle_id');
$division_id = $this->session->userdata('division_id');
$data['projects'] = $this->Communication_model->get_projects($circle_id,$division_id);
$this->load->common_template('communication/project_activity_list',$data);
}
	

}
?>