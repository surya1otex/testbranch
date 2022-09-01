<?php
ob_start();
error_reporting(0); //hide php errors
$CI =& get_instance();
$this->load->library('Pdf');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Brainspark Technology Pvt. Ltd.');
$pdf->SetTitle('Project Summary Report');
$pdf->SetSubject('Application PDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
//$pdf->SetFont('helvetica', '', 6);
//$pdf->AddPage('L', 'A4');
//$pdf->setCellHeightRatio(2);


// $image_file =  base_url().'assets/images/obcc_inner_logo.png';

//         $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
//         $pdf->SetLeftMargin(10);
//         $pdf->SetRightMargin(10);
//         $pdf->SetTopMargin(25);

// add a page

// create some HTML content#b4c6e7
if(in_array('ProjectOverviewReport', $type)){
$pdf->SetFont('helvetica', '', 5);
$pdf->AddPage('L', 'A4');


$image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);


$html = '<h2>Project Overview Report:</h2>';
$html .= '<table border="1" cellspacing="1" cellpadding="4">
                   <thead>
                      <tr style="background-color:#ff0;">
                            <th colspan="5" style="text-align: center; vertical-align: middle;width:29.16%;">Project Overview</th>
                            <th colspan="9" style="text-align: center; vertical-align: middle; width:57.96%;">Pre-Construction</th>
                            <th colspan="2" style="text-align: center; vertical-align: middle;width:12.88%;">Construction</th>
                       </tr>
                            
                        <tr style="background-color:#b4c6e7;">
                        <th style="text-align: center; vertical-align: middle; width:3.4%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle; width:6.44%;">Project Category</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Location</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Scheme</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Project Status</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Govt Land</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Direct Purchase Land</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Land Acquisition</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Forest Land</th>
                        
                        
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Utlility Shifting (Electrical)</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Utlility Shifting <br>(PH)</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Utility Shifting <br>(RWSS)</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Tree Cutting</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Encroachment eviction</th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Work Progress <br>(%) </th>
                        <th style="text-align: center; vertical-align: middle;width:6.44%;">Target End Date</th>
                      </tr>
                      
                            </thead>
                            <tbody>';
                              $s = 1;
                              if(is_array($overView_data)){
                                foreach ($overView_data as $overView) {
                                $pro_details = $CI->get_overview_project_details($overView->project_id);
                                if($overView->project_step_no == 1){
                                  $stage = 'Concept Creation';
                                }elseif ($overView->project_step_no == 3) {
                                  $stage = 'DPR';
                                }elseif ($overView->project_step_no == 4) {
                                  $stage = 'Pre Construction Activities';
                                }elseif ($overView->project_step_no == 4) {
                                  $stage = 'Administrative Approval';
                                }else{
                                  $stage = 'Project Creation';
                                }

                                $project_amount_data = $CI->get_project_ammount_data($overView->project_id);

                                    $s_planned_ammount = $project_amount_data[0]['Planned_Value'];
                                    $s_earned_ammount = $project_amount_data[0]['Earned_Value'];
                                    if($s_planned_ammount != 0){
                                       $s_percent = ($s_earned_ammount * 100) / $s_planned_ammount; 
                                   }else{
                                    $s_percent = 0.00;
                                   }

                                   $pr_target_end_date = $CI->get_project_target_end_date($overView->project_id);
                                   if (!empty ($pr_target_end_date[0]['target_end_date'])) {
                                         $chpr_target_end_date = new DateTime($pr_target_end_date[0]['target_end_date']); 
                                       $chpr_target_end_date1 = $chpr_target_end_date->format('jS M Y');
                                     } else {
                                      $chpr_target_end_date1 = "--"; 
                                    }

                              $html .= '<tr>
                                <td rowspan="2" style="width:3.4%;">'.$s.'</td>
                                <td colspan="15" style=" width:96.6%;">'.$pro_details['project_name'].'</td>
                                </tr>
                                <tr>
                                <td style=" width:6.44%;">'.$pro_details['category_name'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['location'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['scheme'].'</td>
                                <td style=" width:6.44%;">'.$stage.'</td>
                                <td style=" width:6.44%;">'.$pro_details['govt_land_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['pvt_land_direct_purchase_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['land_acquistion_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['forest_land_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['shifting_electrical_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['ph_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['rwss_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['tree_%'].'</td>
                                <td style=" width:6.44%;">'.$pro_details['eviction_%'].'</td>
                                <td style=" width:6.44%;">'.round($s_percent,2).'</td>
                                <td style=" width:6.44%;">'.$chpr_target_end_date1.'</td>
                              </tr>';
                           
                           $s++; 
                         } }
                           $html .= '</tbody>
                        </table>';
                       


$txt = date("m/d/Y h:m:s");    

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
}


//====================


if(in_array('PreConstructionSummaryReport', $type)){
$pdf->SetFont('helvetica', '', 5);
$pdf->AddPage('L', 'A4');


  $image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);

$html2 = '<h2>Pre-Construction Summary Report:</h2>';
$html2 .= '<table border="1" cellspacing="1" cellpadding="4">
                            <thead>
                            <tr style="background-color:#ff0;">
                           <th colspan="5" style="text-align: center; vertical-align: middle;width:20.6%;">Pre-Construction Summary</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Govt. Land Alienation</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Private Land Acquisition</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Private Land Direct Purchase</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Forest Clearance</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Environment Clearance</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Tree Cutting</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Utility Shifting <br>(Energy)</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Utility Shifting <br>(PH)</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;width:8.8%;">Encroachment Eviction</th>
                       </tr>
                            
                        <tr style="background-color:#b4c6e7;">
                        <th style="text-align: center; vertical-align: middle; width:3%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Project Category</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Circle</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Division</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Scheme</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Land Alienated</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Land requisitioned</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Land requisitioned</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Land Cleared</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Clearance received</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;"> Trees cut</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Poles shifted </th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Length shifted </th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Land cleared</th>
                        <th style="text-align: center; vertical-align: middle;width:4.4%;">Target End Date</th>
                      </tr>
                      
                            </thead>
                            <tbody>';
                              $s2 = 1;
                              if(is_array($pre_Contruction_data)){
                                foreach ($pre_Contruction_data as $value) {

                                  if (!empty ($value->govt_date)) {
                                      $govt_date = new DateTime($value->govt_date); 
                                       $govt_date1 = $govt_date->format('jS M Y');
                                     } else {
                                      $govt_date1 = "--"; 
                                    }

                                    if (!empty ($value->pvt_date)) {
                                      $pvt_date = new DateTime($value->pvt_date); 
                                       $pvt_date1 = $pvt_date->format('jS M Y');
                                     } else {
                                      $pvt_date1 = "--"; 
                                    }

                                    if (!empty ($value->direct_date)) {
                                      $direct_date = new DateTime($value->direct_date); 
                                       $direct_date1 = $direct_date->format('jS M Y');
                                     } else {
                                      $direct_date1 = "--"; 
                                    }
                                    if (!empty ($value->forest_date)) {
                                      $forest_date = new DateTime($value->forest_date); 
                                       $forest_date1 = $forest_date->format('jS M Y');
                                     } else {
                                      $forest_date1 = "--"; 
                                    }

                                    if (!empty ($value->env_date)) {
                                      $env_date = new DateTime($value->env_date); 
                                       $env_date1 = $env_date->format('jS M Y');
                                     } else {
                                      $env_date1 = "--"; 
                                    }

                                    if (!empty ($value->tree_date)) {
                                      $tree_date = new DateTime($value->tree_date); 
                                       $tree_date1 = $tree_date->format('jS M Y');
                                     } else {
                                      $tree_date1 = "--"; 
                                    }

                                    if (!empty ($value->eng_date)) {
                                      $eng_date = new DateTime($value->eng_date); 
                                       $eng_date1 = $eng_date->format('jS M Y');
                                     } else {
                                      $eng_date1 = "--"; 
                                    }

                                    if (!empty ($value->ph_date)) {
                                      $ph_date = new DateTime($value->ph_date); 
                                       $ph_date1 = $ph_date->format('jS M Y');
                                     } else {
                                      $ph_date1 = "--"; 
                                    }

                                    if (!empty ($value->eviction_date)) {
                                      $eviction_date = new DateTime($value->eviction_date); 
                                       $eviction_date1 = $eviction_date->format('jS M Y');
                                     } else {
                                      $eviction_date1 = "--"; 
                                    }
                              
                              $html2  .= '<tr>
                                <td td rowspan="2" style="width:3%;">'.$s2.'</td>
                                <td colspan="22" style="width:97%;">'.$value->project_name.'</td>
                                </tr>
                                <tr>
                                <td style="width:4.4%;">'.$value->category_name.'</td>
                                <td style="width:4.4%;">'.$value->circle_name.'</td>
                                <td style="width:4.4%;">'.$value->division_name.'</td>
                                <td style="width:4.4%;">'.$value->scheme.'</td>
                                <td style="width:4.4%;">'.$value->govt_val.'</td>
                                <td style="width:4.4%;">'.$govt_date1.'</td>
                                <td style="width:4.4%;">'.$value->pvt_val.'</td>
                                <td style="width:4.4%;">'.$pvt_date1.'</td>
                                <td style="width:4.4%;">'.$value->direct_val.'</td>
                                <td style="width:4.4%;">'.$direct_date1.'</td>
                                <td style="width:4.4%;">'.$value->forest_val.'</td>
                                <td style="width:4.4%;">'.$forest_date1.'</td>
                                <td style="width:4.4%;">'.$value->env_val.'</td>
                                <td style="width:4.4%;">'.$env_date1.'</td>
                                <td style="width:4.4%;">'.$value->tree_val.'</td>
                                <td style="width:4.4%;">'.$tree_date1.'</td>
                                <td style="width:4.4%;">'.$value->eng_val.'</td>
                                <td style="width:4.4%;">'.$eng_date1.'</td>
                                <td style="width:4.4%;">'.$value->ph_val.'</td>
                                <td style="width:4.4%;">'.$ph_date1.'</td>
                                <td style="width:4.4%;">'.$value->eviction_val.'</td>
                                <td style="width:4.4%;">'.$eviction_date1.'</td>
                                
                                
                              </tr>';
                           
                            $s2++; 
                          } }
                           $html2 .= '</tbody>
                        </table>';
                       


$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->lastPage();
}

//==================
if(in_array('TenderingSummaryReport', $type)){

  $pdf->SetFont('helvetica', '', 5);
  $pdf->AddPage('L', 'A4');
  $image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);

  $html3 = '<h2>Tendering Summary Report:</h2>';
  $html3 .= '<table border="1" cellspacing="1" cellpadding="4">
                <thead>
                      <tr style="background-color:#ff0;">

                          <th colspan="5" style="text-align: center; vertical-align: middle;width:100%;">Pre-Bid Summary</th>
                     </tr>

                     <tr style="background-color:#b4c6e7;">

                       <th style="text-align: center; vertical-align: middle; width:11.1%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">Prebid Meeting date</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">Bidder Name</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">Country</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">First Name</th>
                        <th style="text-align: center; vertical-align: middle;width:11.1%;">Last Name</th>
                        <th style="text-align: center; vertical-align: middle;width:11%;">Mobile Number</th>
                        <th style="text-align: center; vertical-align: middle;width:11%;">Email Id</th>

                     </tr>
                </thead>  

                 <tbody>';
                              $s3 = 1;
                              if(is_array($pre_bid_data_summary)){
                                foreach ($pre_bid_data_summary as $value) {

                                  if($value['approval_date']=='0000-00-00'){
                                  $prebid_approval_date1 = "--";

                                }else { $prebid_approval_date = new DateTime($value['approval_date']); 
                                $prebid_approval_date1 = $prebid_approval_date->format('jS M Y'); }
                      

                              $html3  .= '<tr>
                                <td  style="width:11.1%;">'.$s3.'</td>
                                <td style="width:11.1%;">'.$value['tendername'].'</td>
                                
                                <td style="width:11.1%;">'.$prebid_approval_date1.'</td> 
                                <td style="width:11.1%;">'.$value['bidder_name'].'</td>
                                <td style="width:11.1%;">'.$value['country'].'</td>
                                <td style="width:11.1%;">'.$value['first_name'].'</td>
                                <td style="width:11.1%;">'.$value['last_name'].'</td>
                                <td style="width:11%;">'.$value['mobile_no'].'</td>
                                <td style="width:11%;">'.$value['email_id'].'</td> 
              
                              </tr>';
                           
                            $s3++; 
                            } }
                           $html3 .= '</tbody>

               </table>';
 $pdf->writeHTML($html3, true, false, true, false, '');
 $pdf->lastPage();
  

  $pdf->SetFont('helvetica', '', 5);
  $pdf->AddPage('L', 'A4');

          
          
  $html4 .= '<table border="1" cellspacing="1" cellpadding="4">
                  <thead>
                        <tr style="background-color:#ff0;">

                            <th colspan="5" style="text-align: center; vertical-align: middle;width:100%;">Technical Summary</th>
                       </tr>

                       <tr style="background-color:#b4c6e7;">

                        <th style="text-align: center; vertical-align: middle; width:20%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Technical Evalution Date</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Bidder Ref No/Name</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Technically Status</th>

                     </tr>
                  </thead>

                  <tbody>';
                              $s4 = 1;
                              if(is_array($technical_data_summary)){
                                foreach ($technical_data_summary as $value) {

                                if($value['bidder_tech_status'] == 'Y'){
                                    $status = 'Yes';
                                }elseif ($value['bidder_tech_status'] == 'P') {
                                   $status = 'No';
                                }


                                 if($value['tendering_date']=='0000-00-00'){
                                  $tendering_approval_date1 = "--";

                                }else { $tendering_approval_date = new DateTime($value['tendering_date']); 
                                $tendering_approval_date1 = $tendering_approval_date->format('jS M Y'); }
                              
                              $html4  .= '<tr>
                                <td  style="width:20%;">'.$s4.'</td>
                                <td style="width:20%;">'.$value['tendername'].'</td>
                                
                                <td style="width:20%;">'.$tendering_approval_date1.'</td> 
                                <td style="width:20%;">'.$value['bidder_tech_name'].'</td>
                               
                                <td style="width:20%;">'.$status.'</td> 
                              </tr>';
                           
                            $s4++; 
                          } }
                           $html4 .= '</tbody> 
  </table>';

 $pdf->writeHTML($html4, true, false, true, false, '');
 $pdf->lastPage();

 $pdf->SetFont('helvetica', '', 5);
 $pdf->AddPage('L', 'A4');
   
   $html5 .= '<table border="1" cellspacing="1" cellpadding="4">
                  <thead>
                        <tr style="background-color:#ff0;">

                            <th colspan="5" style="text-align: center; vertical-align: middle;width:100%;">Financial Summary</th>
                       </tr>

                       <tr style="background-color:#b4c6e7;">

                        <th style="text-align: center; vertical-align: middle; width:14.2%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:14.2%;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Financial Evalution Date</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Bidder Ref No/Name</th>
                        <th style="text-align: center; vertical-align: middle;width:14.2%;">Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Final Score</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Status</th>

                     </tr>
                  </thead>

                  <tbody>';
                              $s5 = 1;
                              if(is_array($financial_data_summary)){
                                foreach ($financial_data_summary as $value) {

                                if($value['bidder_status'] == 'L1'){
                                    $status = 'L1';
                                }elseif ($value['bidder_status'] == 'L2') {
                                   $status = 'L2';
                                }
                                elseif ($value['bidder_status'] == 'L3') {
                                   $status = 'L3';
                                }
                              
                                elseif ($value['bidder_status'] == 'N') {
                                   $status = 'Not Qualified';
                                }
                                else{

                                  $status = '';
                                }

                                if($value['approval_date']=='0000-00-00'){
                                  $financial_approval_date1 = "--";

                                }else { $financial_approval_date = new DateTime($value['approval_date']); 
                                $financial_approval_date1 = $financial_approval_date->format('jS M Y'); }

                              $html5  .= '<tr>
                                <td  style="width:14.2%;">'.$s5.'</td>
                                <td style="width:14.2%;">'.$value['tendername'].'</td>
                                

                                <td style="width:14.3%;">'.$financial_approval_date1.'</td>
                                <td style="width:14.3%;">'.$value['fina_bidder_name'].'</td>
                                <td style="width:14.2%;">'.number_format($value['bid_value'],2).'</td>
                                
                                <td style="width:14.3%;">'.$value['final_score'].'</td>
                               
                               <td style="width:14.3%;">'.$status.'</td> 
                              </tr>';
                           
                            $s5++; 
                          } }
                           $html5 .= '</tbody> 
  </table>';





  $pdf->writeHTML($html5, true, false, true, false, '');
  $pdf->lastPage();


  $pdf->SetFont('helvetica', '', 5);
  $pdf->AddPage('L', 'A4');
   

   $html6 .= '<table border="1" cellspacing="1" cellpadding="4">
                  <thead>
                        <tr style="background-color:#ff0;">

                            <th colspan="5" style="text-align: center; vertical-align: middle;width:100%;">Negotiation</th>
                       </tr>

                       <tr style="background-color:#b4c6e7;">

                        <th style="text-align: center; vertical-align: middle; width:14.2%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:14.2%;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Negotiation Date</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Negotiation Bidder name</th>
                        <th style="text-align: center; vertical-align: middle;width:14.2%;">Negotiation Meeting date</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Negotiation Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</th>
                        <th style="text-align: center; vertical-align: middle;width:14.3%;">Negotiation Status</th>

                     </tr>
                  </thead>

                  <tbody>';
                              $s6 = 1;
                              if(is_array($negotiation_data_summary)){
                                foreach ($negotiation_data_summary as $value) {

                                if($value['nego_status'] == 'Y'){
                                    $status = 'Yes';
                                }elseif ($value['nego_status'] == 'N') {
                                   $status = 'No';
                                }
                                
                                else{
                                  $status = '';
                                }

                                if($value['approval_date']=='0000-00-00'){
                                  $negotiation_date1 = "--";

                                }else { $negotiation_date = new DateTime($value['approval_date']); 
                                $negotiation_date1 = $negotiation_date->format('jS M Y'); }

                                if($value['nego_date']=='0000-00-00'){
                                  $nego_date1 = "--";

                                }else { $nego_date = new DateTime($value['nego_date']); 
                                $nego_date1 = $nego_date->format('jS M Y'); }

                              
                              $html6  .= '<tr>
                                <td  style="width:14.2%;">'.$s6.'</td>
                                <td style="width:14.2%;">'.$value['tendername'].'</td>
              
                                <td style="width:14.3%;">'.$negotiation_date1.'</td>
                                <td style="width:14.3%;">'.$value['bidder_name'].'</td>
                                <td style="width:14.3%;">'.$nego_date1.'</td>
                                <td style="width:14.2%;">'.number_format($value['nego_bid_value'],2).'</td>

                               <td style="width:14.2%;">'.$status.'</td> 
                              </tr>';
                           
                            $s6++; 
                            } }
                           $html6 .= '</tbody> 
         </table>';  

  $pdf->writeHTML($html6, true, false, true, false, '');
  $pdf->lastPage();


  $pdf->SetFont('helvetica', '', 5);
  $pdf->AddPage('L', 'A4');


  $html7 .= '<table border="1" cellspacing="1" cellpadding="4">
                  <thead>
                        <tr style="background-color:#ff0;">

                            <th colspan="5" style="text-align: center; vertical-align: middle;width:100%;">Issue of LOA</th>
                       </tr>

                       <tr style="background-color:#b4c6e7;">

                        <th style="text-align: center; vertical-align: middle; width:20%;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Successful Bidder Name</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Issue of LOA Date</th>
                        <th style="text-align: center; vertical-align: middle;width:20%;">Negotiated Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</th>
                        
                     </tr>
                  </thead>

                  <tbody>';
                              $s7 = 1;
                              if(is_array($issue_of_loa_data_summary)){
                                foreach ($issue_of_loa_data_summary as $value) {
                               
                                if($value['loa_issue_date']=='0000-00-00'){
                                  $loa_issue_date1 = "--";

                                }else { $loa_issue_date = new DateTime($value['loa_issue_date']); 
                                $loa_issue_date1 = $loa_issue_date->format('jS M Y'); }

                              $html7  .= '<tr>
                                <td  style="width:20%;">'.$s7.'</td>
                                <td style="width:20%;">'.$value['tendername'].'</td>
                                <td style="width:20%;">'.$value['successful_bidder_ref_no'].'</td>
                                <td style="width:20%;">'.$loa_issue_date1.'</td>
                                <td style="width:20%;">'.number_format($value['negotiation_bid_value'],2).'</td>
                                 
                              </tr>';
                           
                            $s7++; 
                          } }
                           $html7 .= '</tbody> 
  </table>';


  $pdf->writeHTML($html7, true, false, true, false, '');
  $pdf->lastPage();

  }

//==================

if(in_array('ProjectDelayedReport', $type)){
$pdf->SetFont('helvetica', '', 5);
$pdf->AddPage('L', 'A4');

$image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);


$html2 = '<h2>Project Delayed Summary Report:</h2>';
$html2 .= '<table border="1" cellspacing="1" cellpadding="4">
                  <thead>
                           
                            
                        <tr style="background-color:#b4c6e7;">
                          <th style="text-align: center; vertical-align: middle; width:12%;">Sl. No.</th>
                          <th style="text-align: center; vertical-align: middle;width:16%;">Project Name</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">Category</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">Location</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">SV</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">SPI</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">CV</th>
                          <th style="text-align: center; vertical-align: middle;width:12%;">CPI</th>
                          
                          
                      </tr>
                      
                            </thead>
                            <tbody>';
                              $s2 = 1;
                              if(is_array($delayed_data)){
                                foreach ($delayed_data as $project) {

                                         $Planned_Value = $project->Planned_Value;
                                         $Earned_Value = $project->Earned_Value;
                                         $Paid_Value = $project->Paid_Value;
                                         $agreement_cost = $project->agreement_cost;

                                         $PV =  ($Planned_Value ) / $agreement_cost;
                                         $EV =  ($Earned_Value  ) / $agreement_cost;
                                         $AC =  ($Paid_Value  ) / $agreement_cost;
                                        
                                         //$not_seen_count = $CI->get_not_seen_count_data($project->id);

                                         $SV = $EV - $PV;
                                         $SPI = $EV / $PV;  
                                          
                                             
                                         $CV = $EV - $AC;
                                         if($AC != 0){
                                         $CPI = $EV / $AC;

                                        }else{
                                            $CPI = 0.00;
                                        }

                       
                              $html2 .= '<tr>
                                <td  style="width:12%;">'.$s2.'</td>
                                <td style="width:16%;">'.$project->project_name.'</td>
                                <td style="width:12%;">'.$project->project_type.'</td>
                                <td style="width:12%;">'.$project->area_name.'</td>
                                <td style="width:12%;">'.round($SV,2).'</td>
                                <td style="width:12%;">'.round($SPI,2).'</td>
                                <td style="width:12%;">'.round($CV,2).'</td>
                                <td style="width:12%;">'.round($CPI,2).'</td>
                                
                              </tr>';
                           
                            $s2++; 
                          } }
                           $html2 .= '</tbody>
                        </table>';


$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->lastPage();
}
//================
if(in_array('SummaryProjectStatus', $type)){
$pdf->SetFont('helvetica', '', 5);
$pdf->AddPage('L', 'A4');


$image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 130, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);


