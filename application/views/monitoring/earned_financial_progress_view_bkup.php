<?php 
    $CI =& get_instance();
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    //echo "<pre>"; print_r($project_deatail); die;
?>

<!-- flex slider css !-->
<!--   <link href="css/shCore.css" rel="stylesheet" type="text/css" />
  <link href="css/shThemeDefault.css" rel="stylesheet" type="text/css" /> -->
  <!-- Demo CSS -->
<!--     <link rel="stylesheet" href="assets/FlexSlider/css/demo.css" type="text/css" media="screen" /> -->


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/FlexSlider/flexslider.css" type="text/css" media="screen" />

<!-- slick css !-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/slick/slick-theme.css"/>
<!-- end of slick css !-->

    <!-- Modernizr -->
<!--   <script src="js/modernizr.js"></script> -->
<!-- end of flexslider css !-->
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>Financial Monitoring Activity Wise </h4>
                </div>
            </div>
            <!-- Basic Examples -->
            <?php echo form_open('Monitoring/earned_financial_progress',array('name'=> 'add_project_work_item','id'=>'add_project_work_item_form')); ?>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <tbody>
                                            <tr>
                                                <td>Project Name: </td>
                                                <td>
                                                    <?php
                                                    echo $project_deatail[0]['project_name'];
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Stage: </td>
                                                <td>
                                                    <?php
                                                    $work_item_name= $CI->work_item($project_work_item_id);
                                                    echo $work_item_name[0]['work_item_description'];
                                                    ?>
                                                    <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
                                                    <input type="hidden" id="work_item_id" name="work_item_id" value="<?php echo $project_work_item_id; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Select Activity<span style="color: red;">*</span>: </td>
                                                <td>
                                                    <select class="form-control show-tick" name="activity_id" id="activity_id">
                                                        <option value="">Select Activity</option>
                                                        <?php
                                                        foreach($project_activity_detail as 
                                                            $activity_detail){
                                                        ?>
                                                            <option value="<?php echo $activity_detail['project_activity_id']?>"><?php echo $activity_detail['particulars']?></option>
                                                        <?php  
                                                        }
                                                        ?>
                                                    
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Start Date : </td>
                                                <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                            </tr>
                                            <tr>
                                                <td>End Date : </td>
                                                <td><?php $end_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $end_date->format('jS M Y'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="activity_extra_data">
                        </div>                                
                                                        

                        <div id="activity_details_error" class="m-t-10 m-b-10"></div>
                        <div id="activity_details">                                
                            
                        </div>
                        

                    </div>
                </div>
            </form>
            <!-- #END# Basic Examples -->
        </div>
    </section>
 
<!-- modal images section !-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body" id="modalbody">
<div class="wrap-modal-slider">
          <div class="fade">

          </div>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- end of modal images !-->

<!-- flexslider js scripts !-->
<!--   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>

  <script defer src="<?php echo base_url(); ?>assets/FlexSlider/jquery.flexslider.js"></script> -->

 <!-- FlexSlider -->

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/slick/slick.min.js"></script>


  <script type="text/javascript">
// $(window).load(function() {
//   $('.flexslider').flexslider({
//     animation: "slide"
//   });
// });

// $(document).ready(function(){
//     $(".earnedimage").click(function(){
//         alert('Test Ok');
//     })
// });


// async function flexslide() {
//     //alert('test called');

//    // var cnts = $('.slides').html();

//    // alert(cnts);

//     $('#myModal').on('shown.bs.modal', function () {

//      $('.flexslider').flexslider({
//         animation: "slide"
//   });

// });
// }
//$(document).ready(function(){



// $(document).ready(function(){
// $('.fade').slick({
//     dots: true,
//     infinite: true,
//     speed: 700,
//     autoplay:true,
//     autoplaySpeed: 2000,
//     arrows:false,
//     slidesToShow: 1,
//     slidesToScroll: 1
//  });
// });


$(document).on("click", ".earnedimage" , function(event) {
    event.preventDefault();
    //$('#slides').html('');
    $('#slides').empty();
    var projid = $('#project_id').val();
    var month = $(this).data('month');
    
 $.ajax({
    url: '<?php echo base_url('Monitoring/earned_value_images_generation'); ?>',
    type: 'post',
    data: {project_id:projid, month: month},
    success: function(response){ 

        //alert(response);
      // Add response in Modal body
     
    $('.fade').html(response);

  // $('#modalbody').html(response);

    // setTimeout(function () {
    //     flexslide();
    // }, 200);

     //flexslide();
// $(window).load(function() {

//$(".slider").not('.slick-initialized').slick()

$('.fade').not('.slick-initialized').slick({
    dots: true,
    infinite: true,
    speed: 700,
    autoplay:true,
    autoplaySpeed: 2000,
    arrows:false,
    slidesToShow: 1,
    slidesToScroll: 1
 });



$('.modal').on('shown.bs.modal', function (e) {
  $('.fade').slick('setPosition');
  $('.wrap-modal-slider').addClass('open');
})



// $('#myModal').on('shown.bs.modal', function () {







//     //$('#slides').html(response);

//  //alert('test')
 
//      // $('.flexslider').flexslider({
//      //    animation: "slide",
//      //    slideshow: true
//      //  });

// //alert('flex slide called');

// });



     
    }

  });


});

//})







// $('#myModal').on('shown.bs.modal', function () {
//      $('.flexslider').flexslider({
//         animation: "slide"
//   });
// });
  </script>
<!-- end of flex slider !-->


    <script>
        $("#activity_id").change(function(){
            var activity_id=$('#activity_id').val();  
            var project_id=$('#project_id').val();
            var work_item_id=$('#work_item_id').val();          
            if(activity_id > 0){
                $("#activity_details").html('<p>Processing...</p>');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url();?>Monitoring/get_earned_financial_acitivity_plan_xhr",
                    data: {
                        project_id:project_id, 
                        work_item_id:work_item_id,
                        activity_id:activity_id
                        },
                    dataType: "json",    
                    success: function (msg) {
                        //console.log(msg.html);
                        $("#activity_details").html(msg.html);
                        $("#activity_extra_data").html(msg.html_additional_data);
                        $("#activity_details_error").html('');
                        check_total();
                    }
                });
            }else{
                $("#activity_details").html('');    
            }
             
        });

        function check_total(){
            var earnedTotalAmount = 0.00;
            var activityBudgetAmount = $("#total_activity_budget_amount").val();
            $('#activity_details').find('.amount_key').each(function(index, element) {
                earnedTotalAmount +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#earnedTotalAmount").html(earnedTotalAmount.toFixed(2));
            })
            var earnedTotalPercent = 0.00;
            $('#activity_details').find('.weightage_key').each(function(index, element) {
                earnedTotalPercent +=parseFloat(element.value);
                //console.log(earnedTotalAmount);
                $("#earnedTotalPercent").html(earnedTotalPercent.toFixed(2));
            })


        }

         $("#add_project_work_item_form").on("submit", function(e){
            
            var earnedTotalAmount = 0.00;
            var activityBudgetAmount = $("#total_activity_budget_amount").val();
            $('#activity_details').find('.amount_key').each(function(index, element) {
                earnedTotalAmount +=parseFloat(element.value);
            })
            if(parseFloat(earnedTotalAmount) > parseFloat(activityBudgetAmount)){
                alert('Earned Amount Exceeded!');
                $("#activity_details_error").html('<p style="color:red;"><strong>Earned Amount Exceeded!</strong></p>');
                e.preventDefault(); //return false;
            }else{
                $("#activity_details_error").html('');
                //alert('form submit');
                
            }
            //e.preventDefault();
            //return false;
        })
    </script>

    


    <script type="text/javascript">
        function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}

