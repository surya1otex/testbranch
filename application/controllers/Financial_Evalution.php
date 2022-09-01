<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Financial_Evalution extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
        //$this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper','tendering_stepsbar_helper'));
        $this->load->model('Financial_evalution_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

   function delete_single_user()  
      {  
           $this->Financial_evalution_model->delete_single_user($_POST["user_id"]);  
          //$this->Financial_evalution_model->delete_single_user($user_id); 
           //echo 'Data Deleted';  
      }

    public function manage()
    { 
         $user_id = $this->session->userdata('id'); 
         $project_id = base64_decode($_REQUEST['project_id']); 
         $data['project_id'] = base64_decode($_REQUEST['project_id']);

         $projectData_exist_flag = $this->Financial_evalution_model->checkProjectExits($project_id);

         $data['get_financialeval'] = $this->Financial_evalution_model->getfinancialevalution($project_id);

         $data['get_financialevalupdate'] = $this->Financial_evalution_model->getfinancialevalutionupdate($project_id);

         $data['financial_evalution_data'] = $this->Financial_evalution_model->financial_evalution_data($project_id);

         if(!empty($data['financial_evalution_data'])){
           
           $data['financial_evalution_data'] = $this->Financial_evalution_model->financial_evalution_data($project_id);
           $data['financial_evalution_added_data'] = $this->Financial_evalution_model->financial_evalution_added_data($project_id);
         }

         else{
            $data['financial_evalution_data_form_technical'] = $this->Financial_evalution_model->financial_evalution_data_form_technical($project_id);
         }

         
         if(!empty($_REQUEST['submit'])){

                 $submit = $this->input->post('submit');
                    if($submit == 'Submit'){

                         $db_data['project_id'] = $project_id;
                         if(empty($_REQUEST['approval_date'])){
                            $db_data['approval_date'] = '0000-00-00';
                            }
                            else{
                            $db_data['approval_date'] = $_REQUEST['approval_date'];
                            }
                           if(empty($_REQUEST['approval_status'])){
                                $db_data['approval_status'] = 'P';  
                            }
                            else{
                                $db_data['approval_status'] = $_REQUEST['approval_status'];
                            }

                         $db_data['remarks'] = $_REQUEST['remarks'];
                         $db_data['entered_by'] = $user_id;

                         if(!empty($projectData_exist_flag)){  //UPDATE
                         
                            $financialeval_id = $data['get_financialeval'][0]['id'];
                            $EE_last_data =$this->Financial_evalution_model->updatefinancial($db_data,$financialeval_id);
                         }
                     
                         else {
                            $EE_last_data =$this->Financial_evalution_model->savefinancial($db_data);//ADD
                           }

                        $bidder_refno_count = count($_REQUEST['finbidder_refno']);
                        //$bidder_refno = $this->input->post('finbidder_refno');
                        $bidder_refno = $this->input->post('finbidder_refnoid');
                        //$success_bid_value = $this->input->post('finsucc_bidvalue');
                        $success_bid_value = str_replace(',','',$this->input->post('finsucc_bidvalue'));
                        $success_bidder_name = $this->input->post('finsucc_biddername');
                        $final_score = $this->input->post('final_score');
                        //$techevnupdateid = $this->input->post('hidden_tech_updateid');
                      
                         for ($i=0; $i < $bidder_refno_count; $i++) { 

                                     $db_data = array(
                                        'project_id' => $project_id, 
                                        'tendering_financial_evalution_id' => $EE_last_data,
                                        'bidder_ref_no' => $bidder_refno[$i],
                                        //'bid_value' => $success_bid_value[$i], 
                                        'bid_value' => $success_bid_value[$i], 
                                        'final_score' => $final_score[$i], 
                                        'successful_bidder' => $success_bidder_name[$i], 
                                        'entered_by' => $user_id
                                        );     

                          if(!empty($projectData_exist_flag)){//UPDATE
                             

                                // update
                                $techevnupdateid = $data['get_financialevalupdate'][$i]['id'];
                                if(!empty($techevnupdateid)){
                                            $UaddData = array(
                                            'project_id' => $project_id,
                                            'tendering_financial_evalution_id' => $financialeval_id, 
                                            'bidder_ref_no' => $bidder_refno[$i],
                                            'bid_value' => $success_bid_value[$i], 
                                            'final_score' => $final_score[$i], 
                                            'successful_bidder' => $success_bidder_name[$i], 
                                            'entered_by' => $user_id
                                        ); 
                                
                                   $this->Financial_evalution_model->updatefinancialid($UaddData,$techevnupdateid);
                                   }

                                   else{

                                    $addData1 = array(
                                            'project_id' => $project_id,
                                            'tendering_financial_evalution_id' => $financialeval_id, 
                                            'bidder_ref_no' => $bidder_refno[$i],
                                            'bid_value' => $success_bid_value[$i], 
                                            'final_score' => $final_score[$i], 
                                            'successful_bidder' => $success_bidder_name[$i], 
                                            'entered_by' => $user_id
                                        ); 

                                    $this->Financial_evalution_model->addfinancial($addData1);

                                   }
                                 }

                               else {
                                
                                   $this->Financial_evalution_model->addfinancial($db_data);
                                 } 

                         }
                    }

                  $this->session->set_flashdata('success', 'Financial  Data saved successfully');

                  if($project_id){
                       redirect('Financial_Evalution/manage?project_id=' . base64_encode($project_id));
                    }
             }
              $this->load->common_template('tendering/financial_evalution', $data);
      }
}
?>
