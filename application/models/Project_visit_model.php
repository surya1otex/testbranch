<?php

class Project_visit_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    /*Insart data to the database common function*/
    function insertAllData($data = array(), $tbl)
    {
    	$insert = $this->db->insert($tbl, $data);
	    if($insert){ return true; }
	    else{ return false; }
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

   /*get Specific field data2*/
   function getSpecificdata3($table,$field1,$get_id1,$field2,$get_id2,$field3,$get_id3,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field1, $get_id1);
        $this->db->where($field2, $get_id2);
        $this->db->where($field3, $get_id3);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
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


   // function get_project_single_data($project_id){
   // 		$this->db->select('pd.*,area.name as area_name,sector.name as sector_name,ptype.project_type as project_type_name,td.*');
   //      $this->db->from('project_detail as pd');
   //      $this->db->where('pd.id', $project_id);

   //      $this->db->join('tender_details as td', 'pd.id = td.project_id', 'LEFT');
   //      $this->db->join('area_master as area', 'pd.project_area = area.id', 'LEFT');
   //      $this->db->join('sector_master as sector', 'pd.project_sector = sector.id', 'LEFT');
   //      $this->db->join('project_type_master as ptype', 'pd.project_type = ptype.id', 'LEFT');
   //      $query = $this -> db -> get();
   //      //echo  $this->db->last_query(); die();
   //      if($query -> num_rows() >= 1){ return $query->result(); }
   //      else{ return false; }
   // }

   function get_project_single_data($project_id){
        $this -> db -> select('t1.project_name,t1.project_code,t1.id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type as project_type_name,t3.name as area_name,t4.name as sector_name,t5.project_start_date,t5.project_end_date');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.project_area ', 'left');
        $this->db->join('sector_master as t4', 't1.project_sector = t4.id', 'LEFT');
        $this->db->join('project_aggrement_stage as t5', 't1.id = t5.project_id', 'LEFT');
        $this -> db -> where('t1.id', $project_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


   /*Fetch data with order by*/
    function fetchSingledatawithorder($tbl, $fid, $did,$odfldN,$ordType)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $this->db->order_by($odfldN, $ordType);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_project_progress_details($project_id){
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

    function get_progress_image_result($project_id,$log_id){
    	$this -> db -> select('*');
        $this -> db -> from('project_progress_update_images_triggering');
        $this->db->where('log_id', $log_id);
        $this->db->where('project_id', $project_id);
        $this->db->order_by('id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_log_details_data($project_id,$log_id){
    	$this->db->select('t1.*,t2.username,t3.particulars as activities_name,t3.amount');
        $this->db->from('project_progress_update_log_details_triggering as t1');
        $this->db->join('user as t2', 't1.user_id = t2.id', 'LEFT');
        $this->db->join('project_pf_activities as t3', 't1.project_activity_id = t3.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.log_id', $log_id);
        $this->db->order_by('t1.timestamp', 'DESC');
        $query = $this -> db -> get();
        //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_log_details_table_data($project_id,$log_id){
        $this->db->select('t1.*,t2.username,t3.particulars as activities_name,t3.amount');
        $this->db->from('project_progress_update_log_details_triggering as t1');
        $this->db->join('user as t2', 't1.user_id = t2.id', 'LEFT');
        $this->db->join('project_pf_activities as t3', 't1.project_activity_id = t3.id', 'LEFT');
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.log_id', $log_id);
        $this->db->order_by('t1.timestamp', 'DESC');
        return $this->db->get();
    }

    function get_physical_planning_detail_data($project_id,$project_work_item_id,$project_activity_id){
    	$this -> db -> select('t1.month_name,t1.month_date,t1.target_quantity,t1.allotted_quantity,t1.unit_id,t2.unit_name,t1.status');
        $this -> db -> from('project_physical_planning_detail as t1');
        $this->db->join('unit_master as t2', 't1.unit_id = t2.id', 'LEFT');
        $this->db->where('t1.project_work_item_id', $project_work_item_id);
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.project_activity_id', $project_activity_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_physical_planning_total_detail_data($project_id,$project_work_item_id,$project_activity_id){
        $this -> db -> select('t1.total_activity_quantity,t1.total_activity_allotted_quantity,t1.activity_quantity_unit_id,t2.unit_name,t1.status');
        $this -> db -> from('project_physical_planning_main as t1');
        $this->db->join('unit_master as t2', 't1.activity_quantity_unit_id = t2.id', 'LEFT');
        $this->db->where('t1.project_work_item_id', $project_work_item_id);
        $this->db->where('t1.project_id', $project_id);
        $this->db->where('t1.project_activity_id', $project_activity_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    /*checking num rows against 2 field*/
    function get_num_rows($table,$column,$value){
    $this->db->where($column, $value);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
    }


    /*checking num rows against 2 field*/
    function get_num_rows2($table,$column1,$value1,$column2,$value2){
    $this->db->where($column1, $value1);
    $this->db->where($column2, $value2);
    $query=$this->db->get($table);
    $num_rows = $query->num_rows();
    return $num_rows;
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

    function get_project_physical_planning_details_data($project_id,$project_work_item_id,$project_activity_id,$fld,$today,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from('project_physical_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_work_item_id', $project_work_item_id);
        $this->db->where('project_activity_id', $project_activity_id);
        $this->db->where($fld, $today);
        $this->db->limit(1);  
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
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


    function get_table_specific_data($tbl,$where,$specifc_field){
      $this->db->select($specifc_field);
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
    }


    public function updatetableDataCondition($tableName, $data, $where){
        $this->db->where($where);
        $this->db->update($tableName, $data);
        return TRUE;
    }


}