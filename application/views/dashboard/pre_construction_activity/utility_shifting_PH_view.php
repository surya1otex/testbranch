<?php $CI =& get_instance();?>
<div class="card">
    <div class="header">
        <h2> Utility Shifting ( PH ) </h2>
    </div>

            <?php
if(!empty($utility_shifting_PH_data)){


        

        ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=300px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of pipeline to be shifted </td>
                <td><?php echo $utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_lhs']; ?></td>
                
            
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of pipeline to be shifted </td>
                <td><?php echo $utility_shifting_PH_data[0]['length_of_pipeline_tobe_shifted_rhs']; ?></td>
                
            </tr>    
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <td><?php echo $utility_shifting_PH_data[0]['target_end_date']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PH division  </td>
                <td>  </td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint verification done ?  </td>
                <td>  <?php echo $utility_shifting_PH_data[0]['status_joint_verification']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund for utility shifting placed ? </td>
                <td><?php echo $utility_shifting_PH_data[0]['status_fund_for_utility_shifting']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender awarded ? </td>
                <td>  <?php echo $utility_shifting_PH_data[0]['status_tender_awarded']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of line to be shifted</td>
                <td> <?php echo $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_lhs']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Length of line to be shifted </td>
                <td>  <?php echo $utility_shifting_PH_data[0]['progress_length_of_line_tobe_shifted_rhs']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <td><?php echo $utility_shifting_PH_data[0]['progress_%']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
                <td> <?php echo number_format($utility_shifting_PH_data[0]['progress_amount_utilised'],2); ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <td> <?php echo $utility_shifting_PH_data[0]['progress_fund_utilised']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> PH/RHS utility shifting for A / A done ?   </td>
                <td> <?php echo $utility_shifting_PH_data[0]['progress_ph_utility_shifting']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <td> <?php echo $utility_shifting_PH_data[0]['remarks']; ?></td>
            </tr>

            </tbody>
        </table>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> District </th>
                <th> ULBs </th>
            </thead>
            <tbody>
                <?php
            if(!empty($utility_shifting_PH_location_data)){
        foreach ($utility_shifting_PH_location_data as $land_location) {
            $ulbdata = $land_location['ulb_id'];
            $ulbs ='';
            if($ulbdata == '0'){
                $ulbs ='All ULBs';
            }else{
            if(!empty($ulb_arr)){
                foreach ($ulb_arr as $ulb) {
                   $ulbs .= $CI->get_specific_data_against_value('ulb_master','id',$ulb,'ulb_name').',';
                }
                }
            }

            
            ?>
            <tr>
                <td><?php echo $land_location['district_name']; ?></td>
                <td><?php echo rtrim($ulbs,','); ?></td>
                
            </tr>
        <?php } } ?>
            </tbody>
        </table>
</div>

    <?php 
}else{
echo 'No data availbale!!';
    
}
?>
</div>