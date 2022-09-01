<?php

class Physical_progress_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    /* common function for get organization id */



    public function getOrganization_Users_OrganizationId($user_id){
        $user_id = (int)$user_id;
        $this->db->select('organization_id');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['organization_id'];
    }


    /* end for get organization id */


    function get_peoject_details_data($project_id){
        $this -> db -> select('t1.project_name,t1.id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.project_code,t2.project_type,t3.name as area_name,t4.name as sector_name,t5.project_start_date,t5.project_end_date,t5.planning_incharge_user_id');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.project_area ', 'left');
        $this -> db ->join('sector_master t4', 't4.id = t1.project_sector ', 'left');
        $this -> db ->join('project_aggrement_stage t5', 't5.project_id = t1.id ', 'left');
        $this -> db -> where('t1.id', $project_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
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




    
    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

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


    

     /*Insert data to the database and return id*/
    function insertDatareturnid($data = array(), $tbl){
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        if($insert){ return  $insert_id; }
        else{ return false; }
    }

    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
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

     /*Check Field value exist or not in specific table*/
    function check_field_value_exist_or_not_in_tbl($tbl,$field1,$value1){
      $this->db->where($field1, $value1);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }


      /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }

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

    function get_milestone_activity_list_data($project_id,$milestone_id){
        $this -> db -> select('*');
        $this -> db -> from('project_activities');
        $this -> db -> where('project_id', $project_id);
        $this -> db -> where('milstone_id', $milestone_id);
        $this -> db -> where('completion_status', 'N');
        //return  $this->db->last_query();
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_work_item_activity_list_data($project_id,$work_item_id){
        $this -> db -> select('t1.id as main_id,t1.project_id,t1.project_work_item_id,t1.project_activity_id,t1.total_activity_quantity,t1.total_activity_allotted_quantity,t1.activity_quantity_unit_id,t2.particulars,t2.amount,t3.unit_name');
            $this->db->from('project_physical_planning_main t1');
            $this -> db -> join('project_pf_activities t2','t2.id = t1.project_activity_id','left');
            $this->db->join('unit_master as t3', 't1.activity_quantity_unit_id = t3.id', 'LEFT');
            $this -> db -> where('t1.project_id', $project_id);
            $this -> db -> where('t1.project_work_item_id', $work_item_id);
            $this -> db -> where('t1.status', 'Y');
            $this -> db -> where('t2.status', 'Y');
            $this -> db -> group_by('t1.project_activity_id');
            $query = $this -> db -> get();
          
           //echo  $this->db->last_query(); die();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
    }

    function get_activity_till_target($physical_planning_main_id){
        $todate = date('Y-m-d');
        $this->db->select('sum(project_physical_planning_detail.target_quantity) as target_quantity');
      $this->db->where('project_physical_planning_detail.project_physical_planning_id', $physical_planning_main_id);
      $this->db->where('project_physical_planning_detail.month_date <=', $todate);
      $this->db->where('project_physical_planning_detail.status', 'Y');
      $query = $this->db->get('project_physical_planning_detail');
      return $query->result_array();
    }


    function get_activites_completed_or_not($project_id,$milestone_id,$activities_id){
         $this->db->select('status');
        $this->db->from('project_progress_update_log_details_actioned');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_work_item_id', $milestone_id);
        $this->db->where('project_activity_id', $activities_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['status'];
        } 


        }


        function get_physical_progress_list_data(){
            $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
            $this->db->from('project_pf_activities t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
            $this -> db -> group_by('t1.project_id');
            $query = $this -> db -> get();
          
           //echo  $this->db->last_query(); die();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }



        public function get_project_progress($proj_id)
    {
 
   $query = $this->db->query("select sum(milestone_progress) as project_progress from (select pm.id as milestone_id, pm.milestone as milestone_name,activities_completion.activity_progress, pm.weightage as milestone_weightage, round(IFNULL((activity_progress*pm.weightage)/100,0),2) as milestone_progress  from project_milestone as pm
left JOIN
(SELECT
    milstone_id AS milestone_id_in_activities_table, sum(weightage) as activity_progress from
    project_pf_activities
where completion_status='Y'
and project_id='".$proj_id."'
group by milstone_id) as activities_completion

on activities_completion.milestone_id_in_activities_table=pm.id
where project_id='".$proj_id."') milestone_progress");
   
  
        $result = $query->result_array();
        return $result;
 
 
    }



    function get_physical_progress_work_item_data($project_id){
        $this -> db -> select('t1.project_id,t1.work_item_id,t1.amount,t2.work_item_description');
            $this->db->from('project_work_items t1');
            $this -> db -> join('work_item_master t2','t2.id = t1.work_item_id','left');
            $this -> db -> where('t1.project_id', $project_id);
            $this -> db -> group_by('t1.work_item_id');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
    }






}