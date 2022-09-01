<?php
$CI =& get_instance();
ob_start();
error_reporting(0); //hide php errors
$CI =& get_instance();
$this->load->library('Pdf');

$usernamepdf = $this->session->userdata('user_f_name');
// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	
 	private $customFooterText = "";
   public function setCustomFooterText($customFooterText)
    {
        $this->customFooterText = $customFooterText;
    }
		
	// Page footer
	public function Footer() {
		
		// Position at 15 mm from bottom

        $dt = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'  Created On - '.$dt->format('d/M/Y, H:i:s').'  Created By -'.$this->customFooterText, 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Brainspark Technology Pvt. Ltd.');
$pdf->SetTitle('Project Monitoring Dashboard - '.$project_creation_data['project_name']);
$pdf->SetSubject('Application PDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);


$pdf->setCustomFooterText($usernamepdf);

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
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(2);
$image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 90, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $content = '<div style="line-height: 12px;"><h1>Project Monitoring Dashboard</h1>
        <p>'.$project_creation_data['project_name'].'</p></div>';
        $pdf->SetLeftMargin(70);
        $pdf->SetTopMargin(25);
        $pdf->writeHTML($content, true, false, true, false, 'J');
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);


$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Creation</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        <tr>
                            <td style="background-color: #00000026;"> Project Name </td>
                            <td colspan="3">' .$project_creation_data['project_name'].'</td>
                        </tr>
                        <tr>
                          <td style="background-color: #00000026;"> Projects Category</td>
                          <td>'.$project_creation_data['project_type_name'].'</td>
                          <td style="background-color: #00000026;"> Project Scheme</td>
                          <td>'.$project_creation_data['scheme_name'].'</td>
                      </tr>
                      <tr>
                          <td style="background-color: #00000026;"> Project Location  </td>
                          <td>'.$project_creation_data['area_name'].'</td>
                         
                          <td> Indicative Cost (<span style="font-family:dejavusans;">&#8377;</span>)</td>

                          <td> '.number_format($CI->amount_check_empty($project_creation_data['project_cost'],2)).'</td>
                      </tr>
                      <tr>
                          
                          <td style="background-color: #00000026;"> Project Division </td>
                          <td>'.$project_creation_data['division_name'].'</td>
                         
                          <td style="background-color: #00000026;"> Project Division </td>
                          <td>'.$project_creation_data['wing_name'].'</td>

                      </tr>

                        
                        </tbody>
                    </table>
            </div>';
if(is_array($project_creation_users)){
  $html .= '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Stakeholders Information</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <thead>
                                    <tr>
                                        <th style="background-color: #00000026;">Sl No</th>
                                        <th style="background-color: #00000026;">User Name</th>
                                        <th style="background-color: #00000026;">Designation</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $i = 1;
                                    foreach ($project_creation_users as $creation_user) {
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$creation_user->firstname.' '.$creation_user->lastname.'</td>
                                        <td>'.$creation_user->designation.' </td>
                                        
                                    </tr>';

                                $i++;
                              }
                                $html .= '</tbody>
                    </table>
            </div>';

          }




// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->AddPage();
if (!empty ($project_detail[0]['submission_date'])) {
           $submission_date = new DateTime($project_detail[0]['submission_date']); 
          
          
          $submission_date1 = $submission_date->format('jS M Y');} else { $submission_date1 = "--"; } 
    if(!empty($project_detail[0]['concpt_submited_status'])){ if($project_detail[0]['concpt_submited_status'] == 'Y'){ $concpt_submited_status =  "Yes";}else{ $concpt_submited_status = "No";} }else{ $concpt_submited_status = "NA";}

    if (!empty ($project_detail[0]['expected_approval_date'])) {
           $expected_approval_date = new DateTime($project_detail[0]['expected_approval_date']); 
          
          
          $expected_approval_date1 = $expected_approval_date->format('jS M Y');} else { $expected_approval_date1 = "--"; } 
$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Details</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                                    <tr>
                                        <td style="background-color: #00000026;"> Project name </td>
                                        <td colspan="3">'.$project_detail[0]['project_name'].'</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Project Scheme </td>
                                        <td>'.$CI->value_check_empty($project_detail[0]['groupName']).'</td>
                                        <td style="background-color: #00000026;"> Location </td>
                                        <td>'.$CI->value_check_empty($project_detail[0]['area_name']).'</td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td style="background-color: #00000026;"> Submission date</td>
                                        <td>'.$submission_date1.'
                                        </td>
                                        <td style="background-color: #00000026;"> Concept prepared by </td>
                                        <td>'.$CI->value_check_empty($project_detail[0]['concept_prepared_by']).'</td>
                                    </tr>
                                    <tr>
                                        
                                        <td style="background-color: #00000026;"> Concept Submitted for approval  </td>
                                        <td>'.$concpt_submited_status.'</td>
                                       <td style="background-color: #00000026;"> Expected date for Approval </td>
                                        <td> '.$expected_approval_date1.'</td> 
            
                                    </tr>
            
                                    <tr>
                                       
                                        
                                        <td style="background-color: #00000026;"> Approving Authority</td>
                                        <td>'. $CI->value_check_empty($project_detail[0]['approving_authority']).'</td>
                    
            
                                    </tr>
                                 </tbody>
                    </table>
            </div>';

  $pdf->writeHTML($html, true, false, true, false, '');


if(in_array('ProjectDPR', $type) || in_array('All', $type)){
$pdf->AddPage();

if (!empty ($project_dpr_data[0]['dpr_start_date'])) {
     $dpr_start_date = new DateTime($project_dpr_data[0]['dpr_start_date']); 
    
    
    $dpr_start_date1 = $dpr_start_date->format('jS M Y');} else { $dpr_start_date1 = "--"; }
    if (!empty ($project_dpr_data[0]['dpr_end_date'])) {
         $dpr_end_date = new DateTime($project_dpr_data[0]['dpr_end_date']); 
        
        
        $dpr_end_date1 = $dpr_end_date->format('jS M Y');} else { $dpr_end_date1 = "--";
      }
        if (!empty ($project_dpr_data[0]['dpr_submission_date'])) {
           $dpr_submission_date = new DateTime($project_dpr_data[0]['dpr_submission_date']); 
          
          
          $dpr_submission_date1 = $dpr_submission_date->format('jS M Y');} else { $dpr_submission_date1 = "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Planning / DPR</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                                    <tr>
                                        <td style="background-color: #00000026;"> Plan / DPR prepared by </td>

                                        <td>'.$CI->value_check_empty($project_dpr_data[0]['dpr_prepared_by_user_id']).'</td>
                                        
                                        <td style="background-color: #00000026;"> Master Plan / DPR start date   </td>
                                        <td>'.$dpr_start_date1.'</td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td style="background-color: #00000026;"> Master Plan / DPR end date</td>
                                        <td>'.$dpr_end_date1.'
                                        </td>
                                        <td style="background-color: #00000026;"> Master Plan / DPR submission date </td>
                                        <td>'.$dpr_submission_date1.'</td>
                                    </tr>
                                    
                                 </tbody>
                    </table>
            </div>';

 $pdf->writeHTML($html, true, false, true, false, '');
}




 if(in_array('AdministrativeApproval', $type) || in_array('All', $type)){
 $pdf->AddPage();
if (!empty ($project_administrative_approval_data[0]['date_of_presentation'])) {
   $date_of_presentation = new DateTime($project_administrative_approval_data[0]['date_of_presentation']); 
  
  
  $date_of_presentation1 = $date_of_presentation->format('jS M Y');} else { $date_of_presentation1 = "--"; }

  if (!empty ($project_administrative_approval_data[0]['administrative_approval_date'])) {
   $administrative_approval_date = new DateTime($project_administrative_approval_data[0]['administrative_approval_date']); 
  
  
  $administrative_approval_date1 =  $administrative_approval_date->format('jS M Y');} else { $administrative_approval_date1 =  "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Administrative Approval</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                                    <tr>
                                        <td style="background-color: #00000026;"> Date of presentation for Administrative approval </td>
                                        <td>'. $date_of_presentation1.'</td>
                                        <td style="background-color: #00000026;"> Administrative Approval date </td>
                                        <td>'.$administrative_approval_date1.'</td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td style="background-color: #00000026;"> Administrative Approval file No. (Physical and/or OSWAS ref)</td>
                                        <td>'.$CI->value_check_empty($project_administrative_approval_data[0]['file_no']).'
                                        </td>
                                        <td style="background-color: #00000026;"> Final Approval Authority </td>
                                        <td>'.$CI->value_check_empty($project_administrative_approval_data[0]['final_approval_authority']).'</td>
                                    </tr>
                                    <tr>
                                        
                                        <td style="background-color: #00000026;"> Approved Project Cost (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                                        <td>'.number_format($CI->amount_check_empty($project_administrative_approval_data[0]['approved_project_cost'],2)).'
                                        </td>
                                    </tr>
                                    
                                 </tbody>
                    </table>
            </div>';

 $pdf->writeHTML($html, true, false, true, false, '');
}
if(in_array('PreConstructionActivities', $type) || in_array('All', $type)){
 // Pre Construction Activities 
if($project_pre_construction_setting[0]['land_schedule'] == 'Y'){
  $land_schedule = $CI->project_pre_construction_details_data($project_id,'land_schedule');

  $district_data = $land_schedule['district_data'];
  if(!empty($district_data)){

 $pdf->AddPage();


$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Land Schedule</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <thead>
                    <tr class="bg-blue-grey">
                        <th class="text-center">District</th>
                        <th class="text-center">Tahsil</th>
                        <th class="text-center">Village</th>
                        <th colspan="2" class="text-center">Govt. Land(In Acres)</th>
                        <th class="text-center">Forest Land(In Acres)</th>
                        <th colspan="3" class="text-center">Private Land(In Acres)</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                        <th class="text-center">PWD Land</th>
                        <th class="text-center">Other Department Land</th>
                        <th class="text-center"></th>
                        <th class="text-center">General</th>
                        <th class="text-center">SC</th>
                        <th class="text-center">ST</th>
                    </tr>
                </thead>
                <tbody>
                    


                    <tr>
                        <td rowspan="7" class="align-middle">Sambalpur</td>
                        <td rowspan="4" class="align-middle">Bamra</td>
                        <td class="align-middle">Babuniktimal</td>
                        <td> 0 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Baunslaga</td>
                        <td> 3 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                        <td> 1 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Garposh</td>
                        <td> 0 </td>
                        <td> 2 </td>
                        <td> 1 </td>
                        <td> 0 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 3 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                        <td> 1 </td>
                        <td> 2 </td>
                        <td> 3 </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="align-middle">Maneswar</td>
                        <td class="align-middle">Udepuri</td>
                        <td> 0 </td>
                        <td> 1 </td>
                        <td> 6 </td>
                        <td> 3 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 6 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                        <td> 1 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 4 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td rowspan="7" class="align-middle">Sambalpur</td>
                        <td rowspan="4" class="align-middle">Bamra</td>
                        <td class="align-middle">Babuniktimal</td>
                        <td> 0 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Baunslaga</td>
                        <td> 3 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                        <td> 1 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Garposh</td>
                        <td> 0 </td>
                        <td> 2 </td>
                        <td> 1 </td>
                        <td> 0 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 3 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                        <td> 1 </td>
                        <td> 2 </td>
                        <td> 3 </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="align-middle">Maneswar</td>
                        <td class="align-middle">Udepuri</td>
                        <td> 0 </td>
                        <td> 1 </td>
                        <td> 6 </td>
                        <td> 3 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 6 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 4 </td>
                        <td> 1 </td>
                        <td> 1 </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Jarabaga</td>
                        <td> 4 </td>
                        <td> 4 </td>
                        <td> 5 </td>
                        <td> 2 </td>
                        <td> 0 </td>
                        <td> 5 </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center align-middle"><strong>Total</strong></td>
                        <td> <strong>10</strong> </td>
                        <td> <strong>20</strong> </td>
                        <td> <strong>25</strong> </td>
                        <td> <strong>16</strong> </td>
                        <td> <strong>13</strong> </td>
                        <td> <strong>25</strong> </td>

                    </tr>
                </tbody>
                    </table>
            </div>';

$pdf->writeHTML($html, true, false, true, false, '');
} }


if($project_pre_construction_setting[0]['govt_land_alienation'] == 'Y'){
  $gov_land_alienation = $CI->project_pre_construction_details_data($project_id,'gov_land_alienation');

  $gov_land_alienation_data = $gov_land_alienation['gov_land_alienation_data'];
  //print_r($gov_land_alienation_data);
 
  if(!empty($gov_land_alienation_data)){
  


 $pdf->AddPage();
if (!empty ($gov_land_alienation_data[0]['target_end_date'])) {
$gov_land_alienation_target_end_date = new DateTime($gov_land_alienation_data[0]['target_end_date']); 
          
          
          $gov_land_alienation_target_end_date1 = $gov_land_alienation_target_end_date->format('jS M Y');} else { $gov_land_alienation_target_end_date1 = "--"; } 

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Government Land Alienation</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                <tr>
                    <td style="background-color: #00000026;"> Total Area to be alienated  </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['total_land']).' Acres</td>
                    <td style="background-color: #00000026;"> Departments that own the land </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['department_id']).'</td>
                </tr>
                
                <tr>
                    <td style="background-color: #00000026;"> Target end date </td>
                    <td>'.$gov_land_alienation_target_end_date1.' </td>
                    <td style="background-color: #00000026;"> Alienation proposed to tahsildar</td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['status_alienation_proposed']).'</td>
                </tr>
                <tr>
                    <td style="background-color: #00000026;"> Relinquishment proposal submitted </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['status_relinquishment_proposal']).'</td>
                    <td style="background-color: #00000026;"> Land alienated so far (In Acres) </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['progress_land_alienated']).'</td>
                </tr>
                <tr>
                    <td style="background-color: #00000026;">Progress %</td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['progress_%']).'</td>
                    <td style="background-color: #00000026;"> Land Required for A/A alienated </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['progress_land_required_aa']).'</td>
                </tr> 
                <tr>
                    <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                    <td>'.number_format($CI->amount_check_empty($gov_land_alienation_data[0]['progress_amount_utilised'],2)).'</td>
                    <td style="background-color: #00000026;">  % of pre-construction fund Utilized  </td>
                    <td>'.$CI->value_check_empty($gov_land_alienation_data[0]['progress_fund_utilised']).'</td>
                </tr>
                <tr> 
                    <td style="background-color: #00000026;"> Remarks  </td>
                    <td colspan="3">'.$CI->value_check_empty($gov_land_alienation_data[0]['remarks']).'</td>
                    
                </tr>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }



