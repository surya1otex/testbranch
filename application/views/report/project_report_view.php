<?php
$CI =& get_instance();
?>
<section class="content">
  <div class="container-fluid">
      
    <div class="row clearfix ">
        <div class="col-md-6">
            <div class="block-header">
              <h4> Project Report </h4>
            </div>
        </div>
        <?php
        $form_action = base_url().'Report/ajax_project_report';
    ?>
        
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Project Report</h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <form id="project_from" method="POST" action="<?php echo $form_action; ?>">
                <div class="row clearfix cloneBox1">
                                  <div class="col-md-4">
                                    <p>
                                        <b>Category </b>
                                    </p>
                                      <select class="form-control show-tick" id="project_category_id" name="project_category_id"  onchange="changeFunction();">
                                                <option value="0">Default all</option>
                                                <?php foreach ($project_category as $key => $val ){?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['project_type']; ?></option>
                                                <?php } ?>
                                      </select>

                                </div> 
                                <div class="col-md-4">
                                    <p>
                                        <b>Scheme</b>
                                    </p>
                                    <select class="form-control show-tick" id="project_group_id" name="project_group_id" onchange="changeFunction();">
                                                  <option value="0">All</option>
                                                  <?php foreach ($group_list as $key => $valg ){?>
                                                      <option value="<?php echo $valg['id']; ?>"><?php echo $valg['name']; ?></option>
                                                  <?php } ?>
                                     </select>
                                </div>                           
                                  
                                  <div class="col-md-4">
                                    <p>
                                        <b>Location </b>
                                    </p>
                                    <select class="form-control show-tick" id="project_area_id" name="project_area_id" onchange="changeFunction();">
                                                <option value="0">Default All</option>
                                                <?php foreach ($project_area as $key => $val ){?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                                                <?php } ?>
                                    </select>
                                    
                                </div>
                                  <!-- <div class="col-md-4" style="display:none;">
                                    <p>
                                        <b>Circle </b>
                                    </p>
                                     <select class="form-control" id="project_sector_id" name="project_sector_id" onchange="changeFunction();">
                                                <option value="0">All</option>
                                                <?php foreach ($sector_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['name']; ?></option>
                                                <?php } ?>
                                    </select>

                                </div> -->
                                <!-- <div class="col-md-4">
                                    <p>
                                        <b>Wing</b>
                                    </p>
                                  <select class="form-control" id="project_wing_id" name="project_wing_id" onchange="changeFunction();">
                                                <option value="0">All</option>
                                                <?php foreach ($wing_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['wing_name']; ?></option>
                                                <?php } ?>
                                            </select>

                                </div> -->
                                <div class="col-md-4">
                                    <p>
                                        <b>Division</b>
                                    </p>
                                    <select class="form-control" id="project_division_id" name="project_division_id" onchange="changeFunction();">
                                                <option value="0">All</option>
                                                <?php foreach ($division_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['division_name']; ?></option>
                                                <?php } ?>
                                     </select>

                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Status</b>
                                    </p>
                                    <select class="form-control" id="project_status" name="project_status" onchange="changeFunction();">
                                                <option value="All">All</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Completed">Completed</option>
                                                
                                    </select>

                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                  <div class="pull-right" style="margin-top: 21px;">
                                  <button class="btn bg-indigo waves-effect"  onclick="generateFunction();" type="button">
                                    <i class="material-icons">search</i>
                                    <span>SEARCH</span>
                                  </button>
                                </div>
                                </div>
                                  
                               </div>
              <div class="row clearfix">

                <div class="col-md-8 col-md-offset-2">
                  <div id="report_type_div" style="display:none;">
                  <div class="col-md-3">
                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Report Type : </label>
                  </div>
                  <div class="col-md-9">
                    <select class="form-control show-tick" name="report_type" id="report_type" onchange="projectFunction();">
                      <option value="Individual">Individual</option>
                      <option value="Summary">Summary</option>  
                    </select>
                    
                  </div>
                </div>
                  <div id="indi_data" style="display: none;">
                  <div class="col-md-3">
                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Project : </label>
                  </div>
                  <div class="col-md-9">
                    <select class="form-control show-tick" name="project_id" id="select_project">
                      <option value="">Select Projects</option>
                      <?php 
                        if(is_array($project_dropdown_Data)){
                          foreach ($project_dropdown_Data as $projectdr) {
                         
                      ?>
                      <option value="<?php echo $projectdr->id; ?>"><?php echo $projectdr->project_name; ?></option>
                    <?php } } ?>
                    </select>
                    
                  </div>
                </div>
                   <div id="indi_type" style="display: none;"> 
                  <div class="col-md-3">
                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Type : </label>
                  </div>
                  <div class="col-md-9">
                    <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="All" id="select_all" class="filled-in" />
                        <label for="select_all">Check All </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="ProjectInformetion" id="basic_checkbox_2" class="filled-in" checked />
                        <label for="basic_checkbox_2">Project Information </label>
                     </div>
                     
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="ProjectDPR" id="ProjectDPR" class="filled-in" />
                        <label for="ProjectDPR">Master Planning / DPR </label>
                     </div> 
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="AdministrativeApproval" id="AdministrativeApproval" class="filled-in" />
                        <label for="AdministrativeApproval"> Administrative Approval </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="PreConstructionActivities" id="PreConstructionActivities" class="filled-in" />
                        <label for="PreConstructionActivities">  Pre Construction Activities </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="Tendering" id="Tendering" class="filled-in" />
                        <label for="Tendering"> Tendering </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="Agreement" id="Agreement" class="filled-in" />
                        <label for="Agreement"> Agreement </label>
                     </div>
                    <!--  <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="ProjectCloser" id="ProjectCloser" class="filled-in" />
                        <label for="ProjectCloser"> Project Closer </label>
                     </div> -->

                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="ProjectProgress" id="ProjectProgress" class="filled-in" />
                        <label for="ProjectProgress"> Project Progress </label>
                     </div>

                     <div class="col-md-6"> 
                        <input type="checkbox" name="view_data[]" value="ProjectIssue" id="ProjectIssue" class="filled-in" />
                        <label for="ProjectIssue"> Project Issue Status </label>
                     </div>
                    
                  </div> 
                  </div> 

                   <div id="summ_type" style="display:none;">
                    
                  <div class="col-md-3">
                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Type : </label>
                  </div>
                  <div class="col-md-9">
                    <div class="col-md-6"> 
                        <input type="checkbox" name="summ_view_data[]" value="ProjectOverviewReport" id="ProjectOverviewReport" class="filled-in" />
                        <label for="ProjectOverviewReport">Project Overview Report </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="summ_view_data[]" value="PreConstructionSummaryReport" id="PreConstructionSummaryReport" class="filled-in"/>
                        <label for="PreConstructionSummaryReport">Pre-Construction Summary Report </label>
                     </div>

                     <div class="col-md-6"> 
                        <input type="checkbox" name="summ_view_data[]" value="TenderingSummaryReport" id="TenderingSummaryReport" class="filled-in"/>
                        <label for="TenderingSummaryReport">Tendering Summary Report </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="summ_view_data[]" value="ProjectDelayedReport" id="ProjectDelayedReport" class="filled-in"/>
                        <label for="ProjectDelayedReport">Project Delayed Report </label>
                     </div>
                     <div class="col-md-6"> 
                        <input type="checkbox" name="summ_view_data[]" value="SummaryProjectStatus" id="SummaryProjectStatus" class="filled-in"/>
                        <label for="SummaryProjectStatus">Project Issue Report </label>
                     </div>

                  </div> 
                  </div> 
                </div>

              </div>

                <div class="col-md-2 col-md-offset-5 text-center">
                  <!-- <a href="#"  class="btn bg-green waves-effect"><span> VIEW </span></a> -->
                  <div id="submit_button_div" style="display:none;">
                  <button type="submit" id="submitButton" name="submit" value="Submit" class="btn bg-indigo waves-effect"><i class="material-icons">save</i><span>GENERATE</span></button> 
                </div>
                </div>
                <div style='clear:both'></div>
              </form>
            </div>
          </div>
        </div>
      </div>

