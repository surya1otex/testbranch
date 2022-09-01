<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tendering extends MY_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        //$this->load->model('Tender_listing_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function pp_technical_evalution()
    {
		
        $this->load->common_template('tendering/technical_evalution_list', $data);
    }

    public function pp_finacial_evalution()
    {
        
        $this->load->common_template('tendering/finacial_evalution_list', $data);
    }

    public function pp_pre_bid()
    {
         
        $this->load->common_template('tendering/prebid_list', $data);
    }

    public function pp_issue_loa()
    {
         
        $this->load->common_template('tendering/issue_loa_list', $data);
    }

    public function pp_negotiation()
    {
         
        $this->load->common_template('tendering/negotiation_list', $data);
    }


}

?>