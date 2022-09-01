<?php
/**
**Common Helper for all Common function
**/

/*Count all data from specific table*/
	function project_info($project_id){
		$CI =& get_instance();

		$CI->load->model('Projectdashboard_model');
	    $project_id = base64_decode($_REQUEST['project_id']);
	  
		// ========= Project Information about 5 stages ===========
        //============Project Creation Data ===========
        $proj_rel_id = $CI->Projectdashboard_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        $data['project_creation_data'] = $CI->Projectdashboard_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $CI->Projectdashboard_model->get_project_creation_users($proj_rel_id);



        //============End Project Creation Data ===========




        // ====Project Conceptualisation details ======
        $data['project_detail'] = $CI->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
		// ============================================ 

        //============Project DPR Data ===========
        
        $data['project_dpr_data'] = $CI->Projectdashboard_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
         //============End Project DPR Data ===========

        //============Project Administrative Approval Data ===========
        
        $data['project_administrative_approval_data'] = $CI->Projectdashboard_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
         //============End Project Administrative Approval Data ===========



        $data['project_preparation'] = $CI->Projectdashboard_model->project_data_preparation($project_id);
        $data['project_preparation_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_preparation_stage_documents','project_id',$project_id);

        $data['project_userinfo_preparation'] = $CI->Projectdashboard_model->preparation_project_user_information($project_id);
        $data['sof_preparation'] = $CI->Projectdashboard_model->preparation_sof($project_id);
        $data['project_pre_tender'] = $CI->Projectdashboard_model->pretender_project_data($project_id);
        $data['project_pre_tender_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_pretender_stage_documents','project_id',$project_id);
        $data['tender_histroy'] = $CI->Projectdashboard_model->getTenderHistory($project_id);
        $data['project_tender'] = $CI->Projectdashboard_model->tender_project_data($project_id);
        $data['project_publishing_tender'] = $CI->Projectdashboard_model->tender_publishing_project_data($project_id);
        $data['project_tender_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_tender_stage_documents','project_id',$project_id);
        $data['project_agreement'] = $CI->Projectdashboard_model->agreement_project_data($project_id);
        $data['project_agreement_attachment'] = $CI->Projectdashboard_model->fetchSingledata('project_aggrement_stage_document','project_id',$project_id);
        $data['project_commissioning'] = $CI->Projectdashboard_model->commissioning_project_data($project_id);
        $data['issue_list'] = $CI->Projectdashboard_model->get_list_issues($project_id);	
        // ==============For Project Pre Construction Activities==============
        $data['project_pre_construction_setting'] = $CI->Projectdashboard_model->project_pre_construction_settings_data($project_id);

        $data['project_id'] =$project_id;



        // ==============End For Project Pre Construction Activities==========


		//=========== End Project Information ======================


		
		$CI->load->view('dashboard/project_info_entry_page', $data);
		
	}


	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}


