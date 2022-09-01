<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h4>Revise Projects List</h4>
				</div>
            </div>
            <div class="col-md-6">
				<!--<a href="#"  class="btn bg-indigo waves-effect pull-right">
				  <i class="fas fa-plus"></i>
				  <span>ADD PROJECT </span>
			    </a>-->
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
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 1;
                                        if(is_array($project_list_data)){
                                            foreach ($project_list_data as  $value) {
                                                # code...

                                                $edit_action = base_url().'Project_creation/manage?project_id='.base64_encode($value->id);

                                         
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $value->project_name; ?>
                                        </td>
                                            <td><?php echo $value->project_type_name; ?></td>
                                            <td><?php echo $value->area_name; ?></td>
                                            <td><span class="label label-success">New</span></td>
                                            <td>
                                                <a href="<?php echo $edit_action; ?>" class="btn bg-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Modify</a>   
                                                
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