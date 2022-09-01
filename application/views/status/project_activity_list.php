<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css">
<section class="content">
        <div class="container-fluid">
				<div class="block-header">
					<h4>Projects List</h4>
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
                                            <th>Issue</th>
                                            <th>Action</th>
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
                                            <td><?php echo $project->issuecount ?></td>
                                            <td>

                                                <?php
                                                if($user_type_id == 37) { ?>
                                                <a href="<?php echo base_url(); ?>Updatestatus/issuedetails?project_id=<?php echo base64_encode($project->projectid); ?>" class="btn bg-primary waves-effect"><i class="fa fa-solid fa-list"></i>&nbsp;Details</a>
                                                 <?php } else { ?>

                                                <a href="<?php echo base_url(); ?>Updatestatus/manage?project_id=<?php echo base64_encode($project->projectid); ?>" class="btn bg-primary waves-effect"><i class="fa fa-solid fa-list"></i>&nbsp;Modify</a>
                                                  <?php } ?>
                                                
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




 
    
    