<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
            <div class="block-header">
             <h4><?php if(empty($project_physical_id)){echo "CREATING";}else{echo "UPDATE";}?> PHYSICAL PLAN OF A PROJECT </h4>
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
                      <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-warning waves-effect" title="Work Item"><i class="fas fa-cubes"></i> Work Item</a>
                      <?php if($pro_work_item_cnt > 0){ ?>
                      <span class="label-count2 bg-blue"><?php echo $pro_work_item_cnt; ?></span>
                      <?php } ?>
                      </div>

                      <a href="<?php echo base_url();?>pf_planning/project_planning?project_id=<?php echo base64_encode($project_id);?>#planning" class="btn btn-primary waves-effect" title="Planning"><i class="fas fa-sliders-h"></i> Planning</a>
            </div>
            <!-- Basic Examples -->
            <?php echo form_open('pf_planning/add_physical_planning',array('name'=> 'add_financial_planning','id'=>'add_financial_planning_form')); ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                    <div class="card">
                         
             <div class="body">
                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td><strong>Work Item</strong>: </td>
                                            <td>
                                              <?php
                                                $work_item_name= $CI->work_item($project_work_item_id);
                                                echo $work_item_name[0]['work_item_description'];
                                              ?>
                                              <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                              <input type="hidden" name="work_item_id" value="<?php echo $project_work_item_id; ?>">
                                              <input type="hidden" name="project_physical_id" value="<?php echo $project_physical_id; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                              if(empty($project_physical_id)){
                                            ?>
                                                <td><strong>Select Activity</strong><span style="color: red;">*</span>: </td>
                                                <td><select class="form-control show-tick" name="activity_id" required="">
                                                <option value="">Select Activity</option>
                                                <?php
                                                foreach($project_activity_deatail as 
                                                  $activity_deatail){
                                                ?>
                                                  <option value="<?php echo $activity_deatail['id']?>" <?php if($project_activity_id==$activity_deatail['id']){echo "selected";}?>><?php echo $activity_deatail['particulars']?></option>
                                                <?php  
                                                }
                                                ?>
                                                </select></td>
                                            <?php }else{?>
                                                <td><strong>Activity</strong>: </td>
                                                <td>
                                                  <?php 
                                                    $activity_name= $CI->work_activity($project_activity_id);
                                                    echo $activity_name[0]['particulars'];
                                                  ?>
                                                  <input type="hidden" value="<?php echo $project_activity_id;?>" name="activity_id">
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <tr>
                                            <td><strong>Select Unit</strong><span style="color: red;">*</span>: </td>
                                            <td><select class="form-control show-tick" name="unit_id" required="">
                                                <option value="">Select Unit</option>
                                                <?php
                                                foreach($unit_detail as $unit){
                                                ?>
                                                  <option value="<?php echo $unit['id']?>" <?php if($unit['id']==$unit_id[0]['id']){echo "selected";} ?>><?php echo $unit['unit_name']?></option>
                                                <?php  
                                                }
                                                ?>
                                                
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Work Item Type</strong>: </td>
                                            <td><?php echo $work_item_type[0]['type_name'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td><strong>Start Date</strong> : </td>
                                            <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>End Date</strong> : </td>
                                            <td><?php $end_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $end_date->format('jS M Y'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                </div>
              </div>
          </div>
                   
                    
                    <div class="card">
             <div class="body">
             <?php /*echo '<pre>';
             print_r($project_physical_planning_detail);
             echo '</pre>';*/
             ?>
               <div class="table-responsive">
                                <?php
                                      $start    = new DateTime($project_aggrement_deatail[0]['project_start_date']);
                                      $start->modify('first day of this month');
                                      $end      = new DateTime($project_aggrement_deatail[0]['project_end_date']);
                                      $end->modify('first day of next month');
                                      $interval = DateInterval::createFromDateString('1 month');
                                      $period   = new DatePeriod($start, $interval, $end);
                                ?>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th style="padding: 10px 5px; width: 40px">Sl No</th>
                                            <th style="padding: 10px 5px; width: 350px">Months
                                            </th>
                                            <th style="padding: 10px 5px; width: 150px">Target
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                        $i=1;$j=0;
                                        foreach ($period as $dt) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <?php echo $dt->format("M Y");?>
                                                <input type="hidden" class="form-control" placeholder="Cost" name="month[]" value="<?php echo $dt->format("M Y");?>"/>
                                                <input type="hidden" name="physical_planning_detail_id[]" value="<?php if(!empty($project_physical_planning_detail[$j]['id'])){echo $project_physical_planning_detail[$j]['id'];}else{echo "";};?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Quantity" name="target[]" value="<?php if(!empty($project_physical_planning_detail[$j]['target_quantity'])){echo $project_physical_planning_detail[$j]['target_quantity'];}else{echo "";};?>" />
                                            </td>
                                            
                                        </tr>
                                       <?php $j++;$i++;} ?> 
                                    </tbody>
                                </table>
                           
                               
                                <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                       <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                       <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                </div>
                            </div>
                            
              </div>
          </div>
                </div>
            </div>
            </form>
            <!-- #END# Basic Examples -->

        </div>
        
        
        
        
    </section>