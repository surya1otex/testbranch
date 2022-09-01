<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Project_creation extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper'));
        $this->load->model('Project_creation_model');
        $this->load->model('User_model');
        $this->load->model('Procurement_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
    }





    function manage(){
        $project_id = base64_decode($_REQUEST['project_id']);
        // print_r($this->input->post());
        // //die();
        $submit = $this->input->post('draft_mode');
        //die();
        if($submit == 'S')
            {
            $this->form_validation->set_rules('project_name','Project Name','trim|required|callback_check_project_name',array('required' => '%s required'));
             if($this->form_validation->run() == TRUE) {

                $data = $this->fetch_data_from_post();


                if(is_numeric($project_id)){
                    
                  $data['modified_by'] = $this->session->userdata('id');
                  $up =  $this->Project_creation_model->updateData('id', 'project_creation',$data,$project_id); 

                  $post_user_type = $_REQUEST['user_type'];
                    $post_user_name = $_REQUEST['user_name'];
                    /** Project Users **/
                    foreach ($post_user_type as $key => $val) {

                        if ($val == 'Select Stakeholder Type' || $post_user_name[0] == 'Select Stakeholder Name') {
                            unset($_REQUEST['user_type']);
                            unset($_REQUEST['user_name']);
                            break;
                        }
                        $insert_arr[] = array(
                            'user_id' => $post_user_name[$key],
                            'user_type_id' => $val,
                            'project_id' => $project_id,
                            'entered_by' => $this->session->userdata('id'),
                            'modified_by' => $this->session->userdata('id')
                        );


                    }
                    $this->Project_creation_model->insert_Project_users($insert_arr, $project_id);
                    /* file upload */

                /* for deleteation old data */


                $doc_arr = $this->Project_creation_model->getFiles($project_id,'project_creation_document');
                
                $old_arr = array();
                if(!empty($doc_arr)){
                    foreach ($doc_arr as $doc) {
                        $old_arr[] = $doc['document_id'];
                    }
                }

                
                $db_hidden_file_id = $this->input->post('db_hidden_file_id');
                if(!empty($db_hidden_file_id)){

                $diff_result = array_diff($old_arr, $db_hidden_file_id);
                }else{
                  $diff_result =  $old_arr; 
                }
                
                if(!empty($diff_result)){
                    foreach ($diff_result as $diff) {
                        $get_old_file_name = $this->Project_creation_model->getSpecificdata('project_creation_document','document_id',$diff,'file_path');
                        
                        /*delete and unlink */
                        $this->Project_creation_model->deleteData('document_id', $diff, 'project_creation_document');

                        $temp_des = 'uploads/attachment/'.$get_old_file_name;
                        unlink($temp_des);
                    }
                }

                /* end for deletation old data */


                $hidden_file_name = $this->input->post('hidden_file_name');
                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,'project_creation_document');

                /* end file update */




                  $this->session->set_flashdata('success', 'Data Updated Successfully');
                    $rurl = base_url().'Project_creation/lists'; 
                    redirect($rurl);

                }else{
                    $data['entered_by'] = $this->session->userdata('id');
                    $data['enetered_on'] = date('Y-m-d H:i:s');
                    $add_id = $this->Project_creation_model->insertDatareturnid($data, 'project_creation');


                    $post_user_type = $_REQUEST['user_type'];
                    $post_user_name = $_REQUEST['user_name'];
                    /** Project Users **/
                    foreach ($post_user_type as $key => $val) {

                        if ($val == 'Select User Type' || $post_user_name[0] == 'Select User Name') {
                            unset($_REQUEST['user_type']);
                            unset($_REQUEST['user_name']);
                            break;
                        }
                        $insert_arr[] = array(
                            'user_id' => $post_user_name[$key],
                            'user_type_id' => $val,
                            'project_id' => $add_id,
                            'entered_by' => $this->session->userdata('id')
                        );


                    }


                    /* file upload */
                $hidden_file_name = $this->input->post('hidden_file_name');

                $hidden_file_url = $this->input->post('hidden_file_url');
                $this->file_upload_on_server($hidden_file_name,$hidden_file_url,$add_id,'project_creation_document');

                /* file upload */
                    $this->Project_creation_model->insert_Project_users($insert_arr, $project_id);

                    $this->session->set_flashdata('success', 'Data Added Successfully');
                    $rurl = base_url().'Project_creation/lists'; 
                    redirect($rurl);
                }



            }


         }
        

        if((is_numeric($project_id)) && ($submit != 'Submit')){
            $data = $this->fetch_data_from_db($project_id);
        }else{
            $data = $this->fetch_data_from_post();
        }

        $data['project_id'] = $project_id;
        $data['project_type'] = $this->Project_creation_model->fetchMasterData('project_type_master','status','Y'); 
        $data['project_scheme'] = $this->Project_creation_model->fetchMasterData('group_master','status','Y'); 
        $data['project_location'] = $this->Project_creation_model->fetchMasterData('area_master','status','Y'); 

        $data['project_circle'] = $this->Project_creation_model->fetchMasterData('sector_master','status','Y'); 
        $data['project_wings'] = $this->Project_creation_model->fetchMasterData('wing_master','status','Y'); 
        $data['project_division'] = $this->Project_creation_model->fetchMasterData('division_master','status','Y'); 


        $data['user_type'] = $this->Project_creation_model->getAllUserType();
        $data['super_visor_dtl'] = $this->Project_creation_model->getProjectUsers($project_id);
        $data['user_name'] = $this->Project_creation_model->getAllUserName();

        $data['steps_files'] = $this->Project_creation_model->getFiles($project_id,'project_creation_document');
        $data['divisions'] = $this->Project_creation_model->getProjectDivision();
        $data['post_steps_files']['file_name'] = $this->input->post('hidden_file_name');
        $data['post_steps_files']['file_url'] = $this->input->post('hidden_file_url');

        $this->load->common_template('project/project_creation_view', $data);
    }



        /*fetch data from post */
