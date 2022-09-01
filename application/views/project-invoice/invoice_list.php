<?php $CI =& get_instance();?>
<section class="content">
    <div class="container-fluid">

        <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project Summary of <?php echo $project_details[0]['project_name']; ?></h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>Project Name : </td>
                                    <td>
                                    
                                    <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project_details[0]['id']); ?>">
                                            <span class="ntip"><?php echo $project_details[0]['project_name']; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                    </td>
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
            <div class="col-md-6">
                <div class="block-header">
                    <h4>INVOICE LIST</h4>
                </div>
            </div>
            <div class="col-md-6">
              <span  class="pull-right">
                  <a href="<?php echo base_url(); ?>projectInvoice/add_invoice?project_id=<?php echo base64_encode($project_details[0]['id']); ?>" class="btn bg-indigo waves-effect pull-right">
                    <i class="fas fa-plus"></i>
                    <span> Add Invoice </span>
                  </a>
              </span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th> Sl No </th>
                                    <th> Invoice no </th>
                                    <th> Vender </th>
                                    <th> Total Amount </th>
                                    <th> Paid </th>
                                    <th> Due </th>
                                    <th> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;foreach ( $invoice_list as $invoice){?>
                                <tr>
                                    <td> <?php echo $i; ?></td>
                                    <td> <?php echo $invoice['invoice_no']; ?></td>
                                    <td><?php  $vendor_details= $CI->get_vendor_name($invoice['vendor_id']);

                                        echo $vendor_details[0]['vendor'];
                                    ?> </td>
                                    <td> <i class="fas fa-rupee-sign"></i> <?php $total_invoice_amount = $CI->get_total_invoice_amount($invoice['id']);
                                        echo $total_invoice_amount[0]['total_amount'];
                                    ?></td>
                                    <td> <i class="fas fa-rupee-sign"></i> <?php echo $invoice['amount_paid']; ?></td>
                                    <td> <i class="fas fa-rupee-sign"></i> <?php echo $total_invoice_amount[0]['total_amount'] - $invoice['amount_paid']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url();?>projectInvoice/view_invoice?invoice_id=<?php echo base64_encode($invoice['id']);?>"  class="btn bg-blue waves-effect">
                                            <i class="material-icons col-black">visibility</i>
                                            <span> VIEW </span>
                                        </a>
                                        <a href="<?php echo base_url();?>projectInvoice/pay_invoice?invoice_id=<?php echo base64_encode($invoice['id']);?>" class="btn bg-orange waves-effect">
                                            <i class="material-icons col-black">visibility</i>
                                            <span> PAY </span>
                                        </a>
                                        <?php $history_check_flag = $CI->check_payment_histroy($invoice['id']); ?>
                                        <?php if(!$history_check_flag ){
                                            $disble = 'disabled="disabled"'; $link="javascript:void(0);";
                                        }else{
                                            $disble = "";
                                            $link= base_url().'projectInvoice/edit_invoice?invoice_id='.base64_encode($invoice['id']).'&project_id='.base64_encode($project_details[0]['id']);
                                        }?>
                                        <a href="<?php echo $link; ?>"  <?php echo $disble; ?>class="btn bg-teal waves-effect">
                                            <i class="material-icons col-black">settings</i>
                                            <span> EDIT </span>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>