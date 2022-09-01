<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>PROJECT LIST</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <a href="<?php echo site_url();?>/Procurement/pre_tender_stage"  class="btn bg-indigo waves-effect pull-right">
                  <i class="fas fa-plus"></i>
                  <span>ADD PROJECT </span>
                </a>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <!--<th>Category </th>
                                            <th>Area</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                //$project_area= $CI->project_area($pro_dtl['project_area']);
                                                //$project_type= $CI->project_type($pro_dtl['project_type']);
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $pro_dtl['project_name']?></td>
                                            <!--<td><?php /*echo $project_type[0]['project_type']*/?></td>-->
                                           <!-- <td><?php /*echo $project_area[0]['name']*/?></td>-->
                                            <td>
                                                <a href="<?php echo site_url(); ?>/Procurement/pre_tender_stage?project_id=<?php echo base64_encode($pro_dtl['id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>
                                                <!--<a href="<?php /*echo base_url();?>Project/project_other_setting?project_id=<?php echo base64_encode($pro_dtl['id']);*/?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a>
                                                <a href="<?php /*echo base_url();*/?>Project/project_activity?project_id=<?php /*echo base64_encode($pro_dtl['id']);*/?>" class="btn btn-success waves-effect" title="Activity"><i class="fas fa-boxes"></i> Activities</a>
                                                <a href="<?php /*echo base_url();*/?>Project/project_work_item?project_id=<?php /*echo base64_encode($pro_dtl['id']);*/?>" class="btn btn-warning waves-effect" title="Work Item"><i class="fas fa-cubes"></i> Work Item</a>
                                                <a href="<?php /*echo base_url();*/?>Project/project_work_item?project_id=<?php /*echo base64_encode($pro_dtl['id']);*/?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>-->
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
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>


    <!-- Jquery DataTable Plugin Js -->
    <!-- <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script> -->
