<?php

class Environmental_clearance_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function save_env_clearance($data) {
      $query =  $this->db->insert('pre_construction_activities_environment_clearance', $data);
  
      if($query)
      {
      return true;  
      }
      else
      {
       return false; 
      }
  }
  public function update_env_clearance($data,$id) {
      $this->db->where('id', $id);
      $this->db->update('pre_construction_activities_environment_clearance', $data);
      return TRUE;
  }

            public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_environment_clearance'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
   public function get_env_clearance($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_environment_clearance.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_environment_clearance');
      return $query->result_array();
   }
	
}