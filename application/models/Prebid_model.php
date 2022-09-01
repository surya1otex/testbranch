<?php

class Prebid_model extends CI_Model {
	
  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    public function saveprebid($data) {
    
        $insert = $this->db->insert('tendering_pre_bid', $data);
            if ($insert) {
                $insert_id = $this->db->insert_id();
                return $insert_id > 0 ? $insert_id : false;
            } else {
                return false;
            }
     }


   public function getprebid($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_pre_bid.project_id', $projectid);
      $query = $this->db->get('tendering_pre_bid');
      return $query->result_array();
   }

   public function addbidderdata($data){

        $insert = $this->db->insert('tendering_pre_bid_bidder_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

    public function addbidderdatafile($data){

        $insert = $this->db->insert('tendering_pre_bid_document', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

     public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('tendering_pre_bid_bidder_details');
    }

     public function removefile($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('tendering_pre_bid_document');
    }

     public function checkProjectExits( $project_id,$table_name = 'tendering_pre_bid'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

     public function updateprebid($data,$prebid_id) {
      $this->db->where('id', $prebid_id);
      $this->db->update('tendering_pre_bid', $data);
      return TRUE;
    }
  
    public function prebid_bidder_data($project_id){
      $this->db->select('*');
      $this->db->where('tendering_pre_bid_bidder_details.project_id', $project_id);
      $query = $this->db->get('tendering_pre_bid_bidder_details');
      return $query->result_array();
    }

    public function fetch_meeting_date($project_id){

      $this->db->select('project_administrative_approval_stage.administrative_approval_date as financial_date');
      $this->db->where('project_administrative_approval_stage.project_id', $project_id);
      $query = $this->db->get('project_administrative_approval_stage');
      return $query->result_array();
    }


 
    public function prebid_file($project_id){
      $this->db->select('*');
      $this->db->where('tendering_pre_bid_document.project_id', $project_id);
      $query = $this->db->get('tendering_pre_bid_document');
      return $query->result_array();
    }
    function fetch_country() {
      $this->db->select('*');
      $query = $this->db->get('country_master');
      return $query->result_array();
    }

    function fetch_states($country_id)  {
         $query = $this->db->query("Select eb.*,ec.state_id,ec.state_name from state_master ec inner join country_master eb on ec.state_country_id=eb.country_id where ec.state_country_id='".$country_id."' order by ec.state_name");
              
          if($query->num_rows() > 0){
            return $query->result(); 
          }else{
            return false;
          }

     }
    
	
}