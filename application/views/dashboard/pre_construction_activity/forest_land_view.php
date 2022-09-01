<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Forest Land  </h2>
        </div>

        <?php
if(!empty($forest_land_data)){

        


        $forest_div_data = $CI->get_specific_data_against_value('forest_division_master','id',$forest_land_data[0]['forest_division_id'],'division_name');

        ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Total Area to be Diverted</td>
                <td><?php echo $forest_land_data[0]['total_area_tobe_diverted']; ?></td>
                <td  width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Forest Division  </td>
                <td><?php echo $forest_div_data; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund allotted</td>
                <td><?php echo $forest_land_data[0]['fund_alloted']; ?></td>
                
               <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date</td>
                <td><?php echo $forest_land_data[0]['target_end_date']; ?></td>
            </tr>    

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Online application submitted ?  </td>
                <td>  <?php echo $forest_land_data[0]['status_application_submited']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> FCP uploaded online ?</td>
                <td>  <?php echo $forest_land_data[0]['status_fcp_uploaded']; ?></td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> State govt. Recommendation obtained  ?</td>
                <td> <?php echo $forest_land_data[0]['status_state_govt_recomend']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Gol approval obtained ?  </td>
                <td>  <?php echo $forest_land_data[0]['status_goi_approval']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Parmission issued ? </td>
                <td> <?php echo $forest_land_data[0]['status_permission_issued']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land cleared so far </td>
                <td>  </td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Progress %  </td>
                <td>  <?php echo $forest_land_data[0]['progress_%']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Land Required for A/A purchased  </td>
                <td>  <?php echo $forest_land_data[0]['progress_land_required_for_cleared_aa']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative; margin:5px"> ₹ </i> Amount Utilized </td>
                <td> <?php echo number_format($forest_land_data[0]['progress_amount_utilised'],2); ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> % of pre-construction fund Utilized  </td>
                <td> <?php echo $forest_land_data[0]['progress_fund_utilised']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right </i> Remarks  </td>
                <td>  <?php echo $forest_land_data[0]['remarks']; ?></td>
                <td>&nbsp;   </td>
                <td>&nbsp;   </td>
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
            if(!empty($forest_land_data_location_data)){
        foreach ($forest_land_data_location_data as $land_location) {
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