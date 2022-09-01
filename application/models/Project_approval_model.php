<?php

class Project_approval_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    /* common function for get organization id */

 
    public function getOrganization_Users_OrganizationId($user_id){
        $user_id = (int)$user_id;
        $this->db->select('organization_id');
        $this->db->from('organization_user_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['organization_id'];
    }


    /* end for get organization id */


    
    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function fetchSingledata2($tbl, $fid, $did,$fid1, $did1)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $this -> db -> where($fid1, $did1);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

     /*Insert data to the database and return id*/
    function insertDatareturnid($data = array(), $tbl){
        $insert = $this->db->insert($tbl, $data);
        $insert_id = $this->db->insert_id();
        if($insert){ return  $insert_id; }
        else{ return false; }
    }

    function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }

     /*get Specific field data*/
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

     /*Check Field value exist or not in specific table*/
    function check_field_value_exist_or_not_in_tbl($tbl,$field1,$value1){
      $this->db->where($field1, $value1);
      $query=$this->db->get($tbl);
      $num_rows = $query->num_rows();
      return $num_rows;
    }


      /*Update data to database common function*/
    function updateData($fid, $tbl, $data, $uid)
    {
        $this->db->where($fid, $uid);
        $this->db->update($tbl, $data);
        if( $this->db->affected_rows() == 1 ) { return TRUE; }
        else{ return FALSE; }
    }

     /*Fetch data From the database common function*/
    function fetchAllData($tbl, $id = NULL, $tp = NULL)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this->db->order_by($id, $tp);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_peoject_details_data($project_id){
        $this -> db -> select('t1.project_name,t1.id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db -> where('t1.id', $project_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    public function get_peoject_approval_data($user_id,$circle_id,$division_id) {

     if($circle_id == 0 && $division_id == 0){
        $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (SELECT id as project_id,approve_status, 'Concept Creation' as stage,'1' as stage_id FROM project_conceptualisation_stage 
             WHERE approve_status!='Y' 
             AND draft_mode='N' 
             
             UNION 
             SELECT project_id,approve_status, 'Project DPR' as stage,'3' as stage_id FROM project_dpr_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Pre Construction Activities' as stage,'4' as stage_id FROM pre_construction_settings 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Administrative Approval' as stage,'5' as stage_id FROM project_administrative_approval_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Tender Publishing' as stage,'6' as stage_id FROM project_tender_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approve_status!='Y' ");
        
        $result = $query->result();
        return $result;

      }
      elseif($circle_id && $division_id){

        $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (SELECT id as project_id,approve_status, 'Concept Creation' as stage,'1' as stage_id FROM project_conceptualisation_stage 
             WHERE approve_status!='Y' 
             AND draft_mode='N' 
             
             UNION 
             SELECT project_id,approve_status, 'Project DPR' as stage,'3' as stage_id FROM project_dpr_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Pre Construction Activities' as stage,'4' as stage_id FROM pre_construction_settings 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Administrative Approval' as stage,'5' as stage_id FROM project_administrative_approval_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Tender Publishing' as stage,'6' as stage_id FROM project_tender_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approve_status!='Y' and project_conceptualisation_stage.wing_id=".$circle_id." and project_conceptualisation_stage.division_id=".$division_id." ");
        
        $result = $query->result();
        return $result;
      }

      else{

        $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (SELECT id as project_id,approve_status, 'Concept Creation' as stage,'1' as stage_id FROM project_conceptualisation_stage 
             WHERE approve_status!='Y' 
             AND draft_mode='N' 
             
             UNION 
             SELECT project_id,approve_status, 'Project DPR' as stage,'3' as stage_id FROM project_dpr_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Pre Construction Activities' as stage,'4' as stage_id FROM pre_construction_settings 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Administrative Approval' as stage,'5' as stage_id FROM project_administrative_approval_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
             UNION 
             SELECT project_id,approve_status, 'Project Tender Publishing' as stage,'6' as stage_id FROM project_tender_stage 
             WHERE approve_status!='Y' AND draft_mode='N'
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approve_status!='Y' and project_conceptualisation_stage.wing_id=".$circle_id." ");
        
        $result = $query->result();
        return $result;
      }
        // $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
        //     left join 
        //     (SELECT id as project_id,approve_status, 'Concept Creation' as stage,'1' as stage_id FROM project_conceptualisation_stage 
        //      WHERE approve_status!='Y' 
        //      AND draft_mode='N' 
             
        //      UNION 
        //      SELECT project_id,approve_status, 'Project DPR' as stage,'3' as stage_id FROM project_dpr_stage 
        //      WHERE approve_status!='Y' AND draft_mode='N'
        //      UNION 
        //      SELECT project_id,approve_status, 'Project Pre Construction Activities' as stage,'4' as stage_id FROM pre_construction_settings 
        //      WHERE approve_status!='Y' AND draft_mode='N'
        //      UNION 
        //      SELECT project_id,approve_status, 'Project Administrative Approval' as stage,'5' as stage_id FROM project_administrative_approval_stage 
        //      WHERE approve_status!='Y' AND draft_mode='N'
        //      UNION 
        //      SELECT project_id,approve_status, 'Project Tender Publishing' as stage,'6' as stage_id FROM project_tender_stage 
        //      WHERE approve_status!='Y' AND draft_mode='N'
        //     ) all_project 
        //      ON all_project.project_id=id 
        //      LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
        //      LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
        //      LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
        //      WHERE all_project.approve_status!='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");
        
        // $result = $query->result();
        // return $result;
    }

    // public function get_peoject_approval_data($user_id)
    // {
    //     $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
    //         left join 
    //         (SELECT id as project_id,approve_status, 'Concept Creation' as stage,'1' as stage_id FROM project_conceptualisation_stage 
    //          WHERE approve_status!='Y' 
    //          AND draft_mode='N' 
             
    //          UNION 
    //          SELECT project_id,approve_status, 'Project DPR' as stage,'3' as stage_id FROM project_dpr_stage 
    //          WHERE approve_status!='Y' AND draft_mode='N'
    //          UNION 
    //          SELECT project_id,approve_status, 'Project Pre Construction Activities' as stage,'4' as stage_id FROM pre_construction_settings 
    //          WHERE approve_status!='Y' AND draft_mode='N'
    //          UNION 
    //          SELECT project_id,approve_status, 'Project Administrative Approval' as stage,'5' as stage_id FROM project_administrative_approval_stage 
    //          WHERE approve_status!='Y' AND draft_mode='N'
    //          UNION 
    //          SELECT project_id,approve_status, 'Project Tender Publishing' as stage,'6' as stage_id FROM project_tender_stage 
    //          WHERE approve_status!='Y' AND draft_mode='N'
    //         ) all_project 
    //          ON all_project.project_id=id 
    //          LEFT JOIN district_master ON district_master.id = project_conceptualisation_stage.project_destination 
    //          LEFT JOIN project_creation ON project_creation.id = project_conceptualisation_stage.proj_rel_id 
    //          LEFT JOIN area_master ON area_master.id = project_creation.location 
    //          LEFT JOIN project_type_master ON project_type_master.id = project_creation.cat_id 
    //          WHERE all_project.approve_status!='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");
        
    //     $result = $query->result();
    //     return $result;
    // }


    public function get_project_history_data( $project_id,$stage_id ){

        $this->db->select('*');
        $this->db->where('project_id', $project_id);
        $this->db->where('project_step_no', $stage_id);
        $this->db->order_by('id ', 'DESC');
        $query = $this->db->get('project_approval');

        //echo $this->db->last_query(); die;
        return $query->result_array();

    }

    public function get_level3_details( $user_id){
        $this->db->select('*');

        $this->db->join('organization_user_details', 'user.id = organization_user_details.user_id', 'LEFT');

        $this->db->where('user.id', $user_id);
        $query = $this->db->get('user');
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


    function get_user_details_by_user_id($user_id){
        $this->db->select('user_type');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $row = $query->row_array();
            $user_type_id = $row['user_type'];
        }

        if($user_type_id == 2){
			
        }elseif ($user_type_id == 3) {
          $this -> db -> select('email,mobile, CONCAT(firstname, '.', lastname) AS name');
        $this -> db -> from('organization_user_details');
        $this -> db -> where('user_id', $user_id);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ 
            return $query->result_array(); 
        }
        else{ return false; } 
        }
    }


    public function get_peoject_procurement_approval_data($user_id)
    {

        $query = $this->db->query("select all_project.project_id,project_name, all_project.approve_status,all_project.stage_id, all_project.stage,area_master.name as area_name,project_type_master.project_type from project_conceptualisation_stage left join ( SELECT project_id,approve_status, 'Project Pre Tender' as stage,'3' as stage_id FROM project_pre_tender_stage WHERE approve_status!='Y' AND draft_mode='N' UNION SELECT project_id,approve_status, 'Project Tender' as stage,'4' as stage_id FROM project_tender_stage WHERE approve_status!='Y' AND draft_mode='N' UNION SELECT project_id,approve_status, 'Project Agreement Stage' as stage ,'5' as stage_id FROM project_aggrement_stage WHERE approve_status!='Y' AND draft_mode='N') all_project ON all_project.project_id=id LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.project_area LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type WHERE all_project.approve_status!='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");
        //echo  $this->db->last_query(); die();
        $result = $query->result();
        return $result;
    }


    function get_project_progress_data($project_id,$stage_id){
        $query = $this->db->query("select IFNULL(approval_status, 'P') as progress from project_approval 
 WHERE project_id=".$project_id." and project_step_no=".$stage_id."");
        //echo  $this->db->last_query(); die();
        $result = $query->result_array();
        return $result;
    }





}