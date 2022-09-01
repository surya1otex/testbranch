<?php

class Land_schedule extends CI_Model {

	function __construct(){
      parent :: __construct();
      $this->load->database();
    }

 function fetch_district()
 {

  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }

  function fetch_tahasil($district_id)
 {
  $this->db->where('district_id', $district_id);
  $this->db->order_by('district_id', 'ASC');
  $query = $this->db->get('tahsil_master');
  //$output = '<option value="">Select Tahasil</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->tahsil_name.'">'.$row->tahsil_name.'</option>';
  }
  return $output;
 }
}