if($project_pre_construction_setting[0]['private_land_direct_purchase'] == 'Y'){
  $private_land_dp = $CI->project_pre_construction_details_data($project_id,'private_land_dp');
  $private_land_dp_data = $private_land_dp['private_land_dp_data'];
   if(!empty($private_land_dp_data)){
  


 $pdf->AddPage();
if (!empty ($private_land_dp_data[0]['target_end_date'])) {
 $private_land_dp_data_target_end_date = new DateTime($private_land_dp_data[0]['target_end_date']); 
 $private_land_dp_data_target_end_date1 = $private_land_dp_data_target_end_date->format('jS M Y');} else { $private_land_dp_data_target_end_date1 = "--"; } 


$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Private Land (Direct Purchase)</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                <tr>
                <td style="background-color: #00000026;"> Total Area to be Purchased  </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['total_area']).' Acres</td>
                <td style="background-color: #00000026;"> Estimate cost of purchase  </td>
                <td>'.number_format($CI->amount_check_empty($private_land_dp_data[0]['estimated_cost']),2).'</td>
            </tr>

            <tr>
                <td style="background-color: #00000026;"> General category land </td>
                <td> '.$CI->value_check_empty($private_land_dp_data[0]['general_cat_land']).'</td>
                <td style="background-color: #00000026;"> SC Land  </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['sc_land']).'</td>
            </tr>

            <tr>
                <td style="background-color: #00000026;"> ST land </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['st_land']).'</td>
               
                <td style="background-color: #00000026;"> Target end date </td>
                <td>'.$private_land_dp_data_target_end_date1.'</td>
            </tr> 

            <tr>
                <td style="background-color: #00000026;"> Bilateral Negotiation conducted ?</td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['status_negotiation_conducted']).'</td>
                <td style="background-color: #00000026;"> DCAC Metting held ? </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['status_dcac_meeting_held']).'</td>
            </tr>

             <tr>
                <td style="background-color: #00000026;"> A / A funds approved ?</td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['status_aa_funds_approved']).'</td>
                <td style="background-color: #00000026;"> Land registration done ? </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['status_land_registration']).'</td>
            </tr>

             <tr>
                <td style="background-color: #00000026;"> Land possesed so far </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['progress_land_processed']).'</td>
                <td style="background-color: #00000026;"> Progress %</td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['progress_%']).'</td>
            </tr> 

            <tr> 
                <td style="background-color: #00000026;"> Land Required for A/A purchased </td>
                <td>'.$CI->value_check_empty($private_land_dp_data[0]['progress_land_required_aa']).'</td>
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td>'.number_format($CI->amount_check_empty($private_land_dp_data[0]['progress_amount_utilised'],2)).'</td>
            </tr> 

            <tr>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td>  '.$CI->value_check_empty($private_land_dp_data[0]['progress_fund_utilised']).'</td>
                <td colspan="2"></td>
                 
            </tr> 
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($private_land_dp_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }




