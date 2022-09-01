function checkSubmitStatus(event) {
    var elemntValue = $("#re_tender_status").val();
    var retenderComment = $("#remarks_for_retender").val();
    if (elemntValue == 'Y' && retenderComment == '') {
        $('#err_span').html("Please type a reason for re tender.");
        event.preventDefault();
    }
}
;
$(document).ready(function () {
    $("#reason_retender_label,#reason_retender_field").hide()
    $('#re_tender_status').on('change', function () {
        var val = $(this).val();
        if( val == 'Y'){
            $("#reason_retender_label ,#reason_retender_field").show();
        }else{
            $("#reason_retender_label ,#reason_retender_field").hide();
        }

    });
    var val = $('#re_tender_status').val();
    if( val == 'Y'){
        $("#reason_retender_label ,#reason_retender_field").show();
    }else{
        $("#reason_retender_label ,#reason_retender_field").hide();
    }

});

