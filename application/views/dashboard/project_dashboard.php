<?php $CI =& get_instance();?>

    <!-- Bootstrap Select Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<section class="content">
        <div class="container-fluid">
         	<div class="col-md-12">
				<div class="block-header">
					<h4>Project Dashboard - <?php echo $project_detail[0]['project_name']; ?></h4>
				</div>
            </div>
          <?php   
		  /* echo "<pre>";
		print_r($project_detail);
		  echo "</pre>";*/
		  $CI->tab_content();
		  
		  ?>  

       <?php //include('tab_project_info_dashboard.php') ?>
       
      <!--Visit Report Photographs -->  
        <?php
                $imagesData = $CI->project_images_data($project_id);
                // echo "<pre>";
                // print_r($imagesData);
                // die();
                if(!empty($imagesData)){
                ?>
            <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
            <div class="header">
            <h2>Visit Report Photographs</h2>
            </div>
              <div class="body">
                  <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                  
                    <?php
                                foreach ($imagesData as $imgs) {
                                    if($imgs['gateway'] == 'W'){
                                   $img_file = base_url().'uploads/mobilevisitreport/'.$imgs['image'];
                                    }else{
                                        $img_file = visitReportImagePath.'mobilevisitreport/'.$imgs['image'];
                                    }

                                 ?>

                     
                    <div class="col-md-2 col-sm-6 col-xs-6">
                        <a href="<?php echo $img_file; ?>" data-sub-html="Demo Description">
                          <img class="img-responsive thumbnail" src="<?php echo $img_file; ?>">
                        </a>
                    </div>
                    
                    
                    
                            <?php } ?>

                  </div>
                </div>

            </div>
        </div>
    </div>
    
        <?php } ?>
        <!--Work Items - Budget & Released-->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                  <div style="float:left">  <h2>Project Overview - Planned, Earned & Paid</h2></div>
                                   <div style="float:right">
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="percentage" onclick="type_button(this.value);"    type="button"><strong>%</strong></button>
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="actual"  onclick="type_button(this.value);"   type="button"><strong>Rs.</strong></button>
                                    </div>
                                    <div style='clear:both'></div>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                
                                  <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#stage" data-toggle="tab">Stages Overview</a></li>
                                        <li role="presentation"><a href="#activity" onclick="activityFunction();" data-toggle="tab">Activities Overview </a></li>
                                 </ul>
                            
                            
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="stage"> 
                                <div id = "budget_released" style = "min-width: 550px; height: 400px; margin: 0 auto"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="activity">
                                     <div id = "activity_view" style = "min-width: 550px; min-height: 600px; margin: 0 auto"></div>
                                </div>
                            </div>
                                 
                                <!--<div id="budget_released" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Work Items - Budget & Released-->
                
        		<div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card"> <div class="header">
                        
                       <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> <h2>Overall Project Progress </h2>
                       </div>
                       <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-line">
                                    <select class="form-control show-tick" id="work_item_id">
                                        <option value="0">Select Stage</option>
                                        <?php
                                        if (!empty($project_work_item)) {
                                            foreach ($project_work_item as $key => $value) {
                                                $work_item_id = $value['work_item_id'];
                                                $work_item_name = $value['work_item_name'];
                                                ?>
                                                <option value="<?php echo $work_item_id; ?>"><?php echo $work_item_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
                       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                 <div class="form-line">
                                    <select class="form-control show-tick" name="activity_id" id="activity_id">
                                        <option value="0">Select Activity</option>

                                        <?php
                                        if (!empty($project_activity)) {
                                            foreach ($project_activity as $key => $value) {
                                                $work_item_id = $value['activity_id'];
                                                $work_item_name = $value['activity_name'];
                                                ?>
                                                <option value="<?php echo $work_item_id; ?>"><?php echo $work_item_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
                                    <div style='clear:both'></div>
                       </div>
                       <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
                       
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="percentage" onclick="type_buttonwi(this.value);"    type="button"><strong>%</strong></button>
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="actual"  onclick="type_buttonwi(this.value);"   type="button"><strong>Rs.</strong></button>
                       </div>
                                
                                  
                                    <div style='clear:both'></div>
                            </div>
                            <div class="body">
                              <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">Monthly Overview</a></li>
                                <li role="presentation"><a href="#profile" onclick="cumulativeFunction();" data-toggle="tab">Cumulative Overview </a></li>
                            </ul>
                            
                            
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home"> 
                                <div id = "financial_data" style = "min-width: 550px; height: 400px; margin: 0 auto"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                     <div id = "financial_datacum" style = "min-width: 550px; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            
                            

                                
                            </div>
                        </div>
                    </div>
                    </div>
                    
                <div class="row clearfix">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Tendering Individual Project Overview</h2>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                <div id="container1" style = "width: 100%;  margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
            </div>

                    
                <!--Work Items - Budget & Released-->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header">
                                <h2>Pre-Construction Overview</h2>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                <div id="project_pre_construction_overview" style = "width: 100%;  margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="header">
                                <h2>Pre-Construction Fund Overview</h2>

                            </div>
                            <div class="body">
                                 <div id="project_pre_construction_cost" style = "width: 100%;  margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Work Items - Budget & Released-->

                
        
    <?php  if(!empty($project_agreement)){ ?>
     
        		<div class="row clearfix">
                
       			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           
                            <div class="header">
                             <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ><h2>Project Stages With Activities</h2>
                             </div>
                             <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" > <label for="email_address_2">Choose a Category :</label>
                             </div>
                             <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
                            <div class="form-line">
                                    <select class="form-control show-tick" id="work_item_type">
                                        <?php
                                        $wi = 1;
                                        if (!empty($work_item_categories)) {
                                            foreach ($work_item_categories as $key => $value) {
                                                $work_item_type_id = $value['id'];
                                                $work_item_type_name = $value['type_name'];
                                                ?>
                                                <option value="<?php echo $work_item_type_id; ?>" <?php if($wi == 1){echo 'selected'; } ?>><?php echo $work_item_type_name; ?></option>
                                                <?php
                                                $wi++;
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                             </div>
                           
                              <div style='clear:both'></div>

                         </div>
                            
                            <div class="body p-10">
                                <div class="row clearfix">
                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">

                                        <div class="panel-group" id="accordion_2" role="tablist"
                                             aria-multiselectable="true">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
    			</div>
     
      
        <?php  } ?>

        <?php  if(!empty($project_issue)){ ?>

           <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                  <div class="card">
                           
                    <div class="header">
                         <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ><h2>Project Issue Status</h2>
                         </div>
                   
                          <div class="body">
                                    
                                        <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Issue Description</th>
                                                    <th>Action Taken</th>
                                                    <th>Status</th>
                                                    <th>Updated By</th>
                                                    <th>Updated Date</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                               <?php
                                              
                                                $slno = 1;
                                               foreach($project_issue as $issue) { ?>

                                                    <tr>
                                                        <td><?php echo $slno; ?></td>
                                                        <td><?php echo $issue->issuename ?></td>
                                                        <td><?php echo $issue->actiontaken ?></td>
                                                        <td><?php echo $issue->status == "Y" ? Closed : Open ?></td> 
                                                        <td><?php echo $issue->createdby ?></td>
                                                        
                                                        <td><?php $dt = new DateTime($issue->date); echo $dt->format('jS M Y'); ?></td>
                                                        
                                                    </tr>
                                                <?php  $slno++; } ?>
                                               
                                                
                                            </tbody>
                                        </table>
                                     
                           </div>               
                          <div style='clear:both'></div>

                       </div>
                                        
                    </div>

                    </div>
                </div>

        <?php } ?>
    
      <!--Project Milestone With Activities --> 
      <?php
                if(!empty($project_milestone)){
                ?>
                
    	<!--	<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           
                            <div class="header">
<h2>Project Milestone With Activities</h2>
</div>
                            
                            <div class="body p-10">
                                <div class="row clearfix">
                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">

                                        <div class="panel-group" id="accordion_2" role="tablist" aria-multiselectable="true">
                                        
                                         <?php 
                                               $i=1;
                                               foreach($project_milestone as $milestone){
                                                
                                      	?>
                                        <div class="panel panel-col-teal">
                    					<div class="panel-heading" role="tab" id="heading1">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse<?php echo $i; ?>"aria-expanded="false" aria-controls="collapse">
                            <i class="fas fa-align-justify"></i> <?php echo !empty($milestone['milestone']) ? $milestone['milestone'] : "NA"; ?>
                            </a>
                        </h4>
                    </div>
                    					<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                        <div class="panel-body p-5" style="font-size: 11px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr class="bg-blue-grey">
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activities</th>
                                        <th colspan="2" style="text-align: center; vertical-align: middle;">Physical</th>
                                         <th rowspan="2" style="text-align: center; vertical-align: middle;">Completion Date</th>
                                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Last Reported</th>
                                    </tr>
                                    <tr class="bg-blue-grey"><th style="text-align: center; vertical-align: middle;">Weightage</th>
                                        <th style="text-align: center; vertical-align: middle;">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                           <?php 
									   //print_r($sof_preparation);
									   $milestone_id = $milestone['id'];
									   $milestone_activity = $CI->project_milestone_activity($milestone_id,$project_id); 
									   
									    /*echo "<pre>";
		  print_r($milestone_activity);
		  echo "</pre>";*/
									     if(!empty($milestone_activity)){ 
                                               $c=1;
                                               foreach($milestone_activity as $activitydata){
												   
									
									   $activity_id = $activitydata['id'];
									   $progress_activity = $CI->project_progress_activity($milestone_id,$activity_id,$project_id); 			   
                                       /* echo "<pre>";
		  print_r($progress_activity);
		  echo "</pre>";        */
                                      ?>
                                        <tr style="text-align: center; vertical-align: middle;">
                                                    <td><?php echo $c; ?></td>
                                                    <td><?php echo !empty($activitydata['particulars']) ? $activitydata['particulars'] : "NA"; ?></td>
                                                    <td><?php echo !empty($activitydata['weightage']) ? $activitydata['weightage'] : "NA"; ?></td>
                                                    <td>
                                                     <?php if( $activitydata['completion_status'] == 'Y'){
                                        echo "Completed";
                                    } else if( $activitydata['completion_status'] == 'N'){
                                        echo "Pending";
                                    }else{
                                        echo "NA";
                                    } ?> 
                                                    </td>
                                                    <td> <?php 
										if (!empty ($activitydata['end_date'])) {
										 $aa_date = new DateTime($activitydata['end_date']); 
										
										
										echo $aa_date->format('jS M Y');} else { echo "--"; } ?></td>
                                                    <td><?php 
										if (!empty ($progress_activity[0]['reporting_date'])) {
										 $rp_date = new DateTime($progress_activity[0]['reporting_date']); 
										
										
										echo $rp_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        </tr>
                                        
                                        <?php
											   $c++; }  } else { ?>
                                               
                                                <tr style="text-align: center; vertical-align: middle;">
                                                    <td colspan="6" align="center">No Record Found</td>
                                                    </tr>
                                                <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                						</div>
                
                
                						<?php  $i++; } ?>
              
            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
    </div>-->
    <?php } ?>

    <?php  if(!empty($project_agreement)){ ?>
      <!--Project Performance (Physical Planning) 
    		<div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Project Performance (Physical Planning)</h2>
                        </div>
                        <div class="body">
                            <div id="project_performance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
    </div> --> 
    
      <!--Vendor Overview AND Financial Overview 
    		<div class="row clearfix"> 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                       
 <?php
$vendorwisedata = $CI->get_vendor_data($project_id);
$claimed = json_encode($vendorwisedata['claimed']);

$released = json_encode($vendorwisedata['released']);
$vendor = json_encode($vendorwisedata['vendor']);

?>   
    
        				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            
                             <div class="header">
<h2>Vendor Overview</h2>
</div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div id="vendorOLD" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        
                                </div>
                            </div>
                        </div>
 
  <?php
$financialwisedata = $CI->get_financial_data($project_id);
// echo json_encode($financialwisedata);
// die();
$per =array();
for($k = 0 ; $k < count($financialwisedata) ; $k++ ){
    $financialperiod = $financialwisedata[$k]['period'];
    $financialclaimed = $financialwisedata[$k]['claimed'];
    $financialreleased = $financialwisedata[$k]['released'];


    $period_data[$k] =  $financialperiod;
    $claimedTilldate[$k] =  (int)$financialclaimed;
    $releasedtTilldate[$k] =  (int)$financialreleased;
    }

    $financial_period_data = json_encode($period_data);
    $financial_claimedTilldate = json_encode($claimedTilldate);
    $financial_releasedtTilldate = json_encode($releasedtTilldate);

// echo json_encode($period_data);
// die();
?>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            
                             <div class="header">
<h2>Financial Overview</h2>
</div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div id="financial" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        </div>
                        </div>
                        
                        
                    </div>-->
                                             
			
    <?php } ?>
    
    
                
                <!-- Financial Overview WITH monthly and Cumulative Start -->
                
                <div class="row clearfix">
                    
                </div>
                <!-- Financial Overview WITH monthly and Cumulative End -->
    <!-- START WELCOME MODAL MESSAGE  -->
    		<div id="welcome-modal" class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">


</div>	
	<!-- End WELCOME MODAL MESSAGE  -->
          

        </div>
    </section>
    

	<!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

     <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    
    
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/exporting.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script src="https://code.highcharts.com/modules/timeline.js"></script> 
    
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
    
        
    <!-- Light Gallery Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/plugins/light-gallery/js/lightgallery-all.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pages/medias/image-gallery.js"></script>

  
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
	

	 $(document).ready(function() {
		 
		var work_item_id = $("#work_item_id").val();
		//alert(work_item_id);
        var project_id = <?php echo $project_id; ?>;
		 <?php  if (!empty($project_work_item)) { ?>
        //physicalProjectPerformance(work_item_id, project_id);
		<?php } ?>

        project_overviewdata();
        project_activitydata();
		 

	 });
	 
	
	
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

<!--Vendor-->



<!--Financial Overview-->
<script type="text/javascript">





    $(document).ready(function () {

        var work_item_id = $("#work_item_id").val();
        //alert(work_item_id);
        var project_id = <?php echo $project_id; ?>;
        //physicalProjectPerformance(work_item_id, project_id);

       // $("#container_line_chart_physical").hide();

       // $('#work_item_type').val();
       // var work_item_type_id = this.value;
         var work_item_type_id = $("#work_item_type").val();
		var project_id = <?php echo $project_id; ?>;
       // var start_date = $("#start_date").val();
       // var end_date = $("#end_date").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>Projectdashboard/get_project_work_item_activity_table",
            data: {work_item_type_id: work_item_type_id, project_id: project_id},
            //dataType: "json",
            success: function (data) {
               // alert(data);
                $("#accordion_2").html(data);

            }
        });

    });

    $('#work_item_type').on('change', function () {
        //alert( this.value );
        var work_item_type_id = this.value;
        //var project_id = $("#project_id").val();
		
		var project_id = <?php echo $project_id; ?>;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>Projectdashboard/get_project_work_item_activity_table",
            data: {
                work_item_type_id: work_item_type_id,
                project_id: project_id
            },
            //dataType: "json",
            success: function (data) {

                $("#accordion_2").html(data);
                return false;
            }
        });
    })
	
	
    $('#work_item_id').on('change', function () {

        var work_item_id = $("#work_item_id").val();
        var project_id = <?php echo $project_id; ?>;
        //alert(work_item_id + "--"+ project_id);
       // $("#bar_container").show();
       // $("#container_line_chart_physical").hide();
        activtyDropDown(work_item_id);
		financial_progressmonthly();
		financial_progresscum();
        //physicalProjectPerformance(work_item_id, project_id);
    });
	
    $('#activity_id').on('change', function () {
        //$("#bar_container").hide();
       // $("#container_line_chart_physical").show();
       // project_physical_performance();
		financial_progressmonthly();
		financial_progresscum();

    });
	
	



    function activtyDropDown(work_item_id) {

        var project_id = <?php echo $project_id; ?>;
        if (work_item_id) {

            $.ajax({
                url: "<?php echo site_url();?>Projectdashboard/get_activity_dropdown",
                method: "POST",
                dataType: 'json',
                data: {work_item_id: work_item_id, project_id: project_id},
                success: function (data) {

                    $('#activity_id').html(data);

                }
            });
        }
    }

    function getUnitname(project_id, activity_id) {

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>Projectdashboard/get_unit_name",
            data: {project_id: project_id, activity_id: activity_id},
            success: function (jsonData) {
                $("#unit_name").val(jsonData);
            }
        });
    }
	

			
	function type_button(fired_button) {
					 project_overviewdata(fired_button);
					 project_activitydata(fired_button);
	}	
		
	function type_buttonwi(clicked_button) {
				 financial_progressmonthly(clicked_button);
				 financial_progresscum(clicked_button);
	}
	

    function project_overviewdata(type_show = false)
          {
              
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_project_wise_work_item_budget_data",
            dataType: "json",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_id": "<?php echo $project_id; ?>", "type_show": type_show},
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                //console.log('jdsh');
                //console.log(jsonData);
				Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				
                Highcharts.chart('budget_released', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Project Stages Overview'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: jsonData.workitem_ar,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: jsonData.value_sufx
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
						            
                        shared: true,
                        useHTML: true
                    },
                    credits: {
                        enabled: false
                    },
                    colors: [                        
                        '#374649', 
                        '#ff8b3d', 
                        '#01b8aa'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                            //colorByPoint: true
                        }
                    },
                    series: [{
                        name: 'Planned Value',
                        data: jsonData.planned_ar

                    }, {
                        name: 'Earned Value',
                        data: jsonData.earned_ar

                    }, {
                        name: 'Actual Cost',
                        data: jsonData.paid_ar

                    }]
                });

            }
        });
        
          }
		  
    function project_activitydataOLD(type_show = false)
          {
              
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_project_wise_activity_budget_data",
            dataType: "json",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_id": "<?php echo $project_id; ?>", "type_show": type_show},
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                //console.log('jdsh');
                //console.log(jsonData);
				Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				
                Highcharts.chart('activity_view', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Project Activities Overview'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: jsonData.activity_ar,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: jsonData.value_sufx
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    credits: {
                        enabled: false
                    },
                    colors: [
                        '#374649', 
                        '#ff8b3d', 
                        '#01b8aa'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                            //colorByPoint: true
                        }
                    },
                    series: [{
                        name: 'Planned Value',
                        data: jsonData.planned_ar

                    }, {
                        name: 'Earned Value',
                        data: jsonData.earned_ar

                    }, {
                        name: 'Actual Cost',
                        data: jsonData.paid_ar

                    }]
                });

            }
        });
        
          }
		  
    function project_activitydata(type_show = false)
          {
              
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_project_wise_activity_budget_data",
            dataType: "json",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_id": "<?php echo $project_id; ?>", "type_show": type_show},
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                //console.log('jdsh');
                //console.log(jsonData);
				Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				
				
				var chart = { 
				/* height: 500,*/
				height: (9 / 16 * 100) + '%',
                type: 'bar'
            };
            var title = {
               text: 'Project Activities Overview'   
            };
            var subtitle = {
               text: ''  
            };
            var xAxis = {
               categories: jsonData.activity_ar,
               title: {
                  text: null
               }
            };
            var yAxis = {
               min: 0,
               title: {
                  text: jsonData.value_sufx
                  /*align: 'high'*/
               },
               labels: {
                  overflow: 'justify'
               }
            };
            var tooltip = {
                		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
            };
            var plotOptions = {
               bar: {
                  dataLabels: {
                     enabled: true
                  }
               }
            };
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'top',
               x: -40,
               y: 20,
               floating: true,
               borderWidth: 1,
               
               backgroundColor: (
                  (Highcharts.theme && Highcharts.theme.legendBackgroundColor) ||
                     '#FFFFFF'),
               shadow: true
            };
            var credits = {
               enabled: false
            };
            var series = [{
                        name: 'Planned Value',
                        data: jsonData.planned_ar,
						color: '#374649'

                    }, {
                        name: 'Earned Value',
                        data: jsonData.earned_ar,
						color: '#ff8b3d'

                    }, {
                        name: 'Actual Cost',
                        data: jsonData.paid_ar,
						color: '#01b8aa'

                    }];
      
            var json = {};   
            json.chart = chart; 
            json.title = title;   
            json.subtitle = subtitle; 
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;  
            json.series = series;
            json.plotOptions = plotOptions;
            json.legend = legend;
            json.credits = credits;
            $('#activity_view').highcharts(json);
				
				
				
				

            }
        });
        
          }
		  
		  
		     $(document).ready(function(){
  // we call the function
  financial_progressmonthly();
  financial_progresscum();
});

