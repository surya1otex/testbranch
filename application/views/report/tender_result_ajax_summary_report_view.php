<?php

$CI =& get_instance();
?>
 <?php
    $imtype = implode(',', $type);

    $form_data_val = $imtype.'&project_sector_id='.base64_encode($project_sector_id).'&project_group_id='.base64_encode($project_group_id).'&project_category_id='.base64_encode($project_category_id).'&project_area_id='.base64_encode($project_area_id).'&project_wing_id='.base64_encode($project_wing_id).'&project_division_id='.base64_encode($project_division_id).'&project_status='.$project_status;


    ?>
<div class="col-md-2 col-md-offset-9 text-center" style="margin-top: 0px;margin-bottom: 15px !important;">
  <a href="<?php echo base_url().'Tender_Report/summary_generate_pdf?type='.$form_data_val; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>






    <?php  
          if(in_array('TenderingSummaryReport', $type)){
    ?>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">

                 <div class="header">
                    <h2>Tendering Summary Report</h2>
                </div>
             <!-- Pre-bid -->
                <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                                <tr class="bg-blue-grey">
                                   <th colspan="9" style="text-align: center; vertical-align: middle;">Pre-Bid</th>
                                </tr>

                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Prebid Meeting date</th> 
                                    <th style="text-align: center; vertical-align: middle;">Bidder Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Country</th> 
                                    <th style="text-align: center; vertical-align: middle;">First Name</th> 
                                    <th style="text-align: center; vertical-align: middle;">Last Name</th> 
                                    <th style="text-align: center; vertical-align: middle;">Mobile Number</th> 
                                    <th style="text-align: center; vertical-align: middle;">Email Id</th>
                                    
                                   
                              </tr>
                            </thead>
                            <tbody>


                                <?php
                                $s = 1;
                                if(is_array($pre_bid_data_summary)){
                                    foreach ($pre_bid_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                     <td><?php echo $s; ?></td>
                                     <td><?php echo $value['tendername']; ?></td>
                                     
                                     <td><?php 
                                              if($value['approval_date']=='0000-00-00'){
                                                  echo $value['approval_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date1 = new DateTime($value['approval_date']); 
                                               echo $submission_date1->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                     <td><?php echo $value['bidder_name']; ?></td>
                                     <td><?php echo $value['country']; ?></td>
                                     <td><?php echo $value['first_name']; ?></td>
                                     <td><?php echo $value['last_name']; ?></td>
                                     <td><?php echo $value['mobile_no']; ?></td>
                                     <td><?php echo $value['email_id']; ?></td>
                                     
                                </tr>    
                                
                               <?php $s++;}  }  ?>
                              
                               
                            </tbody>
                         </table>
                     </div>

                </div>

               <!-- Technical -->

                <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                                <tr class="bg-blue-grey">
                                   
                                   <th colspan="5" style="text-align: center; vertical-align: middle;">Technical Evalution</th>
                                   

                                </tr>

                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Technical Evalution Date</th> <th style="text-align: center; vertical-align: middle;">Bidder Ref No/Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Technically Status</th>
                                   
                              </tr>
                            </thead>
                            <tbody>


                                <?php
                                $s = 1;
                                if(is_array($technical_data_summary)){
                                    foreach ($technical_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                     <td><?php echo $s; ?></td>
                                      <td><?php echo $value['tendername']; ?></td>
                                      
                                      <td><?php 
                                              if($value['tendering_date']=='0000-00-00'){
                                                  echo $value['tendering_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date2 = new DateTime($value['tendering_date']); 
                                               echo $submission_date2->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                     <td><?php echo $value['bidder_tech_name']; ?></td>
                                     <td><?php

                                       if($value['bidder_tech_status']=='Y'){
                                          echo $value['bidder_tech_status']= 'Yes';
                                       }
                                       elseif ($value['bidder_tech_status']=='P') {
                                           echo $value['bidder_tech_status']= 'No';
                                       }
                                       else{
                                           echo $value['bidder_tech_status']= '';
                                       }

                                   ?></td>
                                     
                                </tr>    
                                
                               <?php $s++;}  }  ?>
                              
                               
                            </tbody>
                         </table>
                     </div>

                </div>


                <!-- Financial -->

                    <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                                <tr class="bg-blue-grey">
                                   
                                   <th colspan="7" style="text-align: center; vertical-align: middle;">Financial Evalution</th>
                                   

                                </tr>

                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Financial Evalution Date</th>
                                     <th style="text-align: center; vertical-align: middle;">Bidder Ref No/Name</th>
                                     <th style="text-align: center; vertical-align: middle;">Bid Value(₹)</th>
                                     <th style="text-align: center; vertical-align: middle;">Final Score</th>
                                     <th style="text-align: center; vertical-align: middle;">Status</th>
                                
                                   
                              </tr>
                            </thead>
                            <tbody>


                                <?php
                                $s = 1;
                                if(is_array($financial_data_summary)){
                                    foreach ($financial_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $value['tendername']; ?></td>
                                    

                                      <td><?php 
                                              if($value['approval_date']=='0000-00-00'){
                                                  echo $value['approval_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date3 = new DateTime($value['approval_date']); 
                                               echo $submission_date3->format('jS M Y');

                                               }
                                               
                                         ?></td>

                                    <td><?php echo $value['fina_bidder_name']; ?></td>
                                   

                                    <td><?php echo number_format($value['bid_value'],2); ?></td>
                                    <td><?php echo $value['final_score']; ?></td>
                                   
                                     <td><?php

                                       if($value['bidder_status']=='L1'){
                                          echo $value['bidder_status']= 'L1';
                                       }
                                       elseif ($value['bidder_status']=='L2') {
                                           echo $value['bidder_status']= 'L2';
                                       }
                                       elseif ($value['bidder_status']=='L3') {
                                           echo $value['bidder_status']= 'L3';
                                       }
                                       elseif ($value['bidder_status']=='N') {
                                           echo $value['bidder_status']= 'Not Qualified';
                                       }
                                       else{
                                           echo $value['bidder_status']= '';
                                       }

                                   ?></td>
                                     
                                </tr>    
                                
                               <?php $s++;}  }  ?>
                              
                               
                            </tbody>
                         </table>
                     </div>

                </div>

                 <!-- Negotiation -->


                  <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                                <tr class="bg-blue-grey">
                                   
                                   <th colspan="7" style="text-align: center; vertical-align: middle;">Negotiation</th>
                                   
                                </tr>

                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Negotiation Date</th>
                                    <th style="text-align: center; vertical-align: middle;">Negotiation Bidder name</th>
                                    <th style="text-align: center; vertical-align: middle;">Negotiation Meeting date</th>
                                    <th style="text-align: center; vertical-align: middle;">Negotiation Bid Value(₹)</th>
                                     <th style="text-align: center; vertical-align: middle;">Negotiation Status</th>
                                
                                   
                              </tr>
                            </thead>
                            <tbody>


                                <?php
                                $s = 1;
                                if(is_array($negotiation_data_summary)){
                                    foreach ($negotiation_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $value['tendername']; ?></td>
                                   

                                     <td><?php 
                                              if($value['approval_date']=='0000-00-00'){
                                                  echo $value['approval_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date4 = new DateTime($value['approval_date']); 
                                               echo $submission_date4->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                    <td><?php echo $value['bidder_name']; ?></td>
                                   

                                    <td><?php 
                                              if($value['nego_date']=='0000-00-00'){
                                                  echo $value['nego_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date6 = new DateTime($value['nego_date']); 
                                               echo $submission_date6->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                    

                                    <td><?php echo number_format($value['nego_bid_value'],2); ?></td>

                                     <td><?php

                                       if($value['nego_status']=='Y'){
                                          echo $value['nego_status']= 'Yes';
                                       }
                                       elseif ($value['nego_status']=='N') {
                                           echo $value['nego_status']= 'No';
                                       }
                                       else{
                                           echo $value['nego_status']= '';
                                       }

                                   ?></td>
                                </tr>    
                                
                               <?php $s++;}  }  ?>
                              
                               
                            </tbody>
                         </table>
                     </div>

                </div>


                <!-- Issue of LOA -->
                 <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                                <tr class="bg-blue-grey">
                                   
                                   <th colspan="7" style="text-align: center; vertical-align: middle;">Issue of LOA</th>
                                   
                                </tr>

                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Successful Bidder Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Issue of LOA Date</th>
                                    <th style="text-align: center; vertical-align: middle;">Negotiated Bid Value(₹)</th>     
                              </tr>
                            </thead>
                            <tbody>


                                <?php
                                $s = 1;
                                if(is_array($issue_of_loa_data_summary)){
                                    foreach ($issue_of_loa_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $value['tendername']; ?></td>
                                    <td><?php echo $value['successful_bidder_ref_no']; ?></td>
                                   

                                    <td><?php 
                                              if($value['loa_issue_date']=='0000-00-00'){
                                                  echo $value['loa_issue_date']='--';
                                               }

                                               else
                                               {
                                                
                                               $submission_date5 = new DateTime($value['loa_issue_date']); 
                                               echo $submission_date5->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                   

                                    <td><?php echo number_format($value['negotiation_bid_value'],2); ?></td>
                                   
                                </tr>    
                                
                               <?php $s++;}  }  ?>
                               
                            </tbody>
                         </table>
                     </div>

                </div>


              </div>
          </div>
   <?php } ?>