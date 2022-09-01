<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_list extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'security'));

        $this->load->model('Project_list_model');
        //$this->load->model('Organization_model');
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

    function pip_conceptualisation(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
  
          $data['user_id'] = $user_id;

          $data['conceptualisation_data'] = $this->Project_list_model->get_project_conceptualisation_data($user_id,$circle_id,$division_id);

          $data['project_creation_data'] = $this->Project_list_model->get_project_creation_data($user_id,$circle_id,$division_id);

          $this->load->common_template('project/pip_conceptualisation_list_view', $data);
    }



    function pip_preparation(){
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
     
          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pip_preparation_pending_projects_list_data($user_id);

          $data['pip_preparation_data'] = $this->Project_list_model->get_pip_preparation_list_data($user_id);

          $this->load->common_template('project/pip_preparation_list_view', $data);
    }



    function pp_pretender(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        $this->load->model('Tender_listing_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        

          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pp_pre_tender_pending_projects_list_data($user_id);

          $data['pp_pre_tender_data'] = $this->Project_list_model->get_pp_pre_tender_list_data($user_id);

          $this->load->common_template('project/pp_pre_tender_list_view', $data);
    }


    function pp_tender(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
      

          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pp_tender_pending_projects_list_data($user_id);

          $data['pp_tender_data'] = $this->Project_list_model->get_pp_tender_list_data($user_id);

          $this->load->common_template('project/pp_tender_list_view', $data);
    }


    function pp_agreement(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
       

          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pp_agreement_pending_projects_list_data($user_id);

          //$data['pp_agreement_data'] = $this->Project_list_model->get_pp_agreement_list_data($user_id);

          $this->load->common_template('project/pp_agreement_list_view', $data);
    }


    /* end for listing Page */
    
    
    function pip_dpr(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
     
          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pip_dpr_pending_projects_list_data($user_id,$circle_id,$division_id);

          $data['pip_dpr_data'] = $this->Project_list_model->get_pip_dpr_list_data($user_id,$circle_id,$division_id);

          $this->load->common_template('project/pip_dpr_list_view', $data);
    }


    function pip_pre_construction_activities(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
     
          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pip_pre_construction_pending_projects_list_data($user_id,$circle_id,$division_id);

          $data['pip_preparation_data'] = $this->Project_list_model->get_pip_pre_construction_list_data($user_id,$circle_id,$division_id);

          $this->load->common_template('project/pip_pre_construction_activities_list_view', $data);
    }

    function pip_administrative_approval(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
     
          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pip_administrative_pending_projects_list_data($user_id,$circle_id,$division_id);

          $data['pip_administrative_data'] = $this->Project_list_model->get_pip_administrative_list_data($user_id,$circle_id,$division_id);

          $this->load->common_template('project/pip_administrative_approval_list_view', $data);
    }
    
   
    function pip_tender_publishing(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
          $circle_id = $this->session->userdata('circle_id');
          $division_id = $this->session->userdata('division_id');
     
          $data['user_id'] = $user_id;

          $data['project_pending_data'] = $this->Project_list_model->get_pip_tender_publishing_projects_list_data($user_id,$circle_id,$division_id);

          $data['pip_preparation_data'] = $this->Project_list_model->get_pip_tender_publishing_list_data($user_id,$circle_id,$division_id);

           $this->load->common_template('project/pip_tender_publishing_list_view', $data);
      }
           
   
    function agreement_data_exist_or_not($project_id,$specifc_field){
       return $this->Project_list_model->project_specific_data('project_aggrement_stage','project_id',$project_id,$specifc_field);
      
    }
     

}
?>