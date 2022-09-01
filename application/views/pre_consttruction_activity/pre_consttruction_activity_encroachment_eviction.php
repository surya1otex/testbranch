   <?php $CI =& get_instance();?>
 <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
     <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    
    
    <!-- Multi Select Css 
    <link href="<?php echo base_url();?>assets/plugins/multi-select/css/multi-select.css" rel="stylesheet">
    
    
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>Pre Project Initiation </h4>
            </div>
            
            
    <!-- Alert Message -->
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
    <!-- End Alert Message -->
            
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
    <!-- Quick Nav Start -->   
<?php project_quick_nav($project_id);  ?>        
<!-- Quick Nav end -->   
 <?php echo form_open_multipart('Pre_consttruction_activity_encroachment_eviction/manage', array('name' => 'pre_consttruction_activity_encroachment_eviction','id' => 'pre_consttruction_activity_encroachment_eviction', 'class'=> 'container-fluid')); ?>
 
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
            
			<div class="row clearfix">
                <div class="">
               <!-- Encroachment Eviction Start-->
               
                    <div class="card">
                        <div class="header">
                            <h2> Encroachment Eviction </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Area Under Encroachment ( In Acres ) <span class="col-pink">*</span></b>
                                        
                                    </p>
                                     <?php $val = (!empty($_REQUEST['total_area'])) ? $_REQUEST['total_area'] : $encroachment_data[0]['total_area']; ?>
                                    <input class="form-control txtQty" type="text" name="total_area" value="<?php echo $val; ?>" placeholder="Area under Encroachment">
                           			<span style='color:#ff0000'><?php echo form_error('total_area'); ?></span>
                                </div>
                                
                                 <div class="col-md-4">
                                    <p>
                                        <b>Type of Encroachment </b>
                                        
                                    </p>
                                     <select class="form-control show-tick" name="types_of_encroachment">
                                        <option value="0">Select Type</option>

                             <?php   foreach ($encroachment_type as  $CTvalue){?>
                                      <option value="<?php echo $CTvalue->id; ?>"  <?php
                                        if ((!empty($encroachment_data[0]['types_of_encroachment']) && $encroachment_data[0]['types_of_encroachment'] == $CTvalue->id) || $_REQUEST['types_of_encroachment'] == $CTvalue->id) {
                                            echo "selected";
                                        } ?> ><?php echo $CTvalue->name; ?></option>

                              <?php } ?>
                                     </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date</b>
                                      
                                    </p>
                                     <?php 
									 
									  $date_t_end_date = (!empty($encroachment_data[0]['target_end_date']) && $encroachment_data[0]['target_end_date'] != '0000-00-00') ? $encroachment_data[0]['target_end_date'] : '';
                                    
									 
									 
									 $t_end_date = (!empty($_REQUEST['target_end_date'])) ? $_REQUEST['target_end_date'] : $date_t_end_date; ?>
                                     <input type="text" name="target_end_date" value="<?php echo $t_end_date; ?>"  class="datepicker form-control" placeholder="Please choose a date...">
                                </div>  
                                
                             </div>
                            
                            
   
                           </div>
                        </div>
                        
               <!-- Encroachment Eviction End-->

                        
               <!-- Location Details Start-->
                    <div class="card">
                        <div class="header">
                            <h2> Location Details </h2>
                        </div>

                        <div class="body">
                         <div class="col-md-3" style="display: none;">
                      <div class="form-group">
                        <label>Class / Course <span class="text-red"> * </span></label>
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="">Select District</option>

                             <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>" ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                      </div>
                    </div>   
                        <?php
                   if(!empty($encroachment_location_data)){
                    ?>
                    
                    
                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($encroachment_location_data);
                foreach ($encroachment_location_data as $sameD) {
                  if($k == 1){
					  
                ?>
                   
                                <div class="col-md-3">
                                    <p>
                                        <b>Districts Name </b>
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_1" class="form-control selectBoxV" onchange="tehsilFunc(1);ulbFunc(1);">
                           <option value="">Select District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Tehsils Covered </b>
                                       
                                    </p>
                                    <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple" >
                           <?php
                            echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
                            ?>
                        </select>
                        
        <input type="hidden" name="hd_row_no[]" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Ulbs Covered</b>
                                       
                                    </p>
                                    <select class="form-control select2" id="ulb_id_1" name="ulb_id[0][]" multiple="multiple"  style="width: 100%;">
                                     <?php
                            echo $CI->getulbSelection_data($sameD->district_id,$sameD->ulb_id);
                            ?>
                        </select>
                                </div>
                                <div class="col-md-2 p-t-25">
<button   id="newField_<?php echo $get_same_datacnt; ?>" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
<i class="material-icons">add</i>
</button>
</div>

						 <?php }else{ ?>
                         
                              <div id="newAdd_<?php echo $k; ?>">
                                <div class="col-md-12 p-0 mt-10px">
                                
                                <div class="col-md-3">
                                    <p>
                                       <!-- <b>Districts Name <span class="col-pink">* </span></b>-->
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control selectBoxV" onchange="tehsilFunc(<?php echo $k; ?>);ulbFunc(<?php echo $k; ?>);">
                           <option value="">Select District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                       <!-- <b>Tehsils covered </b>-->
                                       
                                    </p>
                                    <select name="tehsil_id[<?php echo $k - 1; ?>][]" id="tehsil_id_<?php echo $k; ?>" class="form-control select2" multiple="multiple" >
                           <?php
                            echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
							
                            ?>
                           
                          
                        </select>
                        
        <input type="hidden" name="hd_row_no[]" value="<?php echo $k - 1; ?>" />
                                </div>
                                <div class="col-md-3">
                                   <p>
                                        <!-- <b>Ulbs covered</b>-->
                                       
                                    </p>
                                    <select class="form-control select2" id="ulb_id_<?php echo $k; ?>" name="ulb_id[<?php echo $k - 1; ?>][]" multiple="multiple"  style="width: 100%;">
                                     <?php
                            echo $CI->getulbSelection_data($sameD->district_id,$sameD->ulb_id);
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
                   <?php $k++; } ?>
                                
                             </div>
                             
                             
                    <?php } else { ?>
                            <div id="container1" class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Districts Name <span class="col-pink">* </span></b>
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_1" class="form-control selectBoxV" onchange="tehsilFunc(1);ulbFunc(1);">
                           <option value="">Select District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>" ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Tehsils Covered </b>
                                       
                                    </p>
                                    <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple" >
                           <!-- <option value="0">All Tehsil</option>-->
                        </select>
                        
        <input type="hidden" name="hd_row_no[]" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Ulbs Covered</b>
                                       
                                    </p>
                                    <select class="form-control select2" id="ulb_id_1" name="ulb_id[0][]" multiple="multiple"  style="width: 100%;">
                        </select>
                                </div>
                                <div class="col-md-2 p-t-25">
<button  id="newField_1" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
<i class="material-icons">add</i>
</button>
</div>
                                
                             </div>
                    <?php } ?>
                            
                      
                        </div>
                    </div>
                    
               <!-- Location Details  End-->
               <!-- Status of key milestones Start -->

                        
                    <div class="card"> 
                          <div class="header">
                            <h2> Status of Key Milestones</h2>
                          </div>  
                         
                        <div class="body"> 
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Joint Verification Done ? </b>
                                    </p>
                                     <select name="status_joint_verification" class="form-control show-tick">
                                        <option value="yes" <?php
                                        if ((!empty($encroachment_data[0]['status_joint_verification']) && $encroachment_data[0]['status_joint_verification'] == "yes") || $_REQUEST['status_joint_verification'] == "yes") {
                                            echo "selected";
                                        } ?>>Yes</option>
                                        <option value="no" <?php
                                        if ((!empty($encroachment_data[0]['status_joint_verification']) && $encroachment_data[0]['status_joint_verification'] == "no") || $_REQUEST['status_joint_verification'] == "no") {
                                            echo "selected";
                                        } ?>>No</option>
                                        <option value="inprogress" <?php
                                        if ((!empty($encroachment_data[0]['status_joint_verification']) && $encroachment_data[0]['status_joint_verification'] == "inprogress") || $_REQUEST['status_joint_verification'] == "inprogress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="NA" <?php
                                        if ((!empty($encroachment_data[0]['status_joint_verification']) && $encroachment_data[0]['status_joint_verification'] == "NA") || $_REQUEST['status_joint_verification'] == "NA") {
                                            echo "selected";
                                        } ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>Documents / Joint Verification </b>
                                    </p>
                                     <input  type="file" name="file_joint_verification" value="" id=""> ( pdf, jpg and png )
                                     <?php if(!empty($encroachment_data[0]['file_joint_verification'])) { ?>
                                      <?php $file_link4 = base_url().'uploads/attachment/'.$encroachment_data[0]['file_joint_verification']; ?>
                                     <a href="<?php echo $file_link4; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                                 
                                <div class="col-md-4">
                                    <p>
                                        <b>Formal Requisition Filed ? </b>
                                    </p>
                                     <select name="status_formal_requisition" class="form-control show-tick">
                                         <option value="yes" <?php
                                        if ((!empty($encroachment_data[0]['status_formal_requisition']) && $encroachment_data[0]['status_formal_requisition'] == "yes") || $_REQUEST['status_formal_requisition'] == "yes") {
                                            echo "selected";
                                        } ?>>Yes</option>
                                        <option value="no" <?php
                                        if ((!empty($encroachment_data[0]['status_formal_requisition']) && $encroachment_data[0]['status_formal_requisition'] == "no") || $_REQUEST['status_formal_requisition'] == "no") {
                                            echo "selected";
                                        } ?>>No</option>
                                        <option value="inprogress" <?php
                                        if ((!empty($encroachment_data[0]['status_formal_requisition']) && $encroachment_data[0]['status_formal_requisition'] == "inprogress") || $_REQUEST['status_formal_requisition'] == "inprogress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="NA" <?php
                                        if ((!empty($encroachment_data[0]['status_formal_requisition']) && $encroachment_data[0]['status_formal_requisition'] == "NA") || $_REQUEST['status_formal_requisition'] == "NA") {
                                            echo "selected";
                                        } ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>Documents / Requisition </b>
                                    </p>
                                     <input  type="file" name="file_requisition" value="" id=""> ( pdf, jpg and png ) 
                                     <?php if(!empty($encroachment_data[0]['file_requisition'])) { ?>
									 <?php $file_link3 = base_url().'uploads/attachment/'.$encroachment_data[0]['file_requisition']; ?>
                                     <a href="<?php echo $file_link3; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                          
                                <div class="col-md-4">
                                    <p>
                                        <b>Enroachment Eviction Programme Fixed </b>
                                    </p>
                                     <select name="status_encroachment_eviction" class="form-control show-tick">
                                          <option value="yes" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_eviction']) && $encroachment_data[0]['status_encroachment_eviction'] == "yes") || $_REQUEST['status_encroachment_eviction'] == "yes") {
                                            echo "selected";
                                        } ?>>Yes</option>
                                        <option value="no" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_eviction']) && $encroachment_data[0]['status_encroachment_eviction'] == "no") || $_REQUEST['status_encroachment_eviction'] == "no") {
                                            echo "selected";
                                        } ?>>No</option>
                                        <option value="inprogress" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_eviction']) && $encroachment_data[0]['status_encroachment_eviction'] == "inprogress") || $_REQUEST['status_encroachment_eviction'] == "inprogress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="NA" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_eviction']) && $encroachment_data[0]['status_encroachment_eviction'] == "NA") || $_REQUEST['status_encroachment_eviction'] == "NA") {
                                            echo "selected";
                                        } ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>Documents / Eviction Programme </b>
                                    </p>
                                     <input  type="file" name="file_eviction" value="" id=""> ( pdf, jpg and png )
                                     <?php if(!empty($encroachment_data[0]['file_eviction'])) { ?>
                                     <?php $file_link1 = base_url().'uploads/attachment/'.$encroachment_data[0]['file_eviction']; ?>
                                     <a href="<?php echo $file_link1; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                          
                                <div class="col-md-4">
                                    <p>
                                        <b>Enroachment Notice Field </b>
                                    </p>
                                     <select name="status_encroachment_notice" class="form-control show-tick">
                                         <option value="yes" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_notice']) && $encroachment_data[0]['status_encroachment_notice'] == "yes") || $_REQUEST['status_encroachment_notice'] == "yes") {
                                            echo "selected";
                                        } ?>>Yes</option>
                                        <option value="no" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_notice']) && $encroachment_data[0]['status_encroachment_notice'] == "no") || $_REQUEST['status_encroachment_notice'] == "no") {
                                            echo "selected";
                                        } ?>>No</option>
                                        <option value="inprogress" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_notice']) && $encroachment_data[0]['status_encroachment_notice'] == "inprogress") || $_REQUEST['status_encroachment_notice'] == "inprogress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="NA" <?php
                                        if ((!empty($encroachment_data[0]['status_encroachment_notice']) && $encroachment_data[0]['status_encroachment_notice'] == "NA") || $_REQUEST['status_encroachment_notice'] == "NA") {
                                            echo "selected";
                                        } ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <p>
                                        <b>Documents / Enroachment Notice </b>
                                    </p>
                                     <input  type="file" name="file_encroachment" value="" id=""> ( pdf, jpg and png )
                                     <?php if(!empty($encroachment_data[0]['file_encroachment'])) { ?>
                                     <?php $file_link = base_url().'uploads/attachment/'.$encroachment_data[0]['file_encroachment']; ?>
                                     <a href="<?php echo $file_link; ?>" class="m-r-15" title="Download" download><i class="fas fa-download"></i> </a>
                                     <?php } ?>
                                </div>
                            </div>
                              
                        </div>
                      </div>
                      
        <input type="hidden" name="file_joint_verification_hidden" value="<?php echo $encroachment_data[0]['file_joint_verification']; ?>" />
        <input type="hidden" name="file_requisition_hidden" value="<?php echo $encroachment_data[0]['file_requisition']; ?>" />
        <input type="hidden" name="file_eviction_hidden" value="<?php echo $encroachment_data[0]['file_eviction']; ?>" />
        <input type="hidden" name="file_encroachment_hidden" value="<?php echo $encroachment_data[0]['file_encroachment']; ?>" />
               <!-- Status of key milestones End-->
               <!-- Status of Progress Start -->

                        
                    <div class="card">  
                        <div class="header">
                          <h2> Status of Progress</h2>
                        </div>
                        
                       <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Enroachment Area Evicted so Far </b>
                                    </p>
                                     <?php $progress_encroachment_area = (!empty($_REQUEST['progress_encroachment_area'])) ? $_REQUEST['progress_encroachment_area'] : $encroachment_data[0]['progress_encroachment_area']; ?>
                                     <input class="form-control txtQty" name="progress_encroachment_area" value="<?php echo $progress_encroachment_area; ?>" type="text" placeholder="area evicted so far">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Progress % </b>
                                    </p>
                                     <?php $progress = (!empty($_REQUEST['progress'])) ? $_REQUEST['progress'] : $encroachment_data[0]['progress_%']; ?>
                                     <input class="form-control txtQty limittxt_progress" type="text" name="progress" value="<?php echo $progress; ?>" placeholder="Progress">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Enroachment Eviction for A / A Done ? </b>
                                    </p>
                                    
                                    <select name="progress_enroachment_area_aa" class="form-control show-tick">
                                        <option value="">Select...</option>
                                        <option value="yes" <?php
                                        if ((!empty($encroachment_data[0]['progress_enroachment_area_aa']) && $encroachment_data[0]['progress_enroachment_area_aa'] == "yes") || $_REQUEST['progress_enroachment_area_aa'] == "yes") {
                                            echo "selected";
                                        } ?>>Yes</option>
                                        <option value="no" <?php
                                        if ((!empty($encroachment_data[0]['progress_enroachment_area_aa']) && $encroachment_data[0]['progress_enroachment_area_aa'] == "no") || $_REQUEST['progress_enroachment_area_aa'] == "no") {
                                            echo "selected";
                                        } ?>>No</option>
                                        <option value="inprogress" <?php
                                        if ((!empty($encroachment_data[0]['progress_enroachment_area_aa']) && $encroachment_data[0]['progress_enroachment_area_aa'] == "inprogress") || $_REQUEST['progress_enroachment_area_aa'] == "inprogress") {
                                            echo "selected";
                                        } ?>>In Progress</option>
                                        <option value="NA" <?php
                                        if ((!empty($encroachment_data[0]['progress_enroachment_area_aa']) && $encroachment_data[0]['progress_enroachment_area_aa'] == "NA") || $_REQUEST['progress_enroachment_area_aa'] == "NA") {
                                            echo "selected";
                                        } ?>>N.A.</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized </b>
                                    </p>
                                     <?php $progress_amount_utilised = (!empty($_REQUEST['progress_amount_utilised'])) ? $_REQUEST['progress_amount_utilised'] : $encroachment_data[0]['progress_amount_utilised']; ?>
                                     <input class="form-control txtQty" type="text" name="progress_amount_utilised" value="<?php echo number_format($progress_amount_utilised,2); ?>" placeholder="Amount">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-construction Fund Utilized </b>
                                    </p> 
                                     <?php $progress_fund_utilised = (!empty($_REQUEST['progress_fund_utilised'])) ? $_REQUEST['progress_fund_utilised'] : $encroachment_data[0]['progress_fund_utilised']; ?>
                                     <input class="form-control txtQty limittxt_progress" name="progress_fund_utilised" type="text" value="<?php echo $progress_fund_utilised; ?>" placeholder="pre-construction fund Utilized">
                                </div> 
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                     <?php $remarks = (!empty($_REQUEST['remarks'])) ? $_REQUEST['remarks'] : $encroachment_data[0]['remarks']; ?>
                                    <textarea class="form-control no-resize" name="remarks" rows="3" placeholder="Please type what you want..."><?php echo $remarks; ?></textarea>
                                </div>
                            </div>   
                              
                          </div>
                            
                          <div class="col-md-12  align-center">
                              <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">SAVE</button>
                           </div>
                           <div class="clearfix"></div>   
                        
                      </div>

                    </div>
               <!-- Status of Progress End -->
                 </div>
                

            <!-- Select -->
            </div>
        </div>
        </form>
    </section>
    
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
    <script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
    
    <!-- Multi Select Plugin Js 
    <script src="<?php echo base_url();?>assets/plugins/multi-select/js/jquery.multi-select.js"></script>-->
    <?php
          if(empty($encroachment_location_data)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>
          
<script type="text/javascript">
</script>
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
	
	$(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});
