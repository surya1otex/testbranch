<?php

class Project_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function get_source_fund()
    {

        $this->db->select('*');
        $query = $this->db->get('source_of_fund_master');
        return $query->result_array();

    }
    public function get_org_user_details( $user_id ){

        $this->db->select('organization_user_details.firstname,organization_user_details.lastname,organization_user_details.user_id,
        user_designation_master.designation');

        $this->db->where('organization_user_details.user_id', $user_id);


        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'LEFT');
        $query = $this->db->get('organization_user_details');
        //echo $this->db->last_query(); die;
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
    public function get_project_name( $project_id ){
        $this->db->select('project_name');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_detail');
        $result =  $query->result_array();
        return $result[0]['project_name'];
    }
    public function get_list_planning($user_id){

        $this->db->select('project_approval.id,project_detail.project_name, organization_user_details.firstname,organization_user_details.lastname,
        user_designation_master.designation,project_approval.approval_status');
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

        $this->db->select('project_approval.id,project_detail.project_name,organization_user_details.firstname,organization_user_details.lastname ,user_designation_master.designation,
       project_approval.approval_status,project_detail.id as project_id');
        $this->db->join('project_detail', 'project_approval.project_id = project_detail.id', 'INNER');
        $this->db->join('organization_user_details', 'project_approval.approver_id = organization_user_details.user_id', 'INNER');
        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'INNER');
        $this->db->where('project_detail.approver_id', $user_id);

        $query = $this->db->get('project_approval');
        return $query->result_array();
    }
    public function get_approval_project_list( $user_id ){


        $sql = "select area_master.name as area_name,project_type_master.project_type as project_type_name,
        project_conceptualisation_stage.*, PA_id,approval_status as project_approval_status,requester_id,project_step_no
         from project_preparation_stage
          
             inner join 
             (select id PA_id,project_id,requester_id,approver_id PA_Approver_ID, approval_status,
             project_step_no
                from project_approval where id in(select max(id) from project_approval group by project_id)) PA 
             ON PA.project_id=project_preparation_stage.project_id
             
        
             left join project_conceptualisation_stage  on project_conceptualisation_stage.id = project_preparation_stage.project_id
             
             left join project_type_master  on project_conceptualisation_stage.project_type = project_type_master.id
             left join area_master  on project_conceptualisation_stage.project_area = area_master.id
             
        where project_preparation_stage.project_approver_id=".$user_id;
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); die;
        return $query->result_array();


    }
    public function get_entry_project_details( $user_id ){

        $sql = "select project_detail.project_type,project_detail.project_area,project_detail.id,approver_id,project_name,status,PA.PA_id,PA.requester_id,PA.PA_Approver_ID,PA.approval_status from project_detail 
            LEFT JOIN (select id PA_id,project_id,requester_id,approver_id PA_Approver_ID, approval_status  from project_approval where id in(select max(id) from project_approval group by project_id)) PA 
             ON PA.project_id=project_detail.id where project_detail.project_creator_id=".$user_id;
        $query = $this->db->query($sql);
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_planning_approver( $project_id ){

        $this->db->select('user.user_type,user.id,user_designation_master.designation');

        $this->db->join('user', 'project_user.user_id = user.id', 'LEFT');
        $this->db->join('user_designation_master', 'project_user.designation_id = user_designation_master.id', 'LEFT');

        $this->db->where('project_user.project_id', $project_id);



        $query = $this->db->get('project_user');
        //echo $this->db->last_query(); die;
        return $query->result_array();

    }
    public function get_final_approval_status( $project_id,$approver_id = 0 ){

        $this->db->select('approval_status,id,approver_id');
        $this->db->where('project_id', $project_id);
        if( $approver_id > 0 ){
            $this->db->where('approver_id', $approver_id);
        }


        $this->db->order_by('project_approval.id ', 'DESC');
        $this->db->limit('1');
        $query = $this->db->get('project_approval');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_project_history( $project_id ){

        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $this->db->order_by('id ', 'DESC');
        $query = $this->db->get('project_approval');

        //echo $this->db->last_query(); die;
        return $query->result_array();

    }
    /*Get project list*/
    public function get_project_details($project_id = 0,$user_id = 0, $status = "")
    {

        $this->db->select('project_conceptualisation_stage.*');

        if (!empty($project_id)) {
            $this->db->where('project_conceptualisation_stage.id', $project_id);
        }
        if( $user_id > 0 ){
            $this->db->where('project_conceptualisation_stage.project_creator_id', $user_id);

        }
//        /*if( !empty($status)){
//            $this->db->where('project_detail.status', $status);
//        }*/

        //$this->db->join('tender_details as td', 'td.project_id = project_detail.id', 'LEFT');
        $query = $this->db->get('project_conceptualisation_stage');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
    public function get_project_physical_list($user_id = 0)
    {
        $this->db->select('*');
        $this->db->where('planning_approver_id', $user_id);
        $this->db->where('status', 'Y');
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

        $this->db->select('*');
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
    public function updateProjectInitiationDetails($data)
    {

        $project_id = $data['project_id'];
        unset($data['project_id']);

        $this->db->where('id', $project_id);
        $this->db->update('project_conceptualisation_stage', $data);

        $this->db->where('project_id', $project_id);
        $this->db->update('project_preparation_stage', $data);
        return true;
    }

    public function submit_approval($data = [],$request_id = 0 )
    {
        if ($request_id > 0) {
            $this->db->where('id', $request_id);
            return $this->db->update('project_approval', $data);
            //echo $this->db->last_query(); die;g
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
    public function delete_old_data( $project_id ){
        $query = $this->db->query("DELETE FROM aa_amount_breakup_details WHERE project_id = '" . $project_id . "'");
    }

    public function insert_aa_mount_breakup($data)
    {
       // echo "<pre>"; print_r($data);

        $insert = $this->db->insert('aa_amount_breakup_details', $data);

        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function getProjectSector()
    {
        $this->db->select('*');
        $this->db->from('sector_master');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function getAllArea()
    {

        $this->db->select('*');
        $this->db->from('area_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getProjectGroup()
    {
        $this->db->select('*');
        $this->db->from('group_master');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProjectCategory(){
     
        $this->db->select('*');
        $this->db->from('project_type_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

    }

     public function getProjectCircle(){
     
        $this->db->select('*');
        $this->db->from('wing_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getProjectDivision(){
     
        $this->db->select('*');
        $this->db->from('division_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

    }


    public function getAllProjectType()
    {

        $this->db->select('*');
        $this->db->from('project_type_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function get_user_type($user_id){
        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['user_type'];
    }

    public function updatePreTender($data)
    {

        $project_id = $data['project_id'];
        unset($data['project_id']);
        $this->db->where('id', $project_id);
        return $this->db->update('project_detail', $data);
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
        $this->db->where('approval_status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

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

    public function updateConceptualData($project_id, $data)
    {

        $this->db->where('id', $project_id);
        return $this->db->update('project_conceptualisation_stage', $data);
    }

    public function updatePreparationData($project_id, $data)
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_preparation_stage', $data);

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

    public function get_project_progress_location($project_id)
    {
      
         $this -> db -> select('t3.name as area_name');
         $this -> db -> from('project_conceptualisation_stage t1');
        
         $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
       
        $this->db->where('t1.id', $project_id);
        $this->db->where('t3.status', 'Y');
        $query = $this -> db -> get();
        return $query->result_array();
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

    public function project_destination($destination_id)
    {
        $this->db->select('name');
        $this->db->where('id', $destination_id);
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

    public function deletePreTender($project_id)
    {

        /*$this->db->delete($tableName, $deleteClause);*/
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_pre_tender_stage');

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
       // echo $this->db->last_query(); //die();
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
        $this->db->select('project_physical_planning_detail.*,td.monitoring_frequency');
        $this->db->join('tender_details as td', 'td.project_id = project_physical_planning_detail.project_id', 'LEFT');
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


    /*Get project indivisual details*/
    public function get_project_data($project_id = Null)
    {
        $this->db->select('pd.*,area.name as area_name,td.*');
        $this->db->from('project_detail as pd');
        $this->db->where('pd.id', $project_id);

        $this->db->join('tender_details as td', 'pd.id = td.project_id', 'LEFT');
        $this->db->join('area_master as area', 'pd.project_area = area.id', 'LEFT');
        $this->db->join('project_user as pu', 'pu.project_id = pd.id', 'LEFT');
        $this->db->join('destination_master as destination', 'pd.project_destination = destination.id', 'LEFT');
        $query = $this->db->get('project_detail');
        //echo  $this->db->last_query(); die();
        return $query->result_array();
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
     public function check_dupliacte_work_item_project( $project_id,$work_item_id ){

         $this->db->select('count(id) as total');
         $this->db->where('project_id', $project_id);
         $this->db->where('work_item_id', $work_item_id);
         $query = $this->db->get('project_work_items');
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

    public function get_physical_progress_monthly($project_id, $activity_id = 0, $start_date = '', $end_date = '',$work_item_id = 0)
    {
        $this->db->select('month_name, month_date, IFNULL(target_quantity, 0) AS total_budget_monthly, IFNULL(allotted_quantity, 0) AS total_allotted_monthly');
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
    public function get_total_work_items( $project_id ){
        $this->db->select('count(id) as total_work_item');
        $this->db->from('project_work_items');
        $this->db->where('project_id', $project_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        //echo $this->db->last_query(); die;

        return $return[0]['total_work_item'];
    }
    public function get_total_planned_work_items( $project_id  ){

        $this->db->select('*');
        $this->db->from('project_physical_planning_main');
        $this->db->where('project_id', $project_id);
        $this->db->group_by('project_work_item_id');
        $query = $this->db->get();
        $return = $query->result_array();
        //echo $this->db->last_query(); die;

        return count($return);



    }
    public function get_total_activity( $project_id ){
        $this->db->select('count(id) as total_activity');
        $this->db->from('project_activities');
        $this->db->where('project_id', $project_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
//        echo $this->db->last_query(); die;
        return $return[0]['total_activity'];
    }
    public function get_total_planned_activity( $project_id ){

       // $return = $this->db->query("SELECT * FROM `project_physical_planning_main` WHERE project_id = ".$project_id." group BY project_activity_id");
        $this->db->select('*');
        $this->db->from('project_physical_planning_main');
        $this->db->where('project_id', $project_id);
        $this->db->group_by('project_activity_id');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->result_array();
        return count($result);
    }
    public function get_total_activities_used($project_id){

        $this->db->select('count(project_activity_id) as Total_planned_activity');
        $this->db->from('project_physical_planning_main');
        $this->db->where('project_id', $project_id);
        $this->db->group_by('project_activity_id');
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        return  $query->result_array();


    }

    ///somnath


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

 
    function project_details_user_details_data($user_id){
        $this->db->select('firstname,lastname,email,mobile');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
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

    function get_vendor_data($project_id){

        $this->db->select('vendor_master.vendor,project_invoice.vendor_id');
        $this->db->from('project_invoice');
        $this->db->join('vendor_master ', 'vendor_master.id = project_invoice.vendor_id','left');
           
        $this->db->where('project_invoice.project_id ', $project_id);
        $this->db->order_by('vendor_master.vendor', 'DESC');
        $this->db->group_by('vendor_master.id');
        $query = $this->db->get();
        return $query->result_array();
    }

     public function get_invoice_data($project_id,$vendor_id)
    {
       
            $condition = "";   
            
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.amount) as claimed_amnt
    FROM `project_invoice` a
    left join project_invoice_details b on b.invoice_id=a.id
    left join project_detail pd on a.project_id=pd.id
    WHERE a.vendor_id='".$vendor_id."' AND a.project_id='".$project_id."' $condition GROUP BY b.invoice_id");
        $result = $query->result_array();
        return $result;
 
    }

    public function get_invoicereleased_data($project_id,$vendor_id){
        $condition = "";   
       
 
 
   $query = $this->db->query("SELECT a.id,a.vendor_id,a.invoice_no,SUM(b.paid_amount) as released_amnt
    FROM `project_invoice` a
    left join project_invoice_payment_history b on b.invoice_id=a.id
    left join project_detail pd on a.project_id=pd.id
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
    left join project_detail w on a.project_id=w.id 
    WHERE  a.project_id='".$project_id."' $condition GROUP BY DATE_FORMAT(b.payment_date, '%Y-%m') 
    UNION ALL 
    SELECT c.id,c.invoice_date,DATE_FORMAT(c.invoice_date, '%Y-%m') as period, 0 as released, IFNULL(SUM(d.amount), 0) AS claimed
    FROM `project_invoice` c
    left join project_invoice_details d on d.invoice_id=c.id 
    left join project_detail pd on c.project_id=pd.id 
    
    WHERE c.project_id='".$project_id."' $conditionN GROUP BY DATE_FORMAT(c.invoice_date, '%Y-%m')) 
    A
GROUP by period");
       // echo  $this->db->last_query(); die();
        $result = $query->result_array();
        return $result;
    }

    public function getProjectConceptualisationDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_conceptualisation_stage');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    public function getProjectPreparationDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_preparation_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    public function getProjectPreTenderDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_pre_tender_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    public function getProjectTenderDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_tender_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
    public function getProjectAgreementDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_aggrement_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }


    public function getFiles( $project_id , $table_name){

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
    public function updateProjectConceptualisationDetails($data,$project_id )
    {
		//echo "<pre>";
		//print_r($data);
		//echo  $this->db->last_query(); die();
        $this->db->where('id', $project_id);
        return $this->db->update('project_conceptualisation_stage', $data);
    }
    public function updateProjectPreparationDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
		//echo "<pre>";
		//print_r($data);die();
		//echo  $this->db->last_query(); 
        return $this->db->update('project_preparation_stage', $data);
    }
    public function updateProjectPreTenderDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_pre_tender_stage', $data);
    }
    public function updateProjectTenderDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_tender_stage', $data);
    }
    public function updateProjectAgreementDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_aggrement_stage', $data);
    }


    public function addProjectConceptualisation($data)
    {

        $insert = $this->db->insert('project_conceptualisation_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function addProjectPreparation($data)
    {

        $insert = $this->db->insert('project_preparation_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function addProjectAgreement($data)
    {

        $insert = $this->db->insert('project_aggrement_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function addProjectPreTender($data)
    {
        $insert = $this->db->insert('project_pre_tender_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function addProjectTender($data)
    {
        $insert = $this->db->insert('project_tender_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function insertProjectConceptualisationDocuments($data)
    {

        $insert = $this->db->insert('project_conceptualisation_stage_document', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function insertProjectPreparationDocuments($data)
    {

        $insert = $this->db->insert('project_preparation_stage_documents', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function insertProjectPreTenderDocuments($data)
    {

        $insert = $this->db->insert('project_pretender_stage_documents', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function insertProjectTenderDocuments($data)
    {

        $insert = $this->db->insert('project_tender_stage_documents', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    public function insertProjectAgreementDocuments($data)
    {

        $insert = $this->db->insert('project_aggrement_stage_document', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }


    public function checkProjectExits( $project_id,$table_name = 'project_preparation_stage'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }


    public function get_project_conceptualisation_list( $user_id ){

        $query = $this->db->query("SELECT a.*,b.project_type as project_type_name,c.name as area_name
    FROM `project_conceptualisation_stage` a
    left join project_type_master b on b.id=a.project_type
    left join area_master c on c.id=a.project_area
    WHERE a.project_creator_id='".$user_id."' ");
        //print_r($this->db->last_query()); die;
        $result = $query->result_array();
        return $result;
    }
    public function get_project_preparation_list( $user_id )
    {

        $query = $this->db->query("SELECT a.*,b.project_type as project_type_name,d.project_name,c.name as area_name
    FROM `project_preparation_stage` a
    left join project_conceptualisation_stage d on d.id=a.project_id
    left join project_type_master b on b.id=d.project_type
    left join area_master c on c.id=d.project_area
    WHERE a.project_creator_id='" . $user_id . "' ");
        //print_r($this->db->last_query()); die;    }
        $result = $query->result_array();
        return $result;
    }
    public function get_initiation_planning_approval_list($user_id){
        $query = $this->db->query("SELECT t1.*,t2.*,b.project_type as project_type_name,c.name as area_name,t2.status as status_preparation_stage 
                    FROM project_conceptualisation_stage t1
                    LEFT JOIN project_preparation_stage t2 ON t1.id = t2.project_id
                    LEFT JOIN project_type_master b on b.id=t1.project_type
                    LEFT JOIN area_master c on c.id=t1.project_area
                        UNION
                    SELECT t1.*,t2.*,b.project_type as project_type_name,c.name as area_name,t2.status as status_preparation_stage  
                    FROM project_conceptualisation_stage t1
                    RIGHT JOIN project_preparation_stage  t2 ON t1.id = t2.project_id
                    LEFT JOIN project_type_master b on b.id=t1.project_type
                    LEFT JOIN area_master c on c.id=t1.project_area WHERE t1.project_creator_id='".$user_id."'");
        //print_r($this->db->last_query()); die;
        $result = $query->result_array();
        return $result;
    }
    public function get_project_pre_tender_list( $user_id ){

        $query = $this->db->query("SELECT a.*,b.project_type as project_type_name,c.name as area_name,t1.approve_status as pre_tender_approve_status,
       t1.status as pre_tender_status
    FROM `project_conceptualisation_stage` a
    left join project_pre_tender_stage t1 on a.id=t1.project_id
    left join project_type_master b on b.id=a.project_type
    left join area_master c on c.id=a.project_area
    WHERE a.project_creator_id='".$user_id."' ");
        $result = $query->result_array();
        return $result;
    }
    public function get_project_tender_list( $user_id ){

        $query = $this->db->query("SELECT a.*,b.project_type as project_type_name,c.name as area_name,t1.approve_status as tender_approve_status,
       t1.status as tender_status
    FROM `project_conceptualisation_stage` a
    left join project_tender_stage t1 on a.id=t1.project_id
    left join project_type_master b on b.id=a.project_type
    left join area_master c on c.id=a.project_area
    WHERE a.project_creator_id='".$user_id."' ");
        $result = $query->result_array();
        return $result;
    }
    public function get_project_agreement_list( $user_id ){

        $query = $this->db->query("SELECT a.*,b.project_type as project_type_name,c.name as area_name,t1.approve_status as agreement_approve_status,
       t1.status as agreement_tender_status
    FROM `project_conceptualisation_stage` a
    left join project_aggrement_stage t1 on a.id=t1.project_id
    left join project_type_master b on b.id=a.project_type
    left join area_master c on c.id=a.project_area
    WHERE a.project_creator_id='".$user_id."' ");
        $result = $query->result_array();
        return $result;
    }


    /*Delete data from database common function*/
    function deleteData($fid, $did, $tbl)
    {
        $this -> db -> where($fid, $did);
        $this -> db -> delete($tbl);
        if ( $this->db->affected_rows() == 1 ) { return TRUE; }
        else {return FALSE;}
    }

    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

    function get_last_date_from_approval($project_id,$step_no,$rfd){
        $this->db->select($rfd);
        $this->db->from('project_approval');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_step_no', $step_no);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $row = $query->row_array();
            return $row[$rfd];
        }else{
          return false;
        }
    }
	
	  public function getAllDistrict()
    {

        $this->db->select('*');
        $this->db->from('district_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
	
	 public function getTehsilsByDistrict($district_id)
    {

        $this->db->select('*');
        $this->db->from('tahsil_master');
        $this->db->where('district_id', $district_id);
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }


    function check_prooject_value_exist_or_not_in_tbl($tbl,$field,$value){
      $this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }


    // function getProjectCreationDetails($project_id){
    //     $this->db->select('t1.id,t1.project_cost,t1.cat_id,t1.scheme_id as project_group,t1.cat_id as project_type,t1.wing_id as wing_id,t1.division_id as division_id,t1.location as location_id,t1.project_name,t2.project_type as project_type_name,t3.name as area_name,t4.name as scheme_name,t5.name as circle_name,t6.wing_name,t7.division_name');
    //     $this->db->from('project_creation t1');
    //      $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
    //     $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
    //     $this -> db ->join('group_master t4', 't4.id = t1.scheme_id ', 'left');
    //     $this -> db ->join('sector_master t5', 't5.id = t1.circle_id ', 'left');
    //     $this -> db ->join('wing_master t6', 't6.id = t1.wing_id ', 'left');
    //     $this -> db ->join('division_master t7', 't7.id = t1.division_id ', 'left');
    //     $this -> db ->join('project_type_master  t8', 't8.id = t1.cat_id ', 'left');
    //     $this->db->where('t1.id', $project_id);
    //     $query = $this->db->get();
    //     $return = $query->result_array();
    //     return $return[0];
    // }

    function getProjectCreationDetails($project_id){
        $this->db->select('t1.id,t1.project_cost as estimate_total_cost,t1.cat_id,t1.scheme_id as project_group,t1.cat_id as project_type,t1.wing_id as wing_id,t1.division_id as division_id,t1.location as location_id,t1.project_name,t2.project_type as project_type_name,t3.name as area_name,t4.name as scheme_name,t5.name as circle_name,t6.wing_name,t7.division_name');
        $this->db->from('project_creation t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        $this -> db ->join('group_master t4', 't4.id = t1.scheme_id ', 'left');
        $this -> db ->join('sector_master t5', 't5.id = t1.circle_id ', 'left');
        $this -> db ->join('wing_master t6', 't6.id = t1.wing_id ', 'left');
        $this -> db ->join('division_master t7', 't7.id = t1.division_id ', 'left');
        $this -> db ->join('project_type_master  t8', 't8.id = t1.cat_id ', 'left');
        $this -> db ->join('project_conceptualisation_stage t9', 't9.proj_rel_id = t1.id ', 'left');
        $this->db->where('t1.id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }

    function get_project_creation_data($project_id){
        $this->db->select('*');
        $this->db->from('project_creation');
        $this->db->where('id', $project_id);
        $query = $this->db->get();
		print_r($this->db->last_query());
        $return = $query->result_array();
        return $return[0];
    }

    function fetch_divisions($circle_id)  {
         $query = $this->db->query("select wm.id as circleid,dm.division_name,dm.id FROM division_master dm inner join wing_master wm ON dm.circle_id = wm.id where dm.circle_id='".$circle_id."'order by dm.division_name");
              
          if($query->num_rows() > 0){
            return $query->result(); 
          }else{
            return false;
          }

     }


}

?>
