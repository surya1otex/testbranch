<?php $CI =& get_instance();?>
<!-- icheck -->
<link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">


<link href="<?php echo base_url();?>/assets/css/themes/theme-pmms.css" rel="stylesheet" />

<!-- Steps Css -->
<link href="<?php echo base_url();?>/assets/css/mstepper.min.css" rel="stylesheet">

<!-- Sweetalert Css -->
<link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>Project Procurement Phase </h4>
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

                        <li class="<?php if($project_pre_tender_status){ echo 'completed'; }else{ echo 'completed'; } ?>">
                                <span class="circle"><i class="fas fa-cog"></i></span>
                                <span class="label">Project Pre-Tender</span>
                           
                        </li>

                        <li class="<?php if($project_tender_status){ echo 'completed'; }else{ echo 'completed'; } ?>">
                                <span class="circle"><i class="fas fa-file"></i></span>
                                <span class="label">Project Tender</span>
                            
                        </li>

                        <li class="<?php if($project_agreement_status){ echo 'completed'; }else{ echo 'active'; } ?>">
                                <span class="circle"><i class="fas fa-check-square"></i></span>
                                <span class="label">Project’s Agreement</span>
                           
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <!-- Steps end -->
        
            <?php
           
                project_info($project_id);
           

            ?>
        <?php echo form_open_multipart('Project/project_agreement?project_id='.base64_encode($project_id),array('name'=> 'project_agreement','id'=> 'project_agreement_form')); ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Project’s Agreement Stage</h2>
                    </div>

                    <div class="body">

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Draft Contract Preparation status <span class="col-pink">* </span></b>
                                    <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                    <span class="ntiptext">Draft Contract Preparation status</span>
                                        </span>
                                </p>
                                <select name="draft_contract_pre_status" class="form-control show-tick">
                                <option value="N" <?php if ('N' == $result['draft_contract_pre_status'] ) {
                                        echo "selected";
                                    } ?>>Not started</option>
                                    <option value="S" <?php if ('S' == $result['draft_contract_pre_status'] ) {
                                        echo "selected";
                                    } ?>>Started</option>
                                    <option value="C" <?php if ('C' == $result['draft_contract_pre_status'] ) {
                                        echo "selected";
                                    } ?>>Completed</option>
                                    <option value="U" <?php if ('U' == $result['draft_contract_pre_status'] ) {
                                        echo "selected";
                                    } ?>>Under Review</option>
                                    <option value="F" <?php if ('F' == $result['draft_contract_pre_status'] ) {
                                        echo "selected";
                                    } ?>>Finalized</option>
                               
                            </select>
                            <span><?php echo form_error('draft_contract_pre_status'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Final Draft Contract shared to Bidder <span class="col-pink">* </span></b>
                                    <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                    <span class="ntiptext">Final Draft Contract shared to Bidder</span>
                                        </span>
                                </p>
                                <select name="final_draft_contract_shared_bidder_status" class="form-control show-tick">
                                <option value="Y" <?php if ('Y' == $result['final_draft_contract_shared_bidder_status'] ) {
                                        echo "selected";
                                    } ?>>Yes</option>
                                    <option value="N" <?php if ('N' == $result['final_draft_contract_shared_bidder_status'] ) {
                                        echo "selected";
                                    } ?>>No</option>
                                    
                               
                            </select>
                            <span><?php echo form_error('draft_contract_pre_status'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Final Draft Contract sharing date <span class="col-pink">* </span></b>
                                    
                                </p>

                                <input type="text" value="<?php echo !empty($result['final_draft_contract_sharing_date']) ? $result['final_draft_contract_sharing_date'] : $_REQUEST['final_draft_contract_sharing_date'] ?>" name="final_draft_contract_sharing_date" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('final_draft_contract_sharing_date'); ?></span>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Contract signing date (dd/mm/yyyy) <span class="col-pink">* </span></b>
                                    <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                    <span class="ntiptext">Date of agreement with the vendor or organisation</span>
                                        </span>
                                </p>
                                <input name="agreement_date" value="<?php echo !empty($result['agreement_date']) ? $result['agreement_date'] : $_REQUEST['agreement_date'] ?>" type="text" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('agreement_date'); ?></span>
                            </div>
                            <div class="col-md-4"> <p>
                                    <b> Contract Effective date (dd/mm/yyyy) <span class="col-pink">* </span></b>
                                </p>

                                <input type="text" name="project_start" value="<?php echo !empty($result['project_start_date']) ? $result['project_start_date'] : $_REQUEST['project_start'] ?>" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('project_start'); ?></span>
                            </div>

                            <div class="col-md-4">
                                <p>
                                    <b>Project end date (dd/mm/yyyy) <span class="col-pink">* </span></b>
                                </p>

                                <input type="text" name="project_end_date" value="<?php echo !empty($result['project_end_date']) ? $result['project_end_date'] : $_REQUEST['project_end_date'] ?>" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('project_end_date'); ?></span>
                            </div>
                        </div>
                            <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Contract value  (₹)<span class="col-pink">* </span></b>
                                   
                                </p>

                                <input type="text" value="<?php echo !empty($result['agreement_cost']) ? $result['agreement_cost'] : $_REQUEST['agreement_cost'] ?>" name="agreement_cost" class="form-control" placeholder="Enter Agreement cost" onkeypress="allowNumbersOnly(event)">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('agreement_cost'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Agreement end date (dd/mm/yyyy) <span class="col-pink">* </span></b>
                                    
                                </p>

                                <input type="text" value="<?php echo !empty($result['agreement_end_date']) ? $result['agreement_end_date'] : $_REQUEST['agreement_end_date'] ?>" name="agreement_end_date" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('agreement_end_date'); ?></span>
                            </div>

                            <div class="col-md-4">
                                <p>
                                    <b>PBG verified <span class="col-pink">* </span></b>
                                    <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                    <span class="ntiptext">PBG verified</span>
                                        </span>
                                </p>
                                <select name="PBG_verified" class="form-control show-tick">
                                <option value="Y" <?php if ('Y' == $result['PBG_verified'] ) {
                                        echo "selected";
                                    } ?>>Yes</option>
                                    <option value="N" <?php if ('N' == $result['PBG_verified'] ) {
                                        echo "selected";
                                    } ?>>No</option>
                                    
                               
                            </select>
                            <span><?php echo form_error('PBG_verified'); ?></span>
                            </div>
                        
                            <div class="col-md-4">
                                <p>
                                    <b>PBG submitted by Bidder <span class="col-pink">* </span></b>
                                   
                                </p>

                                <input type="text" name="bidder_name" value="<?php echo !empty($result['bidder_details']) ? $result['bidder_details'] : $_REQUEST['bidder_name'] ?>" class="form-control" placeholder="Enter bidder's name">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('bidder_name'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Selected bidders representative name <span class="col-pink">* </span></b>
                                    
                                </p>

                                <input type="text" value="<?php echo !empty($result['representative_name']) ? $result['representative_name'] : $_REQUEST['representative_name'] ?>" name="representative_name" class="form-control" placeholder="Enter bidders representative name">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('representative_name'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>PBG amount  (₹)<span class="col-pink">* </span></b>
                                   
                                </p>

                                <input type="text" name="bg_amount" value="<?php echo !empty($result['bg_amount']) ? $result['bg_amount'] : $_REQUEST['bg_amount'] ?>" class="form-control" placeholder="Enter BG amount" onkeypress="allowNumbersOnly(event)">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('bg_amount'); ?></span>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>PBG submission date <span class="col-pink">* </span></b>
                                    
                                </p>
                                <input type="text" class="datepicker form-control" name="bg_validity" value="<?php echo !empty($result['bg_validity_date']) ? $result['bg_validity_date'] : $_REQUEST['bg_validity'] ?>"  placeholder="Enter BG validity">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('bg_validity'); ?></span>
                            </div>
                            <!-- <div class="col-md-4"> <p>
                                    <b>Other details of bidder <span class="col-pink">* </span></b>
                                  
                                </p>
                                <input type="text" name="bidder_other_details" value="<?php //echo !empty($result['other_bidder_details']) ? $result['other_bidder_details'] : $_REQUEST['bidder_other_details'] ?>"  class="form-control" placeholder="Enter reason for re-tendering">
                                <span id="err_span" style='color:#ff0000'><?php //echo form_error('bidder_other_details'); ?></span>
                            </div> -->
                            
                            

                        
                            
                            
                            <div class="col-md-4">
                                <p>
                                    <b>Planning in-charge  <span class="col-pink">* </span></b>
                                </p>

                            <select name="project_planning_approver" class="form-control show-tick">
                                <option value="">Please Select</option>
                                <?php foreach ($project_approvers as $approver ){ ?>
                                    <?php $name = $approver['firstname']. " " .$approver['lastname']. " - ".$approver['designation']; ?>

                                    <option value="<?php  echo $approver['user_id'] ?>" <?php if ($approver['user_id'] == $result['planning_incharge_user_id'] ) {
                                        echo "selected";
                                    } ?>> <?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                            <span style='color:#ff0000'><?php echo form_error('project_planning_approver'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <p>
                                    <b>Notice to proceed date <span class="col-pink">* </span></b>
                                    
                                </p>

                                <input type="text" value="<?php echo !empty($result['notice_to_proceed_date']) ? $result['notice_to_proceed_date'] : $_REQUEST['notice_to_proceed_date'] ?>" name="notice_to_proceed_date" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('notice_to_proceed_date'); ?></span>
                            </div>

                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p>
                                    <b>Payment Schedule <span class="col-pink">* </span></b>
                                    
                                </p>

                                <input type="text" value="<?php echo !empty($result['payment_schedule']) ? $result['payment_schedule'] : $_REQUEST['payment_schedule'] ?>" name="payment_schedule" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('payment_schedule'); ?></span>
                            </div>
                            <div class="col-md-4"> <p> <b>Remarks </b>
                                </p>


                                <textarea name="remarks" class="form-control no-resize" placeholder="Enter remarks" rows="4"><?php echo !empty($result['remarks']) ? $result['remarks'] : $_REQUEST['remarks'] ?></textarea>
                                <span id="err_span" style='color:#ff0000'><?php echo form_error('remarks'); ?></span>
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
                        <h2>Attachment - Project’s Agreement</h2>
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
                   // print_r($steps_files);

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
                        <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" id="submit_btn" value="Submit"><?php if($project_agreement_status){ echo 'SUBMIT'; }else{ echo 'SUBMIT'; } ?></button>
                        
                        <?php
                        if($result['draft_mode']  == 'Y' || empty($project_agreement_status)){
                        ?>
                        <button class="btn btn-success waves-effect" type="submit" name="draft_btn" id="draft_btn" value="Draft">SAVE DRAFT</button>
                    <?php } ?>

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </form>
       
    </div>
</section>

<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script>
    $("#fname_99,#title_99,#tr_9999999").hide();
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
  
  $("#project_agreement_form").submit();
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
  
  $("#project_agreement_form").submit();
   }else{
  return false;
 }
 });
});


</script>