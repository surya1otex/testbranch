  <?php  $CI =& get_instance(); ?>
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
  <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

  <link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <section class="content">
        <div class="container-fluid">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>         
        
    </div>
            <div class="block-header">
                <h4>Pre Project Initiation </h4>
            </div>
            
          <!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">Concept Creation</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>
                    <li class="active">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li>
                    
                    <li class="gray">
                          <span class="circle"><i class="fas fa-list"></i></span>
                          <span class="label">Tender</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>           
            
    <!-- Steps end -->     
            
   
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 
                   
 <!--    Project_Information End -->  
            
            
             
 <!-- Quick Nav   -->
            
  <?php project_quick_nav($project_id);  ?> 
            
<!-- Quick Nav end -->           
            
<?php echo form_open_multipart('Pre_consttruction_activity_tree_cutting/manage', array('name' => 'pre_consttruction_activity_tree_cutting','id' => 'pre_consttruction_activity_tree_cutting')); ?>
<input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Tree Cutting </h2>
                        </div>

                        <div class="body">
                            

                            <div class="row clearfix">

                               <div class="col-md-4">
                                    <p>
                                        <b>No. of Trees To be Cut  <span class="col-pink">*</span></b>
                                    </p>
                                
                                    <input class="form-control txtQty" type="text" placeholder="No.Trees Cut" name="noof_trees_tobe_cut" id="noof_trees_tobe_cut" value="<?php if(empty($tree_cutting)){ echo set_value('noof_trees_tobe_cut'); }?><?php echo $tree_cutting[0]['noof_trees_tobe_cut'] ?>">
                                    <input type="hidden" id="total_trees_tobe_cut_hidden">
                                    <?php echo form_error('noof_trees_tobe_cut', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Forest Division </b>
                                    </p>
                            <select class="form-control show-tick" name="forest_division_id">
                                <?php
                                   foreach($forest_id as $forest)
                                   { ?>

                                   <option value="<?php echo $forest->id ?>"<?php
                                        if ((!empty($tree_cutting[0]['forest_division_id']) && $tree_cutting[0]['forest_division_id'] == $forest->id) || $_REQUEST['forest_division_id'] == $forest->id) {
                                            echo "selected";
                                        } ?>><?php echo $forest->division_name ?></option>
                                   <?php
                                   }
                                     ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>OFDC Division </b>
                                    </p>
                            <select class="form-control show-tick" name="ofdc_division_id">
                                <?php
                                   foreach($ofdc_id as $ofdc)
                                   { ?>

                                    <option value="<?php echo $ofdc->id ?>"<?php
                                        if ((!empty($tree_cutting[0]['ofdc_division_id']) && $tree_cutting[0]['ofdc_division_id'] == $ofdc->id) || $_REQUEST['ofdc_division_id'] == $ofdc->id) {
                                            echo "selected";
                                        } ?>><?php echo $ofdc->ofdc_name ?></option>
                                   <?php
                                   }
                                     ?>
                                    </select>
                                </div>

                            </div>
                            
                            <div class="row clearfix">
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                    
                                     <input type="text" class="datepicker form-control" placeholder="Please choose a date..." name="target_end_date" value="<?php if(empty($tree_cutting)){ echo set_value('target_end_date'); }?><?php echo $tree_cutting[0]['target_end_date'] ?>">
                                     <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
   
                           </div>
                        </div>
                    
                    <div class="card">
                        <div class="header">
                            <h2> Location Details </h2>
                        </div>

                        <div class="body">
                           <div class="col-md-3" style="display: none;">
                             <div class="form-group">
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">All District</option>

                             <?php 
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }

                             ?>
                        </select>
                         </div>
                       </div>


                        <?php
                   if(!empty($treecutting_location_data)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($treecutting_location_data);
              
                foreach ($treecutting_location_data as $sameD) {
                  if($k == 1){
            
                ?>
                   
                                <div class="col-md-4">
                                    <p>
                                        <b>Districts Name</b>
                                        
                                    </p>
                      <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);ulbFunc(1);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>



                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils Covered <!-- <span class="col-pink">* </span> --></b>
                                       
                                    </p>
                                    <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple" >
                           <?php
                             echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
                            ?>
                        </select>
                                </div>


                                <div class="col-md-2 p-t-25">
<button   id="newField_<?php echo $get_same_datacnt; ?>" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
<i class="material-icons">add</i>
</button>
</div>

             <?php

              }

             else{ ?>
                         
                              <div id="newAdd_<?php echo $k; ?>">
                                <div class="col-md-12 p-0 mt-10px">
                                
                                <div class="col-md-4">

                                   <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="tehsilFunc(<?php echo $k; ?>);ulbFunc(<?php echo $k; ?>);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-4">
 
                                    <select name="tehsil_id[<?php echo $k - 1; ?>][]" id="tehsil_id_<?php echo $k; ?>" class="form-control select2" multiple="multiple" >
                           <?php
                            echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
              
                            ?>
                           
                        </select>
                                </div>

                                
                                <div class="col-md-2">
<button   id="removefld_<?php echo $k; ?>" data-id="<?php echo $k; ?>" name="submit" type="button"class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i>
</button>
</div>
                                </div>
                                
                                </div>
                           
                           
                    <?php } ?>


                   <?php $k++; 

                 }

                  ?>
                                
                             </div>
        




                             
                    <?php 

                  } else { 

                    ?>
                            <div id="container1" class="row clearfix addrow">
                              <?php
                              $get_same_datacnt = count($treecutting_location_data);
                              ?>
                                <div class="col-md-4">
                                    <p>
                                        <b>Districts covered </b>
                                        
                                    </p>
                              <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);">
                                  <option value="0">Please select</option>
                                            <?php
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }
                                     ?>
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils covered <!-- <span class="col-pink">* </span> --></b>
                                        
                                    </p>
                  <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple">
                                      
                                    </select>
                                </div>
                                <div class="col-md-2 p-t-25">
