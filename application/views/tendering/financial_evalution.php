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
            <h4>Tendering - Financial Evaluation</h4>
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
   

           <?php echo form_open_multipart('Financial_Evalution/manage', array('name' => 'Financial_Evalution','id' => 'Financial_Evalution')); ?>
           <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
        
                  <div class="card">
                    <div class="header">
                            <h2> Bidder Information </h2>
                        </div>
                        <div class="body">
                            <div class="bidder-details-container m-b-15" id="bidder_ref_number">
                                  

                                <?php
                                 if(!empty($financial_evalution_data)){
                                 ?>

                                <?php 
                                  $k = 1;
                                  $get_same_datacnt = count($financial_evalution_data);
                          
                                  foreach ($financial_evalution_data as $Tvalue) {
                                  if($k == 1){
                        
                                ?>
                                 <div class="row">
                                    <div class="col-md-3">
                                        <p><b>Bidder Ref. No./Name</b></p>
                                        <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name" name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_name']; ?>">

                                        <input class="form-control bidderrefno" type="hidden" name="finbidder_refnoid[]" value="<?php echo $Tvalue['bidder_ref_no']; ?>">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <p><b>Successful Bid Value</b></p>
                                        <input class="form-control txtQty" type="text"  placeholder="Successful Bid Value" name="finsucc_bidvalue[]"  value="<?php echo number_format($Tvalue['bid_value'],2); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <p><b>Status</b></p>
                                        <select  class="form-control show-tick" name="finsucc_biddername[]" >
                                            
                                            <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option>  
                                        </select>
                                    </div> 
                                    
                                    <div class="col-md-2">
                                        <p><b>Final Score</b></p>
                                        <input class="form-control txtQty" type="text"  placeholder="Final Score" value="<?php echo $Tvalue['final_score']; ?>" name="final_score[]">
                                    </div>
                                    <!-- <div class="col-md-1 p-t-25">
                                            <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                     </div> -->
                                    
                                </div>
                                <?php 
                                 }
                                else{
                                 ?>   
                                    <div id="bidder-details-row" >
                                      <div class="row"> 
                                        <div class="col-md-3">
                                            <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name"  name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_name']; ?>">
                                            <input class="form-control bidderrefno" type="hidden" name="finbidder_refnoid[]" value="<?php echo $Tvalue['bidder_ref_no']; ?>"> 
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control txtQty" type="text" placeholder="Successful Bid Value" name="finsucc_bidvalue[]" 
                                             value="<?php echo number_format($Tvalue['bid_value'],2); ?>"> 
                                        </div>
                                        <div class="col-md-3">
                                            
                                             <select  class="form-control show-tick" name="finsucc_biddername[]">
                                            
                                            <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option>
                                            </select> 
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control txtQty" type="text" placeholder="Final Score" name="final_score[]" value="<?php echo $Tvalue['final_score']; ?>"> 
                                        </div>
                                        <!-- <div class="col-md-1">
                                           <button class="btn btn-default btn-circle waves-effect waves-circle waves-float  bidder-details-row bidder-details-remove" type="button" id="<?php echo $Tvalue['id']; ?>" ><i class="material-icons col-pink">delete</i></button> 

                                        </div> -->
                                       
                                    </div>
                                 </div>     
                                 <?php } ?>


                                 <?php $k++; 

                                 }
  
                                ?>
                               
                              <?php }  ?>


                              <!-- ============= -->

                              <?php
                                 if(!empty($financial_evalution_added_data)){
                                 ?>

                                <?php 
                                  $k = 1;
                                  $get_same_datacnt = count($financial_evalution_added_data);
                          
                                  foreach ($financial_evalution_added_data as $Tvalue) {
                                  if($k == 1){
                        
                                ?>
                                 <div class="row">
                                    <div class="col-md-3">
                                        
                                        <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name" name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_ref_no']; ?>">

                                        <input class="form-control bidderrefno" type="hidden" name="finbidder_refnoid[]" value="<?php echo $Tvalue['id']; ?>">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <input class="form-control txtQty" type="text"  placeholder="Successful Bid Value" name="finsucc_bidvalue[]" value="<?php echo number_format($Tvalue['bid_value'],2); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <select  class="form-control show-tick" name="finsucc_biddername[]" >
                                            
                                            <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option>  
                                        </select>
                                    </div> 
                                    
                                    <div class="col-md-2">
                                        
                                        <input class="form-control txtQty" type="text"  placeholder="Final Score" value="<?php echo $Tvalue['final_score']; ?>" name="final_score[]">
                                    </div>
                                    <!-- <div class="col-md-1 p-t-25">
                                            <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                     </div> -->
                                    
                                </div>
                                <?php 
                                 }
                                else{
                                 ?>   
                                    <div id="bidder-details-row" >
                                      <div class="row"> 
                                        <div class="col-md-3">
                                            <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name"  name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_ref_no']; ?>"> 

                                            <input class="form-control bidderrefno" type="hidden" name="finbidder_refnoid[]" value="<?php echo $Tvalue['id']; ?>">
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control txtQty" type="text" placeholder="Successful Bid Value" name="finsucc_bidvalue[]" 
                                             value="<?php echo number_format($Tvalue['bid_value'],2); ?>"> 
                                        </div>
                                        <div class="col-md-3">
                                            
                                             <select  class="form-control show-tick" name="finsucc_biddername[]">
                                            
                                            <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option>
                                            </select> 
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control txtQty" type="text" placeholder="Final Score" name="final_score[]" value="<?php echo $Tvalue['final_score']; ?>"> 
                                        </div>
                                        <!-- <div class="col-md-1">
                                           <button class="btn btn-default btn-circle waves-effect waves-circle waves-float  bidder-details-row bidder-details-remove" type="button" id="<?php echo $Tvalue['id']; ?>" ><i class="material-icons col-pink">delete</i></button> 

                                        </div> -->
                                       
                                    </div>
                                 </div>     
                                 <?php } ?>


                                 <?php $k++; 

                                 }
  
                                ?>
                               
                              <?php }  ?>
                                
                                <!-- ============ -->
                                <?php
                                     if(!empty($financial_evalution_data_form_technical)){
                                 ?>
                               
                                <?php 
                                  $k = 1;
                                  $get_same_datacnt1 = count($financial_evalution_data_form_technical);
                          
                                  foreach ($financial_evalution_data_form_technical as $Tvalue) {
                                  if($k == 1){
                        
                                ?>
                                 <div class="row">
                                    <div class="col-md-3">
                                        <p><b>Bidder Ref. No./Name</b></p>
                                        <input class="form-control bidderrefno" type="text"  placeholder="Bidder Ref No/Name" name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_ref_no']; ?>">

                                        <input class="form-control bidderrefno" type="hidden"  placeholder="Bidder Ref No/Name" name="finbidder_refnoid[]" value="<?php echo $Tvalue['id']; ?>">
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <p><b>Successful Bid Value</b></p>
                                        <input class="form-control txtQty" type="text"  placeholder="Successful Bid Value" name="finsucc_bidvalue[]" value="<?php echo number_format($Tvalue['bid_value'],2); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <p><b>Status</b></p>
                                        <select  class="form-control show-tick" name="finsucc_biddername[]" >
                                             <option value="0">Select...</option> 
                                             <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option> 
                                        </select>
                                    </div> 
                                    
                                    <div class="col-md-2">
                                        <p><b>Final Score</b></p>
                                        <input class="form-control txtQty" type="text"  placeholder="Final Score" value="<?php echo $Tvalue['final_score']; ?>" name="final_score[]">
                                    </div>
                                    <!-- <div class="col-md-1 p-t-25">
                                            <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                     </div> -->
                                    
                                </div>
                                <?php 
                                 }
                                else{
                                 ?>   
                                    <div id="bidder-details-row">
                                      <div class="row"> 
                                        <div class="col-md-3">
                                            <input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name"  name="finbidder_refno[]" readonly value="<?php echo $Tvalue['bidder_ref_no']; ?>"> 

                                            <input class="form-control bidderrefno" type="hidden"  placeholder="Bidder Ref No/Name" name="finbidder_refnoid[]" value="<?php echo $Tvalue['id']; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control txtQty" type="text" placeholder="Successful Bid Value" name="finsucc_bidvalue[]" value="<?php echo number_format($Tvalue['bid_value'],2); ?>"> 
                                        </div>
                                        <div class="col-md-3">
                                            
                                             <select  class="form-control show-tick" name="finsucc_biddername[]">
                                            <option value="0">Select...</option> 
                                            <option value="L1" <?php echo set_select('finsucc_biddername','L1', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L1" ? TRUE : FALSE )); ?>>L1
                                            </option>
                                            <option value="L2"  <?php echo set_select('finsucc_biddername','L2', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L2" ? TRUE : FALSE )); ?>>L2
                                            </option>
                                            <option value="L3"  <?php echo set_select('finsucc_biddername','L3', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "L3" ? TRUE : FALSE )); ?>>L3
                                            </option> 
                                            <option value="N"  <?php echo set_select('finsucc_biddername','N', ( !empty($Tvalue['successful_bidder']) &&
                                                $Tvalue['successful_bidder'] == "N" ? TRUE : FALSE )); ?>>Others
                                            </option> 
                                        </select> 
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control txtQty" type="text" placeholder="Final Score" name="final_score[]" value="<?php echo $Tvalue['final_score']; ?>"> 
                                        </div>
                                        <!-- <div class="col-md-1">
                                           <button class="btn btn-default btn-circle waves-effect waves-circle waves-float  bidder-details-row bidder-details-remove" type="button" id="<?php echo $Tvalue['id']; ?>" ><i class="material-icons col-pink">delete</i></button> 

                                        </div> -->
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
                                    
                                    <div class="col-md-4">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Financial Evaluation Date</b></p>
                                              <input type="text" name="approval_date" id="meeting_date" value="<?php echo ($get_financialeval[0]['approval_date'] != '0000-00-00') ? $get_financialeval[0]['approval_date'] : '' ?>" class="datepicker form-control" placeholder="Please choose a date...">   
                                       </div>
                                    </div>
                                     <div class="col-md-4">
                                         <p> <b>Financial Evaluation Completed</b> </p>
                                         <select  class="form-control" name="approval_status" id="prebid_conf">
                                                <option value="">Select..</option>
                                                <option value="Y" <?php echo set_select('approval_status','Y', ( !empty($get_financialeval[0]['approval_status']) && $get_financialeval[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Yes
                                                </option> 
                                                <option value="P" <?php echo set_select('approval_status','P', ( !empty($get_financialeval[0]['approval_status']) && $get_financialeval[0]['approval_status'] == "P" ? TRUE : FALSE )); ?>>No
                                                </option>  
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <p> <b> Remarks </b></p>
                                        <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                        <textarea class="form-control no-resize" maxlength="250" name="remarks" id="maxremarks" rows="3" placeholder="Please type what you want..."><?php if(empty($get_financialeval)){ echo set_value('remarks'); }?><?php echo $get_financialeval[0]['remarks'] ?></textarea>
                                         <span id="warning-message" style='color:#ff0000'></span>
                                    </div>

                                </div>
                               </div>
                              
                                <?php  if(!empty($financial_evalution_data)) { ?>
                                <div class="col-md-12 align-center">
                                    <a href="<?php echo base_url();?>published_tender/pp_finacial_evalution" class="btn btn-warning waves-effect">CANCEL</a>
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"   type="submit">Update</button>
                                    
                                </div>
                              <?php }
                              else
                              {
                              ?>
                                 <div class="col-md-12 align-center">
                                      <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"   onclick="checkSubmitStatus(event );"  type="submit">Submit</button> 
                                </div>
                             <?php } ?>
                                <div class="clearfix"></div>
                            </div>

                          </div>
                      </div>
                  </div>
                </form>
            <!-- Select -->

        </div>
    </section>
    <!-- #Main Content -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
   

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
        $(".bidder-details-container").append('<div id="bidder-details-row"><div class="row"> <div class="col-md-3"><input class="form-control bidderrefno" type="text" placeholder="Bidder Ref No/Name" name="finbidder_refno[]"> </div><div class="col-md-3"><input class="form-control txtQty_'+divid+'" type="text" placeholder="Successful Bid Value" name="finsucc_bidvalue[]"> </div><div class="col-md-3"><select class="form-control" name="finsucc_biddername[]"><option value="0">Select..</option><option value="L1">L1</option><option value="L2">L2</option><option value="L3">L3</option><option value="N">Others</option></select> </div><div class="col-md-2"><input class="form-control txtQty_'+divid+'" type="text" placeholder="Final Score " name="final_score[]"> </div><div class="col-md-1"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button> </div></div></div>');
        
        $('.txtQty_'+divid+'').keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
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
        $('#meeting_date').after("<span class='error' style='color:#ff0000'>Please Enter Financial Evalution date.</span>");
        event.preventDefault();
        }

   }


   $(document).ready(function(){  
        
      $(document).on('click', '.bidder-details-row', function(){  
           var user_id = $(this).attr("id"); 
           
           
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>Financial_Evalution/delete_single_user",  
                     method:"POST",  
                     data:{user_id:user_id},  
                     success:function(data)  
                     {  
                          //alert('ajax success');
                          //location.reload(); 
                          alert(data);  
                        
                     }  
                });  
           }  
           else  
           {  
                return false;       
           }  
      });  
 });  

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
   
</script>

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>

