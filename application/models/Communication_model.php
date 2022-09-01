<?php

class Communication_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

  //  public function get_projects() {

  //   $query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,area_master.name,COUNT(project_communication.project_id) as communication
  //   from project_conceptualisation_stage pcs
  //   LEFT join project_type_master ON pcs.project_type = project_type_master.id
  //   LEFT join area_master ON pcs.location_id = area_master.id
  //   LEFT join project_communication on project_communication.project_id=pcs.id GROUP BY projectid");

  //     return $query->result();
  // }

    public function get_projects($circle_id,$division_id) {



if($circle_id == 0 && $division_id == 0){



$query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,area_master.name,COUNT(project_communication.project_id) as communication
from project_conceptualisation_stage pcs
LEFT join project_type_master ON pcs.project_type = project_type_master.id
LEFT join area_master ON pcs.location_id = area_master.id
LEFT join project_communication on project_communication.project_id=pcs.id GROUP BY projectid");



return $query->result();
}



elseif($circle_id && $division_id){



$query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,area_master.name,COUNT(project_communication.project_id) as communication
from project_conceptualisation_stage pcs
LEFT join project_type_master ON pcs.project_type = project_type_master.id
LEFT join area_master ON pcs.location_id = area_master.id
LEFT join project_communication on project_communication.project_id=pcs.id where pcs.wing_id = $circle_id AND pcs.division_id = $division_id GROUP BY projectid");



return $query->result();
}



else{




$query = $this->db->query("select pcs.id as projectid,pcs.project_name,project_type_master.project_type,area_master.name,COUNT(project_communication.project_id) as communication
from project_conceptualisation_stage pcs
LEFT join project_type_master ON pcs.project_type = project_type_master.id
LEFT join area_master ON pcs.location_id = area_master.id
LEFT join project_communication on project_communication.project_id=pcs.id where  AND pcs.wing_id = $circle_id GROUP BY projectid");



return $query->result();



}


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