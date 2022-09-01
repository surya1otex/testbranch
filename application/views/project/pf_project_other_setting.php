<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
        <div class="block-header">
         
          <h4>Other Charges
          </h4>
          
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
                                        <th scope="row">Area:</th>
                                        <td><?php echo !empty($project_area) ? $project_area[0]['name']: "--"?></td>
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
                        <div class="header">
                          <h2>Add Other Charges
                        </h2>
                        </div>
                        <div class="body">
                          <?php echo form_open('pf_planning/add_project_other_setting',array('name'=> 'add_project_other_setting','id'=>'add_project_other_setting_form')); ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                       <!-- <th>AOC Component Name </th>-->
                                            <th>Description<span style="color: red;">*</span> </th>
                                            <th>Percentage<span style="color: red;">*</span> </th>
                                            <th>Status<span style="color: red;">*</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>">
                                            <input type="hidden" name="other_setting_id" value="<?php echo base64_encode($other_setting_id); ?>">

                                            <input type="text" class="form-control" placeholder="Title" required="" name="title" value="<?php if(!empty($project_other_setting_detail_edit[0]['charge_name'])){echo $project_other_setting_detail_edit[0]['charge_name'];}else{echo "";}?>"/></td>

                                            <td><input type="number" class="form-control" placeholder="Percentage" min="1" required="" name="percentage" name="percentage" value="<?php if(!empty($project_other_setting_detail_edit[0]['charge_percentage'])){echo $project_other_setting_detail_edit[0]['charge_percentage'];}else{echo "";}?>"/></td>
                                            <td><select class="form-control show-tick" name="status" required="">
                                            <option value="Y" <?php if(!empty($project_other_setting_detail_edit) &&($project_other_setting_detail_edit[0]['status']=="Y")){echo "selected";}?>>Active</option>
                                            <option value="N" <?php if(!empty($project_other_setting_detail_edit) &&($project_other_setting_detail_edit[0]['status']=="N")){echo "selected";}?>>Inactive</option>
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
                    <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-offset-3 col-md-6">
                    <?php 
                     $pro_activity_cnt = $CI->count_data_against_project('project_pf_activities','project_id',$project_id,'status','Y');
                     $pro_work_item_cnt = $CI->count_data_against_project('project_work_items','project_id',$project_id,'status','Y');

                    ?>

                    <a href="<?php echo base_url();?>pf_planning/project_other_setting?project_id=<?php echo base64_encode($project_id);?>" class="btn btn-primary waves-effect" title="Other Charges"> <i class="fas fa-cog"></i> </a>
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
                  </div>
                    
                    
                    <div class="card">
             <div class="body">
               <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Description</th>
                                            <th>Percentage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($project_other_setting_detail)){
                                                $i=1;
                                                foreach($project_other_setting_detail as $other_detail){
                                        ?>
                                                  <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $other_detail['charge_name'];?></td>
                                                    <td> <?php echo $other_detail['charge_percentage'];?>% </td>
                                                    <td>
                                                      <a href="<?php echo base_url(); ?>pf_planning/project_other_setting?project_id=<?php echo base64_encode($other_detail['project_id']); ?>&other_setting_id=<?php echo base64_encode($other_detail['id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>
                                                      <a href="<?php echo base_url(); ?>pf_planning/delete_other_setting?project_id=<?php echo base64_encode($other_detail['project_id']); ?>&other_setting_id=<?php echo base64_encode($other_detail['id']); ?>" class="col-black" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i> </a>

                                                      <?php if($other_detail['status']=='Y'){?>
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


    <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>
<!-- ENd Alert Page js for hide alert  -->