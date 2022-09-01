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
<?php echo form_open_multipart('Pre_consttruction_activity_private_land_dp/manage', array('name' => 'pre_consttruction_activity_private_land_dp','id' => 'pre_consttruction_activity_private_land_dp')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Private Land ( Direct Purchase ) </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Total Area To be Purchased ( In Acres ) <span class="col-pink">*</span></b>
                                    </p>

                                    <input type="hidden" name="directpurchase_id" value="<?php echo $get_prvatelanddp[0]['id'] ?>">
                                    

                    <input class="form-control txtQty"  name="total_area"  id="total_area" type="text" value="<?php if(empty($get_prvatelanddp)){ echo set_value('total_area'); }?><?php echo $get_prvatelanddp[0]['total_area'] ?>"  placeholder="Total Area">
                     <input type="hidden" id="total_area_hidden">
                    <?php echo form_error('total_area', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                 <div class="col-md-4">
                                    <p>
                                        <b>Estimate Cost of Purchase </b>
                                    </p>
                                    <?php echo form_error('estmtd_cost', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty"  name="estmtd_cost" type="text" value="<?php if(empty($get_prvatelanddp)){ echo set_value('estmtd_cost'); }?><?php echo $get_prvatelanddp[0]['estimated_cost'] ?>"  placeholder="Compensation amount">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>General Category Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('general_cat_land', '<div class="error">', '</div>'); ?>
                                    <input class="form-control txtQty"  name="general_cat_land" type="text" value="<?php if(empty($get_prvatelanddp)){ echo set_value('general_cat_land'); }?><?php echo $get_prvatelanddp[0]['general_cat_land'] ?>"  placeholder="General cat land">
                                </div>

                             </div>
                            
                            <div class="row clearfix">

                                <div class="col-md-4">
                                    <p>
                                        <b>SC Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('sc_land', '<div class="error">', '</div>'); ?>

                                    <input class="form-control txtQty" name="sc_land" type="text" placeholder="SC land" value="<?php if(empty($get_prvatelanddp)){ echo set_value('sc_land'); }?><?php echo $get_prvatelanddp[0]['sc_land'] ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>ST Land ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('st_land', '<div class="error">', '</div>'); ?>

                                    <input class="form-control txtQty" name="st_land" type="text" placeholder="ST land" value="<?php if(empty($get_prvatelanddp)){ echo set_value('st_land'); }?><?php echo $get_prvatelanddp[0]['st_land'] ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                    <?php echo form_error('target_end', '<div class="error">', '</div>'); ?>

                                     <input type="text" name="target_end" class="datepicker form-control" placeholder="Please choose a date..." value="<?php if(empty($get_prvatelanddp)){ echo set_value('target_end'); }?><?php echo $get_prvatelanddp[0]['target_end_date'] ?>">
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
                   if(!empty($directpurchase_location_data)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($directpurchase_location_data);
              
                foreach ($directpurchase_location_data as $sameD) {
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
                                        <!-- <b>Districts Name </b> -->
                                        
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
                                        <b>Tehsils Covered </b> <!-- <span class="col-pink">* </span> -->
                                        
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
                                    <p> <b>Bilateral Negotiation Conducted ? </b></p>
                                     
                                    
                                     <select class="form-control show-tick" name="negotiation_con">
                             <option value="Yes" <?php echo set_select('negotiation_con','Yes', ( !empty($get_prvatelanddp[0]['status_negotiation_conducted']) &&
                                      $get_prvatelanddp[0]['status_negotiation_conducted'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('negotiation_con','No', ( !empty($get_prvatelanddp[0]['status_negotiation_conducted']) &&
                                      $get_prvatelanddp[0]['status_negotiation_conducted'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('negotiation_con','In Progress', ( !empty($get_prvatelanddp[0]['status_negotiation_conducted']) &&
                                      $get_prvatelanddp[0]['status_negotiation_conducted'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('negotiation_con','N.A', ( !empty($get_prvatelanddp[0]['status_negotiation_conducted']) &&
                                      $get_prvatelanddp[0]['status_negotiation_conducted'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / Bilateral Negotiation  </b> </p>
                                    <?php echo form_error('file_bilateral_negotiation', '<div class="error">', '</div>'); ?>
                                    <input  type="file" name="file_bilateral_negotiation" value="fileupload" id="uploadFile1" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                    <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php if (!empty($get_prvatelanddp[0]['file_bilateral_negotiation'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/direct_purchase/<?php echo $get_prvatelanddp[0]['file_bilateral_negotiation']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                             
                                
                                <div class="col-md-3">
                                    <p> <b>DCAC Metting Held ? </b></p>
                                    <select class="form-control show-tick" name="dcac_meeting">
                             <option value="Yes" <?php echo set_select('dcac_meeting','Yes', ( !empty($get_prvatelanddp[0]['status_dcac_meeting_held']) &&
                                      $get_prvatelanddp[0]['status_dcac_meeting_held'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('dcac_meeting','No', ( !empty($get_prvatelanddp[0]['status_dcac_meeting_held']) &&
                                      $get_prvatelanddp[0]['status_dcac_meeting_held'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('dcac_meeting','In Progress', ( !empty($get_prvatelanddp[0]['status_dcac_meeting_held']) &&
                                      $get_prvatelanddp[0]['status_dcac_meeting_held'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('dcac_meeting','N.A', ( !empty($get_prvatelanddp[0]['status_dcac_meeting_held']) &&
                                      $get_prvatelanddp[0]['status_dcac_meeting_held'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / DCAC Metting Held  </b> </p>
                                    <?php echo form_error('file_meeting_held', '<div class="error">', '</div>'); ?>
                                    <input  type="file" name="file_meeting_held" value="fileupload" id="uploadFile2" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                    <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php if (!empty($get_prvatelanddp[0]['file_meeting_held'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/direct_purchase/<?php echo $get_prvatelanddp[0]['file_meeting_held']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p><b>A / A Funds Approved ? </b></p>
                                    <select class="form-control show-tick" name="funds_approved_aa">
                             <option value="Yes" <?php echo set_select('funds_approved_aa','Yes', ( !empty($get_prvatelanddp[0]['status_aa_funds_approved']) &&
                                      $get_prvatelanddp[0]['status_aa_funds_approved'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('funds_approved_aa','No', ( !empty($get_prvatelanddp[0]['status_aa_funds_approved']) &&
                                      $get_prvatelanddp[0]['status_aa_funds_approved'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('funds_approved_aa','In Progress', ( !empty($get_prvatelanddp[0]['status_aa_funds_approved']) &&
                                      $get_prvatelanddp[0]['status_aa_funds_approved'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('funds_approved_aa','N.A', ( !empty($get_prvatelanddp[0]['status_aa_funds_approved']) &&
                                      $get_prvatelanddp[0]['status_aa_funds_approved'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Documents / A / A Funds Approved  </b></p>
                                    <?php echo form_error('file_funds_approved', '<div class="error">', '</div>'); ?>
                                    <input  type="file" name="file_funds_approved" value="fileupload_fund_approved" id="uploadFile3" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                    <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php if (!empty($get_prvatelanddp[0]['file_funds_approved'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/direct_purchase/<?php echo $get_prvatelanddp[0]['file_funds_approved']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                            
                                <div class="col-md-3">
                                    <p><b>Land Registration Done ? </b></p>

                                    <select class="form-control show-tick" name="land_registation">
                             <option value="Yes" <?php echo set_select('land_registation','Yes', ( !empty($get_prvatelanddp[0]['status_land_registration']) &&
                                      $get_prvatelanddp[0]['status_land_registration'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('land_registation','No', ( !empty($get_prvatelanddp[0]['status_land_registration']) &&
                                      $get_prvatelanddp[0]['status_land_registration'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('land_registation','In Progress', ( !empty($get_prvatelanddp[0]['status_land_registration']) &&
                                      $get_prvatelanddp[0]['status_land_registration'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('land_registation','N.A', ( !empty($get_prvatelanddp[0]['status_land_registration']) &&
                                      $get_prvatelanddp[0]['status_land_registration'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p><b>Documents / Land Registration </b></p>
                                    <?php echo form_error('file_land_registration', '<div class="error">', '</div>'); ?>
                                    <input  type="file" name="file_land_registration" value="fileupload_land" id="uploadFile4" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                    <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php if (!empty($get_prvatelanddp[0]['file_land_registration'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/direct_purchase/<?php echo $get_prvatelanddp[0]['file_land_registration']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                </div>
                            </div>  
                              
                           </div>
                         </div>
                    
        <input type="hidden" name="file_bilateral_negotiation_hidden" value="<?php echo $get_prvatelanddp[0]['file_bilateral_negotiation']; ?>" />
        <input type="hidden" name="file_meeting_held_hidden" value="<?php echo $get_prvatelanddp[0]['file_meeting_held']; ?>" />
        <input type="hidden" name="file_funds_approved_hidden" value="<?php echo $get_prvatelanddp[0]['file_funds_approved']; ?>" />
        <input type="hidden" name="file_land_registration_hidden" value="<?php echo $get_prvatelanddp[0]['file_land_registration']; ?>" />              
                        
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

                                     <input class="form-control txtQty" name="progress_land_processed" id="progress_land_alienated" type="text" placeholder="Land alienated" value="<?php if(empty($get_prvatelanddp)){ echo set_value('progress_land_processed'); }?><?php echo $get_prvatelanddp[0]['progress_land_processed'] ?>">
                                </div>
                                
                               <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                    <?php echo form_error('progress_percent', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty limittxt_progress" name="progress_percent" type="text" placeholder="Progress" value="<?php if(empty($get_prvatelanddp)){ echo set_value('progress_percent'); }?><?php echo $get_prvatelanddp[0]['progress_%'] ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Required for A/A Purchased </b>
                                    </p>
                                    <select class="form-control show-tick" name="progress_land_required_aa">
                             <option value="Yes" <?php echo set_select('progress_land_required_aa','Yes', ( !empty($get_prvatelanddp[0]['progress_land_required_aa']) &&
                                      $get_prvatelanddp[0]['progress_land_required_aa'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('progress_land_required_aa','No', ( !empty($get_prvatelanddp[0]['progress_land_required_aa']) &&
                                      $get_prvatelanddp[0]['progress_land_required_aa'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                     <option value="In Progress" <?php echo set_select('progress_land_required_aa','In Progress', ( !empty($get_prvatelanddp[0]['progress_land_required_aa']) &&
                                      $get_prvatelanddp[0]['progress_land_required_aa'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>
                                        <option value="N.A" <?php echo set_select('progress_land_required_aa','N.A', ( !empty($get_prvatelanddp[0]['progress_land_required_aa']) &&
                                      $get_prvatelanddp[0]['progress_land_required_aa'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized  </b>
                                    </p>
                                    <?php echo form_error('progress_amount_utilised', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty" name="progress_amount_utilised" type="text" placeholder="Amount Utilized" value="<?php if(empty($get_prvatelanddp)){ echo set_value('progress_amount_utilised'); }?><?php echo number_format($get_prvatelanddp[0]['progress_amount_utilised'],2 )?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p>
                                    <?php echo form_error('progress_fund_utilised', '<div class="error">', '</div>'); ?>

                                     <input class="form-control txtQty limittxt_progress" name="progress_fund_utilised" type="text" placeholder="fund Utilized" value="<?php if(empty($get_prvatelanddp)){ echo set_value('progress_fund_utilised'); }?><?php echo $get_prvatelanddp[0]['progress_fund_utilised'] ?>">
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                    <textarea class="form-control no-resize" name="remarks" rows="3" id="maxremarks" placeholder="Please type what you want..."><?php if(empty($get_prvatelanddp)){ echo set_value('remarks'); }?><?php echo $get_prvatelanddp[0]['remarks'] ?></textarea>
                                    <span id="warning-message" style='color:#ff0000'></span>
                                </div>
                            </div> 
                          </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_prvatelanddp)) ? 'SAVE' : 'Update' ?>
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
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>

            <?php
          if(empty($directpurchase_location_data)){
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
         //$('.select2').select2();
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
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_private_land_dp/gettehsil_list",
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

    <!-- #Main Content -->
        <style type="text/css">
      .error {
        color: red;
        padding-bottom: 10px;
      }
    </style>