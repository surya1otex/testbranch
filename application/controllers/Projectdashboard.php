<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projectdashboard extends MY_Controller
{   public $financial_module_permission;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        //$this->load->helper('form');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $this->load->model('Projectdashboard_model');
        //$this->load->model('Procurement_model');
        $this->load->model('Analytics_model');
        $this->load->model('User_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
        $this->financial_module_permission = $this->user_access_details(8);

    }


    /*User Dashboard End*/
    public function  all_projectlists(){
		
		/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";
					die;*/

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Projectdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Projectdashboard_model->login_roledata( $role_id );
        
		// All rejected data of 5 stages
       	$data['approved_project_Data'] = $this->Projectdashboard_model->get_peoject_dashboard_data($user_id);


        $this->load->common_template('dashboard/all_project', $data);
    }
    /*User Dashboard End*/
	
    public function  project_dashboard(){

        $user_id = $this->session->userdata('id');
        $role_id = $this->session->userdata('user_role_id');
        $data['user_details'] = $this->Projectdashboard_model->get_user_details( $user_id );
        $data['role_details'] = $this->Projectdashboard_model->login_roledata( $role_id );		
		
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
		
		$data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
		
        $data['project_agreement'] = $this->Projectdashboard_model->agreement_project_data($project_id);
        $data['project_issue'] = $this->Projectdashboard_model->issue_project_data($project_id);

		
        $data['work_item_categories'] = $this->Projectdashboard_model->get_work_item_categories();
		$data['project_work_item'] = $this->Projectdashboard_model->get_project_work_item($project_id);
 
        $data['project_activity'] = $this->Projectdashboard_model->get_all_activity_details($project_id, $work_item_id);
        $arr = [];
        for ($a = 0; $a <= count($data['project_work_item']); $a++) {
            $arr[$data['project_work_item'][$a]['work_item_id']] = $this->Projectdashboard_model->get_all_activity_details($project_id, $data['project_work_item'][$a]['work_item_id']);
        }

        $data['project_milestone'] = $this->Projectdashboard_model->milestone_project_data($project_id);
        $this->load->common_template('dashboard/project_dashboard', $data);
		
    }

     public function  issue_details(){

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $data['issues'] = $this->Projectdashboard_model->get_issues_details($project_id);
        $this->load->common_template('dashboard/project_issue_details', $data);
     }

     

     public function  issue_details_open(){

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['issues'] = $this->Projectdashboard_model->get_issues_details_open($project_id);
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $this->load->common_template('dashboard/project_issue_details', $data);
     }

	
	
    function tab_content(){
		
        $project_id = base64_decode($_REQUEST['project_id']);
	  
		// ========= Project Information about 5 stages ===========
        // ====Project  details ======
        $data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
		// ============================================ 
        $data['project_preparation'] = $this->Projectdashboard_model->project_data_preparation($project_id);
        $data['project_preparation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_preparation_stage_documents','project_id',$project_id);

        $data['project_userinfo_preparation'] = $this->Projectdashboard_model->preparation_project_user_information($project_id);
        $data['sof_preparation'] = $this->Projectdashboard_model->preparation_sof($project_id);
        $data['project_pre_tender'] = $this->Projectdashboard_model->pretender_project_data($project_id);
        $data['project_pre_tender_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_pretender_stage_documents','project_id',$project_id);
        $data['tender_histroy'] = $this->Projectdashboard_model->getTenderHistory($project_id);
        $data['project_tender'] = $this->Projectdashboard_model->tender_project_data($project_id);
        $data['project_publishing_tender'] = $this->Projectdashboard_model->tender_publishing_project_data($project_id);
        $data['project_tender_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_tender_stage_documents','project_id',$project_id);
        $data['project_agreement'] = $this->Projectdashboard_model->agreement_project_data($project_id);
        $data['project_agreement_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_aggrement_stage_document','project_id',$project_id);
        $data['project_commissioning'] = $this->Projectdashboard_model->commissioning_project_data($project_id);
        $data['issue_list'] = $this->Projectdashboard_model->get_list_issues($project_id);	

        // ==============For Project Pre Construction Activities==============
        $data['project_pre_construction_setting'] = $this->Projectdashboard_model->project_pre_construction_settings_data($project_id);

        $data['project_id'] =$project_id;



        // ==============End For Project Pre Construction Activities==========
        //============Project Creation Data ===========
        $proj_rel_id = $this->Projectdashboard_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        $data['project_creation_data'] = $this->Projectdashboard_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $this->Projectdashboard_model->get_project_creation_users($proj_rel_id);



        //============End Project Creation Data ===========




        // ====Project Conceptualisation details ======
        $data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
        // ============================================ 

        //============Project DPR Data ===========
        
        $data['project_dpr_data'] = $this->Projectdashboard_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
         //============End Project DPR Data ===========

        //============Project Administrative Approval Data ===========
        
        $data['project_administrative_approval_data'] = $this->Projectdashboard_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
         //============End Project Administrative Approval Data ===========
		//=========== End Project Information ======================

		
        $this->load->view('dashboard/tab_project_info_dashboard', $data);
    }
	
	
/* for project tendering */
	function project_tendering_ajax_data(){
        $project_id = $this->input->post('project_id');
        $type = $this->input->post('type');
        if($type == 'pre_bid'){
            $pre_bid = $this->Projectdashboard_model->fetch_tendering_pre_bid_single_data('tendering_pre_bid', 'project_id', $project_id);
            
            $data['pre_bid'] = $pre_bid;
            if(!empty($pre_bid)){
                $data['pre_bid_bidder_data'] = $this->Projectdashboard_model->get_tendering_pre_bid_bidder_data($project_id);

                $data['pre_bid_bidder_data_document'] = $this->Projectdashboard_model->get_tendering_pre_bid_bidder_data_document($project_id);

            }
          
            $this->load->view('dashboard/tendering/pre_bid_view',$data);
        }

        if($type == 'technical_evalution'){

            $technical_evalution = $this->Projectdashboard_model->fetch_tendering_technical_evalution_single_data('tendering_technical_evalution', 'project_id', $project_id);
            
            $data['technical_evalution'] = $technical_evalution;
            if(!empty($technical_evalution)){
                  $data['technical_evalution_bidder_data'] = $this->Projectdashboard_model->get_tendering_technical_evalution_bidder_data($project_id);
                
            }

        
            $this->load->view('dashboard/tendering/technical_evalution_view',$data);
        }

         if($type == 'financial_evalution'){

             $financial_evalution = $this->Projectdashboard_model->fetch_tendering_financial_evalution_single_data('tendering_financial_evalution', 'project_id', $project_id);
            
            $data['financial_evalution'] = $financial_evalution;
            if(!empty($financial_evalution)){
              $data['financial_evalution_bidder_data'] = $this->Projectdashboard_model->get_tendering_financial_evalution_bidder_data($project_id);
          }

            $this->load->view('dashboard/tendering/financial_evalution_view',$data);
        }

        if($type == 'negotiation'){

             $negotiation = $this->Projectdashboard_model->fetch_tendering_negotiation_single_data('tendering_negotiation', 'project_id', $project_id);
            
            $data['negotiation'] = $negotiation;
             if(!empty($negotiation)){
                 $data['negotiation_bidder_data'] = $this->Projectdashboard_model->get_tendering_negotiation_bidder_data($project_id);
             }

           
            $this->load->view('dashboard/tendering/negotiation_view',$data);
        }

        if($type == 'issue_of_loa'){
            $issue_of_loa = $this->Projectdashboard_model->fetch_tendering_issue_of_loa_single_data('tendering_issue_of_loa', 'project_id', $project_id);
            
            $data['issue_of_loa'] = $issue_of_loa;
            if(!empty($issue_of_loa)){
            }
           
            $this->load->view('dashboard/tendering/issue_of_loa_view',$data);
        }

         if($type == 'aggrement'){
			 
        $data['project_agreement'] = $this->Projectdashboard_model->agreement_project_data($project_id);
        $data['project_agreement_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_aggrement_stage_document','project_id',$project_id);

            $this->load->view('dashboard/tendering/aggrement_view',$data);
        }
}

    function get_documents($issueid,$project_id) {

        $com_docs = $this->Projectdashboard_model->get_doc_files($issueid, $project_id);

        foreach($com_docs as $docs) {
            $r .= '<tr>
                    <td>'.$docs['document_name'].'</td>
                    <td>
                    <a href="'.base_url().'uploads/files/doc_upload/'.str_replace(' ','_',$docs['communication_file']).'" title="download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a>
                    </td>
                 </tr>';
        }
        echo $r;

    }
	
	
	  function project_images_data($project_id){
        //$project_id = 1;
        $approved_log_result = $this->Projectdashboard_model->get_project_approved_log_data($project_id);
		//print_r($approved_log_result);
        $img_data = array();
        $k = 0;
        if(is_array($approved_log_result)){
            foreach ($approved_log_result as $key => $value) {
                $gateWay = $this->Projectdashboard_model->getSpecificdata('project_progress_update_log_triggering','id',$value->log_id,'gateway');
				
                $result =  $this->Projectdashboard_model->fetch_project_images_data($project_id,$value->log_id);
			  //print_r($result);
                
                if(is_array($result)){
                    foreach ($result as $key) {
                       $img_data[$k]['image'] = $key->image_path;
                        $img_data[$k]['gateway'] = $gateWay;
                       $k++;
                    }
                }
            }
        }
        return $img_data;
    }
	
	  public function project_type($type_id)
    {
        return $this->Projectdashboard_model->get_project_type($type_id);
    }
	
	 /* Project Destination End*/
    public function project_sector($sector_id)
    {
        return $this->Projectdashboard_model->get_sector_id($sector_id);
    }

    public function project_group($group_id)
    {
        return $this->Projectdashboard_model->get_group_id($group_id);
    }


    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Projectdashboard_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Projectdashboard_model->project_destination($destination_id);
    }

	
	  public function project_milestone_activity($milestone_id,$project_id)
    {
        return $this->Projectdashboard_model->get_project_milestone_activity($milestone_id,$project_id);
    }
	
	  public function project_progress_activity($milestone_id,$activity_id,$project_id)
    {
       return  $this->Projectdashboard_model->project_milestone_activity($milestone_id,$activity_id,$project_id);
		
	
		
    }
	
	
    
    function get_vendor_data($project_id){
        $result_vendor = $this->Projectdashboard_model->get_vendor_data($project_id);

        $claimedTilldate = $releasedtTilldate = $vendor_name = [];
                    for($k = 0 ; $k < count($result_vendor) ; $k++ ){
                    $vendor = $result_vendor[$k]['vendor'];
                    $vendor_id = $result_vendor[$k]['vendor_id'];                   
                                       
                   
            $row_claim =  $this->Projectdashboard_model->get_invoice_data($project_id,$vendor_id);
           
            $tot_cnt = count($row_claim);
            $claim_amnt = [];
                for($i = 0 ; $i < count($row_claim) ; $i++ ){
               
                     $claim_amnt[$i] = $row_claim[$i]['claimed_amnt'];
               
            }           
            $SUMclaim_amount = array_sum($claim_amnt);
                   
            $row_released =  $this->Projectdashboard_model->get_invoicereleased_data($project_id,$vendor_id);
           
            $tot_Rcnt = count($row_released);
            $release_amnt = [];
                for($p = 0 ; $p < count($row_released) ; $p++ ){
               
                     $release_amnt[$p] = $row_released[$p]['released_amnt'];
               
            }           
            $SUMreleased_amount = array_sum($release_amnt);
             
             $vendor_name[$k] =  $vendor;
             $claimedTilldate[$k] =  (int)$SUMclaim_amount;
             $releasedtTilldate[$k] =  (int)$SUMreleased_amount;
                   
                }
       
        $data['vendor'] = $vendor_name;
        $data['claimed'] = $claimedTilldate;
        $data['released']= $releasedtTilldate;

        return $data;
    }
	
	function get_financial_data($project_id){
        $result_financial = $this->Projectdashboard_model->get_financial_data($project_id);

        
        return $result_financial;
    }
	

    public function get_physical_project_performance()
    {

         //$arr = $this->Project_model->get_all_activity_details($_REQUEST['project_id'], $_REQUEST['work_item_id']);
         // $project_id = 1;
         // $work_item_id = 1; 
         $arr = $this->Projectdashboard_model->get_all_activity_details_new($_REQUEST['project_id'], $_REQUEST['work_item_id']);
         //$arr = $this->Project_model->get_all_activity_details($project_id, $work_item_id);
          // echo '<pre>'; print_r($arr);
          // die();
        $categories = $target = $complete = [];
        for ($i = 0; $i < count($arr); $i++) {

           
            $done_data = 0;
            if($arr[$i]['ActivityAchievedTillDatePercentage'] != ''){
                $done_data = $arr[$i]['ActivityAchievedTillDatePercentage'];
            }
            $categories[$i] = $arr[$i]['pa_name'];
            $target[$i] = round($arr[$i]['TargetTillDatePercentage']);
            //$done[$i] = round($done_data);
			if ($done_data >= $target[$i]) {
				
            $done[$i] = round(($arr[$i]['TargetTillDatePercentage'] * $arr[$i]['ActivityAchievedTillDatePercentage']) / 100);
			}
			else {
            $done[$i] = round($done_data);
				
			}
			
			            $left[$i] = ($target[$i] - $done[$i]);
        }


        $data['categories'] = $categories;
        $data['target'] = $target;
        $data['complete'] = $done;
        $data['left'] = $left;
        //echo '<pre>';print_r($data);

        echo json_encode($data);
        exit();
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


    function get_project_work_item_xhr()
    {
        //echo "<pre>"; print_r($_REQUEST); //die();
        $project_id = $_REQUEST['project_id'];
        //$project_id = base64_decode($_REQUEST['project_id']);
        $work_item_type_id = $_REQUEST['work_item_type_id'];

        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Projectdashboard_model->get_project_work_items($project_id, $work_item_type_id);
        //echo "<pre>"; print_r($data['project_work_item_details']); die();


        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                 $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Projectdashboard_model->get_physical_activity_main($project_id, $work_item_id);
                //echo "<pre>"; print_r($data['physical_activity']); die();
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Projectdashboard_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        //echo "<pre>"; print_r($valueActivity); die();
                        //echo "<pre>"; print_r($data['financial_activity_details']); die();
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['financial_total_planned'] = $data['financial_activity_details'][0]['total_planned'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['financial_total_released'] = $data['financial_activity_details'][0]['total_released'];
                        

                        // Getting Activity Physical Details
                        $data['physical_activity_details'] = $this->Projectdashboard_model->get_physical_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                    
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_planned'] = $data['physical_activity_details'][0]['total_planned'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_released'] = $data['physical_activity_details'][0]['total_released'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_activity_quantity'] =  $valueActivity['total_activity_quantity'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_total_activity_allotted_quantity'] =  $valueActivity['total_activity_allotted_quantity'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['target_date'] =  $this->Projectdashboard_model->get_report_work_target_date($project_id,$valueActivity['project_activity_id'],$work_item_id);

                        // Getting Physical Activity Unit Details
                        $data['physical_activity_unit_details'] = $this->Projectdashboard_model->get_physical_activity_unit_details($project_id, $work_item_id, $valueActivity['project_activity_id']);
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['physical_qty_unit_name'] = $data['physical_activity_unit_details'][0]['unit_name'];

                    }
                }


            }
        
                      //  echo "<pre>"; print_r($project_work_item_details_ar); die();

            $html = '';
            if (!empty($project_work_item_details_ar)) {
                foreach ($project_work_item_details_ar as $key => $value) {

                    $accordian_id = $key + 1;
                    $work_item_name = $value['work_item_name'];
                    $work_item_id = $value['work_item_id'];

                    $html .= '<div class="panel panel-col-teal">
                    <div class="panel-heading" role="tab" id="heading' . $accordian_id . '">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse' . $accordian_id . ' "aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-align-justify"></i> ' . $work_item_name . '
                            </a>
                        </h4>
                    </div>
                    <div id="collapse' . $accordian_id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $accordian_id . '">
                        <div class="panel-body p-5" style="font-size: 11px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activities</th>';

                        $html .= '<th colspan = "2" style = "text-align: center; vertical-align: middle;" > Financial</th >';
                    $html .= '<th colspan="4" style="text-align: center; vertical-align: middle;">Physical</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Completion Date</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Last Reported</th>
                                    </tr><tr class="bg-blue-grey">';
                        $html .= '<th style="text-align: center; vertical-align: middle;">Planned Amount</th>
                                            <th style="text-align: center; vertical-align: middle;">Released Amount</th>';
                    $html .= '<th style="text-align: center; vertical-align: middle;">Unit</th>
                        <th style="text-align: center; vertical-align: middle;">Target</th>
                        <th style="text-align: center; vertical-align: middle;">Achieved</th>
                        <th style="text-align: center; vertical-align: middle;">Progress (%)</th>
                                            </tr></thead><tbody>';
                    //echo '<pre>'; print_r($value['activity_details']);
                    // die();
                    if (!empty($value['activity_details'])) {
                        foreach ($value['activity_details'] as $keyActivity => $valueActivity) {

                            $sl = $keyActivity + 1;
                            $activity_name = $valueActivity['activity_name'];
                            $activity_id = $valueActivity['activity_id'];

                            $financial_total_planned = $valueActivity['financial_total_planned'];
                            $financial_total_released = $valueActivity['financial_total_released'];
                            $physical_total_planned = round($valueActivity['physical_total_planned']);
                            $physical_total_released = round($valueActivity['physical_total_released']);

                            /*if($physical_total_activity_quantity){
                            $physical_total_activity_quantity = $valueActivity['physical_total_activity_quantity'];  
                          }else{
                            $physical_total_activity_quantity = '0.00 ';
                          }

                             
                             if($physical_total_activity_allotted_quantity){
                              $physical_total_activity_allotted_quantity = $valueActivity['physical_total_activity_allotted_quantity'];
                            }else{
                              $physical_total_activity_allotted_quantity = '0.00 ';
                            }*/
							
							if($physical_total_planned){
                            $physical_total_activity_quantity = $physical_total_planned;  
                          }else{
                            $physical_total_activity_quantity = '0.00 ';
                          }

                             
                             if($physical_total_released){
                              $physical_total_activity_allotted_quantity = $physical_total_released;
                            }else{
                              $physical_total_activity_allotted_quantity = '0.00 ';
                            }
							
							
                             
                             $target_date = $valueActivity['target_date'];


                             //$progress_per = ($physical_total_activity_allotted_quantity/$physical_total_activity_quantity)*100;

                             $progress_per = $physical_total_activity_quantity != 0 ? round($physical_total_activity_allotted_quantity/$physical_total_activity_quantity*100) : '';


                             $last_reported = $this->get_reported_date($project_id,$work_item_id,$activity_id);
                             if(!empty($last_reported) && $last_reported != '0000-00-00'){
                                $l_date =  date('d M, Y', strtotime($last_reported));
                             }else{
                                $l_date = 'NA';
                             }
                            $html .= '<tr style="text-align: center; vertical-align: middle;">
                                                    <td>' . $sl . '</td>
                                                    <td >' . $activity_name . '</td>';
                                $html .= '<td > <i class="fa fa-rupee-sign"></i> ' . $financial_total_planned . '</td>
                                         <td > <i class="fa fa-rupee-sign"></i> ' . $financial_total_released . '</td>';
                            $html .= '<td >' . $valueActivity['physical_qty_unit_name'] . '</td>
                                     <td >' . $physical_total_activity_quantity . '</td>
                                     <td >' . $physical_total_activity_allotted_quantity . '</td>
                                     <td >' . $progress_per . '</td>
                                     <td >' . date('d M, Y', strtotime($target_date)) . '</td>
                                     <td >' . $l_date . '</td>
                                   </tr>';
                        }
                    } else {
                        //$html .='<tr colspan="5"><td>No Data Available</td></tr>';
                        $html .= '<tr colspan="5">No Data Available</tr>';
                    }


                    $html .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';

                }
            }

        } else {
            $html .= 'No Data Available';
        }

        //echo "<br>project_work_item_details_ar: <pre>"; print_r($project_work_item_details_ar); die();
        echo $html;
        die();
    }
    public function get_reported_date($project_id,$work_item_id,$activity_id){
        return $this->Projectdashboard_model->get_reported_date($project_id,$work_item_id,$activity_id);
    }

    public function get_activity_dropdown($work_item_id = '', $project_id = '')
    {

        $req_project_id = !empty($_REQUEST['project_id']) ? $_REQUEST['project_id'] : $project_id;
        $req_work_item_id = !empty($_REQUEST['work_item_id']) ? $_REQUEST['work_item_id'] : $work_item_id;

        $activity_arr = $this->Projectdashboard_model->get_all_activity_details($req_project_id, $req_work_item_id);

        $html = ' <select id="activity_id" name="activity_id" class="form-control show-tick">
                      <option value="">Select Activity</option>';
        if (!empty($activity_arr)) {

            foreach ($activity_arr as $activity) {
                $html .= "<option value=" . $activity['activity_id'] . ">" . $activity['activity_name'] . "</option>";
            }
        }

        echo json_encode($html);
        exit;
    }

    function get_unit_name()
    {
        $unit_name = $this->Projectdashboard_model->get_unit_name($_REQUEST['project_id'], $_REQUEST['activity_id']);
        echo $unit_name[0]['name'];
        exit();
    }


    public function get_project_activity_performance_xhr()
    {
       // $project_details = $this->Project_model->get_project_details($_REQUEST['project_id']);
        $data['physical_progress_monthly_ar'] = $this->Projectdashboard_model->get_physical_progress_monthly($_REQUEST['project_id'], $_REQUEST['activity_id'],'','',$_REQUEST['work_item_id']);

        $fin_progress_ar = array();
		//echo "<br>project_work_item_details_ar: <pre>"; print_r($data['physical_progress_monthly_ar']); die();
        if (!empty($data['physical_progress_monthly_ar'])) {

            foreach ($data['physical_progress_monthly_ar'] as $key => $value) {
                 $from_date = new DateTime($value['month_date']);
                $fin_progress_ar[$key]['month_name'] =  $from_date->format('M y');
                $fin_progress_ar[$key]['month_timestamp'] = strtotime($value['month_name']);
                $fin_progress_ar[$key]['total_budget_monthly'] = $value['total_budget_monthly'];
                $fin_progress_ar[$key]['total_allotted_monthly'] = $value['total_allotted_monthly'];
                $fin_progress_ar[$key]['unit_name'] = $value['unit_id'];
            }
        }

        //$this->sortBy('month_timestamp', $fin_progress_ar);
        $filtered_fin_progress_ar = array();
        if (!empty($fin_progress_ar)) {
            $count = 0;
            foreach ($fin_progress_ar as $key => $value) {

                    $filtered_fin_progress_ar[$count]['period'] = date("Y-m", $value['month_timestamp']);
                    $filtered_fin_progress_ar[$count]['month_date'] = $value['month_name'];
                    $filtered_fin_progress_ar[$count]['planned'] = (int)$value['total_budget_monthly'];
                    $filtered_fin_progress_ar[$count]['released'] = (int)$value['total_allotted_monthly'];
					$unit = $this->Projectdashboard_model->unit_name_data($value['unit_name']);
					//print_r($unit);
					$filtered_fin_progress_ar[$count]['unit_name'] = $unit[0]['name'];
                    //$filtered_fin_progress_ar[$count]['unit_name'] = $value['unit_name'];
                    $count++;

            }

            echo json_encode($filtered_fin_progress_ar);
            exit();
        }
        exit();
    }


