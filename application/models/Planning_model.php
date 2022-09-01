<?php

class Planning_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }
	
	
    public function get_planning_project_list($approver_id)
    {

        
        $this->db->select('project_conceptualisation_stage.id,project_conceptualisation_stage.project_code,project_conceptualisation_stage.project_name, project_conceptualisation_stage.project_group,project_conceptualisation_stage.project_sector,
        project_conceptualisation_stage.project_destination,project_conceptualisation_stage.project_area,project_conceptualisation_stage.project_type');

        //$this->db->where('project_detail.status', 'N');
        $this->db->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id', 'LEFT');
		$this->db->where('project_aggrement_stage.approve_status', 'Y');
        $this->db->where('project_aggrement_stage.planning_incharge_user_id', $approver_id);
        $query = $this->db->get('project_conceptualisation_stage');
       // echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	 /*Get project  area*/
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
    /*Get project area End*/

    /*Get project destination*/
    public function get_project_destination($area_id)
    {
        $this->db->select('destination_master.*');
        $this->db->where('destination_master.area_id', $area_id);
        $this->db->where('destination_master.status', 'Y');
        $query = $this->db->get('destination_master');
        return $query->result_array();
    }

    /*Get project destination End*/
	
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
	
	
	    public function project_details( $project_id ){
        $this->db->select('*');
        $this->db->where('id', $project_id);
        $query = $this->db->get('project_conceptualisation_stage');
        return $query->result_array();
    }
	    public function get_project_aggrement_details( $project_id ){
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_aggrement_stage');
        return $query->result_array();
    }
	
	     public function check_dupliacte_milestone_project( $project_id,$milestone_name ){

         $this->db->select('count(id) as total');
         $this->db->where('project_id', $project_id);
         $this->db->where('milestone', $milestone_name);
         $query = $this->db->get('project_milestone');
         return $query->result_array();
     }
	 
	  function add($table, $data)
    {
        $this->db->insert($table, $data);
		//echo $this->db->last_query(); die;
        return $this->db->insert_id();
    }
	    public function get_project_milestone( $project_id){
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_milestone');
        return $query->result_array();
    }
	    public function check_total_milestone_weightage( $project_id){
        $this->db->select('SUM(weightage) weightage');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_milestone');
		// echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	
	    public function check_total_milestone_weightageEDIT( $project_id,$milestone_id){
        $this->db->select('SUM(weightage) weightage');
        $this->db->where('project_id', $project_id);
        $this->db->where('id!=', $milestone_id);
        $query = $this->db->get('project_milestone');
		//echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
		public function milestone_deatails($project_id,$milestone_id){
        $this->db->select('*');
        $this->db->where('id', $milestone_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_milestone');
        return $query->result_array();
    }
	
	
	     public function check_dupliacte_milestone_activity( $project_id,$milestone_id,$activity_name ){

         $this->db->select('count(id) as total');
         $this->db->where('milstone_id', $milestone_id);
         $this->db->where('project_id', $project_id);
         $this->db->where('particulars', $activity_name);
         $query = $this->db->get('project_activities');
		 
		//echo $this->db->last_query(); die;
         return $query->result_array();
     }
	 
	 
	    public function check_total_milestoneActivity_weightage( $project_id,$milestone_id){
        $this->db->select('SUM(weightage) weightage');
        $this->db->where('project_id', $project_id);
        $this->db->where('milstone_id', $milestone_id);
        $query = $this->db->get('project_activities');
		// echo $this->db->last_query(); die;
        return $query->result_array();
    }
	
	    public function check_total_milestoneActivity_weightageEDIT( $project_id,$milestone_id,$activity_id){
        $this->db->select('SUM(weightage) weightage');
        $this->db->where('project_id', $project_id);
        $this->db->where('milstone_id', $milestone_id);
        $this->db->where('id!=', $activity_id);
        $query = $this->db->get('project_activities');
		// echo $this->db->last_query(); die;
        return $query->result_array();
    }

	    public function get_milestone_activity( $project_id,$milestone_id){
        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $this->db->where('milstone_id', $milestone_id);
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
   
	     public function milestone_activity_cnt( $project_id,$milestone_id){

         $this->db->select('count(id) as total_activitycnt');
         $this->db->where('milstone_id', $milestone_id);
         $this->db->where('project_id', $project_id);
         $query = $this->db->get('project_activities');
		 
		//echo $this->db->last_query(); die;
         return $query->result_array();
     }
	     public function milestone_activity_maxenddate( $project_id,$milestone_id){

         $this->db->select('MAX(end_date) as milestone_enddate');
         $this->db->where('milstone_id', $milestone_id);
         $this->db->where('project_id', $project_id);
         $query = $this->db->get('project_activities');
		 
		//echo $this->db->last_query(); die;
         return $query->result_array();
     }
	 
	 
    /*For Any Update Query*/
    function updateDataCondition($tableName, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($tableName, $data);
       //echo $this->db->last_query().'<br><br>';die;
        return TRUE;
    }
	
	
	     public function check_dupliacte_milestone_projectEDIT( $project_id,$milestone_id,$milestone_name ){

         $this->db->select('count(id) as total');
         $this->db->where('id !=', $milestone_id);
         $this->db->where('project_id', $project_id);
         $this->db->where('milestone', $milestone_name);
         $query = $this->db->get('project_milestone');
        //echo $this->db->last_query().'<br><br>';die;
         return $query->result_array();
     }
	 
	  function deleteRecord($tableName, $deleteClause)
    {
        $this->db->delete($tableName, $deleteClause);
    }
	
		public function get_activity_details($project_id,$milestone_id,$activity_id){
        $this->db->select('*');
        $this->db->where('id', $activity_id);
        $this->db->where('milstone_id', $milestone_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get('project_activities');
        return $query->result_array();
    }
	

	 
	     public function check_dupliacte_milestone_activityEDIT( $project_id,$milestone_id,$activity_id,$activity_name ){

         $this->db->select('count(id) as total');
         $this->db->where('id !=', $activity_id);
         $this->db->where('milstone_id', $milestone_id);
         $this->db->where('project_id', $project_id);
         $this->db->where('particulars', $activity_name);
         $query = $this->db->get('project_activities');
         return $query->result_array();
		 
		 
		 }

	
}

?>
