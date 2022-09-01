<?php

$CI =& get_instance();
?>
 <?php
    $imtype = implode(',', $type);

    $form_data_val = $imtype.'&project_sector_id='.base64_encode($project_sector_id).'&project_group_id='.base64_encode($project_group_id).'&project_category_id='.base64_encode($project_category_id).'&project_area_id='.base64_encode($project_area_id).'&project_wing_id='.base64_encode($project_wing_id).'&project_division_id='.base64_encode($project_division_id).'&project_status='.$project_status;


    ?>
<div class="col-md-2 col-md-offset-9 text-center" style="margin-top: 0px;margin-bottom: 15px !important;">
  <a href="<?php echo base_url().'Report/summary_generate_pdf?type='.$form_data_val; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>

<?php
    if(in_array('ProjectOverviewReport', $type)){
    ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Project Overview Report</h2>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            	<tr class="bg-blue-grey">
                           <th colspan="6" style="text-align: center; vertical-align: middle;">Project Overview</th>
                           <th colspan="9" style="text-align: center; vertical-align: middle;">Pre-Construction</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Construction</th>
                       </tr>
                            
                        <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;padding: 0; width: 300px">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;">Project Category</th>
                        <th style="text-align: center; vertical-align: middle;">Location</th>
                        <th style="text-align: center; vertical-align: middle;">Scheme</th>
                        <th style="text-align: center; vertical-align: middle;">Project Status</th>
                        <th style="text-align: center; vertical-align: middle;">Govt Land</th>
                        <th style="text-align: center; vertical-align: middle;">Direct Purchase Land</th>
                        <th style="text-align: center; vertical-align: middle;">Land Acquisition</th>
                        <th style="text-align: center; vertical-align: middle;">Forest Land</th>
                        
                        
                        <th style="text-align: center; vertical-align: middle;">Utlility Shifting (Electrical)</th>
                        <th style="text-align: center; vertical-align: middle;">Utlility Shifting <br>(PH)</th>
                        <th style="text-align: center; vertical-align: middle;">Utility Shifting <br>(RWSS)</th>
                        <th style="text-align: center; vertical-align: middle;">Tree Cutting</th>
                        <th style="text-align: center; vertical-align: middle;">Encroachment eviction</th>
                        <th style="text-align: center; vertical-align: middle;">Work Progress <br>(%) </th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                      </tr>
                      
                            </thead>
                            <tbody>
                            	<?php
                            	$sl = 1;
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
                                    

                            	?>
                            	<tr>
                            		<td><?php echo $sl; ?></td>
                            		<td><?php echo $pro_details['project_name']; ?></td>
                            		<td><?php echo $pro_details['category_name']; ?></td>
                            		<td><?php echo $pro_details['location']; ?></td>
                            		<td><?php echo $pro_details['scheme']; ?></td>
                            		<td><?php echo $stage; ?></td>
                            		<td><?php echo $pro_details['govt_land_%']; ?></td>
                                    <td><?php echo $pro_details['pvt_land_direct_purchase_%']; ?></td>
                                    <td><?php echo $pro_details['land_acquistion_%']; ?></td>
                                    <td><?php echo $pro_details['forest_land_%']; ?></td>
                                    <td><?php echo $pro_details['shifting_electrical_%']; ?></td>
                                    <td><?php echo $pro_details['ph_%']; ?></td>
                                    <td><?php echo $pro_details['rwss_%']; ?></td>
                                    <td><?php echo $pro_details['tree_%']; ?></td>
                                    <td><?php echo $pro_details['eviction_%']; ?></td>
                                    <td><?php echo round($s_percent,2); ?></td>
                                    <td><?php 
                                        if (!empty ($pr_target_end_date[0]['target_end_date'])) {
                                         $chpr_target_end_date = new DateTime($pr_target_end_date[0]['target_end_date']); 
                                        echo $chpr_target_end_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            	</tr>
                           
                            <?php $sl++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php
}
    if(in_array('PreConstructionSummaryReport', $type)){
    ?>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Pre-Construction Summary Report</h2>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                            	<tr class="bg-blue-grey">
                           <th colspan="6" style="text-align: center; vertical-align: middle;">Pre-Construction Summary</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Govt. Land Alienation</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Private Land Acquisition</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Private Land Direct Purchase</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Forest Clearance</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Environment Clearance</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Tree Cutting</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Utility Shifting <br>(Energy)</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Utility Shifting <br>(PH)</th>
                           <th colspan="2" style="text-align: center; vertical-align: middle;">Encroachment Eviction</th>
                       </tr>
                            
                        <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                        <th style="text-align: center; vertical-align: middle;">Project Name</th>
                        <th style="text-align: center; vertical-align: middle;">Project Category</th>
                        <th style="text-align: center; vertical-align: middle;">Circle</th>
                        <th style="text-align: center; vertical-align: middle;">Division</th>
                        <th style="text-align: center; vertical-align: middle;">Scheme</th>
                        <th style="text-align: center; vertical-align: middle;">Land Alienated</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Land requisitioned</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Land requisitioned</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Land Cleared</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Clearance received</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;"> Trees cut</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Poles shifted </th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Length shifted </th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>
                        <th style="text-align: center; vertical-align: middle;">Land cleared</th>
                        <th style="text-align: center; vertical-align: middle;">Target End Date</th>

                        
                      </tr>
                      
                            </thead>
                            <tbody>
                            	<?php
                            	$s = 1;
                            	if(is_array($pre_Contruction_data)){
                            		foreach ($pre_Contruction_data as $value) {
                            		

                            	?>
                            	<tr>
                            		<td><?php echo $s; ?></td>
                            		<td><?php echo $value->project_name; ?></td>
                            		<td><?php echo $value->category_name; ?></td>
                            		<td><?php echo $value->circle_name; ?></td>
                            		<td><?php echo $value->division_name; ?></td>
                            		<td><?php echo $value->scheme; ?></td>
                            		<td><?php echo $value->govt_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->govt_date)) {
                                         $govt_date = new DateTime($value->govt_date); 
                                        echo $govt_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->pvt_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->pvt_date)) {
                                         $pvt_date = new DateTime($value->pvt_date); 
                                        echo $pvt_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->direct_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->direct_date)) {
                                         $direct_date = new DateTime($value->direct_date); 
                                        echo $direct_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->forest_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->forest_date)) {
                                         $forest_date = new DateTime($value->forest_date); 
                                        echo $forest_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->env_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->env_date)) {
                                         $env_date = new DateTime($value->env_date); 
                                        echo $env_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->tree_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->tree_date)) {
                                         $tree_date = new DateTime($value->tree_date); 
                                        echo $tree_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->eng_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->eng_date)) {
                                         $eng_date = new DateTime($value->eng_date); 
                                        echo $eng_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->ph_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->ph_date)) {
                                         $ph_date = new DateTime($value->ph_date); 
                                        echo $ph_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		<td><?php echo $value->eviction_val; ?></td>
                                    <td><?php 
                                        if (!empty ($value->eviction_date)) {
                                         $eviction_date = new DateTime($value->eviction_date); 
                                        echo $eviction_date->format('jS M Y');} else { echo "--"; } ?>
                                    </td>
                            		
                            		
                            	</tr>
                           
                            <?php $s++; } } ?>
                           

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Project Issue Report -->
  <?php  
          if(in_array('SummaryProjectStatus', $type)){
    ?>

     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">

                 <div class="header">
                    <h2>Project Issue Summary Report</h2>
                </div>

                <div class="body">
                    <div class="table-responsive">

                         <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                            
                                <tr class="bg-blue-grey">
                                    <th style="text-align: center; vertical-align: middle;">Sl. No.</th>
                                    <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Issue Description</th> 
                                    <th style="text-align: center; vertical-align: middle;">Action Taken</th>
                                    <th style="text-align: center; vertical-align: middle;">Status</th> 
                                    <th style="text-align: center; vertical-align: middle;">Updated By</th> 
                                    <th style="text-align: center; vertical-align: middle;">Updated date</th>  
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $s = 1;
                                if(is_array($issue_data_summary)){
                                    foreach ($issue_data_summary as $value) {
                                       
                                ?>
                                  <tr>
                                     <td><?php echo $s; ?></td>
                                     <td><?php echo $value->project_name; ?></td>
                                     <td><?php echo $value->issuename; ?></td>
                                     <td><?php echo $value->actiontaken; ?></td>
                                     <td><?php echo $value->status == "Y" ? Closed : Open ?></td> 
                                     <td><?php echo $value->createdby ?></td>
                                                        
                                     <td><?php $dt = new DateTime($value->date); echo $dt->format('Y-m-d'); ?></td>
                                 </tr>    
                                
                               <?php $s++;}  }  ?>
                               
                            </tbody>
                         </table>
                     </div>

                </div>
            </div>
        </div>

  <?php } ?>
    <!-- Project Issue Report -->


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


   <?php
