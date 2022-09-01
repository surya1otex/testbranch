<?php $CI =& get_instance();
  $CI->load->model('Physical_progress_model');
  //echo json_encode($activitiesData);
  ?>
<div class="table-responsive m-b-30">
                             <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Sl No </th>
                                        <th>Activity Name</th>
                                        <th>Total Target</th>
                                        <th>Target Till Date</th>
                                        <th>Achived Till Date</th>
                                        <th>Achived</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; 
                                    if(is_array($activitiesData)){
                                        foreach ($activitiesData as $key) {

                                    $get_till_target = $CI->get_activity_till_target($key->main_id);

                                    if(!empty($key->total_activity_allotted_quantity)){ 
                                        $activity_allotted_quantity =  $key->total_activity_allotted_quantity; }else{
                                         $activity_allotted_quantity = 0.00;
                                     }
                                    
                                    $remain = $key->total_activity_quantity - $activity_allotted_quantity;
                                    

                                     if($remain != 0){
                                    ?>
                                    <tr>
                                        <input type="hidden" name="activity_id[]" value="<?php echo $key->project_activity_id; ?>">
                                        <!-- <input type="hidden" name="activity_weightage[<?php //echo $key->project_activity_id; ?>][]" value="<?php //echo $key->weightage; ?>"> -->
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $key->particulars; ?></td>
                                        <td><?php echo $key->total_activity_quantity.' '.$key->unit_name; ?></td>
                                        <td><?php echo $get_till_target[0]['target_quantity'].' '.$key->unit_name; ?></td>
                                        <td><?php echo $activity_allotted_quantity.' '.$key->unit_name; ?></td>
                                        
                                        <td>
                                            <div class="">
                                            <div class="col-md-6">
                                                <input type="text" id="activity_weightage_<?php echo $key->project_activity_id; ?>" name="activity_weightage[<?php echo $key->project_activity_id; ?>][]"  class="form-control" onkeypress="allowNumbersOnly(event,this.id)" onKeyUp="edValueKeyPress(event,this.id)">
                                                <span style="color:#ff0000" id="error_activity_weightage_<?php echo $key->project_activity_id; ?>"></span>
                                                <input type="hidden" id="remain_activity_weightage_<?php echo $key->project_activity_id; ?>" value="<?php echo $remain; ?>">
                                            </div>
                                            <div class="col-md-6 p-0 text-left col-green">
                                            <b>/ <?php echo $remain; ?>
                                            <?php echo $key->unit_name; ?></b>
                                        </div>
                                        </td>
                                    </tr>
                                <?php $i++;  } } }else{ ?>
                                    <tr>
                                        <td colspan="6">No data available</td>
                                    </tr>

                               <?php  } ?>
                                </tbody>
                              </table>   
                           </div>