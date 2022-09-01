<?php
class Reporttender_model extends CI_Model {

	function __construct(){
		parent :: __construct();
        $this->load->database();
	}

	


	// Code bY Somnath 10-08-2020 
     /*Fetch data From the database common function*/
    function fetchAllData($tbl, $id = NULL, $tp = NULL)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this->db->order_by($id, $tp);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
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

    /*Fetch Single data from the database common function*/
    function fetchSingledata2($tbl, $fid, $did,$fid1, $did1)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $this -> db -> where($fid1, $did1);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
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
    /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }

public function get_source_fund()
    {

        $this->db->select('*');
        $query = $this->db->get('source_of_fund_master');
        return $query->result_array();

    }

    public function get_org_users(){

        $this->db->select('organization_user_details.firstname,organization_user_details.lastname,organization_user_details.user_id,
        user_designation_master.designation');



        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'LEFT');
        $query = $this->db->get('organization_user_details');
        //echo $this->db->last_query(); die;
        return $query->result_array();

    }

    public function get_project_monitoring_frequency($project_id)
    {

        $this->db->select('monitoring_frequency');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_details');
        $result = $query->result_array();
        return $result[0]['monitoring_frequency'];
    }

    public function getProjectFinancialOpeningDate($project_id)
    {

        $this->db->select('finance_bid_opening_date');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_details');
        return $query->result_array();
    }

    public function getTenderDetails($project_id)
    {
        $this->db->select('*');
        $this->db->from('tender_details');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProjectAADate($project_id)
    {
        $this->db->select('aa_date');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_detail');
        return $query->result_array();
    }

    public function getProjectRFPClosing($project_id)
    {
        $this->db->select('rfp_closing_date');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_detail');
        return $query->result_array();
    }
    public function get_project_monitoring_type( $project_id ){
        $this->db->select('type_monitoring');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_details');
        return $query->result_array();
    }

    public function get_list_planning( $user_id){

        $this->db->select('project_approval.id,project_detail.project_name, organization_user_details.firstname,organization_user_details.lastname,
        user_designation_master.designation,project_approval.approval_status');

        //$this->db->where('project_detail.status', 'N');
        $this->db->join('project_detail', 'project_approval.project_id = project_detail.id', 'LEFT');
        $this->db->join('organization_user_details', 'project_approval.approver_id = organization_user_details.user_id', 'LEFT');
        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'LEFT');
        $this->db->where('project_approval.approval_status', 'Y');
        $this->db->where('project_detail.project_creator_id', $user_id);
        $this->db->where('project_detail.status', 'Y');


        $query = $this->db->get('project_approval');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_list_approval($user_id){

        $this->db->select('project_approval.id,project_detail.project_name, organization_user_details.firstname,organization_user_details.lastname,
        user_designation_master.designation,project_approval.approval_status');

        //$this->db->where('project_detail.status', 'N');
        $this->db->join('project_detail', 'project_approval.project_id = project_detail.id', 'LEFT');
        $this->db->join('organization_user_details', 'project_approval.approver_id = organization_user_details.user_id', 'LEFT');
        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'LEFT');
        //$this->db->where('', 'P');
        $this->db->where('project_detail.project_creator_id', $user_id);
        $this->db->or_where('project_detail.approver_id', $user_id);
        $this->db->where('project_detail.status', 'Y');


        $query = $this->db->get('project_approval');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }

    /*Get project list*/
    public function get_project_details($project_id = 0,$user_id = 0, $status = "")
    {

        $this->db->select('project_detail.*,td.project_start_date as project_start_date,td.project_end_date as project_end_date,project_detail.status');
        if (!empty($project_id)) {
            $this->db->where('project_detail.id', $project_id);
        }
        
        if( $user_id > 0 ){
            $this->db->where('project_detail.project_creator_id', $user_id);

        }
        if( !empty($status)){
            $this->db->where('project_detail.status', $status);
        }
        //$this->db->where('project_detail.status', 'Y');
        $this->db->join('tender_details as td', 'td.project_id = project_detail.id', 'LEFT');
        $query = $this->db->get('project_detail');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
 
    public function get_level3_details( $user_id){
        $this->db->select('*');

        $this->db->join('organization_user_details', 'user.id = organization_user_details.user_id', 'LEFT');

        $this->db->where('user.id', $user_id);
        $query = $this->db->get('user');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_project_approval_details( $request_id ){

        $this->db->select('user.user_type,user.id ,DATE(project_approval.created_on) as date_request ');


        $this->db->join('user', 'user.id = project_approval.requester_id', 'LEFT');

        $this->db->where('project_approval.id', $request_id);
        $query = $this->db->get('project_approval');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_approval_project_id( $reuquest_id ){

        $this->db->select('project_id');
        $this->db->where('id', $reuquest_id);
        $query = $this->db->get('project_approval');
        return $query->result_array();
    }
    /*Get project list End*/
    public function getProjectInchargeDetails($project_id)
    {
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_user');
        return $query->result_array();
    }

    public function updateProjectDetails($data)
    {

        $project_id = $data['project_id'];
        unset($data['project_id']);
        $this->db->where('id', $project_id);
        return $this->db->update('project_detail', $data);
    }
    public function submit_approval($data = [],$request_id = 0 )
    {
        if ($request_id > 0) {
            $this->db->where('id', $request_id);
            return $this->db->update('project_approval', $data);
        }
    }


    public function getProjectBasicDetails($project_id, $fields_array)
    {
        $fields = implode(",", $fields_array);
        $this->db->select($fields);

        $this->db->where('id', $project_id);
        $query = $this->db->get('project_detail');
        return $query->result_array();
    }

    public function addTenderDetails($data)
    {

        $insert = $this->db->insert('tender_details', $data);
        //echo $this->db->last_query(); die;
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function get_amount_brakup($project_id)
    {
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('aa_amount_breakup_details');
        return $query->result_array();
    }

    public function insert_aa_mount_breakup($data)
    {

        $query = $this->db->query("DELETE FROM aa_amount_breakup_details WHERE project_id = '" . $data['project_id'] . "'");
        $insert = $this->db->insert('aa_amount_breakup_details', $data);

        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
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

    public function updatePreTender($data)
    {

        $project_id = $data['project_id'];
        unset($data['project_id']);
        $this->db->where('id', $project_id);
        return $this->db->update('project_detail', $data);
    }

    public function addPreTender($data)
    {

        $insert = $this->db->insert('project_detail', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function updateProjectApproval($data,$id)
    {
        $this->db->where('id', $id);
        return $this->db->update('project_approval', $data);
    }
    public function check_prev_Aprrover_id($project_id){
        $this->db->select('approver_id');
        $this->db->from('project_detail');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); //die;
        $result = $query->result_array();
        return $result;
    }
    public function addProjectApproval($data)
    {

        $insert = $this->db->insert('project_approval', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function projectApprovalLog($data)
    {

        $insert = $this->db->insert('project_approval_history', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function get_selected_approver($project_id){
        $this->db->select('*');
        $this->db->from('project_approval');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); //die;
        $result = $query->result_array();
        return $result;
    }



    public function insert_Project_users($data, $project_id = 0)
    {
        if ($project_id > 0) {
            $query = $this->db->query("DELETE FROM project_user WHERE project_id = '" . $project_id . "'");
        }
        if (!empty($data)) {

            $insert = $this->db->insert_batch('project_user', $data);
        }
    }

    public function getTenderHistory($project_id)
    {

        $this->db->select("*");
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('tender_history');
        return $query->result_array();
    }

    public function insertTenderHistory($data)
    {
        $insert = $this->db->insert('tender_history', $data);
        //echo $this->db->last_query(); die;
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function updatePretenderData($project_id, $data)
    {

        $this->db->where('id', $project_id);
        return $this->db->update('project_detail', $data);
    }

    public function updateTenderDetails($data)
    {
        $tender_id = $data['tender_id'];
        unset($data['tender_id']);

        $this->db->where('id', $tender_id);
        return $this->db->update('tender_details', $data);
        //echo $this->db->last_query(); die;

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

    public function project_destination($destination_id)
    {
        $this->db->select('name');
        $this->db->where('id', $destination_id);
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

    public function deleteTender($project_id)
    {

        /*$this->db->delete($tableName, $deleteClause);*/
        $this->db->where('project_id', $project_id);
        $this->db->delete('tender_details');

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
    /*Get project area type*/

    /*Get project tsu*/
    public function get_tsu()
    {
        $this->db->select('tsu_master.*');
        $this->db->where('tsu_master.status', 'Y');
        $query = $this->db->get('tsu_master');
        return $query->result_array();
    }
    /*Get project tsu End*/

    /*Get project designing supervisor*/
    public function get_designing_supervisor_master()
    {
        $this->db->select('designing_supervisor_master.*');
        $this->db->where('designing_supervisor_master.status', 'Y');
        $query = $this->db->get('designing_supervisor_master');
        return $query->result_array();
    }
    /*Get project designing supervisor End*/

    /*Get project designing agency master*/
    public function get_agency_master()
    {
        $this->db->select('agency_master.*');
        $this->db->where('agency_master.status', 'Y');
        $query = $this->db->get('agency_master');
        return $query->result_array();
    }
    /*Get project designing agency master End*/

    /*Get ngo master*/
    public function get_ngo_master()
    {
        $this->db->select('ngo_master.*');
        $this->db->where('ngo_master.status', 'Y');
        $query = $this->db->get('ngo_master');
        return $query->result_array();
    }
    /*Get ngo master End*/


    /*Get count project revised end date*/
    /*public function get_count_revised_end_date($project_id) {
      $this->db->select('count(*) as revised_count');
      $this->db->where('project_end_date_revision.project_id', $project_id);
      $query = $this->db->get('project_end_date_revision');
      return $query->result_array();
    }*/
    /*Get count project revised end date End*/

    /*Get project other setting details list*/
    public function get_project_other_setting_list($project_id = Null, $other_setting_id = Null)
    {
        $this->db->select('project_other_charges.*');
        $this->db->where('project_other_charges.project_id', $project_id);
        if (!empty($other_setting_id)) {
            $this->db->where('project_other_charges.id', $other_setting_id);
        }
        $query = $this->db->get('project_other_charges');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    /*Get project other setting details list End*/

    /*Get project other setting details*/
    public function get_project_other_setting_details($project_id = Null, $other_setting_id = Null)
    {
        $this->db->select('project_other_charges.*');
        $this->db->where('project_other_charges.project_id', $project_id);
        if (!empty($other_setting_id)) {
            $this->db->where('project_other_charges.id', $other_setting_id);
        }
        $this->db->where('project_other_charges.status', 'Y');
        $query = $this->db->get('project_other_charges');
        return $query->result_array();
    }
    /*Get project other setting details End*/

    /*Get project activity list*/
    public function get_project_activity_list($project_id = Null, $activity_id = Null)
    {
        $this->db->select('project_activities.*');
        $this->db->where('project_activities.project_id', $project_id);
        if (!empty($activity_id)) {
            $this->db->where('project_activities.id', $activity_id);
        }
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
    /*Get project activity details list*/

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
    /*Get project activity details End*/


    /*Get project activity wise financial planning details*/
    public function project_activity_wise_financial_planning_main($project_id, $activity_id)
    {
        $this->db->select('project_financial_planning_main.*');
        $this->db->where('project_financial_planning_main.project_id', $project_id);
        $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
        $this->db->where('project_financial_planning_main.status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /*Get project activity wise financial planning details End*/

    /*Get project activity wise physical planning details*/
    public function project_activity_wise_physical_planning_detail($project_id, $activity_id)
    {
        $this->db->select('project_physical_planning_main.*');
        $this->db->where('project_physical_planning_main.project_id', $project_id);
        $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);
        $this->db->where('project_physical_planning_main.status', 'Y');
        $query = $this->db->get('project_physical_planning_main');
        return $query->result_array();
    }
    /*Get project activity wise physical planning details End*/

    /*Get project planned amount*/
    public function get_planned_amount_data($project_id, $project_activity_id)
    {
        $this->db->select('sum(project_financial_planning_detail.target_amount) as planned_amnt');
        $this->db->where('project_financial_planning_detail.project_id', $project_id);
        $this->db->where('project_financial_planning_detail.project_activity_id', $project_activity_id);
        $this->db->where('project_financial_planning_detail.status', 'Y');
        $query = $this->db->get('project_financial_planning_detail');
        return $query->result_array();
    }
    /*Get project planned amount End*/

    /*Get project activity wise total amt*/
    public function get_project_wise_total_activity_amt($project_id)
    {
        $this->db->select('sum(project_activities.amount) as total_amount');
        $this->db->where('project_activities.project_id', $project_id);
        $this->db->where('project_activities.status', 'Y');
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
    /*Get project activity wise total amt End*/

    /*Get project activity wise total planned amt*/
    public function get_project_wise_total_activity_planned_amt($project_id)
    {
        $this->db->select('sum(project_financial_planning_main.total_activity_budget_amount)
        as total_planned_amount');
        $this->db->where('project_financial_planning_main.project_id', $project_id);
        $this->db->where('project_financial_planning_main.status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /*Get project activity wise total planned amt End*/

    /*Get project work item list*/
    public function get_work_item_list($work_item_id = Null)
    {

        $this->db->select('work_item_master.*');
        if (!empty($work_item_id)) {
            $this->db->where('work_item_master.id', $work_item_id);
        }
        $this->db->where('work_item_master.status', 'Y');
        $query = $this->db->get('work_item_master');

        return $query->result_array();
    }
    /*Get project work item list End*/

    /*Get project work item details*/
    public function get_project_work_item_details($project_id)
    {
        $this->db->select('project_work_items.*');
        $this->db->where('project_work_items.status', 'Y');
        $this->db->where('project_work_items.project_id', $project_id);
        $query = $this->db->get('project_work_items');
        return $query->result_array();
    }
    /*Get project work item details End*/

    /*Get project work item physical target*/
    public function get_work_item_physical_target($project_id, $work_item_id)
    {
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
    public function get_work_item_financial_planned_amount($project_id, $work_item_id)
    {
        $this->db->select('sum(project_financial_planning_detail.target_amount) as target_amount');
        $this->db->where('project_financial_planning_detail.status', 'Y');
        $this->db->where('project_financial_planning_detail.project_id', $project_id);
        $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
        $query = $this->db->get('project_financial_planning_detail');
        return $query->result_array();
    }
    /*Get project work item financial planned amount End*/

    /*Get project work item financial planned amount with workitem and activity wise*/
    public function get_work_item_financial_planned_amount_with_workitem_activity($project_id, $work_item_id, $project_activity_id)
    {
        $this->db->select('sum(project_financial_planning_detail.target_amount) as target_amount');
        $this->db->where('project_financial_planning_detail.status', 'Y');
        $this->db->where('project_financial_planning_detail.project_id', $project_id);
        $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
        $this->db->where('project_financial_planning_detail.project_activity_id', $project_activity_id);
        $query = $this->db->get('project_financial_planning_detail');
        return $query->result_array();
    }
    /*Get project work item financial planned amount with workitem and activity wise End*/

    /*Financial Budget Amount*/
    public function get_financial_budget_data($project_id, $work_item_id)
    {
        $this->db->select('project_work_items.*');
        $this->db->where('project_work_items.project_id', $project_id);
        $this->db->where('project_work_items.work_item_id', $work_item_id);
        $this->db->where('project_work_items.status', 'Y');
        $query = $this->db->get('project_work_items');
        return $query->result_array();
    }
    /*Financial Budget Amount End*/

    /*Get project financial details*/
    public function get_project_financial_details($project_id, $work_item_id = Null, $activity_id = Null)
    {
        $this->db->select('project_financial_planning_main.*');
        $this->db->where('project_financial_planning_main.project_id', $project_id);
        $this->db->where('project_financial_planning_main.project_work_item_id', $work_item_id);
        $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
        $this->db->where('project_financial_planning_main.status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /*Get project financial details End*/

    /*Get project activity name*/
    public function project_activity_name($activity_id)
    {
        $this->db->select('project_activities.*');
        $this->db->where('project_activities.id', $activity_id);
        $this->db->where('project_activities.status', 'Y');
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
    /*Get project activity name End*/

    /*Get project financial planning details*/
    public function project_financial_planning_detail($project_id, $work_item_id, $activity_id)
    {
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
    public function get_work_item_type_master($work_item_type_master_id = Null)
    {
        $this->db->select('work_item_type_master.*');
        if (!empty($work_item_type_master_id)) {
            $this->db->where('work_item_type_master.id', $work_item_type_master_id);
        }
        $this->db->where('work_item_type_master.status', 'Y');
        $query = $this->db->get('work_item_type_master');
        //echo $this->db->last_query();
        return $query->result_array();
    }
    /*Get work item type master details End*/

    /*Get project physical details*/
    public function get_project_physical_details($project_id, $work_item_id, $activity_id)
    {
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
    public function project_physical_planning_detail($project_id, $work_item_id, $activity_id)
    {
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
    public function project_physical_planning_main($project_id, $work_item_id, $activity_id)
    {
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

    /*Get project physical details*/
    public function get_unit_detail($unit_id = null)
    {
        $this->db->select('unit_master.*');
        if (!empty($unit_id)) {
            $this->db->where('unit_master.id', $unit_id);
        }
        $this->db->where('unit_master.status', 'Y');
        $query = $this->db->get('unit_master');
        return $query->result_array();
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
    /*Get project physical details End*/

    /*Get no of activities*/
    public function total_no_activity_with_respect_project($project_id)
    {
        $this->db->select('count(*) as activity_count');
        $this->db->where('project_activities.project_id', $project_id);
        $this->db->where('project_activities.status', 'Y');
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
    /*Get no of activities End*/

    /*Get no of activities*/
    public function total_no_work_item_with_respect_project($project_id)
    {
        $this->db->select('count(*) as work_item_count');
        $this->db->where('project_work_items.project_id', $project_id);
        $this->db->where('project_work_items.status', 'Y');
        $query = $this->db->get('project_work_items');
        return $query->result_array();
    }
    /*Get no of activities End*/

    /*Get no of physical planned activities*/
    public function no_of_physical_planned_activity_with_respect_project($project_id)
    {
        $this->db->select('count(*) as planned_physical_activity_count');
        $this->db->where('project_physical_planning_main.project_id', $project_id);
        $this->db->where('project_physical_planning_main.status', 'Y');
        $query = $this->db->get('project_physical_planning_main');
        return $query->result_array();
    }
    /*Get no of physical planned activities End */

    /*Get no of financial planned activities*/
    public function no_of_financial_planned_activity_with_respect_project($project_id)
    {
        $this->db->select('count(*) as planned_financial_activity_count');
        $this->db->where('project_financial_planning_main.project_id', $project_id);
        $this->db->where('project_financial_planning_main.status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /*Get no of financial planned activities End */

    /*Add project*/
    function add($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    /*Add project End*/

    /*For Any Update Query*/
    function updateDataCondition($tableName, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($tableName, $data);
        //echo $this->db->last_query().'<br><br>';
        return TRUE;
    }
    /*For Any Update Query End*/

    /*delete for all*/
    function deleteRecord($tableName, $deleteClause)
    {
        $this->db->delete($tableName, $deleteClause);
    }

    /*delete for all End*/
    public function get_custom_project_monitoring_details($project_id, $project_work_item_id, $project_activity_id, $project_physical_id)
    {

        $this->db->select('*');
        $this->db->where('project_physical_planning_detail.project_id', $project_id);
        $this->db->where('project_physical_planning_detail.project_work_item_id', $project_work_item_id);
        $this->db->where('project_physical_planning_detail.project_activity_id', $project_activity_id);
        $this->db->where('project_physical_planning_detail.project_physical_planning_id ', $project_physical_id);
        $query = $this->db->get('project_physical_planning_detail');
        //echo $this->db->last_query().'<br><br>';
        return $query->result_array();
    }

    public function get_physical_plan_details($project_id, $work_item_id, $activity_id)
    {
        $this->db->select('id');
        $this->db->where('project_physical_planning_main.project_id', $project_id);
        $this->db->where('project_physical_planning_main.project_work_item_id', $work_item_id);
        $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);

        $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result[0]['id'];
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

    public function get_taget_till_date($project_id, $work_item_id, $activity_id)
    {

        $this->db->select('SUM(`target_quantity`) AS TagetTillDate');
        $this->db->where('project_physical_planning_detail.project_work_item_id', $work_item_id);
        $this->db->where('project_physical_planning_detail.project_id', $project_id);
        $this->db->where('project_physical_planning_detail.project_activity_id', $activity_id);
        $this->db->where('project_physical_planning_detail.month_date <=', date('Y-m-d'));

        $query = $this->db->get('project_physical_planning_detail');
        //echo $this->db->last_query().'<br><br>'; die;
        return $query->result_array();

    }

    public function get_achive_till_date($project_id, $work_item_id, $activity_id)
    {

        $this->db->select('SUM(`allotted_quantity`) AS AchvedTillDate ');
        $this->db->where('project_physical_planning_detail.project_work_item_id', $work_item_id);
        $this->db->where('project_physical_planning_detail.project_id', $project_id);
        $this->db->where('project_physical_planning_detail.project_activity_id', $activity_id);
        $this->db->where('project_physical_planning_detail.month_date <=', date('Y-m-d'));

        $query = $this->db->get('project_physical_planning_detail');
        //echo $this->db->last_query().'<br><br>'; die;
        return $query->result_array();

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



    public function get_project_users($project_id)
    {
        $this->db->select('oud.firstname as firstname ,oud.lastname as lastname,oud.email as email ,udm.designation as designation');
        /*$this->db->from('project_user as pu');*/

        $this->db->join('organization_user_details as oud', 'project_user.user_id = oud.id', 'LEFT');
        $this->db->join('user_designation_master as udm', 'project_user.designation_id = udm.id', 'LEFT');
        $this->db->where('project_user.project_id', $project_id);
        $this->db->where('project_user.status', 'Y');
        $query = $this->db->get('project_user');
        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }
    /*#END Get project indivisual details*/

    /* Getting project released amount */
    public function get_project_released_amount($project_id = null)
    {
        $this->db->select('sum(total_activity_allotted_amount) as total_released_amount');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /* #END Getting project released amount */

    /* Getting project planned amount */
    public function get_project_planned_amount($project_id = null)
    {
        $this->db->select('sum(total_activity_budget_amount) as total_planned_amount');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get('project_financial_planning_main');
        return $query->result_array();
    }
    /* #END Getting project planned amount */

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
    /* #END Get project activity financial details*/

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
    /* #END Getting project released amount details */

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
    /* #END Getting project planned amount details */

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
    /*#END Get work item type */

    /* Get project work item details */
    public function get_project_work_items($project_id)
    {
        $this->db->select('pwi.project_id, pwi.work_item_id, pwi.total_quantity as work_item_total_quantity, pwi.amount as work_item_amount, wim.work_item_description, wim.type_id as work_item_type_id');
        $this->db->from('project_work_items as pwi');
      
        $this->db->where('pwi.project_id', $project_id);
        
        $this->db->where('pwi.status', 'Y');
        //$this->db->where('wim.type_id', $work_item_type_id);
        $this->db->join('work_item_master as wim', 'pwi.work_item_id = wim.id', 'LEFT');
        $query = $this->db->get();
        // echo  $this->db->last_query(); die();
        return $query->result_array();
    }

    /* #END# Get project work item details */

    public function get_financial_activity_main($project_id, $work_item_id)
    {

        $this->db->select('pfpm.project_activity_id, pa.particulars as activity_name');
        $this->db->from('project_financial_planning_main as pfpm');
        if (!empty($project_id)) {
            $this->db->where('pfpm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pfpm.project_work_item_id', $work_item_id);
        }
        $this->db->where('pfpm.status', 'Y');
        $this->db->join('project_activities as pa', 'pfpm.project_activity_id = pa.id', 'LEFT');
        $query = $this->db->get();
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

    public function get_financial_progress_monthly($project_id, $start_date, $end_date)
    {
        $this->db->select('month_name, month_date, IFNULL(SUM(target_amount), 0) AS total_budget_monthly, IFNULL(SUM(allotted_amount), 0) AS total_allotted_monthly');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $project_id);
        }

        $this->db->group_by('month_name');
        $query = $this->db->get('project_financial_planning_detail');
        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }

    public function get_physical_progress_monthly($project_id, $activity_id = 0, $start_date = '', $end_date = '')
    {
        $this->db->select('month_name, month_date, IFNULL(SUM(target_quantity), 0) AS total_budget_monthly, IFNULL(SUM(allotted_quantity ), 0) AS total_allotted_monthly');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($activity_id)) {
            $this->db->where('project_activity_id', $activity_id);
        }
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $project_id);
        }

        $this->db->group_by('month_name');
        $query = $this->db->get('project_physical_planning_detail');
        //echo  $this->db->last_query(); die();
        return $query->result_array();
    }


    /*Get project list multiple*/
    public function getProjectDetailsMultiple($project_ids)
    {
        $this->db->select('project_detail.*');
        if (!empty($project_ids)) {
            $this->db->where_in('project_detail.id', $project_ids);
        }
        $this->db->where('project_detail.status', 'Y');
        $query = $this->db->get('project_detail');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    /*Get project list multiple End*/
    public function getProjectDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_detail');
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

    public function get_visit_report_progress_details_data($project_id){
        $this->db->select('t1.*,t2.username');
        $this->db->from('project_progress_update_log_triggering as t1');
        $this->db->join('user as t2', 't1.user_id = t2.id', 'LEFT');
        // $this->db->join('project_progress_update_log_details_triggering as t3', 't1.id = t3.log_id', 'LEFT');
        // $this->db->join('project_work_items as t4', 't4.id = t3.project_work_item_id', 'LEFT');
        // $this->db->join('work_item_master as t5', 't5.id = t4.work_item_id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->order_by('t1.timestamp', 'DESC');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

     /*checking num rows against 3 field*/
    function get_num_rows3($table,$column1,$value1,$column2,$value2,$column3,$value3){
    $this->db->where($column1, $value1);
    $this->db->where($column2, $value2);
    $this->db->where($column3, $value3);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
    }

    /*get Specific field data2*/
   function getSpecificdata2($table,$field1,$get_id1,$field2,$get_id2,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field1, $get_id1);
        $this->db->where($field2, $get_id2);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
   }

   /*checking num rows against 2 field*/
    function get_num_rows2($table,$column1,$value1,$column2,$value2){
    $this->db->where($column1, $value1);
    $this->db->where($column2, $value2);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
    }

    public function get_project_claimed_amnt($invoice_id){
        $this->db->select("sum(amount) as claimed_amt");
         $this->db->where('invoice_id', $invoice_id);
         $this->db->where('status', 'Y');
         $this->db->group_by('invoice_id');
        $query = $this->db->get('project_invoice_details');
        //echo  $this->db->last_query(); die();
        $return =  $query->result_array();
        return $return[0]['claimed_amt'];
    }

    public function get_project_paid_amnt($invoice_id){
        $this->db->select("sum(paid_amount) as paid_amount");
         $this->db->where('invoice_id', $invoice_id);
         $this->db->where('status', 'Y');
         $this->db->group_by('invoice_id');
        $query = $this->db->get('project_invoice_payment_history');
        //echo  $this->db->last_query(); die();
        $return =  $query->result_array();
        return $return[0]['paid_amount'];

    }

    public function get_project_summery_data($project_id){
        $this->db->select('t1.*,t2.vendor as vendor_name');
        $this->db->from('project_invoice as t1');
        $this->db->join('vendor_master as t2', 't1.vendor_id = t2.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.status', 'Y');
        $this->db->group_by('t1.vendor_id');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    public function get_total_invoices_cnt($project_id,$vendor_id){
    $this->db->where('project_id', $project_id);
    $this->db->where('vendor_id', $vendor_id);
    $this->db->where('status', 'Y');
    $query=$this->db->get('project_invoice');
    $num_rows = $query->num_rows();
    return $num_rows;
    }
    public function project_all_invoice_data($invoice_id){
       $this->db->select('t1.*,t2.major_head');
        $this->db->from('project_invoice_details as t1');
        $this->db->join('account_head_master as t2', 't1.major_head_id = t2.id', 'LEFT');
        $this->db->where('t1.invoice_id', $invoice_id);
        $this->db->where('t1.status', 'Y');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; } 
    }

    public function invoice_head_details_data($project_id){
        $this -> db -> select('*');
        $this -> db -> from('project_invoice');
        $this -> db -> where('project_id', $project_id);
        $this -> db -> where('status', 'Y');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    public function get_invoice_paid_amount_data($invoice_id,$major_head_id){
        $this->db->select("sum(paid_amount) as paid_amount");
         $this->db->where('invoice_id', $invoice_id);
         $this->db->where('major_head_id', $major_head_id);
         $this->db->where('status', 'Y');
         $this->db->group_by('invoice_id');
        $query = $this->db->get('project_invoice_payment_history');
        //echo  $this->db->last_query(); die();
        $return =  $query->result_array();
        return $return[0]['paid_amount'];
    }

    public function work_item_details_head_data($project_id){
       $this->db->select('t1.*,t3.work_item_description as work_item_name,t4.unit_name');
        $this->db->from('project_physical_planning_main as t1');
        $this->db->join('project_work_items as t2', 't1.project_work_item_id = t2.id', 'LEFT');
        $this->db->join('work_item_master as t3', 't2.work_item_id = t3.id', 'LEFT');
        $this->db->join('unit_master as t4', 't1.activity_quantity_unit_id = t4.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.status', 'Y');
        $this->db->group_by('t1.project_work_item_id');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }  
    }

    public function get_mobile_visit_activity_detail_data($project_id,$project_work_item_id){
        $this->db->select('t1.*,t2.particulars as activity_name,t4.unit_name');
        $this->db->from('project_physical_planning_main as t1');
        $this->db->join('project_activities as t2', 't1.project_activity_id = t2.id', 'LEFT');
        $this->db->join('unit_master as t4', 't1.activity_quantity_unit_id = t4.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.project_work_item_id', $project_work_item_id);
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; } 
    }

    public function get_target_quantity_arr_data($project_id,$physical_planning_id,$project_work_item_id,$project_activity_id){
        $this->db->select('target_quantity');
        $this->db->from('project_physical_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_physical_planning_id', $physical_planning_id);
        $this->db->where('project_work_item_id', $project_work_item_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();

         //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; } 
    }

    function get_mobile_visit_report_detail_data($project_id,$project_physical_planning_id,$project_work_item_id){
        $this->db->select('t1.*,t2.particulars as  activity_name,t3.unit_name');
        $this->db->from('project_physical_planning_detail as t1');
        $this->db->join('project_activities as t2', 't1.project_activity_id = t2.id', 'LEFT');
        $this->db->join('unit_master as t3', 't1.unit_id = t3.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.project_physical_planning_id', $project_physical_planning_id);
        $this->db->where('t1.project_work_item_id', $project_work_item_id);
        $this->db->where('t1.status', 'Y');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }  
    }


    function get_mobile_visit_report_group_detail_data($project_id,$project_physical_planning_id,$project_work_item_id){
        $this->db->select('t1.*,t2.particulars as  activity_name,t3.unit_name');
        $this->db->from('project_physical_planning_detail as t1');
        $this->db->join('project_activities as t2', 't1.project_activity_id = t2.id', 'LEFT');
        $this->db->join('unit_master as t3', 't1.unit_id = t3.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.project_physical_planning_id', $project_physical_planning_id);
        $this->db->where('t1.project_work_item_id', $project_work_item_id);
        $this->db->group_by('project_activity_id');
        $this->db->where('t1.status', 'Y');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }    
    }

    function get_detail_target_quantity_data($project_id,$project_physical_planning_id,$project_work_item_id,$month_name){
        $this->db->select('target_quantity');
        $this->db->from('project_physical_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_physical_planning_id', $project_physical_planning_id);
        $this->db->where('project_work_item_id', $project_work_item_id);
        $this->db->where('month_name', $month_name);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['target_quantity'];
        } 

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

    function get_project_details_required_field($project_id,$rfld){
         $this->db->select($rfld);
        $this->db->from('project_detail');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$rfld];
        } 
    }

    function project_details_user_details_data($user_id){
        $this->db->select('firstname,lastname,email,mobile');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; } 
    }


    public function get_project_user_data($project_id){
        $this->db->select('t2.firstname,t2.lastname,t2.email,t2.mobile,t3.designation');
        $this->db->from('project_user as t1');
        $this->db->join('organization_user_details as t2', 't1.user_id = t2.user_id', 'LEFT');
        $this->db->join('user_designation_master as t3', 't1.designation_id = t3.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; } 
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

    function get_project_retender_data_result($project_id){
        $this->db->select('t1.*,t2.project_type as type_name,t3.name as group_name,t4.name as sector_name,t5.name as destination_name,t6.name as area_name');
        $this->db->from('tender_history as t1');
        $this->db->join('project_type_master as t2', 't1.project_type = t2.id', 'LEFT');
        $this->db->join('group_master as t3', 't1.project_group = t3.id', 'LEFT');
        $this->db->join('sector_master as t4', 't1.project_sector = t4.id', 'LEFT');
        $this->db->join('destination_master as t5', 't1.project_destination = t5.id', 'LEFT');
        $this->db->join('area_master as t6', 't1.project_area = t6.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

	//End Code bY Somnath 10-08-2020 



    /* Start new changes for table connected  12-01-2021 */

    /*Get project indivisual details*/
    public function get_project_data($project_id = Null)
    {
                
        $this->db->select('pd.*,area.name as area_name,dest.name as dest_name,sector.name as sector_name,typeP.project_type as ptype_name,group.name as groupName,orgapprover.firstname,orgapprover.lastname');
        $this->db->from('project_conceptualisation_stage as pd');
        $this->db->where('pd.id', $project_id);
        $this->db->join('area_master as area', 'pd.project_area = area.id', 'LEFT');
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
        $query = $this->db->get();
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

    public function get_project_progress_activity($milestone_id,$activity_id,$project_id)
    {
        $this->db->select('pu.*');
        $this->db->from('project_progress_update_log_details_actioned as pu');
        $this->db->where('pu.project_id', $project_id);
        $this->db->where('pu.project_work_item_id', $milestone_id);
        $this->db->where('pu.project_activity_id', $activity_id);
        $query = $this->db->get();
        //echo  $this->db->last_query(); //die();
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

    function get_user_details_by_user_id($user_id){
        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            $user_type_id = $row['user_type'];
        }

        if($user_type_id == 2){
			
			}elseif ($user_type_id == 3) {
          $this -> db -> select('email,mobile, CONCAT(firstname, '.', lastname) AS name');
        $this -> db -> from('organization_user_details');
        $this -> db -> where('user_id', $user_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ 
            return $query->result_array(); 
        }
        else{ return false; } 
        }
    }


    // function get_project_overview_data(){
        


    //     $sql = "SELECT *
    //         FROM project_approval
    //         where id IN 
    //         ( 
    //         SELECT max(id) 
    //         FROM project_approval 
    //         group by project_id 
    //         );";
    //     $query = $this->db->query($sql);
    //     echo  $this->db->last_query(); die();
    //     if($query -> num_rows() >= 1){ return $query->result(); }
    //     else{ return false; }
    // }

    public function get_project_overview_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status) {

    
    $this->db->select('project_approval.*');
    $this->db->where("project_approval.id IN 
            ( 
            SELECT max(project_approval.id) 
            FROM project_approval 
            group by project_approval.project_id 
            )");
    if($project_sector_id > 0){
        $this->db->where('t2.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t2.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t2.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t2.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t2.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t2.division_id', $project_division_id);  
      }
      if($project_status == 'Pending'){
        //$this -> db ->where('t2.id IN(SELECT project_id FROM project_aggrement_stage)');
        $this->db->where('t3.approve_status !=', 'Y');
      }elseif($project_status == 'Ongoing'){
        $this->db->where('t3.approve_status', 'Y');
      }elseif($project_status == 'Completed'){
        $this -> db ->where('t2.id IN(SELECT project_id FROM project_completed_history)');
      }else{

      }
    $this->db->group_by('project_id');
    $this->db->from('project_approval');
    $this->db->join('project_conceptualisation_stage as t2', 't2.id = project_approval.project_id', 'LEFT');
    if($project_status == 'Ongoing' || $project_status == 'Pending'){
      $this->db->join('project_aggrement_stage as t3', 't2.id = t3.project_id', 'LEFT');  
    }
    

    $query = $this->db->get();
    //echo  $this->db->last_query(); die();
    if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    
}


    function get_overview_project_details($project_id){
        $this->db->select('t1.project_name,t3.project_type as category_name,t4.name as location,t5.name as scheme,t6.progress_% as tree_%,t7.progress_% as ph_%,t8.progress_% as rwss_%,t9.progress_% as eviction_%');
        $this->db->from('project_conceptualisation_stage as t1');
        $this->db->where('t1.id', $project_id);
        $this->db->join('project_creation as t2', 't2.id = t1.proj_rel_id', 'LEFT');
        $this->db->join('project_type_master as t3', 't3.id = t1.project_type', 'LEFT');
        $this->db->join('area_master as t4', 't4.id = t1.location_id', 'LEFT');
        $this->db->join('group_master as t5', 't5.id = t1.project_group', 'LEFT');
        $this->db->join('pre_construction_activities_tree_cutting as t6', 't6.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_ph as t7', 't7.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_rwss as t8', 't8.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_encroachment_eviction as t9', 't9.project_id = t1.id', 'LEFT');

       $query = $this->db->get();
       //echo  $this->db->last_query(); die();
        $return = $query->result_array();
        return $return[0];
    }


    function get_project_pre_Contruction_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status){
        $this->db->select('t1.project_name,t3.project_type as category_name,t4.name as location,t5.name as scheme,t6.total_land as govt_val,t6.target_end_date as govt_date,t7.total_area as pvt_val,t7.target_end_date as pvt_date,t8.total_area as direct_val,t8.target_end_date as direct_date,t9.total_area_tobe_diverted as forest_val,t9.target_end_date as forest_date,t10.name as circle_name,t11.division_name,t12.status_EIA as env_val,t12.target_end_date as env_date,t13.noof_trees_tobe_cut as tree_val,t13.target_end_date as tree_date,t14.poles_tobe_shifted as eng_val,t14.target_end_date as eng_date,t15.length_of_pipeline_tobe_shifted_lhs as ph_val,t15.target_end_date as ph_date,t16.total_area as eviction_val,t16.target_end_date as eviction_date');
        $this->db->from('project_conceptualisation_stage as t1');
        if($project_sector_id > 0){
        $this->db->where('t1.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t1.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t1.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t1.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t1.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t1.division_id', $project_division_id);  
      }
      if($project_status == 'Pending'){
        $this->db->where('pr_approve.approve_status !=', 'Y');
      }elseif($project_status == 'Ongoing'){
        $this->db->where('pr_approve.approve_status', 'Y');
      }elseif($project_status == 'Completed'){
        $this -> db ->where('t1.id IN(SELECT project_id FROM project_completed_history)');
       
      }else{

      }
        $this->db->join('project_creation as t2', 't2.id = t1.proj_rel_id', 'LEFT');
        $this->db->join('project_type_master as t3', 't3.id = t1.project_type', 'LEFT');
        $this->db->join('area_master as t4', 't4.id = t1.location_id', 'LEFT');
        $this->db->join('group_master as t5', 't5.id = t1.project_group', 'LEFT');
        $this->db->join('pre_construction_activities_govt_land_alienation as t6', 't6.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_pvt_land_acquistion as t7', 't7.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_pvt_land_direct_purchase as t8', 't8.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_forest_land as t9', 't9.project_id = t1.id', 'LEFT');
        $this->db->join('sector_master as t10', 't10.id = t2.circle_id', 'LEFT');
        $this->db->join('division_master as t11', 't11.id = t2.division_id', 'LEFT');
        $this->db->join('pre_construction_activities_environment_clearance as t12', 't12.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_tree_cutting as t13', 't13.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_electrical as t14', 't14.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_utility_shifting_ph as t15', 't15.project_id = t1.id', 'LEFT');
        $this->db->join('pre_construction_activities_encroachment_eviction as t16', 't16.project_id = t1.id', 'LEFT');
        if($project_status == 'Ongoing' || $project_status == 'Pending'){
       $this->db->join('project_aggrement_stage as pr_approve', 't1.id = pr_approve.project_id', 'LEFT');  
    }
       $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }



    /* End new changes for table connected  12-01-2021 */

    public function get_sector(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('sector_master');

        return $query->result_array();
    }

    public function get_group(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('group_master');

        return $query->result_array();
    }
    public function get_wing(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('wing_master');

        return $query->result_array();
    }

    public function get_division(){

        $this->db->select('*');
        $this->db->where('status', 'Y');
        $query = $this->db->get('division_master');

        return $query->result_array();
    }


    public function get_project_filter_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status){
       
       $this -> db -> select('t1.*');
        $this -> db -> from('project_conceptualisation_stage as t1');
        if($project_sector_id > 0){
        $this->db->where('t1.project_sector', $project_sector_id);  
      }
      if($project_group_id > 0){
        $this->db->where('t1.project_group', $project_group_id);  
      }
    if($project_category_id > 0){
        $this->db->where('t1.project_type', $project_category_id);  
      }
      if($project_area_id > 0){
        $this->db->where('t1.location_id', $project_area_id);  
      }
    if($project_wing_id > 0){
        $this->db->where('t1.wing_id', $project_wing_id);  
      }
      if($project_division_id > 0){
        $this->db->where('t1.division_id', $project_division_id);  
      }
      if($project_status == 'Pending'){
        $this->db->where('pr_approve.approve_status !=', 'Y');
      }elseif($project_status == 'Ongoing'){
        $this->db->where('pr_approve.approve_status', 'Y');
      }elseif($project_status == 'Completed'){
        $this -> db ->where('t1.id IN(SELECT project_id FROM project_completed_history)');
       
      }else{

      }
 //if($project_status == 'Ongoing' || $project_status == 'Pending'){
      $this->db->join('project_aggrement_stage as pr_approve', 't1.id = pr_approve.project_id', 'LEFT');  
    //}
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    //Tendering
      function fetch_tendering_pre_bid_report_data()
      {
        $this -> db -> select('tendering_pre_bid.approval_date,project_tender_stage.tender_name as tendername,tendering_pre_bid_bidder_details.bidder_name,country_master.country_name as country,tendering_pre_bid_bidder_details.first_name,tendering_pre_bid_bidder_details.last_name,tendering_pre_bid_bidder_details.mobile_no,tendering_pre_bid_bidder_details.email_id');

        $this->db->join('project_tender_stage', 'tendering_pre_bid.project_id = project_tender_stage.project_id');

        $this->db->join('tendering_pre_bid_bidder_details','project_tender_stage.project_id = tendering_pre_bid_bidder_details.project_id','LEFT');

        $this->db->join('country_master','tendering_pre_bid_bidder_details.country_id = country_master.country_id');

        // $this->db->join('tendering_technical_evalution', 'tendering_pre_bid.project_id = tendering_technical_evalution.project_id','LEFT');

        // $this->db->join('tendering_technical_evalution_bidder_details', 'tendering_pre_bid.project_id = tendering_technical_evalution_bidder_details.project_id','LEFT');

        // $this->db->join('tendering_financial_evalution', 'tendering_pre_bid.project_id = tendering_financial_evalution.project_id','LEFT');
        
        //$this->db->group_by('project_tender_stage.project_id','tendering_pre_bid_bidder_details.bidder_name','tendering_pre_bid_bidder_details.email_id');

        $this->db->group_by(array("project_tender_stage.project_id", "tendering_pre_bid_bidder_details.bidder_name","tendering_pre_bid_bidder_details.email_id")); 
        //$this->db->order_by('project_tender_stage.project_id', 'asc'); 
        $query = $this -> db -> get(tendering_pre_bid);
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
     }


     function get_technical_data_summary_report_data(){

        $this -> db -> select('project_tender_stage.tender_name as tendername,tendering_technical_evalution.approval_date as tendering_date,tendering_technical_evalution_bidder_details.bidder_ref_no as bidder_tech_name,tendering_technical_evalution_bidder_details.technical_status as bidder_tech_status');
        $this->db->join('project_tender_stage', 'tendering_technical_evalution.project_id = project_tender_stage.project_id');

        $this->db->join('tendering_technical_evalution_bidder_details', 'tendering_technical_evalution.project_id = tendering_technical_evalution_bidder_details.project_id','LEFT');

       
        $query = $this -> db -> get(tendering_technical_evalution);
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }


     }


     function get_financial_data_summary_report_data(){


        $this -> db -> select('project_tender_stage.tender_name as tendername,tendering_financial_evalution.approval_date,tendering_financial_evalution_bidder_details.bidder_ref_no as fina_bidder_name,tendering_financial_evalution_bidder_details.bid_value,tendering_financial_evalution_bidder_details.final_score,tendering_financial_evalution_bidder_details.successful_bidder as bidder_status');
         $this->db->join('project_tender_stage', 'tendering_financial_evalution.project_id = project_tender_stage.project_id');

        $this->db->join('tendering_financial_evalution_bidder_details', 'tendering_financial_evalution.project_id = tendering_financial_evalution_bidder_details.project_id','LEFT');

       
        $query = $this -> db -> get(tendering_financial_evalution);
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }


     }

     function get_negotiation_data_summary_report_data(){

     $this -> db -> select('project_tender_stage.tender_name as tendername,tendering_negotiation.approval_date,tendering_negotiation_bidder_details.negotiation_meeting_date as nego_date,tendering_negotiation_bidder_details.negotiation_bid_value as nego_bid_value,tendering_negotiation_bidder_details.negotiation_status as nego_status,tendering_financial_evalution_bidder_details.bidder_ref_no as bidder_name');
          $this->db->join('project_tender_stage', 'tendering_negotiation.project_id = project_tender_stage.project_id');

         $this->db->join('tendering_negotiation_bidder_details', 'tendering_negotiation.project_id = tendering_negotiation_bidder_details.project_id','LEFT');

         $this->db->join('tendering_financial_evalution_bidder_details', 'tendering_financial_evalution_bidder_details.id = tendering_negotiation_bidder_details.bidder_id');

      $query = $this -> db -> get(tendering_negotiation);
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }

     }


     function get_issue_of_loa_data_summary_report_data(){

          $this -> db -> select('project_tender_stage.tender_name as tendername,tendering_issue_of_loa.successful_bidder_ref_no,tendering_issue_of_loa.loa_issue_date,tendering_issue_of_loa.negotiation_bid_value');
          $this->db->join('project_tender_stage', 'tendering_issue_of_loa.project_id = project_tender_stage.project_id');

        $query = $this -> db -> get(tendering_issue_of_loa);
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }


     }





   

   

    //Tendering

}

?>
