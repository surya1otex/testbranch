<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h4>All Roles List</h4>
				</div>
            </div>
            <div class="col-md-6">
				<a href="<?php echo base_url('roles/create'); ?>"  class="btn bg-indigo waves-effect pull-right">
				  <i class="fas fa-plus"></i>
				  <span>ADD ROLES </span>
			    </a>
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
                                <table id="roles_list" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Role Name</th>
                                            <th>Default Page </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $i = 1; 
                                        if(is_array($roleData)){
                                            foreach ($roleData as $role) {
                                          if($role->status == 'Y'){
                                            $st = '<span class="label label-success">Active</span>';
                                          }else{
                                            $st = '<span class="label label-warning">Inactive</span>';
                                          }

                                          $edit_action = base_url().'roles/create?roleId='.base64_encode($role->id);

                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $role->role; ?></td>
                                            <td><?php echo $role->lebel; ?></td>
                                            <td><?php echo $st; ?></td>
                                            <td>
                                                <a class="btn-sm btn-primary" href="<?php echo $edit_action; ?>" title="Edit" style="text-decoration:none;"><i class="fas fa-edit" aria-hidden="true"></i> Edit</a>
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



<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#roles_list').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>