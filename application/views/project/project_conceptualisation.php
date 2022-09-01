<?php $CI =& get_instance();?>
<!-- icheck -->
<link href="<?php echo base_url();?>assets/css/icheck/flat/green.css" rel="stylesheet">


<link href="<?php echo base_url();?>/assets/css/themes/theme-pmms.css" rel="stylesheet" />

<!-- Steps Css -->
<link href="<?php echo base_url();?>/assets/css/mstepper.min.css" rel="stylesheet">

<!-- Sweetalert Css -->
    <link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<section class="content">
<!--<form class="container-fluid">-->
    <?php if(!empty($project_id)) {
        if($entry_type == 'new'){
        ?>

        <?php echo form_open_multipart('Project/project_conceptualisation?project_id='.base64_encode($project_id).'&type=new',array('name'=> 'project_conceptualisation','id'=> 'project_conceptualisation_form','class'=> 'container-fluid')); ?>
    <?php }else{ ?>
        <?php echo form_open_multipart('Project/project_conceptualisation?project_id='.base64_encode($project_id),array('name'=> 'project_conceptualisation','id'=> 'project_conceptualisation_form','class'=> 'container-fluid')); ?>

    <?php } ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
    <?php }else{
        echo form_open_multipart('Project/project_conceptualisation', array('name' => 'project_conceptualisation','id' => 'project_conceptualisation_form', 'class'=> 'container-fluid'));
    } ?>
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
   

    <?php
    project_steps($project_id);
    ?>
    <?php 
    if($entry_type == 'new'){
    
    ?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Project Creation Details</h2>
                </div>

                <div class="body">
        <div class="table-responsive m-b-30">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
                    <tbody>
                    <tr>
                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project Name </td>
                        <td colspan="3"><?php echo $result['project_name']; ?></td>
                    </tr>
                    <tr>
                        <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Project Category</td>
                        <td><?php echo $result['project_type_name']; ?></td>
                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Project Scheme</td>
                        <td><?php echo $result['scheme_name']; ?></td>
                    </tr>
                    <tr>
                        <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project Location  </td>
                        <td><?php echo $result['area_name']; ?></td>
                        <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> Project circle </td>
                        <td><?php echo $result['wing_name']; ?></td>
                        
                    </tr>
                    <tr>
                        
                        <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> Project division </td>
                        <td><?php echo $result['division_name']; ?></td>
                        <td> <i class="material-icons" style="position: relative;top: 8px;">flag</i> Indicative Cost (₹)  </td>

                       <td><?php echo number_format($result['estimate_total_cost'],2); ?></td>
                        

                    </tr>

                   
                   </tbody>
                </table>


    </div>
</div>
</div>
</div>
</div>
<?php } 
?>
    
    <?php
    if($entry_type != 'new'){
        project_info($project_id);
    }

    ?>


    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 camelcase">
            <div class="card">
                <div class="header">
                    <h2>Project Information</h2>
                </div>

                <div class="body">

                    <div class="row clearfix">
                        <div class="col-md-12">
                            <p>
                                <b>Concept Name <span class="col-pink">* </span></b>   <!-- <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Project’s name should be max 255 characters </span>
                                        </span> -->

                            </p>
                            <?php $val = (!empty($_REQUEST['project_name'])) ? $_REQUEST['project_name'] : $result['project_name']; ?>
                            <input type="text"  value="<?php echo $val; ?>" name="project_name" class="form-control" placeholder="Enter project name" />
                            <span style='color:#ff0000'><?php echo form_error('project_name'); ?></span>
                        </div>

                    </div>
                    <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Scheme  <span class="col-pink">* </span></b>
                                        
                                    </p>
                                    <select name="project_group" class="form-control show-tick">
                                        <option value="">Select project scheme</option>
                                        <?php foreach ($groups as $group) { ?>
                                            <option value="<?php echo $group['id'] ?>"
                                                <?php
                                                if ((!empty($result['project_group']) && $result['project_group'] == $group['id']) || $_REQUEST['project_group'] == $group['id']) {
                                                    echo "selected";
                                                } ?> ><?php
                                                echo $group['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span style='color:#ff0000'><?php echo form_error('project_group'); ?></span>
                                </div>



                                <div class="col-md-4">
                                    <p>
                                        <b>Location </b><!-- <span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">Location</span>
                                        </span> -->
                                    </p>
                                    <select class="form-control show-tick" name="location_id">
                                        <option value="">Project Location</option>
                                        <?php foreach ($project_location as $lct) { ?>
                                    <option value="<?php echo $lct['id'] ?>"
                                        <?php
                                        if ((!empty($result['location_id']) && $result['location_id'] == $lct['id']) || $_REQUEST['location_id'] == $lct['id']) {
                                            echo "selected";
                                        } ?> ><?php
                                        echo $lct['name'] ?></option>
                                <?php } ?>
                                    </select>
                                    <span style='color:#ff0000'><?php echo form_error('location_id'); ?></span>
                                </div>




                                <div class="col-md-4">
                                    <p>
                                        <b>Submission Date  <span class="col-pink">* </span></b>
                                    </p>
                                    <?php $submission_date_val = (!empty($_REQUEST['submission_date'])) ? $_REQUEST['submission_date'] : $result['submission_date']; ?>
                                    
                                              <input type="text" id="approve" class="datepicker form-control" name="submission_date" value="<?php echo $submission_date_val; ?>" placeholder="Please choose a date...">

                                              <span style='color:#ff0000'><?php echo form_error('submission_date'); ?></span>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Concept Prepared By <span class="col-pink">* </span></b><!-- <span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">text Information</span>
                                        </span> -->
                                    </p>
                                    <?php $concept_prepared_by_val = (!empty($_REQUEST['concept_prepared_by'])) ? $_REQUEST['concept_prepared_by'] : $result['concept_prepared_by']; ?>
                                    
                                              <input type="text" id="concept_prepared_by" class="form-control" name="concept_prepared_by" value="<?php echo $concept_prepared_by_val; ?>" placeholder="Concept prepared by">

                                              <span style='color:#ff0000'><?php echo form_error('concept_prepared_by'); ?></span>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Concept Submitted For Approval <span class="col-pink">* </span></b>
                                    </p>
                                    <?php $concpt_submited_status_val = (!empty($_REQUEST['concpt_submited_status'])) ? $_REQUEST['concpt_submited_status'] : $result['concpt_submited_status']; ?>

                                    <select class="form-control show-tick" name="concpt_submited_status">
                                        <option value="Y" <?php if($concpt_submited_status_val == 'Y'){echo "selected"; } ?>>Yes</option>
                                        <option value="N" <?php if($concpt_submited_status_val == 'N'){echo "selected"; } ?>>No</option>
                                    </select>

                                    <span style='color:#ff0000'><?php echo form_error('concpt_submited_status'); ?></span>
                                </div>


                                <div class="col-md-4">
                                     <p>
                                        <b>Expected Date For Approval  <span class="col-pink">* </span></b>
                                    </p>

                                    <?php $expected_approval_date_val = (!empty($_REQUEST['expected_approval_date'])) ? $_REQUEST['expected_approval_date'] : $result['expected_approval_date']; ?>
                                    
                                              <input type="text" id="approve" class="datepicker form-control" name="expected_approval_date" placeholder="Please choose a date..." value="<?php echo $expected_approval_date_val; ?>">
                             <span style='color:#ff0000'><?php echo form_error('expected_approval_date'); ?></span>

                                </div>
                                
                                
                            </div>
                            <div class="row clearfix">
                                
                                
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Approving Authority  <span class="col-pink">* </span></b>
                                    </p>
                                    <?php $approving_authority_val = (!empty($_REQUEST['approving_authority'])) ? $_REQUEST['approving_authority'] : $result['approving_authority']; ?>
                                    
                                              <input type="text" id="approve" class="form-control" name="approving_authority" placeholder="Approving Authority" value="<?php echo $approving_authority_val; ?>">
                                <span style='color:#ff0000'><?php echo form_error('approving_authority'); ?></span>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <b>Indicative Project Cost (₹) <span class="col-pink">* </span></b>
                                    </p>
                                    <input class="form-control" type="text" placeholder="Enter project cost" name="estimate_total_cost" value="<?php
                                    if (!empty($result['estimate_total_cost'])){
                                         echo number_format($result['estimate_total_cost'],2);
                                         }
                                        else{
                                           echo $_REQUEST['estimate_total_cost']; 
                                        }  

                                     ?>"  onkeypress="allowNumbersOnly(event)">
                                   <span style='color:#ff0000'><?php echo form_error('estimate_total_cost'); ?></span>

                                </div>


                                <div class="col-md-4">
                                    <p>
                                        <b>Project Category</b>
                                        
                                    </p>
                                    <select name="project_category" class="form-control show-tick">
                                        <option value="">Select project Category</option>

                                       <?php foreach ($categorys as $category) { ?>
                                            <option value="<?php echo $category['id'] ?>"
                                                <?php
                                                if ((!empty($result['project_type']) && $result['project_type'] == $category['id']) || $_REQUEST['project_type'] == $category['id']) {
                                                    echo "selected";
                                                } ?> ><?php
                                                echo $category['project_type'] ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                    <span style='color:#ff0000'><?php echo form_error('project_category'); ?></span>
                                </div>
                            </div>
                    
                    
                    
                    <div class="row clearfix">
                         
                         <div class="col-md-4">
                                    <p>
                                        <b>Project Circle</b>
                                        
                                    </p>
                                    <select name="project_circle" class="form-control show-tick" id="circle_id"  onchange="divisionfunc(1)">
                                        <option value="0">Select project Circle</option>
                                        <?php foreach ($circles as $circle) { ?>
                                            <option value="<?php echo $circle['id'] ?>"
                                                <?php
                                                if ((!empty($result['wing_id']) && $result['wing_id'] == $circle['id']) || $_REQUEST['wing_id'] == $circle['id']) {
                                                    echo "selected";
                                                } ?> ><?php
                                                echo $circle['wing_name'] ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                    <span style='color:#ff0000'><?php echo form_error('project_circle'); ?></span>
                         </div>

                        <div class="col-md-4">
                                <p>
                                    <b>Project Division</b>
                                    
                                </p>
                                <select name="project_division" id="division_id" class="form-control show-tick">
                                    <option value="0">Select project Division</option>

                                   <?php
                                          echo $CI->getdivision_data($result['wing_id'],$result['division_id']);
                                           ?>
                                    
                                </select>
                                <span style='color:#ff0000'><?php echo form_error('project_division'); ?></span>
                         </div>


                         
                        
                        

                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">



                        </div>
                        <div class="col-md-4">



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
                    <h2>Attachment - Project Conceptualisation</h2>
                </div>

                <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                            <div class="col-md-4">
                                <p id="fname_1" class="fname">
                                    <b>File Name</b>
                                   
                                </p>
                                <input class="form-control" id="file_name" name="file_name" type="text"  placeholder="Enter file name">
                                
                                <span id="file_name_err_status" style='color:#ff0000'></span>
                            </div>
                            <div class="col-md-4">
                                <p id="title_1" class="fname">
                                    <b>Upload File (size limit maximum 50 MB each)</b>
                                   
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
                        <table id="docTable" class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
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
                        if($result['draft_mode']  == 'Y' || ($entry_type == 'new')){
                        ?>
                        <button class="btn btn-success waves-effect" type="submit" name="draft_btn" id="draft_btn" value="Draft">SAVE DRAFT</button>
                    <?php }else{ ?>
                        <a href="<?php echo base_url().'project_list/pip_conceptualisation' ?>" class="btn btn-warning waves-effect">CANCEL</a>
                    <?php } ?>


                        <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" id="submit_btn" value="Submit" ><?php if($result['draft_mode']  == 'Y' || ($entry_type == 'new')){ echo 'SUBMIT'; }else{ echo 'UPDATE'; } ?></button>
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
<script>
    
</script>



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
  //   swal({
  //   title: "Are you sure you want to save this record?",
  //   type: "warning",
  //   showCancelButton: true,
  //   confirmButtonColor: "#32CD32",
  //   confirmButtonText: "Yes!",
  //   cancelButtonText: "Cancel",
  //   closeOnConfirm: true
  // }, function(isConfirm) {
  //   if (isConfirm) {
  
  $("#project_conceptualisation_form").submit();
 //   }else{
 //  return false;
 // }
 // });
});

    $('#draft_btn').click(function(e){
    e.preventDefault();
    $("#draft_mode").val('D');

  //   swal({
  //   title: "Are you sure you want to save this record?",
  //   type: "warning",
  //   showCancelButton: true,
  //   confirmButtonColor: "#32CD32",
  //   confirmButtonText: "Yes!",
  //   cancelButtonText: "Cancel",
  //   closeOnConfirm: true
  // }, function(isConfirm) {
  //   if (isConfirm) {
  
  $("#project_conceptualisation_form").submit();
 //   }else{
 //  return false;
 // }
 // });
});


</script>


<script type="text/javascript">
   
    function divisionfunc() {
        var value = $('#circle_id').val();
        
         if (value != 0)
            {
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Project/getdivision_list",
            datatype : 'json',
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","circleId": value },
            
                success: function(data){
                     
                var parsed_data = JSON.parse(data);
                $("#division_id").empty();
                
                  $val_selec ='';
                  var listItems= "";

                      if(parsed_data.all_divisions.length > 0){
                        $("#division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                       for (var i = 0; i < parsed_data.all_divisions.length; i++)
                           {
                                $("#division_id").append(
                                    "<option  value='" + parsed_data.all_divisions[i].id  + "'>" + parsed_data.all_divisions[i]. division_name + "</option>");

                                  $val_selec ='';
                            } 
                        }

                        else
                        {
                        $("#division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                        
                          $val_selec =''; 
                        }

                    }
            });
            }
     }
</script>