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

                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="align-right"><strong> Total </strong> </td>
                                    <td> <i class="fa fa-rupee-sign"></i> <strong><?php echo $total_amount[0]['total_amount']; ?></strong></td>

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
                                            <?php $in_date = new DateTime($date);
                                            echo $in_date->format('jS M Y'); ?>
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
        </div>
</section>

