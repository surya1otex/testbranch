<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class GoogleChatbot extends MY_Controller {
	
	public function __construct() 
	{
                  parent::__construct();
		//$this->load->model('outgoing_email_log_tracker_model');
	}	




	function index(){
		//$json = file_get_contents('php://input');
// 		 $json = '{
//   "responseId": "52fa43e6-409e-4207-bb43-e7a39e7ff451-b4cb2fcf",
//   "queryResult": {
//     "queryText": "Somnath",
//     "action": "name",
//     "parameters": {
//       "name": "Somnath"
//     },
//     "allRequiredParamsPresent": true,
//     "outputContexts": [
//       {
//         "name": "projects/applicantbot-hyec/agent/sessions/webdemo-122dac28-9587-a61f-0662-64829b26f263/contexts/__system_counters__",
//         "parameters": {
//           "no-input": 0,
//           "no-match": 0,
//           "name": "Somnath",
//           "name.original": "Somnath"
//         }
//       }
//     ],
//     "intent": {
//       "name": "projects/applicantbot-hyec/agent/intents/38b06cd0-7f83-40f6-9844-6f27bce634f6",
//       "displayName": "testIntent"
//     },
//     "intentDetectionConfidence": 1,
//     "languageCode": "en"
//   },
//   "originalDetectIntentRequest": {
//     "payload": {}
//   },
//   "session": "projects/applicantbot-hyec/agent/sessions/webdemo-122dac28-9587-a61f-0662-64829b26f263"
// }';
// 		// Converts it into a PHP object
// 		 $get_data = (array) json_decode($json);
// 		// echo "<pre>";
// 		// print_r($get_data);
// 		// echo "</pre>";
	
// 		// foreach($get_data as $g){
// 		// 	$outputContexts = $g->outputContexts;
// 		// }

// 		// print_r($outputContexts);

// 	$queryResult[] = $get_data['queryResult'];
// 	echo "<pre>";
// 	print_r($queryResult);
// 	echo "</pre>";

// 	 $parameters = $queryResult[0]['parameters'];
// 	echo "<pre>";
// 	print_r($parameters);
// 	echo "</pre>";

		$res = "Name is Amit Samanta";

		$r = '{
  "fulfillmentMessages": [
    {
      "text": {
        "name": [
          "Response From Amit"
        ]
      }
    }
  ]
}';
return $r;
		
	}

}