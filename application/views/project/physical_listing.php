<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
            <div class="block-header">
              <h4>Physical Budget</h4>
              <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?>
            </div>
          </div>
          
            <!-- Basic Examples -->
          <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="body">
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <tbody>
                                        <tr>
                                            <td>Project Name : </td>
                                            <td><?php echo $project_deatail[0]['project_name'];?></td>
                                        </tr>
                                        <?php 
                                          $project_area= $CI->project_area($project_deatail[0]
                                            ['project_area']);
                                          $project_type= $CI->project_type($project_deatail[0]
                                            ['project_type']);

                                        ?>
                                        <tr>
                                            <td>Area : </td>
                                            <td><?php echo $project_area[0]['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Type : </td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Administrative Approval Amnt : </td>
                                            <td><?php echo number_format($project_deatail[0]['estimate_total_cost'],2);?> INR</td>
                                        </tr>
                                        <tr>
                                            <td>Start Date : </td>
                                            <td><?php $from_date = new DateTime($project_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>End Date : </td>
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
          <?php
            $work_item_name= $CI->work_item($project_work_item_id);
          ?>
          <div class="block-header">
           <h4>Physical Planning for Work Item <?php echo $work_item_name[0]['work_item_description'];?></h4>
          </div>
          <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th style="text-align: center;">Sl No</th>
                              <th style="text-align: center;">Work Activity</th>
                              <th style="text-align: center;">Quantity</th>
                              <th style="text-align: center;">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($project_activity_deatail)){
                               $i=1;
                               foreach($project_activity_deatail as $activity_deatail){
                                $project_activity_id=$activity_deatail['id'];
                                $physical_detail=$CI->get_physical_main($project_id,$project_work_item_id,$project_activity_id);
                                $unit_name=$CI->get_unit($physical_detail[0]['activity_quantity_unit_id']);
                        ?>
                              <tr>
                                <td><?php echo $i;?></td>
                                <td>
                                  <a href="#" data-toggle="modal" data-target="#exampleModal" style="color: #555" onclick="get_activity_wise_workitem_breakup('<?php echo $project_id;?>','<?php echo $activity_deatail['id'];?>','<?php echo $activity_deatail['particulars'];?>')"><?php echo $activity_deatail['particulars'];?></a>
                                </td>
                                <td align="right">
                                <?php
                                  if(!empty($physical_detail)){
                                   echo $physical_detail[0]['total_activity_quantity']." ".$unit_name[0]['unit_name'];
                                  }else{
                                   echo "--";
                                  }
                                ?>
                                </td>
                                
                                <td>
                                  <?php if(!empty($physical_detail)){ ?>
                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_activity_details('<?php echo $project_id; ?>','<?php echo $project_work_item_id; ?>','<?php echo $project_activity_id; ?>','<?php echo $activity_deatail['particulars']; ?>','<?php echo $work_item_name[0]['work_item_description'];?>')">VIEW DETAILS</button>
                                   <a href="<?php echo base_url(); ?>project/add_physical_planning?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>&project_activity_id=<?php echo base64_encode($project_activity_id); ?>&project_physical_id=<?php echo base64_encode($physical_detail[0]['id']); ?>" class="m-r-10"> <i class="fas fa-edit"></i> </a>
                                  <?php }else{ ?>
                                    <a href="<?php echo base_url(); ?>project/add_physical_planning?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>&project_activity_id=<?php echo base64_encode($project_activity_id); ?>"  class="btn btn-primary"><span>CREATE PHYSICAL PLAN</span></a>
                                  <?php } ?>
                                </td>
                              </tr>
                                        <?php 
                                               $i++;
                                             }
                                        ?>
                                        
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="4">No Data Found</td>
                                         </tr>
                                       <?php } ?>
                                    </tbody>
                    </table>
                                
                 

                </div>
            </div>
          </div>
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>


    <!-- Modal -->
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
          data: {project_id: project_id,activity_id: activity_id,activity_name:activity_name,type:"physical"},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
      }

      function get_activity_details(project_id,work_item_id,activity_id,activity_name,workitem_name){

        $.ajax({
          type: "POST",
          url: "<?php echo site_url();?>/project/get_physical_month_details",
          data: {project_id: project_id,work_item_id: work_item_id,activity_id:activity_id,activity_name:activity_name,workitem_name:workitem_name},
          success: function(data) {

            $('.modal-body').html(data);
          }
        });
      }


    
    </script>

