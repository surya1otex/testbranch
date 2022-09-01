<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h4>Project List - Tender</h4>
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
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $i = 1; 
                                        if(is_array($project_pending_data)){
                                            foreach ($project_pending_data as $key) {
                                          if($key->approve_status == 'Y'){
                                            $st = '<span class="label label-danger">Pending</span>';
                                          }elseif ($key->approve_status == 'R') {
                                            $st = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($key->approver_id != $user_id && $key->project_creator_id == $user_id){
                                               $st = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'project/project_tender?project_id='.base64_encode($key->project_id);

                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($key->project_id);?>">
                                            <span class="ntip"><?php echo $key->project_name;?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a></td>
                                            <td><?php echo $key->project_type; ?></td>
                                            <td><?php echo $key->area_name; ?></td>
                                            <td><?php echo $st; ?></td>
                                            <td>
                                                
                                                <a href="<?php echo $edit_action; ?>" class="btn bg-red" title="Entry"><i class="fa fa-plus"></i> Entry</a>
                                                
                                                
                                            </td>
                                        </tr>

                                    <?php $i++; } } ?>

                                   <!--  end for pending -->

                                    <?php 
                                        $k = $i; 
                                        if(is_array($pp_tender_data)){
                                            foreach ($pp_tender_data as $key) {
                                          if($key->approve_status == 'Y'){
                                            $st = '<span class="label label-success">Approved</span>';
                                          }elseif ($key->approve_status == 'R') {
                                            $st = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($key->approver_id != $user_id && $key->project_creator_id == $user_id){
                                               if($key->draft_mode == 'Y'){
                                                  $st = '<span class="label label-warning">Draft</span>';   
                                                }else{
                                                    $st = '<span class="label label-warning">Submitted</span>'; 
                                                }
                                            }else{
                                                if($key->draft_mode == 'Y'){
                                                  $st = '<span class="label label-warning">Draft</span>';   
                                                }else{
                                                    $st = '<span class="label label-warning">Pending</span>'; 
                                                }
                                                
                                            }
                                            
                                          }

                                          $edit_action = base_url().'project/project_tender?project_id='.base64_encode($key->project_id);

                                        ?>

                                        <tr>
                                            <td><?php echo $k; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($key->project_id);?>">
                                            <span class="ntip"><?php echo $key->project_name;?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a></td>
                                            <td><?php echo $key->project_type; ?></td>
                                            <td><?php echo $key->area_name; ?></td>
                                            <td><?php echo $st; ?></td>
                                            <td>
                                                <?php
                                                if($key->approver_id == $user_id){
                                                ?>
                                                <a href="<?php echo $edit_action; ?>" class="btn bg-primary" title="Modify"><i class="fa fa-cog"></i> Modify</a>
                                                 
                                                <?php }elseif ($key->approver_id != $user_id && $key->approve_status != 'Y') {
                                                ?>
                                                <a href="<?php echo $edit_action; ?>" class="btn bg-primary" title="Modify"><i class="fa fa-cog"></i> Modify</a>
                                                <?php }

                                                ?>
                                                
                                            </td>
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