<?php $CI =& get_instance(); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
        <h4>PROJECT DASHBOARD</h4>
    </div>
        <!-- Input -->
        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="body">
                    <!-- <form class="form-horizontal"> -->

                    <!-- <div class="row clearfix m-b-35"> -->
                    <div class="row">
                        <!--<h4>Project Dashboard</h4>-->
                        <input type="hidden" id="project_id" value="<?php echo $project_id; ?>">
                        <?php if ($financial_module_permission) { ?>
                            <div class="col-md-8">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 p-r-0">
                                    <label for="SmeUserMasterMiddleName" class=" input-xlarge"
                                           style="vertical-align:middle; padding-top:8px;"><i
                                                class="fa fa-calendar fa-2x "></i> Start date :
                                    </label>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
                                    <div class="form-line">
                                        <input type="text" class="form-control datepicker monthpicker"
                                               placeholder="Start date" id="start_date">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"
                                           style="vertical-align:middle; padding-top:8px;"><i
                                                class="fa fa-calendar fa-2x "></i> End date :
                                    </label>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
                                    <div class="form-line">
                                        <input type="text" class="form-control datepicker monthpicker"
                                               placeholder="End date" id="end_date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button class="btn bg-indigo waves-effect" onclick="projectDashboardSearch()">SEARCH
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- </form> -->
                </div>

                <div class="panel-group full-body" id="accordion_17" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-col-orange">
                        
                <div class="panel-heading" role="tab" id="headingOne_17">
                    <h4 class="panel-title p-10">
                       <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                          <?php echo $project_detail[0]['project_name']; ?>
                                    , <?php echo ucfirst($project_detail[0]['area_name']); ?>
                        </div>

                         <span class="proj_id"> Project ID : <?php echo $project_detail[0]['project_code']; ?> </span>
                           <a role="button" data-toggle="collapse" href="#collapseOne_17" aria-expanded="true" aria-controls="collapseOne_17" class="p-0 pull-right">
                            <i class="fa fa-minus"></i>
                           </a>
                     </h4>
                  </div>

                       

            <div id="collapseOne_17" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">

                <div style="font-size: 12px">
                    <div class="col-md-3 col-xs-12">
                      <div class="col-md-6 col-xs-5 p-l-0">
                        <ul style="list-style: none;" class="p-l-0">
                          <li class="m-5"><strong><i class="fa fa-caret-right"></i> Project Area :</strong></li>
                          <!-- <li class="m-5"><strong><i class="fa fa-caret-right"></i> Support :</strong></li> -->
                        </ul>
                      </div>
                      <div class="col-md-6 col-xs-7 p-l-0">
                        <ul style="list-style: none;" class="p-l-0">
                          <li class="m-5"> <?php echo ucfirst($project_detail[0]['area_name']); ?> </li>
                          <!-- <li class="m-5"> Agra CityTechnical Support Units (TSU) </li> -->
                        </ul>
                      </div>
                      <div class="col-md-9 col-xs-12 p-l-0">
                        <?php 
                        $project_details_ar = $CI->get_project_progress_data($project_id);
                        // print_r($project_details_ar);
                        // die();
                   $project_physical_progress_percentageN = $project_details_ar['project_physical_completion_percentage'];
                   //$project_physical_progress_percentage = $project_details_ar['project_physical_completion_percentage'];
			$project_physical_progress_percentage = !is_nan($project_physical_progress_percentageN) ? $project_physical_progress_percentageN : 0;
                        ?>
                        <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Project Progress</div>
                            <div class="number"><?php echo $project_physical_progress_percentage; ?>%</div>
                        </div>
                    </div>
                      </div>

                    </div>

                    <?php
                    $approver_mobile = $approver_result['Mobile'] != 0 ? $approver_result['Mobile'] : '';
                    $planning_approver_mobile = $planning_approver_result['Mobile'] != 0 ? $planning_approver_result['Mobile'] : '';
                    $project_creator_mobile = $project_creator_result['Mobile'] != 0 ? $project_creator_result['Mobile'] : '';
                    ?>
                    
                    <div class="col-md-5 col-xs-12 table-responsive p-0">
                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable m-b-0">
                         <thead>
                            <tr class="bg-blue-grey">
                                <th>Name</th>
                                <th>Position</th>
                                <th>Email ID</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-5"> <?php echo $approver_result['Username']; ?></td>
                                <td class="p-5">Project Incharge / Approver</td>
                                <td class="p-5"><?php echo $approver_result['Email']; ?></td>
                                <td class="p-5"><?php echo $approver_mobile; ?></td>
                            </tr>
                            <tr>
                                <td class="p-5"><?php echo $planning_approver_result['Username']; ?></td>
                                <td class="p-5">Planning Officer</td>
                                <td class="p-5"><?php echo $planning_approver_result['Email']; ?></td>
                                <td class="p-5"><?php echo $planning_approver_mobile; ?></td>
                            </tr>
                            <tr>
                                <td class="p-5"><?php echo $project_creator_result['Username']; ?></td>
                                <td class="p-5">Project Creator</td>
                                <td class="p-5"><?php echo $project_creator_result['Email']; ?></td>
                                <td class="p-5"><?php echo $project_creator_mobile; ?></td>
                            </tr>
                        <?php foreach ($project_user_data as $user_res) { 
                             $user_res_mobile = $user_res->mobile != 0 ? $user_res->mobile : '';
                            ?>
                            <tr>
                                <td class="p-5"><?php echo $user_res->firstname.' '.$user_res->lastname; ?></td>
                                <td class="p-5"><?php echo $user_res->designation; ?> </td>
                                <td class="p-5"> <?php echo $user_res->email; ?> </td>
                                <td class="p-5"> <?php echo $user_res_mobile; ?> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                       </table>
                    </div>
                    
                    <div class="col-md-4 col-xs-12">
                      <div class="col-md-6 col-xs-5 p-l-0">
                        <ul style="list-style: none;" class="p-l-0">
                          <li class="m-5"><strong><i class="fa fa-caret-right"></i> Status  :</strong></li>
                          <li class="m-5"><strong><i class="fa fa-calendar"></i> Start Date :</strong></li>
                          <li class="m-5"><strong><i class="fa fa-calendar"></i> End Date :</strong></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-xs-7 p-l-0">
                        <ul style="list-style: none;" class="p-l-0">
                          <li class="m-5"> Ongoing </li>
                          <li class="m-5"> <?php echo date("F j, Y", strtotime($project_detail[0]['project_start_date'])); ?> </li>
                          <li class="m-5"> <?php echo date("F j, Y", strtotime($project_detail[0]['project_end_date'])); ?> </li>
                        </ul>
                      </div>
                    </div>
                    <input type="hidden" id="act_start_dt" value="<?php echo $project_detail[0]['project_start_date'] ?>" />
                    <input type="hidden" id="act_end_dt" value="<?php echo $project_detail[0]['project_end_date'] ?>" >
                    <div class="clearfix"></div>
                 
                </div>                                               

             </div>

                    </div>
                </div>

                <?php include('tab_content_dashboard.php') ?>

                <?php
                $imagesData = $CI->project_images_data($project_id);
                if(!empty($imagesData)){
                ?>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                          <div class="body">
                              <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                <?php
                                foreach ($imagesData as $imgs) {
                                    $img_file = visitReportImagePath.'/'.$imgs;
                                 ?>

                                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                    <a href="<?php echo $img_file; ?>" data-sub-html="Demo Description">
                                      <img class="img-responsive thumbnail" src="<?php echo $img_file; ?>" style="width:100%; height:118px">
                                    </a>
                                </div>

                            <?php } ?>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>


                <?php if ($financial_module_permission) { ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box-3 bg-amber hover-zoom-effect">
                                <div class="icon">
                                    <i class="fa fa-rupee-sign"></i>
                                </div>
                                <div class="content">
                                    <div class="number m-t-5"><i class="fa fa-rupee-sign"></i><span
                                                id="planned_amount"> <?php echo $project_planned_amount; ?></span></div>
                                    <div class="text m-t--5 pull-right">Planned</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box-3 bg-green hover-zoom-effect">
                                <div class="icon">
                                    <i class="fa fa-chart-bar"></i>
                                </div>
                                <div class="content">
                                    <div class="number m-t-5"><i class="fa fa-rupee-sign"></i> <span
                                                id="released_amount"><?php echo $project_released_amount; ?></span>
                                    </div>
                                    <div class="text m-t--5 pull-right">Released</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box-3 bg-deep-orange hover-zoom-effect">
                                <div class="icon">
                                    <i class="fa fa-chart-pie"></i>
                                </div>
                                <div class="content">
                                    <div class="number m-t-5"><i class="fa fa-rupee-sign"></i><span
                                                id="pending_amount"> <?php echo $project_pending_amount; ?></span></div>
                                    <div class="text m-t--5 pull-right">Amount Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row clearfix">


                    <div class="col-md-12">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                            <label for="email_address_2">Choose a Category :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" id="work_item_type">
                                        <?php
                                        $wi = 1;
                                        if (!empty($work_item_categories)) {
                                            foreach ($work_item_categories as $key => $value) {
                                                $work_item_type_id = $value['id'];
                                                $work_item_type_name = $value['type_name'];
                                                ?>
                                                <option value="<?php echo $work_item_type_id; ?>" <?php if($wi == 1){echo 'selected'; } ?>><?php echo $work_item_type_name; ?></option>
                                                <?php
                                                $wi++;
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="p-10 bg-deep-blue-grey">
                                <h2>Project Work Items With Activities</h2>
                            </div>
                            <div class="body p-10">
                                <div class="row clearfix">
                                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">

                                        <div class="panel-group" id="accordion_2" role="tablist"
                                             aria-multiselectable="true">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php if ($financial_module_permission) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class=" p-10 bg-deep-blue-grey">
                                    <h2>Project Performance</h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div id="container_line_chart"
                                             style="min-width: 310px; height: 390px; max-width: 900px; margin: 0 auto"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                            <label for="email_address_2">Choose a WorkItems :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" id="work_item_id">
                                        <?php
                                        if (!empty($project_work_item)) {
                                            foreach ($project_work_item as $key => $value) {
                                                $work_item_id = $value['work_item_id'];
                                                $work_item_name = $value['work_item_name'];
                                                ?>
                                                <option value="<?php echo $work_item_id; ?>"><?php echo $work_item_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-5 form-control-label">
                            <label for="email_address_2">Choose a Activity :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control show-tick" name="activity_id" id="activity_id">
                                        <option value="">Select Activity</option>

                                        <?php
                                        if (!empty($project_activity)) {
                                            foreach ($project_activity as $key => $value) {
                                                $work_item_id = $value['activity_id'];
                                                $work_item_name = $value['activity_name'];
                                                ?>
                                                <option value="<?php echo $work_item_id; ?>"><?php echo $work_item_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class=" p-10 bg-deep-blue-grey">
                                <h2>Project Performance (Physical Planning)</h2>

                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div id="bar_container"
                                         style="min-width: 310px; height: 390px; max-width: 900px; margin: 0 auto"></div>
                                    <div id="container_line_chart_physical"
                                         style="min-width: 310px; height: 390px; max-width: 900px; margin: 0 auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
$vendorwisedata = $CI->get_vendor_data($project_id);
$claimed = json_encode($vendorwisedata['claimed']);

$released = json_encode($vendorwisedata['released']);
$vendor = json_encode($vendorwisedata['vendor']);

?>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class=" p-10 bg-deep-blue-grey">
                                <h2>Vendor Overview</h2>

                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div id="vendor" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        
                                </div>
                                </div>
                            </div>
                        </div>
 <?php
$financialwisedata = $CI->get_financial_data($project_id);
// echo json_encode($financialwisedata);
// die();
$per =array();
for($k = 0 ; $k < count($financialwisedata) ; $k++ ){
    $financialperiod = $financialwisedata[$k]['period'];
    $financialclaimed = $financialwisedata[$k]['claimed'];
    $financialreleased = $financialwisedata[$k]['released'];


    $period_data[$k] =  $financialperiod;
    $claimedTilldate[$k] =  (int)$financialclaimed;
    $releasedtTilldate[$k] =  (int)$financialreleased;
    }

    $financial_period_data = json_encode($period_data);
    $financial_claimedTilldate = json_encode($claimedTilldate);
    $financial_releasedtTilldate = json_encode($releasedtTilldate);

// echo json_encode($period_data);
// die();
?>


                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class=" p-10 bg-deep-blue-grey">
                                <h2>Financial Overview</h2>

                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div id="financial" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- </div> --> <input type="hidden" name="unit_name" id="unit_name" value=""/>

       

             </div> 
</section>

<!-- Light Gallery Plugin Css -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- Light Gallery Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/light-gallery/js/lightgallery-all.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/medias/image-gallery.js"></script>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    $(function () {
        $('.btn-circle').on('click', function () {
            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
            $(this).addClass('btn-info').removeClass('btn-default').blur();
        });

        $('.next-step, .prev-step').on('click', function (e) {
            var $activeTab = $('.tab-pane.active');

            $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

            if ($(e.target).hasClass('next-step')) {
                var nextTab = $activeTab.next('.tab-pane').attr('id');
                $('[href="#' + nextTab + '"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#' + nextTab + '"]').tab('show');
            } else {
                var prevTab = $activeTab.prev('.tab-pane').attr('id');
                $('[href="#' + prevTab + '"]').addClass('btn-info').removeClass('btn-default');
                $('[href="#' + prevTab + '"]').tab('show');
            }
        });
    });

    function projectDashboardSearch() {

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var project_id = $("#project_id").val();
        if ((start_date != "") && (end_date != "")) {

            $.ajax({
                type: "POST",
                url: "<?php echo site_url();?>/Project/get_project_summary_xhr",
                data: {start_date: start_date, end_date: end_date, project_id: project_id},
                dataType: "json",
                success: function (jsonData) {

                    $("#planned_amount").html(jsonData.project_planned_amount);
                    $("#released_amount").html(jsonData.project_released_amount);
                    $("#pending_amount").html(jsonData.project_pending_amount);

                }
            });
        } else {
            alert("Please Select Start & End Date!");
        }

    }

    $(document).ready(function () {

        var work_item_id = $("#work_item_id").val();
        //alert(work_item_id);
        var project_id = $("#project_id").val();
        physicalProjectPerformance(work_item_id, project_id);

        $("#container_line_chart_physical").hide();

        $('#work_item_type').val();
        var work_item_type_id = this.value;
         //var work_item_type_id = $("#work_item_id").val();
        var project_id = $("#project_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/Project/get_project_work_item_xhr",
            data: {work_item_type_id: work_item_type_id, project_id: project_id, start_date: start_date, end_date: end_date},
            //dataType: "json",
            success: function (data) {
               // alert(data);
                $("#accordion_2").html(data);

            }
        });

    });

    $('#work_item_type').on('change', function () {
        //alert( this.value );
        var work_item_type_id = this.value;
        var project_id = $("#project_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/Project/get_project_work_item_xhr",
            data: {
                work_item_type_id: work_item_type_id,
                project_id: project_id,
                start_date: start_date,
                end_date: end_date
            },
            //dataType: "json",
            success: function (data) {

                $("#accordion_2").html(data);
                return false;
            }
        });
    })
    $('#work_item_id').on('change', function () {

        var work_item_id = $("#work_item_id").val();
        var project_id = $("#project_id").val();
        //alert(work_item_id + "--"+ project_id);
        $("#bar_container").show();
        $("#container_line_chart_physical").hide();
        activtyDropDown(work_item_id);
        physicalProjectPerformance(work_item_id, project_id);
    });
    $('#activity_id').on('change', function () {
        $("#bar_container").hide();
        $("#container_line_chart_physical").show();
        project_physical_performance();

    });




    function physicalProjectPerformance(work_item_id, project_id) {
        //alert(work_item_id + "--"+ project_id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/Project/get_physical_project_performance",
            data: {work_item_id: work_item_id, project_id: project_id},
            dataType: "json",
            success: function (data) {


                var chart = {
                    type: 'column'
                };
                var title = {
                    text: 'Project Performance'
                };
                var xAxis = {
                    categories: data.categories
                };
                var yAxis = {
                    min: 0,
                    title: {
                        text: 'Target/Achievement'
                    },
                    stackLabels: {
                        enabled: true,
                        formatter: function () {
                            return [, this.total, '%'].join('');
                        },
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                };
                var legend = {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,

                    backgroundColor: (
                        Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                };


                var tooltip = {



                    formatter: function () {
                        var abcStr = data.complete;
                        var datacomp = (data.complete);
                        var index = this.point.index;
                        var achieve = abcStr[index];

                        var tooltip = '<b>' + this.x + '</b><br/>';

                        tooltip += '<br><span style="color:' + this.series.color + '">' + '<b>Target </b>' + '</span>: ';

                        tooltip += this.point.stackTotal + '(%) <br><span style="color:' + this.series.color + '"><br><b>Achieved:</b> ' + achieve + '(%)';

                        return tooltip;
                    }


                };

                var plotOptions = {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            format: '{y} %',
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                                || 'white',
                            style: {
                                textShadow: '0 0 3px black'
                            }
                        }
                    }
                };
                var credits = {
                    enabled: false
                };
                var series = [
                    {
                        color: 'blue',
                        name: 'Target',
                        data: data.left,

                        tooltip: {
                            valueSuffix: ' %'
                        }
                    },
                    {
                        color: 'green',
                        name: 'Achieved',
                        data: data.complete,

                        tooltip: {
                            valueSuffix: ' %'
                        }
                    }
                ];

                var json = {};
                json.chart = chart;
                json.title = title;
                json.xAxis = xAxis;
                json.yAxis = yAxis;
                json.legend = legend;
                json.tooltip = tooltip;
                json.plotOptions = plotOptions;
                json.credits = credits;
                json.series = series;
                $('#bar_container').highcharts(json);

            }

        });
    }

    function activtyDropDown(work_item_id) {

        var project_id = $("#project_id").val();
        if (activity_id) {

            $.ajax({
                url: "<?php echo site_url();?>/Project/get_activity_dropdown",
                method: "POST",
                dataType: 'json',
                data: {work_item_id: work_item_id, project_id: project_id},
                success: function (data) {

                    $('#activity_id').html(data);

                }
            });
        }
    }

    function getUnitname(project_id, activity_id) {

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/project/get_unit_name",
            data: {project_id: project_id, activity_id: activity_id},
            success: function (jsonData) {
                $("#unit_name").val(jsonData);
            }
        });
    }

    function project_physical_performance() {

        var start_date = $("#start_date").val() ||$("#act_start_dt").val();
        var end_date = $("#end_date").val() ||  $("#act_end_dt").val();
        var project_id = $("#project_id").val();
        var activity_id = $("#activity_id").val();
        var work_item_id = $("#work_item_id").val();

        var project_performance_category_array = [];
        var project_performance_planned_array = [];
        var project_performance_released_array = [];
        if (activity_id > 0) {

            getUnitname(project_id, activity_id);
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url();?>/project/get_project_activity_performance_xhr",
                data: {start_date: start_date, end_date: end_date, project_id: project_id, activity_id: activity_id,work_item_id: work_item_id},
                dataType: "json",
                success: function (jsonData) {

                    $.each(jsonData, function (key, value) {

                        project_performance_category_array.push(value.month_date);
                        project_performance_planned_array.push(value.planned);
                        project_performance_released_array.push(value.released);
                        console.log(project_performance_category_array);
                    });
                    var unit_name = $("#unit_name").val();
                    Highcharts.chart('container_line_chart_physical', {
                        title: {
                            text: ''
                        },
                        subtitle: {
                            text: ''
                        },
                        yAxis: {
                            title: {
                                text: ''
                            }
                        },
                        xAxis: {
                            //categories: ['Dec 17', 'Jan 18', 'Feb 18', 'Mar 18', 'Apr 18']
                            categories: project_performance_category_array
                        },
                        yAxis: {
                            title: {
                                text: unit_name /*'Amount (INR)'*/
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        plotOptions: {
                            series: {
                                label: {
                                    connectorAllowed: false
                                }
                            }
                        },
                        colors: [
                            'green',
                            'orange'
                        ],
                        series: [{
                            name: 'Planned',
                            //data: [0, 25, 50, 75, 85]
                            data: project_performance_planned_array
                        }, {
                            name: 'Achived',
                            //data: [0, 17, 39, 65, 81]
                            data: project_performance_released_array
                        }],
                        credits: {
                            enabled: false
                        },
                        responsive: {
                            rules: [{
                                condition: {
                                    //maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }

                    });

                }
            });
        } else {
            $("#bar_container").show()
            $("#container_line_chart_physical").hide()
            var work_item_id = $("#work_item_id").val();
            var project_id = $("#project_id").val();
            physicalProjectPerformance(work_item_id, project_id);
        }

    }


</script>
<!-- For vendor -->

<script type="text/javascript">
    
    var chart = {
                           type: 'column'
                        };
                        var title = {
                           text: ''  
                        };
                        var subtitle = {
                           text: '' 
                        };
                        var xAxis = {
                         categories: <?php echo $vendor; ?>,
                         crosshair: true
                        };
                        var yAxis = {
                           min: 0,
                           title: {
                              text: 'Amount (₹)'        
                           }     
                        };
                        var tooltip = {
                           headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
                           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}'+'(&#8377;)'+': </td>' +
                              '<td style = "padding:0"><b>{point.y:.1f} </b></td></tr>',
                           footerFormat: '</table>',
                           shared: true,
                           useHTML: true
                        };
                        var plotOptions = {
                           column: {
                              pointPadding: 0.2,
                              borderWidth: 0
                           }
                        }; 
                        var credits = {
                           enabled: false
                        };
                        var series= [
                           {
                              name: 'Invoice Claimed',
                              data: <?php echo $claimed; ?>
                           },
                           {
                              name: 'Invoice Released',
                              data: <?php echo $released; ?>
                           }
                        ];
                        var json = {};  
                        json.chart = chart;
                        json.title = title;  
                        json.subtitle = subtitle;
                        json.tooltip = tooltip;
                        json.xAxis = xAxis;
                        json.yAxis = yAxis; 
                        json.series = series;
                        json.plotOptions = plotOptions; 
                        json.credits = credits;
                        $('#vendor').highcharts(json);
               
</script>

<script type="text/javascript">
    //alert('<?php //echo $financial_claimedTilldate; ?>');
    Highcharts.chart('financial', {
  chart: {
    type: 'line'
  },
  title: {
    text: ''
  },
  xAxis: {
    categories: <?php echo $financial_period_data; ?>
  },
  yAxis: {
    title: {
      text: 'Amount (₹)'
    }
  },
  tooltip:  {
           headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}'+'(&#8377;)'+': </td>' +
              '<td style = "padding:0"><b>{point.y:.1f} </b></td></tr>',
           footerFormat: '</table>',
           shared: true,
           useHTML: true
        },
  plotOptions: {
    line: {
      dataLabels: {
        enabled: true
      }
    }
  },
  series: [{
          name: 'Claimed',
          data: <?php echo $financial_claimedTilldate; ?>
       },
       {
           name: 'Released',
          data: <?php echo $financial_releasedtTilldate; ?>
       }]
});
</script>

   