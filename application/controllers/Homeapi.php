<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homeapi extends MY_Controller {
	public function __construct(){
        parent::__construct();
			  // load base_url
		$this->load->library('session');
		$this->load->library('pagination');	  
		$this->load->helper('form');
   		$this->load->helper(array('url','html','form'));
		$this->load->model('Home_model');
    }
	 
	public function index($data=NULL){
        $session_user_id = $this->session->userdata('id');
	    if( !$session_user_id  ) {
            $this->load->template('home/index');
        }else{
				// FOR AUTO REDIRECTION
		 		$login_type = base64_decode($_REQUEST['type']);
				$role_id = $this->session->userdata('user_role_id');				
				$role_data = $this->Home_model->login_roledata($role_id);	
				$redirect_url = $role_data[0]['default_page'];
				// FOR AUTO REDIRECTION END
				if($redirect_url!='')
				{
					redirect($redirect_url);
				}
				else
				{
					redirect('Dashboard');
				}
        }

	}
    
    /* Authentication of user */
	public function user_login_process() {
            $apikey = $_GET['token'];
            $result = $this->Home_model->fetch_token_records($apikey);

            if(!empty($result)){

				$Login_details = array(
					'is_logged_in' => '1',
					'id' => $result[0]['id'],
					// 'firstname'  => $result[0]['firstname'],
					// 'lastname'     => $result[0]['lastname'],
					// 'email' => $result[0]['email'],
					'username'  => $result[0]['username'],
                    'user_type' => $result[0]['user_type'],
                    'user_role_id' => $result[0]['role_id'],
                    'user_role_name' => $result[0]['role_name'],
				);
				
				$this->session->set_userdata($Login_details);
				//echo $result[0]['user_type'];
				
				//die;
				
				$login_step = "first";
				/*Super Admin*/
				if($result[0]['user_type'] == 2){
					
				//$org_data = $this->Home_model->login_orgdata($result[0]['id']);

				//$orgnization_name = $this->Home_model->getSpecificdata('organization_master','id',$result[0]['id'],'name');
//
//				
					
				$this->session->set_userdata('user_f_name', 'BRAINSPARK TECHNOLOGIES');
				$this->session->set_userdata('name', 'BRAINSPARK TECHNOLOGIES');
				//$this->session->set_userdata('orgnization_id', $org_data[0]['id']);
				//$this->session->set_userdata('orgnization_name', $orgnization_name);
				//$this->session->set_userdata('user_f_name', $org_data[0]['name']);
				//echo "<pre>";
				//print_r($this->session->userdata);				
				
//die;				
                    redirect('Dashboard');
                    /*3rd Level User */
                }


				else if( $result[0]['user_type'] == 3 ){
					
				$role_data = $this->Home_model->login_roledata($result[0]['role_id']);
				$orguser_data = $this->Home_model->login_org_userdata($result[0]['user_id']);
				$fname = $orguser_data[0]['firstname'];
				$lname = $orguser_data[0]['lastname'];
				$full_name = $fname." ".$lname; 
				//$orgnization_name = $this->Home_model->getSpecificdata('organization_master','id',$role_data[0]['organization_id'],'name');

				//$this->session->set_userdata('orgnization_id', $role_data[0]['organization_id']);
				//$this->session->set_userdata('orgnization_name', $orgnization_name);
				$this->session->set_userdata('user_f_name', $full_name);
					
					$redirect_url = $role_data[0]['default_page'];
					//redirect(base_url().$redirect_url);
					// $login_type = base64_decode($_REQUEST['type']);
					
					//echo $login_type;
					//echo $redirect_url;
					
					//die;
					if ($redirect_url == "Dashboard" && $login_type == "delayed") {
						
						
					redirect("project_summary_list?project_list_type=Delayed%20Project");
					
					}
					else if ($redirect_url == "Userdashboard/co_dashboard" && $login_type == "userNotification") {
						
						
					redirect("project_delay_list");
					
					}
					else
					{
						
						//print_r($result);
					redirect($redirect_url);

						//print_r($orguser_data);
						
					}
					
					
					//redirect($redirect_url.'?type=login');
                }



				else if( $result[0]['user_type'] == 37 ){
					
				$role_data = $this->Home_model->login_roledata($result[0]['role_id']);
				$orguser_data = $this->Home_model->login_org_userdata($result[0]['id']);
				$fname = $orguser_data[0]['firstname'];
				$lname = $orguser_data[0]['lastname'];
				$full_name = $fname." ".$lname; 
				//$orgnization_name = $this->Home_model->getSpecificdata('organization_master','id',$role_data[0]['organization_id'],'name');

				//$this->session->set_userdata('orgnization_id', $role_data[0]['organization_id']);
				//$this->session->set_userdata('orgnization_name', $orgnization_name);
				$this->session->set_userdata('user_f_name', $full_name);
					
					$redirect_url = $role_data[0]['default_page'];
					//redirect(base_url().$redirect_url);
					// $login_type = base64_decode($_REQUEST['type']);
					
					//echo $login_type;
					//echo $redirect_url;
					
					//die;
					if ($redirect_url == "Dashboard" && $login_type == "delayed") {
						
						
					redirect("project_summary_list?project_list_type=Delayed%20Project");
					
					}
					else if ($redirect_url == "Userdashboard/co_dashboard" && $login_type == "userNotification") {
						
						
					redirect("project_delay_list");
					
					}
					else
					{
						
					redirect($redirect_url);
						
					}
					
					
					//redirect($redirect_url.'?type=login');
                }




			}else{


                $this->session->set_flashdata('message', 'Wrong username or password cant log you in'); 
				if (!empty($login_type) && $login_type == "delayed"){
					 redirect('/?type='.base64_encode("delayed"));
				}
				else if (!empty($login_type) && $login_type == "userNotification"){
					
					 redirect('/?type='.base64_encode("userNotification"));
				}
				else
				{
                

                //redirect('/');
                 echo $apikey;
				 print_r($result);
				}
			}  
	}
    /* Authentication of user End */

     // Logout from admin page
    public  function logout() {
		
    	$this->session->set_flashdata('message', 'Logout Successfully');
        $this->session->unset_userdata($Login_details);
        $this->session->sess_destroy();
	    redirect('Home');
		
    }

    // Logout from admin page End


    function my_priority_action(){
    	$user_id = $this->session->userdata('id');
    	$user_type = $this->session->userdata('user_type');
    	$user_role_id = $this->session->userdata('user_role_id');

                /*Organization*/
            if($user_type == 2){
                redirect('Dashboard/index');
                /*3rd Level User */
            }else if( $user_type == 3 ){
				$role_data = $this->Home_model->login_roledata($user_role_id);
				
				$redirect_url = $role_data[0]['default_page'];	
				redirect($redirect_url);
            }
    }

    function page_access(){
    	$this->load->common_template('home/error_404_view');
    }

    function not_applicable(){

    	$this->load->view('includes/common_header');
        if( $_SESSION['user_type'] == 1){
         $this->load->view('includes/sidebar-backup');
        }else{
           $this->load->view('includes/sidebar');
        }

        $this->load->view('home/error_404_view');
        $this->load->view('includes/common_footer');
    }
    


}
?>