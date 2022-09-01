<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Private Land ( Direct Purchase ) </h2>
        </div>  
    <?php 
if(!empty($private_land_dp_data)){

?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Total Area to be Purchased  </td>
                <td><?php echo $private_land_dp_data[0]['total_area']; ?></td>
                <td width=310px><i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Estimate cost of purchase  </td>
                <td><?php echo number_format($private_land_dp_data[0]['estimated_cost'],2); ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> General category land </td>
                <td> <?php echo $private_land_dp_data[0]['general_cat_land']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> SC Land  </td>
                <td><?php echo $private_land_dp_data[0]['sc_land']; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> ST land </td>
                <td><?php echo $private_land_dp_data[0]['st_land']; ?></td>
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date </td>
                <td><?php echo $private_land_dp_data[0]['target_end_date']; ?> </td>
            </tr> 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Bilateral Negotiation conducted ?</td>
                <td><?php echo $private_land_dp_data[0]['status_negotiation_conducted']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> DCAC Metting held ? </td>
                <td><?php echo $private_land_dp_data[0]['status_dcac_meeting_held']; ?></td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> A / A funds approved ?</td>
                <td><?php echo $private_land_dp_data[0]['status_aa_funds_approved']; ?> </td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land registration done ? </td>
                <td><?php echo $private_land_dp_data[0]['status_land_registration']; ?></td>
            </tr>

             <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land possesed so far </td>
                <td></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %</td>
                <td><?php echo $private_land_dp_data[0]['progress_%']; ?></td>
            </tr> 

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Land Required for A/A purchased </td>
                <td><?php echo $private_land_dp_data[0]['progress_land_required_aa']; ?></td>
                <td> <i class="material-icons" style="position: relative; margin:5px">₹</i> Amount Utilized (₹)</td>
                <td><?php echo number_format($private_land_dp_data[0]['progress_amount_utilised'],2); ?></td>
            </tr> 

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <td>  <?php echo $private_land_dp_data[0]['progress_fund_utilised']; ?></td>
                 <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks  </td>
                <td> <?php echo $private_land_dp_data[0]['remarks']; ?></td>
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
            if(!empty($private_land_dp_data_location_data)){
        foreach ($private_land_dp_data_location_data as $land_location) {
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