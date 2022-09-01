<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Tree Cutting </h2>
        </div>  

        <?php
if(!empty($tree_cutting_data)){

       


        $forest_div_data = $CI->get_specific_data_against_value('forest_division_master','id',$tree_cutting_data[0]['forest_division_id'],'division_name');

        ?>
   <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <tbody>
            <tr>
                <td width=310px;><i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. of trees to be cut </td>
                <td><?php echo $tree_cutting_data[0]['noof_trees_tobe_cut']; ?></td>
                <td  width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Forest Division  </td>
                <td><?php echo $forest_div_data; ?></td>
            </tr>

            <tr>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> OFDC Division </td>
                <td></td>
                
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date</td>
                <td><?php echo $tree_cutting_data[0]['target_end_date']; ?></td>
            </tr>    

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date</td>
                <td><?php echo $tree_cutting_data[0]['target_end_date']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Join verification done ?  </td>
                <td>  <?php echo $tree_cutting_data[0]['status_joint_verification']; ?></td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Enumeration done ?</td>
                <td>  <?php echo $tree_cutting_data[0]['status_enumeration']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Cutting permission obtained  ?</td>
                <td> <?php echo $tree_cutting_data[0]['status_cutting_permission']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund for tree cutting placed ?  </td>
                <td>  <?php echo $tree_cutting_data[0]['status_fund_for_tree_cutting']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tender awarded ? </td>
                <td> <?php echo $tree_cutting_data[0]['status_tender_awarded']; ?></td>
            </tr>

            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> No. of trees cut </td>
                <td>  <?php echo $tree_cutting_data[0]['progress_noof_trees_cut']; ?></td>
                <td> <i class="material-icons" style="position: relative; margin:5px"> ₹ </i> Amount Utilized </td>
                <td> <?php echo number_format($tree_cutting_data[0]['progress_amount_utilised'],2); ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Progress %  </td>
                <td>  <?php echo $tree_cutting_data[0]['progress_%']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> % of pre-construction fund Utilized  </td>
                <td> <?php echo $tree_cutting_data[0]['progress_fund_utilised']; ?></td>
            </tr>
            <tr> 
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Tree cutting required A / A Done   </td>
                <td>  <?php echo $tree_cutting_data[0]['progress_tree_cutting_required_for_aa_done']; ?></td>
                <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                <td> <?php echo $tree_cutting_data[0]['remarks']; ?></td>
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
            if(!empty($tree_cutting_data_location_data)){
        foreach ($tree_cutting_data_location_data as $land_location) {
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