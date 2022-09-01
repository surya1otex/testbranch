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
                <h4>Tendering - Issue of LoA</h4>
         </div>
            
         <!-- Steps start -->      
           <?php
              // project_tendering_steps($project_id);
           ?>
        <!-- Steps end --> 

         <?php
            if(is_numeric($project_id)){
                project_info($project_id);
            }

         ?>    

        
        <?php echo form_open_multipart('Issue_of_LoA/manage', array('name' => 'Issue_of_LoA','id' => 'Issue_of_LoA')); ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />

        

              <div class="card">
                <div class="header">
                            <h2> Bidder Information </h2>
                        </div>
                         <div class="body">
                            <div class="m-b-15">
                            <div class="row clearfix">  
                                
                               <div class="col-md-4">
                                    <p><b>Successful Bidder Ref No/Name</b> <span class="col-pink">*</span></b></p>
                                    <input class="form-control" type="text" name="successful_bidder_ref_no" placeholder="Successful Bidder Ref No/Name" value="<?php if(empty($fetch_issueofloa)){ echo set_value('bidder_name'); }?><?php echo $fetch_issueofloa[0]['bidder_name'] ?>" readonly>

                                     <?php echo form_error('successful_bidder_ref_no', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p><b>Negotiation Meeting Date</b></p>
                                    <input class="form-control" name="negotiation_meeting_date" readonly id="negodatepicker" type="text"  placeholder="Please choose a date..."  value="<?php if(empty($fetch_issueofloa)){ echo set_value('negotiation_meeting_date'); }?><?php echo $fetch_issueofloa[0]['negotiation_meeting_date'] ?>">
                                    
                                </div>

                               <!--  <div class="col-md-4">
                                    <p><b>Accepted Offer Value</b></p>
                                    <input class="form-control txtQty" type="text" name="negotiation_bid_value" readonly id="negotiation_bid_value" placeholder="Negotiated Bid Value" value="<?php if(empty($get_issueofloa)){ echo set_value('negotiation_bid_value'); }?><?php echo number_format($fetch_issueofloa[0]['negotiation_bid_value'],2) ?>">
                                    
                                    <?php echo form_error('negotiation_bid_value', '<div class="error">', '</div>'); ?>

                                    <input class="form-control" type="hidden" name="negotiation_bid_value_hidden" id="negotiation_bid_value_hidden" value="<?php echo $fetch_issueofloa[0]['negotiation_bid_value'] ?>">
                                </div> -->

                                <div class="col-md-4">
                                    <p><b>Accepted Offer Value</b> <span class="col-pink">*</span></b></p>
                                    <input class="form-control txtQty" type="text" readonly name="negotiation_bid_value" id="negotiation_bid_value" placeholder="Negotiated Bid Value" value="<?php if(empty($get_issueofloa)){ echo set_value('negotiation_bid_value'); }?><?php echo number_format($fetch_issueofloa[0]['negotiation_bid_value'],2) ?>">
                                    <?php echo form_error('negotiation_bid_value', '<div class="error">', '</div>'); ?>



                                    <input class="form-control" type="hidden" name="negotiation_bid_value_hidden" id="negotiation_bid_value_hidden" value="<?php echo $fetch_issueofloa[0]['negotiation_bid_value'] ?>">
                                </div>

                                <div class="col-md-4">
                                  <p><b>LoA Issue Date</b></p>
                                  <input class="datepicker form-control" name="loa_issue_date" id="neg_loaissue_date" type="text"  placeholder="Please choose a date..." value="<?php if(empty($get_issueofloa)){ echo set_value('loa_issue_date'); }?><?php echo $get_issueofloa[0]['loa_issue_date'] ?>">
                                </div>

                                <div class="col-md-4">
                                  <p><b>Upload LoA</b>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                  <input  type="file" name="loa_document" multiple="multiple" id="uploadFile">
                                  <?php if (!empty($get_issueofloa[0]['loa_document'])) { ?>
                                    <a href="<?php echo base_url();?>uploads/files/loa/<?php echo $get_issueofloa[0]['loa_document']; ?>" title="Download" download>
                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                    </a>
                                  <?php } ?> 
                                </div>

                                <div class="col-md-4">
                                    <p><b>Negotiation Completion Date</b></p>
                                    <input class="form-control" readonly name="loa_issue_complete_date" id="neg_complete_date" type="text" placeholder="Please choose a date..." value="<?php if(empty($fetch_negoofloa)){ echo set_value('date'); }?><?php echo $fetch_negoofloa[0]['date'] ?>">
                               </div>
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
                                    
                                    <!-- <div class="col-md-4">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Issue of LoA Date</b></p>

                                             <input type="text" name="approval_date" id="neo_issuedate" value="<?php echo ($get_issueofloa[0]['approval_date'] != '0000-00-00') ? $get_issueofloa[0]['approval_date'] : '' ?>" class="datepicker form-control" placeholder="Please choose a date...">
                                            
                                       </div>
                                    </div> -->
                                     <div class="col-md-6">
                                         <p> <b>Issue Of LoA Completed</b> </p>
                                         <select  class="form-control" name="approval_status" id="prebid_conf">
                                                <option value="">Select..</option>
                                                <option value="Y" <?php echo set_select('approval_status','Y', ( !empty($get_issueofloa[0]['approval_status']) && $get_issueofloa[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                                </option>  
                                                <option value="P" <?php echo set_select('approval_status','P', ( !empty($get_issueofloa[0]['approval_status']) && $get_issueofloa[0]['approval_status'] == "P" ? TRUE : FALSE )); ?>>No
                                                </option> 
                                            </select>
                                         
                                    </div>
                                    <div class="col-md-6">
                                        <p> <b> Remarks </b></p>
                                        <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                        <textarea class="form-control no-resize" maxlength="250" name="remarks" id="maxremarks" rows="3" placeholder="Please type what you want..."><?php if(empty($get_issueofloa)){ echo set_value('remarks'); }?><?php echo $get_issueofloa[0]['remarks'] ?></textarea>
                                      <span id="warning-message" style='color:#ff0000'></span>
                                    </div>
                                </div>
                               </div>
                                
                                <?php  if(!empty($fetch_issueofloa)) { ?>
                                <div class="col-md-12 align-center">
                                    <a href="<?php echo base_url();?>published_tender/pp_issue_loa" class="btn btn-warning waves-effect">CANCEL</a>
                                     <button class="btn btn-primary waves-effect" name="submit" id="submit_btn" value="Submit"
                                     onclick="checkSubmitStatus(event );"  type="submit">Update</button>
                                    
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

<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
   
  <!-- #Main Content -->
        
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    
    });

   $(".txtQty").keyup(function() {
      var $this = $(this);
      $this.val($this.val().replace(/[^\d.]/g, ''));        
      });


  function checkSubmitStatus( event ){
       $('.error').hide();


        var bidconfirm = $('#prebid_conf').val();
        var bidvalue = $('#neo_issuedate').val();

        if(bidconfirm == 'Y' && bidvalue == '') {
        $('#neo_issuedate').after("<span class='error' style='color:#ff0000'>Please Enter Issue of LOA date.</span>");
        event.preventDefault();
        }

        
        
       
      

    }

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

    //===================file===========

$('#uploadFile').change(function () {
        var fileExtension = ['png','pdf','jpg','docx','doc','docs'];
        var MAX_FILE_SIZE = 50 * 1024 * 1024;
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            swal(" ", "Only png,pdf,jpg,docx,doc,docs format is allowed", "error");
            this.value = ''; // Clean field
            return false;
        }
        fileSize = this.files[0].size;
        if (fileSize > MAX_FILE_SIZE) {
            swal(" ", "File must not exceed 50 MB", "error");
            this.value = '';
        } else {
            
        }
    });

// ===================
// $('#negotiation_bid_value').keyup(function(){
//  var curval = $(this).val();
//   var hidden_area = $("#negotiation_bid_value_hidden").val();
  
//   if ( parseInt(curval) > parseInt(hidden_area) ){
//     alert("Issue of LOA Negotiated Bid Value value should less than Negotiation Bid value");
//     $(this).val(0);
//   }
// });


</script>

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>
