<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>

<?php $CI =& get_instance(); ?>

<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-t-20">
                <?php if($this->session->flashdata('message')){?>
                                  <div class="alert alert-success fade-message">      
                                    <?php echo $this->session->flashdata('message')?>
                                  </div>
                                <?php } ?>
<input type="hidden" id="project_id" value="<?php echo $project_id; ?>">
                


                <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 


                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="p-10 bg-deep-blue-grey">
                                <h2>Closing Details</h2>
                                
                                <?php // print_r($gov_app_att); ?>
                            </div>
                            <div class="body p-10">

                                <form method="POST" action="<?php echo base_url().'Commissioning/add_details?project_id='.base64_encode($project_id); ?>" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">  
                                    <div class="col-md-4">

                                      <p>
                                            <b>Construction Completion Certificate issued on <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="Construction Completion Certificate issued on" name="certificate_issued_date" id="com_date" value="<?php echo $certificate_issued_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('certificate_issued_date'); ?></span>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <b>Construction Completion Certificate <span class="col-pink">* </span></b>
                                       </p>
                                    
                                     
                                      
                                        <input type="file" class="form-control" name="construction_completion_certificate">
                                        <?php 
                                        if($comp_count > 0){
                                          ?>
                                        <a href="<?php echo base_url().'uploads/commission/'.$construction_completion_certificate; ?>" target="_blank">Last Uploaded File</a>
                                      <?php } ?>
                                            <span style='color:#ff0000'><?php echo form_error('construction_completion_certificate'); ?></span>
                                    
                                    </div>

                                    
                                   
                                    <div class="col-md-4">
                                        <p>
                                            <b>Final Payment done <span class="col-pink">* </span></b>
                                       </p>
                                       <select class="form-control show-tick" name="final_payment_status">
                                          <option value="Y" <?php if($final_payment_status == 'Y'){ echo "selected";} ?>>Yes</option>
                                          <option value="N" <?php if($final_payment_status == 'N'){echo "selected"; } ?>>No</option>
                                        </select>

                                        <span style='color:#ff0000'><?php echo form_error('final_payment_status'); ?></span> 
                                    </div>
                                </div>
                            </div>




                        <div class="row clearfix">

                               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">           

                                    
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>Final Payment Date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="Final Payment Date" name="final_payment_date" id="com_date" value="<?php echo $final_payment_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('final_payment_date'); ?></span>
                                        
                                    </div>

                                   
                                   
                                    <div class="col-md-4">
                                        <p>
                                            <b>APS, if applicable <span class="col-pink">* </span></b>
                                       </p>
                                       <select class="form-control show-tick" name="APS_status" id="APS_status">
                                          <option value="Y" <?php if($APS_status == 'Y'){ echo "selected";} ?>>Yes</option>
                                          <option value="N" <?php if($APS_status == 'N'){ echo "selected";} ?>>No</option>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('APS_status'); ?></span>
                                        
                                    </div>

                                    
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>Retention amount released <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="form-control"
                                                   placeholder="Retention amount released" name="release_retention_amount" value="<?php echo $release_retention_amount; ?>" onkeypress="return validateFloatKeyPress(this,event);"
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('release_retention_amount'); ?></span>
                                        
                                    </div>
                                    
                             
                            </div>
                        </div>

                            

                            <div class="row clearfix">
                                   <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">  
                                    
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>Retention amount on hold <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="form-control"
                                                   placeholder="Retention amount on hold" name="hold_retention_amount" value="<?php echo $hold_retention_amount; ?>" onkeypress="return validateFloatKeyPress(this,event);"
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('hold_retention_amount'); ?></span>
                                        
                                    </div>

                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>DLP Starting Date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="DLP Starting Date" name="DLP_starting_date" id="DLP_starting_date" value="<?php echo $DLP_starting_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('DLP_starting_date'); ?></span>
                                        
                                    </div>
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>Final PBG Returning Date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="Final PBG Returning Date" name="PBG_returning_date" id="PBG_returning_date" value="<?php echo $PBG_returning_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('PBG_returning_date'); ?></span>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                   <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">  
                                    
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>PBG Value at Return Date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="PBG Value at Return Date" name="PBG_return_date" id="PBG_return_date" value="<?php echo $PBG_return_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('PBG_return_date'); ?></span>
                                        
                                    </div>
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b>Balance Retention amount release date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="Balance Retention amount release date" name="retention_release_date" id="retention_release_date" value="<?php echo $retention_release_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('retention_release_date'); ?></span>
                                        
                                    </div>
                                     
                                      <div class="col-md-4">
                                        <p>
                                            <b> Project Closure Date <span class="col-pink">* </span></b>
                                       </p>
                                        <input type="text" class="datepicker form-control"
                                                   placeholder="Project Closure Date" name="completion_date" id="completion_date" value="<?php echo $completion_date; ?>" 
                                                   >
                                            <span style='color:#ff0000'><?php echo form_error('completion_date'); ?></span>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                   <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">  
                                   
                                    <div class="col-md-4">
                                        <p>
                                            <b> Remarks </b>
                                       </p>
                                       <div class="form-line">
                                          <!-- <input type="text" class="form-control" name="remarks" placeholder="Remarks" /> -->
                                          <textarea name="remarks" class="form-control" cols="4"><?php echo $remarks;?></textarea>
                                      </div>

                                        
                                    </div> 

                                    

                                    
                                </div>
                            </div>

                            
                  
                            <div class="text-center">
                                <a href="<?php echo base_url();?>Commissioning/project_list" class="btn btn-warning waves-effect">CANCEL</a>
                                        <button type="submit" class="btn btn-primary waves-effect" name="submit" value="Submit">
                                                   <?php if($comp_count < 1){ echo 'Submit'; }else{ echo 'Update'; } ?>
                                        </button>
                                    </div>
                              
                             
                        </form>
                        </div>

                    </div>
                </div>

                </div>

          

            </div>

            <!-- #END# Input -->

            <!-- Select -->

            <!-- </div> -->
            </div>
            </div>
            
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
      });
    </script>
<script>
        

   

function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}
</script>
<!-- For vendor -->

   