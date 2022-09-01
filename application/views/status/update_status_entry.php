<link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <section class="content">
        <div class="container-fluid">

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>         
        
    </div>
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 

       
<?php echo form_open('Updatestatus/manage', array('name' => 'Updatestatus','id' => 'Updatestatus')); ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Update Status </h2>

                        </div>
                        <div class="body">
                            <div class="m-b-15">
                        <div class="issue-create-container m-b-15">
                        <?php
                                     if(!empty($get_updatestatus)){
                                    ?>

 

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt = count($get_updatestatus);
                              
                                      foreach ($get_updatestatus as $updatestatus) {
                                      if($k == 1){
                            
                                    ?>
                                <div class="row clearfix">
                                 <div class="col-md-3">
                                        <!-- <p><b>Current Status</b></p> -->
                                        <div id="warning-message"></div>
                                        <label>Issue Name</label>
                                        <input class="form-control issuerow" type="text" name="issue_name[]" id="issue_name" value="<?php echo $updatestatus->issues; ?>" placeholder="Issue Name">
                                        <?php echo form_error('issue_name', '<div class="error">', '</div>'); ?>
                                    </div>
                                 <div class="col-md-3">
                                        <!-- <p><b>Issues</b></p> -->
                                        <div id="warning-message2"></div>
                                        <label>Action Taken</label>
                                        <input class="form-control actionrow" type="text" name="action_taken[]" id="action_taken1" value="<?php echo $updatestatus->action_taken; ?>" placeholder="Action Taken">
                                    </div>
                                  <div class="col-md-3">
                                    <label>Issue Status</label>
                                  <select class="form-control" name="status[]" id="status1">
                                    <option value="N" <?=$updatestatus->current_status == 'N' ? ' selected="selected"' : '';?> >Open</option>
                                    <option value="Y" <?=$updatestatus->current_status == 'Y' ? ' selected="selected"' : '';?>>Closed</option>
                                  </select>
                                  </div>
                                   <div class="col-md-3 p-t-25">                                            
                                        <button id="addusr_0" href="javascript:void(0);" onclick="addUserRow();" type="button" class="btn btn-default btn-circle2 waves-effect waves-float issue-add">
                                                 <i class="material-icons col-green">add</i>
                                        </button>
                                    </div>
                                  </div>
                                <!--</div> !-->

                              <?php 
                                 }
                                else {
                                  ?>
                            <div id="issue-create-row">
                              <div class="row clearfix">
                                 <div class="col-md-3">
                                        <!-- <p><b>Current Status</b></p> -->
                                        <div id="warning-message"></div>
                                        <input class="form-control issuerow" type="text" name="issue_name[]" id="issue_name" value="<?php echo $updatestatus->issues; ?>" placeholder="Issue Name">
                                        <?php echo form_error('issue_name', '<div class="error">', '</div>'); ?>
                                    </div>
                                 <div class="col-md-3">
                                        <!-- <p><b>Issues</b></p> -->
                                        <div id="warning-message2"></div>
                                        <input class="form-control actionrow" type="text" name="action_taken[]" id="action_taken<?php echo $k; ?>" value="<?php echo $updatestatus->action_taken; ?>" placeholder="Action Taken">
                                    </div>
                                  <div class="col-md-3">
                                     <select class="form-control" name="status[]" id="status<?php echo $k; ?>">
                                       <option value="N" <?=$updatestatus->current_status == 'N' ? ' selected="selected"' : '';?>>Open</option>
                                       <option value="Y" <?=$updatestatus->current_status == 'Y' ? ' selected="selected"' : '';?>>Closed</option>
                                     </select>
                                  </div>
                                   <div class="col-md-3">                                            
<!--                                         <button id="addusr_0" href="javascript:void(0);" onclick="addUserRow();" type="button" class="btn btn-default btn-circle2 waves-effect waves-float issue-add">
                                                 <i class="material-icons col-green">add</i>
                                        </button> -->

                                        <button class="btn btn-default btn-circle2 waves-effect waves-float delusrcls issue-remove" type="button">
                                          <i class="material-icons col-pink">delete</i>
                                        </button>

                                    </div>
                                  </div>
                                </div>
                                  <?php } ?>

                                  <?php $k++; 


                                    }
                                   ?>
                                   <!-- </div> !-->
                                 <?php }


                                 else {
                                  ?>
                                <div class="row clearfix">
                                 <div class="col-md-3">
                                        <!-- <p><b>Current Status</b></p> -->
                                        <div id="warning-message"></div>
                                        <label>Issue Name</label>
                                        <input class="form-control issuerow" type="text" name="issue_name[]" id="issue_name" value="<?php echo $get_updatestatus[0]['current_status']; ?>" placeholder="Issue Name">
                                        <?php echo form_error('issue_name', '<div class="error">', '</div>'); ?>
                                    </div>
                                 <div class="col-md-3">
                                        <!-- <p><b>Issues</b></p> -->
                                        <div id="warning-message2"></div>
                                        <label>Action Taken</label>
                                        <input class="form-control actionrow" type="text" name="action_taken[]" id="action_taken1" value="<?php echo $get_updatestatus[0]['issues']; ?>" placeholder="Action Taken">
                                    </div>
                                  <div class="col-md-3">
                                     <label>Issue Status</label>
                                     <select class="form-control" name="status[]" id="status1">
                                       <option value="N">Open</option>
                                       <option value="Y">Closed</option>
                                     </select>
                                  </div>
                                   <div class="col-md-3 p-t-25">                                            
                                        <button id="addusr_0" href="javascript:void(0);" onclick="addUserRow();" type="button" class="btn btn-default btn-circle2 waves-effect waves-float delusrcls issue-add">
                                                 <i class="material-icons col-green">add</i>
                                        </button>

                                    </div>
                                  </div>
                                  <?php } ?>

                                </div>


                              <div class="row">
                                <div class="col-md-4">
                                 </div>
                                  <div class="col-md-4 align-center">
                                  <p><b></b></p>
                                  <a href="<?php echo base_url();?>Updatestatus/project_lists" class="btn btn-warning waves-effect">CANCEL</a>
                    <button class="btn btn-primary waves-effect" name="submit" id="submit_btn" value="Submit"  type="submit" onclick="checkSubmitStatus(event);">
                                    <?php echo (empty($get_updatestatus)) ? 'SAVE' : 'Update' ?>
                                  </button>
                                 </div>
                                <div class="col-md-4">
                                 </div>
                              </div>

                            </div>
                        </div>
                    </div>
            
                     </div>
                  </div>
                </form>
            <!-- Select -->
        </div>
    </section>
            <?php
          if(empty($get_updatestatus)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>
    <!-- #Main Content -->
    
         <!-- Footer -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });
