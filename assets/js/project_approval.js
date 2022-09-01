function addBreakupRow() {

    var last_id = $('#amount_brkup_tbl tr:last').attr('id');
    var id = last_id.split("_");
    //alert(id);
    var next_id = parseInt(id[1]) + 1;
    var html = $("#tr_1").clone().attr('id', 'tr_' + next_id);
    $('#amount_brkup_tbl tr:last').after(html)
}

function checkSubmitStatus(event) {

    $('.error').hide();
    var flag_err = 0;
    if ($("#invoice_no").val() == '') {
        flag_err++;
        $('#invoice_no').after("<span class='error' style='color:#ff0000'>Invoice no cannot be blank.</span>");
        //event.preventDefault();
    }
    if ($("#invoice_date").val() == '') {
        flag_err++;
        $('#invoice_date').after("<span class='error' style='color:#ff0000'>Invoice date cannot be blank.</span>");
        //event.preventDefault();
    }
    if ($("#invoice_vendor").val() == '') {
        flag_err++;
        $('#invoice_vendor').after("<span class='error' style='color:#ff0000'>Please select a vendor.</span>");
        //event.preventDefault();
    }

    var total_break_up = 0;
    var total_amount = parseInt($("#total_invoice_amount").val());

    $('#amount_brkup_tbl').find('.amount').each(function (i, input) {

        var $input = $(input);
        total_break_up = parseInt(total_break_up) + parseInt($(input).val());

    });

    if (isNaN(total_break_up) && isNaN(total_amount)) {

        $('#total_invoice_amount').after("<span class='error' style='color:#ff0000'>Invice amount cannot be zero.</span>");
        event.preventDefault();
        //return false;
    } else if (total_break_up != total_amount) {

        $('#err_span').show();
        $('#err_span').html("Total invoice amount is not matched with the total brakeup amount.");
        event.preventDefault();
        //return false;
    } else {
        $('#err_span').html('');

    }

    $('#amount_brkup_tbl').find('.details').each(function (i, input) {

        var $input = $(input);

        if ($(input).val() == '') {
            $(input).after("<span class='error' style='color:#ff0000'>Details cannot be blank.</span>");
            event.preventDefault();
        }
    });
    $('#amount_brkup_tbl').find('.head').each(function (i, input) {

        var $input = $(input);

        if ($(input).val() == '') {
            $(input).after("<span class='error' style='color:#ff0000'>Plese select a head.</span>");
            event.preventDefault();
        }
    });

    if (flag_err > 0) {
        event.preventDefault();
    }
}
