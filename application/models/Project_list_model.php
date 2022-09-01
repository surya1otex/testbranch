<?php

class Project_list_model extends CI_Model
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


    // function get_project_conceptualisation_data($user_id){
    //     $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
    //     $this -> db ->join('project_creation pc', 'pc.id = t1.proj_rel_id ', 'left');
    //     $this -> db -> from('project_conceptualisation_stage t1');
    //     $this -> db ->join('project_type_master t2', 't2.id = pc.cat_id ', 'left');
    //     $this -> db ->join('area_master t3', 't3.id = pc.location ', 'left');

    //     $this->db->where("(t1.project_creator_id='".$user_id."') OR (t1.approver_id='".$user_id."' AND t1.draft_mode='N')", NULL, FALSE);
    //     $this -> db -> order_by('t1.id', 'DESC');
    //     $query = $this -> db -> get();
    //     if($query -> num_rows() >= 1){ return $query->result(); }
    //     else{ return false; }
    // }

    

    function get_project_conceptualisation_data($user_id,$circle_id,$division_id){

        if($circle_id == 0 && $division_id == 0){
            $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            //$this->db->where("(t1.draft_mode='N')", NULL, FALSE);
           
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
         }
        elseif($circle_id && $division_id){

             $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            //$this->db->where("(t1.draft_mode='N')", NULL, FALSE);
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> where('t1.division_id' , $division_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }
        else{

             $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
           // $this->db->where("(t1.draft_mode='N')", NULL, FALSE);
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }
    }


function get_project_creation_data($user_id,$circle_id,$division_id){


   if($circle_id == 0 && $division_id == 0){
        $this -> db -> select('t1.project_name,t1.id,t2.project_type as project_type_name,t3.name as area_name');
        $this -> db -> from('project_creation t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        $this -> db ->join('project_conceptualisation_stage t4', 't4.proj_rel_id = t1.id ', 'left');
        
       //$this -> db -> where('t1.entered_by', $user_id);
        $this -> db ->where('t1.id NOT IN(SELECT proj_rel_id FROM project_conceptualisation_stage)');

        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

   }
    elseif($circle_id && $division_id){
        $this -> db -> select('t1.project_name,t1.id,t2.project_type as project_type_name,t3.name as area_name');
        $this -> db -> from('project_creation t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        $this -> db ->join('project_conceptualisation_stage t4', 't4.proj_rel_id = t1.id ', 'left');
        //$this -> db -> where('t1.entered_by', $user_id);
        $this -> db ->where('t1.id NOT IN(SELECT proj_rel_id FROM project_conceptualisation_stage)');
        $this -> db -> where('t4.wing_id' , $circle_id);
        $this -> db -> where('t4.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }

     else{
         $this -> db -> select('t1.project_name,t1.id,t2.project_type as project_type_name,t3.name as area_name');
        $this -> db -> from('project_creation t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        $this -> db ->join('project_conceptualisation_stage t4', 't4.proj_rel_id = t1.id ', 'left');
        //$this -> db -> where('t1.entered_by', $user_id);
         $this -> db ->where('t1.id NOT IN(SELECT proj_rel_id FROM project_conceptualisation_stage)');
       $this -> db -> where('t4.wing_id' , $circle_id);
      
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }

       //  $this -> db -> select('t1.project_name,t1.id,t2.project_type as project_type_name,t3.name as area_name');
       //  $this -> db -> from('project_creation t1');
       //  $this -> db ->join('project_type_master t2', 't2.id = t1.cat_id ', 'left');
       //  $this -> db ->join('area_master t3', 't3.id = t1.location ', 'left');
        
       // // $this -> db -> where('t1.entered_by', $user_id);
       //  $this -> db ->where('t1.id NOT IN(SELECT proj_rel_id FROM project_conceptualisation_stage)');
       //  $this -> db -> order_by('t1.id', 'DESC');
       //  $query = $this -> db -> get();
       //  if($query -> num_rows() >= 1){ return $query->result(); }
       //  else{ return false; }
    }


    function get_all_steps_projects_list_data_old($user_id,$tbl){
        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.project_area ', 'left');
        // $this -> db -> where('t1.project_creator_id', $user_id);
        // $this -> db -> or_where('t1.approver_id', $user_id);
        $this->db->where("(t1.project_creator_id=".$user_id." OR t1.approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }



    function get_pip_dpr_pending_projects_list_data($user_id,$circle_id,$division_id){
        
        if($circle_id == 0 && $division_id == 0){


        $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_dpr_stage)');
        $this -> db -> where('t1.approve_status', 'Y');
        //$this -> db -> where('t1.project_creator_id', $user_id);
        
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }

        elseif($circle_id && $division_id){

            $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
            
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_dpr_stage)');
            $this -> db -> where('t1.approve_status', 'Y');
            //$this -> db -> where('t1.project_creator_id', $user_id);
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> where('t1.division_id' , $division_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
          
           
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }

        else{

            $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
            
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_dpr_stage)');
            $this -> db -> where('t1.approve_status', 'Y');
            //$this -> db -> where('t1.project_creator_id', $user_id);
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
          
           
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

        // $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        // $this -> db -> from('project_conceptualisation_stage t1');
        // $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        // $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        // $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_dpr_stage)');
        // $this -> db -> where('t1.approve_status', 'Y');
        // $this -> db -> where('t1.project_creator_id', $user_id);
        
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();
      
       
        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }


    function get_pip_dpr_list_data($user_id,$circle_id,$division_id){

        if($circle_id == 0 && $division_id == 0){

            $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
            $this->db->from('project_dpr_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
           
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
          
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

        elseif($circle_id && $division_id){

            $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
            $this->db->from('project_dpr_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
            $this -> db -> where('t2.wing_id' , $circle_id);
            $this -> db -> where('t2.division_id' , $division_id);
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
          
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

        else{
            $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
            $this->db->from('project_dpr_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
            $this -> db -> where('t2.wing_id' , $circle_id);
          
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
          
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }

        // $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        // $this->db->from('project_dpr_stage t1');
        // $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        // $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        // $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
       
        // $this->db->where("(t2.project_creator_id=".$user_id.")");
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();
      
        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }


    function get_pip_pre_construction_pending_projects_list_data($user_id,$circle_id,$division_id){


        if($circle_id == 0 && $division_id == 0){
        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_administrative_approval_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM pre_construction_settings)');
        
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }


     elseif($circle_id && $division_id){

        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_administrative_approval_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM pre_construction_settings)');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> where('t2.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

     }

     else{

        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_administrative_approval_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM pre_construction_settings)');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

     }
        // $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        // $this->db->from('project_administrative_approval_stage t1');
        // $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        // $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        // $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //  $this -> db -> where('t1.approve_status', 'Y');
        // $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM pre_construction_settings)');
        // $this->db->where("t2.project_creator_id=".$user_id."");
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();
      
       
        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }


   function get_pip_pre_construction_list_data($user_id,$circle_id,$division_id){

    if($circle_id == 0 && $division_id == 0){

        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('pre_construction_settings t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

    }

     elseif($circle_id && $division_id){

        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('pre_construction_settings t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> where('t2.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

     }

     else{

         $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('pre_construction_settings t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

     }
       //  $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
       //  $this->db->from('pre_construction_settings t1');
       //  $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
       //  $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
       //  $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        
       //  $this->db->where("t2.project_creator_id=".$user_id." ");
       //  $this -> db -> where('t2.project_status', '1');
       //  $this -> db -> order_by('t1.id', 'DESC');
       //  $query = $this -> db -> get();
      
       // //echo  $this->db->last_query(); die();
       //  if($query -> num_rows() >= 1){ return $query->result(); }
       //  else{ return false; }
    }



    function get_pip_administrative_pending_projects_list_data($user_id,$circle_id,$division_id){

        if($circle_id == 0 && $division_id == 0){

        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_dpr_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }

        elseif($circle_id && $division_id){

        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_dpr_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> where('t2.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }
        else{


            $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_dpr_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }

        // $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        // $this->db->from('project_dpr_stage t1');
        // $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        // $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        // $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //  $this -> db -> where('t1.approve_status', 'Y');
        // $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
        // $this->db->where("t2.project_creator_id=".$user_id."");
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();
      
        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }


     function get_pip_administrative_list_data($user_id,$circle_id,$division_id){

        if($circle_id == 0 && $division_id == 0){

            $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
            $this->db->from('project_administrative_approval_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
           
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();

            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

        elseif($circle_id && $division_id){

            $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
            $this->db->from('project_administrative_approval_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
            $this -> db -> where('t2.wing_id' , $circle_id);
            $this -> db -> where('t2.division_id' , $division_id);
           
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();

            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }
        }
        else{

            $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
            $this->db->from('project_administrative_approval_stage t1');
            $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
            
            $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
            $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
            //$this->db->where("(t2.project_creator_id=".$user_id.")");
            $this -> db -> where('t2.wing_id' , $circle_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();

            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

        // $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        // $this->db->from('project_administrative_approval_stage t1');
        // $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        
        // $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        // $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        // $this->db->where("(t2.project_creator_id=".$user_id.")");
       
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();

        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }


    function get_pip_preparation_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
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


    function get_pip_preparation_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_preparation_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //$this -> db -> where('t2.organization_id', $organization_id);
        // $this -> db -> where('t2.project_creator_id', $user_id);
        // $this -> db -> or_where('t2.approver_id', $user_id);
        $this->db->where("(t2.project_creator_id=".$user_id.") OR ( t1.project_approver_id=".$user_id." AND t1.draft_mode='N')");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_pre_tender_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t1.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_preparation_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_pre_tender_stage)');
        $this->db->where("(t2.project_creator_id=".$user_id." OR t1.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

    function get_pp_pre_tender_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t5.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        $this->db->from('project_pre_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db ->join('project_preparation_stage t5', 't5.project_id = t1.project_id ', 'left');
        // $this -> db -> where('t2.project_creator_id', $user_id);
        // $this -> db -> or_where('t2.approver_id', $user_id);
        $this->db->where("(t2.project_creator_id=".$user_id." OR t5.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_tender_pending_projects_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t5.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_pre_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db ->join('project_preparation_stage t5', 't5.project_id = t1.project_id ', 'left');
         $this -> db -> where('t1.approve_status', 'Y');
        $this -> db ->where('t1.project_id NOT IN(SELECT project_id FROM project_tender_stage)');
        $this->db->where("(t2.project_creator_id=".$user_id." OR t5.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_tender_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t5.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db ->join('project_preparation_stage t5', 't5.project_id = t1.project_id ', 'left');
        // $this -> db -> where('t2.project_creator_id', $user_id);
        // $this -> db -> or_where('t2.approver_id', $user_id);
        $this->db->where("(t2.project_creator_id=".$user_id." OR t5.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    /* end tender */


    function get_pp_agreement_pending_projects_list_data($user_id){
        
        
        $query = $this->db->query("select all_project.project_id,project_conceptualisation_stage.project_name,project_code, all_project.approval_status,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT project_id,approval_status FROM tendering_issue_of_loa 
             WHERE approval_status='Y'
            ) all_project 
             ON all_project.project_id=id 
             
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type  
             WHERE all_project.approval_status='Y'");
        //echo $this->db->last_query(); die;
         if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_pp_agreement_list_data($user_id){
        $this -> db -> select('t1.project_id,t2.project_name,t5.project_approver_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name');
        $this->db->from('project_aggrement_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        $this -> db ->join('project_preparation_stage t5', 't5.project_id = t1.project_id ', 'left');
        // $this -> db -> where('t2.project_creator_id', $user_id);
        // $this -> db -> or_where('t2.approver_id', $user_id);
        $this->db->where("(t2.project_creator_id=".$user_id." OR t5.project_approver_id=".$user_id.")");
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
       //echo  $this->db->last_query(); die();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

    }

  function project_wise_settingData($project_id){
      
      $this->db->select('*');
        $this->db->from('pre_construction_settings');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $return = $query->num_rows();
        //echo  $this->db->last_query(); die();
        return $return;
      
      
  }

    function checkifsettingenable($project_id) {
     $query = $this->db->query("select * from pre_construction_settings WHERE 'Y' IN(land_schedule, govt_land_alienation,private_land_direct_purchase,private_land_acquisition,forest_land,
        tree_cutting,environmental_clearance,utility_shifting_electrical,utility_shifting_PH,utility_shifting_RWSS,encroachment_eviction) AND project_id='".$project_id."'");
        
        $result = $query->num_rows();
        return $result;

  }
  
    function get_pip_tender_publishing_projects_list_data($user_id,$circle_id,$division_id){


 if($circle_id == 0 && $division_id == 0){
        $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_tender_stage)');
        $this -> db -> where('t1.approve_status', 'Y');
        
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
       
       }
       elseif($circle_id && $division_id){

        $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_tender_stage)');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> where('t1.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
       }

       else{

         $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_tender_stage)');
        $this -> db -> where('t1.approve_status', 'Y');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
      
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
       }

        // $this -> db -> select('t1.project_name,t1.id as project_id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t2.project_type,t3.name as area_name');
        
        // $this -> db -> from('project_conceptualisation_stage t1');
        // $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        // $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        // $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_tender_stage)');
        // $this -> db -> where('t1.approve_status', 'Y');
        // $this -> db -> where('t1.project_creator_id', $user_id);
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();
      
        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }
    
    
   function get_pip_tender_publishing_list_data($user_id,$circle_id,$division_id){

   if($circle_id == 0 && $division_id == 0){
        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        $this->db->from('project_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //$this->db->where("(t2.project_creator_id=".$user_id.")"); 
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();

        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }
     elseif($circle_id && $division_id){
         $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        $this->db->from('project_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //$this->db->where("(t2.project_creator_id=".$user_id.")"); 
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> where('t2.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();

        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }

     else{

        $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        $this->db->from('project_tender_stage t1');
        $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
        $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        //$this->db->where("(t2.project_creator_id=".$user_id.")"); 
        $this -> db -> where('t2.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();

        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }

        // $this -> db -> select('t1.project_id,t2.project_name,t2.project_creator_id as approver_id,t2.project_creator_id,t1.approve_status,t1.draft_mode,t2.estimate_total_cost,t3.project_type,t4.name as area_name,');
        // $this->db->from('project_tender_stage t1');
        // $this -> db -> join('project_conceptualisation_stage t2','t2.id = t1.project_id','left');
       
        // $this -> db ->join('project_type_master t3', 't3.id = t2.project_type ', 'left');
        // $this -> db ->join('area_master t4', 't4.id = t2.location_id ', 'left');
        
        // $this->db->where("(t2.project_creator_id=".$user_id.")");
        
        // $this -> db -> order_by('t1.id', 'DESC');
        // $query = $this -> db -> get();

        // if($query -> num_rows() >= 1){ return $query->result(); }
        // else{ return false; }
    }

    function project_specific_data($table,$field,$get_id,$specifc_field){
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








}