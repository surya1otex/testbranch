<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
         parent::__construct();
         error_reporting(E_ERROR | E_PARSE);
         $this->load->model('User_model');
		 
	}

	public function user_access_details($module_id){
     	 $user_id=$this->session->userdata('id');
         return $this->User_model->get_role_based_access_details($user_id,$module_id);
    }

   public function get_user_menu_acces_detail(){

       $user_id=$this->session->userdata('id');
       $data =  $this->User_model->get_user_menu_acces_detail($user_id);

       return $data;
   }
   public function get_submenu( $parent_module_id = 0){

       $data =  $this->User_model->get_sub_menu($parent_module_id,$this->session->userdata('id'));
       //echo "<pre>"; print_r($data);
       return $data;
   }
   public function get_user_details(){
       $user_id=$this->session->userdata('id');
       return $this->User_model->get_loging_user_type($user_id);
   }

}