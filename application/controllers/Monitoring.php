<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
class Monitoring extends MY_Controller {
	public function __construct(){
        parent::__construct();
		$this->load->library('session');
		$this->load->library('pagination');	  
		$this->load->helper('form');
        
        $this->load->model('Monitoring_model');
        $this->load->model('Project_model');
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
    }
    
    
    /* Project List For Monitoring */
    public function project_monitoring_list() {
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');

        $data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);
    	$this->load->common_template('monitoring/project_monitoring_list',$data);
    }
    /* Project List For Monitoring End*/

    /* Project Destination */
    public function get_destination(){
        $area_id= $_REQUEST['area_id'];
        $destination=$this->Project_model->get_project_destination($area_id);
        $html="";
        //$html.="<option value=''>Select Project Destination</option>";
        foreach($destination as $des){
           $html.="<option value='".$des['id']."'>".$des['name']."</option>";
        }
        echo $html;
        die;
     }
    /* Project Destination End*/ 

    /* Project Type */
     public function project_type($type_id){
        return $this->Project_model->get_project_type($type_id);
     }
    /* Project Type End */   

    /* Project Area */
     public function project_area($area_id){
        return $this->Project_model->get_project_area($area_id);
     }
    /* Project Area End */ 

    /*Financial Monitoring Listing*/
    public function financial_listing(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;

        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_financial_deatail'] = $this->Project_model->get_project_financial_details($project_id);
        $data['project_work_item_detail'] = $this->Project_model->get_project_work_item_details($project_id);

        $data['project_other_setting_detail'] = $this->Project_model->get_project_other_setting_list($project_id);
        $data['work_item_categories'] = $this->Monitoring_model->get_work_item_categories();
        $data['project_progress_location'] = $this->Project_model->get_project_progress_location($project_id);

        $this->load->common_template('monitoring/financial_listing',$data);
     }
     /*Financial Monitoring Listing End*/

    /* Project work item name */
    public function work_item($work_item_id){

        return $this->Project_model->get_work_item_list($work_item_id);
    }
    /* Project work item name End*/ 

    /* Add Project Financial*/
    public function work_activity($activity_id){
        return $this->Project_model->project_activity_name($activity_id);
    }
    /* Add Project Financial End*/

    /*  Financial Monitor */
    public function add_financial_monitoring(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);

        //echo "<pre>"; print_r($data); die;

        if(!empty($_REQUEST['submit'])){
            
            $totalAllottedAmount = 0;
            $total_target_amt = 0;
            // Updating project_financial_planning_detail and project_financial_planning_main


    foreach($_REQUEST['financialPlanningDetailId'] as $plan => $fin){
            $totalAllottedAmount += str_replace(',','',$_REQUEST['allotted'][$plan]);
            }



            /* Checking this data already exist or not */
            $where_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);


           $chk_exist = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_main',$where_check);




           if($chk_exist > 0){

            $showprocess = "Update";
            //For update
            $financial_planning_monitoring_main['total_activity_allotted_amount']=$totalAllottedAmount;


            $financial_planning_monitoring_main['monitored_by']=$this->session->userdata('id');


            $financial_planning_monitoring_main['monitored_on']=Date('Y-m-d');

            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);


            $this->Monitoring_model->updateDataCondition('project_financial_planning_main', $financial_planning_monitoring_main, $where_main);

            $main_financial_id = $this->Monitoring_model->get_any_table_specific_data('project_financial_planning_main',$where_main,'id');
           }else{
            //for add
 $showprocess = "Insert";
                $financeAddData = array(
                                            'project_id' => $_REQUEST['project_id'], 
                                            'project_work_item_id' => $_REQUEST['work_item_id'], 
                                            'project_activity_id' => $_REQUEST['activity_id'],
                                            'total_activity_allotted_amount' => $totalAllottedAmount, 
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $main_financial_id = $this->Monitoring_model->insertDatareturnid($financeAddData,'project_financial_planning_main');

           }




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
                $img_detail = $this->Monitoring_model->check_table_data_exist_or_not_condition('earned_value_images',$where_detail_check);


                echo '<h2>'. $img_detail . '</h2>';
                if($chk_detail > 0){
                    //update
                    
                    $financial_planning_monitoring['allotted_amount']=$financial_allotted_amount;
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
                                            'allotted_amount' => $financial_allotted_amount,
                                            'status' => 'Y', 
                                            'created_by' => $this->session->userdata('id'), 
                                            'created_on' => Date('Y-m-d')
                                        );
                $this->Monitoring_model->insertDatareturnid($financeDetailsAddData,'project_financial_planning_detail');
                }

             }
            
            $this->session->set_flashdata('message', 'Financial  Data saved successfully');
              echo $showprocess;

            //redirect('Monitoring/financial_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/add_financial_monitoring',$data);
        }
        
    }
    /*  Financial Monitor End*/

    /* Get Project Financial Acitivity Plan Ajax */
    public function get_financial_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arFinancialActivityPlan=$this->Monitoring_model->get_financial_acitivity_plan($project_id, $work_item_id, $activity_id);
        $arActivityBudget=$this->Monitoring_model->get_financial_acitivity_budget($project_id, $work_item_id, $activity_id);
        
        $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];
        $html='<div class="card">
            <div class="body ">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            
        <thead>
            <tr>
                <th style="padding: 10px 5px; width: 40px; text-align: center; vertical-align: middle;">Sl No</th>
                <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Months</th>
                <th style="padding: 10px 5px; width: 50px; text-align: center; vertical-align: middle;"> Earned (%)</th>
                <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Earned (<i class="fa fa-rupee-sign"></i>)</th>
                <th style="padding: 10px 5px; width: 50px; text-align: center; vertical-align: middle;"> Released (%)</th>
                <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Released (<i class="fa fa-rupee-sign"></i>)</th>
            </tr>
        </thead>
        
        <tbody>';

                $financialPlanningMonthFlag = true;
                $total_earned_amount = 0.00;
                $total_earned_amount_percent = 0.00;

                
        foreach ($arFinancialActivityPlan as $key => $val) {
            //echo "<pre>"; print_r($val); die(); 
            //echo "Curremt Month & Year: ".date('M Y'); die();
            $slNo = $key+1;
            $monthName = $val['month_name'];
            $monthDate = $val['month_date'];
            $financialPlanningDetailId = $val['id'];
            if(!empty($val['earned_amount'])){
            $earned_amount = $val['earned_amount'];
            }else{
               $earned_amount = 0.00; 
            }
            $total_earned_amount = $total_earned_amount + $earned_amount;

            $earned_amount_percent = ($earned_amount / $agreement_cost) * 100;

            $total_earned_amount_percent = $total_earned_amount_percent + $earned_amount_percent;
            
            if(!empty($val['allotted_amount'])){
            $allotted_amount = $val['allotted_amount'];
            }else{
               $allotted_amount = 0.00; 
            }
             $allotted_amount_percent = ($allotted_amount / $agreement_cost) * 100;
            



            if($financialPlanningMonthFlag){
                $html.='<tr>
                    <td style="text-align: center; vertical-align: middle;">'.$slNo.'</td>
                    <td style="text-align: center; vertical-align: middle;">'.$monthName.'
                        <input type="hidden" class="form-control" name="financialPlanningDetailId[]" value="'.$financialPlanningDetailId.'"/>
                        <input type="hidden" class="form-control" name="month[]" value="'.$monthName.'"/>
                        <input type="hidden" class="form-control" name="month_date[]" value="'.$monthDate.'"/>
                    </td>
                    <td style="text-align: right; vertical-align: middle;">'.number_format($earned_amount_percent,2).'</td>
                    <td style="text-align: center; vertical-align: middle;">'.number_format($earned_amount,2).'</td>
                    
                    <td>
                        <input type="text" onkeypress="return validateFloatKeyPress(this,event);" class="form-control weightage_key" id="weightage_'.$slNo.'" style="text-align: right; vertical-align: middle;" placeholder="Achieved" name="erarnedpercent[]" value="'.number_format($allotted_amount_percent,2).'" />
                    </td>
                    
                    <td>
                        <input type="text" onkeypress="return validateFloatKeyPress(this,event);" class="form-control amount_key" id="amountKey_'.$slNo.'" style="text-align: right; vertical-align: middle;" placeholder="Achieved" name="allotted[]" value="'.$allotted_amount.'" />
                    </td>
                </tr>';
            }
            

            if(date('M Y') == $monthName){
                $financialPlanningMonthFlag = false;    
            }

        }

        $html.='<tr>
            <td style="text-align: center; vertical-align: middle;"></td>
            <td style="text-align: center; vertical-align: middle;"><strong>Total</strong></td>
            <td style="text-align: right; vertical-align: middle;">'.number_format($total_earned_amount_percent,2).'</td>
            <td style="text-align: center; vertical-align: middle;">'.number_format($total_earned_amount,2).'</td>
            
            <td style="text-align: right; vertical-align: middle;"><span id="releasedTotalPercent"></span></td>
            <td style="text-align: right; vertical-align: middle;"><span id="releasedTotalAmount"></span></td>
        </tr>';

        $html.='</tbody>
            </table>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                    <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                    <a href="javascript:window.history.back();" title="Go back to previous page" class="btn bg-indigo waves-effect"><span> BACK </span></a>
            </div>
            
            </div>
                            </div>
                        </div>';

        //echo $html;

        $jsonData['html'] =  $html;

        $total_activity_budget_amount = $arActivityBudget[0]['total_activity_budget_amount'];
        $total_activity_budget_amount_percent = ($total_activity_budget_amount / $agreement_cost) * 100;
        $total_activity_earned_amount = $arActivityBudget[0]['total_activity_earned_amount'];
        $total_activity_earned_amount_percent = ($total_activity_earned_amount / $agreement_cost) * 100;
        $total_activity_allotted_amount = $arActivityBudget[0]['total_activity_allotted_amount'];
        $total_activity_allotted_amount_percent = ($total_activity_allotted_amount / $agreement_cost) * 100;
        $remaining_amount = $total_activity_earned_amount - $total_activity_allotted_amount;
        $remaining_amount_percent = ($remaining_amount / $agreement_cost) * 100;

        $html_additional_data='<div class="card">
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="summaryTable">
                    <tbody>
                    <tr>
                                    <td width="45%">Project Cost: </td>
                                    <td width="50%">'.number_format($agreement_cost,2).' <i class="fa fa-rupee-sign"></i></td>
                                </tr>
                    <tr>
                                    <td width="45%">Planned Amount: </td>
                                    <td width="50%">'.number_format($total_activity_budget_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_budget_amount_percent,2).' %) </td>
                                </tr>
                                <tr>
                                    <td width="45%">Earned Amount: 
                                    <input type="hidden" class="form-control" id="total_activity_earned_amount" value="'.$total_activity_earned_amount.'"/>
                                    </td>
                                    <td width="50%">'.number_format($total_activity_earned_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_earned_amount_percent,2).' %) </td>
                                </tr>
                                <tr>
                                    <td width="45%">Released Amount: </td>
                                    <td width="50%">'.number_format($total_activity_allotted_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_allotted_amount_percent,2).' %) </td>
                                </tr>
                                <tr>
                                    <td width="45%">Remaining Value : </td>
                                    <td width="50%">'.number_format($remaining_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($remaining_amount_percent,2).' %) </td>
                                </tr>
                                </tbody>
                </table>
            </div>
        </div>
        </div>';
        $jsonData['html_additional_data'] =  $html_additional_data;   
        
        echo json_encode($jsonData);


        die;
    }
    /* Get Project Financial Acitivity Plan Ajax Ends */

    /* Physical Monitoring Listing*/
    public function physical_listing(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']); 
        $data['project_id']=$project_id;
        $data['project_work_item_id']=$project_work_item_id;
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_financial_deatail'] = $this->Project_model->get_project_financial_details($project_id);
        $data['project_work_item_detail'] = $this->Project_model->get_project_work_item_details($project_id);
        $this->load->common_template('monitoring/physical_listing',$data);
    }
    /* Physical Monitoring Listing End*/

    /* Project work item physical target*/
    public function work_item_physical_target($project_id,$work_item_id){
        return $this->Project_model->get_work_item_physical_target($project_id,$work_item_id);          
    }
    /* Project work item physical target End*/

    /*Get unit*/
    public function get_unit($unit_id){
        return $this->Project_model->get_unit_detail($unit_id);
    }
    /*Get unit End*/

    /*  Physical Monitoring */
    public function add_physical_monitoring(){
        $project_id=base64_decode($_REQUEST['project_id']);
        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_id']=$project_id;
        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_physical_activity_details($project_id, $project_work_item_id);

        //echo "<pre>"; print_r($data); die;

        if(!empty($_REQUEST['submit'])){
            //echo "<pre>"; print_r($_REQUEST); die;
            $totalAllottedQuantity = 0;
            // Updating project_physical_planning_detail and project_physical_planning_main
            foreach($_REQUEST['physicalPlanningDetailId'] as $key => $val){
                //echo $val; echo "<br>";
                $physical_planning_monitoring['allotted_quantity']=$_REQUEST['allotted'][$key];
                $physical_planning_monitoring['modified_by']=$this->session->userdata('id');
                $physical_planning_monitoring['modified_on']=Date('Y-m-d');
                $where = array('id' => $val);
                if($this->Monitoring_model->updateDataCondition('project_physical_planning_detail', $physical_planning_monitoring, $where)){
                    $totalAllottedQuantity += $_REQUEST['allotted'][$key];    
                }
            }

            // Now Update project_financial_planning_main
            $physical_planning_monitoring_main['total_activity_allotted_quantity']=$totalAllottedQuantity;
            $physical_planning_monitoring_main['modified_by']=$this->session->userdata('id');
            $physical_planning_monitoring_main['modified_on']=Date('Y-m-d');
            $where_main = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);
            $this->Monitoring_model->updateDataCondition('project_physical_planning_main', $physical_planning_monitoring_main, $where_main);

            redirect('Monitoring/physical_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/add_physical_monitoring',$data);
        }
        
    }
    /*  Physical Monitoring End*/

    /* Get Project Physical Acitivity Plan Ajax */
    public function get_physical_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arPhysicalActivityPlan=$this->Monitoring_model->get_physical_acitivity_plan($project_id, $work_item_id, $activity_id);

        $arActivityBudget=$this->Monitoring_model->get_physical_acitivity_budget($project_id, $work_item_id, $activity_id);
        //echo "<pre>"; print_r($arActivityBudget);echo '</pre>'; die();
        $activityBudgetQuantity = $arActivityBudget[0]['total_activity_quantity'];
        $activityAllottedQuantity = $arActivityBudget[0]['total_activity_allotted_quantity'];
        //$activityBudgetQuantity = $arActivityBudget[0]['activity_quantity_unit_id'];
        $unitDetailsAr = $this->get_unit($arActivityBudget[0]['activity_quantity_unit_id']);
        //echo "<pre>"; print_r($unitDetailsAr);echo '</pre>'; die();
        $unitName = $unitDetailsAr[0]['unit_name'];

        $html='<div class="card">
            <div class="body ">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <input type="hidden" class="form-control" name="activityTargetQuantity" id="activityTargetQuantity" value="'.$activityBudgetQuantity.'"/>
                <thead>
                    <tr>
                        <th style="padding: 10px 5px; width: 40px; text-align: center; vertical-align: middle;">Sl No</th>
                        <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Months</th>
                        <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Target Quantity</th>
                        <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Achieved Quantity</th>
                    </tr>
                </thead>
                
                <tbody>';

        $physicalPlanningMonthFlag = true;
        $totalTargetTillDate = 0;
        $totalAlottedTillDate = 0;
        foreach ($arPhysicalActivityPlan as $key => $val) {
            //echo "<pre>"; print_r($val); die(); 
            //echo "Curremt Month & Year: ".date('M Y'); die();
            $slNo = $key+1;
            $monthName = $val['month_name'];
            $physicalPlanningDetailId = $val['id'];
            $targetQuantity = $val['target_quantity'];
            if(!empty($val['allotted_quantity'])){
                $allottedQuantity = $val['allotted_quantity'];
            }else{
                $allottedQuantity = "";
            }

            $unid_id=$this->Project_model->get_unit_detail($val['unit_id']);


            $totalAlottedTillDate = $totalAlottedTillDate+$allottedQuantity;

            if($physicalPlanningMonthFlag){
                $html.='<tr>
                    <td style="text-align: center; vertical-align: middle;">'.$slNo.'</td>
                    <td style="text-align: center; vertical-align: middle;">'.$monthName.'
                        <input type="hidden" class="form-control" name="physicalPlanningDetailId[]" value="'.$physicalPlanningDetailId.'"/>
                        <input type="hidden" class="form-control" name="month[]" value="'.$monthName.'"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">'.$targetQuantity .' '.$unid_id[0]['unit_name'].' 
                        <input type="hidden" class="form-control" placeholder="Cost" name="target[]" value="'.$targetQuantity.'" />
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" class="form-control pull-left" placeholder="Achieved" name="allotted[]" style="width: 60%; margin-left:30px;" value="'.$allottedQuantity.'" /> <label class="pull-left" style="margin-left:5px;margin-top: 5px;">'.$unid_id[0]['unit_name'].'</label></td>
                </tr>';
            }
            

            if(date('M Y') == $monthName){
                $physicalPlanningMonthFlag = false;    
            }

        }

        $html.='</tbody>
            </table>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                    <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                    <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
            </div>
            
            </div>
                            </div>
                        </div>';

        
        $jsonData['html'] =  $html;
        $activityRemainingQuantity = $activityBudgetQuantity - $activityAllottedQuantity;
        $html_additional_data='<div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="summaryTable">
                        <tbody>
                            <tr>
                                <td width="45%">Activity Quantity : </td>
                                <td width="50%">'.number_format(round($activityBudgetQuantity,2)).' '.$unitName.'</td>
                            </tr>
                            <tr>
                                <td width="45%">Activity Remaining Quantity : </td>
                                <td width="50%">'.number_format(round($activityRemainingQuantity,2)).' '.$unitName.'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
        $jsonData['html_additional_data'] =  $html_additional_data;   
        echo json_encode($jsonData);                


        //echo $html;
        die;
    }
    /* Get Project Financial Acitivity Plan Ajax Ends */

    /* Getting Project Financial Progress Details */
    public function project_financial_progress_details($project_id){
        $project_released_amount_ar = $this->Monitoring_model->get_project_released_amount($project_id);
        $project_planned_amount_ar = $this->Monitoring_model->get_project_planned_amount($project_id);
        $project_earend_amount_ar = $this->Monitoring_model->get_project_earned_amount($project_id);

        $project_financial_details_ar['released'] = $this->IND_money_format(empty($project_released_amount_ar[0]['total_activity_allotted_amount'])?0:$project_released_amount_ar[0]['total_activity_allotted_amount']);
        $project_financial_details_ar['planned'] = $this->IND_money_format(empty($project_planned_amount_ar[0]['total_activity_planned_amount'])?0:$project_planned_amount_ar[0]['total_activity_planned_amount']);
        $project_financial_details_ar['project_completion_percentage'] = round((($project_released_amount_ar[0]['total_activity_allotted_amount'] * 100)/$project_planned_amount_ar[0]['total_activity_planned_amount']),2);
       $project_activities_total_value = $this->Monitoring_model->get_project_activities_total_value($project_id);

       $project_agrreement_data = $this->Monitoring_model->get_project_aggrement_details($project_id);

      if($project_earend_amount_ar[0]['total_activity_earned_amount'] > 0){
        $project_financial_details_ar['project_financial_completion_percentage'] = round(($project_earend_amount_ar[0]['total_activity_earned_amount'] / $project_agrreement_data[0]['agreement_cost'] ) * 100,2);
      }else{
        $project_financial_details_ar['project_financial_completion_percentage'] = 0.00;
      }

        
      
        return $project_financial_details_ar; //die();
    }
    /* #END Getting Project Financial Progress Details */

    /* Getting Project physical Progress Details */
    public function project_physical_progress_details($project_id){
        $project_released_quantity_ar = $this->Monitoring_model->get_project_released_quantity($project_id);
        $project_planned_quantity_ar = $this->Monitoring_model->get_project_planned_quantity($project_id);
        //echo "<pre>"; print_r($project_released_quantity_ar); die();
        
        $project_physical_details_ar['released_quantity'] = empty($project_released_quantity_ar[0]['total_activity_allotted_quantity'])?0:$project_released_quantity_ar[0]['total_activity_allotted_quantity'];

        $project_physical_details_ar['planned_quantity'] = empty($project_planned_quantity_ar[0]['total_activity_planned_quantity'])?0:$project_planned_quantity_ar[0]['total_activity_planned_quantity'];

        $project_physical_details_ar['project_physical_completion_percentage'] = round((($project_released_quantity_ar[0]['total_activity_allotted_quantity'] * 100)/$project_planned_quantity_ar[0]['total_activity_planned_quantity']),2);

        // echo "<br>Planned: ".$project_financial_details_ar['planned']; 
        // echo "<br>released: ".$project_financial_details_ar['released'];
        // echo "<br>project_completion_percentage: ".$project_financial_details_ar['project_completion_percentage'];
        // die();
        return $project_physical_details_ar; //die();
    }
    /* #END Getting Project physical Progress Details */

    public function work_item_financial_details($project_id, $work_item_id){
        $work_item_financial_details_ar = $this->Monitoring_model->get_work_item_financial_details($project_id, $work_item_id);
        return $work_item_financial_details_ar;    
        //echo "work_item_financial_details_ar: <pre>"; print_r($work_item_financial_details_ar); die();
    }

    public function no_to_words($no)
    {
        if ($no == 0) {
            return ' ';

        } else {
            $n = strlen($no); // 7
            //echo "length: ".$n; //die();
            switch ($n) {
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
                    $finalval = $val . " Crore";
            }
            return $finalval;

        }
    }

    function qno_to_words($no)
    {
        //$no = (int) $no;
        echo "no: ".$no;
        if($no == 0) {
            return ' ';

        }else {
            $n =  strlen($no); // 7
            switch ($n) {
                case 3:
                    $val = $no/100;
                    $val = round($val, 2);
                    $finalval =  $val ." hundred";
                    break;
                case 4:
                    $val = $no/1000;
                    $val = round($val, 2);
                    $finalval =  $val ." thousand";
                    break;
                case 5:
                    $val = $no/1000;
                    $val = round($val, 2);
                    $finalval =  $val ." thousand";
                    break;
                case 6:
                    $val = $no/100000;
                    $val = round($val, 2);
                    $finalval =  $val ." lakh";
                    break;
                case 7:
                    $val = $no/100000;
                    $val = round($val, 2);
                    $finalval =  $val ." lakh";
                    break;
                case 8:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;
                case 9:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;

                default:
                    $val = $no/10000000;
                    $val = round($val, 2);
                    $finalval =  $val ." crore";
                    break;
            }
            //return $finalval;

        }
        echo "final val: ".$finalval; die();
    }

    function IND_money_format($number){        
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);
 
        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }
 
        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);
 
        if( $decimal != '0'){
            $result = $result.$decimal;
        }
 
        return $result;
    }




    /*=============== New Changes on 30-07-2021 ================== */

    function financial_monitoring_list(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');
        
        $data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);
        $this->load->common_template('monitoring/financial_monitoring_list',$data);
    }


    function get_work_item_budget_amount($project_id, $work_item_id){
        $budget_amount = 0;
        $main_result = $this->Monitoring_model->project_financial_planning_main_result($project_id, $work_item_id);

        if(is_array($main_result)){
            foreach($main_result as $res){
                //$activity_id = $res->project_activity_id;
                //$activity_amount = $this->Monitoring_model->project_activity_amount_data($project_id, $activity_id);
                $budget_amount += $res->total_activity_budget_amount;
            }
        }

        return $budget_amount;

    }


    function get_work_item_earned_amount($project_id, $work_item_id){
        $earned_amount = 0;
        $main_result = $this->Monitoring_model->project_financial_planning_main_result($project_id, $work_item_id);

        if(is_array($main_result)){
            foreach($main_result as $res){
                //$activity_id = $res->project_activity_id;
                //$earned_amountdata = $this->Monitoring_model->project_activity_earned_amount_data($project_id,$work_item_id, $activity_id);

                $earned_amount += $res->total_activity_earned_amount;
            }
        }

        return $earned_amount;

    }



    /*  Earned Financial Monitor */
    public function earned_financial_progress(){
        $project_id=base64_decode($_REQUEST['project_id']);

        $project_work_item_id=base64_decode($_REQUEST['project_work_item_id']);

        $data['project_id']=$project_id;

        $data['project_work_item_id']=base64_decode($_REQUEST['project_work_item_id']);
        
        $data['project_deatail'] = $this->Monitoring_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $data['project_work_item_deatail'] = $this->Project_model->get_project_work_item_details($project_id);
        $data['project_activity_detail'] = $this->Monitoring_model->get_project_activity_details($project_id, $project_work_item_id);
        
        //echo "<pre>"; print_r($data); die;

        if(!empty($_REQUEST['submit'])){
            
            $totalEarnedAmount = 0;
            // Updating project_financial_planning_detail and project_financial_planning_main
            foreach($_REQUEST['financialPlanningDetailId'] as $plan => $fin){
                $totalEarnedAmount += str_replace(',','',$_REQUEST['allotted'][$plan]); 
                
            }



            /* Checking this data already exist or not */
            $where_check = array('project_id' => $_REQUEST['project_id'],'project_work_item_id' => $_REQUEST['work_item_id'],'project_activity_id' => $_REQUEST['activity_id']);


           $chk_exist = $this->Monitoring_model->check_table_data_exist_or_not_condition('project_financial_planning_main',$where_check);


           if($chk_exist > 0){

            $responsemsg = "Update Called";
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
                $responsemsg = "Insert Called";
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

                    $boxstatus = "Update box called";
                    $financial_planning_monitoring['earned_amount']=$financial_allotted_amount;
                    
                    $financial_planning_monitoring['monitored_by']=$this->session->userdata('id');
                    $financial_planning_monitoring['monitored_on']=Date('Y-m-d');
                    $this->Monitoring_model->updateDataCondition('project_financial_planning_detail', $financial_planning_monitoring, $where_detail_check);
                }else{
                    $boxstatus = "Insert box called";
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
            
            $this->session->set_flashdata('message', 'Financial  Data saved successfully');

            redirect('Monitoring/financial_listing?project_id='.base64_encode($_REQUEST['project_id']).'&project_work_item_id='.base64_encode($_REQUEST['work_item_id']));
        }else{
            $this->load->common_template('monitoring/earned_financial_progress_view',$data);
        }
        
    }




     /* Get Project Financial Earned Acitivity Plan Ajax */
    public function get_earned_financial_acitivity_plan_xhr(){
        $project_id= $_REQUEST['project_id'];
        $work_item_id= $_REQUEST['work_item_id'];
        $activity_id= $_REQUEST['activity_id'];
        $arFinancialActivityPlan=$this->Monitoring_model->get_financial_acitivity_plan($project_id, $work_item_id, $activity_id);
        $arActivityBudget=$this->Monitoring_model->get_financial_acitivity_budget($project_id, $work_item_id, $activity_id);
        
        $project_aggrement_deatail = $this->Monitoring_model->get_project_aggrement_details($project_id);
        $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];

        $html='<div class="card">
            <div class="body ">
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th style="padding: 10px 5px; width: 40px; text-align: center; vertical-align: middle;">Sl No</th>
                <th style="padding: 10px 5px; width: 200px; text-align: center; vertical-align: middle;">Months</th>
                <th style="padding: 10px 5px; width: 50px; text-align: center; vertical-align: middle;">Planned (%)</th>
                <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;"> Planned Value (<i class="fa fa-rupee-sign"></i>)</th>
                
                
                <th style="padding: 10px 5px; width: 50px; text-align: center; vertical-align: middle;"> Earned (%)</th>
                <th style="padding: 10px 5px; width: 150px; text-align: center; vertical-align: middle;">Earned Value (<i class="fa fa-rupee-sign"></i>)</th>
                <th style="padding: 10px 5px; width: 75px; text-align: center; vertical-align: middle;">Earned Images <i class="fa fa-file-image"></i></th>

            </tr>
        </thead>
        
        <tbody>';

        $financialPlanningMonthFlag = true;

        $total_target_amount = 0.00;
        $total_target_amount_percent = 0.00;
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

            
            
            
            


            if($financialPlanningMonthFlag){
                $html.='<tr>
                    <td style="text-align: center; vertical-align: middle;">'.$slNo.'</td>
                    <td style="text-align: center; vertical-align: middle;">'.$monthName.'
                        <input type="hidden" class="form-control" name="financialPlanningDetailId[]" value="'.$financialPlanningDetailId.'"/>
                        <input type="hidden" class="form-control" name="month[]" value="'.$monthName.'"/>
                        <input type="hidden" class="form-control" name="month_date[]" value="'.$monthDate.'"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">'.number_format($target_amount_percent,2).'</td>
                    <td style="text-align: right; vertical-align: middle;">'.number_format($target_amount,2).'</td>
                    
                    <td>
                        <input type="text" onkeypress="return validateFloatKeyPress(this,event);" class="form-control weightage_key" id="weightage_'.$slNo.'" style="text-align: right; vertical-align: middle;" placeholder="Achieved" name="erarnedpercent[]" value="'.number_format($earned_amount_percent,2).'" />
                    </td>
                    
                    <td>
                        <input type="text" onkeypress="return validateFloatKeyPress(this,event);" class="form-control amount_key" id="amountKey_'.$slNo.'" style="text-align: right; vertical-align: middle;" placeholder="Achieved" name="allotted[]" value="'.$earned_amount.'" />
                    </td>
                    <td><a class="btn btn-info btn-lg earnedimage" id="earnedimage" data-toggle="modal" data-target="#myModal"  data-month="'.$monthName.'">Preview</a></td>

                </tr>';
            }        
            

            if(date('M Y') == $monthName){   
                $financialPlanningMonthFlag = false;    
            }

        }

        $html.='<tr>
            <td style="text-align: center; vertical-align: middle;"></td>
            <td style="text-align: center; vertical-align: middle;"><strong>Total</strong></td>
            <td style="text-align: center; vertical-align: middle;">'.number_format($total_target_amount_percent,2).'</td>
            <td style="text-align: right; vertical-align: middle;">'.number_format($total_target_amount,2).'</td>
            
            
            <td style="text-align: right; vertical-align: middle;"><span id="earnedTotalPercent"></span></td>
            <td style="text-align: right; vertical-align: middle;"><span id="earnedTotalAmount"></span></td>
        </tr>';

        $html.='</tbody>
            </table>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                    <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                    <a href="javascript:window.history.back();" title="Go back to previous page" class="btn bg-indigo waves-effect"><span> BACK </span></a>
            </div>
            
            </div>
                            </div>
                        </div>';

        //echo $html;

        $jsonData['html'] =  $html;

        $total_activity_budget_amount = $arActivityBudget[0]['total_activity_budget_amount'];
        $total_activity_budget_amount_percent = ($total_activity_budget_amount / $agreement_cost) * 100;
        $total_activity_earned_amount = $arActivityBudget[0]['total_activity_earned_amount'];
        $total_activity_earned_amount_percent = ($total_activity_earned_amount / $agreement_cost) * 100;
        
        $remaining_amount = $total_activity_budget_amount - $total_activity_earned_amount;
        $remaining_amount_percent = ($remaining_amount / $agreement_cost) * 100;
        $html_additional_data='<div class="card">
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="summaryTable">
                    <tbody>
                    <tr>
                                    <td width="45%">Project Cost: </td>
                                    <td width="50%">'.number_format($agreement_cost,2).' <i class="fa fa-rupee-sign"></i></td>
                                </tr>
                    <tr>
                                    <td width="45%">Planned Value: 
                                    <input type="hidden" class="form-control" id="total_activity_budget_amount" value="'.$total_activity_budget_amount.'"/>
                                    </td>
                                    <td width="50%">'.number_format($total_activity_budget_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_budget_amount_percent,2).' %)</td>
                                </tr>
                                <tr>
                                    <td width="45%">Earned Value: </td>
                                    <td width="50%">'.number_format($total_activity_earned_amount,2).' <i class="fa fa-rupee-sign"></i> ('.number_format($total_activity_earned_amount_percent,2).' %)</td>
                                </tr>
                                <tr>
                                    <td width="45%">Remaining Value : </td>
                                    <td width="50%">'.number_format(($remaining_amount),2).' <i class="fa fa-rupee-sign"></i> ('.number_format($remaining_amount_percent,2).' %)</td>
                                </tr>
                                </tbody>
                </table>
            </div>
        </div>
        </div>';
        $jsonData['html_additional_data'] =  $html_additional_data;   
        
        echo json_encode($jsonData);


        die;
    }


    function get_project_total_data($project_id){
        return $project_total_data = $this->Monitoring_model->get_project_total_data($project_id);
    }

    function earned_value_images_generation() {
        $project_id = $_REQUEST['project_id'];
        $month = $_REQUEST['month'];
        $monthimages = $this->Monitoring_model->get_earned_image_monthly($project_id,$month);

          foreach ($monthimages as $key => $value) {


            if($key == 0) {
              $imageblock .= '<div class="item active">
                                  <img src="'.base_url().'uploads/earnedimages/'.$monthimages[$key]['image'].'" />
                                </div>';
                 $dotsblock .= '<li data-target="#myCarousel" data-slide-to="'.$monthimages[$key].'" class="active"></li>';

             }
             else {
                  $imageblock .= '<div class="item">
                                  <img src="'.base_url().'uploads/earnedimages/'.$monthimages[$key]['image'].'" />
                                </div>';
                   $dotsblock .= '<li data-target="#myCarousel" data-slide-to="'.$monthimages[$key].'"></li>';
             }


          }
           
           $jsonres = array('imgblocks' => $imageblock, 'dotsblock' => $dotsblock);
          echo json_encode($jsonres);
    }
    function get_project_work_item_activity_table()
    {
        
        $project_id = $_REQUEST['project_id'];
        $work_item_type_id = $_REQUEST['work_item_type_id'];

        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Monitoring_model->get_project_work_items($project_id, $work_item_type_id);
        
      

        //Total Project Cost
         $project_total_cst = $this->Monitoring_model->get_total_project_cost($project_id);

        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                 $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Monitoring_model->get_financial_activity_data($project_id, $work_item_id);
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Monitoring_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Planned_Value'] = $valueActivity['Planned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Earned_Value'] = $valueActivity['Earned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Paid_Value'] = $valueActivity['Paid_Value'];
                        
                        
                        

                    }
                }


            }
        

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
                                    </tr><tr class="bg-blue-grey">';
                        $html .= '<th style="text-align: center; vertical-align: middle;">Finish Date</th>
                                            <th style="text-align: center; vertical-align: middle;">Weightage (%)</th>';
                    

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
                            $start_date = $this->Monitoring_model->get_project_startdate($project_id,$work_item_id,$activity_id);
                            
                            $start_dateview = date('M Y', strtotime($start_date[0]['month_date']));
                            
                            //finish date
                            $finish_date = $this->Monitoring_model->get_project_finishdate($project_id,$work_item_id,$activity_id);
                            $finish_dateview = date('M Y', strtotime($finish_date[0]['month_date']));
                            
                            
                            
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
                            
                            $weightage =  round(($valueActivity['Planned_Value']/$project_total_cst * 100), 2) ;
                            //Progress Status %
                            $progress =  round(($valueActivity['Earned_Value']/$project_total_cst * 100), 2) ;
                            //Actual Cost % 
                            $actual_cost =  round(($valueActivity['Paid_Value']/$project_total_cst * 100), 2) ;
                            
                            

                       
                            $html .= '<tr style="text-align: center; vertical-align: middle;">
                                                    <td>' . $sl . '</td>
                                                    <td >' . $activity_name . '</td>';
                                $html .= '<td >' . $start_dateview . '</td>
                                         <td >' . $duration . '</td>';
                            $html .= '<td >' . $finish_dateview . '</td>
                                     <td >' . $weightage . '</td>
                                     <td >' . $val_total_planned . '</td>';
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


        /* close all data show table */

        } else {
            $html .= 'No Data Available';
        }

        //echo "<br>project_work_item_details_ar: <pre>"; print_r($project_work_item_details_ar); die();
        echo $html;
        die();
    }

}
?>