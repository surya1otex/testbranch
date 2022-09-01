<?php $CI =& get_instance();
$work_item_name= $CI->work_item($project_work_item_id);
$financial_budget= $CI->get_financial_budget($project_id,$project_work_item_id);
$financial_planned=$CI->work_item_financial_planned_amount_with_workitem_activity($project_id,$project_work_item_id,$project_activity_id);

 
?>

<?php
  $start    = new DateTime($project_aggrement_deatail[0]['project_start_date']);
  $start->modify('first day of this month');
  $end      = new DateTime($project_aggrement_deatail[0]['project_end_date']);
  $end->modify('first day of next month');
  $interval = DateInterval::createFromDateString('1 month');
  $period   = new DatePeriod($start, $interval, $end);
  


$nYear = date('Y', strtotime($project_aggrement_deatail[0]['project_end_date']));
$bYear = date('Y', strtotime($project_aggrement_deatail[0]['project_start_date']));
foreach ($period as $month){ 
    $monthsArr[]= $month->format("M");
}
//print_r($monthsArr);
$narr =array_unique($monthsArr);
foreach ($period as $month){ 
    $monthsidArr[]= $month->format("m");
}
$narr_id =array_unique($monthsidArr);
?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
              <div class="block-header">
              <h4><?php if(empty($project_financial_id)){echo "Creating";}else{echo "Update";}?> Financial Plan Of a Project </h4>
              </div>
            </div>
            <div class="col-md-6" style="text-align: right;">
              <?php 
                     $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$project_id,'status','Y');
                     $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$project_id,'status','Y');

                    ?>

                  <!--   <a href="<?php //echo base_url();?>pf_planning/project_other_setting?project_id=<?php //echo base64_encode($project_id);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a> -->
                      <div class="notification">
                      <a href="<?php echo base_url();?>pf_planning/project_activity?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-success waves-effect" title="Activity"><i class="fas fa-boxes"></i> Activities</a>
                      <?php if($pro_activity_cnt > 0){ ?>
                      <span class="label-count2 bg-blue"><?php echo $pro_activity_cnt; ?></span>
                  <?php } ?>
                      </div>

                      <div class="notification">
                      <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-warning waves-effect" title="Work Item"><i class="fas fa-cubes"></i> Stage</a>
                      <?php if($pro_work_item_cnt > 0){ ?>
                      <span class="label-count2 bg-blue"><?php echo $pro_work_item_cnt; ?></span>
                      <?php } ?>
                      </div>

                      <a href="<?php echo base_url();?>pf_planning/project_planning?project_id=<?php echo base64_encode($project_id);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
            </div>
              <!-- Alert Message -->
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('message')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>        
        
    </div>
    <!-- End Alert Message -->
            <!-- Basic Examples -->
            <?php echo form_open('pf_planning/add_financial_planning',array('name'=> 'add_project_work_item','id'=>'add_project_work_item_form')); ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                    <div class="card">
                        
             <div class="body">
                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td width="40%"><strong>Stage</strong>: </td>
                                            <td colspan="2">
                                              <?php
                                                $work_item_name= $CI->work_item($project_work_item_id);
                                                echo $work_item_name[0]['work_item_description'];
                                              ?>
                                              <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" id="project_id">
                                              <input type="hidden" name="work_item_id" value="<?php echo $project_work_item_id; ?>" id="work_item_id">
                                              <input type="hidden" name="project_financial_id" value="<?php echo $project_financial_id; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                              if(empty($project_financial_id)){
                                            ?>
                                                <td><strong>Select Activity</strong><span style="color: red;">*</span>: </td>
                                                <td colspan="2"><select class="form-control show-tick" name="activity_id" id="activity_id" required="">
                                                <option value="">Select Activity</option>
                                                <?php

                                                foreach($project_activity_deatail as 
                                                  $activity_deatail){
                                                  $count_exist_or_not = $CI->check_activity_record_exist_or_not($project_id,$project_work_item_id,$activity_deatail['id']);
                                                  if($count_exist_or_not == 0){
                                                ?>
                                                  <option value="<?php echo $activity_deatail['id']?>" <?php if($project_activity_id==$activity_deatail['id']){echo "selected";}?>><?php echo $activity_deatail['particulars']?></option>
                                                <?php  
                                                } } 
                                                ?>
                                                </select></td>
                                            <?php }else{?>
                                                <td><strong>Activity </strong>: </td>
                                                <td colspan="2">
                                                  <?php 
                                                    $activity_name= $CI->work_activity($project_activity_id);
                                                    echo $activity_name[0]['particulars'];
                                                  ?>
                                                  <input type="hidden" value="<?php echo $project_activity_id;?>" name="activity_id" id="activity_id">
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <!-- <tr>
                                            <td><strong>Work Item Type</strong><span style="color: red;">*</span>: </td>
                                            <td colspan="2"><?php //echo $work_item_type[0]['type_name'];?></td>
                                            
                                        </tr> -->

                                        <tr>
                                        <th scope="row">Project Start Date:</th>
                                        <td colspan="2"><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Project End Date:</th>
                                        <td colspan="2"><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                    <!-- <tr>
                                      <td scope="row"></td>
                                      <th scope="row">Work Item (<i class="fas fa-rupee-sign"> </i>)</th>
                                      <th scope="row">Activity (<i class="fas fa-rupee-sign"> </i>)</th>
                                    </tr> -->
                                    <tr>
                                      <th scope="row">Project Cost (<i class="fas fa-rupee-sign"> </i>) :</th>
                                      <td><span class="label bg-green"><?php echo number_format($project_aggrement_deatail[0]['agreement_cost'],2);?></span></td> 
                                      
                                      
                                      
                                    </tr>
                                   <!--  <tr>
                                      <th scope="row">Estimated Amount (<i class="fas fa-rupee-sign"> </i>) :</th>
                                      <td><span class="label bg-green"><?php //echo number_format($financial_budget[0]['amount'],2);?></span></td>
                                      <td><span class="label bg-green" id="act_budget"></span></td>
                                      
                                      
                                      
                                    </tr> -->
                                    <tr>
                                      <th scope="row">Weightage (%):</th>
                                      <td><span class="label bg-blue" id="act_Weightage"></span></td>
                                      
                                      
                                      
                                    </tr>
                                    <tr>
                                      <th scope="row">Planned Value (<i class="fas fa-rupee-sign"> </i>) :</th>
                                      <!-- <td><span class="label bg-yellow"><?php //echo number_format($financial_planned[0]['target_amount'],2);?></span></td> -->
                                      <td><span class="label bg-yellow" id="act_planned"></span></td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Remaining Value (<i class="fas fa-rupee-sign"> </i>) :</th>
                                      <!-- <td><span class="label bg-red"><?php //echo number_format(($financial_budget[0]['amount']-$financial_planned[0]['target_amount']),2);?></span></td> -->
                                      <td><span class="label bg-red" id="act_remain"></span></td>
                                    </tr>
                                    </tbody>
                                </table>
                </div>
              </div>
          </div>
          <?php
              if(empty($project_financial_id)){
            ?>
          <div class="card">
                        <div class="body">
                              <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   
                                    <thead>
                                        <tr>
                                            <th>Start Month : <span style="color: red;">*</span> 
                                            </th>
                                            <th>Start Year : <span style="color: red;">*</span> 
                                            </th>
                                            <th>Duration (Number of Month): <span style="color: red;">*</span> 
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td>
                                            <select class="form-control show-tick" name="start_month" id="start_month" required="">
                                                <option value="">Select Month</option>
                                                <?php

                                                
                                                $s = 0;
                                                foreach ($narr as $mon){ 
                                                  
                                                ?>
                                                  <option value="<?php echo $narr_id[$s];?>"> <?php echo $mon;?></option>
                                                <?php
                                                $s++;  
                                                } 
                                                ?>
                                                </select>
                                            
                                        </td>
                                        

                                        <td>

                                           <select class="form-control show-tick" name="start_year" id="start_year" required="">
                                                <option value="">Select Year</option>
                                                <?php
                                                  for ($start_year=$bYear; $start_year <= $nYear ; $start_year++) { 
 
                                                ?>
                                                  <option value="<?php echo $start_year;?>"> <?php echo $start_year;?></option>
                                                <?php  
                                                } 
                                                ?>
                                                </select> 
                                                <input type="hidden" name="addfinancial_start_date" id="addfinancial_start_date">
                                        </td>
                                        <td>

                                            <input type="text" class="form-control" placeholder="Duration" name="duration" id="duration" onkeypress="allowNumbersOnly(event)" required="" />
                                        </td>

                                            <td>
                                                <input type="button" id="generate_btn" name="generate" value="GENERATE" class="btn bg-indigo waves-effect" />
                                            </td>

                                           
                                        </tr>
                                    </tbody>
                                </table>
                                
                              </div>
                        </div>
                    </div>

                    <div id="financial_month_data">

                    </div>
                   <?php }else{ ?>
                    
                    <div class="card" id="edit_financial_planning">
             <div class="body">
               
               <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th style="padding: 10px 5px; width: 40px">Sl No</th>
                                            <th style="padding: 10px 5px; width: 350px">Months
                                            </th>
                                            <th style="padding: 10px 5px; width: 50px">Planned (%)
                                            </th>
                                            <th style="padding: 10px 5px; width: 150px">Planned Value (<i class="fa fa-rupee-sign"></i>)
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                      <?php 
                                        $i=1;$j=0;

                                        foreach ($period as $dt){ 

                                            $cal_weightage = 0.00;
                                            if(!empty($project_financial_planning_detail[$j]['target_amount'])){
                                            $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];
                                            $cal_weightage = ($project_financial_planning_detail[$j]['target_amount'] / $agreement_cost) * 100;

                                            }

                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <?php echo $dt->format("M Y");?>
                                                <input type="hidden" class="form-control" placeholder="Cost" name="month[]" value="<?php echo $dt->format("M Y");?>"/>
                                                <input type="hidden" name="financial_planning_detail_id[]" value="<?php if(!empty($project_financial_planning_detail[$j]['id'])){echo $project_financial_planning_detail[$j]['id'];}else{echo "";};?>">
                                            </td>
                                            <td>
                                                <input onkeypress="return validateFloatKeyPress(this,event);" type="text" style="text-align: right; vertical-align: middle;" class="form-control mainweightage_key" placeholder="Weightage" name="Weightage[]" id="mainweightage_<?php echo $i; ?>" value="<?php echo number_format(round($cal_weightage,2),2);?>" />
                                                
                                            </td>
                                            <td>
                                                <input type="text" style="text-align: right; vertical-align: middle;" onkeypress="return validateFloatKeyPress(this,event);" class="form-control mainamount_key" placeholder="Amount" id="mainamount_<?php echo $i; ?>" name="target[]" value="<?php if(!empty($project_financial_planning_detail[$j]['target_amount'])){echo $project_financial_planning_detail[$j]['target_amount'];}else{echo "0.00";};?>" />
                                            </td>
                                        </tr>
                                       <?php 
                                          $j++;$i++;
                                          }
                                       ?>
                                       <tr>
                                           <td></td>
                                           <td style="text-align: center; vertical-align: middle;"><strong>Total</strong></td>
                                           <td style="text-align: right; vertical-align: middle;"><span id="mainTotalPlannedPercentData"></span></td>
                                           <td style="text-align: right; vertical-align: middle;"><span id="mainTotalPlannedAmtData"></span> ( <span style="color: red;" id="mainremainPlannedAmtData"></span>)</td>
                                       </tr>
                                    </tbody>
                                </table>
                           
                               
                                <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                       <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                       <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                </div>
                            </div>
                            
              </div>
          </div>
      <?php } ?>
                </div>
            </div>
            </form>
            <!-- #END# Basic Examples -->

        </div>
        
        
        
        
    </section>

                <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>
