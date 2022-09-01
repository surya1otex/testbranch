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

<?php echo form_open_multipart('Pre_consttruction_activity_private_land_la/manage', array('name' => 'pre_consttruction_activity_private_land_la','id' => 'pre_consttruction_activity_private_land_la')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" /> 
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Private Land ( Land Acquisition Under Act ) </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Total Area To be Purchased ( In Acres ) <span class="col-pink">*</span></b>
                                    </p>
                                      
                                     <input type="hidden" name="landacquisition_id" value="<?php echo $get_prvatelandla[0]['id'] ?>">
                                       
                                     
                         <input class="form-control txtQty"  name="total_area" id="total_area" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('total_area'); }?><?php echo $get_prvatelandla[0]['total_area'] ?>"  placeholder="Total Area">
                         <input type="hidden" id="total_area_hidden">
                         <?php echo form_error('total_area', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                 <div class="col-md-4">
                                    <p>
                                        <b>Compensation Amount </b>
                                    </p>
                                    <?php echo form_error('compensation_amount', '<div class="error">', '</div>'); ?>
                                    <input class="form-control txtQty"  name="compensation_amount" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('compensation_amount'); }?><?php echo $get_prvatelandla[0]['compensation_amount'] ?>"  placeholder="Compensation amount">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>General Category Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('general_cat_land', '<div class="error">', '</div>'); ?>
                                    <input class="form-control txtQty"  name="general_cat_land" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('general_cat_land'); }?><?php echo $get_prvatelandla[0]['general_cat_land'] ?>"  placeholder="General Cat Land">
                                </div>

                             </div>
                            
                            <div class="row clearfix">

                                <div class="col-md-4">
                                    <p>
                                        <b>SC Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('sc_land', '<div class="error">', '</div>'); ?>
                                    <input class="form-control txtQty"  name="sc_land" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('sc_land'); }?><?php echo $get_prvatelandla[0]['sc_land'] ?>"  placeholder="Sc Land">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>ST Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('st_land', '<div class="error">', '</div>'); ?>

                                    <input class="form-control txtQty"  name="st_land" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('st_land'); }?><?php echo $get_prvatelandla[0]['st_land'] ?>"  placeholder="St Land">
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                    <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>

                                      <input class="datepicker form-control"  name="target_end_date" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('target_end_date'); }?><?php echo $get_prvatelandla[0]['target_end_date'] ?>"  placeholder="Please choose a date...">
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
                   if(!empty($landacquisition_location_data)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($landacquisition_location_data);
              
                foreach ($landacquisition_location_data as $sameD) {
                  if($k == 1){
            
                ?>
                   
                                <div class="col-md-4">
                                    <p>
                                        <b>Districts Name </b>
                                        
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
                                    <p>
                                        <!-- <b>Districts Name <span class="col-pink">* </span></b> -->
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="tehsilFunc(<?php echo $k; ?>);ulbFunc(<?php echo $k; ?>);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <!-- <b>Tehsils covered </b> -->
                                       
                                    </p>
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
                              //$get_same_datacnt = count($alianation_location_data);
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
                                    <p> <b>SIA Approved ? </b></p>
                                    <?php echo form_error('status_SIA_approved', '<div class="error">', '</div>'); ?>

                                    <select class="form-control show-tick" name="status_SIA_approved">
                             <option value="Yes" <?php echo set_select('status_SIA_approved','Yes', ( !empty($get_prvatelandla[0]['status_SIA_approved']) &&
                                      $get_prvatelandla[0]['status_SIA_approved'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_SIA_approved','No', ( !empty($get_prvatelandla[0]['status_SIA_approved']) &&
                                      $get_prvatelandla[0]['status_SIA_approved'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('status_SIA_approved','In Progress', ( !empty($get_prvatelandla[0]['status_SIA_approved']) &&
                                      $get_prvatelandla[0]['status_SIA_approved'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_SIA_approved','N.A', ( !empty($get_prvatelandla[0]['status_SIA_approved']) &&
                                      $get_prvatelandla[0]['status_SIA_approved'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / SIA </b> </p>
                                    <?php echo form_error('file_SIA', '<div class="error">', '</div>'); ?>
                                     <input  type="file" name="file_SIA" value="fileupload" id="uploadFile1" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_prvatelandla[0]['file_SIA'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/land_acquisition/<?php echo $get_prvatelandla[0]['file_SIA']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                              
                                <div class="col-md-3">
                                    <p> <b>Notification Under Section 11.1 ? </b></p>
                                    <select class="form-control show-tick" name="status_notification">
                             <option value="Yes" <?php echo set_select('status_notification','Yes', ( !empty($get_prvatelandla[0]['status_notification']) &&
                                      $get_prvatelandla[0]['status_notification'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_notification','No', ( !empty($get_prvatelandla[0]['status_notification']) &&
                                      $get_prvatelandla[0]['status_notification'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="N.A" <?php echo set_select('status_notification','N.A', ( !empty($get_prvatelandla[0]['status_notification']) &&
                                      $get_prvatelandla[0]['status_notification'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Section 11.1 Notification </b>
                                    </p>
                                    <?php echo form_error('file_notification', '<div class="error">', '</div>'); ?>
                                     <input  type="file" name="file_notification" value="fileupload" id="uploadFile2" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_prvatelandla[0]['file_notification'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/land_acquisition/<?php echo $get_prvatelandla[0]['file_notification']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 
                                </div>
                           
                                <div class="col-md-3">
                                    <p> <b>Declaration Under Section 19.1 ? </b></p>

                                    <select class="form-control show-tick" name="status_declaration">
                             <option value="Yes" <?php echo set_select('status_declaration','Yes', ( !empty($get_prvatelandla[0]['status_declaration']) &&
                                      $get_prvatelandla[0]['status_declaration'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_declaration','No', ( !empty($get_prvatelandla[0]['status_declaration']) &&
                                      $get_prvatelandla[0]['status_declaration'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('status_declaration','In Progress', ( !empty($get_prvatelandla[0]['status_declaration']) &&
                                      $get_prvatelandla[0]['status_declaration'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_declaration','N.A', ( !empty($get_prvatelandla[0]['status_declaration']) &&
                                      $get_prvatelandla[0]['status_declaration'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / Section 19.1 Declaration </b></p>
                                    <?php echo form_error('file_declaration', '<div class="error">', '</div>'); ?>

                                     <input  type="file" name="file_declaration" value="fileupload" id="uploadFile3" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_prvatelandla[0]['file_declaration'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/land_acquisition/<?php echo $get_prvatelandla[0]['file_declaration']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                           
                                <div class="col-md-3">
                                    <p><b>Award of Compensation ? </b></p>
                                    <select class="form-control show-tick" name="status_award_of_compensation">
                             <option value="Yes" <?php echo set_select('status_award_of_compensation','Yes', ( !empty($get_prvatelandla[0]['status_award_of_compensation']) &&
                                      $get_prvatelandla[0]['status_award_of_compensation'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_award_of_compensation','No', ( !empty($get_prvatelandla[0]['status_award_of_compensation']) &&
                                      $get_prvatelandla[0]['status_award_of_compensation'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('status_award_of_compensation','In Progress', ( !empty($get_prvatelandla[0]['status_award_of_compensation']) &&
                                      $get_prvatelandla[0]['status_award_of_compensation'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_award_of_compensation','N.A', ( !empty($get_prvatelandla[0]['status_award_of_compensation']) &&
                                      $get_prvatelandla[0]['status_award_of_compensation'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / Award of Compensation </b> </p>
                                    <?php echo form_error('file_compensation', '<div class="error">', '</div>'); ?>

                                     <input  type="file" name="file_compensation" value="fileupload" id="uploadFile4" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_prvatelandla[0]['file_compensation'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/land_acquisition/<?php echo $get_prvatelandla[0]['file_compensation']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 
                                </div>
                            </div>  
                              
                           </div>
                         </div>
        <input type="hidden" name="file_SIA_hidden" value="<?php echo $get_prvatelandla[0]['file_SIA']; ?>" />
        <input type="hidden" name="file_notification_hidden" value="<?php echo $get_prvatelandla[0]['file_notification']; ?>" />
        <input type="hidden" name="file_declaration_hidden" value="<?php echo $get_prvatelandla[0]['file_declaration']; ?>" />
        <input type="hidden" name="file_compensation_hidden" value="<?php echo $get_prvatelandla[0]['file_compensation']; ?>" />                     
                        
                        
                       <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Possesed so Far ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('progress_land_processed', '<div class="error">', '</div>'); ?>
                                      <input class="form-control txtQty"  name="progress_land_processed" id="progress_land_alienated" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('progress_land_processed'); }?><?php echo $get_prvatelandla[0]['progress_land_processed'] ?>"  placeholder="land alienated">
                                </div>
                                
                               <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                    <?php echo form_error('progress_p', '<div class="error">', '</div>'); ?>

                       <input class="form-control txtQty limittxt_progress"  name="progress_p" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('progress_p'); }?><?php echo $get_prvatelandla[0]['progress_%'] ?>"  placeholder="Progress">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Required for A/A Acquired </b>
                                    </p>
                                    <select class="form-control show-tick" name="progress_land_required_aa">
                             <option value="Yes" <?php echo set_select('progress_land_required_aa','Yes', ( !empty($get_prvatelandla[0]['progress_land_required_aa']) &&
                                      $get_prvatelandla[0]['progress_land_required_aa'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('progress_land_required_aa','No', ( !empty($get_prvatelandla[0]['progress_land_required_aa']) &&
                                      $get_prvatelandla[0]['progress_land_required_aa'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('progress_land_required_aa','In Progress', ( !empty($get_prvatelandla[0]['progress_land_required_aa']) &&
                                      $get_prvatelandla[0]['progress_land_required_aa'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('progress_land_required_aa','N.A', ( !empty($get_prvatelandla[0]['progress_land_required_aa']) &&
                                      $get_prvatelandla[0]['progress_land_required_aa'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized </b>
                                    </p>
                                    <?php echo form_error('progress_amount_utilised', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty"  name="progress_amount_utilised" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('progress_amount_utilised'); }?><?php echo number_format($get_prvatelandla[0]['progress_amount_utilised'],2) ?>"  placeholder="Progress Amount " >

                                    
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized <span class="col-pink">* </span></b>
                                    </p>
                                    <?php echo form_error('progress_fund_utilised', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty limittxt_progress"  name="progress_fund_utilised" type="text" value="<?php if(empty($get_prvatelandla)){ echo set_value('progress_fund_utilised'); }?><?php echo $get_prvatelandla[0]['progress_fund_utilised'] ?>"  placeholder="Progress fund">
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                      
                                        <b> Remarks </b>
                                    </p>
                                    
<?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                    <textarea class="form-control no-resize" name="remarks" rows="3" id="maxremarks" placeholder="Please type what you want..."><?php if(empty($get_prvatelandla)){ echo set_value('remarks'); }?><?php echo $get_prvatelandla[0]['remarks'] ?></textarea>
                                    <span id="warning-message" style='color:#ff0000'></span>
                                </div>
                            </div> 
                          </div>
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                              <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_prvatelandla)) ? 'SAVE' : 'Update' ?>
                            </button>
                           </div>
                            
                           <div class="clearfix"></div>   
                        
                      </div>

                    </div>
                 </div>
                
              </form>
            <!-- Select -->
            </div>
            
        </div>
    </section>
    <!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
  <?php
  if(empty($landacquisition_location_data)){
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
    var land_total_area = $(this).val();
    $("#total_area_hidden").val(land_total_area);
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

//valication for Total Area To be Alienated 
$('#progress_land_alienated').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#total_area_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#total_area").val();
  }
  if ( parseFloat(curval) > parseFloat(hidden_area) ){
     alert("Land Possesed so Far should less than Total Area Purchased");
    $(this).val(0);
  }
});

//valication for Total Area To be Alienated 
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
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_private_land_la/gettehsil_list",
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

for(let i=1; i<= 4; i++) {
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