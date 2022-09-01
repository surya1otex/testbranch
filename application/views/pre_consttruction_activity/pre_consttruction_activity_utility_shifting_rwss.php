 <?php $CI =& get_instance();?>
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

            

           <?php echo form_open_multipart('Pre_consttruction_activity_utility_shifting_rwss/manage', array('name' => 'Pre_consttruction_activity_utility_shifting_rwss','id' => 'Pre_consttruction_activity_utility_shifting_rwss')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />




			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Utility Shifting ( RWSS ) </h2>
                        </div>

                        <div class="body">
                 
                            
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Length of Pipeline to be Shifted ( LHS ) <span class="col-pink">*</span></b>
                                    </p>
                                    
                                    <input class="form-control txtQty" type="text" placeholder="Length of pipeline (LHS)" name="length_of_pipeline_tobe_shifted_lhs" id="length_of_pipeline_tobe_shifted_lhs" value="<?php if(empty($utility_rwss)){ echo set_value('length_of_pipeline_tobe_shifted_lhs'); }?><?php echo $utility_rwss[0]['length_of_pipeline_tobe_shifted_lhs'] ?>">

                                     <input type="hidden" id="length_of_pipeline_tobe_shifted_lhs_hidden">
                                    <?php echo form_error('length_of_pipeline_tobe_shifted_lhs', '<div class="error">', '</div>'); ?>
                                </div>
                                

                                
                                 <div class="col-md-4">
                                    <p>
                                        <b>Length of Pipeline to be Shifted ( RHS ) </b>
                                    </p>
                                    <input class="form-control txtQty" type="text" placeholder="Length of pipeline ( RHS )"  name="length_of_pipeline_tobe_shifted_rhs" value="<?php if(empty($utility_rwss)){ echo set_value('length_of_pipeline_tobe_shifted_rhs'); }?><?php echo $utility_rwss[0]['length_of_pipeline_tobe_shifted_rhs'] ?>">
                                    <?php echo form_error('length_of_pipeline_tobe_shifted_rhs', '<div class="error">', '</div>'); ?>
                                </div>
                                                            
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                     <input type="text" class="datepicker form-control" placeholder="Please choose a date..." name="target_end_date" value="<?php if(empty($utility_rwss)){ echo set_value('target_end_date'); }?><?php echo $utility_rwss[0]['target_end_date'] ?>">
                                     <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>
                                </div>
   
                           </div>
                        </div>
               <!-- Location Details Start-->
                    <div class="card">
                        <div class="header">
                            <h2> Location Details </h2>
                        </div>

                        <div class="body">
                         <div class="col-md-3" style="display: none;">
                      <div class="form-group">
                        <label>Class / Course <span class="text-red"> * </span></label>
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">All District</option>

                             <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>" ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>




                      </div>
                    </div>   




                   <?php
                      if(!empty($utility_rwss_location)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
                 $get_same_datacnt = count($utility_rwss_location);
              
                foreach ($utility_rwss_location as $sameD) {
                  if($k == 1){
            
                ?>
                   
                                <div class="col-md-3">
                                    <p>
                                        <b>Districts Name</b>
                                        
                                    </p>
                      <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="ulbFunc(1);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>



                                <div class="col-md-3">
                                    <p>
                                        <b>Ulbs Covered </b>
                                       
                                    </p>
                                    <select name="ulb_id[]" id="ulb_id_1" class="form-control" onchange="phdivFunc(1);">
                           <?php
                            echo $CI->getselulb($sameD->district_id,$sameD->ulb_id);
                            ?>
                        </select>
                                </div>


                                <div class="col-md-3">
                                    <p>
                                        <b>PH Division</b>
                                       
                                    </p>
                                    <select class="form-control select2" id="ph_id_1" name="phd_id[0][]" multiple="multiple"  style="width: 100%;">
                                     <?php
                                     echo $CI->get_phd_data($sameD->ulb_id,$sameD->ph_division_id);
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
                                
                                <div class="col-md-3">
<!--                                     <p>
                                        <b>Districts Name <span class="col-pink">* </span></b>
                                        
                                    </p> -->
                        <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="ulbFunc(<?php echo $k; ?>)">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-3">
<!--                                     <p>
                                        <b>Ulbs Covered </b>
                                       
                                    </p> -->
                                    <select name="ulb_id[]" id="ulb_id_<?php echo $k; ?>" class="form-control" onchange="phdivFunc(<?php echo $k; ?>)">
                           <?php
                            echo $CI->getselulb($sameD->district_id,$sameD->ulb_id);
              
                            ?>
                           
                        </select>
                                </div>


                                <div class="col-md-3">
<!--                                     <p>
                                        <b>PH Division</b>
                                       
                                    </p> -->
                                    <select class="form-control select2" id="ph_id_<?php echo $k; ?>" name="phd_id[<?php echo $k - 1; ?>][]" multiple="multiple"  style="width: 100%;">
                                     <?php
                           echo $CI->get_phd_data($sameD->ulb_id,$sameD->ph_division_id);
                            ?>
                        </select>
                                </div>

                                
                                <div class="col-md-2 p-t-25">
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



                            <div id="container1" class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Districts Name <span class="col-pink">* </span></b>
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="ulbFunc(1);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>" ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Ulbs Covered</b>
                                       
                                    </p>
                                    <select class="form-control" id="ulb_id_1" name="ulb_id[]" onchange="phdivFunc(1);" style="width: 100%;">
                        </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>PH Division </b>
                                       
                                    </p>
                                    <select name="phd_id[0][]" id="ph_id_1" class="form-control select2" multiple="multiple" >
                           <!-- <option value="0">All Tehsil</option>-->
                        </select>
                                </div>




                                <div class="col-md-2 p-t-25">
<button  id="newField_1" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
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
                                        <b>Joint Verification Done ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_joint_verification">
                                        <option value="Yes" <?php echo set_select('status_joint_verification','Yes', ( !empty($utility_rwss[0]['status_joint_verification']) &&
                                      $utility_rwss[0]['status_joint_verification'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_joint_verification','No', ( !empty($utility_rwss[0]['status_joint_verification']) &&
                                      $utility_rwss[0]['status_joint_verification'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_joint_verification','In Progress', ( !empty($utility_rwss[0]['status_joint_verification']) &&
                                      $utility_rwss[0]['status_joint_verification'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_joint_verification','N.A', ( !empty($utility_rwss[0]['status_joint_verification']) &&
                                      $utility_rwss[0]['status_joint_verification'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Joint Verification </b>
                                    </p>
                                     <input  type="file" name="file_joint_verification" value="fileupload" id="uploadFile1" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php echo form_error('file_joint_verification', '<div class="error">', '</div>'); ?>
            <?php if (!empty($utility_rwss[0]['file_joint_verification'])) { ?>
      <a href="<?php echo base_url();?>uploads/files/shifting_ph/<?php echo $utility_rwss[0]['file_joint_verification']; ?>" target="_blank">
        <i class="fa fa-download fa-2x" aria-hidden="true"></i>
      </a>
    <?php } ?>
                                </div>

                                <div class="col-md-3">
                                    <p>
                                        <b>Fund for Utility Shifting Placed ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_fund_for_utility_shifting">
                                        <option value="Yes" <?php echo set_select('status_fund_for_utility_shifting','Yes', ( !empty($utility_rwss[0]['status_fund_for_utility_shifting']) &&
                                      $utility_rwss[0]['status_fund_for_utility_shifting'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_fund_for_utility_shifting','No', ( !empty($utility_rwss[0]['status_fund_for_utility_shifting']) &&
                                      $utility_rwss[0]['status_fund_for_utility_shifting'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_fund_for_utility_shifting','In Progress', ( !empty($utility_rwss[0]['status_fund_for_utility_shifting']) &&
                                      $utility_rwss[0]['status_fund_for_utility_shifting'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_fund_for_utility_shifting','N.A', ( !empty($utility_rwss[0]['status_fund_for_utility_shifting']) &&
                                      $utility_rwss[0]['status_fund_for_utility_shifting'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Fund Placement </b>
                                    </p>
                                     <input  type="file" name="file_fund_for_utility_shifting" value="fileupload" id="uploadFile2" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php echo form_error('file_fund_for_utility_shifting', '<div class="error">', '</div>'); ?>
            <?php if (!empty($utility_rwss[0]['file_fund_for_utility_shifting'])) { ?>
      <a href="<?php echo base_url();?>uploads/files/shifting_ph/<?php echo $utility_rwss[0]['file_fund_for_utility_shifting']; ?>" target="_blank">
        <i class="fa fa-download fa-2x" aria-hidden="true"></i>
      </a>
    <?php } ?>
                                </div>
                               </div>
                               <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Tender Awarded ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_tender_awarded">
                                        <option value="Yes" <?php echo set_select('status_tender_awarded','Yes', ( !empty($utility_rwss[0]['status_tender_awarded']) &&
                                      $utility_rwss[0]['status_tender_awarded'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_tender_awarded','No', ( !empty($utility_rwss[0]['status_tender_awarded']) &&
                                      $utility_rwss[0]['status_tender_awarded'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_tender_awarded','In Progress', ( !empty($utility_rwss[0]['status_tender_awarded']) &&
                                      $utility_rwss[0]['status_tender_awarded'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_tender_awarded','N.A', ( !empty($utility_rwss[0]['status_tender_awarded']) &&
                                      $utility_rwss[0]['status_tender_awarded'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Tender Awarded </b>
                                    </p>
                                     <input  type="file" name="file_tender_awarded" value="fileupload" id="uploadFile3" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php echo form_error('file_tender_awarded', '<div class="error">', '</div>'); ?>
                                                 <?php if (!empty($utility_rwss[0]['file_tender_awarded'])) { ?>
      <a href="<?php echo base_url();?>uploads/files/shifting_ph/<?php echo $utility_rwss[0]['file_tender_awarded']; ?>" target="_blank">
        <i class="fa fa-download fa-2x" aria-hidden="true"></i>
      </a>
    <?php } ?>
                                </div>
                            </div>
                              
                        </div>
                      </div>
                    
       <input type="hidden" name="file_joint_verification_hidden" value="<?php echo $utility_ph[0]['file_joint_verification']; ?>" />
        <input type="hidden" name="file_fund_for_utility_shifting_hidden" value="<?php echo $utility_ph[0]['file_fund_for_utility_shifting']; ?>" />
        <input type="hidden" name="file_tender_awarded_hidden" value="<?php echo $utility_ph[0]['file_tender_awarded']; ?>" />
                        
                      <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                       <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Length of Line to be Shifted ( LHS ) </b>
                                    </p>
                                     <input class="form-control txtQty" type="text" placeholder="poles shifted" name="progress_length_of_line_tobe_shifted_lhs"  id="progress_length_of_line_tobe_shifted_lhs" value="<?php if(empty($utility_rwss)){ echo set_value('progress_length_of_line_tobe_shifted_lhs'); }?><?php echo $utility_rwss[0]['progress_length_of_line_tobe_shifted_lhs'] ?>">
                                     <?php echo form_error('progress_length_of_line_tobe_shifted_lhs', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Length of Line to be Shifted ( RHS ) </b>
                                    </p>
                                     <input class="form-control txtQty" type="text" placeholder="poles shifted" name="progress_length_of_line_tobe_shifted_rhs" value="<?php if(empty($utility_rwss)){ echo set_value('progress_length_of_line_tobe_shifted_rhs'); }?><?php echo $utility_rwss[0]['progress_length_of_line_tobe_shifted_rhs'] ?>">
                                     <?php echo form_error('progress_length_of_line_tobe_shifted_rhs', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="Progress" name="progress_%" value="<?php if(empty($utility_rwss)){ echo set_value('progress_%'); }?><?php echo $utility_rwss[0]['progress_%'] ?>">
                                     <?php echo form_error('progress_%', '<div class="error">', '</div>'); ?>
                                </div>

                            </div>
                             
                              
                            <div class="row clearfix">
                                 <div class="col-md-4">
                                    <p>
                                        <b>RWSS/RHS Utility Shifting for A / A Done ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="progress_rwss_utility_shifting">
                                        <option value="Yes" <?php echo set_select('progress_rwss_utility_shifting','Yes', ( !empty($utility_rwss[0]['progress_rwss_utility_shifting']) &&
                                      $utility_rwss[0]['progress_rwss_utility_shifting'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('progress_rwss_utility_shifting','No', ( !empty($utility_rwss[0]['progress_rwss_utility_shifting']) &&
                                      $utility_rwss[0]['progress_rwss_utility_shifting'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('progress_rwss_utility_shifting','In Progress', ( !empty($utility_rwss[0]['progress_rwss_utility_shifting']) &&
                                      $utility_rwss[0]['progress_rwss_utility_shifting'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('progress_rwss_utility_shifting','N.A', ( !empty($utility_rwss[0]['progress_rwss_utility_shifting']) &&
                                      $utility_rwss[0]['progress_rwss_utility_shifting'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>                               
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized  </b>
                                    </p>
                                     <input class="form-control txtQty" type="text" placeholder="Amount" name="progress_amount_utilised" value="<?php if(empty($utility_rwss)){ echo set_value('progress_amount_utilised'); }?><?php echo number_format($utility_rwss[0]['progress_amount_utilised'],2) ?>">
                                     <?php echo form_error('progress_amount_utilised', '<div class="error">', '</div>'); ?>
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p>
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="pre-construction fund Utilized" name="progress_fund_utilised" value="<?php if(empty($utility_rwss)){ echo set_value('progress_fund_utilised'); }?><?php echo $utility_rwss[0]['progress_fund_utilised'] ?>">
                                     <?php echo form_error('progress_fund_utilised', '<div class="error">', '</div>'); ?>
                                </div> 
                            </div>
                              
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <textarea class="form-control no-resize" rows="3" id="maxremarks"  placeholder="Please type what you want..." name="remarks"><?php if(empty($utility_rwss)){ echo set_value('remarks'); }?><?php echo $utility_rwss[0]['remarks'] ?></textarea>
                                     <span id="warning-message" style='color:#ff0000'></span>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>   
                              
                          </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($utility_rwss)) ? 'SAVE' : 'Update' ?>
                            </button>
                           </div>
                           <div class="clearfix"></div>   
                        
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
    <!-- #Main Content -->
      <?php
          if(empty($utility_rwss_location)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>
          
<script type="text/javascript">
</script>
            <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
   var dividcnt = <?php echo $cnt6; ?>;
   
   var i = <?php echo $cnt6; ?>;
for (i = 1; i <= <?php echo $cnt6; ?>; i++) {
   
//$('#tehsil_id_'+i).select2({dropdownAutoWidth : true});

$('#ph_id_'+i).select2({dropdownAutoWidth : true});


//$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
});

    $("#length_of_pipeline_tobe_shifted_lhs").keyup(function() {
    //alert($(this).val());
    var length_of_pipeline_tobe_shifted_lhs_area = $(this).val();
    $("#length_of_pipeline_tobe_shifted_lhs_hidden").val(length_of_pipeline_tobe_shifted_lhs_area);
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

//valication for Total Area To be Alienated 
$('#progress_length_of_line_tobe_shifted_lhs').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#length_of_pipeline_tobe_shifted_lhs_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#length_of_pipeline_tobe_shifted_lhs").val();
  }
  if ( parseInt(curval) > parseInt(hidden_area) ){
    alert("Length of Line to be Shifted should less than Total Length of Pipeline to be Shifted");
    $(this).val(0);
  }
});
</script>

<script type="text/javascript">

  
   var divid = <?php echo $cnt6; ?>;

   var optionValues = $("#hidden_dist_fetch").html();

      $('#container1').on('click','#newField_' + divid, function () {

        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-3"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="ulbFunc('+divid+')">' + optionValues + '</select></div></div><div class="col-md-3"><div class=""><select name="ulb_id[]" id="ulb_id_'+divid+'" class="form-control" onchange="phdivFunc('+divid+')"></select></div></div><div class="col-md-3"><div class=""><select class="form-control select2" id="ph_id_'+divid+'" name="phd_id['+ndiv+'][]" multiple="multiple" style="width: 100%;"></select></div></div><div class="col-md-3"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
      
      
                    

         $('#container1').append(newthing);
         $('.select2').select2()
    });
  

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
        $('#newAdd_'+id).remove();

    });
    
   
$('#tehsil_id_1').select2({dropdownAutoWidth : true});
//$('#ulb_id_1').select2({dropdownAutoWidth : true});

</script>

<script type="text/javascript">
 function ulbFunc(divid) {

    var value = $('#dist_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_encroachment_eviction/getulb_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","dist_id": value },
    
    success: function(data){
      
      
         var parsed_data = JSON.parse(data);
                            
                            
                              $val_selec ='';
                            var listItems= "";
                    if(parsed_data.all_ulb.length > 0)
                    {
                      $("#ulb_id_"+divid).empty();
                               $("#ulb_id_"+divid).append("<option value=0>Please select Ulbs Covered</option>");
                               for (var i = 0; i < parsed_data.all_ulb.length; i++)
                                      {
                    $("#ulb_id_"+divid).append("<option  value='" + parsed_data.all_ulb[i].id  + "'>" + parsed_data.all_ulb[i]. ulb_name + "</option>");
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#ulb_id_"+divid).append("<option  value=''>" +'All ulb' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}

  function phdivFunc(divid) {
    //alert(divid);
    var value = $('#ulb_id_'+divid).val();
//$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_ph/getph_divison",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","ulb_id": value },
    
    success: function(data){
      
      
      
                            var parsed_data = JSON.parse(data);
                            $("#ph_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_data.length);
                    if(parsed_data.all_phdivision.length > 0)
                    {

                               for (var i = 0; i < parsed_data.all_phdivision.length; i++)
                                      {
                    $("#ph_id_"+divid).append("<option  value='" + parsed_data.all_phdivision[i].ph_division_id  + "'>" + parsed_data.all_phdivision[i]. ph_division_name + "</option>");
                    $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#ph_id_"+divid).append("<option  value=''>" +'Select Another PH Division' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}

      for(let i=1; i<= 3; i++) {
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
        font-weight: bold;
      }
    </style>