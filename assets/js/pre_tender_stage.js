$(document).on('click', '.delete', function (e) {
    const id = $(this).data('id');
    e.preventDefault();
    var html = ' <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
    html += '<button  type="button" class="btn btn-danger"  onclick="removeFund(' + id + ')">Delete</button>';


    $("#modal_btn").html(html);
})

function checkSubmitStatus(event) {

    if ($('#aa_brake_up').prop('checked')) {

        var total_break_up = 0;
        var total_aa_amount = $("#estimate_total_cost").val();

        $('#total_container').find('input').each(function (i, input) {

            var $input = $(input);
            total_break_up = parseFloat(total_break_up) + parseFloat($(input).val());

        });


        if (total_break_up != total_aa_amount) {

            $('#err_span').show();
            $('#err_span').html("Total AA Amount is not matched with the total brakeup amount.");
            event.preventDefault();
            return false;
        } else {
            $('#err_span').html('');

        }

        $('#total_container').find('select').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == 'Select Source of Fund') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Select source of fund.</span>");
                event.preventDefault();
            }
        });
    } else {

        return true;

    }

}

function removeUser(id) {
    $("#container_" + id).remove();
}



$(function () {

    var check_box_flag = $('#aa_brake_up').prop('checked');
    if (check_box_flag == true) {
        $('#total_container').show();
    } else {
        $('#total_container').hide();
        $("#err_span").hide();

    }

    $('#aa_brake_up').change(function () {
        var check_box_flag = $('#aa_brake_up').prop('checked');
        if (check_box_flag == true) {
            $('#total_container').show();
        } else {
            $('#total_container').hide();
            $("#err_span").hide();
        }
    });
    areaDropDownAjax();
    $('#project_area').change(function () {

        var elementVal = $(this).val();
        if (elementVal) {

            var url = $('#ajax_url').val();

            $.ajax({
                url: url,
                method: "POST",
                dataType: 'json',
                data: {area_id: elementVal},
                success: function (data) {
                    $('#project_destination').html(data);


                }
            });
        }
    });

    $('.btn-circle').on('click', function () {
        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
        $(this).addClass('btn-info').removeClass('btn-default').blur();
    });

    $('.next-step, .prev-step').on('click', function (e) {
        var $activeTab = $('.tab-pane.active');

        $('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

        if ($(e.target).hasClass('next-step')) {
            var nextTab = $activeTab.next('.tab-pane').attr('id');
            $('[href="#' + nextTab + '"]').addClass('btn-info').removeClass('btn-default');
            $('[href="#' + nextTab + '"]').tab('show');
        } else {
            var prevTab = $activeTab.prev('.tab-pane').attr('id');
            $('[href="#' + prevTab + '"]').addClass('btn-info').removeClass('btn-default');
            $('[href="#' + prevTab + '"]').tab('show');
        }
    });
});
