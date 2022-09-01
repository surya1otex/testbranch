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

<section class="content" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">

        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project Summary of <?php echo $project_details[0]['project_name'];?></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>Project Name : </td>
                                    <td><?php echo $project_details[0]['project_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Area : </td>
                                    <td><?php echo $project_area_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Type : </td>
                                    <td><?php echo $project_type_name; ?></td>
                                </tr>
                                <tr>
                                    <td>Estimated Cost : </td>
                                    <td><?php echo !empty($project_details[0]['estimate_total_cost']) ? $project_details[0]['estimate_total_cost'] .'INR': 'TBD'; ?> </td>
                                </tr>
                                <tr>
                                    <td>Start Date : </td>
                                    <td>
                                        <?php if(!empty($project_details[0]['project_start_date'])){?>
                                            <?php $start_date = new DateTime($project_details[0]['project_start_date']);
                                            echo $start_date->format('jS M Y'); ?>

                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date : </td>
                                    <td>
                                        <?php if( !empty($project_details[0]['project_end_date']) ){  ?>
                                            <?php $end_date = new DateTime($project_details[0]['project_end_date']);
                                            echo $end_date->format('jS M Y'); ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix ">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>Project <?php echo $tittle;  ?> Form  </h4>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo $project_details[0]['project_name']; ?> </h2>
                    </div>
                    <div class="body">
                        <?php echo form_open_multipart('Project/submit_approval',array('name'=> 'submit_approval')); ?>
                        <input type="hidden" name="request_id" value="<?php echo $_REQUEST['request_id'];?>" />
                        <input type="hidden" name="request_type" value="<?php echo base64_encode($tittle) ;?>" />
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;"> Project Requester  : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php echo $request['requester']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class=" input-xlarge"  style="vertical-align:middle; padding-top:8px;"><?php echo $tittle; ?> Date : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['approve_date'])) ? $_REQUEST['approve_date'] : $result_tender['approve_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="approve_date" required="" value="<?php echo $val; ?>"
                                                   class="datepicker form-control" placeholder="<?php echo $tittle; ?> date"/>
                                            <span style='color:#ff0000'><?php echo form_error('approve_date'); ?></span>
                                        </div>
                                    </div>

                                </div>
                                <?php if($tittle != 'Reject'){ ?>
                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Planning Approvers :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <select name="planning_approver" class="form-control show-tick">
                                                <option value="">Please Select</option>
                                                <?php foreach ($planning_approvers as $approver ){ ?>
                                                    <?php $name = $approver['name']. " - ".$approver['designation']; ?>

                                                    <option value="<?php  echo $approver['id'] ?>" > <?php echo $name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span style='color:#ff0000'><?php echo form_error('planning_approver'); ?></span>
                                        </div>
                                    </div>
                                </div>
                               <?php } ?>
                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <textarea name="remarks" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Attachment, if any :
                                        </label>
                                    </div>
                                    <form action="/" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <input name="attachment" type="file" multiple />
                                            <span style='color:#ff0000'><?php echo $file_upload_error; ?></span>
                                        </div>
                                    </div>
                                    </form>
                                </div>

                            </div>

                            <div class="col-md-2 col-md-offset-5 text-center" style="margin-top: -21px;">
                                <!--<a href="#"  class="btn bg-blue waves-effect"><span> SUBMIT </span></a>-->
                                <input type="submit" name="submit" value="SUBMIT" class="btn bg-blue waves-effect" />
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