function clickFunction(){

  financial_progressmonthly();
  financial_progresscum();
}	

		  
		  	function cumulativeFunction(){

  financial_progresscum();
}	  
		  	function activityFunction(){

  project_activitydata();
}	

		/*newly added by  SUDIPTA*/
		  
	function financial_progressmonthly(type_show = false)
			{
				 var work_item_id = $("#work_item_id").val();
				 var activity_id = $("#activity_id").val();
				// alert(work_item_id);
		            $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/Projectdashboard/get_finnancial_progressdata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_id": "<?php echo $project_id; ?>", "type_show": type_show, "work_item_id": work_item_id, "activity_id": activity_id},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {	
			
			Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				
		
				
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Monthly Progress'   
            };   
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
	};
	
			
            var yAxis = {
               min: 0,
               title: {
				   text: 'MONTHLY PROGRESS ('+jsonData.value_sufx+')'
               }      
            };
			var tooltip= {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    };
            var credits = {
               enabled: false
            };   
            /*var tooltip = {
               valueSuffix: jsonData.value_sufx
            };*/
            var series = [
               {
				  color: '#374649',
                  name: 'Monthly Planned Value',
                  data: jsonData.planned
               }, 
               {
				  color: '#ff8b3d',
                  name: 'Monthly Earned Value',
                  data: jsonData.earned

               }, 
               {
				  color: '#01b8aa',
                  name: 'Monthly Paid Value',
                  data: jsonData.paid

               }
            ];     
      
            var json = {};   
            json.chart = chart; 
            json.title = title; 
            json.xAxis = xAxis;
            json.yAxis = yAxis; 
            json.tooltip = tooltip;
            json.credits = credits;
            json.series = series;
            $('#financial_data').highcharts(json);
			}
        });
         
				}
		  		  
   	function financial_progresscum(type_show = false)
          	{
				
				 var work_item_id = $("#work_item_id").val();
				 var activity_id = $("#activity_id").val();
				 
				   $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/Projectdashboard/get_finnancial_cumulativedata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_id": "<?php echo $project_id; ?>", "type_show": type_show, "work_item_id": work_item_id, "activity_id": activity_id},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
				
				Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				
		
		
    		  
		  var title = {
               text: 'Cumulative Overview'   
            };
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
            };
            var yAxis = {
               title: {
                  text: 'PROGRESS ('+jsonData.value_sufx+')'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   
           /* var tooltip = {
               valueSuffix: jsonData.value_sufx
            };*/
			
			
			var tooltip= {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    };
        
            var series =  [{
				  color: '#374649',
                  name: 'Cum Planned Value (PV)',
                  data: jsonData.planned
               }, 
               {
				  color: '#ff8b3d',
                  name: 'Cum Earned Value (EV)',
                  data: jsonData.earned
               }, 
               {
				  color: '#01b8aa',
                  name: 'Cum Actual Paid (AC)',
                  data: jsonData.paid
               }
            ];

            var json = {};
            json.title = title;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
           // json.legend = legend;
            json.series = series;
            
            $('#financial_datacum').highcharts(json);}
        });
				
				}
		  
		  
		/*newly added by  SUDIPTA*/
	
