<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperAdminDashboard extends MY_Controller {
    public function __construct(){
        parent::__construct();
        // load base_url
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->model('SuperAdminDashboard_model');
        $this->load->helper(array('url','html','form'));
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */

    }
    public  function index(){
		//print_r($this->session->userdata());
		
		$data['organization_list'] = $this->SuperAdminDashboard_model->get_organization();
		
		

        // Get Project Details
       // $organization_id = $this->Procurement_model->getOrganizationId($this->session->userdata('id'));
        $organization_id = 0;
        $data['all_project_details_ar'] = $this->SuperAdminDashboard_model->get_project_details();
        //echo "<pre>"; print_r($data['all_project_details_ar']); die;
        $project_details_ar = array();
        if (!empty($data['all_project_details_ar'])) {
            foreach ($data['all_project_details_ar'] as $key => $value) {
                $project_details_ar[$key]['project_id'] = $value['id'];
                $project_details_ar[$key]['project_name'] = $value['project_name'];
                $project_details_ar[$key]['budget'] = $this->IND_money_format($value['estimate_total_cost']);
                $project_details_ar[$key]['start_date'] = $value['project_start_date'];
                $project_details_ar[$key]['end_date'] = $value['project_end_date'];
                $project_released_amount_ar = $this->SuperAdminDashboard_model->get_project_released_amount($value['id']);
                $project_details_ar[$key]['released'] = $this->IND_money_format(empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount']);
                $project_details_ar[$key]['project_completion_percentage'] = ((empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount'] * 100) / $value['estimate_total_cost']);
            }
        }
        $data['project_details_ar'] = $project_details_ar;
		
        $this->load->common_template('superadmindashboard/dashboard', $data);
    }


  	public function no_to_words($no)
    {
		
		$number = sprintf('%.2f', $no);
		$_float = explode(".", $number);
		$nocnt = strlen($_float[0]);
		
        if ($nocnt == 0) {
            return ' ';

        } else {
            //$n = strlen($no); // 7
            //echo "length: ".$n; //die();
            switch ($nocnt) {
                case 3:
                    $val = $no / 100;
                    $val = round($val, 2);
                    $finalval = $val . " Hundred";
                    break;
                case 4:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 5:
                    $val = $no / 1000;
                    $val = round($val, 2);
                    $finalval = $val . " Thousand";
                    break;
                case 6:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 7:
                    $val = $no / 100000;
                    $val = round($val, 2);
                    $finalval = $val . " Lakh";
                    break;
                case 8:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;
                case 9:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Cr.";
                    break;

                default:
                    $val = $no / 10000000;
                    $val = round($val, 2);
                    $finalval = $val . " Crore";
            }
            return $finalval;

        }
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
	
	public function org_project_summary()
			{
			
	
	 // Preparinng project summary data
        $data['total_project'] = $this->SuperAdminDashboard_model->get_total_project_count();
        $data['ongoing_project'] = $this->SuperAdminDashboard_model->get_ongoing_project_count();
        $data['completed_project'] = $this->SuperAdminDashboard_model->get_completed_project_count();
		//print_r($data['total_project']);
        /*$data['all_project_budget'] = $this->SuperAdminDashboard_model->get_project_budget();
        $data['all_project_budget_words'] = $this->no_to_words($data['all_project_budget'][0]['total_project_budget']);
        $all_project_budget_words_ar = array();
        if (!empty($data['all_project_budget_words'])) {
            $all_project_budget_words_ar = explode(' ', $data['all_project_budget_words']);
            $all_project_budget_number = $all_project_budget_words_ar[0];
            $all_project_budget_suffix = $all_project_budget_words_ar[1];
        } else {
            $all_project_budget_number = 0;
            $all_project_budget_suffix = '';
        }
        $data['all_project_budget_number'] = $all_project_budget_number;
        $data['all_project_budget_suffix'] = $all_project_budget_suffix;

        $data['all_project_released_amount'] = $this->SuperAdminDashboard_model->get_project_released_amount();
        $data['all_project_released_words'] = $this->no_to_words($data['all_project_released_amount'][0]['total_activity_allotted_amount']);
        $all_project_released_words_ar = array();
        if (!empty($data['all_project_released_words'])) {
            $all_project_released_words_ar = explode(' ', $data['all_project_released_words']);
            $all_project_released_number = $all_project_released_words_ar[0];
            $all_project_released_suffix = $all_project_released_words_ar[1];
        } else {
            $all_project_released_number = 0;
            $all_project_released_suffix = '';
        }
        $data['all_project_released_number'] = $all_project_released_number;
        $data['all_project_released_suffix'] = $all_project_released_suffix;

        $data['all_project_pending_amount'] = $data['all_project_budget'][0]['total_project_budget'] - $data['all_project_released_amount'][0]['total_activity_allotted_amount'];
        $data['all_project_pending_words'] = $this->no_to_words($data['all_project_pending_amount']);
        $all_project_pending_words_ar = array();
        if (!empty($data['all_project_pending_words'])) {
            $all_project_pending_words_ar = explode(' ', $data['all_project_pending_words']);
            $all_project_pending_number = $all_project_pending_words_ar[0];
            $all_project_pending_suffix = $all_project_pending_words_ar[1];
        } else {
            $all_project_pending_number = 0;
            $all_project_pending_suffix = '';
        }
        $data['all_project_pending_number'] = $all_project_pending_number;
        $data['all_project_pending_suffix'] = $all_project_pending_suffix;*/
        // #END# Preparinng project summary data
		
		$data['all_project_budget'] = $this->SuperAdminDashboard_model->get_project_budgetamnt();
        $data['all_project_budget_words'] = $this->no_to_words($data['all_project_budget'][0]['total_project_budget']);
		//print_r($data['all_project_budget_words']);
        $all_project_budget_words_ar = array();
        if (!empty($data['all_project_budget_words'])) {
            $all_project_budget_words_ar = explode(' ', $data['all_project_budget_words']);
            $all_project_budget_number = $all_project_budget_words_ar[0];
            $all_project_budget_suffix = $all_project_budget_words_ar[1];
        } else {
            $all_project_budget_number = 0;
            $all_project_budget_suffix = '';
        }
        $data['all_project_budget_number'] = $all_project_budget_number;
        $data['all_project_budget_suffix'] = $all_project_budget_suffix;

        $data['all_project_agreement_amount'] = $this->SuperAdminDashboard_model->get_project_agreement_amount();
        $data['all_project_agreement_words'] = $this->no_to_words($data['all_project_agreement_amount'][0]['proj_agreement_cost']);
        $all_project_agreement_words_ar = array();
        if (!empty($data['all_project_agreement_words'])) {
            $all_project_agreement_words_ar = explode(' ', $data['all_project_agreement_words']);
            $all_project_agreement_number = $all_project_agreement_words_ar[0];
            $all_project_agreement_suffix = $all_project_agreement_words_ar[1];
        } else {
            $all_project_agreement_number = 0;
            $all_project_agreement_suffix = '';
        }
        $data['all_project_agreement_number'] = $all_project_agreement_number;
        $data['all_project_agreement_suffix'] = $all_project_agreement_suffix;
		
		//Expendature amount
		$data['all_project_expen'] = $this->SuperAdminDashboard_model->get_project_expendature();
        $data['all_project_expen_words'] = $this->no_to_words($data['all_project_expen'][0]['total_project_expen']);
		//print_r($data['all_project_expen_words']);
        $all_project_expen_words_ar = array();
        if (!empty($data['all_project_expen_words'])) {
            $all_project_expen_words_ar = explode(' ', $data['all_project_expen_words']);
            $all_project_expen_number = $all_project_expen_words_ar[0];
            $all_project_expen_suffix = $all_project_expen_words_ar[1];
        } else {
            $all_project_expen_number = 0;
            $all_project_expen_suffix = '';
        }
        $data['all_project_expen_number'] = $all_project_expen_number;
        $data['all_project_expen_suffix'] = $all_project_expen_suffix;
			
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
			
	
			$this->load->view('superadmindashboard/org_project_summary', $data);
		}
		
	public function org_project_progress()
			{
			
	
			
			  //$organization_id = 0;
        $data['all_project_details_ar'] = $this->SuperAdminDashboard_model->get_project_details();
        //echo "<pre>"; print_r($data['all_project_details_ar']); die;
        $project_details_ar = array();
        if (!empty($data['all_project_details_ar'])) {
            foreach ($data['all_project_details_ar'] as $key => $value) {
                $project_details_ar[$key]['project_id'] = $value['id'];
                $project_details_ar[$key]['project_name'] = $value['project_name'];
                $project_details_ar[$key]['budget'] = $this->IND_money_format($value['estimate_total_cost']);
                $project_details_ar[$key]['start_date'] = $value['project_start_date'];
                $project_details_ar[$key]['end_date'] = $value['project_end_date'];
                $project_released_amount_ar = $this->SuperAdminDashboard_model->get_project_released_amount($value['id']);
                $project_details_ar[$key]['released'] = $this->IND_money_format(empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount']);
                $project_details_ar[$key]['project_completion_percentage'] = ((empty($project_released_amount_ar[0]['total_activity_allotted_amount']) ? 0 : $project_released_amount_ar[0]['total_activity_allotted_amount'] * 100) / $value['estimate_total_cost']);
            }
        }
        $data['project_details_ar'] = $project_details_ar;
	
			$this->load->view('superadmindashboard/org_project_progress', $data);
		}



}
?>