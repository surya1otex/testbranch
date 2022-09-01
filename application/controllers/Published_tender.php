<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Published_tender extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper'));
        $this->load->helper(array('url', 'security'));

        $this->load->model('Published_tender_model');
        $this->allowedModule = array(1 => true, 3 => false, 6 => false, 2 => false, 5 => false, 7 => false, 4 => false);
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }


    /* for listing Page */

    function lists(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->published_project_lists($user_id);

           $this->load->common_template('published_tender/published_tetnder_project_list', $data);
    }


    /* end for listing Page */
    /* for PRE-BID listing Page */

    function pp_pre_bid(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->published_project_lists($user_id);

           $this->load->common_template('published_tender/pre_bid_project_list', $data);
    }


    /* end for PRE-BID listing Page */
    /* for Technical Evalution  listing Page */

    function pp_technical_evalution(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->technical_evalution_project_lists($user_id);

           $this->load->common_template('published_tender/technical_evalution_project_list', $data);
    }


    /* end for Technical Evalution  listing Page */
    /* for Financial Evalution   listing Page */

    function pp_finacial_evalution(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->finacial_evalution_project_lists($user_id);

           $this->load->common_template('published_tender/finacial_evalution_project_list', $data);
    }


    /* end for Financial Evalution   listing Page */
    /* for Negotiation  listing Page */

    function pp_negotiation(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->negotiation_project_lists($user_id);

           $this->load->common_template('published_tender/negotiation_project_list', $data);
    }


    /* end for Negotiation  listing Page */
    /* for Issue of LoA   listing Page */

    function pp_issue_loa(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
          $data['published_tender_data'] = $this->Published_tender_model->issue_loa_project_lists($user_id);

           $this->load->common_template('published_tender/issue_loa_project_list', $data);
    }


    /* end for Issue of LoA listing Page */


  


}