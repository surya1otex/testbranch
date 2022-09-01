<script src="<?php echo base_url();?>assets/js/project_approval.js"></script>
<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>

<!-- Sweetalert Css -->
    <link href="<?php echo base_url();?>/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />


  <?php $CI =& get_instance();
  $CI->load->model('Physical_progress_model');
  ?>
<?php
foreach ($project_details as $project) {
    $project_name = $project->project_name;
    $project_area_name = $project->area_name;
    $project_type_name = $project->project_type;
    $estimate_total_cost = $project->estimate_total_cost;
    $project_creator_id = $project->project_creator_id;
    $sector_name = $project->sector_name;
    $project_code = $project->project_code;
    $project_start_date = date('M d Y', strtotime($project->project_start_date));
    $project_end_date = date('M d Y', strtotime($project->project_end_date));
    $planning_incharge_user_id = $project->planning_incharge_user_id;
}
$creatorDetails = $CI->Physical_progress_model->get_user_details_by_user_id($project_creator_id);
?>

<section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="block-header">
                    <h4>Progress Update Offline</h4>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
           <?php
            $from_action = base_url().'physical_progress/create?project_id='.base64_encode($project_id);
            ?>
            <form method="POST" action="<?php echo $from_action; ?>" enctype="multipart/form-data">
            <div class="row clearfix ">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <div class="card clearfix">
                     
                        <div class="col-md-8 col-sm-12 col-xs-12 p-0">
                            <div class="header"><h2>Project Information</h2></div>
                           <div class="body">
                              <div class="table-responsive">
                              <table class="table table-bordered table-striped table-hover js-basic-example dataTable  m-b-0">
                                <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons"> build</i> <span style="position: relative;bottom: 5px;">Project's Name </span></td>
                                        <td colspan="3"> <span style="position: relative;top: 5px;"><?php echo $project_name; ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons">my_location</i> <span style="position: relative;bottom: 5px;"> Projects Sector </span> </td>
                                        <td><span style="position: relative;top: 5px;"> <?php echo $sector_name; ?> </span></td>
                                        <td width="230px">  <i class="material-icons">dashboard</i> <span style="position: relative;bottom: 5px;"> Project’s id</span></td>
                                        <td><span style="position: relative;top: 5px;"><?php echo $project_code; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons">settings</i><span style="position: relative;bottom: 5px;"> Project Type </span></td>
                                        <td><span style="position: relative; top: 5px;"> <?php echo $project_type_name; ?> </span></td>
                                        <td> <i class="material-icons">account_circle</i> <span style="position: relative;bottom: 5px;">Planning in-Charge </span></td>
                                        <td><span style="position: relative; top: 5px;"> <?php echo $creatorDetails[0]['name']; ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons">date_range</i> <span style="position: relative; bottom: 5px;"> Start Date </span> </td>
                                        <td> <span style="position: relative; top: 4px;"> <?php echo $project_start_date; ?> </span></td>
                                        <td> <i class="material-icons" >date_range</i><span style="position: relative; bottom: 5px"> End Date </span></td>
                                        <td> <span style="position: relative; top: 4px;"> <?php echo $project_end_date; ?></span></td>
                                    </tr>
                                    <!-- <tr>
                                        <td><i class="material-icons" >trending_up</i><span style="position: relative; bottom: 5px;"> Project Status </span></td>
                                        <td colspan="2">
                                          <?php
                                          //$pro_completed_st_count = $project_progress_ar[0]['project_progress'];

                                          ?>
                                           <div class="progress m-t-10">
                                               <div class="progress-bar bg-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo $pro_completed_st_count; ?>%">
                                                   <?php //echo $pro_completed_st_count; ?>% Completed
                                               </div>
                                           </div>
 
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr> -->
                                  </tbody>
                                </table>
                              </div>
                           </div>
                         </div>
                        
                       
                         <div class="col-md-4 col-sm-12 col-xs-12 p-0">
                             <div class="header"><h2>&nbsp;</h2></div>
                            <div class="body">
                            
                              <div class="col-md-12">
                                <p><b>Visit Date (dd/mm/yyyy) <span class="col-pink">* </span></b></p>
                                <input type="text" id="approve" name="visit_date" class="datepicker form-control" placeholder="Please choose a date..." value="<?php echo $_REQUEST['visit_date']; ?>" required>
                                <?php echo form_error('visit_date'); ?>
                              </div>
                              <div class="col-md-12">
                                <p><b>Reporting Date (dd/mm/yyyy) <span class="col-pink">* </span></b></p>
                                <input type="text" id="approve" name="reporting_date" class="datepicker form-control" placeholder="Please choose a date..." value="<?php echo $_REQUEST['visit_date']; ?>" required>
                                <?php echo form_error('reporting_date'); ?>
                              </div>
                           </div>
                        </div>
                       
                    </div>
                </div>
           </div>
            
            <div class="row clearfix ">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card clearfix">
                    <div class="header">
                        <h2> Activity Details</h2>    
                    </div>
                     <div class="body">
                         <div class="col-md-8">
                         <div class="col-md-12">
                            <div class="col-md-4 m-t-10"><b> Choose Work Item<span class="col-pink">* </span></b></div>
                             <div class="col-md-8">   
                                <select class="form-control show-tick" name="work_item_id" id="work_item_id" required>
                                    <option value="">Select Work Item</option>
                                    <?php
                                    if(is_array($work_itemData)){
                                      foreach ($work_itemData as $work) {
                                     
                                    ?>
                                    <option value="<?php echo $work->work_item_id; ?>" <?php if($_REQUEST['work_item_id'] == $work->work_item_id){ echo "selected"; } ?>><?php echo $work->work_item_description; ?></option>
                                  <?php } } ?>
                                </select>
                                <?php echo form_error('work_item_id'); ?>
                                

                           </div>
                         </div> 
                       </div>
                         
                         <div class="clearfix"></div>
                         <?php echo form_error('activity_weightage'); ?>
                        <div class="col-md-8" id="activity_data">   
                          
                        </div>  

                        
                         
                        <div class="col-md-4">   
                          <div class="col-md-12">
                             <p><b>Observation  </b> </p>    
                             <textarea name="observation" class="form-control no-resize" placeholder="Enter Observation" rows="4" ><?php echo $_REQUEST['observation']; ?></textarea>
                             <?php echo form_error('observation'); ?>
                           </div>
                           <div class="col-md-12">
                             <p><b>Recommendation </b> </p>    
                             <textarea name="recommendation" class="form-control no-resize" placeholder="Enter Recommendation" rows="4"><?php echo $_REQUEST['recommendation']; ?></textarea>
                             <?php echo form_error('recommendation'); ?>
                          </div>
                        </div>  
                         
                     </div>
                   </div>
                </div>
            </div>
            
           <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Attachment</h2>
                </div>

                <div class="body">
                    <div class="cloneBox1 m-b-15">
                        <div class="row clearfix">
                            <div id="file_upload_div" style="display: block;">
                            
                            <div class="col-md-4">
                                <p id="title_1" class="fname">
                                    <b>Upload file <span class="col-pink">* </span> (size limit maximum 50 MB each)</b>
                                    (Extension allowed -  jpg, jpeg, png)
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
                    <div class="col-md-6 table-responsive" <?php if(empty($post_steps_files['file_url'])){ ?>style="display: none;" <?php } ?> id="documentsData">
                        <table id="docTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                              <tr>
                                <th>Image</th>
                                <th>File Size</th>
                                <th></th>
                              </tr>
                              <?php
                              if(!empty($post_steps_files['file_url'])){
                                foreach ($post_steps_files['file_url'] as $key => $file_url_val) {
                                 $file_link = base_url().'uploads/temp/'.($file_url_val);
                                 $path = 'uploads/temp/'.($file_url_val);
                                 $file_size = filesize($path);
                                $file_d_link = '<a href="'.$file_link.'" class="btn btn-primary waves-effect m-r-15" title="Download" download><i class="fas fa-download"></i> Download</a>  <button id="del_1" type="button" class="btn btn-default btn-circle2 waves-effect waves-float p-r-10" onclick="deleteRow(this)"><i class="material-icons col-pink">delete</i></button>';
                                $image_data = '<img style="height: 60px; width: 60px" src="'.$file_link.'">';
                                
                                $input_data = '<input type="hidden" name="hidden_file_url[]" value="'.$file_url_val.'">';
                                ?>
                                <tr>
                                    <?php echo $input_data; ?>
                                    <td><?php echo $image_data; ?></td>
                                    <td><?php echo $CI->formatSizeUnits($file_size); ?></td>
                                    <td><?php echo $file_d_link; ?></td>
                                </tr>


                             <?php } }
                               ?>
                            </table>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-12 align-center">
                       

                        <button id="submit_btn" class="btn bg-indigo waves-effect" type="submit" name="submit" value="Submit">UPDATE</button>
                        
                        <!--<a  class="btn btn-success waves-effect" href="<?php /*echo site_url() .'/Project/project_preparation?project_id=' . base64_encode($project_id) */?>" type="button">NEXT</a>-->

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

    function addFileRow(){

        var last_id =  $('#amount_brkup_tbl > div:last').prev().attr('id');
        console.log(last_id);
        var next_id = 1;
        if( last_id ){
            var id = last_id.split("_");
            next_id =  parseInt(id[1]) + 1 ;
        }

        $("#tr_9999999").show();
        var html = $("#tr_9999999").clone().attr('id', 'tr_'+next_id );
        $("#tr_9999999").hide();
        html.find("#del_1").attr('id','del_'+next_id);
        html.find("#add_1").attr('id','add_'+next_id);
        html.find("#fname_1").attr('id','fname_'+next_id);
        html.find("#title_1").attr('id','title_'+next_id);
        html.find(".fname").hide();
        html.find(".p-t-25").removeClass("p-t-25");
        if( last_id ) {
            $('#amount_brkup_tbl > div:last').prev().after(html);
            $('#del_'+next_id).show();
            $('#add_'+next_id).hide();
        }else{

            $('#0000').before(html);

            $('#del_'+next_id).show();
            $('#add_'+next_id).hide();

            $("#fname_99,#title_99").hide();
            $("#fname_"+next_id).show();
            $("#title_"+next_id).show();
        }

    }
