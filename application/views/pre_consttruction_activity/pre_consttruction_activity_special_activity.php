<link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />    
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>Pre Project Initiation </h4>
            </div>
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
          <!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-cog"></i></span>
                          <span class="label">Initial Project Profile</span>
                        </a>
                    </li>
                    
                    <li class="completed">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">DPR Updation</span>
                        </a>
                    </li>
                    
                    <li class="active">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-check-square"></i></span>
                          <span class="label">Pre Construction Activities</span>
                        </a>
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
    <!-- Quick Nav Start -->   
<?php project_quick_nav($project_id);  ?>        
<!-- Quick Nav end -->   
 <?php echo form_open_multipart('Pre_consttruction_activity_special_activity/manage', array('name' => 'pre_consttruction_activity_special_activity','id' => 'pre_consttruction_activity_special_activity')); ?>
 
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />      
            
            
            
      <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Special Activities </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Name <span class="col-pink">*</span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                          <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                                    <?php $val = (!empty($_REQUEST['name'])) ? $_REQUEST['name'] : $special_activity[0]['name']; ?>
                                    <input class="form-control" type="text" value="<?php echo $val; ?>" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b> Status Update <span class="col-pink">* </span></b>
                                    </p>
                                     <select class="form-control show-tick" name="updated_status">
                                        <option value="started" <?php if ((!empty($special_activity[0]['updated_status']) && $special_activity[0]['updated_status'] == "started") || $_REQUEST['updated_status'] == "started") {
                                            echo "selected";
                                        } ?>>Started</option>
                                        <option value="In Progress" <?php if ((!empty($special_activity[0]['updated_status']) && $special_activity[0]['updated_status'] == "In Progress") || $_REQUEST['updated_status'] == "In Progress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="completed" <?php if ((!empty($special_activity[0]['updated_status']) && $special_activity[0]['updated_status'] == "completed") || $_REQUEST['updated_status'] == "completed") {
                                            echo "selected";
                                        } ?>>Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date <span class="col-pink">* </span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i> 
                                            <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                                    <?php $val = (!empty($_REQUEST['target_end_date'])) ? $_REQUEST['target_end_date'] : $special_activity[0]['target_end_date']; ?>
                                     <input type="text" class="datepicker form-control" name="target_end_date" value="<?php echo $val; ?>" placeholder="Please choose a date...">
                                </div>
                              </div>
                              <div class="row clearfix">
                                <div class="col-md-4">
                                    <p><b> Executing Agency<span class="col-pink">* </span></b></p>
                                    <select class="form-control show-tick" name="executing_agency">
                                      <option value="0">Select Agency</option>
                             <?php 
                              foreach ($agency as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->user_id; ?>" <?php
                                        if ((!empty($special_activity[0]['executing_agency']) && $special_activity[0]['executing_agency'] == $Tvalue->user_id) || $_REQUEST['executing_agency'] == $Tvalue->user_id) {
                                            echo "selected";
                                        } ?> ><?php echo $Tvalue->username; ?></option>

                              <?php } ?>
                                    </select>
                                </div>
                                 <div class="col-md-4">
                                    <p>
                                        <b>Description <span class="col-pink">*</span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                          <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                                    <?php $val = (!empty($_REQUEST['description'])) ? $_REQUEST['description'] : $special_activity[0]['description']; ?>
                                   <textarea class="form-control no-resize" rows="3" name="description" placeholder="Please enter Description"><?php echo $val; ?></textarea>
                                </div>

                             </div>
                        
                           </div>
                        </div>
                    
                        
                    <div class="card"> 
                          <div class="header">
                            <h2> Documents of Special Activity</h2>
                          </div>  
                         
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                
                                <div class="col-md-6">
                                    <p> <b>Documents /  Implementation Order  <span class="col-pink">* </span></b> </p>
                                     <input  type="file" name="document" value="fileupload" id="uploadFile1">
                                      <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                     <?php if(!empty($special_activity[0]['document'])) { ?>
                   <?php $file_link1 = base_url().'uploads/files/special_activity/'.$special_activity[0]['document']; ?>
                                     <a href="<?php echo $file_link1; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <p> <b>Delay/Issues in implementation  <span class="col-pink">* </span></b> </p>
                                     <input  type="file" name="issue_related_document" value="fileupload" id="uploadFile2">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p> 
                                     <?php if(!empty($special_activity[0]['issue_related_document'])) { ?>
                   <?php $file_link2 = base_url().'uploads/files/special_activity/'.$special_activity[0]['issue_related_document']; ?>
                                     <a href="<?php echo $file_link2; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                              </div>  
                            </div>
<input type="hidden" name="document_hidden" value="<?php echo $special_activity[0]['document']; ?>" />
<input type="hidden" name="issue_related_document_hidden" value="<?php echo $special_activity[0]['issue_related_document']; ?>" />
                          <div class="col-md-12  align-center">
                              <button class="btn btn-primary waves-effect" name="submit" value="Submit" type="submit">SAVE</button>
                           </div>
                           <div class="clearfix"></div>
                          </div>
                        </div>


                 </div>
                

            <!-- Select -->
            </div>
        </div>
      </form>
    </section>
    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
      });

          for(let i=1; i<= 2; i++) {
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
    </script>