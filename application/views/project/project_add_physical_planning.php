<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
            <div class="block-header">
             <h4><?php if(empty($project_physical_id)){echo "CREATING";}else{echo "UPDATE";}?> PHYSICAL PLAN OF A PROJECT </h4>
            </div>
            </div>
            <!-- Basic Examples -->
            <?php echo form_open('Project/add_physical_planning',array('name'=> 'add_financial_planning','id'=>'add_financial_planning_form')); ?>
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
                                                <?php foreach($project_activity_deatail as $activity_deatail){ ?>
                                                  <option value="<?php echo $activity_deatail['id']?>" <?php if($project_activity_id==$activity_deatail['id']){echo "selected";}?>><?php echo $activity_deatail['particulars']?></option>
                                                <?php } ?>
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
                                            <td><?php $from_date = new DateTime($project_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                            <input type="hidden" id="project_start_dt" value="<?php echo $project_deatail[0]['project_start_date']; ?>" />
                                        </tr>
                                        <tr>
                                            <td><strong>End Date</strong> : </td>
                                            <td><?php $end_date = new DateTime($project_deatail[0]['project_end_date']); echo $end_date->format('jS M Y'); ?></td>
                                            <input type="hidden" id="project_end_dt" value="<?php echo $project_deatail[0]['project_end_date']; ?>"
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
                    <?php if( ($project_deatail[0]['project_start_date'] != '0000-00-00' || $project_deatail[0]['project_start_date'] != '') && ($project_deatail[0]['project_end_date'] != '0000-00-00' || $project_deatail[0]['project_end_date'] != '') && ($project_deatail[0]['TD_status'] == 'Y') ) { ?>
                        <?php
                        if($project_monitoring_frequency == 'W'){

                          include('weekly_monitoring.php');
                        } else if($project_monitoring_frequency == 'F'){

                         include('half_month_monitoring.php');
                       } else if($project_monitoring_frequency == 'M'){

                             include('monthly_monitoring.php');
                       } else if($project_monitoring_frequency == 'C'){

                            include('custom_monitoring.php');
                         }else{ ?>
                           <div class="col-md-6 col-md-offset-3" style="margin-top: 5px;">
                               <div class="alert alert-danger">
                                   <strong>Monitoring frequesncy</strong> not yet selected!
                               </div>
                               <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                           </div>
                   <?php } ?>
                   <?php if($project_monitoring_frequency != '') { ?>
                   <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">

                       <input type="submit"  id="submit_btn" name="submit"  class="btn bg-indigo waves-effect" value="SAVE">-
                       <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                   </div>
                   <?php } ?>

                   <?php } else { ?>
                        <div class="col-md-6 col-md-offset-3" style="margin-top: 5px;">
                            <div class="alert alert-danger">
                                <strong>Agreement Stage</strong> not yet completed!
                            </div>
                            <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                        </div>

                   <?php } ?>
                            </div>
                            
              </div>
          </div>
                </div>
            </div>
            </form>
            <!-- #END# Basic Examples -->

        </div>
        
        
        
        
    </section>
<script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
</script>