if($project_pre_construction_setting[0]['private_land_acquisition'] == 'Y'){
  $private_land_la = $CI->project_pre_construction_details_data($project_id,'private_land_la');
  $private_land_la_data = $private_land_la['private_land_la_data'];
   if(!empty($private_land_la_data)){
  


 $pdf->AddPage();
 if (!empty ($private_land_la_data[0]['target_end_date'])) {
$private_land_la_target_end_date = new DateTime($private_land_la_data[0]['target_end_date']); 
$private_land_la_target_end_date1 = $private_land_la_target_end_date->format('jS M Y');} else { $private_land_la_target_end_date1 = "--"; } 

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Private Land (Land Acquisition)</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                <tr>
                <td style="background-color: #00000026;"> Total Area to be Purchased  </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['total_area']).' Acres</td>
                <td style="background-color: #00000026;"> Compensation amount  </td>
                <td>'.number_format($CI->amount_check_empty($private_land_la_data[0]['compensation_amount'],2)).'</td>
            </tr>

            <tr>
                <td style="background-color: #00000026;"> General category land </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['general_cat_land']).'</td>
                <td style="background-color: #00000026;"> SC Land  </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['sc_land']).'</td>
            </tr>

            <tr>
                <td style="background-color: #00000026;"> ST land </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['st_land']).'</td>
             
                <td style="background-color: #00000026;"> Target end date </td>
                <td>'.$private_land_la_target_end_date1.' </td>
            </tr> 

            <tr>
                <td style="background-color: #00000026;"> SIA Approved ?</td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['status_SIA_approved']).' </td>
                <td style="background-color: #00000026;"> Notification under section 11.1 ? </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['status_notification']).'</td>
            </tr>

             <tr>
                <td style="background-color: #00000026;"> Declaration under section 19.1 ?</td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['status_declaration']).'</td>
                <td style="background-color: #00000026;"> Award of compensation ? </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['status_award_of_compensation']).'</td>
            </tr>

             <tr>
                <td style="background-color: #00000026;"> Land possesed so far </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['progress_land_processed']).'</td>
                <td style="background-color: #00000026;"> Progress %</td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['progress_%']).'</td>
            </tr> 

            <tr> 
                <td style="background-color: #00000026;"> Land Required for A/A purchased </td>
                <td>'.$CI->value_check_empty($private_land_la_data[0]['progress_land_required_aa']).'</td>
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td>'.number_format($CI->amount_check_empty($private_land_la_data[0]['progress_amount_utilised'],2)).'</td>
            </tr> 

            <tr>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td> '.$CI->value_check_empty($private_land_la_data[0]['progress_fund_utilised']).'</td>
                 <td colspan="2"></td>
            </tr>
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($private_land_la_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }



if($project_pre_construction_setting[0]['forest_land'] == 'Y'){
  $forest_land = $CI->project_pre_construction_details_data($project_id,'forest_land');
  $forest_land_data = $forest_land['forest_land_data'];
   $forest_div_data1 = $CI->get_specific_data_against_value('division_master','id',$forest_land_data[0]['forest_division_id'],'division_name');
   if(!empty($forest_land_data)){
   if (!empty ($forest_land_data[0]['target_end_date'])) {
$forest_land_data_target_end_date = new DateTime($forest_land_data[0]['target_end_date']); 
$forest_land_data_target_end_date1 = $forest_land_data_target_end_date->format('jS M Y');} else { $forest_land_data_target_end_date1 = "--"; }

 $pdf->AddPage();


$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Forest Land</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                <tr>
                <td style="background-color: #00000026;"> Total Area to be Diverted</td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['total_area_tobe_diverted']).'Acres</td>
                <td style="background-color: #00000026;"> Forest Division  </td>
                <td>'.$CI->value_check_empty($forest_div_data1).'</td>
            </tr>

            <tr>
                <td style="background-color: #00000026;"> Fund allotted</td>
                <td>'.number_format($CI->amount_check_empty($forest_land_data[0]['fund_alloted'],2)).'</td>
             
               <td style="background-color: #00000026;"> Target end date</td>
                <td>'.$forest_land_data_target_end_date1.'</td>
            </tr>    

            <tr> 
                <td style="background-color: #00000026;">  Online application submitted ?  </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['status_application_submited']).'</td>
                <td style="background-color: #00000026;">  FCP uploaded online ?</td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['status_fcp_uploaded']).'</td>
            </tr>

            <tr> 
                <td style="background-color: #00000026;">  State govt. Recommendation obtained  ?</td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['status_state_govt_recomend']).'</td>
                <td style="background-color: #00000026;">  Gol approval obtained ?  </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['status_goi_approval']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;">  Parmission issued ? </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['status_permission_issued']).'</td>
                <td style="background-color: #00000026;">  Land cleared so far </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['progress_land_processed']).'</td>
            </tr>

            <tr> 
                <td style="background-color: #00000026;"> Progress %  </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['progress_%']).'</td>
                <td style="background-color: #00000026;"> Land Required for A/A purchased  </td>
                <td> '.$forest_land_data[0]['progress_land_required_for_cleared_aa'].'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td>'.number_format($CI->amount_check_empty($forest_land_data[0]['progress_amount_utilised'],2)).'</td>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td>'.$CI->value_check_empty($forest_land_data[0]['progress_fund_utilised']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3">'.$CI->value_check_empty($forest_land_data[0]['remarks']).'</td>
                
            </tr>


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }


if($project_pre_construction_setting[0]['tree_cutting'] == 'Y'){
  $tree_cutting = $CI->project_pre_construction_details_data($project_id,'tree_cutting');
  $tree_cutting_data = $tree_cutting['tree_cutting_data'];
  $forest_div_data = $CI->get_specific_data_against_value('forest_division_master','id',$tree_cutting_data[0]['forest_division_id'],'division_name');
   if(!empty($tree_cutting_data)){
 if (!empty ($tree_cutting_data[0]['target_end_date'])) { 
$tree_cutting_data_target_end_date=new DateTime($tree_cutting_data[0]['target_end_date']); 
$tree_cutting_data_target_end_date1 = $tree_cutting_data_target_end_date->format('jS M Y');} else { $tree_cutting_data_target_end_date1 = "--"; }

 $pdf->AddPage();


$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Tree Cutting</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr>
                <td style="background-color: #00000026;">No. of trees to be cut </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['noof_trees_tobe_cut']).'</td>
                <td style="background-color: #00000026;"> Forest Division  </td>
                <td>'.$CI->value_check_empty($forest_div_data).'</td>
            </tr>

            <tr>
                
                <td style="background-color: #00000026;"> Target end date</td>
                <td>'.$tree_cutting_data_target_end_date1.'</td>
            
                <td style="background-color: #00000026;"> Join verification done ?  </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['status_joint_verification']).'</td>
            </tr>

            <tr> 
                <td style="background-color: #00000026;"> Enumeration done ?</td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['status_enumeration']).'</td>
                <td style="background-color: #00000026;"> Cutting permission obtained  ?</td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['status_cutting_permission']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Fund for tree cutting placed ?  </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['status_fund_for_tree_cutting']).'</td>
                <td style="background-color: #00000026;"> Tender awarded ? </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['status_tender_awarded']).'</td>
            </tr>

            <tr> 
                <td style="background-color: #00000026;"> No. of trees cut </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['progress_noof_trees_cut']).'</td>
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td>'.number_format($CI->amount_check_empty($tree_cutting_data[0]['progress_amount_utilised'],2)).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Progress %  </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['progress_%']).'</td>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td>'.$CI->value_check_empty($tree_cutting_data[0]['progress_fund_utilised']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Tree cutting required A / A Done   </td>
                <td>'.$tree_cutting_data[0]['progress_tree_cutting_required_for_aa_done'].'</td>
                <td style="background-color: #00000026;"></td>
                <td></td>
            </tr>
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($tree_cutting_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }


