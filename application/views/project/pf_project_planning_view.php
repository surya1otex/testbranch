<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
        

        <div class="col-md-6">
            <div class="block-header">
             <h4>Project Planning</h4>
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
                      <a href="<?php echo base_url();?>pf_planning/project_work_item?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-warning waves-effect" title="Stage"><i class="fas fa-cubes"></i> Stage</a>
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
             <div class="body">
               <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable" name="planning">
                    <tbody>
                      <tr style="background: #e6e6e6;">
                        <td rowspan="2" style="text-align: center; vertical-align: middle; width:10%" class="p-b-0"><strong>Sl No</strong></td>
                        <td rowspan="2" style="text-align: center; vertical-align: middle;" class="p-b-0"><strong>Stage</strong></td>

                        <!-- <td colspan="2" style="text-align: center; background: #b4c4e4;width:15%" class="p-b-0"><strong>Physical</strong></td> -->

                        <td colspan="2" style="text-align: center; background: #b4c4e4" class="p-b-0"><strong>Financial</strong></td>
                        <td rowspan="2" style="text-align: center; vertical-align: middle;" class="p-b-0"><strong>Planning</strong></td>
                      </tr>
                      <tr style="background: #e6e6e6;">
                        <!-- <td colspan="2" style="text-align: center; background: #b5bec9; border-right: 1px solid #ddd;">Planned Activities</td> -->
                        <td style="text-align: center; background: #b5bec9; border-right: 1px solid #ddd;">Planned Activities</td>
                        <td style="text-align: center; background: #b5bec9; border-right: 1px solid #ddd;">Planned Value</td>
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
                            $activity_cnt = $CI->count_data_against_project('project_physical_planning_main','project_id',$project_id,'project_work_item_id',$work_item_deatail['work_item_id']);

                            $fin_activity_cnt = $CI->count_data_against_project('project_financial_planning_main','project_id',$project_id,'project_work_item_id',$work_item_deatail['work_item_id']);
                      ?>
                              <tr>
                                <td><?php echo $i; ?> </td>
                                <td><?php echo $work_item_name[0]['work_item_description']?></td>
                                
                                <!-- <td colspan="2" style="border-right-color: #8694a3;">
                                  <?php
                                  //echo $activity_cnt;
                                   
                                  ?>
                                </td> -->
                                <td align="center"><?php echo $fin_activity_cnt; ?></td>
                                
                                <td align="right">
                                 <?php
                                 if(!empty($financial_planned)){
                                      echo number_format($financial_planned[0]['target_amount'],2);
                                 }else{
                                      echo "--";
                                 }
                                 ?>
                                </td>
                                <td>
                                
                                                                    
                                    <a href="<?php echo base_url();?>pf_planning/financial_listing?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-warning waves-effect" title="Financial Planning"><i class="fas fa-tasks"></i> Financial</a>
                                    
                                    
 
                                   
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
                      <tr>
                        <td style="text-align: center"><strong> TOTAL </strong></td>
                        <td  style="width: 11%">--</td>
                      
                        <td colspan="2" align="right"><b><?php echo number_format($sum_fin_planned,2);?></b></td>
                        <td></td>

                      </tr>
                    
                                          
                    </tbody>
                  </table>
                                
                 
              </div>
          </div>
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>


    
        <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>
<!-- ENd Alert Page js for hide alert  -->