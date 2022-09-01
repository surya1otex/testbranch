<?php

class Setting_modify_model extends CI_Model {

	function __construct(){
      parent :: __construct();
      $this->load->database();
    }
 function fetch_settings($project_id) {
  $this->db->where('project_id', $project_id);
  $query = $this->db->get('pre_construction_settings');
  return $query->result();
  
 }

}