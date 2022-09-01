<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
    public function __construct(){
        parent::__construct();
        // load base_url
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper(array('url','html','form'));
        $this->load->model('Report_model');
        $this->load->model('Procurement_model');
        $this->load->library('form_validation');
         /*To Check whether logged in */
        $logged_in = $this->session->userdata('is_logged_in');
        if (empty($logged_in)) {
            $this->session->set_flashdata('message', 'You have to log in to access this section');
            redirect('Home');
        }
        /*End fo Check whether logged in */
       

    }
    

    function project_report(){

        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $data['project_category'] = $this->Report_model->get_project_type();
        $data['project_area'] = $this->Report_model->get_project_area();
        $data['sector_list'] = $this->Report_model->get_sector();
        $data['group_list'] = $this->Report_model->get_group();
        $data['wing_list'] = $this->Report_model->get_wing();
        $data['division_list'] = $this->Report_model->get_division();
           
        $data['project_dropdown_Data'] = $this->Report_model->fetchAllData('project_conceptualisation_stage');
        $this->load->common_template('report/project_report_view', $data);
    }

    function ajax_project_report(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        
        $project_id = $this->input->post('project_id');
        $type_str = $this->input->post('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);

        $data['project_id'] = $project_id;
        $data['type'] = $type;

        // Getting Project Details
        $data['project_detail'] = $this->Report_model->get_project_data($project_id);
        $data['project_preparation'] = $this->Report_model->project_data_preparation($project_id);
        $data['project_userinfo_preparation'] = $this->Report_model->preparation_project_user_information($project_id);
        $data['sof_preparation'] = $this->Report_model->preparation_sof($project_id);        
        $data['project_pre_tender'] = $this->Report_model->pretender_project_data($project_id);        
        $data['project_tender'] = $this->Report_model->tender_project_data($project_id);
        $data['tender_histroy'] = $this->Report_model->getTenderHistory($project_id);        
        $data['project_agreement'] = $this->Report_model->agreement_project_data($project_id);
        $data['project_milestone'] = $this->Report_model->milestone_project_data($project_id);

        $this->load->view('report/result_ajax_view',$data);

    }

     public function project_milestone_activity($milestone_id,$project_id)
    {
        return $this->Report_model->get_project_milestone_activity($milestone_id,$project_id);
    }


      public function project_progress_activity($milestone_id,$activity_id,$project_id)
    {
        $get_log_data =  $this->Report_model->get_project_progress_activity($milestone_id,$activity_id,$project_id);
        /*echo "<pre>";
        print_r($get_log_data);
        echo "</pre>";*/
         $break_up_details = [];
         foreach ($get_log_data as $key => $value) {
                    $break_up_details[$key] = $value['log_id'];
                }
                
            /*echo "<pre>";
        print_r($break_up_details);
        echo "</pre>";*/    
        $main_array = array_values(array_unique($break_up_details));
        $maxactivity_logId = max($main_array);
        return $this->Report_model->get_last_reported_date($maxactivity_logId);
    
        
    }



    /* Project Destination End*/
    public function project_sector($sector_id)
    {
        return $this->Report_model->get_sector_id($sector_id);
    }


    /* Project Area */
    public function project_area($area_id)
    {
        return $this->Report_model->get_project_area($area_id);
    }

    public function project_destination($destination_id)
    {
        return $this->Report_model->project_destination($destination_id);
    }

    public function project_group($group_id)
    {
        return $this->Report_model->get_group_id($group_id);
    }

    /* Project Type */
    public function project_type($type_id)
    {
        return $this->Report_model->get_project_type($type_id);
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


    public function get_project_work_item_report($project_id){

        // Get Project Work Item details
        $project_work_item_details_ar = array();
        $data['project_work_item_details'] = $this->Report_model->get_project_work_items($project_id);
        //echo "<pre>"; print_r($data['project_work_item_details']); die();


        $financial_activity_ar = array();

        if (!empty($data['project_work_item_details'])) {
            foreach ($data['project_work_item_details'] as $keyWI => $valueWI) {
                //echo "<pre>"; print_r($valueWI);
                $project_work_item_details_ar[$keyWI]['work_item_id'] = $valueWI['work_item_id'];
                $project_work_item_details_ar[$keyWI]['work_item_name'] = $valueWI['work_item_description'];

                $work_item_id = $valueWI['work_item_id'];
                
                $data['physical_activity'] = $this->Report_model->get_financial_activity_data($project_id, $work_item_id);
                //echo "<pre>"; print_r($data['physical_activity']); die();
               // echo "<pre>"; print_r($project_work_item_details_ar); 
                
                if (!empty($data['physical_activity'])) {

                    foreach ($data['physical_activity'] as $keyActivity => $valueActivity) {

                        // Getting Activity Financial Details
                        $data['financial_activity_details'] = $this->Report_model->get_financial_activity_details($project_id, $work_item_id, $valueActivity['project_activity_id'], $start_date, $end_date);
                        //echo "<pre>"; print_r($valueActivity); die();
                        //echo "<pre>"; print_r($data['financial_activity_details']); die();
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_id'] = $valueActivity['project_activity_id'];
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['activity_name'] = $valueActivity['activity_name'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Planned_Value'] = $valueActivity['Planned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Earned_Value'] = $valueActivity['Earned_Value'];
                        
                        $project_work_item_details_ar[$keyWI]['activity_details'][$keyActivity]['Paid_Value'] = $valueActivity['Paid_Value'];
                             

                    }
                }


            }
        }

        return $project_work_item_details_ar;

    }

    public function get_visit_report_progress_details($project_id){
       return $progress_details = $this->Report_model->get_visit_report_progress_details_data($project_id);

    }

    public function getSpecificdata_res($table,$field,$get_id,$specifc_field){
        return $this->Report_model->getSpecificdata($table,$field,$get_id,$specifc_field);
    }

    public function get_project_visit_pending_count($project_id,$progress_id){
return $this->Report_model->get_num_rows3('project_progress_update_log_details_triggering','project_id',$project_id,'log_id',$progress_id,'status','P');
    }

    public function getSpecificdata2_res($table,$field1,$get_id1,$field2,$get_id2,$specifc_field){
        return $this->Report_model->getSpecificdata2($table,$field1,$get_id1,$field2,$get_id2,$specifc_field);
    }

    public function get_reported_date($project_id,$work_item_id,$activity_id){
        return $this->Report_model->get_reported_date($project_id,$work_item_id,$activity_id);
    }


    public function get_project_visit_approved_count($project_id,$progress_id){
    return $this->Report_model->get_num_rows3('project_progress_update_log_details_triggering','project_id',$project_id,'log_id',$progress_id,'status','Y');
    }

    public function get_project_visit_total_count($project_id,$progress_id){
    return $this->Report_model->get_num_rows2('project_progress_update_log_details_triggering','project_id',$project_id,'log_id',$progress_id);
    }

    public function get_project_invoice_summery_details($project_id){
        //$project_id = 1;
        $invoice_data = $this->Report_model->fetchSingledata2('project_invoice', 'project_id', $project_id,'status', 'Y');

        $claimed_amount = 0.00;
        $paid_amt = 0.00;
        if(is_array($invoice_data)){
            foreach ($invoice_data as $inv) {
                //echo $inv->id;
                $claimed_amount = $this->Report_model->get_project_claimed_amnt($inv->id);
                $paid_amt = $this->Report_model->get_project_paid_amnt($inv->id);
                //print_r($claimed_amount_res);
                //$claimed_amount = $claimed_amount_res->claimed_amt;
            }
        }

        $summeryData = array();
        $cnt = 0;
        
        $project_summery_data = $this->Report_model->get_project_summery_data($project_id);
        if(is_array($project_summery_data)){
            foreach($project_summery_data as $summery){
              $summeryData[$cnt]->vendor_name = $summery->vendor_name;  
              $summeryData[$cnt]->total_invoice= $this->Report_model->get_total_invoices_cnt($project_id,$summery->vendor_id);  
              $summeryData[$cnt]->claimed_amount= $claimed_amount;  
              $summeryData[$cnt]->paid_amount = $paid_amt;  


                $cnt++;
            }
        }

        return $summeryData;
    }


    public function get_project_all_invoice_details($invoice_id){
       return $all_invoice_details = $this->Report_model->project_all_invoice_data($invoice_id);
    }

    public function get_project_all_invoice_head_details($project_id){
       return $invoice_head_details = $this->Report_model->invoice_head_details_data($project_id);
    }

    public function get_invoice_paid_amount($invoice_id,$major_head_id){
        $paid_amount = $this->Report_model->get_invoice_paid_amount_data($invoice_id,$major_head_id);
        if($paid_amount){
            return $paid_amount;
        }else{
            return $p = 0.00;
        }
    }


    function work_item_details_head_data($project_id){
        //$project_id = 1;
       return $head_data = $this->Report_model->work_item_details_head_data($project_id);
    }

    function get_mobile_visit_activity_detail($project_id,$project_work_item_id){
        return $details_data = $this->Report_model->get_mobile_visit_activity_detail_data($project_id,$project_work_item_id);
    }

    function get_target_quantity_arr($project_id,$physical_planning_id,$project_work_item_id,$project_activity_id){
         $result = $this->Report_model->get_target_quantity_arr_data($project_id,$physical_planning_id,$project_work_item_id,$project_activity_id);
         $tar_arr = array();
         if(!empty($result)){
         foreach ($result as $key) {
            $tar_arr[] .= $key->target_quantity;
         }
     }
     return $tar_arr;
    }

    function get_mobile_visit_report_group_detail($project_id,$project_physical_planning_id,$project_work_item_id){
        return $details_data = $this->Report_model->get_mobile_visit_report_group_detail_data($project_id,$project_physical_planning_id,$project_work_item_id);
    }

    function get_mobile_visit_report_detail($project_id,$project_physical_planning_id,$project_work_item_id){
        return $details_data = $this->Report_model->get_mobile_visit_report_detail_data($project_id,$project_physical_planning_id,$project_work_item_id);
    }

    function get_detail_target_quantity($project_id,$project_physical_planning_id,$project_work_item_id,$month_name){
        return $all_qty =  $this->Report_model->get_detail_target_quantity_data($project_id,$project_physical_planning_id,$project_work_item_id,$month_name);
    }


function generate_pdf(){

    $user_id = $this->session->userdata('id');
    $user_type = $this->session->userdata('user_type');
       


      $project_id = base64_decode($_REQUEST['project_id']);
        $type_post = $_REQUEST['type'];
        $type = explode(',', $type_post);




 /* ===================Conceptualisation stage Data ===============================*/

        /* result array */
        $result = $this->Report_model->get_project_data($project_id);
        /* result array */
        $date = date_create($result[0]['aa_date']);
        $approve_date = date_format($date,"d M, Y");
         $project_name = $result[0]['project_name'];
         
         $sector_name = $result[0]['sector_name'];
         $project_code = $result[0]['project_code'];
         $group_name =$result[0]['groupName'];
         $project_destination_name = $result[0]['dest_name'];
         $project_area_name = $result[0]['area_name'];
         $project_code = $result[0]['project_code'];
         $estimate_total_cost = $result[0]['estimate_total_cost'];
         $project_type_name = $result[0]['ptype_name'];
         $pro_incharge =$result[0]['firstname']." ".$result[0]['lastname'];


         /* ===================preperation stage Data ===============================*/
         /* result array */
         $project_preparation = $this->Report_model->project_data_preparation($project_id);
         /* result array */


         $consultant_id = $project_preparation[0]['consultant_id'];
         $consultant_name = $project_preparation[0]['consultant_name'];
         $consultant_designation = $project_preparation[0]['designation'];
         $consulant_project_no = $project_preparation[0]['consulant_project_no'];
         $approval_cost = $project_preparation[0]['approval_cost'];
         $file_number = $project_preparation[0]['file_number'];

         
        
        if(!empty ($project_preparation[0]['approval_date'])){
        $aa_approval_date = date_create($project_preparation[0]['approval_date']);
        $approval_date = date_format($aa_approval_date,"d M, Y");
        }else{
          $approval_date = 'NA';
        }
        
         $pro_approver = $project_preparation[0]['firstname']." ".$project_preparation[0]['lastname'];
         $pre_remarks = $project_preparation[0]['remarks'];

         /* =========================pre tender data============================= */
         /* result array */
         $project_pre_tender = $this->Report_model->pretender_project_data($project_id);
         /* result array */

         $tender_call_no = $project_pre_tender[0]['tender_call_no'];
         if(!empty ($project_pre_tender[0]['tender_approval_date'])){
        $tender_approval_date_db = new DateTime($project_pre_tender[0]['tender_approval_date']); 
         $tender_approval_date = $tender_approval_date_db->format('jS M Y');
        }else{
          $tender_approval_date = 'NA';
        }
         

         

         if (!empty($project_pre_tender[0]['tender_document_approved'] && $project_pre_tender[0]['tender_document_approved']=="Y")){
              $tdoc_app =  "Yes"; 
          } else {
            $tdoc_app =  "No";  
        }

        if(!empty ($project_pre_tender[0]['rfp_publishing_date'])){
        $publish_date_db = new DateTime($project_pre_tender[0]['rfp_publishing_date']); 
        $rfp_publishing_date = $publish_date_db->format('jS M Y');
        }else{
          $rfp_publishing_date = 'NA';
        }

        

        

        if(!empty ($project_pre_tender[0]['rfp_closing_date'])){
        $closing_date_db = new DateTime($project_pre_tender[0]['rfp_closing_date']); 
        $rfp_closing_date = $closing_date_db->format('jS M Y');
        }else{
          $rfp_closing_date = 'NA';
        }

        if (!empty($project_pre_tender[0]['re_tender_status'] && $project_pre_tender[0]['re_tender_status']=="Y")){
            $retender =  "Yes"; 
        } else {  
        $retender =  "No";  
        }

        $remarks_for_retender = $project_pre_tender[0]['remarks'];
        $reason_for_retender = $project_pre_tender[0]['remarks_for_retender'];



        /* ==============================for tender data================================ */
        /* result array */
        $project_tender= $this->Report_model->tender_project_data($project_id);
        /* result array */

        
        if(!empty ($project_tender[0]['final_date_rfp_publish'])){
        $rfppublish_date = new DateTime($project_tender[0]['final_date_rfp_publish']); 
        $final_date_rfp_publish_f = $rfppublish_date->format('jS M Y');
        }else{
          $final_date_rfp_publish_f = 'NA';
        }

        $rfpclose_date = new DateTime($project_tender[0]['final_date_rfp_publish']); 
        if(!empty ($project_tender[0]['final_date_rfp_publish'])){
        $final_date_rfp_close_f = $rfpclose_date->format('jS M Y');
        }else{
          $final_date_rfp_close_f = 'NA';  
        }
        $tbid_open_date = new DateTime($project_tender[0]['tech_bid_opening_date']); 
        
        if(!empty ($project_tender[0]['tech_bid_opening_date'])){
        $tech_bid_opening_date_f = $tbid_open_date->format('jS M Y');
        }else{
          $tech_bid_opening_date_f = 'NA';  
        }

        $fbid_open_date = new DateTime($project_tender[0]['finance_bid_opening_date']); 
        if(!empty ($project_tender[0]['finance_bid_opening_date'])){
        $finance_bid_opening_date_f = $fbid_open_date->format('jS M Y');
        }else{
         $finance_bid_opening_date_f = 'NA'; 
        }
        

        $Tissue_date = new DateTime($project_tender[0]['tender_ly_date']);
        if(!empty ($project_tender[0]['tender_ly_date'])){
        $tender_ly_date_f = $Tissue_date->format('jS M Y');
        }else{
         $tender_ly_date_f = 'NA'; 
        }
        
        


        /* ==============================for agreement data================================ */
        /* result array */
        $project_agreement = $this->Report_model->agreement_project_data($project_id);
        /* result array */

         $agreement_date = new DateTime($project_agreement[0]['agreement_date']); 
        $agreement_date_f = $agreement_date->format('jS M Y');

        $agreement_cost = $project_agreement[0]['agreement_cost'];

         $agreement_end_date = new DateTime($project_agreement[0]['agreement_end_date']);
        $agreement_end_date_f = $agreement_end_date->format('jS M Y');

        $bidder_details = $project_agreement[0]['bidder_details'];
        $representative_name = $project_agreement[0]['representative_name'];
        $bg_amount = $project_agreement[0]['bg_amount'];

        $bgvalidity_date = new DateTime($project_agreement[0]['bg_validity_date']); 
        $bg_validity_date_f = $bgvalidity_date->format('jS M Y');

        $other_bidder_details = 'N/A';

         $pstart_date = new DateTime($project_agreement[0]['project_start_date']); 
        $project_start_date_f = $pstart_date->format('jS M Y');

        $pend_date = new DateTime($project_agreement[0]['project_end_date']); 
        $project_end_date_f = $pend_date->format('jS M Y');


        /* ==============================ENd agreement data================================ */

        /* =====================for ActivitySummary data================================ */


if(in_array('ActivitySummary', $type) || in_array('All', $type)){
//Project Work Items With Activities

$pdf_pro_work_with_activities = $this->get_pdf_pro_work_with_activities($project_id);
}else{
 $pdf_pro_work_with_activities  = '';  
}


if(in_array('VisitReportDetails', $type) || in_array('All', $type)){
//Mobile Visit Report Summary

$pdf_mobile_visit_report_summery = $this->get_pdf_mobile_visit_report_summery($project_id);
}else{
  $pdf_mobile_visit_report_summery = '';  
}



if(in_array('InvoiceCheck', $type) || in_array('All', $type)){
    //Invoice Summary
$pdf_invoice_summary = $this->get_pdf_invoice_summary($project_id);

//invoice details

$pdf_inv_detail = '<div style="font-size:14px;">
            <div style="font-size:24px;">Invoice Details</div>'
            .$this->get_pdf_invoice_all_details($project_id).
            '</div>';
}else{
$pdf_invoice_summary = '';

$pdf_inv_detail = ''; 
}


// $get_tender_history_pdf = $this->get_tender_history_pdf($project_id);


// $project_user_data  = $this->get_project_user_pdf($project_id);

// /* get organization details */
/* Source of funds */

$sof_preparation = $this->Report_model->preparation_sof($project_id);
$source_tbl ='<table width="100%" border="1" style="border-collapse: collapse">
                    <tr style="background-color: #00000026;">
                 <td colspan="2">Source of Fund (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                    </tr>';

 if(!empty($sof_preparation)){
 
   
        foreach ($source_of_fund as $source) {
            $source_tbl .='<tr>
                        <td>'.$sofdata['sof_name'].'</td>
                        <td>'.$sofdata['amount'].'</td>
                          </tr>';
                            } 
                        $source_tbl .='</table>';
            }else{
               $source_tbl .='<tr>
                        <td colspan="2">No Record Found</td>
                        </tr>';
                            
                $source_tbl .='</table>'; 
            }

    $org_name = "Brainspark Technologies Pvt. Ltd.";
    $org_code = "Brainspark";
    $org_title = "Project Management and Monitoring Solution";
    $org_tagline = "PMIS";
    $org_address = "Brainspark Technologies Pvt. Ltd.</br>
Bengal Eco Intelligent Park</br>
EM-3, 15th floor, Unit 10B</br>
Sec V, Salt Lake City</br>
Kolkata - 700091, India";


$logopath = base_url().'assets/images/brainspark-pmis-logo.png';


        $this->load->library('Pdf');
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Brainspark Technology Pvt. Ltd.');
$pdf->SetTitle($project_name);
$pdf->SetSubject('TCPDF EX');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 021', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();
$pdf->setCellHeightRatio(2);


$image_file = $logopath;
        $content = '<br><br><br><br><br><div style="line-height: 12px;"><h1>'.$org_name.'</h1><p>'.$org_tagline.'</p><p>'.$org_address.'</p></div>';
        $pdf->Image($image_file, 90, 10, 30, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(70);
        $pdf->writeHTML($content, true, false, true, false, 'C');
        //$pdf->SetTopMargin(47);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

// define some HTML content with style
//$html1 = $this->get_pdf_pro_work_with_activities($project_id);
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->


            
              <div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Basic Information</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        <tr>
                            <td style="background-color: #00000026;"> Project's Name </td>
                            <td colspan="3"> $project_name</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Projects Sector</td>
                            <td>$sector_name</td>
                            <td style="background-color: #00000026;"> Project’s id</td>
                            <td>$project_code</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Projects Type</td>
                            <td>$project_type_name</td>
                            <td style="background-color: #00000026;"> Project’s in-charge (Approver)</td>
                            <td>$pro_incharge</td>
                            
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Approve date</td>
                            <td>$approve_date</td>
                            <td style="background-color: #00000026;"> Project’s group</td>
                            <td>$group_name</td>
                            
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Project’s area</td>
                            <td>$project_area_name</td>
                            <td style="background-color: #00000026;"> Project’s location</td>
                            <td>$project_destination_name</td>
                            
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Estimated project cost (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                            <td>$estimate_total_cost</td>
                            
                        </tr>
                        
                        </tbody>
                    </table>
            </div>

            <div style="font-size:14px;">
              <div style="font-size:24px;">Identified Stackholders</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        <tr>
                            <td style="background-color: #00000026;"> Consultant id </td>
                            <td> $consultant_id</td>
                            <td style="background-color: #00000026;"> Consultant name </td>
                            <td> $consultant_name</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Consultant designation</td>
                            <td>$consultant_designation</td>
                            <td style="background-color: #00000026;"> Consultant project number</td>
                            <td>$consulant_project_no</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Administrative approval cost (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                            <td>$approval_cost</td>
                            <td style="background-color: #00000026;">  File number</td>
                            <td>$file_number</td>
                            
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> AA Date</td>
                            <td>$approval_date</td>
                            <td colspan="2" style="text-align: center;">$source_tbl</td>
                            
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Project approvers</td>
                            <td>$pro_approver</td>
                            <td style="background-color: #00000026;"> Remarks</td>
                            <td>$pre_remarks</td>
                            
                        </tr>
                        
                        </tbody>
                    </table>
            </div>

            
              <div style="font-size:14px;">
              <div style="font-size:24px;">Pre Tender</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        <tr>
                            <td style="background-color: #00000026;">  Tender call number </td>
                            <td colspan="3"> $tender_call_no</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Date of tender approval </td>
                            <td>$tender_approval_date</td>
                            <td style="background-color: #00000026;"> Tender document approved </td>
                            <td>$tdoc_app</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> RFP Publish date </td>
                            <td>$rfp_publishing_date</td>
                            <td style="background-color: #00000026;">   RFP closing date </td>
                            <td>$rfp_closing_date</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;">Re-tender</td>
                            <td>$retender</td>
                            <td style="background-color: #00000026;"> Reason for re-tendering </td>
                            <td>$reason_for_retender</td>

                        </tr>
                            <tr>
                                <td style="background-color: #00000026;">Remarks </td>
                                <td colspan="3">$remarks_for_retender</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            
                
             
EOF;


$html_tender = <<<EOF



            
            <div style="font-size:14px;">
            <div style="font-size:24px;">Tender</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                       
                        <tr>
                        <td style="background-color: #00000026;">  Final RFP publish date</td>
                        <td> $final_date_rfp_publish_f </td>
                        <td style="background-color: #00000026;">  Final RFP closing date </td>
                        <td> $final_date_rfp_close_f </td>
                            
                        </tr>
                        <tr>

                            <td style="background-color: #00000026;">  Technical bid opening date</td>
                            <td> $tech_bid_opening_date_f </td>
                            <td style="background-color: #00000026;">  Financial bid opening date</td>

                            <td> $finance_bid_opening_date_f </td>
                        </tr>
                        <tr>

                            <td style="background-color: #00000026;"> Tender LY Issue Date</td>
                            <td> $tender_ly_date_f </td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            $get_tender_history_pdf

            <div style="font-size:14px;">
            <div style="font-size:24px;">Agreement</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                       <tr>
                        <td style="background-color: #00000026;"> Agreement date </td>
                        <td colspan="3"> $agreement_date_f </td>
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;"> Agreement cost (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                        <td>$agreement_cost</td>
                        <td style="background-color: #00000026;">  Agreement end date</td>
                        <td> $agreement_end_date_f </td>
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;">  Selected bidders name </td>
                        <td> $bidder_details </td>
                        <td style="background-color: #00000026;">  Selected bidders representative name</td>
                        <td> $representative_name </td>
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;">  BG amount (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                        <td> $bg_amount </td>
                        <td style="background-color: #00000026;"> BG validity</td>
                        <td> $bg_validity_date_f </td>
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;">  Other details of the bidder</td>
                        <td> $other_bidder_details </td>
                        <td style="background-color: #00000026;"> Project Start Date</td>
                        <td> $project_start_date_f </td>
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;"> Project End Date</td>
                        <td> $project_end_date_f </td>
                        <td></td>
                        <td></td>


                        </tr>
                        </tbody>
                    </table>
            </div>
            $project_user_data
            
                
             
EOF;


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
$pdf->AddPage();

$pdf->writeHTML($html_tender, true, false, true, false, '');


if($pdf_pro_work_with_activities !=''){
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
$pdf->AddPage();

$html1 = <<<EOF
$pdf_pro_work_with_activities

EOF;
$pdf->writeHTML($html1, true, false, true, false, '');
}

$pdf->changeTheDefault(false);

if($pdf_mobile_visit_report_summery !=''){
 $pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
 $pdf->AddPage();
$html2 = <<<EOF
$pdf_mobile_visit_report_summery
EOF;
$pdf->writeHTML($html2, true, false, true, false, '');
}

if($pdf_mobile_visit_report_details !=''){
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
$pdf->AddPage();

$html3 = <<<EOF
$pdf_mobile_visit_report_details
EOF;
$pdf->writeHTML($html3, true, false, true, false, '');
}

if($pdf_invoice_summary !='' || $pdf_inv_detail != ''){
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
$pdf->AddPage();

$html4 = <<<EOF
$pdf_invoice_summary
$pdf_inv_detail
EOF;
$pdf->writeHTML($html4, true, false, true, false, '');
}


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output($project_name.'.pdf', 'I');

}



    function get_pdf_pro_work_with_activities($project_id){
         $project_milestone = $this->Report_model->milestone_project_data($project_id);
        $html = '<div style="font-size:14px;">
        <div style="font-size:24px;"> Project Milestone With Activities</div>
        <table width="100%" border="1" style="border-collapse: collapse">
                        
                    <thead>

                    
                    <tr class="bg-blue-grey">
                        <th rowspan="2" style="text-align: center; vertical-align: middle; width:55px;background-color: #00000026;">Sl No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;width:190px;background-color: #00000026;">Activities</th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;width:180px;">Physical</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;">Completion Date</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;">Last Reported</th>
                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:90px;">Weightage (%)</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:90px;">Status</th>
                        
                      </tr>
                    </thead>';
            if (!empty($project_milestone)) {
                      foreach($project_milestone as $milestone){
                               $milestone_id = $milestone['id'];
                            $milestone_activity = $this->project_milestone_activity($milestone_id,$project_id);
                $html .= '<tbody>
                      <tr style="text-align: center; vertical-align: middle;background-color: #cccccc52 !important;">
                        <td colspan="6"><h3>'.$milestone['milestone'].'</h3></td>
                        
                      </tr>';
                $c = 1;
                      if(!empty($milestone_activity)){
                        foreach ($milestone_activity as $activitydata) {

                            $activity_id = $activitydata['id'];
                            $progress_activity = $this->project_progress_activity($milestone_id,$activity_id,$project_id); 
                            if( $activitydata['completion_status'] == 'Y'){
                                          $comp_st =  "Completed";
                                      } else if( $activitydata['completion_status'] == 'N'){
                                          $comp_st =  "Pending";
                                      }else{
                                          $comp_st =  "NA";
                                      }
                            
                    
                    if(!empty($activitydata['end_date'])){
                        $aa_date_db = new DateTime($activitydata['end_date']); 
                    $activity_end_date =  $aa_date_db->format('jS M Y');
                    }else{
                     $activity_end_date = '--';
                    }

                    $rp_date = new DateTime($progress_activity[0]['reporting_date']); 
                    
                    if(!empty($progress_activity[0]['reporting_date'])){
                     $reporting_date =  $rp_date->format('jS M Y');   
                 }else{
                    $reporting_date = '--';
                 }
                    
                         
                $html .= '<tr>
                       <td style="width:55px;">'.$c.'</td>
                       <td style="width:190px;">'.$activitydata['particulars'].'</td>
                       <td style="width:90px;">'.$activitydata['weightage'].'</td>
                      <td style="width:90px;">'.$comp_st.'</td>
                      <td>'.$activity_end_date.'</td>
                      <td>'.$reporting_date.'</td>
                      </tr>';
            $c++; } } else{
                $html .= '<tr><td colspan="6">No Data Available</td></tr>';
            }

            $html .= '</tbody>';
        }}
        $html .= '</table></div>';

        return $html;




    }

    function get_pdf_mobile_visit_report_summery($project_id){
        $pdf_html = '<div style="font-size:14px;">
            <div style="font-size:24px;">Mobile Visit Report Summary</div>
        <table width="100%" border="1" style="border-collapse: collapse" style="font-size:14px;">
                            <thead>
                            
                        <tr class="bg-blue-grey">
                        <th rowspan="2" style="text-align: center; vertical-align: middle; width:50px;background-color: #00000026;">Sl No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;width:180px;">Dated</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;">Submitted By</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;width:200px;">Details</th>
                        
                        <th colspan="3" style="text-align: center; vertical-align: middle;background-color: #00000026;width:120px;">Activities</th>
                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:40px;">Total</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:40px;">Pending</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:40px;">Approved</th>
                      </tr>
                            </thead>
                            <tbody>';
        $progress_details = $this->get_visit_report_progress_details($project_id);
                            //print_r($progress_details);
        $sl = 1;
        if(is_array($progress_details)){
            foreach ($progress_details as $progress) {
                $newDateTime = date('d M, Y h:i A', strtotime($progress->timestamp));
                if(!empty($progress->visit_date) && $progress->visit_date != '0000-00-00'){
               $visitDateTime = date('d M, Y', strtotime($progress->visit_date));
             }else{
                $visitDateTime = 'NA';
             }


                if(!empty($progress->reporting_date) && $progress->reporting_date != '0000-00-00'){
               $reportingDateTime = date('d M, Y', strtotime($progress->reporting_date));
             }else{
                $reportingDateTime = 'NA';
             }
            
            
            $pending_cnt = $this->get_project_visit_pending_count($progress->project_id,$progress->id);
            $approved_cnt = $this->get_project_visit_approved_count($progress->project_id,$progress->id);
            $total_cnt = $this->get_project_visit_total_count($progress->project_id,$progress->id);

            $project_work_item_id = $this->getSpecificdata2_res('project_progress_update_log_details_triggering','project_id',$progress->project_id,'log_id',$progress->id,'project_work_item_id');
                                
            $milestone = $this->getSpecificdata_res('project_milestone', 'id', $project_work_item_id,'milestone');

            $userDeatils = $this->get_user_details_by_user_id($progress->user_id);
                $pdf_html .= ' <tr>
                                <td style="width:50px;">'. $sl.'</td>
                                <td style="width:180px;"><b>Submitted On : </b><br>'. $newDateTime.'<hr><b>Visit Date :</b> '.$visitDateTime.'<hr><b>Reporting Date : </b><br>'.$reportingDateTime.'</td>
                                <td>'. $userDeatils[0]['name'].'</td>
                                <td style="width:200px;"><b>Milestone : </b>'. $milestone.'<hr><b>Observation : </b>'.$progress->observation.'<hr><b>Recommendation : </b>'.$progress->recommendation.'</td>
                                <td style="width:40px;">'. $total_cnt.' </td>
                                <td style="width:40px;">'. $pending_cnt.' </td>
                                <td style="width:40px;">'. $approved_cnt.' </td>
                                
                            </tr>';
                    $sl++;
            }
        }
    $pdf_html .= '</tbody>
                        </table></div>';
                        return $pdf_html;

    }


    function get_pdf_invoice_summary($project_id){
        $invoice_details = $this->get_project_invoice_summery_details($project_id);
        $pdf_html = '<div style="font-size:14px;">
            <div style="font-size:24px;">Invoice Summary</div>
        <table width="100%" border="1" style="border-collapse: collapse">
                           
                            <thead>
                            
                              <tr class="bg-blue-grey">
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:50px;">Sl No</th>
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:180px;">Vendor Name</th>
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:90px;">Total Invoices</th>
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Claimed (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Paid (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                              <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Due (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $sl = 1;
                            $t_claim = 0;
                            if(is_array($invoice_details)){
                                foreach ($invoice_details as $inv) {
                          $due = $inv->claimed_amount - $inv->paid_amount;

                          $t_claim += $inv->claimed_amount;
                          $t_paid += $inv->paid_amount;
                          $t_due += $due;

                        $pdf_html .='<tr>
                                <td style="width:50px;">'.$sl.'</td>
                                <td style="width:180x;">'.$inv->vendor_name.'</td>
                                <td style="width:90x;">'.$inv->total_invoice.'</td>
                                <td style="text-align: right;">'.$inv->claimed_amount.'</td>
                                <td style="text-align: right;">'.$inv->paid_amount.'</td>
                                <td style="text-align: right;">'.sprintf('%.2f', $due).'</td>
                                
                            </tr>';
                        $sl++;  } }

                       $pdf_html .='<tr style="background-color: #00000026;">
                       <td colspan="3" style="text-align: center;">Total </td>
                       <td style="text-align: right;">'.sprintf('%.2f', $t_claim).'</td>
                       <td style="text-align: right;">'.sprintf('%.2f', $t_paid).'</td>
                       <td style="text-align: right;">'.sprintf('%.2f', $t_due).'</td>
                       </tr></tbody>
                        </table></div>';

        return  $pdf_html;
    }

    function get_pdf_invoice_all_details($project_id,$pdf_html = NULL){
        
        $head_data = $this->get_project_all_invoice_head_details($project_id);
         if(is_array($head_data)){
            foreach ($head_data as $head) {
            $invoice_id = $head->id;
            $details_data = $this->get_project_all_invoice_details($invoice_id);

        $pdf_html .= '
        <table  width="100%" border="1" style="border-collapse: collapse">
                    <thead>
                    <tr class="bg-blue-grey">
                        <th colspan="3" style="text-align: center; vertical-align: middle;background-color: #00000026;width:475px;">'.$head->invoice_no.'</th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;background-color: #00000026;width:160px;">'.date('d M, Y', strtotime($head->invoice_date)).'</th>

                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:135px;">Head</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:240px;">Description</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:100px;">Claimed (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:80px;">Paid (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:80px;">Due (<span style="font-family:dejavusans;">&#8377;</span>)</th>
                      </tr>
                    </thead>
                    <tbody>';
                    if(is_array($details_data)){
                        foreach ($details_data as $dinvoice) {
                         $get_invoice_paid_amt = $this->get_invoice_paid_amount($invoice_id,$dinvoice->major_head_id);
                         $due = $dinvoice->amount - $get_invoice_paid_amt;

                         $td_due += $due;
                         $td_paid += $get_invoice_paid_amt;
                         $td_claim += $dinvoice->amount;

                    $pdf_html .= '<tr style="text-align: center; vertical-align: middle;">
                       <td style="width:135px;">'.$dinvoice->major_head.'</td>
                       <td style="width:240px;">'.$dinvoice->details.'</td>
                      <td style="text-align: right;width:100px;">'.$dinvoice->amount.'</td>
                      <td style="text-align: right;width:80px;">'.$get_invoice_paid_amt.'</td>
                      <td style="text-align: right;width:80px;">'.sprintf('%.2f', $due).'</td>
                      </tr>';
                } } 
                $pdf_html .= '<tr style="background-color: #00000026;">
                       <td colspan="2" style="text-align: center;">Total </td>
                       <td style="text-align: right;">'.sprintf('%.2f', $td_claim).'</td>
                       <td style="text-align: right;">'.sprintf('%.2f', $td_paid).'</td>
                       <td style="text-align: right;">'.sprintf('%.2f', $td_due).'</td>
                       </tr></tbody>

                  </table><div style="font-size:13px;"></div>';

              } } 

            return $pdf_html;
    }

    function get_pdf_mobile_visit_report_details($project_id){
        //$project_id = 1;
        $r_head_data = $this->work_item_details_head_data($project_id);
        $pdf_html = '<div style="font-size:14px;">
            <div style="font-size:24px;">Planning Details</div>';

            if(is_array($r_head_data)){
              foreach ($r_head_data as $r_hd) {

              $project_physical_planning_id = $r_hd->id;
              $project_work_item_id = $r_hd->project_work_item_id;
              $visit_details_activity_data = $this->get_mobile_visit_activity_detail($project_id,$project_work_item_id);
              $visit_details_data = $this->get_mobile_visit_report_detail($project_id,$project_physical_planning_id,$project_work_item_id);
          
                  $month_arr = array();
                  if(!empty($visit_details_data)){
                    foreach ($visit_details_data as $visit_details) {

                      $month_arr[] .= $visit_details->month_name;
                        }
                    } 

              $cal_end_pos = count($month_arr) + 2;

              $cal_start_pos = 0;
      
              $row_per_table = 4;

               $n_of_table = $cal_end_pos/($row_per_table+1);
              
              $whole = floor($n_of_table);      // 1
              $fraction = $n_of_table - $whole; // .25
              if($fraction > 5){
                $number_of_table = round($n_of_table);
              }else{
                 $number_of_table = round($n_of_table) + 1;
              }

              //echo $number_of_table;

              $cal_actual_position = 0;
              $activities_actual_position = 0;
              $activities_start_position = 0;


               $pdf_html .= '<table  width="100%" border="1" style="border-collapse: collapse">
                    <thead>';

                        for ($t=1; $t < $number_of_table ; $t++) { 
                               
                           if($t == 1){ 
                    $pdf_html .= '<tr style="text-align: center; vertical-align: middle;background-color: #cccccc52 !important;"><th colspan="7">'.$r_hd->work_item_name.'</th></tr>';
                   }
                      $pdf_html .= '<tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:50px;">Sl No</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:240px;">Activities</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;width:70px;">Type</th>';
                      
                          for ($i=$cal_start_pos; $i <= $row_per_table; $i++) { 
                        
                        $pdf_html .= '<th style="text-align: center; vertical-align: middle;background-color: #00000026;width:70px;">'.$month_arr[$cal_actual_position].'</th>';
                     
                      $cal_actual_position++;
                    } 
                        
                      
                      $pdf_html .= '</tr>
                    </thead>
                    <tbody>'; 
                      $j = 1;
                        if(!empty($visit_details_activity_data)){
                          foreach ($visit_details_activity_data as $activity) {
                           $physical_planning_id = $activity->id;
                           $target_quantity_arr = $this->get_target_quantity_arr($activity->project_id,$physical_planning_id,$activity->project_work_item_id,$activity->project_activity_id);

                       $pdf_html .= '<tr style="text-align: center; vertical-align: middle;">

                        <td style="width:50px;">'.$j.'</td>
                        <td style="width:240px;">'.$activity->activity_name.'</td>
                        <td style="width:70px;">'.$activity->unit_name.'</td>';
                         
                         $activities_actual_position = $activities_start_position;
                         for ($x=0; $x <= $row_per_table ; $x++) { 

                           $pdf_html .= '<td style="width:70px;">'.$target_quantity_arr[$activities_actual_position].'</td>';

                           $activities_actual_position++;
                         }
                         $pdf_html .= '</tr>'; 

                        $j++; } }

                      //$pdf_html .= '</tr>'; 

                    $activities_start_position = $cal_actual_position;

                  }


                       


                    $pdf_html .= '</tbody>

                  </table>';
                } } 
               
              


              $pdf_html .= '</div>';

              return $pdf_html;
    }



    public function project_details_user_details($project_id,$rfld){
        $user_id = $this->Report_model->get_project_details_required_field($project_id,$rfld);
      $user_type = $this->Report_model->getSpecificdata('user','id',$user_id,'user_type');

        $r_arr = array();
        if($user_type == 2){
        $user_details2 = $this->Report_model->project_organisation_user_details_data($user_id);
        foreach ($user_details2 as $key) {
            $r_arr['Username'] = $key->name;
            $r_arr['Email'] = $key->email;
            $r_arr['Mobile'] = $key->mobile;
        }
        }else{
          $user_details = $this->Report_model->project_details_user_details_data($user_id);
          foreach ($user_details as $key) {
            $r_arr['Username'] = $key->firstname.' '.$key->lastname;
            $r_arr['Email'] = $key->email;
            $r_arr['Mobile'] = $key->mobile;
        }  
        }
        return $r_arr;
    }

    public function get_project_user_data($project_id){
        return $result = $this->Report_model->get_project_user_data($project_id);
    }


    function get_project_user_pdf($project_id){

        $approver_result = $this->project_details_user_details($project_id,'approver_id');
        //print_r($approver_result);
        $planning_approver_result = $this->project_details_user_details($project_id,'planning_approver_id');
        $project_creator_result = $this->project_details_user_details($project_id,'project_creator_id');

        $project_user_result = $this->get_project_user_data($project_id);
    $approver_mobile = $approver_result['Mobile'] != 0 ? $approver_result['Mobile'] : '';
    $planning_approver_mobile = $planning_approver_result['Mobile'] != 0 ? $planning_approver_result['Mobile'] : '';
    $project_creator_mobile = $project_creator_result['Mobile'] != 0 ? $project_creator_result['Mobile'] : '';

        $pdf_html = '<div style="font-size:14px;">
            <div style="font-size:24px;">Project Members</div>
        <table  width="100%" border="1" style="border-collapse: collapse">
                    <thead>
                    <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Name</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Designation</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Email</th>
                        <th style="text-align: center; vertical-align: middle;background-color: #00000026;">Mobile</th>

                      </tr>
                    </thead>
                    <tbody>';
                  $pdf_html .= '<tr>
                                <td>'.$approver_result['Username'].'</td>
                                <td>Project Incharge / Approver</td>
                                <td>'.$approver_result['Email'].'</td>
                                <td>'.$approver_mobile.'</td>
                            </tr>
                            <tr>
                                <td>'.$planning_approver_result['Username'].'</td>
                                <td>Planning Officer</td>
                                <td>'.$planning_approver_result['Email'].'</td>
                                <td>'.$planning_approver_mobile.'</td>
                            </tr>
                            <tr>
                                <td>'.$project_creator_result['Username'].'</td>
                                <td>Project Creator</td>
                                <td>'.$project_creator_result['Email'].'</td>
                                <td>'.$project_creator_mobile.'</td>
                            </tr>';
                 

                if(is_array($project_user_result)){
                foreach ($project_user_result as $user_res) {
                    $user_res_mobile = $user_res->mobile != 0 ? $user_res->mobile : '';
                      
                            $pdf_html .= '<tr>
                                <td>'.$user_res->firstname.' '.$user_res->lastname.'</td>
                                <td>'.$user_res->designation.'</td>
                                <td>'.$user_res->email.'</td>
                                <td>'.$user_res_mobile.'</td>
                            </tr>';

                       } }


                   
                $pdf_html .= '</tbody>

                  </table><div>';

              

            return $pdf_html;


    }

    function get_source_of_fund_data($project_id){
        return $result = $this->Report_model->get_source_of_fund_data_result($project_id);
    }


    function get_project_retender_data($project_id){
        return $result = $this->Report_model->get_project_retender_data_result($project_id);
    }

    function get_tender_history_pdf($project_id){
        //$project_id = 71;
        $pdf_html = '';
        $tender_history_data = $this->Report_model->get_project_retender_data_result($project_id);
       // print_r($tender_history_data);

    if(is_array($tender_history_data)){

     $pdf_html = '<div style="font-size:14px;">
            <div style="font-size:24px;">Tender History</div>';
                foreach ($tender_history_data as $tender_history) {
            if(!empty( $tender_history->tender_document_approval_date) &&  $tender_history->tender_document_approval_date != '0000-00-00'){
                $tender_document_approval_date = date('d M, Y', strtotime($tender_history->tender_document_approval_date));
            }else{
               $tender_document_approval_date = 'NA'; 
            }

            if(!empty($tender_history->aa_date) && $tender_history->aa_date != '0000-00-00' ){
                $aa_date = date('d M, Y', strtotime($tender_history->aa_date));
            }else{
                $aa_date = 'NA';
            }

            if( $tender_history->tender_document_approved == 'Y'){
                    $tender_document_approved =  "Yes";
                } else if( $tender_history->tender_document_approved == 'N'){
                    $tender_document_approved =  "No";
                }else{
                    $tender_document_approved =  "NA";
                }

            if(!empty($tender_history->rfp_publishing_date) && $tender_history->rfp_publishing_date != '0000-00-00' ){
                $rfp_publishing_date = date('d M, Y', strtotime($tender_history->rfp_publishing_date));
            }else{
                $rfp_publishing_date = 'NA';
            }

            
            if(!empty($tender_history->rfp_closing_date) && $tender_history->rfp_closing_date != '0000-00-00' ){
                $rfp_closing_date = date('d M, Y', strtotime($tender_history->rfp_closing_date));
            }else{
                $rfp_closing_date = 'NA';
            }

                $pdf_html .='<div style="font-size:14px;">
                <table  width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        <tr>
                            <td style="background-color: #00000026;"> Tender call number </td>
                            <td>'.$tender_history->tender_call_no.'</td>

                            <td style="background-color: #00000026;"> Date of tender approval </td>
                            <td>'.$tender_document_approval_date.'</td>
                           
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> Project Name  </td>
                            <td colspan="3">'.$tender_history->project_name.'</td>
                        </tr>
                        <tr>
                            <td style="background-color: #00000026;"> Projects Sector</td>
                            <td>'.$tender_history->sector_name.'</td>
                            <td style="background-color: #00000026;"> Projects Group</td>
                            
                            <td>'.$tender_history->group_name.'</td>
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> Projects Area</td>
                            <td> '.$tender_history->area_name.' </td>

                            <td style="background-color: #00000026;"> Project Destination</td>
                            <td> '.$tender_history->destination_name.' </td>
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> Projects Code </td>
                            <td>'.$tender_history->project_code.'</td>
                            <td style="background-color: #00000026;"> File Number </td>
                            <td>'.$tender_history->file_no.'</td>

                        </tr>
                         <tr>
                            <td style="background-color: #00000026;"> AA Date</td>
                            <td>'.$aa_date.'</td>
                            
                            <td style="background-color: #00000026;"> AA Amount (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                            <td>'.$tender_history->estimate_total_cost.'</td>
                            
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> Projects Type</td>
                            <td>'.$tender_history->type_name.'</td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;">Date of tender approval</td>
                            <td>'.$tender_document_approval_date.'</td>
                            <td style="background-color: #00000026;"> Tender document approved </td>
                            <td>'.$tender_document_approved.'</td>
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> RFP Publish date </td>
                           <td>'.$rfp_publishing_date.'</td>
                            
                            <td style="background-color: #00000026;"> RFP closing date</td>
                            <td>'.$rfp_closing_date.'</td>
                        </tr>

                        <tr>
                            <td style="background-color: #00000026;"> Re-tender </td>
                            <td>Yes</td>
                            <td></td>
                            <td></td>
                            
                        </tr>
                        <tr>
                        <td style="background-color: #00000026;"> Reason for re-tendering</td>
                            <td colspan="3">'.$tender_history->remarks_for_retender.'</td>
                        </tr>

                        <tr>
                                <td style="background-color: #00000026;"> Remarks </td>
                                <td colspan="3">'.$tender_history->remarks_pre_tender.'</td>
                            </tr>
                        


                        </tbody>
                    </table></div>';
           }

              $pdf_html .= '</div>';

   } 

   return $pdf_html;

    }


    public function get_user_details_by_user_id($user_id)
    {
        return $this->Report_model->get_user_details_by_user_id($user_id);
    }



    /* for project summery report */

    function ajax_project_summary_report(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        if (!empty($this->input->post('project_sector_id'))) {
            $project_sector_id = $this->input->post('project_sector_id');
        } else {
            $project_sector_id = 0;
        }
        $data['project_sector_id'] = $project_sector_id;
        if (!empty($this->input->post('project_group_id'))) {
            $project_group_id = $this->input->post('project_group_id');
        } else {
            $project_group_id = 0;
        }
        $data['project_group_id'] = $project_group_id;
        if (!empty($this->input->post('project_category_id'))) {
            $project_category_id = $this->input->post('project_category_id');
        } else {
            $project_category_id = 0;
        }
        $data['project_category_id'] = $project_category_id;
        if (!empty($this->input->post('project_area_id'))) {
            $project_area_id = $this->input->post('project_area_id');
        } else {
            $project_area_id = 0;
        }
        $data['project_area_id'] = $project_area_id;
        if (!empty($this->input->post('project_wing_id'))) {
            $project_wing_id = $this->input->post('project_wing_id');
        } else {
            $project_wing_id = 0;
        }
        $data['project_wing_id'] = $project_wing_id;

        if (!empty($this->input->post('project_division_id'))) {
            $project_division_id = $this->input->post('project_division_id');
        } else {
            $project_division_id = 0;
        }
        $data['project_division_id'] = $project_division_id;
        
        $project_status = $this->input->post('project_status');

        
        $data['project_status'] = $project_status;

        $type_str = $this->input->post('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);
        $data['type'] = $type;

        $data['overView_data'] = $this->Report_model->get_project_overview_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        $data['pre_Contruction_data'] = $this->Report_model->get_project_pre_Contruction_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        $data['delayed_data'] = $this->Report_model->get_delayed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);

        //Tendering

         $data['pre_bid_data_summary'] =$this->Report_model->fetch_tendering_pre_bid_report_data();
         $data['technical_data_summary'] =$this->Report_model->get_technical_data_summary_report_data();

         $data['financial_data_summary'] =$this->Report_model->get_financial_data_summary_report_data();
         $data['negotiation_data_summary'] =$this->Report_model->get_negotiation_data_summary_report_data();

         $data['issue_of_loa_data_summary'] =$this->Report_model->get_issue_of_loa_data_summary_report_data();
          
        //Tendering

         //issue 

         $data['issue_data_summary'] =$this->Report_model->get_issue_summary_report_data();

         //issue

        $this->load->view('report/result_ajax_summary_report_view',$data);
    }


    function get_overview_project_details($project_id){
        return $this->Report_model->get_overview_project_details($project_id);
    }


    function summary_generate_pdf(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $project_sector_id = base64_decode($this->input->get('project_sector_id'));
        $project_group_id = base64_decode($this->input->get('project_group_id'));
        $project_category_id = base64_decode($this->input->get('project_category_id'));
        $project_area_id = base64_decode($this->input->get('project_area_id'));
        $project_wing_id = base64_decode($this->input->get('project_wing_id'));
        $project_division_id = base64_decode($this->input->get('project_division_id'));
        $project_status = $this->input->get('project_status');
        $type_str = $this->input->get('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);
        $data['type'] = $type;

        $data['overView_data'] = $this->Report_model->get_project_overview_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);

        $data['pre_Contruction_data'] = $this->Report_model->get_project_pre_Contruction_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);
        $data['delayed_data'] = $this->Report_model->get_delayed_project_data($project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id);

        //Tendering

         $data['pre_bid_data_summary'] =$this->Report_model->fetch_tendering_pre_bid_report_data();
         $data['technical_data_summary'] =$this->Report_model->get_technical_data_summary_report_data();

         $data['financial_data_summary'] =$this->Report_model->get_financial_data_summary_report_data();
         $data['negotiation_data_summary'] =$this->Report_model->get_negotiation_data_summary_report_data();

         $data['issue_of_loa_data_summary'] =$this->Report_model->get_issue_of_loa_data_summary_report_data();
          
        //Tendering

          $data['issue_data_summary'] =$this->Report_model->get_issue_summary_report_data();

        $this->load->view('report/result_ajax_summary_report_pdf_view',$data);
    }

    /* for individual report */

    function ajax_project_individual_report(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $this->load->model('Projectdashboard_model');
        
        $project_id = $this->input->post('project_id');

        $type_str = $this->input->post('type');
        $type_r_str = rtrim($type_str,',');
        $type = explode(',', $type_r_str);

       
        $data['type'] = $type;

       // ========= Project Information about 5 stages ===========
        //============Project Creation Data ===========
        $proj_rel_id = $this->Projectdashboard_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        
        $data['project_creation_data'] = $this->Projectdashboard_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $this->Projectdashboard_model->get_project_creation_users($proj_rel_id);



        //============End Project Creation Data ===========




        // ====Project Conceptualisation details ======
        $data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
        // ============================================ 

        //============Project DPR Data ===========
        
        $data['project_dpr_data'] = $this->Projectdashboard_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
         //============End Project DPR Data ===========

        //============Project Administrative Approval Data ===========
        
        $data['project_administrative_approval_data'] = $this->Projectdashboard_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
         //============End Project Administrative Approval Data ===========

        $data['project_agreement'] = $this->Report_model->agreement_project_data($project_id);
// ==============For Project Pre Construction Activities==============
        $data['project_pre_construction_setting'] = $this->Projectdashboard_model->project_pre_construction_settings_data($project_id);


        /* Project Closer */
        $data['project_commissioning'] = $this->Projectdashboard_model->commissioning_project_data($project_id);
        $data['project_id'] =$project_id;



        // ==============End For Project Pre Construction Activities==========
         //Project Tendering

         $data['pre_bid_data'] =$this->Report_model->fetch_single_tendering_pre_bid_report_data('tendering_pre_bid', 'project_id', $project_id);
         $data['pre_bid_bidder_data'] = $this->Report_model->get_tendering_pre_bid_bidder_report_data($project_id);
         $data['pre_bid_bidder_data_document'] = $this->Report_model->get_tendering_pre_bid_bidder_report_data_document($project_id);


          $data['technical_evalution'] = $this->Report_model->fetch_tendering_technical_evalution_report_data('tendering_technical_evalution', 'project_id', $project_id);

          $data['technical_evalution_bidder_data'] = $this->Report_model->get_tendering_technical_evalution_bidder_report_data($project_id);

          $data['financial_evalution'] = $this->Report_model->fetch_tendering_financial_evalution_report_data('tendering_financial_evalution', 'project_id', $project_id);

           $data['financial_evalution_bidder_data'] = $this->Report_model->get_tendering_financial_evalution_bidder_report_data($project_id);

           $data['negotiation'] = $this->Report_model->fetch_tendering_negotiation_report_data('tendering_negotiation', 'project_id', $project_id);

           $data['negotiation_bidder_data'] = $this->Report_model->get_tendering_negotiation_bidder_report_data($project_id);

           $data['issue_of_loa'] = $this->Report_model->fetch_tendering_issue_of_loa_report_data('tendering_issue_of_loa', 'project_id', $project_id);

      
         //Project Tendering


           //Project Issue

          $data['project_issue_data'] = $this->Projectdashboard_model->get_project_issue_data($project_id);

          $data['project_issue_details'] = $this->Projectdashboard_model->get_project_issue_details($project_id);


           //Project Issue

        //=========== End Project Information ======================

      

        $this->load->view('report/result_ajax_project_individual_report_view',$data);
    }


    function project_individual_report_pdf(){
        $user_id = $this->session->userdata('id');
        $user_type = $this->session->userdata('user_type');
        $this->load->model('Projectdashboard_model');
        
        $project_id = base64_decode($_REQUEST['project_id']);
        $type_post = $_REQUEST['type'];
        $type = explode(',', $type_post);

       
        $data['type'] = $type;

       // ========= Project Information about 5 stages ===========
        //============Project Creation Data ===========
        $proj_rel_id = $this->Projectdashboard_model->getSpecificdata('project_conceptualisation_stage','id',$project_id,'proj_rel_id');
        
        $data['project_creation_data'] = $this->Projectdashboard_model->get_project_creation_data($proj_rel_id);
        $data['project_creation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_creation_document','project_id',$proj_rel_id);
        $data['project_creation_users'] = $this->Projectdashboard_model->get_project_creation_users($proj_rel_id);



        //============End Project Creation Data ===========




        // ====Project Conceptualisation details ======
        $data['project_detail'] = $this->Projectdashboard_model->get_project_data($project_id);
        $data['project_conceptualisation_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_conceptualisation_stage_document','project_id',$project_id);
        // ============================================ 

        //============Project DPR Data ===========
        
        $data['project_dpr_data'] = $this->Projectdashboard_model->get_project_dpr_data($project_id);
        $data['project_dpr_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_dpr_stage_document','project_id',$project_id);
         //============End Project DPR Data ===========

        //============Project Administrative Approval Data ===========
        
        $data['project_administrative_approval_data'] = $this->Projectdashboard_model->fetchSingle_pro_result_arr_data('project_administrative_approval_stage','project_id',$project_id);
        $data['project_administrative_approval_attachment'] = $this->Projectdashboard_model->fetchSingledata('project_administrative_approval_stage_document','project_id',$project_id);
         //============End Project Administrative Approval Data ===========


// ==============For Project Pre Construction Activities==============
        $data['project_pre_construction_setting'] = $this->Projectdashboard_model->project_pre_construction_settings_data($project_id);

        /* Project Closer */
        $data['project_commissioning'] = $this->Projectdashboard_model->commissioning_project_data($project_id);

        $data['project_id'] =$project_id;



        // ==============End For Project Pre Construction Activities==========

        $data['project_agreement'] = $this->Report_model->agreement_project_data($project_id);
        //=========== End Project Information ======================


        //Project Tendering

         $data['pre_bid_data'] =$this->Report_model->fetch_single_tendering_pre_bid_report_data('tendering_pre_bid', 'project_id', $project_id);
         $data['pre_bid_bidder_data'] = $this->Report_model->get_tendering_pre_bid_bidder_report_data($project_id);
         $data['pre_bid_bidder_data_document'] = $this->Report_model->get_tendering_pre_bid_bidder_report_data_document($project_id);


          $data['technical_evalution'] = $this->Report_model->fetch_tendering_technical_evalution_report_data('tendering_technical_evalution', 'project_id', $project_id);

          $data['technical_evalution_bidder_data'] = $this->Report_model->get_tendering_technical_evalution_bidder_report_data($project_id);

          $data['financial_evalution'] = $this->Report_model->fetch_tendering_financial_evalution_report_data('tendering_financial_evalution', 'project_id', $project_id);

           $data['financial_evalution_bidder_data'] = $this->Report_model->get_tendering_financial_evalution_bidder_report_data($project_id);

           $data['negotiation'] = $this->Report_model->fetch_tendering_negotiation_report_data('tendering_negotiation', 'project_id', $project_id);

           $data['negotiation_bidder_data'] = $this->Report_model->get_tendering_negotiation_bidder_report_data($project_id);

           $data['issue_of_loa'] = $this->Report_model->fetch_tendering_issue_of_loa_report_data('tendering_issue_of_loa', 'project_id', $project_id);

      
      //Project Tendering

      //Project Issue

          $data['project_issue_data'] = $this->Projectdashboard_model->get_project_issue_data($project_id);

          $data['project_issue_details'] = $this->Projectdashboard_model->get_project_issue_details($project_id);


           //Project Issue

        $this->load->view('report/result_ajax_project_individual_report_pdf_view',$data);
    }




/* for project pre construction details view new code start on 27-04-2021 */
  function project_pre_construction_details_data($project_id,$type){
        //$project_id = $this->input->post('project_id');
        $this->load->model('Projectdashboard_model');
        //$project_id = 14;
        //$type = $this->input->post('type');
        //$type = 'environmental_clearance';
        if($type == 'land_schedule'){
            return $data['district_data'] = $this->Projectdashboard_model->get_land_schedule_data($project_id);
            //$this->load->view('dashboard/pre_construction_activity/land_schedule_view',$data);
        }
        if($type == 'gov_land_alienation'){

            $gov_land_alienation_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_govt_land_alienation', 'project_id', $project_id);
            
            $data['gov_land_alienation_data'] = $gov_land_alienation_data;
            if(!empty($gov_land_alienation_data)){
            $data['gov_land_alienation_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_govt_land_alienation_location',$project_id, $gov_land_alienation_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/gov_land_alienation_view',$data);
        }

        if($type == 'private_land_dp'){
            $private_land_dp_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_pvt_land_direct_purchase', 'project_id', $project_id);
            
            $data['private_land_dp_data'] = $private_land_dp_data;
            if(!empty($private_land_dp_data)){
            $data['private_land_dp_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_pvt_land_direct_purchase_location',$project_id, $private_land_dp_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/private_land_dp_view',$data);
        }
        if($type == 'private_land_la'){

            $private_land_la_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_pvt_land_acquistion', 'project_id', $project_id);
            
            $data['private_land_la_data'] = $private_land_la_data;
            if(!empty($private_land_la_data)){
            $data['private_land_la_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_pvt_land_acquistion_location',$project_id, $private_land_la_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/private_land_la_view',$data);
        }
        if($type == 'forest_land'){

            $forest_land_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_forest_land', 'project_id', $project_id);
            
            $data['forest_land_data'] = $forest_land_data;
            if(!empty($forest_land_data)){
            $data['forest_land_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_forest_land_location',$project_id, $forest_land_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/forest_land_view',$data);
        }
        if($type == 'tree_cutting'){
            $tree_cutting_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_tree_cutting', 'project_id', $project_id);
            
            $data['tree_cutting_data'] = $tree_cutting_data;
            if(!empty($tree_cutting_data)){
            $data['tree_cutting_data_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_tree_cutting_location',$project_id, $tree_cutting_data[0]['id']);
            }


            return $data;
            //$this->load->view('dashboard/pre_construction_activity/tree_cutting_view',$data);
        }
        if($type == 'environmental_clearance'){
            // echo "string";
            // die();
            $environmental_clearance_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_environment_clearance', 'project_id', $project_id);
            
            $data['environmental_clearance_data'] = $environmental_clearance_data;
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/environmental_clearance_view',$data);
        }
        if($type == 'utility_shifting_elec'){


            $utility_shifting_elec_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_electrical', 'project_id', $project_id);
            
            $data['utility_shifting_elec_data'] = $utility_shifting_elec_data;
            if(!empty($utility_shifting_elec_data)){
            $data['utility_shifting_elec_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_electric_location',$project_id, $utility_shifting_elec_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/utility_shifting_elec_view',$data);
        }
        if($type == 'utility_shifting_PH'){

            $utility_shifting_PH_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_ph', 'project_id', $project_id);
            
            $data['utility_shifting_PH_data'] = $utility_shifting_PH_data;
            if(!empty($utility_shifting_PH_data)){
            $data['utility_shifting_PH_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_ph_location',$project_id, $utility_shifting_PH_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/utility_shifting_PH_view',$data);
        }
        if($type == 'utility_shifting_RWSS'){

            $utility_shifting_RWSS_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_utility_shifting_rwss', 'project_id', $project_id);
            
            $data['utility_shifting_RWSS_data'] = $utility_shifting_RWSS_data;
            if(!empty($utility_shifting_RWSS_data)){
            $data['utility_shifting_RWSS_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_utility_shifting_rwss_location',$project_id, $utility_shifting_RWSS_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/utility_shifting_RWSS_view',$data);
        }
        if($type == 'encroachment_eviction'){

            $encroachment_eviction_data = $this->Projectdashboard_model->fetch_Pre_Construction_Activities_details_single_data('pre_construction_activities_encroachment_eviction', 'project_id', $project_id);
            
            $data['encroachment_eviction_data'] = $encroachment_eviction_data;
            if(!empty($encroachment_eviction_data)){
            $data['encroachment_eviction_location_data'] = $this->Projectdashboard_model->get_pre_construction_details_location_data('pre_construction_activities_encroachment_eviction_location',$project_id, $encroachment_eviction_data[0]['id']);
            }
            return $data;
            //$this->load->view('dashboard/pre_construction_activity/encroachment_eviction_view',$data);
        }
        
    }

    function get_specific_data_against_value($table,$field,$get_id,$specifc_field){

        $this->load->model('Projectdashboard_model');
        return $this->Projectdashboard_model->get_specific_data_against_value($table,$field,$get_id,$specifc_field);
    }


    function get_project_list(){
     if (!empty($this->input->post('project_sector_id'))) {
            $project_sector_id = $this->input->post('project_sector_id');
        } else {
            $project_sector_id = 0;
        }
        if (!empty($this->input->post('project_group_id'))) {
            $project_group_id = $this->input->post('project_group_id');
        } else {
            $project_group_id = 0;
        }
        if (!empty($this->input->post('project_category_id'))) {
            $project_category_id = $this->input->post('project_category_id');
        } else {
            $project_category_id = 0;
        }
        if (!empty($this->input->post('project_area_id'))) {
            $project_area_id = $this->input->post('project_area_id');
        } else {
            $project_area_id = 0;
        }
        if (!empty($this->input->post('project_wing_id'))) {
            $project_wing_id = $this->input->post('project_wing_id');
        } else {
            $project_wing_id = 0;
        }

        if (!empty($this->input->post('project_division_id'))) {
            $project_division_id = $this->input->post('project_division_id');
        } else {
            $project_division_id = 0;
        }
        $project_status = $this->input->post('project_status');
   
          $dataoutput = '<option value="">Select Project</option>';  
        
        
        $result = $this->Report_model->get_project_filter_data($project_sector_id,$project_group_id,$project_category_id,$project_area_id,$project_wing_id,$project_division_id,$project_status);
        if(is_array($result)){
        foreach ($result as $row) {
        
        $dataoutput .= '<option value="'.$row->id.'">'.$row->project_name.'</option>';
        }
        }
        

            echo $dataoutput;
    }


    function value_check_empty($val){
        if(!empty($val)){
            return $val;
        }else{
           return  $emp = '--';
        }
    }
    function amount_check_empty($val){
        if(!empty($val)){
            return $val;
        }else{
           return  $emp = 0.00;
        }
    }


    function get_project_ammount_data($project_id){
        return $this->Report_model->get_project_ammount_data($project_id);
    }

    function get_project_target_end_date($project_id){
        return $this->Report_model->get_project_target_end_date($project_id);
    }


    
}
?>

