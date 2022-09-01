<?php

class Document_upload_model extends CI_Model {
	
	  function __construct() {
      parent :: __construct();
      $this->load->database();
    }

function fetch_issues($project_id) {
    // $this->db->order_by("id", "ASC");
    // $query = $this->db->get("project_communication");

       $this->db->select('*');
        $this->db->from("project_communication");
       // $this->db->join('user', 'project_communication.entered_by = user.id');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result();
}
function fetch_communication() {
  $this->db->order_by("id", "ASC");
  $query = $this->db->get("communication_type_master");
  return $query->result();
    }

   public function save_communication($data) {

            $insert = $this->db->insert('project_communication', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
  }

   function fetch_doc_owner($project_id){
		
	$query = $this->db->query("select eb.*,ec.username,ec.id as user_id from project_creation_linked_user eb INNER join user ec on ec.id=eb.user_id where eb.project_id='".$project_id."' order by eb.user_id ");
			
	if($query->num_rows() > 0){
		return $query->result(); 
	}else{
		return false;
	} }

        public function checkProjectExits( $project_id,$table_name = 'project_communication'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
     public function updatedocument($data,$doc_id) {
      $this->db->where('id', $doc_id);
      $this->db->update('project_communication', $data);
      return TRUE;
  }
   public function getdocuments($id,$projectid) {
      $this->db->select('*');
      $this->db->where('project_communication.project_id', $projectid);
      $this->db->where('project_communication.id', $id);
      //$this->db->limit('1');
      $query = $this->db->get('project_communication');
      return $query->result_array();
   }
      function documents_data($comm_id,$project_id){
        $this->db->select('*');
        $this->db->from('project_communication_document');
        $this->db->where('project_id', $project_id);
        $this->db->where('communication_id',$comm_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
     public function removelist($user_id,$comm_id,$project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->where('communication_id',$comm_id);
      $this->db->where('entered_by',$user_id);
      $this->db->delete('project_communication_document');
    }
  public function add_documents($data)
    {

        $insert = $this->db->insert('project_communication_document', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
 }