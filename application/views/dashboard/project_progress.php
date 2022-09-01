<?php $CI =& get_instance();?>


<div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Ongoing Project Progress</h2>
                            </div>
                            <div class="body table-responsive">
                                <div class="">
								<?php
								//echo "<pre>";
								//print_r($project_details_ar);
								
								?>
                                    <table <?php echo !empty($project_details_ar) ? 'id="orgproject_progress"' : ''; ?>  style="table-layout: fixed; width: 100%;" class="table table-hover dashboard-task-infos" id="prog">
                                        <thead>
                                                <tr>
                                                <th width="200">Project Name</th>
                                                <th width="100">Category</th>
                                                <th width="150">Project Owner</th>
                                                <th width="100">Start Date</th>
                                                <th width="180">Scheduled End Date</th>
                                                <th width="180">SV</th>
                                                <th width="180">SPI</th>
                                                <th width="180">CV</th>
                                                <th width="180">CPI</th>
                                                <th width="180">Progress(Till Date)</th>
                                                <th width="100">Planned Cost (<i class="fas fa-rupee-sign ">)</th>
                                                <th width="100">Amount Released (<i class="fas fa-rupee-sign ">)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!empty($project_details_ar)){
												
												
                                                foreach ($project_details_ar as $key => $value) {
                                                    $project_id = $value['project_id'];
                                                    $project_name = $value['project_name'];
                                                    //$budget = $value['budgetamnt'];
                                                    $budget = $value['budgetamnt'];
                                                    $category = $value['category'];
                                                    $approving_authority = $value['approving_authority'];
                                                    $project_progress = $value['project_progress'];
                                                    $start_date = date_create($value['start_date']);
                                                    $start_date = date_format($start_date,"F d Y");
                                                    /*$start_date = date('M, Y', strtotime($value['start_date']));*/
                                                    $end_date = date_create($value['end_date']);
                                                    $end_date = date_format($end_date,"F d Y");
                                                    $released = $value['released'];  
                                                   // $project_completion_percentage = $value['project_physical_completion_percentage'];
                                                    $project_completion_percentage = $value['project_completion_percentage'];  
                                                    //$project_completion_percentage = "40"; 
                                                    $sl = $key+1;

                                                    $project_total_data = $CI->get_project_total_data($project_id);
                                                    $project_total_cst = $value['agreement_cost'];


													$total_Planned_Value = $project_total_data[0]['Planned_Value'];
                                                     $total_Earned_Value = $project_total_data[0]['Earned_Value'];
                                                     $total_Paid_Value = $project_total_data[0]['Paid_Value'];

                                                     if(empty($total_Planned_Value)){
                                                        $total_Planned_Value = 0.00; 
                                                     }

                                                     if(empty($total_Earned_Value)){
                                                        $total_Earned_Value = 0.00; 
                                                     }

                                                     if(empty($total_Paid_Value)){
                                                        $total_Paid_Value = 0.00; 
                                                     }



                                                     if($total_Planned_Value > 0.00){
                                                       $total_PV =  ($total_Planned_Value) / $project_total_cst; 
                                                   }else{
                                                    $total_PV = 0.00;
                                                   }


                                                   if($total_Earned_Value > 0.00){
                                                       $total_EV =  ($total_Earned_Value  ) / $project_total_cst; 
                                                   }else{
                                                    $total_EV = 0.00;
                                                   }

                                                   if($total_Paid_Value > 0.00){
                                                       $total_AC =  ($total_Paid_Value ) / $project_total_cst;
                                                   }else{
                                                    $total_AC = 0.00;
                                                   }
                                                     
                                                    
                                                     
                                                     
                                                     $total_SV = $total_EV - $total_PV;
                                                     
                                                     if($total_PV > 0.00){
                                                          $total_SPI = $total_EV / $total_PV;   
                                                      }else{
                                                        $total_SPI = 0.00;
                                                      }
                                                     $total_CV = $total_EV - $total_AC;
                                                     
                                                     if($total_AC != 0){
                                                     $total_CPI = $total_EV / $total_AC;
                                                     }else{
                                                        $total_CPI = 0.00;
                                                     }
													
													                                                                                     
                                        ?>
                                                    <tr>
                                                        <td width="300px">
                                                           
                                                             <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project_id); ?>">
                                            <span class="ntip"> <?php echo $project_name; ?><span class="ntiptext">Click to view the project dashboard</span>
                                        </span></a>
                                                        </td>
														
                                                        <td><?php echo $category; ?></td>
                                                        <td><?php echo $approving_authority; ?></td>
                                                        <td><?php echo $start_date; ?></td>
                                                        <td><?php echo $end_date; ?></td>
                                                        <td><?php echo round($total_SV,2); ?></td>
                                                        <td><?php echo round($total_SPI,2); ?></td>
                                                        <td><?php echo round($total_CV,2); ?></td>
                                                        <td><?php echo round($total_CPI,2); ?></td>
                                                        <!--<td> <span style="display:block" class="ntip">
                                                            <div class="progress">
                                                                <div class="progress-bar bg-green" role="progressbar" title="<?php echo $project_progress; ?>% Completed" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_progress; ?>%"></div>
                                                            </div><?php if(!empty ($project_progress)){ ?><span class="ntiptext"><?php echo $project_progress; ?>% Completed</span> <?php } ?>
                                        </span>
                                                        </td>-->
                                                        
                                                        <td> <span style="display:block" class="ntip">
                                                            <div class="progress">
                                                                <div class="progress-bar bg-green" role="progressbar" title="<?php echo $project_completion_percentage; ?>% Completed" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project_completion_percentage; ?>%"></div>
                                                            </div><?php if(!empty ($project_completion_percentage)){ ?><span class="ntiptext"><?php echo $project_completion_percentage; ?>% Completed</span> <?php } ?>
                                                            </span>
                                                        </td>
                                                        <td><?php echo $budget; ?></i></td>
                                                        <td><?php echo $released; ?></i></td>
                                                       
                                                    </tr>
                                        <?php
                                                }
                                            } else {
                                        ?>
                                        <tr> <td colspan="5">No Record Found!</td></tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Task Info -->
                </div>
                
<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
			
            $('#orgproject_progress').DataTable({
			responsive: true
			});
         
        })
</script>