</script>

<!--Project Performance (Physical Planning)-->
<!-- Project Pre-construction Overview Start -->
<script type="text/javascript">
    $(document).ready(function () {

        var project_id = <?php echo $project_id; ?>;
        tenderingprojectwise();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_project_pre_construction_overview",
            dataType: "json",
           
            data: {project_id:project_id},
           
            success: function (jsonData) {

                //alert(jsonData);
                Highcharts.chart('project_pre_construction_overview', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Pre-Construction Progress'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                       
                        categories: ['Land-Alination','Direct-Purchase','Land-Acquisition', ' Forest-Land', 'Utility-Shifting-Electrical','Utility-Shifting-PH','Utility-Shifting-RWSS','Tree-Cutting','Encrochment-Eviction']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '%'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' %'
                    },
                    credits: {
                        enabled: false
                    },
                    colors: [
                        '#374649'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                        }
                    },
                    series: [{
                         name: 'Progress',
                         data: jsonData

                    }]
                });

            }
          });

        
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_project_pre_construction_cost_chart",
            dataType: "json",
           
            data: {project_id:project_id},
           
            success: function (jsonData) {

               // alert(jsonData);
                Highcharts.chart('project_pre_construction_cost', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Fund Utilized Percent'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                       
                        categories: ['Land-Alination','Direct-Purchase','Land-Acquisition', ' Forest-Land', 'Utility-Shifting-Electrical','Utility-Shifting-PH','Utility-Shifting-RWSS','Tree-Cutting','Encrochment-Eviction']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '%'
                        }
                    },
                    tooltip: {
                        valueSuffix: '%',

                    },
                    credits: {
                        enabled: false
                    },
                    colors: [
                        '#008080'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                        }
                    },
                    series: [{
                         name: 'Fund',
                         data: jsonData

                    }
                    ]
                });

            }
          });

    });
	
	
    function tenderingprojectwise(){
		 
        var project_category_id = <?php echo $project_id; ?>;

         $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Projectdashboard/get_individual_chart",
            dataType: "json",
           
            data: {project_id:project_category_id},
           
            success: function (jsonData) {


                Highcharts.chart('container1', {
                chart: {
                    type: 'timeline'
                },
                accessibility: {
                    screenReaderSection: {
                        beforeChartFormat: '<h5>{chartTitle}</h5>' +
                            '<div>{typeDescription}</div>' +
                            '<div>{chartSubtitle}</div>' +
                            '<div>{chartLongdesc}</div>' +
                            '<div>{viewTableButton}</div>'
                    },
                    point: {
                        valueDescriptionFormat: '{index}. {point.label}. {point.description}.'
                    }
                },
                xAxis: {
                    visible: false
                },
                yAxis: {
                    visible: false
                },
                title: {
                    text: 'Tendering Project'
                },
               
                colors: [
                    '#4185F3',
                    '#427CDD',
                    '#406AB2',
                    '#3E5A8E',
                    '#3B4A68',
                    '#363C46'
                ],
                

                series: [{
                         data: jsonData

                    }]

         });
      }
  });

// ===============
       

} 

</script>
<!-- Project Pre-construction Overview  End -->


<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script type="text/javascript">
        //datatable//
        $(function() {

        $('#all_project').DataTable({
        responsive: true,
        bLengthChange: false

        });

    })
</script>
    









 
    
    