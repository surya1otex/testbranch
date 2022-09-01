<?php

class Project_creation_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    public function getProjectDivision(){
     
        $this->db->select('*');
        $this->db->from('division_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

    }

     function fetch_divisions($circle_id)  {
         $query = $this->db->query("select wm.id as circleid,dm.division_name,dm.id FROM division_master dm inner join wing_master wm ON dm.circle_id = wm.id where dm.circle_id='".$circle_id."'order by dm.division_name");
              
          if($query->num_rows() > 0){
            return $query->result(); 
          }else{
            return false;
          }

     }

     


    function fetchMasterData($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    /*Insert data to the database and return id*/
    function insertDatareturnid($data = array(), $tbl){
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        if($insert){ return  $insert_id; }
        else{ return false; }
    }


     /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }


    public function getFiles( $project_id , $table_name){

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
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

       /*Delete data from database common function*/
    function deleteData($fid, $did, $tbl)
    {
        $this -> db -> where($fid, $did);
        $this -> db -> delete($tbl);
        if ( $this->db->affected_rows() == 1 ) { return TRUE; }
        else {return FALSE;}
    }


    public function getAllUserType()
    {
        $this->db->select('*');
        $this->db->from('user_designation_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }

    public function getProjectUsers( $project_id ){

        $this->db->select('user_id,user_type_id');
        $this->db->from('project_creation_linked_user');
        $this->db->where('project_id', $project_id);
        //$this->db->where('status', 'Y');
        $query = $this->db->get();
        $return = $query->result_array();
        return $return;
    }


    public function getAllUserName()
    {

        $this->db->select('u.*,um.id as uid,um.firstname as firstname, um.lastname as lastname');
        $this->db->from('user as u');

       
        $this->db->join('organization_user_details as um', 'um.user_id = u.id', 'LEFT');
        $this->db->order_by('um.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function insert_Project_users($data, $project_id = 0)
    {
        if ($project_id > 0) {
            $query = $this->db->query("DELETE FROM project_creation_linked_user WHERE project_id = '" . $project_id . "'");
        }
        if (!empty($data)) {

            $insert = $this->db->insert_batch('project_creation_linked_user', $data);
        }
    }

    function project_list_data($admin_id){
        $this -> db -> select('t1.project_name,t1.id,t2.project_type as project_type_name,t3.name as area_name');
        $this -> db -> from('project_creation t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        
        $this -> db -> where('t1.entered_by', $admin_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    /*Check Field value exist or not in specific table*/
    function check_table_data_exist_or_not_condition($tbl,$where){
      $this->db->where($where);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }


}