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
                    <h4>Financial Monitoring Activity Wise </h4>
                </div>
            </div>
            <!-- Basic Examples -->
            <?php echo form_open('Monitoring/add_financial_monitoring',array('name'=> 'add_project_work_item','id'=>'add_project_work_item_form')); ?>
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
                                                <td>Stage: </td>
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
                                                        foreach($project_activity_detail as 
                                                            $activity_detail){
                                                        ?>
                                                            <option value="<?php echo $activity_detail['project_activity_id']?>"><?php echo $activity_detail['particulars']?></option>
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
                    
                        <div id="activity_extra_data">
                        </div>                                
                                                        

                        <div id="activity_details_error" class="m-t-10 m-b-10"></div>
                        <div id="activity_details">                                
                            <!-- <div class="card">
                                <div class="body ">
                                    <div class="table-responsive">
                                        <?php
                                                $start    = new DateTime($project_aggrement_deatail[0]['project_start_date']);
                                                $start->modify('first day of this month');
                                                $end      = new DateTime($project_aggrement_deatail[0]['project_end_date']);
                                                $end->modify('first day of next month');
                                                $interval = DateInterval::createFromDateString('1 month');
                                                $period   = new DatePeriod($start, $interval, $end);
                                        ?>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th style="padding: 10px 5px; width: 40px">Sl No</th>
                                                    <th style="padding: 10px 5px; width: 200px">Months</th>
                                                    <th style="padding: 10px 5px; width: 150px">Target</th>
                                                    <th style="padding: 10px 5px; width: 150px">Allotted</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                    
                                        
                                        <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                                <input type="submit" name="submit" value="ADD" class="btn bg-indigo waves-effect" />
                                                <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                        </div>
                                    </div>                                
                                </div>
                            </div> -->
                        </div>
                        

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
                    url: "<?php echo base_url();?>Monitoring/get_financial_acitivity_plan_xhr",
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
                        check_total();
                    }
                });
            }else{
                $("#activity_details").html('');    
            }
             
        });

          $("#add_project_work_item_form").on("submit", function(e){
            
            var ReleasedTotalAmount = 0.00;
            var total_activity_earned_amount = $("#total_activity_earned_amount").val();
            $('#activity_details').find('.amount_key').each(function(index, element) {
                ReleasedTotalAmount +=parseFloat(element.value);
            })
            if(parseFloat(ReleasedTotalAmount) > parseFloat(total_activity_earned_amount)){
                alert('Released Amount Exceeded!');
                $("#activity_details_error").html('<p style="color:red;"><strong>Released Amount Exceeded!</strong></p>');
                e.preventDefault(); //return false;
            }else{
                $("#activity_details_error").html('');
                //alert('form submit');
                
            }
            //e.preventDefault();
            //return false;
        })
    </script>


    <script type="text/javascript">
        function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
    </script>


     <script type="text/javascript">

              $(document.body).on("keyup",".weightage_key",function(){
                //alert('hi');
                var weightageKeyId = this.id;
                var weightageVal = this.value;
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#amountKey_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });

             
                $(document.body).on("keyup",".amount_key",function(){
                    //alert('hi');
                var amountKeyId = this.id;
                var amountVal = this.value;
                
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                // alert(id);
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    //alert(calamtData);
                    $("#weightage_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });



                function check_total(){
            var releasedTotalAmount = 0.00;
            var activityBudgetAmount = $("#activityBudgetAmount").val();
            $('#activity_details').find('.amount_key').each(function(index, element) {
                releasedTotalAmount +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#releasedTotalAmount").html(releasedTotalAmount.toFixed(2));
            })
            var releasedTotalPercent = 0.00;
            $('#activity_details').find('.weightage_key').each(function(index, element) {
                releasedTotalPercent +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#releasedTotalPercent").html(releasedTotalPercent.toFixed(2));
            })


        }
          </script>