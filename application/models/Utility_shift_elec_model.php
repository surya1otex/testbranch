<?php

class Utility_shift_elec_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function save_utility_electrical($data) {
      $query =  $this->db->insert('pre_construction_activities_utility_shifting_electrical', $data);
  
      if($query)
      {
      return true;  
      }
      else
      {
       return false; 
      }
  }
  public function update_env_clearance($project_id,$data) {
      $this->db->where('project_id', $project_id);
      $this->db->update('pre_construction_activities_environment_clearance', $data);
      return TRUE;
  }
function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }
 function fetch_divisons()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("division_master");
  return $query->result();
 }
     public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_utility_shifting_electrical'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

 function fetch_discom($division_id){
    
  // $query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name
  //      from tahsil_master eb
  //      left join district_master ec on ec.id=eb.district_id
  //      where eb.district_id='".$district_id."' order by eb.tahsil_name ");


      $query = $this->db->query("select * from discom_master where electrical_division_id='".$division_id."'");
      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  } }

 // function fetch_division() {
 //    $this->db->order_by("id", "ASC");
 //  $query = $this->db->get("division_master");
 //  return $query->result();
 // }
  
   public function get_env_clearance($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_environment_clearance.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_environment_clearance');
      return $query->result_array();
   }

    public function get_utilityahift_elec($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_utility_shifting_electrical.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_utility_shifting_electrical');
      return $query->result_array();
   }

     public function update_utility_elec($data,$id) {
      $this->db->where('id', $id);
      $this->db->update('pre_construction_activities_utility_shifting_electrical', $data);
      return TRUE;
  }

    public function addutility_electric_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_utility_shifting_electric_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    function deleteUtility_location($project_id) {
      $this->db->query("DELETE FROM pre_construction_activities_utility_shifting_electric_location WHERE project_id = '" . $project_id . "' ");
    }
    function utilityelectrical_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_utility_shifting_electric_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
   function fetch_divison($district_id){
    
  $query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name,eb.id as division_id
       from division_master eb
       left join district_master ec on ec.id=eb.district_id
       where eb.district_id='".$district_id."' order by eb.division_name ");
      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  } }

        function discom_listing($division_id){
        $this->db->select('*');
        $this->db->from('discom_master');
        $this->db->where('electrical_division_id', $division_id);
        $query = $this->db->get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	
}