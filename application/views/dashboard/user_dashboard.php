<?php $CI =& get_instance();?>

    <!-- Bootstrap Select Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>USER-DASHBOARD</h4>
            </div>

            <!-- Search Start -->
            <div class="row clearfix">
                
               
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>My Details</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered camelcase">

                            <tbody>
                            <tr>
                                <th scope="row"><i class="fa fa-user m-r-10"></i><b> Name :</b></th>
                                <td><?php echo $user_details[0]['firstname']. " ".$user_details[0]['lastname']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-cogs m-r-10"></i><b> Designation :</b></th>
                                <td><?php echo $user_details[0]['designation']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-mobile m-r-15"></i> <b>Mobile No :</b></th>
                                <td><?php echo $user_details[0]['mobile']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-envelope m-r-10"></i> <b>Email ID :</b></th>
                                <td><?php echo $user_details[0]['email']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-list m-r-10"></i> <b>Logged in as :</b></th>
                                <td><?php echo $role_details[0]['role']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            </div>                  
            <!-- Search End -->
            
                                        
			
    <!-- START WELCOME MODAL MESSAGE  -->
    <div id="welcome-modal" class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">


</div>

	
	<!-- End WELCOME MODAL MESSAGE  -->
          

        </div>
    </section>
    
    
<script src = "<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<script src = "<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"> </script>
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
    
    









 
    
    