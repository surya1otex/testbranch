<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>
<script src="<?php echo base_url();?>assets/js/tender_stage.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/tender_stage.css"/>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>INITIATION & PROCUREMENT</h4>
        </div>
        <!-- Input -->


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> Project Details</h2>
                    </div>

                    <div class="body p-b-0 align-center">

                        <ul class="steps">
                            <?php  if($steps_status_arr['basic_stage']){ ?>
                                <li class="complete">
                                <?php } else { ?>
                                    <li class="past">
                                <?php } ?>
                                <span>
                                  <strong>Stage 1</strong>
                                  Project’s basic information
                                </span><i></i>
                            </li>
                            <?php  if($steps_status_arr['pre_tender_stage']){ ?>
                            <li class="complete">
                                <?php } else { ?>
                            <li class="present">
                                <?php } ?>
                                <span>
                                  <strong>Stage 2</strong>
                                  Pre-tender stage
                                </span><i></i>
                            </li>
                            <?php  if($steps_status_arr['tender_stage']){ ?>
                            <li class="complete">
                                <?php } else { ?>
                            <li class="future">
                                <?php } ?>
                                <span>
                                  <strong>Stage 3</strong>
                                    Tender stage
                                  </span><i></i>
                            </li>
                            <?php  if($steps_status_arr['agreement_stage']){ ?>
                            <li class="complete">
                                <?php } else { ?>
                            <li class="future">
                                <?php } ?>
                                <span>
                                  <strong>Stage 4</strong>
                                    Agreement stage
                                  </span><i></i>
                            </li>
                        </ul>
                    </div>
                    

                    <div class="body">
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">
                                <?php include('tab_content.php') ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

		
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                            <h2>
                                Pre-tender stage 
                            </h2>
                            
                        </div>
                        
                    <div class="body">
                    
                        <div class="section_clone">
                                <?php if(!empty($project_id)) {?>
                                    <?php echo form_open('Project/pre_tender_stage?project_id='.base64_encode($project_id),array('name'=> 'pre_tender_stage','id'=> 'pre_tender_stage')); ?>
                                    <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
                                    <input type="hidden" name="tender_id" value="<?php echo base64_encode($tender_id); ?>" />
                                <?php }else{
                                    echo form_open('Project/pre_tender_stage', array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage'));
                                } ?>
                            <div class="row clearfix cloneBox1">

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Tender call Number :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['tender_call_no'])) ? $_REQUEST['tender_call_no'] : $result['tender_call_no']; ?>
                                            <input type="text" name="tender_call_no"  value="<?php echo $val;  ?>" class="form-control" placeholder="Tender call number" />
                                            <span style='color:#ff0000'><?php echo form_error('tender_call_no'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Date of Tender Approval<span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['tender_document_approval_date'])) ? $_REQUEST['tender_document_approval_date'] : $result['tender_document_approval_date']; ?>
                                            <?php if($val == '0000-00-00') {$val = '';} ?>
                                            <input type="text" name="tender_document_approval_date" value="<?php echo $val;?>" class="datepicker form-control" placeholder="Please choose a date..." />
                                            <span style='color:#ff0000'><?php echo form_error('tender_document_approval_date'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Tender Document Approval:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <?php $checked=''; if($result['tender_document_approved'] == 'Y'){ $checked = "checked";}?>
                                        <select name="tender_document_approved" class="form-control show-tick">
                                            <option value="NA">NA</option>
                                            <option value="Y" <?php if(!empty($result['tender_document_approved']) && $result['tender_document_approved']== 'Y'){echo "selected";}?> >YES</option>
                                            <option value="N" <?php if(!empty($result['tender_document_approved']) && $result['tender_document_approved']== 'N'){echo "selected";}?>>NO </option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>RFP publish date :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['rfp_publishing_date'])) ? $_REQUEST['rfp_publishing_date'] : $result['rfp_publishing_date']; ?>
                                            <?php if($val == '0000-00-00') {$val = '';} ?>
                                            <input type="text" name="rfp_publishing_date" value="<?php echo $val; ?>" class="datepicker form-control" placeholder="Please choose a date..." />
                                            <span style='color:#ff0000'><?php echo form_error('rfp_publishing_date'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>RFP closing date :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['rfp_closing_date'])) ? $_REQUEST['rfp_closing_date'] : $result['rfp_closing_date']; ?>
                                            <?php if($val == '0000-00-00') {$val = '';} ?>
                                            <input  type="text" class="datepicker form-control" placeholder="RFP closing date" value="<?php echo $val; ?>" name="rfp_closing_date" id="start_date" >
                                            <span style='color:#ff0000'><?php echo form_error('rfp_closing_date'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Re-Tender :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select id="re_tender_status" name="re_tender_status" class="form-control show-tick">
                                            <option value="NA">NA</option>
                                            <option value="Y" <?php if(!empty($result['re_tender_status']) && $result['re_tender_status']== 'Y'){echo "selected";} ?> >YES</option>
                                            <option value="N" <?php if(!empty($result['re_tender_status']) && $result['re_tender_status']== 'N'){echo "selected";} ?>>NO </option>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['remarks_pre_tender'])) ? $_REQUEST['remarks_pre_tender'] : $result['remarks_pre_tender']; ?>
                                            <textarea class="form-control no-resize" name="remarks_pre_tender" placeholder="Please type what you want..."><?php echo trim($val); ?></textarea>
                                            <span style='color:#ff0000'><?php /*echo form_error('remarks_for_retender'); */?></span>
                                        </div>
                                    </div>
                                    <div id="reason_retender_label" class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Reason for Re-tender:
                                        </label>
                                    </div>

                                    <div id="reason_retender_field" class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['remarks_for_retender'])) ? $_REQUEST['remarks_for_retender'] : $result['remarks_for_retender']; ?>
                                            <textarea id="remarks_for_retender" class="form-control no-resize" name="remarks_for_retender" placeholder="Please type what you want..."><?php echo $val; ?></textarea>
                                            <span id="err_span" style='color:#ff0000'><?php /*echo form_error('remarks_for_retender'); */?></span>
                                        </div>
                                    </div>
                                </div>

                           	
                            </div>
                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <?php $btnName = "Save";  if(!empty($id)) { $btnName = "Save"; }?>
                                <?php $link = site_url().'/Project/tender_stage?project_id='.base64_encode($project_id)?>
                                <button onclick="checkSubmitStatus(event );" class="btn bg-indigo waves-effect" type="submit"> <?php echo $btnName; ?></button>
                                <?php $disble = '' ;if(!$submit_status){ $disble = 'disabled="disabled"'; $link="javascript:void(0);"; } ?>

                                <a class="btn bg-indigo waves-effect"  href="<?php echo $link ?>"  <?php echo $disble; ?> > Next </a>
                            </div>
                            	
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
         </div>

        <!-- Select -->

    </div>
</section>
<script>

</script>