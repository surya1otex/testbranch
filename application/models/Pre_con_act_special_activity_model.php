<?php

class Pre_con_act_special_activity_model extends CI_Model {

	function __construct(){
      parent :: __construct();
      $this->load->database();
    }


 
 function fetch_agency($project_id){
		
	$query = $this->db->query("select eb.*,ec.username,ec.id as user_id from project_creation_linked_user eb INNER join user ec on ec.id=eb.user_id where eb.project_id='".$project_id."' order by eb.user_id ");
			
	if($query->num_rows() > 0){
		return $query->result(); 
	}else{
		return false;
	} }
	
	
	    public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_special_activity'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
      function specialactivity_data($project_id){
      $this -> db -> select('*');
        $this -> db -> from('pre_construction_activities_special_activity');
        $this -> db -> where('project_id', $project_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result_array(); }
        else{ return false; }
    }
     public function addspecial_activity($data)
    {

        $insert = $this->db->insert('pre_construction_activities_special_activity', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    } 
    public function updatespeical_activity($db_data,$special_activity_id)
    {
        $this->db->where('id', $special_activity_id);
        return $this->db->update('pre_construction_activities_special_activity', $db_data);
    }
  public function deleteEncroachment_eviction_location($project_id)
    {
		
      $this->db->query("DELETE FROM pre_construction_activities_encroachment_eviction_location WHERE project_id = '" . $project_id . "' ");
	}
 
 
 
}