<?php

class Project_summary_list_model extends CI_Model {
    
      function __construct(){
      parent :: __construct();
      $this->load->database();
    }

    function get_total_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

     if($circle_id == 0){
        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }

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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }
    }



    function get_puri_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

       if($circle_id == 0){
        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id', '2');
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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id', '2');
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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id', '2');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

    }
        
    }


    function get_nonpuri_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

       
       if($circle_id == 0){

        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id!=', '2');
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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id!=', '2');
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
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.location_id!=', '2');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
       }

    }


    function get_circle1_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

      if($circle_id == 0){

         $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '1');
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }

elseif($circle_id && $division_id){
        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '1');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> where('t1.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

else{

        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t1.estimate_total_cost,t1.draft_mode,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '1');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }

    }


    function get_circle2_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

      

        if($circle_id == 0){

            $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
           if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
            }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
            $this -> db -> where('t1.wing_id=', '2');
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

        }

elseif($circle_id && $division_id){

    $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
           if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
            }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
            $this -> db -> where('t1.wing_id=', '2');
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> where('t1.division_id' , $division_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }

    }

 else{
         $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
            $this -> db -> from('project_conceptualisation_stage t1');
            $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
            $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
            $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
           if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
            }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
            $this -> db -> where('t1.wing_id=', '2');
            $this -> db -> where('t1.wing_id' , $circle_id);
            $this -> db -> order_by('t1.id', 'DESC');
            $query = $this -> db -> get();
            if($query -> num_rows() >= 1){ return $query->result(); }
            else{ return false; }   
        }
    }


    function get_division_project_data($division_id){

    $this -> db -> select('t1.project_name,t1.id,t1.estimate_total_cost,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
       
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');

        $this->db->where('t1.division_id', $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }


   }
    
  function get_circle3_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

        if($circle_id == 0){
            
         $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '3');
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

elseif($circle_id && $division_id){

     $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '3');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> where('t1.division_id' , $division_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

else{
        $this -> db -> select('t1.project_name,t1.id,t1.approver_id,t1.project_creator_id,t1.approve_status,t2.project_type,t3.name as area_name,t4.wing_name as circlename');
        $this -> db -> from('project_conceptualisation_stage t1');
        $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
        $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
        $this -> db ->join('wing_master t4', 't4.id = t1.wing_id ', 'left');
       if($project_group_id > 0){
            $this->db->where('t1.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('t1.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('t1.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('t1.wing_id', $project_wing_id);  
          }
          if($project_division_id > 0){
            $this->db->where('t1.division_id', $project_division_id);  
          }
        $this -> db -> where('t1.wing_id=', '3');
        $this -> db -> where('t1.wing_id' , $circle_id);
        $this -> db -> order_by('t1.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
          }

         
    }


    

    function get_closed_project_data(){

        $this -> db ->select('pcs.project_name,pcs.id,COUNT(uis.current_status) as closeissue');
        $this -> db ->from('project_conceptualisation_stage pcs');
        $this -> db ->join('update_status_issues uis', 'pcs.id = uis.project_id ', 'left');
       
        $this -> db -> where('uis.current_status', 'Y');
        $this -> db -> group_by('pcs.id');
        $this -> db -> order_by('uis.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }

     function get_open_project_data(){

        $this -> db ->select('pcs.project_name,pcs.id,COUNT(uis.current_status) as closeissue');
        $this -> db ->from('project_conceptualisation_stage pcs');
        $this -> db ->join('update_status_issues uis', 'pcs.id = uis.project_id ', 'left');
       
        $this -> db -> where('uis.current_status', 'N');
        $this -> db -> group_by('pcs.id');
        $this -> db -> order_by('uis.id', 'DESC');
        $query = $this -> db -> get();
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


   
function get_ongoing_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

    

   if($circle_id == 0){

        $this -> db -> select('project_conceptualisation_stage.id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode');
        $this -> db -> from('project_conceptualisation_stage ');
        $this -> db ->join('(Select  IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id GROUP BY project_id)all_project','all_project.project_id=id', 'left');
        $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id ', 'left');
        $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type  ', 'left');
        $this -> db ->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id ', 'left');


        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
    $this->db->where('project_aggrement_stage.approve_status', 'Y');
    $query = $this -> db -> get();
     if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
 
    }

elseif($circle_id && $division_id){


    $this -> db -> select('project_conceptualisation_stage.id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode');
    $this -> db -> from('project_conceptualisation_stage ');
    $this -> db ->join('(Select  IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id GROUP BY project_id)all_project','all_project.project_id=id', 'left');
    $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id ', 'left');
    $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type  ', 'left');
    $this -> db ->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id ', 'left');


        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
    $this->db->where('project_aggrement_stage.approve_status', 'Y');
    $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
    $this->db->where('project_conceptualisation_stage.division_id', $division_id);
    $query = $this -> db -> get();
     if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }


    }

else{

     $this -> db -> select('project_conceptualisation_stage.id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode');
    $this -> db -> from('project_conceptualisation_stage ');
    $this -> db ->join('(Select  IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id GROUP BY project_id)all_project','all_project.project_id=id', 'left');
    $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id ', 'left');
    $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type  ', 'left');
    $this -> db ->join('project_aggrement_stage', 'project_aggrement_stage.project_id = project_conceptualisation_stage.id ', 'left');


        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
    $this->db->where('project_aggrement_stage.approve_status', 'Y');
    $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
    $query = $this -> db -> get();
     if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


}


    function get_completed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){

    
    $condition = "";  
       
      if($project_group_id > 0){
        $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
      }
     if($project_category_id > 0){
        $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
      }
      if($project_area_id > 0){
        $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
      }
      if($project_wing_id > 0){
        $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
      }
      if($project_division_id > 0){
        $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
      }
        $query = $this->db->query("select all_project.project_id as id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
            left join 
            (
             SELECT a.project_id FROM project_completed_history a   
             WHERE 1=1
            
            ) all_project 
             ON all_project.project_id=id 
             LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
             LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
             WHERE all_project.project_id IS NOT NULL $condition");
        
        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
  

    }



    function get_planning_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){
        

         if($circle_id == 0){
            
            $this->db->select('t1.*,t2.project_type,t3.name as area_name');
              
            if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
              }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
              
              $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
              
              $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
              $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');

              $query = $this->db->get('project_conceptualisation_stage t1');
             
              if($query -> num_rows() >= 1){ return $query->result(); }
                else{ return false; }
         }
elseif($circle_id && $division_id){

     $this->db->select('t1.*,t2.project_type,t3.name as area_name');
              
            if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
              }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
              
              $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
              
              $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
              $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
               $this -> db -> where('t1.wing_id' , $circle_id);
               $this -> db -> where('t1.division_id' , $division_id);
              $query = $this->db->get('project_conceptualisation_stage t1');
             
              if($query -> num_rows() >= 1){ return $query->result(); }
                else{ return false; }

    }

else{
            $this->db->select('t1.*,t2.project_type,t3.name as area_name');
              
            if($project_group_id > 0){
                $this->db->where('t1.project_group', $project_group_id);  
              }
            if($project_category_id > 0){
                $this->db->where('t1.project_type', $project_category_id);  
              }
              if($project_area_id > 0){
                $this->db->where('t1.location_id', $project_area_id);  
              }
            if($project_wing_id > 0){
                $this->db->where('t1.wing_id', $project_wing_id);  
              }
              if($project_division_id > 0){
                $this->db->where('t1.division_id', $project_division_id);  
              }
              
              $this -> db ->where('t1.id NOT IN(SELECT project_id FROM project_administrative_approval_stage)');
              
              $this -> db ->join('project_type_master t2', 't2.id = t1.project_type ', 'left');
              $this -> db ->join('area_master t3', 't3.id = t1.location_id ', 'left');
               $this -> db -> where('t1.wing_id' , $circle_id);
              $query = $this->db->get('project_conceptualisation_stage t1');
             
              if($query -> num_rows() >= 1){ return $query->result(); }
                else{ return false; }
         }

    }

    function get_tendering_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){
       

       if($circle_id == 0){
                
     $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage');
       $this -> db ->join('(SELECT a.project_id,a.approve_status FROM project_tender_stage a LEFT JOIN project_aggrement_stage b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL
             UNION
            SELECT t1.project_id,t1.approve_status FROM  project_aggrement_stage  t1
            WHERE t1.approve_status="N")all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }

elseif($circle_id && $division_id){

    
       $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage');
       $this -> db ->join('(SELECT a.project_id,a.approve_status FROM project_tender_stage a LEFT JOIN project_aggrement_stage b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL
             UNION
            SELECT t1.project_id,t1.approve_status FROM  project_aggrement_stage  t1
            WHERE t1.approve_status="N")all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id); 
       $this->db->where('project_conceptualisation_stage.division_id', $division_id); 
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

    }
else{

    $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage');
       $this -> db ->join('(SELECT a.project_id,a.approve_status FROM project_tender_stage a LEFT JOIN project_aggrement_stage b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL
             UNION
            SELECT t1.project_id,t1.approve_status FROM  project_aggrement_stage  t1
            WHERE t1.approve_status="N")all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

        if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id); 
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
         }
    }


    function get_construction_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){
         

           if($circle_id == 0){

            $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,all_project.agreement_cost, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id,a.approve_status,a.agreement_cost FROM project_aggrement_stage a LEFT JOIN project_completed_history  b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

            }

elseif($circle_id && $division_id){
  
        $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,all_project.agreement_cost, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id,a.approve_status,a.agreement_cost FROM project_aggrement_stage a LEFT JOIN project_completed_history  b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
       $this->db->where('project_conceptualisation_stage.division_id', $division_id);
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

      
       }      

    else{

        $this -> db -> select('all_project.project_id as id,project_name,project_code, all_project.approve_status,all_project.agreement_cost, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id,a.approve_status,a.agreement_cost FROM project_aggrement_stage a LEFT JOIN project_completed_history  b on a.project_id = b.project_id  
             WHERE a.approve_status="Y" AND b.project_id IS NULL)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');

       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
       $this->db->where('all_project.approve_status', 'Y');
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
     }
    }


    function get_overview_completed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){
    

        if($circle_id == 0){
        $this -> db -> select('all_project.project_id as id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id FROM project_completed_history a   
             WHERE 1=1)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');
       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('all_project.project_id',!0);
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
        }

 elseif($circle_id && $division_id){
          
      $this -> db -> select('all_project.project_id as id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id FROM project_completed_history a   
             WHERE 1=1)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');
       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
       $this->db->where('project_conceptualisation_stage.division_id', $division_id);
       $this->db->where('all_project.project_id',!0);
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }

        }
