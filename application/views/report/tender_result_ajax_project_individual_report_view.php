<?php
$CI =& get_instance();
?>

<?php
    $imtype = implode(',', $type);
    $en_project_id =base64_encode($project_id);
    ?>
<div class="col-md-2 col-md-offset-9 text-center" style="margin-top: 0px;margin-bottom: 15px !important;">
    <a href="<?php echo site_url().'/Tender_Report/project_individual_report_pdf?project_id='.$en_project_id.'&type='.$imtype; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>




      <?php 

       if(in_array('Tendering', $type) || in_array('All', $type)){
       ?>
     
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Project Tendering - Pre Bid</h2>
                </div>

      <?php
        if(!empty($pre_bid_data)){
       ?>
     <div class="body">
     <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                    
                      <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Prebid Meeting date</td>
                      <td><?php 
                          if($pre_bid_data[0]['approval_date']=='0000-00-00'){
                              echo $pre_bid_data[0]['approval_date']='';
                           }
                         else{
                            
                             $submission_date = new DateTime($pre_bid_data[0]['approval_date']); 
                             echo $submission_date->format('jS M Y');
                           }

                     ?></td>


                      <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                      <td><?php echo $pre_bid_data[0]['remarks']; ?></td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i>Corrigendum / Addendum Issuance Date</td>
                        <td><?php 
                              if($pre_bid_data[0]['corrigendum_issuance_date']=='0000-00-00'){
                                  echo $pre_bid_data[0]['corrigendum_issuance_date']='';
                               }
                               else{
                                $submission_date1 = new DateTime($pre_bid_data[0]['corrigendum_issuance_date']); 
                                echo $submission_date1->format('jS M Y');
                               }
                               
                         ?></td> 
                          
                          <td>  &nbsp; </td>
                          <td>  &nbsp; </td>
                   </tr>


                </tbody>
         </table>
     </div>
     

 <?php }else {
        echo 'No data availbale!!';
    } ?> 

    <?php
        if(!empty($pre_bid_bidder_data)){
       ?>

<div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Name  </th>
               <th> Country </th>
               <th> First Name </th>
               <th> Middle Name </th>
               <th> Last Name </th>
               <th> Mobile Number </th>
               <th> Email Address </th>

            </thead>
            <tbody>
                 <?php
                    if(!empty($pre_bid_bidder_data)){
                    foreach ($pre_bid_bidder_data as $prebid_bidder_data) {
                    ?>
                    <tr>
                         <td><?php echo $prebid_bidder_data['bidder_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['country']; ?></td>
                         <td><?php echo $prebid_bidder_data['first_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['middle_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['last_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['mobile_no']; ?></td>
                         <td><?php echo $prebid_bidder_data['email_id']; ?></td>
                    </tr>
                 <?php } } ?>

              
            </tbody>
        </table>
     </div>

        <?php } ?>
  
      <?php
        if(!empty($pre_bid_bidder_data_document)){
       ?>


       <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Upload Pre-bid Clarifications </th>
            </thead>
            <tbody>

                <?php
                if(!empty($pre_bid_bidder_data_document)){
                foreach ($pre_bid_bidder_data_document as $prebid_bidder_data_document) {
                ?>
                <tr>
                      <td><a href="<?php echo base_url();?>uploads/files/prebid/<?php echo $prebid_bidder_data_document['document_name']; ?>" title="Download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a></td> 
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>

     <?php } ?>

    </div>
  </div>
</div>

<!-- Technical Evalution -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Project Tendering - Technical Evalution</h2>
                </div>
      <?php
        if(!empty($technical_evalution)){
       ?>
       <div class="body">

         <div class="table-responsive">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Technical Evalution Date</td>
                        <td><?php 
                              if($technical_evalution[0]['approval_date']=='0000-00-00'){
                                  echo $technical_evalution[0]['approval_date']='';
                               }
                               else
                               {
                                //echo $technical_evalution[0]['approval_date'];
                                $submission_date3 = new DateTime($technical_evalution[0]['approval_date']); 
                                echo $submission_date3->format('jS M Y');
                               }
                         ?></td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                        <td><?php echo $technical_evalution[0]['remarks']; ?></td>
                   </tr>
                </tbody>
         </table>
    </div>

   <?php }else {
        echo 'No data availbale!!';
    } ?>

     <?php
        if(!empty($technical_evalution_bidder_data)){
       ?>

        <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Ref No/Name </th>
               <th> Technically qualified / disqualified </th>
            </thead>
            <tbody>

                <?php
                if(!empty($technical_evalution_bidder_data)){
                foreach ($technical_evalution_bidder_data as $bidder_data) {
                ?>
                <tr>
                     <td><?php echo $bidder_data['biddername']; ?></td>
                     <td>
                        <?php if($bidder_data['status']=='Y') {
                            echo $bidder_data['status']='Yes';
                        }

                        else{
                           echo $bidder_data['status']='No';
                        }

                         ?>
                     </td>
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>


     <?php } ?>
    </div>
  </div>
</div>
<!-- Technical Evalution -->
<!-- Financial Evalution -->

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Project Tendering - Financial Evalution</h2>
                </div>

                 <?php
                    if(!empty($financial_evalution)){
                   ?>
                   <div class="body">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <tbody>
                                    <tr>
                                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Financial Evalution Date</td>
                                    <td><?php 
                                          if($financial_evalution[0]['approval_date']=='0000-00-00'){
                                              echo $financial_evalution[0]['approval_date']='';
                                           }

                                           else
                                           {
                                           $submission_date4 = new DateTime($financial_evalution[0]['approval_date']); 
                                          echo $submission_date4->format('jS M Y');

                                           }
                                           
                                     ?></td>

                                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                                    <td><?php echo $financial_evalution[0]['remarks']; ?></td>
                                    
                                   </tr>
                                </tbody>
                         </table>
                   </div>

                   <?php }else {
                        echo 'No data availbale!!';
                    } ?> 

                <?php
                  if(!empty($financial_evalution_bidder_data)){
                ?> 
                
                <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                               <th> Bidder Ref No/Name </th>
                               <th> Successful Bid Value(₹) </th>
                               <th> Status </th>
                               <th> Final Score </th>
                            </thead>
                            <tbody>

                                <?php
                                if(!empty($financial_evalution_bidder_data)){
                                foreach ($financial_evalution_bidder_data as $financial_bidder_data) {
                                ?>
                                <tr>
                                     <td><?php echo $financial_bidder_data['biddername']; ?></td>
                                     <td><?php echo number_format($financial_bidder_data['bidvalue'],2); ?></td>
                                   

                                     <td>
                                        <?php if($financial_bidder_data['status']=='L1') {
                                            echo $financial_bidder_data['status']='L1';
                                        }

                                        elseif ($financial_bidder_data['status']=='L2') {
                                             echo $financial_bidder_data['status']='L2';
                                        }
                                         elseif ($financial_bidder_data['status']=='L3') {
                                             echo $financial_bidder_data['status']='L3';
                                        }
                                        else
                                        {
                                           echo $financial_bidder_data['status']='Not Qualified';
                                        }
                                        ?>
                                     </td>
                                     <td><?php echo $financial_bidder_data['score']; ?></td>
                                </tr>
                             <?php } } ?>
                            </tbody>
                        </table>
                     </div>


                <?php } ?>
               

            </div>
        </div>
    </div>

<!-- Financial Evalution -->

<!-- Negotiation Evalution -->

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Project Tendering - Negotiation </h2>
                </div>
                  <?php
                    if(!empty($negotiation)){
                   ?>
                   <div class="body">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <tbody>
                                    <tr>
                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Negotiation Date</td>
                                        <td>
                                            <?php 
                                              if($negotiation[0]['approval_date']=='0000-00-00'){
                                                  echo $negotiation[0]['approval_date']='';
                                               }

                                               else
                                               {
                                                
                                                $submission_date5 = new DateTime($negotiation[0]['approval_date']); 
                                               echo $submission_date5->format('jS M Y');
                                               }       
                                            ?>    
                                         </td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                                        <td><?php echo $negotiation[0]['remarks']; ?></td>
                                   </tr>
                                </tbody>
                         </table>
                    </div>

                    <?php }else {
                        echo 'No data availbale!!';
                    } ?> 
                   
                    <?php
                        if(!empty($negotiation_bidder_data)){
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                               <th> Bidder Ref No/Name </th>
                               <th> Negotiation Meeting date</th>
                               <th> Negotiated Bid Value(₹)</th>
                               <th> Status</th>
                            </thead>
                            <tbody>

                                <?php
                                if(!empty($negotiation_bidder_data)){
                                foreach ($negotiation_bidder_data as $bidder_negotiation_data) {
                                ?>
                                <tr>
                                     <td><?php echo $bidder_negotiation_data['biddername']; ?></td>
                                      
                                     <td><?php $submission_date8 = new DateTime($bidder_negotiation_data['meetingdate']); 
                                               echo $submission_date8->format('jS M Y');  ?></td>
                                   

                                     <td><?php echo number_format($bidder_negotiation_data['bidvalue'],2); ?></td>

                                     <td>
                                        <?php if($bidder_negotiation_data['status']=='Y') {
                                            echo $bidder_negotiation_data['status']='Yes';
                                        }

                                        else{
                                           echo $bidder_negotiation_data['status']='No';
                                        }

                                         ?>
                                     </td>
                                </tr>
                             <?php } } ?>
                            </tbody>
                        </table>
                     </div>

                    <?php } ?>
                </div>
        </div>
</div>
<!-- Negotiation Evalution -->

<!-- Issue of LoA Evalution -->

   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Project Tendering - issue_of_loa</h2>
                </div>

                 <?php
                    if(!empty($issue_of_loa)){
                   ?>
                   <div class="body">
                    <div class="table-responsive">
                         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <tbody>
                                    <tr>
                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Successful Bidder Ref No/Name</td>
                                        <td><?php echo $issue_of_loa[0]['successful_bidder_ref_no']; ?></td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Negotiation Meeting date</td>
                                        <td><?php 
                                              if($issue_of_loa[0]['negotiation_meeting_date']=='0000-00-00'){
                                                  echo $issue_of_loa[0]['negotiation_meeting_date']='';
                                               }

                                               else
                                               {
                                                
                                                $submission_date6 = new DateTime($issue_of_loa[0]['negotiation_meeting_date']); 
                                               echo $submission_date6->format('jS M Y');
                                               }
                                               
                                         ?></td>
                                   </tr>

                                   <tr>
                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Negotiated Bid Value(₹)</td>
                                        

                                        <td><?php echo number_format($issue_of_loa['negotiation_bid_value'],2); ?></td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Issue of LOA Date</td>
                                        <td><?php 
                                              if($issue_of_loa[0]['loa_issue_date']=='0000-00-00'){
                                                  echo $issue_of_loa[0]['loa_issue_date']='';
                                               }

                                               else
                                               {
                                            
                                               $submission_date7 = new DateTime($issue_of_loa[0]['loa_issue_date']); 
                                               echo $submission_date7->format('jS M Y');

                                               }
                                               
                                         ?></td>
                                   </tr>

                                   <tr>  
                                    
                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                                        <td><?php echo $issue_of_loa[0]['remarks']; ?></td>
                                   </tr>
                                   
                                </tbody>
                         </table>
                    </div>
                <?php }else {
                        echo 'No data availbale!!';
                    } ?> 

                   </div>

            </div>
    </div>
<!-- Issue of LoA Evalution -->

<?php  }   ?>
