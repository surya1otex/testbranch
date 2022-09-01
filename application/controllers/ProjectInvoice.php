<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProjectInvoice extends MY_Controller {

    public function __construct(){
        parent::__construct();
        // load base_url
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper(array('url','html','form'));
        $this->load->model(array('Project_model','Project_invoice_model','Master_model'));
        /*To Check whether logged in */
        $logged_in= $this->session->userdata('is_logged_in');
        if(empty($logged_in)){
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */


    }
    public  function index(){

        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
       
        $data['project_deatail'] = $this->Project_model->get_project_details('');
        $data['finalcial_module_permission'] = $this->financial_module_permission[0]['view'];
        $this->load->common_template('project-invoice/project_invoice_list', $data);

    }
    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Project_model->get_project_type($type_id);
    }
    /* Project Type End */

    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Project_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Project_model->project_destination($destination_id);
    }
    public  function check_payment_histroy( $invoice_id  ){
        $history_count = $this->Project_invoice_model->check_payment_histroy($invoice_id);
        if( $history_count[0]['total_history_count'] > 0 ){
            return false;
        }else{
            return true;
        }
    }
    public function invoice_list(){

        $project_id = base64_decode($_REQUEST['project_id']);
        $data['project_details'] = $this->Project_invoice_model->get_project_single_data($project_id);
        $area_name = $this->Project_model->get_project_area($data['project_details'][0]['project_area']);
        $project_type = $this->Project_model->get_project_type($data['project_details'][0]['project_type']);
        $data['project_details'][0]['area_name'] = $area_name[0]['name'];
        $data['project_details'][0]['type_name'] = $project_type[0]['project_type'];
        $data['invoice_list'] = $this->Project_invoice_model->get_invoice_list($project_id);

        for( $k = 0; $k < count($data['invoice_list']); $k++){
            $invoice_id = $data['invoice_list'][$k]['id'];
            $amunt = $this->Project_invoice_model->get_total_paid_amount_invoice($invoice_id);
            //echo "<pre>"; print_r($amunt);
            $data['invoice_list'][$k]['amount_paid'] = ($amunt[0]['total_paid_amount'] > 0 ) ? $amunt[0]['total_paid_amount'] : 0;
            //$data['invoice_list'][$k]['due_amount'] = $amunt[0]['total_amount'];
        }
        $this->load->common_template('project-invoice/invoice_list',$data);

    }
    public function  add_invoice(){

        $project_id = base64_decode($_REQUEST['project_id']);
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
        $data['vendors'] = $this->Project_invoice_model->get_all_vendors();
        $data['head'] = $this->Project_invoice_model->get_all_head();
        $data['project_details'] = $this->Project_invoice_model->get_project_single_data($project_id);
        $area_name = $this->Project_model->get_project_area($data['project_details'][0]['project_area']);
        $project_type = $this->Project_model->get_project_type($data['project_details'][0]['project_type']);
        $data['project_details'][0]['area_name'] = $area_name[0]['name'];
        $data['project_details'][0]['type_name'] = $project_type[0]['project_type'];

        if (!empty($_REQUEST['submit'])  ) {

            $this->invoice_amount_validation($_REQUEST);

            $invoice_data['invoice_no'] = $_REQUEST['invoice_no'];

            $invoice_data['invoice_date'] = $_REQUEST['invoice_date'];
            $invoice_data['project_id'] = $project_id;
            $invoice_data['vendor_id'] = $_REQUEST['vendor'];
            $invoice_data['remarks'] = $_REQUEST['remarks'];
            if( !empty($_REQUEST['invoice_id']) ){
                $invoice_id = base64_decode($_REQUEST['invoice_id']);
                $this->Project_invoice_model->update('project_invoice',$invoice_data,$invoice_id);
            }else{
                $invoice_id = $this->Project_invoice_model->add('project_invoice',$invoice_data);
            }

            

            $insert_flag = 0;
            $invoice_details = [];

            $this->Project_invoice_model->clean_up_old_details($invoice_id);
            for($k = 0 ; $k < count($_REQUEST['head']); $k++){
                $invoice_details['invoice_id'] = $invoice_id;
                $invoice_details['major_head_id'] = $_REQUEST['head'][$k];
                $invoice_details['details'] = $_REQUEST['details'][$k];
                $invoice_details['amount'] = $_REQUEST['amount'][$k];
                //echo "<pre>"; print_r($invoice_details);
                $invoice_details_id = $this->Project_invoice_model->add('project_invoice_details',$invoice_details);
                if($invoice_details_id > 0 ){
                    $insert_flag++;
                }
            }

            if($invoice_id > 0 && $insert_flag > 0 ){
                $this->session->set_flashdata('success', 'Data inserted successfully.');
                redirect('projectInvoice/invoice_list?project_id='.$_REQUEST['project_id']);
            }
        }
        $this->load->common_template('project-invoice/add_invoice',$data);
    }
    public function invoice_amount_validation( $data ){
        if(empty($data['project_id']) ){

            $this->session->set_flashdata('danger', 'Invaild request ,please try again later.');
            redirect('Project/project_list');
        }
        $total_amount = $data['amount_paid'];
        $amount_details_arr = $data['amount'];
        $amt = 0;
        for ($i = 0 ;  $i < count($amount_details_arr); $i++){
            $amt+= $amount_details_arr[$i];
        }

        if( $amt != $total_amount){

            $this->session->set_flashdata('danger', 'Invoice amount is not equal to amount beakup details please try again later.');
            redirect('ProjectInvoice/invoice_list');
        }
    }
    public function get_vendor_name( $vendor_id ){
        return $this->Master_model->get_vendor_details($vendor_id);
    }
    public function get_total_invoice_amount( $invoice_id ){
       return $this->Project_invoice_model->get_total_amount( $invoice_id );
    }

    public function pay_invoice(){

        $invoice_id = base64_decode($_REQUEST['invoice_id']);
        $invoice_details = $this->Project_invoice_model->get_invoice_details($invoice_id);
        $project_id = $invoice_details[0]['project_id'];
        $data['invoice_details'] = $invoice_details;

        $data['project_details'] = $this->Project_invoice_model->get_project_single_data($project_id);
        $area_name = $this->Project_model->get_project_area($data['project_details'][0]['project_area']);
        $project_type = $this->Project_model->get_project_type($data['project_details'][0]['project_type']);
        $data['project_details'][0]['area_name'] = $area_name[0]['name'];
        $data['project_details'][0]['type_name'] = $project_type[0]['project_type'];
        $data['total_amount'] = $this->get_total_invoice_amount($invoice_id);
        $data['invoice_breakup_details'] = $this->Project_invoice_model->get_invoice_breakup_details($invoice_id);
        $data['invoice_head_arr'] = $this->Project_invoice_model->get_invoice_account_head($invoice_id);

        $data['payment_history'] = $this->payment_history($invoice_id);

        
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
       
        $data['head'] = $this->Project_invoice_model->get_all_head();

        $this->load->common_template('project-invoice/pay_invoice',$data);
    }
    public function view_invoice(){

        $invoice_id = base64_decode($_REQUEST['invoice_id']);
        $invoice_details = $this->Project_invoice_model->get_invoice_details($invoice_id);
        $project_id = $invoice_details[0]['project_id'];
        $data['invoice_details'] = $invoice_details;

        $data['project_details'] = $this->Project_invoice_model->get_project_single_data($project_id);
        $area_name = $this->Project_model->get_project_area($data['project_details'][0]['project_area']);
        $project_type = $this->Project_model->get_project_type($data['project_details'][0]['project_type']);
        $data['project_details'][0]['area_name'] = $area_name[0]['name'];
        $data['project_details'][0]['type_name'] = $project_type[0]['project_type'];
        $data['total_amount'] = $this->get_total_invoice_amount($invoice_id);
        $data['invoice_breakup_details'] = $this->Project_invoice_model->get_invoice_breakup_details($invoice_id);
        $data['invoice_head_arr'] = $this->Project_invoice_model->get_invoice_account_head($invoice_id);

        $data['payment_history'] = $this->payment_history($invoice_id);

        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
         
        $data['head'] = $this->Project_invoice_model->get_all_head();

        $this->load->common_template('project-invoice/view_invoice',$data);
    }
    public function payment_history( $invoice_id ){
        $payment_history = $this->Project_invoice_model->get_payment_histoy($invoice_id);

        $history_details = [];
        foreach ( $payment_history as $history){
            $date = $history['payment_date'];
            if( !isset($history_details[$date])){
                $history_details[$date] = [];
            }
            $history_details[$date][] = $history;
        }
        return $history_details;
    }
    public function get_head_name( $head_id ){
        return $this->Project_invoice_model->get_head_details( $head_id );
    }
    public function get_due_amount( $account_head_id,$invoice_id){


        $history = $this->checkPaymentHistory( $account_head_id ,$invoice_id );
        if( $history[0]['totalRow'] > 0 ){
            $due_details = $this->Project_invoice_model->get_due_amount( $account_head_id ,$invoice_id );
            $due_amount = $due_details[0]['due_amount'];

        }else{
            $due_details =  $this->Project_invoice_model->get_total_amount( $invoice_id,$account_head_id  );
            $due_amount = $due_details[0]['total_amount'];
        }

        return $due_amount;
    }
    public function get_total_head_amount( $invoice_id,$account_head_id ){
        $total_head_amount = $this->Project_invoice_model->get_total_amount( $invoice_id,$account_head_id  );
        return $total_head_amount[0]['total_amount'];
    }
    public function checkPaymentHistory( $account_head_id ,$invoice_id ){
        return $this->Project_invoice_model->checkPayment($account_head_id,$invoice_id);
    }
    public function payment_invoice(){


        $invoice_id =$_REQUEST['invoice_id'];
        $invoice_head_arr = $this->Project_invoice_model->get_invoice_account_head($invoice_id);
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
        
        for( $i = 0; $i < count($invoice_head_arr); $i++){
            $major_head_id = $invoice_head_arr[$i]['major_head_id'];
            if( !empty($_REQUEST['account_head'][$major_head_id])) {
                if(!empty($_REQUEST['account_head'][$major_head_id]['amount_paid'])  && (int)$_REQUEST['account_head'][$major_head_id]['amount_paid'] > 0) {
                    $payment_details['payment_date'] = $_REQUEST['payment_date'];
                    $payment_details['invoice_id'] = $_REQUEST['invoice_id'];
                    $payment_details['major_head_id'] = $major_head_id;
                    $payment_details['remarks'] = $_REQUEST['account_head'][$major_head_id]['remarks'];
                    $paid_amount = $_REQUEST['account_head'][$major_head_id]['amount_paid'];
                    $due_amount = $_REQUEST['account_head'][$major_head_id]['due_amount'];
                    $payment_details['paid_amount '] = $paid_amount;
                    $payment_details['due_amount '] = ($due_amount > $paid_amount) ? ($due_amount - $paid_amount) : 0;
                    //print_r($payment_details);
                    $history_id[$i]['id'] = $this->Project_invoice_model->add('project_invoice_payment_history',$payment_details);
                }
            }else{
                $this->session->set_flashdata('danger', 'Invaild request please try again later.');
                redirect('ProjectInvoice/pay_invoice?invoice_id='.base64_encode($invoice_id));
            }
        }
        if( !empty($history_id )  ){

            $this->session->set_flashdata('success', 'Data inserted successfuly.');

        }else{
            $this->session->set_flashdata('danger', 'Please try again later.');
        }
        $invoice_details = $this->Project_invoice_model->get_invoice_details($invoice_id);

        redirect('ProjectInvoice/invoice_list?project_id='.base64_encode($invoice_details[0]['project_id']));
    }
    public function edit_invoice(){

        $invoice_id = base64_decode($_REQUEST['invoice_id']);
        $project_id = base64_decode($_REQUEST['project_id']);
        $data['invoice_details'] = $this->Project_invoice_model->get_invoice_details($invoice_id);
        $total_invoice_amount = $this->get_total_invoice_amount($invoice_id);
        $data['invoice_details'][0]['total_amount'] = $total_invoice_amount[0]['total_amount'];
        $data['invoice_breakup_details'] = $this->Project_invoice_model->get_invoice_breakup_details($invoice_id);

        
        $user_id = $this->session->userdata('id');
          $user_type = $this->session->userdata('user_type');
       
        $data['vendors'] = $this->Project_invoice_model->get_all_vendors();
        $data['head'] = $this->Project_invoice_model->get_all_head();
        $data['project_details'] = $this->Project_invoice_model->get_project_single_data($project_id);
        $area_name = $this->Project_model->get_project_area($data['project_details'][0]['project_area']);
        $project_type = $this->Project_model->get_project_type($data['project_details'][0]['project_type']);
        $data['project_details'][0]['area_name'] = $area_name[0]['name'];
        $data['project_details'][0]['type_name'] = $project_type[0]['project_type'];
        if (!empty($_REQUEST['submit'])  ) {

            $this->invoice_amount_validation($_REQUEST);

            $invoice_data['invoice_no'] = $_REQUEST['invoice_no'];
            //$invoice_data['invoice_amount'] = $_REQUEST['amount_paid'];
            $invoice_data['invoice_date'] = $_REQUEST['invoice_date'];
            $invoice_data['project_id'] = $project_id;
            $invoice_data['vendor_id'] = $_REQUEST['vendor'];
            $invoice_data['remarks'] = $_REQUEST['remarks'];
            $invoice_id = $this->Project_invoice_model->add('project_invoice',$invoice_data);
            $insert_flag = 0;
            $invoice_details = [];
            for($k = 0 ; $k < count($_REQUEST['head']); $k++){
                $invoice_details['invoice_id'] = $invoice_id;
                $invoice_details['major_head_id'] = $_REQUEST['head'][$k];
                $invoice_details['details'] = $_REQUEST['details'][$k];
                $invoice_details['amount'] = $_REQUEST['amount'][$k];
                $invoice_details_id = $this->Project_invoice_model->add('project_invoice_details',$invoice_details);
                if($invoice_details_id > 0 ){
                    $insert_flag++;
                }
            }
            if($invoice_id > 0 && $insert_flag > 0 ){
                $this->session->set_flashdata('success', 'Data inserted successfully.');
                redirect('projectInvoice/invoice_list?project_id='.$_REQUEST['project_id']);
            }
        }
        $this->load->common_template('project-invoice/edit_invoice',$data);

    }



}
?>