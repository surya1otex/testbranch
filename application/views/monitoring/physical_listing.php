<?php 
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
  $CI =& get_instance();
  //echo "<pre>"; print_r($project_work_item_detail); die();  
?>
<section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
            <div class="block-header">
              <h4>Physical Monitoring</h4>
            </div>
          </div>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                    <div class="body">
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <tbody>
                                        <tr>
                                            <td>Project Name : </td>
                                            <td><?php echo $project_deatail[0]['project_name'];?></td>
                                        </tr>
                                        <?php 
                                          $project_area= $CI->project_area($project_deatail[0]
                                            ['project_area']);
                                          $project_type= $CI->project_type($project_deatail[0]
                                            ['project_type']);

                                        ?>
                                        <tr>
                                            <td>Area : </td>
                                            <td><?php echo $project_area[0]['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Type : </td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Cost : </td>
                                            <td><?php echo number_format($project_deatail[0]['estimate_total_cost'],2);?> INR</td>
                                        </tr>
                                        <tr>
                                            <td>Start Date : </td>
                                            <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>End Date : </td>
                                            <td><?php $end_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $end_date->format('jS M Y'); ?></td>
                                        </tr>
                            </tbody>
                          </table>
                
                        </div>
            </div>
          </div>    
          <?php
            //$work_item_name= $CI->work_item($financial_deatail['project_work_item_id']);
            //echo "<pre>"; print_r($project_work_item_detail);
          ?>
          <div class="block-header">
           <h4>Physical Monitoring for Work Items</h4>
          </div>
          <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th style="text-align: center;" width="5%">#</th>
                              <th style="text-align: center;" width="30%">Work Items</th>
                              <!-- <th style="text-align: center;">Budget Quantity</th> -->
                              <th style="text-align: center;">Planned Quantity</th>
                              <th style="text-align: center;">Achieved Quantity</th>
                              <th style="text-align: center;">Monitor Physical Progress</th>
                          </tr>
                      </thead>
                      <tbody>
                              <?php if(!empty($project_work_item_detail)){
                                  $i=1;
                                  foreach($project_work_item_detail as $key => $work_item_detail){
                                    $project_id=$work_item_detail['project_id'];
                                    $work_item_name= $CI->work_item($work_item_detail['work_item_id']);
                                    $physical_target=$CI->work_item_physical_target($project_id,$work_item_detail['work_item_id']);
                              ?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
                                          <?php echo $work_item_name[0]['work_item_description'];?>
                                        </td>

                                        <!-- <td align="center">
                                          <?php
                                            if(!empty($physical_target)){
                                              $k=1;
                                              foreach($physical_target as $target){
                                                $unit_name=$CI->get_unit($target['unit_id']);

                                                echo $k.") ".$target['target']." ".$unit_name[0]['unit_name'].'<br>';
                                                $k++;
                                              }
                                              
                                            }else{
                                              echo "--";
                                            }
                                          ?>
                                        </td> -->

                                        <td align="center">
                                          <?php
                                            if(!empty($physical_target)){
                                              $k=1;
                                              foreach($physical_target as $target){
                                                $unit_name=$CI->get_unit($target['unit_id']);

                                                echo $k.") ".$target['target']." ".$unit_name[0]['unit_name'].'<br>';
                                                $k++;
                                              }
                                              
                                            }else{
                                              echo "--";
                                            }
                                          ?>
                                        </td>

                                        <td align="center">
                                          <?php
                                            if(!empty($physical_target)){
                                              $k=1;
                                              foreach($physical_target as $target_achieved){
                                                $unit_name=$CI->get_unit($target_achieved['unit_id']);
                                                //echo "<pre>"; print_r($target_achieved); echo "</pre>";
                                                //echo "Achieved Qty: ".$target_achieved['achieved']."<br>";                                              

                                                if(!empty($target_achieved['achieved'])){
                                                  if(trim($target_achieved['achieved']) != '0.00'){
                                                    echo $k.") ".$target_achieved['achieved']." ".$unit_name[0]['unit_name'].'<br>';
                                                    $k++;
                                                  }
                                                  
                                                }else{
                                                  echo "--<br>";  
                                                }                                                
                                              }
                                              
                                            }else{
                                              echo "--";
                                            }
                                          ?>
                                        </td>
                                        
                                        <td>
                                          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">MONITOR</button> -->
                                          <a href="<?php echo base_url();?>Monitoring/add_physical_monitoring?project_id=<?php echo base64_encode($work_item_detail['project_id']);?>&project_work_item_id=<?php echo base64_encode($work_item_detail['work_item_id']); ?>" class="btn btn-warning waves-effect" style="text-align:center" title=""><i class="fas fa-eye"></i> UPDATE PROGRESS</a>

                                          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="get_activity_details('<?php echo $project_id; ?>','<?php echo $project_work_item_id; ?>','<?php echo $project_activity_id; ?>','<?php echo $work_activity_name[0]['particulars']; ?>')">View Details</button> -->
                                        </td>

                                      </tr>
                                    <?php 
                                            $i++;
                                          }
                                    ?>
                                    
                                    <?php }else{?> 
                                      <tr>
                                        <td colspan="4">No Data Found</td>
                                      </tr>
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function get_activity_details(project_id,work_item_id,activity_id,activity_name){      
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>project/get_activity_month_details", 
          data: {project_id: project_id,work_item_id: work_item_id,activity_id:activity_id,activity_name:activity_name},
          success: function(data) {
            $('.modal-body').html(data);
          }
        });
        
      }
    
    </script>

