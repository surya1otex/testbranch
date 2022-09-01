<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Physical_progress extends MY_Controller
{
    public $allowedModule;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper(array('url', 'security'));

        $this->load->model('Physical_progress_model');
        //$this->load->model('Organization_model');
        $this->allowedModule = array(1 => true, 3 => false, 6 => false, 2 => false, 5 => false, 7 => false, 4 => false);

        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }

    /* for list page */

    function lists(){
      $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');

          $data['physical_progress_list_Data'] = $this->Physical_progress_model->get_physical_progress_list_data();






          $data['user_id'] = $user_id;
          $data['project_id'] = $project_id;
          $this->load->common_template('projectvisitreport/physical_progress_list_view', $data);

    }

    /* end list page */



    /* for insert Page */

    function create(){
          $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
           
          

          $project_id = base64_decode($_REQUEST['project_id']);


          $submit = $this->input->post('submit');
            if($submit == 'Submit'){
               $this->form_validation->set_rules('visit_date', 'Visit Date', 'required');
               $this->form_validation->set_rules('reporting_date', 'Reporting Date', 'required');
               //$this->form_validation->set_rules('observation', 'Observation', 'required');
               //$this->form_validation->set_rules('recommendation', 'Recommendation', 'required');
               $this->form_validation->set_rules('work_item_id', 'Work Item', 'required');
               
               $this->form_validation->set_rules('activity_weightage', 'Achive Score', 'callback_check_entry_or_not');
               $this->form_validation->set_error_delimiters('<div class="col-pink">', '</div>');
                $this->form_validation->set_message('required', 'Enter %s'); 
               if ($this->form_validation->run() == TRUE){

                //$activity_status = $this->input->post('activity_status');
                // echo "<pre>";
                // print_r($activity_status);
                // die();

                $activity_id = $this->input->post('activity_id');
                // print_r($activity_id);
                // die();
                $activity_weightage = $this->input->post('activity_weightage');
                // echo "<pre>";
                //  print_r($activity_weightage);
                //  echo "</pre>";
                // die();
                $work_item_id = $this->input->post('work_item_id');



                  $addData = array(
                    'user_id' => $user_id,  
                    'project_id' => $project_id, 
                    'visit_date' => $this->input->post('visit_date'),
                    'reporting_date' => $this->input->post('reporting_date'),
                    'observation' => $this->input->post('observation'),
                    'recommendation' => $this->input->post('recommendation'),
                    'gateway'=>'W'
                  );

                 $triggering_id = $this->Physical_progress_model->insertDatareturnid($addData, 'project_progress_update_log_triggering');

                //$activity_status_1 = array_keys($activity_status);
                //echo "string";
                

                 $activity_weightage_1 = array_keys($activity_weightage);
                // print_r();
                // die();

                  if(!empty($activity_weightage)){
                    foreach ($activity_weightage_1 as $key => $value) {
                      //$value;
                      $activity_id = $value;
                     
                      //echo "activity_id - $activity_id <br>";

                      if(!empty($activity_weightage[$activity_id][0])){

                       $weightage_val = $activity_weightage[$activity_id][0]; 
                     
                      

                     // echo "weightage - $weightage_val <br>";
                      
                      $detailsData = array(
                          'log_id' => $triggering_id, 
                          'user_id' => $user_id, 
                          'project_id' => $project_id, 
                          'project_work_item_id' => $work_item_id, 
                          'project_activity_id' => $activity_id, 
                          'achieved_score' => $weightage_val, 
                          'status' => 'P', 
                          'activity_completion_status' => 'Y'
                        );

                         $this->Physical_progress_model->insertAllData($detailsData, 'project_progress_update_log_details_triggering');
                       }
                    }
                  }
                 

            /* file upload */
                

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->physical_progress_file_upload_on_server($hidden_file_url,$project_id,$triggering_id,$user_id,'project_progress_update_images_triggering');

                /* file upload */

                  



                  $this->session->set_flashdata('success', 'Data Updated successfully');
                  $red_url = base_url().'physical_progress/lists';
                  redirect($red_url);;

               }

            }


          $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
            $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

          $data['project_details'] = $this->Physical_progress_model->get_peoject_details_data($project_id);


          $data['milestoneData'] = $this->Physical_progress_model->fetchSingledata('project_milestone', 'project_id', $project_id);

          $data['work_itemData'] = $this->Physical_progress_model->get_physical_progress_work_item_data($project_id);

          //$data['project_progress_ar'] = $this->Physical_progress_model->get_project_progress($project_id);

          $data['user_id'] = $user_id;
          $data['project_id'] = $project_id;

          

           $this->load->common_template('projectvisitreport/physical_progress_create_view', $data);
    }

    /* end for insert Page */


    function check_entry_or_not($str){
      $activity_weightage = $this->input->post('activity_weightage');
      $singleArray = array();

    foreach ($activity_weightage as $value){
      if(!empty($value[0])){
        $singleArray[] = $value[0];
      }
    }
      
      if(empty($singleArray)){
        $this->form_validation->set_message('check_entry_or_not', 'Atleast Entry one activity');
            return false;
          }else{
            return true;
          }
    }

    function get_milestone_activity_list(){
      $project_id = $this->input->post('project_id');
      $milestone_id = $this->input->post('milestone_id');

      $data['project_id'] = $project_id;
      $data['milestone_id'] = $milestone_id;

      $data['activitiesData'] = $this->Physical_progress_model->get_milestone_activity_list_data($project_id,$milestone_id);
      $this->load->view('projectvisitreport/milestone_activity_list_view',$data);
    }

    function get_work_item_activity_list(){
      $project_id = $this->input->post('project_id');
      $work_item_id = $this->input->post('work_item_id');

      $data['project_id'] = $project_id;
      $data['work_item_id'] = $work_item_id;

      $data['activitiesData'] = $this->Physical_progress_model->get_work_item_activity_list_data($project_id,$work_item_id);
      $this->load->view('projectvisitreport/work_item_activity_list_view',$data);
    }


    function get_activity_till_target($physical_planning_main_id){
        
        return $this->Physical_progress_model->get_activity_till_target($physical_planning_main_id);
    }



    function progress_file_upload_data()
    {
        

        //$file_name = $this->input->post('file_name');

        if( !empty($_FILES['file1'])) {
            if (!is_dir('uploads/temp/')) {
                      mkdir('./uploads/temp', 0777, TRUE);

                  }
                $config['upload_path'] = 'uploads/temp/';
                $config['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
                $config['max_size'] = 50000000;
               // $config['max_size'] = 2000000;
                $f_name = preg_replace('/\s+/', '_', $_FILES['file1']['name']);
                $fileName = rand(11,999999).'_'.$f_name;
                    
                $config['file_name'] = $fileName;
                $this->load->library('upload', $config);
                

                if ($this->upload->do_upload('file1') && !empty($_FILES['file1']['name'])) {
                    
                    //echo base_url().'uploads/attachment/'.$fileName;
                    //echo 'File Name: '.$file_name.'<br>File: '.$fileName;
                    $file_link = base_url().'uploads/temp/'.$fileName;

                    $path = 'uploads/temp/'.$fileName;
                    $file_size = $this->formatSizeUnits(filesize($path));
                    
                    $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                    $input_data = '<input type="hidden" name="hidden_file_url[]" value="'.$fileName.'">';
                    $image_data = '<img style="height: 60px; width: 60px" src="'.$file_link.'">';
                    echo "<tr>$input_data<td>$image_data</td><td>$file_size</td><td>$file_d_link</td>";

                } else {
                    //echo $this->upload->display_errors();
                    echo "No";

                }
            }else{
                echo "No";
            }
    }


    

    function physical_progress_file_upload_on_server($hidden_file_url,$project_id,$triggering_id,$user_id,$table_name){
        if (!is_dir('uploads/mobilevisitreport/')) {
              mkdir('./uploads/mobilevisitreport', 0777, TRUE);
          }
        if(!empty($hidden_file_url)){
            foreach ($hidden_file_url as $key => $value) {

                $temp_des = 'uploads/temp/'.$value;
                $move_des = 'uploads/mobilevisitreport/'.$value;
                if (copy($temp_des,$move_des)) {
                      unlink($temp_des);
                }
               
                $file_data['log_id'] = $triggering_id;
                $file_data['image_path'] = $value;
                $file_data['project_id'] = $project_id;
                $file_data['user_id'] = $user_id;
                $this->Physical_progress_model->insertAllData($file_data, $table_name);
            }
        }
        return true;
    }


      function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
  

}