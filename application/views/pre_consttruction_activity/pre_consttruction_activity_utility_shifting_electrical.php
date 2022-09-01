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

<?php echo form_open_multipart('Pre_consttruction_activity_utility_shifting_electrical/manage', array('name' => 'pre_consttruction_activity_utility_shifting_electrical','id' => 'pre_consttruction_activity_utility_shifting_electrical')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Utility Shifting ( Electrical ) </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Poles To be Shifted <span class="col-pink">*</span></b>
                                    </p>

                                    <input class="form-control txtQty" type="text" name="poles_tobe_shifted" id="poles_tobe_shifted" placeholder="Poles Shifted" value="<?php if(empty($get_utility_elec)){ echo set_value('poles_tobe_shifted'); }?><?php echo $get_utility_elec[0]['poles_tobe_shifted'] ?>">
                                     <input type="hidden" id="poles_tobe_shifted_hidden">
                                     <?php echo form_error('poles_tobe_shifted', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>New lines To be Installed </b>
                                    </p>
                                    <input class="form-control txtQty" type="text" name="new_lines_tobe_installed" value="<?php if(empty($get_utility_elec)){ echo set_value('new_lines_tobe_installed'); }?><?php echo $get_utility_elec[0]['new_lines_tobe_installed'] ?>" placeholder="New lines installed">
                                    <?php echo form_error('new_lines_tobe_installed', '<div class="error">', '</div>'); ?>
                                </div>
                                
                               <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                     <input type="text" name="target_end_date" value="<?php if(empty($get_utility_elec)){ echo set_value('target_end_date'); }?><?php echo $get_utility_elec[0]['target_end_date'] ?>" class="datepicker form-control" placeholder="Please choose a date...">
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
                   if(!empty($utility_location_data)){
                    ?>
                    

                     <div id="container1" class="row clearfix">
                       <?php 
                         $k = 1;
                         $get_same_datacnt = count($utility_location_data);
                
                        foreach ($utility_location_data as $sameD) {
                        if($k == 1){
              
                        ?>
                   
                            <div class="col-md-3">
                                <p>
                                    <b>Districts Name </b>
                                    
                                </p>
                             <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1)">
                                 <option value="0">All District</option>

                                    <?php   foreach ($districts as  $Tvalue){?>
                                            <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                                    <?php } ?>
                              </select>
                                </div>



                                <div class="col-md-3">
                                    <p>
                                        <b>Electrical Division </b>
                                       
                                    </p>
                                    <select name="division_id[]" id="division_id_1" class="form-control" onchange="discomFunc(<?php echo $k; ?>)">
                                      <option value="0">Please Select Division</option>
                                      <?php echo $CI->getseldivision($sameD->district_id,$sameD->electrical_division_id); ?>
                                    </select>
                                </div>


                                <div class="col-md-3">
                                    <p>
                                        <b>Discom Name</b>
                                       
                                    </p>
                                   <select class="form-control select2" id="ulb_id_1" name="discom_id[0][]" multiple="multiple"  style="width: 100%;">

                                     <?php
                                      echo $CI->getdiscom_data($sameD->electrical_division_id,$sameD->discom_name);
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
                                    <p>
                                        <!-- <b>Districts Name <span class="col-pink">* </span></b> -->
                                        
                                    </p>
                              <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="tehsilFunc(<?php echo $k; ?>)">
                                <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-3">
                                    <p>
                                        <!-- <b>Electrical Division </b> -->
                                       
                                    </p>
                        <select name="division_id[]" id="division_id_<?php echo $k; ?>" class="form-control" onchange="discomFunc(<?php echo $k; ?>)">
                                   <option value="0">Please Select Division</option>
                                    <?php
                                      echo $CI->getseldivision($sameD->district_id,$sameD->electrical_division_id);
                                    ?>
                           
                        </select>
                                </div>


                                <div class="col-md-3">
                                    <p>
                                        <!-- <b>Discom Name </b> -->
                                       
                                    </p>
                                    <select class="form-control select2" id="ulb_id_<?php echo $k; ?>" name="discom_id[<?php echo $k - 1; ?>][]" multiple="multiple"  style="width: 100%;">

                                      <?php
                                         echo $CI->getdiscom_data($sameD->electrical_division_id,$sameD->discom_name);
                                      ?>
                                  </select>
                                </div>

                                
                                 <div class="col-md-2">
                                      <button   id="removefld_<?php echo $k; ?>" data-id="<?php echo $k; ?>" name="submit" type="button"class="btn btn-default btn-circle remove waves-effect  waves-float"><i class="material-icons remove col-pink">delete</i>
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
                                   <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1)">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>" ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>


                                <div class="col-md-3">
                                    <p>
                                        <b>Electrical Division </b>
                                       
                                    </p>
                                    <select name="division_id[]" id="division_id_1" class="form-control" onchange="discomFunc(1)">
                                       <!-- <option value="0">All Tehsil</option>-->
                                    </select>
                                </div>



                                <div class="col-md-3">
                                    <p>
                                        <b>Discom Name</b>
                                       
                                    </p>
                                    <select class="form-control select2" id="ulb_id_1" name="discom_id[0][]" multiple="multiple"  style="width: 100%;">
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
                                  <option value="Yes" <?php echo set_select('status_joint_verification','Yes', ( !empty($get_utility_elec[0]['status_joint_verification']) &&
                                      $get_utility_elec[0]['status_joint_verification'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_joint_verification','No', ( !empty($get_utility_elec[0]['status_joint_verification']) &&
                                      $get_utility_elec[0]['status_joint_verification'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_joint_verification','In Progress', ( !empty($get_utility_elec[0]['status_joint_verification']) &&
                                      $get_utility_elec[0]['status_joint_verification'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_joint_verification','N.A', ( !empty($get_utility_elec[0]['status_joint_verification']) &&
                                      $get_utility_elec[0]['status_joint_verification'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Joint Verification </b>
                                    </p>
                                     <input  type="file" name="file_joint_verification" value="fileupload" id="uploadFile1" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_utility_elec[0]['file_joint_verification'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/utility_electrical/<?php echo $get_utility_elec[0]['file_joint_verification']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                          
                                      <?php } ?>
                                     <?php echo form_error('file_joint_verification', '<div class="error">', '</div>'); ?>
                                </div>
                            
                                <div class="col-md-3">
                                    <p>
                                        <b>Approval Fund Received ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_approval_fund_received">
                                  <option value="Yes" <?php echo set_select('status_approval_fund_received','Yes', ( !empty($tree_cutting[0]['status_approval_fund_received']) &&
                                      $get_utility_elec[0]['status_approval_fund_received'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_approval_fund_received','No', ( !empty($get_utility_elec[0]['status_approval_fund_received']) &&
                                      $get_utility_elec[0]['status_approval_fund_received'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_approval_fund_received','In Progress', ( !empty($get_utility_elec[0]['status_approval_fund_received']) &&
                                      $get_utility_elec[0]['status_approval_fund_received'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_approval_fund_received','N.A', ( !empty($get_utility_elec[0]['status_approval_fund_received']) &&
                                      $get_utility_elec[0]['status_approval_fund_received'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Approval Fund  </b>
                                    </p>
                                     <input  type="file" name="file_approval_fund_received" value="fileupload" id="uploadFile2" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_utility_elec[0]['file_approval_fund_received'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/utility_electrical/<?php echo $get_utility_elec[0]['file_approval_fund_received']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_approval_fund_received', '<div class="error">', '</div>'); ?>
                                </div>
                           
                                <div class="col-md-3">
                                    <p>
                                        <b>New Line Charged ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_new_line_charged">
                                  <option value="Yes" <?php echo set_select('status_new_line_charged','Yes', ( !empty($get_utility_elec[0]['status_new_line_charged']) &&
                                      $get_utility_elec[0]['status_new_line_charged'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_new_line_charged','No', ( !empty($get_utility_elec[0]['status_new_line_charged']) &&
                                      $get_utility_elec[0]['status_new_line_charged'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_new_line_charged','In Progress', ( !empty($get_utility_elec[0]['status_new_line_charged']) &&
                                      $get_utility_elec[0]['status_new_line_charged'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_new_line_charged','N.A', ( !empty($get_utility_elec[0]['status_new_line_charged']) &&
                                      $get_utility_elec[0]['status_new_line_charged'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / New line Charged </b>
                                    </p>
                                     <input  type="file" name="file_new_line_charged" value="fileupload" id="uploadFile3" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($get_utility_elec[0]['file_new_line_charged'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/utility_electrical/<?php echo $get_utility_elec[0]['file_new_line_charged']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_new_line_charged', '<div class="error">', '</div>'); ?>
                                </div>
                           
                                <div class="col-md-3">
                                    <p>
                                        <b>Tender Awarded ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="status_tender_awarded">
                                  <option value="Yes" <?php echo set_select('status_tender_awarded','Yes', ( !empty($get_utility_elec[0]['status_tender_awarded']) &&
                                      $get_utility_elec[0]['status_tender_awarded'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_tender_awarded','No', ( !empty($get_utility_elec[0]['status_tender_awarded']) &&
                                      $get_utility_elec[0]['status_tender_awarded'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_tender_awarded','In Progress', ( !empty($get_utility_elec[0]['status_tender_awarded']) &&
                                      $get_utility_elec[0]['status_tender_awarded'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_tender_awarded','N.A', ( !empty($get_utility_elec[0]['status_tender_awarded']) &&
                                      $get_utility_elec[0]['status_tender_awarded'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Tender Awarded </b>
                                    </p>
                                     <input  type="file" name="file_tender_awarded" value="fileupload" id="uploadFile4" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_utility_elec[0]['file_tender_awarded'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/utility_electrical/<?php echo $get_utility_elec[0]['file_tender_awarded']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_tender_awarded', '<div class="error">', '</div>'); ?>
                                </div> 
                            </div>
                              
                        </div>
                      </div>
                    
            <input type="hidden" name="file_joint_verification_hidden" value="<?php echo $get_utility_elec[0]['file_joint_verification']; ?>" />
        <input type="hidden" name="file_new_line_charged_hidden" value="<?php echo $get_utility_elec[0]['file_new_line_charged']; ?>" />
        <input type="hidden" name="file_approval_fund_received_hidden" value="<?php echo $get_utility_elec[0]['file_approval_fund_received']; ?>" />
        <input type="hidden" name="file_tender_awarded_hidden" value="<?php echo $get_utility_elec[0]['file_tender_awarded']; ?>" />    
                        
                      <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                       <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>No. of Poles Shifted </b>
                                    </p>
                              <input class="form-control txtQty" type="text" placeholder="poles shifted" name="progress_noof_poles_shifted" id="progress_noof_poles_shifted" value="<?php if(empty($get_utility_elec)){ echo set_value('progress_noof_poles_shifted'); }?><?php echo $get_utility_elec[0]['progress_noof_poles_shifted'] ?>">
                                     <?php echo form_error('progress_noof_poles_shifted', '<div class="error">', '</div>'); ?>
                                </div>
                                
                               <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                <input class="form-control txtQty limittxt_progress" type="text" value="<?php if(empty($get_utility_elec)){ echo set_value('progress'); }?><?php echo $get_utility_elec[0]['progress_%'] ?>" placeholder="Progress" name="progress">
                                <?php echo form_error('progress', '<div class="error">', '</div>'); ?>
                               </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Electrical Utility Shifting for A / A Done ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="progress_electrical_utility_shifting">
                                  <option value="Yes" <?php echo set_select('progress_electrical_utility_shifting','Yes', ( !empty($get_utility_elec[0]['progress_electrical_utility_shifting']) &&
                                      $get_utility_elec[0]['progress_electrical_utility_shifting'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('progress_electrical_utility_shifting','No', ( !empty($get_utility_elec[0]['progress_electrical_utility_shifting']) &&
                                      $get_utility_elec[0]['progress_electrical_utility_shifting'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('progress_electrical_utility_shifting','In Progress', ( !empty($get_utility_elec[0]['progress_electrical_utility_shifting']) &&
                                      $get_utility_elec[0]['progress_electrical_utility_shifting'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('progress_electrical_utility_shifting','N.A', ( !empty($get_utility_elec[0]['progress_electrical_utility_shifting']) &&
                                      $get_utility_elec[0]['progress_electrical_utility_shifting'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div> 
                            </div>
                             
                            <div class="row clearfix">   
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized  </b>
                                    </p>
                                     <input class="form-control txtQty" type="text" placeholder="Amount" name="progress_amount_utilised" value="<?php if(empty($get_utility_elec)){ echo set_value('progress_amount_utilised'); }?><?php echo number_format($get_utility_elec[0]['progress_amount_utilised'],2) ?>">
                                    <?php echo form_error('progress_amount_utilised', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p>
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="pre-construction fund Utilized" name="progress_fund_utilised" value="<?php if(empty($get_utility_elec)){ echo set_value('progress_fund_utilised'); }?><?php echo $get_utility_elec[0]['progress_fund_utilised'] ?>">
                                     <?php echo form_error('progress_fund_utilised', '<div class="error">', '</div>'); ?>
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <textarea class="form-control no-resize" rows="3" id="maxremarks" placeholder="Please type what you want..." name="remarks"><?php if(empty($get_utility_elec)){ echo set_value('remarks'); }?><?php echo $get_utility_elec[0]['remarks'] ?></textarea>

                                     <span id="warning-message" style='color:#ff0000'></span>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                </div>
                            </div> 
                          </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_utility_elec)) ? 'SAVE' : 'Update' ?>
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
          if(empty($utility_location_data)){
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
$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
    
});

 $("#poles_tobe_shifted").keyup(function() {
    //alert($(this).val());
    var poles_tobe_shifted_area = $(this).val();
    $("#poles_tobe_shifted_hidden").val(poles_tobe_shifted_area);
    //alert(poles_tobe_shifted_area);
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
$('#progress_noof_poles_shifted').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#poles_tobe_shifted_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#poles_tobe_shifted").val();
  }
  if ( parseInt(curval) > parseInt(hidden_area) ){
    alert("Number of Poles Shifted should less than Total Poles To be Shifted");
    $(this).val(0);
  }
});


</script>

<script type="text/javascript">

  
   var divid = <?php echo $cnt6; ?>;
   //alert(divid);
   var optionValues = $("#hidden_dist_fetch").html();

      $('#container1').on('click','#newField_' + divid, function () {
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-3"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="tehsilFunc('+divid+');">' + optionValues + '</select></div></div><div class="col-md-3"><div class=""><select name="division_id[]" id="division_id_'+divid+'"  class="form-control" onchange="discomFunc('+divid+');"></select></div></div><div class="col-md-3"><div class=""><select class="form-control select2" id="ulb_id_'+divid+'" name="discom_id['+ndiv+'][]" multiple="multiple" style="width: 100%;"></select></div></div><div class="col-md-3"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
      
      
                    

         $('#container1').append(newthing);
         $('.select2').select2();
    });
  

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
       $('#newAdd_'+id).remove();

        //var nextvar = $('#newAdd_'+id).next().attr('name');

        //$("#ulb_id_").next().attr('name');

        //alert('delete called');

    });
    
   
$('#tehsil_id_1').select2({dropdownAutoWidth : true});
$('#ulb_id_1').select2({dropdownAutoWidth : true});

</script>

<script type="text/javascript">
  function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_electrical/getelectrical_divison",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
      //alert(data);

      
      
      
                            var parsed_data = JSON.parse(data);
                            $("#division_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_divison.length);
                    if(parsed_data.all_divison.length > 0)
                    {

                               $("#division_id_"+divid).append("<option value=0>Please select Division</option>");
                               for (var i = 0; i < parsed_data.all_divison.length; i++)
                                      {
                    $("#division_id_"+divid).append("<option value='" + parsed_data.all_divison[i].id  + "'>" + parsed_data.all_divison[i]. division_name + "</option>");
                    $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#division_id_"+divid).append("<option  value=''>" +'Select Another Division' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}

 function discomFunc(divid) {
    var value = $('#division_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_electrical/getdiscom_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","division_id": value },
    
    success: function(data){

      
      
                            var parsed_data = JSON.parse(data);
                            
                            
                              $val_selec ='';
                            var listItems= "";
                    if(parsed_data.all_discom.length > 0)
                    {
                      $("#ulb_id_"+divid).empty();
                               for (var i = 0; i < parsed_data.all_discom.length; i++)
                                      {
                    $("#ulb_id_"+divid).append("<option  value='" + parsed_data.all_discom[i].id  + "'>" + parsed_data.all_discom[i]. discom_name + "</option>");
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#ulb_id_"+divid).append("<option  value=''>" +'All Discom' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
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
        font-weight: bold;
      }
    </style>