<script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }

    function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
</script>

<!-- ENd Alert Page js for hide alert  -->

<script type="text/javascript">

  $("#activity_id").change(function(){
            var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var work_item_id=$('#work_item_id').val();          
            if(activity_id > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>pf_planning/get_financial_acitivity_plan_data",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id
                        },
                    dataType: "json",    
                    success: function (msg) {
                        //console.log(msg);
                        $("#act_budget").html(msg.get_activities_budget_amt);
                        $("#act_planned").html(msg.get_activities_planned_amt);
                        $("#act_remain").html(msg.get_activities_remain_amt);
                        $("#act_Weightage").html(msg.get_activities_Weightage);
                    }
                });
            }else{
                $("#act_budget").html('0.00');
                $("#act_planned").html('0.00');
                $("#act_remain").html('0.00');   
                $("#act_Weightage").html('0.00');   
            }
             
        });

  var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var work_item_id=$('#work_item_id').val();          
            if(activity_id > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>pf_planning/get_financial_acitivity_plan_data",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id
                        },
                    dataType: "json",    
                    success: function (msg) {
                        //console.log(msg);
                         $("#act_budget").html(msg.get_activities_budget_amt);
                         $("#act_planned").html(msg.get_activities_planned_amt);
                         $("#act_remain").html(msg.get_activities_remain_amt);
                         $("#act_Weightage").html(msg.get_activities_Weightage);
                    }
                });
            }else{
                $("#act_budget").html('0.00');
                $("#act_planned").html('0.00');
                $("#act_remain").html('0.00'); 
                $("#act_Weightage").html('0.00');     
            }
  
