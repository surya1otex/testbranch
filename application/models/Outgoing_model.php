<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class Outgoing_model extends CI_Model {
	
function __construct(){
    parent :: __construct();
    //Load email library
    $this->load->library('email');
	$this->load->helper('path');
	$this->load->helper('directory'); 
    $this->load->helper(array('url','html','form'));
}	
	
//Dynamic Email Function
function sendEmail($recipientArr, $ackSubject, $messgArrs){



    require_once APPPATH."core/PHPMailer/src/Exception.php";
    require_once APPPATH. "core/PHPMailer/src/PHPMailer.php";
    require_once APPPATH. "core/PHPMailer/src/SMTP.php";


	//require_once APPPATH."core/PHPmailer/class.phpmailer.php";
	//require_once APPPATH."core/PHPmailer/class.smtp.php";
	
		
    $data['project_delayed_deatail']= $messgArrs;
		
								$mail = new PHPMailer();
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "smtp.gmail.com";
								$mail->Port = 465; 
								$mail->IsHTML(true);
								$mail->Username = "cmm.obcc@gmail.com";
								//password = Cmm@12345
								$mail->Password = "fihjznaxiwxximkf";
								$mail->From     = "cmm.obcc@gmail.com";
								$mail->FromName = "CMMA";
		    					$mail->isHTML(true);
								if(!empty($recipientArr)) {
								
								 foreach($recipientArr as $values){
								$mail->ClearAllRecipients();	 
								 $mail->AddAddress($values['email_id'],$values['name']);
		    					 $mail->Subject = $ackSubject.' - '.date('jS M, Y - g:i a');
								
								$arrayLength = count($recipientArr);
								
								$data['to_email_name'] = $values['name'];
									

								 $message = $this->load->view('dashboard/mail',$data,TRUE);
								//echo $message;
								 $mail->Body    = $message;
										 
								//echo $mail->Body;
								 $mail->send();
								 }
								}
			
	
		    $mail->wordWrap = 150; 
		   
		
			echo 'Message: ' .$mail->ErrorInfo."<br>";
		
}


//Dynamic Email Function for stakeholder from md
function sendEmailtoStakeholder($email_id,$name, $mailSubject, $project_deatail,$sender_details,$text_message){

	require_once APPPATH."core/PHPmailer/class.phpmailer.php";
	require_once APPPATH."core/PHPmailer/class.smtp.php";

    
    

		
								$mail = new PHPMailer();
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "smtp.gmail.com";
								$mail->Port = 465; 
								$mail->IsHTML(true);
								$mail->Username = "cmm.obcc@gmail.com";
								$mail->Password = "fihjznaxiwxximkf";
								$mail->From     = "cmm.obcc@gmail.com";
								$mail->FromName = "CMMA";
		    					$mail->isHTML(true);  
								//$mail->AddAddress($all_rec_email);
								if(!empty($email_id)) {
								
								$mail->ClearAllRecipients();	 
								 $mail->AddAddress($email_id,$name);
		    					 $mail->Subject = $mailSubject.' - '.date('jS M, Y - g:i a');
								
								$data['to_email_name'] = $name;
								$data['project_deatail']= $project_deatail;
    							$data['sender_details']= $sender_details;
    							$data['text_message']= $text_message;	

								 $message = $this->load->view('dashboard/stakeholder_email_view',$data,TRUE);
								
								 $mail->Body    = $message;
										 
								//echo $mail->Body;
								 $mail->send();
								
								}
			
	
		    $mail->wordWrap = 150; 
		     return true;
		     //echo 'Message: ' .$mail->ErrorInfo."<br>";
		
}



//Dynamic Email Function for MD from Stakeholders
function sendEmail_to_MD($recipientArr, $ackSubject, $project_deatail,$sender_details,$text_message){

	require_once APPPATH."core/PHPmailer/class.phpmailer.php";
	require_once APPPATH."core/PHPmailer/class.smtp.php";
	
    $data['project_delayed_deatail']= $messgArrs;
    

		
								$mail = new PHPMailer();
								$mail->IsSMTP(); // enable SMTP
								$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
								$mail->Host = "smtp.gmail.com";
								$mail->Port = 465; 
								$mail->IsHTML(true);
								$mail->Username = "cmm.obcc@gmail.com";
								$mail->Password = "fihjznaxiwxximkf";
								$mail->From     = "cmm.obcc@gmail.com";
								$mail->FromName = "CMMA";
		    					$mail->isHTML(true);  
								//$mail->AddAddress($all_rec_email);
								if(!empty($recipientArr)) {
								
								 foreach($recipientArr as $values){
								$mail->ClearAllRecipients();	 
								 $mail->AddAddress($values['email_id'],$values['name']);
		    					 $mail->Subject = $ackSubject.' - '.date('jS M, Y - g:i a');
								
								$arrayLength = count($recipientArr);
								
								$data['to_email_name'] = $values['name'];
								$data['project_deatail']= $project_deatail;
    							$data['sender_details']= $sender_details;
    							$data['text_message']= $text_message;
									

								 $message = $this->load->view('dashboard/md_email_view',$data,TRUE);
								//echo $message;
								 $mail->Body    = $message;
										 
								//echo $mail->Body;
								 $mail->send();
								 }
								}
			
	
		    $mail->wordWrap = 150; 
		    
			return true;
		
}

}
