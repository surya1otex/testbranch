<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Pf_planning extends MY_Controller
{



    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model('Pf_planning_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }

      
    }


    function project_list(){

        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');

        $data['project_deatail'] = $this->Pf_planning_model->get_pf_planning_project_list($user_id,$circle_id,$division_id);
        $this->load->common_template('project/pf_planning_list_view', $data);

    }

    public function project_area($area_id)
    {
        return $this->Pf_planning_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Pf_planning_model->project_destination($destination_id);
    }
    
    
    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Pf_planning_model->get_project_type($type_id);
    }



    /* Project other setting */
    public function project_other_setting(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $data['project_id']=$project_id;
        $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        $data['project_other_setting_detail'] = $this->Pf_planning_model->get_project_other_setting_list($project_id);
        

        
        


        if(!empty($_REQUEST['other_setting_id'])){
           $other_setting_id=base64_decode($_REQUEST['other_setting_id']);
           $data['other_setting_id']=$other_setting_id; 
           $data['project_other_setting_detail_edit'] = $this->Pf_planning_model->get_project_other_setting_list($project_id,$other_setting_id);
        }
        
        $this->load->common_template('project/pf_project_other_setting',$data);
    }


    /* Project other setting */
    public function add_project_other_setting(){
        if(!empty($_REQUEST['submit'])){
            $project_id=base64_decode($_REQUEST['project_id']);
            $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
            $total_amount= (($data['project_deatail'][0]['estimate_total_cost'] * $_REQUEST['percentage']) / 100);
            $other_setting= array();
            $other_setting['project_id']=$project_id;
            $other_setting['charge_name']=$_REQUEST['title'];
            $other_setting['charge_percentage']=$_REQUEST['percentage'];
            $other_setting['total_amount']=$total_amount;
            $other_setting['status']=$_REQUEST['status'];
            $other_setting['created_by']=$this->session->userdata('id');
            $other_setting['created_on']=Date('Y-m-d');
            
            if(empty($_REQUEST['other_setting_id'])){
               $this->Pf_planning_model->add('project_other_charges',$other_setting);  
               $this->session->set_flashdata('message', 'Data Added Successfully');
            }else{
                $other_setting['modified_by']=$this->session->userdata('id');
               $where = array('id' => base64_decode($_REQUEST['other_setting_id']));
               $this->Pf_planning_model->updateDataCondition('project_other_charges', $other_setting, $where);
               $this->session->set_flashdata('message', 'Data updated Successfully'); 
            }
            redirect('pf_planning/project_other_setting?project_id='.$_REQUEST['project_id']);
        }
    }


     /* Project other setting Delete*/
    public function delete_other_setting(){
       $other_setting_id=base64_decode($_REQUEST['other_setting_id']);
       $deleteClause =  array('id' => $other_setting_id);
       $this->Pf_planning_model->deleteRecord('project_other_charges',$deleteClause);
       $this->session->set_flashdata('danger', 'Data deleted Successfully');
       redirect('pf_planning/project_other_setting?project_id='.$_REQUEST['project_id']);
    }
    /* Project other setting Delete End*/


    /* Project activity */
    public function project_activity(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $data['project_id']=$project_id;
        $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);
        $data['project_activity_deatail'] = $this->Pf_planning_model->get_project_activity_list($project_id);
        $data['project_other_setting_detail'] = $this->Pf_planning_model->get_project_other_setting_details($project_id);

        $data['project_wise_total_activity_amt'] = $this->Pf_planning_model->get_project_wise_total_activity_amt($project_id);

        $data['project_wise_total_activity_planned_amt'] = $this->Pf_planning_model->get_project_wise_total_activity_planned_amt($project_id);

        $data['project_wise_location'] = $this->Pf_planning_model->get_project_wise_location($project_id);

        if(!empty($_REQUEST['activity_id'])){
           $activity_id=base64_decode($_REQUEST['activity_id']);
           $data['activity_id']=$activity_id; 
           $data['project_activity_detail_edit'] = $this->Pf_planning_model->get_project_activity_list($project_id,$activity_id);
        }

        $this->load->common_template('project/pf_project_activity',$data);
    }
    /* Project activity End*/


     /* Get project work item wise break up */
    function get_workitem_wise_breakup(){
        $project_id=$_REQUEST['project_id'];
        $activity_id=$_REQUEST['activity_id'];
        $type=$_REQUEST['type'];
        $html='';
        
        if($type=="financial" || $type=="activity"){
            $project_activity_wise_financial_planning_main=$this->Pf_planning_model->project_activity_wise_financial_planning_main($project_id,$activity_id);
            $html.='<div class="block-header"><h4>Activity: '.$_REQUEST['activity_name'].'</h4>
                </div>';
            $html.='<div class="block-header">Financial Planing</div>';    
            $html.='<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Sl No</th>
                                <th style="text-align: center;">Work Item Name</th>
                                <th style="text-align: center;">Planned Amount</th>
                            </tr>
                        </thead>
            <tbody>';
            if(!empty($project_activity_wise_financial_planning_main)){
                
                $i=1; 
                foreach($project_activity_wise_financial_planning_main as $planning_main){
                    $work_item_id=$planning_main['project_work_item_id'];
                    $work_item=$this->Pf_planning_model->get_work_item_list($work_item_id);
                    $html.='<tr><td>'.$i.'</td></td><td>'.$work_item[0]['work_item_description'].'</td><td style="text-align: right;">'.number_format($planning_main['total_activity_budget_amount'],2).'</td></tr>';
                    $i++;
                }  
            }else{
                $html.='<tr><td colspan="3">No data available</td></tr>'; 
            }
            $html.='</table>';
        }
        
        if($type=="physical" || $type=="activity"){
            $project_activity_wise_physical_planning_main=$this->Pf_planning_model->project_activity_wise_physical_planning_detail($project_id,$activity_id);
            $html.='<div class="block-header">Physical Planing</div>';    
            $html.='<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Sl No</th>
                                <th style="text-align: center;">Work Item Name</th>
                                <th style="text-align: center;">Planned Quantity</th>
                            </tr>
                        </thead>
            <tbody>';
            if(!empty($project_activity_wise_physical_planning_main)){
                $i=1; 
                foreach($project_activity_wise_physical_planning_main as $phy_planning_main){
                    $work_item_id=$phy_planning_main['project_work_item_id'];
                    $work_item=$this->Pf_planning_model->get_work_item_list($work_item_id);

                    $unit= $this->Pf_planning_model->get_unit_detail($phy_planning_main['activity_quantity_unit_id']);
                    $html.='<tr><td>'.$i.'</td></td><td>'.$work_item[0]['work_item_description'].'</td><td style="text-align: right;">'.$phy_planning_main['total_activity_quantity'].' '.$unit[0]['unit_name'].'</td></tr>';
                    $i++;
                }  
            }else{
                $html.='<tr><td colspan="3">No data available</td></tr>'; 
            }
            $html.='</table>';
        }
        echo  $html;
    }
    /* Get project work item wise break up End*/

    /* Add Project other setting */
    public function add_project_activity(){

        if(!empty($_REQUEST['submit'])){
            $project_id=base64_decode($_REQUEST['project_id']);
            $project_activity= array();
            $project_activity['project_id']=$project_id;
            $project_activity['particulars']=$_REQUEST['particular'];
            $project_activity['amount']= $_REQUEST['amount'];
            $project_activity['status']=$_REQUEST['status'];
            $project_activity['created_by']=$this->session->userdata('id');
            $project_activity['created_on']=Date('Y-m-d');
            if(empty($_REQUEST['activity_id'])){
               $this->Pf_planning_model->add('project_pf_activities',$project_activity);  
               $this->session->set_flashdata('message', 'Data Added Successfully');
            }else{
                $project_activity['modified_by']=$this->session->userdata('id');
               $where = array('id' => base64_decode($_REQUEST['activity_id']));
               $this->Pf_planning_model->updateDataCondition('project_pf_activities', $project_activity, $where);
               $this->session->set_flashdata('message', 'Data updated Successfully'); 
            }
            redirect('pf_planning/project_activity?project_id='.$_REQUEST['project_id']);
        }
    }
    /* Add Project other setting End*/ 


    /* Project planned amount*/
    public function get_planned_amount($project_id,$project_activity_id){
        return $this->Pf_planning_model->get_planned_amount_data($project_id,$project_activity_id); 
    }
    /* Project planned amount End*/ 

    /* Project activity Delete*/
    public function delete_activity(){
       $activity_id=base64_decode($_REQUEST['activity_id']);
       $deleteClause =  array('id' => $activity_id);
       $this->Pf_planning_model->deleteRecord('project_pf_activities',$deleteClause);
       $this->session->set_flashdata('danger', 'Data deleted Successfully');
       redirect('pf_planning/project_activity?project_id='.$_REQUEST['project_id']);
    }
    /* Project activity Delete End*/ 

    /* Project work item */
    public function project_work_item(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $data['project_id']=$project_id;
       // $data['project_id']=$project_id;
        $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        $data['work_item_list'] = $this->Pf_planning_model->get_work_item_list();
        $data['project_work_item_deatail'] = $this->Pf_planning_model->get_project_work_item_details($project_id);
        $data['project_other_setting_detail'] = $this->Pf_planning_model->get_project_other_setting_details($project_id);

        $data['project_wise_location'] = $this->Pf_planning_model->get_project_wise_location($project_id);
		
		if (!empty($_REQUEST['project_work_item_id'])) {
         		$workItem_id=base64_decode($_REQUEST['project_work_item_id']);
			 $data['p_work_item_id']= $workItem_id;
			 $data['project_work_item_detail'] = $this->Pf_planning_model->get_project_wise_witem_details($project_id,$workItem_id);
		}
       // die;

        $this->load->common_template('project/pf_project_work_item',$data);
    }
    /* Project work item */

    /* Project work item */
    public function project_planning(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $data['project_id']=$project_id;
       // $data['project_id']=$project_id;
        $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        $data['work_item_list'] = $this->Pf_planning_model->get_work_item_list();
        $data['project_work_item_deatail'] = $this->Pf_planning_model->get_project_work_item_details($project_id);
        $data['project_other_setting_detail'] = $this->Pf_planning_model->get_project_other_setting_details($project_id);

        $data['project_wise_location'] = $this->Pf_planning_model->get_project_wise_location($project_id);
        
        if (!empty($_REQUEST['project_work_item_id'])) {
                $workItem_id=base64_decode($_REQUEST['project_work_item_id']);
             $data['p_work_item_id']= $workItem_id;
             $data['project_work_item_detail'] = $this->Pf_planning_model->get_project_wise_witem_details($project_id,$workItem_id);
        }
       // die;

        $this->load->common_template('project/pf_project_planning_view',$data);
    }
    /* Project work item */

    /* Project work item name */
    public function work_item($work_item_id){
         return $this->Pf_planning_model->get_work_item_list($work_item_id);
    }
    /* Project work item name End*/

    /* Project work item physical target*/
    public function work_item_physical_target($project_id,$work_item_id){
        return $this->Pf_planning_model->get_work_item_physical_target($project_id,$work_item_id);          
    }
    /* Project work item physical target End*/

    /*Project work item financial planned*/
    public function work_item_financial_planned_amount($project_id,$work_item_id){
        return $this->Pf_planning_model->get_work_item_financial_planned_amount($project_id,$work_item_id);          
    }
    /*Project work item financial planned End*/


    /* Add Project work item */
    public function add_project_work_item(){
		
		echo "<pre>";
		print_r($_REQUEST);
		echo "</pre>";
		 if((!empty($_REQUEST['submit'])) AND $_REQUEST['submit']=="Add"){ // Add query
		 
         $project_id=base64_decode($_REQUEST['project_id']);
		 $work_item_name=$_REQUEST['work_item'];
		 
		 $duplicate_wrk_itemchk = $this->Pf_planning_model->get_duplicate_workitemchkADD($project_id,$work_item_name);
           
			if ($duplicate_wrk_itemchk > "0"){
           
				 $this->session->set_flashdata('message', 'Workitem already listed for this projecct'); 
				  redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id']);
			}
			else
			{ 
			
            
            $work_item= array();
            $work_item['project_id']=$project_id;
            $work_item['work_item_id']=$_REQUEST['work_item'];
            $work_item['total_quantity']=$_REQUEST['total_quantity'];
            //$work_item['amount']=$_REQUEST['amount'];
            $work_item['status']='Y';
            $work_item['created_by']=$this->session->userdata('id');
            $work_item['created_on']=Date('Y-m-d');
            //$work_item['modified_by']=$this->session->userdata('id');
            $this->Pf_planning_model->add('project_work_items',$work_item);
            $this->session->set_flashdata('message', 'Data Added Successfully');
            redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id']);
			}
        
		 }
		 else { // EDIT query
		 
		 $project_id=base64_decode($_REQUEST['project_id']);
		 $Update_id=$_REQUEST['Projectwork_item_id'];
		 $work_item_name=$_REQUEST['work_item'];
		 //duplicate checking
		   $duplicate_wrk_item = $this->Pf_planning_model->get_duplicate_workitemchk($project_id,$work_item_name,$Update_id);
           
			if ($duplicate_wrk_item > "0"){
           
				 $this->session->set_flashdata('message', 'Workitem already listed for this projecct'); 
				  redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id'].'&project_work_item_id='.$_REQUEST['work_item_id']);
			}
			else
			{ 
			
			$work_item= array();
            $work_item['work_item_id']=$_REQUEST['work_item'];
            //$work_item['amount']=$_REQUEST['amount'];
            $work_item['status']='Y';
            $work_item['modified_by']=$this->session->userdata('id');
			
			    $where = array('project_id' => $project_id,'id' => $Update_id);
               $this->Pf_planning_model->updateDataCondition('project_work_items', $work_item, $where);
               $this->session->set_flashdata('message', 'Data updated Successfully'); 
			    redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id']);
			}
			 
		 }
		 
		
		
		//die;
      /*  if(!empty($_REQUEST['submit'])){
            $project_id=base64_decode($_REQUEST['project_id']);
            
            $work_item= array();
            $work_item['project_id']=$project_id;
            $work_item['work_item_id']=$_REQUEST['work_item'];
            $work_item['total_quantity']=$_REQUEST['total_quantity'];
            $work_item['amount']=$_REQUEST['amount'];
            $work_item['status']='Y';
            $work_item['created_by']=$this->session->userdata('id');
            $work_item['created_on']=Date('Y-m-d');
            $work_item['modified_by']=$this->session->userdata('id');
            $this->Pf_planning_model->add('project_work_items',$work_item);
            $this->session->set_flashdata('message', 'Data Added Successfully');
            redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id']);
        }*/
    }
    /* Project other setting End*/ 

    /*Financial Listing*/
    public function financial_listing(){
       $project_id=base64_decode($_REQUEST['project_id']);
       $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
       $data['project_id']=$project_id;
       $data['project_work_item_id']=$project_work_item_id;
       $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);

       $data['project_activity_deatail'] = $this->Pf_planning_model->get_project_activity_details($project_id);
       
       $this->load->common_template('project/pf_financial_listing',$data);
    }
    /*Financial Listing End*/


     /*Financial Budget Amount*/
    function get_financial_budget($project_id,$project_work_item_id){
        return $this->Pf_planning_model->get_financial_budget_data($project_id,$project_work_item_id);
    }
    /*Financial Budget Amount End*/

    /*Financial Listing details*/
    public function get_financial_main($project_id,$project_work_item_id,$project_activity_id){
        return $this->Pf_planning_model->get_project_financial_details($project_id,$project_work_item_id,$project_activity_id);
    }
    /*Financial Listing details End*/


    /* Add Project Financial*/
    public function add_financial_planning(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $project_activity_id=base64_decode($_REQUEST['project_activity_id']);
        $project_financial_id=base64_decode($_REQUEST['project_financial_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;
        $data['project_activity_id']=$project_activity_id;
        $data['project_financial_id']=$project_financial_id;
        
       $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
       $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Pf_planning_model->get_project_work_item_details($project_id);
        $data['project_activity_deatail'] = $this->Pf_planning_model->get_project_activity_details($project_id);

        $data['project_financial_planning_detail']=$this->Pf_planning_model->project_financial_planning_detail($project_id,$project_work_item_id,$project_activity_id);

        $work_item_master=$this->Pf_planning_model->get_work_item_list($project_work_item_id);
        $data['work_item_type']=$this->Pf_planning_model->get_work_item_type_master($work_item_master[0]['type_id']);
        $get_activities_budget_Data = $this->Pf_planning_model->get_project_activity_list($project_id,$project_activity_id);
        $data['get_activities_budget_amt'] = $get_activities_budget_Data[0]['amount'];

        
        
        

        if(!empty($_REQUEST['submit'])){
            // Sum of month wise budgeted amount
            $sum_month_wise_amt=0;
            $sum_month_wise_amtfor_chk = 0;
            for($i=0;$i<count($_REQUEST['month']);$i++){
                if(!empty($_REQUEST['target'][$i])){
               $new_target = str_replace(",","",$_REQUEST['target'][$i]);

                 $sum_month_wise_amt=$sum_month_wise_amt+ $new_target;
                 $sum_month_wise_amtfor_chk=$sum_month_wise_amtfor_chk + $new_target;

                }
            }
            // Sum of month wise budgeted amount

            
           $get_activities_budget_Data = $this->Pf_planning_model->get_project_activity_list($_REQUEST['project_id'],$_REQUEST['activity_id']);
            $get_activities_planned_data = $this->Pf_planning_model->get_project_activity_wise_total_activity_planned_amt($_REQUEST['project_id'],$_REQUEST['activity_id']);

           $get_activities_budget_amt = $get_activities_budget_Data[0]['amount'];
           if($get_activities_planned_data[0]['total_budget_amount'] != ''){
            $get_activities_planned_amt = $get_activities_planned_data[0]['total_budget_amount'];
            }else{
                $get_activities_planned_amt = 0;
            }
           $get_activities_planned_amt;

          $activitiesremaining_amt = $get_activities_budget_amt - $get_activities_planned_amt;

            $budget_amt=$this->Pf_planning_model->get_financial_budget_data($_REQUEST['project_id'],$_REQUEST['work_item_id']);
            $planned_amt=$this->Pf_planning_model->get_work_item_financial_planned_amount($_REQUEST['project_id'],$_REQUEST['work_item_id']);

            $remaining_amt= $budget_amt[0]['amount'] - $planned_amt[0]['target_amount'];


            $financial_planning= array();
            $financial_planning['project_id']=$_REQUEST['project_id'];
            $financial_planning['project_work_item_id']=$_REQUEST['work_item_id'];
            $financial_planning['project_activity_id']=$_REQUEST['activity_id'];
            $financial_planning['status']='Y';
            $financial_planning['created_by']=$this->session->userdata('id');
            $financial_planning['created_on']=Date('Y-m-d');
            $financial_planning['modified_by']=$this->session->userdata('id');
            
            if(empty($_REQUEST['project_financial_id'])){

                if(round($sum_month_wise_amtfor_chk) > round($activitiesremaining_amt)){
               $this->session->set_flashdata("danger","Planned amount should not exceed budget amount"); 
               
               redirect('pf_planning/add_financial_planning?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']).'&project_activity_id='.base64_encode($_REQUEST['activity_id']));
                
                }
                //$first_date_find = strtotime(date("Y-m-d", strtotime($_REQUEST['start_date'])) . ", first day of this month");
                $financial_planning['start_date']=$_REQUEST['addfinancial_start_date'];
                $financial_planning['duration']=$_REQUEST['duration'];
                
                $project_aggrement_deatail = $this->Pf_planning_model->get_project_aggrement_details($_REQUEST['project_id']);
                $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'].'aggg';
                $cal = ($get_activities_budget_amt / $agreement_cost) * 100;
                
                $financial_planning['weightage']=$cal;


               $financial_planning_main_id=$this->Pf_planning_model->add('project_financial_planning_main',$financial_planning);  
               $this->session->set_flashdata('message', 'Data Added Successfully');
            }else{
               
                if(round($sum_month_wise_amtfor_chk) > round($get_activities_budget_amt)){
               $this->session->set_flashdata("danger","Planned amount should not exceed budget amount"); 
               
                   redirect('pf_planning/add_financial_planning?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']).'&project_activity_id='.base64_encode($_REQUEST['activity_id']).'&project_financial_id='.base64_encode($_REQUEST['project_financial_id'])); 
               
            }
               $where = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
               $this->Pf_planning_model->updateDataCondition('project_financial_planning_main', $financial_planning, $where);
               $this->session->set_flashdata('message', 'Data updated Successfully'); 
            }

            $total_financial_planning=0;
            /*echo '<pre>';
            print_r($_REQUEST);
            die;*/

            for($i=0;$i<count($_REQUEST['month']);$i++){
               $financial_planning_detail= array();
               $financial_planning_detail['project_id']=$_REQUEST['project_id'];
               
               $financial_planning_detail['project_work_item_id']=$_REQUEST['work_item_id'];
               $financial_planning_detail['project_activity_id']=$_REQUEST['activity_id'];
               $financial_planning_detail['month_name']=$_REQUEST['month'][$i];
               $financial_planning_detail['month_date']=date('Y-m-d', strtotime($_REQUEST['month'][$i]));
               if(!empty($_REQUEST['target'][$i])){
                $tr_amt = str_replace(",","",$_REQUEST['target'][$i]); 
            }elseif($_REQUEST['target'][$i] == 'NaN'){
                        $tr_amt = 0.00;
                    }else{ $tr_amt = 0.00; }
               $financial_planning_detail['target_amount']=$tr_amt;
               $financial_planning_detail['status']='Y';
               $financial_planning_detail['created_by']=$this->session->userdata('id');
               $financial_planning_detail['created_on']=Date('Y-m-d');
               $financial_planning_detail['modified_by']=$this->session->userdata('id');

               if(empty($_REQUEST['project_financial_id'])){
                  $financial_planning_detail['project_financial_planning_id']=$financial_planning_main_id;
                  $this->Pf_planning_model->add('project_financial_planning_detail',$financial_planning_detail); 
                  $this->session->set_flashdata('message', 'Data Added Successfully');
               }else{
                  $financial_planning_detail['project_financial_planning_id']=$_REQUEST['project_financial_id'];
                  if(!empty($_REQUEST['financial_planning_detail_id'][$i])){
                    $where = array('id' => $_REQUEST['financial_planning_detail_id'][$i]);
                  $this->Pf_planning_model->updateDataCondition('project_financial_planning_detail', $financial_planning_detail, $where);
                  }else{
                    $financial_planning_detail['project_financial_planning_id']=$financial_planning_main_id;
                    $this->Pf_planning_model->add('project_financial_planning_detail',$financial_planning_detail);
                  }
                  

                  $this->session->set_flashdata('message', 'Data updated Successfully'); 
               }
               if(!empty($_REQUEST['target'][$i])){
                 $total_financial_planning=$total_financial_planning+ str_replace(",","",$_REQUEST['target'][$i]);
               }
               unset($financial_planning_detail);
            }

            

            $financial_planning['total_activity_budget_amount']=$total_financial_planning;
            $where = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Pf_planning_model->updateDataCondition('project_financial_planning_main', $financial_planning, $where);

            redirect('pf_planning/financial_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
            

        }else{
            $this->load->common_template('project/pf_project_add_financial_planning',$data);
        }
        
    }
    /* Add Project Financial End*/


    /*Project work item financial planned with activity wise*/
    public function work_item_financial_planned_amount_with_workitem_activity($project_id,$work_item_id,$project_activity_id){
        return $this->Pf_planning_model->get_work_item_financial_planned_amount_with_workitem_activity($project_id,$work_item_id,$project_activity_id);          
    }
    /*Project work item financial planned with activity wise End*/

    /* Add Project Financial Month wise target*/
    public function get_activity_month_details(){
        $project_id=$_REQUEST['project_id'];
        $work_item_id=$_REQUEST['work_item_id'];
        $activity_id=$_REQUEST['activity_id'];
        $project_financial_planning_detail=$this->Pf_planning_model->project_financial_planning_detail($project_id,$work_item_id,$activity_id);
        
        $html='<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Sl No</th>
                    <th style="text-align: center;">Month Name</th>
                    <th style="text-align: center;">Amount</th>
                </tr>
            </thead>
            <tbody>';
        if(!empty($project_financial_planning_detail)){
            $i=1; 
            $sum=0;
            $html.='<div class="block-header"><h4>Stage Name: '.$_REQUEST['workitem_name'].'</h4>
            </div><div class="block-header"><h4>Activity: '.$_REQUEST['activity_name'].'</h4>
            </div>';
            foreach($project_financial_planning_detail as $planning_detail){
                
                $html.='<tr><td>'.$i.'</td></td><td>'.$planning_detail['month_name'].'</td><td style="text-align: right;">'.number_format($planning_detail['target_amount'],2).'</td></tr>';
                $sum=$sum+$planning_detail['target_amount'];
                $i++; 
            }  
        }
        $html.='<tr><td colspan="2" style="text-align: center;"><b>Total Amount :</b></td><td style="text-align: right;">'.number_format($sum,2).'</td></tr></tbody>';
        $html.='</table>';
        echo  $html;
    }
    /* Add Project Financial Month wise target End*/

    /* Add Project Financial*/
    public function work_activity($activity_id){
        return $this->Pf_planning_model->project_activity_name($activity_id);
    }
    /* Add Project Financial End*/


    /*Physical Listing*/
    public function physical_listing(){
       $project_id=base64_decode($_REQUEST['project_id']);
       $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
       $data['project_id']=$project_id;
       $data['project_work_item_id']=$project_work_item_id;
       
       $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
       $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);
       $data['project_activity_deatail'] = $this->Pf_planning_model->get_project_activity_details($project_id);
       
       $this->load->common_template('project/pf_physical_listing',$data);
    }
    /*Physical Listing End*/

    /*Physical Listing details*/
    public function get_physical_main($project_id,$project_work_item_id,$project_activity_id){
        return $this->Pf_planning_model->get_project_physical_details($project_id,$project_work_item_id,$project_activity_id);
    }
    /*Physical Listing details End*/


    /*Get unit*/
    public function get_unit($unit_id){
        return $this->Pf_planning_model->get_unit_detail($unit_id);
    }
    /*Get unit End*/


    /* Add Project Physical*/
    public function add_physical_planning(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $project_activity_id=base64_decode($_REQUEST['project_activity_id']);
        $project_physical_id=base64_decode($_REQUEST['project_physical_id']);

        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;
        $data['project_activity_id']=$project_activity_id;
        $data['project_physical_id']=$project_physical_id;
        $data['project_deatail'] = $this->Pf_planning_model->project_details($project_id);
       $data['project_aggrement_deatail'] = $this->Pf_planning_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Pf_planning_model->get_project_work_item_details($project_id);
        $data['project_activity_deatail'] = $this->Pf_planning_model->get_project_activity_details($project_id);

        $data['unit_detail'] = $this->Pf_planning_model->get_unit_detail();

        $data['project_physical_planning_detail']=$this->Pf_planning_model->project_physical_planning_detail($project_id,$project_work_item_id,$project_activity_id);

        $data['project_physical_planning_main']=$this->Pf_planning_model->project_physical_planning_main($project_id,$project_work_item_id,$project_activity_id);
        if(!empty($data['project_physical_planning_main'])){
          $data['unit_id']=$this->Pf_planning_model->get_unit_detail($data['project_physical_planning_main'][0]['activity_quantity_unit_id']);
        }

        $work_item_master=$this->Pf_planning_model->get_work_item_list($project_work_item_id);
        $data['work_item_type']=$this->Pf_planning_model->get_work_item_type_master($work_item_master[0]['type_id']);


        if(!empty($_REQUEST['submit'])){
            $physical_planning= array();
            $physical_planning['project_id']=$_REQUEST['project_id'];
            $physical_planning['project_work_item_id']=$_REQUEST['work_item_id'];
            $physical_planning['project_activity_id']=$_REQUEST['activity_id'];
            $physical_planning['activity_quantity_unit_id']=$_REQUEST['unit_id'];
            $physical_planning['status']='Y';
            $physical_planning['created_by']=$this->session->userdata('id');
            $physical_planning['created_on']=Date('Y-m-d');
            $physical_planning['modified_by']=$this->session->userdata('id');

            if(empty($_REQUEST['project_physical_id'])){
               $physical_planning_main_id=$this->Pf_planning_model->add('project_physical_planning_main',$physical_planning);  
               $this->session->set_flashdata('message', 'Data Added Successfully');
            }else{
               $where = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
               $this->Pf_planning_model->updateDataCondition('project_physical_planning_main', $physical_planning, $where);
               $this->session->set_flashdata('message', 'Data updated Successfully'); 
            }

            $total_physical_planning=0;
            for($i=0;$i<count($_REQUEST['month']);$i++){
               $physical_planning_detail= array();
               $physical_planning_detail['project_id']=$_REQUEST['project_id'];
               $physical_planning_detail['project_physical_planning_id']=$physical_planning_main_id;
               $physical_planning_detail['project_work_item_id']=$_REQUEST['work_item_id'];
               $physical_planning_detail['project_activity_id']=$_REQUEST['activity_id'];
               $physical_planning_detail['month_name']=$_REQUEST['month'][$i];
               $physical_planning_detail['month_date']=date('Y-m-d', strtotime($_REQUEST['month'][$i]));
                if($_REQUEST['target'][$i]=='')
                {
                    $physical_planning_detail['target_quantity']=0;
                }
                else
                {
                    $physical_planning_detail['target_quantity']=$_REQUEST['target'][$i];
                }
               $physical_planning_detail['unit_id']=$_REQUEST['unit_id'];
               $physical_planning_detail['status']='Y';
               $physical_planning_detail['created_by']=$this->session->userdata('id');
               $physical_planning_detail['created_on']=Date('Y-m-d');
               $physical_planning_detail['modified_by']=$this->session->userdata('id');

               if(empty($_REQUEST['project_physical_id'])){
                  $physical_planning_detail['project_physical_planning_id']=$physical_planning_main_id;
                  $this->Pf_planning_model->add('project_physical_planning_detail',$physical_planning_detail); 
                  $this->session->set_flashdata('message', 'Data Added Successfully');
               }else{
                  $physical_planning_detail['project_physical_planning_id']=$_REQUEST['project_physical_id'];
                  $where = array('id' => $_REQUEST['physical_planning_detail_id'][$i]);
                  $this->Pf_planning_model->updateDataCondition('project_physical_planning_detail', $physical_planning_detail, $where);
                  $this->session->set_flashdata('message', 'Data updated Successfully'); 
               }
               

               if(!empty($_REQUEST['target'][$i])){
                 $total_physical_planning=$total_physical_planning+ $_REQUEST['target'][$i];
               }
            }

            $physical_planning['total_activity_quantity']=$total_physical_planning;
            $where = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Pf_planning_model->updateDataCondition('project_physical_planning_main', $physical_planning, $where);

            redirect('pf_planning/physical_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
            

        }else{
            $this->load->common_template('project/pf_project_add_physical_planning',$data);
        }
        
    }
    /*Add Project Physical End*/


     /* Get Project Physical Month wise target*/
    public function get_physical_month_details(){
        $project_id=$_REQUEST['project_id'];
        $work_item_id=$_REQUEST['work_item_id'];
        $activity_id=$_REQUEST['activity_id'];
        $project_physical_planning_detail=$this->Pf_planning_model->project_physical_planning_detail($project_id,$work_item_id,$activity_id);
        $html='<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Sl No</th>
                    <th style="text-align: center;">Month Name</th>
                    <th style="text-align: center;">Quantity</th>
                </tr>
            </thead>
            <tbody>';
        if(!empty($project_physical_planning_detail)){
            $i=1; 
            $sum=0;
            $html.='<div class="block-header"><h4>Work Item: '.$_REQUEST['workitem_name'].'</h4>
            </div><div class="block-header"><h4>Activity: '.$_REQUEST['activity_name'].'</h4>
            </div>';
            foreach($project_physical_planning_detail as $planning_detail){
                $quantity_name=$this->Pf_planning_model->get_unit_detail($planning_detail['unit_id']);
                $html.='<tr><td>'.$i.'</td></td><td>'.$planning_detail['month_name'].'</td><td style="text-align: right;">'.$planning_detail['target_quantity'].' '.$quantity_name[0]['unit_name'].'</td></tr>';
                $sum=$sum+$planning_detail['target_quantity'];
                $i++; 
            }  
        }
        $html.='<tr><td colspan="2" style="text-align: center;"><b>Total Quantity :</b></td><td style="text-align: right;">'.number_format($sum,2).' '.$quantity_name[0]['unit_name'].'</td></tr></tbody>';
        $html.='</table>';
        echo  $html;
    }
    /* Get Project Physical Month wise target End*/


    // for get financial acitivity plan data

    function get_financial_acitivity_plan_data(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];


        $get_activities_budget_Data = $this->Pf_planning_model->get_project_activity_list($project_id,$activity_id);
        $get_activities_planned_data = $this->Pf_planning_model->get_project_activity_wise_total_activity_planned_amt($project_id,$activity_id);

        $project_aggrement_deatail = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        

        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];

        $jsonData['get_activities_budget_amt'] = number_format($get_activities_budget_Data[0]['amount'],2);
        $jsonData['get_activities_planned_amt'] = number_format($get_activities_planned_data[0]['total_budget_amount'],2);

        $remaining_amt = $get_activities_budget_Data[0]['amount'] - $get_activities_planned_data[0]['total_budget_amount'];
        $jsonData['get_activities_remain_amt'] = number_format($remaining_amt,2);
        $weightage_val = ($get_activities_budget_Data[0]['amount'] / $agreement_cost) * 100;
        $jsonData['get_activities_Weightage'] = number_format($weightage_val,2);
        
        echo json_encode($jsonData);


        die;

    }

