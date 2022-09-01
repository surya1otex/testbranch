   <?php  $CI =& get_instance(); ?>

       <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
     <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
  
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


        <div class="block-header">
                <h4>Tendering - Technical Evaluation</h4>
         </div>

     <!-- Steps start -->      
        <?php
        //project_tendering_steps($project_id);
        ?>
      <!-- Steps end --> 
        <?php
            if(is_numeric($project_id)){
                project_info($project_id);
            }

        ?> 

   
    
            
        <?php echo form_open_multipart('Technical_Evalution/manage', array('name' => 'Technical_Evalution','id' => 'Technical_Evalution')); ?>
         <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />

             <!--  -->
                 <div class="card">
                       <div class="header">
                            <h2> Bidder Information </h2>
                        </div>
                        <div class="body">
                            <div class=" m-b-15">
                                 
                               <div class="bidder-details-container m-b-15" id="bidder_ref_number">
                                  
                                   <?php
                                     if(!empty($technical_evalution_data)){
                                    ?>

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt = count($technical_evalution_data);
                              
                                      foreach ($technical_evalution_data as $Tvalue) {
                                      if($k == 1){
                            
                                    ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p><b>Bidder Ref. No./Name</b></p>
                                                <input class="form-control bidderrefno" type="text" 
                                                name="bidder_refno[]" id="biddername<?php echo $k ?>" value="<?php echo $Tvalue['bidder_ref_no']; ?><?php echo $Tvalue[0]['bidder_ref_no'] ?>" 
                                                placeholder="Bidder Ref No/Name"  > 
                                                
                                        </div>
                                        <!--  -->
                                        <div class="col-md-4">
                                            <p><b>Technically Qualified / Disqualified</b></p>
                                            <select  class="form-control" name="technical_status[]">
                                            <option value="Y" <?php echo set_select('technical_status','Y', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                            </option>
                                            <option value="N"  <?php echo set_select('technical_status','N', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "N" ? TRUE : FALSE )); ?>>No
                                            </option> 
                                            </select>
                                        </div>
                                        <div class="col-md-4 p-t-25">
                                            <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                        </div>

                                </div>
                                <?php 
                                 }
                                else{
                                 ?>
                                    <div id="bidder-details-row">
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name" name="bidder_refno[]"  id="biddername<?php echo $k ?>" value="<?php echo $Tvalue['bidder_ref_no']; ?>" > 
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <select  class="form-control" name="technical_status[]">
                                                <option value="Y" <?php echo set_select('technical_status','Y', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                               </option>
                                                <option value="N"  <?php echo set_select('technical_status','N', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "N" ? TRUE : FALSE )); ?>>No
                                            </option> 
                                            </select>
                                             </div>
                                             <div class="col-md-4">
                                                <button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button> 
                                             </div>
                                            </div>
                                        </div>

                                  <?php } ?>


                                   <?php $k++; 

                                    }

                                  ?>
                               
                                  <?php } 
                                  else { 
                                    ?>

                                      <div class="row">
                                       <div class="col-md-4">
                                        <p><b>Bidder Ref. No./Name</b></p>
                                            <input class="form-control bidderrefno" type="text" 
                                            name="bidder_refno[]"  
                                            placeholder="Bidder Ref No/Name" id="biddername<?php echo $k ?>"> 
                                           

                                    </div>

                                    <div class="col-md-4">
                                        <p><b>Technically Qualified / Disqualified</b></p>
                                        <select  class="form-control" name="technical_status[]">
                                            <option value="0">Select... </option>
                                               <option value="Y" <?php echo set_select('technical_status','Y', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                               </option>
                                                <option value="N" <?php echo set_select('technical_status','N', ( !empty($Tvalue['technical_status']) &&
                                                $Tvalue['technical_status'] == "N" ? TRUE : FALSE )); ?>>No
                                               </option> 
                                      </select>
                                    </div>
                                    <div class="col-md-4 p-t-25">
                                        <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                    </div>

                                </div>

                             <?php } ?>

                            </div>

                        </div>
            
                    </div>
                    </div>


                   <!--  --> 
                   <div class="row clearfix">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Progress Update </h2>
                        </div>

                            <div class="body">
                              <div class="cloneBox1 m-b-15">
                                <div class="row clearfix">  
                                    
                                    <div class="col-md-4">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Technical Evaluation Date</b></p>
                                           
                                             <input type="text" name="approval_date" id="meeting_date" value="<?php echo ($get_technicaleva[0]['approval_date'] != '0000-00-00') ? $get_technicaleva[0]['approval_date'] : '' ?>" class="datepicker form-control" placeholder="Please choose a date...">
                                            
                                       </div>
                                    </div>

                                    <div class="col-md-4">
                                         <p> <b>Technical Evaluation Completed</b> </p>
                                         <select  class="form-control" name="approval_status" id="prebid_conf">
                                                <option value="">Select..</option>
                                                <option value="Y" <?php echo set_select('approval_status','Y', ( !empty($get_technicaleva[0]['approval_status']) && $get_technicaleva[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Yes</option>
                                                <option value="P" <?php echo set_select('approval_status','P', ( !empty($get_technicaleva[0]['approval_status']) && $get_technicaleva[0]['approval_status'] == "P" ? TRUE : FALSE )); ?>>No</option>
                                            </select>
                                         
                                    </div>
                                     
                                    <div class="col-md-4">
                                        <p> <b> Remarks </b></p>
                                        <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                        <textarea class="form-control no-resize" maxlength="250" name="remarks" id="maxremarks" rows="3" placeholder="Please type what you want..."><?php if(empty($get_technicaleva)){ echo set_value('remarks'); }?><?php echo $get_technicaleva[0]['remarks'] ?></textarea>
                                      <span id="warning-message" style='color:#ff0000'></span>
                                    </div>


                                </div>
                               </div>

                                <?php  if(!empty($technical_evalution_data)) { ?>
                                <div class="col-md-12 align-center">
                                    <a href="<?php echo base_url();?>published_tender/pp_technical_evalution" class="btn btn-warning waves-effect">CANCEL</a>
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"   type="submit">Update</button>
                                    
                                </div>
                              <?php }
                              else
                              {
                              ?>
                                 <div class="col-md-12 align-center">
                                      <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"  type="submit">Submit</button>
                                    
                                </div>
                             <?php } ?>
                                <div class="clearfix"></div>
                            </div>

                          </div>
                      </div>
                  </div>
                  <!--  -->
                  </form>
            <!-- Select -->

        </div>
    </section>
    <!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
   
  <!-- #Main Content -->
        
   <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
    });
  

</script>

<script type="text/javascript">

    //Bidder details add remove 
     var divid = 1;
     $(".bidder-details-add").click(function () {
     divid++;
        $(".bidder-details-container").append('<div id="bidder-details-row"><div class="row"> <div class="col-md-4"><input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name" name="bidder_refno[]" id="biddername_'+divid+'"> </div><div class="col-md-4"> <select  class="form-control" name="technical_status[]"><option value="0">Selcet..</option><option value="Y">Yes</option><option value="N">No</option> </select> </div><div class="col-md-4"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button> </div></div></div>');

        $('.txtQty_'+divid+'').keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
        });

     $('#biddername_'+divid+'').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
          }
      });

     });
    
     $("body").on("click", ".bidder-details-remove", function() {
     $(this).closest('#bidder-details-row').remove();
     });

   
// ===================
$(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
});

$('#biddername').on('keypress', function (event) {
var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
if (!regex.test(key)) {
event.preventDefault();
return false;
}
});

   function checkSubmitStatus( event ){
       $('.error').hide();

       
        $('#bidder_ref_number').find('.bidderrefno').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Enter Bidder Ref No/Name.</span>");
                event.preventDefault();
            }
        });

        var bidconfirm = $('#prebid_conf').val();
        var bidvalue = $('#meeting_date').val();

        if(bidconfirm == 'Y' && bidvalue == '') {
        $('#meeting_date').after("<span class='error' style='color:#ff0000'>Please Enter Technical Evalution date.</span>");
        event.preventDefault();
        }

   }

// ===================
var maxLength = 250;
$(document).ready(function(){
    $('#maxremarks').on('keydown keyup change', function(){
        var char = $(this).val();
        var charLength = $(this).val().length;
         if(charLength > maxLength){
            $('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
            $(this).val(char.substring(0, maxLength));
        }else{
            $('#warning-message').text('');
        }
    });
});

var biddernamecount = $(".bidderrefno").length;
    for (let i = 1; i <= biddernamecount; i++) {

    $('#biddername'+ i).on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
     }
   });
}

</script>

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>
