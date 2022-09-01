<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-Type: application/json; charset=utf-8');


class Apicontroller extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('session');
		$this->load->model('Home_model');
    }



	public function login()
	{
		$logresponse = [];
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {

		   $params = json_decode(file_get_contents('php://input'), TRUE);
		      $data = array(
                 'username' => $params['username'],
                 'password' => $params['password']
            );

		   $result = $this->Home_model->login($data);
		   $role_data = $this->Home_model->login_roledata($result[0]['role_id']);

            if(!empty($result)){

				$key = bin2hex(random_bytes(32));
				
				$apidetails = array(
				        'user_id'  => $result[0]['id'],                        
                        'username' => $result[0]['username'],
                        'role_id'  => $result[0]['role_id'],
                        'user_type' => $result[0]['user_type'],
                        'role_name' => $result[0]['role_name'],
                        'circle_id' => $result[0]['circle_id'],
                        'division_id' => $result[0]['division_id'],
                        'token'    => $key
				);
				$this->Home_model->savetoken($apidetails);
				//$this->session->set_userdata($Login_details);
			}


           array_push($logresponse, ['username' => $result[0]['username'], 'token' => $key]);

		            if($result) {
		                echo json_encode($logresponse);


		            }
		            else {
		            	echo json_encode(['status' => 'Username or Password incorrect']);
		            }
				
			//}

		            //echo json_encode($result);
		}
	}

	public function logout()
	{	
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        	$response = $this->MyModel->logout();
				json_output($response['status'],$response);
			}
		}
	}
	
}