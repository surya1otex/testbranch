<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
        <div class="block-header">
          <h4>Progress Update Offline</h4>
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
                         <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         <?php echo $this->session->flashdata('danger'); ?>
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
                                            <th>Area</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $i = 1;
                                      if(is_array($physical_progress_list_Data)){
                                        foreach ($physical_progress_list_Data as $app) {
                                          
                                       $action = base_url().'physical_progress/create?project_id='.base64_encode($app->project_id);
                                       $visit_action = base_url().'projectVisitReport/visit_report?project_id='.base64_encode($app->project_id);
                                      ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id); ?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a></td>
                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->area_name; ?></td>
                                            <td>
                                             
                                                <a class="btn-sm btn-primary m-r-5" href="<?php echo $action; ?>" title="Update Progress" style="text-decoration:none;"><i class="fas fa-plus" aria-hidden="true"></i>
                                                Update Progress
                                                </a>  <a class="btn-sm btn-primary" href="<?php echo $visit_action; ?>" title="View Visit Report" style="text-decoration:none;"><i class="fas fa-eye" aria-hidden="true"></i>
                                                View Visit Report
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" id="app_result_data" style="max-height: 400px; overflow: auto;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#project_approval_list').DataTable({
            responsive: true,
            columnDefs: [ 
            { width: 250, targets: 4 }]
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>
