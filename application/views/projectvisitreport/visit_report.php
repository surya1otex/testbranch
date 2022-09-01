<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url();?>assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
<?php $CI =& get_instance();
$CI->load->model('Project_visit_model');

?>
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h4>Visit Report Details</h4>
    </div>
    <!-- Input -->
    <div class="row clearfix ">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
        
          <div class="body">
            <div class="section_clone">
                <div class="table-responsive">
                  <?php
                                if(is_array($project_details)){
                                    foreach ($project_details as $project) {
                                 
                            ?>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td width="230px"> <b>Project's Name </b></td>
                                    <td colspan="3"><?php echo $project->project_name; ?> </td>
                                </tr>
                                <tr>
                                    <td> <b>Projects Code</b></td>
                                    <td><?php echo $project->project_code; ?></td>
                                    <td width="230px"><b> Projects Sector</b></td>
                                    <td><?php echo $project->sector_name; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Projects Area</b> </td>
                                    <td><?php echo $project->area_name; ?></td>
                                    <td> <b>Projects Type</b></td>
                                    <td><?php echo $project->project_type_name; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Project Start Date </b></td>
                                    <td> <?php echo $project->project_start_date; ?> </td>
                                    <td> <b>Project End Date </b></td>
                                    <td> <?php echo $project->project_end_date; ?></td>
                                </tr>

                                </tbody>
                            </table>
                        <?php } } ?>
                    
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Input --> 


     <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                    <h2>Visit Report Summary</h2>
                </div>
                
                <div class="body">
            <div class="section_clone">
                <div class="table-responsive">
                  <?php
                                if(is_array($single_logs_details)){
                                    foreach ($single_logs_details as $sin) {
                                  $gateway = $sin->gateway;
                                $latitude = $sin->latitude;
                                $longitude = $sin->longitude;
                                 $google_map_link = 'https://www.google.com/maps/search/?api=1&query='.$sin->latitude.','.$sin->longitude;
                                 $sinDateTime = date('d M Y h:i A', strtotime($sin->timestamp));
                                 $visitDateTime = date('d M Y', strtotime($sin->visit_date));
                                 $reportingDateTime = date('d M Y', strtotime($sin->reporting_date));
                                 $img_data = $CI->get_progress_image_data($sin->project_id,$sin->id);
                                 $user_details = $CI->Project_visit_model->get_user_details_by_user_id($sin->user_id);
                            ?>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td width="230px"> <b>Work Item </b></td>
                                    <td><?php echo $work_item_name; ?> </td>
                                    <td> <b>Submitted By</b></td>
                                    <td>  <?php if (!empty($user_details[0]['name'])) { echo $user_details[0]['name']; } else { echo $this->session->userdata('name'); } ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Location</b></td>
                                    <td><?php
                                if($sin->latitude && $sin->longitude){
                                ?>
                                      <a href="<?php echo $google_map_link; ?>" target="_blank"><span class="thumb_img"> <i class="material-icons col-red"> place </i> </span></a>
                                      <?php } ?></td>
                                    <td width="230px"> <b>Submitted Date</b></td>
                                    <td><?php echo $sinDateTime; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Visit Date</b> </td>
                                    <td> <?php if($sin->visit_date){ echo $visitDateTime; } ?> </td>
                                    <td> <b>Reporting Date</b> </td>
                                    <td> <?php if($sin->reporting_date){ echo $reportingDateTime; } ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Observation</b> </td>
                                    <td> <?php echo $sin->observation; ?> </td>
                                    <td> <b>Recommendation</b> </td>
                                    <td> <?php echo $sin->recommendation; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Submitted Through</b> </td>
                                    <td> <?php if($sin->gateway == 'M'){echo '<span class="label label-success">Mobile App</span>'; }else{ echo '<span class="label label-success">Website</span>'; } ?> </td>
                                </tr>

                                </tbody>
                            </table>
                        <?php } } ?>
                    
                  </div>

            </div>
          </div>

          <div class="body">
                  <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                    <?php
                    if(is_array($img_data)){
                    foreach ($img_data as $imgs) {
                      if($gateway == 'W'){
                        $img_file = base_url().'uploads/mobilevisitreport/'.$imgs->image_path;
                      }else{
                        $img_file = visitReportImagePath.'mobilevisitreport/'.$imgs->image_path;
                      }
                  
                    ?>
                     <div class="col-md-2 col-sm-6 col-xs-6">
                        <a href="<?php echo $img_file; ?>" data-sub-html="Demo Description">
                          <img class="img-responsive thumbnail" src="<?php echo $img_file; ?>">
                        </a>
                    </div>
                  <?php } } ?>
                  </div>
                  
                </div>
                <?php if($latitude && $longitude){ ?>
                <div class="body">

              <iframe src="https://maps.google.com/maps?q=<?php echo $latitude.' ,'.$longitude; ?>&z=15&output=embed" width="100%" height="270" frameborder="0" style="border:0"></iframe>
            </div>
          <?php } ?>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
    
    
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                    <h2>Activity List / <?php echo $work_item_name; ?></h2>
                </div>
                
                <div class="body table-responsive">
                    <div class="">
                        <table class="table table-bordered table-striped table-hover dataTable" id="progress-list-tbl">
                            <thead>
                                <tr>
                                    <th> Activity Name </th>
                                    <th> Target </th>
                                    <th> Achieved </th>
                                    <th> Target Till date </th>
                                    <th> Progress</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>

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



