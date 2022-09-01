<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>Project Monitoring List</h4>

                </div>
            </div>
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive" style="overflow-x: unset;">
                                <table id="financial_monitoring_list" class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="2%" style="text-align: center; vertical-align: middle;">Sl No</th>
                                            <th style="text-align: center; vertical-align: middle;">Project Name</th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;">Category </th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;">Location</th>
                                            <th style="text-align: center; vertical-align: middle;" width="5%"> <span class="ntip p-l-5"> SV<span class="ntiptext">Earned Value - Planned Value</span></span></th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;"> <span class="ntip p-l-5"> SPI<span class="ntiptext">Earned Value / Planned Value</span></span></th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;"> <span class="ntip p-l-5"> CV<span class="ntiptext">Earned Value - Actual Cost</span></span></th>
                                            <th width="5%" style="text-align: center; vertical-align: middle;"> <span class="ntip p-l-5">CPI <span class="ntiptext">Earned Value / Actual Cost</span></span></th>
                                            
                                            <!-- <th width="18%" style="text-align: center; vertical-align: middle;">Financial Progress</th> -->
                                            
                                            <th width="22%" style="text-align: center; vertical-align: middle;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                               
                                                $project_area= $CI->project_area($pro_dtl['location_id']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);
                                                $project_financial_progress_details_ar = $CI->project_financial_progress_details($pro_dtl['id']);
                                                $project_financial_progress_percentage = $project_financial_progress_details_ar['project_financial_completion_percentage'];
                                                if(!is_numeric){
                                                    $project_financial_progress_percentage = 0.00;
                                                }

                                        $project_total_data = $CI->get_project_total_data($pro_dtl['id']);

                                         $Planned_Value = $project_total_data[0]['Planned_Value'];
                                         $Earned_Value = $project_total_data[0]['Earned_Value'];
                                         $Paid_Value = $project_total_data[0]['Paid_Value'];

                                         $agreement_cost = $pro_dtl['agreement_cost'];
                                         if(empty($Planned_Value)){
                                            $Planned_Value = 0.00;
                                         }
                                         if(empty($Earned_Value)){
                                            $Earned_Value = 0.00;
                                         }
                                         if(empty($Paid_Value)){
                                            $Paid_Value = 0.00;
                                         }

                                          if($Planned_Value > 0.00){
                                            $PV =  ($Planned_Value ) / $agreement_cost;
                                        }else{
                                            $PV = 0.00;
                                        }

                                        if($Earned_Value > 0.00){
                                            $EV =  ($Earned_Value ) / $agreement_cost;
                                        }else{
                                            $EV = 0.00;
                                        }

                                        if($Paid_Value > 0.00){
                                           $AC =  ($Paid_Value ) / $agreement_cost;
                                        }else{
                                            $AC = 0.00;
                                        }




                                       

                                         $SV = $EV - $PV;
                                         if($PV > 0.00){
                                          $SPI = $EV / $PV;    
                                      }else{
                                        $SPI = 0.00;
                                      }
                                          
                                          
                                             
                                         $CV = $EV - $AC;
                                         if($AC != 0){
                                         $CPI = $EV / $AC;

                                        }else{
                                            $CPI = 0.00;
                                        }
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                            
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a>
                                            
                                            
                                            </td>
                                            <td><?php echo $project_type[0]['project_type']?></td>
                                            <td><?php echo $project_area[0]['name']?></td>
                                            <td><?php echo round($SV,2); ?></td>
                                            <td><?php echo round($SPI,2); ?></td>
                                            <td><?php echo round($CV,2); ?></td>
                                            <td><?php echo round($CPI,2); ?></td>

                                            <!-- <td>
                                                <span style="font-size:10px;"><strong>0%</strong></span>   <span style="float:right; font-size:10px;"><strong>100%</strong></span>     
                                                <div class="progress" style="background-color: blanchedalmond;" title="<?php //echo $project_financial_progress_percentage; ?>% Completed">
                                                    <div class="progress-bar bg-green" role="progressbar"  aria-valuenow="<?php //echo $project_financial_progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo $project_financial_progress_percentage; ?>%"></div>
                                                </div> 
                                            </td> -->
                                             

                                            <td>
                                                <a href="<?php echo base_url();?>Monitoring/financial_listing?project_id=<?php echo base64_encode($pro_dtl['id']);?>&project_work_item_id=<?php echo base64_encode($work_item_deatail['work_item_id']); ?>" class="btn btn-warning waves-effect" title="Financial Monitoring"><i class="fas fa-tasks"></i> Progress Update</a>
                                                
                                            </td>
                                        </tr>
                                      <?php $i++;}}else{?>
                                                <tr><td colspan="7">No data found</td></tr>
                                      <?php } ?>
                                        
                                        
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


<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#financial_monitoring_list').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>