function fetch_data_from_post(){
    $data['project_name'] = $this->input->post('project_name',TRUE);
    $data['cat_id'] = $this->checkEmptyValue($this->input->post('cat_id',TRUE));
   $data['scheme_id'] = $this->checkEmptyValue($this->input->post('scheme_id',TRUE));
    $data['location'] = $this->checkEmptyValue($this->input->post('location',TRUE));
    //$data['circle_id'] = $this->checkEmptyValue($this->input->post('circle_id',TRUE));
    $data['wing_id'] = $this->checkEmptyValue($this->input->post('wing_id',TRUE));
    $data['division_id'] = $this->checkEmptyValue($this->input->post('project_division',TRUE));
    $data['project_cost'] = $this->checkEmptyValue($this->input->post('project_cost',TRUE));

    return $data;
}

function fetch_data_from_db($update_id){
    $result = $this->Project_creation_model->fetchMasterData('project_creation', 'id', $update_id);
    foreach ($result as $row) {
    $data['project_name'] = $row->project_name;
    $data['cat_id'] = $row->cat_id;
    $data['scheme_id'] = $row->scheme_id;;
    $data['location'] = $row->location;
    $data['circle_id'] = $row->circle_id;
    $data['wing_id'] = $row->wing_id;
    $data['division_id'] = $row->division_id;
    $data['project_cost'] = $row->project_cost;

    }
    if(!isset($data)){
        $data = '';
    }
    return $data;
}


    /* Start call back function for checking same name Updated On 16-08-2021 */
    function check_project_name(){
        $project_name = $this->input->post('project_name',TRUE);
        $project_id = base64_decode($_REQUEST['project_id']);
        if(is_numeric($project_id)){
            $where_check = array('id !=' => $project_id,'project_name' => $project_name);
           $exist_count = $this->Project_creation_model->check_table_data_exist_or_not_condition('project_creation',$where_check);
        }else{
            $where_check = array('project_name' => $project_name);
           $exist_count = $this->Project_creation_model->check_table_data_exist_or_not_condition('project_creation',$where_check);
        }
        if($exist_count > 0) { 
            $this->form_validation->set_message('check_project_name', 'This %s already exists.');

            return FALSE;
         }  else {
            return TRUE;
         }
    }
    /* End call back function for checking same name Updated On 16-08-2021 */





 function file_upload_data()
    {
        

        $file_name = $this->input->post('file_name');

        if( !empty($_FILES['file1'])) {
            if (!is_dir('uploads/temp/')) {
                      mkdir('./uploads/temp', 0777, TRUE);

                  }


               $target_dir = "uploads/temp/";

               $f_name = preg_replace('/\s+/', '_', $_FILES['file1']['name']);
               $fileName = rand(11,999999).'_'.$f_name;

               $target_file = $target_dir . $fileName;

                  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

               // Check file size
                if ($_FILES["file1"]["size"] > 50000000) {
                 $sizeOk = 0;
                }
                else {
                    $sizeOk = 1;
                }


       // Allow certain file formats
       if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" && $imageFileType != "gif" && $imageFileType != "txt" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx"  ) {
                   
                 $uploadOk = 0;
          }
          else {
            $uploadOk = 1;
          }


             // Check if $uploadOk is set to 0 by an error
            if ($sizeOk == 0 || $uploadOk == 0) {
                
                echo "No";
              } 

        else {

             //echo 'Else condition called';

                if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file)) {


                    $file_link = base_url().'uploads/temp/'.$fileName;

                    $path = 'uploads/temp/'.$fileName;
                    $file_size = formatSizeUnits(filesize($path));
                    
                    $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                    $input_data = '<input type="hidden" name="hidden_file_name[]" value="'.$file_name.'"><input type="hidden" name="hidden_file_url[]" value="'.$fileName.'">';
                    echo "<tr>$input_data<td>$file_name</td><td>$file_size</td><td>$file_d_link</td>";


                } else {
                  echo "No";
              }

           }


       }

            else {
                echo "No";
             }
    }

    function file_upload_on_server($hidden_file_name,$hidden_file_url,$project_id,$table_name){
        if (!is_dir('uploads/attachment/')) {
              mkdir('./uploads/attachment', 0777, TRUE);
          }
        if(!empty($hidden_file_name)){
            foreach ($hidden_file_name as $key => $value) {

                $temp_des = 'uploads/temp/'.$hidden_file_url[$key];
                $move_des = 'uploads/attachment/'.$hidden_file_url[$key];
                if (copy($temp_des,$move_des)) {
                      unlink($temp_des);
                }
               $file_data['file_name '] = $value;
                $file_data['file_path '] = $hidden_file_url[$key];
                $file_data['project_id'] = $project_id;
                $file_data['added_by'] = $this->session->userdata('id');
                $this->Project_creation_model->insertDatareturnid($file_data, $table_name);
            }
        }
        return true;
    }


    function lists(){
        $admin_id = $this->session->userdata('id');
        $data['project_list_data'] = $this->Project_creation_model->project_list_data($admin_id);
        $this->load->common_template('project/project_creation_list_view', $data);
    }


    public function checkEmptyValue($value)
    {
        return !empty($value) ? $value : NULL;
    }


    function getdivision_list(){
          $circle_id = $this->input->post('circleId');
          if($circle_id!=''){
            $data['all_divisions'] = $this->Project_creation_model->fetch_divisions($circle_id);
            echo  json_encode($data);
          }else{
                  
          }
    }

 function getdivision_data($wing_id,$division_id){
      
        if($wing_id != 0 || $circle_id != ''){
           
            $all_divisions = $this->Project_creation_model->fetch_divisions($wing_id);
            
                foreach ($all_divisions as $key) {
                
                   ?>
                    <!-- <option value="<?php echo $key->id; ?>"><?php echo $key->division_name; ?></option> -->
                     <option value="<?php echo $key->id; ?>" <?php if($key->id == $division_id){ echo "selected"; } ?>><?php echo $key->division_name; ?></option>
                    <?php 
                  }  

          }
        
  }



}