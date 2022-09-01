<script>
    function dataUpToggle(id) {
        if ($('#down_' + id).is(":hidden")) {
            $('#down_' + id).show();
        } else {
            $('#down_' + id).hide();
        }
        if ($('#up_' + id).is(":hidden")) {
            $('#up_' + id).show();
        } else {
            $('#up_' + id).hide();
        }

    }
</script>

<?php $CI =& get_instance(); ?>
<ul class="nav nav-tabs" role="tablist">
    <?php

    if ($this->router->fetch_class() == "Project" && $this->router->fetch_method() == 'project_initiation') {
        $project_initiation = 'class="active"';
    } else if ($this->router->fetch_class() == "Project" && $this->router->fetch_method() == 'pre_tender_stage') {
        $pre_tender_stage = 'class="active"';
    } else if ($this->router->fetch_class() == "Project" && $this->router->fetch_method() == 'tender_stage') {
        $tender_stage = 'class="active"';
    } else if ($this->router->fetch_class() == "Project" && $this->router->fetch_method() == 'agreement_stage') {
        $agreement_stage = 'class="active"';
    }else{
        $project_initiation = 'class="active"';
    }

    ?>

    <li role="presentation" <?php echo $project_initiation; ?> >
        <a href="#home_with_icon_title" data-toggle="tab">
            <i class="material-icons">assignment</i> Project Information
        </a>
    </li>

    <li role="presentation" <?php echo $pre_tender_stage; ?> >

        <a href="#profile_with_icon_title" data-toggle="tab">
            <i class="material-icons">playlist_add_check</i> Pre-tender
        </a>

    </li>
    <li role="presentation" <?php echo $tender_stage; ?> >

        <a href="#messages_with_icon_title" data-toggle="tab">
            <i class="material-icons">border_color</i> Tender
        </a>

    </li>

    <li role="presentation" <?php echo $agreement_stage; ?> >
        <a href="#settings_with_icon_title" data-toggle="tab">
            <i class="material-icons">work</i> Agreement
        </a>
    </li>
