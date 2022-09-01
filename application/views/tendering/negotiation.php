 <?php  $CI =& get_instance(); ?>

       <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
       <link href="<?php echo base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

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
       <div class="block-header">
                <h4>Tendering - Negotiation</h4>
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

    <!--    Project_Information -->                   
                                  
    <!--    Project_Information End -->      
        <?php echo form_open_multipart('Negotiation/manage', array('name' => 'Negotiation','id' => 'Negotiation')); ?>
         <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
                  
                  <div class="card">
                        <div class="header">
                            <h2> Bidder Information </h2>
                        </div>
                        <div class="body">
                            <div class="bidder-details-container m-b-15" id="nego_bid_value">
                              <!-- =========== -->
                               <?php
                                     if(!empty($negotiation_data)){
                                 ?>
                               
                                <?php 
                                  $k = 1;
                                  $get_same_datacnt = count($negotiation_data);
                                  foreach ($negotiation_data as $Tvalue) {
                                  if($k == 1){
                        
                                ?>


                                <div class="row">
                                    <div class="col-md-2 p-r-0">
                                         <p><b>Bidder Ref No/Name</b><span class="col-pink">*</span></p>
                                         <input class="form-control bidder_ref_nom" type="text" readonly  placeholder="Successful Bidder Ref No/Name" name="negobiddername[]" value="<?php echo $Tvalue['bidder_name']; ?>">

                                         <input class="form-control" type="hidden" name="negobidderid[]"  value="<?php echo $Tvalue['bidder_id']; ?>">
                                    </div>

                                    <div class="col-md-3 p-r-0">
                                         <p><b>Negotiation Meeting date</b></p>
                                         <input class="datepicker form-control" type="text"  placeholder="Please choose a date" name="negomeetingdate[]" id="nego_meet_date<?php echo $k ?>"  value="<?php echo $Tvalue['negotiation_meeting_date']; ?>">

                                         <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date_multi<?php echo $k ?>"  value="<?php echo $Tvalue['datefinanceedit']; ?>">
                                    </div>

                                     <div class="col-md-2 p-r-0">
                                        <p><b>Negotiated Bid Value</b></p>
                                        <input class="form-control txtQty bidvalue" type="text"  placeholder="Negotiated Bid Value" name="negobidvalue[]" id="negotiationbidvalue<?php echo $k ?>" value="<?php echo number_format($Tvalue['negotiation_bid_value'],2); ?>">

                                        <!-- <input class="form-control txtQty bidvalue" type="text"  placeholder="Negotiated Bid Value" name="negobidvalue[]" id="negotiationbidvalue<?php echo $k ?>" value="<?php echo number_format($Tvalue['neo_bid_value'],2); ?>"> -->

                                        <input class="form-control" type="hidden" name="negobid_value[]" id="financialbidvalue<?php echo $k ?>" value="<?php echo $Tvalue['neo_bid_value']; ?>">
                                     </div>

                                    <div class="col-md-3">
                                       <p><b>Successful Bidder’s Response</b></p>
                                       <input class="form-control upload_file"  type="file" name="nego_doc[]" multiple="multiple" id="uploadFile<?php echo $k ?>">

                                       <?php if (!empty($Tvalue['successful_bidder_response'])) { ?>
                                            <a href="<?php echo base_url();?>uploads/files/negotiation/<?php echo $Tvalue['successful_bidder_response']; ?>" title="Download" download>
                                              <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                            </a>
                                        <?php } ?>

                                        <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>

                                       <input type="hidden" name="hiddennego_doc[]" value="<?php echo $Tvalue['successful_bidder_response']; ?>">
                                    </div>
                                    <div class="col-md-2">
                                            <p><b>Status</b></p>
                                            <select  class="form-control choose_updatestatus" name="negotiation_status[]" id="sld_<?php echo $k ?>">
                                            <option value="0">Select....</option> 
                                            <option value="Y" <?php echo set_select('negotiation_status','Y', ( !empty($Tvalue['negotiation_status']) &&
                                                $Tvalue['negotiation_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                            </option>
                                            <option value="N" <?php echo set_select('negotiation_status','N', ( !empty($Tvalue['negotiation_status']) &&
                                                $Tvalue['negotiation_status'] == "N" ? TRUE : FALSE )); ?>>No
                                            </option> 
                                            </select>
                                    </div>
                                 
                                </div>


                                <?php 
                                 }
                                else{
                                 ?>


                                 <div id="bidder-details-row">
                                        <div class="row">
                                            <div class="col-md-2 p-r-0">
                                                <input class="form-control bidder_ref_nom" type="text" readonly placeholder="Successful Bidder Ref No/Name" name="negobiddername[]" value="<?php echo $Tvalue['bidder_name']; ?>">
                                                <input class="form-control" type="hidden"  name="negobidderid[]" value="<?php echo $Tvalue['bidder_id']; ?>">
                                            </div>
                                            <div class="col-md-3 p-r-0">
                                                <input class="form-control datepicker" type="text" placeholder="Please choose a date" id="nego_meet_date<?php echo $k ?>" value="<?php echo $Tvalue['negotiation_meeting_date']; ?>" name="negomeetingdate[]">

                                                 <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date_multi<?php echo $k ?>"  value="<?php echo $Tvalue['datefinanceedit']; ?>">
                                            </div>
                                            <div class="col-md-2 p-r-0">
                                                <input class="form-control txtQty bidvalue" type="text" placeholder="Negotiated Bid Value" name="negobidvalue[]" id="negotiationbidvalue<?php echo $k ?>" value="<?php echo number_format($Tvalue['negotiation_bid_value'],2); ?>">

                                                
                                                  <input class="form-control" type="hidden" name="negobid_value[]" id="financialbidvalue<?php echo $k ?>" value="<?php echo $Tvalue['neo_bid_value']; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control upload_file"  type="file" name="nego_doc[]" multiple="multiple" id="uploadFile<?php echo $k ?>">

                                                <?php if (!empty($Tvalue['successful_bidder_response'])) { ?>
                                                    <a href="<?php echo base_url();?>uploads/files/negotiation/<?php echo $Tvalue['successful_bidder_response']; ?>" title="Download" download>
                                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                  <?php } ?>
                                                  <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>

                                                <input type="hidden" name="hiddennego_doc[]" value="<?php echo $Tvalue['successful_bidder_response']; ?>">
                                            </div>

                                             <div class="col-md-2">
                                              <select class="form-control choose_updatestatus" name="negotiation_status[]" id="sld_<?php echo $k ?>">
                                                <option value="0">Select....</option>
                                                <option value="Y" <?php echo set_select('negotiation_status','Y', ( !empty($Tvalue['negotiation_status']) &&
                                                    $Tvalue['negotiation_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                                </option>
                                                <option value="N" <?php echo set_select('negotiation_status','N', ( !empty($Tvalue['negotiation_status']) &&
                                                    $Tvalue['negotiation_status'] == "N" ? TRUE : FALSE )); ?>>No
                                                </option> 
                                            </select>
                                          </div>
     
                                      </div>
                                    </div>

                                 <?php } ?>

                                 <?php $k++;  } ?>

                               <?php }  ?>

                              <!-- =========== -->

                                 
                                <?php
                                     if(!empty($negotiation_data_form_technical)){
                                 ?>

                                <?php 
                                  $k = 1;
                                  $get_same_datacnt1 = count($negotiation_data_form_technical);
                          
                                  foreach ($negotiation_data_form_technical as $Tvalue) {
                                  if($k == 1){
                        
                                ?>
                                <div class="row">
                                    <div class="col-md-2 p-r-0">
                                         <p><b> Bidder Ref No/Name</b><span class="col-pink">*</span></p>
                                         <input class="form-control bidder_ref_nom" type="text" readonly placeholder="Successful Bidder Ref No/Name"  readonly name="negobiddername[]" value="<?php echo $Tvalue['bidder_name']; ?>">

                                         <input class="form-control" type="hidden" name="negobidderid[]" value="<?php echo $Tvalue['bidder_ref_no']; ?>">
    
                                    </div>

                                    <div class="col-md-3 p-r-0">
                                         <p><b>Negotiation Meeting date</b></p>
                                         <input class="datepicker form-control" type="text"  placeholder="Please choose a date" name="negomeetingdate[]" id="nego_meet_date<?php echo $k ?>">

                                     <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date_multi<?php echo $k ?>"  value="<?php echo $Tvalue['datefinance']; ?>">
                                
                                    </div>

                                    <div class="col-md-2 p-r-0">
                                        <p><b>Negotiated Bid Value</b></p>
                                    <input class="form-control txtQty bidvalue" type="text"  placeholder="Negotiated Bid Value" name="negobidvalue[]" id="negotiationbidvalue<?php echo $k ?>" value="<?php echo number_format($Tvalue['bid_value'],2); ?>">

                                    <input class="form-control" type="hidden" name="negobid_value[]" id="financialbidvalue<?php echo $k ?>"  value="<?php echo $Tvalue['bid_value']; ?>">
                                    </div>

                                    <div class="col-md-3">
                                       <p><b>Successful Bidder’s Response</b></p>
                                       <input class="form-control upload_file" type="file" name="nego_doc[]" multiple="multiple" id="uploadFile<?php echo $k ?>">
                                       <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                       <input type="hidden" name="hiddennego_doc[]">
                                    </div>

                                    <div class="col-md-2">
                                        <p><b>Status</b></p>
                                        <select class="form-control choose_status" name="negotiation_status[]" id="sld_<?php echo $k ?>">
                                            <!-- <select class="form-control choose_status" name="negotiation_status[]" id="selectvalue"> -->
                                            <option value="0">Select....</option>  
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option> 
                                        </select>
                                    </div>

                                </div>
                                <?php 
                                 }



                                else{
                                 ?>
                                    <div id="bidder-details-row<?php echo $k; ?>" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-2 p-r-0">
                                                <input class="form-control bidder_ref_nom ref-list<?php echo $k; ?>" readonly type="text" id="ref" placeholder="Successful Bidder Ref No/Name" readonly value="<?php echo $Tvalue['bidder_name']; ?>" name="negobiddername[]">
                                                <input class="form-control" type="hidden" name="negobidderid[]"  value="<?php echo $Tvalue['bidder_ref_no']; ?>">
   
                                            </div>
                                            <div class="col-md-3 p-r-0">
                                                <input class="form-control datepicker" type="text" placeholder="Please choose a date" name="negomeetingdate[]" id="nego_meet_date<?php echo $k ?>">

                                                 <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date_multi<?php echo $k ?>"  value="<?php echo $Tvalue['datefinance']; ?>">
                                              
                                            </div>
                                            <div class="col-md-2 p-r-0">
                                                <input class="form-control txtQty bidvalue" type="text" placeholder="Negotiated Bid Value" name="negobidvalue[]" id="negotiationbidvalue<?php echo $k ?>" value="<?php echo number_format($Tvalue['bid_value'],2); ?>">

                                                <input class="form-control" type="hidden" name="negobid_value[]" id="financialbidvalue<?php echo $k ?>" value="<?php echo $Tvalue['bid_value']; ?>">

                                            </div>
                                            <div class="col-md-3">
                                                <input  class="form-control upload_file" type="file" name="nego_doc[]" multiple="multiple" id="uploadFile<?php echo $k ?>">
                                                <input type="hidden" name="hiddennego_doc[]">
                                                <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                            </div>

                                            <div class="col-md-2">
                                                <select class="form-control choose_status" name="negotiation_status[]" id="sld_<?php echo $k ?>">
                                                    <option value="0">Select....</option>    
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option> 
                                                </select>
                                          </div>
                                            
                                        </div>
                                    </div>


                                 <?php } ?>


                                 <?php $k++; 

                                 }
  
                                ?>
                               
                               <?php } ?>

                               <!-- =========== -->

                            </div> 
                        </div>
                    </div>

 
                   <div class="row clearfix">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Progress Update </h2>
                        </div>

                            <div class="body">
                              <div class="cloneBox1 m-b-15">
                                <div class="row clearfix">  
                                    
                                    <?php
                                     if(!empty($negotiation_data)){
                                    ?>
                                    <div class="col-md-4">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Negotiation Completion Date</b></p>
                                          
                                            <input type="text" name="approval_date" id="meeting_date" value="<?php echo ($get_negotiation[0]['approval_date'] != '0000-00-00') ? $get_negotiation[0]['approval_date'] : '' ?>" class="datepicker form-control" placeholder="Please choose a date...">

                                            <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date"  value="<?php echo $Tvalue['datefinanceedit']; ?>">
                                       </div>
                                    </div>

                                    <?php } 

                                      else{
                                        ?>

                                        <div class="col-md-4">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Negotiation Completion Date</b></p>
                                          
                                            <input type="text" name="approval_date" id="meeting_date" value="<?php echo ($get_negotiation[0]['approval_date'] != '0000-00-00') ? $get_negotiation[0]['approval_date'] : '' ?>" class="datepicker form-control" placeholder="Please choose a date...">

                                            <input class="form-control" type="hidden" name="hiddendatename[]" id="hidden_nego_date"  value="<?php echo $Tvalue['datefinance']; ?>">
                                       </div>
                                    </div>

                                    <?php } ?>

                                     <div class="col-md-4">
                                         <p><b>Negotiation Completed</b></p>
                                         <select class="form-control" name="approval_status" id="prebid_conf">
                                                <option value="">Select..</option>
                                                <option value="Y" <?php echo set_select('approval_status','Y', ( !empty($get_negotiation[0]['approval_status']) && $get_negotiation[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                                </option> 

                                                <option value="P" <?php echo set_select('approval_status','P', ( !empty($get_negotiation[0]['approval_status']) && $get_negotiation[0]['approval_status'] == "P" ? TRUE : FALSE )); ?>>No
                                                </option>  
                                            </select>  
                                    </div>
                                    <div class="col-md-4">
                                        <p> <b> Remarks </b></p>
                                        <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                        <textarea class="form-control no-resize" maxlength="250" id="maxremarks"  name="remarks" rows="3" placeholder="Please type what you want..."><?php if(empty($get_negotiation)){ echo set_value('remarks'); }?><?php echo $get_negotiation[0]['remarks'] ?></textarea>
                                        
                                        <span id="warning-message" style='color:#ff0000'></span>
                                    </div>

                                </div>
                               </div>
                                <?php  if(!empty($negotiation_data)) { ?>
                                <div class="col-md-12 align-center">
                                    <a href="<?php echo base_url();?>published_tender/pp_negotiation" class="btn btn-warning waves-effect">CANCEL</a>
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"  type="submit" >Update</button> 
                                </div>
                              <?php }
                              else
                              {
                              ?>
                                 <div class="col-md-12 align-center">
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"
                                     onclick="checkSubmitStatus(event );" type="submit" >Submit</button>
                                </div>
                             <?php } ?>
                                <div class="clearfix"></div>
                            </div>

                          </div>
                      </div>
                  </div>
                  <!--  -->
                </form>
            </div>
        </section>
    <!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>


<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
   
  <!-- #Main Content -->
        
 <script type="text/javascript">
        $(document).ready(function(){

            $('.fade-message').delay(5000).fadeOut(5000);
        
        });
  
 </script>

<script>
    var sldid = 1;
    var sld_em_cnt = $(".choose_status").length;
    var ref = $("#ref");

    var ref_cnts = $(".bidder_ref_nom").length;

    ref_cnts = ref_cnts + 1;

    for(let i = 2; i < ref_cnts; i++) {
      $('.ref-list'+ i).attr("disabled", true);
    }
   

 for(let i = 1; i < sld_em_cnt; i++) {

    //alert(i);

    $(function () {
        $("#sld_" + i).change(function () {
            if ($(this).val() == "N") {
                 // alert('hello');
                  $("#bidder-details-row" + parseInt(i + 1)).show();
                  $(".ref-list" + parseInt(i + 1)).attr("disabled", false);
            } else {
                $("#bidder-details-row").hide();
            }
        });
    });

}
// end of options //

    var divid = 1;
    $(".bidder-details-add").click(function (){
         divid++;
        $(".bidder-details-container").append('<div id="bidder-details-row"><div class="row"><div class="col-md-3 p-r-0"><input class="form-control" type="text" name="negobiddername[]" readonly placeholder="Successful Bidder Ref No/Name"></div><div class="col-md-3 p-r-0"><input class="form-control datepicker" type="text" name="negomeetingdate[]" placeholder="Please choose a date"></div><div class="col-md-2 p-r-0"><input class="form-control  txtQty_'+divid+'" name="negobidvalue[]" id="negotiationbidvalue" type="text" placeholder="Negotiated Bid Value"></div><div class="col-md-3"><input  type="file" name="nego_doc[]" id="uploadFile_'+divid+'"><input type="hidden" name="hiddennego_doc[]"></div><div class="col-md-1"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');

        $('.datepicker').bootstrapMaterialDatePicker({
            time: false,
            clearButton: true
          });
         $('.txtQty_'+divid+'').keyup(function(){
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));        
         });

        $('#uploadFile_'+divid+'').change(function (){
        var fileExtension = ['png','pdf','jpg','docx','doc','docs'];
        var MAX_FILE_SIZE = 50 * 1024 * 1024;
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
           swal(" ", "Only png,pdf,jpg,docx,doc,docs format is allowed", "error");
            this.value = ''; // Clean field
            return false;
        }
         fileSize = this.files[0].size;
            if (fileSize > MAX_FILE_SIZE){
                swal(" ", "File must not exceed 50 MB", "error");
                this.value = '';
            } else{
                
            }
    });
    });
    
     $("body").on("click", ".bidder-details-remove", function(){
     $(this).closest('#bidder-details-row').remove();
     });

     $(".txtQty").keyup(function(){
      var $this = $(this);
      $this.val($this.val().replace(/[^\d.]/g, ''));        
     });


 function checkSubmitStatus( event ){
       $('.error').hide();

       //alert('Hello');

       $('#nego_bid_value').find('.bidvalue').each(function (i, input) {

            var $input = $(input);

            

        });

        var bidconfirm = $('#prebid_conf').val();
        var bidvalue = $('#meeting_date').val();

        if(bidconfirm == 'Y' && bidvalue == '') {
        $('#meeting_date').after("<span class='error' style='color:#ff0000'>Please Enter Negotiation Completion Date.</span>");
        event.preventDefault();
        }

        


    }

    var biddercount = $(".upload_file").length;
    
    for (let i = 1; i <= biddercount; i++) {
    $('#uploadFile'+ i).change(function (){
            var fileExtension = ['png','pdf','jpg','docx','doc','docs'];
            var MAX_FILE_SIZE = 50 * 1024 * 1024;
             if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
                swal(" ", "Only png,pdf,jpg,docx.doc,docs format is allowed", "error");
                this.value = '';
                return false;
             }
             fileSize = this.files[0].size;
                if (fileSize > MAX_FILE_SIZE){
                  swal(" ", "File must not exceed 50 MB", "error");
                    this.value = '';
                } else{
                    
                }
        });
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

  // ===================


var selcd = $(".choose_updatestatus").length;

var nxt = 1;

for(i =1; i <= selcd; i++) {


    $("#sld_" + i).change(function(){

    var opt_val = $(this).children("option:selected").val();

     if(opt_val == 'Y') {
            if(this.value == 'Y') {

                var rrr = $(this).attr("id");
                var trtid = rrr.slice(4);
                
                $(".choose_updatestatus").each(function(){
                $(this).val('N');
                })
          
                $("#sld_" + trtid).val('Y');

                $(".choose_updatestatus").first().val('N');

            }

            if(trtid == 1) {
                 $("#sld_" + trtid).val('Y');
              }

            }
    })

}


  // ===================

var selcd = $(".choose_status").length;
//alert(selcd);

var nxt = 1;

for(i =1; i <= selcd; i++) {


    $(".choose_status").first().prop('disabled', false);

   // $("#sld_" + i).prop('disabled', true);

    $("#sld_" + i).change(function(){

    var opt_val = $(this).children("option:selected").val();

        if(opt_val == 'N') {
            nxt++;

            $("#sld_" + nxt).prop('disabled', false);

         }

        else if(opt_val == 'Y') {
          //alert(opt_val);
            if(this.value == 'Y') {

                var rrr = $(this).attr("id");
                var trtid = rrr.slice(4);
                
                //alert('hello check');
                //$(".choose_status").nextAll().val('N');
                $(".choose_status").each(function(){
                $(this).val('N');
                })
          
                $("#sld_" + trtid).val('Y');

                $(".choose_status").first().val('N');

            }

            if(trtid == 1) {
                 $("#sld_" + trtid).val('Y');
              }

            }
    })

}




  //==================
 
var biddercount = $(".bidder_ref_nom").length;
var curval = new Array();
var hidden_area = new Array();
for (let i = 1; i <= biddercount; i++) {

      $('#negotiationbidvalue'+ i).keyup(function(){
       curval[i] = $(this).val();
       hidden_area[i] = $('#financialbidvalue'+ i).val();

      if ( parseInt(curval[i]) > parseInt(hidden_area[i]) ){
        swal(" ", "Negotiation Bid value should less than Financial Bid Value!", "error");  
        $(this).val(0);
      }
     

    });
}

</script>

<script type="text/javascript">
  
   function checkSubmitStatus( event ){
       $('.error').hide();
       
        $('.bidder-details-container').find('.choose_status').each(function (i, input) {

            var stabox = $('.choose_status');

            if(stabox[i].value == 0) {
              $(stabox[i]).after("<span class='error' style='color:#ff0000'>Please Select Status.</span>");
              event.preventDefault();
            }
            
        });
         
  }
</script>

<!-- <script type="text/javascript">
    $(function () {
        $("#selectvalue").change(function () {
            if ($(this).val() == "Y") {
                $("#bidder-details-row").show();
            } else {
                $("#bidder-details-row").hide();
            }
        });
    });
</script> -->

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>
