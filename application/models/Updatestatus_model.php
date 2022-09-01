<?php

class Updatestatus_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  //  public function get_projects() {


  //   // $query = $this->db->query("select pcs.id as projectid,pcs.project_name,COUNT(update_status_issues.project_id) as issuecount,project_type_master.project_type,area_master.name,update_status_issues.current_status,update_status_issues.issues
  //   // from project_conceptualisation_stage pcs
  //   // LEFT join project_type_master ON pcs.project_type = project_type_master.id
  //   // LEFT join area_master ON pcs.location_id = area_master.id
  //   // LEFT join update_status_issues on update_status_issues.project_id=pcs.id GROUP BY projectid");




  // }

public function get_projects($circle_id,$division_id) {


    if($circle_id == 0 && $division_id == 0){

    $query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,COUNT(update_status_issues.project_id) as issuecount,area_master.name,update_status_issues.current_status,update_status_issues.issues
    from project_conceptualisation_stage pcs

    LEFT join project_type_master ON pcs.project_type = project_type_master.id
    LEFT join area_master ON pcs.location_id = area_master.id
    LEFT join update_status_issues on update_status_issues.project_id=pcs.id
     GROUP BY projectid");

    return $query->result();
    }


    elseif($circle_id && $division_id){

    $query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,COUNT(update_status_issues.project_id) as issuecount,area_master.name,update_status_issues.current_status,update_status_issues.issues
    from project_conceptualisation_stage pcs

    LEFT join project_type_master ON pcs.project_type = project_type_master.id
    LEFT join area_master ON pcs.location_id = area_master.id
    LEFT join update_status_issues on update_status_issues.project_id=pcs.id
    WHERE  pcs.wing_id = $circle_id AND pcs.division_id = $division_id GROUP BY projectid");

    return $query->result();
    }

    else{

    $query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,COUNT(update_status_issues.project_id) as issuecount,area_master.name,update_status_issues.current_status,update_status_issues.issues
    from project_conceptualisation_stage pcs

    LEFT join project_type_master ON pcs.project_type = project_type_master.id
    LEFT join area_master ON pcs.location_id = area_master.id
    LEFT join update_status_issues on update_status_issues.project_id=pcs.id
    WHERE  pcs.wing_id = $circle_id GROUP BY projectid");

    return $query->result();
    }

}
  public function save_update_status($data) {
      $query =  $this->db->insert('update_status_issues', $data);
          if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
  }

    public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('update_status_issues');
    }
    
    public function update_status($data,$dp_id) {
      $this->db->where('id', $dp_id);
      $this->db->update('update_status_issues', $data);
      return TRUE;
  }
  public function checkProjectExits( $project_id,$table_name = 'update_status_issues'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

  public function getupdatestatus($projectid) {
      $this->db->select('*');
      $this->db->from('update_status_issues');
      $this->db->where('project_id', $projectid);
      $query = $this->db->get();
      if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
   }


  public function get_communications($project_id) {
     $query = $this->db->query("SELECT COUNT(*) AS communication FROM project_communication WHERE project_id='".$project_id."'");
    if($query->num_rows() > 0)
        {
            $result = $query->row_array();

            return $result;

            //return $result['communication'];
        }
  }
}