</ul>
<div class="tab-content">
    <?php $a = ($this->router->fetch_method() == 'project_initiation' || $this->router->fetch_method() == 'project_view') ? 'in active' : '' ?>
    <div role="tabpanel" class="tab-pane fade <?php echo $a; ?>" id="home_with_icon_title">
        <div class="table-responsive m-b-30">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Project's
                        Name
                    </td>
                    <td colspan="3"><?php echo !empty($result['project_name']) ? $result['project_name'] : "NA"; ?></td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Sector</td>
                    <td><?php echo !empty($result['sector_name']) ? $result['sector_name'] : "NA"; ?></td>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects
                        Group
                    </td>
                    <td><?php echo !empty($result['group_name']) ? $result['group_name'] : "NA"; ?></td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Project Destination</td>
                    <td><?php echo !empty($result['project_destination_name']) ? $result['project_destination_name'] : "NA"; ?></td>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Area</td>
                    <td><?php echo !empty($result['project_area_name']) ? $result['project_area_name'] : "NA"; ?></td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Code</td>
                    <td><?php echo !empty($result['project_code']) ? $result['project_code'] : "NA"; ?></td>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i>AA Amount (₹)</td>
                    <td><?php echo !empty($result['estimate_total_cost']) ? $result['estimate_total_cost'] : "NA"; ?></td>

                </tr>

                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Type</td>
                    <td><?php echo !empty($result['project_type_name']) ? $result['project_type_name'] : "NA"; ?></td>

                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> File Number</td>
                    <td><?php echo !empty($result['file_no']) ? $result['file_no'] : "NA"; ?></td>

                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> AA Date</td>

                    <?php if (!empty($result['aa_date']) && $result['aa_date'] != '0000-00-00') { ?>
                        <?php $date = date_create($result['aa_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>

                    <td>&nbsp</td>
                    <td>&nbsp</td>
                </tr>
                <?php if (!empty($result['remarks_project_initition'])) { ?>
                    <tr>
                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i>Remarks
                        </td>
                        <td colspan="3"><?php echo $result['remarks_project_initition']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php if ($this->router->fetch_method() != 'project_initiation' && $this->router->fetch_method() != 'project_view' ) { ?>
                <div class="col-md-12 align-right p-r-0">
                    <?php $edit_link = site_url() . '/Project/project_initiation?edit=1&project_id=' . base64_encode($project_id); ?>
                    <a href='<?php echo $edit_link; ?>' class="btn bg-blue waves-effect">
                        <i class="material-icons">create</i>
                        <span> EDIT </span>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
    <?php $b = ($this->router->fetch_method() == 'pre_tender_stage') ? 'in active' : '' ?>
    <div role="tabpanel" class="tab-pane fade  <?php echo $b; ?>" id="profile_with_icon_title">
        <div class="table-responsive m-b-30">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Tender
                        call number
                    </td>
                    <td colspan="3"><?php echo !empty($result['tender_call_no']) ? $result['tender_call_no'] : 'NA'; ?></td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Date of tender approval
                    </td>

                    <?php

                    if (!empty($result['tender_document_approval_date']) && $result['tender_document_approval_date'] != '0000-00-00') {
                        $date = date_create($result['tender_document_approval_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>

                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Tender
                        document approved
                    </td>
                    <td>
                        <?php if ($result['tender_document_approved'] == 'Y') {
                            echo "Yes";
                        } else if ($result['tender_document_approved'] == 'N') {
                            echo "No";
                        } else {
                            echo "NA";
                        } ?>

                    </td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> RFP Publish date</td>

                    <?php if (!empty($result['rfp_publishing_date']) && $result['rfp_publishing_date'] != '0000-00-00') {
                        $date = date_create($result['rfp_publishing_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> RFP closing date</td>

                    <?php if (!empty($result['rfp_closing_date']) && $result['rfp_closing_date'] != '0000-00-00') {
                        $date = date_create($result['rfp_closing_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Re-tender</td>
                    <td>
                        <?php if ($result['re_tender_status'] == 'Y') {
                            echo "Yes";
                        } else if ($result['re_tender_status'] == 'N') {
                            echo "No";
                        } else {
                            echo "NA";
                        } ?>

                    </td>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Reason for re-tendering
                    </td>
                    <td><?php echo !empty($result['remarks_for_retender']) ? $result['remarks_for_retender'] : "NA"; ?></td>
                </tr>
                <tr>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Remarks
                    </td>
                    <td colspan="3"><?php echo !empty($result['remarks_pre_tender']) ? $result['remarks_pre_tender'] : "NA"; ?></td>

                </tr>


                </tbody>
            </table>
            <?php if ($this->router->fetch_method() != 'pre_tender_stage' && $this->router->fetch_method() != 'project_view') { ?>
                <div class="col-md-12 align-right p-r-0">

                    <?php
                    if ($status_arr['pre_tender_stage']) {
                        $edit_link = site_url() . '/Project/pre_tender_stage?project_id=' . base64_encode($project_id);
                    } else {
                        $edit_link = "javascript:void(0)";
                    } ?>
                    <?php $disble = '';
                    if (!$status_arr['pre_tender_stage']) {
                        $disble = 'disabled="disabled"';
                    } ?>
                    <a href='<?php echo $edit_link; ?>' <?php echo $disble; ?> class="btn bg-blue waves-effect">
                        <i class="material-icons">create</i>
                        <span> EDIT </span>
                    </a>

                </div>

            <?php } ?>

            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <?php ec ?>
                <?php foreach ($tender_histroy as $key => $history) { ?>
                    <?php $id = "collapseme_" . $key; ?>
                    <tr>
                        <td width="60px">
                            <button type="button" onclick="dataUpToggle(<?php echo $key; ?>);"
                                    class="btn btn-success btn-circle waves-circle waves-float" data-toggle="collapse"
                                    data-target="#<?php echo $id; ?>">
                                <i class="material-icons" id="down_<?php echo $key; ?>">keyboard_arrow_down</i>
                                <i style="display:none" id="up_<?php echo $key; ?>" class="material-icons">keyboard_arrow_up</i>
                            </button>

                        </td>
                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Tender
                            call number
                        </td>
                        <td><?php echo !empty($history['tender_call_no']) ? $history['tender_call_no'] : 'NA'; ?></td>
                        <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Date of tender
                            approval
                        </td>
                        <?php

                        if (!empty($history['tender_document_approval_date']) && $history['tender_document_approval_date'] != '0000-00-00') {
                            $date = date_create($history['tender_document_approval_date']); ?>
                            <td> <?php echo date_format($date, "F d Y"); ?> </td>
                        <?php } else { ?>
                            <td> <?php echo "NA"; ?> </td>
                        <?php } ?>
                    </tr>

                    <tr id="<?php echo $id; ?>" class="collapse out">
                        <td colspan="5">

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <tbody>
                                <tr>
                                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i>
                                        Project's Name
                                    </td>
                                    <td colspan="3"><?php echo $history['project_name']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects
                                        Sector
                                    </td>
                                    <?php $project_sector = $CI->project_sector($history['project_sector']); ?>
                                    <td> <?php echo $project_sector[0]['name']; ?> </td>
                                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i>
                                        Projects Group
                                    </td>
                                    <?php $project_group = $CI->project_group($history['project_group']); ?>
                                    <td> <?php echo $project_group[0]['name']; ?> </td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects
                                        Area
                                    </td>
                                    <?php $project_area = $CI->project_area($history['project_area']); ?>
                                    <td> <?php echo $project_area[0]['name']; ?> </td>

                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Project
                                        Destination
                                    </td>
                                    <?php $project_destination = $CI->project_destination($history['project_destination']); ?>
                                    <td> <?php echo $project_destination[0]['name']; ?> </td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects
                                        Code
                                    </td>
                                    <td><?php echo $history['project_code'] ?></td>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> AA
                                        Amount
                                    </td>
                                    <td><?php echo $history['estimate_total_cost'] ?></td>

                                </tr>

                                <tr>
                                    <?php $project_type = $CI->project_type($history['project_type']); ?>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Projects
                                        Type
                                    </td>
                                    <td><?php echo $project_destination[0]['name']; ?></td>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> File
                                        Number
                                    </td>
                                    <td><?php echo $history['file_no'] ?></td>
                                </tr>
                                <tr>

                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> AA Date
                                    </td>
                                    <?php
                                    if (!empty($history['aa_date']) && $history['aa_date'] != '0000-00-00') {
                                        $date = date_create($history['aa_date']); ?>
                                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                                    <?php } else { ?>
                                        <td> <?php echo "NA"; ?> </td>
                                    <?php } ?>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <tbody>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Date of
                                        tender approval
                                    </td>
                                    <?php
                                    if (!empty($history['tender_document_approval_date']) && $history['tender_document_approval_date'] != '0000-00-00') {
                                        $date = date_create($history['tender_document_approval_date']); ?>
                                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                                    <?php } else { ?>
                                        <td> <?php echo "NA"; ?> </td>
                                    <?php } ?>
                                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i>
                                        Tender document approved
                                    </td>
                                    <td> <?php if ($history['tender_document_approved'] == 'Y') {
                                            echo "Yes";
                                        } else if ($history['tender_document_approved'] == 'N') {
                                            echo "No";
                                        } else {
                                            echo "NA";
                                        } ?> </td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> RFP
                                        Publish date
                                    </td>
                                    <?php
                                    if (!empty($history['rfp_publishing_date']) && $history['rfp_publishing_date'] != '0000-00-00') {
                                        $date = date_create($history['rfp_publishing_dates']); ?>
                                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                                    <?php } else { ?>
                                        <td> <?php echo "NA"; ?> </td>
                                    <?php } ?>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> RFP
                                        closing date
                                    </td>
                                    <?php
                                    if (!empty($history['rfp_closing_date']) && $history['rfp_closing_date'] != '0000-00-00') {
                                        $date = date_create($history['rfp_closing_date']); ?>
                                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                                    <?php } else { ?>
                                        <td> <?php echo "NA"; ?> </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i>
                                        Re-tender
                                    </td>
                                    <td>Yes</td>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Reason
                                        for re-tendering
                                    </td>
                                    <td><?php echo $history['remarks_for_retender']; ?> </td>
                                </tr>
                                <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Remarks
                                    </td>
                                    <td colspan="3"><?php echo $history['remarks_pre_tender']; ?></td>
                                </tr>
                                </tbody>
                            </table>

                        </td>
                    </tr>

                <?php } ?>


                </tbody>
            </table>
        </div>
    </div>
    <?php $c = ($this->router->fetch_method() == 'tender_stage') ? 'in active' : '' ?>
    <div role="tabpanel" class="tab-pane fade <?php echo $c; ?>" id="messages_with_icon_title">
        <div class="table-responsive m-b-30">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <!--
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Revised RFP publish date
                    </td>

                    <?php if (!empty($result_tender['revised_rfp_publishing_date']) && $result_tender['revised_rfp_publishing_date'] != '0000-00-00') {
                        $date = date_create($result_tender['revised_rfp_publishing_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Revised RFP closing date
                    </td>
                    <?php if (!empty($result_tender['revised_rfp_closing_date']) && $result_tender['revised_rfp_closing_date'] != '0000-00-00') {
                        $date = date_create($result_tender['revised_rfp_closing_date']); ?>
                        <td><?php echo date_format($date, "F d Y"); ?></td>
                    <?php } else { ?>
                        <td><?php echo "NA" ?></td>
                    <?php } ?>
                </tr>
                -->
                <tr>

                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Final RFP
                        publish date
                    </td>
                    <?php if (!empty($result_tender['final_date_rfp_publish']) && $result_tender['final_date_rfp_publish'] != '0000-00-00') {
                        $date = date_create($result_tender['final_date_rfp_publish']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Final RFP closing date
                    </td>
                    <?php if (!empty($result_tender['final_date_rfp_close']) && $result_tender['final_date_rfp_close'] != '0000-00-00') {
                        $date = date_create($result_tender['final_date_rfp_close']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>

                </tr>
                <tr>

                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Technical bid opening
                        date
                    </td>
                    <?php if (!empty($result_tender['tech_bid_opening_date']) && $result_tender['tech_bid_opening_date'] != '0000-00-00') {
                        $date = date_create($result_tender['tech_bid_opening_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Financial bid opening
                        date
                    </td>

                    <?php if (!empty($result_tender['finance_bid_opening_date']) && $result_tender['finance_bid_opening_date'] != '0000-00-00') {
                        $date = date_create($result_tender['finance_bid_opening_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>

                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Tender LOI Issue Date
                    </td>
                    <?php if (!empty($result_tender['tender_ly_date']) && $result_tender['tender_ly_date'] != '0000-00-00') {
                        $date = date_create($result_tender['tender_ly_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td></td>
                    <td></td>
                </tr>


                </tbody>
            </table>
            <?php if ($this->router->fetch_method() != 'tender_stage' && $this->router->fetch_method() != 'project_view') { ?>
                <div class="col-md-12 align-right p-r-0">
                    <?php if ($status_arr['tender_stage']) {
                        $disble = '';
                        $edit_link = site_url() . '/Project/tender_stage?project_id=' . base64_encode($project_id);
                    } else {
                        $disble = 'disabled="disabled"';
                        $edit_link = "javascript:void(0)";
                    } ?>
                    <a href='<?php echo $edit_link; ?>' <?php echo $disble; ?> class="btn bg-blue waves-effect">
                        <i class="material-icons">create</i>
                        <span> EDIT </span>
                    </a>
                </div>
            <?php } ?>

        </div>

    </div>
    <?php $d = ($this->router->fetch_method() == 'agreement_stage') ? 'in active' : '' ?>
    <div role="tabpanel" class="tab-pane fade <?php echo $d; ?>" id="settings_with_icon_title">
        <div class="table-responsive m-b-30">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Agreement
                        date
                    </td>

                    <?php if (!empty($result_tender['agreement_date']) && $result_tender['agreement_date'] != '0000-00-00') {
                        $date = date_create($result_tender['agreement_date']); ?>
                        <td colspan="3"> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td colspan="3"> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i>Agreement cost</td>

                    <td><?php echo !empty($result_tender['agreement_cost']) ? $result_tender['agreement_cost'] : "NA"; ?></td>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Agreement
                        end date
                    </td>
                    <?php if (!empty($result_tender['agreement_end_date']) && $result_tender['agreement_end_date'] != '0000-00-00') {
                        $date = date_create($result_tender['agreement_end_date']); ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Selected bidders name
                    </td>

                    <td> <?php echo !empty($result_tender['bidder_details']) ? $result_tender['bidder_details'] : "NA"; ?> </td>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Selected bidders
                        representative name
                    </td>

                    <td> <?php echo !empty($result_tender['representative_name']) ? $result_tender['representative_name'] : "NA"; ?> </td>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> BG amount</td>


                    <td> <?php echo !empty($result_tender['bg_amount']) ? $result_tender['bg_amount'] : 'NA'; ?> </td>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> BG validity</td>
                    <?php if (!empty($result_tender['bg_validity_date']) && $result_tender['bg_validity_date'] != '0000-00-00') {
                        $date = date_create($result_tender['bg_validity_date']) ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>

                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Other details of the
                        bidder
                    </td>


                    <td> <?php echo !empty($result_tender['other_bidder_details']) ? $result_tender['other_bidder_details'] : "NA"; ?> </td>
                    <td>&nbsp;<i class="material-icons" style="position: relative;top: 8px;">done</i> Project Start Date
                    </td>
                    <?php if (!empty($result_tender['project_start_date']) && $result_tender['project_start_date'] != '0000-00-00') {
                        $date = date_create($result_tender['project_start_date']) ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td><i class="material-icons" style="position: relative;top: 8px;">done</i> Project End Date</td>
                    <?php if (!empty($result_tender['project_end_date']) && $result_tender['project_end_date'] != '0000-00-00') {
                        $date = date_create($result_tender['project_end_date']) ?>
                        <td> <?php echo date_format($date, "F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td></td>
                    <td></td>


                </tr>

                </tbody>
            </table>
            <?php if ($this->router->fetch_method() != 'agreement_stage' && $this->router->fetch_method() != 'project_view') { ?>
                <div class="col-md-12 align-right p-r-0">
                    <?php if ($status_arr['agreement_stage']) {
                        $edit_link = site_url() . '/Project/agreement_stage?project_id=' . base64_encode($project_id);
                        $disble = '';
                    } else {
                        $edit_link = "javascript:void(0)";
                        $disble = 'disabled="disabled"';
                    } ?>
                    <a href='<?php echo $edit_link; ?>' <?php echo $disble; ?> class="btn bg-blue waves-effect">
                        <i class="material-icons">create</i>
                        <span> EDIT </span>
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>

</div>
