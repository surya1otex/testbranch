<?php
$start = new DateTime($project_deatail[0]['project_start_date']);
$end = new DateTime($project_deatail[0]['project_end_date']);
$interval = DateInterval::createFromDateString('+7 days');
$period = new DatePeriod($start, $interval, $end);

?>
<!--js-basic-example dataTable-->
<table class="table table-bordered table-striped table-hover" id="yourtableid">
    <thead>
    <tr>
        <th style="padding: 10px 5px; width: 40px">Sl No</th>
        <th style="padding: 10px 5px; width: 350px">Date</th>
        <th style="padding: 10px 5px; width: 150px">Target</th>
        <th style="padding: 10px 5px; width: 150px">Action</th>

    </tr>
    </thead>

    <tbody id="custom_container">
    <?php
    if (count($custom_monitoring_details) > 0) {
        $i = 1;
        $j = 0;
        $sum = 0;
        foreach ($custom_monitoring_details as $val) { ?>
            <tr id="tr_<?php echo $i; ?>">
                <td><?php echo $i; ?></td>
                <td>

                    <input type="text" required="" id="date_<?php echo $i; ?>" class="datepicker form-control"
                           placeholder="Please enter a date" name="custom_date[]"
                           value="<?php echo $val['month_date']; ?>"/>
                    <input type="hidden" class="form-control" placeholder="Cost" name="custom_dt[]"
                           value="<?php //echo $dt->format("Y-m-d");
                           ?>"/>
                    <input type="hidden" name="physical_planning_detail_id[]"
                           value="<?php if (!empty($project_physical_planning_detail[$j]['id'])) {
                               echo $project_physical_planning_detail[$j]['id'];
                           } else {
                               echo "";
                           }; ?>">
                </td>
                <td>
                    <?php if( $ajax_request){ ?>
                        <?php $sum = $sum + $project_physical_planning_detail[$j]['target_quantity']; ?>
                        <?php if (!empty($project_physical_planning_detail[$j]['target_quantity'])) {
                            echo $project_physical_planning_detail[$j]['target_quantity'];
                        } else {
                            echo "";
                        }; ?>
                    <?php } else{ ?>
                    <input type="text" required="" onkeypress="allowNumbersOnly1(event)" class="form-control" placeholder="Quantity" name="target[]"
                           value="<?php if (!empty($project_physical_planning_detail[$j]['target_quantity'])) {
                               echo $project_physical_planning_detail[$j]['target_quantity'];
                           } else {
                               echo "";
                           }; ?>"/>
                    <?php } ?>
                </td>
                <td>
                    <?php if (count($custom_monitoring_details) == $i) { ?>
                        <button type="button" id="add_custom_date_btn" onclick="addDateRow(<?php echo $i; ?>)"
                                class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                            <i class="material-icons">add</i></button>
                    <?php } ?>
                    <button type="button" class='btn  btn-circle waves-effect waves-circle waves-float'
                            onclick="removeDateRow(<?php echo $i; ?>)" id='rmv_custom_date_btn_<?php echo $i; ?>'>
                        <i class="material-icons">delete</i></button>

                </td>

            </tr>
            <?php
            $i++;
            $j++;
        }
    } else { ?>
        <tr id="tr_1">
            <td>1</td>
            <td>

                <input type="text" required="" id="date_1" class="datepicker form-control"
                       placeholder="Please enter a date" name="custom_date[]"
                       value="<?php echo $val['month_date']; ?>"/>
                <input type="hidden" class="form-control" placeholder="Cost" name="custom_dt[]"
                       value="<?php //echo $dt->format("Y-m-d");
                       ?>"/>
                <input type="hidden" name="physical_planning_detail_id[]"
                       value="<?php if (!empty($project_physical_planning_detail[$j]['id'])) {
                           echo $project_physical_planning_detail[$j]['id'];
                       } else {
                           echo "";
                       }; ?>">
            </td>
            <td>
                <input type="text" required="" onkeypress="allowNumbersOnly1(event)" class="form-control" placeholder="Quantity" name="target[]"
                       value="<?php if (!empty($project_physical_planning_detail[$j]['target_quantity'])) {
                           echo $project_physical_planning_detail[$j]['target_quantity'];
                       } else {
                           echo "";
                       }; ?>"/>
            </td>
            <td>

                <button type="button" id="add_custom_date_btn" onclick="addDateRow(1)"
                        class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">add</i></button>

                <button type="button" class='btn  btn-circle waves-effect waves-circle waves-float'
                        onclick="removeDateRow(1)" id='rmv_custom_date_btn_1'>
                    <i class="material-icons">delete</i></button>

            </td>

        </tr>
    <?php } ?>
    <?php if($ajax_request){ ?>

        <tr><td colspan="2" style="text-align: left;"><b>Total Quantity :</b></td><td style="text-align: left;">  <?php echo number_format($sum, 2) ?> </td></tr>;
    <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function () {
        var startDate = document.getElementById("project_start_dt").value;
        var endDate = document.getElementById("project_end_dt").value;

        $(document.body).on('change', "[id^='date_']", function () {
            var enterDate = $(this).val();
            $('#submit_btn').removeAttr("disabled");
            if (Date.parse(enterDate) <= Date.parse(startDate)) {
                $(".error").remove();
                var html = '<span class="error" style="color:#ff0000">Enter date should be in between project start and end date.</span>'
                $(this).after(html);
                $("#submit_btn").attr("disabled", true);
                return false;

            } else if (Date.parse(enterDate) > Date.parse(endDate)) {

                $(".error").remove();
                var html = '<span class="error" style="color:#ff0000">Enter date should be in between project start and end date.</span>'
                $(this).after(html);
                $("#submit_btn").attr("disabled", true);
                return false;

            }

        });
    });

    function allowNumbersOnly1(e) {

        var code = (e.which) ? e.which : e.keyCode;

        if (code > 31 && (code < 48 || code > 57) && code != 46) {
            e.preventDefault();
        }

    }

    function addDateRow(row_id) {

        $("#add_custom_date_btn").remove();
        $("#rmv_custom_date_btn_1").show();
        var next_row_id = parseInt(row_id) + parseInt(1);
        var next_id = "tr_" + next_row_id;
        var html = '<tr id=' + next_id + '>\n' +
            '<td>' + next_row_id + '</td>\n' +
            '<td>\n' +
            '<input type="text" required="" id="date_' + next_row_id + '" class="datepicker form-control" placeholder="Please enter a date"  name="custom_date[]" value="" />\n' +
            '<input type="hidden" class="form-control" placeholder="Cost" name="custom_dt[]" value=""/>\n' +
            '<input type="hidden" name="physical_planning_detail_id[]" value="0">\n' +
            '</td>\n' +
            '<td>\n' +
            '<input type="text" required=""class="form-control" placeholder="Quantity" name="target[]" value="" />\n' +
            '</td>\n' +
            '<td>\n' +
            '<button type="button" id="add_custom_date_btn"  onclick="addDateRow(' + next_row_id + ')" class="btn btn-success btn-circle waves-effect waves-circle waves-float">\n' +
            '<i class="material-icons">add</i></button>\n' +
            '<button type="button" class=\'btn  btn-circle waves-effect waves-circle waves-float\' onclick="removeDateRow(' + next_row_id + ')" id="rmv_custom_date_btn_' + next_row_id + '"  >\n' +
            '<i class="material-icons">delete</i></button>\n' +
            '</td></tr>';

        $('#tr_' + row_id).after(html);
        var datetime = $('.datepicker').bootstrapMaterialDatePicker({time: false, clearButton: true});
    }

    function removeDateRow(row_id) {
        $("#tr_" + row_id).remove();
        //
        if ($("#add_custom_date_btn").length) {
            alert("The element you're testing is present.");
        } else {
            var new_id = parseInt(row_id) - parseInt(1);
            var last = $('#yourtableid tr:last').attr('id');
            var id_str = last.split("_");
            var html_btn = '<button type="button" id="add_custom_date_btn"  onclick="addDateRow(' + new_id + ')" class="btn btn-success btn-circle waves-effect waves-circle waves-float">\n' +
                '<i class="material-icons">add</i></button>';
            $('#rmv_custom_date_btn_' + id_str[1]).before(html_btn);

        }
    }
</script>