$html2 = '<h2>Project Issue Summary Report:</h2>';
$html2 .= '<table border="1" cellspacing="1" cellpadding="4">
                            <thead>
                           
                            
                        <tr style="background-color:#b4c6e7;">
                          <th style="text-align: center; vertical-align: middle; width:14%;">Sl. No.</th>
                          <th style="text-align: center; vertical-align: middle;width:14%;">Project Name</th>
                          <th style="text-align: center; vertical-align: middle;width:14%;">Issue Description</th>
                          <th style="text-align: center; vertical-align: middle;width:14%;">Action Taken</th>
                          <th style="text-align: center; vertical-align: middle;width:14%;">Status</th>
                          <th style="text-align: center; vertical-align: middle;width:14%;">Updated By</th>
                          <th style="text-align: center; vertical-align: middle;width:16%;">Updated date</th>
                          
                          
                      </tr>
                      
                            </thead>
                            <tbody>';
                              $s2 = 1;
                              if(is_array($issue_data_summary)){
                                foreach ($issue_data_summary as $value) {

                               

                                if($value->status == 'Y'){
                                        $status = 'Closed';
                                    }elseif ($value->status == 'N') {
                                       $status = 'Open';
                                    }

                                if (!empty ($value->date)) {
                                       $issue_date = new DateTime($value->date); 

                                      $issue_date1 = $issue_date->format('jS M Y');} else { $issue_date1 = "--"; }
                              
                              $html2 .= '<tr>
                                <td td rowspan="2" style="width:3%;">'.$s2.'</td>
                                <td colspan="5" style="width:97%;">'.$value->project_name.'</td>
                                </tr>
                                <tr>
                                <td style="width:20%;">'.$value->issuename.'</td>
                                <td style="width:20%;">'.$value->actiontaken.'</td>
                                <td style="width:20%;">'.$status.'</td>
                                <td style="width:20%;">'.$value->createdby.'</td>
                                <td style="width:17%;">'.$issue_date1.'</td>
                                
                              </tr>';
                           
                            $s2++; 
                          } }
                           $html2 .= '</tbody>
                        </table>';


$pdf->writeHTML($html2, true, false, true, false, '');
$pdf->lastPage();
}


//==================


$pdf->lastPage();




// ---------------------------------------------------------
//$pdfName = $courseName.'_student_attendance'.time().'.pdf';
//Close and output PDF document
 ob_end_clean(); //add this line here 
$pdf->Output('Project Summary Report.pdf', 'D');


//============================================================+
// END OF FILE
//============================================================+

?>