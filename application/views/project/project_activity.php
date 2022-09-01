<?php $CI =& get_instance(); ?>
<section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
            <div class="block-header">
              <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?>
              </span>
              <h4>Activities</h4>
            </div>
          </div>
            <!-- Basic Examples -->
          <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                          <h2>Project Summary of <?php echo $project_deatail[0]['project_name'];?></h2>
            </div>
             <div class="body">
               <div class="table-responsive">
                                  <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td width="40%"><strong>Project Name :</strong> </td>
                                            <td><?php echo $project_deatail[0]['project_name'];?></td>
                                        </tr>
                                        <?php 
                                          $project_area= $CI->project_area($project_deatail[0]
                                            ['project_area']);
                                          $project_type= $CI->project_type($project_deatail[0]
                                            ['project_type']);

                                        ?>
                                        <tr>
                                            <td><strong>Location :</strong> </td>
                                            <td><?php echo $project_area[0]['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type :</strong> </td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <?php if( $finalcial_module_permission ){ ?>
                                            <tr>
                                                <td><strong>Contract Amount :</strong> </td>
                                                <td><?php echo number_format($project_deatail[0]['estimate_total_cost'],2);?> INR</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Amount :</strong> </td>
                                                <td><?php echo number_format($project_wise_total_activity_amt[0]['total_amount'],2);?> INR</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Planned Amount :</strong> </td>
                                                <td><?php echo number_format($project_wise_total_activity_planned_amt[0]['total_planned_amount'],2);?> INR</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Remaining Amount to Plan :</strong> </td>
                                                <td><?php echo number_format(($project_wise_total_activity_amt[0]['total_amount']-$project_wise_total_activity_planned_amt[0]['total_planned_amount']),2);?> INR</td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td><strong>Start Date :</strong> </td>
                                            <td><?php $from_date = new DateTime($project_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>End Date :</strong> </td>
                                            <td><?php $end_date = new DateTime($project_deatail[0]['project_end_date']); echo $end_date->format('jS M Y'); ?></td>
                                        </tr>
                                    </tbody>
                                  </table>
                            </div>
              </div>

                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box-2 bg-teal hover-expand-effect">
                                        <div class="icon">
                                            <i class="material-icons">brightness_low</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">WORK ITEM</div>
                                            <div class="number"><?php echo $counters['total_planned_work_item']; ?>/<?php  echo $counters['total_work_item'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box-2 bg-green hover-expand-effect">
                                        <div class="icon">
                                            <i class="material-icons">gps_fixed</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">ACTIVITIES</div>
                                            <div class="number"><?php echo $counters['total_planned_activity']; ?>/<?php echo $counters['total_activity']; ?> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box-2 bg-light-green hover-expand-effect">
                                        <div class="icon">
                                            <i class="material-icons">equalizer</i>
                                        </div>
                                        <div class="content">
                                            <div class="text">PLANNED ACTIVITIES</div>
                                            <div class="number"><?php echo $counters['total_used_activity']; ?></div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                        <div class="wizard_steps">
                          <div class="normal_steps bg-indigo"><strong><i class="fa fa-cogs fa-2x m-t-5"></i></strong></div>
                          <a href="#">PROJECT</a>
                        </div>

                        <div class="wizard_steps ">
                          <div class="normal_steps bg-teal"><strong><?php if(!empty($status_bar_data['activity_percentage']) && $status_bar_data['activity_percentage']>0){echo $status_bar_data['activity_percentage'];}else{echo "0";}?>%</strong></div>
                          <a href="#">ACTIVITIES</a>
                        </div>

                        <div class="wizard_steps">
                          <div class="normal_steps bg-cyan"><strong><?php if(!empty($status_bar_data['activity_percentage']) && $status_bar_data['workitem_percentage']>0){echo $status_bar_data['workitem_percentage'];}else{echo "0";}?>%</strong></div>
                          <a href="#">WORK ITEM</a>
                        </div>

                        <div class="wizard_steps">
                          <div class="normal_steps bg-orange"><strong><?php if(!empty($status_bar_data['planned_physical_activity_count']) && $status_bar_data['planned_physical_activity_count']>0){echo $status_bar_data['planned_physical_activity_count'];}else{echo "0";}?>/<?php if(!empty($status_bar_data['total_work_item_with_activity_count']) && $status_bar_data['total_work_item_with_activity_count']>0){echo $status_bar_data['total_work_item_with_activity_count'];}else{echo "0";}?></strong></div>
                          <a href="#">PHYSICAL PLANNING</a>
                        </div>

                          <?php if( $finalcial_module_permission ){ ?>
                              <div class="wizard_steps">
                                  <div class="normal_steps bg-blue"><strong><?php if(!empty($status_bar_data['planned_financial_activity_count']) && $status_bar_data['planned_financial_activity_count']>0){echo $status_bar_data['planned_financial_activity_count'];}else{echo "0";}?>/<?php if(!empty($status_bar_data['total_work_item_with_activity_count']) && $status_bar_data['total_work_item_with_activity_count']>0){echo $status_bar_data['total_work_item_with_activity_count'];}else{echo "0";}?></strong></div>
                                  <a href="#">FINANCIAL PLANNING</a>
                              </div>
                          <?php }else{ ?>
                              <div class="wizard_steps">
                                  <div class="normal_steps bg-blue"><strong><i class="large material-icons" style="position: relative;top: 8px;">done</i></strong></div>

                              </div>
                          <?php  } ?>
                        <div class="steps_line"></div>
                        -->
                            </div>
                        </div>
          </div>
                   
                    <div class="card">
                        <div class="header">
                          <h2>Add a New Activity</h2>
                        </div>
                        <div class="body">
                          <?php echo form_open('Project/add_project_activity',array('name'=> 'add_project_activity','id'=>'add_project_activity_form')); ?>
                              <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Activity Name:<span style="color: red;">*</span> 
                                            </th>
                                            <?php if( $finalcial_module_permission ){ ?>
                                                <th>Estimated Amount (INR)<span style="color: red;">*</span> </th>
                                            <?php } ?>
                                            <th>Status<span style="color: red;">*</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>">
                                            <input type="hidden" name="activity_id" value="<?php echo base64_encode($activity_id); ?>">

                                            <input type="text" class="form-control" placeholder="Activity Name" name="particular" required="" value="<?php if(!empty($project_activity_detail_edit[0]['particulars'])){echo $project_activity_detail_edit[0]['particulars'];}else{echo "";}?>"/></td>
                                            <?php if( $finalcial_module_permission ){ ?>
                                                <td><input type="text" class="form-control" placeholder="Amount" name="amount" required="" pattern="[+-]?([0-9]*[.])?[0-9]+" value="<?php if(!empty($project_activity_detail_edit[0]['amount'])){echo $project_activity_detail_edit[0]['amount'];}else{echo "";}?>"/></td>
                                            <?php } ?>
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
                                            <th style="text-align: center;">Sl No</th>
                                            <th style="text-align: center;">Particulars Name</th>
                                            <?php if( $finalcial_module_permission ){ ?>
                                                <th style="text-align: center;">Estimated Amount</th>
                                                <th style="text-align: center;">Planned Amount</th>
                                                <th style="text-align: center;">Remaining Amount</th>
                                            <?php } ?>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($project_activity_deatail)){
                                               $i=1;
                                               $sum_amt=0;
                                               $sum_planned_amnt=0;
                                               $sum_remaining_amnt=0;
                                               foreach($project_activity_deatail as $activity_deatail){
                                                $sum_amt=$sum_amt+$activity_deatail['amount'];

                                                $planned_amount= $CI->get_planned_amount($project_id,$activity_deatail['id']);
                                                $sum_planned_amnt=$sum_planned_amnt+$planned_amount[0]['planned_amnt'];

                                                $remaining_amt=$activity_deatail['amount']-$planned_amount[0]['planned_amnt'];

                                                $sum_remaining_amnt= $sum_remaining_amnt+$remaining_amt; 
                                        ?>
                                        <tr>
                                            <td width="5%" ><?php echo $i;?></td>
                                            <td width="30%"><a href="#" data-toggle="modal" data-target="#exampleModal" style="color: #555" onclick="get_activity_wise_workitem_breakup('<?php echo $project_id;?>','<?php echo $activity_deatail['id'];?>','<?php echo $activity_deatail['particulars'];?>')"><?php echo $activity_deatail['particulars'];?></a></td>
                                            <?php if( $finalcial_module_permission ){ ?>
                                                <td width="20%" align="right"><?php echo number_format($activity_deatail['amount'],2);?></td>
                                                <td width="20%" align="right"><?php echo number_format($planned_amount[0]['planned_amnt'],2);?></td>
                                                <td width="15%" align="right"><?php echo number_format($remaining_amt,2);?></td>
                                            <?php } ?>
                                            <td width="10%" align="right">
                                              <a href="<?php echo base_url(); ?>Project/project_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']); ?>&activity_id=<?php echo base64_encode($activity_deatail['id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>

                                              <a href="<?php echo base_url(); ?>Project/delete_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']); ?>&activity_id=<?php echo base64_encode($activity_deatail['id']); ?>" class="col-black" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </a>

                                              <?php if($activity_deatail['status']=='Y'){?>
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
                                            <?php if( $finalcial_module_permission ){ ?>
                                        <tr>

                                            <td></td>

                                                <td><strong>Total Amount: </strong></td>
                                                <td align="right"><b><?php echo number_format($sum_amt,2);?></b></td>
                                                <td align="right"><b><?php echo number_format($sum_planned_amnt,2);?></b>
                                                </td>

                                            <td align="left" colspan="2" style="padding-left: 40px;"><b><?php echo number_format($sum_remaining_amnt,2);?></b></td>

                                        </tr>
                                            <?php } ?>
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="6">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>

                </div>
                 <?php if( $finalcial_module_permission ){ ?>
                        <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                           <thead>
                                                <tr>
                                                    <th colspan="2" style="text-align: left;">Charges</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($project_other_setting_detail)){
                                                       $i=1;
                                                       $sum_charges=0;
                                                       $sum_planned_charges=0;
                                                       $sum_remaining_charges=0;
                                                       foreach($project_other_setting_detail as $other_detail){

                                                        $charge_amount= (($sum_amt * $other_detail['charge_percentage']) / 100);
                                                        $sum_charges=$sum_charges+$charge_amount;


                                                        $charge_planned_amount= (($sum_planned_amnt * $other_detail['charge_percentage']) / 100);
                                                        $sum_planned_charges=$sum_planned_charges+$charge_planned_amount;


                                                        $charge_remaining_amount= $sum_remaining_charges+ (($sum_remaining_amnt * $other_detail['charge_percentage']) / 100);
                                                        $sum_remaining_charges=$sum_remaining_charges+$charge_remaining_amount;
                                                ?>
                                                <tr>
                                                    <td width="5%"><?php echo $i;?></td>
                                                    <td width="30%"><?php echo $other_detail['charge_name']." (".$other_detail['charge_percentage']."%)";?></td>
                                                    <td width="20%" align="right"><?php echo number_format($charge_amount,2);?></td>
                                                    <td width="20%" align="right"><?php echo number_format($charge_planned_amount,2);?></td>
                                                    <td width="15%" align="right"><?php echo number_format($sum_remaining_charges,2);?></td>
                                                    <td width="10%"></td>
                                                </tr>
                                                <?php
                                                       $i++;
                                                     }
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td><strong>Gross Amount: </strong></td>
                                                    <td align="right"><b><?php echo number_format(($sum_amt+$sum_charges),2);?></b></td>
                                                    <td align="right"><b><?php echo number_format(($sum_planned_amnt+$sum_planned_charges),2);?></b>
                                                    </td>
                                                    <td align="left" colspan="2" style="padding-left: 40px;"><b><?php echo number_format(($sum_remaining_amnt+$sum_remaining_charges),2);?>
                                                    </b></td>


                                                </tr>
                                               <?php }else{?>
                                                 <tr>
                                                    <td colspan="6">No Data Found</td>
                                                 </tr>
                                               <?php } ?>
                                            </tbody>
                                        </table>

                        </div>
                 <?php } ?>
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
          url: "<?php echo base_url();?>project/get_workitem_wise_breakup", 
          data: {project_id: project_id,activity_id: activity_id,activity_name:activity_name,type:"activity"},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
      }
    </script>