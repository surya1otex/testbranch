<?php

class Commissioning_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }



    public function getOrganization_Users_OrganizationId($user_id){
        $user_id = (int)$user_id;
        $this->db->select('organization_id');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['organization_id'];
    }

    /*Get project list*/
    public function get_commissioning_project_details_old()
    {
       $this->db->select('project_conceptualisation_stage.*,td.project_start_date as project_start_date,td.project_end_date as project_end_date,project_conceptualisation_stage.status,td.status as TD_status, am.name as area_name,ptm.project_type as project_type_name');
       $this->db->where('project_conceptualisation_stage.status', 'Y');
       $this->db->join('project_aggrement_stage as td', 'td.project_id = project_conceptualisation_stage.id', 'LEFT');
       $this->db->join('area_master as am', 'am.id = project_conceptualisation_stage.project_area', 'LEFT');
       $this->db->join('project_type_master as ptm', 'ptm.id = project_conceptualisation_stage.project_type', 'LEFT');

       $query = $this->db->get('project_conceptualisation_stage');
        //echo $this->db->last_query(); die;
       return $query->result_array();
    }

    /*Get project list*/
    public function get_commissioning_project_details()
    {
       $query = $this->db->query("Select * from(SELECT IFNULL(SUM(c.target_amount), 0) as Planned_Value, IFNULL(SUM(c.earned_amount), 0) as Earned_Value, IFNULL(SUM(c.allotted_amount), 0) as Paid_Value,pas.agreement_cost as project_agreement_cost,pas.project_start_date as project_start_date,pas.project_end_date as project_end_date ,pas.status as TD_status,am.name as area_name,ptm.project_type as project_type_name,pd.* FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id left join project_aggrement_stage pas on pas.project_id=pd.id left join area_master am on am.id=pd.location_id left join project_type_master ptm on ptm.id=pd.project_type GROUP BY c.project_id)as summary where Earned_Value >= (95/100 * project_agreement_cost);");
       if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }



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
    public function get_sector_id($sector_id)
    {
        $this->db->select('name');
        $this->db->where('id', $sector_id);
        $query = $this->db->get('sector_master');
        return $query->result_array();
    }

    public function get_group_id($group_id)
    {
        $this->db->select('name');
        $this->db->where('id', $group_id);
        $query = $this->db->get('group_master');
        return $query->result_array();
    }

     /*Get project type*/
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

    /*Get project  area*/
    public function get_project_area($area_id = Null)
    {
        $this->db->select('area_master.*');
        if (!empty($area_id)) {
            $this->db->where('area_master.id', $area_id);
        }
        $this->db->where('area_master.status', 'Y');
        $query = $this->db->get('area_master');
        return $query->result_array();
    }

     public function project_destination($destination_id)
    {
        $this->db->select('name');
        $this->db->where('id', $destination_id);
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

    /*Get project indivisual details*/
    public function get_project_data($project_id = Null)
    {
        $this->db->select('pd.*,area.name as area_name,td.*');
        $this->db->from('project_conceptualisation_stage as pd');
        $this->db->where('pd.id', $project_id);

        $this->db->join('project_aggrement_stage as td', 'pd.id = td.project_id', 'LEFT');
        $this->db->join('area_master as area', 'pd.project_area = area.id', 'LEFT');
        $this->db->join('project_user as pu', 'pu.project_id = pd.id', 'LEFT');
        $this->db->join('destination_master as destination', 'pd.project_destination = destination.id', 'LEFT');
        $query = $this->db->get('project_conceptualisation_stage');
        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }

     public function getTenderHistory($project_id)
    {

        $this->db->select("*");
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_history');
        return $query->result_array();
    }

    /*Get project list multiple End*/
    public function getProjectDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_conceptualisation_stage');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }

    public function getGroupName( $grp_id ){
        $this->db->select('name');
        $this->db->from('group_master');
        $this->db->where('id', $grp_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }
    public function getSectorName( $sec_id ){
        $this->db->select('name');
        $this->db->from('sector_master');
        $this->db->where('id', $sec_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }

    public function getProjectTypeName( $p_type_id ){
        $this->db->select('project_type');
        $this->db->from('project_type_master');
        $this->db->where('id', $p_type_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['project_type'];
    }
    public function getDestinationName( $destination_id ){
        $this->db->select('name');
        $this->db->from('destination_master');
        $this->db->where('id', $destination_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }
    public function getAreaName( $area_id ){
        $this->db->select('name');
        $this->db->from('area_master');
        $this->db->where('id', $area_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0]['name'];
    }

    public function getTenderDetails($project_id)
    {
        $this->db->select('*');
        $this->db->from('project_aggrement_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*Get work item type details*/
    public function get_work_item_categories($category_id = null)
    {
        $this->db->select('work_item_type_master.*');
        if (!empty($category_id)) {
            $this->db->where('work_item_type_master.id', $category_id);
        }
        $this->db->where('work_item_type_master.status', 'Y');
        $query = $this->db->get('work_item_type_master');
        return $query->result_array();
    }

    public function get_project_work_item($project_id)
    {
        $this->db->select('wm.id as work_item_id,wm.work_item_description as work_item_name');
        $this->db->where('project_work_items.project_id', $project_id);
        $this->db->join('work_item_master as wm', 'wm.id = project_work_items.work_item_id', 'LEFT');

        $query = $this->db->get('project_work_items');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }

    public function get_all_activity_details($project_id, $work_item_id)
    {

        $this->db->select('pa.particulars as activity_name,project_physical_planning_main.project_activity_id as activity_id,
        project_physical_planning_main.total_activity_quantity as target,project_physical_planning_main.total_activity_allotted_quantity as achived,
        project_physical_planning_main.activity_quantity_unit_id as unit_id,um.unit_name as unit_name');
        $this->db->where('project_physical_planning_main.project_id', $project_id);
        $this->db->where('project_physical_planning_main.project_work_item_id', $work_item_id);
        $this->db->join('project_activities as pa', 'pa.id = project_physical_planning_main.project_activity_id', 'LEFT');
        $this->db->join('unit_master as um', 'um.id = project_physical_planning_main.activity_quantity_unit_id', 'LEFT');

        $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }

    /* Getting project planned amount details */
    public function get_project_planned_amount_details($project_id = null, $start_date = null, $end_date = null)
    {
        $this->db->select('IFNULL(sum(target_amount),0) as total_planned_amount');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_financial_planning_detail');
        return $query->result_array();
    }

     /* Getting project released amount details */
    public function get_project_released_amount_details($project_id = null, $start_date = null, $end_date = null)
    {
        $this->db->select('IFNULL(sum(allotted_amount),0) as total_released_amount');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_financial_planning_detail');
        return $query->result_array();
    }

    /*Get project activity details*/
    public function get_project_activity_details($project_id = Null, $activity_id = Null)
    {
        $this->db->select('project_activities.*');
        $this->db->where('project_activities.project_id', $project_id);
        if (!empty($activity_id)) {
            $this->db->where('project_activities.id', $activity_id);
        }
        $this->db->where('project_activities.status', 'Y');
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }

    function get_source_of_fund_data_result($project_id){
        $this->db->select('t1.amount,t2.name as source_name');
        $this->db->from('aa_amount_breakup_details as t1');
        $this->db->join('source_of_fund_master as t2', 't1.source_of_fund_id = t2.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    /*Get project activity financial details*/
    public function get_project_activity_financial_details($project_id, $activity_id)
    {
        $this->db->select('project_financial_planning_main.*');
        $this->db->where('project_financial_planning_main.project_id', $project_id);
        $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
        $this->db->where('project_financial_planning_main.status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }

    /* Get project work item details */
    public function get_project_work_items($project_id)
    {
        $this->db->select('pwi.project_id, pwi.work_item_id, pwi.total_quantity as work_item_total_quantity, pwi.amount as work_item_amount, wim.work_item_description, wim.type_id as work_item_type_id');
        $this->db->from('project_work_items as pwi');
       
        $this->db->where('pwi.project_id', $project_id);
      
        $this->db->where('pwi.status', 'Y');
        
        $this->db->join('work_item_master as wim', 'pwi.work_item_id = wim.id', 'LEFT');
        $query = $this->db->get();
        // echo  $this->db->last_query(); die();
        return $query->result_array();
    }

    public function get_physical_activity_main($project_id, $work_item_id)
    {

        $this->db->select('pppm.project_activity_id,pppm.total_activity_quantity,pppm.total_activity_allotted_quantity, pa.particulars as activity_name');
        $this->db->from('project_physical_planning_main as pppm');
        if (!empty($project_id)) {
            $this->db->where('pppm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pppm.project_work_item_id', $work_item_id);
        }
        $this->db->where('pppm.status', 'Y');
        $this->db->join('project_activities as pa', 'pppm.project_activity_id = pa.id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_financial_activity_details($project_id, $work_item_id, $project_activity_id)
    {
        //echo "project_id: ".$project_id;echo "<br>work_item_id: ".$work_item_id; die();
        $this->db->select('IFNULL(SUM(target_amount),0) as total_planned, IFNULL(SUM(allotted_amount),0) as total_released');
        $this->db->from('project_financial_planning_detail');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('project_work_item_id', $work_item_id);
        }
        if (!empty($project_activity_id)) {
            $this->db->where('project_activity_id', $project_activity_id);
        }
       
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_physical_activity_details($project_id, $work_item_id, $project_activity_id)
    {

        $this->db->select('IFNULL(SUM(target_quantity),0) as total_planned, IFNULL(SUM(allotted_quantity),0) as total_released');
        $this->db->from('project_physical_planning_detail');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('project_work_item_id', $work_item_id);
        }
        if (!empty($project_activity_id)) {
            $this->db->where('project_activity_id', $project_activity_id);
        }
        
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

     public function get_physical_activity_unit_details($project_id, $work_item_id, $project_activity_id)
    {

        $this->db->select('pppm.activity_quantity_unit_id, um.unit_name');
        $this->db->from('project_physical_planning_main as pppm');
        if (!empty($project_id)) {
            $this->db->where('pppm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pppm.project_work_item_id', $work_item_id);
        }
        if (!empty($project_activity_id)) {
            $this->db->where('pppm.project_activity_id', $project_activity_id);
        }
        $this->db->join('unit_master as um', 'pppm.activity_quantity_unit_id = um.id', 'LEFT');
        $query = $this->db->get();
        return $query->result_array();
    }

     function get_reported_date($project_id,$work_item_id,$activity_id){
        $this->db->select('timestamp');
        $this->db->from('project_progress_update_log_details_triggering');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_work_item_id', $work_item_id);
        $this->db->where('project_activity_id', $activity_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['timestamp'];
        } 
    }

    public function get_report_work_target_date($project_id,$project_activity_id,$work_item_id){
        $this->db->select('month_date');
        $this->db->from('project_physical_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_activity_id', $project_activity_id);
        $this->db->where('project_work_item_id', $work_item_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['month_date'];
        }
   }

   /*get Specific field data*/
   function getSpecificdata($table,$field,$get_id,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field, $get_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
   }

    /*Insart data to the database common function*/
    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

    /*Check Field value exist or not in specific table*/
    function check_field_value_exist_or_not_in_tbl($tbl,$field,$value){
      $this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

     /*Fetch Single data from the database common function*/
    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	
	   public function milestone_project_data($project_id)
    {

        $this->db->select("*");
        $this->db->where('project_id', $project_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_milestone');
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
	   public function get_project_milestone_activity($milestone_id,$project_id)
    {

        $this->db->select("*");
        $this->db->where('milstone_id', $milestone_id);
        $this->db->where('project_id', $project_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_activities');
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
	 public function project_milestone_activity($milestone_id,$activity_id,$project_id)
    {
       /*$this->db->select('pu.*');
        $this->db->from('project_progress_update_log_details_actioned as pu');
        $this->db->where('pu.project_id', $project_id);
        $this->db->where('pu.project_work_item_id', $milestone_id);
        $this->db->where('pu.project_activity_id', $activity_id);
        $query = $this->db->get();*/
	 $sql = "SELECT a.* FROM project_progress_update_log_triggering a WHERE id =(select max(log_id) from project_progress_update_log_details_actioned where project_id=".$project_id." AND project_work_item_id=".$milestone_id." AND project_activity_id=".$activity_id."  group by log_id ORDER BY id DESC LIMIT 0,1)";
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();
				
       
    }

    /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }
	
	


}