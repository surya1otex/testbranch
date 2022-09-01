<?php



function project_tendering_steps($step_project_id){
	$CI =& get_instance();
	$step_project_id = base64_decode($_REQUEST['project_id']);
	$CI->load->model('Projectdashboard_model');
	$type = $_REQUEST['type'];
	if($type == 'new'){
		$step_project_id = 0;
	}
	$con_name = $CI->uri->segment(1);
    $fun_name = $CI->uri->segment(2);
    if(!empty($fun_name)){
        $whole_url = strtolower($con_name.'/'.$fun_name);
	  }else{
	    $whole_url = strtolower($con_name);
	  }

	  $data['whole_url'] = $whole_url;

	$data['stepData'] = $CI->Projectdashboard_model->get_project_tendering_steps_data($step_project_id);
	$data['step_project_id'] = $step_project_id;
	$CI->load->view('dashboard/project_tendering_steps_bar_view', $data);



}