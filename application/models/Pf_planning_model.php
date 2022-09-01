<?php

class Pf_planning_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    function get_pf_planning_project_list($user_id,$circle_id,$division_id){

      if($circle_id == 0 && $division_id == 0){

      $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type');

        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        $this->db->where('project_aggrement_stage.approve_status', 'Y');
        //$this->db->where('project_conceptualisation_stage.project_status', '1');
        //$this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
        $query = $this->db->get('project_conceptualisation_stage');
       
        return $query->result_array();

      }

      elseif($circle_id && $division_id){

        $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type');

        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        $this->db->where('project_aggrement_stage.approve_status', 'Y');
        //$this->db->where('project_conceptualisation_stage.project_status', '1');
        $this -> db -> where('project_conceptualisation_stage.wing_id' , $circle_id);
        $this -> db -> where('project_conceptualisation_stage.division_id' , $division_id);
        //$this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
        $query = $this->db->get('project_conceptualisation_stage');
       
        return $query->result_array();
      }

      else{

        $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type');

        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        $this->db->where('project_aggrement_stage.approve_status', 'Y');
       // $this->db->where('project_conceptualisation_stage.project_status', '1');
        $this -> db -> where('project_conceptualisation_stage.wing_id' , $circle_id);
       
        //$this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
        $query = $this->db->get('project_conceptualisation_stage');
       
        return $query->result_array();
      }

      // $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
      //   project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type');

      //   $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
      //   $this->db->where('project_aggrement_stage.approve_status', 'Y');
      //   $this->db->where('project_conceptualisation_stage.project_status', '1');
      //   $this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
      //   $query = $this->db->get('project_conceptualisation_stage');
       
