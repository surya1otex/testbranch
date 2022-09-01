<?php

class Home_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    public function login($data) {
      $this->db->select('user.*,rm.role as role_name');
      $this->db->where('user.username', $data['username']);
      $this->db->where('user.password', md5($data['password']));
      $this->db->where('user.status', 'Y');
      $this->db->limit('1');
      $this->db->join('role_master as rm', 'rm.id = user.role_id', 'LEFT');
      $query = $this->db->get('user');
      return $query->result_array();
    }	
	

    public function login_roledata($role_id) {
      $this->db->select('*');
      $this->db->where('role_master.id', $role_id);
      $this->db->where('role_master.status', 'Y');
      $this->db->limit('1');
      $query = $this->db->get('role_master');
      return $query->result_array();
    }	

	   public function login_org_userdata($user_id) {
      $this->db->select('*');
      $this->db->where('organization_user_details.user_id', $user_id);
      $this->db->limit('1');
      $query = $this->db->get('organization_user_details');
	  //echo $this->db->last_query();die;
      return $query->result_array();
    }


    function check_user_module_permission($whole_url,$user_id){
      
      

       $this->db->select('id');
       $this->db->from('module_master');
       $this->db->where('LOWER(moduleUrl)', $whole_url);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            $module_id =  $row['id'];
        }else{
          $module_id = 0;
        }

        
        $chk_cnt = 0;
        if($module_id > 0){
          $this->db->where('user_id', $user_id);
          $this->db->where('module_id', $module_id);
          $query=$this->db->get('user_role_based_access');
          $chk_cnt = $query->num_rows();
        }

        if($chk_cnt == 0){
          $this->db->select('id');
       $this->db->from('module_master');
       $this->db->where('LOWER(moduleUrl)', $whole_url);
       $this->db->order_by('id','desc');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            $module_id =  $row['id'];
        }else{
          $module_id = 0;
        }

        
        $chk_cnt = 0;
        if($module_id > 0){
          $this->db->where('user_id', $user_id);
          $this->db->where('module_id', $module_id);
          $query=$this->db->get('user_role_based_access');
          $chk_cnt = $query->num_rows();
        }
        }


        return $chk_cnt;
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
    
   function savetoken($data) {
      $insert = $this->db->insert('api_tokens', $data);
        if ($insert) {
            $insert_id = $this->db->insert_id();
            return $insert_id > 0 ? $insert_id : false;
        } else {
            return false;
        }
   }
    
      public function fetch_token_records($token_id) {
      $this->db->select('*');
      $this->db->where('api_tokens.token', $token_id);
      $this->db->limit('1');
      $query = $this->db->get('api_tokens');
      return $query->result_array();
    } 
	
}
?>