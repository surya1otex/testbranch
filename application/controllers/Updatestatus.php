<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Updatestatus extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Updatestatus_model');
        /*To Check whether logged in */
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper'));
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function project_lists()
    {
        $data['user_type_id'] = $this->session->userdata('user_type');
        $circle_id = $this->session->userdata('circle_id');
        $division_id = $this->session->userdata('division_id');
		$data['projects'] = $this->Updatestatus_model->get_projects($circle_id,$division_id);
        $this->load->common_template('status/project_activity_list',$data);
    }

    public function manage() {
        $user_id = $this->session->userdata('id');
        $user_type_id = $this->session->userdata('user_type');
        $project_id = base64_decode($_REQUEST['project_id']);
        if($user_type_id == 33) {
            redirect('Updatestatus/issuedetails?project_id='.base64_encode($project_id));
        }
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $projectData_exist_flag = $this->Updatestatus_model->checkProjectExits($project_id);
        $data['get_updatestatus'] = $this->Updatestatus_model->getupdatestatus($project_id);
        $this->form_validation->set_rules('issue_name', 'Current Status','required'); 
        
           /*** Form Validation Rules***/
        //if ($this->form_validation->run() == FALSE) {
            
            
          $this->load->common_template('status/update_status_entry', $data);

           // echo $project_id;

              //echo 'error';

       // }
        
        //else{ 

              $submit = $this->input->post('submit');

              if($submit == 'Submit'){

                 $issue_id_count = count($_REQUEST['issue_name']);
                 //$tehsil_id_arr = $this->input->post('tehsil_id');
                 $issue_id_arr = $this->input->post('issue_name');
                 $action_taken_arr = $this->input->post('action_taken');
                 $status_arr = $this->input->post('status');

                 // code for delete exist rows


                 // end code for remove issue rows

                if (!empty($projectData_exist_flag)) {
        
                  $del_issue_data =$this->Updatestatus_model->removelist($project_id);
            
                 }



                 for ($i=0; $i < $issue_id_count; $i++) { 
                 //$db_data['project_id'] = $project_id;
                 //$db_data['current_status'] = $_REQUEST['current_status'];
                 //$db_data['issues'] = $_REQUEST['issue_name'];
                 //$db_data['entered_by'] = $user_id;

                    $addData = array(
                    'project_id' => $project_id, 
                    'issues' => $issue_id_arr[$i],
                    'action_taken' => $action_taken_arr[$i], 
                    'current_status' => $status_arr[$i], 
                    'entered_by' => $user_id
                );



        // if(!empty($projectData_exist_flag)){  //UPDATE
         
       // $directpurchase_id = $data['get_prvatelanddp'][0]['id'];  
        
                    //$UaddData = array(
                    //'project_id' => $project_id, 
                    //'relation_id' => $directpurchase_id,
                    //'district_id' => $dist_id_arr[$i], 
                    //'tahsils_id' => $tehsil_id, 
                    //'entered_by' => $user_id
               // );
          
        
                 //$this->Privateland_dp_model->direct_purchase_location($UaddData);
                 //$this->Privateland_dp_model->direct_purchase_location($addData);
                   $EE_last_data =$this->Updatestatus_model->save_update_status($addData);
          }
                 // else
                   //{
        
                   //$this->Privateland_dp_model->direct_purchase_location($addData);
        
                 //}

                $this->session->set_flashdata('success', 'Project update status saved successfully');
        
                 //if($EE_last_data){

                    //echo 'success';

                   redirect('Updatestatus/manage?project_id=' . base64_encode($project_id));

                //}


                }



//  Lines not required 
           // if(!empty($projectData_exist_flag)){  //UPDATE
                 
               // $update_status_id = $data['get_updatestatus'][0]['id'];
                //$EE_last_data_update =$this->Updatestatus_model->update_status($db_data,$update_status_id); 
             //}
             
             
             //else { //ADD
            
                  //$EE_last_data =$this->Updatestatus_model->save_update_status($db_data);
            
               // }

// End of Lines not required //

              // $this->session->set_flashdata('success', 'Project update status saved successfully');
        
              //    if($EE_last_data){

              //       redirect('Updatestatus/project_lists');
              //   }

             // form validation logic to remove   

              //}
             // form validation logic to remove


              //$this->load->common_template('status/update_status_entry');

          }

          public function issuedetails() {
            $project_id = base64_decode($_REQUEST['project_id']);
            $data['issue_details'] = $this->Updatestatus_model->getupdatestatus($project_id);
            $this->load->common_template('status/issue_details', $data);


          }

    
	

}
?>