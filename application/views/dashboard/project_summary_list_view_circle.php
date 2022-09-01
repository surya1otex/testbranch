<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h4><?php echo $project_list_type.' Lists'; ?></h4>
				</div>
            </div>
            <div class="col-md-6">
				
			</div>
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
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <table id="project_list" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Area</th>
                                            <th>Circle</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $k =1; 
                                        if(is_array($project_list)){
                                            foreach ($project_list as $project) {
                                        ?>

                                        <tr>
                                            <td><?php echo $k; ?></td>
                                            <td>
                                                <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project->id);?>">
                                                <span class="ntip"><?php echo $project->project_name;?>
                                                <span class="ntiptext">Click to view the project reports</span>
                                                </span>
                                            </a>
                                           </td>
                                            <td><?php echo $project->project_type; ?></td>
                                            <td><?php echo $project->area_name; ?></td>
                                            <td><?php echo $project->circlename; ?></td>
                                            
                                        </tr>



                                       <?php $k++; } } ?>

                                        
                                        
                                        
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
       
            $(function() {
            
            $('#project_list').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>