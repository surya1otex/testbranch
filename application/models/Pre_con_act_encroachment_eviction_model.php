<?php

class Pre_con_act_encroachment_eviction_model extends CI_Model {

	function __construct(){
      parent :: __construct();
      $this->load->database();
    }

 function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  if($query->num_rows() > 0){
		return $query->result(); 
	}else{
		return false;
	}
 }
 
 
  function fetch_encroachment()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("encroachment_master");
  if($query->num_rows() > 0){
		return $query->result(); 
	}else{
		return false;
	}
 }

 
 function fetch_tahasil($district_id){
		
	$query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name
			 from tahsil_master eb
			 left join district_master ec on ec.id=eb.district_id
			 where eb.district_id='".$district_id."' order by eb.tahsil_name ");
			
	if($query->num_rows() > 0){
		return $query->result(); 
	}else{
		return false;
	} }
	
	    function Ulb_listing($district_id){
      $this -> db -> select('*');
        $this -> db -> from('ulb_master');
        $this -> db -> where('district_id', $district_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	    function encroachment_data($project_id){
      $this -> db -> select('*');
        $this -> db -> from('pre_construction_activities_encroachment_eviction');
        $this -> db -> where('project_id', $project_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }
	    function encroachment_location_data($project_id){
      $this -> db -> select('*');
        $this -> db -> from('pre_construction_activities_encroachment_eviction_location');
        $this -> db -> where('project_id', $project_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	
	   public function addEncroachment_eviction($data)
    {

        $insert = $this->db->insert('pre_construction_activities_encroachment_eviction', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    } 
	
	  public function updateEncroachment_eviction($db_data,$encroachment_eviction_id)
    {
        $this->db->where('id', $encroachment_eviction_id);
        return $this->db->update('pre_construction_activities_encroachment_eviction', $db_data);
    }
	
	  public function addEncroachment_eviction_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_encroachment_eviction_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
	
	    public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_encroachment_eviction'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

  public function deleteEncroachment_eviction_location($project_id)
    {
		
      $this->db->query("DELETE FROM pre_construction_activities_encroachment_eviction_location WHERE project_id = '" . $project_id . "' ");
	}
 
 
 
}