<?php

class Project_administrative_approval_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }
	
	    public function checkProjectExits( $project_id,$table_name = 'project_administrative_approval_stage'){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return count($return) > 0 ? true : false;
    }
	
	  public function get_org_users(){

        $this->db->select('organization_user_details.firstname,organization_user_details.lastname,organization_user_details.user_id,
        user_designation_master.designation');


        $this->db->join('user_designation_master', 'organization_user_details.designation_id = user_designation_master.id', 'LEFT');
        $query = $this->db->get('organization_user_details');
        //echo $this->db->last_query(); die;
        return $query->result_array();

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
   
     public function get_amount_brakup($project_id)
    {
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('aa_amount_breakup_details');
        return $query->result_array();
    }

	
	   public function getProjectAapprovalDetails( $project_id ){

        $this->db->select('*');
        $this->db->from('project_administrative_approval_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return[0];
    }
	
	    public function updateProjectAApprovalDetails($data,$project_id )
    {
        $this->db->where('project_id', $project_id);
		//echo "<pre>";
		//print_r($data);die();
		//echo  $this->db->last_query(); 
        return $this->db->update('project_administrative_approval_stage', $data);
    }
	
	    public function addProjectApproval($data)
    {

        $insert = $this->db->insert('project_administrative_approval_stage', $data);
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
	
	    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

	
	
	/*========================================================================*/


   

}

?>
