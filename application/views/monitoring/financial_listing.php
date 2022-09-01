<?php 
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);
  $CI =& get_instance();
  //echo "<pre>"; print_r($project_work_item_detail); //die();  
?>
<section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
            <div class="block-header">
              <h4>Project Monitoring</h4>
            </div>
          </div>
          <!-- <div class="col-md-6">
            <a href="<?php echo base_url(); ?>project/add_financial_planning?project_id=<?php echo $_REQUEST['project_id'];?>&project_work_item_id=<?php echo base64_encode($project_work_item_id); ?>"  class="btn bg-indigo waves-effect pull-right">
              <i class="fas fa-plus"></i>
              <span>CREATE FINANCIAL PLAN</span>
            </a>
          </div> -->
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
                                          <td>Location : </td>
                                          <td><?php echo $project_progress_location[0]['area_name'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Type : </td>
                                            <td><?php echo $project_type[0]['project_type'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Project Cost : </td>
                                            <td><?php echo number_format($project_aggrement_deatail[0]['agreement_cost'],2);?>  <i class="fa fa-rupee-sign"></i></td>
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

          <div class="row clearfix">
                
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                           
                            <div class="header">
                             <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" ><h2>Project Stages With Activities</h2>
                             </div>
                             <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" > <label for="email_address_2">Choose a Category :</label>
                             </div>
                             <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
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
                           
                              <div style='clear:both'></div>

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
          </div>
          <!-- Alert Message -->
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('message')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('message'); ?>
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
          <div class="block-header">
           <h4>Project Progress Monitoring</h4>
          </div>
          <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                      <thead>
                          <tr>
                              <th style="text-align: center;">Sl No</th>
                              <th style="text-align: center;">Stage</th>
                              <th style="text-align: center;" width="12%">PV (<i class="fa fa-rupee-sign"></i>)</th>
                              <th style="text-align: center;" width="12%">PV</th>

                              
                              <th style="text-align: center;" width="12%"> EV (<i class="fa fa-rupee-sign"></i>)</th>
                              <th style="text-align: center;" width="12%">EV</th>
                              <th style="text-align: center;" width="12%">AC (<i class="fa fa-rupee-sign"></i>)</th>
                              <th style="text-align: center;" width="12%">AC</th>
                              <th style="text-align: center;" width="35%">Monitor Project Progress</th>
                          </tr>
                      </thead>
                      <tbody>
                              <?php if(!empty($project_work_item_detail)){
                                  $i=1;
                                  $sum_budget=0;
                                  $sum_planned=0;
                                  $sum_achieved=0;
                                  $sum_planned_percent = 0;
                                  $sum_earned_percent = 0;
                                  $sum_released_percent = 0;
                                  foreach($project_work_item_detail as $key => $work_item_detail){
                                    $work_item_name= $CI->work_item($work_item_detail['work_item_id']);

                                    $work_item_financial_details_ar = $CI->work_item_financial_details($work_item_detail['project_id'], $work_item_detail['work_item_id']);
                                    
                                    
                                    $project_id=$work_item_detail['project_id'];
                                    $project_work_item_budget_amount=$work_item_detail['amount'];
                                    
                                    $sum_achieved=$sum_achieved+$work_item_financial_details_ar[0]['total_achieved_amount'];
                                    /* Chnages on 30-07-2021 */
                                    $budget_amount = $CI->get_work_item_budget_amount($work_item_detail['project_id'], $work_item_detail['work_item_id']);
                                    $achieved_amount = $CI->get_work_item_earned_amount($work_item_detail['project_id'], $work_item_detail['work_item_id']);
                                    $sum_budget=$sum_budget+$budget_amount;

                                    $sum_planned=$sum_planned+$achieved_amount;

                                    $agreement_cost = $project_aggrement_deatail[0]['agreement_cost'];

                                    $planned_percent = ($budget_amount/$agreement_cost);
                                    $sum_planned_percent = $sum_planned_percent + $planned_percent;

                                    $earned_percent = ($achieved_amount/$agreement_cost);
                                    $sum_earned_percent = $sum_earned_percent + $earned_percent;

                                    $released_percent = ($work_item_financial_details_ar[0]['total_achieved_amount']/$agreement_cost);
                                    $sum_released_percent = $sum_released_percent + $released_percent;
                              ?>
                                      <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
                                          <?php echo $work_item_name[0]['work_item_description'];?>
                                        </td>
                                        <td align="right">
                                          
                                            <?php echo number_format($budget_amount,2);?>
                                           
                                        </td>
                                        <td align="right">
                                          <span class="ntip">
                                          <?php echo number_format($planned_percent,2);?>
                                             <span class="ntiptext"> <?php echo $planned_percent; ?></span>
                                          </span>
                                        </td>
                                        <td align="right">
                                          <?php echo number_format($achieved_amount,2);?>
                                        </td>
                                        <td align="right">
                                          <span class="ntip">
                                          <?php echo number_format($earned_percent,2);?>
                                          <span class="ntiptext"> <?php echo $earned_percent; ?></span>
                                          </span>
                                        </td>
                                        <td align="right">
                                          <?php echo number_format($work_item_financial_details_ar[0]['total_achieved_amount'],2);?>
                                        </td>

                                        <td align="right">
                                          <span class="ntip">
                                          <?php echo number_format($released_percent,2);?>
                                          <span class="ntiptext"> <?php echo $released_percent; ?></span>
                                          </span>
                                        </td>
                                        


                                        <td>
                                          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">MONITOR</button> -->
                                          <a href="<?php echo base_url();?>Monitoring/earned_financial_progress?project_id=<?php echo base64_encode($work_item_detail['project_id']);?>&project_work_item_id=<?php echo base64_encode($work_item_detail['work_item_id']); ?>" class="btn btn-warning waves-effect" style="text-align:center" title=""><i class="fas fa-eye"></i> EARNED</a>

                                          <a href="<?php echo base_url();?>Monitoring/add_financial_monitoring?project_id=<?php echo base64_encode($work_item_detail['project_id']);?>&project_work_item_id=<?php echo base64_encode($work_item_detail['work_item_id']); ?>" class="btn btn-success waves-effect" style="text-align:center" title=""><i class="fas fa-eye"></i> ACTUAL</a>
                                        </td>

                                      </tr>
                                    <?php 
                                            $i++;
                                      }
                                    ?>
                                    
                                        <tr>
                                            <td></td>
                                            <td><strong>Total : </strong></td>
                                            <td align="right"><b><?php echo number_format($sum_budget,2);?></b></td>
                                            <td align="right"><b><span class="ntip"><?php echo number_format($sum_planned_percent,2);?><span class="ntiptext"> <?php echo $sum_planned_percent; ?></span>
                                          </span></b></td>
                                            <td align="right"><b><?php echo number_format($sum_planned,2);?></b>
                                            </td>
                                            <td align="right"><b><span class="ntip"><?php echo number_format($sum_earned_percent,2);?><span class="ntiptext"> <?php echo $sum_earned_percent; ?></span>
                                          </span></b></td>
                                            <td align="right"><b><?php echo number_format($sum_achieved,2);?></b></td>
                                            <td align="right"><b><span class="ntip"><?php echo number_format($sum_released_percent,2);?><span class="ntiptext"> <?php echo $sum_released_percent; ?></span>
                                          </span></b></td>
                                            <td></td>
                                        </tr>


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


    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>

<script type="text/javascript">





    $(document).ready(function () {

        var work_item_id = $("#work_item_id").val();
        //alert(work_item_id);
        var project_id = <?php echo $project_id; ?>;
        //physicalProjectPerformance(work_item_id, project_id);

       // $("#container_line_chart_physical").hide();

       // $('#work_item_type').val();
       // var work_item_type_id = this.value;
         var work_item_type_id = $("#work_item_type").val();
    var project_id = <?php echo $project_id; ?>;
       // var start_date = $("#start_date").val();
       // var end_date = $("#end_date").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Monitoring/get_project_work_item_activity_table",
            data: {work_item_type_id: work_item_type_id, project_id: project_id},
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
        //var project_id = $("#project_id").val();
    
    var project_id = <?php echo $project_id; ?>;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>Monitoring/get_project_work_item_activity_table",
            data: {
                work_item_type_id: work_item_type_id,
                project_id: project_id
            },
            //dataType: "json",
            success: function (data) {

                $("#accordion_2").html(data);
                return false;
            }
        });
    })

    </script>