else{

     $this -> db -> select('all_project.project_id as id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type');
       $this -> db -> from('project_conceptualisation_stage ');
       $this -> db ->join('(SELECT a.project_id FROM project_completed_history a   
             WHERE 1=1)all_project','all_project.project_id=id', 'left');
       $this -> db ->join('area_master', 'area_master.id = project_conceptualisation_stage.location_id', 'left');
       $this -> db ->join('project_type_master', 'project_type_master.id = project_conceptualisation_stage.project_type', 'left');
       if($project_group_id > 0){
            $this->db->where('project_conceptualisation_stage.project_group', $project_group_id);  
        }
        if($project_category_id > 0){
            $this->db->where('project_conceptualisation_stage.project_type', $project_category_id);  
          }
          if($project_area_id > 0){
            $this->db->where('project_conceptualisation_stage.location_id', $project_area_id);  
          }
        if($project_wing_id > 0){
            $this->db->where('project_conceptualisation_stage.wing_id', $project_wing_id);  
          }
        if($project_division_id > 0){
            $this->db->where('project_conceptualisation_stage.division_id', $project_division_id);  
          }
       $this->db->where('project_conceptualisation_stage.wing_id', $circle_id);
       $this->db->where('all_project.project_id',!0);
       $query = $this -> db -> get();
       if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
            
        }

    }


    function get_delayed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){


        if($circle_id == 0){

                 $condition = "";  
                   
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition1 = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition2 = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition3 = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition4 = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }

                  $conditiondata = $condition." ".$condition1." ".$condition2." ".$condition3." ".$condition4;
                    $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode from project_conceptualisation_stage 
                        left join 
                        (
                         Select *  from
            (SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
                        
                        ) all_project 
                         ON all_project.project_id=id 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         LEFT JOIN project_aggrement_stage ON project_aggrement_stage.project_id = project_conceptualisation_stage.id 
                         WHERE all_project.project_id IS NOT NULL $conditiondata");
                    
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }

          }

          elseif($circle_id && $division_id){

            $condition = "";  
                   
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition1 = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition2 = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition3 = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition4 = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }
                  $conditiondata = $condition." ".$condition1." ".$condition2." ".$condition3." ".$condition4;
                    $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode from project_conceptualisation_stage 
                        left join 
                        (
                         Select *  from
            (SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
                        
                        ) all_project 
                         ON all_project.project_id=id 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         LEFT JOIN project_aggrement_stage ON project_aggrement_stage.project_id = project_conceptualisation_stage.id 
                         WHERE all_project.project_id IS NOT NULL AND project_conceptualisation_stage.wing_id = $circle_id  AND project_conceptualisation_stage.division_id = $division_id $conditiondata");
                    
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }
           }


          else{
                     

                 $condition = "";  
                   
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition1 = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition2 = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition3 = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition4 = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }
                  $conditiondata = $condition." ".$condition1." ".$condition2." ".$condition3." ".$condition4;
                    $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode from project_conceptualisation_stage 
                        left join 
                        (
                         Select *  from
            (SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
                        
                        ) all_project 
                         ON all_project.project_id=id 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         LEFT JOIN project_aggrement_stage ON project_aggrement_stage.project_id = project_conceptualisation_stage.id 
                         WHERE all_project.project_id IS NOT NULL AND project_conceptualisation_stage.wing_id = $circle_id $conditiondata");
                    
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }

          }
       
