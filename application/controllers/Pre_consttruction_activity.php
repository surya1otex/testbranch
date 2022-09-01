<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('Setting_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function project_lists()
    {
		
        $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_list', $data);
    }
	

    public function settings()
    {
		$data['project_id'] = base64_decode($_REQUEST['project_id']);

        $project_id = base64_decode($_REQUEST['project_id']);
        

        $getsettings = $this->Setting_model->getsettings($project_id);

        //print_r($getsettings);

        if($getsettings) {
            $data['getsettings'] = $this->Setting_model->getsettings($project_id);

            //print_r($data['getsettings']);
          $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_settings', $data);
        }
        else {
            $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_settings', $data);
        }

       // $this->load->common_template('pre_consttruction_activity/pre_consttruction_activity_settings', $data);


    }

    public function savesettings() {
            $project_id = base64_encode($_REQUEST['project_id']);
            if(count($_POST) == 1) {
              
              $this->session->set_flashdata('danger', 'Please Check minimum one option');
              redirect('pre_consttruction_activity/settings?project_id='.$project_id);  
            }
            else {
            $data = array(
                'project_id' => $_REQUEST['project_id'],
                'govt_land_alienation' => ($_REQUEST['gov_land'] == 'Y') ? 'Y' : 'N',
                'private_land_direct_purchase' => ($_REQUEST['pri_land_direct'] == 'Y') ? 'Y' : 'N',
                 'private_land_acquisition' => ($_REQUEST['pri_land_land'] == 'Y') ? 'Y' : 'N',
                 'forest_land' => ($_REQUEST['forest_land'] == 'Y') ? 'Y' : 'N',
                 'tree_cutting' => ($_REQUEST['tree_cut'] == 'Y') ? 'Y' : 'N',
                 'environmental_clearance' => ($_REQUEST['env_clearance'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_electrical' => ($_REQUEST['utility_shift'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_PH' => ($_REQUEST['utili_shft_ph'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_RWSS' => ($_REQUEST['utili_shft_rwss'] == 'Y') ? 'Y' : 'N',
                 'encroachment_eviction' => ($_REQUEST['encroach_evic'] == 'Y') ? 'Y' : 'N',
                 'special_activity' => ($_REQUEST['special_act'] == 'Y') ? 'Y' : 'N',
                 'entered_by_userID' => $this->session->userdata('id')
            );
            $success = $this->Setting_model->savesettings($data);

             if($success == true)
             {
              //redirect('Pre_consttruction_activity/project_lists');
              $this->session->set_flashdata('success', 'Settings Saved');
              redirect('pre_consttruction_activity/settings?project_id='.$project_id);


             }

        }

  }  

    public function updatesettings() {
        $project_id = $_REQUEST['project_id'];
       // if(count($_POST) == 1) {
             // $this->session->set_flashdata('danger', 'Please Check minimum one option');
              //redirect('pre_consttruction_activity/settings?project_id='.base64_encode($project_id));
          //}
          //else {
            $data = array(
                'govt_land_alienation' => ($_REQUEST['gov_land'] == 'Y') ? 'Y' : 'N',
                'private_land_direct_purchase' => ($_REQUEST['pri_land_direct'] == 'Y') ? 'Y' : 'N',
                 'private_land_acquisition' => ($_REQUEST['pri_land_land'] == 'Y') ? 'Y' : 'N',
                 'forest_land' => ($_REQUEST['forest_land'] == 'Y') ? 'Y' : 'N',
                 'tree_cutting' => ($_REQUEST['tree_cut'] == 'Y') ? 'Y' : 'N',
                 'environmental_clearance' => ($_REQUEST['env_clearance'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_electrical' => ($_REQUEST['utility_shift'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_PH' => ($_REQUEST['utili_shft_ph'] == 'Y') ? 'Y' : 'N',
                 'utility_shifting_RWSS' => ($_REQUEST['utili_shft_rwss'] == 'Y') ? 'Y' : 'N',
                 'encroachment_eviction' => ($_REQUEST['encroach_evic'] == 'Y') ? 'Y' : 'N',
                 'special_activity' => ($_REQUEST['special_act'] == 'Y') ? 'Y' : 'N', 
                 'entered_by_userID' => $this->session->userdata('id')
            );
            $this->Setting_model->updatesettings($project_id,$data);
            $project_id = base64_encode($project_id);
            
            $this->session->set_flashdata('success', 'Settings Updated');
            redirect('pre_consttruction_activity/settings?project_id='.$project_id);
        //}
            
    }
 
}
?>