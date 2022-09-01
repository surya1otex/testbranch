<?php

class Pre_con_act_quick_nav_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }


    public function project_pre_construction_settings_data($project_id = Null)
    {
        $this->db->select('*');
        $this->db->from('pre_construction_settings');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result_array();
                
       
    }


    /*Check Field value exist or not in specific table*/
    function check_pre_construction_quick_nav_value_exist_or_not_in_tbl($tbl,$field,$value){
      $this->db->where($field, $value);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

     function get_quick_nav_data_against_value($table,$field,$get_id,$specifc_field){
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


}