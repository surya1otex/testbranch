<?php

class Privateland_dp_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function save_priland_dp($data) {
      $query =  $this->db->insert('pre_construction_activities_pvt_land_direct_purchase', $data);
          if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
  }
  public function update_priland_dp($data,$dp_id) {
      $this->db->where('id', $dp_id);
      $this->db->update('pre_construction_activities_pvt_land_direct_purchase', $data);
      return TRUE;
  }
function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }
        public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_pvt_land_direct_purchase'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
   public function getprivatelanddp($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_pvt_land_direct_purchase.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_pvt_land_direct_purchase');
      return $query->result_array();
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

          function directpurchae_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_pvt_land_direct_purchase_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
        public function checkdistexst($district_id) {
    $this->db->select('*');
    $this->db->where('pre_construction_activities_pvt_land_direct_purchase_location.district_id', $district_id);
    $query = $this->db->get('pre_construction_activities_pvt_land_direct_purchase_location');
    if($query->num_rows() > 0){
      return TRUE;
      }
    //return $query->result_array();

    }
        public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('pre_construction_activities_pvt_land_direct_purchase_location');
    }
  public function direct_purchase_location($data)
    {


   $insert = $this->db->insert('pre_construction_activities_pvt_land_direct_purchase_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }

    }

}