if($project_pre_construction_setting[0]['environmental_clearance'] == 'Y'){
  $environmental_clearance = $CI->project_pre_construction_details_data($project_id,'environmental_clearance');
  $environmental_clearance_data = $environmental_clearance['environmental_clearance_data'];
  if(!empty($environmental_clearance_data)){
  


 $pdf->AddPage();
 if (!empty ($project_detail[0]['expected_approval_date'])) { 
$environmental_clearance_data_target_end_date = new DateTime($project_detail[0]['expected_approval_date']); 
$environmental_clearance_data_target_end_date1 = $environmental_clearance_data_target_end_date->format('jS M Y');} else { $environmental_clearance_data_target_end_date1 = "--"; }
$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Environmental Clearance</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr> 
                    <td style="background-color: #00000026;"> Target end date</td>
                    <td>'.$environmental_clearance_data_target_end_date1.'</td>
                    <td style="background-color: #00000026;"> EIA and TORS prepared ?  </td>
                    <td>'.$CI->value_check_empty($environmental_clearance_data[0]['status_EIA']).'</td>
                </tr>

                <tr> 
                    <td style="background-color: #00000026;"> Online application submitted ?</td>
                    <td>'.$CI->value_check_empty($environmental_clearance_data[0]['status_online_application']).'</td>
                    <td style="background-color: #00000026;"> OSCPCB scrutiny completed  ?</td>
                    <td>'.$CI->value_check_empty($environmental_clearance_data[0]['status_OSCPCB_scrunity']).'</td>
                </tr>
                <tr> 
                    <td style="background-color: #00000026;"> EC Received ?  </td>
                    <td>'.$CI->value_check_empty($environmental_clearance_data[0]['status_ec_received']).'</td>
                    <td style="background-color: #00000026;"> Fund for EC Deposite ? </td>
                    <td> '.$CI->value_check_empty($environmental_clearance_data[0]['status_fund_for_ec']).'</td>
                </tr>
                <tr> 
                    <td style="background-color: #00000026;"> Remarks   </td>
                    <td colspan="3">'.$CI->value_check_empty($environmental_clearance_data[0]['remarks']).'</td>
                    
                </tr>


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }


if($project_pre_construction_setting[0]['utility_shifting_electrical'] == 'Y'){
  $utility_shifting_elec = $CI->project_pre_construction_details_data($project_id,'utility_shifting_elec');
  $utility_shifting_elec_data = $utility_shifting_elec['utility_shifting_elec_data'];
  if(!empty($utility_shifting_elec_data)){
  


 $pdf->AddPage();
  if (!empty ($utility_shifting_elec_data[0]['target_end_date'])) { 
$utility_shifting_elec_data_target_end_date = new DateTime($utility_shifting_elec_data[0]['target_end_date']); 
$utility_shifting_elec_data_target_end_date1 = $utility_shifting_elec_data_target_end_date->format('jS M Y');} else { $utility_shifting_elec_data_target_end_date1 = "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Utility Shifting (Electrical)</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr>
                <td style="background-color: #00000026;"> Poles to be Shifted </td>
                <td>'.$CI->value_check_empty($utility_shifting_elec_data[0]['poles_tobe_shifted']).'</td>
                <td style="background-color: #00000026;"> New lines to be installed </td>
                <td>'.$CI->value_check_empty($utility_shifting_elec_data[0]['new_lines_tobe_installed']).'</td>
            </tr>
            <tr>
                <td style="background-color: #00000026;"> Target End Date</td>
                <td>'.$utility_shifting_elec_data_target_end_date1.'</td>
                <td style="background-color: #00000026;">  % of pre-construction fund Utilized  </td>
                <td> '. $CI->value_check_empty($utility_shifting_elec_data[0]['progress_fund_utilised']).'</td>
            </tr>
            <tr>
                <td style="background-color: #00000026;">  Joint verification done ?  </td>
                <td>'.$CI->value_check_empty($utility_shifting_elec_data[0]['status_joint_verification']).'</td>
                <td style="background-color: #00000026;">  Approval fund received ? </td>
                <td>'.$CI->value_check_empty($utility_shifting_elec_data[0]['status_approval_fund_received']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;">  New line charged ? </td>
                <td>  '. $CI->value_check_empty($utility_shifting_elec_data[0]['status_new_line_charged']).'</td>
                <td style="background-color: #00000026;">  Tender awarded ?</td>
                <td> '. $CI->value_check_empty($utility_shifting_elec_data[0]['status_tender_awarded']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;">  No. of poles shifted </td>
                <td>  '. $CI->value_check_empty($utility_shifting_elec_data[0]['progress_noof_poles_shifted']).'</td>
                <td style="background-color: #00000026;">  Progress %  </td>
                <td> '. $CI->value_check_empty($utility_shifting_elec_data[0]['progress_%']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;">  Electrical utility shifting for A / A done ?   </td>
                <td> '. $CI->value_check_empty($utility_shifting_elec_data[0]['progress_electrical_utility_shifting']).' </td>
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td>  '.number_format($CI->amount_check_empty($utility_shifting_elec_data[0]['progress_amount_utilised'],2)).'</td>
            </tr>
            
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($utility_shifting_elec_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }



if($project_pre_construction_setting[0]['utility_shifting_PH'] == 'Y'){
  $utility_shifting_PH = $CI->project_pre_construction_details_data($project_id,'utility_shifting_PH');
  $utility_shifting_PH_data = $utility_shifting_PH['utility_shifting_PH_data'];
  if(!empty($utility_shifting_PH_data)){
  


 $pdf->AddPage();
   if (!empty ($utility_shifting_PH_data[0]['target_end_date'])) { 
$utility_shifting_PH_data_target_end_date = new DateTime($utility_shifting_PH_data[0]['target_end_date']); 
$utility_shifting_PH_data_target_end_date1 = $utility_shifting_PH_data_target_end_date->format('jS M Y');} else { $utility_shifting_PH_data_target_end_date1= "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Utility Shifting (PH)</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr>
                <td style="background-color: #00000026;"> Length of pipeline to be shifted </td>
                <td>'.$CI->value_check_empty($utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_lhs']).'</td>
                <td style="background-color: #00000026;"> Length of pipeline to be shifted </td>
                <td>'.$CI->value_check_empty($utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_rhs']).'</td>
            </tr>
                
            <tr> 
                <td style="background-color: #00000026;"> Target End Date</td>
                <td>'.$utility_shifting_PH_data_target_end_date1.'</td>
                <td style="background-color: #00000026;"> PH/RHS utility shifting for A / A done ?   </td>
                <td> '.$CI->value_check_empty($utility_shifting_PH_data[0]['progress_ph_utility_shifting']).' </td>
     

            </tr>
            <tr>
                <td style="background-color: #00000026;"> Joint verification done ?  </td>
                <td>  '.$CI->value_check_empty($utility_shifting_PH_data[0]['status_joint_verification']).' </td>
                <td style="background-color: #00000026;"> Fund for utility shifting placed ? </td>
                <td>'.$CI->value_check_empty($utility_shifting_PH_data[0]['status_fund_for_utility_shifting']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Tender awarded ? </td>
                <td>  '.$CI->value_check_empty($utility_shifting_PH_data[0]['status_tender_awarded']).'</td>
                <td style="background-color: #00000026;"> Length of line to be shifted</td>
                <td> '.$CI->value_check_empty($utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_lhs']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Length of line to be shifted </td>
                <td>  '.$CI->value_check_empty($utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_rhs']).'</td>
                <td style="background-color: #00000026;"> Progress %  </td>
                <td>'.$CI->value_check_empty($utility_shifting_PH_data[0]['progress_%']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;">  Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td> '.number_format($CI->amount_check_empty($utility_shifting_PH_data[0]['progress_amount_utilised'],2)).'</td>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td> '.$CI->value_check_empty($utility_shifting_PH_data[0]['progress_fund_utilised']).'</td>
            </tr>
           
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($utility_shifting_PH_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }

if($project_pre_construction_setting[0]['utility_shifting_RWSS'] == 'Y'){
  $utility_shifting_RWSS = $CI->project_pre_construction_details_data($project_id,'utility_shifting_RWSS');

  $utility_shifting_RWSS_data = $utility_shifting_RWSS['utility_shifting_RWSS_data'];
  if(!empty($utility_shifting_RWSS_data)){
  


 $pdf->AddPage();
    if (!empty ($utility_shifting_RWSS_data[0]['target_end_date'])) { 
$utility_shifting_RWSS_data_target_end_date = new DateTime($utility_shifting_RWSS_data[0]['target_end_date']); 
$utility_shifting_RWSS_data_target_end_date1 = $utility_shifting_RWSS_data_target_end_date->format('jS M Y');} else { $utility_shifting_RWSS_data_target_end_date1 = "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Pre-Construction Activities - Utility Shifting (RWSS)</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr>
                <td style="background-color: #00000026;">Length of pipeline to be shifted </td>
                <td>'.$CI->value_check_empty($utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_lhs']).'</td>
                 <td style="background-color: #00000026;"> Length of pipeline to be shifted </td>
                <td>'.$CI->value_check_empty($utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_rhs']).'</td>
            </tr>
              
            <tr> 
                <td style="background-color: #00000026;"> Target End Date</td>
                <td>'.$utility_shifting_RWSS_data_target_end_date1.'</td>
                 <td style="background-color: #00000026;"> PH/RHS utility shifting for A / A done ?   </td>
                <td> '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_ph_utility_shifting']).' </td>
            </tr>
            <tr>
                <td style="background-color: #00000026;"> Joint verification done ?  </td>
                <td>  '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['status_joint_verification']).' </td>
                <td style="background-color: #00000026;"> Fund for utility shifting placed ? </td>
                <td>'.$CI->value_check_empty($utility_shifting_RWSS_data[0]['status_fund_for_utility_shifting']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Tender awarded ? </td>
                <td>  '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['status_tender_awarded']).'</td>
                <td style="background-color: #00000026;"> Length of line to be shifted</td>
                <td> '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_lhs']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Length of line to be shifted </td>
                <td>  '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_rhs']).'</td>
                <td style="background-color: #00000026;"> Progress %  </td>
                <td>'.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_%']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td> '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_amount_utilised']).'</td>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td> '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['progress_fund_utilised']).'</td>
            </tr>
            
             <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($utility_shifting_RWSS_data[0]['remarks']).'</td>
            </tr> 


            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }


