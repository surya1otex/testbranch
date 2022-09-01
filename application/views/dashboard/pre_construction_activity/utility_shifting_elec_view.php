<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Utility Shifting ( Electrical ) </h2>
        </div> 


        <?php
if(!empty($utility_shifting_elec_data)){



        

        ?>
   <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=300px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Poles to be Shifted </td>
                <td><?php echo $utility_shifting_elec_data[0]['poles_tobe_shifted']; ?></td>
                <td width=300px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> New lines to be installed </td>
                <td><?php echo $utility_shifting_elec_data[0]['new_lines_tobe_installed']; ?></td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <td><?php echo $utility_shifting_elec_data[0]['target_end_date']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Electrical Division Name </td>
                <td></td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint verification done ?  </td>
                <td>  <?php echo $utility_shifting_elec_data[0]['status_joint_verification']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Approval fund received ? </td>
                <td><?php echo $utility_shifting_elec_data[0]['status_approval_fund_received']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> New line charged ? </td>
                <td>  <?php echo $utility_shifting_elec_data[0]['status_new_line_charged']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender awarded ?</td>
                <td> <?php echo $utility_shifting_elec_data[0]['status_tender_awarded']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. of poles shifted </td>
                <td>  <?php echo $utility_shifting_elec_data[0]['progress_noof_poles_shifted']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <td> <?php echo $utility_shifting_elec_data[0]['progress_%']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Electrical utility shifting for A / A done ?   </td>
                <td> <?php echo $utility_shifting_elec_data[0]['progress_electrical_utility_shifting']; ?> </td>
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
                <td>  <?php echo number_format($utility_shifting_elec_data[0]['progress_amount_utilised'],2); ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <td> <?php echo $utility_shifting_elec_data[0]['progress_fund_utilised']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <td><?php echo $utility_shifting_elec_data[0]['remarks']; ?></td>
            </tr>

            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> District </th>
                <th> Tehsils </th>
            </thead>
            <tbody>
                <?php
            if(!empty($utility_shifting_elec_location_data)){
        foreach ($utility_shifting_elec_location_data as $land_location) {
            $tahsilsdata = $land_location['tahsils_id'];

            $tahsils_arr = explode(',', $tahsilsdata);
            
            $tahsils ='';
            if($tahsilsdata == '0'){
               $tahsils ='All Tehsils'; 
            }else{
            if(!empty($tahsils_arr)){
                foreach ($tahsils_arr as $tah) {
                   $tahsils .= $CI->get_tahasils_name($tah).',';
                }
                }

            }

            
            ?>
            <tr>
                <td><?php echo $land_location['district_name']; ?></td>
                <td><?php echo rtrim($tahsils,','); ?></td>
                
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