<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2>Agreement </h2>
        </div>
<?php 
if(!empty($project_agreement)){
?>        
                            <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Draft Contract Preparation status </td>
            
                                         <td> <?php 
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
                                            echo $drft_st;
                                          } ?>   </td>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Draft Contract Preparation status </td>
            
                                         <td> <?php 
                                        if (!empty ($project_agreement[0]['final_draft_contract_shared_bidder_status'])) {
                                            if($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'N'){
                                                $contract_st = 'No';
                                            }elseif ($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'Y') {
                                               $contract_st = 'Yes';
                                            }
                                            echo $contract_st;
                                          } ?>   </td>
                                    </tr>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final Draft Contract sharing date </td>
            
                                         <td > <?php 
                                        if (!empty ($project_agreement[0]['final_draft_contract_sharing_date'])) {
                                         $final_draft_contract_sharing_date = new DateTime($project_agreement[0]['final_draft_contract_sharing_date']); 
                                        
                                        
                                        echo $final_draft_contract_sharing_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Contract signing date </td>
            
                                         <td > <?php 
                                        if (!empty ($project_agreement[0]['agreement_date'])) {
                                         $agreement_date = new DateTime($project_agreement[0]['agreement_date']); 
                                        
                                        
                                        echo $agreement_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Contract value  (₹)</td>
            
                                        <td><?php echo !empty($project_agreement[0]['agreement_cost']) ? number_format($project_agreement[0]['agreement_cost'],2) : "NA"; ?></td>
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement end date</td>
                                                                    <td><?php 
                                        if (!empty ($project_agreement[0]['agreement_end_date'])) {
                                         $agreement_end_date = new DateTime($project_agreement[0]['agreement_end_date']); 
                                        
                                        
                                        echo $agreement_end_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>  PBG submitted by Bidder </td>
            
                                        <td> <?php echo !empty($project_agreement[0]['bidder_details']) ? $project_agreement[0]['bidder_details'] : "NA"; ?> </td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Selected bidders representative name</td>
            
                                        <td> <?php echo !empty($project_agreement[0]['representative_name']) ? $project_agreement[0]['representative_name'] : "NA"; ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PBG amount  (₹)</td>
            
            
                                        <td>  <?php echo !empty($project_agreement[0]['bg_amount']) ? number_format($project_agreement[0]['bg_amount'],2) : "NA"; ?>  </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> PBG submission date</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['bg_validity_date'])) {
                                         $bgvalidity_date = new DateTime($project_agreement[0]['bg_validity_date']); 
                                        
                                        
                                        echo $bgvalidity_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PBG verified</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['PBG_verified'])) {
                                            if($project_agreement[0]['PBG_verified'] == 'N'){
                                                $PBG_verified = 'No';
                                            }elseif ($project_agreement[0]['PBG_verified'] == 'Y') {
                                               $PBG_verified = 'Yes';
                                            }
                                            echo $PBG_verified;
                                          } ?>   </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Contract Effective date</td>
                                         <td> <?php 
                                        if (!empty ($project_agreement[0]['project_start_date'])) {
                                         $pstart_date = new DateTime($project_agreement[0]['project_start_date']); 
                                        
                                        
                                        echo $pstart_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                     </tr>
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Stipulated date of Completion as per Agreement</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['project_end_date'])) {
                                         $pend_date = new DateTime($project_agreement[0]['project_end_date']); 
                                        
                                        
                                        echo $pend_date->format('jS M Y');} else { echo "--"; } ?>   
                                    </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Notice to Proceed / Date of Commencement of Project</td>
                                        <td>
                                           <?php 
                                        if (!empty ($project_agreement[0]['notice_to_proceed_date'])) {
                                         $notice_to_proceed_date = new DateTime($project_agreement[0]['notice_to_proceed_date']); 
                                        
                                        
                                        echo $notice_to_proceed_date->format('jS M Y');} else { echo "--"; } ?>   
                                        </td>
            
            
                                    </tr>

                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Payment Schedule</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['payment_schedule'])) {
                                        
                                        
                                        echo $project_agreement[0]['payment_schedule']; 
                                    } ?>   
                                    </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;
                                         
                                        </td>
            
            
                                    </tr>
                                    
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> remarks</td>
                                        
                                        <td colspan="3">
                                          <?php 
                                        if (!empty ($project_agreement[0]['remarks'])) {
                                        
                                        
                                        echo $project_agreement[0]['remarks']; 
                                    } ?>   
                                        </td>
            
            
                                    </tr>
            
                                    </tbody>
                                </table>
            
            
                            </div>

                            <!-- For image  -->
                            <?php
                            if(is_array($project_agreement_attachment)){
                             
                            ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Attachment - Project’s Agreement </h2>
                        </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        
                        <div class=" table-responsive">
                            <table class="table table-bordered table-striped table-hover camelcase">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>File Size</th>
                                        <th>File Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($project_agreement_attachment as $agreement_attachment) {
                                     $agreement_file_link = base_url().'uploads/attachment/'.$agreement_attachment->file_path;
                                     $path4 = 'uploads/attachment/'.$agreement_attachment->file_path;
                                     $file_size4 = $CI->formatSizeUnits(filesize($path4));

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $file_size4; ?></td>
                                        <td><?php echo $agreement_attachment->file_name; ?></td>
                                        <td>
                                            <div class="col-md-3"> 
                                                <a href="<?php echo $agreement_file_link; ?>" class="btn btn-primary waves-effect" title="Download" download><i class="fas fa-download"></i> Download</a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                  
                </div>
            </div>
        <?php } ?>

           <!--  ENd for image -->

<?php }else {
        echo 'No data availbale!!';
    } ?>


</div>