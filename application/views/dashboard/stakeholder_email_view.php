<?php

?>
          <div class="body">
         <div style="width:100%; margin:15px 15px; text-align:left;">Dear <?php echo $to_email_name; ?>,</div>
 <div style="width:100%; margin:15px 15px; text-align:left;">Project Monitoring Dashboard - Clarification Required</div>
    <div style="margin:0 15px;">
        <table style="width:100%; border: 1px solid black; border-collapse:collapse">
            <tbody>
                <tr>
                    <td style="background-color: #D5DDE1; text-align:center; border: 1px solid black; padding:10px; font-weight: bold;">Project Name :</td>
                    <td style="border: 1px solid black; padding:10px;"> <?php echo $project_deatail[0]['project_name'];?></td>
                </tr>
                <tr>
                    <td style="background-color: #D5DDE1; text-align:center; border: 1px solid black; padding:10px; font-weight: bold;">Location :</td>
                    <td style="border: 1px solid black; padding:10px;"> <?php echo !empty($project_deatail[0]['area_name']) ? $project_deatail[0]['area_name']: "--"?> </td>
                </tr>
                <tr>
                    <td style="background-color: #D5DDE1; text-align:center; border: 1px solid black; padding:10px; font-weight: bold;"> Catagory :</td>
                    <td style="border: 1px solid black; padding:10px;"> <?php echo !empty($project_deatail[0]['project_type']) ? $project_deatail[0]['project_type'] : "--"?> </td>
                </tr>
            </tbody>
        </table>
        
        <br clear="all">
        
        <table style="width:100%; border: 1px solid black; border-collapse:collapse">
            <thead>
                <tr>
                    <th style="background-color: #D5DDE1; text-align:left; border: 1px solid black; padding:10px;">Message From : <?php echo $sender_details[0]['firstname'].' '.$sender_details[0]['lastname'].' ('.$sender_details[0]['designation'].')'; ?></th>
                  </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black; padding:10px;"> <?php echo $text_message; ?> </td>
                </tr>
            </tbody>
        </table>
        </div>

        <div style="width:100%; margin:15px 15px; text-align:center;">
            <a href="<?php echo base_url().'?type='.base64_encode('userNotification'); ?>" target="_blank" style="background-color: #4C8AAF; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius:10px 20px;" type="button"> Replay </a>

             <div class="clearfix"></div>
        </div>

                
            </div>
            
            <div style=" margin:40px 15px 5px 15px; text-align:left;">Best regards,</div>
<div style=" margin:5px 15px; text-align:left;"><strong>Project Monitoring Dashboard</strong></div>
<div style=" margin:5px 15px; text-align:left;">Odisha Bridge & Construction Corporation Limited</div>