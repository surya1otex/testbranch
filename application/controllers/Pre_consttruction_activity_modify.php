<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pre_consttruction_activity_modify extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('Setting_modify_model');
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

       $settings = $this->Setting_modify_model->fetch_settings(base64_decode($_REQUEST['project_id']));
       if($settings[0]->land_schedule == 'Y') {
        redirect('pre_consttruction_activity_land_schedule/manage?project_id='.$_REQUEST['project_id']);
       }
       elseif($settings[0]->govt_land_alienation == 'Y') {
        redirect('Pre_consttruction_activity_government_land_alienation/manage?project_id='.$_REQUEST['project_id']);
       }
       elseif ($settings[0]->private_land_direct_purchase == 'Y') {
        redirect('Pre_consttruction_activity_private_land_dp/manage?project_id='.$_REQUEST['project_id']);
       }
       elseif ($settings[0]->private_land_acquisition == 'Y') {
         redirect('Pre_consttruction_activity_private_land_la/manage?project_id='.$_REQUEST['project_id']);
       }
        elseif ($settings[0]->forest_land == 'Y') {
         redirect('Pre_consttruction_activity_forest_land/manage?project_id='.$_REQUEST['project_id']);     
        }
        elseif ($settings[0]->tree_cutting == 'Y') {
         redirect('Pre_consttruction_activity_tree_cutting/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif($settings[0]->environmental_clearance == 'Y') {
            redirect('Pre_consttruction_activity_environmental_clearance/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif ($settings[0]->utility_shifting_electrical == 'Y') {
            redirect('Pre_consttruction_activity_utility_shifting_electrical/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif ($settings[0]->utility_shifting_PH == 'Y') {
            redirect('Pre_consttruction_activity_utility_shifting_ph/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif($settings[0]->utility_shifting_RWSS == 'Y') {
            redirect('Pre_consttruction_activity_utility_shifting_rwss/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif($settings[0]->encroachment_eviction == 'Y') {
            redirect('Pre_consttruction_activity_encroachment_eviction/manage?project_id='.$_REQUEST['project_id']);
        }
        elseif($settings[0]->special_activity == 'Y') {
            redirect('Pre_consttruction_activity_special_activity/manage?project_id='.$_REQUEST['project_id']);
        }
        else {

        }

    }



}