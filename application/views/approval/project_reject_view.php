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
                                    <td><?php echo !empty($estimate_total_cost) ? $estimate_total_cost .'INR': 'TBD'; ?> </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
   
        project_info($project_id);
   //die();

        ?>

        
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Project Reject Form</h2>
                        </div>
                        <?php
            $from_action = base_url().'project_approval/reject?project_id='.base64_encode($project_id).'&stage_id='.base64_encode($stage_id);
            ?>
                        <form method="POST" action="<?php echo $from_action; ?>" enctype="multipart/form-data">
                             <input type="hidden" name="requester_id" value="<?php echo $project_creator_id; ?>">
                        <div class="body">
                            <div class="cloneBox1 m-b-15">
                            
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Requester </b>   <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Project Requester info</span>
                                        </span>
                                      
                                    </p>
                                    
                                    <input type="text" class="form-control" value="<?php echo $creatorDetails[0]['name']; ?>" disabled />

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Reject Date <span class="col-pink">* </span></b>   <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Reject Date</span>
                                        </span>
                                      
                                    </p>
                                    <?php $val = (!empty($_REQUEST['approve_date'])) ? $_REQUEST['approve_date'] : $result_tender['approve_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                    
                                    <input type="text" name="approve_date" required="" value="<?php echo $val; ?>"
                                                   class="datepicker form-control" placeholder="Reject date"/>
                                            <span style='color:#ff0000'><?php echo form_error('approve_date'); ?></span>

                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <b>Remarks, if any : </b>   <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Remarks</span>
                                        </span>
                                      
                                    </p>
                                    <textarea name="remarks" class="form-control no-resize" placeholder="Please type what you want..."></textarea>

                                </div>
                                
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Attachment, if any : <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Supporing Attachment</span>
                                        </span></b>
                                    </p>
                                    <input name="attachment" class="form-control" type="file" multiple />
                                     <span style='color:#ff0000'><?php echo $file_upload_error; ?></span>

                                </div>
                             </div>
                            
                        
                        
                        </div>
                        <div class="col-md-12 align-center">
                        
                        
                        <a href="<?php echo base_url().'project_approval/pip'; ?>" class="btn btn-warning waves-effect">CANCEL</a>
                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="Submit">SAVE</button>
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
