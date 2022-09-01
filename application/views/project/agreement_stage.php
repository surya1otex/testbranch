<link rel="stylesheet" href="<?php echo base_url();?>assets/css/agreement_stage.css"/>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>INITIATION & PROCUREMENT </h4>
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
                            <li class="past">
                                <span>
                                  <strong>Stage 1</strong>
                                  Project’s basic information
                                </span><i></i>
                            </li>
                            <li class="past">
                                <span>
                                  <strong>Stage 2</strong>
                                  Pre-tender stage
                                </span><i></i>
                            </li>
                            <li class="past">
                                <span>
                                  <strong>Stage 3</strong>
                                    Tender stage
                                  </span><i></i>
                            </li>
                            <?php if ($steps_status_arr['agreement_stage']){ ?>
                            <li class="complete">
                                <?php } else { ?>
                            <li class="present">
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
                                Agreement stage 
                            </h2>
                            
                        </div>
                   		 	<div class="body">
                    
                        <div class="section_clone">      
                        
                         <?php if (!empty($project_id)) { ?>
                                    <?php echo form_open('Project/agreement_stage?project_id=' . base64_encode($project_id), array('name' => 'agreement_stage', 'id' => 'agreement_stage')); ?>
                                    <input type="hidden" name="project_id"
                                           value="<?php echo base64_encode($project_id); ?>"/>
                                    <input type="hidden" name="tender_id"
                                           value="<?php echo base64_encode($tender_id); ?>"/>
                                <?php } else {
                                    echo form_open('Project/agreement_stage', array('name' => 'agreement_stage', 'id' => 'agreement_stage'));
                                } ?>
                            <div class="row clearfix cloneBox1">


                         
                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Agreement date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['agreement_date'])) ? $_REQUEST['agreement_date'] : $result_tender['agreement_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="agreement_date" value="<?php echo $val; ?>"
                                                   class="datepicker form-control" placeholder="Agreement date"/>
                                            <span style='color:#ff0000'><?php echo form_error('agreement_date'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Agreement cost:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['agreement_cost'])) ? $_REQUEST['agreement_cost'] : $result_tender['agreement_cost']; ?>
                                            <?php if ($val == '0.00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="agreement_cost"  onkeypress="allowNumbersOnly(event)" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="Argeement Cost"/>
                                            <span style='color:#ff0000'><?php echo form_error('agreement_cost'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Agreement end date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['agreement_end_date'])) ? $_REQUEST['agreement_end_date'] : $result_tender['agreement_end_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="agreement_end_date" value="<?php echo $val; ?>"
                                                   class="datepicker form-control" placeholder="Agreement end date">
                                            <span style='color:#ff0000'><?php echo form_error('agreement_end_date'); ?></span>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Selected bidder's name:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['bidder_details'])) ? $_REQUEST['bidder_details'] : $result_tender['bidder_details']; ?>
                                            <input type="text" name="bidder_details" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="Bidder details"/>
                                            <span style='color:#ff0000'><?php echo form_error('bidder_details'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Selected bidders representative name:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['representative_name'])) ? $_REQUEST['representative_name'] : $result_tender['representative_name']; ?>
                                            <input type="text" name="representative_name" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="Representative’s ">
                                            <span style='color:#ff0000'><?php /*echo form_error('representative_name'); */ ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>BG Amount:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['bg_amount'])) ? $_REQUEST['bg_amount'] : $result_tender['bg_amount']; ?>
                                            <?php if ($val == '0.00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="bg_amount" value="<?php echo $val; ?>"
                                                   onkeypress="allowNumbersOnly(event)" class="form-control" placeholder="BG Amount">
                                            <span style='color:#ff0000'><?php /*echo form_error('bg_amount'); */ ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>BG Validity:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['bg_validity_date'])) ? $_REQUEST['bg_validity_date'] : $result_tender['bg_validity_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" class="datepicker form-control"
                                                   placeholder="BG validity date"
                                                   name="bg_validity_date" value="<?php echo $val; ?>">
                                            <span style='color:#ff0000'><?php echo form_error('bg_validity_date'); ?></span>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Other details of bidder:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['other_bidder_details'])) ? $_REQUEST['other_bidder_details'] : $result_tender['other_bidder_details']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" class="form-control" name="other_bidder_details"
                                                   value="<?php echo $val; ?>" placeholder="Other details of bidder"/>
                                            <span style='color:#ff0000'><?php /*echo form_error('other_bidder_details'); */ ?></span>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Project Start Date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['project_start_date'])) ? $_REQUEST['project_start_date'] : $result_tender['project_start_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" class="datepicker form-control"
                                                   placeholder="Project Start Date"
                                                   name="project_start_date" value="<?php echo $val; ?>">
                                            <span style='color:#ff0000'><?php echo form_error('project_start_date'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Project End Date:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['project_end_date'])) ? $_REQUEST['project_end_date'] : $result_tender['project_end_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" class="datepicker form-control"
                                                   placeholder="Project End Date"
                                                   name="project_end_date" value="<?php echo $val; ?>">
                                            <span style='color:#ff0000'><?php echo form_error('project_end_date'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Frequency of Monitoring:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <select id="monitoring_type" name="monitoring_type"
                                                    class="form-control show-tick">
                                                <option value="0">Select Frequency of Monitoring</option>
                                                <option <?php echo ($result_tender['monitoring_frequency'] == 'W') ? "selected" : "" ?>
                                                        value="W"> Weekly
                                                </option>
                                                <option <?php echo ($result_tender['monitoring_frequency'] == 'F') ? "selected" : "" ?>
                                                        value="F"> 15-Days Interval
                                                </option>
                                                <option <?php echo ($result_tender['monitoring_frequency'] == 'M') ? "selected" : "" ?>
                                                        value="M"> Monthly
                                                </option>
                                                <option <?php echo ($result_tender['monitoring_frequency'] == 'C') ? "selected" : "" ?>
                                                        value="C"> Custom
                                                </option>

                                            </select>
                                            <span style='color:#ff0000'><?php echo form_error('monitoring_type'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Type of Monitoring:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <select id="monitoring_type_item" name="monitoring_type_item"
                                                    class="form-control show-tick">
                                                <option value="0">Select Type of Monitoring</option>
                                                <option <?php echo ($result_tender['type_monitoring'] == 'Work Item') ? "selected" : "" ?>
                                                        value="Work Item"> Work Item
                                                </option>
                                                <option <?php echo ($result_tender['type_monitoring'] == 'Milestone') ? "selected" : "" ?>
                                                        value="Milestone"> Milestone
                                                </option>


                                            </select>
                                            <span style='color:#ff0000'><?php echo form_error('monitoring_type_item'); ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <?php $btnName = "Save";
                                if (!empty($id)) {
                                    $btnName = "UPDATE";
                                } ?>
                                <?php $link = site_url() . '/Project/tender_stage?project_id=' . base64_encode($project_id) ?>
                                <button class="btn bg-indigo waves-effect"
                                        type="submit"> <?php echo $btnName; ?></button>

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