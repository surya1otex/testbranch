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
                
               
                <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>My Priority Actions</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered">

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
            </div>-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Type </th>
                                            <th>Stage</th>
                                            <th>Status</th>
                                            <th>Action Required</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php
										/*echo "<pre>";
					print_r($this->session->userdata);
					echo "</pre>";*/
										/*echo "<pre>";
										print_r($project_pending_data_pretender);
										echo "</pre>";*/
                                      $i = 1;
                                      if(is_array($rejectedData)){
                                        foreach ($rejectedData as $app) {
											
											 if($app->approve_status == 'Y'){
                                            $st = '<span class="label label-success">Approved</span>';
                                          }elseif ($app->approve_status == 'R') {
                                            $st = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($app->approver_id != $user_id && $app->project_creator_id == $user_id){
                                               $st = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }
                                          
                                       
                                      ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($app->project_id); ?>">
                                            <span class="ntip"><?php echo $app->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                           
                                            <td><?php echo $app->project_type; ?></td>
                                            <td><?php echo $app->stage; ?></td>
                                            <td><?php echo $st; ?></td>
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
                                               <a class="btn-sm btn-primary" href="<?php echo $redirect_url; ?>" title="" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Update
</a> 
										<?php
										
          $edit_action = base_url().'project/project_preparation?project_id='.base64_encode($app->project_id);
          $edit_action = base_url().'project/project_pre_tender?project_id='.base64_encode($app->project_id); 
          $edit_action = base_url().'project/project_tender?project_id='.base64_encode($app->project_id);
          $edit_action = base_url().'project/project_agreement?project_id='.base64_encode($app->project_id);
		  		
										?>

                                                
                                            </td>
                                            <td> <button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $app->project_id.','.$app->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button>
                                                 
                                                </td>
                                        </tr>

                                      <?php $i++; } }
									 
									  ?>
									 
									 <!--FOR PENDING DATA DPR QUERY START-->
										<?php 
                                        $q = $i; 
                                        if(is_array($project_pending_data_dpr)){
                                            foreach ($project_pending_data_dpr as $key) {
                                          if($key->approve_status == 'Y'){
                                            $st = '<span class="label label-warning">Pending</span>';
                                          }elseif ($key->approve_status == 'R') {
                                            $st = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($key->approver_id == $user_id && $key->project_creator_id == $user_id){
                                               $st = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'project_dpr/project_dpr?project_id='.base64_encode($key->project_id);

                                        ?>

                                        <tr>
                                            <td><?php echo $q; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($key->project_id); ?>">
                                            <span class="ntip"><?php echo $key->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $key->project_type; ?></td>
                                            <td><?php echo $key->stage; ?></td>
                                            <td><?php echo $st; ?></td>
                                            <td>
                                               
                                     <a class="btn-sm btn-success m-l-10" href="<?php echo $edit_action; ?>" title="Entry" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Entry
</a>           
                                            </td>
                                            <td><button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $key->project_id.','.$key->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button></td>
                                        </tr>

                                    <?php $q++; } } ?>
									 <!--FOR PENDING DATA  ADMINSTRATIVE APPROVAL QUERY START-->
										<?php 
                                        $r = $i; 
                                        if(is_array($project_pending_data_administrative_approval)){
                                            foreach ($project_pending_data_administrative_approval as $key2) {
                                          if($key2->approve_status == 'Y'){
                                            $st2 = '<span class="label label-warning">Pending</span>';
                                          }elseif ($key2->approve_status == 'R') {
                                            $st2 = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($key2->approver_id == $user_id && $key2->project_creator_id == $user_id){
                                               $st2 = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st2 = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'project_administrative_approval/manage?project_id='.base64_encode($key2->project_id);

                                        ?>

                                        <tr>
                                            <td><?php echo $r; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($key2->project_id); ?>">
                                            <span class="ntip"><?php echo $key2->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $key2->project_type; ?></td>
                                            <td><?php echo $key2->stage; ?></td>
                                            <td><?php echo $st2; ?></td>
                                            <td>
                                               
                                     <a class="btn-sm btn-success m-l-10" href="<?php echo $edit_action; ?>" title="Entry" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Entry
</a>           
                                            </td>
                                            <td><button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $key2->project_id.','.$key2->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button></td>
                                        </tr>

                                    <?php $r++; } } ?>
									 <!--FOR PENDING DATA PRE CONSTRUCTION ACTIVITES QUERY START-->
										<?php 
                                        $s = $i; 
                                        if(is_array($project_pending_data_pre_construction)){
                                            foreach ($project_pending_data_pre_construction as $key3) {
                                          if($key3->approve_status == 'Y'){
                                            $st3 = '<span class="label label-warning">Pending</span>';
                                          }elseif ($key3->approve_status == 'R') {
                                            $st3 = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($key3->approver_id == $user_id && $key3->project_creator_id == $user_id){
                                               $st3 = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st3 = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'pre_consttruction_activity/settings?project_id='.base64_encode($key3->project_id);
                                          

                                        ?>

                                        <tr>
                                            <td><?php echo $s; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($key3->project_id); ?>">
                                            <span class="ntip"><?php echo $key3->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $key3->project_type; ?></td>
                                            <td><?php echo $key3->stage; ?></td>
                                            <td><?php echo $st3; ?></td>
                                            <td>
                                               
                                     <a class="btn-sm btn-success m-l-10" href="<?php echo $edit_action; ?>" title="Entry" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Entry
</a>           
                                            </td>
                                            <td><button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $key3->project_id.','.$key3->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button></td>
                                        </tr>

                                    <?php $s++; } } ?>

          <!--FOR PENDING DATA tender QUERY START-->
                    <?php 
                                        $tendersl = $s; 
                                        if(is_array($project_pending_data_tender)){
                                            foreach ($project_pending_data_tender as $tenderkey) {
                                          if($tenderkey->approve_status == 'Y'){
                                            $tenderst = '<span class="label label-warning">Pending</span>';
                                          }elseif ($tenderkey->approve_status == 'R') {
                                            $tenderst = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($tenderkey->approver_id == $user_id && $tenderkey->project_creator_id == $user_id){
                                               $tenderst = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st3 = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'Project_tender_publishing/manage?project_id='.base64_encode($tenderkey->project_id);
                                          

                                        ?>

                                        <tr>
                                            <td><?php echo $tendersl; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($tenderkey->project_id); ?>">
                                            <span class="ntip"><?php echo $tenderkey->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $tenderkey->project_type; ?></td>
                                            <td><?php echo $tenderkey->stage; ?></td>
                                            <td><?php echo $tenderst; ?></td>
                                            <td>
                                               
                                     <a class="btn-sm btn-success m-l-10" href="<?php echo $edit_action; ?>" title="Entry" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Entry
</a>           
                                            </td>
                                            <td><button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $tenderkey->project_id.','.$tenderkey->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button></td>
                                        </tr>

                                    <?php $tendersl++; } } ?>

                                    <!--FOR PENDING DATA tender QUERY START-->
                    <?php 
                                        $agreesl = $tendersl; 
                                        if(is_array($project_pending_data_aggre)){
                                            foreach ($project_pending_data_aggre as $agreekey) {
                                          if($agreekey->approve_status == 'Y'){
                                            $tenderst = '<span class="label label-warning">Pending</span>';
                                          }elseif ($agreekey->approve_status == 'R') {
                                            $tenderst = '<span class="label label-danger">Rejected</span>';
                                          }else{
                                            if($agreekey->approver_id == $user_id && $agreekey->project_creator_id == $user_id){
                                               $tenderst = '<span class="label label-warning">Submitted</span>'; 
                                            }else{
                                               $st3 = '<span class="label label-warning">Pending</span>'; 
                                            }
                                            
                                          }

                                          $edit_action = base_url().'Project_agreement/manage?project_id='.base64_encode($agreekey->project_id);
                                          

                                        ?>

                                        <tr>
                                            <td><?php echo $agreesl; ?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($agreekey->project_id); ?>">
                                            <span class="ntip"><?php echo $agreekey->project_name; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $agreekey->project_type; ?></td>
                                            <td><?php echo $agreekey->stage; ?></td>
                                            <td><?php echo $tenderst; ?></td>
                                            <td>
                                               
                                     <a class="btn-sm btn-success m-l-10" href="<?php echo $edit_action; ?>" title="Entry" style="text-decoration:none;">
<i class="fas fa-edit" aria-hidden="true"></i>
Entry
</a>           
                                            </td>
                                            <td><button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_project_history_details(<?php echo $agreekey->project_id.','.$agreekey->stage_id; ?>)" >
                                                    <i class="material-icons">chat</i>
                                                </button></td>
                                        </tr>

                                    <?php $agreesl++; } } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>                  
            <!-- Search End --> 
                 
            <!-- Project Details Modal Start -->
      		<!--<div class="modal fade" id="pdetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 400px; overflow: auto;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>-->    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 400px; overflow: auto;">
            <!--<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
    <tbody>

                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <tbody>
                    <tr>
                        <td><i class="fas fa-info"></i> <span>Status :</span></td>
                        <td>
                                <span class="label label-danger">Rejected</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="250px"><i class="fas fa-calendar-check"></i> <span> Project Approve Date :

                            </span></td>

                        <td> December 11 2020 </td>
                    </tr>
                    <tr>
                        <td width="250"><i class="fa fa-user-circle" aria-hidden="true"></i>

                            <span>
                               Approved By :
                               
                            </span>

                        </td>
                        <td>
                          Mr. Nil Gupta
                        </td>

                    </tr>
                    <tr>
                        <td><i class="fa fa-comments" aria-hidden="true"></i>  <span>Remarks</span> </td>
                        <td> Information missing. (Project’s group name, Project’s location)  </td>

                    </tr>

                    </tbody>
                </table>




    </tbody>
</table>-->
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

    
	//load_details();
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
            {"width": "35%"},
            {"width": "10%"},
            {"width": "15%"},
            {"width": "10%"},
            {"width": "20%"},
            {"width": "5%"}
        ]
        });

    })
</script>

<script type="text/javascript">
    function get_project_history_details( project_id, stage_id ){
      //alert(project_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Userdashboard/get_project_history_data",
            data: {project_id: project_id,stage_id:stage_id},
            success: function(data) {
              //console.log(data);
                $('.modal-body').html(data);
            }
        });
    }
   
        </script>
    
    









 
    
    