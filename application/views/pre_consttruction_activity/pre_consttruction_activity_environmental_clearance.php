    
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
                  
<?php echo form_open_multipart('Pre_consttruction_activity_environmental_clearance/manage', array('name' => 'pre_consttruction_activity_environmental_clearance','id' => 'pre_consttruction_activity_environmental_clearance')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card">
                        <div class="header">
                            <h2> Environmental Clearance </h2>
                        </div>

                      <div class="body">
                          <div class="row clearfix">
                             <div class="col-md-4">
                                <p>
                                    <b>Target End Date <span class="col-pink">* </span></b>
                                 </p>
                                 <input type="text" class="datepicker form-control" placeholder="Please choose a date..." name="target_end_date" value="<?php if(empty($get_env_clearance)){ echo set_value('target_end_date'); }?><?php echo $get_env_clearance[0]['target_end_date'] ?>">
                                 <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>
                              </div>
                           </div>
   
                        </div>
                     </div>
                    
                        
                    <div class="card"> 
                          <div class="header">
                            <h2> Status of Key Milestones</h2>
                          </div>  
                         
                       <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>EIA And TORS Prepared ?</b>
                                    </p>
                                     <select class="form-control show-tick" name="status_EIA">
                                      <option value="Yes" <?php echo set_select('status_EIA','Yes', ( !empty($get_env_clearance[0]['status_EIA']) &&
                                      $get_env_clearance[0]['status_EIA'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_EIA','No', ( !empty($get_env_clearance[0]['status_EIA']) &&
                                      $get_env_clearance[0]['status_EIA'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_EIA','In Progress', ( !empty($get_env_clearance[0]['status_EIA']) &&
                                      $get_env_clearance[0]['status_EIA'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_EIA','N.A', ( !empty($get_env_clearance[0]['status_EIA']) &&
                                      $get_env_clearance[0]['status_EIA'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / EIA And TORS </b>
                                    </p>
                                     <input  type="file" value="fileupload" id="uploadFile1" name="file_EIA" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($get_env_clearance[0]['file_EIA'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/env_clearance/<?php echo $get_env_clearance[0]['file_EIA']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_EIA', '<div class="error">', '</div>'); ?>
                                </div>
                             
                                <div class="col-md-3">
                                    <p>
                                        <b>Online Application Submitted ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="status_online_application">
                                      <option value="Yes" <?php echo set_select('status_online_application','Yes', ( !empty($get_env_clearance[0]['status_online_application']) &&
                                      $get_env_clearance[0]['status_online_application'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_online_application','No', ( !empty($get_env_clearance[0]['status_online_application']) &&
                                      $get_env_clearance[0]['status_online_application'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_online_application','In Progress', ( !empty($get_env_clearance[0]['status_online_application']) &&
                                      $get_env_clearance[0]['status_online_application'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_online_application','N.A', ( !empty($get_env_clearance[0]['status_online_application']) &&
                                      $get_env_clearance[0]['status_online_application'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Application  </b>
                                    </p>
                                     <input  type="file"  value="fileupload" id="uploadFile2" name="file_application" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                      <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($get_env_clearance[0]['file_application'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/env_clearance/<?php echo $get_env_clearance[0]['file_application']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_application', '<div class="error">', '</div>'); ?> 
                                </div>
                           </div>
                           <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>OSCPCB Scrutiny Completed ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="status_OSCPCB_scrunity">
                                     <option value="Yes" <?php echo set_select('status_OSCPCB_scrunity','Yes', ( !empty($get_env_clearance[0]['status_OSCPCB_scrunity']) &&
                                      $get_env_clearance[0]['status_OSCPCB_scrunity'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_OSCPCB_scrunity','No', ( !empty($get_env_clearance[0]['status_OSCPCB_scrunity']) &&
                                      $get_env_clearance[0]['status_OSCPCB_scrunity'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_OSCPCB_scrunity','In Progress', ( !empty($get_env_clearance[0]['status_OSCPCB_scrunity']) &&
                                      $get_env_clearance[0]['status_OSCPCB_scrunity'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_OSCPCB_scrunity','N.A', ( !empty($get_env_clearance[0]['status_OSCPCB_scrunity']) &&
                                      $get_env_clearance[0]['status_OSCPCB_scrunity'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / OSCPCB Scrutiny  </b>
                                    </p>
                                     <input  type="file"  value="fileupload" id="uploadFile3" name="file_OSCPCB" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                      <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($get_env_clearance[0]['file_OSCPCB'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/env_clearance/<?php echo $get_env_clearance[0]['file_OSCPCB']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_OSCPCB', '<div class="error">', '</div>'); ?> 
                                </div>
                           
                                <div class="col-md-3">
                                    <p>
                                        <b>EC Received ? </b>
                                    </p>
                                    <select class="form-control show-tick" name="status_ec_received">
                                     <option value="Yes" <?php echo set_select('status_ec_received','Yes', ( !empty($get_env_clearance[0]['status_ec_received']) &&
                                      $get_env_clearance[0]['status_ec_received'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_ec_received','No', ( !empty($get_env_clearance[0]['status_ec_received']) &&
                                      $get_env_clearance[0]['status_ec_received'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_ec_received','In Progress', ( !empty($get_env_clearance[0]['status_ec_received']) &&
                                      $get_env_clearance[0]['status_ec_received'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_ec_received','N.A', ( !empty($get_env_clearance[0]['status_ec_received']) &&
                                      $get_env_clearance[0]['status_ec_received'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / EC </b>
                                    </p>
                                     <input  type="file"  value="fileupload" id="uploadFile4" name="file_EC" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                <?php if (!empty($get_env_clearance[0]['file_EC'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/env_clearance/<?php echo $get_env_clearance[0]['file_EC']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_EC', '<div class="error">', '</div>'); ?> 
                                </div>
                           
                                <div class="col-md-3">
                                    <p>
                                        <b>Fund for EC Deposite ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_fund_for_ec">
                                     <option value="Yes" <?php echo set_select('status_fund_for_ec','Yes', ( !empty($get_env_clearance[0]['status_fund_for_ec']) &&
                                      $get_env_clearance[0]['status_fund_for_ec'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>
                                        <option value="No" <?php echo set_select('status_fund_for_ec','No', ( !empty($get_env_clearance[0]['status_fund_for_ec']) &&
                                      $get_env_clearance[0]['status_fund_for_ec'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                        <option value="In Progress" <?php echo set_select('status_fund_for_ec','In Progress', ( !empty($get_env_clearance[0]['status_fund_for_ec']) &&
                                      $get_env_clearance[0]['status_fund_for_ec'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="N.A" <?php echo set_select('status_fund_for_ec','N.A', ( !empty($get_env_clearance[0]['status_fund_for_ec']) &&
                                      $get_env_clearance[0]['status_fund_for_ec'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                      </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Fund Deposite </b>
                                    </p>
                                     <input  type="file"  value="fileupload" id="uploadFile5" name="file_fund_deposit" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($get_env_clearance[0]['file_fund_deposit'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/env_clearance/<?php echo $get_env_clearance[0]['file_fund_deposit']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                     <?php echo form_error('file_fund_deposit', '<div class="error">', '</div>'); ?> 
                                </div>
            <input type="hidden" name="file_EIA_hidden" value="<?php echo $get_prvatelandla[0]['file_EIA']; ?>" />
        <input type="hidden" name="file_application_hidden" value="<?php echo $get_prvatelandla[0]['file_application']; ?>" />
        <input type="hidden" name="file_OSCPCB_hidden" value="<?php echo $get_prvatelandla[0]['file_OSCPCB']; ?>" />
        <input type="hidden" name="file_EC_hidden" value="<?php echo $get_prvatelandla[0]['file_EC']; ?>" />
       <input type="hidden" name="file_fund_deposit_hidden" value="<?php echo $get_prvatelandla[0]['file_fund_deposit']; ?>" />
                               <div class="col-md-6">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <textarea class="form-control no-resize" rows="3" id="maxremarks" placeholder="Please type what you want..." name="remarks"><?php if(empty($get_env_clearance)){ echo set_value('remarks'); }?><?php echo $get_env_clearance[0]['remarks'] ?></textarea>
                                     <span id="warning-message" style='color:#ff0000'></span>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                              
                           </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_env_clearance)) ? 'SAVE' : 'Update' ?>
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

    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- #Main Content -->
  <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
      });



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
        font-weight: bold;
      }
    </style>