//var ex_val = 0;
<?php //if (!empty($encroachment_data[0]['progress_%'])) { ?>
//var ex_val = $('.limittxt_progress').val();
<?php  //} ?>

//var check_val = (100 - ex_val);
//alert(check_val);
// $('.limittxt_progress').on('keyup', function(e){
//     if(this.value >= check_val){
//        alert('You have entered more than 100 as input');
// 	   $('.limittxt_progress').val(ex_val);
//        return false;
//     }
// });

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


var ex_valfund = 0;
<?php if (!empty($encroachment_data[0]['progress_fund_utilised'])) { ?>
var ex_valfund = $('.limittxt_fund').val();
<?php  } ?>
var check_valfund = (100 - ex_valfund);

$('.limittxt_fund').on('keyup', function(e){
    if(this.value >= check_valfund){
       alert('You have entered more than 100 as input');
	   $('.limittxt_fund').val(ex_valfund);
       return false;
    }
});

</script>

<script type="text/javascript">

  
   var divid = <?php echo $cnt6; ?>;
   var optionValues = $("#hidden_dist_fetch").html();

      $('#container1').on('click','#newField_' + divid, function () {
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-3"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control validate[required]" onchange="tehsilFunc('+divid+');ulbFunc('+divid+');">' + optionValues + '</select></div></div><div class="col-md-3"><div class=""><select name="tehsil_id['+ndiv+'][]" id="tehsil_id_'+divid+'" multiple="multiple" class="form-control select2"></select><input type="hidden" name="hd_row_no[]" value="'+ndiv+'" /></div></div><div class="col-md-3"><div class=""><select class="form-control select2" id="ulb_id_'+divid+'" name="ulb_id['+ndiv+'][]" multiple="multiple" style="width: 100%;"></select></div></div><div class="col-md-3"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
		  
		  
		                

         $('#container1').append(newthing);
         $('.select2').select2()
    });
  

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
        $('#newAdd_'+id).remove();

    });
    
   
