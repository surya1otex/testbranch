<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
        <div class="block-header">
          <h4>Project Tendering - Technical Evaluation</h4>
        </div>
            </div>
            <div class="col-md-6">
        <!--<a href="#"  class="btn bg-indigo waves-effect pull-right">
          <i class="fas fa-plus"></i>
          <span>ADD PROJECT </span>
          </a>-->
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
                                <table id="project_approval_list" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
									  
                                      $i = 1;
                                      if(is_array($published_tender_data)){
                                        foreach ($published_tender_data as $app) {
                                 
                                                   
							  $project_status_ar =$CI->Published_tender_model->fetchSingledata('tendering_technical_evalution', 'project_id', $app->project_id); 
							  $stage_status =$project_status_ar[0]->approval_status;
							  if ($stage_status == "Y"){
								  
								  $status_class = "success";
								  $status_view = "Completed";
							  } else if ($stage_status == "P"){
								  
								  $status_class = "danger";
								  $status_view = "Pending";
							  }
							  else
							  {
								  
								  $status_class = "primary";
								  $status_view = "In Progress";
							  }
							  
							    
                                      ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id); ?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project dashboard</span>
                                        </span></a></td>


                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->area_name; ?></td> 
                                            <td>
                                            
											<span class="label label-<?php echo $status_class; ?>"><?php echo $status_view; ?></span>
                                            
                                            
                                            </td> 
                                            <td>
                                              
                                            <a class="btn bg-primary waves-effect" title="" href="<?php echo base_url();?>Technical_Evalution/manage?project_id=<?php echo base64_encode($app->project_id); ?>">
											<i class="fa fa-pencil-alt"></i> Modify
											</a>
                                              
                                              
                                            </td>
                                        </tr>

                                      <?php $i++; } } ?>

                                        
                                        
                                        
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
<!-- Modal -->

<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#project_approval_list').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>