<div id="load-result">
  
</div>

    </div>

  </div>
</section>

<script type="text/javascript">
      
  $('#select_all').click(function() {
  $(':checkbox').prop('checked', this.checked);
  $("input[type='checkbox']").not('#select_all').change( function() {
        $('#select_all').removeAttr('checked');
    });
});
$('#project_from').submit( function(e) {
  e.preventDefault();
    //alert('ok');
var project_id = $("#select_project").val();
var report_type = $("#report_type").val();
var checkbox_value = "";
var project_sector_id = $('#project_sector_id').val();
var project_group_id = $('#project_group_id').val();
var project_category_id = $('#project_category_id').val();
var project_area_id = $('#project_area_id').val();
//var project_wing_id = $('#project_wing_id').val();
var project_division_id = $('#project_division_id').val();
var project_status = $('#project_status').val();
   
    $("input[name='view_data[]']:checked").each(function (index, obj) {
        checkbox_value += $(this).val() + ",";
    });
    
    if(report_type == 'Individual'){
    if(project_id == '' || checkbox_value == ''){
      alert('Please Select Project and Type');
    }else{
      $.ajax({
            url:"<?php echo base_url(); ?>Report/ajax_project_individual_report",
              method:"POST",
              data:{
                report_type:report_type,
                project_id:project_id,
                type:checkbox_value
                },
            success: function(res){
               $('#load-result').html(res);
            }
        });//end ajax
    }
  }
  if(report_type == 'Summary'){
    var checkbox_value1 = "";
    
    $("input[name='summ_view_data[]']:checked").each(function (index, obj) {
        checkbox_value1 += $(this).val() + ",";
    });
    
    if(checkbox_value1 == ''){
      alert('Please Select Type');
    }else{
      $.ajax({
            url:"<?php echo base_url(); ?>Report/ajax_project_summary_report",
              method:"POST",
              data:{
                report_type:report_type,
                type:checkbox_value1,
                project_sector_id:project_sector_id,
                project_group_id:project_group_id,
                project_category_id:project_category_id,
                project_area_id:project_area_id,
               // project_wing_id:project_wing_id,
                project_division_id:project_division_id,
                project_sector_id:project_sector_id,
                project_status:project_status
                },
            success: function(res){
              console.log(res);
               $('#load-result').html(res);
            }
        });//end ajax
    }
  }
   
});
</script>

