<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Content-Type: application/json; charset=utf-8');
class ProjectinfoApi extends MY_Controller {
	public function __construct(){
        parent::__construct();
			  // load base_url
		$this->load->library('session');
		$this->load->library('pagination');	  
		$this->load->helper('form');
   		$this->load->helper(array('url','html','form'));
		$this->load->model('Home_model');
		$this->load->model('Monitoring_model');
		$this->load->model('Project_model');
    }
     /* Project Type */
     public function project_type($type_id){
        return $this->Project_model->get_project_type($type_id);
     }

    /* Project Area */
     public function project_area($area_id){
        return $this->Project_model->get_project_area($area_id);
     }
	 public function work_item($work_item_id){

        return $this->Project_model->get_work_item_list($work_item_id);
    }

    public function project_progress() {
    	    $apikey = $_GET['token'];
            $result = $this->Home_model->fetch_token_records($apikey);
            $progress_projects = [];

            if(!empty($result)){

				$Login_details = array(
					'is_logged_in' => '1',
					'id' => $result[0]['user_id'],
					'username'  => $result[0]['username'],
          'user_type' => $result[0]['user_type'],
          'user_role_id' => $result[0]['role_id'],
          'user_role_name' => $result[0]['role_name'],
          'circle_id' => $result[0]['circle_id'],
          'division_id' => $result[0]['division_id']
				);
				
				$this->session->set_userdata($Login_details);

		       $user_id = $this->session->userdata('id');
               $user_type = $this->session->userdata('user_type');
               $circle_id = $this->session->userdata('circle_id');
               $division_id = $this->session->userdata('division_id');
               //$data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id);

               $project_deatail = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);

          foreach($project_deatail as $pro_dtl){
             $project_area= $this->project_area($pro_dtl['location_id']);
             $project_type= $this->project_type($pro_dtl['project_type']);

               array_push($progress_projects, array("id" => $pro_dtl['id'], "project" => $pro_dtl['project_name'], "category" => $project_type[0]['project_type'], "location" => $project_area[0]['name']));
             }

               echo json_encode($progress_projects);

			}
			else {
				$res = array('response' => "Request Error");
				echo json_encode($result);
			}
    }

    	public function earned_financial_progress(){
        $project_id=$_REQUEST['project_id'];
        
        $project_work_item_id=$_REQUEST['project_work_item_id'];
        //echo $project_work_item_id;
       // exit;
        /* token */
		$apikey = $_GET['token'];
		$result = $this->Home_model->fetch_token_records($apikey);
		if(!empty($result)){

			$Login_details = array(
				'is_logged_in' => '1',
				'id' => $result[0]['user_id'],
				'username'  => $result[0]['username'],
				'user_type' => $result[0]['user_type'],
				'user_role_id' => $result[0]['role_id'],
				'user_role_name' => $result[0]['role_name']
			);
			
			$this->session->set_userdata($Login_details);

		   $user_id = $this->session->userdata('id');
		   $user_type = $this->session->userdata('user_type');
		   $circle_id = $this->session->userdata('circle_id');
		   $division_id = $this->session->userdata('division_id');

		 //  $project_work_item_detail = $this->Project_model->get_project_work_item_details($project_id);
		   //$data['project_id']=$project_id;
		  // $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
		   $project_deatail= $this->Monitoring_model->project_details($project_id);
		  $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
		 //  $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
		   $project_activity_detail = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
		  // echo $project_work_item_detail;
		  // exit;
		   
			$project_item= $this->work_item($project_work_item_id);
			//$project_type= $this->project_type($pro_dtl['project_type']);
                // echo $pro_dtl['work_item_id'];
				// exit;
			//  array_push($data['stage_detail'], array( "stage_name" => $project_item['work_item_description']));
		//	}
              $name=$project_deatail[0]['project_name'];
			  $stage_name=$project_item[0]['work_item_description'];
			  $start_date=$project_aggrement_deatail[0]['project_start_date'];
			  $end_date=$project_aggrement_deatail[0]['project_end_date'];
         //echo $data['stage_detail'];
		  
		   echo json_encode(['project_name'=>$name,
		   'stage_name'=>$stage_name,'project_start_date'=>$start_date,'project_end_date'=>$end_date,'activity_array'=>$project_activity_detail]);

		}
		else {
			$res = array('response' => "Request Error");
			echo json_encode($result);
		}

       /* token end */
     
        

        //echo "<pre>"; print_r($data); die;

        
        
    }
	public function project_financial_listing(){
		$project_id=$_REQUEST['project_id'];
	//	echo $project_id;
		//exit;
		$project_work_item=[];
		$apikey = $_GET['token'];
            $result = $this->Home_model->fetch_token_records($apikey);

            if(!empty($result)){

				$Login_details = array(
					'is_logged_in' => '1',
					'id' => $result[0]['user_id'],
					'username'  => $result[0]['username'],
                    'user_type' => $result[0]['user_type'],
                    'user_role_id' => $result[0]['role_id'],
                    'user_role_name' => $result[0]['role_name']
				);
				
				$this->session->set_userdata($Login_details);

		       $user_id = $this->session->userdata('id');
               $user_type = $this->session->userdata('user_type');
               $circle_id = $this->session->userdata('circle_id');
               $division_id = $this->session->userdata('division_id');

			   $project_work_item_detail = $this->Project_model->get_project_work_item_details($project_id);
              // echo $project_work_item_detail;
			  // exit;
               foreach($project_work_item_detail as $pro_dtl){
				$project_item= $this->work_item($pro_dtl['work_item_id']);
				//$project_type= $this->project_type($pro_dtl['project_type']);
   
				  array_push($project_work_item, array("id" => $pro_dtl['work_item_id'], "stage_name" => $project_item[0]['work_item_description']));
				}
   
               echo json_encode($project_work_item);

			}
			else {
				$res = array('response' => "Request Error");
				echo json_encode($result);
			}
	}


	public function activity_details(){
		$project_id=$_REQUEST['project_id'];
        
        $project_work_item_id=$_REQUEST['project_work_item_id'];
		$activity_id=$_REQUEST['activity_id'];
    //echo $project_work_item_id;
       // exit;
        /* token */
		$apikey = $_GET['token'];
		$result = $this->Home_model->fetch_token_records($apikey);
		if(!empty($result)){

			$Login_details = array(
				'is_logged_in' => '1',
				'id' => $result[0]['user_id'],
				'username'  => $result[0]['username'],
				'user_type' => $result[0]['user_type'],
				'user_role_id' => $result[0]['role_id'],
				'user_role_name' => $result[0]['role_name']
			);
			
			$this->session->set_userdata($Login_details);

		   $user_id = $this->session->userdata('id');
		   $user_type = $this->session->userdata('user_type');
		   $circle_id = $this->session->userdata('circle_id');
		   $division_id = $this->session->userdata('division_id');
/* start code */
   $arFinancialActivityPlan=$this->Monitoring_model->get_financial_acitivity_plan($project_id, $project_work_item_id, $activity_id);
        $arActivityBudget=$this->Monitoring_model->get_financial_acitivity_budget($project_id, $project_work_item_id, $activity_id);
       // print_r( $arActivityBudget);
		//exit;
        $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];

       $nf_agreement_cost=number_format($agreement_cost,2);

        $financialPlanningMonthFlag = true;

        $total_target_amount = 0.00;
        $total_target_amount_percent = 0.00;
/* 		$total_activity_budget_amount=0.00;
		$total_activity_budget_amount_percent=0.00;
        $total_activity_earned_amount=0.00;
		$total_activity_earned_amount_percent=0.00;
		$remaining_amount=0.00;
		$remaining_amount_percent=0.00; */
		$total_activity_budget_amount=$arActivityBudget[0]['total_activity_budget_amount'];
		$total_activity_budget_amount_percent=($total_activity_budget_amount / $agreement_cost) * 100;
		$total_activity_earned_amount=$arActivityBudget[0]['total_activity_earned_amount'];
		$total_activity_earned_amount_percent = ($total_activity_earned_amount / $agreement_cost) * 100;
		$remaining_amount = $total_activity_budget_amount - $total_activity_earned_amount;
		$remaining_amount_percent =($remaining_amount / $agreement_cost) * 100;

           $nf_total_activity_budget_amount=number_format($total_activity_budget_amount,2);
		   $nf_total_activity_budget_amount_percent=number_format($total_activity_budget_amount_percent,2);
			$nf_total_activity_earned_amount=number_format($total_activity_earned_amount,2);
			$nf_total_activity_earned_amount_percent = number_format($total_activity_earned_amount_percent,2);
			$nf_remaining_amount = number_format($remaining_amount,2);
			$nf_remaining_amount_percent =number_format($remaining_amount_percent,2);
/* loop code */
$loop_data=[];
foreach ($arFinancialActivityPlan as $key => $val) {
	//echo "<pre>"; print_r($val); die(); 
	//echo "Curremt Month & Year: ".date('M Y'); die();
	$slNo = $key+1;
	$monthName = $val['month_name'];
	$monthDate = $val['month_date'];
	$financialPlanningDetailId = $val['id'];

	if(!empty($val['target_amount'])){
	$target_amount = $val['target_amount'];
	}else{
	   $target_amount = 0.00; 
	}
	$total_target_amount = $total_target_amount + $target_amount;

	$target_amount_percent = ($target_amount / $agreement_cost) * 100;

	$total_target_amount_percent = $total_target_amount_percent + $target_amount_percent;



	if(!empty($val['earned_amount'])){
	$earned_amount = $val['earned_amount'];
	}else{
	   $earned_amount = 0.00; 
	}
	

	$earned_amount_percent = ($earned_amount / $agreement_cost) * 100;
   $nf_target_amount_percent=number_format($target_amount_percent,2);
   $nf_target_amount=number_format($target_amount,2);
   $nf_earned_amount_percent=number_format($earned_amount_percent,2);
   $nf_earned_amount=number_format($earned_amount,2);

	if($financialPlanningMonthFlag){
		array_push($loop_data,array('key_no'=> $slNo,
		'month'=> $monthName,
		'month_date'=>$monthDate,
	    'planned_percent'=>$nf_target_amount_percent,
	    'planned_value'=>$nf_target_amount,
	    'earned_percent'=>$nf_earned_amount_percent,
	    'earned_value'=>$nf_earned_amount,
		'financialPlanningDetailId_hidden'=>$financialPlanningDetailId));
		
	
	}
	

	if(date('M Y') == $monthName){
		$financialPlanningMonthFlag = false;    
	}

}





/* loop code ends */
            	  
		   echo json_encode(['project_cost'=>$nf_agreement_cost,
		   'planned_value'=>$nf_total_activity_budget_amount,
		   'planned_value_percent'=>$nf_total_activity_budget_amount_percent,
		   'earned_value'=>$nf_total_activity_earned_amount,
		   'earned_value_percent'=>$nf_total_activity_earned_amount_percent,
		   'remaining_value'=>$nf_remaining_amount,
		   'remaining_value_percent'=>$nf_remaining_amount_percent,
		   'monthly_array'=>$loop_data
		]);

		}
		else {
			$res = array('response' => "Request Error");
			echo json_encode($result);
		}
            
	}
 

  public function update_financial_progress() {

  			$apikey = $_GET['token'];

		$result = $this->Home_model->fetch_token_records($apikey);
		if(!empty($result)){

			$Login_details = array(
				'is_logged_in' => '1',
				'id' => $result[0]['user_id'],
				'username'  => $result[0]['username'],
				'user_type' => $result[0]['user_type'],
				'user_role_id' => $result[0]['role_id'],
				'user_role_name' => $result[0]['role_name']
			);
			
			$this->session->set_userdata($Login_details);
		}
     $method = $_SERVER['REQUEST_METHOD'];
     	if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

            $totalEarnedAmount = 0;
            foreach($_REQUEST['financialPlanningDetailId'] as $plan => $fin){
                $totalEarnedAmount += str_replace(',','',$_REQUEST['allotted'][$plan]); 
                
            }

            /* Checking this data already exist or not */
            $where_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
       // update individual boxes end

             $chk_exist = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_main',$where_check);

          if($chk_exist > 0){
            //For update
            //$financial_planning_monitoring_main['total_activity_allotted_amount']=$totalAllottedAmount;
            $financial_planning_monitoring_main['total_activity_earned_amount']=$totalEarnedAmount;
            $financial_planning_monitoring_main['monitored_by']=$this->session->userdata('id');
            $financial_planning_monitoring_main['monitored_on']=Date('Y-m-d');

            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Monitoring_model->updateDataCondition('project_financial_planning_main', $financial_planning_monitoring_main, $where_main);

            $main_financial_id = $this->Monitoring_model->get_any_table_specific_data('project_financial_planning_main',$where_main,'id');
           }else{
            //for add

                $financeAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'], 
                                            //'total_activity_budget_amount' => $_REQUEST['activityBudgetAmount'], 
                                            'total_activity_earned_amount' => $totalEarnedAmount, 
                                            //'total_activity_allotted_amount' => $totalAllottedAmount, 
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $main_financial_id = $this->Monitoring_model->insertDatareturnid($financeAddData,'project_financial_planning_main');

           }

      //individual box updates
      foreach($_REQUEST['financialPlanningDetailId'] as $key => $val){
                //echo $val; echo "<br>";
            $mnth_name  = $_REQUEST['month'][$key];
            $mnth_date  = $_REQUEST['month_date'][$key];

                if ($_REQUEST['allotted'][$key]==''){
                    $financial_allotted_amount = 0;
                }else{
                    $financial_allotted_amount = str_replace(',','',$_REQUEST['allotted'][$key]);
                }
                $where_detail_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id'],'project_financial_planning_id' => $main_financial_id,'month_name' => $mnth_name);
                $chk_detail = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_detail',$where_detail_check);

                if($chk_detail > 0){
                    //update
                    $financial_planning_monitoring['earned_amount']=$financial_allotted_amount;
                    
                    $financial_planning_monitoring['monitored_by']=$this->session->userdata('id');
                    $financial_planning_monitoring['monitored_on']=Date('Y-m-d');
                    $this->Monitoring_model->updateDataCondition('project_financial_planning_detail', $financial_planning_monitoring, $where_detail_check);
                }else{
                    $financeDetailsAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_financial_planning_id' => $main_financial_id, 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'], 
                                            'month_name' => $mnth_name, 
                                            'month_date' => $mnth_date,
                                            'earned_amount'=> $financial_allotted_amount,
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $this->Monitoring_model->insertDatareturnid($financeDetailsAddData,'project_financial_planning_detail');
                }
            }

           	echo json_encode(['status' => 'Financial  Data saved successfully']);

		}

  }

}