<div class="modal fade" id="logrejectModal" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Progress Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="rejectForm" id="reject-form" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="log-details">
        </div>
        <label for="reason"><b>Reason: </b></label>
        <!-- <input name="progress" id="progress" class="form-control" type="text"/> -->
        <textarea name="reason" class="form-control" id="reason"></textarea>
        <p class="text-danger" id="reason_err"></p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <input id="progress-form-submit" type="submit" class="btn btn-primary" value="Submit">
      </div>
    </form>
      </div>
     </div>
    </div>
 

 <div class="modal fade logapproveModal" id="logapproveModal" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Progress Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="approveForm" id="approve-form" method="post">
      <div class="modal-body">
        <div class="log-app-details">
        </div>
        <!-- <label for="progress">Progress: </label>
        <input name="progress" id="progress" class="form-control" type="text"/>
        <p class="text-danger" id="progress_err"></p>
 -->    
 <label for="appreason"><b>Reason: </b></label>
        <textarea name="appreason" class="form-control" id="appreason"></textarea>
        <p class="text-danger" id="appreason_err"></p>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <input id="approve-form-submit" type="submit" class="btn btn-primary" value="Submit">
       <!-- <button type="submit">Submit</button> -->
      </div>
    </form>
      </div>
     </div>
    </div>

<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- Light Gallery Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/light-gallery/js/lightgallery-all.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/medias/image-gallery.js"></script>

<?php 
$project_id = base64_decode($_REQUEST['project_id']);
$log_id = base64_decode($_REQUEST['log_id']);
?>
<script type="text/javascript">
var project_id = '<?php echo $project_id; ?>';
var log_id = '<?php echo $log_id; ?>';
    
var proTable = $('#progress-list-tbl').DataTable({
        "order": [[ 0, "asc" ]],
        "pageLength" : 10,
        "ajax": {
            url : "<?php echo site_url();?>/projectVisitReport/progress_detail_data",
            data: { project_id: project_id , log_id: log_id },
            type : 'POST',
            
        }
    });
</script>
<script type="text/javascript">
$(document).on( "click", '.rejectSt',function(e) {
//proTable.ajax.reload( null, false );
  var type = 'reject';
  var logid = $(this).data('id');
  var progress = $(this).data('progress');
  //console.log(progress);
  $.ajax({
  type: "POST",
  url: "<?php echo site_url(); ?>/projectVisitReport/get_log_details_reject",
  //data: "logid=" +logid,
  data:{logid:logid,type:type},
  success: function(data){
    //console.log(data);

    $('#logrejectModal').modal('show'); 
    //$("#progress").val(progress);
    $('.log-details').html(data);
    
  }
  });

  $(function() {

$('body').off('submit').on('submit',function(e){
    e.preventDefault();
    // console.log();
    var res=document.getElementById('reason').value;
    $("#reason_err").html('');
    if (res=='')
    {
        //alert("Please Fill All Required Field");
        $("#reason_err").html('Please Enter Reason');
        return false;
    }

    else{
    $.ajax({
        type: "POST",
        url: '<?php echo site_url("/projectVisitReport/submit_reject_data"); ?>',
        data: $('form.rejectForm').serialize()+'&id='+logid,
        success: function(response) {
            console.log(response);
            $('#logrejectModal').modal('hide'); 
            proTable.ajax.reload( null, false );
        },
        error: function() {
            alert('Error');
        }
    });
    return false;
    }
});
});
  
});


</script>

<script type="text/javascript">
$(document).on( "click", '.approveSt',function(e) {
//proTable.ajax.reload( null, false );
//document.getElementById("approve-form-submit").reset();
$("#approve-form").trigger("reset");
  var type='approve';
  var logid = $(this).data('id');
  //var progress = $(this).data('progress');

  console.log(logid);
  //console.log(progress);
  $.ajax({
  type: "POST",
  url: "<?php echo site_url(); ?>/projectVisitReport/get_log_details_reject",
  //data: "logid=" +logid,
  data:{logid:logid,type:type},
  success: function(data){
    //console.log(data);

    //$('#logapproveModal').modal('show');
    $('#logapproveModal').modal('toggle'); 
    //$('.upload-modal').modal();
    //$("#progress").val(progress);
    $('.log-app-details').html(data);
    //var remain = document.getElementById('remaincount').value;
    //console.log(remain);
    
  }
  });


$('body').off('submit').on('submit',function(e){
  e.preventDefault();
   //console.log($('form.approveForm').serialize()+'&id='+logid);
    var a=document.getElementById('appreason').value;
    var remaincount=parseInt(document.getElementById('remaincount').innerText);
    var progress=parseInt(document.getElementById('progress').value);
    //var p=document.getElementById('progress').value;
    $("#appreason_err").html('');
    $("#progress_err").html('');
     if(progress > remaincount){
      $("#progress_err").html("Progress should be less than Remaining Quantity");
    }else{
    //console.log('hit');
    $.ajax({
         url: '<?php echo base_url("projectVisitReport/submit_approve_data"); ?>',
        
        type: 'POST',
        data: $('form.approveForm').serialize()+'&id='+logid,
        
        cache:false,
        async:false,
        success: function(response) {
            //console.log(response);
            //console.log('ok');
            $('#logapproveModal').modal('hide'); 
            proTable.ajax.reload( null, false );
        },
        error: function() {
            alert('Error');
        }
    });
    return false;
    }
});
});


$(".modal").on("hidden.bs.modal", function(){
  $("#approve-form").trigger("reset");  
  $("#reject-form").trigger("reset");  
});
</script>