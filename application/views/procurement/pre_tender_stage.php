<style type="text/css">

                          .steps {
                              padding-left: 15px;
                              list-style: none;
                              font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                              font-size: 12px;
                              line-height: 1;
                              margin: 0px auto;
                              border-radius: 3px;
                              display: inline-block;
                          }

    .steps strong {
        font-size: 14px;
        display: block;
        line-height: 1.4;
    }

    .steps>li {
        position: relative;
        display: block;
        /* border: 1px solid #ddd; */
        padding: 12px 50px 8px 50px;
        /* width: 250px;*/
        height: 60px;
    }



    @media (min-width: 768px) {
        .steps>li { float: left; }
        .steps .past { color: #333; background: #FFC107; }
        .steps .present { color: #777; background: #efefef;}
        .steps .future { color: #777; background: #efefef; }

        .steps li > span:after,
        .steps li > span:before {
            content: "";
            display: block;
            width: 0px;
            height: 0px;
            position: absolute;
            top: 0;
            left: 0;
            border: solid transparent;
            border-left-color: #f0f0f0;
            border-width: 30px;
        }

        .steps li > span:after {
            top: -5px;
            z-index: 1;
            border-left-color: white;
            border-width: 34px;
        }

        .steps li > span:before { z-index: 2; }

        .steps li.past + li > span:before { border-left-color: #FFC107; }
        .steps li.present + li > span:before { border-left-color: #efefef; }
        .steps li.future + li > span:before { border-left-color: #efefef; }

        .steps li:first-child > span:after,
        .steps li:first-child > span:before { display: none; }

        /* Arrows at start and end */
        .steps li:first-child i,
        .steps li:last-child i {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            border: solid transparent;
            border-left-color: white;
            border-width: 30px;
        }

        .steps li:last-child i {
            left: auto;
            right: -30px;
            border-left-color: transparent;
            border-top-color: white;
            border-bottom-color: white;
        }
    }
</style>

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
                            <li class="past">
                                <span>
                                  <strong>Stage 1</strong>
                                  Initiation & Procurement
                                </span><i></i>
                            </li>
                            <li class="present">
                                <span>
                                  <strong>Stage 2</strong>
                                    Execution
                                  </span><i></i>
                            </li>
                            <li class="future">
                                <span>
                                  <strong>Stage 3</strong>
                                    Commissioning
                                  </span><i></i>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="clearfix"></div>


                        <?php if(!empty($project_id)) {?>
                            <?php echo form_open('Procurement/pre_tender_stage?project_id='.base64_encode($project_id),array('name'=> 'pre_tender_stage','id'=> 'pre_tender_stage')); ?>
                            <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
                        <?php }else{
                            echo form_open('Procurement/pre_tender_stage', array('name' => 'pre_tender_stage', 'id' => 'pre_tender_stage'));
                        } ?>
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">

                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Name <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['project_name'])) ? $_REQUEST['project_name'] : $result['project_name']; ?>
                                            <input type="text" name="project_name" value="<?php echo $val; ?>" class="form-control" placeholder="Project’s name" />
                                            <span style='color:#ff0000'><?php echo form_error('project_name'); ?></span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Projects Sector <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_sector" class="form-control show-tick">
                                            <option value="">Select Sector</option>
                                            <?php foreach($sectors as $sector){?>
                                                <option value="<?php echo $sector['id']?>"
                                                    <?php
                                                    if(!empty($result['project_sector']) && $result['project_sector']== $sector['id']){echo "selected";}
                                                    ?>><?php
                                                    echo $sector['name']?></option>
                                            <?php } ?>

                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_sector'); ?></span>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Group <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_group" class="form-control show-tick">
                                            <option value="">Select Group</option>
                                            <?php foreach($groups as $group){?>
                                                <option value="<?php echo $group['id']?>"
                                                    <?php
                                                    if(!empty($result['project_group']) && $result['project_group']== $group['id']){echo "selected";}?> ><?php
                                                    echo $group['name']?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_group'); ?></span>
                                    </div>

                                </div>


                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Code <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['project_code'])) ? $_REQUEST['project_code'] : $result['project_code']; ?>
                                            <input type="text" name="project_code" value="<?php echo $val; ?>" class="form-control" placeholder="Project Code" />
                                            <span style='color:#ff0000'><?php echo form_error('project_code'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Destination <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                       <select id="project_destination" name="project_destination" class="form-control show-tick">
                                           <option value="">Select Destination</option>
                                                <?php foreach($project_destinations as $destination){?>
                                                    <option value="<?php echo $destination['id']?>"
                                                        <?php
                                                        if(!empty($result['project_destination']) && $result['project_destination']== $destination['id']){echo "selected";}?> ><?php
                                                        echo $destination['name']?></option>
                                                <?php } ?>
                                            </select>
                                            <span style='color:#ff0000'><?php echo form_error('project_destination'); ?></span>

                                    </div>
                                </div>



                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Projects Area <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select id="project_area" name="project_area" class="form-control show-tick">
                                            <option value="">Select Area</option>
                                            <?php foreach($project_area as $area){?>
                                                <option value="<?php echo $area['id']?>"
                                                    <?php
                                                    if(!empty($result['project_area']) && $result['project_area']== $area['id']){echo "selected";}?> ><?php
                                                    echo $area['name']?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_area'); ?></span>

                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            AA Amount (₹)<span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['estimate_total_cost'])) ? $_REQUEST['estimate_total_cost'] : $result['estimate_total_cost']; ?>
                                            <?php if($val == '0.00') {$val = '';} ?>
                                            <input type="text" name="estimate_total_cost" value="<?php echo $val; ?>" class="form-control" placeholder="AA cost" />
                                            <span style='color:#ff0000'><?php echo form_error('estimate_total_cost'); ?></span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Projects Type <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="project_type" class="form-control show-tick">
                                            <option value=""> Select Project Type </option>
                                            <?php foreach($project_type as $type){?>
                                                <option value="<?php echo $type['id']?>"
                                                    <?php
                                                    if(!empty($result['project_type']) && $result['project_type']== $type['id']){echo "selected";}?> ><?php
                                                    echo $type['project_type']?></option>
                                            <?php } ?>
                                        </select>
                                        <span style='color:#ff0000'><?php echo form_error('project_type'); ?></span>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            File Number <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['file_no'])) ? $_REQUEST['file_no'] : $result['file_no']; ?>
                                            <input type="taxt" name="file_no"  value="<?php echo $val; ?>" class="form-control" placeholder="File number" />
                                            <span style='color:#ff0000'><?php echo form_error('file_no'); ?></span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            AA Date <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['aa_date'])) ? $_REQUEST['aa_date'] : $result['aa_date']; ?>
                                            <?php if($val == '0000-00-00') {$val = '';} ?>
                                            <input type="text" name="aa_date" value="<?php echo $val;?>" class="datepicker form-control" placeholder="Please choose a date..." />
                                            <span style='color:#ff0000'><?php echo form_error('aa_date'); ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Date of Tender Approval<span class="col-pink">* </span>:
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
                                            RFP publish date <span class="col-pink">* </span>:
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

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            RFP closing date <span class="col-pink">* </span>:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['rfp_closing_date'])) ? $_REQUEST['rfp_closing_date'] : $result['rfp_closing_date']; ?>
                                            <?php if($val == '0000-00-00') {$val = '';} ?>
                                            <input type="text" class="datepicker form-control" placeholder="RFP closing date" value="<?php echo $val; ?>" name="rfp_closing_date" id="start_date"  value="<?php echo (!empty($project_deatail[0]['rfp_closeing_date'])?date('d-m-Y' ,strtotime($project_deatail[0]['rfp_closeing_date'])):"");?>">
                                            <span style='color:#ff0000'><?php echo form_error('rfp_closing_date'); ?></span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Tender Document Approval:
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
                                            Tender call Number :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['tender_call_no'])) ? $_REQUEST['tender_call_no'] : $result['tender_call_no']; ?>
                                            <input type="text" name="tender_call_no"  value="<?php echo $val;  ?>" class="form-control" placeholder="Tender call number" />
                                            <span style='color:#ff0000'><?php echo form_error('tender_call_no'); ?></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Re-Tender :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select name="re_tender_status" class="form-control show-tick">
                                            <option value="NA">NA</option>
                                            <option value="Y" <?php if(!empty($result['re_tender_status']) && $result['re_tender_status']== 'Y'){echo "selected";}?> >YES</option>
                                            <option value="N" <?php if(!empty($result['re_tender_status']) && $result['re_tender_status']== 'N'){echo "selected";}?>>NO </option>

                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Reason for Re-tender:
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <?php $val = (!empty($_REQUEST['remarks_for_retender'])) ? $_REQUEST['remarks_for_retender'] : $result['remarks_for_retender']; ?>
                                            <textarea class="form-control no-resize" name="remarks_for_retender" placeholder="Please type what you want..."><?php echo $val; ?></textarea>
                                            <span style='color:#ff0000'><?php echo form_error('remarks_for_retender'); ?></span>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">

                                            <?php $val = (!empty($_REQUEST['remarks_pre_tender'])) ? $_REQUEST['remarks_pre_tender'] : $result['remarks_pre_tender']; ?>
                                            <textarea class="form-control no-resize" name="remarks_pre_tender" placeholder="Please type what you want..."><?php echo $val; ?></textarea>
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
                                    if(!empty($super_visor_dtl)){   $i =1; ?>

                                        <?php foreach ($super_visor_dtl as $key => $val){ ?>

                                            <div id="container_<?php echo $i; ?>" class="col-sm-12 ">

                                                <div class="col-md-2">
                                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                                        User Type :
                                                    </label>
                                                </div>

                                                <div class="col-md-4">
                                                    <select id="user_type_<?php echo $i; ?>" name="user_type[]" class="form-control show-tick">
                                                        <option>Select User Type</option>
                                                        <?php foreach ($user_type as $type ){ ?>
                                                            <option value="<?php echo $type['id']; ?>"  <?php if($type['id']== $val['designation_id'] ){echo "selected";}?>> <?php echo $type['designation']; ?></option>

                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                                        User Name :
                                                    </label>
                                                </div>

                                                <div class="col-md-3 p-r-0 userNameContainer" >
                                                    <select id="user_name_<?php echo $i; ?>" name="user_name[]" class="form-control show-tick">
                                                        <option>Select User Name</option>
                                                        <?php foreach ($user_name as $user ){?>
                                                            <option value="<?php echo $user['uid'] ?>" <?php if($user['uid']== $val['user_id'] ){echo "selected";}?>><?php echo $user['firstname']." ".$user['lastname']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div id="btn_container_<?php echo $i; ?>" class="col-md-1">
                                                    <?php if( count($super_visor_dtl) == $i ) {?>
                                                    <button type="button" id="btn_1" onclick="addUser(<?php echo $i; ?> )" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">add</i>
                                                    </button>
                                                    <?php }else{ ?>
                                                        <button type="button" class='btn  btn-circle waves-effect waves-circle waves-float' id='btn_rmv_<?php echo $i; ?>' onclick="removeUser('<?php echo $i; ?>')"
                                                            <i class=\"material-icons\">Remove</i></button>
                                                    <?php } ?>
                                                </div>


                                            </div>
                                        <?php $i++; } ?>

                              <?php } else { ?>

                                <div id="container_1" class="col-sm-12 ">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            User Type :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <select id="user_type_1" name="user_type[]" class="form-control show-tick">
                                            <option>Select User Type</option>
                                            <?php foreach ($user_type as $type ){ ?>
                                                <option value="<?php echo $type['id']; ?>" > <?php echo $type['designation']; ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            User Name :
                                        </label>
                                    </div>

                                    <div class="col-md-3 p-r-0 userNameContainer" >
                                        <select id="user_name_1" name="user_name[]" class="form-control show-tick">
                                            <option>Select User Name</option>
                                            <?php foreach ($user_name as $user ){?>
                                                    <option value="<?php echo $user['uid'] ?>"><?php echo $user['firstname']." ".$user['lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div id="btn_container_1" class="col-md-1">
                                        <button type="button" id="btn_1" onclick="addUser(1)" class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">add</i>
                                        </button>
                                    </div>


                                </div>
                            <?php  } ?>
                            </div>

                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <?php $btnName = "Save";  if(!empty($id)) { $btnName = "UPDATE"; }?>
                                <?php $link = site_url().'/Procurement/tender_stage?project_id='.base64_encode($project_id)?>
                                <button id="submit_pre_stage" class="btn bg-indigo waves-effect" type="submit"> <?php echo $btnName; ?></button>
                                <?php $disble = '' ;if(!$submit_status){ $disble = 'disabled="disabled"'; $link="javascript:void(0);"; } ?>

                                <a class="btn bg-indigo waves-effect"  href="<?php echo $link ?>"  <?php echo $disble; ?> > Next </a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="<?php echo site_url();?>/Procurement/getDestination" name="ajax_url" id="ajax_url" />


</section>
    <script type="text/javascript">
        function addUser( cnt_id ){
            var html_usertype = '<?php echo $html_usertype; ?>';
            var html_username = '<?php echo $html_username; ?>';
            var final_id = cnt_id + parseInt(1);
            var user_type = "user_type_"+final_id;
            var user_name = "user_name_"+final_id;
            var html = "<div id='container_"+final_id+"'class='col-sm-12 '>\n" +
                "\n" +
            "                                    <div  class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            User Type :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-4 userTypeContainer'>\n" +
            "                                        <select id="+user_type+" name='user_type[]' class='form-control show-tick'><option>Select User Type</option>" +html_usertype+ "</select>" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-2'>\n" +
            "                                        <label for='SmeUserMasterMiddleName' class='input-xlarge'  style='vertical-align:middle; padding-top:8px;'>\n" +
            "                                            User Name :\n" +
            "                                        </label>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div class='col-md-3 p-r-0 userNameContainer' >\n" +
            "                                        <select id="+user_name+" name='user_name[]' class='form-control show-tick'>\n" +
            "                                            <option>Select User Name</option>\n" + html_username +"</select>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                    <div id='btn_container_"+final_id +"' class='col-md-1'>\n" +
            "                                        <button type='button' id='btn_"+final_id +"' onclick='addUser("+final_id+")' class='btn btn-success btn-circle waves-effect waves-circle waves-float'>\n" +
            "                                            <i class='material-icons'>add</i>\n" +
            "                                        </button>\n" +
            "                                    </div>\n" +
            "\n" +
            "                                </div>";

            $("#container_"+cnt_id).after(html);
            $("#btn_"+cnt_id).remove();
            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
            $(this).addClass('btn-info').removeClass('btn-default').blur();
            var rmBtn = " <button type=\"button\" class='btn  btn-circle waves-effect waves-circle waves-float' id='btn_rmv_"+cnt_id+"' onclick=\"removeUser("+cnt_id+")\" >\n" +
                "                                            <i class=\"material-icons\">Remove</i>\n" +
                "                                        </button>";
             $("#btn_container_"+cnt_id).html(rmBtn);
    }
    function removeUser( id ){
        $("#container_"+id).remove();
    }
    function areaDropDownAjax(){
        var elementVal = $("#project_area").val();
        if( elementVal ){

            var url = $('#ajax_url').val();

            $.ajax({
                url: url,
                method:"POST",
                dataType: 'json',
                data:{area_id:elementVal},
                success:function(data){

                    $('#project_destination').html(data);
                    var id = '<?php echo $result['project_destination']?>';
                    $("#project_destination").val(id);

                }
            });
        }
    }
    $(function(){
        /*$("#submit_pre_stage").click(function(){
            alert();
            $([id^="user_name"]).each(function(){
                alert("asas");
                if($(this).text() == ""){
                    alert("asas");
                var html = "<span style='color:#ff0000'>Please select a username</span>";
                $(this).after(html);
                    e.preventDefault();
                    return false;
                }
            });
        });*/
        areaDropDownAjax();
        $('#project_area').change(function(){
            console.log($(this).val());
            var elementVal = $(this).val();
            if( elementVal ){

                var url = $('#ajax_url').val();

                $.ajax({
                    url: url,
                    method:"POST",
                    dataType: 'json',
                    data:{area_id:elementVal},
                    success:function(data){
                      
                    $('#project_destination').html(data);


                    }
                });
            }
        });
        $('.btn-circle').on('click',function(){
            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
            $(this).addClass('btn-info').removeClass('btn-default').blur();
        });

        $('.next-step, .prev-step').on('click', function (e){
            var $activeTab = $('.tab-pane.active');

            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

            if ( $(e.target).hasClass('next-step') )
            {
                var nextTab = $activeTab.next('.tab-pane').attr('id');
                $('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#'+ nextTab +'"]').tab('show');
            }
            else
            {
                var prevTab = $activeTab.prev('.tab-pane').attr('id');
                $('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#'+ prevTab +'"]').tab('show');
            }
        });
    });

</script>