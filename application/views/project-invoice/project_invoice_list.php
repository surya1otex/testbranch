<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>PROJECT INVOICE LIST</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body table-responsive">
                                <table <?php echo !empty($project_deatail) ? 'id="project-invoice"' : ''; ?>  class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Area</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                $project_area= $CI->project_area($pro_dtl['project_area']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            

                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a></td>
                                            <td><?php echo $project_type[0]['project_type']?></td>
                                            <td><?php echo $project_area[0]['name']?></td>
                                            <td>
                                                <a href="<?php echo base_url();?>projectInvoice/invoice_list?project_id=<?php echo base64_encode($pro_dtl['id']);?>#invoice" class="btn btn-primary waves-effect" title="Invoice"><i class="fas fa-sliders-h"></i> Invoice</a>

                                            </td>
                                        </tr>
                                      <?php $i++;}}else{?>
                                                <tr><td colspan="5">No data found</td></tr>
                                      <?php } ?>
                                        
                                        
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>
<style>

    .dataTables_filter {
        float: right !important;
    }
    .dataTables_paginate {
        float: right !important;
    }

</style>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script>

    //datatable//
    // $(function() {

    //     $('#project-invoice').DataTable({

    //         responsive: true,
    //         columns: [
    //             {"width": "5%"},
    //             {"width": "50%"},
    //             {"width": "50%"},
    //             {"width": "50%"},
    //             {"width": "50%"}
    //         ]
    //     });
    // })


</script>

<script type="text/javascript">
       
            $(function() {
            
            $('#project-invoice').DataTable({
            responsive: true
            });
         
        })
    </script>

