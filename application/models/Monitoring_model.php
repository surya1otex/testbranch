<?php

class Monitoring_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }


    function get_monitoring_project_list($user_id,$circle_id,$division_id){



         if($circle_id == 0 && $division_id == 0){

            $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
            project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type,project_aggrement_stage.agreement_cost');

            $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
            $this->db->where('project_aggrement_stage.approve_status', 'Y');
           // $this->db->where('project_conceptualisation_stage.project_status', '1');
            $query = $this->db->get('project_conceptualisation_stage');
            return $query->result_array();

        }
        elseif($circle_id && $division_id){

            $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
            project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type,project_aggrement_stage.agreement_cost');

            $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
            $this->db->where('project_aggrement_stage.approve_status', 'Y');
            //$this->db->where('project_conceptualisation_stage.project_status', '1');
            $this -> db -> where('project_conceptualisation_stage.wing_id' , $circle_id);
            $this -> db -> where('project_conceptualisation_stage.division_id' , $division_id);
            $query = $this->db->get('project_conceptualisation_stage');
            return $query->result_array();

        }
        else
        {
            $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
            project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type,project_aggrement_stage.agreement_cost');

            $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
            $this->db->where('project_aggrement_stage.approve_status', 'Y');
           // $this->db->where('project_conceptualisation_stage.project_status', '1');
            $this -> db -> where('project_conceptualisation_stage.wing_id' , $circle_id);
            $query = $this->db->get('project_conceptualisation_stage');
            return $query->result_array(); 
        }


        // $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        // project_conceptualisation_stage.project_destination,project_conceptualisation_stage.location_id,project_conceptualisation_stage.project_type,project_aggrement_stage.agreement_cost');
        // $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        // $this->db->where('project_aggrement_stage.approve_status', 'Y');
        // $this->db->where('project_conceptualisation_stage.project_status', '1');
        // $this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
        // $query = $this->db->get('project_conceptualisation_stage');
      
        // return $query->result_array();
    }


    public function project_details( $project_id ){
        $this->db->select('*');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_conceptualisation_stage');
        return $query->result_array();
    }

    public function get_earned_image_monthly($project_id,$month) {
      $this->db->select('*');
      $this->db->where('project_id', $project_id);
      $this->db->where('month_name', $month);
      $query = $this->db->get('earned_value_images');
        return $query->result_array();
    }

    public function get_project_aggrement_details( $project_id){
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_aggrement_stage');
        return $query->result_array();
    }


    public function get_project_activity_details($project_id=null, $project_work_item_id=null) {
      $this->db->select('pa.particulars, pfpm.project_work_item_id, pfpm.project_activity_id');
      $this->db->from('project_financial_planning_main as pfpm');
      $this->db->where('pfpm.project_id', $project_id);
      $this->db->where('pfpm.project_work_item_id', $project_work_item_id);
      $this->db->join('project_pf_activities as pa', 'pfpm.project_activity_id = pa.id', 'LEFT');
      $query = $this->db->get();
      return $query->result_array();
    }

    /* Get project financial activity plan */
    public function get_financial_acitivity_plan($project_id, $work_item_id, $activity_id) {
      $this->db->select('project_financial_planning_detail.*');
      $this->db->where('project_financial_planning_detail.project_id', $project_id);
      $this->db->where('project_financial_planning_detail.project_work_item_id', $work_item_id);
      $this->db->where('project_financial_planning_detail.project_activity_id', $activity_id);
      //$this->db->where('project_physical_planning_detail.status', 'Y');
      $query = $this->db->get('project_financial_planning_detail');
      return $query->result_array();
    }
    /* Get project financial activity plan Ends */

    /* Get project physical activity plan */
    public function get_project_physical_activity_details($project_id=null, $project_work_item_id=null) {
      $this->db->select('pa.particulars, pfpm.project_work_item_id, pfpm.project_activity_id');
      $this->db->from('project_physical_planning_main as pfpm');
      $this->db->where('pfpm.project_id', $project_id);
      $this->db->where('pfpm.project_work_item_id', $project_work_item_id);
      $this->db->join('project_pf_activities as pa', 'pfpm.project_activity_id = pa.id', 'LEFT');
      $query = $this->db->get();
      return $query->result_array();
    }
    /* Get project physical activity plan */

    /* Get project physical activity plan */
    public function get_physical_acitivity_plan($project_id, $work_item_id, $activity_id) {
      $this->db->select('project_physical_planning_detail.*');
      $this->db->where('project_physical_planning_detail.project_id', $project_id);
      $this->db->where('project_physical_planning_detail.project_work_item_id', $work_item_id);
      $this->db->where('project_physical_planning_detail.project_activity_id', $activity_id);
      
      $query = $this->db->get('project_physical_planning_detail');
      //echo $this->db->last_query(); die;
      return $query->result_array();
    }
    /* Get project physical activity plan */
    
    /*For Any Update Query*/ 
    public function updateDataCondition($tableName, $data, $where){
        $this->db->where($where);
        $this->db->update($tableName, $data);
        return TRUE;
    }

    public function updateimageCollection($tableName, $data, $where) {
        $this->db->where($where);
        $this->db->update($tableName, $data);
        return TRUE;
    }


      function earnedimagesexist($project_id){
        $this->db->select('*');
        $this->db->from('earned_value_images');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

     public function removelist($project_id) {
      $this->db->where('project_id', $project_id);
      $this->db->delete('earned_value_images');
    }
    public function insertimageCollection($data = array(), $tbl) {
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
         if($insert){ return  $insert_id; }
        else{ return false; }
    }
    /*For Any Update Query End*/

    /* Getting Project Released Amount */
    public function get_project_released_amount($project_id=null) {
      $this->db->select('sum(total_activity_allotted_amount) as total_activity_allotted_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /* #END Getting Project Released Amount */


    /* Getting Project Planned Amount */
    public function get_project_planned_amount($project_id=null) {
      $this->db->select('sum(total_activity_budget_amount) as total_activity_planned_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /* #END Getting Project Planned Amount */

    /* Getting Project Released Quanntity */
    public function get_project_released_quantity($project_id=null) {
      $this->db->select('sum(total_activity_allotted_quantity) as total_activity_allotted_quantity');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }

    /* Getting Project Earened Amount */
    public function get_project_earned_amount($project_id=null) {
      $this->db->select('sum(total_activity_earned_amount) as total_activity_earned_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /* #END Getting Project Released quantity */


    /* Getting Project Planned quantity */
    public function get_project_planned_quantity($project_id=null) {
      $this->db->select('sum(total_activity_quantity) as total_activity_planned_quantity');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }
    /* #END Getting Project Planned quantity */


    /* Getting Work Item Financial Details */
    public function get_work_item_financial_details($project_id=null, $work_item_id=null) {
      $this->db->select('sum(total_activity_budget_amount) as total_planned_amount, sum(total_activity_allotted_amount) as total_achieved_amount');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      if(!empty($work_item_id)){
        $this->db->where('project_work_item_id', $work_item_id);  
      }
      $query = $this->db->get('project_financial_planning_main');
      //echo "Query: ".$this->db->last_query(); die();
      return $query->result_array();
    }
    /* #END Getting Work Item Financial Details */

    /* Get project financial activity budget */
    public function get_financial_acitivity_budget($project_id, $work_item_id, $activity_id) {
      $this->db->select('project_financial_planning_main.*');
      $this->db->where('project_financial_planning_main.project_id', $project_id);
      $this->db->where('project_financial_planning_main.project_work_item_id', $work_item_id);
      $this->db->where('project_financial_planning_main.project_activity_id', $activity_id);
      //$this->db->where('project_financial_planning_detail.status', 'Y');
      $query = $this->db->get('project_financial_planning_main');
      return $query->result_array();
    }
    /* Get project financial activity budget Ends */

    /* Get project physical activity budget */
    public function get_physical_acitivity_budget($project_id, $work_item_id, $activity_id) {
      $this->db->select('project_physical_planning_main.*');
      $this->db->where('project_physical_planning_main.project_id', $project_id);
      $this->db->where('project_physical_planning_main.project_work_item_id', $work_item_id);
      $this->db->where('project_physical_planning_main.project_activity_id', $activity_id);
      //$this->db->where('project_financial_planning_detail.status', 'Y');
      $query = $this->db->get('project_physical_planning_main');
      return $query->result_array();
    }
    /* Get project physical activity budget Ends */


    /*Get project destination*/
    public function get_project_destination($area_id)
    {
        $this->db->select('destination_master.*');
        $this->db->where('destination_master.area_id', $area_id);
        $this->db->where('destination_master.status', 'Y');
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

/*=============== New Changes on 30-07-2021 ================== */
    function project_physical_planning_main_result($project_id, $work_item_id)
    {
        $this -> db -> select('*');
        $this -> db -> from('project_physical_planning_main');
        $this -> db -> where('project_id', $project_id);
        $this -> db -> where('project_work_item_id', $work_item_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function project_financial_planning_main_result($project_id, $work_item_id)
    {
        $this -> db -> select('*');
        $this -> db -> from('project_financial_planning_main');
        $this -> db -> where('project_id', $project_id);
        $this -> db -> where('project_work_item_id', $work_item_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function project_activity_amount_data($project_id, $project_activity_id){
        $this->db->select('amount');
        $this->db->from('project_pf_activities');
        $this->db->where('id', $project_activity_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['amount'];
        } 
   }


   function get_physical_project_activity_details($project_id, $project_work_item_id){
      $this->db->select('pa.particulars, pfpm.project_work_item_id, pfpm.project_activity_id');
      $this->db->from('project_physical_planning_main as pfpm');
      $this->db->where('pfpm.project_id', $project_id);
      $this->db->where('pfpm.project_work_item_id', $project_work_item_id);
      $this->db->join('project_pf_activities as pa', 'pfpm.project_activity_id = pa.id', 'LEFT');
      $query = $this->db->get();
      return $query->result_array();
   }


   function get_project_financial_released_ammount_data($project_id,$work_item_id,$activity_id,$monthName){
    $this->db->select('allotted_amount');
        $this->db->from('project_financial_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_work_item_id', $work_item_id);
        $this->db->where('project_activity_id', $activity_id);
        $this->db->where('month_name', $monthName);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['allotted_amount'];
        } 
   }

   function get_project_financial_earned_ammount_data($project_id,$work_item_id,$activity_id,$monthName){
    $this->db->select('earned_amount');
        $this->db->from('project_financial_planning_detail');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_work_item_id', $work_item_id);
        $this->db->where('project_activity_id', $activity_id);
        $this->db->where('month_name', $monthName);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['earned_amount'];
        } 
   }

   /*Check Field value exist or not in specific table*/
    function check_table_data_exist_or_not_condition($tbl,$where){
      $this->db->where($where);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    /*Insert data to the database and return id*/
    function insertDatareturnid($data = array(), $tbl){
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        if($insert){ return  $insert_id; }
        else{ return false; }
    }

    function insertDataCondition($data = array(), $tbl){
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        if($insert){ return  $insert_id; }
        else{ return false; }
    }


    function get_any_table_specific_data($tbl,$where,$specifc_field){
      $this->db->select($specifc_field);
        $this->db->from($tbl);
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
    }

    /* Getting Project activities total amount */
    public function get_project_activities_total_value($project_id=null) {
      $this->db->select('sum(amount) as project_activities_total_value');
      if(!empty($project_id)){
        $this->db->where('project_id', $project_id);  
      }
      $this->db->where('status', 'Y');
      $query = $this->db->get('project_pf_activities');
      return $query->result_array();
    }

         public function get_project_total_data($project_id)
    {
        $query = $this->db->query("SELECT IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value FROM `project_financial_planning_detail` WHERE month_date<=NOW() AND project_id=".$project_id." ");
        $result = $query->result_array();
        return $result;
    }

       /*Get work item type details*/
    public function get_work_item_categories($category_id = null)
    {
        $this->db->select('work_item_type_master.*');
        if (!empty($category_id)) {
            $this->db->where('work_item_type_master.id', $category_id);
        }        $this->db->where('work_item_type_master.status', 'Y');
        $query = $this->db->get('work_item_type_master');
    // echo  $this->db->last_query(); die();
        return $query->result_array();
    }

     /* Get project work item details */
    public function get_project_work_items($project_id = null, $work_item_type_id = null)
    {
        $this->db->select('pwi.project_id, pwi.work_item_id, pwi.total_quantity as work_item_total_quantity, pwi.amount as work_item_amount, wim.work_item_description, wim.type_id as work_item_type_id');
        $this->db->from('project_work_items as pwi');
        if (!empty($project_id)) {
            $this->db->where('pwi.project_id', $project_id);
        }
        $this->db->where('pwi.status', 'Y');
        if (!empty($work_item_type_id)) {
        $this->db->where('wim.type_id', $work_item_type_id);
        }
        $this->db->join('work_item_master as wim', 'pwi.work_item_id = wim.id', 'LEFT');
        $query = $this->db->get();
        // echo  $this->db->last_query(); die();
        return $query->result_array();
    }

    function get_total_project_cost($project_id){
        $this->db->select('agreement_cost');
        $this->db->from('project_aggrement_stage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
    //echo $this->db->last_query(); die();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row['agreement_cost'];
        } 
   }

    public function get_financial_activity_data($project_id, $work_item_id)
    {

        $this->db->select('pppm.project_id,pppm.project_work_item_id,pppm.project_activity_id, IFNULL(SUM(pppm.target_amount), 0) as Planned_Value, IFNULL(SUM(pppm.earned_amount), 0) as Earned_Value, IFNULL(SUM(pppm.allotted_amount), 0) as Paid_Value, pa.particulars as activity_name');
        $this->db->from('project_financial_planning_detail as pppm');
        if (!empty($project_id)) {
            $this->db->where('pppm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pppm.project_work_item_id', $work_item_id);
        }
        $this->db->where('pppm.status', 'Y');
        $this->db->group_by('pppm.project_activity_id');
        $this->db->join('project_pf_activities as pa', 'pppm.project_activity_id = pa.id', 'LEFT');
        $query = $this->db->get();
    //echo  $this->db->last_query(); die();
        return $query->result_array();
    }

     public function get_financial_activity_details($project_id, $work_item_id, $project_activity_id, $start_date, $end_date)
    {
        //echo "project_id: ".$project_id;echo "<br>work_item_id: ".$work_item_id; die();
        $this->db->select('IFNULL(SUM(target_amount),0) as total_planned, IFNULL(SUM(allotted_amount),0) as total_released');
        $this->db->from('project_financial_planning_detail');
        if (!empty($project_id)) {
            $this->db->where('project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('project_work_item_id', $work_item_id);
        }
        if (!empty($project_activity_id)) {
            $this->db->where('project_activity_id', $project_activity_id);
        }
        if (!empty($start_date)) {
            $this->db->where('month_date >=', $start_date);
        }
        if (!empty($end_date)) {
            $this->db->where('month_date <=', $end_date);
        }
        $this->db->where('status', 'Y');
        $query = $this->db->get();
    //echo  $this->db->last_query(); die();
        return $query->result_array();
    }

    public function get_project_startdate($project_id, $work_item_id,$activity_id)
    {
    
    $this->db->select('pppm.id,pppm.month_date');
        $this->db->from('project_financial_planning_detail as pppm');
        if (!empty($project_id)) {
            $this->db->where('pppm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pppm.project_work_item_id', $work_item_id);
        }
        if (!empty($activity_id)) {
            $this->db->where('pppm.project_activity_id', $activity_id);
        }
        $this->db->where('pppm.target_amount!=', '0');
        $this->db->order_by('pppm.id', 'ASC');
    $this->db->limit('1');
       // $this->db->group_by('pppm.project_activity_id');
       // $this->db->join('project_pf_activities as pa', 'pppm.project_activity_id = pa.id', 'LEFT');
        $query = $this->db->get();
    //echo  $this->db->last_query(); die();
        return $query->result_array();
    
  } 

  public function get_project_finishdate($project_id, $work_item_id,$activity_id)
    {
    
    $this->db->select('pppm.id,pppm.month_date');
        $this->db->from('project_financial_planning_detail as pppm');
        if (!empty($project_id)) {
            $this->db->where('pppm.project_id', $project_id);
        }
        if (!empty($work_item_id)) {
            $this->db->where('pppm.project_work_item_id', $work_item_id);
        }
        if (!empty($activity_id)) {
            $this->db->where('pppm.project_activity_id', $activity_id);
        }
        $this->db->where('pppm.target_amount!=', '0');
        $this->db->order_by('pppm.id', 'DESC');
    $this->db->limit('1');
        $query = $this->db->get();
    //echo  $this->db->last_query(); die();
        return $query->result_array();
    
  }

}
?>