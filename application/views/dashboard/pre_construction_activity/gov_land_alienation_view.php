<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Government Land Alienation  </h2>
        </div>
<?php 
if(!empty($gov_land_alienation_data)){

?>


        
    <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                <tr>
                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Total Area to be alienated  </td>
                    <td><?php echo $gov_land_alienation_data[0]['total_land']; ?></td>
                    <td  width=310px> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Departments that own the land </td>
                    <td><?php echo $gov_land_alienation_data[0]['department_id']; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date </td>
                    <td><?php echo $gov_land_alienation_data[0]['target_end_date']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Alienation proposed to tahsildar</td>
                    <td><?php echo $gov_land_alienation_data[0]['status_alienation_proposed']; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Relinquishment proposal submitted </td>
                    <td><?php echo $gov_land_alienation_data[0]['status_relinquishment_proposal']; ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land alienated so far </td>
                    <td><?php echo $gov_land_alienation_data[0]['progress_land_alienated']; ?></td>
                </tr>
                <tr>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
                    <td><?php echo $gov_land_alienation_data[0]['progress_%']; ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Required for A/A alienated </td>
                    <td><?php echo $gov_land_alienation_data[0]['progress_land_required_aa']; ?></td>
                </tr> 
                <tr>
                    <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                    <td><?php echo number_format($gov_land_alienation_data[0]['progress_amount_utilised'],2); ?></td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                    <td><?php echo $gov_land_alienation_data[0]['progress_fund_utilised']; ?></td>
                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
                    <td> <?php echo $gov_land_alienation_data[0]['remarks']; ?></td>
                    <td>&nbsp;  </td>
                    <td>&nbsp;  </td>
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
            if(!empty($gov_land_alienation_location_data)){
        foreach ($gov_land_alienation_location_data as $land_location) {
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
    <?php }else {
        echo 'No data availbale!!';
    } ?>
</div>