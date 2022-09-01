   <?php  $CI =& get_instance(); ?>
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
  <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <section class="content">
        <div class="container-fluid">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>         
        
    </div>
            <div class="block-header">
                <h4>Pre Project Initiation </h4>
            </div>
            
          <!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">Concept Creation</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>
                    <li class="active">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li>
                    
                    <li class="gray">
                          <span class="circle"><i class="fas fa-list"></i></span>
                          <span class="label">Tender</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end -->     
     
            
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 
                   
 <!--    Project_Information End -->  
            
            
             
 <!-- Quick Nav   -->
            
  <?php project_quick_nav($project_id);  ?> 
            
<!-- Quick Nav end -->            
                     

<?php echo form_open_multipart('Pre_consttruction_activity_forest_land/manage', array('name' => 'pre_consttruction_activity_forest_land','id' => 'pre_consttruction_activity_forest_land')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" /> 
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Forest Land / Diversion </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                                <input type="hidden" name="forestland_id" value="<?php echo $get_forestland[0]['id'] ?>">
                               <div class="col-md-4">
                                    <p>
                                        <b>Total Area To be Diverted ( In Acres ) <span class="col-pink">*</span></b>
                                    </p>
                                    <input class="form-control txtQty" type="text" placeholder="Total Area" name="total_area" id="total_area" value="<?php if(empty($get_forestland)){ echo set_value('total_area'); }?><?php echo $get_forestland[0]['total_area_tobe_diverted'] ?>"> 
                                       <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('total_area', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Forest Division </b>
                                    </p>
                                    <select class="form-control show-tick" name="forest_division">
                                <?php
                                   foreach($forest_id as $forest)
                                   { ?>

    <option value="<?php echo $forest->id ?>" <?php if ((!empty($get_forestland[0]['forest_division_id']) && $get_forestland[0]['forest_division_id'] == $forest->id) || $_REQUEST['forest_division'] == $forest->id) {
                                            echo "selected";
                                        } ?>><?php echo $forest->division_name?></option>
                                   <?php
                                   }
                                     ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Fund Allotted </b>
                                    </p>
                                    <input class="form-control txtQty" type="text" placeholder="Fund allotted" name="fund_allot" value="<?php if(empty($get_forestland)){ echo set_value('fund_allot'); }?><?php echo $get_forestland[0]['fund_alloted'] ?>"> 

                                    <?php echo form_error('fund_allot', '<div class="error">', '</div>'); ?>
                                </div>
                                
                             </div>
                            
                            <div class="row clearfix">
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                     <input type="text" class="datepicker form-control" placeholder="Please choose a date..." name="target_end_date" value="<?php if(empty($get_forestland)){ echo set_value('target_end_date'); }?><?php echo $get_forestland[0]['target_end_date'] ?>">

                                    <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>
                                </div>
                             </div>
   
                           </div>
                        </div>
                     <div class="card">
                        <div class="header">
                            <h2> Location Details </h2>
                        </div>

                        <div class="body">
                           <div class="col-md-3" style="display: none;">
                             <div class="form-group">
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">All District</option>

                             <?php 
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }

                             ?>
                        </select>
                         </div>
                       </div>


                        <?php
                   if(!empty($forestland_location_data)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($forestland_location_data);
              
                foreach ($forestland_location_data as $sameD) {
                  if($k == 1){
            
                ?>
                   
                                <div class="col-md-4">
                                    <p>
                                        <b>Districts Name</b>
                                        
                                    </p>
                      <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);ulbFunc(1);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>



                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils Covered <!-- <span class="col-pink">* </span> --></b>
                                       
                                    </p>
                                    <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple" >
                           <?php
                             echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
                            ?>
                        </select>
                                </div>


                                <div class="col-md-2 p-t-25">
<button   id="newField_<?php echo $get_same_datacnt; ?>" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
<i class="material-icons">add</i>
</button>
</div>

             <?php

              }

             else{ ?>
                         
                              <div id="newAdd_<?php echo $k; ?>">
                                <div class="col-md-12 p-0 mt-10px">
                                
                                <div class="col-md-4">

                                   <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="tehsilFunc(<?php echo $k; ?>);ulbFunc(<?php echo $k; ?>);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-4">

                                    <select name="tehsil_id[<?php echo $k - 1; ?>][]" id="tehsil_id_<?php echo $k; ?>" class="form-control select2" multiple="multiple" >
                           <?php
                            echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
              
                            ?>
                           
                        </select>
                                </div>

                                
                                <div class="col-md-2">
<button   id="removefld_<?php echo $k; ?>" data-id="<?php echo $k; ?>" name="submit" type="button"class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i>
</button>
</div>
                                </div>
                                
                                </div>
                           
                           
                    <?php } ?>


                   <?php $k++; 

                 }

                  ?>
                                
                             </div>
        




                             
                    <?php 

                  } else { 

                    ?>
                            <div id="container1" class="row clearfix addrow">
                              <?php
                              $get_same_datacnt = count($forestland_location_data);
                              ?>
                                <div class="col-md-4">
                                    <p>
                                        <b>Districts Covered </b>
                                        
                                    </p>
                              <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);">
                                  <option value="0">Please select</option>
                                            <?php
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }
                                     ?>
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils Covered <!-- <span class="col-pink">* </span> --></b>
                                        
                                    </p>
                  <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple">
                                      
                                    </select>
                                </div>
                                <div class="col-md-2 p-t-25">
