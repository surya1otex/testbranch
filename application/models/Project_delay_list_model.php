<?php

class Project_delay_list_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }


    function get_stakeholder_delayed_project_data($user_id){
       
    
        $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_aggrement_stage.agreement_cost,project_type_master.project_type from project_delayed_communication 
            left join 
            (
             Select *  from
(SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
            
            ) all_project 
             ON all_project.project_id=project_delayed_communication.project_id 
             LEFT JOIN project_conceptualisation_stage ON all_project.project_id = project_conceptualisation_stage.id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             LEFT JOIN project_aggrement_stage ON project_aggrement_stage.project_id = project_conceptualisation_stage.id 
             WHERE all_project.project_id IS NOT NULL AND sent_to='".$user_id."' group by project_delayed_communication.project_id order by project_delayed_communication.id DESC; ");
        //echo $this->db->last_query(); die;
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    


   function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }


    function get_stakeholder_communication_area($project_id,$user_id){
        $query = $this->db->query("select communication.*,t4.firstname as sent_to_first_name,t4.lastname as sent_to_last_name from project_delayed_communication delay 
            left join (
                Select t1.*,t2.firstname as sent_by_first_name,t2.lastname as sent_by_last_name
             from project_delayed_communication t1
             left join organization_user_details t2 on t1.sent_by=t2.user_id
                ) communication
                on communication.id = delay.id
                left join organization_user_details t4 on delay.sent_to=t4.user_id
             where delay.project_id='".$project_id."' AND (delay.sent_to='".$user_id."' OR delay.sent_by='".$user_id."') ORDER BY delay.id DESC;");

        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_stakeholder_not_seen_count($project_id,$user_id){
        $this->db->where('sent_to', $user_id);
        $this->db->where('project_id', $project_id);
        $this->db->where('seen_by_user', 'N');
        $query=$this->db->get('project_delayed_communication');
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_communication_last_status($project_id,$user_id){
        $this -> db -> select('seen_by_user');
        $this -> db -> from('project_delayed_communication');
         $this->db->where('sent_to', $user_id);
          $this->db->where('project_id', $project_id);
        $this->db->order_by('id', 'DESC');
        $query = $this -> db -> get();
        if($query->num_rows() > 0){
           $row = $query->row_array();
            return $row['seen_by_user'];
        } 
    }

    function get_stakeholder_delayed_project_details_data($project_id){
       
        
      
        $condition = "AND project_conceptualisation_stage.id='$project_id'"; 
      
        $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             Select *  from
(SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
            
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.project_id IS NOT NULL $condition");
       //echo $this->db->last_query(); die;
        return $query->result_array();
    }


    function get_stakeholder_delayed_project_details_till_date_data($project_id){
       
        
      
        $condition = "AND project_conceptualisation_stage.id='$project_id'"; 
      
        $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.project_activity_id,all_project.project_work_item_id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_pf_activities.particulars as activities_name,work_item_master.work_item_description as work_item_name,draft_mode from project_conceptualisation_stage 
            left join 
            (
             Select *  from
(SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id, project_activity_id, project_work_item_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY c.project_activity_id) as summary where Earned_Value<Planned_Value
            
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type
             LEFT JOIN project_pf_activities ON project_pf_activities.id = all_project.project_activity_id 
             LEFT JOIN work_item_master ON work_item_master.id = all_project.project_work_item_id 
             WHERE all_project.project_id IS NOT NULL $condition ORDER BY all_project.project_work_item_id;");
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function getSpecificdata($table,$field,$get_id,$specifc_field){
        $this->db->select($specifc_field);
        $this->db->from($table);
        $this->db->where($field, $get_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            return $row[$specifc_field];
        } 
   }


   function update_seen_by_status($project_id,$user_id,$updateData)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('sent_to', $user_id);
        $this->db->update('project_delayed_communication', $updateData);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }

    function organization_user_details($user_id){
        $this->db->select('t1.*,t2.designation');
        $this->db->from('organization_user_details t1');
         $this -> db ->join('user_designation_master t2', 't2.id = t1.designation_id ', 'left');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        //echo $this->db->last_query();die;
        return $result;
    }

   




}