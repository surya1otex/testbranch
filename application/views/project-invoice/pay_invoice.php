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

<?php $CI =& get_instance();?>
<section class="content" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">

        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project Summary of Revitalization of <?php echo $project_details[0]['project_name']; ?></h2>
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
                                    <td><?php echo $project_details[0]['area_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Type : </td>
                                    <td><?php echo $project_details[0]['type_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Estimated Cost : </td>
                                    <td><?php echo $project_details[0]['estimate_total_cost']; ?> INR</td>
                                </tr>
                                <tr>
                                    <td>Start Date : </td>
                                    <td>
                                        <?php $start_date = new DateTime($project_details[0]['project_start_date']);
                                        echo $start_date->format('jS M Y'); ?>
                                        <?php //echo $project_details[0]['project_start_date']; ?></td>
                                </tr>
                                <tr>
                                    <td>End Date : </td>
                                    <td>
                                        <?php $end_date = new DateTime($project_details[0]['project_end_date']);
                                        echo $end_date->format('jS M Y'); ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>INVOICE</h2>
                    </div>
                    <div class="body">
                        <div class="col-md-6 col-md-offset-3 p-0">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td> <strong> Invoice No : </strong></td>
                                    <td> <?php echo $invoice_details[0]['invoice_no']; ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td> <strong> Invoice Date : </strong></td>
                                    <td> <?php $invoice_date = new DateTime($invoice_details[0]['invoice_date']);
                                        echo $invoice_date->format('jS M Y'); ?></td>
                                </tr>
                                <tr>
                                    <td> <strong> Vendor Name : </strong></td>
                                    <td> <?php  $vendor_details= $CI->get_vendor_name($invoice_details[0]['vendor_id']);

                                        echo $vendor_details[0]['vendor'];
                                        ?> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <div class="header">
                        <h2>INVOICE DETAILS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th > Head </th>
                                    <th style="padding: 10px 5px;"> Description</th>
                                    <th style="padding: 10px 5px;"> Total Amount</th>
                                    <!--<th style="padding: 10px 5px;"> Paid</th>
                                    <th style="padding: 10px 5px;"> Due</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($invoice_breakup_details as $invoice_breakup){?>
                                <tr>
                                    <td><?php $account_head =  $CI->get_head_name($invoice_breakup['major_head_id']);

                                        echo $account_head[0]['major_head']; ?> </td>
                                    <td> <?php echo  $invoice_breakup['details']; ?></td>
                                    <td> <i class="fa fa-rupee-sign"></i> <?php echo  $invoice_breakup['amount']; ?></td>
                                    <!--<td> <i class="fa fa-rupee-sign"></i> 500</td>
                                    <td> <i class="fa fa-rupee-sign"></i> 500</td>-->
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="align-right"><strong> Total </strong> </td>
                                    <td> <i class="fa fa-rupee-sign"></i> <strong><?php echo $total_amount[0]['total_amount']; ?></strong></td>
                                    <!--<td> <i class="fa fa-rupee-sign"></i> <strong> 1200</strong></td>
                                    <td> <i class="fa fa-rupee-sign"></i> <strong> 1900</strong></td>-->
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <?php if(!empty($payment_history) > 0){?>
                        <div class="header">
                            <h2> PAYMENT HISTORY </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <?php foreach ($payment_history as $date => $history){?>
                                    <tr>
                                        <td>
                                            <?php if( $date != '0000-00-00'){
                                            $in_date = new DateTime($date);
                                            echo $in_date->format('jS M Y');}else { echo "NA";} ?>
                                        </td>
                                        <td>
                                            <table class="table table-bordered table-striped m-b-0">
                                                <thead>
                                                <tr>
                                                    <th > Head </th>
                                                    <th style="padding: 10px 5px;"> Total Amount</th>
                                                    <th style="padding: 10px 5px;"> Paid Amount</th>
                                                    <th style="padding: 10px 5px;"> Due Amount</th>
                                                    <th style="padding: 10px 5px;"> Remarks </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php for( $i = 0 ;$i < count($history); $i++){ ?>
                                                <tr>
                                                    <td><?php  $account_head =  $CI->get_head_name($history[$i]['major_head_id']);

                                                        echo $account_head[0]['major_head']; ?>  </td>
                                                    <td> <i class="fa fa-rupee-sign"></i> <?php
                                                        echo $CI->get_total_head_amount($history[$i]['invoice_id'] , $history[$i]['major_head_id']);
                                                        ?></td>
                                                    <td> <i class="fa fa-rupee-sign"></i> <?php echo $history[$i]['paid_amount'];?></td>
                                                    <td> <i class="fa fa-rupee-sign"></i> <?php echo $history[$i]['due_amount'];?></td>
                                                    <td> <?php echo $history[$i]['remarks'];?></td>
                                                </tr>
                                                <?php } ?>

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>


        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> PAYMENT NOW </h2>
                    </div>
                    <div class="body cloneBox1">
                        <?php /*echo form_open('ProjectInvoice/payment_invoice',array('name'=> 'payment_invoice','id'=>'payment_invoice')); */?>
                        <form action="<?php echo site_url();?>/ProjectInvoice/payment_invoice" onsubmit="return confirm('Do you really want to submit the form?');"name="payment_invoice" id="payment_invoice" method="post" accept-charset="utf-8">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td style="width: 25%">
                                        <div class="col-md-12">
                                            <label class=" input-xlarge" ><i class="fa fa-calendar"></i> Payment Date : </label>
                                            <div class="form-line">
                                                <input type="text" id="payment_date" name="payment_date" class="datepicker form-control" placeholder="Payment Date">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <table id="payment_tbl" class="table table-bordered table-striped m-b-0">
                                            <thead>
                                            <tr>
                                                <th > Head </th>
                                                <th style="padding: 10px 5px;"> Due Amount</th>
                                                <th style="padding: 10px 5px;"> Amount</th>
                                                <th style="padding: 10px 5px;"> Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($j = 0; $j < count($invoice_head_arr); $j++){   ?>
                                            <tr>
                                                <td><input id="invoice_id" name="invoice_id" type="hidden" value="<?php echo  $invoice_details[0]['id']; ?>"  />
                                                    <input id="account_head" name="account_head[<?php echo $invoice_head_arr[$j]['major_head_id']; ?>]" type="hidden" value="<?php echo  $invoice_details[0]['id']; ?>"  />

                                                    <label><?php  $account_head =  $CI->get_head_name($invoice_head_arr[$j]['major_head_id']);

                                                        echo $account_head[0]['major_head']; ?></label>
                                                </td>
                                                <td> <i class="fas fa-rupee-sign"></i> <input  name="account_head[<?php echo $invoice_head_arr[$j]['major_head_id']; ?>][due_amount]" type="hidden" value="<?php echo $CI->get_due_amount($invoice_head_arr[$j]['major_head_id'],$invoice_details[0]['id']) ?>"  />
                                                    <span><?php echo $CI->get_due_amount($invoice_head_arr[$j]['major_head_id'],$invoice_details[0]['id']) ?></span> </td>
                                                <td> <div class="col-md-2 left m-t-5"><i class="fas fa-rupee-sign"></i></div>
                                                    <div class="col-md-10 p-l-0"><input type="text" onkeypress="allowNumbersOnly(event)" name="account_head[<?php echo $invoice_head_arr[$j]['major_head_id']; ?>][amount_paid]" class="form-control"/></div>
                                                </td>
                                                <td>
                                                    <div class="form-line">
                                                        <textarea name="account_head[<?php echo $invoice_head_arr[$j]['major_head_id']; ?>][remarks]" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-md-2 col-md-offset-5 text-center" style="margin-top: -21px;">
                       <!-- <a href="#"  class="btn bg-blue waves-effect"><span> PAY </span></a>-->
                        <input type="submit" name="submit" onclick="checkSubmitStatus(event );" value="PAY" class="btn bg-blue waves-effect " />
                    </div></form>
                    <br clear="all">

                </div>
            </div>
        </div>

    </div>
</section>
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
                <p>Do you really want to procced these request? This process cannot be undone.</p>
            </div>
            <div id="modal_btn" class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button  type="submit" class="btn btn-danger" id="submit_modal" >Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<script>


    $(document).ready(function() {



    });
    function checkSubmitStatus(event){
        $('.error').hide();
        var flag_err = 0 ;
        var payment_date = $("#payment_date").val();
        if( payment_date == '' ){
            flag_err++;
            $("#payment_date").after("<span class='error' style='color:#ff0000'>Payment date cannot be blank.</span>");

        }
        $('#payment_tbl').find('input').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                flag_err++;
                $(input).after("<span class='error' style='color:#ff0000'>Field cannot be blank.</span>");

            }
        });
        if( flag_err > 0 ){
            event.preventDefault();
        }


    }

</script>