/* for project pre construction details view new code start on 27-04-2021 */
  function project_pre_construction_details_ajax_data(){
        $project_id = $this->input->post('project_id');
        //$project_id = 14;
        $type = $this->input->post('type');
        //$type = 'environmental_clearance';
        if($type == 'land_schedule'){
            $data['district_data'] = $this->Projectdashboard_model->get_land_schedule_data($project_id);
            $this->load->view('dashboard/pre_construction_activity/land_schedule_view',$data);
        }
        if($type == 'gov_land_alienation'){

            $gov_land_alienation_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_govt_land_alienation', 'project_id', $project_id);
            
            $data['gov_land_alienation_data'] = $gov_land_alienation_data;
            if(!empty($gov_land_alienation_data)){
            $data['gov_land_alienation_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_govt_land_alienation_location',$project_id, $gov_land_alienation_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/gov_land_alienation_view',$data);
        }

        if($type == 'private_land_dp'){
            $private_land_dp_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_pvt_land_direct_purchase', 'project_id', $project_id);
            
            $data['private_land_dp_data'] = $private_land_dp_data;
            if(!empty($private_land_dp_data)){
            $data['private_land_dp_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_pvt_land_direct_purchase_location',$project_id, $private_land_dp_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/private_land_dp_view',$data);
        }
        if($type == 'private_land_la'){

            $private_land_la_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_pvt_land_acquistion', 'project_id', $project_id);
            
            $data['private_land_la_data'] = $private_land_la_data;
            if(!empty($private_land_la_data)){
            $data['private_land_la_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_pvt_land_acquistion_location',$project_id, $private_land_la_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/private_land_la_view',$data);
        }
        if($type == 'forest_land'){

            $forest_land_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_forest_land', 'project_id', $project_id);
            
            $data['forest_land_data'] = $forest_land_data;
            if(!empty($forest_land_data)){
            $data['forest_land_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_forest_land_location',$project_id, $forest_land_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/forest_land_view',$data);
        }
        if($type == 'tree_cutting'){
            $tree_cutting_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_tree_cutting', 'project_id', $project_id);
            
            $data['tree_cutting_data'] = $tree_cutting_data;
            if(!empty($tree_cutting_data)){
            $data['tree_cutting_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_tree_cutting_location',$project_id, $tree_cutting_data[0]['id']);
            }


            $this->load->view('dashboard/pre_construction_activity/tree_cutting_view',$data);
        }
        if($type == 'environmental_clearance'){
            // echo "string";
            // die();
            $environmental_clearance_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_environment_clearance', 'project_id', $project_id);
            
            $data['environmental_clearance_data'] = $environmental_clearance_data;
            $this->load->view('dashboard/pre_construction_activity/environmental_clearance_view',$data);
        }
        if($type == 'utility_shifting_elec'){


            $utility_shifting_elec_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_electrical', 'project_id', $project_id);
            
            $data['utility_shifting_elec_data'] = $utility_shifting_elec_data;
            if(!empty($utility_shifting_elec_data)){
            $data['utility_shifting_elec_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_electric_location',$project_id, $utility_shifting_elec_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/utility_shifting_elec_view',$data);
        }
        if($type == 'utility_shifting_PH'){

            $utility_shifting_PH_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_ph', 'project_id', $project_id);
            
            $data['utility_shifting_PH_data'] = $utility_shifting_PH_data;
            if(!empty($utility_shifting_PH_data)){
            $data['utility_shifting_PH_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_ph_location',$project_id, $utility_shifting_PH_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/utility_shifting_PH_view',$data);
        }
        if($type == 'utility_shifting_RWSS'){

            $utility_shifting_RWSS_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_rwss', 'project_id', $project_id);
            
            $data['utility_shifting_RWSS_data'] = $utility_shifting_RWSS_data;
            if(!empty($utility_shifting_RWSS_data)){
            $data['utility_shifting_RWSS_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_rwss_location',$project_id, $utility_shifting_RWSS_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/utility_shifting_RWSS_view',$data);
        }
        if($type == 'encroachment_eviction'){

            $encroachment_eviction_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_encroachment_eviction', 'project_id', $project_id);
            
            $data['encroachment_eviction_data'] = $encroachment_eviction_data;
            if(!empty($encroachment_eviction_data)){
            $data['encroachment_eviction_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_encroachment_eviction_location',$project_id, $encroachment_eviction_data[0]['id']);
            }
            $this->load->view('dashboard/pre_construction_activity/encroachment_eviction_view',$data);
        }
        
    }


    function get_tahasils_name($tahasils_id){
        return $this->Projectdashboard_model->get_specific_data_against_value('tahsil_master','id',$tahasils_id,'tahsil_name');
    }

    function get_specific_data_against_value($table,$field,$get_id,$specifc_field){
        return $this->Projectdashboard_model->get_specific_data_against_value($table,$field,$get_id,$specifc_field);
    }


  /* end for 27-4-2021 */

  /* Start 02/06/2021 project_overviewdata */

  function get_project_wise_work_item_budget_released()
    {
        
        $project_id = $_REQUEST['project_id'];
             

        $data['work_item_budget_ar'] = $this->Projectdashboard_model->get_project_work_item_budget($project_id);

        $work_item_category_ar = array();
        $budget_ar = array();
        $released_ar = array();
        if (!empty($data['work_item_budget_ar'])) {
            foreach ($data['work_item_budget_ar'] as $key => $val) {
                array_push($work_item_category_ar, $val['work_item_description']);
                //array_push($budget_ar, (int)$val['amount']);
				
					
                $data['work_item_activity_budget_ar'] = $this->Projectdashboard_model->get_work_item_activity_budget($val['work_item_id']);
				$budget_amount = 0;
				if(is_array($data['work_item_activity_budget_ar'])){
						foreach($data['work_item_activity_budget_ar'] as $res){
							$activity_id = $res['project_activity_id'];
							$project_id = $res['project_id'];
							$activity_amount = $this->Projectdashboard_model->project_activity_amount_data($project_id, $activity_id);
							$budget_amount += $activity_amount;
						}
       			 }

				 $budget_amount;
				 
				    if ($budget_amount != "0") {

                    array_push($budget_ar, (int)$budget_amount);
                } else {

                    array_push($budget_ar, (int)0.00);
                }
				
				
				
                $data['work_item_released_ar'] = $this->Projectdashboard_model->get_project_wise_work_item_released($val['work_item_id']);

                if (!empty($data['work_item_released_ar'][0]['total_released'])) {

                    array_push($released_ar, (int)$data['work_item_released_ar'][0]['total_released']);
                } else {

                    array_push($released_ar, (int)0.00);
                }
            }
        }
        $json_data['category_ar'] = $work_item_category_ar;
        $json_data['budget_ar'] = $budget_ar;
        $json_data['released_ar'] = $released_ar;
        echo json_encode($json_data);
        die();

    }
  /* End 02/06/2021 */

  function get_project_wise_work_item_budget_data()
    {
        
        $project_id = $_REQUEST['project_id'];
        $type_show = $_REQUEST['type_show'];     

        $work_item_wise_ar = $this->Projectdashboard_model->get_project_work_item_data($project_id);
		
		$projecttotal_cost = $this->Projectdashboard_model->get_total_project_cost($project_id);
		 
		// $total_proj_cost = $financial_projecttotel_cost[0]['Project_cost'];
		
        //$data['work_item_budget_ar'] = $this->Projectdashboard_model->get_project_work_item_budget($project_id);

        /*$work_item_category_ar = array();
        $budget_ar = array();
        $released_ar = array();
        if (!empty($data['work_item_budget_ar'])) {
            foreach ($data['work_item_budget_ar'] as $key => $val) {
                array_push($work_item_category_ar, $val['work_item_description']);
                //array_push($budget_ar, (int)$val['amount']);
				
					
                $data['work_item_activity_budget_ar'] = $this->Projectdashboard_model->get_work_item_activity_budget($val['work_item_id']);
				$budget_amount = 0;
				if(is_array($data['work_item_activity_budget_ar'])){
						foreach($data['work_item_activity_budget_ar'] as $res){
							$activity_id = $res['project_activity_id'];
							$project_id = $res['project_id'];
							$activity_amount = $this->Projectdashboard_model->project_activity_amount_data($project_id, $activity_id);
							$budget_amount += $activity_amount;
						}
       			 }

				 $budget_amount;
				 
				    if ($budget_amount != "0") {

                    array_push($budget_ar, (int)$budget_amount);
                } else {

                    array_push($budget_ar, (int)0.00);
                }
				
				
				
                $data['work_item_released_ar'] = $this->Projectdashboard_model->get_project_wise_work_item_released($val['work_item_id']);

                if (!empty($data['work_item_released_ar'][0]['total_released'])) {

                    array_push($released_ar, (int)$data['work_item_released_ar'][0]['total_released']);
                } else {

                    array_push($released_ar, (int)0.00);
                }
            }
        }*/
		
		if ($type_show == "actual"){
					
			$workitem =  $planned  = $earned  = $paid =  [];
			
			
			for($k = 0 ; $k < count($work_item_wise_ar) ; $k++ ){
			
					$workitemdata = $work_item_wise_ar[$k]['work_item_description'];
					$planned_value = $work_item_wise_ar[$k]['Planned_Value'];
					$earned_value = $work_item_wise_ar[$k]['Earned_Value'];
					$paid_value = $work_item_wise_ar[$k]['Paid_Value'];
					
			 
			 $workitem[$k] =  $workitemdata;
			
			
			 $planned[$k] =  round($planned_value, 2);
			 $earned[$k] =  round($earned_value, 2);
			 $paid[$k] =  round($paid_value, 2);
									
				}
		
        $json_data['value_sufx'] = "Rs";
        $json_data['workitem_ar'] = $workitem;
        $json_data['planned_ar'] = $planned;
        $json_data['earned_ar'] = $earned;
        $json_data['paid_ar'] = $paid;
			
			
		
		}
		
		else {
			
			
		$workitem =  $planned = $Pplanned_val = $earned = $Pearned_val = $paid = $Ppaid_val = [];
		
		for($k = 0 ; $k < count($work_item_wise_ar) ; $k++ ){
			
					$workitemdata = $work_item_wise_ar[$k]['work_item_description'];
					$planned_value = $work_item_wise_ar[$k]['Planned_Value'];
					$earned_value = $work_item_wise_ar[$k]['Earned_Value'];
					$paid_value = $work_item_wise_ar[$k]['Paid_Value'];
					
					
			 $Pplanned_val[$k] =  round(($planned_value/$projecttotal_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($earned_value/$projecttotal_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($paid_value/$projecttotal_cost * 100), 2) ;
			 
					
			 
			 $workitem[$k] =  $workitemdata;
			 $planned[$k] =  $Pplanned_val[$k];
			 $earned[$k] =  $Pearned_val[$k];
			 $paid[$k] =  $Ppaid_val[$k];
									
				}
		
        $json_data['value_sufx'] = "%";
        $json_data['workitem_ar'] = $workitem;
        $json_data['planned_ar'] = $planned;
        $json_data['earned_ar'] = $earned;
        $json_data['paid_ar'] = $paid;
			
			
			
	
			
			
		}
		
        echo json_encode($json_data);
        die();

    }
	
	
  function get_project_wise_activity_budget_data()
    {
        
        $project_id = $_REQUEST['project_id'];
        $type_show = $_REQUEST['type_show'];     

        $activity_wise_ar = $this->Projectdashboard_model->get_project_activity_data($project_id);
		
		$projecttotal_cost = $this->Projectdashboard_model->get_total_project_cost($project_id);
		 
	
		if ($type_show == "actual"){
					
			$activity =  $planned =  $earned =  $paid =  [];
			
			
			for($k = 0 ; $k < count($activity_wise_ar) ; $k++ ){
			
					$activitydata = $activity_wise_ar[$k]['particulars'];
					$planned_value = $activity_wise_ar[$k]['Planned_Value'];
					$earned_value = $activity_wise_ar[$k]['Earned_Value'];
					$paid_value = $activity_wise_ar[$k]['Paid_Value'];
					
			 
			 $activity[$k] =  $activitydata;
			 $planned[$k] =  round($planned_value, 2);
			 $earned[$k] =  round($earned_value, 2);
			 $paid[$k] =  round($paid_value, 2);
									
				}
		
        $json_data['value_sufx'] = "Rs";
        $json_data['activity_ar'] = $activity;
        $json_data['planned_ar'] = $planned;
        $json_data['earned_ar'] = $earned;
        $json_data['paid_ar'] = $paid;
			
			
		
		}
		
		else {
			
			
		$activity =  $planned = $Pplanned_val = $earned = $Pearned_val = $paid = $Ppaid_val = [];
		
		for($k = 0 ; $k < count($activity_wise_ar) ; $k++ ){
			
					$activitydata = $activity_wise_ar[$k]['particulars'];
					$planned_value = $activity_wise_ar[$k]['Planned_Value'];
					$earned_value = $activity_wise_ar[$k]['Earned_Value'];
					$paid_value = $activity_wise_ar[$k]['Paid_Value'];
					
					
			 $Pplanned_val[$k] =  round(($planned_value/$projecttotal_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($earned_value/$projecttotal_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($paid_value/$projecttotal_cost * 100), 2) ;
			 
					
			 
			 $activity[$k] =  $activitydata;
			 $planned[$k] =  $Pplanned_val[$k];
			 $earned[$k] =  $Pearned_val[$k];
			 $paid[$k] =  $Ppaid_val[$k];
									
				}
		
        $json_data['value_sufx'] = "%";
        $json_data['activity_ar'] = $activity;
        $json_data['planned_ar'] = $planned;
        $json_data['earned_ar'] = $earned;
        $json_data['paid_ar'] = $paid;
			
			
			
	
			
			
		}
		
        echo json_encode($json_data);
        die();

    }
	
	
	
	
  function get_finnancial_progressdata()
    {
        //echo(strtotime("May 2018") . "<br>");
					$type_show = $_REQUEST['type_show'];
					$project_id = $_REQUEST['project_id'];
					$work_item_id = $_REQUEST['work_item_id'];
					$activity_id = $_REQUEST['activity_id'];
   			
	
		 $financial_data = $this->Projectdashboard_model->get_financial_overview($project_id,$work_item_id,$activity_id);
	
		 $projecttotal_cost = $this->Projectdashboard_model->get_total_project_cost($project_id);
		 
		 
		/*echo "<pre>";
		print_r($data['financial_data']);
		echo "</pre>";*/
		
		if ($type_show == "actual"){
		
		$period = $periodmonth = $planned = $earned = $paid = [];
				//foreach ($result_phisical as $key) {
					for($k = 0 ; $k < count($financial_data) ; $k++ ){
					$perioddata = $financial_data[$k]['period'];
					$planned_value = $financial_data[$k]['Planned_Value'];
					$earned_value = $financial_data[$k]['Earned_Value'];
					$paid_value = $financial_data[$k]['Paid_Value'];
					
			 
			 $periodmonth[$k] =  $perioddata."-01";
			 $period[$k] =  date("M-Y", strtotime($periodmonth[$k]));
			 $planned[$k] =  $planned_value+0;
			 $earned[$k] =  $earned_value+0;
			 $paid[$k] =  $paid_value+0;
				/*	echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
					
				}
		
        $data['value_sufx'] = "Rs.";
        $data['period'] = $period;
        $data['planned'] = $planned;
        $data['earned']= $earned;
        $data['paid']= $paid;
		
				}
				
		else
				{
					
					$period = $periodmonth = $planned = $Pplanned_val = $earned = $Pearned_val = $paid = $Ppaid_val = [];
				//foreach ($result_phisical as $key) {
					for($k = 0 ; $k < count($financial_data) ; $k++ ){
					$perioddata = $financial_data[$k]['period'];
					$planned_value = $financial_data[$k]['Planned_Value'];
					$earned_value = $financial_data[$k]['Earned_Value'];
					$paid_value = $financial_data[$k]['Paid_Value'];
					
					
			 
			 $periodmonth[$k] =  $perioddata."-01";
			 $period[$k] =  date("M-Y", strtotime($periodmonth[$k]));
			 //$planned_value."<br>";round(1.95583, 2);
			 
			 $Pplanned_val[$k] =  round(($planned_value/$projecttotal_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($earned_value/$projecttotal_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($paid_value/$projecttotal_cost * 100), 2) ;
			 
			 $planned[$k] =  $Pplanned_val[$k];
			 $earned[$k] =  $Pearned_val[$k];
			 $paid[$k] =  $Ppaid_val[$k];
				/*	echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
					
				}
		
        $data['value_sufx'] = "%";
        $data['period'] = $period;
        $data['planned'] = $planned;
        $data['earned']= $earned;
        $data['paid']= $paid;
			
					
				}
		
		
		
		echo json_encode($data);
                die();
		
       
        die();
        // Get all projects financial progress (Planned & Released)
    }
	
	

     function get_finnancial_cumulativedata()
    {
        //echo(strtotime("May 2018") . "<br>");
				
					$type_show = $_REQUEST['type_show'];
					$project_id = $_REQUEST['project_id'];
					$work_item_id = $_REQUEST['work_item_id'];
					$activity_id = $_REQUEST['activity_id'];
   			
	
		 $financial_data = $this->Projectdashboard_model->get_financial_overview($project_id,$work_item_id,$activity_id);
	
		 $projecttotal_cost = $this->Projectdashboard_model->get_total_project_cost($project_id);
		 
	
		
		/*echo "<pre>";
		print_r($financial_data);
		echo "</pre>";*/
		
		if ($type_show == "actual"){
		
		$period = $periodmonth = $planned = $earned = $paid = [];
				//foreach ($result_phisical as $key) {
					for($k = 0 ; $k < count($financial_data) ; $k++ ){
					
					$perioddata = $financial_data[$k]['period'];
					$planned_value = $financial_data[$k]['Planned_Value'];
					$earned_value = $financial_data[$k]['Earned_Value'];
					$paid_value = $financial_data[$k]['Paid_Value'];
					
					
					
					  $financial_data[$k]['Planned_Value']=$financial_data[$k]['Planned_Value']+$financial_data[$k-1]['Planned_Value'];
					  $financial_data[$k]['Earned_Value']=$financial_data[$k]['Earned_Value']+$financial_data[$k-1]['Earned_Value'];
					  $financial_data[$k]['Paid_Value']=$financial_data[$k]['Paid_Value']+$financial_data[$k-1]['Paid_Value'];
					
				
					
			 $periodmonth[$k] =  $perioddata."-01";
			 $period[$k] =  date("M-Y", strtotime($periodmonth[$k]));
			 
			 
			// echo "<br>";
			// echo $claimeddata."<br>";
			// echo $prev_val."---<br>";
			 //echo $claimeddata+$prev_val."VAL---<br>";
			 $prev_val = $claimeddata;
			 //$period[$k] =  $perioddata;
			 //$claimed[$k] =  $claimeddata+0;
			 //$released[$k] =  $releaseddata+0;
			 $planned[$k] =  round($financial_data[$k]['Planned_Value'], 2);
				/*	echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
		
		//echo $period[$k]."---";
		  $dbdate = date("Y-m-d", strtotime($periodmonth[$k]));
		  $currdate = date(("Y-m")."-01");
		
		//if(date("m-Y", strtotime($periodmonth[$k])) == date("m-Y"))
		if($dbdate > $currdate)
			{
				//if they are the same it will come here
				//echo "same"."<br>";
					$earned[$k] =  " ";
				 	$paid[$k] =  " ";
			}
			else
			{
			 $earned[$k] =  round($financial_data[$k]['Earned_Value'], 2);
			 $paid[$k] =  round($financial_data[$k]['Paid_Value'], 2);
				//echo "diff"."<br>";
				// they aren't the same
				
			}
		
		
		
			
					
				}
		$data['value_sufx'] = "Rs.";
        $data['period'] = $period;
        $data['planned'] = $planned;
        $data['earned']= $earned;
        $data['paid']= $paid;
		
				}
			else {
					
					$period = $periodmonth = $planned = $Pplanned_val = $earned = $Pearned_val = $paid = $Ppaid_val = [];
				
				//foreach ($result_phisical as $key) {
					for($k = 0 ; $k < count($financial_data) ; $k++ ){
					
					$perioddata = $financial_data[$k]['period'];
					$planned_value = $financial_data[$k]['Planned_Value'];
					$earned_value = $financial_data[$k]['Earned_Value'];
					$paid_value = $financial_data[$k]['Paid_Value'];
					
					
		
					
					  $financial_data[$k]['Planned_Value']=$financial_data[$k]['Planned_Value']+$financial_data[$k-1]['Planned_Value'];
					  $financial_data[$k]['Earned_Value']=$financial_data[$k]['Earned_Value']+$financial_data[$k-1]['Earned_Value'];
					  $financial_data[$k]['Paid_Value']=$financial_data[$k]['Paid_Value']+$financial_data[$k-1]['Paid_Value'];
					
				
					
			 $periodmonth[$k] =  $perioddata."-01";
			 $period[$k] =  date("M-Y", strtotime($periodmonth[$k]));
			 
			 
			 
			 $Pplanned_val[$k] =  round(($financial_data[$k]['Planned_Value']/$projecttotal_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($financial_data[$k]['Earned_Value']/$projecttotal_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($financial_data[$k]['Paid_Value']/$projecttotal_cost * 100), 2) ;
			 
			 $planned[$k] =  $Pplanned_val[$k];
			// $earned[$k] =  $Pearned_val[$k];
			// $paid[$k] =  $Ppaid_val[$k];
			 
			 
			$dbdate = date("Y-m-d", strtotime($periodmonth[$k]));
		  	$currdate = date(("Y-m")."-01");
		
		//if(date("m-Y", strtotime($periodmonth[$k])) == date("m-Y"))
		if($dbdate > $currdate)
			{
				//if they are the same it will come here
					$earned[$k] =  " ";
				 	$paid[$k] =  " ";
			}
			else
			{
				
			 $earned[$k] =  $Pearned_val[$k];
			 $paid[$k] =  $Ppaid_val[$k];
				// they aren't the same
			}
		
					
				}
		$data['value_sufx'] = "%";
        $data['period'] = $period;
        $data['planned'] = $planned;
        $data['earned']= $earned;
        $data['paid']= $paid;
				
				
			}
		
		
		
		echo json_encode($data);
              //  die();
		
       
        die();
        // Get all projects financial progress (Planned & Released)
    }
	
	
    function get_project_work_item_activity_table()
    {
        //echo "<pre>"; print_r($_REQUEST); //die();
        $project_id = $_REQUEST['project_id'];
        //$project_id = base64_decode($_REQUEST['project_id']);
        $work_item_type_id = $_REQUEST['work_item_type_id'];

        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Projectdashboard_model->get_project_work_items($project_id, $work_item_type_id);
        $project_total_data = $this->Projectdashboard_model-> get_project_total_data($project_id);
        //echo "<pre>"; print_r($data['project_work_item_details']); die();

        //Total Project Cost
         $project_total_cst = $this->Projectdashboard_model->get_total_project_cost($project_id);

        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                 $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Projectdashboard_model->get_financial_activity_data($project_id, $work_item_id);
                
                //echo "<pre>"; print_r($data['physical_activity']); die();
               // echo "<pre>"; print_r($project_work_item_details_ar); 
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Projectdashboard_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        //echo "<pre>"; print_r($valueActivity); die();
                        //echo "<pre>"; print_r($data['financial_activity_details']); die();
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
						
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Planned_Value'] = $valueActivity['Planned_Value'];
						
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Earned_Value'] = $valueActivity['Earned_Value'];
						
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Paid_Value'] = $valueActivity['Paid_Value'];
						
						
						

                    }
                }


            }
        
                       // echo "<pre>"; print_r($project_work_item_details_ar); die();

            $html = '';
            if (!empty($project_work_item_details_ar)) {
                foreach ($project_work_item_details_ar as $key => $value) {

                    $accordian_id = $key + 1;
                    $work_item_name = $value['work_item_name'];
                    $work_item_id = $value['work_item_id'];

                    $html .= '<div class="panel panel-col-teal">
                    <div class="panel-heading" role="tab" id="heading' . $accordian_id . '">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse' . $accordian_id . ' "aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-align-justify"></i> ' . $work_item_name . '
                            </a>
                        </h4>
                    </div>
                    <div id="collapse' . $accordian_id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $accordian_id . '">
                        <div class="panel-body p-5" style="font-size: 11px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activity Name</th>';

                       // $html .= '<th colspan = "2" style = "text-align: center; vertical-align: middle;" > Financial</th >';
                    $html .= '<th rowspan="2" style="text-align: center; vertical-align: middle;">Start</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Duration (Month)</th>
                    <th style="text-align: center; vertical-align: middle;">Finish Date</th>
                    <th style="text-align: center; vertical-align: middle;">Weightage (%)</th>';
                        // $html .= '<th style="text-align: center; vertical-align: middle;">Finish Date</th>
                        //                     <th style="text-align: center; vertical-align: middle;">Weightage (%)</th>';
                   

                    $html .= '<th style="text-align: center; vertical-align: middle;">Value <br>(<i class="fa fa-rupee-sign"></i>)</th>
                        <th style="text-align: center; vertical-align: middle;">Earned Value <br>(<i class="fa fa-rupee-sign"></i>)</th>
                        <th style="text-align: center; vertical-align: middle;">Actual Cost <br>(%)</th>
                        <th style="text-align: center; vertical-align: middle;">Actual Cost <br>(<i class="fa fa-rupee-sign"></i>)</th>
                                            </tr></thead><tbody>';
                    //echo '<pre>'; print_r($value['activity_details']);
                    // die();
                    if (!empty($value['activity_details'])) {
                        foreach ($value['activity_details'] as $keyActivity => $valueActivity) {

                            $sl = $keyActivity + 1;
                            $activity_name = $valueActivity['activity_name'];
                            $activity_id = $valueActivity['activity_id'];
                            $val_total_planned = number_format($valueActivity['Planned_Value'], 2);
                            $val_total_earned = number_format($valueActivity['Earned_Value'], 2);
                            $val_total_paid = number_format($valueActivity['Paid_Value'], 2);
							
							//start date
                            $start_date = $this->Projectdashboard_model->get_project_startdate($project_id,$work_item_id,$activity_id);
							
							$start_dateview = date('M Y', strtotime($start_date[0]['month_date']));
							
							//finish date
                            $finish_date = $this->Projectdashboard_model->get_project_finishdate($project_id,$work_item_id,$activity_id);
							$finish_dateview = date('M Y', strtotime($finish_date[0]['month_date']));
							
							/*$diff = abs(strtotime($finish_date[0]['month_date']) - strtotime($start_date[0]['month_date']));
							
							$years = floor($diff / (365*60*60*24));
							$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							$duration="";
							if ($years != "0"){
								$duration.= $years." Year";
							}
							if ($months != "0"){
								$calM = $months+1;
								$duration.= $calM." Month";
							}*/
							
							
							$duration="";
							$ts1 = strtotime($start_date[0]['month_date']);
							$ts2 = strtotime($finish_date[0]['month_date']);
							
							$year1 = date('Y', $ts1);
							$year2 = date('Y', $ts2);
							
							$month1 = date('m', $ts1);
							$month2 = date('m', $ts2);
							
							$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
							$calM = $diff+1;
							if ($calM <= "1") {
							$duration= $calM." Month";
							}
							else
							{
							$duration= $calM." Months";								
							}
							
							
							/* $d1=new DateTime($finish_date[0]['month_date']); 
							 $d2=new DateTime($start_date[0]['month_date']);                                  
							 $Months = $d2->diff($d1); 
							 $howeverManyMonths = (($Months->y) * 12) + ($Months->m);
							 
							 	$startDate = new DateTime($start_date[0]['month_date']);
								$endDate = new DateTime($finish_date[0]['month_date']);
								
								$difference = $endDate->diff($startDate);
								 $difference->format("%m");
							 
							 
							 
							 $age = 0;

							if($ts2 < $ts1) {
								//prenatal
								$age = -1;
							} else {
								//born, count months.
								while($ts1 < $ts2) {
									$age++;
									$ts1 = strtotime('+1 MONTH', $ts1);
									if ($ts1 > $ts2) {
										$age--;
									}
								}
							}*/
							
							
							
							
							
							
							
							$weightage =  round(($valueActivity['Planned_Value']/$project_total_cst * 100), 2) ;
							//Progress Status %
							$progress =  round(($valueActivity['Earned_Value']/$project_total_cst * 100), 2) ;
							//Actual Cost % 
							$actual_cost =  round(($valueActivity['Paid_Value']/$project_total_cst * 100), 2) ;
							
							
							
                                         $Planned_Value = $valueActivity['Planned_Value'];
                                         $Earned_Value = $valueActivity['Earned_Value'];
                                         $Paid_Value = $valueActivity['Paid_Value'];

                                         $PV =  ($Planned_Value * 100 ) / $project_total_cst;
                                         $EV =  ($Earned_Value * 100 ) / $project_total_cst;
                                         $AC =  ($Paid_Value * 100 ) / $project_total_cst;
										 
										 $SV = $EV - $PV;
                                         $SPI = $EV / $PV;
                                         $CV = $EV - $AC;
										 
                                         if($AC != 0){
                                         $CPI = $EV / $AC;
                                         }else{
                                            $CPI = 0.00;
										 }
							
							

                       
                            $html .= '<tr style="text-align: center; vertical-align: middle;">
                                                    <td>' . $sl . '</td>
                                                    <td >' . $activity_name . '</td>';
                                $html .= '<td >' . $start_dateview . '</td>
                                         <td >' . $duration . '</td>';
                            $html .= '<td >' . $finish_dateview . '</td>
                                     <td >' . $weightage . '</td>
                                     <td >' . $val_total_planned . '</td>';
                                     // $html .= '<td >' . round($SV,2) . '</td>
                                     // <td >' . round($SPI,2) . '</td>
                                     // <td >' . round($CV,2) . '</td>
                                     // <td >' . round($CPI,2) . '</td>';
                                     $html .= '<td >' . $val_total_earned . '</td>
                                     <td >' . $actual_cost . '</td>
                                     <td >' . $val_total_paid . '</td>
                                   </tr>';
                        }
                    } else {
                        //$html .='<tr colspan="5"><td>No Data Available</td></tr>';
                        $html .= '<tr ><td colspan="9">No Data Available</td></tr>';
                    }


                    $html .= '</tbody>
                            </table>
                        </div>
                    </div>
                </div>';

                }
            }

            /* all data show table */
            if(!empty($project_total_data)){
             $total_Planned_Value = $project_total_data[0]['Planned_Value'];
             $total_Earned_Value = $project_total_data[0]['Earned_Value'];
             $total_Paid_Value = $project_total_data[0]['Paid_Value'];

             $total_PV =  ($total_Planned_Value  ) / $project_total_cst;
             $total_EV =  ($total_Earned_Value  ) / $project_total_cst;
             $total_AC =  ($total_Paid_Value  ) / $project_total_cst;
             
             $total_SV = $total_EV - $total_PV;
             $total_SPI = $total_EV / $total_PV;
             $total_CV = $total_EV - $total_AC;
             
             if($total_AC != 0){
             $total_CPI = $total_EV / $total_AC;
             }else{
                $total_CPI = 0.00;
             }

            $html .= '<div class="col-lg-6 col-md- 6 col-sm-12 col-xs-12 panel-body p-5" style="font-size: 11px">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tr>
                        <td><b>Planned Value</b></td>
                        <td><i class="fa fa-rupee-sign"></i> '.number_format($total_Planned_Value,2).' ('.round($total_PV,2).')</td>
                        <td><b>SV</b></td>
                        <td>'.round($total_SV,2) .'</td>

                        </tr>
                        <tr>
                        <td><b>Earned Value</b></td>
                        <td><i class="fa fa-rupee-sign"></i> '.number_format($total_Earned_Value,2).' ('.round($total_EV,2).')</td>
                        <td><b>SPI</b></td>
                        <td>'.round($total_SPI,2) .'</td>

                        </tr>
                         <tr>
                        <td><b>Actual Cost</b></td>
                        <td><i class="fa fa-rupee-sign"></i> '.number_format($total_Paid_Value,2).' ('.round($total_AC,2).')</td>
                        <td><b>CV</b></td>
                        <td>'.round($total_CV,2) .'</td>

                        </tr>
                         <tr>
                        <td></td>
                        <td></td>
                        <td><b>CPI</b></td>
                        <td>'.round($total_CPI,2) .'</td>

                        </tr>
                            
                        </table>
                    </div>';

        }

        /* close all data show table */

        } else {
            $html .= 'No Data Available';
        }

        //echo "<br>project_work_item_details_ar: <pre>"; print_r($project_work_item_details_ar); die();
        echo $html;
        die();
    }



    function get_project_pre_construction_overview(){
        $project_id = $_REQUEST['project_id'];
      
        $pr_result = $this->Projectdashboard_model->get_project_pre_construction_overview_percent($project_id);

        echo json_encode($pr_result);
    }

    function get_project_pre_construction_cost_chart() {
        $project_id = $_REQUEST['project_id'];
      
        $pr_result = $this->Projectdashboard_model->get_project_pre_construction_cost_overview($project_id);

        echo json_encode($pr_result);

   }
   
    function get_individual_chart() {

        $project_id = $_REQUEST['project_id'];
        $pr_result = $this->Projectdashboard_model->get_individual_data($project_id);
        echo json_encode($pr_result);
      
    }
	
	
}

?>