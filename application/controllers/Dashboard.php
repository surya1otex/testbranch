<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{  
 public $financial_module_permission;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('Dashboard_model');
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

    /* Dashboard */
    public function index()
    {
		 $division_id = $this->session->userdata('division_id');
		// Preparinng project summary data
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
		
        $data['project_category'] = $this->Dashboard_model->get_project_type();
        $data['project_area'] = $this->Dashboard_model->get_project_area();
        $data['sector_list'] = $this->Dashboard_model->get_sector();
        $data['group_list'] = $this->Dashboard_model->get_group();
        $data['wing_list'] = $this->Dashboard_model->get_wing();
        $data['division_list'] = $this->Dashboard_model->get_division();

        $data['division_name'] = $this->Dashboard_model->count_division_name($division_id);
		
	
        $this->load->common_template('dashboard/dashboard', $data);
										    
    }
	
	public function org_project_summary(){

			$circle_id = $this->session->userdata('circle_id');
            $division_id = $this->session->userdata('division_id');

			 echo $circle_id;
			// echo $division_id;
			
			   if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
		
	 // Preparinng project summary data
      
		
        // Preparinng project summary data
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
		 
        $data['total_project'] = $this->Dashboard_model->get_total_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
       
        $data['ongoing_project'] = $this->Dashboard_model->get_ongoing_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		$data['total_ongoing_project'] = COUNT($data['ongoing_project']);
 

         $data['puri_project'] = $this->Dashboard_model->get_puri_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		$data['total_puri_project'] = COUNT($data['puri_project']);
        

    
         $data['nonpuri_project'] = $this->Dashboard_model->get_nonpuri_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
    	 $data['total_nonpuri_project'] = COUNT($data['nonpuri_project']); 
         
        $data['circle1_project'] = $this->Dashboard_model->get_circle1_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		$data['total_circle1_project'] = COUNT($data['circle1_project']);

		$data['circle2_project'] = $this->Dashboard_model->get_circle2_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		$data['total_circle2_project'] = COUNT($data['circle2_project']);

		$data['circle3_project'] = $this->Dashboard_model->get_circle3_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		$data['total_circle3_project'] = COUNT($data['circle3_project']);

		// $data['cgm1_project'] = $this->Dashboard_model->get_cgm1_project_count();
		// $data['total_cgm1_project'] = COUNT($data['cgm1_project']); 

		// $data['srcgm_project'] = $this->Dashboard_model->get_srcgm_project_count();
		// $data['total_srcgm_project'] = COUNT($data['srcgm_project']); 

		// $data['cgm3_project'] = $this->Dashboard_model->get_cgm3_project_count();
		// $data['total_cgm3_project'] = COUNT($data['cgm3_project']);

		$data['closed_project'] = $this->Dashboard_model->get_closed_project_count();
		$data['total_closeissue_project'] = COUNT($data['closed_project']);

		$data['open_project'] = $this->Dashboard_model->get_open_project_count();
		$data['total_openissue_project'] = COUNT($data['open_project']);


        $data['completed_project'] = $this->Dashboard_model->get_completed_project_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		
        $data['all_project_budget'] = $this->Dashboard_model->get_project_budget($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        
        $data['all_project_budget_words'] = $this->no_to_words($data['all_project_budget'][0]['total_project_budget']);
     
        $all_project_budget_words_ar = array();
        if (!empty($data['all_project_budget_words'])) {
            $all_project_budget_words_ar = explode(' ', $data['all_project_budget_words']);
            $all_project_budget_number = $all_project_budget_words_ar[0];
            $all_project_budget_suffix = $all_project_budget_words_ar[1];
        } else {
            $all_project_budget_number = 0;
            $all_project_budget_suffix = '';
        }
        

        $data['all_project_agreement_amount'] = $this->Dashboard_model->get_project_agreement_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);

        $data['all_project_agreement_words'] = $this->no_to_words($data['all_project_agreement_amount'][0]['proj_agreement_cost']);
        $all_project_agreement_words_ar = array();
        if (!empty($data['all_project_agreement_words'])) {
            $all_project_agreement_words_ar = explode(' ', $data['all_project_agreement_words']);
            $all_project_agreement_number = $all_project_agreement_words_ar[0];
            $all_project_agreement_suffix = $all_project_agreement_words_ar[1];
        } else {
            $all_project_agreement_number = 0;
            $all_project_agreement_suffix = '';
        }
        $data['all_project_agreement_number'] = $all_project_agreement_number;
        $data['all_project_agreement_suffix'] = $all_project_agreement_suffix;
		
		//Expendature amount
		$data['all_project_expen'] = $this->Dashboard_model->get_project_paid_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        $data['all_project_expen_words'] = $this->no_to_words($data['all_project_expen'][0]['total_project_expen']);
		
        $all_project_expen_words_ar = array();
        if (!empty($data['all_project_expen_words'])) {
            $all_project_expen_words_ar = explode(' ', $data['all_project_expen_words']);
            $all_project_expen_number = $all_project_expen_words_ar[0];
            $all_project_expen_suffix = $all_project_expen_words_ar[1];
        } else {
            $all_project_expen_number = 0;
            $all_project_expen_suffix = '';
        }


	    $data['all_project_budget_number'] = $all_project_budget_number;
        $data['all_project_budget_suffix'] = $all_project_budget_suffix;
   
		
        $data['all_project_expen_number'] = $all_project_expen_number;
        $data['all_project_expen_suffix'] = $all_project_expen_suffix;
			
	
	    $this->load->view('dashboard/project_summary_cnt', $data);
		}
	
	
	public function org_project_overview_old()
			{
			
	
			
			  if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_destination_id'])) {
					$project_destination_id = $_REQUEST['project_destination_id'];
				} else {
					$project_destination_id = 0;
				}
		
	 // Tender Issued Data
	 		// Projects
			$tender_projecct = $this->Dashboard_model->get_tenderProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
				/*echo "<pre>";
			print_r($tender_projecct);
			echo "</pre>";*/
		    $newprojIds = implode(",", array_column($tender_projecct, 'id'));
			$data['tender_project'] = count($tender_projecct);
	 		// AA Amount
			if(!empty($newprojIds)) {
			$tender_projecct_aaamount = $this->Dashboard_model->get_tenderProjectAA_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newprojIds);
			$tender_projecctAA_amnta = $tender_projecct_aaamount[0]['aa_amount'];
			$tender_projecctAA_amnt =  number_format((float)$tender_projecctAA_amnta, 2, '.', '');
			$data['Viewtender_projecctAA_amnt'] = $this->no_to_words($tender_projecctAA_amnt);
			} else {
			$tender_projecctAA_amnt =  "0.00";
			$data['Viewtender_projecctAA_amnt'] = "0.00";
			}
      		// Achieved
			$tender_aaamount = $this->Dashboard_model->get_tenderAA_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
			$tender_AA_amnta = $tender_aaamount[0]['aa_amounttotal'];	
			$tender_AA_amnt =  number_format((float)$tender_AA_amnta, 2, '.', '');		
			$data['achieved_tenderamnt'] = round(($tender_projecctAA_amnt/$tender_AA_amnt) * 100);
      
	 // Work Order Issued Data
	 		// Projects
			$woi_projecct = $this->Dashboard_model->get_WOIProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
		    $newwoiprojIds = implode(",", array_column($woi_projecct, 'id'));
			$data['woi_project'] = count($woi_projecct);
	 		// Project Cost Amount
			if(!empty($newwoiprojIds)) {
			$woi_projecct_aaamount = $this->Dashboard_model->get_woi_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newwoiprojIds);
			$woi_project_costa = $woi_projecct_aaamount[0]['total_proj_cost'];
			$woi_project_cost =  number_format((float)$woi_project_costa, 2, '.', '');
			$data['Viewwoi_project_cost'] = $this->no_to_words($woi_project_cost);
			} else {
			$woi_project_cost =  "0.00";
			$data['Viewwoi_project_cost'] = "0.00";
			}
      		// Achieved
			$woi_amount = $this->Dashboard_model->get_woi_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
			$woi_costa = $woi_amount[0]['woi_proj_cost'];			
			$woi_cost =  number_format((float)$woi_costa, 2, '.', '');
			$data['achieved_woiamnt'] = round(($woi_project_cost/$woi_cost) * 100);
      
	 // Work Completed  Data
	 		// Projects
			$wc_projecct = $this->Dashboard_model->get_WCProject($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
			
		    $newwcprojIds = implode(",", array_column($wc_projecct, 'id'));
			$data['wc_project'] = count($wc_projecct);
	 		// Project Cost Amount
			if(!empty($newwcprojIds)) {
			$wc_projecct_aaamount = $this->Dashboard_model->get_wc_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$newwcprojIds);			
			$wc_project_costa = $wc_projecct_aaamount[0]['total_wcproj_cost'];
			$wc_project_cost =  number_format((float)$wc_project_costa, 2, '.', '');
			$data['Viewwc_project_cost'] = $this->no_to_words($wc_project_cost); } else {
			$wc_project_cost =  "0.00";
			$data['Viewwc_project_cost'] = "0.00";
			}
      		// Achieved
			$wc_amount = $this->Dashboard_model->get_wc_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id);
			$wc_costa = $wc_amount[0]['wc_proj_cost'];			
			$wc_cost =  number_format((float)$wc_costa, 2, '.', '');
			$data['achieved_wcamnt'] = round(($wc_project_cost/$wc_cost) * 100);
			
			
			/*echo "<pre>";
			print_r($data);
			echo "<pre>";*/
	        //die;
			$this->load->view('dashboard/project_overview', $data);
		}



