<?php

class Userdashboard_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

	
//get role details
    public function login_roledata($role_id) {
      $this->db->select('*');
      $this->db->where('role_master.id', $role_id);
      $this->db->where('role_master.status', 'Y');
      $this->db->limit('1');
      $query = $this->db->get('role_master');
      return $query->result_array();
    }	
//get user details	
	function get_user_details($userId){

        $this->db->select('organization_user_details.*,user_designation_master.designation');
        $this->db->from('organization_user_details');
        $this->db->join('user', 'user.id = organization_user_details.user_id','left');
        $this->db->join('user_designation_master', 'user_designation_master.id = organization_user_details.designation_id','left');
        $this->db->where('user.id', $userId);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $result = $query->result_array();
        return $result;
    }
	
	    public function get_peoject_rejected_data($user_id)
    {

        $query = $this->db->query(" select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type from project_conceptualisation_stage left join (
 SELECT id as project_id,approve_status, 'Project Conceptualisation' as stage,'1' as stage_id FROM project_conceptualisation_stage WHERE approve_status ='R' UNION 
 SELECT project_id,approve_status, 'Project Preparation' as stage,'2' as stage_id FROM project_preparation_stage WHERE approve_status='R' UNION 
 SELECT project_id,approve_status, 'Project Pre Tender' as stage,'3' as stage_id FROM project_pre_tender_stage WHERE approve_status='R' UNION 
 SELECT project_id,approve_status, 'Project Tender' as stage,'4' as stage_id FROM project_tender_stage WHERE approve_status='R' UNION 
 SELECT project_id,approve_status, 'Project Aggrement' as stage,'5' as stage_id FROM project_aggrement_stage WHERE approve_status='R') all_project ON all_project.project_id=id LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.project_area LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type WHERE all_project.approve_status='R' and project_conceptualisation_stage.project_creator_id=".$user_id." ");
       //echo  $this->db->last_query(); die();
        $result = $query->result();
        return $result;
    }
	
	    public function get_peoject_pending_data($user_id)
    {
        $query = $this->db->query(" select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type from project_conceptualisation_stage left join (
 SELECT id as project_id,approve_status, 'Project Conceptualisation' as stage,'1' as stage_id FROM project_conceptualisation_stage WHERE approve_status='N' AND draft_mode='N' UNION 
 SELECT project_id,approve_status, 'Project Preparation' as stage,'2' as stage_id FROM project_preparation_stage WHERE approve_status='N' AND draft_mode='N' UNION 
 SELECT project_id,approve_status, 'Project Pre Tender' as stage,'3' as stage_id FROM project_pre_tender_stage WHERE approve_status='N' AND draft_mode='N' UNION 
 SELECT project_id,approve_status, 'Project Tender' as stage,'4' as stage_id FROM project_tender_stage WHERE approve_status='N' AND draft_mode='N' UNION 
 SELECT project_id,approve_status, 'Project Aggrement' as stage,'5' as stage_id FROM project_aggrement_stage WHERE approve_status='N' AND draft_mode='N') all_project ON all_project.project_id=id LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.project_area LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type WHERE all_project.approve_status='N' and project_conceptualisation_stage.approver_id=".$user_id." ");
        //echo  $this->db->last_query(); die();
        $result = $query->result();
        return $result;
    }
	
	

    public function get_project_history_data( $project_id,$stage_id ){

        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_step_no', $stage_id);
        $this->db->order_by('id ', 'DESC');
        $query = $this->db->get('project_approval');

        //echo $this->db->last_query(); die;
        return $query->result_array();

    }
	
	   public function get_user_type($user_id){
        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['user_type'];
    }


	
	    public function get_level3_details( $user_id){
        $this->db->select('*');

        $this->db->join('organization_user_details', 'user.id = organization_user_details.user_id', 'LEFT');

        $this->db->where('user.id', $user_id);
        $query = $this->db->get('user');
        //echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	
    public function get_planning_project_list($approver_id)
    {

        
        $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.project_area,project_conceptualisation_stage.project_type');

        //$this->db->where('project_detail.status', 'N');
        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        $this->db->where('project_aggrement_stage.approve_status', 'Y');
        $this->db->where('project_aggrement_stage.planning_incharge_user_id', $approver_id);
        $query = $this->db->get('project_conceptualisation_stage');
       // echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	
    function get_pf_planning_project_list($user_id){
      $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.aa_date,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.project_area,project_conceptualisation_stage.project_type');

        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
        $this->db->where('project_aggrement_stage.approve_status', 'Y');
        $this->db->where('project_aggrement_stage.planning_incharge_user_id', $user_id);
        $query = $this->db->get('project_conceptualisation_stage');
       // echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	    public function get_project_area($area_id = Null)
    {
        $this->db->select('area_master.*');
        if (!empty($area_id)) {
            $this->db->where('area_master.id', $area_id);
        }
        $this->db->where('area_master.status', 'Y');
        $query = $this->db->get('area_master');
        return $query->result_array();
    }
	
	   public function get_project_type($type_id = Null)
    {
        $this->db->select('project_type_master.*');
        if (!empty($type_id)) {
            $this->db->where('project_type_master.id', $type_id);
        }
        $this->db->where('project_type_master.status', 'Y');
        $query = $this->db->get('project_type_master');
        return $query->result_array();
    }
	
	
    function get_pip_preparation_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_name,t1.project_code,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name,"Project Identified Stackholders" as stage,"2" as stage_id');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.project_area ', 'left');
        $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_preparation_stage)');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db -> where('t1.project_creator_id', $user_id);
         //$this -> db -> or_where('t1.approver_id', $user_id);
        //$this->db->where("(t1.project_creator_id=".$user_id." OR t1.approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_pp_dpr_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_code,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Planning / DPR" as stage,"3" as stage_id');
        $this->db->from('project_preparation_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_dpr_stage)');
        $this->db->where("t2.project_creator_id=".$user_id."");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_administrative_approval_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_code,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Administrative Approval" as stage,"3" as stage_id');
        $this->db->from('project_dpr_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
        $this->db->where("t2.project_creator_id=".$user_id."");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_pp_pre_construction_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_code,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Pre Construction Activities" as stage,"3" as stage_id');
        $this->db->from('project_administrative_approval_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM pre_construction_settings)');
        $this->db->where("t2.project_creator_id=".$user_id."");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }
	
	 function get_pp_pre_tender_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_code,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Project Pre Tender" as stage,"3" as stage_id');
        $this->db->from('project_preparation_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
		$this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_pre_tender_stage)');
        $this->db->where("(t2.project_creator_id=".$user_id." OR t1.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_tender_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Tender Publishing" as stage,"5" as stage_id');
        $this->db->from('project_administrative_approval_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_tender_stage)');
        $this->db->where("t2.project_creator_id=".$user_id."");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

	
    function get_pp_agreement_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_code,t5.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name,"Project Aggrement" as stage,"5" as stage_id');
        $this->db->from('project_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.project_area ', 'left');
        $this -> db ->join('project_preparation_stage t5', 't5.project_id = t1.project_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_aggrement_stage)');
        $this->db->where("(t2.project_creator_id=".$user_id." OR t5.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

	    function count_data_against_project($tbl,$field1,$value1,$field2,$value2){
      $this->db->where($field1, $value1);
      $this->db->where($field2, $value2);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }
   

}
?>