</script>


  
<script type="text/javascript">
  var project_id = <?php echo $project_id; ?>;

  
  $("#work_item_id").change(function(){
    //alert($(this).val());
    var value = $(this).val();
    //alert(value);
    if (value != "")
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>physical_progress/get_work_item_activity_list",
    datatype : 'json',
    //data:'lodgeDesID='+$(this).val(),
    data: {"project_id":project_id,"work_item_id": $(this).val() },
    
    success: function(response){
      //console.log(response);
      $('#activity_data').html('').prepend(response);
      
      }
    });
    }else{
      $('#activity_data').html('');
    }
  });

var work_item_id = $("#work_item_id").val();
    //alert(work_item_id);
    if (work_item_id != "")
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>physical_progress/get_work_item_activity_list",
    datatype : 'json',
    //data:'lodgeDesID='+$(this).val(),
    data: {"project_id":project_id,"work_item_id": work_item_id },
    
    success: function(response){
      //console.log(response);
      $('#activity_data').html('').prepend(response);
      
      }
    });
    }else{
      $('#activity_data').html('');
    }
  </script>


  <script type="text/javascript">
    function _(el) {
  return document.getElementById(el);
}

function submitFile() {
   // alert('gdgfhd');
  var file = _("fileupload").files[0];
  //var file_name = _("file_name").value;
  if(file){
    if(file.size < 50000000){
    // _("file_name_err_status").innerHTML = "";
     _("upload_err_status").innerHTML = "";   
   //alert(file.name+" | "+file.size+" | "+file.type);
   _("submit_btn").disabled = true;
  var formdata = new FormData();
  formdata.append("file1", file);
  //formdata.append("file_name", file_name);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "<?php echo base_url('physical_progress/progress_file_upload_data'); ?>"); // http://www.developphp.com/video/JavaScript/File-Upload-Progress-Bar-Meter-Tutorial-Ajax-PHP
  //use file_upload_parser.php from above url
  ajax.send(formdata);
   //_("file_name").value = "";
   _("fileupload").value = "";
  //document.getElementById("uploadCaptureInputFile").value = "";
    }else{
        //_("file_name_err_status").innerHTML = "";
       _("upload_err_status").innerHTML = "Max File size allowed 50 MB."; 
    }
    }else{
        //_("file_name_err_status").innerHTML = "";
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

<script>
    function allowNumbersOnly(e,id) {
      //var getVal = $('#'+id).val();
      //console.log(getVal);
      //alert(getVal);

        var code = (e.which) ? e.which : e.keyCode;
        // alert(e.key);
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }

    function edValueKeyPress(e,id){
    //alert(id);
    var getVal = Number($('#'+id).val());
    var remain = Number($("#remain_"+id).val());
    console.log(getVal);
    if(getVal > remain){
      //alert('Cant exceed remain');
      $('#error_'+id).html("Not Applicable");
      $('#'+id).val("");
      setTimeout(function(){
     $('#error_'+id).html("");
    }, 2000);
    }else{
      $('#error_'+id).html("");
    }
    }
</script>