      //   return $query->result_array();
    }

     /*Get project  area*/
    public function get_project_area($area_id = Null)
    {
        $this->db->select('area_master.*');
        if (!empty($area_id)) {
            $this->db->where('area_master.id', $area_id);
        }
        $this->db->where('area_master.status', 'Y');
        $query = $this->db->get('area_master');
		// echo $this->db->last_query(); die;
        return $query->result_array();
    }
    /*Get project area End*/

    /*Get project destination*/
    public function get_project_destination($area_id)
    {
        $this->db->select('destination_master.*');
        $this->db->where('destination_master.area_id', $area_id);
        $this->db->where('destination_master.status', 'Y');
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

    /*Get project destination End*/
  
      public function get_project_type($type_id = Null)
    {
        $this->db->select('project_type_master.*');
        if (!empty($type_id)) {
            $this->db->where('project_type_master.id', $type_id);
        }
        $this->db->where('project_type_master.status', 'Y');
        $query = $this->db->get('project_type_master');
        return $query->result_array();
    }


    public function project_details( $project_id){
        $this->db->select('*');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_conceptualisation_stage');
        return $query->result_array();
    }

    public function get_project_wise_location($project_id)
        {
        $this -> db -> select('t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');

        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');

        $this->db->where('t1.id', $project_id);
        $this->db->where('t3.status', 'Y');
        $query = $this -> db -> get();
        return $query->result_array();
        }

    /*Get project other setting details list*/
    public function get_project_other_setting_list($project_id=Null,$other_setting_id=Null) {
      $this->db->select('project_other_charges.*');
      $this->db->where('project_other_charges.project_id', $project_id);
      if(!empty($other_setting_id)){
        $this->db->where('project_other_charges.id', $other_setting_id);
      }
      $query = $this->db->get('project_other_charges');
      //echo $this->db->last_query(); die;
      return $query->result_array();
    }

    public function get_project_aggrement_details( $project_id){
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_aggrement_stage');
        return $query->result_array();
    }

     /*Add project*/
    function add($table,$data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
    /*Add project End*/

   /*For Any Update Query*/ 
   function updateDataCondition($tableName, $data, $where){
      $this->db->where($where);
      $this->db->update($tableName, $data);
      //echo $this->db->last_query().'<br><br>';
      return TRUE;
   }
   /*For Any Update Query End*/

 /*delete for all*/ 
   function deleteRecord($tableName,$deleteClause){
    $this->db->delete($tableName, $deleteClause); 
   }
   /*delete for all End*/

   /*Get project activity list*/
    public function get_project_activity_list($project_id=Null,$activity_id=Null) {
      $this->db->select('project_pf_activities.*');
      $this->db->where('project_pf_activities.project_id', $project_id);
      if(!empty($activity_id)){
        $this->db->where('project_pf_activities.id', $activity_id);
      }
      $query = $this->db->get('project_pf_activities');
      return $query->result_array();
    }
    /*Get project activity details list*/

    /*Get project activity details*/
    public function get_project_activity_details($project_id=Null,$activity_id=Null) {
      $this->db->select('project_pf_activities.*');
      $this->db->where('project_pf_activities.project_id', $project_id);
      if(!empty($activity_id)){
        $this->db->where('project_pf_activities.id', $activity_id);
      }
      $this->db->where('project_pf_activities.status', 'Y');
      $query = $this->db->get('project_pf_activities');
      return $query->result_array();
    }
    /*Get project activity details End*/

    /*Get project other setting details*/
    public function get_project_other_setting_details($project_id=Null,$other_setting_id=Null) {
      $this->db->select('project_other_charges.*');
      $this->db->where('project_other_charges.project_id', $project_id);
      if(!empty($other_setting_id)){
        $this->db->where('project_other_charges.id', $other_setting_id);
      }
      $this->db->where('project_other_charges.status', 'Y');
      $query = $this->db->get('project_other_charges');
      return $query->result_array();
    }
    /*Get project other setting details End*/

    /*Get project activity wise total amt*/
    public function get_project_wise_total_activity_amt($project_id) {
      $this->db->select('sum(project_pf_activities.amount) as total_amount');
      $this->db->where('project_pf_activities.project_id', $project_id);
      $this->db->where('project_pf_activities.status', 'Y');
      $query = $this->db->get('project_pf_activities');
      return $query->result_array();
    }
    /*Get project activity wise total amt End*/

    /*Get project activity wise total planned amt*/
    public function get_project_wise_total_activity_planned_amt($project_id) {
      $this->db->select('sum(project_financial_planning_main.total_activity_budget_amount) 
        as total_planned_amount');
      $this->db->where('project_financial_planning_main.project_id', $project_id);
      $this->db->where('project_financial_planning_main.status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /*Get project activity wise total planned amt End*/

    /*Get project planned amount*/
    public function get_planned_amount_data($project_id,$project_activity_id) {
      $this->db->select('sum(project_financial_planning_detail.target_amount) as planned_amnt');
      $this->db->where('project_financial_planning_detail.project_id', $project_id);
      $this->db->where('project_financial_planning_detail.project_activity_id', $project_activity_id);
      $this->db->where('project_financial_planning_detail.status', 'Y');
      $query = $this->db->get('project_financial_planning_detail');
      return $query->result_array();
    }
    /*Get project planned amount End*/

    /*Get project activity wise financial planning details*/
    public function project_activity_wise_financial_planning_main($project_id,$activity_id) {
      $this->db->select('project_financial_planning_main.*');
      $this->db->where('project_financial_planning_main.project_id', $project_id);
      $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_financial_planning_main.status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /*Get project activity wise financial planning details End*/

    /*Get project work item list*/
    public function get_work_item_list($work_item_id=Null) {

      $this->db->select('work_item_master.*');
      if(!empty($work_item_id)){
        $this->db->where('work_item_master.id', $work_item_id);
      }
      $this->db->where('work_item_master.status', 'Y');
      $query = $this->db->get('work_item_master');
     
      return $query->result_array();
    }
    /*Get project work item list End*/

    /*Get project activity wise physical planning details*/
    public function project_activity_wise_physical_planning_detail($project_id,$activity_id) {
      $this->db->select('project_physical_planning_main.*');
      $this->db->where('project_physical_planning_main.project_id', $project_id);
      $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_physical_planning_main.status', 'Y');
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }
    /*Get project activity wise physical planning details End*/

    /*Get project physical details*/
    public function get_unit_detail($unit_id=null) {
      $this->db->select('unit_master.*');
      if(!empty($unit_id)){
        $this->db->where('unit_master.id', $unit_id);
      }
      $this->db->where('unit_master.status', 'Y');
      $query = $this->db->get('unit_master');
      return $query->result_array();
    }
    /*Get project physical details End*/

    /*Get project work item details*/
    public function get_project_work_item_details($project_id) {
      $this->db->select('project_work_items.*');
      $this->db->where('project_work_items.status', 'Y');
      $this->db->where('project_work_items.project_id', $project_id);
      $query = $this->db->get('project_work_items');
      return $query->result_array();
    }
    /*Get project work item details End*/
     /*Get project work item physical target*/
    public function get_work_item_physical_target($project_id,$work_item_id) {
       $this->db->select('sum(project_physical_planning_detail.target_quantity) as target, sum(project_physical_planning_detail.allotted_quantity) as achieved, unit_id');
       $this->db->where('project_physical_planning_detail.status', 'Y');
       $this->db->where('project_physical_planning_detail.project_id', $project_id);
       $this->db->where('project_physical_planning_detail.project_work_item_id', $work_item_id);
       $this->db->group_by('project_physical_planning_detail.unit_id');
       $query = $this->db->get('project_physical_planning_detail');
       //echo $this->db->last_query(); die();
       return $query->result_array();
    }
    /*Get project work item physical target End*/

    /*Get project work item financial planned amount*/
    public function get_work_item_financial_planned_amount($project_id,$work_item_id) {
       $this->db->select('sum(project_financial_planning_detail.target_amount) as target_amount');
       $this->db->where('project_financial_planning_detail.status', 'Y');
       $this->db->where('project_financial_planning_detail.project_id', $project_id);
       $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
       $query = $this->db->get('project_financial_planning_detail');
       return $query->result_array();
    }
    /*Get project work item financial planned amount End*/

    /*Financial Budget Amount*/
    public function get_financial_budget_data($project_id,$work_item_id) {
       $this->db->select('project_work_items.*');
       $this->db->where('project_work_items.project_id', $project_id);
       $this->db->where('project_work_items.work_item_id', $work_item_id);
       $this->db->where('project_work_items.status', 'Y');
       $query = $this->db->get('project_work_items');
       return $query->result_array();
    }
    /*Financial Budget Amount End*/

     /*Get project financial details*/
    public function get_project_financial_details($project_id,$work_item_id=Null,$activity_id=Null) {
      $this->db->select('project_financial_planning_main.*');
      $this->db->where('project_financial_planning_main.project_id', $project_id);
      $this->db->where('project_financial_planning_main.project_work_item_id', $work_item_id);
      $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_financial_planning_main.status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /*Get project financial details End*/

    /*Get project financial planning details*/
    public function project_financial_planning_detail($project_id,$work_item_id,$activity_id) {
      $this->db->select('project_financial_planning_detail.*');
      $this->db->where('project_financial_planning_detail.project_id', $project_id);
      $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
      $this->db->where('project_financial_planning_detail.project_activity_id', $activity_id);
      $query = $this->db->get('project_financial_planning_detail');
      //echo $this->db->last_query(); die;
      return $query->result_array();
    }
    /*Get project financial planning details End*/

    /*Get work item type master details*/
    public function get_work_item_type_master($work_item_type_master_id=Null) {
      $this->db->select('work_item_type_master.*');
      if(!empty($work_item_type_master_id)){
         $this->db->where('work_item_type_master.id', $work_item_type_master_id);
      }
      $this->db->where('work_item_type_master.status', 'Y');
      $query = $this->db->get('work_item_type_master');
      //echo $this->db->last_query();
      return $query->result_array();
    }
    /*Get work item type master details End*/

    /*Get project work item financial planned amount with workitem and activity wise*/
    public function get_work_item_financial_planned_amount_with_workitem_activity($project_id,$work_item_id,$project_activity_id) {
       $this->db->select('sum(project_financial_planning_detail.target_amount) as target_amount');
       $this->db->where('project_financial_planning_detail.status', 'Y');
       $this->db->where('project_financial_planning_detail.project_id', $project_id);
       $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
       $this->db->where('project_financial_planning_detail.project_activity_id', $project_activity_id);
       $query = $this->db->get('project_financial_planning_detail');
       return $query->result_array();
    }
    /*Get project work item financial planned amount with workitem and activity wise End*/

    /*Get project activity name*/
    public function project_activity_name($activity_id) {
      $this->db->select('project_pf_activities.*');
      $this->db->where('project_pf_activities.id', $activity_id);
      $this->db->where('project_pf_activities.status', 'Y');
      $query = $this->db->get('project_pf_activities');
      return $query->result_array();
    }
    /*Get project activity name End*/

    /*Get project physical details*/
    public function get_project_physical_details($project_id,$work_item_id,$activity_id) {
      $this->db->select('project_physical_planning_main.*');
      $this->db->where('project_physical_planning_main.project_id', $project_id);
      $this->db->where('project_physical_planning_main.project_work_item_id', $work_item_id);
      $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_physical_planning_main.status', 'Y');
      $query = $this->db->get('project_physical_planning_main');
      //echo $this->db->last_query();
      return $query->result_array();
    }
    /*Get project physical details End*/

     /*Get project physical planning details*/
    public function project_physical_planning_detail($project_id,$work_item_id,$activity_id) {
      $this->db->select('project_physical_planning_detail.*');
      $this->db->where('project_physical_planning_detail.project_id', $project_id);
      $this->db->where('project_physical_planning_detail.project_work_item_id', $work_item_id);
      $this->db->where('project_physical_planning_detail.project_activity_id', $activity_id);
      $this->db->where('project_physical_planning_detail.status', 'Y');
      $query = $this->db->get('project_physical_planning_detail');
      //echo $this->db->last_query(); die;
      return $query->result_array();
    }
    /*Get project physical planning details End*/

     /*Get project physical planning main*/
    public function project_physical_planning_main($project_id,$work_item_id,$activity_id) {
      $this->db->select('project_physical_planning_main.*');
      $this->db->where('project_physical_planning_main.project_id', $project_id);
      $this->db->where('project_physical_planning_main.project_work_item_id', $work_item_id);
      $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_physical_planning_main.status', 'Y');
      $query = $this->db->get('project_physical_planning_main');
      //echo $this->db->last_query(); die;
      return $query->result_array();
    }
    /*Get project physical planning main End*/

    /*Get project and activity wise total planned amt*/
    public function get_project_activity_wise_total_activity_planned_amt($project_id,$activity_id) {
      $this->db->select('sum(project_financial_planning_main.total_activity_budget_amount) 
        as total_budget_amount');
      $this->db->where('project_financial_planning_main.project_id', $project_id);
      $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
      $this->db->where('project_financial_planning_main.status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /*Get project activity wise total planned amt End*/

    function check_activity_record_exist_or_not($project_id,$project_work_item_id,$activity_id){
      $this->db->where('project_id', $project_id);
      $this->db->where('project_work_item_id', $project_work_item_id);
      $this->db->where('project_activity_id', $activity_id);
      $query=$this->db->get('project_financial_planning_main');
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    function count_data_against_project($tbl,$field1,$value1,$field2,$value2){
      $this->db->where($field1, $value1);
      $this->db->where($field2, $value2);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }
	  /*Get project wise single work item details*/
    public function get_project_wise_witem_details($project_id,$workItem_id) {
      $this->db->select('project_work_items.*');
      $this->db->where('project_work_items.work_item_id', $workItem_id);
      $this->db->where('project_work_items.project_id', $project_id);
      $query = $this->db->get('project_work_items');
	  //echo $this->db->last_query(); die;
      return $query->result_array();
    }
	
	  /*Get project wise  work item duplicatechking EDIT*/
    public function get_duplicate_workitemchk($project_id,$work_item_name,$Update_id) {
      $this->db->select('project_work_items.*');
      $this->db->where('project_work_items.work_item_id', $work_item_name);
      $this->db->where('project_work_items.project_id', $project_id);
      $this->db->where('project_work_items.id!=', $Update_id);
      $query = $this->db->get('project_work_items');
	  //echo $this->db->last_query(); die;
     $num_rows = $query->num_rows();
	 return $num_rows;
    }
	
	/*Get project wise  work item duplicatechking add*/
    public function get_duplicate_workitemchkADD($project_id,$work_item_name) {
      $this->db->select('project_work_items.*');
      $this->db->where('project_work_items.work_item_id', $work_item_name);
      $this->db->where('project_work_items.project_id', $project_id);
      $query = $this->db->get('project_work_items');
	  //echo $this->db->last_query(); die;
     $num_rows = $query->num_rows();
	 return $num_rows;
    }

/* checking activity id exist or not */
    function count_activity_exist($activity_id,$tbl){
      $this->db->where('project_activity_id', $activity_id);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

}
?>