<?php

class Analytics_model extends CI_Model {
	
	  function __construct(){
      parent :: __construct();
      $this->load->database();
    }

 public function get_all_project_list(  ){

        $this->db->select('*');
		//$this->db->where('status', 'Y');
        $query = $this->db->get('project_detail');
//echo $this->db->last_query().'<br><br>'; die;
        return $query->result_array();
    }



   public function get_all_physical_planning_main($all_ProjId)
    {
		   
        $query = $this->db->query("Select a.*,b.work_item_description from project_physical_planning_main a
  							left join work_item_master b on b.id=a.project_work_item_id
   where a.project_id IN ($all_ProjId) ORDER BY project_id,project_work_item_id,project_activity_id ");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }
  

   public function get_activity_main($proj_id, $workitem_id)
    {
   
        $query = $this->db->query("Select a.*,b.work_item_description,c.particulars from project_physical_planning_main a
  							left join work_item_master b on b.id=a.project_work_item_id
  							left join project_activities c on c.id=a.project_activity_id
   where a.project_id='".$proj_id."' AND a.project_work_item_id='".$workitem_id."' ORDER BY a.project_id,a.project_work_item_id,a.project_activity_id ");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
    }
   public function get_physical_main($proj_id)
    {
 
   /*$query = $this->db->query("SELECT main.project_work_item_id,SUM(main.target) as targetTotal,SUM(main.achieved) as achievedTotal,SUM(main.tilltarget) as tilltargetTotal FROM( SELECT a.id,a.project_id,a.project_work_item_id,a.project_activity_id,a.total_activity_quantity as target,a.total_activity_allotted_quantity as achieved,SUM(b.target_quantity) as tilltarget FROM `project_physical_planning_main` a left join project_physical_planning_detail b on b.project_physical_planning_id=a.id WHERE a.project_id='".$proj_id."' AND b.month_date < NOW() GROUP BY b.project_physical_planning_id ) as main GROUP BY main.project_work_item_id,main.project_activity_id");*/
 
   $query = $this->db->query("SELECT
    project_work_item_id,
    count(project_activity_id) as cnt_activity,
    SUM(TargetTillDatePercentage) as TargetTillDatePercentageTotal,
    SUM(ActivityAchievedTillDatePercentage) as ActivityAchievedTillDatePercentageTotal,
    SUM(AchievedOverallPercentage) as AchievedOverallPercentageTotal
FROM
(
SELECT
    project_work_item_id,
    project_activity_id,
    targetTotal,
    achievedTotal,
    tilltargetTotal,
    TargetTillDatePercentage,
    round(TargetTillDatePercentage*ActivityAchievedTillDatePercentage/100,2) as ActivityAchievedTillDatePercentage,
    AchievedOverallPercentage
    FROM
    (
        SELECT
            project_work_item_id,
            project_activity_id,
            targetTotal,
            achievedTotal,
            tilltargetTotal,
            round(tilltargetTotal/targetTotal*100,2) as TargetTillDatePercentage,
            if(achievedTotal/tilltargetTotal*100>100, 100, round(achievedTotal/tilltargetTotal*100,2)) as ActivityAchievedTillDatePercentage,
            round(achievedTotal/targetTotal*100,2) as AchievedOverallPercentage  
            FROM
            (
                    SELECT
                        main.project_work_item_id,
                        main.project_activity_id,
                        SUM(main.target) as targetTotal,
                        SUM(main.achieved) as achievedTotal,
                        SUM(main.tilltarget) as tilltargetTotal
                        FROM
                            ( SELECT a.id,a.project_id,
                                    a.project_work_item_id,
                                    a.project_activity_id,
                                    a.total_activity_quantity as target,
                                    a.total_activity_allotted_quantity as achieved,
                                    SUM(b.target_quantity) as tilltarget
                             FROM `project_physical_planning_main` a
                             left join project_physical_planning_detail b
                             on b.project_physical_planning_id=a.id
                             WHERE a.project_id='".$proj_id."'
                             AND b.month_date < NOW()
                             GROUP BY b.project_physical_planning_id
                            )
                        as main
                        GROUP BY main.project_work_item_id, main.project_activity_id
            )
            as summary
            GROUP BY project_work_item_id, project_activity_id
    )
    as consolidated
    GROUP BY project_work_item_id, project_activity_id
    )
    as wisum
    GROUP BY project_work_item_id");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	} 
	
	public function get_physicaltarget_main($proj_id,$wi_ID)
    {
 
   $query = $this->db->query("SELECT a.id,a.project_id,a.project_work_item_id,a.project_activity_id,a.total_activity_quantity as target,a.total_activity_allotted_quantity as achieved,SUM(b.target_quantity) as tilltarget FROM `project_physical_planning_main` a left join project_physical_planning_detail b on b.project_physical_planning_id=a.id WHERE a.project_id='".$proj_id."' AND a.project_work_item_id='".$wi_ID."' AND b.month_date < NOW() GROUP BY b.project_physical_planning_id");

       // $query = $this->db->get('project_physical_planning_main');
        //echo $this->db->last_query().'<br><br>'; die;
        $result = $query->result_array();
        return $result;
 
 
	}
	
	public function getworkitem($wi_id)
    {
        
		$wi_id = (int)$wi_id;
        $this->db->select('work_item_description');
        $this->db->from('work_item_master');
        $this->db->where('id', $wi_id);
        $query = $this->db->get();
        $result = $query->result_array();
		 return $result[0]['work_item_description'];
		
		
    }

}
?>