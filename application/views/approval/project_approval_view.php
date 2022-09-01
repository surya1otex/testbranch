<script src="<?php echo base_url();?>assets/js/project_approval.js"></script>
<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>
  <?php $CI =& get_instance();
   $CI->load->model('Project_approval_model');
  ?>
<?php
foreach ($project_details as $project) {
    $project_name = $project->project_name;
    $project_area_name = $project->area_name;
    $project_type_name = $project->project_type;
    $estimate_total_cost = $project->estimate_total_cost;
    $project_creator_id = $project->project_creator_id;
}

$creatorDetails = $CI->Project_approval_model->get_user_details_by_user_id($project_creator_id);

?>



<section class="content" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">

        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project Summary of <?php echo $project_name;?></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>Project Name : </td>
                                    <td><?php echo $project_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Location : </td>
                                    <td><?php echo $project_area_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Type : </td>
                                    <td><?php echo $project_type_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Estimated Cost : </td>
                                    <!-- <td><?php echo !empty($estimate_total_cost) ? $estimate_total_cost .' INR': ' TBD'; ?> </td> -->
                                    
                                    <td> <?php echo number_format($estimate_total_cost,2); ?></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

 <?php
						//echo "<pre>";
						//print_r($project_history);
						//echo "</pre>";
						?>
        <?php
   
        project_info($project_id);
   //die();

        ?>
        <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
        
                       
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                         <?php 
								if ($stage_id == 1) { // Project Conceptualisation 
								 $fund_lebel ="Fund Alloted For DPR";
								 $fund_text ="Fund Alloted For DPR";
								 $fund_heading ="Proposed Project";
								}
								elseif ($stage_id == 2) { // Identified Stackholders
								 $fund_lebel ="Fund Alloted For Identified Stackholders";
								 $fund_text ="Fund Alloted For Identified Stackholders";
								 $fund_heading ="Identified Stackholders";
									
								}
								elseif ($stage_id == 3) { // DPR
								 $fund_lebel ="Fund Alloted For pre-construction";
								 $fund_text ="Fund Alloted For pre-construction";
								 $fund_heading ="status of DPR";
									
								}
								elseif ($stage_id == 4) { // Pre Construction Activities
								 $fund_lebel ="Fund Alloted For Administrative Approval";
								 $fund_text ="Fund Alloted For Administrative Approval";
								 $fund_heading ="Pre Construction Activities";
									
								}
								elseif ($stage_id == 5) { // Administrative Approval
								 $fund_lebel ="Fund Alloted For Administrative Approval";
								 $fund_text ="Fund Alloted For Administrative Approval";
								 $fund_heading ="Administrative Approval";
									
								}
								elseif ($stage_id == 6) { // Tender Publishing
								 $fund_lebel ="Fund Alloted For Construction";
								 $fund_text ="Fund Alloted For Construction";
								 $fund_heading ="Tender Publishing";
									
								}
								?>
                            <h2>Approval <?php  echo $fund_heading; ?></h2>
                        </div>
            <?php
            $from_action = base_url().'project_approval/update_status?project_id='.base64_encode($project_id).'&stage_id='.base64_encode($stage_id);
            ?>
                        <form method="POST" action="<?php echo $from_action; ?>" enctype="multipart/form-data">
                             <input type="hidden" name="requester_id" value="<?php echo $project_creator_id; ?>">
                        <div class="body">
                            <div class="cloneBox1 m-b-15">
                            
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Requester </b>   
                                      
                                    </p>
                                    
                                    <input type="text" class="form-control" value="<?php echo $creatorDetails[0]['name']; ?>" disabled />

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Approval Date </b>   
                                      
                                    </p>
                                    <?php $val = (!empty($project_history[0]['approval_date'])) ? $project_history[0]['approval_date'] : $project_history[0]['approval_date']; 
									//if (!empty($project_history[0]['approval_date'])) { $val =$project_history[0]['approval_date']; } else {
										
										//$val = set_value('alloted_fund')
									
									
									
									?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                    
                                    <input type="text" name="approve_date"  value="<?php if (!empty($val)) { echo $val; } else {  echo set_value('approve_date');   } ?>"
                                                   class="datepicker form-control" placeholder="Approval date"/>
                                            <span style='color:#ff0000'><?php echo form_error('approve_date'); ?></span>

                                </div>
								<div class="col-md-4">
                               
                                    <p>
                                        <b> <?php echo $fund_lebel; ?></b>   
                                      
                                    </p>
                                   
                                    <input type="text" name="alloted_fund" class="form-control txtQty" value="<?php if (!empty($project_history[0]['alloted_fund'])) { echo $project_history[0]['alloted_fund']; } else { echo set_value('alloted_fund'); } ?>"  />
                                     <span style='color:#ff0000'><?php echo form_error('alloted_fund'); ?></span>

                                </div>
                                
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-4">
                                    <?php echo set_select('status_relinquishment_proposal','Yes', ( !empty($get_landalienation[0]['status_relinquishment_proposal']) &&
                                      $get_landalienation[0]['status_relinquishment_proposal'] == "Yes" ? TRUE : FALSE )); ?>
                                      
                                      
                                      
                                       <p><b>Decision Status<span class="col-pink">* </span></b></p>
                                    <select name="decission_status" class="form-control show-tick">
                                        <!-- <option value="">Select...</option> -->
                                        <option value="P" <?php echo set_select('decission_status','P', ( !empty($project_history[0]['approval_status']) && $project_history[0]['approval_status'] == "P" ? TRUE : FALSE )); ?> >Pending</option>
                                        <option value="I" <?php echo set_select('decission_status','I', ( !empty($project_history[0]['approval_status']) && $project_history[0]['approval_status'] == "I" ? TRUE : FALSE )); ?>>In Progress</option>
                                        <option value="Y" <?php echo set_select('decission_status','Y', ( !empty($project_history[0]['approval_status']) && $project_history[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Completed</option>
                                    </select>
 <span style='color:#ff0000'><?php echo form_error('decission_status'); ?></span>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Remarks </b>  
                                      
                                    </p>
                                    <textarea name="remarks" class="form-control no-resize" placeholder="Please Type What You Want..."><?php if (!empty($project_history[0]['remarks'])) { echo $project_history[0]['remarks']; } else { echo set_value('remarks'); } ?></textarea>

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Proof of Decision : (size limit maximum 50 MB)</b>
                                        (Extension allowed pdf, docx, xls, xlsx, jpg, jpeg, png)
                                
                                    </p>
                                    <input name="attachment" class="form-control" type="file" multiple />
                                    
                             <input type="hidden" name="hidden_attachment" value="<?php echo $project_history[0]['attachment']; ?>">
                                    <?php if (!empty($project_history[0]['attachment'])) { 
									$download_file_link = base_url().'uploads/attachment/'.$project_history[0]['attachment'];

									?>
                                    <a class="" download="" title="Download" href="<?php echo $download_file_link; ?>">
<i class="fas fa-download"></i>
Download
</a> <?php } ?>
                                     <span style='color:#ff0000'><?php echo $file_upload_error; ?></span>

                                </div>
                             </div>
                            
                        
                        
                        </div>
                        <div class="col-md-12 align-center">
                        
                        
                        <a href="<?php echo base_url().'project_approval/pip'; ?>" class="btn btn-warning waves-effect">CANCEL</a>
                         <?php if (!empty($project_history[0]['id'])) { ?>
                         
                             <input type="hidden" name="project_approval_Tid" value="<?php echo $project_history[0]['id']; ?>">
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="Update">Update</button>
                        <?php } else { ?>
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="Submit">SAVE</button>
                        <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        </div>
                    </form>

                          </div>
                      </div>
                  </div>

        
        </div>

    </div>

</section>
<script type="application/javascript">
$(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
</script>

   <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>
