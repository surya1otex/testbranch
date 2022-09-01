<?php

class SuperAdminDashboard_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }
	

	  public function get_project_details(){
      $this->db->select('project_conceptualisation_stage.*,td.agreement_date as project_start_date,td.agreement_end_date as project_end_date');
     
      $this->db->where('project_conceptualisation_stage.status', 'Y');
      $this->db->join('project_aggrement_stage as td', 'td.project_id = project_conceptualisation_stage.id', 'LEFT');
      $query = $this->db->get('project_conceptualisation_stage');
       // echo $this->db->last_query(); die;
      return $query->result_array();
    }
	
	
    public function get_total_project_count(){
      $this->db->select('COUNT(*) AS total_project');
	  
      $query = $this->db->get('project_conceptualisation_stage');
	  //echo $this->db->last_query(); die;
      return $query->result_array();
    }


    public function get_ongoing_project_count(){
      $this->db->select('project_conceptualisation_stage.*,td.*');
	  
      //$this->db->where('status', 'Y');
      $this->db->where('td.approve_status', 'Y');
      $this->db->join('project_aggrement_stage as td', 'project_conceptualisation_stage.id = td.project_id', 'LEFT');
      $query = $this->db->get('project_conceptualisation_stage');
	 //echo $this->db->last_query(); die;
      return $query->result_array();
    }

    public function get_completed_project_count(){
      $this->db->select('project_conceptualisation_stage.*,td.*');
	  
      $this->db->join('project_completed_history as td', 'project_conceptualisation_stage.id = td.project_id', 'RIGHT');
      $query = $this->db->get('project_conceptualisation_stage');
      return $query->result_array();
    }
	
	
    public function get_project_budget($project_id=null) {
      $this->db->select('sum(estimate_total_cost) as total_project_budget');
      if(!empty($project_id)){
        $this->db->where('id', $project_id);  
      }
      $this->db->where('status', 'Y');
      //$this->db->group_by('project_physical_planning_detail.unit_id');
      $query = $this->db->get('project_conceptualisation_stage');
      return $query->result_array();
    }
	
	 public function get_project_released_amount($project_id=null) {
      $this->db->select('sum(total_activity_allotted_amount) as total_activity_allotted_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }


	   public function get_project_budgetamnt() {
      $this->db->select('sum(estimate_total_cost) as total_project_budget');
	  
      $query = $this->db->get('project_conceptualisation_stage');
	 // echo $this->db->last_query();
      return $query->result_array();
    }

    public function get_project_expendature() {
		
      $this->db->select('sum(pi.paid_amount) as total_project_expen'); 
	  $this->db->from('project_invoice_payment_history as pi'); 
	   
      //$query = $this->db->get('project_invoice_payment_history');
	  $query = $this->db->get();
	 // echo $this->db->last_query();
      return $query->result_array();
    }
	
	 public function get_project_agreement_amount(){

      $this->db->select('(td.agreement_cost) as proj_agreement_cost');
     // $this->db->select('pd.organization_id, pd.id, td.agreement_cost, td.id');
      $this->db->from('project_conceptualisation_stage as pd');     
	  
      $this->db->join('project_aggrement_stage as td', 'pd.id = td.project_id', 'LEFT');
      $query = $this->db->get();
       // echo $this->db->last_query(); die();
      return $query->result_array(); 
    }
	













}
?>