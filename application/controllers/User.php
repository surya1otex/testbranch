<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('User_model');
        $this->load->model('Procurement_model');
        $this->load->model('Organization_model');

        $this->allowedModule = array(1 => true, 2 => false, 3 => false, 4 => false, 5 => false, 6 => false, 7 => false);
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }

    public function user_list()
    {
        $admin_id = $this->session->userdata('id');
        $data['userList'] = $this->User_model->get_user_list();
        $this->load->common_template('user/list_user', $data);
    }

    public function user_type($user_type_id = Null)
    {
        return $this->User_model->get_user_type($user_type_id);
    }

    public function add_user()
    {
        $admin_id = $this->session->userdata('id');
        $data['userType'] = $this->User_model->getAllUserType();
        $data['userRole'] = $this->User_model->getAllUserRole();
        $data['circles'] = $this->User_model->getProjectCircle();
        $data['module_details'] = $this->User_model->get_module_details_permission();

        if (!empty($_REQUEST['user_id'])) {
            $userId = base64_decode($_REQUEST['user_id']);
            $data["userId"] = $userId;
            $data["user_details"] = $this->User_model->get_user_details($userId);
            $data["user_access_details"] = $this->User_model->get_user_access_details($userId);

        }

       

            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('user_type', 'User Type', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('user_role', 'User Role', 'required');
            $this->form_validation->set_rules('user_role', 'User Role', 'required');
                
                  
          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
          $this->form_validation->set_message('required', 'Enter %s');  
          if ($this->form_validation->run() == false){
            $this->load->common_template('user/add_user', $data);
          }else{

            $existingUserId = $this->input->post('existingUserId');
            if (!empty($existingUserId) && ($existingUserId > 0)) {//Edit existing user
                $first_name = htmlentities($this->input->post('firstname'));
                $last_name = htmlentities($this->input->post('lastname'));
                $email = htmlentities($this->input->post('email'));
                $mobile = htmlentities($this->input->post('mobile'));
                $username = htmlentities($this->input->post('username'));
                $password = ($this->input->post('password') ) ? $this->input->post('password') : "";
                $circle_id = htmlentities($this->input->post('project_circle_user'));
                $division_id = htmlentities($this->input->post('project_division_user'));
                $user_type = $this->input->post('user_type');
                $status = 'Y';
                $modified_by = $admin_id;


                if (!empty($password)) {
                    if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $password)) {
                    } else {
                        $this->session->set_flashdata('message', 'Password must contain Minimum 8 characters at least 1 Alphabet, 1 Number, 1 Capital and 1 Special Character.');
                        redirect('User/add_user?user_id='.base64_encode($existingUserId));

                    }
                }

                $this->User_model->update_user_basic_info($existingUserId, $first_name, $last_name, $email, $user_type, $status, $modified_by, $mobile);

                if($user_type == 37) {
                     $this->User_model->update_user_typeid($existingUserId, $username, $password, $user_type);
                   }
                   else {
                      $user_type = 3;
                      $this->User_model->update_user($existingUserId, $username, $password, $user_type,$circle_id,$division_id);
                   }
				
				
				$post_data['modify'] = $_REQUEST['modify'];
				$post_data['view'] = $_REQUEST['view'];

				$this->add_User_Module_Permission($existingUserId,$post_data);

                
            $this->session->set_flashdata('success', 'User Updated successfully');

                redirect('User/user_list');

            } else {  // Add New
                // checking duplicate email
                $check_duplicate_email_status = $this->User_model->check_duplicate_username($this->input->post('username'));

                if ($check_duplicate_email_status > 0) {
                    $this->session->set_flashdata('message', 'Username already exists!');
                    redirect('User/add_user');
                }

                if (preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $_REQUEST['password'])) {

                    $user_field_data = array(
                        'username' => htmlentities($this->input->post('username')),

                        'password' => md5($this->input->post('password')),
                        'role_id' => $this->input->post('user_role'),
                        'user_type' => 3,
                        'division_id' => $this->input->post('project_division_user'),
                        'circle_id' => $this->input->post('project_circle_user'),
                        'status' => 'Y'
                    );
                    $lastInsertedMainUserId = $this->User_model->add_user($user_field_data);


                    $this->data_array['field_data'] = array(
                        'designation_id' => $this->input->post('user_type'),
                        'firstname' => htmlentities($this->input->post('firstname')),
                        'lastname' => htmlentities($this->input->post('lastname')),
                        'email' => htmlentities($this->input->post('email')),
                        'mobile' => htmlentities($this->input->post('mobile')),
                        /*'username' => htmlentities($this->input->post('username')),
                        'password' => md5($this->input->post('password')),*/
                        'user_id' => $lastInsertedMainUserId,
                        'created_on' => date("Y-m-d"),

                        'status' => 'Y',
                        'modified_by' => $admin_id,
                        'created_by' => $admin_id
                    );
                    $lastInsertedUserId = $this->User_model->add_user_basic_info($this->data_array);

                } else {
                    $this->session->set_flashdata('message', 'Password must contain Minimum 8 characters at least 1 Alphabet, 1 Number and 1 Special Character.');
                    redirect('User/add_user');
                }
				
				
				
							//$post_data['modify'] = $_REQUEST['modify'];
				            $post_data['view'] = $_REQUEST['view'];
							

							$this->add_User_Module_Permission($lastInsertedMainUserId,$post_data);
				

                $this->session->set_flashdata('success', 'User added successfully');

                redirect('User/user_list');
            }
        } 


    }
	
	
	
   public function add_User_Module_Permission($user_id,$post_data = [ ])
    {
        //$permission_data['modify'] = array_keys($post_data['modify']);
        $permission_data['view'] = array_keys($post_data['view']);
        $temp = [];
        foreach ($permission_data as $key => $val) {
            for ($k = 0; $k < count($permission_data[$key]); $k++) {
                // if ($key == "view") {
                //     $module_id = $permission_data['modify'][$k];
                //     $temp[$module_id] = array("modify" => 1);
                // }
                // $temp[$module_id] = array("modify" => 1);
                if($key == "view"){
                    $module_id = $permission_data['view'][$k];
                    
                        $temp[$module_id] = array("view" => 1, "modify" => 1);

                    
                }
            }
        }


        foreach( $temp as $module_id => $permission ){
           $special_menu_arr =  $this->User_model->get_sub_no_display_menu($module_id);

           for( $k = 0; $k < count($special_menu_arr); $k++){

               if( $permission['view'] == 1) {
                   $temp[$special_menu_arr[$k]['id']]['view'] = 1;
               }
               if($permission['view'] == 1){
                   $temp[$special_menu_arr[$k]['id']]['modify'] = 1;
               }
           }
        }
		// echo "<pre>";
		// print_r($temp);
		// echo "</pre>";
		// die;

        $this->User_model->add_module_Permission($temp, $user_id);

    }


	
	
    public function addUserMenuPermission($user_id,$post_data = [ ])
    {

        $permission_data['modify'] = array_keys($post_data['modify']);
        $permission_data['view'] = array_keys($post_data['view']);

        $temp = [];
        foreach ($permission_data as $key => $val) {
            for ($k = 0; $k < count($permission_data[$key]); $k++) {
                if ($key == "modify") {
                    $module_id = $permission_data['modify'][$k];
                    $temp[$module_id] = array("modify" => 1);
                }
                if($key == "view"){
                    $module_id = $permission_data['view'][$k];
                    if( isset($temp[$module_id])){
                        $temp[$module_id] = array("view" => 1, "modify" => 1);

                    }else{
                        $temp[$module_id] = array("view" => 1);

                    }
                }
            }
        }

        


        //echo "<pre>"; print_r($temp); die;
        $this->Organization_model->addMenuPermission($temp, $user_id);
    }
    public function getSubModule( $module_id ){
        return $this->User_model->getSubModule( $module_id );
    }
    public function getModuleAccessByUser($userId, $moduleId)
    {
        return $this->User_model->getModuleAccessInfoByUser($userId, $moduleId);
    }
    public function getMenuAccessInfoByUser($userId, $moduleId)
    {
        return $this->User_model->getMenuAccessInfoByUser($userId, $moduleId);
    }


    /*public function addUserModulePermission($user_id)
    {
        $this->Organization_model->addPermission($this->allowedModule, $user_id);
    }*/


    function check_permission($mode, $moduleId)
    {
        $userId = $this->session->userdata('id');
        //echo "<pre>"; print_r($_SERVER);
        // echo "Mode: ".$mode; echo "<br>";
        // echo "Module Id: ".$moduleId; echo "<br>";
        // echo "REDIRECT_QUERY_STRING: ".$_SERVER['REDIRECT_QUERY_STRING']; echo "<br>";
        // echo "REDIRECT_URL: ".$_SERVER['REDIRECT_URL'];
        $userAccessDetailAr = array();
        //$userAccessDetailAr = $this->model_user->get_user_access_details($userId);
        $userAccessDetailAr = $this->model_user->getModuleAccessInfoByUser($userId, $moduleId);
        //echo "<pre>"; print_r($userAccessDetailAr);

        $userModuleAccessAr = array();
        $userModuleCtrlAccessAr = array();
        if (!empty($userAccessDetailAr)) {
            foreach ($userAccessDetailAr as $key => $value) {
                $userModuleAccessAr['moduleId'] = $value['module_id'];
                //$userModuleCtrlAccessAr['add_option'] = $value['add_option'];
                $userModuleCtrlAccessAr['modify'] = $value['modify'];
                $userModuleCtrlAccessAr['report'] = $value['report'];
                $userModuleCtrlAccessAr['booking'] = $value['booking'];
                $userModuleAccessAr['moduleAccess'] = $userModuleCtrlAccessAr;
            }
        }
        //echo "<pre>"; print_r($userModuleAccessAr);
        // Now get all the pages by moduleId & mode specific
        $modulePagesAr = array();
        $permissionVar = 0;
        $modulePagesAr = $this->model_user->getPagesByModuleAndModeWise($moduleId, $mode);
        //echo "<pre>"; print_r($modulePagesAr);
        // Now search for REDIRECT_QUERY_STRING in the $modulePagesAr, if it is found then return true, else false
        if ($userModuleAccessAr['moduleAccess'][$mode] > 0) {
            if (!empty($modulePagesAr)) {
                foreach ($modulePagesAr as $k1 => $modulePages) {
                    // echo "<pre>"; print_r($modulePages); //die();
                    // echo "Page: ".$modulePages['page']; echo "<br>";
                    // echo "REDIRECT_URL: ".$_SERVER['REDIRECT_URL']; //die();
                    if (strpos($_SERVER['REDIRECT_URL'], $modulePages['page']) != false) {
                        return true;
                        $permissionVar = 1;
                    }
                }
            } else {
                //return false;
                //echo 0;
                $permissionVar = 0;
            }
        } else {
            $permissionVar = 0;
        }

        return $permissionVar;

    }


    /* Chnage Password  changes by somnath 10-08-2020*/
    public function change_password()
    {
        $user_id = $this->session->userdata('id');
        $submit = $this->input->post('submit');

        if($submit == 'Submit'){
            $old_password = $this->input->post('old_password', TRUE);
            //Do stuff for from validation
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('old_password','Old Password','trim|required|callback_checkoldpassword['.$user_id.']');
            $this->form_validation->set_rules('password','Password','trim|required|min_length[8]|callback_valid_password');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[password]');
            
            $username = $this->input->post('username', TRUE);
            if($this->form_validation->run() == TRUE) {

                $password = $this->input->post('password', TRUE);
                $secured_pass = md5($password); 

                $data = array(
                    'password'=>$secured_pass,
                    'modified_by'=>$user_id
                );
                $up = $this->User_model->updateData('id', 'user', $data, $user_id);
                if($up){
                    $this->session->set_flashdata('message', 'Password updated Successfully');
                    redirect('User/change_password');
                }


            }    
        }
        $this->load->inner_template('user/change_password_view', $data);
    }
    /* Password Change End*/

    function checkoldpassword($old_password,$update_id){
        $old_pass = $this->User_model->getSpecificdata('user','id',$update_id,'password');
        if(md5($old_password) == $old_pass){
            return TRUE;
        }else{
            $error_msg = 'Old Password is wrong';
            $this->form_validation->set_message('checkoldpassword', $error_msg);
            return FALSE;
        }

    }

     public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The New Password field is required.');
            return FALSE;
        }
        // if (preg_match_all($regex_lowercase, $password) < 1)
        // {
        //     $this->form_validation->set_message('valid_password', 'The New Password field must be at least one lowercase letter.');
        //     return FALSE;
        // }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The New Password field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The New Password field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The New Password field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 8)
        {
            $this->form_validation->set_message('valid_password', 'The New Password field must be at least 8 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The New Password field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }

    /* END changes by somnath 10-08-2020 */
	
	
	 function get_role_access_list(){
	 	$role_id = $this->input->post('role_id');
	 	$action_val = $this->input->post('action_val');
	 	$userid = $this->input->post('userid');


        $admin_id = $userid;

		 if ($action_val=="edit") {
			 //echo "chk";
			//$data['module_details'] = $this->User_model->get_module_details_permission($userid);
			
			$data['module_details'] = $this->User_model->get_module_details_permission();
            $data['common_module_details'] = $this->User_model->get_common_module_details_permission($admin_id);
			 //$data['module_details1'] = $this->User_model->get_user_access_details( $userid );
			 $data['action_val'] = "edit";
			 
		$data['User_id'] = $userid;
		 }
        //
		else
		{
		$data['module_details'] = $this->User_model->get_module_details_permission();
        $data['common_module_details'] = $this->User_model->get_common_module_details_permission();
		 $data['action_val'] = "add";
		
		}

   

       
		$data['role_id'] = $role_id;
	 	$this->load->view('user/role_assign_view',$data);
	 }



      function getdivision_list(){
          $circle_id = $this->input->post('circleId');
          if($circle_id!=''){
            $data['all_divisions'] = $this->User_model->fetch_divisions($circle_id);
            echo  json_encode($data);
          }else{
                  
          }
    }

     function getdivision_data($circle_id,$division_id){
      
        if($circle_id != 0 || $circle_id != ''){
           
            $all_divisions = $this->User_model->fetch_divisions($circle_id);
            
                foreach ($all_divisions as $key) {
                
                   ?>
                    <option value="<?php echo $key->id; ?>" <?php if($key->id == $division_id){ echo "selected"; } ?>><?php echo $key->division_name; ?></option>
                    <?php 
                  }  

          }
        
  }



}
