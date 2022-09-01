<?php $CI =& get_instance();
  $CI->load->model('Projectdashboard_model');
  // echo "string";
  // die();
  ?>
<div class="row m-b-20">
             
                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                 <div class="panel-group m-b-10" id="accordion_10" role="tablist" aria-multiselectable="true">  
                    <div class="panel panel-col-black">
                        <div class="panel-heading" role="tab" id="headingTwo_10">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_10" href="#collapseTwo_10" aria-expanded="false"
                                   aria-controls="collapseTwo_10">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Project Information - <?php echo !empty($project_detail[0]['project_name']) ? $project_detail[0]['project_name'] : "NA"; ?>
                                </a>
                            </h4>
                        </div>
            <div id="collapseTwo_10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_10">
                
                    <ul class="nav nav-tabs" role="tablist">

                    <!-- <li role="presentation" class="active">
                        <a href="#project_creation" data-toggle="tab" aria-expanded="true">
                            <i class="material-icons">assignment</i> Project Creation
                        </a>
                    </li> -->

                    <li role="presentation" class="active">
                        <a href="#home_with_icon_title" data-toggle="tab" aria-expanded="true">
                            <i class="material-icons">assignment</i> Concept Creation
                        </a>
                    </li>
                            <?php
                            
                                   if(!empty($project_dpr_data)){ ?>
        
                    <li role="presentation" class="">
                        <a href="#project_dpr_data" data-toggle="tab" aria-expanded="true">
                            <i class="material-icons" style="position: relative;top: 8px;">local_offer</i> DPR
                        </a>
                    </li>
                    <?php
                            
                                  } if(!empty($project_administrative_approval_data)){ ?>
        
                    <li role="presentation" class="">
                        <a href="#project_administrative_approval" data-toggle="tab" aria-expanded="true">
                            <i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Administrative Approval
                        </a>
                    </li>
                    <?php } 
                      if(!empty($project_pre_construction_setting)){ ?>
        
                    <li role="presentation" class="">
        
                        <a href="#project_pre_construction" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">playlist_add_check</i>  Pre Construction Activities
                        </a>
        
                    </li>
                 
                    <?php } 
                                   if(!empty($project_publishing_tender)){ ?>
                    
                    <li role="presentation" class="">
        
                        <a href="#tender_data" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">border_color</i> Tender
                        </a>
        
                    </li>
                    <?php } 
									if(!empty($issue_list)){ ?>
        
                    <li role="presentation" class="">
                        <a href="#communication_data" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">work</i> Communication
                        </a>
                    </li>
                    <?php } 
                                   if(!empty($project_commissioning)){ ?>
        
                    <li role="presentation" class="">
                        <a href="#settings_with_icon_titlecommissioning" data-toggle="tab" aria-expanded="false">
                            <i class="material-icons">explore</i> Closer
                        </a>
                    </li>
                    <?php } 
                                 ?>
                </ul>
                <div class="tab-content body p-10">
                <!-- Project creation -->
                
                <!-- End Project creation -->
                <div role="tabpanel" class="tab-pane active in" id="home_with_icon_title">
                            <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project name </td>
                                        <td colspan="3"><?php echo !empty($project_detail[0]['project_name']) ? $project_detail[0]['project_name'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Scheme </td>
                                        <td><?php echo !empty($project_detail[0]['groupName']) ? $project_detail[0]['groupName'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Location </td>
                                        <td><?php echo !empty($project_detail[0]['area_name']) ? $project_detail[0]['area_name'] : "NA"; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Submission date</td>
                                        <td><?php 
                                        if (!empty ($project_detail[0]['submission_date'])) {
                                         $submission_date = new DateTime($project_detail[0]['submission_date']); 
                                        
                                        
                                        echo $submission_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Concept prepared By </td>
                                        <td><?php echo !empty($project_detail[0]['concept_prepared_by']) ? $project_detail[0]['concept_prepared_by'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Concept Submitted for approval  </td>
                                        <td><?php if(!empty($project_detail[0]['concpt_submited_status'])){ if($project_detail[0]['concpt_submited_status'] == 'Y'){ echo "Yes";}else{ echo "No";} }else{ echo "NA";} ?></td>
                                       <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Expected date for Approval </td>
                                        <td> <?php 
                                        if (!empty ($project_detail[0]['expected_approval_date'])) {
                                         $expected_approval_date = new DateTime($project_detail[0]['expected_approval_date']); 
                                        
                                        
                                        echo $expected_approval_date->format('jS M Y');} else { echo "--"; } ?></td> 
            
                                    </tr>
            
                                    <tr>
                                         <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Division</td>
                                        <td><?php echo !empty($project_detail[0]['division_name']) ? $project_detail[0]['division_name'] : "NA"; ?></td>
                                        
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>Approving Authority</td>
                                        <td><?php echo !empty($project_detail[0]['approving_authority']) ? $project_detail[0]['approving_authority'] : "NA"; ?></td>

                                    </tr>
                                    <tr>

                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Project Circle</td>
                                        <td><?php echo !empty($project_detail[0]['wing_name']) ? $project_detail[0]['wing_name'] : "NA"; ?></td>
                                        <td></td>
                                        <td></td>

                                  </tr>
                                 </tbody>
                                </table>
            
            
                            </div>

                            <!-- For image  -->
                            <?php
                            if(is_array($project_conceptualisation_attachment)){
                             
                            ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Attachment - Project Conceptualisation </h2>
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
                                    foreach ($project_conceptualisation_attachment as $conceptualisation_document) {
                                     $conceptualisation_file_link = base_url().'uploads/attachment/'.$conceptualisation_document->file_path;

                                     $path = 'uploads/attachment/'.$conceptualisation_document->file_path;
                                     $file_size = formatSizeUnits(filesize($path));

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $file_size; ?></td>
                                        <td><?php echo $conceptualisation_document->file_name; ?></td>
                                        <td>
                                            <div class="col-md-3"> 
                                                <a href="<?php echo $conceptualisation_file_link; ?>" class="btn btn-primary waves-effect" title="Download" download><i class="fas fa-download"></i> Download</a>
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
                        </div>

   <!--  ======================== Project DPR ======= -->
            
                                <?php
                                
                                       if(!empty($project_dpr_data)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="project_dpr_data">
                            <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                                    <tbody>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Plan / DPR prepared by </td>
                                        <td>
                                           <?php echo !empty($project_dpr_data[0]['dpr_prepared_by_user_id']) ? $project_dpr_data[0]['dpr_prepared_by_user_id'] : "NA"; ?>
                                                
                                        </td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Master Plan / DPR start date </td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_start_date'])) {
                                         $dpr_start_date = new DateTime($project_dpr_data[0]['dpr_start_date']); 
                                        
                                        
                                        echo $dpr_start_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Master Plan / DPR end date</td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_end_date'])) {
                                         $dpr_end_date = new DateTime($project_dpr_data[0]['dpr_end_date']); 
                                        
                                        
                                        echo $dpr_end_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Master Plan / DPR submission date</td>
                                        <td><?php 
                                        if (!empty ($project_dpr_data[0]['dpr_submission_date'])) {
                                         $dpr_submission_date = new DateTime($project_dpr_data[0]['dpr_submission_date']); 
                                        
                                        
                                        echo $dpr_submission_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                                
                                
            
            
                            </div>
                            <!-- For image  -->
                            <?php
                            if(is_array($project_dpr_attachment)){
                             
                            ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Attachment - Project Master Planning / DPR </h2>
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
                                    foreach ($project_dpr_attachment as $dpr_attachment) {
                                     $dpr_attachment_file_link = base_url().'uploads/attachment/'.$dpr_attachment->file_path;

                                     $path1 = 'uploads/attachment/'.$dpr_attachment->file_path;
                                     $file_size1 = formatSizeUnits(filesize($path1));

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $file_size1; ?></td>
                                        <td><?php echo $dpr_attachment->file_name; ?></td>
                                        <td>
                                            <div class="col-md-3"> 
                                                <a href="<?php echo $dpr_attachment_file_link; ?>" class="btn btn-primary waves-effect" title="Download" download><i class="fas fa-download"></i> Download</a>
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


                        </div>
                    <?php } ?>

<!--       END     ========================END  Project DPR ======= -->


  <!--  ======================== Project Project Administrative Approval ======= -->
            
                                <?php
                                
                                       if(!empty($project_administrative_approval_data)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="project_administrative_approval">
                            <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                                    <tbody>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of presentation for Administrative approval </td>
                                        <td>
                                            <?php 
                                        if (!empty ($project_administrative_approval_data[0]['date_of_presentation'])) {
                                         $date_of_presentation = new DateTime($project_administrative_approval_data[0]['date_of_presentation']); 
                                        
                                        
                                        echo $date_of_presentation->format('jS M Y');} else { echo "--"; } ?>
                                                
                                            </td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Administrative Approval date </td>
                                        <td><?php 
                                        if (!empty ($project_administrative_approval_data[0]['administrative_approval_date'])) {
                                         $administrative_approval_date = new DateTime($project_administrative_approval_data[0]['administrative_approval_date']); 
                                        
                                        
                                        echo $administrative_approval_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Administrative Approval file No. (Physical and/or OSWAS ref) </td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['file_no']) ? $project_administrative_approval_data[0]['file_no'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Final Approval Authority</td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['final_approval_authority']) ? $project_administrative_approval_data[0]['final_approval_authority'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Approved Project Cost  (₹)</td>
                                        <td><?php echo !empty($project_administrative_approval_data[0]['approved_project_cost']) ? number_format($project_administrative_approval_data[0]['approved_project_cost'],2) : "NA"; ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                                
                                
            
            
                            </div>
                            <!-- For image  -->
                            <?php
                            if(is_array($project_administrative_approval_attachment)){
                             
                            ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Attachment - Project Administrative Approval </h2>
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
                                    foreach ($project_administrative_approval_attachment as $approval_attachment) {
                                     $approval_attachment_file_link = base_url().'uploads/attachment/'.$approval_attachment->file_path;

                                     $path1 = 'uploads/attachment/'.$approval_attachment->file_path;
                                     $file_size1 = formatSizeUnits(filesize($path1));

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $file_size1; ?></td>
                                        <td><?php echo $approval_attachment->file_name; ?></td>
                                        <td>
                                            <div class="col-md-3"> 
                                                <a href="<?php echo $approval_attachment_file_link; ?>" class="btn btn-primary waves-effect" title="Download" download><i class="fas fa-download"></i> Download</a>
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


                        </div>
                    <?php } ?>

<!--       END     ========================END  Project Administrative Approval ======= -->

                    <!-- Project pre constraction data for view -->
                    <?php  if(!empty($project_pre_construction_setting)){ ?>

                <div role="tabpanel" class="tab-pane fade" id="project_pre_construction">
                            
                        <!-- Quick Nav   -->


                          <div class="card clearfix m-b-5">
                            <div class="col-md-4">
                              <div class="row ">
                                <div class="body">
                                    <ul class="list-unstyled">
                                        <?php
                                        if($project_pre_construction_setting[0]['land_schedule'] == 'Y'){
                                            
                                            $chk_no = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_land_schedule','project_id',$project_id);
                                            if($chk_no > 0){
                                                $cls = 'col-cyan';
                                            }else{
                                               $cls = 'col-pink'; 
                                            }
                                        ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('land_schedule')" class=" <?php echo $cls; ?> mb-20"> Land Schedule </a>
                                        </li>
                                    <?php } 
                                    if($project_pre_construction_setting[0]['govt_land_alienation'] == 'Y'){

                                        $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_govt_land_alienation','project_id',$project_id);
                                        $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_govt_land_alienation','project_id',$project_id,'progress_%');
                                        if(!empty($progress2)){
                                            $progress2 = '('.$progress2.'%)';
                                        }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('gov_land_alienation')" class="<?php echo $cls2; ?>"> Government Land Alienation <?php echo $progress2; ?></a>
                                        </li>
                                        <?php } 
                                    if($project_pre_construction_setting[0]['private_land_direct_purchase'] == 'Y'){

                                        $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_pvt_land_direct_purchase','project_id',$project_id);
                                        $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_pvt_land_direct_purchase','project_id',$project_id,'progress_%');
                                        if(!empty($progress2)){
                                            $progress2 = '('.$progress2.'%)';
                                        }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('private_land_dp')" class="<?php echo $cls2; ?>"> Private Land ( Direct Purchase ) <?php echo $progress2; ?> </a></li>
                                        <?php } 
                                    if($project_pre_construction_setting[0]['private_land_acquisition'] == 'Y'){

                                        $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_pvt_land_acquistion','project_id',$project_id);
                                        $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_pvt_land_acquistion','project_id',$project_id,'progress_%');
                                        if(!empty($progress2)){
                                            $progress2 = '('.$progress2.'%)';
                                        }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('private_land_la')" class="<?php echo $cls2; ?>"> Private Land ( Land Acquisition ) <?php echo $progress2; ?> </a></li>
                                    <?php } ?>
                                    
                                    </ul>
                                 </div>
                               </div>
                             </div>

                             <div class="col-md-4">
                               <div class="row ">
                                <div class="body">
                                    <ul class="list-unstyled"> 
                                    <?php if($project_pre_construction_setting[0]['forest_land'] == 'Y'){
                                        $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_forest_land','project_id',$project_id);
                                        $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_forest_land','project_id',$project_id,'progress_%');
                                        if(!empty($progress2)){
                                            $progress2 = '('.$progress2.'%)';
                                        }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('forest_land')" class="<?php echo $cls2; ?>"> Forest Land <?php echo $progress2; ?> </a>
                                        </li>
                                        <?php }
                                        if($project_pre_construction_setting[0]['tree_cutting'] == 'Y'){
                                            $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_tree_cutting','project_id',$project_id);
                                        $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_tree_cutting','project_id',$project_id,'progress_%');
                                        if(!empty($progress2)){
                                            $progress2 = '('.$progress2.'%)';
                                        }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('tree_cutting')" class=" <?php echo $cls2; ?>"> Tree Cutting <?php echo $progress2; ?></a>
                                        </li>
                                        <?php }
                                        if($project_pre_construction_setting[0]['environmental_clearance'] == 'Y'){

                                            $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_environment_clearance','project_id',$project_id);
                                        //$progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_tree_cutting','project_id',$project_id,'progress_%');
                                        // if(!empty($progress2)){
                                        //     $progress2 = '('.$progress2.'%)';
                                        // }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-cyan';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('environmental_clearance')" class="<?php echo $cls2; ?>"> Environmental Clearance </a></li>
                                        <?php }
                                        if($project_pre_construction_setting[0]['utility_shifting_electrical'] == 'Y'){
                                            $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_electrical','project_id',$project_id);
                                            $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_utility_shifting_electrical','project_id',$project_id,'progress_%');
                                            if(!empty($progress2)){
                                                $progress2 = '('.$progress2.'%)';
                                            }
                                                if($chk_no2 > 0){
                                                    $cls2 = 'col-cyan';
                                                }else{
                                                   $cls2 = 'col-pink'; 
                                                }



                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('utility_shifting_elec')" class="<?php echo $cls2; ?>"> Utility Shifting ( Electrical ) <?php echo $progress2; ?></a></li>
                                    <?php } ?>
                                        
                                    </ul>
                                 </div>
                               </div>
                             </div>

                            <div class="col-md-4">
                               <div class="row ">
                                <div class="body">
                                    <ul class="list-unstyled"> 
                                        <?php if($project_pre_construction_setting[0]['utility_shifting_PH'] == 'Y'){

                                            $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_ph','project_id',$project_id);
                                            $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_utility_shifting_ph','project_id',$project_id,'progress_%');
                                            if(!empty($progress2)){
                                                $progress2 = '('.$progress2.'%)';
                                            }
                                                if($chk_no2 > 0){
                                                    $cls2 = 'col-cyan';
                                                }else{
                                                   $cls2 = 'col-pink'; 
                                                }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('utility_shifting_PH')" class="<?php echo $cls2; ?>"> Utility Shifting ( PH ) <?php echo $progress2; ?></a></li>
                                    <?php }
                                    if($project_pre_construction_setting[0]['utility_shifting_RWSS'] == 'Y'){

                                        $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_rwss','project_id',$project_id);
                                            $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_utility_shifting_rwss','project_id',$project_id,'progress_%');
                                            if(!empty($progress2)){
                                                $progress2 = '('.$progress2.'%)';
                                            }
                                                if($chk_no2 > 0){
                                                    $cls2 = 'col-cyan';
                                                }else{
                                                   $cls2 = 'col-pink'; 
                                                }
                                    ?>
                                    <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('utility_shifting_RWSS')" class="<?php echo $cls2; ?>"> Utility Shifting ( RWSS ) <?php echo $progress2; ?></a></li>

                                  <?php } if($project_pre_construction_setting[0]['encroachment_eviction'] == 'Y'){

                                    $chk_no2 = $CI->Projectdashboard_model->check_pre_construction_value_exist_or_not_in_tbl('pre_construction_activities_encroachment_eviction','project_id',$project_id);
                                            $progress2 = $CI->Projectdashboard_model->get_specific_data_against_value('pre_construction_activities_encroachment_eviction','project_id',$project_id,'progress_%');
                                            if(!empty($progress2)){
                                                $progress2 = '('.$progress2.'%)';
                                            }
                                                if($chk_no2 > 0){
                                                    $cls2 = 'col-cyan';
                                                }else{
                                                   $cls2 = 'col-pink'; 
                                                }
                                    ?>
                                        <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_info('encroachment_eviction')" class="<?php echo $cls2; ?>"> Encroachment Eviction <?php echo $progress2; ?></a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                 </div>
                               </div>
                             </div>
                        </div> 

                        <!-- Quick Nav end -->                              
                                                
                     <div id="pre_construction_details"></div>
                    </div>

               
                        <?php } 
                                       if(!empty($project_publishing_tender)){ ?>
                        
                        <div role="tabpanel" class="tab-pane fade" id="tender_data">
                      
                          <div class="heading p-10 m-b-5">
                            <h2>Tender Details </h2>
                        </div>
                        <div class="table-responsive m-b-30">
                        
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    
                                    <tr>
                                    <td width="25%"> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Reference Number</td>
                                    <td  width="25%"><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_ref_no'])) {
                                         echo $project_publishing_tender[0]['tender_ref_no'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                     <td  width="25%"> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Name</td>
                                    <td  width="25%"><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_name'])) {
                                         echo $project_publishing_tender[0]['tender_name'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                       
                                        
                                    </tr>
                                    <tr>
            
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Short Name</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_short_name'])) {
                                         echo $project_publishing_tender[0]['tender_short_name'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                      <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Type (Coverage)</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_type_coverage'])) {
                                         echo $project_publishing_tender[0]['tender_type_coverage'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                     </tr>
                                    <tr>
                                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Type (Geography)</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_type_geography'])) {
                                         echo $project_publishing_tender[0]['tender_type_geography'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                     <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Type (Procurement)</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_type_precurement'])) {
                                         echo $project_publishing_tender[0]['tender_type_precurement'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                    </tr>

                                    <tr>
                                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender Type (Execution)</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_type_execution'])) {
                                         echo $project_publishing_tender[0]['tender_type_execution'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                     <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Tender Publishing Date</td>
                                        <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_publishing_date'])) {
                                         $tender_publishing_date = new DateTime($project_publishing_tender[0]['tender_publishing_date']); 
                                        
                                        
                                        echo $tender_publishing_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>

                                    <tr>
                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Tender Start Date</td>
                                        <td><?php 
                                        if (!empty ($project_publishing_tender[0]['tender_start_date'])) {
                                         $tender_start_date = new DateTime($project_publishing_tender[0]['tender_start_date']); 
                                        
                                        
                                        echo $tender_start_date->format('jS M Y');} else { echo "--"; } ?>
                                            
                                        </td>
                                     <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Bid Submission date</td>
                                        <td><?php 
                                        if (!empty ($project_publishing_tender[0]['bid_submission_date'])) {
                                         $bid_submission_date = new DateTime($project_publishing_tender[0]['bid_submission_date']); 
                                        
                                        
                                        echo $bid_submission_date->format('jS M Y');} else { echo "--"; } ?>
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Pre-Bid Conference Venue</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['pre_bid_conf_venue'])) {
                                         echo $project_publishing_tender[0]['pre_bid_conf_venue'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                     <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Pre-Bid Conference Date</td>
                                        <td><?php 
                                        if (!empty ($project_publishing_tender[0]['pre_bid_conf_date'])) {
                                         $pre_bid_conf_date = new DateTime($project_publishing_tender[0]['pre_bid_conf_date']); 
                                        
                                        
                                        echo $pre_bid_conf_date->format('jS M Y');} else { echo "--"; } ?></td>
                                    </tr>

                                    <tr>
                                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Pre-Bid Conference Time</td>
                                    <td><?php 
                                        if (!empty ($project_publishing_tender[0]['pre_bid_conf_time'])) {
                                         echo $project_publishing_tender[0]['pre_bid_conf_time'];

                                         } else { echo "--"; } ?> 
                                     </td>
                                      <td><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i>Put To Tender(₹)</td>
                                    <td><?php
                                    if (!empty ($project_publishing_tender[0]['put_tender_value'])) {
                                    echo number_format($project_publishing_tender[0]['put_tender_value'],2) ;

                                    } else { echo "--"; } ?> </td>
                                    
                                    
                                    </tr>
                                   
            
            
                                    </tbody>
                                </table>
            
            
                            </div>
                            
                              <!-- For image  -->
                            <?php
                            if(is_array($project_tender_attachment)){
                             
                            ?>
                <div class="row clearfix">
                    <div class="heading m-b-5">
                            <h2>Attachment - Project’s Tender </h2>
                        </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        
                        <div class=" table-responsive">
                            <table class="table table-bordered table-striped table-hover">
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
                                    foreach ($project_tender_attachment as $tender_attachment) {
                                     $tender_file_link = base_url().'uploads/attachment/'.$tender_attachment->file_path;
                                     $path3 = 'uploads/attachment/'.$tender_attachment->file_path;
                                     $file_size3 = formatSizeUnits(filesize($path3));

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $file_size3; ?></td>
                                        <td><?php echo $tender_attachment->file_name; ?></td>
                                        <td>
                                            <div class="col-md-3"> 
                                                <a href="<?php echo $tender_file_link; ?>" class="btn btn-primary waves-effect" title="Download" download><i class="fas fa-download"></i> Download</a>
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
                      
                      
                                  <?php
                            if(!empty($project_tender)){
                             
                            ?>     
                                    
            <!-- Quick Nav   -->

              <div class="card clearfix m-b-5">
                <div class="col-md-4">
                  <div class="row ">
                    <div class="body">
                        <ul class="list-unstyled">
                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!"  onclick="show_tender_info('pre_bid')" class=" <?php echo $cls; ?> mb-20"> Pre Bid </a></li>

                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_tender_info('technical_evalution')" class="col-cyan"> Technical Evalution</a></li>
                            
                        </ul>
                     </div>
                   </div>
                 </div>

                 <div class="col-md-4">
                   <div class="row ">
                    <div class="body">
                        <ul class="list-unstyled"> 
                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_tender_info('financial_evalution')"  class="col-cyan"> Financial Evalution</a></li>
                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_tender_info('negotiation')" class="col-cyan"> Negotiation </a></li>
                           
                        </ul>
                     </div>
                   </div>
                 </div>

                <div class="col-md-4">
                   <div class="row ">
                    <div class="body">
                        <ul class="list-unstyled"> 
                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!"  onclick="show_tender_info('issue_of_loa')"  class="col-cyan"> Issue Of LOA </a></li>
                            <li class="m-b-10"><i class="fas fa-arrow-alt-circle-right"></i> <a href="#!" onclick="show_tender_info('aggrement')"  class="col-cyan"> Agreement </a></li>
                        </ul>
                     </div>
                   </div>
                 </div>
            </div> 

            <!-- Quick Nav end -->
            <div id="tender_details_data"></div>     
              
        <?php } ?>                                             
                                    
            </div>
                        <?php } 
                                       if(!empty($issue_list)){ ?>
                        
                        <div role="tabpanel" class="tab-pane fade" id="communication_data">
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                        <tr>
                            <th>Issue Name</th>
                            <th>Issuer Name</th>
                        </tr>
                        <?php
                        //print_r($issue_list);
                        foreach($issue_list as $issuelist) { ?>
                           <tr>
                            <td><h5 style="color:#464646"><?php echo $issuelist['issue_name'] ?></h5></td>
                            <td style="vertical-align: middle;"><?php echo $issuelist['issuer_name'] ?></td>
                           </tr>
                          
                            <?php //echo $CI->get_documents($issuelist['id'],$issuelist['project_id']); ?>
                            <?php  $com_docs =  $CI->Projectdashboard_model->get_doc_files($issuelist['id'],$issuelist['project_id']); 
                             foreach($com_docs as $docs) { ?>
           <tr>
                    <td><?php echo $docs['document_name']; ?></td>
                    <td>
                    <a href="<?php echo base_url().'uploads/files/doc_upload/'.$docs['communication_file']; ?>" title="download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a>
                    </td>
                 </tr>
       

                      <?php  } } ?>
                        
                        </tbody>
                    </table>

                </div>
            </div>
                        <?php } 
                        if(!empty($project_commissioning)){ ?>
                        
                        <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_titlecommissioning">
                            <div class="table-responsive m-b-30">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                                    <tbody>
                                    
                                    <tr>
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Construction Completion Certificate issued on  </td>
            
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
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Final Payment done </td>
            
                                        <td>  <?php if( $project_commissioning[0]['final_payment_status'] == 'Y'){
                                        echo "Yes";
                                    } else if( $project_commissioning[0]['final_payment_status'] == 'N'){
                                        echo "No";
                                    }else{
                                        echo "NA";
                                    } ?>   </td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final Payment Date </td>
            
                                        <td> <?php 
                                        if (!empty ($project_commissioning[0]['final_payment_date'])) {
                                         $final_payment_date = new DateTime($project_commissioning[0]['final_payment_date']); 
                                        
                                        
                                        echo $final_payment_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                    </tr>
                                    <tr>
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> APS, if applicable</td>
            
            
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
                                        

                                    <td  width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Retention amount on hold </td>
            
                                    <td> <?php echo number_format($project_commissioning[0]['hold_retention_amount'],2); ?> </td>

                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> DLP Starting Date </td>
            
                                    <td> <?php 
                                        if (!empty ($project_commissioning[0]['DLP_starting_date'])) {
                                         $DLP_starting_date = new DateTime($project_commissioning[0]['DLP_starting_date']); 
                                        
                                        
                                        echo $DLP_starting_date->format('jS M Y');} else { echo "--"; } ?> 
                                    </td>
                                      
                                        
                                    </tr>

                                    <tr>

                                    <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  Final PBG Returning Date </td>
            
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

                                    <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  Balance Retention amount release date </td>
            
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

                                    <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">insert_drive_file</i>  Remarks </td>
            
                                    <td colspan="3"> <?php echo $project_commissioning[0]['remarks']; ?> </td>
                                      
                                        
                                    </tr>
            
                                    </tbody>
                                </table>
            
            
                            </div>
                        </div>
                    <?php } ?>
                
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>


<script>
   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>


<script type="text/javascript">
    function show_info(pageName){
        //alert(pageName);
        var project_id = <?php echo $project_id; ?>;
        $.ajax({
            url:"<?php echo base_url(); ?>Projectdashboard/project_pre_construction_details_ajax_data",
              method:"POST",
              data:{
                project_id:project_id,
                type:pageName
                },
            success: function(res){
               $('#pre_construction_details').html(res);
            }
        });//end ajax
    }
	
	
    function show_tender_info(pageName){
        //alert(pageName);
        var project_id = <?php echo $project_id; ?>;
        $.ajax({
            url:"<?php echo base_url(); ?>Projectdashboard/project_tendering_ajax_data",
              method:"POST",
              data:{
                project_id:project_id,
                type:pageName
                },
            success: function(res){
               $('#tender_details_data').html(res);
            }
        });//end ajax
    }
	
</script>