if($project_pre_construction_setting[0]['encroachment_eviction'] == 'Y'){
  $encroachment_eviction = $CI->project_pre_construction_details_data($project_id,'encroachment_eviction');
  
  $encroachment_eviction_data = $encroachment_eviction['encroachment_eviction_data'];
  if(!empty($encroachment_eviction_data)){
  


 $pdf->AddPage();
  if (!empty ($encroachment_eviction_data[0]['target_end_date'])) { 
$encroachment_eviction_data_target_end_date = new DateTime($encroachment_eviction_data[0]['target_end_date']); 
$encroachment_eviction_data_target_end_date1 = $encroachment_eviction_data_target_end_date->format('jS M Y');} else{ $encroachment_eviction_data_target_end_date1 = "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Encroachment Eviction</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
            <tr>
                <td style="background-color: #00000026;">Area under Encroachment </td>
                <td>'.$CI->value_check_empty($encroachment_eviction_data[0]['total_area']).' Acres</td>
                <td style="background-color: #00000026;"> Type of Encroachment </td>
                <td>'.$CI->value_check_empty($encroachment_eviction_data[0]['types_of_encroachment']).'</td>
            </tr>
            <tr>
                <td style="background-color: #00000026;"> Target End Date</td>
                <td>'.$encroachment_eviction_data_target_end_date1.'</td>
                <td style="background-color: #00000026;"> % of pre-construction fund Utilized  </td>
                <td> '.$encroachment_eviction_data[0]['progress_fund_utilised'].' </td>
            </tr>
            <tr>
                <td style="background-color: #00000026;"> Joint verification done ?  </td>
                <td> '.$CI->value_check_empty($encroachment_eviction_data[0]['status_joint_verification']).'  </td>
                <td style="background-color: #00000026;"> Formal requisition filed ? </td>
                <td>'.$CI->value_check_empty($encroachment_eviction_data[0]['status_formal_requisition']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Enroachment eviction programme fixed ? </td>
                <td>  '.$CI->value_check_empty($encroachment_eviction_data[0]['status_encroachment_eviction']).'</td>
                <td style="background-color: #00000026;"> Enroachment notice filed </td>
                <td> '.$CI->value_check_empty($encroachment_eviction_data[0]['status_encroachment_notice']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Enroachment area evicted so far </td>
                <td>  '.$CI->value_check_empty($encroachment_eviction_data[0]['progress_encroachment_area']).' Acres</td>
                <td style="background-color: #00000026;"> Progress %  </td>
                <td> '.$CI->value_check_empty($encroachment_eviction_data[0]['progress_%']).'</td>
            </tr>
            <tr> 
                <td style="background-color: #00000026;"> Enroachment eviction for A / A done ?   </td>
                <td> '.$CI->value_check_empty($encroachment_eviction_data[0]['progress_enroachment_area_aa']).' </td>
                <td style="background-color: #00000026;"> Amount Utilized (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                <td> '.number_format($CI->amount_check_empty($encroachment_eviction_data[0]['progress_amount_utilised'],2)).'</td>
            </tr>
           
            <tr>
                 <td style="background-color: #00000026;"> Remarks  </td>
                <td colspan="3"> '.$CI->value_check_empty($encroachment_eviction_data[0]['remarks']).'</td>
            </tr> 

            </tbody>

                </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');
} }

}



if(in_array('Tendering', $type) || in_array('All', $type)){
 $pdf->AddPage();


 if($pre_bid_data[0]['approval_date']=='0000-00-00' || $pre_bid_data[0]['approval_date']==''){
   $approval_date1 = "--";
  } else {  $approval_date = new DateTime($pre_bid_data[0]['approval_date']); 
  $approval_date1 = $approval_date->format('jS M Y'); }

   if (!empty ($pre_bid_data[0]['corrigendum_issuance_date'])) {
         $corrigendum_issuance_date = new DateTime($pre_bid_data[0]['corrigendum_issuance_date']);  
   $corrigendum_issuance_date1 = $corrigendum_issuance_date->format('jS M Y');} else { $corrigendum_issuance_date1 = "--";
      }


    if(!empty($pre_bid_data[0]['remarks'])){
      $remarks = $pre_bid_data[0]['remarks'];}else{
      $remarks = "--";}


   $html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Tendering - Pre Bid</div>

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Prebid Meeting date </td>
                    <td>'.$approval_date1.'</td> 
                    <td style="background-color: #00000026;"> Remarks</td>
                    <td>'.$remarks.'</td> 
                </tr>

                <tr>
                    <td style="background-color: #00000026;">Corrigendum / Addendum Issuance Date </td>
                    <td>'.$corrigendum_issuance_date1.'</td> 
                </tr>

                </tbody>
            </table>
                
         </div>';
  
  if(!empty($pre_bid_bidder_data)){
     $html .= '<div style="font-size:14px;width:100%;">
                 <table width="100%" border="1" style="border-collapse: collapse">
                        <thead>
                                    <tr>
                                        <th style="background-color: #00000026;">Sl No</th>
                                        <th style="background-color: #00000026;">Bidder Name </th>
                                        <th style="background-color: #00000026;">Country</th>
                                        <th style="background-color: #00000026;">First Name</th>
                                        <th style="background-color: #00000026;">Middle Name</th>
                                        <th style="background-color: #00000026;">Last Name</th>
                                        <th style="background-color: #00000026;">Mobile Number</th>
                                        <th style="background-color: #00000026;">Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $i = 1;
                                   
                                    foreach ($pre_bid_bidder_data as $prebid_bidder_data) {
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['bidder_name']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['country']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['first_name']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['middle_name']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['last_name']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['mobile_no']).' </td>
                                        <td>'.$CI->value_check_empty($prebid_bidder_data['email_id']).' </td>
                                        
                                    </tr>';

                                $i++;
                              }

                                $html .= '</tbody>
                    </table>
            </div>';

          }
 $pdf->writeHTML($html, true, false, true, false, '');

// Technical Evalution
  $pdf->AddPage();
  if($technical_evalution[0]['approval_date']=='0000-00-00' || $technical_evalution[0]['approval_date']==''){
    $approval_date_tech1 = "--";

  }else { $approval_date_tech = new DateTime($technical_evalution[0]['approval_date']); 
  $approval_date_tech1 = $approval_date_tech->format('jS M Y'); }

   if(!empty($technical_evalution[0]['remarks'])){
      $technical_evalution1 = $technical_evalution[0]['remarks'];}else{
     $technical_evalution1 = "--";}


   $html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;"> Project Tendering - Technical Evalution</div>

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Technical Evalution Date</td>
                    <td>'.$approval_date_tech1.'</td> 
                    <td style="background-color: #00000026;"> Remarks</td>
                    <td>'.$technical_evalution1.'</td>
                </tr>

                </tbody>
            </table>
                
         </div>';


if(!empty($technical_evalution_bidder_data)){ 
    
   $html .= '<div style="font-size:14px;width:100%;">
                <table width="100%" border="1" style="border-collapse: collapse">
                          <thead>
                                <tr>
                                    <th style="background-color: #00000026;">Sl No</th>
                                    <th style="background-color: #00000026;">Bidder Ref No/Name </th>
                                    <th style="background-color: #00000026;">Technically qualified / disqualified</th>
                                </tr>
                            </thead>
                            <tbody>';
                                $i = 1;
                               
                                foreach ($technical_evalution_bidder_data as $bidder_data) {
                                if($bidder_data['status'] == 'Y'){
                                    $status = 'Yes';
                                }elseif ($bidder_data['status'] == 'P') {
                                   $status = 'No';
                                }
                                else{
                                    echo $status = '--';
                                }
                                $html .= '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$CI->value_check_empty($bidder_data['biddername']).' </td>
                                    <td>'.$status.'</td> 
                                </tr>';
                            $i++;
                          }
                        
                         $html .= '</tbody>
                    </table>
            </div>';
        }
    $pdf->writeHTML($html, true, false, true, false, '');
    // Technical Evalution

    // Financial Evalution

    if($financial_evalution[0]['approval_date']=='0000-00-00' || $financial_evalution[0]['approval_date']==''){

    $approval_date_finance1 = "--";} else {  $approval_date_finance = new DateTime($financial_evalution[0]['approval_date']); 
    $approval_date_finance1 = $approval_date_finance->format('jS M Y'); }
$pdf->AddPage();
if(!empty($financial_evalution[0]['remarks'])){
      $financial_evalution1 = $financial_evalution[0]['remarks'];}else{
     $financial_evalution1 = "--";}


    $html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;"> Project Tendering - Financial Evalution</div>

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Financial Evalution Date</td>
                    <td>'.$approval_date_finance1.'</td> 
                    <td style="background-color: #00000026;"> Remarks</td>
                    <td>'.$financial_evalution1.'</td>
                </tr>

                </tbody>
            </table>
                
         </div>';

         if(!empty($financial_evalution_bidder_data)){

          $html .= '<div style="font-size:14px;width:100%;">
                <table width="100%" border="1" style="border-collapse: collapse">
                        <thead>
                                    <tr>
                                        <th style="background-color: #00000026;">Sl No</th>
                                        <th style="background-color: #00000026;">Bidder Name </th>
                                        <th style="background-color: #00000026;">Successful Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</th>
                                        <th style="background-color: #00000026;">Status</th>
                                        <th style="background-color: #00000026;">Final Score</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>';
                                    $i = 1;
                                   
                                    foreach ($financial_evalution_bidder_data as $financial_bidder_data) {
                                    
                                    if($financial_bidder_data['status'] == 'L1'){
                                    $status = 'L1';
                                    }elseif ($financial_bidder_data['status'] == 'L2') {
                                       $status = 'L2';
                                    }
                                    elseif ($financial_bidder_data['status'] == 'L3') {
                                       $status = 'L3';
                                    }
                                    elseif ($financial_bidder_data['status'] == 'N') {
                                       $status = 'Not Qualified';
                                    }
                                    else{
                                       echo $status = '--'; 
                                    }

                        
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$CI->value_check_empty($financial_bidder_data['biddername']).' </td>
                                        <td>'.number_format($CI->amount_check_empty($financial_bidder_data['bidvalue'],2)).'</td>
                                        <td>'.$status.'</td>
                                        <td>'.$CI->value_check_empty($financial_bidder_data['score']).' </td>
                                        
                                        
                                    </tr>';

                                $i++;
                              }

                                $html .= '</tbody>
                    </table>
            </div>';

         }

       $pdf->writeHTML($html, true, false, true, false, '');

    // Financial Evalution


    // Negotiation Evalution
   $pdf->AddPage();  
   if($negotiation[0]['approval_date']=='0000-00-00' || $negotiation[0]['approval_date']==''){
   $approval_date_negotiation1 = "--";
    } else { $approval_date_negotiation = new DateTime($negotiation[0]['approval_date']); 
    $approval_date_negotiation1 = $approval_date_negotiation->format('jS M Y'); }

    if(!empty($negotiation[0]['remarks'])){
      $negotiation1 = $negotiation[0]['remarks'];}else{
      $negotiation1 = "--";}

           $html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;"> Project Tendering - Negotiation</div>

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Negotiation Date</td>
                    <td>'.$approval_date_negotiation1.'</td> 
                    <td style="background-color: #00000026;"> Remarks</td>
                    <td>'.$negotiation1.'</td>
                </tr>

                </tbody>
            </table>
                
         </div>'; 
        //}

if(!empty($negotiation_bidder_data)){

          $html .= '<div style="font-size:14px;width:100%;">
                    <table width="100%" border="1" style="border-collapse: collapse">
                             <thead>
                                    <tr>
                                        <th style="background-color: #00000026;">Sl No</th>
                                        <th style="background-color: #00000026;">Bidder Name </th>
                                        <th style="background-color: #00000026;">Negotiation Meeting date</th>
                                        <th style="background-color: #00000026;">Negotiated Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</th>
                                        <th style="background-color: #00000026;">Status</th> 
                                    </tr>
                                </thead>
                                <tbody>';
                                    $i = 1;
                                   
                                    foreach ($negotiation_bidder_data as $nego_bidder_data) {
                                    
                                    if($nego_bidder_data['status'] == 'Y'){
                                    $status = 'Yes';
                                    }elseif ($nego_bidder_data['status'] == 'N') {
                                       $status = 'No';
                                    }

                                    else{

                                         echo $status = '--';
                                    }
                                    
                                if(!empty($nego_bidder_data['meetingdate'])){

                                  $approval_date_nego = new DateTime($nego_bidder_data['meetingdate']); 
                                  $approval_date_nego1 = $approval_date_nego->format('jS M Y');} else { $approval_date_nego1 = "--"; }
                        
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$CI->amount_check_empty($nego_bidder_data['biddername']).' </td>
                                        <td>'.$approval_date_nego1.'</td>
                                        
                                        <td>'.number_format($CI->amount_check_empty($nego_bidder_data['bidvalue'],2)).'</td>

                                        <td>'.$status.'</td>
                                        
                                    </tr>';

                                $i++;
                              }

                             $html .= '</tbody>
                    </table>
            </div>';

         }

   $pdf->writeHTML($html, true, false, true, false, '');
  // Negotiation Evalution

  // Issue of LOA 

 $pdf->AddPage();
 if(!empty($issue_of_loa[0]['negotiation_meeting_date'])){

    $negotiation_date = new DateTime($issue_of_loa[0]['negotiation_meeting_date']); 
    $negotiation_date1 = $negotiation_date->format('jS M Y');} else { $negotiation_date1 = "--"; }

    if(!empty($issue_of_loa[0]['loa_issue_date'])){

    $LOA_issue_date = new DateTime($issue_of_loa[0]['loa_issue_date']); 
    $LOA_issue_date1 = $LOA_issue_date->format('jS M Y');} else { $LOA_issue_date1 = "--"; }


   if(!empty($issue_of_loa[0]['remarks'])){
        $issue_of_loa1 = $issue_of_loa[0]['remarks'];}else{
        $issue_of_loa1 = "--";}

   $html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;"> Project Tendering - Issue of LOA</div>

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Bidder Ref No/Name</td>
                    <td>'.$CI->amount_check_empty($issue_of_loa[0]['successful_bidder_ref_no']).'</td>
                    <td style="background-color: #00000026;"> Negotiation Meeting date</td>
                    <td>'.$negotiation_date1.'</td>
                </tr>
                <tr>
                    
                    <td style="background-color: #00000026;"> Negotiated Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</td>
                   
                     <td>'.number_format($CI->amount_check_empty($issue_of_loa[0]['negotiation_bid_value'],2)).'</td>
                    <td style="background-color: #00000026;"> LoA issue date</td>
                    <td>'.$LOA_issue_date1.'</td>
                 </tr>
                 <tr>   
                    <td style="background-color: #00000026;"> Remarks</td>
                    <td>'.$issue_of_loa1.'</td>
                 </tr>

                </tbody>
            </table>
                
         </div>'; 


$pdf->writeHTML($html, true, false, true, false, '');

  // Issue of LOA Date

}