<button id="newField_1" class="add-data btn btn-success btn-circle waves-effect waves-circle waves-float" name="submit" type="button">
<i class="material-icons">add</i>
</button>
</div>
                                
                             </div>
                      <?php } ?>
                        
                        </div>
                    </div> 
                        
                    <div class="card"> 
                          <div class="header">
                            <h2> Status of Key Milestones</h2>
                          </div>  
                         
                        <div class="body"> 
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Online Application Submitted ? </b>
                                    </p>

                                     <select class="form-control show-tick" name="online_application_submit">
                             <option value="Yes" <?php echo set_select('online_application_submit','Yes', ( !empty($get_forestland[0]['status_application_submited']) &&
                                      $get_forestland[0]['status_application_submited'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('online_application_submit','No', ( !empty($get_forestland[0]['status_application_submited']) &&
                                      $get_forestland[0]['status_application_submited'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('online_application_submit','In Progress', ( !empty($get_forestland[0]['status_application_submited']) &&
                                      $get_forestland[0]['status_application_submited'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('online_application_submit','N.A', ( !empty($get_forestland[0]['status_application_submited']) &&
                                      $get_forestland[0]['status_application_submited'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Application  </b>
                                    </p>
                                     <input type="file" name="app_fileupload" value="fileupload" id="uploadFile1" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                <?php if (!empty($get_forestland[0]['file_application_submited'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/forest_land/<?php echo $get_forestland[0]['file_application_submited']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>

                                    <?php echo form_error('app_fileupload', '<div class="error">', '</div>'); ?>
                                </div>
                              
                                <div class="col-md-3">
                                    <p>
                                        <b>FCP Uploaded Online ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="fcp_upload_status">
                             <option value="Yes" <?php echo set_select('fcp_upload_status','Yes', ( !empty($get_forestland[0]['status_fcp_uploaded']) &&
                                      $get_forestland[0]['status_fcp_uploaded'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('fcp_upload_status','No', ( !empty($get_forestland[0]['status_fcp_uploaded']) &&
                                      $get_forestland[0]['status_fcp_uploaded'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('fcp_upload_status','In Progress', ( !empty($get_forestland[0]['status_fcp_uploaded']) &&
                                      $get_forestland[0]['status_fcp_uploaded'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('fcp_upload_status','N.A', ( !empty($get_forestland[0]['status_fcp_uploaded']) &&
                                      $get_forestland[0]['status_fcp_uploaded'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / FCP  </b>
                                    </p>
                                     <input  type="file" name="doc_fileupload" value="fcp_fileupload" id="uploadFile2" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_forestland[0]['file_fcp_uploaded'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/forest_land/<?php echo $get_forestland[0]['file_fcp_uploaded']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>

                                    <?php echo form_error('doc_fileupload', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>State Govt. Recommendation Obtained ? </b>
                                    </p>

                                    <select class="form-control show-tick" name="state_govt_recommend">
                             <option value="Yes" <?php echo set_select('state_govt_recommend','Yes', ( !empty($get_forestland[0]['status_state_govt_recomend']) &&
                                      $get_forestland[0]['status_state_govt_recomend'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('state_govt_recommend','No', ( !empty($get_forestland[0]['status_state_govt_recomend']) &&
                                      $get_forestland[0]['status_state_govt_recomend'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('state_govt_recommend','In Progress', ( !empty($get_forestland[0]['status_state_govt_recomend']) &&
                                      $get_forestland[0]['status_state_govt_recomend'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('state_govt_recommend','N.A', ( !empty($get_forestland[0]['status_state_govt_recomend']) &&
                                      $get_forestland[0]['status_state_govt_recomend'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / State Govt. Recommendation  </b>
                                    </p>
                                     <input  type="file" name="file_stategovt_recommend" value="file_stategovt" id="uploadFile3" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                <?php if (!empty($get_forestland[0]['file_state_govt_recomend'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/forest_land/<?php echo $get_forestland[0]['file_state_govt_recomend']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 

                                    <?php echo form_error('file_stategovt_recommend', '<div class="error">', '</div>'); ?>
                                </div>
                            
                                <div class="col-md-3">
                                    <p>
                                        <b>Gol Approval Obtained ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="gol_application">
                             <option value="Yes" <?php echo set_select('gol_application','Yes', ( !empty($get_forestland[0]['status_goi_approval']) &&
                                      $get_forestland[0]['status_goi_approval'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('gol_application','No', ( !empty($get_forestland[0]['status_goi_approval']) &&
                                      $get_forestland[0]['status_goi_approval'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('gol_application','In Progress', ( !empty($get_forestland[0]['status_goi_approval']) &&
                                      $get_forestland[0]['status_goi_approval'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('gol_application','N.A', ( !empty($get_forestland[0]['status_goi_approval']) &&
                                      $get_forestland[0]['status_goi_approval'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Gol Approval </b>
                                    </p>
                                     <input  type="file" name="file_gol_application" value="file_gol" id="uploadFile4" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                <?php if (!empty($get_forestland[0]['file_goi_approval'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/forest_land/<?php echo $get_forestland[0]['file_goi_approval']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 

                                    <?php echo form_error('file_gol_application', '<div class="error">', '</div>'); ?>
                                </div>
                                
                            </div>
                            <div class="row clearfix m-t-10">
                                <div class="col-md-3">
                                    <p>
                                        <b>Permission Issued ? </b>
                                    </p>

                                    <select class="form-control show-tick" name="permission_issue">
                             <option value="Yes" <?php echo set_select('permission_issue','Yes', ( !empty($get_forestland[0]['status_permission_issued']) &&
                                      $get_forestland[0]['status_permission_issued'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('permission_issue','No', ( !empty($get_forestland[0]['status_permission_issued']) &&
                                      $get_forestland[0]['status_permission_issued'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('permission_issue','In Progress', ( !empty($get_forestland[0]['status_permission_issued']) &&
                                      $get_forestland[0]['status_permission_issued'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('permission_issue','N.A', ( !empty($get_forestland[0]['status_permission_issued']) &&
                                      $get_forestland[0]['status_permission_issued'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Permission </b>
                                    </p>
                                     <input  type="file" name="file_permission" value="permission" id="uploadFile5">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                <?php if (!empty($get_forestland[0]['file_permission_issued'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/forest_land/<?php echo $get_forestland[0]['file_permission_issued']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 

                                    <?php echo form_error('file_permission', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                              
                           </div>
                         </div>
                    
        <input type="hidden" name="app_fileupload_hidden" value="<?php echo $get_prvatelandla[0]['file_application_submited']; ?>" />
        <input type="hidden" name="file_stategovt_recommend_hidden" value="<?php echo $get_prvatelandla[0]['file_state_govt_recomend']; ?>" />
        <input type="hidden" name="file_permission_hidden" value="<?php echo $get_prvatelandla[0]['file_permission_issued']; ?>" />
        <input type="hidden" name="doc_fileupload_hidden" value="<?php echo $get_prvatelandla[0]['file_fcp_uploaded']; ?>" />
       <input type="hidden" name="file_gol_application_hidden" value="<?php echo $get_prvatelandla[0]['file_goi_approval']; ?>" />  
                        
                       <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Cleared So Far </b>
                                    </p>
                                     <input class="form-control txtQty" type="text" placeholder="Land cleared" name="progress_land_clr" id="progress_land_clr" value="<?php if(empty($get_forestland)){ echo set_value('progress_land_clr'); }?><?php echo $get_forestland[0]['progress_land_cleared'] ?>">

                                    <?php echo form_error('progress_land_clr', '<div class="error">', '</div>'); ?>
                                </div>
                                
                               <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                     <input class="form-control txtQty limittxt_progress" type="text" name="progress" placeholder="Progress" value="<?php if(empty($get_forestland)){ echo set_value('progress'); }?><?php echo $get_forestland[0]['progress_%'] ?>">

                                    <?php echo form_error('progress', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Required for A/A Cleared </b>
                                    </p>
                                     <select class="form-control show-tick" name="land_required_clr">
                             <option value="Yes" <?php echo set_select('land_required_clr','Yes', ( !empty($get_forestland[0]['progress_land_required_for_cleared_aa']) &&
                                      $get_forestland[0]['progress_land_required_for_cleared_aa'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('land_required_clr','No', ( !empty($get_forestland[0]['progress_land_required_for_cleared_aa']) &&
                                      $get_forestland[0]['progress_land_required_for_cleared_aa'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('land_required_clr','In Progress', ( !empty($get_forestland[0]['progress_land_required_for_cleared_aa']) &&
                                      $get_forestland[0]['progress_land_required_for_cleared_aa'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('land_required_clr','N.A', ( !empty($get_forestland[0]['progress_land_required_for_cleared_aa']) &&
                                      $get_forestland[0]['progress_land_required_for_cleared_aa'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized  </b>
                                    </p>

                                     <input class="form-control txtQty" type="text" placeholder="Amount" name="ammount_utilize" value="<?php if(empty($get_forestland)){ echo set_value('ammount_utilize'); }?><?php echo number_format($get_forestland[0]['progress_amount_utilised'],2) ?>">

                                    <?php echo form_error('ammount_utilize', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p>
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="pre-construction fund Utilized" name="fund_utilize" value="<?php if(empty($get_forestland)){ echo set_value('fund_utilize'); }?><?php echo $get_forestland[0]['progress_fund_utilised'] ?>">
                                     
                                    <?php echo form_error('fund_utilize', '<div class="error">', '</div>'); ?>
                                </div> 
 
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <textarea class="form-control no-resize" rows="3" id="maxremarks" placeholder="Please type what you want..." name="remarks"><?php if(empty($get_forestland)){ echo set_value('remarks'); }?><?php echo $get_forestland[0]['remarks'] ?></textarea>
                                    <span id="warning-message" style='color:#ff0000'></span>
                                    
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                </div>
                            </div> 
                          </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_forestland)) ? 'SAVE' : 'Update' ?>
                            </button>
                           </div>
                           <div class="clearfix"></div>   
                        </form>
                      </div>

                    </div>
                 </div>
                

            <!-- Select -->
            </div>
        </div>
    </section>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
  <?php
  if(empty($forestland_location_data)){
      $cnt6 = 1;
      }else{
        $cnt6 = $get_same_datacnt;
  }
          ?>


            <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
   var dividcnt = <?php echo $cnt6; ?>;
   
   var i = <?php echo $cnt6; ?>;
for (i = 1; i <= <?php echo $cnt6; ?>; i++) {
   
$('#tehsil_id_'+i).select2({dropdownAutoWidth : true});
$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
});
    $("#total_area").keyup(function() {
    //alert($(this).val());
    var land_total_area = $(this).val();
    $("#total_area_hidden").val(land_total_area);
    //alert(land_total_area);
  });
  
  $(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
var ex_val = $('.limittxt_progress').val();
if(ex_val > 100) {
    $('.limittxt_progress').val('0');
}
$('.limittxt_progress').keyup(function(){
  if ($(this).val() > 100){
    alert("No numbers above 100");
    $(this).val(ex_val);
  }
});

$('#progress_land_clr').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#total_area_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#total_area").val();
  }
  if ( parseFloat(curval) > parseFloat(hidden_area) ){
    alert("Land Cleared should less than Total Area");
    $(this).val(0);
  }
});
</script>
<script type="text/javascript">

var divid = <?php echo $cnt6; ?>;
var optionValues = $("#hidden_dist_fetch").html();
      $('#container1').on('click','#newField_' + divid, function () {
       // alert(divid);
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-4"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="tehsilFunc('+divid+');">' +optionValues+ '</select></div></div><div class="col-md-4"><div class=""><select name="tehsil_id['+ndiv+'][]" id="tehsil_id_'+divid+'" multiple="multiple" class="form-control select2"></select></div></div><div class="col-md-4"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
      
      
                    

         $('#container1').append(newthing);
         $('.select2').select2();
    });

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
        $('#newAdd_'+id).remove();

    });



    function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
//$("#ulb_id_"+divid).empty();


if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_forest_land/gettehsil_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
     // alert(data);
      
      
                            var parsed_data = JSON.parse(data);
                            $("#tehsil_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_tehsil.length);
                    if(parsed_data.all_tehsil.length > 0)
                    {
                               for (var i = 0; i < parsed_data.all_tehsil.length; i++)
                                      {
                    $("#tehsil_id_"+divid).append("<option  value='" + parsed_data.all_tehsil[i].id  + "'>" + parsed_data.all_tehsil[i]. tahsil_name + "</option>");
                   // $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }

                    else
                    {
                    $("#tehsil_id_"+divid).append("<option  value=''>" +'Select Another District' + "</option>");
                    
                      $val_selec =''; 
                    }



                              
                            
      }
    });
    }
    //$('#tehsil_id_'+divid).select2({dropdownAutoWidth : true});
}

for(let i=1; i<= 5; i++) {
   $('#uploadFile'+i).change(function () {
      var fileExtension = ['png','pdf','jpg','docs'];
      var MAX_FILE_SIZE = 50 * 1024 * 1024;
       if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
          swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
          this.value = ''; // Clean field
       return false;
     }
        fileSize = this.files[0].size;
          if (fileSize > MAX_FILE_SIZE) {
            swal(" ", "File must not exceed 50 MB", "error");
            this.value = '';
            } else {

     }
   });
}
var maxLength = 250;
$(document).ready(function(){
$('#maxremarks').on('keydown keyup change', function(){
var char = $(this).val();
var charLength = $(this).val().length;
if(charLength > maxLength){
$('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
$(this).val(char.substring(0, maxLength));
}else{
$('#warning-message').text('');
}
});
});
</script>
        <style type="text/css">
      .error {
        color: red;
        padding-bottom: 10px;
      }
    </style>