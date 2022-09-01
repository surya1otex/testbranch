<?php

class Tenderreport_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

	
//get role details
    public function login_roledata($role_id) {
      $this->db->select('*');
      $this->db->where('role_master.id', $role_id);
      $this->db->where('role_master.status', 'Y');
      $this->db->limit('1');
      $query = $this->db->get('role_master');
      return $query->result_array();
    }	
//get user details	
	function get_user_details($userId){

        $this->db->select('organization_user_details.*,user_designation_master.designation');
        $this->db->from('organization_user_details');
        $this->db->join('user', 'user.id = organization_user_details.user_id','left');
        $this->db->join('user_designation_master', 'user_designation_master.id = organization_user_details.designation_id','left');
        $this->db->where('user.id', $userId);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result;
    }
	
	  
	     public function get_peoject_pending_data($user_id)
    {
        $query = $this->db->query(" select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type from project_conceptualisation_stage left join (
 SELECT id as project_id,approve_status, 'Project Conceptualisation' as stage,'1' as stage_id FROM project_conceptualisation_stage WHERE approve_status='N' UNION 
 SELECT project_id,approve_status, 'Project Preparation' as stage,'2' as stage_id FROM project_preparation_stage WHERE approve_status='N' UNION 
 SELECT project_id,approve_status, 'Project Pre Tender' as stage,'3' as stage_id FROM project_pre_tender_stage WHERE approve_status='N' UNION 
 SELECT project_id,approve_status, 'Project Tender' as stage,'4' as stage_id FROM project_tender_stage WHERE approve_status='N' UNION 
 SELECT project_id,approve_status, 'Project Aggrement' as stage,'5' as stage_id FROM project_aggrement_stage WHERE approve_status='N') all_project ON all_project.project_id=id LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.project_area LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type WHERE all_project.approve_status='N' and project_conceptualisation_stage.approver_id=".$user_id." ");
        //echo  $this->db->last_query(); die();
        $result = $query->result();
        return $result;
    }
	
	
    /*Get project indivisual details*/
    public function get_project_data($project_id = Null)
    {
				
        $this->db->select('pd.*,area.name as area_name,dest.name as dest_name,sector.name as sector_name,typeP.project_type as ptype_name,group.name as groupName,orgapprover.firstname,orgapprover.lastname');
        $this->db->from('project_conceptualisation_stage as pd');
        $this->db->where('pd.id', $project_id);
        $this->db->join('area_master as area', 'pd.location_id = area.id', 'LEFT');
        $this->db->join('destination_master as dest', 'pd.project_destination = dest.id', 'LEFT');
        $this->db->join('sector_master as sector', 'pd.project_sector = sector.id', 'LEFT');
        $this->db->join('project_type_master as typeP', 'pd.project_type = typeP.id', 'LEFT');
        $this->db->join('group_master as group', 'pd.project_group = group.id', 'LEFT');
        $this->db->join('organization_user_details as orgapprover', 'pd.approver_id = orgapprover.user_id', 'LEFT');
        //$this->db->join('project_user as pu', 'pu.project_id = pd.id', 'LEFT');
        $this->db->join('destination_master as destination', 'pd.project_destination = destination.id', 'LEFT');
       $query = $this->db->get();
       //echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
    public function project_data_preparation($project_id = Null)
    {
        $this->db->select('ps.*,orgapprover.*');
        $this->db->from('project_preparation_stage as ps');
        $this->db->join('organization_user_details as orgapprover', 'ps.project_approver_id = orgapprover.user_id', 'LEFT');
        $this->db->where('ps.project_id', $project_id);
        $query = $this->db->get();
       	return $query->result_array();
				
       
    }
    public function preparation_project_user_information($project_id)
    {
        $this->db->select('pu.*,designation.*,orgapprover.*');
        $this->db->from('project_user as pu');
        $this->db->join('user_designation_master as designation', 'pu.designation_id = designation.id', 'LEFT');
        $this->db->join('organization_user_details as orgapprover', 'pu.user_id = orgapprover.user_id', 'LEFT');
        $this->db->where('pu.project_id', $project_id);
        $query = $this->db->get();
		//echo  $this->db->last_query(); die();
       	return $query->result_array();
				
       
    }
    public function preparation_sof($project_id)
    {
        $this->db->select('pu.*,sof.name as sof_name');
        $this->db->from('aa_amount_breakup_details as pu');
        $this->db->join('source_of_fund_master as sof', 'pu.source_of_fund_id = sof.id', 'LEFT');
        $this->db->where('pu.project_id', $project_id);
        $query = $this->db->get();
		//echo  $this->db->last_query(); die();
       	return $query->result_array();
				
       
    }
	
	
    public function pretender_project_data($project_id = Null)
    {
        $this->db->select('ps.*');
        $this->db->from('project_pre_tender_stage as ps');
        $this->db->where('ps.project_id', $project_id);
        $query = $this->db->get();
       	return $query->result_array();
				
    
    }
    public function tender_project_data($project_id = Null)
    {
        $this->db->select('ps.*');
        $this->db->from('project_tender_stage as ps');
        $this->db->where('ps.project_id', $project_id);
        $query = $this->db->get();
       	return $query->result_array();
				
       
    }
    public function agreement_project_data($project_id = Null)
    {
        $this->db->select('ps.*,orgapprover.*');
        $this->db->from('project_aggrement_stage as ps');
        $this->db->join('organization_user_details as orgapprover', 'ps.planning_incharge_user_id = orgapprover.user_id', 'LEFT');
        $this->db->where('ps.project_id', $project_id);
        $this->db->where('ps.approve_status', 'Y');
        $query = $this->db->get();
       	return $query->result_array();
				
       
    }
	
	
    public function getTenderHistory($project_id)
    {

        $this->db->select("*");
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_history');
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
    public function commissioning_project_data($project_id)
    {

        $this->db->select("*");
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_completed_history');
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
	
    function get_project_approved_log_data($project_id){
        $this -> db -> select('log_id');
        $this -> db -> from('project_progress_update_log_details_triggering');
        $this -> db -> where('project_id', $project_id);
        $this->db->group_by('log_id');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function fetch_project_images_data($project_id,$log_id){
        $this -> db -> select('image_path');
        $this -> db -> from('project_progress_update_images_triggering');
        $this -> db -> where('project_id', $project_id);
        $this -> db -> where('log_id', $log_id);
        $query = $this -> db -> get();
		//echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
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
    /*Get project area End*/
	
	 public function project_destination($destination_id)
    {
        $this->db->select('name');
        $this->db->where('id', $destination_id);
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
	
	
    public function get_project_progress_activity($milestone_id,$activity_id,$project_id)
    {
       $this->db->select('pu.*');
        $this->db->from('project_progress_update_log_details_actioned as pu');
        $this->db->where('pu.project_id', $project_id);
        $this->db->where('pu.project_work_item_id', $milestone_id);
        $this->db->where('pu.project_activity_id', $activity_id);
        $query = $this->db->get();
		 /*$this->db->select('pu.*');
        $this->db->from('project_progress_update_log_details_actioned as pu');
        $this->db->where('pu.project_id', $project_id);
        $this->db->where('pu.project_work_item_id', $milestone_id);
        $this->db->where('pu.project_activity_id', $activity_id);
        $this->db->group_by('pu.log_id');
        $this->db->order_by('pu.id ', 'DESC');
        $query = $this->db->get();*/
		//echo  $this->db->last_query(); //die();
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
	
    public function get_last_reported_date($activity_log_id)
    {
        $this->db->select('pu.*');
        $this->db->from('project_progress_update_log_triggering as pu');
        $this->db->where('pu.id', $activity_log_id);
        $query = $this->db->get();
		//echo  $this->db->last_query(); //die();
       	return $query->result_array();
				
       
    }
	
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
   
       function get_vendor_data($project_id){

        $this->db->select('vendor_master.vendor,project_invoice.vendor_id');
        $this->db->from('project_invoice');
        $this->db->join('vendor_master ', 'vendor_master.id = project_invoice.vendor_id','left');
           
        $this->db->where('project_invoice.project_id ', $project_id);
        $this->db->order_by('vendor_master.vendor', 'DESC');
        $this->db->group_by('vendor_master.id');
        $query = $this->db->get();
		
		//echo  $this->db->last_query(); //die();
        return $query->result_array();
    }
	
	  public function get_invoice_data($project_id,$vendor_id)
    {
       
            $condition = "";   
            
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.amount) as claimed_amnt
    FROM `project_invoice` a
    left join project_invoice_details b on b.invoice_id=a.id
    WHERE a.vendor_id='".$vendor_id."' AND a.project_id='".$project_id."' $condition GROUP BY b.invoice_id");
        $result = $query->result_array();
        return $result;
 
    }
	
	   public function get_invoicereleased_data($project_id,$vendor_id){
        $condition = "";   
       
 
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.paid_amount) as released_amnt
    FROM `project_invoice` a
    left join project_invoice_payment_history b on b.invoice_id=a.id
    WHERE a.vendor_id='".$vendor_id."' AND a.project_id='".$project_id."' $condition GROUP BY b.invoice_id");
        $result = $query->result_array();
        return $result;
    }
	
	  public function get_financial_data($project_id){
        $query = $this->db->query("SELECT 
       SUM(claimed) as claimed,
       SUM(released) as released,
       period FROM ( SELECT a.id,a.invoice_date,DATE_FORMAT(b.payment_date, '%Y-%m') as period, IFNULL(SUM(b.paid_amount), 0) AS released, 0 as claimed
    FROM `project_invoice` a
    join project_invoice_payment_history b on b.invoice_id=a.id 
    WHERE a.project_id='".$project_id."' $condition GROUP BY DATE_FORMAT(b.payment_date, '%Y-%m') 
    UNION ALL 
    SELECT c.id,c.invoice_date,DATE_FORMAT(c.invoice_date, '%Y-%m') as period, 0 as released, IFNULL(SUM(d.amount), 0) AS claimed
    FROM `project_invoice` c
    left join project_invoice_details d on d.invoice_id=c.id 
    
    WHERE c.project_id='".$project_id."' $conditionN GROUP BY DATE_FORMAT(c.invoice_date, '%Y-%m')) 
    A
GROUP by period");
       // echo  $this->db->last_query(); die();
        $result = $query->result_array();
        return $result;
    }
	
	   public function get_project_milestone_activitySUM($milestone_id,$project_id)
    {

        $this->db->select("SUM(project_activities.weightage) as Aweightage");
        $this->db->where('milstone_id', $milestone_id);
        $this->db->where('project_id', $project_id);
        $this->db->where('completion_status', 'Y');
        $query = $this->db->get('project_activities');
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
	
	     public function get_peoject_dashboard_data($user_id)
    {
        $query = $this->db->query(" select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type from project_conceptualisation_stage left join (
 SELECT project_id,approve_status, 'Project Aggrement' as stage,'5' as stage_id FROM project_aggrement_stage WHERE approve_status='y') all_project ON all_project.project_id=id LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.project_area LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type WHERE all_project.approve_status='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");
       //echo  $this->db->last_query(); die();
        $result = $query->result();
        return $result;
    }


    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

	    /*Get work item type details*/
    public function get_work_item_categories($category_id = null)
    {
        $this->db->select('work_item_type_master.*');
        if (!empty($category_id)) {
            $this->db->where('work_item_type_master.id', $category_id);
        }        $this->db->where('work_item_type_master.status', 'Y');
        $query = $this->db->get('work_item_type_master');
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

    /* Get project work item details */
    public function get_project_work_items($project_id = null, $work_item_type_id = null)
    {
        $this->db->select('pwi.project_id, pwi.work_item_id, pwi.total_quantity as work_item_total_quantity, pwi.amount as work_item_amount, wim.work_item_description, wim.type_id as work_item_type_id');
        $this->db->from('project_work_items as pwi');
        if (!empty($project_id)) {
            $this->db->where('pwi.project_id', $project_id);
        }
        $this->db->where('pwi.status', 'Y');
        if (!empty($work_item_type_id)) {
        $this->db->where('wim.type_id', $work_item_type_id);
        }
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
        $this->db->join('project_pf_activities as pa', 'pppm.project_activity_id = pa.id', 'LEFT');
        $query = $this->db->get();
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }
	
	   public function get_financial_activity_details($project_id, $work_item_id, $project_activity_id, $start_date, $end_date)
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
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get();
		//echo  $this->db->last_query(); die();
        return $query->result_array();
    }


    public function get_physical_activity_details($project_id, $work_item_id, $project_activity_id, $start_date, $end_date)
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
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get();
		//echo  $this->db->last_query(); die();
        return $query->result_array();
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
		//echo  $this->db->last_query(); die();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['month_date'];
        }
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
        $this->db->join('project_pf_activities as pa', 'pa.id = project_physical_planning_main.project_activity_id', 'LEFT');
        $this->db->join('unit_master as um', 'um.id = project_physical_planning_main.activity_quantity_unit_id', 'LEFT');

        $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }


    public function get_all_activity_details_new($project_id, $work_item_id)
    {

        $query = $this->db->query(" SELECT
            project_activity_id,
            pa_name,
            targetTotal,
            achievedTotal,
            tilltargetTotal,
            round(tilltargetTotal/targetTotal*100,2) as TargetTillDatePercentage,
            if(achievedTotal/tilltargetTotal*100>100, 100, round(achievedTotal/tilltargetTotal*100,2)) as ActivityAchievedTillDatePercentage,
            round(achievedTotal/targetTotal*100,2) as AchievedOverallPercentage  
            FROM
            (
                    SELECT
                        main.project_work_item_id,
                        main.project_activity_id,
                        main.pa_name,
                        SUM(main.target) as targetTotal,
                        SUM(main.achieved) as achievedTotal,
                        SUM(main.tilltarget) as tilltargetTotal
                        FROM
                            ( SELECT a.id,a.project_id,
                                    a.project_work_item_id,
                                    a.project_activity_id,
                                    pa.particulars as pa_name,
                                    a.total_activity_quantity as target,
                                    a.total_activity_allotted_quantity as achieved,
                                    SUM(b.target_quantity) as tilltarget
                             FROM `project_physical_planning_main` a
                             left join project_physical_planning_detail b
                             on b.project_physical_planning_id=a.id
                             left join project_pf_activities pa on b.project_activity_id=pa.id
                             WHERE a.project_id=".$project_id."
                             and a.project_work_item_id=".$work_item_id."
                             AND b.month_date < NOW()
                             GROUP BY b.project_physical_planning_id
                            )
                        as main
                        GROUP BY main.project_work_item_id, main.project_activity_id
            )
            as summary
            GROUP BY project_activity_id");
       // echo  $this->db->last_query(); die();
        $result = $query->result_array();
        return $result;
    }
	
	    public function get_unit_name($project_id, $activity_id)
    {

        $this->db->select('um.unit_name as name');

        $this->db->where('project_physical_planning_detail.project_id', $project_id);
        $this->db->where('project_physical_planning_detail.project_activity_id', $activity_id);

        $this->db->join('unit_master as um', 'um.id = project_physical_planning_detail.unit_id', 'LEFT');
        $query = $this->db->get('project_physical_planning_detail');
        //echo $this->db->last_query(); die;
        return $query->result_array();

    }
	
	
    public function get_physical_progress_monthly($project_id, $activity_id = 0, $start_date = '', $end_date = '',$work_item_id = 0)
    {
        $this->db->select('month_name, month_date,unit_id, IFNULL(target_quantity, 0) AS total_budget_monthly, IFNULL(allotted_quantity, 0) AS total_allotted_monthly');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($activity_id)) {
            $this->db->where('project_activity_id', $activity_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('project_work_item_id', $work_item_id);
        }
        if (!empty($start_date)) {

            $this->db->where('year(month_date) >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }

        $this->db->group_by('month_date');
        $this->db->order_by('month_date','ASC');
       // ORDER BY `project_physical_planning_detail`.`month_date` ASC
        $query = $this->db->get('project_physical_planning_detail');

        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }
   public function unit_name_data($unit_id)
    {

        $this->db->select('unit_master.unit_name as name');

        $this->db->where('unit_master.id', $unit_id);
        $query = $this->db->get('unit_master');
        //echo $this->db->last_query(); die;
        return $query->result_array();

    }


    /*Start New changs for Projects Pre Construction Activities start on 27-04-2021*/
    public function project_pre_construction_settings_data($project_id = Null)
    {
        $this->db->select('*');
        $this->db->from('pre_construction_settings');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result_array();
                
       
    }


    function get_land_schedule_data($project_id){
        $this -> db -> select('t1.*,t2.district_name,t3.tahsil_name,t4.village_name');
        $this -> db -> from('pre_construction_activities_land_schedule t1');
        $this -> db ->join('district_master t2', 't2.id = t1.district_id ', 'left');
        $this -> db ->join('tahsil_master t3', 't3.id = t1.tahsil_id ', 'left');
        $this -> db ->join('village_master t4', 't4.id = t1.village_id ', 'left');
        $this -> db -> where('t1.project_id', $project_id);
        //$this -> db -> group_by('t1.district_id');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }


       /*Fetch Single data from the database common function*/
    function fetch_Pre_Construction_Activities_details_single_data($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }

    function get_pre_construction_details_location_data($tbl,$project_id,$relation_id){
        $this -> db -> select('t1.*,t2.district_name');
        $this -> db -> from($tbl.' t1');
        $this -> db ->join('district_master t2', 't2.id = t1.district_id ', 'left');
        $this -> db -> where('t1.project_id', $project_id);
        $this -> db -> where('t1.relation_id', $relation_id);
        //$this -> db -> group_by('t1.district_id');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }


    function get_specific_data_against_value($table,$field,$get_id,$specifc_field){
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

    /*Check Field value exist or not in specific table*/
    function check_pre_construction_value_exist_or_not_in_tbl($tbl,$field,$value){
      $this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }



    function get_project_steps_data($project_id){

        $query = $this->db->query(" select sum(concept) concept_status, sum(dpr) dpr_status, sum(aa) aa_status, sum(pre_construction) pre_cons_status from 
                (SELECT count(*)
                 as concept, 0 as dpr, 0 as aa, 0 as pre_construction, 0 as tender FROM `project_conceptualisation_stage` WHERE id=".$project_id."
                UNION
                SELECT 0 as concept, count(*)
                 as dpr, 0 as aa, 0 as pre_construction, 0 as tender FROM `project_dpr_stage` WHERE project_id=".$project_id."
                UNION
                SELECT 0 as concept, 0 as dpr, count(*)
                 as aa, 0 as pre_construction, 0 as tender FROM `project_administrative_approval_stage` WHERE project_id=".$project_id."
                UNION
                SELECT 0 as concept, 0 as dpr, 0 as aa, count(*)
                 as pre_construction, 0 as tender  FROM `pre_construction_settings` WHERE project_id=".$project_id."
                UNION
                SELECT 0 as concept, 0 as dpr, 0 as aa, 0 as pre_construction, count(*)
                 as tender FROM `project_tender_stage` WHERE project_id=".$project_id.") as summary");
       // echo  $this->db->last_query(); die();
        
        $return = $query->result_array();
        return $return[0];
    }



    function get_project_creation_data($proj_rel_id){
        $this->db->select('t1.id,t1.project_cost,t1.cat_id,t1.scheme_id as project_group,t1.location as location_id,t1.project_name,t2.project_type as project_type_name,t3.name as area_name,t4.name as scheme_name,t5.name as circle_name,t6.wing_name,t7.division_name');
        $this->db->from('project_creation t1');
         $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        $this -> db ->join('group_master t4', 't4.id = t1.scheme_id ', 'left');
        $this -> db ->join('sector_master t5', 't5.id = t1.circle_id ', 'left');
        $this -> db ->join('wing_master t6', 't6.id = t1.wing_id ', 'left');
        $this -> db ->join('division_master t7', 't7.id = t1.division_id ', 'left');
        $this->db->where('t1.id', $proj_rel_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }


    function get_project_creation_users($proj_rel_id){
        $this->db->select('t1.*,t2.designation,t4.firstname,t4.lastname');
        $this->db->from('project_creation_linked_user t1');
         $this -> db ->join('user_designation_master t2', 't2.id = t1.user_type_id ', 'left');
        $this -> db ->join('user t3', 't3.id = t1.user_id ', 'left');
        $this -> db ->join('organization_user_details t4', 't4.user_id = t3.id ', 'left');
        
        $this->db->where('t1.project_id', $proj_rel_id);
        $query = $this->db->get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_project_dpr_data($project_id){
        $this->db->select('t1.*,t2.designation,t4.firstname,t4.lastname');
        $this->db->from('project_dpr_stage t1');
        
        $this -> db ->join('user t3', 't3.id = t1.dpr_prepared_by_user_id ', 'left');
        $this -> db ->join('organization_user_details t4', 't4.user_id = t3.id ', 'left');

         $this -> db ->join('user_designation_master t2', 't2.id = t4.designation_id ', 'left');
        
        $this->db->where('t1.project_id', $project_id);
        $query = $this->db->get();
         $return = $query->result_array();
        return $return;
    }

    function fetchSingle_pro_result_arr_data($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        $return = $query->result_array();
        return $return;
    }

    /*End New changs for Projects Pre Construction Activities start on 27-04-2021*/
    /* Start 02/06/2021 */

    public function get_project_work_item_budget($project_id){


      $this->db->select('pwi.work_item_id, pwi.amount, pwi.status, wim.work_item_description');
      $this->db->from('project_work_items as pwi');
      
      
      $this->db->where('pwi.status', 'Y');
      $this->db->where('pwi.project_id', $project_id);
      
      
      $this->db->join('work_item_master as wim', 'pwi.work_item_id = wim.id', 'LEFT');
      $query = $this->db->get();
       //echo $this->db->last_query(); die();
      return $query->result_array(); 
    }

    public function get_project_wise_work_item_released($project_work_item_id){
      //SELECT project_work_item_id, IFNULL(SUM(total_activity_allotted_amount), 0) AS total_released FROM project_financial_planning_main WHERE project_work_item_id = 14 AND status = 'Y' GROUP BY project_work_item_id
      $this->db->select('pfpm.project_work_item_id, IFNULL(SUM(pfpm.total_activity_allotted_amount), 0) AS total_released');
      //$this->db->from('project_financial_planning_main');
      $this->db->where('pfpm.project_work_item_id', $project_work_item_id);  
      
      $this->db->where('pfpm.status', 'Y');
      
      
      $this->db->group_by('pfpm.project_work_item_id');
      $query = $this->db->get('project_financial_planning_main as pfpm');
      
      // echo $this->db->last_query(); die();
      return $query->result_array();  
    }
	
	
	// work item ACtivity wise budget
    public function get_work_item_activity_budget($project_work_item_id){


      $this->db->select('pwi.*');
      $this->db->from('project_physical_planning_main as pwi');
     
      
      $this->db->where('pwi.project_work_item_id', $project_work_item_id);
    
      $query = $this->db->get();
       //echo $this->db->last_query(); die();
      return $query->result_array(); 
    }
	
	  function project_activity_amount_data($project_id, $project_activity_id){
        $this->db->select('amount');
        $this->db->from('project_pf_activities');
        $this->db->where('id', $project_activity_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
		//echo $this->db->last_query(); die();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['amount'];
        } 
   }


   // Tendering Report

   function fetch_tendering_pre_bid_report_data($tbl, $fid, $did)
      {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }

      function get_tendering_pre_bid_bidder_report_data($project_id){

      $query = $this->db->query("select pbd.bidder_name,cm.country_name as country,pbd.first_name,pbd.middle_name,pbd.last_name,pbd.mobile_no,pbd.email_id FROM tendering_pre_bid_bidder_details AS pbd JOIN country_master AS cm ON pbd.country_id = cm.country_id WHERE pbd.project_id='".$project_id."'");

        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
        
     }

     function get_tendering_pre_bid_bidder_report_data_document($project_id){

      $query = $this->db->query("select pbd.document_name FROM tendering_pre_bid_document AS pbd WHERE pbd.project_id='".$project_id."'");


        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
        
     }

      function fetch_tendering_technical_evalution_report_data($tbl, $fid, $did)
      {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }

    function get_tendering_technical_evalution_bidder_report_data($project_id){

      $query = $this->db->query("select tteb.bidder_ref_no as biddername,tteb.technical_status as status from tendering_technical_evalution AS tte  JOIN tendering_technical_evalution_bidder_details AS tteb ON tte.project_id = tteb.project_id WHERE tte.project_id='".$project_id."'");


        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
        
    }


     function fetch_tendering_financial_evalution_report_data($tbl, $fid, $did)
      {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }

     function get_tendering_financial_evalution_bidder_report_data($project_id){

      $query = $this->db->query("select tfeb.bidder_ref_no as biddername,tfeb.bid_value as bidvalue,tfeb.successful_bidder as status,tfeb.final_score as score from tendering_financial_evalution AS tfe  JOIN tendering_financial_evalution_bidder_details AS tfeb ON tfe.project_id = tfeb.project_id WHERE tfe.project_id='".$project_id."'");


        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
        
    }


    function fetch_tendering_negotiation_report_data($tbl, $fid, $did)
      {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }


      function get_tendering_negotiation_bidder_report_data($project_id){

      $query = $this->db->query("select tfeb.bidder_ref_no as biddername,tnb.negotiation_meeting_date as meetingdate,tnb.negotiation_bid_value as bidvalue,tnb.successful_bidder_response as document,tnb.negotiation_status as status from tendering_negotiation AS tn JOIN tendering_negotiation_bidder_details AS tnb ON tn.project_id = tnb.project_id JOIN tendering_financial_evalution_bidder_details AS tfeb ON tnb.bidder_id = tfeb.id WHERE tn.project_id='".$project_id."'");


        if($query->num_rows() > 0)
        {
            $result = $query->result_array();
        }
        return $result;
        
     }

     function fetch_tendering_issue_of_loa_report_data($tbl, $fid, $did)
      {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }

     // Tendering Report End
	

}
?>