<style type="text/css">
    a.disabled {
    pointer-events: none;
    color: #ccc !important;
}
</style>

<?php $CI =& get_instance();
/*echo '<pre>';
print_r($project_wise_total_activity_amt);
echo '</pre>';
die;*/
?>
<section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
            <div class="block-header">
              <h4>Activities</h4>
            </div>
          </div>
          <div class="col-md-6" style="text-align: right;">
              <?php 
                     $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$project_id,'status','Y');
                     $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$project_id,'status','Y');

                    ?>

                    <!-- <a href="<?php //echo base_url();?>pf_planning/project_other_setting?project_id=<?php //echo base64_encode($project_id);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a> -->
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
            <!-- Basic Examples -->
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
          <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                    <div class="card">
                  <div class="header">
                          <h2>Project Summary of <?php echo $project_deatail[0]['project_name'];?> </h2>
                  </div>
                  <?php
            /*echo "<pre>";
            print_r($project_milestone_details);
            echo "</pre>";*/
            
            
           $project_area= $CI->project_area($project_deatail[0]['project_area']);
            $project_type= $CI->project_type($project_deatail[0]['project_type']);
            
            ?>
                  <div class="body">
                    <div class="table-responsive">
                                <div class="body table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Project Name :</th>
                                        <td><?php echo $project_deatail[0]['project_name']; ?></td>
                                    </tr>
                                   <tr>
                                        <th scope="row">Location:</th>
                                        <td><?php echo !empty($project_wise_location) ? $project_wise_location[0]['area_name']: "--"?></td>
                                  </tr>
                                    <tr>
                                        <th scope="row">Type:</th>
                                        <td><?php echo !empty($project_type) ? $project_type[0]['project_type'] : "--"?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Agreement Cost:</th>
                                        <td><?php echo !empty($project_aggrement_deatail[0]['agreement_cost']) ? number_format($project_aggrement_deatail[0]['agreement_cost'],2) : "--"?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Start Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  
                 
                </div>
                   
                    <div class="card">
                        <div class="header">
                          <h2>Add a New Activity</h2>
                        </div>
                        <div class="body">
                          <?php echo form_open('pf_planning/add_project_activity',array('name'=> 'add_project_activity','id'=>'add_project_activity_form')); ?>
                              <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   
                                    <thead>
                                        <tr>
                                            <th>Activity Name:<span style="color: red;">*</span> 
                                            </th>
                                            <th>Weightage (%):<span style="color: red;">*</span> 
                                            </th>
                                            <th>Planned Value (<i class="fa fa-rupee-sign"></i>)<span style="color: red;">*</span> </th>
                                            <th>Status<span style="color: red;">*</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>">
                                            <input type="hidden" name="activity_id" value="<?php echo base64_encode($activity_id); ?>">

                                            <input type="text" class="form-control" placeholder="Activity Name" name="particular" required="" value="<?php if(!empty($project_activity_detail_edit[0]['particulars'])){echo $project_activity_detail_edit[0]['particulars'];}else{echo "";}?>"/></td>
                                            <td>

                                            <input type="text" class="form-control" placeholder="Weightage" name="weightage" id="weightage" onkeypress="return validateFloatKeyPress(this,event);" required="" /></td>

                                            <td><input type="text" class="form-control" placeholder="Planned Value" name="amount" onkeypress="return validateFloatKeyPress(this,event);" id="amount" required="" pattern="[+-]?([0-9]*[.])?[0-9]+" value="<?php if(!empty($project_activity_detail_edit[0]['amount'])){echo $project_activity_detail_edit[0]['amount'];}else{echo "";}?>"/></td>

                                            <td><select class="form-control show-tick" name="status" required="">
                                            <option value="Y" <?php if(!empty($project_activity_detail_edit) &&($project_activity_detail_edit[0]['status']=="Y")){echo "selected";}?>>Active</option>
                                            <option value="N" <?php if(!empty($project_activity_detail_edit) &&($project_activity_detail_edit[0]['status']=="N")){echo "selected";}?>>Inactive</option>
                                            </select></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                   <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                   <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                    

                    
                    
                    <div class="card">
             <div class="body">
                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th style="text-align: center; width: 40px">Sl No</th>
                                            <th style="text-align: center; width: 350px">Particulars Name</th>
                                            <th style="text-align: center; width: 40px">Weightage (%)</th>
                                            <th style="text-align: center; width: 40px">Planned Value (<i class="fa fa-rupee-sign"></i>)</th>
                                            <!-- <th style="text-align: center; width: 40px">Planned Amount</th>
                                            <th style="text-align: center; width: 40px">Remaining Amount</th> -->
                                            <th style="text-align: center; width: 80px; " >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($project_activity_deatail)){
                                               $i=1;
                                               $sum_amt=0;
                                               $sum_planned_amnt=0;
                                               $sum_remaining_amnt=0;
                                               $sum_weightage_amnt=0.00;
                                               foreach($project_activity_deatail as $activity_deatail){
                                                $sum_amt=$sum_amt+$activity_deatail['amount'];

                                                $planned_amount= $CI->get_planned_amount($project_id,$activity_deatail['id']);
                                                $sum_planned_amnt=$sum_planned_amnt+$planned_amount[0]['planned_amnt'];

                                                $remaining_amt=$activity_deatail['amount']-$planned_amount[0]['planned_amnt'];

                                                $sum_remaining_amnt= $sum_remaining_amnt+$remaining_amt;
                                                $cal_weightage = 0.00;
                                                if(!empty($project_aggrement_deatail[0]['agreement_cost'])){
                                                     
                                                    $cal_weightage = ($activity_deatail['amount'] / $project_aggrement_deatail[0]['agreement_cost']) * 100;
                                                    
                                                }
                                                $sum_weightage_amnt = $sum_weightage_amnt+$cal_weightage;

                                                $count_activity_exist = $CI->count_activity_exist($activity_deatail['id']);

                                                if($count_activity_exist > 0){
                                                    $disabledcls = 'disabled';

                                                }else{
                                                    $disabledcls = '';
                                                }
                                                
                                        ?>
                                        <tr>
                                            <td ><?php echo $i;?></td>
                                            <td><a href="#" data-toggle="modal" data-target="#exampleModal" style="color: #555" onclick="get_activity_wise_workitem_breakup('<?php echo $project_id;?>','<?php echo $activity_deatail['id'];?>','<?php echo $activity_deatail['particulars'];?>')"><?php echo $activity_deatail['particulars'];?></a></td>
                                            <td align="right"><?php echo number_format($cal_weightage,2);?></td>
                                            <td align="right"><?php echo number_format($activity_deatail['amount'],2);?></td>
                                           <!--  <td align="right"><?php //echo number_format($planned_amount[0]['planned_amnt'],2);?></td>
                                            <td align="right"><?php //echo number_format($remaining_amt,2);?></td> -->
                                            <td align="right">
                                              <a href="<?php echo base_url(); ?>pf_planning/project_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']); ?>&activity_id=<?php echo base64_encode($activity_deatail['id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>
                                              
                                              <a href="<?php echo base_url(); ?>pf_planning/delete_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']); ?>&activity_id=<?php echo base64_encode($activity_deatail['id']); ?>" class="col-black <?php echo $disabledcls; ?>" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </a>

                                              <?php
                                              if($activity_deatail['status']=='Y'){?>
                                                  <i class="fas fa-check col-green"></i>
                                              <?php }else{ ?>  
                                                  <i class="fas fa-times col-red"></i>
                                              <?php } ?>
                                            </td>
                                        </tr>
                                        <?php 
                                               $i++;
                                             }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td><strong>Total Amount: </strong></td>
                                            <td align="right"><b><?php echo number_format($sum_weightage_amnt,2);?></b></td>
                                            <td align="right"><b><?php echo number_format($sum_amt,2);?></b></td>
                                            <!--  <td align="right"><b><?php //echo number_format($sum_planned_amnt,2);?></b>
                                            </td>
                                            <td align="left" colspan="2" style="padding-left: 40px;"><b><?php //echo number_format($sum_remaining_amnt,2);?></b></td> -->
                                            
                                        </tr>
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="6">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>

                </div>
                <!-- <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th colspan="2" style="text-align: left;">Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // if(!empty($project_other_setting_detail)){
                                        //        $i=1;
                                        //        $sum_charges=0;
                                        //        $sum_planned_charges=0;
                                        //        $sum_remaining_charges=0;
                                        //        foreach($project_other_setting_detail as $other_detail){

                                        //         $charge_amount= (($sum_amt * $other_detail['charge_percentage']) / 100);
                                        //         $sum_charges=$sum_charges+$charge_amount;

                                                
                                        //         $charge_planned_amount= (($sum_planned_amnt * $other_detail['charge_percentage']) / 100);
                                        //         $sum_planned_charges=$sum_planned_charges+$charge_planned_amount;


                                        //         $charge_remaining_amount= $sum_remaining_charges+ (($sum_remaining_amnt * $other_detail['charge_percentage']) / 100);
                                        //         $sum_remaining_charges=$sum_remaining_charges+$charge_remaining_amount;
                                        ?>
                                        <tr>
                                            <td width="5%"><?php //echo $i;?></td>
                                            <td width="30%"><?php //echo $other_detail['charge_name']." (".$other_detail['charge_percentage']."%)";?></td>
                                            <td width="20%" align="right"><?php //echo number_format($charge_amount,2);?></td>
                                            <td width="20%" align="right"><?php //echo number_format($charge_planned_amount,2);?></td>
                                            <td width="15%" align="right"><?php //echo number_format($sum_remaining_charges,2);?></td>
                                            <td width="10%"></td>
                                        </tr>
                                        <?php 
                                               //$i++;
                                             //}
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td><strong>Gross Amount: </strong></td>
                                            <td align="right"><b><?php //echo number_format(($sum_amt+$sum_charges),2);?></b></td>
                                            <td align="right"><b><?php //echo number_format(($sum_planned_amnt+$sum_planned_charges),2);?></b>
                                            </td>
                                            <td align="left" colspan="2" style="padding-left: 40px;"><b><?php //echo number_format(($sum_remaining_amnt+$sum_remaining_charges),2);?>
                                            </b></td>
                                            

                                        </tr>
                                       <?php// }else{?> 
                                         <tr>
                                            <td colspan="6">No Data Found</td>
                                         </tr>
                                       <?php// } ?>
                                    </tbody>
                                </table>

                </div> -->
              </div>
          </div>
                    
                   
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body" style="max-height: 400px; overflow: auto;"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function get_activity_wise_workitem_breakup(project_id,activity_id,activity_name){      
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>pf_planning/get_workitem_wise_breakup", 
          data: {project_id: project_id,activity_id: activity_id,activity_name:activity_name,type:"activity"},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
      }
    </script>


        <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>

<script type="text/javascript">
    $(document).ready(function(){
  $("#weightage").keyup(function(){
    var calamt = 0.00;
    var weightage = this.value;
    var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
    if(weightage){
        calamt = (parseFloat(agreementcost, 10) / 100) * parseFloat(weightage, 10);
        //console.log(calamt);
        $("#amount").val(calamt);
    }
  });

  $("#amount").keyup(function(){
    var get_cal_amt = this.value;
    var nweitage = 0.00;
  var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
  if(get_cal_amt){
        nweitage = (parseFloat(get_cal_amt, 10) / parseFloat(agreementcost, 10)) * 100;
        //console.log(calamt);
        $("#weightage").val(nweitage.toFixed(2));
    }
  });

  var get_cal_amt = $("#amount").val();
  var nweitage = 0.00;
  var agreementcost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>'
  if(get_cal_amt){
        nweitage = (parseFloat(get_cal_amt, 10) / parseFloat(agreementcost, 10)) * 100;
        //console.log(calamt);
        $("#weightage").val(nweitage.toFixed(2));
    }

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