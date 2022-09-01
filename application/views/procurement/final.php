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
        .steps .past { color: #fff; background: #4CAF50; }
        .steps .present { color: #fff; background: #4CAF50;}
        .steps .future { color: #333; background: #FFC107; }

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

        .steps li.past + li > span:before { border-left-color: #4CAF50; }
        .steps li.present + li > span:before { border-left-color: #4CAF50; }
        .steps li.future + li > span:before { border-left-color: #FFC107; }

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
<<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>COMMISSIONING</h4>
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
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">


                                <div class="col-md-12">
                                    <div class="table-responsive m-b-30">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <tbody>
                                            <tr>
                                                <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">done</i> Project's Name </td>
                                                <td colspan="3"><?php echo $result['project_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Sector</td>
                                                <td><?php echo $result['sector_name']; ?></td>
                                                <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Group</td>
                                                <td><?php echo $result['group_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Code </td>
                                                <td><?php echo $result['project_code']; ?></td>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Project Destination</td>
                                                <td><?php echo $result['project_destination_name']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Project Destination</td>
                                                <td><?php echo $result['project_destination_name']; ?></td>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Area</td>
                                                <td><?php echo $result['project_area_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> AA Amount </td>
                                                <td><?php echo $result['estimate_total_cost']; ?></td>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Projects Type</td>
                                                <td><?php echo $result['project_type_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> File Number </td>
                                                <td><?php echo $result['file_no']; ?></td>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> AA Date</td>
                                                <?php $date = date_create($result['aa_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>

                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Date of Tender Approval</td>
                                                <?php $date = date_create($result['tender_document_approval_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>

                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> RFP publish date</td>
                                                <?php $date = date_create($result['rfp_publishing_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> RFP closing date</td>

                                                <?php $date = date_create($result['rfp_closing_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>

                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Tender Document Approval</td>
                                                <td><?php if($result['tender_document_approved'] == 'Y') {
                                                        echo "Yes";
                                                    }else if($result['tender_document_approved'] == 'N') {

                                                        echo "No";
                                                    }else{
                                                        echo "NA";
                                                    }?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Tender call Number </td>
                                                <td><?php echo $result['tender_call_no']; ?></td>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Re-Tender</td>
                                                <td><?php if($result['re_tender_status'] == 'Y') {
                                                        echo "Yes";
                                                    }else if($result['re_tender_status'] == 'N') {

                                                        echo "No";
                                                    }else{
                                                        echo "NA";
                                                    }?> </td>
                                            </tr>
                                            <tr>
                                                <td> <i class="material-icons" style="position: relative;top: 8px;">done</i> Reason for Re-tender </td>
                                                <td><?php if(!empty($result['remarks_for_retender']) ) {

                                                        echo $result['remarks_for_retender'];
                                                    } else{ echo "XXXX"; }?> </td>
                                                <td>&nbsp</td>
                                                <td>&nbsp</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <div class="col-md-12 align-right p-r-0">
                                            <?php $edit_link = site_url().'/Procurement/pre_tender_stage?project_id='.base64_encode($project_id); ?>
                                            <a href='<?php echo $edit_link; ?>'  class="btn bg-blue waves-effect">
                                                <i class="material-icons">create</i>
                                                <span> EDIT </span>
                                            </a>
                                        </div>

                                    </div>


                                    <div class="table-responsive m-b-30">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <tbody>
                                            <tr>
                                                <td width="230px">
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i>  Date of revised / Final publising date
                                                </td>
                                                <?php $date = date_create($result_tender['final_date_rfp_publish']); ?>
                                                <td><?php echo date_format($date,"F d Y"); ?></td>

                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Date of revised/Final RFP ending date
                                                </td>
                                                <?php $date = date_create($result_tender['final_date_rfp_close']); ?>
                                                <td><?php echo date_format($date,"F d Y"); ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Technical bid opning date
                                                </td>
                                                <?php $date = date_create($result_tender['tech_bid_opening_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                                <td width="230px">
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Financial bid opning date
                                                </td>
                                                <?php $date = date_create($result_tender['finance_bid_opening_date']); ?>
                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Agreement date
                                                </td>
                                                <?php $date = date_create($result_tender['agreement_date']); ?>

                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Agreement cost
                                                </td>
                                                <td> <?php echo $result_tender['agreement_cost']; ?>  </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Agreement end date
                                                </td>
                                                <?php $date = date_create($result_tender['agreement_end_date']); ?>
                                                <td><?php echo date_format($date,"F d Y"); ?></td>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Selected bidder's name
                                                </td>
                                                <td> <?php echo $result_tender['bidder_details']; ?> </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Selected bidder's Re name
                                                </td>
                                                <td><?php echo  $result_tender['representative_name']; ?></td>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> BG Amount
                                                </td>
                                                <td><?php echo  $result_tender['bg_amount']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> Other details of bidder
                                                </td>
                                                <td><?php echo  $result_tender['other_bidder_details']; ?></td>
                                                <td>
                                                    <i class="material-icons" style="position: relative;top: 8px;">done</i> BG Validity
                                                </td>

                                                <?php $date = date_create($result_tender['bg_validity_date']); ?>

                                                <td> <?php echo date_format($date,"F d Y"); ?> </td>

                                            </tr>

                                            </tbody>
                                        </table>

                                        <div class="col-md-12 align-right p-r-0">
                                            <?php $edit_link = site_url().'/Procurement/tender_stage?project_id='.base64_encode($project_id); ?>
                                            <a href='<?php echo $edit_link; ?>'  class="btn bg-blue waves-effect">
                                                <i class="material-icons">create</i>
                                                <span> EDIT </span>
                                            </a>
                                        </div>

                                    </div>

                                </div>
                                <?php if(!empty($project_id)) {?>
                                    <?php echo form_open('Procurement/final_step?project_id='.base64_encode($project_id),array('name'=> 'final','id'=> 'final')); ?>
                                    <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />

                                <?php }else{
                                    echo form_open('Procurement/final_step', array('name' => 'final', 'id' => 'final'));
                                } ?>

                                <div class="col-sm-12">

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Remarks, if any :
                                        </label>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-line">
                                            <textarea class="form-control no-resize" name="extra_remarks" placeholder="Please type what you want..."><?php echo $extra_remarks; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 align-center" style="margin-top: -21px;">
                                <input class="btn bg-indigo waves-effect" name="submit" value="SAVE" type="submit">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Select -->

    </div>
</section>