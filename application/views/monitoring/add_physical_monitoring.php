<?php 
    $CI =& get_instance();
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    //echo "<pre>"; print_r($project_deatail); die;
?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>Physical Monitoring Activity Wise </h4>
                </div>
            </div>
            <!-- Basic Examples -->
            <?php echo form_open('Monitoring/add_physical_monitoring',array('name'=> 'add_project_work_item','id'=>'add_project_work_item_form')); ?>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <tbody>
                                            <tr>
                                                <td>Project Name: </td>
                                                <td>
                                                    <?php
                                                    echo $project_deatail[0]['project_name'];
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Work Item: </td>
                                                <td>
                                                    <?php
                                                    $work_item_name= $CI->work_item($project_work_item_id);
                                                    echo $work_item_name[0]['work_item_description'];
                                                    ?>
                                                    <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
                                                    <input type="hidden" id="work_item_id" name="work_item_id" value="<?php echo $project_work_item_id; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Select Activity<span style="color: red;">*</span>: </td>
                                                <td>
                                                    <select class="form-control show-tick" name="activity_id" id="activity_id">
                                                        <option value="">Select Activity</option>
                                                        <?php
                                                        if(!empty($project_activity_detail)){
                                                          foreach($project_activity_detail as 
                                                            $activity_detail){
                                                        ?>
                                                            <option value="<?php echo $activity_detail['project_activity_id']?>"><?php echo $activity_detail['particulars']?></option>
                                                        <?php  
                                                          }
                                                        }else{
                                                        ?>
                                                            <option value="">No planned activity found</option> 
                                                        <?php    
                                                        }
                                                        ?>
                                                    
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Start Date : </td>
                                                <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
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

                        <div id="activity_extra_data"></div>                                
                                                        
                        <div id="activity_details_error" class="m-t-10 m-b-10"></div>
                    
                        <div id="activity_details"></div>

                    </div>
                </div>
            </form>
            <!-- #END# Basic Examples -->
        </div>
    </section>

    <script>
        $("#activity_id").change(function(){
            var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var work_item_id=$('#work_item_id').val();          
            if(activity_id > 0){
                $("#activity_details").html('<p>Processing...</p>');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>Monitoring/get_physical_acitivity_plan_xhr",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id
                        },
                    dataType: "json",
                    success: function (msg) {
                        console.log(msg.html);
                        $("#activity_details").html(msg.html);
                        $("#activity_extra_data").html(msg.html_additional_data);
                        $("#activity_details_error").html('');
                    }
                });
            }else{
                $("#activity_details").html('');    
            }
             
        });


        $("#add_project_work_item_form").on("submit", function(e){
            var activityBudgetQuantity = $("#activityTargetQuantity").val();
            var totalQuantity = 0.00;
            console.log("activityBudgetQuantity: "+activityBudgetQuantity);
            $('#activity_details').find('input[type=text]').each(function(index, element) {
                console.log("element: "+element.value);
                totalQuantity = totalQuantity + parseFloat(element.value);
                //alert('totalQuantity: '+totalQuantity);
            })
            console.log("totalQuantity: "+totalQuantity);
            if(parseFloat(totalQuantity) > parseFloat(activityBudgetQuantity)){
                alert('Activity Budget Quantity Exceeded!');
                $("#activity_details_error").html('<p style="color:red;"><strong>Activity Budget Quantity Exceeded!</strong></p>');
                e.preventDefault(); //return false;
            }else{
                $("#activity_details_error").html('');
                //alert('form submit');    
            }
            //alert('End of Checking');
            // e.preventDefault();
            // return false;
        })

        //$('ul #activity_list:first-child').next().attr('title')
    </script>