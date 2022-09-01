<?php

class Roles_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    /* common function for get organization id */


  
    /* end for get organization id */


    function get_module_details(){
      $this->db->select('*');

      $this->db->where('status', 'Y');
      $this->db->where('parent_relation_id', 0);
      $this->db->where('menu_display', 'Y');
      $this->db->where('is_hidden', 'N');
      $this->db->order_by('display_order', 'asc');
      $query = $this->db->get('module_master');
      return $query->result_array();
	  
	}


    function get_user_module_details($user_id){
        $this -> db -> select('t2.*');
        $this -> db -> from('user_role_based_access t1');
        $this -> db ->join('module_master t2', 't2.id = t1.module_id ', 'left');
        $this->db->where('t1.user_id',$user_id );
        $this->db->where('t2.status', 'Y');
        $this->db->where('t2.parent_relation_id', 0);
        $this->db->where('t2.menu_display', 'Y');
        $this->db->where('t2.is_hidden', 'N');
        //$this->db->where("(t2.menu_display='Y' OR t2.menu_display='N')", NULL, FALSE);
        $this->db->order_by('t2.display_order', 'asc');
        $query = $this -> db -> get();
		//echo $this->db->last_query();die;
        return $query->result_array();
    }

	function getSubModule( $module_id ){
		$this->db->select('*');
		//$this->db->order_by("moduleName","asc");
		$this->db->where('status', 'Y');
		$this->db->where('parent_relation_id',$module_id );
		$this->db->where('menu_display', 'Y');
        $this->db->where('is_hidden', 'N');
        //$this->db->where("(module_master.menu_display='Y' OR module_master.menu_display='N')", NULL, FALSE);
		$this->db->order_by('display_order', 'asc');
		$query = $this->db->get('module_master');
		return $query->result_array();
	}


	function check_duplicate_role_name_data($role_name){
        $query = $this->db->query("Select * from role_master where role='".$role_name."'");
        
        return $query;
    }

    function check_duplicate_role_name_data2($role_name,$role_id){
         $query = $this->db->query("Select * from role_master where role='".$role_name."' AND id!='".$role_id."'");
        
        return $query;
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


     public function get_module_permission( $module_id = 0 ){

        $this->db->select('*');
        $this->db->from('module_master');
        $this->db->where('id', $module_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_role_module_Permission($allow_modules, $role_id)
    {
        $this->db->query("DELETE FROM role_wise_module_mapping WHERE role_id = '" . $role_id . "'");
        foreach ($allow_modules as $key => $val) {
            $temp = [];
            $temp = array(
              'role_id' => $role_id,
                'module_id' => $key,
                'view' => isset($val['view']) ? $val['view'] : 0,
                'modify' => isset($val['modify']) ? $val['modify'] : 0,
                );
            $insert = $this->db->insert('role_wise_module_mapping', $temp);
            $insert_id = $this->db->insert_id();
            

        }
    }


    function get_organization_roles_data(){
    	$this -> db -> select('t1.*,t2.lebel');
        $this -> db -> from('role_master t1');
        $this -> db ->join('default_page_master t2', 't2.moduleUrl = t1.default_page ', 'left');
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function getModuleAccessByRole($role_id,$module_id){

    	$this->db->select('*');
		$this->db->from('role_wise_module_mapping');
		$this->db->where('role_id', $role_id);
		$this->db->where('module_id', $module_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
	    return $result;

    }

    function get_common_module_details_permission( $user_id = 0 ){

        if( $user_id == 0 ){
            $this->db->distinct();
        }
        $this->db->select('module_master.moduleName,module_master.id as id , module_master.moduleLabel,user_role_based_access.view,user_role_based_access.modify as manage');
        $this->db->from('module_master');
        $this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
        if( $user_id > 0 ){
            $this->db->where('user_role_based_access.user_id', $user_id);
            //$this->db->where('user_role_based_access.view', 1);
        }
        $this->db->where('module_master.status', 'Y');
        $this->db->where('module_master.parent_relation_id', 0);
        $this->db->where('module_master.menu_display', 'N');
        $this->db->where('module_master.is_hidden', 'Y');
        $this->db->order_by('module_master.display_order', 'asc');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result;

    }

    function getCommon_SubModule($module_id){
        $this->db->select('*');
        //$this->db->order_by("moduleName","asc");
        $this->db->where('status', 'Y');
        $this->db->where('parent_relation_id',$module_id );
        $this->db->where('menu_display', 'N');
        $this->db->where('is_hidden', 'Y');
        $this->db->order_by('display_order', 'asc');
        $query = $this->db->get('module_master');
        return $query->result_array();
    }




}