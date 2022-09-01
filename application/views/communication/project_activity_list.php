<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css">
<section class="content">
        <div class="container-fluid">
				<div class="block-header">
					<h4>Communications Projects List</h4>
				</div>
            
                  
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <?php //print_r($projects); ?>
                                <table id="all_project" class="table table-bordered table-striped table-hover project-monitoring dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>Communication</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php
                                            $cnt =1;
                                            $index =0;
                                            foreach($projects as $project) { ?>
                                             <tr>                                        
                                            <td><?php echo $cnt; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project->projectid); ?>">
                                                <span class="ntip"><?php echo $project->project_name ?> <span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                        </td>
                                            <td><?php echo $project->project_type ?></td>
                                            <td><?php echo $project->name ?></td>
                                            <td><?php echo $project->communication; ?></td>
                                            <td>
<!--                                                 <a href="<?php echo base_url(); ?>Document_upload/manage?project_id=<?php echo base64_encode(); ?>" class="btn bg-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Update</a> -->
                                                <a href="<?php echo base_url(); ?>Issues/issue_lists?project_id=<?php echo base64_encode($project->projectid); ?>" class="btn bg-primary waves-effect"><i class="fa fa-solid fa-list"></i>&nbsp;Communication Trail</a>
                                                <a href="<?php echo base_url(); ?>Issue_create/manage?project_id=<?php echo base64_encode($project->projectid); ?>" class="btn bg-primary waves-effect"><i class="fa fa-solid fa-plus"></i>&nbsp;New</a>
                                                
                                            </td>
                                        </tr>

                                       <?php $cnt++; $index++; } ?>
                                        



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
    
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script type="text/javascript">
        //datatable//
        $(function() {

        $('#all_project').DataTable({
        responsive: true,
        bLengthChange: false

        });

    })
</script>




 
    
    