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
            <?php echo form_open_multipart('Project_dpr/project_dpr?project_id='.$project_id,array('name'=> 'project_dpr','id'=> 'project_dpr_form','class'=> 'container-fluid')); ?>
            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>" />
        <?php } ?>
        <div class="block-header">
            <h4>Project Planning</h4>
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

     <?php
    project_steps($project_id);
    ?>

    
    <?php
   
        project_info($project_id);
   

    ?>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Project Master Planning / DPR</h2>
                </div>

                <div class="body">

                    
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <p>
                                <b>Plan / DPR Prepared By <span class="col-pink">* </span></b> 
                            </p>   
                            
                            <?php $dpr_prepared_by_user_id_val = (!empty($_REQUEST['dpr_prepared_by_user_id'])) ? $_REQUEST['dpr_prepared_by_user_id'] : $result['dpr_prepared_by_user_id']; ?>

                              <input class="form-control" type="text" placeholder="Enter DPR Prepared by" name="dpr_prepared_by_user_id" value="<?php echo $dpr_prepared_by_user_id_val; ?>">
                             <span style='color:#ff0000'><?php echo form_error('dpr_prepared_by_user_id'); ?></span>
                        </div>
						<div class="col-md-4">
                            <p>
                                <b>Master Plan / DPR  Start Date <span class="col-pink">* </span></b>
                            </p>
                            <?php $val = (!empty($_REQUEST['dpr_start_date'])) ? $_REQUEST['dpr_start_date'] : $result['dpr_start_date']; ?>
                            <?php if ($val == '0000-00-00') {
                                $val = '';
                            } ?>
                            <input type="text" name="dpr_start_date"  value="<?php echo $val; ?>" id="approve" class="datepicker form-control" placeholder="Please Choose a Date...">
                            <span style='color:#ff0000'><?php echo form_error('dpr_start_date'); ?></span>
                        </div>
                        <div class="col-md-4">
                            <p>
                                <b>Master Plan / DPR  End Date <span class="col-pink">* </span></b>
                            </p>
                            <?php $val = (!empty($_REQUEST['dpr_end_date'])) ? $_REQUEST['dpr_end_date'] : $result['dpr_end_date']; ?>
                            <?php if ($val == '0000-00-00') {
                                $val = '';
                            } ?>
                            <input type="text" name="dpr_end_date"  value="<?php echo $val; ?>" id="approve" class="datepicker form-control" placeholder="Please Choose a Date...">
                            <span style='color:#ff0000'><?php echo form_error('dpr_end_date'); ?></span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        
                        
                        <div class="col-md-4">
                            <p>
                                <b>Master Plan / DPR  Submission Date <span class="col-pink">* </span></b>
                            </p>
                            <?php $val = (!empty($_REQUEST['dpr_submission_date'])) ? $_REQUEST['dpr_submission_date'] : $result['dpr_submission_date']; ?>
                            <?php if ($val == '0000-00-00') {
                                $val = '';
                            } ?>
                            <input type="text" name="dpr_submission_date"  value="<?php echo $val; ?>" id="approve" class="datepicker form-control" placeholder="Please Choose a Date...">
                            <span style='color:#ff0000'><?php echo form_error('dpr_submission_date'); ?></span>
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
                        <h2> Attachment - Project Master Planning / DPR</h2>
                    </div>

                    <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                            <div class="col-md-4">
                                <p id="fname_1" class="fname">
                                    <b>File Name </b>
                                   
                                </p>
                                <input class="form-control" id="file_name" name="file_name" type="text"  placeholder="Enter File Name">
                                
                                <span id="file_name_err_status" style='color:#ff0000'></span>
                            </div>
                            <div class="col-md-4">
                                <p id="title_1" class="fname">
                                    <b>Upload File  (Size Limit Maximum 50 MB Each)</b>
                                   
                                    (Extension Allowed pdf, docx, xls, xlsx, jpg, jpeg, png)
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
                        
                        <?php
                        if($result['draft_mode']  == 'Y' || empty($dpr_status)){
                        ?>
                        <button class="btn btn-success waves-effect" type="submit" name="draft_btn" id="draft_btn" value="Draft">SAVE DRAFT</button>
                    <?php }else{ ?>
                         <a href="<?php echo base_url().'project_list/pip_dpr' ?>" class="btn btn-warning waves-effect">CANCEL</a>
                    <?php } ?>

                    <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" value="Submit" ><?php if($result['draft_mode']  == 'Y' || empty($dpr_status)){ echo 'SUBMIT'; }else{ echo 'UPDATE'; } ?></button>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div> 

        
</form>
        
        
    
 

</div>
</section>

<!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>




<script type="text/javascript">
    function _(el) {
  return document.getElementById(el);
}

function submitFile() {
   // alert('gdgfhd');
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
  
  $("#project_dpr_form").submit();
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
  
  $("#project_dpr_form").submit();
   }else{
  return false;
 }
 });
});


</script>