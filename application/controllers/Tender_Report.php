<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tender_Report extends MY_Controller {
    public function __construct(){
        parent::__construct();
        // load base_url
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper(array('url','html','form'));
        $this->load->model('Reporttender_model');
        $this->load->model('Procurement_model');
        $this->load->library('form_validation');
         /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }
    

    function project_report(){

        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $data['project_category'] = $this->Reporttender_model->get_project_type();
        $data['project_area'] = $this->Reporttender_model->get_project_area();
        $data['sector_list'] = $this->Reporttender_model->get_sector();
        $data['group_list'] = $this->Reporttender_model->get_group();
        $data['wing_list'] = $this->Reporttender_model->get_wing();
        $data['division_list'] = $this->Reporttender_model->get_division();
           
        $data['project_dropdown_Data'] = $this->Reporttender_model->fetchAllData('project_conceptualisation_stage');
        $this->load->common_template('report/tender_report_view', $data);
    }

    

    /* for project summery report */

    function ajax_project_summary_report(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        if (!empty($this->input->post('project_sector_id'))) {
            $project_sector_id = $this->input->post('project_sector_id');
        } else {
            $project_sector_id = 0;
        }
        $data['project_sector_id'] = $project_sector_id;
        if (!empty($this->input->post('project_group_id'))) {
            $project_group_id = $this->input->post('project_group_id');
        } else {
            $project_group_id = 0;
        }
        $data['project_group_id'] = $project_group_id;
        if (!empty($this->input->post('project_category_id'))) {
            $project_category_id = $this->input->post('project_category_id');
        } else {
            $project_category_id = 0;
        }
        $data['project_category_id'] = $project_category_id;
        if (!empty($this->input->post('project_area_id'))) {
            $project_area_id = $this->input->post('project_area_id');
        } else {
            $project_area_id = 0;
        }
        $data['project_area_id'] = $project_area_id;
        if (!empty($this->input->post('project_wing_id'))) {
            $project_wing_id = $this->input->post('project_wing_id');
        } else {
            $project_wing_id = 0;
        }
        $data['project_wing_id'] = $project_wing_id;

        if (!empty($this->input->post('project_division_id'))) {
            $project_division_id = $this->input->post('project_division_id');
        } else {
            $project_division_id = 0;
        }
        $data['project_division_id'] = $project_division_id;
        
        $project_status = $this->input->post('project_status');

        
        $data['project_status'] = $project_status;

        $type_str = $this->input->post('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);
        $data['type'] = $type;

        $data['overView_data'] = $this->Reporttender_model->get_project_overview_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        $data['pre_Contruction_data'] = $this->Reporttender_model->get_project_pre_Contruction_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        //Tendering

         $data['pre_bid_data_summary'] =$this->Reporttender_model->fetch_tendering_pre_bid_report_data();
         $data['technical_data_summary'] =$this->Reporttender_model->get_technical_data_summary_report_data();

         $data['financial_data_summary'] =$this->Reporttender_model->get_financial_data_summary_report_data();
         $data['negotiation_data_summary'] =$this->Reporttender_model->get_negotiation_data_summary_report_data();

         $data['issue_of_loa_data_summary'] =$this->Reporttender_model->get_issue_of_loa_data_summary_report_data();
          
        //Tendering

        $this->load->view('report/tender_result_ajax_summary_report_view',$data);
    }


    function get_overview_project_details($project_id){
        return $this->Reporttender_model->get_overview_project_details($project_id);
    }


    function summary_generate_pdf(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $project_sector_id = base64_decode($this->input->get('project_sector_id'));
        $project_group_id = base64_decode($this->input->get('project_group_id'));
        $project_category_id = base64_decode($this->input->get('project_category_id'));
        $project_area_id = base64_decode($this->input->get('project_area_id'));
        $project_wing_id = base64_decode($this->input->get('project_wing_id'));
        $project_division_id = base64_decode($this->input->get('project_division_id'));
        $project_status = $this->input->get('project_status');
        $type_str = $this->input->get('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);
        $data['type'] = $type;

        $data['overView_data'] = $this->Reporttender_model->get_project_overview_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        $data['pre_Contruction_data'] = $this->Reporttender_model->get_project_pre_Contruction_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        //Tendering

         $data['pre_bid_data_summary'] =$this->Reporttender_model->fetch_tendering_pre_bid_report_data();
         $data['technical_data_summary'] =$this->Reporttender_model->get_technical_data_summary_report_data();

         $data['financial_data_summary'] =$this->Reporttender_model->get_financial_data_summary_report_data();
         $data['negotiation_data_summary'] =$this->Reporttender_model->get_negotiation_data_summary_report_data();

         $data['issue_of_loa_data_summary'] =$this->Reporttender_model->get_issue_of_loa_data_summary_report_data();
          
        //Tendering

        $this->load->view('report/tender_result_ajax_summary_report_pdf_view',$data);
    }

    /* for individual report */

    function ajax_project_individual_report(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $this->load->model('Tender_report_model');
        
        $project_id = $this->input->post('project_id');

        $type_str = $this->input->post('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);

        $data['type'] = $type;

       
        $proj_rel_id = $this->Tender_report_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        
        $data['project_creation_data'] = $this->Tender_report_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $this->Tender_report_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $this->Tender_report_model->get_project_creation_users($proj_rel_id);

       
        $data['project_detail'] = $this->Tender_report_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Tender_report_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
       
        
        $data['project_dpr_data'] = $this->Tender_report_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $this->Tender_report_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
         
        
        $data['project_administrative_approval_data'] = $this->Tender_report_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $this->Tender_report_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
        

        $data['project_agreement'] = $this->Reporttender_model->agreement_project_data($project_id);
        
        $data['project_pre_construction_setting'] = $this->Tender_report_model->project_pre_construction_settings_data($project_id);

        $data['project_id'] =$project_id;

      

       //Project Tendering

         $data['pre_bid_data'] =$this->Tender_report_model->fetch_tendering_pre_bid_report_data('tendering_pre_bid', 'project_id', $project_id);
         $data['pre_bid_bidder_data'] = $this->Tender_report_model->get_tendering_pre_bid_bidder_report_data($project_id);
         $data['pre_bid_bidder_data_document'] = $this->Tender_report_model->get_tendering_pre_bid_bidder_report_data_document($project_id);


          $data['technical_evalution'] = $this->Tender_report_model->fetch_tendering_technical_evalution_report_data('tendering_technical_evalution', 'project_id', $project_id);

          $data['technical_evalution_bidder_data'] = $this->Tender_report_model->get_tendering_technical_evalution_bidder_report_data($project_id);

          $data['financial_evalution'] = $this->Tender_report_model->fetch_tendering_financial_evalution_report_data('tendering_financial_evalution', 'project_id', $project_id);

           $data['financial_evalution_bidder_data'] = $this->Tender_report_model->get_tendering_financial_evalution_bidder_report_data($project_id);

           $data['negotiation'] = $this->Tender_report_model->fetch_tendering_negotiation_report_data('tendering_negotiation', 'project_id', $project_id);

           $data['negotiation_bidder_data'] = $this->Tender_report_model->get_tendering_negotiation_bidder_report_data($project_id);

           $data['issue_of_loa'] = $this->Tender_report_model->fetch_tendering_issue_of_loa_report_data('tendering_issue_of_loa', 'project_id', $project_id);

      
      //Project Tendering


        //=========== End Project Information ======================

        $this->load->view('report/tender_result_ajax_project_individual_report_view',$data);
    }


    function project_individual_report_pdf(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $this->load->model('Tender_report_model');
        
        $project_id = base64_decode($_REQUEST['project_id']);
        $type_post = $_REQUEST['type'];
        $type = explode(',', $type_post);

        $data['type'] = $type;

      
        $proj_rel_id = $this->Tender_report_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        
        $data['project_creation_data'] = $this->Tender_report_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $this->Tender_report_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $this->Tender_report_model->get_project_creation_users($proj_rel_id);
 
        $data['project_detail'] = $this->Tender_report_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Tender_report_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
       
        
        $data['project_dpr_data'] = $this->Tender_report_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $this->Tender_report_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
       
        
        $data['project_administrative_approval_data'] = $this->Tender_report_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $this->Tender_report_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
        
        $data['project_pre_construction_setting'] = $this->Tender_report_model->project_pre_construction_settings_data($project_id);

        $data['project_id'] =$project_id;

       

        $data['project_agreement'] = $this->Reporttender_model->agreement_project_data($project_id);
        


          //Project Tendering

         $data['pre_bid_data'] =$this->Tender_report_model->fetch_tendering_pre_bid_report_data('tendering_pre_bid', 'project_id', $project_id);
         $data['pre_bid_bidder_data'] = $this->Tender_report_model->get_tendering_pre_bid_bidder_report_data($project_id);
         $data['pre_bid_bidder_data_document'] = $this->Tender_report_model->get_tendering_pre_bid_bidder_report_data_document($project_id);


         $data['technical_evalution'] = $this->Tender_report_model->fetch_tendering_technical_evalution_report_data('tendering_technical_evalution', 'project_id', $project_id);

          $data['technical_evalution_bidder_data'] = $this->Tender_report_model->get_tendering_technical_evalution_bidder_report_data($project_id);

           $data['financial_evalution'] = $this->Tender_report_model->fetch_tendering_financial_evalution_report_data('tendering_financial_evalution', 'project_id', $project_id);

           $data['financial_evalution_bidder_data'] = $this->Tender_report_model->get_tendering_financial_evalution_bidder_report_data($project_id);


           $data['negotiation'] = $this->Tender_report_model->fetch_tendering_negotiation_report_data('tendering_negotiation', 'project_id', $project_id);

           $data['negotiation_bidder_data'] = $this->Tender_report_model->get_tendering_negotiation_bidder_report_data($project_id);

           $data['issue_of_loa'] = $this->Tender_report_model->fetch_tendering_issue_of_loa_report_data('tendering_issue_of_loa', 'project_id', $project_id);

      //Project Tendering
        $this->load->view('report/tender_result_ajax_project_individual_report_pdf_view',$data);
    }


/* for project pre construction details view new code start on 27-04-2021 */
  



    function get_project_list(){
     if (!empty($this->input->post('project_sector_id'))) {
            $project_sector_id = $this->input->post('project_sector_id');
        } else {
            $project_sector_id = 0;
        }
        if (!empty($this->input->post('project_group_id'))) {
            $project_group_id = $this->input->post('project_group_id');
        } else {
            $project_group_id = 0;
        }
        if (!empty($this->input->post('project_category_id'))) {
            $project_category_id = $this->input->post('project_category_id');
        } else {
            $project_category_id = 0;
        }
        if (!empty($this->input->post('project_area_id'))) {
            $project_area_id = $this->input->post('project_area_id');
        } else {
            $project_area_id = 0;
        }
        if (!empty($this->input->post('project_wing_id'))) {
            $project_wing_id = $this->input->post('project_wing_id');
        } else {
            $project_wing_id = 0;
        }

        if (!empty($this->input->post('project_division_id'))) {
            $project_division_id = $this->input->post('project_division_id');
        } else {
            $project_division_id = 0;
        }
        $project_status = $this->input->post('project_status');
   
          $dataoutput = '<option value="">Select Project</option>';  
        
        
        $result = $this->Reporttender_model->get_project_filter_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);
        if(is_array($result)){
        foreach ($result as $row) {
        
        $dataoutput .= '<option value="'.$row->id.'">'.$row->project_name.'</option>';
        }
        }
        

            echo $dataoutput;
    }


    
}
?>

