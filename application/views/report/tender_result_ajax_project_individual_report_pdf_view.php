<?php
$CI =& get_instance();
ob_start();
error_reporting(0); //hide php errors
$CI =& get_instance();
$this->load->library('Pdf');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Somnath Maity');
$pdf->SetTitle('Project Report');
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
$pdf->SetFont('helvetica', '', 9);

// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(2);
$image_file =  base_url().'assets/images/obcc_inner_logo.png';

        $pdf->Image($image_file, 90, 10, 40, '', '', '', 'T', false, 400, '', false, false, 0, false, false, false);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);
        $pdf->SetTopMargin(25);


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



   $html = '<div style="font-size:24px;width:100%;">Project Tendering - Pre Bid</div>

           <div style="font-size:14px;width:100%;">
             

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
                                        <td>'.$prebid_bidder_data['bidder_name'].' </td>
                                        <td>'.$prebid_bidder_data['country'].' </td>
                                        <td>'.$prebid_bidder_data['first_name'].' </td>
                                        <td>'.$prebid_bidder_data['middle_name'].' </td>
                                        <td>'.$prebid_bidder_data['last_name'].' </td>
                                        <td>'.$prebid_bidder_data['mobile_no'].' </td>
                                        <td>'.$prebid_bidder_data['email_id'].' </td>
                                        
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


   $html = '<div style="font-size:24px;"> Project Tendering - Technical Evalution</div>
            <div style="font-size:14px;width:100%;">
              
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
                                $html .= '<tr>
                                    <td>'.$i.'</td>
                                    <td>'.$bidder_data['biddername'].' </td>
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


    $html = ' <div style="font-size:24px;"> Project Tendering - Financial  Evalution</div>
             <div style="font-size:14px;width:100%;">
             

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

                        
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$financial_bidder_data['biddername'].' </td>
                                        <td>'.number_format($financial_bidder_data['bidvalue'],2).'</td>
                                        <td>'.$status.'</td>
                                        <td>'.$financial_bidder_data['score'].' </td>
                                        
                                        
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

           $html = '<div style="font-size:24px;width:100%;"> Project Tendering - Negotiation</div>
                  <div style="font-size:14px;width:100%;">
              

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
                                    
                                if(!empty($nego_bidder_data['meetingdate'])){

                                  $approval_date_nego = new DateTime($nego_bidder_data['meetingdate']); 
                                  $approval_date_nego1 = $approval_date_nego->format('jS M Y');} else { $approval_date_nego1 = "--"; }
                        
                                    $html .= '<tr>
                                        <td>'.$i.'</td>
                                        <td>'.$nego_bidder_data['biddername'].' </td>
                                        <td>'.$approval_date_nego1.'</td>
                                        
                                        <td>'.number_format($nego_bidder_data['bidvalue'],2).'</td>

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

   $html = '<div style="font-size:24px;width:100%;"> Project Tendering - Issue of LOA</div>

            <div style="font-size:14px;width:100%;">
              

              <table width="100%" border="1" style="border-collapse: collapse">
                <tbody>

                <tr>
                    <td style="background-color: #00000026;">Bidder Ref No/Name</td>
                    <td>'.$issue_of_loa[0]['successful_bidder_ref_no'].'</td>
                    <td style="background-color: #00000026;"> Negotiation Meeting date</td>
                    <td>'.$negotiation_date1.'</td>
                </tr>
                <tr>
                    
                    <td style="background-color: #00000026;"> Negotiated Bid Value(<span style="font-family:dejavusans;">&#8377;</span>)</td>
                   
                     <td>'.number_format($issue_of_loa[0]['negotiation_bid_value'],2).'</td>
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



$pdf->lastPage();
// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output('Project Detais.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>