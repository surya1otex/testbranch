<?php

class Privateland_la_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function save_priland_la($data) {
      $query =  $this->db->insert('pre_construction_activities_pvt_land_acquistion', $data);
            if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
  }
      function fetch_tahasil($district_id)  {
    
  $query = $this->db->query("Select eb.*,ec.id as dist_id,ec.district_name
       from tahsil_master eb
       left join district_master ec on ec.id=eb.district_id
       where eb.district_id='".$district_id."' order by eb.tahsil_name ");
      
  if($query->num_rows() > 0){
    return $query->result(); 
  }else{
    return false;
  }

  }
          public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_pvt_land_acquistion'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
      function landacquisition_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_pvt_land_acquistion_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
        public function checkdistexst($district_id) {
    $this->db->select('*');
    $this->db->where('pre_construction_activities_pvt_land_acquistion_location.district_id', $district_id);
    $query = $this->db->get('pre_construction_activities_pvt_land_acquistion_location');
    if($query->num_rows() > 0){
      return TRUE;
      }
    //return $query->result_array();

    }
        public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('pre_construction_activities_pvt_land_acquistion_location');
    }

  public function update_priland_la($data,$id) {
      $this->db->where('id', $id);
      $this->db->update('pre_construction_activities_pvt_land_acquistion', $data);
      return TRUE;
  }
function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }
   public function getprivatelandla($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_pvt_land_acquistion.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_pvt_land_acquistion');
      return $query->result_array();
   }
        public function land_acquisition_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_pvt_land_acquistion_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
}