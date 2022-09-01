<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Negotiation extends MY_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('pagination');
       // $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'security','project_helper','pre_con_act_quick_nav_helper','tendering_stepsbar_helper'));
        $this->load->model('Negotiation_model');
        /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        
    }

    public function manage()
    {
        $user_id = $this->session->userdata('id');
        $project_id = base64_decode($_REQUEST['project_id']); 
        $data['project_id'] = base64_decode($_REQUEST['project_id']);
        $projectData_exist_flag = $this->Negotiation_model->checkProjectExits($project_id);
        $data['get_negotiation'] = $this->Negotiation_model->getnegotiation($project_id);

        $data['negotiation_data'] = $this->Negotiation_model->negotiation_data($project_id);

        $data['negotiation_data_update'] = $this->Negotiation_model->negotiation_data_update($project_id);

        // $this->form_validation->set_rules('remarks', 'Remarks', 'required'); 

        if(!empty($data['negotiation_data'])){
           
            $data['negotiation_data'] = $this->Negotiation_model->negotiation_data($project_id);
           // $data['negotiation_added_data'] = $this->Negotiation_model->negotiation_added_data($project_id);
         }

         else{
             $data['negotiation_data_form_technical'] = $this->Negotiation_model->negotiation_data_form_technical($project_id);
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
                         
                            $negotiation_id = $data['get_negotiation'][0]['id'];
                            $EE_last_data =$this->Negotiation_model->updatenego($db_data,$negotiation_id);
                         }
                     
                         else {
                            $EE_last_data =$this->Negotiation_model->savenegotiation($db_data);//ADD
                           }


                        $bidder_refno_count = count($_REQUEST['negobiddername']);
                        $bidder_refno = $this->input->post('negobidderid');
                        $meeting_date = $this->input->post('negomeetingdate');
                        //$bid_value = $this->input->post('negobidvalue');
                         $bid_value = str_replace(',','',$this->input->post('negobidvalue'));
                        $status = $this->input->post('negotiation_status');
                        $hidden_doc = $_REQUEST['hiddennego_doc'];
                       
                        if (!is_dir('uploads/files/negotiation')) {
                            mkdir('./uploads/files/negotiation');
                         } 
                        $config['upload_path']          = 'uploads/files/negotiation/';
                        $config['allowed_types']        = 'gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|txt|pdf|doc|docx';
                        $config['max_size']             = 2000000;

                        for ($i=0; $i < $bidder_refno_count; $i++) {


                           $filename = rand(11,999999). time().'_'.$_FILES['nego_doc']['name'][$i];
                              $this->load->library('upload',$config);

                              $_FILES['file']['name'] = $filename;
                              $_FILES['file']['type'] = $_FILES['nego_doc']['type'][$i];
                              $_FILES['file']['tmp_name'] = $_FILES['nego_doc']['tmp_name'][$i];                            
                            
                             $this->upload->do_upload('file');

                             $filename = $this->upload->data("file_name");

                                     $db_data = array(
                                        'project_id' => $project_id, 
                                        'tendering_negotiation_id' => $EE_last_data,
                                        'bidder_id' => $bidder_refno[$i],
                                        'negotiation_meeting_date' => $meeting_date[$i], 
                                        'negotiation_bid_value' => $bid_value[$i],
                                        'successful_bidder_response' => $filename,
                                        'negotiation_status' => ($status[$i]== 'Y') ? 'Y' : 'N', 
                                        'entered_by' => $user_id
                                        );

                                  // echo '</pre>';
                                  // print_r($db_data );

                                     if(!empty($projectData_exist_flag)){//UPDATE

                                         $nego_id = $data['negotiation_data_update'][$i]['id'];

                                         if(empty($_FILES['nego_doc']['name'][$i])) {

                                          $filename = $_REQUEST['hiddennego_doc'][$i];

                                         }
                                         else {
                                    
                                               $filename = $filename;
                                          }
                                         if(!empty($nego_id)){
                                            $UaddData = array(
                                            'project_id' => $project_id, 
                                            'tendering_negotiation_id' => $negotiation_id,
                                            'negotiation_meeting_date' => $meeting_date[$i], 
                                            'negotiation_bid_value' => $bid_value[$i],
                                            'bidder_id' => $bidder_refno[$i],
                                            'successful_bidder_response' => $filename, 
                                            'negotiation_status' => ($status[$i]== 'Y') ? 'Y' : 'N', 
                                            'entered_by' => $user_id
                                        ); 

                                            echo '<pre>';
                                            print_r($UaddData );
                                
                                          $this->Negotiation_model->updatenegoid($UaddData,$nego_id);
                                      }


                                   else{

                                    $adddata = array(
                                        'project_id' => $project_id, 
                                        'tendering_negotiation_id' => $negotiation_id,
                                        'negotiation_meeting_date' => $meeting_date[$i], 
                                        'negotiation_bid_value' => $bid_value[$i],
                                        'bidder_id' => $bidder_refno[$i],
                                        'successful_bidder_response' => $filename,
                                        'negotiation_status' => ($status[$i]== 'Y') ? 'Y' : 'N',  
                                        'entered_by' => $user_id
                                        );

                                            echo '<pre>';
                                            print_r($adddata );
                                        
                                     $this->Negotiation_model->addnegotiation($adddata);
                                   }
                              }

                            else{
  
                                    $this->Negotiation_model->addnegotiation($db_data);

                            }

                        }

                    }

              $this->session->set_flashdata('success', 'Negotiation saved successfully');
                  if($project_id){
                       redirect('Negotiation/manage?project_id=' . base64_encode($project_id));
                    }
            }

             $this->load->common_template('tendering/negotiation', $data);
    }
     
}
?>