/* check this acctivity id exist or not */
    function check_activity_record_exist_or_not($project_id,$project_work_item_id,$activity_id){
        return $this->Pf_planning_model->check_activity_record_exist_or_not($project_id,$project_work_item_id,$activity_id);


    }



    function count_data_against_project($tbl,$field1,$value1,$field2,$value2){
      return $this->Pf_planning_model->count_data_against_project($tbl,$field1,$value1,$field2,$value2);
    }


    function get_financial_planned_amount_month_data(){
        $project_id= $_REQUEST['project_id'];
        
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $start_date= $_REQUEST['start_date'];

        $duration= $_REQUEST['duration'];

        $project_aggrement_deatail = $this->Pf_planning_model->get_project_aggrement_details($project_id);

        

        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];
        $first_date_find = strtotime(date("Y-m-d", strtotime($start_date)) . ", first day of this month");
        $first_date = date("Y-m-d",$first_date_find);
        $getnew_duration = $duration -1;
        $duration_end_Date = date('Y-m-d', strtotime("+".$getnew_duration." months", strtotime($first_date)));

        $durationstart    = new DateTime($first_date);
          $durationstart->modify('first day of this month');
          $durationend      = new DateTime($duration_end_Date);
          $durationend->modify('first day of next month');
          $durationinterval = DateInterval::createFromDateString('1 month');
          $data['durationperiod']   = new DatePeriod($durationstart, $durationinterval, $durationend);

        
          $start    = new DateTime($project_aggrement_deatail[0]['project_start_date']);
          $start->modify('first day of this month');
          $end      = new DateTime($project_aggrement_deatail[0]['project_end_date']);
          $end->modify('first day of next month');
          $interval = DateInterval::createFromDateString('1 month');
          $data['period']   = new DatePeriod($start, $interval, $end);
          $data['project_id']= $project_id;
          $data['project_financial_planning_detail']=$this->Pf_planning_model->project_financial_planning_detail($project_id,$work_item_id,$activity_id);



          $get_activities_budget_Data = $this->Pf_planning_model->get_project_activity_list($project_id,$activity_id);
          $get_activities_budget_amt =$get_activities_budget_Data[0]['amount'];
         

          $data['single_budget_amt'] = $get_activities_budget_amt / $duration;
         

          $data['single_weightage'] = ( $data['single_budget_amt'] /$agreement_cost ) * 100;
          $data['view_agreement_cost'] = $agreement_cost;

          $data['get_activities_budget_amt'] =$get_activities_budget_amt;

          $this->load->view('project/financial_planned_amount_month_data_view',$data);


    }


    function count_activity_exist($activity_id){
        $fin_count = $this->Pf_planning_model->count_activity_exist($activity_id,'project_financial_planning_main');
        $phy_count = $this->Pf_planning_model->count_activity_exist($activity_id,'project_physical_planning_main');
        if($fin_count > 0 || $phy_count > 0){
            return 1;
        }else{
            return 0;
        }
    }


    function delete_financial_planning(){
    $project_id=base64_decode($_REQUEST['project_id']);
    $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
    $activity_id=base64_decode($_REQUEST['activity_id']);
    $project_financial_id = base64_decode($_REQUEST['project_financial_id']);
    
       $maindeleteClause =  array('project_id' => $project_id,'project_work_item_id'=>$project_work_item_id,'project_activity_id'=>$activity_id);
       $this->Pf_planning_model->deleteRecord('project_financial_planning_main',$maindeleteClause);

       $detailsdeleteClause =  array('project_id' => $project_id,'project_work_item_id'=>$project_work_item_id,'project_activity_id'=>$activity_id,'project_financial_planning_id'=>$project_financial_id);
       $this->Pf_planning_model->deleteRecord('project_financial_planning_detail',$detailsdeleteClause);
       $this->session->set_flashdata('danger', 'Data deleted Successfully');
       redirect('pf_planning/financial_listing?project_id='.$_REQUEST['project_id'].'&project_work_item_id='.$_REQUEST['project_work_item_id']);
    }

    function delete_work_item() {
        $project_id = base64_decode($_REQUEST['project_id']);
        $work_item_id = base64_decode($_REQUEST['work_item_id']);

        $delworkitClause = array('project_id' => $project_id, 'work_item_id' => $work_item_id);
        $this->Pf_planning_model->deleteRecord('project_work_items',$delworkitClause);
        $this->session->set_flashdata('danger', 'Data deleted Successfully');
        redirect('pf_planning/project_work_item?project_id='.$_REQUEST['project_id']);

    }

}