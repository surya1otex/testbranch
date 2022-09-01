<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
        <div class="block-header">
          <h4>Project Initiation & Planning - Pending Approval</h4>
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
                                            <th>Stage</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
									  	//echo "<pre>";
										//print_r($approvalData);
                                      $i = 1;
                                      if(is_array($approvalData)){
                                        foreach ($approvalData as $app) {
                                          $CI->load->model('Project_approval_model');
                                          $progress =$CI->Project_approval_model->get_project_progress_data($app->project_id,$app->stage_id); 
											
										if($progress[0]['progress'] == 'Y'){
                                            $st = '<span class="label label-success">Approved</span>';
                                          }elseif ($progress[0]['progress'] == 'R') {
                                            $st = '<span class="label label-danger">Rejected</span>';
                                          }elseif ($progress[0]['progress'] == 'I') {
                                            $st = '<span class="label label-warning">In Progress</span>';
                                          }else{
                                            
                                               $st = '<span class="label label-danger">Pending</span>'; 
                                           
                                            
                                          }
                                          
                                       
                                      ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id); ?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a></td>

                                            

                                            <td><?php echo $app->stage; ?></td>
                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->area_name; ?></td>                                            
                                            <td><?php echo $st; ?></td>
                                            <td>
                                              <?php
                                              if($app->approve_status == 'N'){
                                              ?>
                                            <a class="btn btn-info waves-effect" title="" href="<?php echo base_url();?>project_approval/update_status?project_id=<?php echo base64_encode($app->project_id);?>&stage_id=<?php echo base64_encode($app->stage_id);?>">
											<i class="fa fa-check-circle"></i> Update Status
											</a>
                                              <?php }elseif ($app->approve_status == 'Y') {
                                               ?>
                                               <span class="label label-success">Approved</span>
                                              <?php }elseif ($app->approve_status == 'R') { ?>
                                                <span class="label label-danger">Rejected</span>
                                              <?php } ?>
                                              <td>
                                                <button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $app->project_id.','.$app->stage_id; ?>)"><i class="material-icons">chat</i></button>

                                              </td>
                                              
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
          <div class="modal-header">
            <h4 class="modal-title" id="defaultModalLabel">Approved / Rejected History</h4>
        </div>
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
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>
<script type="text/javascript">
    function get_project_history_details( project_id, stage_id ){
      //alert(project_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>project_approval/get_project_history_data",
            data: {project_id: project_id,stage_id:stage_id},
            success: function(data) {
              //console.log(data);
                $('#app_result_data').html(data);
            }
        });
    }
            //datatable//
            $(function() {
			
            $('#project_approval').DataTable({
        			responsive: true
        			});
         
        })
        </script>