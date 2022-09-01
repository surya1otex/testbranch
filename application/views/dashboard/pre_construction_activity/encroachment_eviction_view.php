 <?php $CI =& get_instance();?>
 <div class="card">
        <div class="header">
            <h2> Encroachment Eviction  </h2>
        </div>

                    <?php
if(!empty($encroachment_eviction_data)){


        ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Area under Encroachment </td>
                <td><?php echo $encroachment_eviction_data[0]['total_area']; ?></td>
                <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Type of Encroachment </td>
                <td><?php echo $encroachment_eviction_data[0]['types_of_encroachment']; ?></td>
            </tr>
            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target End Date</td>
                <td><?php echo $encroachment_eviction_data[0]['target_end_date']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Joint verification done ?  </td>
                <td> <?php echo $encroachment_eviction_data[0]['status_joint_verification']; ?>  </td>
            </tr>    
            
            <tr>
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Formal requisition filed ? </td>
                <td><?php echo $encroachment_eviction_data[0]['status_formal_requisition']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment eviction programme fixed ? </td>
                <td>  <?php echo $encroachment_eviction_data[0]['status_encroachment_eviction']; ?></td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment notice filed </td>
                <td> <?php echo $encroachment_eviction_data[0]['status_encroachment_notice']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment area evicted so far </td>
                <td>  <?php echo $encroachment_eviction_data[0]['progress_encroachment_area']; ?></td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <td> <?php echo $encroachment_eviction_data[0]['progress_%']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enroachment eviction for A / A done ?   </td>
                <td> <?php echo $encroachment_eviction_data[0]['progress_enroachment_area_aa']; ?> </td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative; margin:0 5px"> ₹ </i> Amount Utilized </td>
                <td> <?php echo number_format($encroachment_eviction_data[0]['progress_amount_utilised'],2); ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <td> <?php echo $encroachment_eviction_data[0]['progress_fund_utilised']; ?> </td>
            </tr>
            <tr> 
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <td> <?php echo $encroachment_eviction_data[0]['remarks']; ?></td>
                <td></td>
                <td></td>
            </tr>
            

            </tbody>
        </table>
    </div>
 <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
            <thead>
               <th> District </th>
                <th> Tehsils </th>
                <th> ULBs  </th> 
            </thead>
            <tbody>
                <?php
            if(!empty($encroachment_eviction_location_data)){
        foreach ($encroachment_eviction_location_data as $land_location) {
            $tahsilsdata = $land_location['tahsils_id'];
            $ulbdata = $land_location['ulb_id'];

            $tahsils_arr = explode(',', $tahsilsdata);
            $ulb_arr = explode(',', $ulbdata);
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
                <td><?php echo rtrim($tahsils,','); ?></td>
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