
          <div class="body">
         <div style="width:100%; margin:15px 15px; text-align:left;">Dear  <?php echo $to_email_name; ?>,</div>
         <div style="width:100%; margin:15px 15px; text-align:left;">Following projects are delayed. Please login to the Dashboard to view Details</div>
            <div style="margin:0 15px;">
                <table style="width:100%; border: 1px solid black; border-collapse:collapse">
                    <thead>
                        <tr>
                            <th rowspan="2" style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Sl No.</th>
                            <th rowspan="2" style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Project Name</th>
                            <th rowspan="2" style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Location</th>
                            <th colspan="3" style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Till Date</th>
                          </tr>
                          <tr>
                            <th style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Planned Value (Rs.)</th>
                            <th style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Earned Value (Rs.)</th>
                            <th style="text-align:center; border: 1px solid black; padding:10px; background-color:#ccc;">Performance Variance</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					 $i = 1;
                                        if(is_array($project_delayed_deatail)){
                                            foreach($project_delayed_deatail as $delayed){
                                        $Variance = round((100 - (($delayed->Earned_Value * 100 ) / $delayed->Planned_Value)),2);
                                        ?>
                        <tr>
                           
                            <td style="border: 1px solid black; text-align:center; padding:10px;"> <?php echo $i; ?></td>
                            <td style="border: 1px solid black; padding:10px;"> <?php echo $delayed->project_name; ?> </td>
                            <td style="border: 1px solid black; padding:10px;"> <?php echo $delayed->area_name; ?> </td>
                            <td style="border: 1px solid black; padding:10px; text-align:right;"> <?php echo $delayed->Planned_Value; ?> </td>
                            <td style="border: 1px solid black; padding:10px; text-align:right;"> <?php echo $delayed->Earned_Value; ?> </td>
                            <td style="border: 1px solid black; padding:10px; text-align:center;"> <?php echo $Variance; ?>% </td>
                        </tr>
                          <?php $i++; } } ?>
                    </tbody>
                </table>
                </div>
                
                <div style="width:100%; margin:15px 15px; text-align:center;">
                  <a href="<?php echo base_url(); ?>?type=<?php echo base64_encode("delayed"); ?>" target="_blank" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius:10px 20px;" type="button"> View Details </a>



                     <div class="clearfix"></div>
                </div>
                
            </div>
            
            <div style=" margin:40px 15px 5px 15px; text-align:left;">Best regards,</div>
<div style=" margin:5px 15px; text-align:left;"><strong>Project Monitoring Dashboard</strong></div>
<div style=" margin:5px 15px; text-align:left;">Odisha Bridge & Construction Corporation Limited</div>