<button id="newField_1" class="add-data btn btn-success btn-circle waves-effect waves-circle waves-float" name="submit" type="button">
<i class="material-icons">add</i>
</button>
</div>
                                
                             </div>

                      <?php } ?>
                        
                        </div>
                    </div>

                    <div class="card"> 
                          <div class="header">
                            <h2> Status of Key Milestones</h2>
                          </div>  
                         
                        <div class="body">
                            
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Join Verification Done ? </b>
                                    </p>
                                    

                                     <select class="form-control show-tick" name="joint_verification">
                             <option value="Yes" <?php echo set_select('joint_verification','Yes', ( !empty($tree_cutting[0]['status_joint_verification']) &&
                                      $tree_cutting[0]['status_joint_verification'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('joint_verification','No', ( !empty($tree_cutting[0]['status_joint_verification']) &&
                                      $tree_cutting[0]['status_joint_verification'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                        <option value="N.A" <?php echo set_select('joint_verification','N.A', ( !empty($tree_cutting[0]['status_joint_verification']) &&
                                      $tree_cutting[0]['status_joint_verification'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                   <?php echo form_error('joint_verification', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Join Verification  </b>
                                    </p>
                                    
                                     <input  type="file" value="fileupload" name="file_joint_verification" id="uploadFile1" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif"> 
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($tree_cutting[0]['file_joint_verification'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/tree_cutting/<?php echo $tree_cutting[0]['file_joint_verification']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                      <?php echo form_error('file_joint_verification', '<div class="error">', '</div>'); ?>
                                </div>
                            
                                <div class="col-md-3">
                                    <p>
                                        <b>Enumeration Done ? </b>
                                    </p>
                                     <select class="form-control show-tick" name="status_enumeration">
                             <option value="Yes" <?php echo set_select('status_enumeration','Yes', ( !empty($tree_cutting[0]['status_enumeration']) &&
                                      $tree_cutting[0]['status_enumeration'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_enumeration','No', ( !empty($tree_cutting[0]['status_enumeration']) &&
                                      $tree_cutting[0]['status_enumeration'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('status_enumeration','In Progress', ( !empty($tree_cutting[0]['status_enumeration']) &&
                                      $tree_cutting[0]['status_enumeration'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_enumeration','N.A', ( !empty($tree_cutting[0]['status_enumeration']) &&
                                      $tree_cutting[0]['status_enumeration'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>

                                    <?php echo form_error('status_enumeration', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Enumeration  </b>
                                    </p>
                                    

                                     <input  type="file" name="file_enumeration" value="fileupload" id="uploadFile2" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                      <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($tree_cutting[0]['file_enumeration'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/tree_cutting/<?php echo $tree_cutting[0]['file_enumeration']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                      <?php echo form_error('file_enumeration', '<div class="error">', '</div>'); ?>
                                </div>
                           
                                <div class="col-md-3">
                                    <p>
                                        <b>Cutting Permission Obtained ? </b>
                                    </p>
                                    

                                     <select class="form-control show-tick" name="status_cutting_permission">
                             <option value="Yes" <?php echo set_select('status_cutting_permission','Yes', ( !empty($tree_cutting[0]['status_cutting_permission']) &&
                                      $tree_cutting[0]['status_cutting_permission'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_cutting_permission','No', ( !empty($tree_cutting[0]['status_cutting_permission']) &&
                                      $tree_cutting[0]['status_cutting_permission'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('status_cutting_permission','In Progress', ( !empty($tree_cutting[0]['status_cutting_permission']) &&
                                      $tree_cutting[0]['status_cutting_permission'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_cutting_permission','N.A', ( !empty($tree_cutting[0]['status_cutting_permission']) &&
                                      $tree_cutting[0]['status_cutting_permission'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                    <?php echo form_error('status_cutting_permission', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Cutting Permission  </b>
                                    </p>
                                    
                                     <input  type="file" name="file_cutting_permission" id="uploadFile3" value="fileupload" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif"> 
                                      <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    <?php if (!empty($tree_cutting[0]['file_cutting_permission'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/tree_cutting/<?php echo $tree_cutting[0]['file_cutting_permission']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?>
                                      <?php echo form_error('file_cutting_permission', '<div class="error">', '</div>'); ?> 
                                </div>
                            
                                <div class="col-md-3">
                                    <p>
                                        <b>Fund for Tree Cutting Placed ? </b>
                                    </p>
                                    
                                    <select class="form-control show-tick" name="status_fund_for_tree_cutting">
                             <option value="Yes" <?php echo set_select('status_fund_for_tree_cutting','Yes', ( !empty($tree_cutting[0]['status_fund_for_tree_cutting']) &&
                                      $tree_cutting[0]['status_fund_for_tree_cutting'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_fund_for_tree_cutting','No', ( !empty($tree_cutting[0]['status_fund_for_tree_cutting']) &&
                                      $tree_cutting[0]['status_fund_for_tree_cutting'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('status_fund_for_tree_cutting','In Progress', ( !empty($tree_cutting[0]['status_fund_for_tree_cutting']) &&
                                      $tree_cutting[0]['status_fund_for_tree_cutting'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_fund_for_tree_cutting','N.A', ( !empty($tree_cutting[0]['status_fund_for_tree_cutting']) &&
                                      $tree_cutting[0]['status_fund_for_tree_cutting'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                    <?php echo form_error('status_fund_for_tree_cutting', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Fund Placement </b>
                                    </p>
                                     
                                     <input  type="file" name="file_fund_for_tree_cutting" id="uploadFile4" value="fileupload" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif"> 
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($tree_cutting[0]['file_fund_for_tree_cutting'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/tree_cutting/<?php echo $tree_cutting[0]['file_fund_for_tree_cutting']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 
                                      <?php echo form_error('file_fund_for_tree_cutting', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Tender Awarded ? </b>
                                    </p>
                                    

                                    <select class="form-control show-tick" name="status_tender_awarded">
                             <option value="Yes" <?php echo set_select('status_tender_awarded','Yes', ( !empty($tree_cutting[0]['status_tender_awarded']) &&
                                      $tree_cutting[0]['status_tender_awarded'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_tender_awarded','No', ( !empty($tree_cutting[0]['status_tender_awarded']) &&
                                      $tree_cutting[0]['status_tender_awarded'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('status_tender_awarded','In Progress', ( !empty($tree_cutting[0]['status_tender_awarded']) &&
                                      $tree_cutting[0]['status_tender_awarded'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_tender_awarded','N.A', ( !empty($tree_cutting[0]['status_tender_awarded']) &&
                                      $tree_cutting[0]['status_tender_awarded'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                    <?php echo form_error('status_tender_awarded', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-3">
                                    <p>
                                        <b>Documents / Tender Awarded </b>
                                    </p>
                                    
                                     <input  type="file" name=" file_tender_awarded" id="uploadFile5" value="fileupload" accept=".png,.jpg,.jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <?php if (!empty($tree_cutting[0]['file_tender_awarded'])) { ?>
                                        <a href="<?php echo base_url();?>uploads/files/tree_cutting/<?php echo $tree_cutting[0]['file_tender_awarded']; ?>" title="Download" download>
                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                        </a>
                                      <?php } ?> 
                                      <?php echo form_error('file_tender_awarded', '<div class="error">', '</div>'); ?>
                                </div>
                            </div>
                              
                           </div>
                         </div>
        <input type="hidden" name="file_joint_verification_hidden" value="<?php echo $get_prvatelandla[0]['file_joint_verification']; ?>" />
        <input type="hidden" name="file_enumeration_hidden" value="<?php echo $get_prvatelandla[0]['file_enumeration']; ?>" />
        <input type="hidden" name="file_cutting_permission_hidden" value="<?php echo $get_prvatelandla[0]['file_cutting_permission']; ?>" />
        <input type="hidden" name="file_fund_for_tree_cutting_hidden" value="<?php echo $get_prvatelandla[0]['file_fund_for_tree_cutting']; ?>" />
       <input type="hidden" name="file_tender_awarded_hidden" value="<?php echo $get_prvatelandla[0]['file_tender_awarded']; ?>" />                
                        
                        
                       <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>No. of Trees Cut </b>
                                    </p>
                                    
                                     <input class="form-control txtQty" type="text" placeholder="No. of trees cut" name="progress_noof_trees_cut" id="progress_noof_trees_cut" value="<?php if(empty($tree_cutting)){ echo set_value('progress_noof_trees_cut'); }?><?php echo $tree_cutting[0]['progress_noof_trees_cut'] ?>">
                                     <?php echo form_error('progress_noof_trees_cut', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                    
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="Progress" name="progress" value="<?php if(empty($tree_cutting)){ echo set_value('progress'); }?><?php echo $tree_cutting[0]['progress_%'] ?>">
                                     <?php echo form_error('progress', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Tree Cutting Required A / A Done </b>
                                    </p>
                                    
                                    <select class="form-control show-tick" name="progress_tree_cutting_required_for_aa_done">
                             <option value="Yes" <?php echo set_select('progress_tree_cutting_required_for_aa_done','Yes', ( !empty($tree_cutting[0]['progress_tree_cutting_required_for_aa_done']) &&
                                      $tree_cutting[0]['progress_tree_cutting_required_for_aa_done'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('progress_tree_cutting_required_for_aa_done','No', ( !empty($tree_cutting[0]['progress_tree_cutting_required_for_aa_done']) &&
                                      $tree_cutting[0]['progress_tree_cutting_required_for_aa_done'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('progress_tree_cutting_required_for_aa_done','In Progress', ( !empty($tree_cutting[0]['progress_tree_cutting_required_for_aa_done']) &&
                                      $tree_cutting[0]['progress_tree_cutting_required_for_aa_done'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('progress_tree_cutting_required_for_aa_done','N.A', ( !empty($tree_cutting[0]['progress_tree_cutting_required_for_aa_done']) &&
                                      $tree_cutting[0]['progress_tree_cutting_required_for_aa_done'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>

                                    <?php echo form_error('progress_tree_cutting_required_for_aa_done', '<div class="error">', '</div>'); ?>
                                </div>
                                
                            </div>
                             
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized  </b>
                                    </p>
                                    
                                     <input class="form-control txtQty" type="text" placeholder="Amount" name="progress_amount_utilised" value="<?php if(empty($tree_cutting)){ echo set_value('progress_amount_utilised'); }?><?php echo number_format($tree_cutting[0]['progress_amount_utilised'],2) ?>">
                                     <?php echo form_error('progress_amount_utilised', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p>
                                    
                                     <input class="form-control txtQty limittxt_progress" type="text" placeholder="pre-construction fund Utilized" name="progress_fund_utilised" value="<?php if(empty($tree_cutting)){ echo set_value('progress_fund_utilised'); }?><?php echo $tree_cutting[0]['progress_fund_utilised'] ?>">
                                     <?php echo form_error('progress_fund_utilised', '<div class="error">', '</div>'); ?>
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <textarea class="form-control no-resize" rows="3" id="maxremarks" placeholder="Please type what you want..." name="remarks"><?php if(empty($tree_cutting)){ echo set_value('remarks'); }?><?php echo $tree_cutting[0]['remarks'] ?></textarea>
                                    <span id="warning-message" style='color:#ff0000'></span>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                </div>
                            </div> 
                          </div>
                            
                          <div class="col-md-12  align-center">
                            <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                            <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($tree_cutting)) ? 'SAVE' : 'Update' ?>
                            </button>
                           </div>
                           <div class="clearfix"></div>   
                        
                        
                      </div>

                    </div>
                 </div>
                

         </form>
 
            </div>
        </div>
    </section>
  <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- #Main Content -->
            <?php
          if(empty($treecutting_location_data)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>
            <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
   var dividcnt = <?php echo $cnt6; ?>;
   
   var i = <?php echo $cnt6; ?>;
for (i = 1; i <= <?php echo $cnt6; ?>; i++) {
   
$('#tehsil_id_'+i).select2({dropdownAutoWidth : true});
$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
    
});

    $("#noof_trees_tobe_cut").keyup(function() {
    //alert($(this).val());
    var total_trees_tobe_cutting = $(this).val();
    $("#total_trees_tobe_cut_hidden").val(total_trees_tobe_cutting);
    //alert(total_trees_tobe_cutting);
  });
  
  $(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
var ex_val = $('.limittxt_progress').val();
if(ex_val > 100) {
    $('.limittxt_progress').val('0');
}
$('.limittxt_progress').keyup(function(){
  if ($(this).val() > 100){
    alert("No numbers above 100");
    $(this).val(ex_val);
  }
});

$('#progress_noof_trees_cut').keyup(function(){
 var curval = $(this).val();
 //alert(curval);
  var hidden_area = $("#total_trees_tobe_cut_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#noof_trees_tobe_cut").val();
  }
   if ( parseInt(curval) > parseInt(hidden_area) ){
    alert("Number of tree Cut should less than Total Number of tree Cutting");
    $(this).val(0);
  }
});
</script>


<script type="text/javascript">

var divid = <?php echo $cnt6; ?>;
var optionValues = $("#hidden_dist_fetch").html();
      $('#container1').on('click','#newField_' + divid, function () {
       // alert(divid);
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-4"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="tehsilFunc('+divid+');">' +optionValues+ '</select></div></div><div class="col-md-4"><div class=""><select name="tehsil_id['+ndiv+'][]" id="tehsil_id_'+divid+'" multiple="multiple" class="form-control select2"></select></div></div><div class="col-md-4"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
         $('#container1').append(newthing);
         $('.select2').select2();
    });

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
        $('#newAdd_'+id).remove();

    });



    function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
//$("#ulb_id_"+divid).empty();


if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_private_land_dp/gettehsil_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
     // alert(data);
      
      
                            var parsed_data = JSON.parse(data);
                            $("#tehsil_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_tehsil.length);
                    if(parsed_data.all_tehsil.length > 0)
                    {
                               for (var i = 0; i < parsed_data.all_tehsil.length; i++)
                                      {
                    $("#tehsil_id_"+divid).append("<option  value='" + parsed_data.all_tehsil[i].id  + "'>" + parsed_data.all_tehsil[i]. tahsil_name + "</option>");
                   // $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }

                    else
                    {
                    $("#tehsil_id_"+divid).append("<option  value=''>" +'Select Another District' + "</option>");
                    
                      $val_selec =''; 
                    }



                              
                            
      }
    });
    }
    //$('#tehsil_id_'+divid).select2({dropdownAutoWidth : true});
}

for(let i=1; i<= 5; i++) {
   $('#uploadFile'+i).change(function () {
      var fileExtension = ['png','pdf','jpg','docs'];
      var MAX_FILE_SIZE = 50 * 1024 * 1024;
       if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
          swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
          this.value = ''; // Clean field
       return false;
     }
        fileSize = this.files[0].size;
          if (fileSize > MAX_FILE_SIZE) {
            swal(" ", "File must not exceed 50 MB", "error");
            this.value = '';
            } else {

     }
   });
}

var maxLength = 250;
$(document).ready(function(){
$('#maxremarks').on('keydown keyup change', function(){
var char = $(this).val();
var charLength = $(this).val().length;
if(charLength > maxLength){
$('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
$(this).val(char.substring(0, maxLength));
}else{
$('#warning-message').text('');
}
});
});
</script>
  <style type="text/css">
      .error {
        color: red;
        padding-bottom: 10px;
      }
    </style>