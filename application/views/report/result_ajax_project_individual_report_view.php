<?php
$CI =& get_instance();
?>

<?php
    $imtype = implode(',', $type);
    $en_project_id =base64_encode($project_id);
    ?>
<div class="col-md-2 col-md-offset-9 text-center" style="margin-top: 0px;margin-bottom: 15px !important;">
  <a href="<?php echo site_url().'/Report/project_individual_report_pdf?project_id='.$en_project_id.'&type='.$imtype; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>

<?php
    if(in_array('ProjectInformetion', $type) || in_array('All', $type)){
    ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Project Creation</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <tbody>
                      <tr>
                          <td width="230px"><i class="material-icons" style="position: relative;top: 8px;"> chevron_right</i> Project Name </td>
                          <td colspan="3"><?php echo $project_creation_data['project_name']; ?></td>
                      </tr>
                      <tr>
                          <td> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right</i> Projects Category</td>
                          <!-- <td><?php echo $project_creation_data['project_type_name']; ?></td> -->

                          <td> <?php echo !empty($project_creation_data['project_type_name']) ? $project_creation_data['project_type_name'] : "--"; ?> </td>

                          <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;"> chevron_right</i> Project Scheme</td>

                         <!--  <td><?php echo $project_creation_data['scheme_name']; ?></td> -->
                         <td><?php echo !empty($project_creation_data['scheme_name']) ? $project_creation_data['scheme_name'] : "--"; ?> </td>
                      </tr>
                      <tr>
                          <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project Location  </td>
                          <!-- <td><?php echo $project_creation_data['area_name']; ?></td> -->
                            <td><?php echo !empty($project_creation_data['area_name']) ? $project_creation_data['area_name'] : "--"; ?> </td>
                        
                          <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Indicative Cost (₹)  </td>

                          <td> <?php echo number_format($project_creation_data['project_cost'],2); ?></td>
                         
                      </tr>
                      <tr>
                          
                          <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Division </td>
                          <!-- <td><?php echo $project_creation_data['division_name']; ?></td> -->
                          <td> <?php echo !empty($project_creation_data['division_name']) ? $project_creation_data['division_name'] : "--"; ?> </td>
                          <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Circle </td>
                         <!--  <td><?php echo $project_creation_data['wing_name']; ?></td> -->
                          <td> <?php echo !empty($project_creation_data['wing_name']) ? $project_creation_data['wing_name'] : "--"; ?> </td>
                          

                      </tr>

                     </tbody>
                  </table>


            </div>

    <!-- For users -->
           <!-- For image  -->
                <?php
                if(is_array($project_creation_users)){
                 
                ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Project Stakeholders Information </h2>
                        </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        
                        <div class=" table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>User Name</th>
                                        <th>Designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($project_creation_users as $creation_user) {
                                     

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $creation_user->firstname.' '.$creation_user->lastname; ?></td>
                                        <td><?php echo $creation_user->designation; ?></td>
                                        
                                    </tr>

                                <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                  
                </div>
            </div>
        <?php } ?>
    <!-- End for Users -->
        </div>

    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Project Details</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Name </td>
                                        <td colspan="3"><?php echo !empty($project_detail[0]['project_name']) ? $project_detail[0]['project_name'] : "--"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Scheme </td>
                                        <td><?php echo !empty($project_detail[0]['groupName']) ? $project_detail[0]['groupName'] : "--"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Location </td>
                                        <td><?php echo !empty($project_detail[0]['area_name']) ? $project_detail[0]['area_name'] : "--"; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Submission Date</td>
                                        <td><?php 
                                        if (!empty ($project_detail[0]['submission_date'])) {
                                         $submission_date = new DateTime($project_detail[0]['submission_date']); 
                                        
                                        
                                        echo $submission_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Concept prepared by </td>
                                        <td><?php echo !empty($project_detail[0]['concept_prepared_by']) ? $project_detail[0]['concept_prepared_by'] : "--"; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Concept Submitted for approval  </td>
                                        <td><?php if(!empty($project_detail[0]['concpt_submited_status'])){ if($project_detail[0]['concpt_submited_status'] == 'Y'){ echo "Yes";}else{ echo "No";} }else{ echo "--";} ?></td>
                                       <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Expected Date for Approval </td>
                                        <td> <?php 
                                        if (!empty ($project_detail[0]['expected_approval_date'])) {
                                         $expected_approval_date = new DateTime($project_detail[0]['expected_approval_date']); 
                                        
                                        
                                        echo $expected_approval_date->format('jS M Y');} else { echo "--"; } ?></td> 
            
                                    </tr>
            
                                    <tr>
                                       
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>Approving Authority</td>
                                        <td><?php echo !empty($project_detail[0]['approving_authority']) ? $project_detail[0]['approving_authority'] : "--"; ?></td>

                                        
                                        
            
                                    </tr>
                                 </tbody>
                                </table>
            
            
                            </div>

    
        </div>

    </div>
</div>

<?php

}
    if(in_array('ProjectDPR', $type) || in_array('All', $type)){
    ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Project Planning / DPR</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Plan / DPR Prepared By </td>
                                        <td>
                                           <?php echo !empty($project_dpr_data[0]['dpr_prepared_by_user_id']) ? $project_dpr_data[0]['dpr_prepared_by_user_id'] : "--"; ?>
                                                
                                            </td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Master Plan / DPR Start Date </td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_start_date'])) {
                                         $dpr_start_date = new DateTime($project_dpr_data[0]['dpr_start_date']); 
                                        
                                        
                                        echo $dpr_start_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Master Plan / DPR End Date</td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_end_date'])) {
                                         $dpr_end_date = new DateTime($project_dpr_data[0]['dpr_end_date']); 
                                        
                                        
                                        echo $dpr_end_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Master Plan / DPR Submission Date</td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_submission_date'])) {
                                         $dpr_submission_date = new DateTime($project_dpr_data[0]['dpr_submission_date']); 
                                        
                                        
                                        echo $dpr_submission_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                                
                                
            
            
                            </div>

    
        </div>

    </div>
</div>


<?php

}
    if(in_array('AdministrativeApproval', $type) || in_array('All', $type)){
    ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2> Project Administrative Approval</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of Presentation for Administrative Approval </td>
                                        <td>
                                            <?php 
                                        if (!empty ($project_administrative_approval_data[0]['date_of_presentation'])) {
                                         $date_of_presentation = new DateTime($project_administrative_approval_data[0]['date_of_presentation']); 
                                        
                                        
                                        echo $date_of_presentation->format('jS M Y');} else { echo "--"; } ?>
                                                
                                            </td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Administrative Approval Date </td>
                                        <td><?php 
                                        if (!empty ($project_administrative_approval_data[0]['administrative_approval_date'])) {
                                         $administrative_approval_date = new DateTime($project_administrative_approval_data[0]['administrative_approval_date']); 
                                        
                                        
                                        echo $administrative_approval_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Administrative Approval File No. (Physical and/or OSWAS ref) </td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['file_no']) ? $project_administrative_approval_data[0]['file_no'] : "--"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Final Approval Authority</td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['final_approval_authority']) ? $project_administrative_approval_data[0]['final_approval_authority'] : "--"; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Approved Project Cost  (₹)</td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['approved_project_cost']) ? number_format($project_administrative_approval_data[0]['approved_project_cost'],2) : "--"; ?></td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                                
                                
            
            
                            </div>

    
        </div>

    </div>
</div>

<?php

}
    if(in_array('PreConstructionActivities', $type) || in_array('All', $type)){
    ?>

<?php
if($project_pre_construction_setting[0]['land_schedule'] == 'Y'){
  $land_schedule = $CI->project_pre_construction_details_data($project_id,'land_schedule');
  $district_data = $land_schedule['district_data'];
  if(!empty($district_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Land Schedule</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover">
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
                                
                                
            
            
         </div>

    
        </div>

    </div>
</div>
<?php } } ?>



<?php

if($project_pre_construction_setting[0]['govt_land_alienation'] == 'Y'){
  $gov_land_alienation = $CI->project_pre_construction_details_data($project_id,'gov_land_alienation');
  $gov_land_alienation_data = $gov_land_alienation['gov_land_alienation_data'];
  if(!empty($gov_land_alienation_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Government Land Alienation</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
           <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Total Area To Be Alienated  </td>
                    <td><?php echo $gov_land_alienation_data[0]['total_land']; ?> Acres</td>
                    <td  width=310px> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Departments that Own the Land </td>
                    <!-- <td><?php echo $gov_land_alienation_data[0]['department_id']; ?></td> -->
                    <td> <?php echo !empty($gov_land_alienation_data[0]['department_id']) ? $gov_land_alienation_data[0]['department_id'] : "--"; ?> </td>
                </tr>
                <!-- <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Districts Covered  </td>
                    <td></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Tehsils Covered </td>
                    <td></td>
                </tr> -->
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date </td>
                   
                    <td>
                        <?php
                        if (!empty ($gov_land_alienation_data[0]['target_end_date'])) {
                        $dt = new DateTime($gov_land_alienation_data[0]['target_end_date']);
                        echo $dt->format('jS M Y');} else { echo "--"; } ?>
                    </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Alienation Proposed to Tehsildar</td>
                    <td><?php echo $gov_land_alienation_data[0]['status_alienation_proposed']; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Relinquishment Proposal Submitted </td>
                    <td><?php echo $gov_land_alienation_data[0]['status_relinquishment_proposal']; ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Alienated So Far (In Acres)</td>
                   <!--  <td><?php echo $gov_land_alienation_data[0]['progress_land_alienated']; ?></td> -->

                   <td> <?php echo !empty($gov_land_alienation_data[0]['progress_land_alienated']) ? $gov_land_alienation_data[0]['progress_land_alienated'] : "--"; ?> </td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
                   <!--  <td><?php echo $gov_land_alienation_data[0]['progress_%']; ?></td> -->
                    
                     <td> <?php echo !empty($gov_land_alienation_data[0]['progress_%']) ? $gov_land_alienation_data[0]['progress_%'] : "--"; ?> </td>

                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Required For A/A Alienated </td>
                    <td><?php echo $gov_land_alienation_data[0]['progress_land_required_aa']; ?></td>
                </tr> 
                <tr>
                    <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                    <td><?php echo number_format($gov_land_alienation_data[0]['progress_amount_utilised'],2); ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of Pre-Construction Fund Utilized  </td>
                    <!-- <td><?php echo $gov_land_alienation_data[0]['progress_fund_utilised']; ?></td> -->

                     <td> <?php echo !empty($gov_land_alienation_data[0]['progress_fund_utilised']) ? $gov_land_alienation_data[0]['progress_fund_utilised'] : "--"; ?> </td>


                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
                    <!-- <td> <?php echo $gov_land_alienation_data[0]['remarks']; ?></td> -->

                    <td> <?php echo !empty($gov_land_alienation_data[0]['remarks']) ? $gov_land_alienation_data[0]['remarks'] : "--"; ?> </td>
                    <td>&nbsp;  </td>
                    <td>&nbsp;  </td>
                </tr>

                </tbody>
            </table>
                                
                                
            </div>

    
        </div>

    </div>
</div>
<?php } } ?>




<?php

if($project_pre_construction_setting[0]['private_land_direct_purchase'] == 'Y'){
  $private_land_dp = $CI->project_pre_construction_details_data($project_id,'private_land_dp');
  $private_land_dp_data = $private_land_dp['private_land_dp_data'];
   if(!empty($private_land_dp_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Private Land (Direct Purchase)</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
           <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Total Area To Be Purchased  </td>
                <td><?php echo $private_land_dp_data[0]['total_area']; ?> Acres</td>
                
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Estimate Cost Of Purchase  </td>
                <!-- <td><?php echo number_format($private_land_dp_data[0]['estimated_cost'],2); ?></td> -->
                <td><?php echo !empty($private_land_dp_data[0]['estimated_cost']) ? number_format($private_land_dp_data[0]['estimated_cost'],2) : "--"; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> General Category Land </td>
               <!--  <td> <?php echo $private_land_dp_data[0]['general_cat_land']; ?></td> -->

              <td> <?php echo !empty($private_land_dp_data[0]['general_cat_land']) ? $private_land_dp_data[0]['general_cat_land'] : "--"; ?> </td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> SC Land  </td>
                <!-- <td><?php echo $private_land_dp_data[0]['sc_land']; ?></td> -->
                <td><?php echo !empty($private_land_dp_data[0]['sc_land']) ? $private_land_dp_data[0]['sc_land'] : "--"; ?> </td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> ST land </td>
                <!-- <td><?php echo $private_land_dp_data[0]['st_land']; ?></td> -->

                <td> <?php echo !empty($private_land_dp_data[0]['st_land']) ? $private_land_dp_data[0]['st_land'] : "--"; ?> </td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date </td>
               
                <td>
                    <?php
                    if (!empty ($private_land_dp_data[0]['target_end_date'])) {
                    $dt = new DateTime($private_land_dp_data[0]['target_end_date']);
                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                </td>
                <!-- <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Districts Covered  </td>
                <td></td> -->
            </tr>

            <tr>
                <!-- <td> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Tehsils Covered </td>
                <td></td> -->
                <!-- <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date </td>
               
                <td>
                    <?php
                    if (!empty ($private_land_dp_data[0]['target_end_date'])) {
                    $dt = new DateTime($private_land_dp_data[0]['target_end_date']);
                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                </td> -->
            </tr> 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Bilateral Negotiation Conducted ?</td>
                <!-- <td><?php echo $private_land_dp_data[0]['status_negotiation_conducted']; ?> </td> -->
               <td> <?php echo !empty($private_land_dp_data[0]['status_negotiation_conducted']) ? $private_land_dp_data[0]['status_negotiation_conducted'] : "--"; ?> </td>


                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> DCAC Metting Held ? </td>
               <!--  <td><?php echo $private_land_dp_data[0]['status_dcac_meeting_held']; ?></td> -->

               <td> <?php echo !empty($private_land_dp_data[0]['status_dcac_meeting_held']) ? $private_land_dp_data[0]['status_dcac_meeting_held'] : "--"; ?> </td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> A / A funds Approved ?</td>
                <!-- <td><?php echo $private_land_dp_data[0]['status_aa_funds_approved']; ?> </td> -->
                <td> <?php echo !empty($private_land_dp_data[0]['status_aa_funds_approved']) ? $private_land_dp_data[0]['status_aa_funds_approved'] : "--"; ?> </td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Registration Done ? </td>
                <!-- <td><?php echo $private_land_dp_data[0]['status_land_registration']; ?></td> -->
                <td> <?php echo !empty($private_land_dp_data[0]['status_land_registration']) ? $private_land_dp_data[0]['status_land_registration'] : "--"; ?> </td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Possesed So Far </td>
                 <td> <?php echo !empty($private_land_dp_data[0]['progress_land_processed']) ? $private_land_dp_data[0]['progress_land_processed'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
               <!-- <td><?php echo $private_land_dp_data[0]['progress_%']; ?></td> -->

               <td> <?php echo !empty($private_land_dp_data[0]['progress_%']) ? $private_land_dp_data[0]['progress_%'] : "--"; ?> </td>
                
            </tr> 

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Required For A/A Purchased </td>
                <!-- <td><?php echo $private_land_dp_data[0]['progress_land_required_aa']; ?></td> -->
                <td> <?php echo !empty($private_land_dp_data[0]['progress_land_required_aa']) ? $private_land_dp_data[0]['progress_land_required_aa'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                <td><?php echo number_format($private_land_dp_data[0]['progress_amount_utilised'],2); ?></td>
            </tr> 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % Of Pre-Construction Fund Utilized  </td>
                <!-- <td>  <?php echo $private_land_dp_data[0]['progress_fund_utilised']; ?></td> -->
                 <td> <?php echo !empty($private_land_dp_data[0]['progress_fund_utilised']) ? $private_land_dp_data[0]['progress_fund_utilised'] : "--"; ?> </td>
                 <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
               <!--  <td> <?php echo $private_land_dp_data[0]['remarks']; ?></td> -->
                <td> <?php echo !empty($private_land_dp_data[0]['remarks']) ? $private_land_dp_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr> 


            </tbody>
        </table>
                                
                                
            
            
        </div>

    
        </div>

    </div>
</div>
<?php } } ?>



<?php

if($project_pre_construction_setting[0]['private_land_acquisition'] == 'Y'){
  $private_land_la = $CI->project_pre_construction_details_data($project_id,'private_land_la');
  $private_land_la_data = $private_land_la['private_land_la_data'];
   if(!empty($private_land_la_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Private Land (Land Acquisition)</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Total Area To Be Purchased  </td>
                <td><?php echo $private_land_la_data[0]['total_area']; ?> Acres</td>
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Compensation Amount  </td>

                <!-- <td><?php echo number_format($private_land_la_data[0]['compensation_amount'],2); ?></td> -->

                <td><?php echo !empty($private_land_la_data[0]['compensation_amount']) ? number_format($private_land_la_data[0]['compensation_amount'],2) : "--"; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> General Category Land </td>
                <!-- <td> <?php echo $private_land_la_data[0]['general_cat_land']; ?></td> -->

                <td> <?php echo !empty($private_land_la_data[0]['general_cat_land']) ? $private_land_la_data[0]['general_cat_land'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> SC Land  </td>
                <!-- <td><?php echo $private_land_la_data[0]['sc_land']; ?></td> -->
                <td> <?php echo !empty($private_land_la_data[0]['sc_land']) ? $private_land_la_data[0]['sc_land'] : "--"; ?> </td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> ST Land </td>
                <!-- <td><?php echo $private_land_la_data[0]['st_land']; ?></td> -->

                <td> <?php echo !empty($private_land_la_data[0]['st_land']) ? $private_land_la_data[0]['st_land'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date </td>
              
               <td>
                    <?php
                    if (!empty ($private_land_la_data[0]['target_end_date'])) {
                    $dt = new DateTime($private_land_la_data[0]['target_end_date']);
                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
              </td>
               
            </tr>
 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> SIA Approved ?</td>
                <td><?php echo $private_land_la_data[0]['status_SIA_approved']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Notification Under Section 11.1 ? </td>
                <td><?php echo $private_land_la_data[0]['status_notification']; ?></td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Declaration Under Section 19.1 ?</td>
                <td><?php echo $private_land_la_data[0]['status_declaration']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Award Of Compensation ? </td>
                <td><?php echo $private_land_la_data[0]['status_award_of_compensation']; ?></td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Possesed So Far </td>
                 <td> <?php echo !empty($private_land_la_data[0]['progress_land_processed']) ? $private_land_la_data[0]['progress_land_processed'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
                <!-- <td><?php echo $private_land_la_data[0]['progress_%']; ?></td> -->
               
               <td> <?php echo !empty($private_land_la_data[0]['progress_%']) ? $private_land_la_data[0]['progress_%'] : "--"; ?> </td>

            </tr> 

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Required For A/A Purchased </td>
                <td><?php echo $private_land_la_data[0]['progress_land_required_aa']; ?></td>
                <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                <!-- <td><?php echo number_format($private_land_la_data[0]['progress_amount_utilised'],2); ?></td> -->

                <td><?php echo !empty($private_land_la_data[0]['progress_amount_utilised']) ? number_format($private_land_la_data[0]['progress_amount_utilised'],2) : "--"; ?></td>
            </tr> 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of Pre-Construction Fund Utilized  </td>
               <!--  <td><?php echo $private_land_la_data[0]['progress_fund_utilised']; ?></td> -->

                <td> <?php echo !empty($private_land_la_data[0]['progress_fund_utilised']) ? $private_land_la_data[0]['progress_fund_utilised'] : "--"; ?> </td>

                 <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
               <!--  <td>  <?php echo $private_land_la_data[0]['remarks']; ?> </td> -->

               <td> <?php echo !empty($private_land_la_data[0]['remarks']) ? $private_land_la_data[0]['remarks'] : "--"; ?> </td>
            </tr> 

            </tbody>
        </table>
                                
                                
            
            
                            </div>

    
        </div>

    </div>
</div>
<?php }  } ?>



<?php

if($project_pre_construction_setting[0]['forest_land'] == 'Y'){
  $forest_land = $CI->project_pre_construction_details_data($project_id,'forest_land');
  $forest_land_data = $forest_land['forest_land_data'];
  $forest_div_data1 = $CI->get_specific_data_against_value('division_master','id',$forest_land_data[0]['forest_division_id'],'division_name');
  if(!empty($forest_land_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Forest Land</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Total Area To Be Diverted</td>
                <td><?php echo $forest_land_data[0]['total_area_tobe_diverted']; ?> Acres</td>
                <td  width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Forest Division  </td>
                <td><?php echo $forest_div_data1; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund Allotted</td>
               <!--  <td><?php echo $forest_land_data[0]['fund_alloted']; ?></td> -->
               <td> <?php echo !empty($forest_land_data[0]['fund_alloted']) ? $forest_land_data[0]['fund_alloted'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <!-- <td><?php echo $forest_land_data[0]['target_end_date']; ?></td> -->
                <td>
                    <?php
                    if (!empty ($forest_land_data[0]['target_end_date'])) {
                    $dt = new DateTime($forest_land_data[0]['target_end_date']);



                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
               </td>
            </tr> 

            <tr>
                <!-- <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tehsils Covered</td>
                <td></td> -->
               
            </tr>    

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Online Application Submitted ?  </td>
                <td>  <?php echo $forest_land_data[0]['status_application_submited']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> FCP Uploaded Online ?</td>
                <td>  <?php echo $forest_land_data[0]['status_fcp_uploaded']; ?></td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> State govt. Recommendation Obtained  ?</td>
                <td> <?php echo $forest_land_data[0]['status_state_govt_recomend']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Gol Approval Obtained ?  </td>
                <td>  <?php echo $forest_land_data[0]['status_goi_approval']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Parmission Issued ? </td>
                <td> <?php echo $forest_land_data[0]['status_permission_issued']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Cleared So Far </td>
                <td> <?php echo !empty($forest_land_data[0]['progress_land_cleared']) ? $forest_land_data[0]['progress_land_cleared'] : "--"; ?> </td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Progress %  </td>
                <!-- <td>  <?php echo $forest_land_data[0]['progress_%']; ?></td> -->
                <td> <?php echo !empty($forest_land_data[0]['progress_%']) ? $forest_land_data[0]['progress_%'] : "--"; ?> </td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Land Required For A/A Purchased  </td>
                <td>  <?php echo $forest_land_data[0]['progress_land_required_for_cleared_aa']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative; margin:5px"> ₹ </i> Amount Utilized </td>
               <!--  <td> <?php echo $forest_land_data[0]['progress_amount_utilised']; ?></td> -->

               <td><?php echo !empty($forest_land_data[0]['progress_amount_utilised']) ? number_format($forest_land_data[0]['progress_amount_utilised'],2) : "--"; ?></td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> % of Pre-Construction Fund Utilized  </td>
                <!-- <td> <?php echo number_format($forest_land_data[0]['progress_fund_utilised']); ?></td> -->
                <td> <?php echo !empty($forest_land_data[0]['progress_fund_utilised']) ? $forest_land_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Remarks  </td>
                <!-- <td>  <?php echo $forest_land_data[0]['remarks']; ?></td> -->
                 <td> <?php echo !empty($forest_land_data[0]['remarks']) ? $forest_land_data[0]['remarks'] : "--"; ?> </td>
                <td>&nbsp;   </td>
                <td>&nbsp;   </td>
            </tr>

            </tbody>
        </table>
                                
                                
            
            
         </div>

    
        </div>

    </div>
</div>
<?php } }  ?>


<?php

if($project_pre_construction_setting[0]['tree_cutting'] == 'Y'){
  $tree_cutting = $CI->project_pre_construction_details_data($project_id,'tree_cutting');
  $tree_cutting_data = $tree_cutting['tree_cutting_data'];
  $forest_div_data = $CI->get_specific_data_against_value('forest_division_master','id',$tree_cutting_data[0]['forest_division_id'],'division_name');

  $OFDC_div_data = $CI->get_specific_data_against_value('ofdc_master','id',$tree_cutting_data[0]['ofdc_division_id'],'ofdc_name');
   if(!empty($tree_cutting_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Tree Cutting</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. Of Trees To Be Cut </td>
                <td><?php echo $tree_cutting_data[0]['noof_trees_tobe_cut']; ?></td>
                <td  width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Forest Division  </td>
                <td><?php echo $forest_div_data; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> OFDC Division </td>
                <td><?php echo $OFDC_div_data; ?></td>
               <!--  <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Districts Covered </td>
                <td></td> -->
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <!-- <td><?php echo $tree_cutting_data[0]['target_end_date']; ?></td> -->
                <td>
                    <?php
                    if (!empty ($tree_cutting_data[0]['target_end_date'])) {
                    $dt = new DateTime($tree_cutting_data[0]['target_end_date']);

                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                </td>
            </tr>

            <tr>
                <!-- <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tehsils Covered </td>
                <td></td> -->
                
            </tr>    

            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Join Verification Done ?  </td>
                <td>  <?php echo $tree_cutting_data[0]['status_joint_verification']; ?></td>

               <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tree Cutting required A / A Done   </td>
               <td>  <?php echo $tree_cutting_data[0]['progress_tree_cutting_required_for_aa_done']; ?></td>

            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enumeration Done ?</td>
                <td>  <?php echo $tree_cutting_data[0]['status_enumeration']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Cutting Permission Obtained  ?</td>
                <td> <?php echo $tree_cutting_data[0]['status_cutting_permission']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund For Tree cutting Placed ?  </td>
                <td>  <?php echo $tree_cutting_data[0]['status_fund_for_tree_cutting']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Awarded ? </td>
                <td> <?php echo $tree_cutting_data[0]['status_tender_awarded']; ?></td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. Of Trees Cut </td>
                <!-- <td>  <?php echo $tree_cutting_data[0]['progress_noof_trees_cut']; ?></td> -->

                <td> <?php echo !empty($tree_cutting_data[0]['progress_noof_trees_cut']) ? $tree_cutting_data[0]['progress_noof_trees_cut'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative; margin:5px"> ₹ </i> Amount Utilized </td>
               <!--  <td> <?php echo number_format($tree_cutting_data[0]['progress_amount_utilised'],2); ?></td> -->
               <td><?php echo !empty($tree_cutting_data[0]['progress_amount_utilised']) ? number_format($tree_cutting_data[0]['progress_amount_utilised'],2) : "--"; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <!-- <td>  <?php echo $tree_cutting_data[0]['progress_%']; ?></td> -->
                <td> <?php echo !empty($tree_cutting_data[0]['progress_%']) ? $tree_cutting_data[0]['progress_%'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of Pre-Construction Fund Utilized  </td>
                <!-- <td> <?php echo $tree_cutting_data[0]['progress_fund_utilised']; ?></td> -->
                <td> <?php echo !empty($tree_cutting_data[0]['progress_fund_utilised']) ? $tree_cutting_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr>
            <tr> 
               
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <!-- <td> <?php echo $tree_cutting_data[0]['remarks']; ?></td> -->
                 <td> <?php echo !empty($tree_cutting_data[0]['remarks']) ? $tree_cutting_data[0]['remarks'] : "--"; ?> </td>
            </tr>

            </tbody>
        </table>
                                
                                
        </div>

    
        </div>

    </div>
</div>
<?php } } ?>


<?php

if($project_pre_construction_setting[0]['environmental_clearance'] == 'Y'){
  $environmental_clearance = $CI->project_pre_construction_details_data($project_id,'environmental_clearance');
  $environmental_clearance_data = $environmental_clearance['environmental_clearance_data'];
  if(!empty($environmental_clearance_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Environmental Clearance</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>

                <tr> 
                    <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                   <!--  <td><?php echo $environmental_clearance_data[0]['target_end_date']; ?></td> -->

                   <td>
                        <?php
                        if (!empty ($environmental_clearance_data[0]['target_end_date'])) {
                        $dt = new DateTime($environmental_clearance_data[0]['target_end_date']);



                        echo $dt->format('jS M Y');} else { echo "--"; } ?>
                     </td>

                    <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> EIA and TORS prepared ?  </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_EIA']; ?></td>
                </tr>

                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Online Application Submitted ?</td>
                    <td> <?php echo $environmental_clearance_data[0]['status_online_application']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> OSCPCB Scrutiny Completed  ?</td>
                    <td> <?php echo $environmental_clearance_data[0]['status_OSCPCB_scrunity']; ?></td>
                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> EC Received ?  </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_ec_received']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund for EC Deposite ? </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_fund_for_ec']; ?></td>
                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                    <!-- <td> <?php echo $environmental_clearance_data[0]['remarks']; ?></td> -->
                    <td> <?php echo !empty($environmental_clearance_data[0]['remarks']) ? $environmental_clearance_data[0]['remarks'] : "--"; ?> </td>
                    <td>&nbsp;     </td>
                    <td>&nbsp; </td>
                </tr>

                </tbody>
            </table>
                                
                                
            
            
           </div>

    
        </div>

    </div>
</div>
<?php }  } ?>



<?php

if($project_pre_construction_setting[0]['utility_shifting_electrical'] == 'Y'){
  $utility_shifting_elec = $CI->project_pre_construction_details_data($project_id,'utility_shifting_elec');
  $utility_shifting_elec_data = $utility_shifting_elec['utility_shifting_elec_data'];
  if(!empty($utility_shifting_elec_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Utility Shifting ( Electrical )</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=300px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Poles To Be Shifted </td>
                <td><?php echo $utility_shifting_elec_data[0]['poles_tobe_shifted']; ?></td>
                <td width=300px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> New Lines to be installed </td>
                <!-- <td><?php echo $utility_shifting_elec_data[0]['new_lines_tobe_installed']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_elec_data[0]['new_lines_tobe_installed']) ? $utility_shifting_elec_data[0]['new_lines_tobe_installed'] : "--"; ?> </td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <!-- <td><?php echo $utility_shifting_elec_data[0]['target_end_date']; ?></td> -->

                <td>
                    <?php
                    if (!empty ($utility_shifting_elec_data[0]['target_end_date'])) {
                    $dt = new DateTime($utility_shifting_elec_data[0]['target_end_date']);



                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                    </td>

                   <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % Of Pre-Construction Fund Utilized  </td>
                   <!-- <td> <?php echo $utility_shifting_elec_data[0]['progress_fund_utilised']; ?></td> -->
                   <td> <?php echo !empty($utility_shifting_elec_data[0]['progress_fund_utilised']) ? $utility_shifting_elec_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr>    
           
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint Verification Done ?  </td>
                <td>  <?php echo $utility_shifting_elec_data[0]['status_joint_verification']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Approval Fund Received ? </td>
                <td><?php echo $utility_shifting_elec_data[0]['status_approval_fund_received']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> New Line Charged ? </td>
                <td>  <?php echo $utility_shifting_elec_data[0]['status_new_line_charged']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Awarded ?</td>
                <td> <?php echo $utility_shifting_elec_data[0]['status_tender_awarded']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. Of Poles Shifted </td>
               <!--  <td>  <?php echo $utility_shifting_elec_data[0]['progress_noof_poles_shifted']; ?></td> -->
             
               <td> <?php echo !empty($utility_shifting_elec_data[0]['progress_noof_poles_shifted']) ? $utility_shifting_elec_data[0]['progress_noof_poles_shifted'] : "--"; ?> </td>


                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <!-- <td> <?php echo $utility_shifting_elec_data[0]['progress_%']; ?></td> -->

                <td> <?php echo !empty($utility_shifting_elec_data[0]['progress_%']) ? $utility_shifting_elec_data[0]['progress_%'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Electrical Utility Shifting For A / A Done ?   </td>
                <td> <?php echo $utility_shifting_elec_data[0]['progress_electrical_utility_shifting']; ?> </td>
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
               <!--  <td>  <?php echo number_format($utility_shifting_elec_data[0]['progress_amount_utilised'],2); ?></td> -->
                <td><?php echo !empty($utility_shifting_elec_data[0]['progress_amount_utilised']) ? number_format($utility_shifting_elec_data[0]['progress_amount_utilised'],2) : "--"; ?></td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <!-- <td><?php echo $utility_shifting_elec_data[0]['remarks']; ?></td> -->

                <td> <?php echo !empty($utility_shifting_elec_data[0]['remarks']) ? $utility_shifting_elec_data[0]['remarks'] : "--"; ?> </td>
            </tr>

            </tbody>
        </table>
                                
          </div>

        </div>

    </div>
</div>
<?php } }  ?>



<?php

if($project_pre_construction_setting[0]['utility_shifting_PH'] == 'Y'){
  $utility_shifting_PH = $CI->project_pre_construction_details_data($project_id,'utility_shifting_PH');
  $utility_shifting_PH_data = $utility_shifting_PH['utility_shifting_PH_data'];
  if(!empty($utility_shifting_PH_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Utility Shifting (PH)</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=300px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Pipeline To Be Shifted </td>
                <td><?php echo $utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_lhs']; ?></td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Pipeline To Be Shifted </td>
                <!-- <td><?php echo $utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_rhs']; ?></td> -->

                <td> <?php echo !empty($utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_rhs']) ? $utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_rhs'] : "--"; ?> </td>
                
            </tr>
                
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <!-- <td><?php echo $utility_shifting_PH_data[0]['target_end_date']; ?></td> -->

                <td>
                    <?php
                    if (!empty ($utility_shifting_PH_data[0]['target_end_date'])) {
                    $dt = new DateTime($utility_shifting_PH_data[0]['target_end_date']);



                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                </td>

                 <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PH/RHS Utility Shifting For A / A Done ?   </td>
                <td> <?php echo $utility_shifting_PH_data[0]['progress_ph_utility_shifting']; ?> </td>
                
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint Verification Done ?  </td>
                <td>  <?php echo $utility_shifting_PH_data[0]['status_joint_verification']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund For Utility Shifting Placed ? </td>
                <td><?php echo $utility_shifting_PH_data[0]['status_fund_for_utility_shifting']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Awarded ? </td>
                <td>  <?php echo $utility_shifting_PH_data[0]['status_tender_awarded']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Line To Be Shifted</td>
                <!-- <td> <?php echo $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_lhs']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_lhs']) ? $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_lhs'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Line To Be Shifted</td>
                <!-- <td>  <?php echo $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_rhs']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_rhs']) ? $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_rhs'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <!-- <td><?php echo $utility_shifting_PH_data[0]['progress_%']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_PH_data[0]['progress_%']) ? $utility_shifting_PH_data[0]['progress_%'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
                <!-- <td> <?php echo number_format($utility_shifting_PH_data[0]['progress_amount_utilised'],2); ?></td> -->
               
               <td><?php echo !empty($utility_shifting_PH_data[0]['progress_amount_utilised']) ? number_format($utility_shifting_PH_data[0]['progress_amount_utilised'],2) : "--"; ?></td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % Of Pre-Construction Fund Utilized  </td>
                <!-- <td> <?php echo $utility_shifting_PH_data[0]['progress_fund_utilised']; ?></td> -->

                <td> <?php echo !empty($utility_shifting_PH_data[0]['progress_fund_utilised']) ? $utility_shifting_PH_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <!-- <td> <?php echo $utility_shifting_PH_data[0]['remarks']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_PH_data[0]['remarks']) ? $utility_shifting_PH_data[0]['remarks'] : "--"; ?> </td>
            </tr>

            </tbody>
        </table>
                                

         </div>
    
        </div>

    </div>
</div>
<?php } } ?>


<?php

if($project_pre_construction_setting[0]['utility_shifting_RWSS'] == 'Y'){
  $utility_shifting_RWSS = $CI->project_pre_construction_details_data($project_id,'utility_shifting_RWSS');

  $utility_shifting_RWSS_data = $utility_shifting_RWSS['utility_shifting_RWSS_data'];
  if(!empty($utility_shifting_RWSS_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Utility Shifting (RWSS)</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=300px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Pipeline To Be Shifted </td>
                <td><?php echo $utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_lhs']; ?></td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length Of Pipeline To Be Shifted </td>
                <!-- <td><?php echo $utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_rhs']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_rhs']) ? $utility_shifting_RWSS_data[0]['length_of_pipeline_tobe_shifted_rhs'] : "--"; ?> </td>
                
            </tr>
              
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
               <!--  <td><?php echo $utility_shifting_RWSS_data[0]['target_end_date']; ?></td> -->

               <td>
                    <?php
                    if (!empty ($utility_shifting_RWSS_data[0]['target_end_date'])) {
                    $dt = new DateTime($utility_shifting_RWSS_data[0]['target_end_date']);



                    echo $dt->format('jS M Y');} else { echo "--"; } ?>
                 </td>

                 <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PH/RHS utility shifting for A / A done ?   </td>
                <td> <?php echo $utility_shifting_RWSS_data[0]['progress_rwss_utility_shifting']; ?> </td>
               
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint verification done ?  </td>
                <td>  <?php echo $utility_shifting_RWSS_data[0]['status_joint_verification']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund for utility shifting placed ? </td>
                <td><?php echo $utility_shifting_RWSS_data[0]['status_fund_for_utility_shifting']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender awarded ? </td>
                <td>  <?php echo $utility_shifting_RWSS_data[0]['status_tender_awarded']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of line to be shifted</td>
                <!-- <td> <?php echo $utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_lhs']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_lhs']) ? $utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_lhs'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of line to be shifted </td>
                <!-- <td>  <?php echo $utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_rhs']; ?></td> -->

                <td> <?php echo !empty($utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_rhs']) ? $utility_shifting_RWSS_data[0]['progress_length_of_line_tobe_shifted_rhs'] : "--"; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <!-- <td><?php echo $utility_shifting_RWSS_data[0]['progress_%']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_RWSS_data[0]['progress_%']) ? $utility_shifting_RWSS_data[0]['progress_%'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
               <!--  <td> <?php echo number_format($utility_shifting_RWSS_data[0]['progress_amount_utilised'],2); ?></td> -->

               <td><?php echo !empty($utility_shifting_RWSS_data[0]['progress_amount_utilised']) ? number_format($utility_shifting_RWSS_data[0]['progress_amount_utilised'],2) : "--"; ?></td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
               <!--  <td> <?php echo $utility_shifting_RWSS_data[0]['progress_fund_utilised']; ?></td> -->

               <td> <?php echo !empty($utility_shifting_RWSS_data[0]['progress_fund_utilised']) ? $utility_shifting_RWSS_data[0]['progress_fund_utilised'] : "--"; ?> </td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <!-- <td> <?php echo $utility_shifting_RWSS_data[0]['remarks']; ?></td> -->
                <td> <?php echo !empty($utility_shifting_RWSS_data[0]['remarks']) ? $utility_shifting_RWSS_data[0]['remarks'] : "--"; ?> </td>

            </tr>

            </tbody>
        </table>
                                
        </div>

    
        </div>

    </div>
</div>
<?php } } ?>


<?php

if($project_pre_construction_setting[0]['encroachment_eviction'] == 'Y'){
  $encroachment_eviction = $CI->project_pre_construction_details_data($project_id,'encroachment_eviction');
  
  $encroachment_eviction_data = $encroachment_eviction['encroachment_eviction_data'];

  $encroachment_div_data = $CI->get_specific_data_against_value('encroachment_master','id',$encroachment_eviction_data[0]['types_of_encroachment'],'name');
  if(!empty($encroachment_eviction_data)){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>   Pre-Construction Activities - Encroachment Eviction</h2>
        </div>

        <div class="body">
          <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Area under Encroachment </td>
                <td><?php echo $encroachment_eviction_data[0]['total_area']; ?> Acres</td>
                <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Type of Encroachment </td>
               <td><?php echo $encroachment_div_data; ?></td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
               <!--  <td><?php echo $encroachment_eviction_data[0]['target_end_date']; ?></td> -->
               <td>
                <?php
                if (!empty ($encroachment_eviction_data[0]['target_end_date'])) {
                $dt = new DateTime($encroachment_eviction_data[0]['target_end_date']);


                echo $dt->format('jS M Y');} else { echo "--"; } ?>
                </td>

                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <!-- <td> <?php echo $encroachment_eviction_data[0]['progress_fund_utilised']; ?> </td> -->
                <td> <?php echo !empty($encroachment_eviction_data[0]['progress_fund_utilised']) ? $encroachment_eviction_data[0]['progress_fund_utilised'] : "--"; ?> </td>
                
            </tr>    
            
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint verification done ?  </td>
                <td> <?php echo $encroachment_eviction_data[0]['status_joint_verification']; ?>  </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Formal requisition filed ? </td>
                <td><?php echo $encroachment_eviction_data[0]['status_formal_requisition']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment eviction programme fixed ? </td>
                <td>  <?php echo $encroachment_eviction_data[0]['status_encroachment_eviction']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment notice filed </td>
                <td> <?php echo $encroachment_eviction_data[0]['status_encroachment_notice']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment area evicted so far </td>
                <td>  <?php echo $encroachment_eviction_data[0]['progress_encroachment_area']; ?> Acres</td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <!-- <td> <?php echo $encroachment_eviction_data[0]['progress_%']; ?></td> -->

                <td> <?php echo !empty($encroachment_eviction_data[0]['progress_%']) ? $encroachment_eviction_data[0]['progress_%'] : "--"; ?> </td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment eviction for A / A done ?   </td>
                <td> <?php echo $encroachment_eviction_data[0]['progress_enroachment_area_aa']; ?> </td>
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
                <!-- <td> <?php echo number_format($encroachment_eviction_data[0]['progress_amount_utilised'],2); ?></td> -->

                 <td><?php echo !empty($encroachment_eviction_data[0]['progress_amount_utilised']) ? number_format($encroachment_eviction_data[0]['progress_amount_utilised'],2) : "--"; ?></td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <!-- <td> <?php echo $encroachment_eviction_data[0]['remarks']; ?></td> -->
                <td> <?php echo !empty($encroachment_eviction_data[0]['remarks']) ? $encroachment_eviction_data[0]['remarks'] : "--"; ?> </td>
            </tr>

            </tbody>
        </table>
                                
                                
            
         </div>

    
        </div>

    </div>
</div>
<?php } } } ?>

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
                              echo $pre_bid_data[0]['approval_date']='--';
                           }
                         else{
                            
                             $submission_date = new DateTime($pre_bid_data[0]['approval_date']); 
                             echo $submission_date->format('jS M Y');
                           }

                     ?></td>


                      <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                      <!-- <td><?php echo $pre_bid_data[0]['remarks']; ?></td> -->
                      <td> <?php echo !empty($pre_bid_data[0]['remarks']) ? $pre_bid_data[0]['remarks'] : "--"; ?> </td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i>Corrigendum / Addendum Issuance Date</td>
                        <td><?php 
                              if($pre_bid_data[0]['corrigendum_issuance_date']=='0000-00-00'){
                                  echo $pre_bid_data[0]['corrigendum_issuance_date']='--';
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
        echo 'No data available!!';
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
                         <!-- <td><?php echo $prebid_bidder_data['bidder_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['country']; ?></td>
                         <td><?php echo $prebid_bidder_data['first_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['middle_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['last_name']; ?></td>
                         <td><?php echo $prebid_bidder_data['mobile_no']; ?></td>
                         <td><?php echo $prebid_bidder_data['email_id']; ?></td> -->

                         <td> <?php echo !empty($prebid_bidder_data['bidder_name']) ? $prebid_bidder_data['bidder_name'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['country']) ? $prebid_bidder_data['country'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['first_name']) ? $prebid_bidder_data['first_name'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['middle_name']) ? $prebid_bidder_data['middle_name'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['last_name']) ? $prebid_bidder_data['last_name'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['mobile_no']) ? $prebid_bidder_data['mobile_no'] : "--"; ?> </td>
                         <td> <?php echo !empty($prebid_bidder_data['email_id']) ? $prebid_bidder_data['email_id'] : "--"; ?> </td>
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
                                  echo $technical_evalution[0]['approval_date']='--';
                               }
                               else
                               {
                                //echo $technical_evalution[0]['approval_date'];
                                $submission_date3 = new DateTime($technical_evalution[0]['approval_date']); 
                                echo $submission_date3->format('jS M Y');
                               }
                         ?></td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                        <!-- <td><?php echo $technical_evalution[0]['remarks']; ?></td> -->

                        <td> <?php echo !empty($technical_evalution[0]['remarks']) ? $technical_evalution[0]['remarks'] : "--"; ?> </td>
                   </tr>
                </tbody>
         </table>
    </div>

   <?php }else {
        echo 'No data available!!';
    } ?>

     <?php
        if(!empty($technical_evalution_bidder_data)){
       ?>

        <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Ref No/Name </th>
               <th> Technically Qualified / Disqualified </th>
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
                                              echo $financial_evalution[0]['approval_date']='--';
                                           }

                                           else
                                           {
                                           $submission_date4 = new DateTime($financial_evalution[0]['approval_date']); 
                                          echo $submission_date4->format('jS M Y');

                                           }
                                           
                                     ?></td>

                                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                                    <!-- <td><?php echo $financial_evalution[0]['remarks']; ?></td> -->
                                    <td> <?php echo !empty($financial_evalution[0]['remarks']) ? $financial_evalution[0]['remarks'] : "--"; ?> </td>
                                    
                                   </tr>
                                </tbody>
                         </table>
                   </div>

                   <?php }else {
                        echo 'No data available!!';
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
                                     <!-- <td><?php echo number_format($financial_bidder_data['bidvalue'],2); ?></td> -->

                                     <td>
                                       <?php

                                        if($financial_bidder_data['bidvalue']=='') {
                                            echo $financial_bidder_data['bidvalue']='--';
                                        }

                                        else {
                                           echo number_format($financial_bidder_data['bidvalue'],2);
                                        }

                                      ?>

                                     </td>
                                   

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
                                     <td>
                                        <?php

                                        if($financial_bidder_data['score']=='') {
                                            echo $financial_bidder_data['score']='--';
                                        }

                                        else {
                                           echo number_format($financial_bidder_data['score'],2);
                                        }

                                        ?>

                                        <!-- <?php echo $financial_bidder_data['score']; ?> -->
                                         

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
                                                  echo $negotiation[0]['approval_date']='--';
                                               }

                                               else
                                               {
                                                $submission_date5 = new DateTime($negotiation[0]['approval_date']); 
                                               echo $submission_date5->format('jS M Y');
                                               }       
                                            ?>    
                                         </td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                                        <!-- <td><?php echo $negotiation[0]['remarks']; ?></td> -->

                                        <td><?php echo !empty($negotiation[0]['remarks']) ? $negotiation[0]['remarks'] : "--"; ?> </td>
                                   </tr>
                                </tbody>
                         </table>
                    </div>

                    <?php }else {
                        echo 'No data available!!';
                    } ?> 
                   
                    <?php
                        if(!empty($negotiation_bidder_data)){
                    ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                               <th> Bidder Ref No/Name </th>
                               <th> Negotiation Meeting Date</th>
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

                                     <!-- <td> <?php echo !empty($bidder_negotiation_data['biddername']) ? $bidder_negotiation_data['biddername'] : "--"; ?> </td> -->
                                      
                                   
                                    <td><?php
                                    if($bidder_negotiation_data['meetingdate']==''){
                                    echo $bidder_negotiation_data['meetingdate']='--';
                                    }

                                    else{

                                    $submission_date8 = new DateTime($bidder_negotiation_data['meetingdate']);
                                    echo $submission_date8->format('jS M Y');
                                    }

                                    ?></td>

                                    <!-- <td><?php echo number_format($bidder_negotiation_data['bidvalue'],2); ?></td> -->

                                    <td>
                                        <?php

                                            if($bidder_negotiation_data['bidvalue']=='') {
                                                echo $bidder_negotiation_data['bidvalue']='--';
                                            }

                                            else {
                                               echo number_format($bidder_negotiation_data['bidvalue'],2);
                                            }

                                          ?>
                                    </td>
 
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
                    <h2> Project Tendering - Issue of LOA</h2>
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
                                        <!-- <td><?php echo $issue_of_loa[0]['successful_bidder_ref_no']; ?></td> -->

                                        <td> <?php echo !empty($issue_of_loa[0]['successful_bidder_ref_no']) ? $issue_of_loa[0]['successful_bidder_ref_no'] : "--"; ?> </td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Negotiation Meeting Date</td>
                                        <td><?php 
                                              if($issue_of_loa[0]['negotiation_meeting_date']==''){
                                                  echo $issue_of_loa[0]['negotiation_meeting_date']='--';
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
                                        
                                        <!-- <td><?php echo number_format($issue_of_loa[0]['negotiation_bid_value'],2) ?></td> -->

                                        <td>
                                            <?php

                                            if($issue_of_loa[0]['negotiation_bid_value']=='') {
                                                echo $issue_of_loa[0]['negotiation_bid_value']='--';
                                            }

                                            else {
                                               echo number_format($issue_of_loa[0]['negotiation_bid_value'],2);
                                            }

                                          ?>

                                        </td>

                                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Issue of LoA Date</td>
                                        <td><?php 
                                              if($issue_of_loa[0]['loa_issue_date']==''){
                                                  echo $issue_of_loa[0]['loa_issue_date']='--';
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
                                        <!-- <td><?php echo $issue_of_loa[0]['remarks']; ?></td> -->

                                        <td> <?php echo !empty($issue_of_loa[0]['remarks']) ? $issue_of_loa[0]['remarks'] : "--"; ?> </td>
                                   </tr>
                                   
                                </tbody>
                         </table>
                    </div>
                <?php }else {
                        echo 'No data available!!';
                    } ?> 

                   </div>

            </div>
    </div>
<!-- Issue of LoA Evalution -->

<?php  }   ?>

<?php
 if(in_array('Agreement', $type) || in_array('All', $type)){
    ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Agreement </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Draft Contract Preparation Status </td>
            
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
                                          }
                                          else{
                                            echo $drft_st = '--';
                                          } ?>   </td>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Draft Contract Preparation Status </td>
            
                                         <td> <?php 
                                        if (!empty ($project_agreement[0]['final_draft_contract_shared_bidder_status'])) {
                                            if($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'N'){
                                                $contract_st = 'No';
                                            }elseif ($project_agreement[0]['final_draft_contract_shared_bidder_status'] == 'Y') {
                                               $contract_st = 'Yes';
                                            }
                                            echo $contract_st;
                                          }else{
                                            echo $drft_st = '--';
                                          } ?>   </td>
                                    </tr>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final Draft Contract Sharing Date </td>
            
                                         <td > <?php 
                                        if (!empty ($project_agreement[0]['final_draft_contract_sharing_date'])) {
                                         $final_draft_contract_sharing_date = new DateTime($project_agreement[0]['final_draft_contract_sharing_date']); 
                                        
                                        
                                        echo $final_draft_contract_sharing_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Contract Signing Date </td>
            
                                         <td > <?php 
                                        if (!empty ($project_agreement[0]['agreement_date'])) {
                                         $agreement_date = new DateTime($project_agreement[0]['agreement_date']); 
                                        
                                        
                                        echo $agreement_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Contract Value  (₹)</td>
            
                                       <td><?php echo !empty($project_agreement[0]['agreement_cost']) ? number_format( $project_agreement[0]['agreement_cost'],2) : "NA"; ?></td>
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement End Date</td>
                                                                    <td><?php 
                                        if (!empty ($project_agreement[0]['agreement_end_date'])) {
                                         $agreement_end_date = new DateTime($project_agreement[0]['agreement_end_date']); 
                                        
                                        
                                        echo $agreement_end_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>  PBG Submitted by Bidder </td>
            
                                        <td> <?php echo !empty($project_agreement[0]['bidder_details']) ? $project_agreement[0]['bidder_details'] : "--"; ?> </td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Selected Bidders representative Name</td>
            
                                        <td> <?php echo !empty($project_agreement[0]['representative_name']) ? $project_agreement[0]['representative_name'] : "--"; ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PBG amount  (₹)</td>
            
            
                                        <td>  <?php echo !empty($project_agreement[0]['bg_amount']) ? number_format($project_agreement[0]['bg_amount'],2) : "--"; ?>  </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> PBG Submission Date</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['bg_validity_date'])) {
                                         $bgvalidity_date = new DateTime($project_agreement[0]['bg_validity_date']); 
                                        
                                        
                                        echo $bgvalidity_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PBG Verified</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['PBG_verified'])) {
                                            if($project_agreement[0]['PBG_verified'] == 'N'){
                                                $PBG_verified = 'No';
                                            }elseif ($project_agreement[0]['PBG_verified'] == 'Y') {
                                               $PBG_verified = 'Yes';
                                            }
                                            echo $PBG_verified;
                                          } else{
                                            echo $PBG_verified='--';
                                          }?>   </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Contract Effective Date</td>
                                         <td> <?php 
                                        if (!empty ($project_agreement[0]['project_start_date'])) {
                                         $pstart_date = new DateTime($project_agreement[0]['project_start_date']); 
                                        
                                        
                                        echo $pstart_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                     </tr>
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project End Date</td>
                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['project_end_date'])) {
                                         $pend_date = new DateTime($project_agreement[0]['project_end_date']); 
                                        
                                        
                                        echo $pend_date->format('jS M Y');} else { echo "--"; } ?>   
                                    </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Notice to Proceed Date</td>
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
                                    } 
                                      else{
                                         echo $project_agreement[0]['payment_schedule']='--';
                                      }

                                    ?>   
                                    </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> remarks</td>
                                        <td>
                                          <?php 
                                        if (!empty ($project_agreement[0]['remarks'])) {
                                        
                                        echo $project_agreement[0]['remarks']; 
                                      } 
                                      else{
                                         echo $project_agreement[0]['remarks']='--';
                                      }

                                    ?>   
                                        </td>
            
            
                                    </tr>
            
                                    </tbody>
                                </table>

                </div>

              </div>
  
            </div>
          </div>
        </div>
      </div>

    <?php } ?>



<?php
 if(in_array('ProjectCloser', $type) || in_array('All', $type)){
   ?>


 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Project Closer </h2>
          </div>
           <?php
           if(!empty($project_commissioning)){
             
            ?>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    
                                    <tr>
                                        <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Construction Completion Certificate issued on  </td>
            
                                        <td> <?php 
                                        if (!empty ($project_commissioning[0]['certificate_issued_date'])) {
                                         $certificate_issued_date = new DateTime($project_commissioning[0]['certificate_issued_date']); 
                                        
                                        
                                        echo $certificate_issued_date->format('jS M Y');} else { echo "--"; } ?> </td>

                                        <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Upload Construction Completion Certificate</td>
            
            
                                        <td>
                                       <?php  if (!empty($project_commissioning[0]['construction_completion_certificate'])) { ?>
                                        <a target="_blank" href="<?php if (!empty($project_commissioning[0]['construction_completion_certificate'])) { echo base_url().'uploads/commission/'.$project_commissioning[0]['construction_completion_certificate'];} else { echo "#"; } ?>"> Last Uploaded File </a> <?php } else { ?> -- <?php } ?></td>
                                     </tr>
                                    <tr>
                                        <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Final Payment done </td>
            
                                        <td>  <?php if( $project_commissioning[0]['final_payment_status'] == 'Y'){
                                        echo "Yes";
                                    } else if( $project_commissioning[0]['final_payment_status'] == 'N'){
                                        echo "No";
                                    }else{
                                        echo "--";
                                    } ?>   </td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final Payment Date </td>
            
                                        <td> <?php 
                                        if (!empty ($project_commissioning[0]['final_payment_date'])) {
                                         $final_payment_date = new DateTime($project_commissioning[0]['final_payment_date']); 
                                        
                                        
                                        echo $final_payment_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                    </tr>
                                    <tr>
                                        <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> APS, if applicable</td>
            
            
                                        <td>  <?php if( $project_commissioning[0]['APS_status'] == 'Y'){
                                        echo "Yes";
                                    } else if( $project_commissioning[0]['APS_status'] == 'N'){
                                        echo "No";
                                    }else{
                                        echo "NA";
                                    } ?>   </td>

                                    <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Retention amount released </td>
            
                                        <td> <?php echo number_format($project_commissioning[0]['release_retention_amount'],2); ?> </td>
                                        
                                        
                                    </tr>

                                    <tr>
                                        

                                    <td  width="300px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Retention amount on hold </td>
            
                                    <td> <?php echo number_format($project_commissioning[0]['hold_retention_amount'],2); ?> </td>

                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> DLP Starting Date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['DLP_starting_date'])) {
                                         $DLP_starting_date = new DateTime($project_commissioning[0]['DLP_starting_date']); 
                                        
                                        
                                        echo $DLP_starting_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>
                                      
                                        
                                    </tr>

                                    <tr>

                                    <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  Final PBG Returning Date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['PBG_returning_date'])) {
                                         $PBG_returning_date = new DateTime($project_commissioning[0]['PBG_returning_date']); 
                                        
                                        
                                        echo $PBG_returning_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>

                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> PBG Value at Return Date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['PBG_return_date'])) {
                                         $PBG_return_date = new DateTime($project_commissioning[0]['PBG_return_date']); 
                                        
                                        
                                        echo $PBG_return_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>
                                      
                                        
                                    </tr>

                                    <tr>

                                    <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  Balance Retention amount release date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['retention_release_date'])) {
                                         $retention_release_date = new DateTime($project_commissioning[0]['retention_release_date']); 
                                        
                                        
                                        echo $retention_release_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>

                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project Closure Date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['completion_date'])) {
                                         $completion_date = new DateTime($project_commissioning[0]['completion_date']); 
                                        
                                        
                                        echo $completion_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>
                                      
                                        
                                    </tr>

                                    <tr>

                                    <td width="300px"> <i class="material-icons" style="position: relative;top: 8px;">insert_drive_file</i>  Remarks </td>
            
                                    <td colspan="3"> <?php echo $project_commissioning[0]['remarks']; ?> </td>
                                      
                                        
                                    </tr>
            
                                    </tbody>
                                </table>


                </div>

              </div>

                
            </div>

          </div>
          <?php }else {
            echo 'No data available!!';
           } ?> 
         
        </div>
      </div>

      <?php } ?>

   
    <?php
     if(in_array('ProjectProgress', $type) || in_array('All', $type)){
    $project_work_item_details_ar = $CI->get_project_work_item_report($project_id);

    ?>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           
                            <div class="header">
                             <h2>Project Stages With Activities</h2>
                            
                            </div>
                       <?php
           if(!empty($project_work_item_details_ar)){
             
            ?>   

                    <div class="body p-10">
                        <div class="row clearfix">
                            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">

                    <?php 
                    if (!empty($project_work_item_details_ar)) {
                     foreach ($project_work_item_details_ar as $key => $value) {

                                $accordian_id = $key + 1;
                                $work_item_name = $value['work_item_name'];
                                $work_item_id = $value['work_item_id'];
                    ?>

                                            <div class="panel panel-col-teal">
                                                <div class="panel-heading" role="tab" id="heading1">
                                                    <h4 class="panel-title">
                                                        
                                                        <i class="fas fa-align-justify"></i> <?php echo $work_item_name; ?>
                                                        
                                                    </h4>
                                                </div>
                                               
                                                    <div class="panel-body p-5" style="font-size: 11px">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr class="bg-blue-grey">
                                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Activity Name</th><th rowspan="2" style="text-align: center; vertical-align: middle;">Start</th>
                                                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Duration <br />(Month)</th>
                                                </tr>
                                                <tr class="bg-blue-grey">
                                                    <th style="text-align: center; vertical-align: middle;">Finish Date</th>
                                                    <th style="text-align: center; vertical-align: middle;">Weightage <br />(%)</th><th style="text-align: center; vertical-align: middle;">Value <br />(<i class="fa fa-rupee-sign"></i>)</th>
                                                    
                                                    <th style="text-align: center; vertical-align: middle;">Earned Value <br />(<i class="fa fa-rupee-sign"></i>)</th>
                                                    <th style="text-align: center; vertical-align: middle;">Actual Cost <br />(%)</th>
                                                    <th style="text-align: center; vertical-align: middle;">Paid Value <br />(<i class="fa fa-rupee-sign"></i>)</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                        <?php 
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

                                            ?>
                                                <tr style="text-align: center; vertical-align: middle;">
                                                    <td><?php echo $sl; ?></td>
                                                    <td><?php echo $activity_name; ?></td>
                                                    <td><?php echo $start_dateview; ?></td>
                                                    <td><?php echo $duration; ?></td>
                                                    <td><?php echo $finish_dateview; ?></td>
                                                    <td><?php echo $weightage; ?></td>
                                                    <td><?php echo number_format($val_total_planned,2); ?></td>
                                                    <!-- <td><?php //echo round($SV,2); ?></td>
                                                    <td><?php //echo round($SPI,2); ?></td>
                                                    <td><?php //echo round($CV,2); ?></td>
                                                    <td><?php //echo round($CPI,2); ?></td> -->
                                                    <td><?php echo number_format($val_total_earned,2); ?></td>
                                                    <td><?php echo number_format($actual_cost,2); ?></td>
                                                    <td><?php echo number_format($val_total_paid,2); ?></td>
                                                </tr>

                                            <?php } }else{ echo '<tr><td  colspan="11">No Data Available</td></tr>'; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                <?php } } ?>

                                    </div>
                                </div>
                            </div>
                                 

                         <?php }else {
                               echo 'No data available!!';
                           } ?>
                        </div>

                    </div>

   <?php } ?>

   <?php
    if(in_array('ProjectIssue', $type) || in_array('All', $type)){
    ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2>Project Issue Status</h2>
        </div>
      <?php
            if(!empty($project_issue_details)){
             
            ?>
        <div class="body">
          <div class="table-responsive m-b-30">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <tbody>
                      <tr>
                          <td width="230px"><i class="material-icons" style="position: relative;top: 8px;"> chevron_right</i> Project Name </td>
                         
                          <td colspan="3"><?php echo $project_issue_data['project_name']; ?></td>

                      </tr>
                     

                     </tbody>
                  </table>


            </div>

    <!-- For users -->
           <!-- For image  -->
            
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Project Issue Information </h2>
                        </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        
                        <div class=" table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Issue Description</th>
                                        <th>Action Taken</th>
                                        <th>Status</th>
                                        <th>Updated By</th>
                                        <th>Updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    foreach ($project_issue_details as $issue_details) {
                                     

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        
                                        <td><?php echo $issue_details->issuename; ?></td>

                                        <td><?php echo $issue_details->actiontaken ?></td>
                                        <td><?php echo $issue_details->status == "Y" ? Closed : Open ?></td> 
                                        <td><?php echo $issue_details->createdby ?></td>
                                                        
                                        <td>
                                           <?php
                                              if (!empty ($issue_details->date)) {
                                              $dt = new DateTime($issue_details->date);
                                              echo $dt->format('jS M Y');} else { echo "--"; } ?>
                                       </td>
                                        
                                    </tr>

                                <?php $i++; } ?>

                                    
                                </tbody>
                            </table>
                        </div>
                  
                </div>
            </div>
        
        <?php }else {
        echo 'No data available!!';
    } ?> 
    <!-- End for Users -->
        </div>

    </div>
</div>


<?php } ?>