<script type="text/javascript">
  function changeFunction() {
            $("#indi_data").hide();
            $("#indi_type").hide();
            $("#summ_type").hide();
            $("#submit_button_div").hide();
            $("#report_type_div").hide();
            $("#report_type").val("Individual");
         } 
</script>

<script type="text/javascript">
  

  function generateFunction(){
    $("#indi_data").hide();
    $("#indi_type").hide();
    $("#summ_type").hide();
    $("#submit_button_div").hide();
    $("#report_type_div").hide();
    $("#report_type").val("Individual");
    var project_sector_id = $('#project_sector_id').val();
    var project_group_id = $('#project_group_id').val();
    var project_category_id = $('#project_category_id').val();
    var project_area_id = $('#project_area_id').val();
   // var project_wing_id = $('#project_wing_id').val();
    var project_division_id = $('#project_division_id').val();
    var report_type = $("#report_type").val();
    var project_status = $("#project_status").val(); 
    
             $.ajax({
              url:"<?php echo base_url(); ?>Report/get_project_list",
              method:"POST",
              data:{project_sector_id:project_sector_id,
                project_group_id:project_group_id,
                project_category_id:project_category_id,
                project_area_id:project_area_id,
               // project_wing_id:project_wing_id,
                project_division_id:project_division_id,
                project_sector_id:project_sector_id,
                project_status:project_status
              },
              success:function(data)
              {
                console.log(data);
               $('#select_project').html(data);
               $("#indi_data").show();
                $("#indi_type").show();
                $("#summ_type").hide();
                $("#submit_button_div").show();
                $("#report_type_div").show();
              }
             });
         
  }

    $("#report_type").change(function () {
        var report_type = this.value;
        $('#load-result').html('');
        
        if(report_type == 'Individual'){
          $("#indi_data").show();
          $("#indi_type").show();
          $("#summ_type").hide();
          $("#submit_button_div").show();
        }
        if(report_type == 'Summary'){
          $("#indi_data").hide();
          $("#indi_type").hide();
          $("#summ_type").show();
          $("#submit_button_div").show();
        }

    });
</script>