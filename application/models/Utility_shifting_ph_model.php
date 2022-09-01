<?php

class Utility_shifting_ph_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function saveutilityshiftingph($data) {
      $query =  $this->db->insert('pre_construction_activities_utility_shifting_ph', $data);
  
      if($query)
      {
      return true;  
      }
      else
      {
       return false; 
      }
  }
  // public function update_forestland($project_id,$data) {
  //     $this->db->where('project_id', $project_id);
  //     $this->db->update('pre_construction_activities_forest_land', $data);
  //     return TRUE;
  // }
  public function update_utili_ph($data,$id) {
      $this->db->where('id', $id);
      $this->db->update('pre_construction_activities_utility_shifting_ph', $data);
      return TRUE;
  }
          public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_utility_shifting_ph'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }
 function fetch_forest() {
    $this->db->order_by("id", "ASC");
  $query = $this->db->get("forest_division_master");
  return $query->result();
 }
   function fetch_ph_divison($ulb_id){
    
  $query = $this->db->query("Select eb.*,eb.id as ph_division_id,eb.ph_division_name,ec.id as dist_id
       from ph_division_master eb
       left join ulb_master ec on ec.id=eb.ulb_id
       where eb.ulb_id='".$ulb_id."' order by eb.ph_division_name");

      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  } }

  function utilityph_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_utility_shifting_ph_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
    public function addutility_ph_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_utility_shifting_ph_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
    function deleteUtility_ph_location($project_id) {
      $this->db->query("DELETE FROM pre_construction_activities_utility_shifting_ph_location WHERE project_id = '" . $project_id . "' ");
    }
  public function get_utili_ph($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_utility_shifting_ph.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_utility_shifting_ph');
      return $query->result_array();
   }

   function fetch_ulb($district_id){
    
  $query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name,eb.id as ulb_id
       from ulb_master eb
       left join district_master ec on ec.id=eb.district_id
       where eb.district_id='".$district_id."' order by eb.ulb_name ");
      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  } }

   function fetch_ph_division($ulb_id){
    
  // $query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name
  //      from tahsil_master eb
  //      left join district_master ec on ec.id=eb.district_id
  //      where eb.district_id='".$district_id."' order by eb.tahsil_name ");


      $query = $this->db->query("select * from ph_division_master where ulb_id='".$ulb_id."'");
      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  } }
	
}