</script>
<script>

   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>

<script type="text/javascript">
var maxLength = 30;
//var row = 1;
var row = <?php echo $cnt6; ?>;
  $(document).ready(function(){
    $('#action_taken').on('keydown keyup change', function(){
    var char = $(this).val();
    var charLength = $(this).val().length;
      if(charLength > maxLength){
        $('#warning-message2').text('Length is not valid, maximum '+maxLength+' allowed.');
        $(this).val(char.substring(0, maxLength));
      }else{
       $('#warning-message2').text('');
    }
  });
});

//   $(document).ready(function(){
//     $('#issue_name').on('keydown keyup change', function(){
//     var char = $(this).val();
//     var charLength = $(this).val().length;
//       if(charLength > maxLength){
//         $('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
//         $(this).val(char.substring(0, maxLength));
//       }else{
//        $('#warning-message').text('');
//     }
//   });
// });




    $(".issue-add").click(function () {
        row++;
        $(".issue-create-container").append('<div id="issue-create-row"><div class="row clearfix"><div class="col-md-3"><input class="form-control issuerow" type="text" name="issue_name[]" id="issue_name" placeholder="Issue Name"></div><div class="col-md-3"><input class="form-control actionrow" type="text" name="action_taken[]" id="action_taken'+row+'" placeholder="Action Taken"></div><div class="col-md-3"><select class="form-control" name="status[]" id="status'+row+'"><option value="N">Open</option><option value="Y">Closed</option></select></div><div class="col-md-3"> <button class="btn btn-default btn-circle2 waves-effect waves-float delusrcls issue-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');
    });

     $("body").on("click", ".issue-remove", function() {
     $(this).closest('#issue-create-row').remove();
     });

   function checkSubmitStatus( event ){
       $('.error').hide();
       
        $('.issue-create-container').find('.issuerow').each(function (i, input) {

            var $input = $(input);

           if ($(input).val() == '') {
               $(input).after("<span class='error' style='color:#ff0000'>Please Enter Issue Name.</span>");
                event.preventDefault();
           }

        });

        $('.issue-create-container').find('.actionrow').each(function (i, input) {

            var $input = $(input);

           if ($(input).val() == '') {
               $(input).after("<span class='error' style='color:#ff0000'>Please Enter Action taken.</span>");
                event.preventDefault();
           }

        });


   //      var issuecount = $(".issuerow").length;


   //       for (let i = 1; i <= issuecount; i++) {

   //         //$(".error").hide();
   //    //$('.issue-create-container').find('#status, #action_taken').each(function (i, input) {
   //       var status = [];
   //       var action = [];
   //         status[i] = $('#status'+i).val();
   //         action[i] = $('#action_taken'+i).val();

 
   //       //alert(status2);

   //         //alert(status[i]);
       
   //       if(status[i] == 'Y' && action[i] == '') {
   //            $('#action_taken'+i).after("<span class='error' style='color:#ff0000'>Please Enter action taken.</span>");
   //            event.preventDefault();
   //      }
   // // });

   //   }




  }
</script>

</body>
<style type="text/css">
    #hidden_dist_fetch {
        display: none;
    }
      .error {
        color: red;
        padding-bottom: 10px;
      }
      #warning-message {
        color: red;
      }
      #warning-message2 {
        color: red;
      }
      label {
        font-weight: bold;
      }
      .p-t-25 {
        padding-top: 25px!important;
       }
</style>
</html>