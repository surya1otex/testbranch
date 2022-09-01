<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');



class Commissioning extends MY_Controller
{

    public $financial_module_permission;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper'));
        $this->load->model('Commissioning_model');
        $this->load->model('Projectdashboard_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }

        /*End fo Check whether logged in */
      	// $this->financial_module_permission = $this->user_access_details(8);
    }

    public function project_list(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        
        $data['project_deatail'] = $this->Commissioning_model->get_commissioning_project_details();
        $this->load->common_template('commission/commissioning_project_list', $data);
    }

     /* Project Destination */
    public function get_destination()
    {
        $area_id = $_REQUEST['area_id'];
        $destination = $this->Commissioning_model->get_project_destination($area_id);
        $html = "";
        //$html.="<option value=''>Select Project Destination</option>";
        foreach ($destination as $des) {
            $html .= "<option value='" . $des['id'] . "'>" . $des['name'] . "</option>";
        }
        echo $html;
        die;
    }

    /* Project Destination End*/
    public function project_sector($sector_id)
    {
        return $this->Commissioning_model->get_sector_id($sector_id);
    }

    public function project_group($group_id)
    {
        return $this->Commissioning_model->get_group_id($group_id);
    }

    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Commissioning_model->get_project_type($type_id);
    }
    /* Project Type End */

    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Commissioning_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Commissioning_model->project_destination($destination_id);
    }
    /* Project Area End */


    public function add_details(){
        $project_id = base64_decode($_REQUEST['project_id']);

        $comp_count =  $this->Commissioning_model->check_field_value_exist_or_not_in_tbl('project_completed_history','project_id',$project_id);

        $submit = $this->input->post('submit');
        if($submit == 'Submit')
            {
            $this->form_validation->set_rules('certificate_issued_date','Construction Completion Certificate issued on','trim|required',array('required' => '%s'));
             $construction_completion_certificate = $this->input->post('construction_completion_certificate'); 
             if($comp_count < 1){
           if (empty($_FILES['construction_completion_certificate']['name']) && empty($construction_completion_certificate))
              {
                  $this->form_validation->set_rules('construction_completion_certificate', 'Construction Completion Certificate', 'required',array('required' => '%s'));
              }

          }

              $this->form_validation->set_rules('final_payment_status','Final Payment done','trim|required',array('required' => '%s'));
              $final_payment_status = $this->input->post('final_payment_status');
              if($final_payment_status == 'Y'){
                $this->form_validation->set_rules('final_payment_date','Final Payment Date','trim|required',array('required' => '%s'));
              }

              $this->form_validation->set_rules('APS_status','APS, if applicable','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('release_retention_amount','Retention amount released','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('hold_retention_amount','Retention amount on hold','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('DLP_starting_date','DLP Starting Date','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('PBG_returning_date','Final PBG Returning Date','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('PBG_return_date','PBG Value at Return Date','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('retention_release_date','Balance Retention amount release date','trim|required',array('required' => '%s'));
              $this->form_validation->set_rules('completion_date','Project Closure Date','trim|required',array('required' => '%s'));
              
            
			
           

             if($this->form_validation->run() == TRUE) {

                $data = $this->fetch_data_from_post();
				/*echo "<pre>";
			  	print_r($this->input->post());
              	print_r($this->form_validation->run);
				
				die;*/
				
               // 

                $old_img = $this->Commissioning_model->getSpecificdata('project_completed_history','project_id',$project_id,'construction_completion_certificate');
                if (!is_dir('uploads/commission')) {
                        mkdir('./uploads/commission', 0777, TRUE);

                }
                $construction_completion_certificate = rand(11,999999).'_'.$_FILES['construction_completion_certificate']['name'];
                
                $config['upload_path'] = './uploads/commission/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx';
                 //$config['max_size'] = 1024;
                $config['file_name'] = $construction_completion_certificate;
                $this->load->library('upload', $config);
                $upload_document = $this->upload->do_upload('construction_completion_certificate');

               $upload_data1 = $this->upload->data();
                $newimg1 = $upload_data1['file_name'];

                if(empty($_FILES['construction_completion_certificate']['name'])){
                    $data['construction_completion_certificate'] = $old_img;
                }else{
                    $data['construction_completion_certificate'] = $newimg1;
                }
               
                $data['project_id'] = $project_id;
                if($comp_count > 0){
                    $Add = $this->Commissioning_model->updateData('project_id', 'project_completed_history', $data, $project_id);
                    $this->session->set_flashdata('message', 'Data Updated Successfully');
                   $rurl = base_url().'Commissioning/add_details?project_id='.base64_encode($project_id);
                redirect($rurl); 
                }else{
                    
                   $Add = $this->Commissioning_model->insertAllData($data, 'project_completed_history'); 
                   $this->session->set_flashdata('message', 'Data Added Successfully');
                   $rurl = base_url().'Commissioning/add_details?project_id='.base64_encode($project_id);
                redirect($rurl); 
                }

                
               
                

            

            

        }

          
        }

        

        if(($comp_count > 0) && ($submit != 'Submit')){
            $data = $this->fetch_data_from_db($project_id);
        }else{
            $data = $this->fetch_data_from_post();
        }

   
		
        

        $data['comp_count'] = $comp_count;
		
		
        $data['project_id'] = $project_id;
		
		//echo "werwer we rwe rwerwerwer";

        $this->load->common_template('commission/add_commissioning_project_data', $data);
    }


    function IND_money_format($number)
    {
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for ($i = 0; $i < $length; $i++) {
            if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
                $delimiter .= ',';
            }
            $delimiter .= $money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if ($decimal != '0') {
            $result = $result . $decimal;
        }

        return $result;
    }

    


    public function get_reported_date($project_id,$work_item_id,$activity_id){
        return $this->Commissioning_model->get_reported_date($project_id,$work_item_id,$activity_id);
    }


    /*fetch data from post */
function fetch_data_from_post(){
    $data['certificate_issued_date'] = $this->input->post('certificate_issued_date',TRUE);
    $data['final_payment_status'] = $this->input->post('final_payment_status',TRUE);
    $data['final_payment_date'] = $this->input->post('final_payment_date',TRUE);
    $data['APS_status'] = $this->input->post('APS_status',TRUE);
    $data['release_retention_amount'] = $this->input->post('release_retention_amount',TRUE);

    $data['hold_retention_amount'] = $this->input->post('hold_retention_amount',TRUE);
    $data['DLP_starting_date'] = $this->input->post('DLP_starting_date',TRUE);
    $data['PBG_returning_date'] = $this->input->post('PBG_returning_date',TRUE);
    $data['PBG_return_date'] = $this->input->post('PBG_return_date',TRUE);
    $data['retention_release_date'] = $this->input->post('retention_release_date',TRUE);
    $data['completion_date'] = $this->input->post('completion_date',TRUE);
    $data['remarks'] = $this->input->post('remarks',TRUE);

    return $data;
}

function fetch_data_from_db($update_id){
    $result = $this->Commissioning_model->fetchSingledata('project_completed_history', 'project_id', $update_id);
    foreach ($result as $row) {
    $data['certificate_issued_date'] = $row->certificate_issued_date;
    $data['construction_completion_certificate'] = $row->construction_completion_certificate;
    $data['final_payment_status'] = $row->final_payment_status;;
    $data['final_payment_date'] = $row->final_payment_date;
    $data['APS_status'] = $row->APS_status;
    $data['release_retention_amount'] = $row->release_retention_amount;


    $data['hold_retention_amount'] = $row->hold_retention_amount;
    $data['DLP_starting_date'] = $row->DLP_starting_date;
    $data['PBG_returning_date'] = $row->PBG_returning_date;;
    $data['PBG_return_date'] = $row->PBG_return_date;
    $data['retention_release_date'] = $row->retention_release_date;
    $data['completion_date'] = $row->completion_date;
    $data['remarks'] = $row->remarks;
    }
    if(!isset($data)){
        $data = '';
    }
    return $data;
}


public function check_field_value_exist_or_not_in_tbl($tbl,$field,$value){
    return $this->Commissioning_model->check_field_value_exist_or_not_in_tbl($tbl,$field,$value);
}


  public function project_milestone_activity($milestone_id,$project_id)
    {
        return $this->Commissioning_model->get_project_milestone_activity($milestone_id,$project_id);
    }
	
	
	  public function project_progress_activity($milestone_id,$activity_id,$project_id)
    {
       return  $this->Commissioning_model->project_milestone_activity($milestone_id,$activity_id,$project_id);
		
		
    }


}