if(in_array('ProjectDelayedReport', $type)){
?>



<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="card">



<div class="header">
<h2>Project Delayed Report</h2>
</div>



<div class="body">
<div class="table-responsive">



<table class="table table-bordered table-striped table-hover js-example1">
<thead>

<tr class="bg-blue-grey">
<th style="text-align: center; vertical-align: middle;">Sl. No.</th>
<th style="text-align: center; vertical-align: middle;">Project Name</th>
<th style="text-align: center; vertical-align: middle;">Category</th><th style="text-align: center; vertical-align: middle;">Location</th>
<th style="text-align: center; vertical-align: middle;">SV</th>
<th style="text-align: center; vertical-align: middle;">SPI</th>
<th style="text-align: center; vertical-align: middle;">CV</th>
<th style="text-align: center; vertical-align: middle;">CPI</th>
</tr>
</thead>
<tbody>



<?php
$s = 1;
if(is_array($delayed_data)){
foreach ($delayed_data as $project) {



$Planned_Value = $project->Planned_Value;
$Earned_Value = $project->Earned_Value;
$Paid_Value = $project->Paid_Value;
$agreement_cost = $project->agreement_cost;



$PV = ($Planned_Value ) / $agreement_cost;
$EV = ($Earned_Value ) / $agreement_cost;
$AC = ($Paid_Value ) / $agreement_cost;

//$not_seen_count = $CI->get_not_seen_count_data($project->id);



$SV = $EV - $PV;
$SPI = $EV / $PV;


$CV = $EV - $AC;
if($AC != 0){
$CPI = $EV / $AC;



}else{
$CPI = 0.00;
}

?>
<tr>
<td><?php echo $s; ?></td>
<td><?php echo $project->project_name;?></td>
<td><?php echo $project->project_type;?></td>
<td><?php echo $project->area_name;?></td>
<td><span class="label label-danger"><?php echo round($SV,2);?></span></td>
<td><?php echo round($SPI,2);?></td>
<td><?php echo round($CV,2);?></td>
<td><?php echo round($CPI,2);?></td>


</tr>

<?php $s++;} } ?>

</tbody>
</table>
</div>

</div>

</div>
</div>

<?php } ?>