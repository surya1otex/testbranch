<?php

class Setting_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    public function savesettings($data) {
      $query =  $this->db->insert('pre_construction_settings', $data);
  
   if($query)
    {
    return true;  
    }
    else
    {
    return false; 
    }
  }

   public function getsettings($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_settings.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_settings');
      return $query->result_array();
   }

   public function updatesettings($projectid,$data) {
   	  $this->db->where('project_id', $projectid);
   	  $this->db->update('pre_construction_settings', $data);
   }
	
}