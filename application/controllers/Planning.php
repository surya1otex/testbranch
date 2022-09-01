<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Planning extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model('Planning_model');
        //$this->load->model('Project_model');
        $this->load->model('User_model');
        $this->load->model('Procurement_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }

        /*End fo Check whether logged in */
        $this->financial_module_permission = $this->user_access_details(8);
    }
    /*Project Steps*/

 
    /* Project List */
    public function project_list()
    {
		
        $user_id = $this->session->userdata('id');
        $data['project_deatail'] = $this->Planning_model->get_planning_project_list($user_id);
        $this->load->common_template('project/planning_project_list', $data);
    }
    /* Project Approval List */
 	public function project_area($area_id)
    {
        return $this->Planning_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Planning_model->project_destination($destination_id);
    }
	
	
    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Planning_model->get_project_type($type_id);
    }
	
	

    /* Project Type End */
	
	 public function project_milestone()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_id'] = $project_id;
        $data['project_deatail'] = $this->Planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Planning_model->get_project_aggrement_details($project_id);
        $data['project_milestone'] = $this->Planning_model->get_project_milestone($project_id);

        /* Call for project status bar*/
        //$data['status_bar_data'] = $this->project_plan_monitoring_status_bar($project_id, "Planning");
       // $data['counters'] = $this->project_counters($project_id);
        /* Call for project status bar*/

        $this->load->common_template('project/project_milestone', $data);
    }
	 public function project_milestone_activity()
    {
        $project_id = base64_decode($_REQUEST['project_id']);
        $milestone_id = base64_decode($_REQUEST['m_id']);
        $data['project_id'] = $project_id;
		$data['project_deatail'] = $this->Planning_model->project_details($project_id);
        $data['milestone_deatail'] = $this->Planning_model->milestone_deatails($project_id,$milestone_id);
        $data['project_aggrement_deatail'] = $this->Planning_model->get_project_aggrement_details($project_id);
        $data['project_milestone_activity'] = $this->Planning_model->get_milestone_activity($project_id,$milestone_id);

       

        $this->load->common_template('project/project_milestone_activity', $data);
    }
	
	
    public function add_project_activity()
    {
		
			if(!empty($_REQUEST['project_id'])){  $project_id = base64_decode($_REQUEST['project_id']); }
			if(!empty($_REQUEST['milestone_id'])){  $milestone_id = base64_decode($_REQUEST['milestone_id']); }
			if(!empty($_REQUEST['activity_id'])){  $activity_id = base64_decode($_REQUEST['activity_id']); }
		
		//echo $project_id;
		//echo $milestone_id;
		
		
         $data['project_id'] = $project_id;
         $data['milestone_id'] = $milestone_id;
         $data['activity_id'] = $activity_id;
		
        $data['project_deatail'] = $this->Planning_model->project_details($project_id);
        $data['milestone_deatail'] = $this->Planning_model->milestone_deatails($project_id,$milestone_id);
        $data['project_aggrement_deatail'] = $this->Planning_model->get_project_aggrement_details($project_id);
        $data['project_milestone_activity'] = $this->Planning_model->get_milestone_activity($project_id,$milestone_id);
		//edit
        $data['milestone_activity_deatail'] = $this->Planning_model->get_activity_details($project_id,$milestone_id,$activity_id);
		
		 
		 $total_activitty_weightagecal = $this->Planning_model->check_total_milestoneActivity_weightage( $project_id,$milestone_id);
		 $total_activity_weightage =$total_activitty_weightagecal[0]['weightage'];
	   	 $overall_activity_weightage = 100;
	     $left_Aweightage = ($overall_activity_weightage - $total_activity_weightage);
	  	 $curr_Aweightage = $_REQUEST['weightage'];
		 
		if (!empty($_REQUEST['submit'])) {
			
			if ($_REQUEST['submit'] == "add") 
				{  //MILE STONE ACTIVITY ADD
			

	  
        if (!empty($_REQUEST['activity'])) {
			
            // $this->form_validation->set_rules('activity', 'Milestone Activity', 'required');
           $this->form_validation->set_rules('activity', 'Milestone Activity', 'required|callback__duplicate_activity_check');
        }
		
        if (!empty($_REQUEST['weightage'])) {
			
           // $this->form_validation->set_rules('weightage', 'Weightage', 'required');
            $this->form_validation->set_rules('weightage', 'Weightage', 'required|callback__activity_weightage_check');
        }

        if ($this->form_validation->run() == FALSE) {
		   if (!empty($_REQUEST['activity'])) {
				
        $check_total = $this->Planning_model->check_dupliacte_milestone_activity( $project_id,$milestone_id,$_REQUEST['activity'] );
        if( $check_total[0]['total'] > 0  ){
           $this->session->set_flashdata('Aerror_message', 'Same Activity already exits.');
		}
        } 
		  if (!empty($_REQUEST['weightage'])) {
	  
        if( $curr_Aweightage > $left_Aweightage  ){
           $this->session->set_flashdata('AWerror_message', 'Maximum milestone activity weightage exceed.');
		   
		}
        }
		
           redirect('Planning/project_milestone_activity?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
        }
		else 
		{
			
            $activity = array();
            $activity['project_id'] = $project_id;
            $activity['milstone_id'] = $milestone_id;
            $activity['particulars'] = $_REQUEST['activity'];
            $activity['weightage'] = $_REQUEST['weightage'];
            $activity['end_date'] = $_REQUEST['end_date'];
            $activity['created_by'] = $this->session->userdata('id');
            $activity['created_on'] = Date('Y-m-d');
            $this->Planning_model->add('project_activities', $activity);
            $this->session->set_flashdata('success', 'Milestone Activity Added Successfully');
            redirect('Planning/project_milestone_activity?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
			
        }
			}
			else
			 	{
				  //MILE STONE ACTIVITY EDIT
			

	  
        if (!empty($_REQUEST['activity'])) {
			
            // $this->form_validation->set_rules('activity', 'Milestone Activity', 'required');
           $this->form_validation->set_rules('activity', 'Milestone Activity', 'required|callback__duplicate_activity_checkEDIT');
		   
        }
		
        if (!empty($_REQUEST['weightage'])) {
			
           // $this->form_validation->set_rules('weightage', 'Weightage', 'required');
            $this->form_validation->set_rules('weightage', 'Weightage', 'required|callback__activity_weightage_checkEDIT');
        }

        if ($this->form_validation->run() == FALSE) {
		   if (!empty($_REQUEST['activity'])) {
						
        $check_total = $this->Planning_model->check_dupliacte_milestone_activityEDIT( $project_id,$milestone_id,$activity_id,$_REQUEST['activity'] );
        if( $check_total[0]['total'] > 0  ){
           $this->session->set_flashdata('Aerror_message', 'Same Activity already exits.');
		}
        } 
		  if (!empty($_REQUEST['weightage'])) {
	  
        if( $curr_Aweightage > $left_Aweightage  ){
           $this->session->set_flashdata('AWerror_message', 'Maximum milestone activity weightage exceed.');
		   
		}
        }
		
           redirect('Planning/add_project_activity?project_id=' . $_REQUEST['project_id'].'&milestone_id=' . $_REQUEST['milestone_id'].'&activity_id=' . $_REQUEST['activity_id']);
        }
		else 
		{
			
			//print_r($_REQUEST); die;			
			
            $eactivity = array();
            $eactivity['project_id'] = $project_id;
            $eactivity['milstone_id'] = $milestone_id;
            $eactivity['particulars'] = $_REQUEST['activity'];
            $eactivity['weightage'] = $_REQUEST['weightage'];
            $eactivity['end_date'] = $_REQUEST['end_date'];
            $eactivity['modified_by'] = $this->session->userdata('id');
			$where = array('id' => base64_decode($_REQUEST['activity_id']));
            $this->Planning_model->updateDataCondition('project_activities', $eactivity, $where);
            $this->session->set_flashdata('success', 'Milestone Activity Updated Successfully');
            redirect('Planning/project_milestone_activity?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
			
        }
			
				}
			
		
		}
		
		else {
			
          // redirect('Planning/project_milestone_activity?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
            $this->load->common_template('project/project_milestone_activity', $data);
		}
    }

    /* Add Project milestone */
    public function add_project_milestone()
    {
		
		
			if(!empty($_REQUEST['project_id'])){ $project_id = base64_decode($_REQUEST['project_id']); }
			if(!empty($_REQUEST['m_id'])){ $milestone_id = base64_decode($_REQUEST['m_id']); }
			else if (count($this->input->post('project_id'))>0){    $project_id = base64_decode($this->input->post('project_id')); }
		
		
         $data['project_id'] = $project_id;
         $data['milestone_id'] = $milestone_id;
		
        $data['project_deatail'] = $this->Planning_model->project_details($project_id);
        $data['project_aggrement_deatail'] = $this->Planning_model->get_project_aggrement_details($project_id);
        $data['project_milestone'] = $this->Planning_model->get_project_milestone($project_id);
		
		//edit
        $data['project_milestone_details'] = $this->Planning_model->milestone_deatails($project_id,$milestone_id);
		
		$total_milestone_weightagecal = $this->Planning_model->check_total_milestone_weightage( $project_id);
		$total_milestone_weightage =$total_milestone_weightagecal[0]['weightage'];
	   	$overall_milestone_weightage = 100;
	    $left_weightage = ($overall_milestone_weightage - $total_milestone_weightage);
	  	$curr_weightage = $_REQUEST['weightage'];
		
		if (!empty($_REQUEST['submit'])) {
			
			
		if ($_REQUEST['submit'] == "add") 
			{  //MILE STONE ADD
			
			
        if (!empty($_REQUEST['milestone'])) {
			
            $this->form_validation->set_rules('milestone', 'Milestone', 'required|callback__duplicate_milestone_check');
        }
		
        if (!empty($_REQUEST['weightage'])) {
			
            $this->form_validation->set_rules('weightage', 'Weightage', 'required|callback__weightage_check');
        }

        if ($this->form_validation->run() == FALSE) {
		    if (!empty($_REQUEST['milestone'])) {
				
        $check_total = $this->Planning_model->check_dupliacte_milestone_project( $project_id,$_REQUEST['milestone'] );
        if( $check_total[0]['total'] > 0  ){
           $this->session->set_flashdata('Merror_message', 'Same Milestone already exits.');
		}
        } 
		 if (!empty($_REQUEST['weightage'])) {
	  
	  //die;
        if( $curr_weightage > $left_weightage  ){
           $this->session->set_flashdata('Werror_message', 'Maximum milestone weightage exceed.');
		   
		}
        }
		
        // $this->load->common_template('project/project_milestone', $data);
           redirect('Planning/project_milestone?project_id=' . $_REQUEST['project_id']);
        }
		else 
		{
		
			
		
            //$project_id = base64_decode($_REQUEST['project_id']);

            $milestone = array();
            $milestone['project_id'] = $project_id;
            $milestone['milestone'] = $_REQUEST['milestone'];
            $milestone['weightage'] = $_REQUEST['weightage'];
            $milestone['created_by'] = $this->session->userdata('id');
            $milestone['created_on'] = Date('Y-m-d');
            $this->Planning_model->add('project_milestone', $milestone);
            $this->session->set_flashdata('success', 'Milestone Added Successfully');
            redirect('Planning/project_milestone?project_id=' . $_REQUEST['project_id']);
			
        //$this->load->common_template('project/project_milestone', $data);
        }
		}
		else
			{ // MILE STONE EDIT
			
			
			
			 if (!empty($_REQUEST['milestone'])) {
			
          $this->form_validation->set_rules('milestone', 'Milestone', 'required|callback__duplicate_milestone_checkedit');
            //  $this->form_validation->set_rules('milestone', 'Milestone', 'required');
        }
		
        if (!empty($_REQUEST['weightage'])) {
			
            $this->form_validation->set_rules('weightage', 'Weightage', 'required|callback__weightage_checkedit');
           // $this->form_validation->set_rules('weightage', 'Weightage', 'required');
        }
		
		
        if ($this->form_validation->run() == FALSE) {
			/*print_r($_REQUEST);
			echo "sdff";
			die;*/
		   if (!empty($_REQUEST['milestone'])) {
				
        $mcheck_total = $this->Planning_model->check_dupliacte_milestone_projectEDIT( $project_id,$milestone_id,$_REQUEST['milestone'] );
        if( $mcheck_total[0]['total'] > 0  ){
           $this->session->set_flashdata('Merror_message', 'Same Milestone already exits.');
		}
        } 
		 if (!empty($_REQUEST['weightage'])) {
	  
	  //die;
        if( $curr_weightage > $left_weightage  ){
           $this->session->set_flashdata('Werror_message', 'Maximum milestone weightage exceed.');
		   
		}
        }
		
        // $this->load->common_template('project/project_milestone', $data);
           redirect('Planning/add_project_milestone?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
        }
		else 
		{
		
			/*print_r($_REQUEST);
		die;*/

            $emilestone = array();
            $emilestone['project_id'] = $project_id;
            $emilestone['milestone'] = $_REQUEST['milestone'];
            $emilestone['weightage'] = $_REQUEST['weightage'];
            $emilestone['modified_by'] = $this->session->userdata('id');
			$where = array('id' => base64_decode($_REQUEST['milestone_id']));
            $this->Planning_model->updateDataCondition('project_milestone', $emilestone, $where);
            $this->session->set_flashdata('success', 'Milestone Updated Successfully');
            redirect('Planning/project_milestone?project_id=' . $_REQUEST['project_id']);
			
        //$this->load->common_template('project/project_milestone', $data);
        }

			
		}
		
		
		} 
		else {
            $this->load->common_template('project/project_milestone', $data);
		}
    }
	
	
	
	public function _duplicate_milestone_check()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
	  
        $check_total = $this->Planning_model->check_dupliacte_milestone_project( $project_id,$_REQUEST['milestone'] );
        if( $check_total[0]['total'] > 0  ){
            $this->form_validation->set_message('_duplicate_milestone_check', 'Same Milestone already exits.');
            return false;
        }
        return true;
    }
	
	public function _duplicate_milestone_checkedit()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
	  
        $mcheck_total = $this->Planning_model->check_dupliacte_milestone_projectEDIT( $project_id,$milestone_id,$_REQUEST['milestone'] );
        if( $mcheck_total[0]['total'] > 0  ){
            $this->form_validation->set_message('_duplicate_milestone_checkedit', 'Same Milestone already exits.');
            return false;
        }
        return true;
    }
	
	public function _weightage_check()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
		 
		 $total_milestone_weightagecal = $this->Planning_model->check_total_milestone_weightage( $project_id);
		 $total_milestone_weightage =$total_milestone_weightagecal[0]['weightage'];
	   	 $overall_milestone_weightage = 100;
	     $left_weightage = ($overall_milestone_weightage - $total_milestone_weightage);
	  	 $curr_weightage = $_REQUEST['weightage'];
	  
	  //die;
        if( $curr_weightage > $left_weightage  ){
            $this->form_validation->set_message('_weightage_check', 'Maximum milestone weightage exceed.');
            return false;
        }
        return true;
    }
	
	public function _weightage_checkedit()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
		 
		 $total_milestone_weightagecal = $this->Planning_model->check_total_milestone_weightageEDIT( $project_id,$milestone_id);
		 $total_milestone_weightage =$total_milestone_weightagecal[0]['weightage'];
	   	 $overall_milestone_weightage = 100;
	     $left_weightage = ($overall_milestone_weightage - $total_milestone_weightage);
	  	 $curr_weightage = $_REQUEST['weightage'];
	  
	  //die;
        if( $curr_weightage > $left_weightage  ){
            $this->form_validation->set_message('_weightage_checkedit', 'Maximum milestone weightage exceed.');
            return false;
        }
        return true;
    }

	public function _duplicate_activity_check()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
	  
        $check_total = $this->Planning_model->check_dupliacte_milestone_activity( $project_id,$milestone_id,$_REQUEST['activity'] );
        if( $check_total[0]['total'] > 0  ){
            $this->form_validation->set_message('_duplicate_activity_check', 'Same Milestone Activity already exits.');
            return false;
        }
        return true;
    }
	
	public function _duplicate_activity_checkEDIT()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
         $activity_id = base64_decode($_REQUEST['activity_id']);
	  
        $check_total = $this->Planning_model->check_dupliacte_milestone_activityEDIT( $project_id,$milestone_id,$activity_id,$_REQUEST['activity'] );
        if( $check_total[0]['total'] > 0  ){
            $this->form_validation->set_message('_duplicate_activity_checkEDIT', 'Same Milestone Activity already exits.');
            return false;
        }
        return true;
    }
	
	public function _activity_weightage_check()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
		 
		 $total_activitty_weightagecal = $this->Planning_model->check_total_milestoneActivity_weightage( $project_id,$milestone_id);
		 $total_activity_weightage =$total_activitty_weightagecal[0]['weightage'];
	   	 $overall_activity_weightage = 100;
	     $left_Aweightage = ($overall_activity_weightage - $total_activity_weightage);
	  	 $curr_Aweightage = $_REQUEST['weightage'];
	  
	  //die;
        if( $curr_Aweightage > $left_Aweightage  ){
            $this->form_validation->set_message('_activity_weightage_check', 'Maximum milestone activity weightage exceed.');
            return false;
        }
        return true;
    }
	
	public function _activity_weightage_checkEDIT()
    {
         $project_id = base64_decode($_REQUEST['project_id']);
         $milestone_id = base64_decode($_REQUEST['milestone_id']);
         $activity_id = base64_decode($_REQUEST['activity_id']);
		 
		 $total_activitty_weightagecal = $this->Planning_model->check_total_milestoneActivity_weightageEDIT( $project_id,$milestone_id,$activity_id);
		 $total_activity_weightage =$total_activitty_weightagecal[0]['weightage'];
	   	 $overall_activity_weightage = 100;
	     $left_Aweightage = ($overall_activity_weightage - $total_activity_weightage);
	  	 $curr_Aweightage = $_REQUEST['weightage'];
	  
	  //die;
        if( $curr_Aweightage > $left_Aweightage  ){
            $this->form_validation->set_message('_activity_weightage_checkEDIT', 'Maximum milestone activity weightage exceed.');
            return false;
        }
        return true;
    }
	
	 public function del_project_milestone()
    {
			if(!empty($_REQUEST['project_id'])){ $project_id = base64_decode($_REQUEST['project_id']); }
			if(!empty($_REQUEST['m_id'])){ $milestone_id = base64_decode($_REQUEST['m_id']); }
        $deleteClause = array('id' => $milestone_id);
        $this->Planning_model->deleteRecord('project_milestone', $deleteClause);
        $this->session->set_flashdata('success', 'Milestone deleted Successfully');
        //redirect('Project/project_other_setting?project_id=' . $_REQUEST['project_id']);
		  redirect('Planning/project_milestone?project_id=' . $_REQUEST['project_id']);
    }
	
	 public function del_milestone_activity()
    {
			if(!empty($_REQUEST['project_id'])){ $project_id = base64_decode($_REQUEST['project_id']); }
			if(!empty($_REQUEST['milestone_id'])){ $milestone_id = base64_decode($_REQUEST['milestone_id']); }
			if(!empty($_REQUEST['activity_id'])){ $activity_id = base64_decode($_REQUEST['activity_id']); }
        $deleteClause = array('id' => $activity_id);
        $this->Planning_model->deleteRecord('project_activities', $deleteClause);
        $this->session->set_flashdata('success', 'Milestone Activity deleted Successfully');
		  redirect('Planning/project_milestone_activity?project_id=' . $_REQUEST['project_id'].'&m_id=' . $_REQUEST['milestone_id']);
    }
   
}

?>
