<?php

class Negotiation_model extends CI_Model {
    
      function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    public function savenegotiation($data) {
    $insert = $this->db->insert('tendering_negotiation', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }

   public function updatenego($data,$negotiation_id) {
      $this->db->where('id', $negotiation_id);
      $this->db->update('tendering_negotiation', $data);
      return TRUE;
    }

    public function checkProjectExits( $project_id,$table_name = 'tendering_negotiation'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }

    public function getnegotiation($projectid) {
     
      $this->db->select('*');
      $this->db->where('tendering_negotiation.project_id', $projectid);
      $query = $this->db->get('tendering_negotiation');
      return $query->result_array();
   }

   public function updatenegotiation($data,$negotiation_id){
      $this->db->where('id', $negotiation_id);
      $this->db->update('tendering_negotiation', $data);
      return TRUE;
   }

    public function negotiation_data_form_technical($project_id){
        
      $this->db->select('tendering_financial_evalution_bidder_details.*,tendering_financial_evalution.approval_date as datefinance,tendering_technical_evalution_bidder_details.bidder_ref_no as bidder_name');

       $this->db->join('tendering_technical_evalution_bidder_details','tendering_technical_evalution_bidder_details.id = tendering_financial_evalution_bidder_details.bidder_ref_no');

       $this->db->join('tendering_financial_evalution','tendering_financial_evalution.project_id = tendering_financial_evalution_bidder_details.project_id');

      $this->db->where('tendering_financial_evalution_bidder_details.project_id', $project_id);
      $this->db->where_in('successful_bidder',array('L1','L2','L3'));
      $this->db->order_by("successful_bidder ", "asc");
      $query = $this->db->get('tendering_financial_evalution_bidder_details');
      return $query->result_array();
    }


    public function negotiation_data($project_id){
      $this->db->select('tendering_negotiation_bidder_details.*,tendering_technical_evalution_bidder_details.bidder_ref_no as bidder_name,tendering_financial_evalution_bidder_details.bid_value as neo_bid_value,tendering_financial_evalution.approval_date as datefinanceedit');
      
      $this->db->join('tendering_technical_evalution_bidder_details','tendering_technical_evalution_bidder_details.id = tendering_negotiation_bidder_details.bidder_id');

      $this->db->join('tendering_financial_evalution_bidder_details','tendering_financial_evalution_bidder_details.bidder_ref_no = tendering_negotiation_bidder_details.bidder_id');
      $this->db->join('tendering_financial_evalution','tendering_financial_evalution.project_id = tendering_negotiation_bidder_details.project_id');

      $this->db->where('tendering_negotiation_bidder_details.project_id', $project_id);
      $this->db->order_by("successful_bidder ", "asc");
      $query = $this->db->get('tendering_negotiation_bidder_details');
      return $query->result_array();
    }

    public function negotiation_added_data($project_id){


        $query = $this->db->query("
       select tfebd.id,tfebd.bidder_ref_no,ttebd.bidder_ref_no as biddername from tendering_financial_evalution_bidder_details tfebd
join tendering_technical_evalution_bidder_details ttebd on ttebd.id = tfebd.bidder_ref_no
where tfebd.bidder_ref_no not in (SELECT bidder_id FROM tendering_negotiation_bidder_details) and tfebd.project_id=".$project_id." and tfebd.successful_bidder!='N'
UNION
select tnbd.id, tnbd.bidder_id,ttebd.bidder_ref_no as biddername from tendering_negotiation_bidder_details tnbd
join tendering_technical_evalution_bidder_details ttebd on ttebd.id=tnbd.bidder_id 
where tnbd.bidder_id not in (SELECT bidder_ref_no FROM tendering_financial_evalution_bidder_details) and tnbd.project_id=".$project_id."
");
    
      return $query->result_array();  
    }



     public function negotiation_data_update($project_id){
      $this->db->select('*');
      $this->db->where('tendering_negotiation_bidder_details.project_id', $project_id);
      $query = $this->db->get('tendering_negotiation_bidder_details');
      return $query->result_array();
    }

    public function addnegotiation($data){

        $insert = $this->db->insert('tendering_negotiation_bidder_details', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    } 

    public function updatenegoid($data,$nego_id) {
      $this->db->where('id', $nego_id);
      $this->db->update('tendering_negotiation_bidder_details', $data);
      return TRUE;
    }

    
}