//         $condition = "";  
       
//       if($project_group_id > 0){
//         $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
//       }
//     if($project_category_id > 0){
//         $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
//       }
//       if($project_area_id > 0){
//         $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
//       }
//     if($project_wing_id > 0){
//         $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
//       }
//       if($project_division_id > 0){
//         $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
//       }
//         $query = $this->db->query("select all_project.project_id as id,all_project.Planned_Value,all_project.Earned_Value,all_project.Paid_Value,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,project_aggrement_stage.agreement_cost,project_conceptualisation_stage.draft_mode from project_conceptualisation_stage 
//             left join 
//             (
//              Select *  from
// (SELECT DATE_FORMAT(c.month_date, '%Y-%m') as period, IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value,project_id FROM `project_financial_planning_detail` c left join project_conceptualisation_stage pd on c.project_id=pd.id WHERE c.month_date<=NOW() GROUP BY project_id ORDER BY c.month_date) as summary where Earned_Value<Planned_Value
            
//             ) all_project 
//              ON all_project.project_id=id 
//              LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
//              LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
//              LEFT JOIN project_aggrement_stage ON project_aggrement_stage.project_id = project_conceptualisation_stage.id 
//              WHERE all_project.project_id IS NOT NULL $condition");
//         //echo $this->db->last_query(); die;
//         if($query -> num_rows() >= 1){ return $query->result(); }
//         else{ return false; }

        
    }



    function get_pre_construction_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$circle_id,$division_id){
    

        if($circle_id == 0){
              

               $condition = "";  
                    
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }
                    $query = $this->db->query("select project_conceptualisation_stage.id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         WHERE project_conceptualisation_stage.id IN ( SELECT a.project_id FROM pre_construction_settings a 
                         WHERE 1=1) $condition");
                   
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }
         }

         elseif($circle_id && $division_id){

            $condition = "";  
                    
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }
                    $query = $this->db->query("select project_conceptualisation_stage.id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         WHERE project_conceptualisation_stage.id IN ( SELECT a.project_id FROM pre_construction_settings a 
                         WHERE 1=1 AND project_conceptualisation_stage.wing_id = $circle_id AND project_conceptualisation_stage.division_id = $division_id) $condition");
                   
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }

         }

         else
         {
             $condition = "";  
                    
                  if($project_group_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_group='$project_group_id'"; 
                  }
                if($project_category_id > 0){
                    $condition = "AND project_conceptualisation_stage.project_type='$project_category_id'";
                  }
                  if($project_area_id > 0){
                    $condition = "AND project_conceptualisation_stage.location_id='$project_area_id'"; 
                  }
                if($project_wing_id > 0){
                    $condition = "AND project_conceptualisation_stage.wing_id='$project_wing_id'"; 
                  }
                  if($project_division_id > 0){
                    $condition = "AND project_conceptualisation_stage.division_id='$project_division_id'"; 
                  }
                    $query = $this->db->query("select project_conceptualisation_stage.id,project_name,project_code, project_conceptualisation_stage.estimate_total_cost,area_master.name as area_name,project_type_master.project_type,draft_mode from project_conceptualisation_stage 
                         LEFT JOIN area_master ON area_master.id = project_conceptualisation_stage.location_id 
                         LEFT JOIN project_type_master ON project_type_master.id = project_conceptualisation_stage.project_type 
                         WHERE project_conceptualisation_stage.id IN ( SELECT a.project_id FROM pre_construction_settings a 
                         WHERE 1=1 AND project_conceptualisation_stage.wing_id = $circle_id) $condition");
                   
                    if($query -> num_rows() >= 1){ return $query->result(); }
                    else{ return false; }
         }
    }


    function get_delayed_project_details_data($project_id){
       
        
      
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


    function get_delayed_project_details_till_date_data($project_id){
       
        
      
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

    function get_project_creation_users($proj_rel_id,$user_id){
        $this->db->select('t1.*,t2.designation,t4.firstname,t4.lastname,t3.username');
        $this->db->from('project_creation_linked_user t1');
         $this -> db ->join('user_designation_master t2', 't2.id = t1.user_type_id ', 'left');
        $this -> db ->join('user t3', 't3.id = t1.user_id ', 'left');
        $this -> db ->join('organization_user_details t4', 't4.user_id = t3.id ', 'left');
        
        $this->db->where('t1.project_id', $proj_rel_id);
        $this->db->where('t1.user_id !=', $user_id);
        $query = $this->db->get();
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


   function insertAllData($data = array(), $tbl)
    {
      $insert = $this->db->insert($tbl, $data);
      if($insert){ return true; }
      else{ return false; }
    }


    function get_communication_data($project_id){
        $query = $this->db->query("select communication.*,t4.firstname as sent_to_first_name,t4.lastname as sent_to_last_name from project_delayed_communication delay 
            left join (
                Select t1.*,t2.firstname as sent_by_first_name,t2.lastname as sent_by_last_name
             from project_delayed_communication t1
             left join organization_user_details t2 on t1.sent_by=t2.user_id
                ) communication
                on communication.id = delay.id
                left join organization_user_details t4 on delay.sent_to=t4.user_id
             where delay.project_id='".$project_id."' ORDER BY delay.id DESC;");

        if($query -> num_rows() >= 1){ return $query->result(); }
        else{ return false; }
    }


    function get_project_not_seen_count($project_id){
        $this->db->where('sent_to',0);
        $this->db->where('project_id', $project_id);
        $this->db->where('seen_by_user', 'N');
        $query=$this->db->get('project_delayed_communication');
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_md_communication_last_status($project_id){
        $this -> db -> select('seen_by_user');
        $this -> db -> from('project_delayed_communication');
         $this->db->where('sent_to', 0);
          $this->db->where('project_id', $project_id);
        $this->db->order_by('id', 'DESC');
        $query = $this -> db -> get();
        if($query->num_rows() > 0){
           $row = $query->row_array();
            return $row['seen_by_user'];
        } 
    }

    function update_md_seen_by_status($project_id,$updateData)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('sent_to', 0);
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



    
          public function get_project_total_data($project_id)
    {
        $query = $this->db->query("SELECT IFNULL(SUM(target_amount), 0) as Planned_Value, IFNULL(SUM(earned_amount), 0) as Earned_Value, IFNULL(SUM(allotted_amount), 0) as Paid_Value FROM `project_financial_planning_detail` WHERE month_date<=NOW() AND project_id=".$project_id." ");
        $result = $query->result_array();
        return $result;
    }
   

   




}