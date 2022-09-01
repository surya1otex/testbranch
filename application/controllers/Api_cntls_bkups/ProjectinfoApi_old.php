<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Content-Type: application/json; charset=utf-8');
class ProjectinfoApi extends MY_Controller {
	public function __construct(){
        parent::__construct();
			  // load base_url
		$this->load->library('session');
		$this->load->library('pagination');	  
		$this->load->helper('form');
   		$this->load->helper(array('url','html','form'));
		$this->load->model('Home_model');
		$this->load->model('Monitoring_model');
		$this->load->model('Project_model');
    }
     /* Project Type */
     public function project_type($type_id){
        return $this->Project_model->get_project_type($type_id);
     }

    /* Project Area */
     public function project_area($area_id){
        return $this->Project_model->get_project_area($area_id);
     }

   public function work_item($work_item_id){

        return $this->Project_model->get_work_item_list($work_item_id);
    }

    public function project_progress() {
    	    $apikey = $_GET['token'];
            $result = $this->Home_model->fetch_token_records($apikey);
            $progress_projects = [];

            if(!empty($result)){

				$Login_details = array(
					'is_logged_in' => '1',
					'id' => $result[0]['user_id'],
					'username'  => $result[0]['username'],
          'user_type' => $result[0]['user_type'],
          'user_role_id' => $result[0]['role_id'],
          'user_role_name' => $result[0]['role_name'],
          'circle_id' => $result[0]['circle_id'],
          'division_id' => $result[0]['division_id']
				);
				
				$this->session->set_userdata($Login_details);

		       $user_id = $this->session->userdata('id');
               $user_type = $this->session->userdata('user_type');
               $circle_id = $this->session->userdata('circle_id');
               $division_id = $this->session->userdata('division_id');
               //$data['project_deatail'] = $this->Monitoring_model->get_monitoring_project_list($user_id);

               $project_deatail = $this->Monitoring_model->get_monitoring_project_list($user_id,$circle_id,$division_id);

          foreach($project_deatail as $pro_dtl){
             $project_area= $this->project_area($pro_dtl['location_id']);
             $project_type= $this->project_type($pro_dtl['project_type']);

               array_push($progress_projects, array("id" => $pro_dtl['id'], "project" => $pro_dtl['project_name'], "category" => $project_type[0]['project_type'], "location" => $project_area[0]['name']));
             }

               echo json_encode($progress_projects);

			}
			else {
				$res = array('response' => "Request Error");
				echo json_encode($result);
			}
    }

  public function project_financial_listing(){
    $project_id=$_REQUEST['project_id'];

    $project_work_item=[];
    $apikey = $_GET['token'];
            $result = $this->Home_model->fetch_token_records($apikey);

            if(!empty($result)){

        $Login_details = array(
          'is_logged_in' => '1',
          'id' => $result[0]['user_id'],
          'username'  => $result[0]['username'],
                    'user_type' => $result[0]['user_type'],
                    'user_role_id' => $result[0]['role_id'],
                    'user_role_name' => $result[0]['role_name']
        );
        
        $this->session->set_userdata($Login_details);

           $user_id = $this->session->userdata('id');
               $user_type = $this->session->userdata('user_type');
               $circle_id = $this->session->userdata('circle_id');
               $division_id = $this->session->userdata('division_id');

         $project_work_item_detail = $this->Project_model->get_project_work_item_details($project_id);
              // echo $project_work_item_detail;
        // exit;
               foreach($project_work_item_detail as $pro_dtl){
        $project_item= $this->work_item($pro_dtl['work_item_id']);
        //$project_type= $this->project_type($pro_dtl['project_type']);
   
          array_push($project_work_item, array("id" => $pro_dtl['id'], "stage_name" => $project_item[0]['work_item_description']));
        }
   
               echo json_encode($project_work_item);

      }
      else {
        $res = array('response' => "Request Error");
        echo json_encode($result);
      }
  }


}