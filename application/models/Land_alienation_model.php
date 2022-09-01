<?php

class Land_alienation_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function savealienation($data) {


            $insert = $this->db->insert('pre_construction_activities_govt_land_alienation', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
  }

  public function updatealianation($data,$landalination_id) {
      $this->db->where('id', $landalination_id);
      $this->db->update('pre_construction_activities_govt_land_alienation', $data);
      return TRUE;
  }
  
function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }

        public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_govt_land_alienation'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
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


  public function getlandalianation($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_govt_land_alienation.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_govt_land_alienation');
      return $query->result_array();
   }

    public function addLandalianation_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_govt_land_alienation_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function admin_approval_date($project_id) {
         $this->db->select('*');
         $this->db->where('project_administrative_approval_stage.project_id', $project_id);
         return $this->db->get('project_administrative_approval_stage')->row()->administrative_approval_date;
    }
    public function checkdistexst($district_id) {
    $this->db->select('*');
    $this->db->where('pre_construction_activities_govt_land_alienation_location.district_id', $district_id);
    $query = $this->db->get('pre_construction_activities_govt_land_alienation_location');
    if($query->num_rows() > 0){
      return TRUE;
      }
    //return $query->result_array();

    }

    public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('pre_construction_activities_govt_land_alienation_location');
    }

        public function updateLandalianation_eviction_location($data)
    {

      
      
        $insert = $this->db->insert('pre_construction_activities_govt_land_alienation_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }


    }
        function alianation_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_govt_land_alienation_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
}