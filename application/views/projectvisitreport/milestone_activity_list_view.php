<?php $CI =& get_instance();
  $CI->load->model('Physical_progress_model');
  ?>
<div class="table-responsive m-b-30">
                             <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>Sl No </th>
                                        <th>Activity Name</th>
                                        <th>End Date</th>
                                        <th>Weightage</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1; 
                                    if(is_array($activitiesData)){
                                        foreach ($activitiesData as $key) {
                                    /*check if insert or not */

                                    $chk_status = $CI->Physical_progress_model->get_activites_completed_or_not($project_id,$milestone_id,$key->id);

                                    $end_Date = date('M d Y', strtotime($key->end_date));

                                     
                                    ?>
                                    <tr>
                                        <input type="hidden" name="activity_id[]" value="<?php echo $key->id; ?>">
                                        <input type="hidden" name="activity_weightage[<?php echo $key->id; ?>][]" value="<?php echo $key->weightage; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $key->particulars; ?></td>
                                        <td><?php echo $end_Date; ?></td>
                                        <td><?php echo $key->weightage; ?>%</td>
                                        <td>
                                            <?php
                                            if($chk_status == 'Y'){
                                            ?>
                                            <span class="label label-success">Completed</span>
                                        <?php }else{ ?>
                                           <div class="demo-switch">
                                                <div class="switch" style="min-width:auto">
                                                    <label><input type="checkbox" name="activity_status[<?php echo $key->id; ?>][]" value="1"><span class="lever"></span></label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                <?php $i++;  } }else{ ?>
                                    <tr>
                                        <td colspan="5">No data available</td>
                                    </tr>

                               <?php  } ?>
                                </tbody>
                              </table>   
                           </div>