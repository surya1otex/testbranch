<?php
$start    = new DateTime($project_deatail[0]['project_start_date']);
//$start->modify('first day of this month');
$end      = new DateTime($project_deatail[0]['project_end_date']);
//$end->modify('first day of next month');
$interval = DateInterval::createFromDateString('+7 days');
$period   = new DatePeriod($start, $interval, $end);

?>

<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
    <thead>
    <tr>
        <th style="padding: 10px 5px; width: 40px">Sl No</th>
        <th style="padding: 10px 5px; width: 350px">Weeks
        </th>
        <th style="padding: 10px 5px; width: 150px">Target
        </th>

    </tr>
    </thead>

    <tbody>
    <?php
    $i=1;$j=0;$sum = 0;
    foreach ($period as $dt) { ?>
        <tr>
            <td><?php echo $i;?></td>
            <td>
                <?php
                if ($ajax_request) {
                    $a = $project_physical_planning_detail[$j]['month_date'];
                }else {
                    $a = $dt->format("Y-m-d");
                } ?>
                <?php echo "Week -".$i." (" .$a . " - " .date('Y-m-d', strtotime($a. ' + 6 days')).")"?>
                <input type="hidden" class="form-control" placeholder="Cost" name="week[]" value="<?php echo $dt->format("Y-m-d");?>"/>
                <input type="hidden" name="physical_planning_detail_id[]" value="<?php if(!empty($project_physical_planning_detail[$j]['id'])){echo $project_physical_planning_detail[$j]['id'];}else{echo "";};?>">
            </td>
            <td>
                <?php if($ajax_request){ ?>
                    <?php $sum = $sum + $project_physical_planning_detail[$j]['target_quantity']; ?>
                    <?php if(!empty($project_physical_planning_detail[$j]['target_quantity'])){echo $project_physical_planning_detail[$j]['target_quantity'];}else{echo "";};?>
                <?php } else { ?>
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