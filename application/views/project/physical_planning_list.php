<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>PLANNING PROJECT LIST</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body table-responsive">
                            <div class="">
                                <table <?php echo !empty($project_deatail) ? 'id="project"' : ''; ?> class="table table-bordered table-striped  table-hover">
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
                                            <td><a href="<?php echo base_url();?>Project/porject_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>"><?php echo $pro_dtl['project_name']?></a></td>
                                            <td><?php echo !empty($pro_dtl['project_type']) ? $project_type[0]['project_type'] : "--"?></td>
                                            <td><?php echo !empty($pro_dtl['project_area']) ? $project_area[0]['name']: "--"?></td>
                                            <td>
                                                <?php if($finalcial_module_permission){ ?>
                                                    <a href="<?php echo base_url();?>Project/project_other_setting?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a>
                                                <?php } ?>
                                                <?php if( $pro_dtl['status'] == 'Y'){ ?>
                                                    <a href="<?php echo base_url();?>Project/project_activity?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-success waves-effect" title="Activity"><i class="fas fa-boxes"></i> Activities</a>
                                                    <a href="<?php echo base_url();?>Project/project_work_item?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-warning waves-effect" title="Work Item"><i class="fas fa-cubes"></i> <?php echo $CI->get_project_monitoring_type($pro_dtl['id']);?></a>
                                                    <a href="<?php echo base_url();?>Project/project_planning?project_id=<?php echo base64_encode($pro_dtl['id']);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                      <?php $i++;}} else { ?>
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

<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            //datatable//
            $(function() {
			
           $('#project').DataTable()
         
        })
        </script>