<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'security'));

        $this->load->model('Roles_model');
        //$this->load->model('Organization_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }


    /* for listing Page */

    function role_list(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        
          $data['roleData'] = $this->Roles_model->get_organization_roles_data();

           $this->load->common_template('roles/roles_list_view', $data);
    }


    /* end for listing Page */


    /* for roles create */
    function create(){
        

        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
		
        $admin_id = $user_id;
		
        $roleId = $this->input->get('roleId');
        if($roleId){
        $role_id = base64_decode($roleId);  
        }else{
        $role_id = '';
        }
        $submit = $this->input->post('submit');
        if($submit == 'Submit'){


            $this->form_validation->set_rules('role', 'Role Name', 'required|callback_check_duplicate_role_name['.$role_id.']');
            $this->form_validation->set_rules('role_description', 'Description', 'required');
            $this->form_validation->set_rules('default_page', 'Default Page', 'required');
            $this->form_validation->set_rules('view[]', 'View', 'required');
            //$this->form_validation->set_rules('modify[]', 'Modify', 'required');
                
                  
          $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
          $this->form_validation->set_message('required', 'Enter %s');  
          if ($this->form_validation->run() == TRUE){

            

            /* for update */

            if(is_numeric($role_id)){
                $updateData = array(
                    'role' =>$this->input->post('role'),
                    'role_description' =>$this->input->post('role_description'),
                    'default_page' =>$this->input->post('default_page'),
                    'status' =>$this->input->post('status')
                     );
                $update = $this->Roles_model->updateData('id', 'role_master', $updateData, $role_id); 
                //$post_data['modify'] = $_REQUEST['modify'];
                $post_data['view'] = $_REQUEST['view'];

                $this->add_Role_Module_Permission($role_id,$post_data);
                 

                $this->session->set_flashdata('success', 'Data Updated successfully');
                redirect('roles/role_list',$data);

            }
            /*  end update */
            /* for Add */

            else{


                $addData = array(
                    'role' =>$this->input->post('role'),
                    'role_description' =>$this->input->post('role_description'),
                    'default_page' =>$this->input->post('default_page'),
                    'status' =>$this->input->post('status')
                     );

                $insert_id = $this->Roles_model->insertDatareturnid($addData,'role_master');




                //$post_data['modify'] = $_REQUEST['modify'];
                $post_data['view'] = $_REQUEST['view'];

                
                
                $this->add_Role_Module_Permission($insert_id,$post_data);
                

                $this->session->set_flashdata('success', 'Data Added successfully');
                redirect('roles/role_list',$data);
            

            }
            /* end Add */

          }
         /* form validation end */

        }

            if(is_numeric($role_id) && ($submit != 'Submit')){
                $data = $this->fetch_data_from_db($role_id);
            }else{
                $data = $this->fetch_data_from_post();
            }



          $data["role_id"] = $role_id;
          $data['defaultPageData'] = $this->Roles_model->fetchSingledata('default_page_master','status','Y');
          $data['module_details'] = $this->Roles_model->get_module_details();
          $data['common_module_details'] = $this->Roles_model->get_common_module_details_permission();
          $this->load->common_template('roles/roles_create_view', $data);

    }


    public function check_duplicate_role_name($role_name,$role_id){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');

    if(!empty($role_id)){
        $check_duplicate =$this->Roles_model->check_duplicate_role_name_data2($role_name,$role_id);
    }else{
        $check_duplicate =$this->Roles_model->check_duplicate_role_name_data($role_name); 
    }   
    
     $countRow = $check_duplicate->num_rows();

    if($countRow > 0) { 
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
        $this->form_validation->set_message('check_duplicate_role_name', 'This %s already exists.');

        return FALSE;
     } else { 
      // doesn't return any row means database doesn't have this email
        return TRUE;
     }
}



public function add_Role_Module_Permission($role_id,$post_data)
    {
// echo $role_id;
// die();

        //$permission_data['modify'] = array_keys($post_data['modify']);
        $permission_data['view'] = array_keys($post_data['view']);
        $temp = [];
        foreach ($permission_data as $key => $val) {
            for ($k = 0; $k < count($permission_data[$key]); $k++) {
                if ($key == "view") {
                    $module_id = $permission_data['view'][$k];
                    $temp[$module_id] = array("modify" => 1);
                }
                $temp[$module_id] = array("modify" => 1);
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


        $this->Roles_model->add_role_module_Permission($temp, $role_id);

    }

    /*fetch Data from Database */

function fetch_data_from_db($update_id){
    $result = $this->Roles_model->fetchSingledata('role_master', 'id', $update_id);
    foreach ($result as $row) {
        $data['role'] = $row->role;
        $data['role_description'] = $row->role_description;
        $data['default_page'] = $row->default_page;
        $data['status'] = $row->status;

    }
    if(!isset($data)){
        $data = '';
    }
    return $data;
}

/*fetch data from post */
function fetch_data_from_post(){
    $data['role'] = $this->input->post('role',TRUE);
    $data['role_description'] = $this->input->post('role_description',TRUE);
    $data['default_page'] = $this->input->post('default_page',TRUE);
    $data['status'] = $this->input->post('status',TRUE);

    return $data;
}

}