function validateFloatKeyPress(el, evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    var number = el.value.split('.');
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    //just one dot
    if(number.length>1 && charCode == 46){
         return false;
    }
    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf(".");
    if( caratPos > dotPos && dotPos>-1 && (number[1].length > 1)){
        return false;
    }
    return true;
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate()
        r.moveEnd('character', o.value.length)
        if (r.text == '') return o.value.length
        return o.value.lastIndexOf(r.text)
    } else return o.selectionStart
}
    </script>


    <script type="text/javascript">

              $(document.body).on("keyup",".weightage_key",function(){
                //alert('hi');
                var weightageKeyId = this.id;


                var weightageVal = this.value;
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#amountKey_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });

             
                $(document.body).on("keyup",".amount_key",function(){
                    //alert('hi');
                var amountKeyId = this.id;
                var amountVal = this.value;
                
                var agreementCost = '<?php echo $project_aggrement_deatail[0]['agreement_cost']; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                // alert(id);
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    //alert(calamtData);
                    $("#weightage_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });
          </script>

        <style type="text/css">
            #modalbody li img {
                height: 120px;
            }
            #modalbody li {
                list-style: none;
                display: inline-flex;
                margin: 5px;
            }
            .modal-dialog {
  max-width: 730px;
}

.wrap-modal-slider {
  padding: 0 30px;
  opacity: 0;
  transition: all 0.3s;
}

.wrap-modal-slider.open {
  opacity: 1;
}

.slick-prev:before, .slick-next:before {
  color: red;
}
        </style>


    