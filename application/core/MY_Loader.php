<?php
/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {

    public function __construct() {
         parent::__construct();
         $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
         $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }
    
    public function template($template_name, $data = array(), $return = FALSE)
    {
        $content  = $this->view('includes/header', $data, $return);
        $content .= $this->view($template_name, $data, $return);
        $content .= $this->view('includes/footer', $data, $return);

        if ($return)
        {
            return $content;
        }
    }

    public function inner_template($template_name, $data = array(), $return = FALSE)
    {
        $content  = $this->view('includes/common_header', $data, $return);
        if( $_SESSION['user_type'] == 1){
            $content .= $this->view('includes/sidebar-backup', $data, $return);
        }else{
            $content .= $this->view('includes/sidebar', $data, $return);
        }

        $content .= $this->view($template_name, $data, $return);
        $content .= $this->view('includes/common_footer', $data, $return);

        if ($return)
        {
            return $content;
        }
    }
	
    public function common_template($template_name, $data = array(), $return = FALSE)
    {
        $CI =& get_instance();
        /* ===session checking==== */
        $logged_in = $CI->session->userdata('is_logged_in');
        $user_id = $CI->session->userdata('id');
        /* End session checking */

        /* == module wise user checking == */
        $con_name = $CI->uri->segment(1);
       $fun_name = $CI->uri->segment(2);
      if(!empty($fun_name)){
        $whole_url = strtolower($con_name.'/'.$fun_name);
      }else{
        $whole_url = strtolower($con_name);
      }
      
        $CI->load->model('Home_model');
        $check_module_permission = $CI->Home_model->check_user_module_permission($whole_url,$user_id);
        
       
        /* ===End module wise user checking ===*/
        /*if (empty($logged_in)) {
            $CI->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home/logout');
        }
        elseif($check_module_permission == 0 && $_SESSION['user_type'] != 1){
            // echo "string";
            // die();
            $CI->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home/not_applicable');
        }*/


        $content  = $this->view('includes/common_header', $data, $return);
        if( $_SESSION['user_type'] == 1){
            $content .= $this->view('includes/sidebar-backup', $data, $return);
        }else{
            $content .= $this->view('includes/sidebar', $data, $return);
        }

        $content .= $this->view($template_name, $data, $return);
        $content .= $this->view('includes/common_footer', $data, $return);

        if ($return)
        {
            return $content;
        }
    }
    public function ajax_templete( $template_name, $data = array(), $return = FALSE ){
        return $this->view($template_name, $data, $return);

    }
	


}
?>