</script>

<script type="text/javascript">


    $( "#generate_btn" ).click(function() {

    var start_month = $('#start_month').val();
    var start_year = $('#start_year').val();
    var duration = $('#duration').val();
    if(start_month == '' || duration == '' || start_year == ''){
        alert('Please fill All required fields');
    }else{

    var newmonthdateget = start_year+'-'+start_month+'-01';
    var projectStartDate = '<?php echo $project_aggrement_deatail[0]['project_start_date']; ?>';
    var projectEndDate = '<?php echo $project_aggrement_deatail[0]['project_end_date']; ?>';

    projectStartDate = new Date(projectStartDate);
    projectEndDate = new Date(projectEndDate);
    var newmonthdate = new Date(newmonthdateget);

    var durationlastmonth = moment(newmonthdate);
    durationlastmonth.add(duration - 1, 'months');
    durationlastmonth = new Date(durationlastmonth);


    var firstDay = new Date(projectStartDate.getFullYear(), projectStartDate.getMonth(), 1);
    var lastDay = new Date(projectEndDate.getFullYear(), projectEndDate.getMonth() + 1, 0);
    
    if (newmonthdate < firstDay || newmonthdate > lastDay){
    alert('Please Choose Correct Month, Year!');
    }else if(durationlastmonth > lastDay){
        alert('Please Enter Correct Duration');
    }else{

    //alert(projectStartDate);
    
        var activity_id=$('#activity_id').val();  
        var project_id=$('#project_id').val();
        var work_item_id=$('#work_item_id').val(); 
        $('#addfinancial_start_date').val(newmonthdateget); 
        //console.log(work_item_id);
        $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>pf_planning/get_financial_planned_amount_month_data",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id,
                        start_date : newmonthdateget,
                        duration : duration
                        },    
                    success: function (msg) {
                        //console.log(msg);
                        $('#financial_month_data').html(msg);
                        check_total();
                    }
                });
    }

}
});
</script>




          <script type="text/javascript">
              $(".mainweightage_key").keyup(function(){
    
                var weightageKeyId = this.id;
                var weightageVal = this.value;
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#mainamount_"+id).val(calamtData.toFixed(2));
                    maincheck_total();
               } 
            });

              $(".mainamount_key").keyup(function(){
    
                var amountKeyId = this.id;
                var amountVal = this.value;
                //alert(amountVal);
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    $("#mainweightage_"+id).val(calamtData.toFixed(2));
                    maincheck_total();
               } 
            });
          </script>

          <?php
          if(!empty($project_financial_id)){
          ?>

          <script type="text/javascript">
            $( document ).ready(function() {
                maincheck_total()
            });
              function maincheck_total(){
            var mainTotalPlannedAmtData = 0.00;
            var mainremainPlannedAmtData = 0.00;
            var mainactivitiesBudget =  '<?php echo $get_activities_budget_amt; ?>';
            //console.log(mainactivitiesBudget);
            $('#edit_financial_planning').find('.mainamount_key').each(function(index, element) {
                mainTotalPlannedAmtData +=parseFloat(element.value);
                //console.log(TotalPlannedAmtData);
                
                $("#mainTotalPlannedAmtData").html(mainTotalPlannedAmtData.toFixed(2));
                mainremainPlannedAmtData = parseFloat(mainactivitiesBudget) - mainTotalPlannedAmtData;
                //console.log(mainactivitiesBudget);
                $("#mainremainPlannedAmtData").html(mainremainPlannedAmtData.toFixed(2));
            })
            var mainTotalPlannedPercentData = 0.00;
            $('#edit_financial_planning').find('.mainweightage_key').each(function(index, element) {
                mainTotalPlannedPercentData +=parseFloat(element.value);
                //console.log(mainTotalPlannedPercentData);
                $("#mainTotalPlannedPercentData").html(mainTotalPlannedPercentData.toFixed(2));
            })


        }

          </script>
      <?php } ?> 




