<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProjectVisitReport extends MY_Controller {
    public function __construct(){
        parent::__construct();
        // load base_url
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper(array('url','html','form'));
        $this->load->model('Project_model');
        $this->load->model('Project_visit_model');
         /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
       

    }
    /* Project List */
    public function project_list()
    {
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $data['project_deatail'] = $this->Project_model->get_project_details( '');
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
        $this->load->common_template('projectvisitreport/project_list', $data);
    }
    /* Project List End*/
    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Project_model->get_project_type($type_id);
    }
    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Project_model->get_project_area($area_id);
    }
    public function project_destination($destination_id)
    {
        return $this->Project_model->project_destination($destination_id);
    }
    public function visit_report(){
        $project_id = base64_decode($_REQUEST['project_id']);
        $project_details = $this->Project_visit_model->get_project_single_data($project_id);
        //$data['progress_details'] = $this->Project_visit_model->fetchSingledatawithorder('project_progress_update_log_triggering', 'project_id', $project_id,'id','DESC');
        //print_r($project_details)
        $data['project_details'] = $project_details;
        $data['progress_details'] = $this->Project_visit_model->get_project_progress_details($project_id);
        $this->load->common_template('projectvisitreport/project_visit_report',$data);
    }



    public function get_progress_image_data($project_id,$log_id){
         return $this->Project_visit_model->get_progress_image_result($project_id,$log_id);
    }

    public function visit_progress_detail(){
        $project_id = base64_decode($_REQUEST['project_id']);
        $log_id = base64_decode($_REQUEST['log_id']);
        $data['project_details'] = $this->Project_visit_model->get_project_single_data($project_id);
        $data['single_logs_details'] = $this->Project_visit_model->fetchSingledata('project_progress_update_log_triggering', 'id', $log_id);
        // foreach ($single_logs_details as $key) {
        // $data['observation'] =  $key->observation;
        // $data['recommendation'] =  $key->recommendation; 
        // }
        $project_work_item_id = $this->Project_visit_model->getSpecificdata2('project_progress_update_log_details_triggering','project_id',$project_id,'log_id',$log_id,'project_work_item_id');
        // $work_item_id = $this->Project_visit_model->getSpecificdata('project_work_items', 'id', $project_work_item_id,'work_item_id');
        // $data['work_item_name'] = $this->Project_visit_model->getSpecificdata('work_item_master', 'id', $work_item_id,'work_item_description');
        $work_item_id = $this->Project_visit_model->getSpecificdata('project_milestone', 'id', $project_work_item_id,'id');
        $data['work_item_name'] = $this->Project_visit_model->getSpecificdata('work_item_master', 'id', $project_work_item_id,'work_item_description');
        
        //$data['log_details_data'] = $this->Project_visit_model->get_log_details_data($project_id,$log_id);
        $data['progress_details_table'] = TRUE;
        $this->load->common_template('projectvisitreport/visit_report',$data);
    }

    public function physical_planning_detail_data($project_id,$project_work_item_id,$project_activity_id){
        return $this->Project_visit_model->get_physical_planning_detail_data($project_id,$project_work_item_id,$project_activity_id);
    }




    function progress_detail_data(){
        $user_id = $this->session->userdata('id');
        $project_id = $this->input->post('project_id');
        $log_id = $this->input->post('log_id');
        
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $list = $this->Project_visit_model->get_log_details_table_data($project_id,$log_id);
        $data = array();


        if(is_array($list->result())){
            foreach($list->result() as $row) {
                $newDateTime = date('d M Y h:i A', strtotime($row->created_on));
                $target_res = $this->physical_planning_detail_data($row->project_id,$row->project_work_item_id,$row->project_activity_id);
                $target = 0;
                $till_target = 0;
                $unit_name = '';
                $allotted_quantity = 0;

                $total_result = $this->Project_visit_model->get_physical_planning_total_detail_data($row->project_id,$row->project_work_item_id,$row->project_activity_id);

                if(is_array($total_result)){
                    foreach ($total_result as $tot) {
                        //$unit_name = $tar->unit_name;
                        if($tot->total_activity_quantity){
                        $target = $tot->total_activity_quantity;
                        }else{
                          $target = 0;  
                        }
                        
                        if($tot->total_activity_allotted_quantity){
                            $allotted_quantity = $tot->total_activity_allotted_quantity;
                        }else{
                          $allotted_quantity = 0;  
                        }
                        
                    }
                }


                 $project_approver_id = $this->Project_visit_model->getSpecificdata('project_preparation_stage','project_id',$project_id,'project_approver_id');

                if(is_array($target_res)){
                  foreach ($target_res as $tar) {
                     $unit_name = $tar->unit_name;
                    // $target += $tar->target_quantity;
                    // $allotted_quantity += $tar->allotted_quantity;
                    if($tar->month_date <= $today){
                      $till_target += $tar->target_quantity;
                    }
                  }
                }
                $remain = $target - $allotted_quantity;

            // delete section
            $status = $row->status;

            if ($status == 'Y') {
                $action = '<span class="label label-success">Approved</span>';
            }elseif($status == 'N'){
               $action = '<span class="label label-danger">Rejected</span>'; 
            }else{
               // if($project_approver_id == $user_id){
                $action = '<button type="button" data-id="'.$row->id.'" data-progress="'.$row->achieved_score.'" data-remain="'.$remain.'" class="btn btn-success waves-effect approveSt">Approve</button> <button type="button" data-id="'.$row->id.'" data-progress="'.$row->achieved_score.'" class="btn btn-danger waves-effect rejectSt">Reject</button>'. '&nbsp;<span class="label label-warning">Pending</span>';
           // }else{
               // $action = '<span class="label label-warning">Pending</span>';
           // }
               
            }

        


                $data[] = array(
                    $row->activities_name,
                    $target.' '.$unit_name,
                    $allotted_quantity.' '.$unit_name,
                    $till_target.' '.$unit_name,
                    $row->achieved_score.' '.$unit_name,
                    $action
                   );  
            }
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $list->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }


    public function get_log_details_reject(){
        $id = $this->input->post('logid');
        $type = $this->input->post('type');
        $log_details = $this->Project_visit_model->fetchSingledata('project_progress_update_log_details_triggering', 'id', $id);
        $response = "<table class='table table-bordered table-striped table-hover'>";
        foreach ($log_details as $row) {
            $activities_name = $this->Project_visit_model->getSpecificdata('project_pf_activities','id',$row->project_activity_id ,'particulars');
            $target_res = $this->physical_planning_detail_data($row->project_id,$row->project_work_item_id,$row->project_activity_id);
                $target = 0;
                $till_target = 0;
                $unit_name = '';
                $allotted_quantity = 0;

                $total_result = $this->Project_visit_model->get_physical_planning_total_detail_data($row->project_id,$row->project_work_item_id,$row->project_activity_id);

                if(is_array($total_result)){
                    foreach ($total_result as $tot) {
                        //$unit_name = $tar->unit_name;
                        if($tot->total_activity_quantity){
                        $target = $tot->total_activity_quantity;
                        }else{
                          $target = 0;  
                        }
                        
                        if($tot->total_activity_allotted_quantity){
                            $allotted_quantity = $tot->total_activity_allotted_quantity;
                        }else{
                          $allotted_quantity = 0;  
                        }
                        
                    }
                }




                if(is_array($target_res)){
                  foreach ($target_res as $tar) {
                    $unit_name = $tar->unit_name;
                    //$target += $tar->target_quantity;
                    //$allotted_quantity += $tar->allotted_quantity;
                    if($tar->month_date <= $today){
                      $till_target += $tar->target_quantity;
                    }
                  }
                }
            $remain = $target - $allotted_quantity;

            $project_work_item_id = $this->Project_visit_model->getSpecificdata2('project_progress_update_log_details_triggering','project_id',$row->project_id,'log_id',$row->log_id,'project_work_item_id');
        $work_item_id = $this->Project_visit_model->getSpecificdata('project_work_items', 'id', $project_work_item_id,'work_item_id');
        $work_item_name = $this->Project_visit_model->getSpecificdata('work_item_master', 'id', $work_item_id,'work_item_description');

             $response .= "<tr>";
             $response .= "<td><b>Work Item</b></td><td>".$work_item_name."</td>";
             $response .= "</tr>";

             $response .= "<tr>";
             $response .= "<td><b>Activity Name</b></td><td>".$activities_name."</td>";
             $response .= "</tr>";

             

             $response .= "<tr>";
             $response .= "<td><b>Target</b></td><td>".$target." ".$unit_name."</td>";
             $response .= "</tr>";

             $response .= "<tr>";
             $response .= "<td><b>Achieved</b></td><td>".$allotted_quantity." ".$unit_name."</td>";
             $response .= "</tr>";

             $response .= "<tr>";
             $response .= "<td><b>Remaining</b></td><td><span id='remaincount'>".$remain."</span> ".$unit_name."</td>";
             $response .= "</tr>";
             $response .= "<tr>";
             $response .= "<td><b>Target Till date</b></td><td>".$till_target." ".$unit_name."</td>"; 
             $response .= "</tr>";
             if($type != 'reject'){
             $response .= "</tr>";
             $response .= "<tr>";
             $response .= "<td><b>Progress</b></td><td><div class='col-md-6'><input name='progress' id='progress' class='form-control' value=".$row->achieved_score." type='number'/></div><div class='col-md-6 p-0'>".$unit_name."</div><p class='text-danger' id='progress_err'></p></td>"; 
             $response .= "</tr>";
            }
        }
        $response .= "</table>";

        echo $response;
    }


    function submit_reject_data(){
        $reason = $this->input->post('reason');
        
        $log_details_id = $this->input->post('id');
        $log_details = $this->Project_visit_model->fetchSingledata('project_progress_update_log_details_triggering', 'id', $log_details_id);
        foreach ($log_details as $key) {
           $log_id = $key->log_id;
           $project_id = $key->project_id;
           $project_work_item_id = $key->project_work_item_id;
           $project_activity_id = $key->project_activity_id;
           $achieved_score = $key->achieved_score;
        }
        $addData = array(
            'log_details_triggering_id' => $log_details_id, 
            'log_id' => $log_id,
            'user_id' => $this->session->userdata('id'), 
            'project_id' => $project_id, 
            'project_work_item_id' => $project_work_item_id, 
            'project_activity_id' => $project_activity_id, 
            'progress' => $achieved_score, 
            'remarks' => $reason, 
            'status' => 'N',
        );
        $add = $this->Project_visit_model->insertAllData($addData,'project_progress_update_log_details_actioned');
        if($add){
            $updateData = array(
            'modified_by' => $this->session->userdata('id'), 
            'status' => 'N',
        );
            $up = $this->Project_visit_model->updateData('id', 'project_progress_update_log_details_triggering', $updateData, $log_details_id);
        }

        if($up){
            echo "Success";
        }else{
            echo "Error";
        }

    }


    function submit_approve_data(){
        $reason = $this->input->post('appreason');
        
        $log_details_id = $this->input->post('id');
        $progress = $this->input->post('progress');
        $log_details = $this->Project_visit_model->fetchSingledata('project_progress_update_log_details_triggering', 'id', $log_details_id);
        foreach ($log_details as $key) {
           $log_id = $key->log_id;
           $project_id = $key->project_id;
           $project_work_item_id = $key->project_work_item_id;
           $project_activity_id = $key->project_activity_id;
        }
        $addData = array(
            'log_details_triggering_id' => $log_details_id, 
            'log_id' => $log_id,  
            'user_id' => $this->session->userdata('id'), 
            'project_id' => $project_id, 
            'project_work_item_id' => $project_work_item_id, 
            'project_activity_id' => $project_activity_id, 
            'progress' => $progress, 
            'remarks' => $reason, 
            'status' => 'Y'
        );
        $add = $this->Project_visit_model->insertAllData($addData,'project_progress_update_log_details_actioned');
        if($add){
            $updateData = array(
            'modified_by' => $this->session->userdata('id'), 
            'status' => 'Y'
        );
            $up = $this->Project_visit_model->updateData('id', 'project_progress_update_log_details_triggering', $updateData, $log_details_id);
            //physical main table changes 

            $old_total_activity_allotted_quantity = $this->Project_visit_model->getSpecificdata3('project_physical_planning_main','project_id',$project_id,'project_work_item_id',$project_work_item_id,'project_activity_id',$project_activity_id,'total_activity_allotted_quantity');
            $old_total_activity_allotted_id = $this->Project_visit_model->getSpecificdata3('project_physical_planning_main','project_id',$project_id,'project_work_item_id',$project_work_item_id,'project_activity_id',$project_activity_id,'id');
            if($old_total_activity_allotted_quantity){
              $n_total = $old_total_activity_allotted_quantity + $progress;  
          }else{
            $n_total = $progress;
          }
            
             $totalData = array(
            'total_activity_allotted_quantity' => $n_total, 
            'modified_by' =>  $this->session->userdata('id'),
            'modified_on' => date('Y-m-d H:i:s')
            );
            $up_main_table = $this->Project_visit_model->updateData('id', 'project_physical_planning_main', $totalData, $old_total_activity_allotted_id);

             /* update for project_physical_planning_detail table */
             /* new update on 29-07-2021 */

             /* for financial main table update */
              $where_main = array('id' => $project_activity_id);
             $activity_amount = $this->Project_visit_model->get_table_specific_data('project_pf_activities',$where_main,'amount');
             $calculated_amount = ($activity_amount * $n_total) / 100;

             $findata = array(
            'total_activity_earned_amount' => $calculated_amount, 
            'modified_by' =>  $this->session->userdata('id'),
            'modified_on' => date('Y-m-d H:i:s')
            );
             $finwhere =  array('project_id' => $project_id,'project_work_item_id' => $project_work_item_id,'project_activity_id' => $project_activity_id);
             $this->Project_visit_model->updatetableDataCondition('project_financial_planning_main', $findata, $finwhere);
             /* END for financial main table update */



             $log_visit_date = $this->Project_visit_model->getSpecificdata('project_progress_update_log_triggering','id',$log_id,'visit_date');

             $log_visit_date_st= strtotime($log_visit_date);
             $log_visit_date_month_year = date('M Y', $log_visit_date_st);




            $today = date('Y-m-d');
            
            $get_physical_planning_detail_next_id = $this->Project_visit_model->get_project_physical_planning_details_data($project_id,$project_work_item_id,$project_activity_id,'month_name',$log_visit_date_month_year,'id');

            if(is_numeric($get_physical_planning_detail_next_id)){
               $get_physical_planning_detail_allotted_quantity = $this->Project_visit_model->getSpecificdata('project_physical_planning_detail','id',$get_physical_planning_detail_next_id,'allotted_quantity');
               if($get_physical_planning_detail_allotted_quantity){
                    $p_total = $get_physical_planning_detail_allotted_quantity + $progress;  
                  }else{
                    $p_total = $progress;
                  } 

               $upDetailsData = array(
                    'allotted_quantity' => $p_total, 
                    'modified_by' =>  $this->session->userdata('id'),
                    'modified_on' => date('Y-m-d H:i:s')
                    );
                $up_planning_detail_table = $this->Project_visit_model->updateData('id', 'project_physical_planning_detail', $upDetailsData, $get_physical_planning_detail_next_id);


                /* Financial Details update */

                $fin_cal_amt = ($activity_amount * $p_total) / 100;
                $findetails_data = array(
            'earned_amount' => $fin_cal_amt, 
            'modified_by' =>  $this->session->userdata('id'),
            'modified_on' => date('Y-m-d H:i:s')
            );
             $findetailswhere =  array('project_id' => $project_id,'project_work_item_id' => $project_work_item_id,'project_activity_id' => $project_activity_id,'month_name' => $log_visit_date_month_year);
             $this->Project_visit_model->updatetableDataCondition('project_financial_planning_detail', $findetails_data, $findetailswhere);

                /* END Financial Details update */


            }else{
                $log_visit_previous_date_st= date("Y-m-d", strtotime($log_visit_date."-1 months"));
                $log_visit_previous_date_month_year = date('M Y', $log_visit_previous_date_st);
                $get_physical_planning_detail_prev_id = $this->Project_visit_model->get_project_physical_planning_details_data($project_id,$project_work_item_id,$project_activity_id,'month_name',$log_visit_previous_date_month_year,'id');

                $get_physical_planning_detail_allotted_quantity = $this->Project_visit_model->getSpecificdata('project_physical_planning_detail','id',$get_physical_planning_detail_prev_id,'allotted_quantity');
               if($get_physical_planning_detail_allotted_quantity){
                    $p_total = $get_physical_planning_detail_allotted_quantity + $progress;  
                  }else{
                    $p_total = $progress;
                  } 

               $upDetailsData = array(
                    'allotted_quantity' => $p_total, 
                    'modified_by' =>  $this->session->userdata('id'),
                    'modified_on' => date('Y-m-d H:i:s')
                    );
                $up_planning_detail_table = $this->Project_visit_model->updateData('id', 'project_physical_planning_detail', $upDetailsData, $get_physical_planning_detail_prev_id);
                
                /* Financial Details update */

                $fin_cal_amt = ($activity_amount * $p_total) / 100;
                $findetails_data = array(
            'earned_amount' => $fin_cal_amt, 
            'modified_by' =>  $this->session->userdata('id'),
            'modified_on' => date('Y-m-d H:i:s')
            );
             $findetailswhere =  array('project_id' => $project_id,'project_work_item_id' => $project_work_item_id,'project_activity_id' => $project_activity_id,'month_name' => $log_visit_previous_date_month_year);
             $this->Project_visit_model->updatetableDataCondition('project_financial_planning_detail', $findetails_data, $findetailswhere);
             
                /* END Financial Details update */
                 

            }
            
            /* END update for project_physical_planning_detail table */
        }

        if($up_main_table){
            echo "Success";
        }else{
            echo "Error";
        }
    }

    public function project_count_data($project_id,$fld,$val){
        return $this->Project_visit_model->get_num_rows2('project_progress_update_log_details_triggering','project_id',$project_id,$fld,$val);
    }

    public function project_summary_count_data($project_id){
    return $this->Project_visit_model->get_num_rows('project_progress_update_log_triggering','project_id',$project_id);
    }

    public function get_project_visit_pending_count($project_id,$progress_id){
return $this->Project_visit_model->get_num_rows3('project_progress_update_log_details_triggering','project_id',$project_id,'log_id',$progress_id,'status','P');
    }


    public function getSpecificdata_res($table,$field,$get_id,$specifc_field){
        return $this->Project_visit_model->getSpecificdata($table,$field,$get_id,$specifc_field);
    }

    public function getSpecificdata2_res($table,$field1,$get_id1,$field2,$get_id2,$specifc_field){
        return $this->Project_visit_model->getSpecificdata2($table,$field1,$get_id1,$field2,$get_id2,$specifc_field);
    }



}
?>