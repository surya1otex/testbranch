<?php

class Financial_evalution_model extends CI_Model {
    
      function __construct(){
          parent :: __construct();
          $this->load->database();
    }

   public function savefinancial($data) {
    
    $insert = $this->db->insert('tendering_financial_evalution', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
     }

   public function updatefinancial($data,$financialeval_id) {
      $this->db->where('id', $financialeval_id);
      $this->db->update('tendering_financial_evalution', $data);
      return TRUE;
    }
  
   public function updatefinancialid($data,$techevnupdateid) {
      $this->db->where('id', $techevnupdateid);
      $this->db->update('tendering_financial_evalution_bidder_details', $data);
      return TRUE;
    }

  public function checkProjectExits( $project_id,$table_name = 'tendering_financial_evalution'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

  public function getfinancialevalution($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_financial_evalution.project_id', $projectid);
      $query = $this->db->get('tendering_financial_evalution');
      return $query->result_array();
   }

   public function getfinancialevalutionupdate($projectid) {
      $this->db->select('*');
      $this->db->where('tendering_financial_evalution_bidder_details.project_id', $projectid);
      $query = $this->db->get('tendering_financial_evalution_bidder_details');
      return $query->result_array();
   }
   
   // delete

 public function delete_single_user($user_id)  
      {  
           $this->db->where("id", $user_id);  
           $this->db->delete("tendering_financial_evalution_bidder_details");  
             
      } 
 
    // delete

    // public function removelist($project_id) {
    //   $this->db->where('project_id', $project_id);
    //   $this->db->delete('tendering_financial_evalution_bidder_details');
    // }

      // public function financial_evalution_data($project_id){
      //     $this->db->select('*');
      //     $this->db->where('tendering_financial_evalution_bidder_details.project_id', $project_id);
      //     $query = $this->db->get('tendering_financial_evalution_bidder_details');
      //     return $query->result_array();
      //   }

  public function financial_evalution_data($project_id){
      $this->db->select('tendering_financial_evalution_bidder_details.*,tendering_technical_evalution_bidder_details.bidder_ref_no as bidder_name');
      $this->db->join('tendering_technical_evalution_bidder_details','tendering_technical_evalution_bidder_details.id = tendering_financial_evalution_bidder_details.bidder_ref_no');
      $this->db->where('tendering_financial_evalution_bidder_details.project_id', $project_id);
      $query = $this->db->get('tendering_financial_evalution_bidder_details');
      return $query->result_array();
    }

    public function financial_evalution_added_data($project_id){

        $query = $this->db->query("
        select id,bidder_ref_no from tendering_technical_evalution_bidder_details
where id not in (SELECT bidder_ref_no FROM tendering_financial_evalution_bidder_details) and project_id=".$project_id." and technical_status='Y'
UNION
select id, bidder_ref_no from tendering_financial_evalution_bidder_details
where bidder_ref_no not in (SELECT id FROM tendering_technical_evalution_bidder_details) and project_id=".$project_id."
");
    
      return $query->result_array(); 

    }

  public function financial_evalution_data_form_technical($project_id){
      $this->db->select('*');
      $this->db->where('tendering_technical_evalution_bidder_details.project_id', $project_id);
      $this->db->where('technical_status =', 'Y' );
      $query = $this->db->get('tendering_technical_evalution_bidder_details');
      return $query->result_array();
    }

 public function addfinancial($data){

        $insert = $this->db->insert('tendering_financial_evalution_bidder_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    } 

    
}