<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_land_schedule extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Land_schedule');
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
		
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $data['districts'] = $this->Land_schedule->fetch_district();

      $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_land_schedule', $data);
        
    }
	
public function fetch_district()
   {
    $districts = $this->Land_alienation_model->fetch_district();
 
    echo json_encode($districts);


   }

	public function fetch_tahasil()
    {
      if($this->input->post('district_id'))
     {
      echo $this->Land_schedule->fetch_tahasil($this->input->post('district_id'));
     }
    }
	
	

}  
 

?>