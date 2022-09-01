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
                                            <th>Approved On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
									 // print_r($approved_project);
									   if(!empty($approved_project)){
                                               $i=1;
                                               foreach($approved_project as $pro_dtl){
                                                $project_area= $CI->project_area($pro_dtl['project_area']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);
												
                                                $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$pro_dtl['id'],'status','Y');
                                                $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$pro_dtl['id'],'status','Y');
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $pro_dtl['project_code']?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?>
                                            <span class="ntiptext">Click to view the project dashboard</span>
                                            </span>
                                            </a>
                                            </td>
                                            <td><?php echo !empty($pro_dtl['project_type']) ? $project_type[0]['project_type'] : "--"?></td>
                                            <td><?php 
										if (!empty ($pro_dtl['aa_date'])) {
										 $approve_date = new DateTime($pro_dtl['aa_date']); 
										
										
										echo $approve_date->format('jS M Y');} else { echo "--"; } ?></td>
                                              
                                              <td>
                                                     
                                                       
                                                <a href="<?php echo base_url();?>pf_planning/project_other_setting?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a>
                                                <div class="notification">
                                                <a href="<?php echo base_url();?>pf_planning/project_activity?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-success waves-effect" title="Activity"><i class="fas fa-boxes"></i> Activities</a>
                                                <?php if($pro_activity_cnt > 0){ ?>
                                                <span class="label-count2 bg-blue"><?php echo $pro_activity_cnt; ?></span>
                                            <?php } ?>
                                                </div>

                                                <div class="notification">
                                                <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($pro_dtl['id']);?>" class="btn btn-warning waves-effect" title="Work Item"><i class="fas fa-cubes"></i> Work Item</a>
                                                <?php if($pro_work_item_cnt > 0){ ?>
                                                <span class="label-count2 bg-blue"><?php echo $pro_work_item_cnt; ?></span>
                                                <?php } ?>
                                                </div>

                                                <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($pro_dtl['id']);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
                                                    
                                                    
                                                    
                                            </td>
                                        </tr>

                                      <?php $i++;}}?>
                                        

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
            {"width": "10%"},
            {"width": "20%"},
            {"width": "10%"},
            {"width": "10%"},
            {"width": "45%"}
        ]
        });

    })
</script>


    
    









 
    
    