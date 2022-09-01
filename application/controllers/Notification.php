<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MY_Controller
{ 

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Outgoing_model');
        $this->load->model('User_model');

    }


public function delayed(){
	
						$recipient_data = $this->User_model->get_higher_level_recipient();
						$messgArrs = $this->User_model->get_delayed_project_Alldata();
						

						$ackSubject = "Delayed Project Notification";

						
						$sendSuccessMail = $this->Outgoing_model->sendEmail($recipient_data,$ackSubject,$messgArrs);
	
	
	
	
}


}  
 

?>