function org_project_overview(){
			$circle_id = $this->session->userdata('circle_id');
			$division_id = $this->session->userdata('division_id');

			if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
				//$project_group_id = 2;
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}

				$total_project = $this->Dashboard_model->org_project_overview_count_all($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id );

				$ad_approval_project_cnt = $this->Dashboard_model->ad_approval_project_cnt_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id );
				
				$published_tender_data = $this->Dashboard_model->tender_published_project_listscnt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
				
				$construction_data = $this->Dashboard_model->construction_project_listscnt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
				
				//$preconstruction_data = $this->Dashboard_model->Preconstruction_project_listscnt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);

				//$idCats = array_column($preconstruction_data, 'proj_id');
				//$all_prj_id = implode(",", $idCats);
				
				//$preconstruction_dataamnt = $this->Dashboard_model->Preconstruction_project_details($all_prj_id);
				
				$completed_data = $this->Dashboard_model->completed_project_listscnt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
				
				/*$total_agreenet_count =  $this->Dashboard_model->count_total_agreenet_count($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);*/
				$total_completed = $this->Dashboard_model->count_total_completed_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);

				$data['planning_cnt'] = $total_project - $ad_approval_project_cnt;

$data['division_count'] = $this->Dashboard_model->count_division($division_id);
//echo $data['division_count'];

$data['division_amount'] = $this->Dashboard_model->count_division_amount($division_id);

