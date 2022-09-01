$(document).ready(function(){

    $("input[id^='status_check_bx']").click(function(){

        var elementId = $(this).attr('id');
        var tempArr = elementId.split("#");
        var orgId =  tempArr[1];

        var status = 'N';
        if($(this).is(":checked"))
        {
            status = 'Y';
        }
        var base_url = $('#ajax_base').val();

        
        $.ajax({
            url:base_url+'organization/updateStatus',
            method:"POST",
            dataType: 'json',
            data:{status:status,orgId:orgId},
            success:function(data){


            }
        });
    });
});
