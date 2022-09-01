<?php

class Tree_cutting_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  public function savetreecutting($data) {
      $query =  $this->db->insert('pre_construction_activities_tree_cutting', $data);
  
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
          public function checkProjectExits( $project_id,$table_name = 'pre_construction_activities_tree_cutting'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
 function fetch_forest() {
    $this->db->order_by("id", "ASC");
  $query = $this->db->get("forest_division_master");
  return $query->result();
 }
  function fetch_ofdc() {
    $this->db->order_by("id", "ASC");
  $query = $this->db->get("ofdc_master");
  return $query->result();
 }

function fetch_district()
 {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("district_master");
  return $query->result();
 }
    public function gettreecutting($projectid) {
      $this->db->select('*');
      $this->db->where('pre_construction_activities_tree_cutting.project_id', $projectid);
      $this->db->limit('1');
      $query = $this->db->get('pre_construction_activities_tree_cutting');
      return $query->result_array();
   }

  public function update_treecutting($data,$id) {
      $this->db->where('id', $id);
      $this->db->update('pre_construction_activities_tree_cutting', $data);
      return TRUE;
  }
    public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('pre_construction_activities_tree_cutting_location');
    }
  public function treecutting_location($data)
    {

        $insert = $this->db->insert('pre_construction_activities_tree_cutting_location', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

function treecutting_location_data($project_id){
        $this->db->select('*');
        $this->db->from('pre_construction_activities_tree_cutting_location');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }



}