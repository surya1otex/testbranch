<?php $CI =& get_instance();?>

    <!-- Bootstrap Select Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4> My Priority Actions </h4>
            </div>

            <!-- Search Start -->
            <div class="row clearfix">
                
              
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project ID</th>
                                            <th>Project Name</th>
                                            <th>Type </th>
                                            <th>Stage</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php
										
										/*echo "<pre>";
										print_r($rejectedData);
										echo "</pre>";*/
                                      $i = 1;
                                      if(is_array($pendingapprovalData)){
                                        foreach ($pendingapprovalData as $app) {
                                          
                                       
                                      ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $app->project_code; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id); ?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                           
                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->stage; ?></td>
                                            <td>
                                            <?php
											$stage_id = $app->stage_id;
											if ($stage_id == "1") { // Project Conceptualisaion Stage
												
                                          	$redirect_url = base_url().'project/project_conceptualisation?project_id='.base64_encode($app->project_id);
											}
											else if ($stage_id == "2") { // Project Preparation Stage
                                          	$redirect_url = base_url().'project/project_preparation?project_id='.base64_encode($app->project_id);
											}
											else if ($stage_id == "3") { // Project Pre tender Stage
                                          	$redirect_url = base_url().'project/project_pre_tender?project_id='.base64_encode($app->project_id);
											}											
											else if ($stage_id == "4") { // Project Tender Stage
                                          	$redirect_url = base_url().'project/project_tender?project_id='.base64_encode($app->project_id);
											}											
											else if ($stage_id == "5") { // Project Aggrement Stage
                                          	$redirect_url = base_url().'project/project_agreement?project_id='.base64_encode($app->project_id);
											}
											?>
                                            
                                            <a class="m-r-10 col-black" href="<?php echo $redirect_url; ?>">
<i class="fas fa-edit"></i>
</a>
                                            
                                          
                                            </td>
                                            <td>  <a style="text-decoration:none;" class="btn-sm btn-success m-r-10" title="Approve" href="<?php echo base_url();?>project_approval/approve?project_id=<?php echo base64_encode($app->project_id);?>&stage_id=<?php echo base64_encode($app->stage_id);?>">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                Approve
                                                </a>
                                                <a style="text-decoration:none;" class="btn-sm btn-danger" title="Reject" href="<?php echo base_url();?>project_approval/reject?project_id=<?php echo base64_encode($app->project_id);?>&stage_id=<?php echo base64_encode($app->stage_id);?>">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                Reject
                                                </a></td>
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
                 
            <!-- Project Details Modal Start -->
      		
  
                                    
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
         columns: [
            {"width": "5%"},
            {"width": "15%"},
            {"width": "20%"},
            {"width": "15%"},
            {"width": "15%"},
            {"width": "5%"},
            {"width": "25%"}
        ]
        });

    })
</script>


    
    









 
    
    