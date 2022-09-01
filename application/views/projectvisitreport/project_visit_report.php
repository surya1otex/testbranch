<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<?php $CI =& get_instance();
$CI->load->model('Project_visit_model');
?>
<section class="content">
<div class="container-fluid">
    <div class="block-header">
        <h4>Visit Report Summary</h4>
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
                                    <td width="230px"> <b>Projects Sector</b></td>
                                    <td><?php echo $project->sector_name; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Projects Area</b> </td>
                                    <td><?php echo $project->area_name; ?></td>
                                    <td> <b>Projects Type</b></td>
                                    <td><?php echo $project->project_type_name; ?></td>
                                </tr>
                                <tr>
                                    <td> <b>Project Start Date</b> </td>
                                    <td> <?php echo $project->project_start_date; ?> </td>
                                    <td> <b>Project End Date</b> </td>
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
                    <h2>Visits List</h2>
                </div>

                <div class="body table-responsive">
                    <div class="">
                        <table class="table table-bordered table-striped table-hover js-example1 dataTable"  <?php echo !empty($progress_details) ? 'id="visit_list"' : ''; ?>>
                            <thead>
                            <tr>
                                <th> Sl No </th>
                                <th> Dated </th>
                                <th> Submitted By </th>
                                <th> Work Item </th>
                                <th> Observation </th>
                                <th> Recommendation </th>
                                <th> </th>
                                <th> </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $sl = 1;
                            if(is_array($progress_details)){
                                foreach ($progress_details as $progress) {
                                    $newDateTime = date('d M Y h:i A', strtotime($progress->timestamp));
                                $img_data = $CI->get_progress_image_data($progress->project_id,$progress->id);
                                $map_icon_file = base_url().'assets/images/maps.png'; 
                                $google_map_link = 'https://www.google.com/maps/search/?api=1&query='.$progress->latitude.','.$progress->longitude;
                                $pending_cnt = $CI->get_project_visit_pending_count($progress->project_id,$progress->id);

                                $project_work_item_id = $CI->getSpecificdata2_res('project_progress_update_log_details_triggering','project_id',$progress->project_id,'log_id',$progress->id,'project_work_item_id');
                                $work_item_id = $CI->getSpecificdata_res('work_item_master', 'id', $project_work_item_id,'id');
                                $work_item_name = $CI->getSpecificdata_res('work_item_master', 'id', $project_work_item_id,'work_item_description');
                                $user_details = $CI->Project_visit_model->get_user_details_by_user_id($progress->user_id);

                              ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $newDateTime; ?></td>
                              <td>  <?php if (!empty($user_details[0]['name'])) { echo $user_details[0]['name']; } else { echo $this->session->userdata('name'); } ?></td>
                                <td><?php echo $work_item_name; ?></td>
                                <td><?php echo $progress->observation; ?></td>
                                <td><?php echo $progress->recommendation; ?></td>
                                <td><span class="ntip"><?php if($progress->gateway == 'M'){echo '<i class="material-icons">stay_current_portrait</i>'; }else{ echo '<i class="material-icons">desktop_mac</i>'; } ?>
                                    <span class="ntiptext"><?php if($progress->gateway == 'M'){echo 'Submitted through Mobile App'; }else{ echo 'Submitted through Website'; } ?></span>
                                        </span>



                                        </td>
                                <td>
                                    <?php
                                    if(is_array($img_data)){
                                      //   foreach ($img_data as $imgs) {
                                      // $img_file = 'https://api.brainsparktech.net/uploads/'.$imgs->image_path;
                                      
                                    ?>
                                    <!-- <span class="thumb_img"> <img src="<?php //echo $img_file; ?>" class="img-responsive"></span> -->
                                    <div class="notification">
                                    <span class="thumb_img"> <i class="material-icons col-red"> collections </i> </span>
                                    <span class="label-count2 bg-green"><?php echo count($img_data); ?></span>
                                    </div>
                                <?php  } ?>
                                <?php
                                if($progress->latitude && $progress->longitude){
                                ?>
                                <a href="<?php echo $google_map_link; ?>" target="_blank"><span class="thumb_img"> <i class="material-icons col-red"> place </i> </span></a>
                            <?php } ?>
                                </td>
                                <td>
                                    <div class="notification">
                                    <a href="<?php echo base_url(); ?>projectVisitReport/visit_progress_detail?project_id=<?php echo base64_encode($progress->project_id); ?>&log_id=<?php echo base64_encode($progress->id); ?>" class="btn bg-blue waves-effect">
                                        <i class="material-icons col-black">visibility</i>
                                        <span> VIEW </span>
                                    </a>
                                    <?php if($pending_cnt > 0){ ?>
                                    <span class="label-count2 bg-orange"><?php echo $pending_cnt; ?></span>
                                <?php } ?>
                                </div>
                                </td>
                            </tr>
                        <?php $sl++;  } } ?>

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


<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#visit_list').DataTable({
            responsive: true,
            columns: [
                {"width": "5%"},
                {"width": "15%"},
                {"width": "20%"},
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"}
            ]

            });
         
        })
    </script>
