<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Organization extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');

        $this->load->helper(array('form', 'url', 'security'));

        $this->load->model(['Organization_model','User_model','Project_model']);
        $this->allowedModule = array(1 => true, 2 => true, 3 => false, 4 => true, 5 => true, 6 => true, 7 => false, 8 => false);
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }
    public function checkEmptyValue( $value){

        return !empty($value) ? $value : NULL;
    }
    public function getModuleAccessByUser($userId, $moduleId)
    {
        return $this->User_model->getModuleAccessInfoByUser($userId, $moduleId);
    }

    public function getMenuAccessInfoByUser($userId, $moduleId)
    {
        return $this->User_model->getMenuAccessInfoByUser($userId, $moduleId);
    }

    public function showOrgForm($data = [])
    {

        $data['module_details'] = $this->Organization_model->get_super_admin_module_details();

        $user_id = $this->Organization_model->getUserId();
        if (!empty($user_id)) {

            $data["userId"] = $user_id;
            $data["user_details"] = $this->User_model->get_user_details($user_id);
            $data["user_access_details"] = $this->User_model->get_user_access_details($user_id);

        }
       
            if (empty($_REQUEST['password'])) {
                $this->form_validation->set_rules('password', 'Password', 'required');
            }else{
                $this->form_validation->set_rules('password', 'Password', 'required|callback__strongPasswordValidation');
            }

            $is_unique_org = '|is_unique[organization_master.name]';
            $is_unique_username = '|is_unique[user.username]';

      


        if(!empty($_REQUEST['date_establishment'])){
            $this->form_validation->set_rules('date_establishment', 'Date of establishment', 'required|callback__datechecker');
        }
        if(!empty($_REQUEST['password'])){
            $this->form_validation->set_rules('password', 'Password', 'required|callback__strongPasswordValidation');
        }
        $this->form_validation->set_rules('org_name', 'Organisation Name', 'required' . $is_unique_org);
        $this->form_validation->set_rules('contact', 'Mobile No', 'numeric|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required'.$is_unique_username );
        $this->form_validation->set_rules('web_tagline', 'Website tagline', 'max_length[100]');
        $this->form_validation->set_rules('title', 'Website title', 'max_length[100]');

        $return_data = $this->uploadLogo();

        if ($this->form_validation->run() == FALSE || (!empty($return_data) && $return_data['flie_upload_error_flag'] > 0)) {

            $imgPath = 'uploads/logo/' . $_FILES['file_logo']['name'];
            unlink($imgPath);

            if (!empty($_REQUEST['token'])) {
                $data['orgId'] = $_REQUEST['token'];
            }

            if (!empty($_FILES['file_logo']['name'])) {
                $data['file_upload_error'] = $this->upload->display_errors();
            }

            $this->load->common_template('organization/create', $data);
        } else {

            /** Data  for table organization_master **/
            $val['name'] = $this->checkEmptyValue($_REQUEST['org_name']);
            $val['tagline'] = $this->checkEmptyValue($_REQUEST['web_tagline']);
            $val['title'] = $this->checkEmptyValue($_REQUEST['title']);
            $val['email'] = $this->checkEmptyValue($_REQUEST['email']);
            $val['mobile'] = $this->checkEmptyValue($_REQUEST['contact']);
            $val['status'] = ($_REQUEST['status'] == 'on') ? 'Y' : 'N';
            $val['address'] = $this->checkEmptyValue(trim($_REQUEST['address']));
            $val['date_establishment'] = $this->checkEmptyValue($_REQUEST['date_establishment']);
            $val['preset_finance_yr'] = ($_REQUEST['preset_finance_yr'] > 0 ) ? $_REQUEST['preset_finance_yr'] : 0;

            if (!empty($_FILES['file_logo']['name'])) {
                $val['logo'] = (!empty($return_data['logo'])) ? $return_data['logo'] : '';
            }

            /** Data for  table user **/
            $userData = array(
                'username' => $_REQUEST['username'],
                'password' => md5($_REQUEST['password']),
                'user_type' => 2,
                'status' => $val['status'],
                'created_by' => $this->session->userdata('id')
            );
            /** For Module permission **/
            $post_data['modify'] = $_REQUEST['modify'];
            $post_data['view'] = $_REQUEST['view'];

            /** For Menu permission **/
            $post_menu_data['modify'] = $_REQUEST['menu_modify'];
            $post_menu_data['view'] = $_REQUEST['menu_view'];
            // echo "<pre>"; print_r($post_data);
            // die();

            /** Only when new organization will add **/
         
                $this->Organization_model->updateUser($update_usr);

                $this->addUserModulePermission($user_id,$post_data);
           
            $result = $this->Organization_model->addEditOrganization($val);

            redirect('Organization/viewList');
        }

    }
    function _datechecker($date)
    {

        if (strtotime($date) > strtotime(date("Y-m-d"))) {
            $this->form_validation->set_message('_datechecker', 'Date of establishment should be  past date');
            return false;
        }
        return true;
    }
        public function get_module_permission( $module_id )
    {
        return $this->Organization_model->get_module_permission($module_id);
    }
    function _strongPasswordValidation($password){


        if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $password)) {
            $this->form_validation->set_message('_strongPasswordValidation', 'Password must contain Minimum 8 characters at least 1 Alphabet, 1 Number, 1 Capital and 1 Special Character.');
            return false;
        }
        return true;

    }

    public function uploadLogo()
    {

        $config['upload_path'] = 'uploads/logo/';
        $config['allowed_types'] = "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF";
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);
        $data = [];
        $flie_upload_error_flag = 0;

        if (!$this->upload->do_upload('file_logo') && !empty($_FILES['file_logo']['name'])) {

            $flie_upload_error_flag++;
            $data['flie_upload_error_flag'] = $flie_upload_error_flag;

        } else {

            $file_data = $this->upload->data();
            $data = array('logo' => $file_data['file_name']);
        }

        return $data;
    }

    public function addUserModulePermission($user_id,$post_data = [ ])
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

        foreach( $temp as $module_id => $permission ){
           $sub_menu_arr =  $this->Organization_model->get_sub_menu($module_id);

           for( $k = 0; $k < count($sub_menu_arr); $k++){

               if( $permission['view'] == 1) {
                   $temp[$sub_menu_arr[$k]['id']]['view'] = 1;
               }
               if($permission['modify'] == 1){
                   $temp[$sub_menu_arr[$k]['id']]['modify'] = 1;
               }
           }
        }

        foreach( $temp as $module_id => $permission ){
           $special_menu_arr =  $this->Organization_model->get_sub_no_display_menu($module_id);

           for( $k = 0; $k < count($special_menu_arr); $k++){

               if( $permission['view'] == 1) {
                   $temp[$special_menu_arr[$k]['id']]['view'] = 1;
               }
               if($permission['modify'] == 1){
                   $temp[$special_menu_arr[$k]['id']]['modify'] = 1;
               }
           }
        }

        
        $this->Organization_model->addPermission($temp, $user_id);
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

    public function viewList()
    {

        $data['project_deatail'] = $this->Organization_model->getOrganizationList();


        $this->load->common_template('organization/org_list', $data);
    }
    public function total_projects(){
       $temp =  $this->Organization_model->get_total_projects();

        return !empty($temp[0]['total_project']) ? $temp[0]['total_project'] : 0;
    }
    public function total_org_users(){
        $temp =  $this->Organization_model->get_total_users( );
        return !empty($temp[0]['total_user']) ? $temp[0]['total_user'] : 0;
    }

    public function view()
    {


        if (!empty($orgId)) {
            $data = [];
            $result = $this->Organization_model->getOrgDetails();
            $data['module_details'] = $this->User_model->get_module_details_permission();
            $data["userId"] = $user_id = $this->Organization_model->getUserId();;
            $data["user_details"] = $this->User_model->get_user_details($user_id);
            $data["user_access_details"] = $this->User_model->get_user_access_details($user_id);
            $res = $this->Organization_model->getUserDetails($result[0]['user_id']);
            $data['username'] = $res[0]['username'];
            if (!empty($result)) {
                $data['result'] = $result[0];
                $this->load->common_template('organization/view', $data);
            } else {
                redirect('Organization/viewList');
            }
        }

    }


    public function updateStatus()
    {

        $orgId = $_REQUEST['orgId'];
        $data['status'] = $_REQUEST['status'];

        $result = $this->Organization_model->updateOrgStatus($data);
        if ($result) {
            $val['msg'] = "Update Successfully";

        } else {
            $val['msg'] = "Please try again later";

        }
        echo json_encode($val);
        exit();
    }


}

?>