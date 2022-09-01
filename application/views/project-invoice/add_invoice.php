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
                                        </td>
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

        <div class="row clearfix ">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>ADD INVOICE DETAILS  </h4>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo $project_details[0]['project_name']; ?> </h2>
                    </div>
                    <div class="body">
                        <?php echo form_open('projectInvoice/add_invoice',array('name'=> 'add_invoice','id'=>'add_invoice')); ?>
                        <input type="hidden" name="project_id" value="<?php  echo $_REQUEST['project_id'];?>" />
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;"> Invoice No : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Invoice No" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class=" input-xlarge"  style="vertical-align:middle; padding-top:8px;"> Invoice Date : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input type="text" id="invoice_date" name="invoice_date" class="datepicker form-control" placeholder="Invoice Date">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;"> Amount (₹): </label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-line">
                                            <input type="text" id="total_invoice_amount" onkeypress="allowNumbersOnly(event)" name="amount_paid" class="form-control" placeholder="Claimed Amount" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;"> Vendor's Name : </label>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="invoice_vendor" name="vendor" class="form-control show-tick">
                                            <option value="">Select Vendor</option>
                                            <?php foreach ($vendors as $vendor){ ?>
                                                <option value="<?php echo $vendor['id'];?>"><?php echo $vendor['vendor']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="body">
                                    <div class="col-md-12 p-l-10 p-r-10">
                                        <div class="header p-l-0 p-r-0 p-b-10">
                                            <h2> Payment Amount Breakup </h2>
                                        </div>

                                        <div class="table-responsive">
                                            <span id='err_span' style="display: none;color:#ff0000"></span>
                                            <table id="amount_brkup_tbl" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th> Head </th>
                                                    <th style="padding: 10px 5px;"> Details</th>
                                                    <th style="padding: 10px 5px;"> Amount</th>
                                                    <th style="padding: 10px 5px;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="tr_1">

                                                    <td>
                                                        <select name="head[]" class="head form-control show-tick">
                                                            <option value="">Please Select</option>
                                                            <?php foreach ($head as $headList){?>
                                                                <option value="<?php echo $headList['id']; ?>"><?php echo $headList['major_head']; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                    </td>
                                                    <td> <input name="details[]" require="" type="text" class="form-control details"/> </td>
                                                    <td> <input name="amount[]" onkeypress="allowNumbersOnly(event)"  require="" type="text" class="form-control amount"/></td>
                                                    <td>
                                                        <a id="add_1" href="javascript:void(0);" onclick="addBreakupRow();"  class="btn bg-blue waves-effect">
                                                            <i class="material-icons col-black">add</i>
                                                        </a>
                                                        <a id="del_1" href="javascript:void(0);" style="display: none;" class="btn bg-blue waves-effect">
                                                            <i class="material-icons col-black">delete</i>
                                                        </a>
                                                    </td>
                                                </tr>


                                                </tbody>
                                            </table>
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
                                            <textarea name="remarks" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-2 col-md-offset-5 text-center" style="margin-top: -21px;">

                                <input type="submit" name="submit" onclick="checkSubmitStatus(event );" value="SUBMIT" class="btn bg-blue waves-effect" />
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>


<script type="text/javascript">
    $(document).ready(function() {
    $(document.body).on('click', "[id^='del_']", function () {
        var elementId = $(this).attr('id');
        var id = elementId.split("_");

        $("#tr_"+id[1]).remove();
    });

});

function addBreakupRow(){

    var last_id =  $('#amount_brkup_tbl tr:last').attr('id');
    var id = last_id.split("_");
    var next_id = parseInt(id[1]) + 1;
    var html = $("#tr_1").clone().attr('id', 'tr_'+next_id );
    html.find("#del_1").attr('id','del_'+next_id);
    html.find("#add_1").attr('id','add_'+next_id);


    $('#amount_brkup_tbl tr:last').after(html)
    $('#del_'+next_id).show();
    $('#add_'+next_id).hide();
}

function checkSubmitStatus( event ){

    $('.error').hide();
    var flag_err = 0 ;
    if($("#invoice_no").val() == ''){
        flag_err++;
        $('#invoice_no').after("<span class='error' style='color:#ff0000'>Invoice no cannot be blank.</span>");
        //event.preventDefault();
    }
    if($("#invoice_date").val() == ''){
        flag_err++;
        $('#invoice_date').after("<span class='error' style='color:#ff0000'>Invoice date cannot be blank.</span>");
        //event.preventDefault();
    }
    if($("#invoice_vendor").val() == ''){
        flag_err++;
        $('#invoice_vendor').after("<span class='error' style='color:#ff0000'>Please select a vendor.</span>");
        //event.preventDefault();
    }

    var total_break_up = 0;
    var total_amount = parseInt($("#total_invoice_amount").val());

    $('#amount_brkup_tbl').find('.amount').each(function (i, input) {

        var $input = $(input);
        total_break_up = parseInt(total_break_up) + parseInt($(input).val());

    });

    if( isNaN(total_break_up) && isNaN(total_amount) ){

        $('#total_invoice_amount').after("<span class='error' style='color:#ff0000'>Invice amount cannot be zero.</span>");
        event.preventDefault();
        //return false;
    } else if (total_break_up != total_amount) {

        $('#err_span').show();
        $('#err_span').html("Total invoice amount is not matched with the total brakeup amount.");
        event.preventDefault();
        //return false;
    }else {
        $('#err_span').html('');

    }

    $('#amount_brkup_tbl').find('.details').each(function (i, input) {

        var $input = $(input);

        if ($(input).val() == '') {
            $(input).after("<span class='error' style='color:#ff0000'>Details cannot be blank.</span>");
            event.preventDefault();
        }
    });
    $('#amount_brkup_tbl').find('.head').each(function (i, input) {

        var $input = $(input);

        if ($(input).val() == '') {
            $(input).after("<span class='error' style='color:#ff0000'>Plese select a head.</span>");
            event.preventDefault();
        }
    });

    if( flag_err > 0 ){
        event.preventDefault();
    }
}
</script>
