<?php
$start    = new DateTime($project_deatail[0]['project_start_date']);
$start->modify('first day of this month');
$end      = new DateTime($project_deatail[0]['project_end_date']);
$end->modify('first day of next month');
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);
?>

<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
    <thead>
    <tr>
        <th style="padding: 10px 5px; width: 40px">Sl No</th>
        <th style="padding: 10px 5px; width: 350px">Months
        </th>
        <th style="padding: 10px 5px; width: 150px">Target
        </th>

    </tr>
    </thead>

    <tbody>
    <?php
    //echo "<pre>"; print_r($project_physical_planning_detail);
    $i=1;$j=0;$sum = 0;
    foreach ($period as $dt) { ?>
        <tr>
            <td><?php echo $i;?></td>
            <td>

                <?php
                //echo "<pre>"; print_r($project_physical_planning_detail);
                if( $ajax_request) {

                    echo $project_physical_planning_detail[$j]['month_name'];
                    //echo $dt->format("M Y");
                }else{
                    echo $dt->format("M Y");
                }
                    ?>
                <input type="hidden" class="form-control" placeholder="Cost" name="month[]" value="<?php echo $dt->format("M Y");?>"/>
                <input type="hidden" name="physical_planning_detail_id[]" value="<?php if(!empty($project_physical_planning_detail[$j]['id'])){echo $project_physical_planning_detail[$j]['id'];}else{echo "";};?>">
            </td>
            <td>
                <?php if( $ajax_request){
                    $sum = $sum + $project_physical_planning_detail[$j]['target_quantity'];
                    if(!empty($project_physical_planning_detail[$j]['target_quantity'])){echo $project_physical_planning_detail[$j]['target_quantity'];}else{echo "";};?>
                <?php }else{ ?>
                    <input type="text" class="form-control" onkeypress="allowNumbersOnly1(event)" placeholder="Quantity" name="target[]" value="<?php if(!empty($project_physical_planning_detail[$j]['target_quantity'])){echo $project_physical_planning_detail[$j]['target_quantity'];}else{echo "";};?>" />
                <?php } ?>
            </td>

        </tr>
        <?php $j++;$i++;} ?>
    <?php if($ajax_request){ ?>

        <tr><td colspan="2" style="text-align: left;"><b>Total Quantity :</b></td><td style="text-align: left;">  <?php echo number_format($sum, 2) . ' ' . $quantity_name[0]['unit_name'] ?> </td></tr>;
    <?php } ?>
    </tbody>
</table>
<script>
    function allowNumbersOnly1(e) {

        var code = (e.which) ? e.which : e.keyCode;

        if (code > 31 && (code < 48 || code > 57) && code != 46) {
            e.preventDefault();
        }

    }
</script>