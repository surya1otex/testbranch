<?php $CI =& get_instance();?>
<!-- Sweetalert Css -->
<link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>Project Creation</h4>
            </div>   

       
          <?php if(!empty($project_id)) {?>
        <?php echo form_open_multipart('Project_creation/manage?project_id='.base64_encode($project_id),array('name'=> 'Project_creation','id'=> 'Project_creation_form')); ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
    <?php }else{
        echo form_open_multipart('Project_creation/manage', array('name' => 'Project_creation','id' => 'Project_creation_form'));
    } ?>    
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add Project Information</h2>
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
                      
                        

                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p>
                                        <b>Project Name <span class="col-pink">* </span></b>
                                        </span>
                                      
                                    </p>
                                    <input type="text" class="form-control" placeholder="Enter Project Name" name="project_name" value="<?php echo $project_name; ?>" />
                                    <span style='color:#ff0000'><?php echo form_error('project_name'); ?></span>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Category </b>
                                    </p>
                                    <select class="form-control show-tick" name="cat_id">
                                        <option value="">Select Category</option>
                                        <?php 
                                        if(is_array($project_type)){
                                            foreach ($project_type as $type) {
                                            
                                        ?>
                                        <option <?php if($cat_id == $type->id){ echo "selected"; } ?> value="<?php echo $type->id; ?>"><?php echo $type->project_type; ?></option>
                                    <?php } } ?>
                                    </select>

                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Scheme </b>
                                    </p>
                                    <select class="form-control show-tick" name="scheme_id">
                                        <option value="">Project scheme</option>
                                        <?php 
                                        if(is_array($project_scheme)){
                                            foreach ($project_scheme as $scheme) {
                                            
                                        ?>
                                        <option <?php if($scheme_id == $scheme->id){ echo "selected"; } ?> value="<?php echo $scheme->id; ?>"><?php echo $scheme->name; ?></option>
                                    <?php } } ?>
                                    </select>

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Location </b>
                                    </p>
                                    <select class="form-control show-tick" name="location">
                                        <option value="">Project Location</option>
                                        <?php 
                                        if(is_array($project_location)){
                                            foreach ($project_location as $locations) {
                                            
                                        ?>
                                        <option <?php if($location == $locations->id){ echo "selected"; } ?> value="<?php echo $locations->id; ?>"><?php echo $locations->name; ?></option>
                                    <?php } } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="row clearfix">
                                 <!-- <div class="col-md-4">
                                    <p>
                                        <b>Project’s Circle  </b>
                                    </p>
                                    <select class="form-control show-tick" name="circle_id">
                                        <option value="">Select Project Circle</option>
                                        <?php 
                                        if(is_array($project_circle)){
                                            foreach ($project_circle as $circle) {
                                            
                                        ?>
                                        <option <?php if($circle_id == $circle->id){ echo "selected"; } ?> value="<?php echo $circle->id; ?>"><?php echo $circle->name; ?></option>
                                    <?php } } ?>
                                    </select>

                                </div> -->
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Circle  </b>
                                    </p>
                                    <select class="form-control show-tick" name="wing_id" id="circle_id" onchange="divisionfunc(1)">
                                            <option value="0">Select Circle</option>
                                            <?php 
                                        if(is_array($project_wings)){
                                            foreach ($project_wings as $wing) {
                                            
                                        ?>
                                        <option <?php if($wing_id == $wing->id){ echo "selected"; } ?> value="<?php echo $wing->id; ?>"><?php echo $wing->wing_name; ?></option>
                                    <?php } } ?>
                                        
                                    </select>

                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Project Division </b>
                                    </p>
                                    <select name="project_division" id="division_id" class="form-control show-tick">
                                    <option value="0">Select project Division</option>

                                   <?php
                                       echo $CI->getdivision_data($result['wing_id'],$result['division_id']);
                                    ?>
                                    
                                </select>

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Indicative Cost (₹) </b>
                                    </p>
                                   <input class="form-control txtQty" type="text" placeholder="Enter Project Cost" name="project_cost" value="<?php echo $project_cost ?>">

                                </div>
                                
                            </div>
                            
                            
                            
                            
                            <div class="row clearfix">
                                
                                
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
                                <h2>Project Stakeholders Information </h2>
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
                                                        <b>Stakeholder Type</b>
                                                    </p>
                                                    <select id="user_type_<?php echo $i; ?>" name="user_type[]" class="form-control show-tick">
                                                        <option value="0">Select Stakeholder Type</option>
                                                        <?php foreach ($user_type as $type) { ?>
                                                            <?php $sta = ($super_visor['user_type_id'] == $type['id']) ? "selected" : '' ?>
                                                            <option value="<?php echo $type['id']; ?>" <?php echo $sta; ?>> <?php echo $type['designation']; ?></option>

                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-5">
                                                    <p id="fnameusr_<?php echo $i; ?>" <?php echo $style; ?> >
                                                        <b>Stakeholder Name</b>
                                                    </p>

                                                    <select id="user_name_<?php echo $i; ?>" name="user_name[]" class="form-control show-tick">
                                                        <option value="0">Select Stakeholder Name</option>
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

                                                    
                                                    <button id="delusr_<?php echo $i; ?>" type="button" class="btn btn-default btn-circle2 waves-effect waves-float delusrcls">
                                                <i class="material-icons col-pink">delete</i>
                                                </button> 


                                                </div>


                                            </div>
                                        <?php $i++; } ?>

                                    <?php } ?>
                                    <div id="0000usr" class="row clearfix">
                                        <div class="col-md-5">
                                            
                                            <select name="user_type[]" class="form-control show-tick">
                                                <option value="0">Select Stakeholder Type</option>
                                                <?php foreach ($user_type as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-5">
                                            
                                            <select  name="user_name[]" class="form-control show-tick">
                                                <option value="0">Select Stakeholder Name</option>
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
                        <h2> Attachment - Project Creation</h2>
                    </div>

                    <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                            <div class="col-md-4">
                                <p id="fname_1" class="fname">
                                    <b>File Name </b>
                                   
                                </p>
                                <input class="form-control" id="file_name" name="file_name" type="text"  placeholder="Enter file name">
                                
                                <span id="file_name_err_status" style='color:#ff0000'></span>
                            </div>
                            <div class="col-md-4">
                                <p id="title_1" class="fname">
                                    <b>Upload File  (size limit maximum 50 MB each)</b>
                                   
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
                        <?php if(is_numeric($project_id)){ ?>
                        <a href="<?php echo base_url().'Project_creation/lists' ?>" class="btn btn-warning waves-effect">CANCEL</a>
                        <?php } ?>
                        
                        <button id="submit_btn" class="btn bg-indigo waves-effect"  type="submit" name="submit_btn" value="Submit" ><?php if(is_numeric($project_id)){ echo 'UPDATE'; }else{ echo 'SUBMIT';  } ?></button>
                        
                        

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
                </div>

 </form>
        <div id="container_9999" class="row clearfix" style="display: none;">
            <div class="col-md-5">
                <p id="titleusr_1">
                    <b>Stakeholder Type</b>
                </p>
                <select id="user_type_1" name="user_type[]" class="form-control show-tick">
                    <option value="0">Select Stakeholder Type</option>
                    <?php foreach ($user_type as $type) { ?>
                        <option value="<?php echo $type['id']; ?>"> <?php echo $type['designation']; ?></option>

                    <?php } ?>
                </select>

            </div>
            <div class="col-md-5">
                <p id="fnameusr_1">
                    <b>Stakeholder Name</b>
                </p>

                <select id="user_name_1" name="user_name[]" class="form-control show-tick">
                    <option value="0">Select Stakeholder Name</option>
                    <?php foreach ($user_name as $user) { ?>
                        <option value="<?php echo $user['id'] ?>"><?php echo $user['firstname'] . " " . $user['lastname']; ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="col-md-2  p-t-25">
                <button id="delusr_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float delusrcls">
                <i class="material-icons col-pink">delete</i>
                </button> 


            </div>


        </div>
            <!-- Select -->

        </div>
    </section>
    <!-- #Main Content -->


    <script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
</script>

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

        
        $("#container_9999").hide();
        


        


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
        if(next_id > 1){
        html.find(".p-t-25").removeClass("p-t-25");
        }
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
  ajax.open("POST", "<?php echo base_url('Project_creation/file_upload_data'); ?>"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
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
  
  $("#Project_creation_form").submit();
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
  
  $("#Project_creation_form").submit();
 //   }else{
 //  return false;
 // }
 // });
});


</script>

<script type="text/javascript">


    $('body').on('click', '.delusrcls', function(){
    //alert('hdsgf');
            var elementId = $(this).attr('id');
            var id = elementId.split("_");
            $("#container_"+id[1]).remove();

    //ajax call here

});


</script>

<script type="text/javascript">
    $(function () {
        $("input[class*='txtQty']").keydown(function (event) {


            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
    });
</script>

<script type="text/javascript">
   
    function divisionfunc() {
        var value = $('#circle_id').val();
        
         if (value != 0)
            {
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Project_creation/getdivision_list",
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