$('#tehsil_id_1').select2({dropdownAutoWidth : true});
$('#ulb_id_1').select2({dropdownAutoWidth : true});

</script>

<script type="text/javascript">
  function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
	//alert(divid);
	<?php if (!empty($encroachment_location_data)) { ?>
	
	if (divid >= "1") {	
	<?php } else { ?>
	if (divid != "1") {	
	<?php } ?>
	var selected_dis = [];
	 $('#dist_id_'+divid).removeClass('selectBoxV');
	 $.each($(".selectBoxV option:selected"), function(){ 
		selected_dis.push($(this).val());
		 });
	var selected_dis_list = selected_dis.join(", "); 
	//alert("You have selected the district - " + selected_dis.join(", "));
	var arr = selected_dis_list.split(", "); 
	
	//alert(selected_dis_list);
	//alert(arr);
	}  
	
	else {  var arr =""; }
		if (arr.indexOf(value) !== -1) {
		   alert("You have already selected this District");
		  $('#dist_id_'+divid+' option:selected').removeAttr('selected');
		  $('#tehsil_id_'+divid).val(-100).trigger('change');
		  $('#ulb_id_'+divid).val(-100).trigger('change');
		   return false;
		} 
		
		else {
		
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_encroachment_eviction/gettehsil_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
      
      
      
                            var parsed_data = JSON.parse(data);
                            $("#tehsil_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";
                    //alert(parsed_data.all_data.length);
                    if(parsed_data.all_tehsil.length > 0)
                    {
                               for (var i = 0; i < parsed_data.all_tehsil.length; i++)
                                      {
                    $("#tehsil_id_"+divid).append("<option  value='" + parsed_data.all_tehsil[i].id  + "'>" + parsed_data.all_tehsil[i]. tahsil_name + "</option>");
                    $('#xamwise_subjectlist').html('').prepend();
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
	
	else
	{
	
		  $('#tehsil_id_'+divid).val(-100).trigger('change');
		  $('#ulb_id_'+divid).val(-100).trigger('change');	
	}
							} 
		}
	

 function ulbFunc(divid) {
    var value = $('#dist_id_'+divid).val();
$("#ulb_id_"+divid).empty();
if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_encroachment_eviction/getulb_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","dist_id": value },
    
    success: function(data){
      
      
                            var parsed_data = JSON.parse(data);
                            
                            
                              $val_selec ='';
                            var listItems= "";
                    if(parsed_data.all_ulb.length > 0)
                    {
                      $("#ulb_id_"+divid).empty();
                               for (var i = 0; i < parsed_data.all_ulb.length; i++)
                                      {
                    $("#ulb_id_"+divid).append("<option  value='" + parsed_data.all_ulb[i].id  + "'>" + parsed_data.all_ulb[i]. ulb_name + "</option>");
                      $val_selec ='';
                                      } 
                    }
                    else
                    {
                    $("#ulb_id_"+divid).append("<option  value=''>" +'All ulb' + "</option>");
                    
                      $val_selec =''; 
                    }
                              
                            
      }
    });
    }
}







  

</script>

