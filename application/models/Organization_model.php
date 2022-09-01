<?php

class Organization_model extends CI_Model
{

    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }


    public function updateUser($data)
    {
        echo $user_id = $data['id'];
        unset($data['id']);
        $this->db->where('id', trim($user_id));
        return $this->db->update('user', $data);
    }

    public function addUser($data)
    {
        if (!empty($data)) {
            $insert = $this->db->insert('user', $data);
            if ($insert) {
                $insert_id = $this->db->insert_id();
                return $insert_id > 0 ? $insert_id : false;
            }
            return false;
        }
        return false;
    }

    /*public function addPermission_old($allow_modules, $user_id)
    {

        foreach ($allow_modules as $key => $val) {
            $temp = [];
            $temp = array('user_id' => $user_id,
                'module_id' => $key,
                'view' => $val,
                'modify' => $val,
                'report' => $val);
            $insert = $this->db->insert('user_role_based_access', $temp);
        }
    }*/
    public function addPermission($allow_modules, $user_id)
    {
        $this->db->query("DELETE FROM user_role_based_access WHERE user_id = '" . $user_id . "'");
        foreach ($allow_modules as $key => $val) {
            $temp = [];
            $temp = array('user_id' => $user_id,
                'module_id' => $key,
                'view' => isset($val['view']) ? $val['view'] : 0,
                'modify' => isset($val['modify']) ? $val['modify'] : 0,
                'report' => 0);
            $insert = $this->db->insert('user_role_based_access', $temp);
        }
    }
    public function get_module_permission( $module_id = 0 ){

        $this->db->select('*');
        $this->db->from('module_master');
        $this->db->where('id', $module_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addMenuPermission($allow_modules, $user_id)
    {
        $this->db->query("DELETE FROM menu_role_based_access WHERE user_id = '" . $user_id . "'");
        foreach ($allow_modules as $key => $val) {
            $temp = [];
            $temp = array('user_id' => $user_id,
                'module_id' => $key,
                'view' => isset($val['view']) ? $val['view'] : 0,
                'modify' => isset($val['modify']) ? $val['modify'] : 0,
                'report' => 0);
            $insert = $this->db->insert('menu_role_based_access', $temp);
        }
    }

  
    public function get_total_projects(  ){
        $this->db->select('count(id) as total_project');
        // $this->db->from('project_detail');
        $this->db->from('project_conceptualisation_stage');
		$query = $this->db->get();
        return $query->result_array();
    }
    public function get_total_users(){
        $this->db->select('count(id) as total_user');
        $this->db->from('organization_user_details');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_sub_menu( $parent_id ){
        $this->db->select('id');
        $this->db->from('module_master');
        $this->db->where('parent_relation_id', $parent_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_sub_no_display_menu($module_id){
        $this->db->select('id');
        $this->db->from('module_master');
        $this->db->where('parent_relation_id', $module_id);
        $this->db->where('menu_display', 'N');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_common_url_menu(){
       $this->db->select('id');
        $this->db->from('module_master');
        $this->db->where('menu_display', 'N');
        $this->db->where('is_hidden', 'Y');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array(); 
    }




    public function getUserDetails($user_id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_super_admin_module_details(){
      $this->db->select('*');

      $this->db->where('status', 'Y');
      $this->db->where('parent_relation_id', 0);
      $this->db->where("(menu_display='Y' OR menu_display='N')", NULL, FALSE);
      //$this->db->where('menu_display', 'Y');
      $this->db->order_by('display_order', 'asc');
      $query = $this->db->get('module_master');
      return $query->result_array();
    }
}


?>