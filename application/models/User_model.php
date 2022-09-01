<?php
class User_model extends CI_Model {

	function __construct(){
		parent :: __construct();
        $this->load->database();
	}



	 public function getProjectCircle(){
     
        $this->db->select('*');
        $this->db->from('wing_master');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();

    }

	function get_user_type($user_type_id=Null){
      $this->db->select('*');
      if(!empty($user_type_id)){
      	$this->db->where('id', $user_type_id);
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('user_type_master');
      //echo $this->db->last_query();die;
	  return $query->result_array();
    }
	function get_loging_user_type($user_type_id=Null){
		$this->db->select('*');
		if(!empty($user_type_id)){
			$this->db->where('id', $user_type_id);
		}
		$this->db->where('status', 'Y');
		$query = $this->db->get('user');
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function get_user_list(){

		/*$this->db->select('*');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('user');
	    return $query->result_array();*/
		$this->db->select('organization_user_details.*,user.username as username,user_designation_master.designation as type');
		$this->db->from('organization_user_details');
		$this->db->join('user', 'user.id = organization_user_details.user_id','left');
		$this->db->join('user_designation_master', 'user_designation_master.id = organization_user_details.designation_id','left');
		$query = $this->db->get();
		return $query->result_array();
    }


	function get_user_details($userId){

		/*$this->db->select('*');
		$this->db->from('organization_user_details');
		$this->db->where('id', $userId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;*/
		$this->db->select('organization_user_details.*,user.username as username,user.role_id as role_id,user.circle_id as circle_id,user.division_id as division_id');
		$this->db->from('organization_user_details');
		$this->db->join('user', 'user.id = organization_user_details.user_id','left');
		$this->db->where('user.id', $userId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	function get_module_details(){
      $this->db->select('*');

      $this->db->where('status', 'Y');
      $this->db->where('parent_relation_id', 0);
      $this->db->where('menu_display', 'Y');
      $this->db->order_by('display_order', 'asc');
      $query = $this->db->get('module_master');
	  return $query->result_array();
    }
	function getAllModule(){
		$this->db->select('*');
		$this->db->order_by("moduleName","asc");
		$this->db->where('status', 'Y');
//		$this->db->where('parent_relation_id', 0);
		$this->db->where('menu_display', 'Y');
		$this->db->order_by('display_order', 'asc');

		$query = $this->db->get('module_master');
		return $query->result_array();
	}

	function getSubModule( $module_id ){
		$this->db->select('*');
		//$this->db->order_by("moduleName","asc");
		$this->db->where('status', 'Y');
		$this->db->where('parent_relation_id',$module_id );
		$this->db->where('menu_display', 'Y');
		$this->db->where('is_hidden', 'N');

		//$this->db->where("(module_master.menu_display='Y' OR module_master.menu_display='N')", NULL, FALSE);
		$this->db->order_by('display_order', 'asc');
		$query = $this->db->get('module_master');
		return $query->result_array();
	}

	function get_module_details_permission( $user_id = 0 ){

		if( $user_id == 0 ){
			$this->db->distinct();
		}
		$this->db->select('module_master.moduleName,module_master.id as id , module_master.moduleLabel,user_role_based_access.view,user_role_based_access.modify as manage');
		$this->db->from('module_master');
		$this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
		if( $user_id > 0 ){
			$this->db->where('user_role_based_access.user_id', $user_id);
			//$this->db->where('user_role_based_access.view', 1);
		}
		$this->db->where('module_master.parent_relation_id',0 );
		$this->db->where('module_master.status', 'Y');
		$this->db->where('module_master.menu_display', 'Y');
		$this->db->where('module_master.is_hidden', 'N');
		//$this->db->where("(module_master.menu_display='Y' OR module_master.menu_display='N')", NULL, FALSE);
		$this->db->order_by('module_master.display_order', 'asc');
		$this->db->group_by('module_master.id');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
		return $result;

	}

	function get_common_module_details_permission( $user_id = 0 ){

		if( $user_id == 0 ){
			$this->db->distinct();
		}
		$this->db->select('module_master.moduleName,module_master.id as id , module_master.moduleLabel,user_role_based_access.view,user_role_based_access.modify as manage');
		$this->db->from('module_master');
		$this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
		if( $user_id > 0 ){
			$this->db->where('user_role_based_access.user_id', $user_id);
			//$this->db->where('user_role_based_access.view', 1);
		}
		$this->db->where('module_master.status', 'Y');
		$this->db->where('module_master.parent_relation_id', 0);
		$this->db->where('module_master.menu_display', 'N');
		$this->db->where('module_master.is_hidden', 'Y');
		$this->db->order_by('module_master.display_order', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
		return $result;

	}

	function getCommon_SubModule($module_id){
		$this->db->select('*');
		//$this->db->order_by("moduleName","asc");
		$this->db->where('status', 'Y');
		$this->db->where('parent_relation_id',$module_id );
		$this->db->where('menu_display', 'N');
		$this->db->where('is_hidden', 'Y');
		$this->db->order_by('display_order', 'asc');
		$query = $this->db->get('module_master');
		return $query->result_array();
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

	function get_user_access_details($userId){
		$this->db->select('*');
		$this->db->from('user_role_based_access');
		$this->db->where('user_id', $userId);
	    $query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query();die;
	    return $result;
	}

	public function check_duplicate_username($username){
		  $this->db->select('*');
		  $this->db->from('user');
		  $this->db->where('username', $username);
		  $query = $this->db->get();
		  $result = $query->result_array();
		  if(!empty($result[0])){ // email already exist
		  	return 1;
		  }else{ // email doesn't exist
		  	return 0;
		  }
	}


	function add_user_basic_info($data_array) {
       if(isset($data_array['field_data'])){
            $insert    = $this->db->insert('organization_user_details',$data_array['field_data']);
            $insert_id = $this->db->insert_id();
            if($insert_id > 0)
            {
                return $insert_id;
            }
        }
    }
	function add_user($data_array) {
		if(!empty($data_array)){
			$insert    = $this->db->insert('user',$data_array);
			$insert_id = $this->db->insert_id();
			if($insert_id > 0)
			{
				return $insert_id;
			}
		}
	}


    function add_user_roles($data_role_array) {

       if(isset($data_role_array['field_data'])){
            $insert    = $this->db->insert('user_role_based_access',$data_role_array['field_data']);
		// echo $this->db->last_query();die;
       }
    }

    function get_sub_no_display_menu($module_id){
    	$this->db->select('id');
        $this->db->from('module_master');
        $this->db->where('parent_relation_id', $module_id);
        $this->db->where('menu_display', 'N');
        $this->db->where('is_hidden', 'N');
        $this->db->where('status', 'Y');
        $query = $this->db->get();
        return $query->result_array();
    }

  public function add_module_Permission($allow_modules, $user_id)
    {
        $this->db->query("DELETE FROM user_role_based_access WHERE user_id = '" . $user_id . "'");
		/*echo "<pre>";
		print_r($allow_modules);
		echo "</pre>";
		die;*/
        foreach ($allow_modules as $key => $val) {
            $temp = [];
            $temp = array(
            	'user_id' => $user_id,
                'module_id' => $key,
                'view' => isset($val['view']) ? $val['view'] : 0,
                'modify' => isset($val['modify']) ? $val['modify'] : 0,
                );
            $insert = $this->db->insert('user_role_based_access', $temp);
			//echo $this->db->last_query();die;
        }
    }

    function getModuleAccessInfoByUser($userId,$moduleId){

		$this->db->select('*');
		$this->db->from('user_role_based_access');
		$this->db->where('user_id', $userId);
		$this->db->where('module_id', $moduleId);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
	    return $result;
	}
	function getMenuAccessInfoByUser($userId,$moduleId){
		$this->db->select('*');
		$this->db->from('menu_role_based_access');
		$this->db->where('user_id', $userId);
		$this->db->where('module_id', $moduleId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	function update_user_basic_info($userId,$first_name,$last_name,$email,$user_type,$status,$modified_by,$mobile)
		{

		   if(!empty($userId)){
		   		$data['firstname'] = $first_name;
		   		$data['lastname'] = $last_name;
		   		$data['email'] = $email;
		   		$data['mobile'] = $mobile;
				$data['designation_id'] = $user_type;
		   		$data['status'] = $status;
		   		$data['modified_by'] = $modified_by;

		   		$table = "organization_user_details";
	            $this->db->where('user_id = ' . "'".$userId."'");
				$this->db->update($table,$data);
	            return true;
			}
			else{
		        return false;
		    }
	}
	public function update_user_typeid($existingUserId,$username,$password,$usertype){

		if(!empty($existingUserId)){

			$data['username'] = $username;
			$data['user_type'] = $usertype;
			

			if( !empty($password)){
				$data['password'] = md5($password);
			}
			$table = "user";
			$this->db->where('id = ' . "'".$existingUserId."'");
			$this->db->update($table,$data);
			return true;
		}
		else{
			return false;
		}
	}

	public function update_user($existingUserId,$username,$password,$user_type,$circle_id,$division_id){

		if(!empty($existingUserId)){

			$data['username'] = $username;
            $data['user_type'] = $user_type;
            $data['circle_id'] = $circle_id;
            $data['division_id'] = $division_id;
			if( !empty($password)){
				$data['password'] = md5($password);
			}
			$table = "user";
			$this->db->where('id = ' . "'".$existingUserId."'");
			$this->db->update($table,$data);
			return true;
		}
		else{
			return false;
		}
	}

    function delete_user_roles($userId){
			$query = $this->db->query("DELETE FROM user_role_based_access WHERE user_id = '".$userId."'");

    }

    public function get_user_menu_acces_detail($user_id){

        $this->db->select('module_master.id as module_id,module_master.menu_icon,module_master.menu_description,module_master.moduleUrl,module_master.moduleLabel,module_master.moduleName,user_role_based_access.modify,user_role_based_access.report,user_role_based_access.view');
        $this->db->from('module_master');
        $this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
        $this->db->where('user_role_based_access.user_id', $user_id);
        $this->db->where('module_master.parent_relation_id', 0);
		$this->db->where('module_master.menu_display', 'Y');
		$this->db->order_by('module_master.display_order', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();die;
        return $result;
    }
	public function get_sub_menu( $parent_module_id = 0 , $user_id){
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('module_master');
		$this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
		$this->db->where('module_master.parent_relation_id', $parent_module_id);
		$this->db->where('module_master.menu_display', 'Y');
		$this->db->where('user_role_based_access.user_id', $user_id);
		$this->db->order_by('module_master.display_order', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result = $query->result_array();
		return $result;
	}

	// Code by 
	public function get_role_based_access_details($user_id,$module_id){
		$this->db->select('module_master.moduleName,module_master.moduleLabel,user_role_based_access.modify,user_role_based_access.report,user_role_based_access.view');
		$this->db->from('module_master');
		$this->db->join('user_role_based_access', 'module_master.id = user_role_based_access.module_id','left');
		$this->db->where('user_role_based_access.user_id', $user_id);
		$this->db->where('user_role_based_access.module_id', $module_id);
		$query = $this->db->get();
		$result = $query->result_array();
        //echo $this->db->last_query();die;
	    return $result;
	}
	// Code by  End


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

    /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }
	//End Code bY Somnath 10-08-2020 
	
	
	public function getAllUserRole()
	{
		$this->db->select('*');
		$this->db->from('role_master');
		$this->db->where('status', 'Y');
		$query = $this->db->get();
		$return = $query->result_array();
		return $return;
	}
	
	   function getModuleAccessByRole($role_id,$module_id){

    	$this->db->select('*');
		$this->db->from('role_wise_module_mapping');
		$this->db->where('role_id', $role_id);
		$this->db->where('module_id', $module_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->result_array();
	    return $result;

    }
	
	
     public function get_module_permission( $module_id = 0 ){

        $this->db->select('*');
        $this->db->from('module_master');
        $this->db->where('id', $module_id);
        $query = $this->db->get();
        return $query->result_array();
    }

	
	
	function get_higher_level_recipient(){
		$this->db->select('*');
		$this->db->from('recipient_master');
		$this->db->where('status', 'Y');
	    $query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query();die;
	    return $result;
	}
	
	
    function get_delayed_project_Alldata(){
      
        $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             Select *  from
(SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
            
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.project_id IS NOT NULL ");
        //echo $this->db->last_query(); die;
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function fetch_divisions($circle_id)  {
         $query = $this->db->query("select wm.id as circleid,dm.division_name,dm.id FROM division_master dm inner join wing_master wm ON dm.circle_id = wm.id where dm.circle_id='".$circle_id."'order by dm.division_name");
              
          if($query->num_rows() > 0){
            return $query->result(); 
          }else{
            return false;
          }

     }


}

?>
