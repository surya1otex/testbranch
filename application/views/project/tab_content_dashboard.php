<script>
    function dataUpToggle( id ){
        if($('#down_'+id). is(":hidden")) {
            $('#down_' + id).show();
        }else{
            $('#down_' + id).hide();
        }
        if($('#up_'+id). is(":hidden")) {
            $('#up_'+id).show();
        }else{
            $('#up_'+id).hide();
        }

    }
</script>

<?php $CI =& get_instance();?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="p-10 bg-deep-blue-grey">
            <h2>Project Information</h2>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"  class="active" >
                <a href="#home_with_icon_title" data-toggle="tab">
                    <i class="material-icons">assignment</i> Project Information
                </a>
            </li>

            <li role="presentation">

                <a href="#profile_with_icon_title"  data-toggle="tab">
                    <i class="material-icons">playlist_add_check</i> Pre-tender
                </a>

            </li>
            <li role="presentation" >

                <a href="#messages_with_icon_title" data-toggle="tab">
                    <i class="material-icons">border_color</i> Tender
                </a>

            </li>

            <li role="presentation" >
                <a href="#settings_with_icon_title" data-toggle="tab">
                    <i class="material-icons">work</i> Agreement
                </a>
            </li>
        </ul>
        <div class="tab-content body p-10">

            <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                        <tr>
                            <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project's Name </td>
                            <td colspan="3"><?php echo !empty($result['project_name']) ? $result['project_name'] : "NA"; ?></td>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Projects Sector</td>
                            <td><?php echo !empty($result['sector_name']) ? $result['sector_name'] : "NA"; ?></td>
                            <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Projects Group</td>
                            <td><?php echo !empty($result['group_name']) ? $result['group_name'] : "NA"; ?></td>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project Destination</td>
                            <td><?php echo !empty($result['project_destination_name']) ? $result['project_destination_name'] : "NA"; ?></td>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">flag</i> Projects Area</td>
                            <td><?php echo !empty($result['project_area_name'] ) ? $result['project_area_name'] : "NA"; ?></td>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">code</i> Projects Code </td>
                            <td><?php echo !empty($result['project_code']) ? $result['project_code'] : "NA"; ?></td>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> File Number </td>
                            <td><?php echo !empty($result['file_no']) ?$result['file_no'] : "NA"; ?></td>
                            

                        </tr>

                        <tr>
                           
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> AA Date</td>

                            <?php  if(!empty($result['aa_date']) && $result['aa_date'] != '0000-00-00') { ?>
                                <?php $date = date_create($result['aa_date']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i>AA Amount </td>
                            <td><?php echo !empty($result['estimate_total_cost']) ? $result['estimate_total_cost'] : "NA"; ?></td>
                            

                        </tr>
                        <tr>
                            
                             <td> <i class="material-icons" style="position: relative;top: 8px;">settings</i> Projects Type</td>
                            <td><?php echo !empty($result['project_type_name']) ? $result['project_type_name'] : "NA"; ?></td>
                            <td colspan="2" style="text-align: center;">
                                <?php
                                if(is_array($source_of_fund)){
                                ?>
                                <table width="100%">
                                    <tr class="bg-blue-grey">
                                        <td colspan="2"><i class="material-icons" style="position: relative;top: 8px;">₹</i> Source of Fund </td>
                                    </tr>
                                    <?php 
                                    foreach ($source_of_fund as $source) {
                                    ?>
                                    <tr>
                                        <td><?php echo $source->source_name; ?></td>
                                        <td><?php echo $source->amount; ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                            </td>

                        </tr>
                        <?php if( !empty($result['remarks_project_initition'])){?>
                            <tr>
                                <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Remarks </td>
                                <td colspan="3"><?php echo $result['remarks_project_initition']; ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>


                </div>
            </div>
            <div role="tabpanel"  class="tab-pane fade" id="profile_with_icon_title">
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                <tr>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chrome_reader_mode</i>  Tender call number </td>
                    <td colspan="3"><?php echo !empty($result['tender_call_no']) ? $result['tender_call_no'] : 'NA'; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval</td>

                    <?php

                    if(!empty($result['tender_document_approval_date']) && $result['tender_document_approval_date'] != '0000-00-00' ){
                        $date = date_create($result['tender_document_approval_date']); ?>
                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                    <?php }else{ ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>

                    <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Tender document approved </td>
                    <td>
                        <?php if( $result['tender_document_approved'] == 'Y'){
                            echo "Yes";
                        } else if( $result['tender_document_approved'] == 'N'){
                            echo "No";
                        }else{
                            echo "NA";
                        } ?>

                    </td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP Publish date </td>

                    <?php  if(!empty($result['rfp_publishing_date']) && $result['rfp_publishing_date'] != '0000-00-00'){
                        $date = date_create($result['rfp_publishing_date']); ?>
                        <td> <?php echo date_format($date,"F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP closing date</td>

                    <?php   if(!empty($result['rfp_closing_date']) && $result['rfp_closing_date'] != '0000-00-00'){
                        $date = date_create($result['rfp_closing_date']); ?>
                        <td> <?php echo date_format($date,"F d Y"); ?> </td>
                    <?php } else { ?>
                        <td> <?php echo "NA"; ?> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Re-tender </td>
                    <td>
                        <?php if( $result['re_tender_status'] == 'Y' ){
                            echo "Yes";
                        }else  if( $result['re_tender_status'] == 'N'){
                            echo "No";
                        }else{
                            echo "NA";
                        } ?>

                    </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Reason for re-tendering</td>
                    <td><?php echo !empty($result['remarks_for_retender']) ? $result['remarks_for_retender'] : "NA"; ?></td>
                </tr>
                <tr>
                    <td width="230px" > <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Remarks </td>
                    <td colspan="3"><?php echo !empty($result['remarks_pre_tender']) ? $result['remarks_pre_tender'] : "NA"; ?></td>
                    <!--<td>&nbsp</td>
                    <td>&nbsp</td>-->
                </tr>



                </tbody>
                    </table>
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <?php ec?>
                <?php  foreach ($tender_histroy as $key => $history){    ?>
                    <?php $id = "collapseme_".$key; ?>
                    <tr>
                    <td width="60px">
                        <button type="button" onclick="dataUpToggle(<?php echo $key; ?>);"  class="btn btn-success btn-circle waves-circle waves-float" data-toggle="collapse" data-target="#<?php echo $id; ?>">
                            <i class="material-icons" id="down_<?php echo $key; ?>" >keyboard_arrow_down</i>
                            <i  style="display:none" id="up_<?php echo $key; ?>" class="material-icons">keyboard_arrow_up</i>
                        </button>

                    </td>
                    <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chrome_reader_mode</i> Tender call number </td>
                    <td ><?php echo !empty($history['tender_call_no']) ? $history['tender_call_no'] : 'NA'; ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval</td>
                        <?php

                        if(!empty($history['tender_document_approval_date']) && $history['tender_document_approval_date'] != '0000-00-00' ){
                            $date = date_create($history['tender_document_approval_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                        <?php }else{ ?>
                            <td> <?php echo "NA"; ?> </td>
                        <?php } ?>
                </tr>

                    <tr id="<?php echo $id; ?>" class="collapse out">
                    <td colspan="5">

                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <tbody>
                            <tr>
                                <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project's Name </td>
                                <td colspan="3"><?php echo $history['project_name']; ?></td>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Projects Sector</td>
                                <?php $project_sector = $CI->project_sector($history['project_sector']); ?>
                                <td> <?php echo $project_sector[0]['name']; ?> </td>
                                <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Projects Group</td>
                                <?php $project_group = $CI->project_group($history['project_group']); ?>
                                <td> <?php echo $project_group[0]['name']; ?> </td>
                            </tr>
                            <tr>
                                <td><i class="material-icons" style="position: relative;top: 8px;">flag</i> Projects Area</td>
                                <?php $project_area = $CI->project_area($history['project_area']); ?>
                                <td> <?php echo $project_area[0]['name']; ?> </td>

                                <td><i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project Destination</td>
                                <?php $project_destination = $CI->project_destination($history['project_destination']); ?>
                                <td> <?php echo $project_destination[0]['name']; ?> </td>
                            </tr>
                            <tr>
                                <td><i class="material-icons" style="position: relative;top: 8px;">code</i> Projects Code </td>
                                <td><?php echo $history['project_code']?></td>
                                <td><i class="material-icons" style="position: relative;top: 8px;">₹</i> AA Amount </td>
                                <td><?php echo $history['estimate_total_cost']?></td>

                            </tr>

                            <tr>
                                <?php $project_type = $CI->project_type($history['project_type']); ?>
                                <td><i class="material-icons" style="position: relative;top: 8px;">settings</i> Projects Type</td>
                                <td><?php echo $project_destination[0]['name']; ?></td>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> File Number </td>
                                <td><?php echo $history['file_no']?></td>
                            </tr>
                            <tr>

                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  AA Date</td>
                                <?php
                                if(!empty($history['aa_date']) && $history['aa_date'] != '0000-00-00' ){
                                $date = date_create($history['aa_date']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
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
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval</td>
                                <?php
                                if(!empty($history['tender_document_approval_date']) && $history['tender_document_approval_date'] != '0000-00-00' ){
                                    $date = date_create($history['tender_document_approval_date']); ?>
                                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
                                    <td> <?php echo "NA"; ?> </td>
                                <?php } ?>
                                <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Tender document approved </td>
                                <td> <?php if( $history['tender_document_approved'] == 'Y'){
                                        echo "Yes";
                                    } else if( $history['tender_document_approved'] == 'N'){
                                        echo "No";
                                    }else{
                                        echo "NA";
                                    } ?> </td>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP Publish date </td>
                                <?php
                                if(!empty($history['rfp_publishing_date']) && $history['rfp_publishing_date'] != '0000-00-00' ){
                                    $date = date_create($history['rfp_publishing_dates']); ?>
                                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
                                    <td> <?php echo "NA"; ?> </td>
                                <?php } ?>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  RFP closing date</td>
                                <?php
                                if(!empty($history['rfp_closing_date']) && $history['rfp_closing_date'] != '0000-00-00' ){
                                    $date = date_create($history['rfp_closing_date']); ?>
                                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
                                    <td> <?php echo "NA"; ?> </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Re-tender </td>
                                <td>Yes</td>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Reason for re-tendering</td>
                                <td><?php echo $history['remarks_for_retender']; ?> </td>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Remarks </td>
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
            <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                        <tr>
                            <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Revised RFP publish date </td>

                            <?php if(!empty($result_tender['revised_rfp_publishing_date']) && $result_tender['revised_rfp_publishing_date'] != '0000-00-00' ) {
                                $date = date_create($result_tender['revised_rfp_publishing_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Revised RFP closing date </td>
                            <?php if(!empty($result_tender['revised_rfp_closing_date']) && $result_tender['revised_rfp_closing_date'] != '0000-00-00'){
                                $date = date_create($result_tender['revised_rfp_closing_date']); ?>
                                <td><?php echo date_format($date,"F d Y"); ?></td>
                            <?php }else { ?>
                                <td><?php echo "NA" ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <!--<td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Revised RFP closing date </td>
                            <?php /*if(!empty($result_tender['revised_rfp_closing_date'])){
                                $date = date_create($result_tender['revised_rfp_closing_date']); */?>
                            <td><?php /*echo date_format($date,"F d Y"); */?></td>
                            <?php /*}else { */?>
                                <td><?php /*echo "NA" */?></td>
                            --><?php /*} */?>
                            <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final RFP publish date</td>
                            <?php if(!empty($result_tender['final_date_rfp_publish']) && $result_tender['final_date_rfp_publish'] != '0000-00-00' ) {
                                $date = date_create($result_tender['final_date_rfp_publish']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                            <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final RFP closing date </td>
                            <?php if(!empty($result_tender['final_date_rfp_close']) && $result_tender['final_date_rfp_close'] != '0000-00-00' ){
                                $date = date_create($result_tender['final_date_rfp_close']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php } else { ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>

                        </tr>
                        <tr>

                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Technical bid opening date</td>
                            <?php if(!empty($result_tender['tech_bid_opening_date']) && $result_tender['tech_bid_opening_date'] != '0000-00-00'){
                                $date = date_create($result_tender['tech_bid_opening_date']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Financial bid opening date</td>

                            <?php if(!empty($result_tender['finance_bid_opening_date'])  && $result_tender['finance_bid_opening_date'] != '0000-00-00'){
                                $date = date_create($result_tender['finance_bid_opening_date']); ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php } else { ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                        </tr>
                        <tr>

                            <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Tender LY Issue Date</td>
                            <?php if(!empty($result_tender['tender_ly_date'])  && $result_tender['tender_ly_date'] != '0000-00-00'){
                            $date = date_create($result_tender['tender_ly_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php } else { ?>
                            <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td></td>
                            <td></td>
                        </tr>


                        </tbody>
                    </table>


                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                        <tr>
                            <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement date </td>

                            <?php if( !empty($result_tender['agreement_date']) && $result_tender['agreement_date'] != '0000-00-00' ) {
                                $date = date_create($result_tender['agreement_date']); ?>
                                <td colspan="3"> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else { ?>
                                <td colspan="3"> <?php echo "NA"; ?> </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i>Agreement cost </td>

                            <td><?php echo !empty($result_tender['agreement_cost']) ? $result_tender['agreement_cost'] : "NA"; ?></td>
                            <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement end date</td>
                            <?php if(!empty($result_tender['agreement_end_date']) && $result_tender['agreement_end_date'] != '0000-00-00' ){
                                $date = date_create($result_tender['agreement_end_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i>  Selected bidders name </td>

                            <td> <?php echo !empty($result_tender['bidder_details']) ?$result_tender['bidder_details'] : "NA"; ?> </td>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Selected bidders representative name</td>

                            <td> <?php echo !empty($result_tender['representative_name']) ?$result_tender['representative_name'] : "NA"; ?> </td>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i> BG amount </td>


                            <td> <?php echo !empty($result_tender['bg_amount']) ? $result_tender['bg_amount'] : 'NA'; ?> </td>
                            <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> BG validity</td>
                            <?php if(!empty($result_tender['bg_validity_date']) && $result_tender['bg_validity_date'] != '0000-00-00') {
                                $date = date_create($result_tender['bg_validity_date']) ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>

                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">insert_drive_file</i> Other details of the bidder</td>


                            <td> <?php echo !empty($result_tender['other_bidder_details']) ? $result_tender['other_bidder_details'] : "NA"; ?> </td>
                            <td>&nbsp;<i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project Start Date</td>
                            <?php if(!empty($result_tender['project_start_date']) && $result_tender['project_start_date'] != '0000-00-00') {
                                $date = date_create($result_tender['project_start_date']) ?>
                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project End Date</td>
                            <?php if(!empty($result_tender['project_end_date']) && $result_tender['project_end_date'] != '0000-00-00') {
                                $date = date_create($result_tender['project_end_date']) ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                            <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td></td>
                            <td></td>


                        </tr>

                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>
</div>
