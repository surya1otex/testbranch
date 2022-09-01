<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>MIS-DASHBOARD</h4>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bg-light-grey">
                        <div class="body p-10">
                            <div class="section_clone">  
                                <div class="row clearfix">
                                    <div class="col-lg-69 col-md-6 col-sm-4 col-xs-12 m-b-0">
                                        <div class="col-md-2 p-r-0 m-b-0">
                                            <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                             Type :
                                            </label>
                                        </div>

                                        <div class="col-md-4 m-b-0">
                                            <select class="form-control show-tick" id="project_category_id">
                                                <option value="0">Default all</option>
                                                <?php foreach ($project_category as $key => $val ){?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['project_type']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                               
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 m-b-0 pull-right">         
                                        <div class="col-md-2 p-r-0 m-b-0">
                                            <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Area :
                                            </label>
                                        </div>

                                        <div class="col-md-4 p-l-0 m-b-0">
                                            <select class="form-control show-tick" id="project_area_id">
                                                <option value="0">Default All</option>
                                                <?php foreach ($project_area as $key => $val ){?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>    
                
            <div id="dash_area">

                <div class="row clearfix">    

                    <!-- Project Summary --> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header"><h2>Project Summary</h2></div>
                            <div class="body">
                                <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="info-box bg-pink hover-expand-effect">
                                        <div class="icon">
                                        <i class="fas fa-cog"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">District Projects</div>
                                            <div class="number count-to" data-from="0" data-to="<?php echo $total_pro_poor_project[0]['total_pro_poor_project']; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    
                                        <div class="info-box bg-cyan hover-expand-effect">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <a href="#"><div class="text">State Projects </div></a>
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_state_project[0]['total_state_project']; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="info-box bg-light-green hover-expand-effect">
                                        <div class="icon">
                                            <i class="fas fa-wrench"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">Total Training</div>
                                            <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="1"></div>
                                        </div>
                                    </div>
                                </div>
                                </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-orange hover-expand-effect m-b-0">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Project Amt. (&#8377; <?php echo ucfirst($all_project_budget_suffix); ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo ucfirst($all_project_budget_number); ?>" data-speed="1000" data-fresh-interval="5"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-deep-purple hover-expand-effect m-b-10">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Disbursement Amt. (&#8377; <?php echo ucfirst($all_project_released_suffix); ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo ucfirst($all_project_released_number); ?>" data-speed="1000" data-fresh-interval="10"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-brown hover-expand-effect m-b-10">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"> </i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Pending Amt. (&#8377; <?php echo ucfirst($all_project_pending_suffix); ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo ucfirst($all_project_pending_number); ?>" data-speed="1000" data-fresh-interval="4"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                                    
                        </div>
                        </div>
                    </div>
                    <!-- #END# Project Summary --> 

                    <!-- Financial Progress --> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <?php if( $finalcial_module_permission ){ ?>
                                <h2>Financial Progress (last 6 months)</h2>
                                <?php } else{?>
                                    <h2>Physical Progress (last 6 months)</h2>
                                <?php }?>
                            </div>
                            <div class="body">
                                <div id="line_chart" class="graph" style="height: 290px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Financial Progress --> 
                    
                </div>
                <!-- #END# Widgets -->

                <?php if( $finalcial_module_permission ){ ?>
                <!-- Work Items -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Work Items - Budget & Released</h2>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Work Items -->
                <?php } ?>
                <!-- Work Items -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Work Items - Planned & Progress</h2>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Work Items -->


                <!-- Project Progress -->
                <div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Project Progress</h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-hover dashboard-task-infos">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th width="400">Project Name</th>
                                                <th width="150">Start Date</th>
                                                <th width="150">End Date</th>

                                                <th width="150">Project Progress</th>
                                                <?php if($finalcial_module_permission) { ?>
                                                <th width="120">Budget</th>
                                                <th width="120">Amount Released</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody id="project_details_section">
                                        <?php
                                            if(!empty($project_details_ar)){
                                                foreach ($project_details_ar as $key => $value) {
                                                    $project_id = $value['project_id'];
                                                    $project_name = $value['project_name'];
                                                    $budget = $value['budget'];
                                                    $start_date = date_create($value['start_date']);
                                                    $start_date = date_format($start_date,"F d Y");
                                                    /*$start_date = date('M, Y', strtotime($value['start_date']));*/
                                                    $end_date = date_create($value['end_date']);
                                                    $end_date = date_format($end_date,"F d Y");
                                                    $released = $value['released'];  
                                                    $project_completion_percentage = $value['project_completion_percentage']; 
                                                    $sl = $key+1;                                                                                     
                                        ?>
                                                    <tr>
                                                        <td><?php echo $sl; ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url();?>Project/porject_dashboard?project_id=<?php echo base64_encode($project_id);?>">
                                                                <?php echo $project_name; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $start_date; ?></td>
                                                        <td><?php echo $end_date; ?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-green" role="progressbar" title="<?php echo $project_completion_percentage; ?>% Completed" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_completion_percentage; ?>%"></div>
                                                            </div>
                                                        </td>
                                                        <?php if($finalcial_module_permission){ ?>
                                                            <td><i class="fas fa-rupee-sign "><?php echo $budget; ?></i></td>
                                                                <td><i class="fas fa-rupee-sign"><?php echo $released; ?></i></td>
                                                        <?php } ?>
                                                    </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Task Info -->
                </div>
                <!-- #END Project Progress -->

            </div>                            

            <!-- <div class="row clearfix">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><h2>BOQ Monitoring - Progress Status</h2></div>
                        <div class="body">
                            <div id="container_pie_boq_monitoring" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header"><h2>Project Implementation Status</h2></div> 
                        <div class="body">
                                <div id="container_pie_project_impl_status" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div> -->
          

            <!-- Indicator Wise Monthly Monitoring -->
            <!-- <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Indicator Wise Monthly Monitoring</h2>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 m-t-10">         
                        <div class="col-md-12">
                          <select class="form-control show-tick">
                            <option value="">Select Indicator</option>
                            <option value="10">No of men and women in project destinations (5) consulated on project activities in the reporting month  </option>
                         </select>
                        </div>
                       </div>
                        
                        <div class="body">
                            <div id="container_combo_graph_indicator" style="min-width: 310px; height: 390px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- #END# Indicator Wise Monthly Monitoring -->

        </div>
    </section>