$data['division_name'] = $this->Dashboard_model->count_division_name($division_id);

				
				//$data['tendering_cnt'] = count($published_tender_data);
				
				//$data['agreement_count'] = count($published_tender_data);
				//$data['Construction_count'] = count($construction_data);
				
				
				if(is_array($published_tender_data))
				{
				   $var = array_filter($published_tender_data);
				   $data['tendering_cnt'] = count($published_tender_data);
				}
				else
				{
				   $data['tendering_cnt'] = 0;
				}
				
				if(is_array($construction_data))
				{
				   $var = array_filter($construction_data);
				   $data['Construction_count'] = count($construction_data);
				}
				else
				{
				   $data['Construction_count'] = 0;
				}
				
				if(is_array($preconstruction_data))
				{
				   $var = array_filter($preconstruction_data);
				   $data['preConstruction_count'] = count($preconstruction_data);
				}
				else
				{
				   $data['preConstruction_count'] = 0;
				}
				
				if(is_array($completed_data))
				{
				   $var = array_filter($completed_data);
				   $data['completed_count'] = count($completed_data);
				}
				else
				{
				   $data['completed_count'] = 0;
				}
				

				$concept_data = $this->Dashboard_model->fetchconcept_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);

				$agree_data = $this->Dashboard_model->fetchagree_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
				
				$project_id_ar =array();
				if(is_array($agree_data)){
					foreach ($agree_data as $ag) {
						$project_id_ar[] =$ag->project_id; 
					}
				}
				$concept_amt = 0.00;
				foreach ($concept_data as $key) {
					if(!in_array($key->id, $project_id_ar)){
						$concept_amt += $key->estimate_total_cost;
					}
					
				}
				$tender_amnt = 0.00;
				if(is_array($published_tender_data)){
					foreach ($published_tender_data as $tender) {
						$tender_amnt +=$tender->estimate_total_cost;
					}
				}
				$construction_amnt = 0.00;
				if(is_array($construction_data)){
					foreach ($construction_data as $construction) {
						$construction_amnt +=$construction->estimate_total_cost;
						//$construction_amnt +=$construction->Paid_Value;
					}
				}
				
				//echo "<pre>";
				//print_r($preconstruction_dataamnt);
				//echo $preconstruction_dataamnt->total_precons_amnt;
				$preconstruction_amnt = 0.00;
				if(!empty($preconstruction_dataamnt)){
					
						 $preconstruction_amnt =$preconstruction_dataamnt->total_precons_amnt;
					
				}
				$completed_amnt = 0.00;
				if(is_array($completed_data)){
					foreach ($completed_data as $completed) {
						$completed_amnt +=$completed->estimate_total_cost;
					}
				}

				$data['completed_amt'] = $this->no_to_words($this->Dashboard_model->completed_amt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id));

				$data['tender_amnt'] = $this->no_to_words($tender_amnt);
				$data['construction_amnt'] = $this->no_to_words($construction_amnt);
				$data['preconstruction_amnt'] = $this->no_to_words($preconstruction_amnt);
				$data['completed_amnt'] = $this->no_to_words($completed_amnt);
				$data['concept_amt'] = $this->no_to_words($concept_amt);
				
				
				 $proj_total_cost = $this->Dashboard_model->total_prj_cst_amt($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
				
				$data['proj_total_no'] = $this->Dashboard_model->total_prj_no($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
				
				
				$planning_percentage =  ($concept_amt / $proj_total_cost)* 100;
				$data['planning_percentage'] = number_format((float)$planning_percentage, 2, '.', '');
				
				$tendering_percentage =  ($tender_amnt / $proj_total_cost)* 100;
				$data['tendering_percentage'] = number_format((float)$tendering_percentage, 2, '.', '');
				
				$construction_percentage =  ($construction_amnt / $proj_total_cost)* 100;
				$data['construction_percentage'] = number_format((float)$construction_percentage, 2, '.', '');
				
				$preconstruction_percentage =  ($preconstruction_amnt / $proj_total_cost)* 100;
				$data['preconstruction_percentage'] = number_format((float)$preconstruction_percentage, 2, '.', '');
				
				$completed_percentage =  ($completed_amnt / $proj_total_cost)* 100;
				$data['completed_percentage'] = number_format((float)$completed_percentage, 2, '.', '');
				

				$this->load->view('dashboard/project_overview', $data);
		}
		
	public function vendor_overview()
			{
			
	
			
			 if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
	
		
		
	 // Preparinng project summary data
      
			
			$result_vendor =  $this->Dashboard_model->get_vendor_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
			/*echo "<pre>";
		print_r($result_phisical);
		echo "</pre>";*/
			$claimedTilldate = $releasedtTilldate = $vendor_name = [];
				//foreach ($result_phisical as $key) {
					for($k = 0 ; $k < count($result_vendor) ; $k++ ){
					$vendor = $result_vendor[$k]['vendor'];
					$vendor_id = $result_vendor[$k]['vendor_id'];
					
										
					
			$row_claim =  $this->Dashboard_model->get_invoice_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$vendor_id);
			/*echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
			$tot_cnt = count($row_claim);
			$claim_amnt = [];
				for($i = 0 ; $i < count($row_claim) ; $i++ ){
				
					 $claim_amnt[$i] = $row_claim[$i]['claimed_amnt'];
				
			}			
			$SUMclaim_amount = array_sum($claim_amnt); 
					
			$row_released =  $this->Dashboard_model->get_invoicereleased_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_destination_id,$vendor_id);
			/*echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
			$tot_Rcnt = count($row_released);
			$release_amnt = [];
				for($p = 0 ; $p < count($row_released) ; $p++ ){
				
					 $release_amnt[$p] = $row_released[$p]['released_amnt'];
				
			}			
			$SUMreleased_amount = array_sum($release_amnt); 
			
	
			 $vendor_name[$k] =  $vendor;
			 $claimedTilldate[$k] =  $SUMclaim_amount;
			 $releasedtTilldate[$k] =  $SUMreleased_amount;
				/*	echo "<pre>";
		print_r($targett_phisical);
		echo "</pre>";*/
					
				}
		
        $data['vendor'] = $vendor_name;
        $data['claimed'] = $claimedTilldate;
        $data['released']= $releasedtTilldate;
/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/

        echo json_encode($data);
        //exit();
		
		
			//$this->load->view('dashboard/vendor_overview', $data);
		}
		
		
	public function sourceof_fund_overview(){

		$circle_id = $this->session->userdata('circle_id');
		$division_id = $this->session->userdata('division_id');
				
	    $type_show = $_REQUEST['type_show'];
			 
		if (!empty($this->input->get('project_sector_id'))) {
					$project_sector_id = $this->input->get('project_sector_id');
				} else {
					$project_sector_id = 0;
				}
				if (!empty($this->input->get('project_group_id'))) {
					$project_group_id = $this->input->get('project_group_id');
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($this->input->get('project_category_id'))) {
					$project_category_id = $this->input->get('project_category_id');
				} else {
					$project_category_id = 0;
				}
				if (!empty($this->input->get('project_area_id'))) {
					$project_area_id = $this->input->get('project_area_id');
				} else {
					$project_area_id = 0;
				}
				if (!empty($this->input->get('project_wing_id'))) {
					$project_wing_id = $this->input->get('project_wing_id');
				} else {
					$project_wing_id = 0;
				}

				if (!empty($this->input->get('project_division_id'))) {
					$project_division_id = $this->input->get('project_division_id');
				} else {
					$project_division_id = 0;
				}


		$get_project_result = $this->Dashboard_model->get_activities_wise_amount($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);

		$gov_land_alietion_amt = 0;
		$pvt_land_direct_amt = 0;
		$pvt_land_acquisition_amt = 0;
		$forest_land_amt = 0;
		$tree_cutting_amt = 0;
		$electrical_amt = 0;
		$ph_amt = 0;
		$rwss_amt = 0;
		$eviction_amt = 0;

		if(is_array($get_project_result)){
			foreach ($get_project_result as $project_val ) {
				if(!empty($project_val->gov_land_alietion_amt)){
					$gov_land_alietion_amt += $project_val->gov_land_alietion_amt;
				}
				if(!empty($project_val->pvt_land_direct_amt)){
					$pvt_land_direct_amt += $project_val->pvt_land_direct_amt;
				}
				if(!empty($project_val->pvt_land_acquisition_amt)){
					$pvt_land_acquisition_amt += $project_val->pvt_land_acquisition_amt;
				}
				if(!empty($project_val->forest_land_amt)){
					$forest_land_amt += $project_val->forest_land_amt;
				}
				if(!empty($project_val->tree_cutting_amt)){
					$tree_cutting_amt += $project_val->tree_cutting_amt;
				}
				if(!empty($project_val->electrical_amt)){
					$electrical_amt += $project_val->electrical_amt;
				}
				if(!empty($project_val->ph_amt)){
					$ph_amt += $project_val->ph_amt;
				}
				if(!empty($project_val->rwss_amt)){
					$rwss_amt += $project_val->rwss_amt;
				}
				if(!empty($project_val->eviction_amt)){
					$eviction_amt += $project_val->eviction_amt;
				}
	

			}
		}

		if ($type_show == "actual"){
			


		$activites_name = 'Government Land Alienation,Private Land (Direct Purchase),Private Land (Land Acquisition), Forest Land, Tree Cutting,Utility Shifting (Electrical), Utility Shifting (PH), Utility Shifting (RWSS),  Encroachment Eviction';

		$percent_string = $gov_land_alietion_amt.','.$pvt_land_direct_amt.','.$pvt_land_acquisition_amt.','.$forest_land_amt.','.$tree_cutting_amt.','.$electrical_amt.','.$ph_amt.','.$rwss_amt.','.$eviction_amt;
		//die();

		$act_arr = explode(',', $activites_name);
		$percent_arr = explode(',', $percent_string);
		$result =  array();
		for($k = 0 ; $k < count($act_arr) ; $k++ ){
			$result[] = array("name" => $act_arr[$k], "y" => (int)$percent_arr[$k]);
		}
		// $result['value_sufx'] = " ";
			
		}
		
		else
		{
			
			
		$total_amt = $gov_land_alietion_amt + $pvt_land_direct_amt + $pvt_land_acquisition_amt +$forest_land_amt + $tree_cutting_amt + $electrical_amt + $ph_amt + $rwss_amt + $eviction_amt;
		

		$gov_land_alietion_amt_percent = (100 * $gov_land_alietion_amt) / $total_amt;
		$pvt_land_direct_amt_percent = (100 * $pvt_land_direct_amt) / $total_amt;
		$pvt_land_acquisition_amt_percent = (100 * $pvt_land_acquisition_amt) / $total_amt;
		$forest_land_amt_percent = (100 * $forest_land_amt) / $total_amt;
		$tree_cutting_amt_percent = (100 * $tree_cutting_amt) / $total_amt;
		$electrical_amt_percent = (100 * $electrical_amt) / $total_amt;
		$ph_amt_percent = (100 * $ph_amt) / $total_amt;
		$rwss_amt_percent = (100 * $rwss_amt) / $total_amt;
		$eviction_amt_percent = (100 * $eviction_amt) / $total_amt;

		$activites_name = 'Government Land Alienation,Private Land (Direct Purchase),Private Land (Land Acquisition), Forest Land, Tree Cutting,Utility Shifting (Electrical), Utility Shifting (PH), Utility Shifting (RWSS),  Encroachment Eviction';
		$percent_string = $gov_land_alietion_amt_percent.','.$pvt_land_direct_amt_percent.','.$pvt_land_acquisition_amt_percent.','.$forest_land_amt_percent.','.$tree_cutting_amt_percent.','.$electrical_amt_percent.','.$ph_amt_percent.','.$rwss_amt_percent.','.$eviction_amt_percent;
		//die();

		$act_arr = explode(',', $activites_name);
		$percent_arr = explode(',', $percent_string);
		$result =  array();
		for($k = 0 ; $k < count($act_arr) ; $k++ ){
			$result[] = array("name" => $act_arr[$k], "y" => (int)$percent_arr[$k]);
		}
		
		}

		echo json_encode($result);
		}

      

		
	    public function project_progress(){

				$circle_id = $this->session->userdata('circle_id');
				$division_id = $this->session->userdata('division_id');
			
			
				if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
		
	 // Preparinng project summary data
      
		$data['all_project_details_ar'] = $this->Dashboard_model->get_project_details($project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
        
        $project_details_ar = array();
        if (!empty($data['all_project_details_ar'])) {
            foreach ($data['all_project_details_ar'] as $key => $value) {
                $project_details_ar[$key]['project_id'] = $value['id'];
                $project_details_ar[$key]['project_name'] = $value['project_name'];
                $project_details_ar[$key]['category'] = $value['category'];
                $project_details_ar[$key]['approving_authority'] = $value['approving_authority'];
                $project_details_ar[$key]['budget'] = $this->no_to_words($value['estimate_total_cost']);
                $project_details_ar[$key]['estimate_total_cost'] = $value['estimate_total_cost'];
                $project_details_ar[$key]['start_date'] = $value['project_start_date'];
                $project_details_ar[$key]['end_date'] = $value['project_end_date'];
                $project_released_amount_ar = $this->Dashboard_model->get_project_released_amount($value['id']);
                $project_details_ar[$key]['budgetamnt'] = $this->no_to_words($value['agreement_cost']);
                $project_details_ar[$key]['agreement_cost'] = $value['agreement_cost'];
                
		 		$projecttotal_cost = $this->Dashboard_model->get_total_project_cost($value['id']);
		 		$project_financial_alldata = $this->Dashboard_model->get_project_activity_data($value['id']);
      
		 		$project_details_ar[$key]['released'] = $this->no_to_words(empty($project_released_amount_ar[0]['total_activity_allotted_amount'])?0:$project_released_amount_ar[0]['total_activity_allotted_amount']);

		 		$project_details_ar[$key]['project_completion_percentage'] = round(($project_released_amount_ar[0]['total_activity_allotted_amount']/$projecttotal_cost * 100), 2) ;
				
				
		    $project_details_ar[$key]['project_progress'] = $project_progress_ar[0]['project_progress'];
              }
        }
		
           $data['project_details_ar'] = $project_details_ar;
      
			$this->load->view('dashboard/project_progress', $data);
		}


	
	public function project_issue(){

        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');


        // echo $circle_id;
        // echo $division_id;

		if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}

		
      
		$data['all_project_details_ar'] = $this->Dashboard_model->get_issues_dashboard($project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
        
        $project_details_ar = array();
        if (!empty($data['all_project_details_ar'])) {
            foreach ($data['all_project_details_ar'] as $key => $value) {
                $project_details_ar[$key]['project_id'] = $value['id'];
                $project_details_ar[$key]['id'] = $value['id'];
                $project_details_ar[$key]['project_name'] = $value['project_name'];
                $project_details_ar[$key]['closeissue'] = $value['closeissue'];
                $project_details_ar[$key]['openissue'] = $value['openissue'];
                $project_details_ar[$key]['category'] = $value['category'];
                $project_details_ar[$key]['start_date'] = $value['start_date'];
				$project_details_ar[$key]['end_date'] = $value['end_date'];
                // $project_details_ar[$key]['approving_authority'] = $value['approving_authority'];
                // $project_details_ar[$key]['start_date'] = $value['project_start_date'];
                // $project_details_ar[$key]['end_date'] = $value['project_end_date'];
              
		 		$project_details_ar[$key]['released'] = $this->no_to_words(empty($project_released_amount_ar[0]['total_activity_allotted_amount'])?0:$project_released_amount_ar[0]['total_activity_allotted_amount']);

		 		$project_details_ar[$key]['project_completion_percentage'] = round(($project_released_amount_ar[0]['total_activity_allotted_amount']/$projecttotal_cost * 100), 2) ;
				
				
		    $project_details_ar[$key]['project_issue'] = $project_progress_ar[0]['project_issue'];
              }
        }
		
		
		
           $data['project_details_ar'] = $project_details_ar;
     
		   $this->load->view('dashboard/project_issue', $data);


	}	

	
	public function area_destination(){
			 
		if (!empty($_REQUEST['project_area_id'])) {
			$project_area_id = $_REQUEST['project_area_id'];
		} else {
			$project_area_id = 0;
		}
		
	    // Preparinng project summary data
      
        $data['destination_list'] = $this->Dashboard_model->get_destination($project_area_id);
			
			$this->load->view('dashboard/area_destination_list', $data);
		}
	
  
    public function get_all_permission_module( $user_id ){
       $details =  $this->Dashboard_model->get_parent_module_permission( $user_id );
       for ($i = 0 ; $i < count($details); $i++){
           $first_child_url = $this->Dashboard_model->get_first_child_module( $user_id, $details[$i]['id'] );
           $details[$i]['first_child_url'] = $first_child_url[0]['moduleUrl'];
       }

       return $details;
    }
    public function no_to_words($no)
    {
		$number = sprintf('%.2f', $no);
		$_float = explode(".", $number);
		$nocnt = strlen($_float[0]);
		
        if($no == 0 || $no == ''){
        	return 0;
        }elseif ($nocnt == 0) {
            return ' ';

        } else {
            //$n = strlen($no); // 7
            //echo "length: ".$n; //die();
            switch ($nocnt) {
                case 3:
                    $val = $no / 100;
                    $val = round($val, 2);
                    $finalval = $val . " Hundred";
                    break;
                case 4:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 5:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 6:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 7:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 8:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;
                case 9:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;

                default:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
            }
            return $finalval;
        }
    }

    function qno_to_words($no)
    {
        //$no = (int) $no;
        echo "no: " . $no;
        if ($no == 0) {
            return ' ';

        } else {
            $n = strlen($no); // 7
            switch ($n) {
                case 3:
                    $val = $no / 100;
                    $val = round($val, 2);
                    $finalval = $val . " hundred";
                    break;
                case 4:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " thousand";
                    break;
                case 5:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " thousand";
                    break;
                case 6:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " lakh";
                    break;
                case 7:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " lakh";
                    break;
                case 8:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " crore";
                    break;
                case 9:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " crore";
                    break;

                default:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " crore";
                    break;
            }
            //return $finalval;

        }
        echo "final val: " . $finalval;
        die();
    }

    function IND_money_format($number)
    {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for ($i = 0; $i < $length; $i++) {
            if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
                $delimiter .= ',';
            }
            $delimiter .= $money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if ($decimal != '0') {
            $result = $result . $decimal;
        }

        return $result;
    }

     function get_finnancial_progressdata(){

     $circle_id = $this->session->userdata('circle_id');
     $division_id = $this->session->userdata('division_id');

	  $type_show = $_REQUEST['type_show'];
      if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
	
		 $financial_data = $this->Dashboard_model->get_financial_overview($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
	
		 $financial_projecttotel_cost = $this->Dashboard_model->get_financial_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		 
		 $total_proj_cost = $financial_projecttotel_cost[0]['Project_cost'];
		
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
			 
			 $Pplanned_val[$k] =  round(($planned_value/$total_proj_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($earned_value/$total_proj_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($paid_value/$total_proj_cost * 100), 2) ;
			 
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
	
    function sortBy($field, &$array, $direction = 'asc')
    {
        usort($array, create_function('$a, $b', '
            $a = $a["' . $field . '"];
            $b = $b["' . $field . '"];

            if ($a == $b) return 0;

            $direction = strtolower(trim($direction));

            return ($a ' . ($direction == 'desc' ? '>' : '<') . ' $b) ? -1 : 1;
        '));

        return true;
    }

    function get_work_item_budget_released_xhr()
    {
        if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}				
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}

        $data['work_item_budget_ar'] = $this->Dashboard_model->get_work_item_budget($project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
		
		

        $work_item_category_ar = array();
        $budget_ar = array();
        $released_ar = array();
        if (!empty($data['work_item_budget_ar'])) {
            foreach ($data['work_item_budget_ar'] as $key => $val) {
                array_push($work_item_category_ar, $val['work_item_description']);
                //array_push($budget_ar, (int)$val['amount']);
				
				
                $data['work_item_activity_budget_ar'] = $this->Dashboard_model->get_work_item_activity_budget($val['work_item_id'], $project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
				$budget_amount = 0;
				if(is_array($data['work_item_activity_budget_ar'])){
						foreach($data['work_item_activity_budget_ar'] as $res){
							$activity_id = $res['project_activity_id'];
							$project_id = $res['project_id'];
							$activity_amount = $this->Dashboard_model->project_activity_amount_data($project_id, $activity_id);
							$budget_amount += $activity_amount;
						}
       			 }

				 $budget_amount;
				
                if ($budget_amount != "0") {

                    array_push($budget_ar, (int)$budget_amount);
                } else {

                    array_push($budget_ar, (int)0.00);
                }
				
				
                $data['work_item_released_ar'] = $this->Dashboard_model->get_work_item_released($val['work_item_id'], $project_sector_id, $project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);
				
				
				

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
    function get_work_item_planned_progress_xhr()
    {
        if (!empty($_REQUEST['project_category_id'])) {
            $project_category_id = $_REQUEST['project_category_id'];
        } else {
            $project_category_id = 0;
        }
        if (!empty($_REQUEST['project_area_id'])) {
            $project_area_id = $_REQUEST['project_area_id'];
        } else {
            $project_area_id = 0;
        }
        $data['work_item_budget_ar'] = $this->Dashboard_model->get_work_item_budget($_REQUEST['project_category_id'], $_REQUEST['project_area_id']);

        $work_item_category_ar = array();
        $budget_ar = array();
        $released_ar = array();
        if (!empty($data['work_item_budget_ar'])) {
            foreach ($data['work_item_budget_ar'] as $key => $val) {
                array_push($work_item_category_ar, $val['work_item_description']);
                array_push($budget_ar, (int)$val['amount']/100);
                $data['work_item_released_ar'] = $this->Dashboard_model->get_work_item_released($val['work_item_id'], $_REQUEST['project_category_id'], $_REQUEST['project_area_id']);

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
    function get_project_details_xhr()
    {

        if (!empty($_REQUEST['project_category_id'])) {
            $project_category_id = $_REQUEST['project_category_id'];
        } else {
            $project_category_id = 0;
        }
        if (!empty($_REQUEST['project_area_id'])) {
            $project_area_id = $_REQUEST['project_area_id'];
        } else {
            $project_area_id = 0;
        }

        $data['all_project_details_ar'] = $this->Dashboard_model->get_project_details_xhr($_REQUEST['project_category_id'], $_REQUEST['project_area_id']);

        //echo "<pre>"; print_r($data['all_project_details_ar']); die();

        $project_details_ar = array();
        if (!empty($data['all_project_details_ar'])) {
            foreach ($data['all_project_details_ar'] as $key => $value) {
                $project_details_ar[$key]['project_id'] = $value['id'];
                $project_details_ar[$key]['project_name'] = $value['project_name'];
                $project_details_ar[$key]['budget'] = $this->IND_money_format($value['estimate_total_cost']);
                $project_details_ar[$key]['start_date'] = $value['project_start_date'];
                $project_details_ar[$key]['end_date'] = $value['project_end_date'];
                $project_released_amount_ar = $this->Dashboard_model->get_project_released_amount($value['id']);
                $project_details_ar[$key]['released'] = $this->IND_money_format(empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount']);
                $project_details_ar[$key]['project_completion_percentage'] = ((empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount'] * 100) / $value['estimate_total_cost']);
            }

            if (!empty($project_details_ar)) {
                $html = '';
                foreach ($project_details_ar as $key => $value) {
                    $project_id = $value['project_id'];
                    $project_name = $value['project_name'];
                    $budget = $value['budget'];
                    /*$start_date = date('M, Y', strtotime($value['start_date']));
                    $end_date = date('M, Y', strtotime($value['end_date']));*/
                    $start_date = date_create($value['start_date']);
                    $start_date = date_format($start_date,"F d Y");
                    $end_date = date_create($value['end_date']);
                    $end_date = date_format($end_date,"F d Y");
                    $released = $value['released'];
                    $project_completion_percentage = $value['project_completion_percentage'];
                    $sl = $key + 1;

                    $html .= '<tr>
                                <td>' . $sl . '</td>
                                <td>
                                    <a href="project_details_kachpura.html">
                                        ' . $project_name . '
                                    </a>
                                </td>
                                <td>' . $start_date . '</td>
                                <td>' . $end_date . '</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-green" role="progressbar" title="' . $project_completion_percentage . '% Completed" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width:' . $project_completion_percentage . '%"></div>
                                    </div>
                                </td>
                                ';
                    if( $this->financial_module_permission[0]['view'] ) {
                        $html .= '<td><i class="fas fa-rupee-sign ">' . $budget . '</i></td>
                                    <td><i class="fas fa-rupee-sign">' . $released . '</i></td>';
                    }
                                $html .='</tr>';

                }
            }

        }

        //$data['project_details_ar'] = $project_details_ar;
        echo $html;
        die();
        //echo json_encode($json_data); die();

    }
	
	
    public function wi_project_progress(){
		 if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
		
		//$org_Id = $_REQUEST['org_id'];
	   //All project list
        $arr_proj = $this->Dashboard_model->get_all_project_list($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);		
	   //All project ID
		$all_ProjId = implode(",", array_column($arr_proj, 'id'));
		
		
			
		$result_phisical =  $this->Dashboard_model->get_physical_main($all_ProjId);
			/*echo "<pre>";
		print_r($result_phisical);
		echo "</pre>";*/
			$wi_achievedTilldate = $wi_targetTilldate = $work_item = [];
		/*for($k = 0 ; $k < count($result_phisical) ; $k++ ){
					$wi_ID = $result_phisical[$k]['project_work_item_id'];
					$cnt = $result_phisical[$k]['cnt_activity']*100;
					$targetTotal = $result_phisical[$k]['TargetTillDatePercentageTotal'];
					$achievedTotal = $result_phisical[$k]['ActivityAchievedTillDatePercentageTotal'];
					$tilltargetTotal = $result_phisical[$k]['AchievedOverallPercentageTotal'];
					
					//WI achieved till date in percentage
					 $wi_achievedTilldate[$k] = round(($achievedTotal/$cnt)*100 );
					 $wi_achievedTilldate1[$k] = round(($achievedTotal/$cnt)*100 )."-----ACHIEVE<br>";
					//echo $wi_achievedTilldate = round(($achievedTotal/$tilltargetTotal)*100 )."-----ACHIEVE<br>";
			$targett_phisical =  $this->Dashboard_model->get_physicaltarget_main($proj_id,$wi_ID);
		
			$tot_cnt = count($targett_phisical);
			$caltot_cnt = $tot_cnt*100;
			$target_till_percent = [];
				for($i = 0 ; $i < count($targett_phisical) ; $i++ ){
				
					$target = $targett_phisical[$i]['target'];
					$tilltarget = $targett_phisical[$i]['tilltarget'];
					//target till date in percentage
					$target_till_percent[$i] = round(($tilltarget/$target)*100 );
					//echo $target_till_percent1 = round(($tilltarget/$target)*100 )."---------<br>";
				
			}
			//print_r(array_sum($target_till_percent));
			$SUMtarget_till_percent = array_sum($target_till_percent);
			 $data['target_till_percent'] = $SUMtarget_till_percent;
			 
			 //WI TARGET till date in percentage
			  $wi_targetTilldate[$k] = round(($SUMtarget_till_percent/$caltot_cnt)*100 );
			// echo $wi_targetTilldate = round(($SUMtarget_till_percent/$caltot_cnt)*100 )."-------TARGET<br>";
			 
			 
			 $work_item[$k] =  $this->Dashboard_model->getworkitem($wi_ID);
			 $left[$k] = ($wi_targetTilldate[$k]-$wi_achievedTilldate[$k]);
				
					
				}
        $data['categories'] = $work_item;
        $data['target'] = $wi_targetTilldate;
        $data['complete'] = $wi_achievedTilldate;
        $data['left'] = $left;*/
		
		
		
					for($k = 0 ; $k < count($result_phisical) ; $k++ ){
					$work_item[$k] = $result_phisical[$k]['work_item_description'];
					$wi_targetTilldate[$k] = round(($result_phisical[$k]['Average_WI_Target_till_datepercentage']+0), 2);
					$wi_achievedTilldate[$k] = round(($result_phisical[$k]['Average_WI_Achieved_till_datepercentage']+0), 2);
			 
			 		$left[$k] = round(($wi_targetTilldate[$k]-$wi_achievedTilldate[$k]), 2);				
					
				}
		
		
		$data['categories'] = $work_item;
        $data['target'] = $wi_targetTilldate;
        $data['complete'] = $wi_achievedTilldate;
        $data['left'] = $left;
		//print_r($data['categories']);
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
	

        echo json_encode($data);
        //exit();
    }
	
	

     function get_finnancial_cumulativedata(){

        //echo(strtotime("May 2018") . "<br>");
         $circle_id = $this->session->userdata('circle_id');

         $division_id = $this->session->userdata('division_id');


	  	$type_show = $_REQUEST['type_show'];
        if (!empty($_REQUEST['project_sector_id'])) {
					$project_sector_id = $_REQUEST['project_sector_id'];
				} else {
					$project_sector_id = 0;
				}
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}
	
		 $financial_data = $this->Dashboard_model->get_financial_overview($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		 
		 
	
		 $financial_projecttotel_cost = $this->Dashboard_model->get_financial_project_cost($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		 
		 $total_proj_cost = $financial_projecttotel_cost[0]['Project_cost'];
	
		
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
			 
			 
			 
			 $Pplanned_val[$k] =  round(($financial_data[$k]['Planned_Value']/$total_proj_cost * 100), 2) ;
			 $Pearned_val[$k] =  round(($financial_data[$k]['Earned_Value']/$total_proj_cost * 100), 2) ;
			 $Ppaid_val[$k] =  round(($financial_data[$k]['Paid_Value']/$total_proj_cost * 100), 2) ;
			 
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


function count_digit($number) {
  return strlen($number);
}

function divider($number_of_digits) {
    $tens="1";

  if($number_of_digits>8)
    return 10000000;

  while(($number_of_digits-1)>0)
  {
    $tens.="0";
    $number_of_digits--;
  }
  return $tens;
}
//function call
function get_amount_data($num){
//$num = "789";
$ext="";//thousand,lac, crore
$number_of_digits = $this->count_digit($num); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=$this->divider($number_of_digits-1);
    else
        $divider=$this->divider($number_of_digits);
}
else
    $divider=1;

$fraction=$num/$divider;
$fraction=number_format($fraction,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
return $fraction." ".$ext;
	
}	


  public function get_pre_contruction_activity()
    {

        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');

    	if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}

         $arr = $this->Dashboard_model->get_all_pre_contruction_status($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
         $proj_cnt = $this->Dashboard_model->get_all_pre_contruction_proj_cnt($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
		  $total_proj_cnt = $proj_cnt[0]['proj_cnt']; 

          $pre_contruction_activity_result = $this->Dashboard_model->get_pre_contruction_activity_chart_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);


        $categories = $target = $complete = [];
        for ($i = 0; $i < count($arr); $i++) {
			
			$arr[0]['pa_name'] = "Government Land Alienation";
			$arr[1]['pa_name'] = "Private Land (Direct Purchase)";
			$arr[2]['pa_name'] = "Private Land (Land Acquisition)";
			$arr[3]['pa_name'] = "Forest Land";
			$arr[4]['pa_name'] = "Utility Shifting (Electrical)";
			$arr[5]['pa_name'] = "Utility Shifting (PH)";
			$arr[6]['pa_name'] = "Utility Shifting (RWSS)";
			$arr[7]['pa_name'] = "Tree Cutting";
			$arr[8]['pa_name'] = "Encroachment Eviction";


			$arr[0]['total_value'] = $pre_contruction_activity_result[0]['govt_land_alienation_total'];
			$arr[1]['total_value'] = $pre_contruction_activity_result[0]['private_land_direct_purchase_total'];
			$arr[2]['total_value'] = $pre_contruction_activity_result[0]['private_land_acquisition_total'];
			$arr[3]['total_value'] = $pre_contruction_activity_result[0]['forest_land_total'];
			$arr[4]['total_value'] = $pre_contruction_activity_result[0]['utility_shifting_electrical_total'];
			$arr[5]['total_value'] = $pre_contruction_activity_result[0]['utility_shifting_PH_total'];
			$arr[6]['total_value'] = $pre_contruction_activity_result[0]['utility_shifting_RWSS_total'];
			$arr[7]['total_value'] = $pre_contruction_activity_result[0]['tree_cutting_total'];
			$arr[8]['total_value'] = $pre_contruction_activity_result[0]['encroachment_eviction_total'];



			$arr[0]['done_value'] = $pre_contruction_activity_result[0]['govt_land_alienation_pending_count'];
			$arr[1]['done_value'] = $pre_contruction_activity_result[0]['private_land_direct_purchase_pending'];
			$arr[2]['done_value'] = $pre_contruction_activity_result[0]['private_land_acquisition_pending'];
			$arr[3]['done_value'] = $pre_contruction_activity_result[0]['forest_land_pending'];
			$arr[4]['done_value'] = $pre_contruction_activity_result[0]['utility_shifting_electrical_pending'];
			$arr[5]['done_value'] = $pre_contruction_activity_result[0]['utility_shifting_PH_pending'];
			$arr[6]['done_value'] = $pre_contruction_activity_result[0]['utility_shifting_RWSS_pending'];
			$arr[7]['done_value'] = $pre_contruction_activity_result[0]['tree_cutting_pending'];
			$arr[8]['done_value'] = $pre_contruction_activity_result[0]['encroachment_eviction_pending'];
           
            $done_data = 0;
           
            $categories[$i] = $arr[$i]['pa_name'];
            $target[$i] = ($arr[$i]['total_value'] - 0);
            $done[$i] = ($arr[$i]['done_value'] - 0);
			
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


    function fetch_project_delayed_data(){

    	$circle_id = $this->session->userdata('circle_id');
    	$division_id = $this->session->userdata('division_id');

    	
				if (!empty($_REQUEST['project_group_id'])) {
					$project_group_id = $_REQUEST['project_group_id'];
				} else {
					$project_group_id = 0;
				}
			  	if (!empty($_REQUEST['project_category_id'])) {
					$project_category_id = $_REQUEST['project_category_id'];
				} else {
					$project_category_id = 0;
				}
				if (!empty($_REQUEST['project_area_id'])) {
					$project_area_id = $_REQUEST['project_area_id'];
				} else {
					$project_area_id = 0;
				}
				if (!empty($_REQUEST['project_wing_id'])) {
					$project_wing_id = $_REQUEST['project_wing_id'];
				} else {
					$project_wing_id = 0;
				}

				if (!empty($_REQUEST['project_division_id'])) {
					$project_division_id = $_REQUEST['project_division_id'];
				} else {
					$project_division_id = 0;
				}


	 		$delay_proj = $this->Dashboard_model->get_delay_proj($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id);
	 		
	 		
			$data['delayproj_cnt']= $delay_proj[0]['delay_cnt'];
			
	
			$this->load->view('dashboard/project_delayed_cnt_view', $data);
    }
	
		
    function tendering_chart(){

    	$circle_id = $this->session->userdata('circle_id');
    	$division_id = $this->session->userdata('division_id');
          $data['tendercount'] = $this->Dashboard_model->tendering_status_overview($circle_id,$division_id);
          $data['pendingcount'] = $this->Dashboard_model->tendering_pending_overview($circle_id,$division_id);
          echo json_encode($data);
    }

    function yearly_financial_count(){
    	
    	$data['yearlyfinanicalcount'] = $this->Dashboard_model->yearly_financial_data_count();

    	$data['yearcount'] = $this->Dashboard_model->year_count();
    	
          echo json_encode($data);

    }

    function yearly_financial_data(){
    	$startdate = '2021-04-01';
    	$enddate = '2022-03-31';

        $data['yearly_financial_num_data'] = $this->Dashboard_model->get_yearly_financial_data($startdate,$enddate);
        
        $this->load->common_template('dashboard/project_yearlyfinancial_view', $data);	 
    }

    function get_project_total_data($project_id){
    	return $project_total_data = $this->Dashboard_model-> get_project_total_data($project_id);
    }

  function getdivision_list(){
          $circle_id = $this->input->post('circleId');
          if($circle_id!=''){
            $data['all_divisions'] = $this->Dashboard_model->fetch_divisions($circle_id);
            echo  json_encode($data);
          }else{
                  
          }
    }
	
	
}  
 

?>