if(in_array('Agreement', $type) || in_array('All', $type)){

 $pdf->AddPage();

 $drft_st = '';
if (!empty ($project_agreement[0]['draft_contract_pre_status'])) {
    if($project_agreement[0]['draft_contract_pre_status'] == 'N'){
        $drft_st = 'Not Started';
    }elseif ($project_agreement[0]['draft_contract_pre_status'] == 'S') {
       $drft_st = 'Started';
    }
    elseif ($project_agreement[0]['draft_contract_pre_status'] == 'C') {
       $drft_st = 'Completed';
    }elseif ($project_agreement[0]['draft_contract_pre_status'] == 'U') {
       $drft_st = 'Under Review';
    }elseif ($project_agreement[0]['draft_contract_pre_status'] == 'F') {
       $drft_st = 'Finalized';
    }
  }
  else{
        echo $drft_st = '--';
    }
$contract_st = '';
  if (!empty ($project_agreement[0]['final_draft_contract_shared_bidder_status'])) {
    if($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'N'){
        $contract_st = 'No';
    }elseif ($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'Y') {
       $contract_st = 'Yes';
    }
    //echo $contract_st;
  } 
   else{
        echo $contract_st = '--';
    }

  if (!empty ($project_agreement[0]['final_draft_contract_sharing_date'])) {
       $final_draft_contract_sharing_date = new DateTime($project_agreement[0]['final_draft_contract_sharing_date']); 
      
      
      $final_draft_contract_sharing_date1 =  $final_draft_contract_sharing_date->format('jS M Y');} else { $final_draft_contract_sharing_date1 = "--"; } 

    if (!empty ($project_agreement[0]['agreement_date'])) {
       $agreement_date = new DateTime($project_agreement[0]['agreement_date']); 
      
      
      $agreement_date1 =  $agreement_date->format('jS M Y');} else { $agreement_date1 = "--"; }

      if (!empty ($project_agreement[0]['agreement_end_date'])) {
       $agreement_end_date = new DateTime($project_agreement[0]['agreement_end_date']); 
      
      
      $agreement_end_date1 =  $agreement_end_date->format('jS M Y');} else { $agreement_end_date1 =  "--"; }

       if (!empty ($project_agreement[0]['bg_validity_date'])) {
       $bgvalidity_date = new DateTime($project_agreement[0]['bg_validity_date']); 
      
      
      $bgvalidity_date1 = $bgvalidity_date->format('jS M Y');} else { $bgvalidity_date1 = "--"; }

    if (!empty ($project_agreement[0]['PBG_verified'])) {
    if($project_agreement[0]['PBG_verified'] == 'N'){
        $PBG_verified = 'No';
    }elseif ($project_agreement[0]['PBG_verified'] == 'Y') {
       $PBG_verified = 'Yes';
    }
  }
  else {
    $PBG_verified = '--';
  }

  if (!empty ($project_agreement[0]['project_start_date'])) {
     $pstart_date = new DateTime($project_agreement[0]['project_start_date']); 
    
    
    $pstart_date1 =  $pstart_date->format('jS M Y');} else { $pstart_date1 =  "--"; }

    if (!empty ($project_agreement[0]['project_end_date'])) {
   $pend_date = new DateTime($project_agreement[0]['project_end_date']); 
  
  
  $pend_date1 =  $pend_date->format('jS M Y');} else { $pend_date1 =  "--"; }

if (!empty ($project_agreement[0]['notice_to_proceed_date'])) {
     $notice_to_proceed_date = new DateTime($project_agreement[0]['notice_to_proceed_date']); 
    
    
    $notice_to_proceed_date1 =  $notice_to_proceed_date->format('jS M Y');} else { $notice_to_proceed_date1 =  "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Agreement</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                                    <tr>
                                        <td style="background-color: #00000026;"> Draft Contract Preparation status </td>
            
                                         <td>'.$drft_st.'</td>
                                        <td style="background-color: #00000026;"> Draft Contract Preparation status </td>
            
                                         <td>'.$contract_st.'</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Final Draft Contract sharing date </td>
            
                                         <td> '.$final_draft_contract_sharing_date1.'</td>
                                        <td style="background-color: #00000026;"> Contract signing date </td>
            
                                         <td >' .$agreement_date1.' </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;">  Contract value  (<span style="font-family:dejavusans;">&#8377;</span>)</td>
            
                                        <td>'.number_format($CI->amount_check_empty($project_agreement[0]['agreement_cost'],2)).'</td>
                                        <td style="background-color: #00000026;">  Agreement end date</td>
                                         <td> '.$agreement_end_date1.'</td>
                                     </tr>
                                    <tr>
                                        <td style="background-color: #00000026;">   PBG submitted by Bidder </td>
            
                                        <td>'.$CI->amount_check_empty($project_agreement[0]['bidder_details']).' </td>
                                        <td style="background-color: #00000026;">  Selected bidders representative name</td>
            
                                        <td> '.$CI->amount_check_empty($project_agreement[0]['representative_name']).' </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;">  PBG amount  (<span style="font-family:dejavusans;">&#8377;</span>)</td>
            
            
                                        <td>'.number_format($CI->amount_check_empty($project_agreement[0]['bg_amount'],2)).'</td>
                                        <td style="background-color: #00000026;"> PBG submission date</td>
                                        <td>'.$bgvalidity_date1.'</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;">  PBG verified</td>
                                        <td>'.$PBG_verified.'</td>
                                        <td style="background-color: #00000026;"> Contract Effective date</td>
                                         <td>'.$pstart_date1.'</td>
                                     </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Project end date</td>
                                        <td>'.$pend_date1.'</td>
                                        <td style="background-color: #00000026;"> Notice to proceed date</td>
                                        <td>'.$notice_to_proceed_date1.'</td>
            
            
                                    </tr>

                                    <tr>
                                        <td style="background-color: #00000026;"> Payment Schedule</td>
                                        <td>'.$CI->amount_check_empty($project_agreement[0]['payment_schedule']).'</td>
                                        <td style="background-color: #00000026;"> </td>
                                        <td></td>
            
            
                                    </tr>
                                    <tr>
                                         <td style="background-color: #00000026;"> Remarks  </td>
                                        <td colspan="3"> '.$CI->value_check_empty($project_agreement[0]['remarks']).'</td>
                                    </tr> 
            
                                    </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');

}



if(in_array('ProjectCloser', $type) || in_array('All', $type)){

     if(!empty($project_commissioning)){

 $pdf->AddPage();



    $construction_completion_certificate = 'Not Uploaded';
  if($project_commissioning[0]['construction_completion_certificate'] != ''){
    $construction_completion_certificate = 'Uploaded';
  }else{
    $construction_completion_certificate = 'Not Uploaded';
  }

  $final_payment_status = 'No';
  if($project_commissioning[0]['final_payment_status'] == 'Y'){
    $final_payment_status = 'Yes';
  }else{
    $final_payment_status = 'No';
  }

  $APS_status = 'No';
  if($project_commissioning[0]['APS_status'] == 'Y'){
    $APS_status = 'Yes';
  }else{
    $APS_status = 'No';
  }

  if (!empty ($project_commissioning[0]['certificate_issued_date'])) {
       $certificate_issued_date = new DateTime($project_commissioning[0]['certificate_issued_date']); 
      
      
      $certificate_issued_date1 =  $certificate_issued_date->format('jS M Y');} else { $certificate_issued_date1 = "--"; } 

    if (!empty ($project_commissioning[0]['final_payment_date'])) {
       $final_payment_date = new DateTime($project_commissioning[0]['final_payment_date']); 
      
      
      $final_payment_date1 =  $final_payment_date->format('jS M Y');} else { $final_payment_date1 = "--"; }

      if (!empty ($project_commissioning[0]['DLP_starting_date'])) {
       $DLP_starting_date = new DateTime($project_commissioning[0]['DLP_starting_date']); 
      
      
      $DLP_starting_date1 =  $DLP_starting_date->format('jS M Y');} else { $DLP_starting_date1 =  "--"; }

       if (!empty ($project_commissioning[0]['PBG_returning_date'])) {
       $PBG_returning_date = new DateTime($project_commissioning[0]['PBG_returning_date']); 
      
      
      $PBG_returning_date1 = $PBG_returning_date->format('jS M Y');} else { $PBG_returning_date1 = "--"; }

     

  if (!empty ($project_commissioning[0]['PBG_return_date'])) {
     $PBG_return_date = new DateTime($project_commissioning[0]['PBG_return_date']); 
    
    
    $PBG_return_date1 =  $PBG_return_date->format('jS M Y');} else { $PBG_return_date1 =  "--"; }

    if (!empty ($project_commissioning[0]['retention_release_date'])) {
   $retention_release_date = new DateTime($project_commissioning[0]['retention_release_date']); 
  
  
  $retention_release_date1 =  $retention_release_date->format('jS M Y');} else { $retention_release_date1 =  "--"; }

if (!empty ($project_commissioning[0]['completion_date'])) {
     $completion_date = new DateTime($project_commissioning[0]['completion_date']); 
    
    
    $completion_date1 =  $completion_date->format('jS M Y');} else { $completion_date1 =  "--"; }

$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Closer</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                         <tbody>
                                    <tr>
                                        <td style="background-color: #00000026;"> Construction Completion Certificate issued on </td>
            
                                         <td>'.$certificate_issued_date1.'</td>
                                        <td style="background-color: #00000026;"> Upload Construction Completion Certificate </td>
            
                                         <td>'.$construction_completion_certificate.'</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Final Payment done </td>
            
                                         <td> '.$final_payment_status.'</td>
                                        <td style="background-color: #00000026;"> Final Payment Date </td>
            
                                         <td >' .$final_payment_date1.' </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> APS, if applicable</td>
            
                                        <td>'.$APS_status.'</td>
                                        <td style="background-color: #00000026;"> Retention amount released (<span style="font-family:dejavusans;">&#8377;</span>)</td>
                                         <td> '.number_format($CI->amount_check_empty($project_commissioning[0]['release_retention_amount'],2)).'</td>
                                     </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Retention amount on hold (<span style="font-family:dejavusans;">&#8377;</span>)</td>
            
                                        <td>'.number_format($CI->amount_check_empty($project_commissioning[0]['hold_retention_amount'],2)).' </td>
                                        <td style="background-color: #00000026;"> DLP Starting Date</td>
            
                                        <td> '.$DLP_starting_date1.' </td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Final PBG Returning Date</td>
            
            
                                        <td>'.$PBG_returning_date1.'</td>
                                        <td style="background-color: #00000026;"> PBG Value at Return Date</td>
                                        <td>'.$PBG_return_date1.'</td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="background-color: #00000026;"> Balance Retention amount release date</td>
                                        <td>'.$retention_release_date1.'</td>
                                        <td style="background-color: #00000026;"> Project Closure Date</td>
                                         <td>'.$completion_date1.'</td>
                                     </tr>
                                    <tr>
                                         <td style="background-color: #00000026;"> Remarks  </td>
                                        <td colspan="3"> '.$CI->value_check_empty($project_commissioning[0]['remarks']).'</td>
                                    </tr> 
            
                                    </tbody>
                    </table>
            </div>';






$pdf->writeHTML($html, true, false, true, false, '');

}

}

if(in_array('ProjectProgress', $type) || in_array('All', $type)){
$pdf->AddPage('L', 'A4');
$project_work_item_details_ar = $CI->get_project_work_item_report($project_id);

$work_itemhtml = '<div style="font-size:14px;">
        <div style="font-size:24px;"> Project Stages With Activities</div>
        <table width="100%" border="1" style="border-collapse: collapse">
                        
                    <thead>

                    
                    <tr class="bg-blue-grey">
                    <th style="text-align: center; vertical-align: middle;width:50px;background-color: #00000026;font-size: 8;">Sl No</th>
                    <th style="text-align: center; vertical-align: middle;width:307px;background-color: #00000026;font-size: 8;">Activity Name</th>
                    <th style="text-align: center; vertical-align: middle;width:65px;background-color: #00000026;font-size: 8;">Start</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;width:65px;background-color: #00000026;font-size: 8;">Duration (Month)</th>
                
                    <th style="text-align: center; vertical-align: middle;width:65px;background-color: #00000026;font-size: 8;">Finish Date</th>
                    <th style="text-align: center; vertical-align: middle;width:65px;background-color: #00000026;font-size: 8;">Weightage (%)</th>
                    <th style="text-align: center; vertical-align: middle;width:102px;background-color: #00000026;font-size: 8;">Value (<span style="font-family:dejavusans;">&#8377;</span>)
      </th>
                    
                    <th style="text-align: center; vertical-align: middle;width:94px;background-color: #00000026;font-size: 8;">Earned Value (<span style="font-family:dejavusans;">&#8377;</span>)
      </th>
                    <th style="text-align: center; vertical-align: middle;width:74px;background-color: #00000026;font-size: 8;">Actual Cost (%)</th>
                    <th style="text-align: center; vertical-align: middle;width:94px;background-color: #00000026;font-size: 8;">Paid Value (<span style="font-family:dejavusans;">&#8377;</span>)
      </th>
                </tr>
                    </thead>';
            if (!empty($project_work_item_details_ar)) {
                      foreach ($project_work_item_details_ar as $key => $value) {
                        $work_item_name = $value['work_item_name'];
                        $work_item_id = $value['work_item_id'];
                $work_itemhtml .= '<tbody>
                      <tr style="text-align: center; vertical-align: middle;background-color: #cccccc52 !important;">
                        <td colspan="11" style="width:981px;"><h3>'.$work_item_name.'</h3></td>
                        
                      </tr>';
                if (!empty($value['activity_details'])) {
                        foreach ($value['activity_details'] as $keyActivity => $valueActivity) {

                            $sl = $keyActivity + 1;
                            $activity_name = $valueActivity['activity_name'];
                            $activity_id = $valueActivity['activity_id'];
                            $val_total_planned = round($valueActivity['Planned_Value'], 2);
                            $val_total_earned = round($valueActivity['Earned_Value'], 2);
                            $val_total_paid = round($valueActivity['Paid_Value'], 2);
                            
                            //start date
                            $start_date = $this->Projectdashboard_model->get_project_startdate($project_id,$work_item_id,$activity_id);
                            
                            $start_dateview = date('M Y', strtotime($start_date[0]['month_date']));
                            
                            //finish date
                            $finish_date = $this->Projectdashboard_model->get_project_finishdate($project_id,$work_item_id,$activity_id);
                            $finish_dateview = date('M Y', strtotime($finish_date[0]['month_date']));
                            
                            
                            
                            
                            $duration="";
                            $ts1 = strtotime($start_date[0]['month_date']);
                            $ts2 = strtotime($finish_date[0]['month_date']);
                            
                            $year1 = date('Y', $ts1);
                            $year2 = date('Y', $ts2);
                            
                            $month1 = date('m', $ts1);
                            $month2 = date('m', $ts2);
                            
                            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                            $calM = $diff+1;
                            if ($calM <= "1") {
                            $duration= $calM." Month";
                            }
                            else
                            {
                            $duration= $calM." Months";                             
                            }
                            
                            
                            
                            
                            
                            //Total Project Cost
                             $project_total_cst = $this->Projectdashboard_model->get_total_project_cost($project_id);
                            
                            $weightage =  round(($val_total_planned/$project_total_cst * 100), 2) ;
                            //Progress Status %
                            $progress =  round(($val_total_earned/$project_total_cst * 100), 2) ;
                            //Actual Cost % 
                            $actual_cost =  round(($val_total_paid/$project_total_cst * 100), 2) ;

                            $Planned_Value = $valueActivity['Planned_Value'];
                             $Earned_Value = $valueActivity['Earned_Value'];
                             $Paid_Value = $valueActivity['Paid_Value'];

                             $PV =  ($Planned_Value * 100 ) / $project_total_cst;
                             $EV =  ($Earned_Value * 100 ) / $project_total_cst;
                             $AC =  ($Paid_Value * 100 ) / $project_total_cst;
                             
                             $SV = $EV - $PV;
                             $SPI = $EV / $PV;
                             $CV = $EV - $AC;
                             
                             if($AC != 0){
                             $CPI = $EV / $AC;
                             }else{
                                $CPI = 0.00;
                             }
                $work_itemhtml .= '<tr>
                       <td style="width:50px;font-size: 8;text-align:center;">'.$sl.'</td>
                       <td style="width:307px;font-size: 8;text-align:center;">'.$activity_name.'</td>
                       <td style="width:65px;font-size: 8;text-align:center;">'.$start_dateview.'</td>
                      <td style="width:65px;font-size: 8;text-align:center;">'.$duration.'</td>
                      <td style="width:65px;font-size: 8;text-align:center;">'.$finish_dateview.'</td>
                      <td style="width:65px;font-size: 8;text-align:center;">'.$weightage.'</td>
                      <td style="width:102px;font-size: 8;text-align:right;">'.number_format($CI->amount_check_empty($val_total_planned,2)).'</td>
                      
                      <td style="width:94px;font-size: 8; text-align:right;">'.number_format($CI->amount_check_empty($val_total_earned,2)).'</td>
                      <td style="width:74px;font-size: 8;text-align:center;">'.number_format($CI->amount_check_empty($actual_cost,2)).'</td>
                      <td style="width:94px;font-size: 8;text-align:right;">'.number_format($CI->amount_check_empty($val_total_paid,2)).'</td>
                      
                      </tr>';
            } } else{
                $work_itemhtml .= '<tr><td colspan="11">No Data Available</td></tr>';
            }

            $work_itemhtml .= '</tbody>';
        }}
        $work_itemhtml .= '</table></div>';

 $pdf->writeHTML($work_itemhtml, true, false, true, false, '');
}

//project Issue

if(in_array('ProjectIssue', $type) || in_array('All', $type)){
$pdf->AddPage();
if(!empty($project_issue_details)){
$html = '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Issue Status</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <tbody>
                        
                        <tr>
                            <td style="background-color: #00000026;"> Project Name </td>
                            <td colspan="3">' .$CI->amount_check_empty($project_issue_data['project_name']).'</td>
                        </tr>
                        
                        </tbody>
                    </table>
            </div>';

 }
if(!empty($project_issue_details)){

     $html .= '<div style="font-size:14px;width:100%;">
              <div style="font-size:24px;">Project Issue Information</div>
                <table width="100%" border="1" style="border-collapse: collapse">
                        <thead>
                                    <tr>
                                        <th style="background-color: #00000026;">Sl No</th>
                                        <th style="background-color: #00000026;">Issue Description</th>
                                        <th style="background-color: #00000026;">Action Taken</th>
                                        <th style="background-color: #00000026;">Updated By</th>
                                        <th style="background-color: #00000026;">Updated date</th>
                                        <th style="background-color: #00000026;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $i = 1;
                                    foreach ($project_issue_details as $issue_details) {
                                        if($issue_details->status == 'Y'){
                                            $status = 'Closed';
                                        }elseif ($issue_details->status == 'N') {
                                           $status = 'Open';
                                        }
                                        else {
                                            $status = '--';
                                        }
                                    if (!empty ($issue_details->date)) {
                                       $issue_date = new DateTime($issue_details->date); 

                                      $issue_date1 = $issue_date->format('jS M Y');} else { $issue_date1 = "--"; }
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$issue_details->issuename.' </td>
                                        <td>'.$issue_details->actiontaken.' </td>
                                        
                                        <td>'.$issue_details->createdby.' </td>

                                         <td>'.$issue_date1.'</td>
                                         <td>'.$status.'</td> 
                                        
                                    </tr>';

                                $i++;
                              }
                                $html .= '</tbody>
                    </table>
            </div>';

          }


$pdf->writeHTML($html, true, false, true, false, '');
}
//project Issue
$pdf->lastPage();
// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output('Project Monitoring Dashboard-'.$project_creation_data['project_name'].'.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+

?>