<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/pre_tender_stage.css"/>

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
                            <?php ?>
                            <?php if ($steps_status_arr['pre_tender_stage']){ ?>
                        <li class="complete">
                        <?php } else { ?>
                            <li class="present">
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
                        <div class="clearfix"></div>


                        <?php if (!empty($project_id)) { ?>
                            <?php include('tab_content.php') ?>
                            <?php 
							
							//echo form_open('Project/project_initiation?edit=1&project_id=' . base64_encode($project_id), array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage')); ?>

                        <?php } else {
                           // echo form_open('Project/project_initiation?edit=1', array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage'));
                        } ?>
                 

                        </form>
                    </div>
                 </div>
        <!-- Modal HTML -->
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div id="modal_btn" class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="removeFund()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal HTML -->
        <input type="hidden" value="<?php echo site_url(); ?>/Project/getDestination" name="ajax_url" id="ajax_url"/>
                 </div>
                 </div>
                 
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Project's basic information 
                            </h2>
                            
                        </div>
                           
                       <?php if (!empty($project_id)) { ?>
                            <?php echo form_open('Project/project_initiation?edit=1&project_id=' . base64_encode($project_id), array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage')); ?>

                            <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>"/>
                        <?php } else {
                            echo form_open('Project/project_initiation?edit=1', array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage'));
                        } ?>
                        <div class="body">
                         <div class="section_clone ">
                            <div class="row clearfix cloneBox1">

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            <span class="col-pink">* </span>Project Name :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['project_name'])) ? $_REQUEST['project_name'] : $result['project_name']; ?>
                                            <input type="text" name="project_name" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="Project’s name"/>
                                            <span style='color:#ff0000'><?php echo form_error('project_name'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Sector :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_sector" class="form-control show-tick">
                                            <option value="">Select Sector</option>
                                            <?php foreach ($sectors as $sector) { ?>
                                                <option value="<?php echo $sector['id'] ?>"
                                                    <?php
                                                    if (!empty($result['project_sector']) && $result['project_sector'] == $sector['id']) {
                                                        echo "selected";
                                                    }
                                                    ?>><?php
                                                    echo $sector['name'] ?></option>
                                            <?php } ?>

                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_sector'); ?></span>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Group :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_group" class="form-control show-tick">
                                            <option value="">Select Group</option>
                                            <?php foreach ($groups as $group) { ?>
                                                <option value="<?php echo $group['id'] ?>"
                                                    <?php
                                                    if (!empty($result['project_group']) && $result['project_group'] == $group['id']) {
                                                        echo "selected";
                                                    } ?> ><?php
                                                    echo $group['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_group'); ?></span>
                                    </div>

                                </div>

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Area :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select id="project_area" name="project_area" class="form-control show-tick">
                                            <option value="">Select Area</option>
                                            <?php foreach ($project_area as $area) { ?>
                                                <option value="<?php echo $area['id'] ?>"
                                                    <?php
                                                    if (!empty($result['project_area']) && $result['project_area'] == $area['id']) {
                                                        echo "selected";
                                                    } ?> ><?php
                                                    echo $area['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_area'); ?></span>

                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Destination :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select id="project_destination" name="project_destination"
                                                class="form-control show-tick">
                                            <option value="">Select Destination</option>
                                            <?php foreach ($project_destinations as $destination) { ?>
                                                <option value="<?php echo $destination['id'] ?>"
                                                    <?php
                                                    if (!empty($result['project_destination']) && $result['project_destination'] == $destination['id']) {
                                                        echo "selected";
                                                    } ?> ><?php
                                                    echo $destination['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_destination'); ?></span>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Code :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['project_code'])) ? $_REQUEST['project_code'] : $result['project_code']; ?>
                                            <input type="text" name="project_code" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="Project Code"/>
                                            <span style='color:#ff0000'><?php echo form_error('project_code'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>AA Date :
                                        </label>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['aa_date'])) ? $_REQUEST['aa_date'] : $result['aa_date']; ?>
                                            <?php if ($val == '0000-00-00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" name="aa_date" value="<?php echo $val; ?>"
                                                   class="datepicker form-control"
                                                   placeholder="Please choose a date..."/>
                                            <span style='color:#ff0000'><?php echo form_error('aa_date'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Type :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_type" class="form-control show-tick">
                                            <option value=""> Select Project Type</option>
                                            <?php foreach ($project_type as $type) { ?>
                                                <option value="<?php echo $type['id'] ?>"
                                                    <?php
                                                    if (!empty($result['project_type']) && $result['project_type'] == $type['id']) {
                                                        echo "selected";
                                                    } ?> ><?php
                                                    echo $type['project_type'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_type'); ?></span>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>File Number:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['file_no'])) ? $_REQUEST['file_no'] : $result['file_no']; ?>
                                            <input type="taxt" name="file_no" value="<?php echo $val; ?>"
                                                   class="form-control" placeholder="File number"/>
                                            <span style='color:#ff0000'><?php echo form_error('file_no'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">


                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge" style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>AA Amount (₹) :
                                        </label>
                                        <?php $status = !empty($brakup_details) ? "checked" : ''; ?>
                                        <input <?php echo $status; ?> type="checkbox" id="aa_brake_up"
                                                                       name="aa_brake_up" value="1">
                                        <label for="aa_brake_up"> Amount Brakeup(₹)</label><br>


                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['estimate_total_cost'])) ? $_REQUEST['estimate_total_cost'] : $result['estimate_total_cost']; ?>
                                            <?php if ($val == '0.00') {
                                                $val = '';
                                            } ?>
                                            <input type="text" id="estimate_total_cost" name="estimate_total_cost" value="<?php echo $val; ?>" class="form-control" onkeypress="allowNumbersOnly(event)" placeholder="AA cost"/>
                                            <span id="err_span"
                                                  style='color:#ff0000'><?php echo form_error('estimate_total_cost'); ?></span>
                                        </div>
                                    </div>
                                    <div id="total_container" style="display:none;">
                                        <?php if (!empty($brakup_details)) { ?>

                                            <?php
                                            $i = 1;

                                            foreach ($brakup_details as $key => $val) {
                                                ?>
                                                <div id="container_fund_<?php echo $i; ?>" class="col-sm-12">

                                                    <div class="col-md-2">
                                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                               style="vertical-align:middle; padding-top:8px;">
                                                            Source of Fund :
                                                        </label>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <select id="source_of_fund_1" name="source_of_fund[]"
                                                                class="form-control show-tick">
                                                            <option>Select Source of Fund</option>
                                                            <?php foreach ($source_of_fund as $fund) { ?>
                                                                <?php $sta = ($val['source_of_fund_id'] == $fund['id']) ? "selected" : '' ?>
                                                                <option value="<?php echo $fund['id']; ?>" <?php echo $sta; ?> > <?php echo $fund['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                               style="vertical-align:middle; padding-top:8px;">
                                                            Amount(₹) :
                                                        </label>
                                                    </div>

                                                    <div class="col-md-3 p-r-0 userNameContainer">
                                                        <input type="text" name="fund_amount[]" value="<?php echo $val['amount']; ?>" class="form-control" placeholder="Fund Amount"/>
                                                    </div>

                                                    <div id="btn_container_fund_<?php echo $i; ?>" class="col-md-1">

                                                        <?php if (count($brakup_details) == $i) { ?>
                                                            <button type="button" id="fund_btn_<?php echo $i; ?>"
                                                                    onclick="addFund(<?php echo $i; ?>)"
                                                                    class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                                                <i class="material-icons">add</i></button>
                                                        <?php } else { ?>

                                                            <button type="button"
                                                                    class='btn  btn-circle waves-effect waves-circle waves-float'
                                                                    id='btn_rmv_fund_<?php echo $i; ?>'
                                                                    onclick="removeFund(<?php echo $i; ?>)">
                                                                <i class="material-icons">delete</i></button>
                                                        <?php } ?>
                                                    </div>


                                                </div>
                                                <?php $i++; ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div id="container_fund_1" class="col-sm-12">

                                                <div class="col-md-2">
                                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                           style="vertical-align:middle; padding-top:8px;">
                                                        Source of Fund :
                                                    </label>
                                                </div>

                                                <div class="col-md-4">
                                                    <select id="source_of_fund_1" name="source_of_fund[]"
                                                            class="form-control show-tick">
                                                        <option>Select Source of Fund</option>
                                                        <?php foreach ($source_of_fund as $fund) { ?>
                                                            <option value="<?php echo $fund['id']; ?>"> <?php echo $fund['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                           style="vertical-align:middle; padding-top:8px;">
                                                        Amount(₹) :
                                                    </label>
                                                </div>

                                                <div class="col-md-3 p-r-0 userNameContainer">
                                                    <input type="text" name="fund_amount[]"  value="" class="form-control"  placeholder="Fund Amount"/>
                                                </div>

                                                <div id="btn_container_fund_1" class="col-md-1">
                                                    <button type="button" id="fund_btn_1" onclick="addFund(1)"
                                                            class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                </div>


                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                             <span class="col-pink">* </span>Project Approvers :
                                        </label>
                                    </div>


                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <select name="project_approver" class="form-control show-tick">
                                                <option value="0">Please Select</option>
                                                <?php foreach ($project_approvers as $approver ){ ?>
                                                    <?php $name = $approver['firstname']. " " .$approver['lastname']. " - ".$approver['designation']; ?>

                                                    <option value="<?php  echo $approver['user_id'] ?>" <?php if ($approver['user_id'] == $project_approver_id ) {
                                                        echo "selected";
                                                    } ?>> <?php echo $name; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span style='color:#ff0000'><?php echo form_error('project_approver'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                               style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['remarks_project_initition'])) ? $_REQUEST['remarks_project_initition'] : $result['remarks_project_initition']; ?>
                                            <textarea class="form-control no-resize" name="remarks_project_initition"
                                                      placeholder="Please type what you want..."><?php echo $val; ?></textarea>
                                            <span style='color:#ff0000'><?php echo form_error('remarks_pre_tender'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 p-b-15 p-r-0 p-l-0">
                                    <div class="header ">
                                        <h2>User Information </h2>
                                    </div>
                                </div>
                                <?php
                                if (!empty($super_visor_dtl)) {
                                    $i = 1; ?>

                                    <?php foreach ($super_visor_dtl as $key => $val) { ?>

                                        <div id="container_<?php echo $i; ?>" class="col-sm-12 ">

                                            <div class="col-md-2">
                                                <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                       style="vertical-align:middle; padding-top:8px;">
                                                    User Type :
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <select id="user_type_<?php echo $i; ?>" name="user_type[]"
                                                        class="form-control show-tick">
                                                    <option>Select User Type</option>
                                                    <?php foreach ($user_type as $type) { ?>
                                                        <option value="<?php echo $type['id']; ?>" <?php if ($type['id'] == $val['designation_id']) {
                                                            echo "selected";
                                                        } ?>> <?php echo $type['designation']; ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                       style="vertical-align:middle; padding-top:8px;">
                                                    User Name :
                                                </label>
                                            </div>

                                            <div class="col-md-3 p-r-0 userNameContainer">
                                                <select id="user_name_<?php echo $i; ?>" name="user_name[]"
                                                        class="form-control show-tick">
                                                    <option>Select User Name</option>
                                                    <?php foreach ($user_name as $user) { ?>
                                                        <option value="<?php echo $user['id'] ?>" <?php if ($user['id'] == $val['user_id']) {
                                                            echo "selected";
                                                        } ?>><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div id="btn_container_<?php echo $i; ?>" class="col-md-1">
                                                <?php if (count($super_visor_dtl) == $i) { ?>
                                                    <button type="button" id="btn_1"
                                                            onclick="addUser(<?php echo $i; ?> )"
                                                            class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="button"
                                                            onclick="removeUser('<?php echo $i; ?>')"
                                                            class="btn btn-circle waves-effect waves-circle waves-float"
                                                            id="btn_rmv_<?php echo $i; ?>">
                                                    <i class="material-icons">delete</i></button>
                                                <?php } ?>
                                            </div>


                                        </div>
                                        <?php $i++;
                                    } ?>

                                <?php } else { ?>

                                    <div id="container_1" class="col-sm-12 ">

                                        <div class="col-md-2">
                                            <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                   style="vertical-align:middle; padding-top:8px;">
                                                User Type :
                                            </label>
                                        </div>

                                        <div class="col-md-4">
                                            <select id="user_type_1" name="user_type[]" class="form-control show-tick">
                                                <option>Select User Type</option>
                                                <?php foreach ($user_type as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                                   style="vertical-align:middle; padding-top:8px;">
                                                User Name :
                                            </label>
                                        </div>

                                        <div class="col-md-3 p-r-0 userNameContainer">
                                            <select id="user_name_1" name="user_name[]" class="form-control show-tick">
                                                <option>Select User Name</option>
                                                <?php foreach ($user_name as $user) { ?>
                                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div id="btn_container_1" class="col-md-1">
                                            <button type="button" id="btn_1" onclick="addUser(1)"
                                                    class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>


                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <?php $btnName = "Save";
                                if (!empty($id)) {
                                    $btnName = "Save";
                                } ?>
                                <!-- onclick="checkSubmitStatus(event );" -->
                                <?php $link = site_url() . '/Project/pre_tender_stage?project_id=' . base64_encode($project_id) ?>
                                <button  type="submit"  onclick="checkSubmitStatus(event );"  class="btn bg-indigo waves-effect" > <?php echo $btnName; ?></button>
                                <?php $disble = '';
                                if (!$submit_status) {
                                    $disble = 'disabled="disabled"';
                                    $link = "javascript:void(0);";
                                } ?>

                                <a class="btn bg-indigo waves-effect"
                                   href="<?php echo $link ?>" <?php echo $disble; ?> > Next </a>
                            </div>
                        </div> 
                        </div>
                        </form>
                    </div>
                </div>
            </div>
                 
</div>


</section>

<script src="<?php echo base_url();?>assets/js/pre_tender_stage.js"></script>
<script>
    function areaDropDownAjax() {
        var elementVal = $("#project_area").val();
        if (elementVal) {

            var url = $('#ajax_url').val();

            $.ajax({
                url: url,
                method: "POST",
                dataType: 'json',
                data: {area_id: elementVal},
                success: function (data) {

                    $('#project_destination').html(data);
                    var id = '<?php echo $result['project_destination']?>';
                    $("#project_destination").val(id);

                }
            });
        }
    }
    function addUser(cnt_id) {

        var html_usertype = '<?php echo $html_usertype; ?>';
        var html_username = '<?php echo $html_username; ?>';
        console.log(html_username);
        var final_id = cnt_id + parseInt(1);
        var user_type = "user_type_" + final_id;
        var user_name = "user_name_" + final_id;
        var html = "<div id='container_" + final_id + "'class='col-sm-12 '>\n" +
            "\n" +
            "                                    <div  class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            User Type :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-4 userTypeContainer'>\n" +
            "                                        <select id=" + user_type + " name='user_type[]' class='form-control show-tick'><option>Select User Type</option>" + html_usertype + "</select>" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            User Name :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-3 p-r-0 userNameContainer' >\n" +
            "                                        <select id=" + user_name + " name='user_name[]' class='form-control show-tick'>\n" +
            "                                            <option>Select User Name</option>\n" + html_username + "</select>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div id='btn_container_" + final_id + "' class='col-md-1'>\n" +
            "                                        <button type='button' id='btn_" + final_id + "' onclick='addUser(" + final_id + ")' class='btn btn-success btn-circle waves-effect waves-circle waves-float'>\n" +
            "                                            <i class='material-icons'>add</i>\n" +
            "                                        </button>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                </div>";

        $("#container_" + cnt_id).after(html);
        $("#btn_" + cnt_id).remove();
        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
        $(this).addClass('btn-info').removeClass('btn-default').blur();
        var rmBtn = " <button type=\"button\" class='btn  btn-circle waves-effect waves-circle waves-float' id='btn_rmv_" + cnt_id + "' onclick=\"removeUser(" + cnt_id + ")\" >\n" +
            "                                            <i class=\"material-icons\">delete</i>\n" +
            "                                        </button>";
        $("#btn_container_" + cnt_id).html(rmBtn);
    }
    function addFund(cnt_id) {
        var html_usertype = '<?php echo $html_source_fund; ?>';
        var final_id = cnt_id + parseInt(1);
        var user_type = "user_type_" + final_id;
        var user_name = "user_name_" + final_id;
        var html = "<div id='container_fund_" + final_id + "'class='col-sm-12 '>\n" +
            "\n" +
            "                                    <div  class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            Source of Fund :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-4 userTypeContainer'>\n" +
            "                                        <select id=" + user_type + " name='source_of_fund[]' class='form-control show-tick'><option>Select source of Fund</option>" + html_usertype + "</select>" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            Amount(₹)  :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-3 p-r-0 userNameContainer' >\n" +
            "                                        <input type=\"text\"  name=\"fund_amount[]\" value=\"\" class=\"form-control\" placeholder=\"Fund Amount\" />" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div id='btn_container_fund_" + final_id + "' class='col-md-1'>\n" +
            "                                        <button type='button' id='fund_btn_" + final_id + "' onclick='addFund(" + final_id + ")' class='btn btn-success btn-circle waves-effect waves-circle waves-float'>\n" +
            "                                            <i class='material-icons'>add</i>\n" +
            "                                        </button>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                </div>";

        $("#container_fund_" + cnt_id).after(html);
        $("#fund_btn_" + cnt_id).remove();
        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
        $(this).addClass('btn-info').removeClass('btn-default').blur();
        /*var rmBtn = " <button type=\"button\" class='btn  btn-circle waves-effect waves-circle waves-float' id='btn_rmv_fund_"+cnt_id+"' onclick=\"removeFund("+cnt_id+")\" >\n" +
            "                                            <i class=\"material-icons\">delete</i>\n" +
            "                                        </button>";*/

        var rmBtn = "<a href=\"#myModal\" data-id=" + cnt_id + " class='btn  btn-circle waves-effect waves-circle waves-float delete' id='btn_rmv_fund_" + cnt_id + "' data-toggle=\"modal\" > <i class='material-icons'>delete</i></a>";

        $("#btn_container_fund_" + cnt_id).html(rmBtn);
    }

    function removeFund(id) {

        $("#container_fund_" + id).remove();
        $('#myModal').modal('toggle');
    }
</script>