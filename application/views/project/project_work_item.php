<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">


        <div class="col-md-6">
            <div class="block-header">
                <?php echo $this->session->flashdata('message'); ?></span>
             <h4><?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?></h4>
            </div>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="header">
                    <h2><?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?> Details for <?php echo $project_deatail[0]['project_name'];?></h2>
                  </div>
                  <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td width="40%"><strong>Project Name : </strong></td>
                                            <td><?php echo $project_deatail[0]['project_name'];?></td>
                                        </tr>
                                        <?php 
                                          $project_area= $CI->project_area($project_deatail[0]
                                            ['project_area']);
                                          $project_type= $CI->project_type($project_deatail[0]
                                            ['project_type']);

                                        ?>
                                        <tr>
                                            <td><strong>Area : </strong></td>
                                            <td><?php echo $project_area[0]['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Type : </strong></td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Administrative Approval Amnt : </strong></td>
                                            <td><?php echo number_format($project_deatail[0]['estimate_total_cost'],2);?> INR</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Start Date : </strong></td>
                                            <td><?php $from_date = new DateTime($project_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>End Date : </strong></td>
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
                    <h2>Add New <?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?></h2>
                  </div>
                  <div class="body">
                    <?php echo form_open('Project/add_project_work_item',array('name'=> 'add_project_work_item','id'=>'add_project_work_item_form')); ?>
                      <div class="section_clone">  
                        <div class="row clearfix cloneBox1">
                          <div class="col-sm-12">
                            <div class="col-md-2">
                              <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                  <?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?> Name<span style="color: red;">*</span> :
                              </label>
                            </div>
                                    
                            <div class="col-md-4">
                              <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>">
                              <select class="form-control show-tick" name="work_item" required="" id="work_item">
                                  <?php $selected_work_item = $this->session->flashdata('work_item_id'); ?>

                                  <option value="">Select <?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?></option>
                                  <?php foreach($work_item_list as $item_list){?>

                                    <option value="<?php echo $item_list['id']?>" <?php if($item_list['id']  == $selected_work_item ){ echo "selected"; }?> ><?php echo $item_list['work_item_description']?></option>
                                  <?php } ?>
                              </select>
                                <span id="err_span" style='color:#ff0000'>
                                    <?php echo $this->session->flashdata('error_message'); ?></span>
                            </div>
                              <?php if( $finalcial_module_permission ){ ?>
                            <div class="col-md-2">
                              <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Total Cost (<i class="fas fa-rupee-sign"> </i>)<span style="color: red;">*</span> :
                              </label>
                            </div>
                                    
                            <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Total Cost" required="" name="amount"/>
                            </div>
                              <?php } ?>
                          </div>
                        </div>
                        <div class="col-md-2 col-md-offset-5" id="project_planning" style="margin-top: -21px;">
                          <input type="submit" name="submit" value="Add" class="btn bg-indigo waves-effect" />
                          <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                    
                    

            <div class="card">
             <div class="body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" name="planning">
                    <tbody>
                      <tr style="background: #e6e6e6;">
                        <td rowspan="2" style="text-align: center; vertical-align: middle; width:10%" class="p-b-0"><strong>Sl No</strong></td>
                        <td rowspan="2" style="text-align: center; vertical-align: middle;" class="p-b-0"><strong><?php echo $CI->get_project_monitoring_type($project_deatail[0]['id']);?></strong></td>

                        <td rowspan="2" style="text-align: center; background: #b4c4e4;width:15%" class="p-b-0"><strong>Target</strong><br>(Physical)</td>
                          <?php if( $finalcial_module_permission ){ ?>
                                <td colspan="2" style="text-align: center; background: #b4c4e4" class="p-b-0"><strong>Total Cost</strong> <br>(Financial)</td>

                        <td rowspan="2" style="text-align: center; vertical-align: middle;" class="p-b-0"><strong>Planing</strong></td>
                          <?php } ?>
                      </tr>
                      <tr style="background: #e6e6e6;">
                          <?php if( $finalcial_module_permission ){ ?>
                        <td style="text-align: center; background: #cbd2da">Budget</td>
                          <?php } ?>
                        <td style="text-align: center; background: #b5bec9; border-right: 1px solid #ddd;">Planned</td>
                      </tr>
                      <?php if(!empty($project_work_item_deatail)){
                           $i=1;
                           $sum_fin_budget=0;
                           $sum_fin_planned=0;
                           foreach($project_work_item_deatail as $work_item_deatail){
                            $work_item_name= $CI->work_item($work_item_deatail['work_item_id']); 
                            $sum_fin_budget=$sum_fin_budget+$work_item_deatail['amount'];

                            $physical_target=$CI->work_item_physical_target($project_id,$work_item_deatail['work_item_id']);

                            $financial_planned=$CI->work_item_financial_planned_amount($project_id,$work_item_deatail['work_item_id']);
                            $sum_fin_planned=$sum_fin_planned+$financial_planned[0]['target_amount'];
                      ?>
                              <tr>
                                <td><?php echo $i; ?> </td>
                                <td><?php echo $work_item_name[0]['work_item_description']?></td>
                                
                                <td style="border-right-color: #8694a3;">
                                  <?php
                                    if(!empty($physical_target)){
                                      $k=1;
                                      foreach($physical_target as $target){
                                         $unit_name=$CI->get_unit($target['unit_id']);

                                         echo $k.") ".$target['target']." ".$unit_name[0]['unit_name'].'<br>';
                                         $k++;
                                      }
                                      
                                    }else{
                                      echo "--";
                                    }
                                  ?>
                                </td>
                                  <?php if( $finalcial_module_permission ){ ?>
                                <td align="right"><?php echo number_format($work_item_deatail['amount'],2);?></td>
                                <td align="right">
                                 <?php
                                 if(!empty($financial_planned)){
                                      echo number_format($financial_planned[0]['target_amount'],2);
                                 }else{
                                      echo "--";
                                 }
                                 ?>
                                </td>
                                  <?php } ?>
                                <td>
                                    <?php if($finalcial_module_permission) { ?>
                                    <a href="<?php echo base_url();?>Project/financial_listing?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-warning waves-effect" title="Financial Planning"><i class="fas fa-tasks"></i> Financial</a>
                                    <?php } ?>
                                    <a href="<?php echo base_url();?>Project/physical_listing?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-primary waves-effect" title="Physical Planning" ><i class="fas fa-people-carry"></i> Physical</a>
                                </td>
                              </tr>
                      <?php 
                           $i++;
                         }
                      ?>
                      <?php }else{?> 
                      <tr>
                        <td colspan="3">No Data Found</td>
                      </tr>
                      <?php } ?>
                      <?php if( $finalcial_module_permission ){ ?>
                      <tr>
                        <td style="text-align: center"><strong> TOTAL </strong></td>
                        <td style="width: 11%" colspan="2">--</td>
                        <td style="width: 11.5%" align="right"><b><?php echo number_format($sum_fin_budget,2);?></b></td>
                        <td align="right"><b><?php echo number_format($sum_fin_planned,2);?></b></td>
                        <td></td>

                      </tr>
                      <tr>
                                            
                          <th style="text-align: center;" colspan="3">Charges Name</th>
                          <th style="text-align: center;"></th>
                          <th style="text-align: center;"></th>
                          <th style="text-align: center;"></th>
                      </tr>
                      <?php if(!empty($project_other_setting_detail)){
                                 $i=1;
                                 $sum_budget_tax=0;
                                 $sum_planned_tax=0;
                                 foreach($project_other_setting_detail as $other_detail){

                                  $charge_budget_amount= (($sum_fin_budget * $other_detail['charge_percentage']) / 100);
                                  $sum_budget_tax=$sum_budget_tax+$charge_budget_amount;

                                  $charge_planned_amount= (($sum_fin_planned * $other_detail['charge_percentage']) / 100);
                                  $sum_planned_tax=$sum_planned_tax+$charge_planned_amount;
                     ?>
                                        <tr>
                                            <td style="text-align: center;" colspan="3"><?php echo $other_detail['charge_name']." (".$other_detail['charge_percentage']."%)";?></td>
                                            <td align="right"><?php echo number_format($charge_budget_amount,2);?></td>
                                            <td align="right"><?php echo number_format($charge_planned_amount,2);?></td>
                                            <td align="right"></td>
                                        </tr>
                                        <?php 
                                               $i++;
                                             }
                                        ?>
                                        <tr>
                                            <td style="text-align: center;" colspan="3">Gross Amount:</td>
                                            <td align="right"><b><?php echo number_format(($sum_budget_tax+$sum_fin_budget),2);?></b></td>
                                            <td align="right"><b><?php echo number_format(($sum_fin_planned+$sum_planned_tax),2);?></b></td>
                                            <td align="right"></td>
                                        </tr> 
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="5">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                          <?php } ?>
                    </tbody>
                  </table>
                                
                 
              </div>
          </div>
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>