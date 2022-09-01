<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/tender_stage_final.css"/>

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
                            <?php if ($steps_status_arr['basic_stage']){ ?>
                        <li class="complete">
                        <?php } else { ?>
                            <li class="past">
                                <?php } ?>
                                <span>
                                  <strong>Stage 1</strong>
                                  Project’s basic information
                                </span><i></i>
                            </li>
                            <?php if ($steps_status_arr['pre_tender_stage']){ ?>
                        <li class="complete">
                        <?php } else { ?>
                            <li class="past">
                                <?php } ?>
                                <span>
                                  <strong>Stage 2</strong>
                                  Pre-tender stage
                                </span><i></i>
                            </li>
                            <?php if ($steps_status_arr['tender_stage']){ ?>
                        <li class="complete">
                        <?php } else { ?>
                            <li class="present">
                                <?php } ?>
                                <span>
                                  <strong>Stage 3</strong>
                                    Tender stage
                                  </span><i></i>
                            </li>
                            <?php if ($steps_status_arr['agreement_stage']){ ?>
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
                                 Tender stage 
                            </h2>
                            
                        </div>
                        
                    <div class="body">
                        <div class="section_clone">
                           <?php if (!empty($project_id)) { ?>
                                    <?php echo form_open('Project/tender_stage?project_id=' . base64_encode($project_id), array('name' => 'tender_stage', 'id' => 'pre_tender_stage')); ?>
                                    <input type="hidden" name="project_id"
                                           value="<?php echo base64_encode($project_id); ?>"/>
                                    <input type="hidden" name="tender_id"
                                           value="<?php echo base64_encode($tender_id); ?>"/>
                                <?php } else {
                                    echo form_open('Project/tender_stage', array('name' => 'tender_stage', 'id' => 'tender_stage'));
                                } ?>
                            <div class="row clearfix cloneBox1">
                         
                                <!--
                                <div class="col-sm-12">
                                
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            Revised RFP publish date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['revised_rfp_publish_date'])) ? $_REQUEST['revised_rfp_publish_date'] : $result_tender['revised_rfp_publishing_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="revised_rfp_publish_date"
                                                   value="<?php echo $val; ?>" class="datepicker form-control"
                                                   placeholder="Final date of RFP publishing"/>
                                            <span style='color:#ff0000'><?php echo form_error('revised_rfp_publish_date'); ?></span>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            Revised RFP closing date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php

                                            $val = (!empty($_REQUEST['revised_rfp_closing_date'])) ? $_REQUEST['revised_rfp_closing_date'] : $result_tender['revised_rfp_closing_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="revised_rfp_closing_date"
                                                   value="<?php echo $val; ?>" class="datepicker form-control"
                                                   placeholder="Final date of RFP closing"/>
                                            <span style='color:#ff0000'><?php echo form_error('revised_rfp_closing_date'); ?></span>
                                        </div>
                                    </div>


                                </div>
                                -->

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Final RFP publish date :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['final_date_rfp_publish '])) ? $_REQUEST['final_date_rfp_publish '] : $result_tender['final_date_rfp_publish']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="final_date_rfp_publish" value="<?php echo $val; ?>"
                                                   class="datepicker form-control"
                                                   placeholder="Please choose a date..."/>
                                            <span style='color:#ff0000'><?php echo form_error('final_date_rfp_publish'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Final RFP closing date :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php

                                            $val = (!empty($_REQUEST['final_date_rfp_close'])) ? $_REQUEST['final_date_rfp_close'] : $result_tender['final_date_rfp_close']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" class="datepicker form-control"
                                                   placeholder="RFP closing date" value="<?php echo $val; ?>"
                                                   name="final_date_rfp_close" id="start_date">
                                            <span style='color:#ff0000'><?php echo form_error('final_date_rfp_close'); ?></span>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Technical bid opening date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['tech_bid_opening_date'])) ? $_REQUEST['tech_bid_opening_date'] : $result_tender['tech_bid_opening_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="tech_bid_opening_date" value="<?php echo $val; ?>"
                                                   class="datepicker form-control"
                                                   placeholder="Technical bid opening date"/>
                                            <span style='color:#ff0000'><?php echo form_error('tech_bid_opening_date'); ?></span>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Financial bid opning date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['finance_bid_opening_date'])) ? $_REQUEST['finance_bid_opening_date'] : $result_tender['finance_bid_opening_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" value="<?php echo $val; ?>"
                                                   name="finance_bid_opening_date" class="datepicker form-control"
                                                   placeholder="Financial bid opening date "/>
                                            <span style='color:#ff0000'><?php echo form_error('finance_bid_opening_date'); ?></span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Tender LOI Issue Date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['tender_ly_date'])) ? $_REQUEST['tender_ly_date'] : $result_tender['tender_ly_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="tender_ly_date" value="<?php echo $val; ?>"
                                                   class="datepicker form-control" placeholder="Tender LOI Issue Date"/>
                                            <span style='color:#ff0000'><?php echo form_error('tender_ly_date'); ?></span>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <?php $btnName = "Save";
                                if (!empty($id)) {
                                    $btnName = "Save";
                                } ?>
                                <?php $link = site_url() . '/Project/agreement_stage?project_id=' . base64_encode($project_id) ?>
                                <button class="btn bg-indigo waves-effect"
                                        type="submit"> <?php echo $btnName; ?></button>
                                <?php $disble = '';
                                if (!$submit_status) {
                                    $disble = 'disabled="disabled"';
                                    $link = "javascript:void(0);";
                                } ?>

                                <a class="btn bg-indigo waves-effect"
                                   href="<?php echo $link ?>" <?php echo $disble; ?> > Next </a>
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