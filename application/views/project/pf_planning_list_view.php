<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>All Project List</h4>
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
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                $project_area= $CI->project_area($pro_dtl['location_id']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);

                                                $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$pro_dtl['id'],'status','Y');
                                                $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$pro_dtl['id'],'status','Y');
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a></td>
                                            <td><?php echo !empty($pro_dtl['project_type']) ? $project_type[0]['project_type'] : "--"?></td>
                                            <td><?php echo !empty($pro_dtl['location_id']) ? $project_area[0]['name']: "--"?></td>
                                            <td>
                                                
                                                <!-- <a href="<?php //echo base_url();?>pf_planning/project_other_setting?project_id=<?php //echo base64_encode($pro_dtl['id']);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a> -->
                                                <div class="notification">
                                                <a href="<?php echo base_url();?>pf_planning/project_activity?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-success waves-effect" title="Activity"><i class="fas fa-boxes"></i> Activities</a>
                                                <?php if($pro_activity_cnt > 0){ ?>
                                                <span class="label-count2 bg-blue"><?php echo $pro_activity_cnt; ?></span>
                                            <?php } ?>
                                                </div>

                                                <div class="notification">
                                                <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-warning waves-effect" title="Stage"><i class="fas fa-cubes"></i> Stage</a>
                                                <?php if($pro_work_item_cnt > 0){ ?>
                                                <span class="label-count2 bg-blue"><?php echo $pro_work_item_cnt; ?></span>
                                                <?php } ?>
                                                </div>

                                                <a href="<?php echo base_url();?>pf_planning/project_planning?project_id=<?php echo base64_encode($pro_dtl['id']);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
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
			
           $('#project').DataTable({
            columnDefs: [ 
            { width: 370, targets: 4 }]
           }
            )
         
        })
        </script>