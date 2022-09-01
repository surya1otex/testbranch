<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>PROJECT MONITORING LIST</h4>
                </div>
            </div>
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive" style="overflow-x: unset;">
                                <table class="table table-bordered table-striped table-hover project-monitoring dataTable">
                                    <thead>
                                        <tr>
                                            <th width="2%" style="text-align: center; vertical-align: middle;">Sl No</th>
                                            <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;">Category </th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;">Area</th>
                                            
                                            <th width="18%" style="text-align: center; vertical-align: middle;">Financial Progress</th>
                                            <th width="18%" style="text-align: center; vertical-align: middle;">Physical Progress</th>
                                            
                                            <th width="22%" style="text-align: center; vertical-align: middle;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                //echo CI_VERSION;
                                                // echo "<pre>"; print_r($pro_dtl); //die();   
                                                // if($pro_dtl['id'] == 1)
                                                //     continue;
                                                $project_area= $CI->project_area($pro_dtl['project_area']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);
                                                $project_financial_progress_details_ar = $CI->project_financial_progress_details($pro_dtl['id']);
                                                $project_financial_progress_percentage = $project_financial_progress_details_ar['project_completion_percentage'];

                                                $project_physical_progress_details_ar = $CI->project_physical_progress_details($pro_dtl['id']);
                                                //echo "<pre>"; print_r($project_physical_progress_details_ar); die(); 
                                                $project_physical_progress_percentage = $project_physical_progress_details_ar['project_physical_completion_percentage'];
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>"><?php echo $pro_dtl['project_name']?></a></td>
                                            <td><?php echo $project_type[0]['project_type']?></td>
                                            <td><?php echo $project_area[0]['name']?></td>

                                            <td>
                                                <span style="font-size:10px;"><strong>0%</strong></span>   <span style="float:right; font-size:10px;"><strong>100%</strong></span>     
                                                <div class="progress" style="background-color: blanchedalmond;" title="<?php echo $project_financial_progress_percentage; ?>% Completed">
                                                    <div class="progress-bar bg-green" role="progressbar"  aria-valuenow="<?php echo $project_financial_progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_financial_progress_percentage; ?>%"></div>
                                                </div> 
                                            </td>
                                            <td>
                                                <span style="font-size:10px;"><strong>0%</strong></span>   <span style="float:right; font-size:10px;"><strong>100%</strong></span>
                                                <div class="progress" style="background-color: blanchedalmond;" title="<?php echo $project_physical_progress_percentage; ?>% Completed">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo $project_physical_progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_physical_progress_percentage; ?>%"></div>
                                                </div>
                                            </td>    

                                            <td>
                                                <a href="<?php echo base_url();?>Monitoring/financial_listing?project_id=<?php echo base64_encode($pro_dtl['id']);?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-warning waves-effect" title="Financial Monitoring"><i class="fas fa-tasks"></i> Financial</a>
                                                <a href="<?php echo base_url();?>Monitoring/physical_listing?project_id=<?php echo base64_encode($pro_dtl['id']);?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-primary waves-effect" title="Physical Monitoring" ><i class="fas fa-people-carry"></i> Physical</a>
                                            </td>
                                        </tr>
                                      <?php $i++;}}else{?>
                                                <tr><td colspan="7">No data found</td></tr>
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
