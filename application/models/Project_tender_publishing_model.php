<?php

class Project_tender_publishing_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }
	
	
	
	    public function checkProjectExits( $project_id,$table_name = 'project_tender_stage'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
	 public function getProjectTenderDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_tender_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
		    /*get Specific field data*/
   function getSpecificdata($table,$field,$get_id,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field, $get_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
   }
   
	
    public function addProjectTenderPublishing($data)
    {
        $insert = $this->db->insert('project_tender_stage', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
    }
	
	    public function getFiles( $project_id , $table_name){

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }
	
	    /*Delete data from database common function*/
    function deleteData($fid, $did, $tbl)
    {
        $this -> db -> where($fid, $did);
        $this -> db -> delete($tbl);
        if ( $this->db->affected_rows() == 1 ) { return TRUE; }
        else {return FALSE;}
    }
	
	   public function updateProjectTenderPunlishingDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
        return $this->db->update('project_tender_stage', $data);
    }
	
	    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

	
	
	/*========================================================================*/


   

}

?>
