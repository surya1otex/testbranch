<?php

class Technical_evalution_model extends CI_Model {
	
	  function __construct(){
	      parent :: __construct();
	      $this->load->database();
      }

    public function savetechnical($data) {
    
    $insert = $this->db->insert('tendering_technical_evalution', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
     }

  public function updatetechnical($data,$techeval_id) {
      $this->db->where('id', $techeval_id);
      $this->db->update('tendering_technical_evalution', $data);
      return TRUE;
    }

    public function delete_single_user($user_id)
     {

            $this->db->delete('tendering_technical_evalution_bidder_details', array('id' => $user_id));
            $this->db->delete('tendering_financial_evalution_bidder_details', array('bidder_ref_no' => $user_id));
            $this->db->delete('tendering_negotiation_bidder_details', array('bidder_id' => $user_id));

    }

 public function gettechnicalevalutionupdate($projectid) {
    $this->db->select('*');
    $this->db->where('tendering_technical_evalution_bidder_details.project_id', $projectid);
    $query = $this->db->get('tendering_technical_evalution_bidder_details');
    return $query->result_array();
}



public function updatetechnicalid($data,$techevnupdateid) {
    $this->db->where('id', $techevnupdateid);
    $this->db->update('tendering_technical_evalution_bidder_details', $data);
    return TRUE;
}

    
    public function gettechnicalevalution($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_technical_evalution.project_id', $projectid);
      $query = $this->db->get('tendering_technical_evalution');
      return $query->result_array();
   }

   public function checkProjectExits( $project_id,$table_name = 'tendering_technical_evalution'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

  public function technical_evalution_data($project_id){
      $this->db->select('*');
      $this->db->where('tendering_technical_evalution_bidder_details.project_id', $project_id);
      $query = $this->db->get('tendering_technical_evalution_bidder_details');
      return $query->result_array();
    }

    public function addtechnicaleval($data){

        $insert = $this->db->insert('tendering_technical_evalution_bidder_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

   

    
}
