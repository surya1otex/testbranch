<?php


 function project_quick_nav($project_id){
 	$CI =& get_instance();
 	$CI->load->model('Pre_con_act_quick_nav_model');
 	$data['project_pre_construction_setting'] = $CI->Pre_con_act_quick_nav_model->project_pre_construction_settings_data($project_id);

 	$CI->load->view('pre_consttruction_activity/project_quick_nav_view', $data);
 }
