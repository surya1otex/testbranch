<?php $CI =& get_instance();?>

    <!-- Bootstrap Select Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4> Ongoing Project List </h4>
            </div>

            <!-- Search Start -->
            <div class="row clearfix">
                
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="card">
                    <?php /*echo "<pre>";
										print_r($pendingapprovalData);
										echo "</pre>";*/ ?>
                        
                        <div class="body">
                            <div class="">
                                <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Stage</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                     <?php
										
										/*echo "<pre>";
										print_r($rejectedData);
										echo "</pre>";*/
                                      $i = 1;
                                      if(is_array($approved_project_Data)){
                                        foreach ($approved_project_Data as $app) {
                                          
                                       
                                      ?>
                                        <tr>
                                              <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id);?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $app->stage; ?></td>
                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->area_name; ?></td>
                                             
                                           <td>
                                                <a  href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id);?>" class="btn bg-primary waves-effect" title="Project Dashboard"><i class="fa fa-cogs"></i> View Dashboard</a>
                                            </td>

                                        </tr>

                                       <?php $i++; } }
									  else {
									  ?>
                                       <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
									  <?php } ?>

                                       
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>                  
            <!-- Search End --> 
                 
          
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 400px; overflow: auto;">
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>  
                                    
            <!--Project Details MOdal End -->          
			
    <!-- START WELCOME MODAL MESSAGE  -->
    		<div id="welcome-modal" class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">


</div>	
	<!-- End WELCOME MODAL MESSAGE  -->
          

        </div>
    </section>
    
     <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>   
<script type="text/javascript">
        <?php
	 $login_type = $_GET['type'];
	 
	if ($login_type == "login"){
	?>
	 $(document).ready(function() {

    
	load_details();
	//$('#initial_modal').modal('show');
	 });
	<?php
	} 
	?>
	</script>
    
    <script type="text/javascript">
function load_details()
{
         var Rurl = "<?php echo base_url();?>Userdashboard/modalwelcomemsgDetails";
        $.ajax({
            type: 'GET',
            url: Rurl,
            success: function (output) {
            $('#welcome-modal').html(output).modal('show');//now its working
            },
            error: function(output){
            alert("fail");
            }
	 });
	
 
}
</script>

<script type="text/javascript">
        //datatable//
        $(function() {

        $('#all_project').DataTable({
        responsive: true,
    bLengthChange: false,
          columns:[
                {"width": "5%"},
                {"width": "20%"},
                {"width": "20%"},
                {"width": "15%"},
                {"width": "15%"},
                {"width": "10%"}
            ]
        });

    })
</script>


    
    









 
    
    