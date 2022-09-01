<?php

class Published_tender_model extends CI_Model
{

    function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    /* common function for get organization id */

 
    public function published_project_lists($user_id)
    {
        // $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
        //     left join 
        //     (
        //      SELECT project_id,approval_status FROM project_approval 
        //      WHERE approval_status='Y' AND project_step_no='6'
        //     ) all_project 
        //      ON all_project.project_id=id 
        //      LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
        //      LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
        //      WHERE all_project.approval_status='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");

        $query = $this->db->query("select all_project.project_id,project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM project_approval 
             WHERE approval_status='Y' AND project_step_no='6'
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approval_status='Y'");
        
        $result = $query->result();
        return $result;
    }

    //  public function published_project_lists($user_id)
    // {
    //     $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
    //         left join 
    //         (
    //          SELECT project_id,approval_status FROM project_approval 
    //          WHERE approval_status='Y' AND project_step_no='6'
    //         ) all_project 
    //          ON all_project.project_id=id 
    //          LEFT JOIN project_creation ON project_creation.id = project_conceptualisation_stage.proj_rel_id
    //          LEFT JOIN area_master ON area_master.id = project_creation.location
    //          LEFT JOIN project_type_master ON project_type_master.id = project_creation.cat_id 
    //          WHERE all_project.approval_status='Y' and project_conceptualisation_stage.approver_id=".$user_id." ");
        
    //     $result = $query->result();
    //     return $result;
    // }



    /* end for get organization id */ 
	
	 /* Technical Evalution project list start */

 
  public function technical_evalution_project_lists($user_id)
    {
        $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM tendering_pre_bid 
             WHERE approval_status='Y' 
            ) all_project 
             ON all_project.project_id=id 
             
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type  
             WHERE all_project.approval_status='Y'");
        //echo $this->db->last_query(); die;
        $result = $query->result();
        return $result;
    }


    /* end for Technical Evalution project list */
	
	
	
	 /* Financial Evalution project list start */

 
   public function finacial_evalution_project_lists($user_id)
    {
        $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM tendering_technical_evalution 
             WHERE approval_status='Y' 
            ) all_project 
             ON all_project.project_id=id 
             
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approval_status='Y'");
        //echo $this->db->last_query(); die;
        $result = $query->result();
        return $result;
    }


    /* end for Financial Evalution project list */
	
	
	
	 /* Negotiation project list start */

 
   public function negotiation_project_lists($user_id)
    {
        $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM tendering_financial_evalution 
             WHERE approval_status='Y' 
            ) all_project 
             ON all_project.project_id=id 
             
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approval_status='Y' ");
        //echo $this->db->last_query(); die;
        $result = $query->result();
        return $result;
    }


    /* end for Negotiation project list */
	 /* Issue of LoA project list start */

 
   public function issue_loa_project_lists($user_id)
    {
        $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM tendering_negotiation 
             WHERE approval_status='Y' 
            ) all_project 
             ON all_project.project_id=id
              
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.approval_status='Y' ");
        //echo $this->db->last_query(); die;
        $result = $query->result();
        return $result;
    }


    /* end for Issue of LoA project list */

    
    function fetchSingledata($tbl, $fid, $did)
    {
        $this -> db -> select('*');
        $this -> db -> from($tbl);
        $this -> db -> where($fid, $did);
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }




}