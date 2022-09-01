<?php $CI =& get_instance();?>
<!-- icheck -->
<link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">


<link href="<?php echo base_url();?>/assets/css/themes/theme-pmms.css" rel="stylesheet" />
<!-- Wait Me Css -->
<link href="<?php echo base_url();?>/assets/plugins/waitme/waitMe.css" rel="stylesheet" />

<!-- Steps Css -->
<link href="<?php echo base_url();?>/assets/css/mstepper.min.css" rel="stylesheet">

<!-- Sweetalert Css -->
<link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <?php if(!empty($project_id)) {?>
            <?php echo form_open_multipart('Project/project_preparation?project_id='.$project_id,array('name'=> 'project_preparation','id'=> 'project_preparation_form','class'=> 'container-fluid')); ?>
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
        <?php } ?>
        <div class="block-header">
            <h4>Project Planning </h4>
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
                          <span class="label"> Concept Creation</span>
                    </li>
                    
                    
                    <li class="<?php if(is_numeric($project_id) && $preparation_status == true){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>
                    <li class="<?php if(is_numeric($project_id) && $preparation_status == true){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>
                    <li class="<?php if(is_numeric($project_id) && $preparation_status == true){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li>
                    
                    
                    
                    
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end --> 

    
    <?php
        project_info($project_id);
  

    ?>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project Identified Stackholders</h2>
                    </div>

                    <div class="body">
                        <div class="cloneBox1 p-b-10">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Consultant appointed  <span class="col-pink">* </span></b><span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">Consultant appointed for this project</span>
                                        </span>
                                    </p>
                                    <select name="consult_appointed" class="form-control show-tick"  id="project_consult" onchange="showDiv(this)">
                                        <option <?php echo ($_REQUEST['consult_appointed'] == 'N' || $result['consultant_appointed'] == 'N' ) ? "selected" :''; ?> value="N">No</option>
                                        <option <?php echo ($_REQUEST['consult_appointed'] == 'Y' || $result['consultant_appointed'] == 'Y') ? "selected" :''; ?> value="Y">Yes</option>
                                    </select>

                                </div>
                                <div class="col-md-4">



                                </div>
                                <div class="col-md-4">



                                </div>

                            </div>

                            <div id="dropped" class="row clearfix"  style="display: none;">
                                <div class="col-md-3">
                                    <p>
                                        <b>Consultant id  <span class="col-pink">* </span></b><span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">It is the unique number to identify the appointed consultant</span>
                                        </span>
                                    </p>
                                    <input type="text" value="<?php echo (!empty($result['consultant_id']) ? $result['consultant_id'] : $_REQUEST['consultant_id'])?>" name="consultant_id" class="form-control" >
                                    <span id="err_span" style='color:#ff0000'><?php echo form_error('consultant_id'); ?></span>

                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Consultant name  <span class="col-pink">* </span></b>
                                      
                                    </p>
                                    <input type="text" name="consultant_name" value="<?php echo (!empty($result['consultant_name']) ? $result['consultant_name'] : $_REQUEST['consultant_name'])?>" class="form-control" placeholder="Enter  Consultant name">
                                    <span id="err_span" style='color:#ff0000'><?php echo form_error('consultant_name'); ?></span>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Designation  <span class="col-pink">* </span></b>
                                       
                                    </p>
                                    <input type="text" value="<?php echo (!empty($result['designation']) ? $result['designation'] : $_REQUEST['designation'])?>" name="designation" class="form-control" placeholder="Enter consultant's designation">
                                    <span id="err_span" style='color:#ff0000'><?php echo form_error('designation'); ?></span>

                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Consultant project number   <span class="col-pink">* </span></b>
                                    </p>
                                    <input type="text" name="consultant_project" class="form-control"  value="<?php echo (!empty($result['consulant_project_no']) ? $result['consulant_project_no'] : $_REQUEST['consultant_project'])?>"  >
                                    <span id="err_span" style='color:#ff0000'><?php echo form_error('consultant_project'); ?></span>


                                </div>


                            </div>
                        </div>

                        <div class="cloneBox1 p-b-10">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>DPR submitted   <span class="col-pink">* </span></b>
                                    </p>
                                    <select  name="dpr_submit"  id="project_dpr_submit" class="form-control show-tick"  onchange="showDivdpr(this)">
                                        <option <?php echo ($_REQUEST['dpr_submit'] == 'N' || $result['DPR_submitted'] == 'N') ? "selected" :''; ?> value="N">No</option>
                                        <option <?php echo ($_REQUEST['dpr_submit'] == 'Y' || $result['DPR_submitted'] == 'Y') ? "selected" :''; ?> value="Y">Yes</option>
                                    </select>

                                </div>
                                <div id="dprform"  style="display: none;">
                                    <div class="col-md-3">
                                        <p>
                                            <b>DPR approved  <span class="col-pink">* </span></b>
                                           
                                        </p>
                                        <select name="dpr_approved" class="form-control show-tick" >
                                            <option <?php echo ($_REQUEST['dpr_approved'] == 'N' || $result['DPR_approved'] == 'N') ? "selected" :''; ?> value="N">No</option>
                                            <option <?php echo ($_REQUEST['dpr_approved'] == 'Y' || $result['DPR_approved'] == 'Y') ? "selected" :''; ?> value="Y">Yes</option>
                                        </select>
                                        <span id="err_span" style='color:#ff0000'><?php echo form_error('dpr_approved'); ?></span>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>DPR cost (₹)<span class="col-pink">* </span></b>
                                           
                                        </p>
                                        <input type="text" name="dpr_cost"  value="<?php echo (!empty($result['DPR_cost']) ? $result['DPR_cost'] : $_REQUEST['dpr_cost'])?>" class="form-control" placeholder="Enter DPR cost" onkeypress="allowNumbersOnly(event)">
                                        <span id="err_span" style='color:#ff0000'><?php echo form_error('dpr_cost'); ?></span>

                                    </div>



                                </div>

                            </div>

                        </div>
                        <div class="cloneBox1 p-b-10">

                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p>
                                        <b>Administrative approval received   <span class="col-pink">* </span></b>
                                    </p>
                                    <select id="approval_received" name="approval_received" class="form-control show-tick"  onchange="showDivadmin(this)">
                                        <option <?php echo ($_REQUEST['approval_received'] == 'N' || $result['approval_received'] = 'N') ? "selected" :''; ?> value="N">No</option>
                                        <option <?php echo ($_REQUEST['approval_received'] == 'Y' || $result['approval_received'] = 'Y') ? "selected" :''; ?> value="Y">Yes</option>
                                    </select>

                                </div>
                                <div class="col-md-4">



                                </div>
                                <div class="col-md-4">



                                </div>

                            </div>

                            <div id="adminform" class="row clearfix"  style="display: none;">
                                <div>
                                    <div class="col-md-4">
                                        <p>
                                            <b>Administrative approval cost (₹)  <span class="col-pink">* </span></b>
                                            
                                        </p>

                                        <input type="text" value="<?php echo !empty($result['approval_cost']) ? $result['approval_cost'] : $_REQUEST['approval_cost']; ?>" name="approval_cost" id="estimate_total_cost" class="form-control" placeholder="Enter administrative approval cost" onkeypress="allowNumbersOnly(event)">
                                        <span id="err_span" style='color:#ff0000'><?php echo form_error('approval_cost'); ?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <p> 
                                            <b>Administrative approval date  (dd/mm/yyyy) <span class="col-pink">* </span></b>
                                           
                                        </p>
                                        <input type="text"  value="<?php echo !empty($result['approval_date']) ? $result['approval_date'] : $_REQUEST['approval_date']; ?>" name="approval_date" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                        <span id="err_span" style='color:#ff0000'><?php echo form_error('approval_date'); ?></span>

                                    </div>
                                    <div class="col-md-4">

                                        <p>
                                            <b>File number  <span class="col-pink">* </span></b>
                                           
                                        </p>

                                        <input type="text" value="<?php echo !empty($result['file_number']) ? $result['file_number'] : $_REQUEST['file_no'];?>" name="file_no" class="form-control" placeholder="Enter file number">
                                        <span id="err_span" style='color:#ff0000'><?php echo form_error('file_no'); ?></span>
                                    </div>


                                </div>
                                <!--<div id="total_container">
                                    <span id="err_span_cost" style='color:#ff0000'></span>
                                    <?php if(!empty($brakup_details)){ ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($brakup_details as $fund_dtl){?>
                                            <?php if( $i > 1 ){  $style = 'style="display: none;"'; }else{$style = '';}?>
                                            <div id="fund_<?php echo $i; ?>" class="col-md-12 p-0">
                                                <div class="col-md-4">
                                                    <p id="fnamefund_<?php echo $i; ?>" class="fname" <?php echo $style; ?> >
                                                        <b>Source of fund</b>
                                                       
                                                    </p>
                                                    <select id="source_of_fund_<?php echo $i; ?>" name="source_of_fund[]"
                                                            class="form-control show-tick">
                                                        <option>Select Source of Fund</option>
                                                        <?php foreach ($source_of_fund as $fund) { ?>
                                                            <?php $sta = ($fund_dtl['source_of_fund_id'] == $fund['id']) ? "selected" : '' ?>
                                                            <option value="<?php echo $fund['id']; ?>" <?php echo $sta; ?> > <?php echo $fund['name']; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <p id="titlefund_<?php echo $i; ?>" class="fname" <?php echo $style; ?> >
                                                        <b>Amount (₹) </b>
                                                    </p>
                                                    <input name="fund_amount[]" value="<?php echo $fund_dtl['amount']; ?>" class="form-control" type="text" placeholder="Enter Amount" onkeypress="allowNumbersOnly(event)">

                                                </div>
                                                 <?php if( $i == 1) { ?>
                                                <div class="col-md-2  p-t-25">
                                                    <?php } else{ ?>
                                                    <div class="col-md-2">
                                                    <?php } ?>
                                                    
                                                    <button id="delfund_<?php echo $i; ?>" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                        <i class="material-icons col-pink">delete</i>
                                        </button>


                                                </div>
                                            </div>
                                        <?php  $i++; } ?>
                                    <?php } else { ?>
                                    <div id="fund_1" class="col-md-12 p-0">
                                        <div class="col-md-4">
                                            <p id="fnamefund_1">
                                                <b>Source of fund</b>
                                            </p>
                                            <select id="source_of_fund_1" name="source_of_fund[]"
                                                    class="form-control show-tick">
                                                <option>Select Source of Fund</option>
                                                <?php foreach ($source_of_fund as $fund) { ?>
                                                    <?php $sta = ($val['source_of_fund_id'] == $fund['id']) ? "selected" : '' ?>
                                                    <option value="<?php echo $fund['id']; ?>" <?php echo $sta; ?> > <?php echo $fund['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-4">
                                            <p id="titlefund_1" >
                                                <b>Amount (₹) </b>
                                            </p>
                                            <input name="fund_amount[]" class="form-control" type="text" placeholder="Enter Amount" onkeypress="allowNumbersOnly(event)">

                                        </div>
                                        <div class="col-md-2  p-t-25">

                                            
                                            <button id="delfund_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                        <i class="material-icons col-pink">delete</i>
                                        </button>


                                        </div>
                                    </div>

                                    <?php } ?>
                                    <div id="0000fund" class="col-md-12 p-0">
                                        <div class="col-md-4">

                                            <select id="source_of_fund" name="source_of_fund[]"
                                                    class="form-control show-tick">
                                                <option>Select Source of Fund</option>
                                                <?php foreach ($source_of_fund as $fund) { ?>
                                                    <?php $sta = ($val['source_of_fund_id'] == $fund['id']) ? "selected" : '' ?>
                                                    <option value="<?php echo $fund['id']; ?>" <?php echo $sta; ?> > <?php echo $fund['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-4">

                                            <input name="fund_amount[]" class="form-control" type="text" placeholder="Enter amount" onkeypress="allowNumbersOnly(event)">


                                        </div>
                                        <div class="col-md-2">

                                            
                                            </button>
                                            <button id="addfund_0" href="javascript:void(0);" onclick="addFundRow();" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                         <i class="material-icons col-green">add</i>
                                     </button>



                                        </div>
                                    </div>
                                </div>

                            </div>-->
                        </div>

                       <!-- <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Project approvers <span class="col-pink">* </span></b>
                                  
                                </p>
                                <select name="project_approver" id="project_approver" class="form-control show-tick">
                                    <option value="">Please Select</option>
                                    <?php foreach ($project_approvers as $approver ){ ?>
                                        <?php $name = $approver['firstname']. " " .$approver['lastname']. " - ".$approver['designation']; ?>

                                        <option value="<?php  echo $approver['user_id'] ?>" <?php if ($approver['user_id'] == $result['project_approver_id'] ) {
                                            echo "selected";
                                        } ?>> <?php echo $name; ?></option>
                                    <?php } ?>
                                </select>
                                <span style='color:#ff0000'><?php echo form_error('project_approver'); ?></span>

                            </div>
                            <div class="col-md-8">
                                <p>
                                    <b>Remarks </b>
                                   
                                </p>
                                <?php $val = (!empty($result['remarks']) ? $result['remarks'] : $_REQUEST['remarks'] ) ?>
                                <input value ="<?php echo $val;?>" type="text" class="form-control" name="remarks" placeholder="Enter remarks">
                                <span style='color:#ff0000'><?php echo form_error('remarks'); ?></span>
                            </div>


                        </div>-->
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project User Information </h2>
                    </div>

                    <div class="body">
                        <div id="user_container" class=" m-b-15">
                            <?php if (!empty($super_visor_dtl)) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($super_visor_dtl as $super_visor){ ?>
                                    <?php if( $i > 1 ){  $style = 'style="display: none;"'; }else{$style = '';}?>
                                    <div id="container_<?php echo $i; ?>" class="row clearfix">
                                        <div class="col-md-5">
                                            <p id="titleusr_<?php echo $i; ?>" <?php echo $style; ?> >
                                                <b>User type</b>
                                            </p>
                                            <select id="user_type_<?php echo $i; ?>" name="user_type[]" class="form-control show-tick">
                                                <option>Select User Type</option>
                                                <?php foreach ($user_type as $type) { ?>
                                                    <?php $sta = ($super_visor['designation_id'] == $type['id']) ? "selected" : '' ?>
                                                    <option value="<?php echo $type['id']; ?>" <?php echo $sta; ?>> <?php echo $type['designation']; ?></option>

                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-5">
                                            <p id="fnameusr_<?php echo $i; ?>" <?php echo $style; ?> >
                                                <b>User name</b>
                                            </p>

                                            <select id="user_name_<?php echo $i; ?>" name="user_name[]" class="form-control show-tick">
                                                <option>Select User Name</option>
                                                <?php foreach ($user_name as $user) { ?>
                                                    <?php $sta = ($super_visor['user_id'] == $user['id']) ? "selected" : '' ?>
                                                    <option value="<?php echo $user['id'] ?>" <?php echo $sta; ?> > <?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <?php if($i == 1) { ?>
                                            <div class="col-md-2 p-t-25">
                                                <?php }else{ ?>
                                            <div class="col-md-2">
                                                <?php } ?>

                                            
                                            <button id="delusr_<?php echo $i; ?>" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                        <i class="material-icons col-pink">delete</i>
                                        </button> 


                                        </div>


                                    </div>
                                <?php $i++; } ?>

                            <?php } else { ?>
                                <div id="container_1" class="row clearfix">
                                    <div class="col-md-5">
                                        <p id="titleusr_1">
                                            <b>User type</b>
                                        </p>
                                        <select id="user_type_1" name="user_type[]" class="form-control show-tick">
                                            <option>Select User Type</option>
                                            <?php foreach ($user_type as $type) { ?>
                                                <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                                            <?php } ?>
                                        </select>

                                    </div>
                                    <div class="col-md-5">
                                        <p id="fnameusr_1">
                                            <b>User name</b>
                                        </p>

                                        <select id="user_name_1" name="user_name[]" class="form-control show-tick">
                                            <option>Select User Name</option>
                                            <?php foreach ($user_name as $user) { ?>
                                                <option value="<?php echo $user['id'] ?>"><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    <div class="col-md-2  p-t-25">

                                        <button id="delusr_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                        <i class="material-icons col-pink">delete</i>
                                        </button> 


                                    </div>


                                </div>

                            <?php } ?>
                            <div id="0000usr" class="row clearfix">
                                <div class="col-md-5">
                                    <p id="titleusr_99">
                                        <b>User type</b>
                                    </p>
                                    <select name="user_type[]" class="form-control show-tick">
                                        <option>Select User Type</option>
                                        <?php foreach ($user_type as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="col-md-5">
                                    <p id="fnameusr_99">
                                        <b>User name</b>
                                    </p>
                                    <select  name="user_name[]" class="form-control show-tick">
                                        <option>Select User Name</option>
                                        <?php foreach ($user_name as $user) { ?>
                                            <option value="<?php echo $user['id'] ?>"><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                                        <?php } ?>
                                    </select>


                                </div>
                                <div class="col-md-2">

                                    
                                    <button id="addusr_0" href="javascript:void(0);" onclick="addUserRow();" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                                         <i class="material-icons col-green">add</i>
                                     </button>


                                </div>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> Attachment - Project Identified Stackholders</h2>
                    </div>

                    <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                            <div class="col-md-4">
                                <p id="fname_1" class="fname">
                                    <b>File name <span class="col-pink">* </span></b>
                                   
                                </p>
                                <input class="form-control" id="file_name" name="file_name" type="text"  placeholder="Enter file name">
                                
                                <span id="file_name_err_status" style='color:#ff0000'></span>
                            </div>
                            <div class="col-md-4">
                                <p id="title_1" class="fname">
                                    <b>Upload file <span class="col-pink">* </span> (size limit maximum 50 MB each)</b>
                                   
                                    (Extension allowed pdf, docx, xls, xlsx, jpg, jpeg, png)
                                </p>

                                <input  type="file" id="fileupload" name="fileupload">
                                <span id="upload_err_status" style='color:#ff0000'></span>
                            </div>
                            
                            <div class="col-md-1  p-t-25">

                                

                                
                                
                                <button class="btn bg-blue waves-effect" type="button" onclick="submitFile();"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>


                            </div>
                            
                            <h3 id="status"></h3>
                            <p id="loaded_n_total"></p>
                        </div>
                        <div class="col-md-6 col-md-offset-3"  id="progressBar_new" style="display: none;">
                           
                                <div class="progress">
                                <div id="progressbar_new_value" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    0%
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <?php
                   //print_r($steps_files);

                    ?>
                    <div class="row clearfix">
                    <div class="col-md-6 table-responsive" <?php if(empty($steps_files) && empty($post_steps_files['file_name'])){ ?>style="display: none;" <?php } ?> id="documentsData">
                        <table id="docTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <tr>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th></th>
                              </tr>
                              <?php
                              if(!empty($post_steps_files['file_name'])){
                                foreach ($post_steps_files['file_name'] as $key => $file_name_val) {
                                 $file_link = base_url().'uploads/temp/'.($post_steps_files['file_url'][$key]);
                                 $path = 'uploads/temp/'.($post_steps_files['file_url'][$key]);
                                 $file_size = filesize($path);
                                $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float p-r-10" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                                
                                $input_data = '<input type="hidden" name="hidden_file_name[]" value="'.$file_name_val.'"><input type="hidden" name="hidden_file_url[]" value="'.$post_steps_files['file_url'][$key].'">';
                                ?>
                                <tr>
                                    <?php echo $input_data; ?>
                                    <td><?php echo $file_name_val; ?></td>
                                    <td><?php echo formatSizeUnits($file_size); ?></td>
                                    <td><?php echo $file_d_link; ?></td>
                                </tr>


                             <?php } }
                               if(!empty($steps_files)){ 
                                foreach ($steps_files as $files) {
                                $file_name = $files['file_name'];
                                $file_path = $files['file_path'];
                                $file_id = $files['document_id'];
                                $file_link = base_url().'uploads/attachment/'.$file_path;

                                $path1 = 'uploads/attachment/'.$file_path;
                                 $file_size1 = filesize($path1);
                                
                                $file_d_link1 = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                                $input_data = '<input type="hidden" name="db_hidden_file_id[]" value="'.$file_id.'"><input type="hidden" name="db_hidden_file_name[]" value="'.$file_name.'"><input type="hidden" name="db_hidden_file_url[]" value="'.$file_path.'">';
                              ?>
                              <tr>
                                    <?php echo $input_data; ?>
                                    <td><?php echo $file_name; ?></td>
                                    <td><?php echo formatSizeUnits($file_size1); ?> </td>
                                    <td><?php echo $file_d_link1; ?></td>
                                </tr>

                              <?php } }  ?>
                            </table>
                    </div>
                    </div>
                    </div>
                    <input type="hidden" name="draft_mode" id="draft_mode" value="">
                    <div class="col-md-12 align-center">
                        <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" id="submit_btn" value="Submit" ><?php if($preparation_status){ echo 'SUBMIT'; }else{ echo 'SUBMIT'; } ?></button>
                        
                        <?php
                        if($result['draft_mode']  == 'Y' || empty($preparation_status)){
                        ?>
                        <button class="btn btn-success waves-effect" type="submit" name="draft_btn" id="draft_btn" value="Draft">SAVE DRAFT</button>
                    <?php } ?>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </form>

        
        <div id="container_9999" class="row clearfix">
            <div class="col-md-5">
                <p id="titleusr_1">
                    <b>User type</b>
                </p>
                <select id="user_type_1" name="user_type[]" class="form-control show-tick">
                    <option>Select User Type</option>
                    <?php foreach ($user_type as $type) { ?>
                        <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                    <?php } ?>
                </select>

            </div>
            <div class="col-md-5">
                <p id="fnameusr_1">
                    <b>User name</b>
                </p>

                <select id="user_name_1" name="user_name[]" class="form-control show-tick">
                    <option>Select User Name</option>
                    <?php foreach ($user_name as $user) { ?>
                        <option value="<?php echo $user['id'] ?>"><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="col-md-2  p-t-25">
                <button id="delusr_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float">
                <i class="material-icons col-pink">delete</i>
                </button> 


            </div>


        </div>
        
       <!--  Select -->

    </div>
</section>

<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<script>
    function showDiv(select){

        if(select.value=="Y"){
            document.getElementById('dropped').style.display = "block";
        } else{
            document.getElementById('dropped').style.display = "none";
        }
    }
    function showDivdpr(select){

        if(select.value=="Y"){
            document.getElementById('dprform').style.display = "block";
        } else{
            document.getElementById('dprform').style.display = "none";
        }
    }
    function showDivadmin(select){

        if(select.value=="Y"){
            document.getElementById('adminform').style.display = "block";
        } else{
            document.getElementById('adminform').style.display = "none";
        }
    }

    $(function () {

        if($("#project_consult").val() =="Y"){
            document.getElementById('dropped').style.display = "block";
        } else{
            document.getElementById('dropped').style.display = "none";
        }

        if($("#project_dpr_submit").val() == "Y") {
            document.getElementById('dprform').style.display = "block";
        } else{
            document.getElementById('dprform').style.display = "none";
        }

        if($("#approval_received").val() =="Y"){
            document.getElementById('adminform').style.display = "block";
        } else{
            document.getElementById('adminform').style.display = "none";
        }
        $("#fund_99999,#fnameusr_99,#titleusr_99,#fname_99,#title_99,#tr_9999999,#container_9999").hide();
        $(document.body).on('click', "[id^='del_']", function () {

            var elementId = $(this).attr('id');
            var id = elementId.split("_");
            var prev_id = $('#amount_brkup_tbl > #tr_'+id[1] ).prev().attr('id');
            var next_id = $('#amount_brkup_tbl > #tr_'+id[1] ).next().attr('id');
            var temp_id = '';
            if( prev_id && !next_id ){
                temp_id = prev_id.split("_");
            }else if( !prev_id && next_id ){
                temp_id = next_id.split("_");
            }
            if(temp_id == '0000'){
                $("#fname_99").show();
                $("#title_99").show();

            }else{
                if( temp_id != '' ){
                    $("#fname_"+temp_id[1]).show();
                    $("#title_"+temp_id[1]).show();
                    $("#fname_99,#title_99").hide();
                }

            }
            $("#tr_"+id[1]).remove();

        });
        $(document.body).on('click', "[id^='delusr_']", function () {
            //alert();
            var elementId = $(this).attr('id');
            var id = elementId.split("_");
            var prev_id = $('#user_container > #container_'+id[1] ).prev().attr('id');
            var next_id = $('#user_container > #container_'+id[1] ).next().attr('id');
            var temp_id = '';
            if( prev_id && !next_id ){
                temp_id = prev_id.split("_");
            }else if( !prev_id && next_id ){
                temp_id = next_id.split("_");
            }
            console.log(temp_id);
            if(temp_id == '0000usr'){
                $("#fnameusr_99").show();
                $("#titleusr_99").show();

            }else{
                if( temp_id != '' ){
                    $("#fnameusr_"+temp_id[1]).show();
                    $("#titleusr_"+temp_id[1]).show();
                    $("#fnameusr_99,#titleusr_99").hide();
                }

            }
            $("#container_"+id[1]).remove();

        });


        $(document.body).on('click', "[id^='delfund_']", function () {
            //alert();
            var elementId = $(this).attr('id');
            //alert(elementId);
            var id = elementId.split("_");
            var prev_id = $('#total_container > #container_'+id[1] ).prev().attr('id');
            var next_id = $('#total_container > #container_'+id[1] ).next().attr('id');
            // var temp_id = '';
            // if( prev_id && !next_id ){
            //     temp_id = prev_id.split("_");
            // }else if( !prev_id && next_id ){
            //     temp_id = next_id.split("_");
            // }
            // console.log(temp_id);
            // if(temp_id == '0000usr'){
            //     $("#fnameusr_99").show();
            //     $("#titleusr_99").show();

            // }else{
            //     if( temp_id != '' ){
            //         $("#fnameusr_"+temp_id[1]).show();
            //         $("#titleusr_"+temp_id[1]).show();
            //         $("#fnameusr_99,#titleusr_99").hide();
            //     }

            // }
            $("#fund_"+id[1]).remove();

        });

        $("#project_approver").on('change',  function () {

            var total_break_up = 0;
            var total_aa_amount = $("#estimate_total_cost").val();
            console.log(total_aa_amount);
            console.log($("#approval_received").val());
            if( total_aa_amount > 0  && $("#approval_received").val() =="Y" ){

                $('#total_container').find('input').each(function (i, input) {

                    var $input = $(input);
                    total_break_up = parseFloat(total_break_up) + parseFloat($(input).val());

                });

                console.log(total_break_up);
                if (total_break_up != total_aa_amount) {

                    $('#err_span_cost').show();
                    $('#err_span_cost').html("Approval cost is not matched with brakeup amount.");

                    return false;
                } else {
                    $('#err_span_cost').html('');

                }

                $('#total_container').find('select').each(function (i, input) {

                    var $input = $(input);

                    if ($(input).val() == 'Select Source of Fund') {
                        $(input).after("<span class='error' style='color:#ff0000'>Please Select source of fund.</span>");
                        event.preventDefault();
                    }
                });

            }
        });


    });


    
    function addUserRow(){

        var last_id =  $('#user_container > div:last').prev().attr('id');
        console.log(last_id);
        var next_id = 1;
        if( last_id ){
            var id = last_id.split("_");
            next_id =  parseInt(id[1]) + 1 ;
        }

        $("#container_9999").show();
        var html = $("#container_9999").clone().attr('id', 'container_'+next_id );
        $("#container_9999").hide();
        html.find("#delusr_1").attr('id','delusr_'+next_id);
        html.find("#addusr_1").attr('id','addusr_'+next_id);
        html.find("#fnameusr_1").attr('id','fnameusr_'+next_id);
        html.find("#titleusr_1").attr('id','titleusr_'+next_id);
        html.find(".fname").hide();
        html.find(".p-t-25").removeClass("p-t-25");
        if( last_id ) {
            $('#user_container > div:last').prev().after(html);
            $('#delusr_'+next_id).show();
            $('#addusr_'+next_id).hide();
            $("#fnameusr_"+next_id).hide();
            $("#titleusr_"+next_id).hide();
        }else{

            $('#0000usr').before(html);

            $('#delusr_'+next_id).show();
            $('#addusr_'+next_id).hide();

            $("#fnameusr_99,#titleusr_99").hide();
            $("#fnameusr_"+next_id).show();
            $("#titleusr_"+next_id).show();
        }

    }
    function addFundRow(){

        var last_id =  $('#total_container > div:last').prev().attr('id');
        console.log(last_id);
        var next_id = 1;
        if( last_id ){
            var id = last_id.split("_");
            next_id =  parseInt(id[1]) + 1 ;
        }

        $("#fund_99999").show();
        var html = $("#fund_99999").clone().attr('id', 'fund_'+next_id );
        $("#fund_99999").hide();
        html.find("#delfund_1").attr('id','delfund_'+next_id);
        html.find("#addfund_1").attr('id','addfund_'+next_id);
        html.find("#fnamefund_1").attr('id','fnamefund_'+next_id);
        html.find("#titlefund_1").attr('id','titlefund_'+next_id);
        html.find(".fname").hide();
        html.find(".p-t-25").removeClass("p-t-25");
        if( last_id ) {
            $('#total_container > div:last').prev().after(html);
            $('#delfund_'+next_id).show();
            $('#addfund_'+next_id).hide();
            $("#fnameusr_"+next_id).hide();
            $("#titleusr_"+next_id).hide();
        }else{

            $('#0000usr').before(html);

            $('#delusr_'+next_id).show();
            $('#addusr_'+next_id).hide();

            $("#fnameusr_99,#titleusr_99").hide();
            $("#fnameusr_"+next_id).show();
            $("#titleusr_"+next_id).show();
        }

    }

</script>



<script type="text/javascript">
    function _(el) {
  return document.getElementById(el);
}

function submitFile() {
  var file = _("fileupload").files[0];
  var file_name = _("file_name").value;
  if(file_name && file){
    if(file.size < 50000000){
     _("file_name_err_status").innerHTML = "";
     _("upload_err_status").innerHTML = "";   
   //alert(file.name+" | "+file.size+" | "+file.type);
   _("submit_btn").disabled = true;
  var formdata = new FormData();
  formdata.append("file1", file);
  formdata.append("file_name", file_name);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "<?php echo base_url('project/file_upload_data'); ?>"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
   _("file_name").value = "";
   _("fileupload").value = "";
  //document.getElementById("uploadCaptureInputFile").value = "";
    }else{
        _("file_name_err_status").innerHTML = "";
       _("upload_err_status").innerHTML = "Max File size allowed 50 MB."; 
    }
    }else if(file_name == ''){
       _("file_name_err_status").innerHTML = "The File name field is required."; 

    }else{
        _("file_name_err_status").innerHTML = "";
       _("upload_err_status").innerHTML = "The File is required.";   
    }
}

function progressHandler(event) {
  //_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
  _("file_upload_div").style.display = "none";
  _("progressBar_new").style.display = "block";
  var percent = (event.loaded / event.total) * 100;
  //_("progressBar").value = Math.round(percent);
  _("progressbar_new_value").style.width = Math.round(percent)+"%";
  _("progressbar_new_value").innerHTML = Math.round(percent) + "%";
}

const docTable = document.getElementById('docTable');

function completeHandler(event) {
    _("documentsData").style.display = "block";
    _("progressBar_new").style.display = "none";
    _("file_upload_div").style.display = "block";

    //alert(event.target.responseText);
     //_("upload_err_status").innerHTML = event.target.responseText; 

  //_("status").innerHTML = event.target.responseText;
  if(event.target.responseText != 'No') {
      let content = docTable.innerHTML;
      content += event.target.responseText;
      docTable.innerHTML = content;
    } else {
          _("upload_err_status").innerHTML = "Upload Failed!! Please Try again";  
    }
    _("submit_btn").disabled = false;
    setTimeout(function(){
     _("file_alert").style.display = "none";
    }, 3000);
  _("progressBar_new").value = 0; //wil clear progress bar after successful upload
}

function errorHandler(event) {
  _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
  _("status").innerHTML = "Upload Aborted";
}

function deleteRow(r) {

    swal({
    title: "Are you sure you want to delete this file?",
    text: "You can't undo this action",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    closeOnConfirm: true
  }, function(isConfirm) {
    if (isConfirm) {
      var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("docTable").deleteRow(i);
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
<!-- ENd Alert Page js for hide alert  -->

<script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
</script>

<script type="text/javascript">
    $('#submit_btn').click(function(e){
    e.preventDefault();
    $("#draft_mode").val('S');
    swal({
    title: "Are you sure you want to save this record?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#32CD32",
    confirmButtonText: "Yes!",
    cancelButtonText: "Cancel",
    closeOnConfirm: true
  }, function(isConfirm) {
    if (isConfirm) {
  
  $("#project_preparation_form").submit();
   }else{
  return false;
 }
 });
});

    $('#draft_btn').click(function(e){
    e.preventDefault();
    $("#draft_mode").val('D');

    swal({
    title: "Are you sure you want to save this record?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#32CD32",
    confirmButtonText: "Yes!",
    cancelButtonText: "Cancel",
    closeOnConfirm: true
  }, function(isConfirm) {
    if (isConfirm) {
  
  $("#project_preparation_form").submit();
   }else{
  return false;
 }
 });
});


</script>