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
            <h4> Tendering - Pre-bid Conference</h4>
        </div>
            
    <!-- Steps start -->      
          <?php
         // project_tendering_steps($project_id);
        ?>
    <!-- Steps end --> 
    <!--    Project_Information -->                   
                  
       <?php
        if(is_numeric($project_id)){
            project_info($project_id);
        }
    
        ?>                   
    <!--    Project_Information End -->  
     
    <?php echo form_open_multipart('Pre_bid_conference/manage', array('name' => 'Pre_bid_conference','id' => 'Pre_bid_conference')); ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
            
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="bidder-details-container"  id="bidder_ref_number">

                                             <div class="col-md-4" style="display: none;">
                                              <p> <b>Country</b> </p>
                                            
                                                <select id="hidden_state_fetch">
                                                  <option value="0">Select Country</option>
                                                     <?php 
                                                           foreach($fetch_country as $country)
                                                           {
                                                           echo '<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                                                           }

                                                     ?>
                                                </select>                      
                                             </div>

                                   <?php
                                     if(!empty($prebid_bidder_data)){
                                    ?>

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt = count($prebid_bidder_data);
                              
                                      foreach ($prebid_bidder_data as $Tvalue) {
                                      if($k == 1){
                            
                                    ?>

                                  <div class="card clearfix">
                                     <div class="header">
                                        <h2> Bidder Information </h2>
                                     </div>
                                     
                                     <div class="body">
                                   
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><b>Bidder Ref No/Name</b> <span class="col-pink">*</span> </p>
                                                <input class="form-control bidderrefno " type="text" id="biddername<?php echo $k ?>" value="<?php echo $Tvalue['bidder_name']; ?>"  name="bidder_name[]" placeholder="Bidder Name" >
                                                <?php echo form_error('bidder_name[]', '<div class="error">', '</div>'); ?>
                                            </div>


                                             <div class="col-md-4">
                                              <p> <b>Country</b> </p>
                                                                
                                                  <select  class="form-control" name="prebid_country[]" id="country_1" onchange="statefunc(1)">
                                                    <option value="0">Select Country</option>
                                                

                                                 <?php   foreach ($fetch_country as $country){?>
                                                       <option value="<?php echo $country['country_id']; ?>"  <?php if($country['country_id'] == $Tvalue['country_id']){ echo "selected"; } ?> ><?php echo $country['country_name']; ?></option>

                                                  <?php } ?>
                                                </select>
                                                
                                               </div>

                                            <div class="col-md-4">
                                            <p> <b>State</b> </p>
                                            
                                                <select  class="form-control" id="state_id_1" name="prebid_state[]">
                                                 <option value="0">Select State</option>
                                                  <?php
                                                    echo $CI->gettehsilSelection_data($Tvalue['country_id'],$Tvalue['state_id']);
                                                    ?>  
                                                  
                                               </select>
                                                
                                            </div>
                                         </div>
                                           <div class="row">
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                       <p></p> <br/>
                                                        <select  class="form-control" name="prebid_salutation[]">
                                                            
                                                            <option value="Mr" <?php echo set_select('prebid_salutation','Mr', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Mr" ? TRUE : FALSE )); ?>>Mr</option>
                                                            <option value="Mrs"  <?php echo set_select('prebid_salutation','Mrs', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Mrs" ? TRUE : FALSE )); ?>>Mrs</option>
                                                            <option value="Ms"  <?php echo set_select('prebid_salutation','Ms', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Ms" ? TRUE : FALSE )); ?>>Ms</option>   
                                                        </select> 
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p> <b>First Name</b> </p>
                                                        <input class="form-control" type="text" name="prebid_first_name[]" value="<?php echo $Tvalue['first_name']; ?>" placeholder="First Name">
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <p> <b>Middle Name</b> </p>
                                                    <input class="form-control" type="text" name="prebid_middle_name[]" value="<?php echo $Tvalue['middle_name']; ?>" placeholder="Middle Name">
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <p> <b>Last Name</b> </p>
                                                    <input class="form-control" type="text" name="prebid_last_name[]" value="<?php echo $Tvalue['last_name']; ?>" placeholder="Last Name">
                                                    </div>
                                                </div>
                                             </div>

                                           </div>
                                           

                                           <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                          
                                                        <div class="col-md-12">
                                                            <p> <b>Mobile Number</b> </p>
                                                            <input class="form-control txtQty mobile-valid" type="text" id="prebidmobile<?php echo $k ?>" name="prebid_mobile[]" value="<?php echo $Tvalue['mobile_no']; ?>" placeholder="Enter Mobile No.">
                                                            <span ></span>
  
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                         <p class="col-md-12"><b>Land Phone Number</b> </p>
                                                        <div class="col-md-4">
                                                            <input class="form-control txtQty mobile-valid" type="text" id="prebidlstd<?php echo $k ?>" name="prebid_std_code[]" value="<?php echo $Tvalue['std']; ?>" placeholder="STD">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control txtQty mobile-valid" type="text" id="prebidlandnum<?php echo $k ?>" name="prebid_land_phone[]" value="<?php echo $Tvalue['land_no']; ?>" placeholder="Enter Land Phone No.">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p> <b>Email Address</b> </p>
                                                            <input class="form-control email" type="text" name="prebid_email[]" value="<?php echo $Tvalue['email_id']; ?>" placeholder="Enter Email Id">
                                                            <?php echo form_error('prebid_email', '<div class="error">', '</div>'); ?>
                                                       </div>
                                                    </div>
                                                </div>
                                               
                                           </div>   
                                           <div class="col-md-12 text-right">
                                              <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                          </div>  

                                    </div>
                                </div>
                                <?php 
                                 }
                                else{
                                 ?>
                                    
                                     
                             <div id="bidder-details-row">
                                <div class="card clearfix">
                                   
                                    <div class="body">
                                        <div class="row">
                                              <div class="col-md-4">
                                                    <p><b>Bidder Ref No/Name</b><span class="col-pink">*</span></p> 
                                                    <input class="form-control bidderrefno" type="text" id="biddername<?php echo $k ?>" name="bidder_name[]" value="<?php echo $Tvalue['bidder_name']; ?>"  placeholder="Bidder Name" >
                                                    <?php echo form_error('bidder_name[]', '<div class="error">', '</div>'); ?>
                                              </div>

                                               <div class="col-md-4">
                                                    <p> <b>Country</b></p> 
                                                    <select class="form-control" name="prebid_country[]" id="country_<?php echo $k; ?>" onchange="statefunc(<?php echo $k; ?>)">
                                                 <option value="0">Select Country</option>
                                                  <?php   foreach ($fetch_country as $country){?>
                                                       <option value="<?php echo $country['country_id']; ?>"  <?php if($country['country_id'] == $Tvalue['country_id']){ echo "selected"; } ?> ><?php echo $country['country_name']; ?></option>

                                                  <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <p> <b>State</b></p>
                                                    <select class="form-control" name="prebid_state[]" id="state_id_<?php echo $k; ?>"> 
                                                 <?php
                                                    echo $CI->gettehsilSelection_data($Tvalue['country_id'],$Tvalue['state_id']);
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p></p> <br/> 
                                                            <select  class="form-control" name="prebid_salutation[]">
                                                                <option value="Mr" <?php echo set_select('prebid_salutation','Mr', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Mr" ? TRUE : FALSE )); ?>>Mr</option>
                                                               <option value="Mrs"  <?php echo set_select('prebid_salutation','Mrs', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Mrs" ? TRUE : FALSE )); ?>>Mrs</option>
                                                               <option value="Ms"  <?php echo set_select('prebid_salutation','Ms', ( !empty($Tvalue['abbreviation']) && $Tvalue['abbreviation'] == "Ms" ? TRUE : FALSE )); ?>>Ms</option> 
                                                            </select>
                                                        </div> 
                                                        <div class="col-md-8">
                                                         <p> <b>First Name</b> </p> 
                                                         <input class="form-control" type="text" name="prebid_first_name[]" value="<?php echo $Tvalue['first_name']; ?>" placeholder="First Name">
                                                         
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p> <b>Middle Name</b> </p>
                                                         <input class="form-control" type="text" name="prebid_middle_name[]" value="<?php echo $Tvalue['middle_name']; ?>" placeholder="Middle Name">
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                 <div class="col-md-12">
                                                    <p> <b>Last Name</b> </p> 
                                                    <input class="form-control" type="text" name="prebid_last_name[]" value="<?php echo $Tvalue['last_name']; ?>" placeholder="Last Name">
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                         <div class="row">
                                            <div class="col-md-12">
                                                <p> <b>Mobile Number</b> </p>
                                                <input class="form-control txtQty mobile-valid" type="text" name="prebid_mobile[]" id="prebidmobile<?php echo $k ?>" value="<?php echo $Tvalue['mobile_no']; ?>" placeholder="Enter Mobile No.">
                                            </div>
                                         </div>
                                         </div>
                                         <div class="col-md-4">
                                            <div class="row">
                                                <p class="col-md-12"><b>Land Phone Number</b> </p> 
                                                <div class="col-md-4">
                                                    <input class="form-control txtQty mobile-valid" type="text" id="prebidlstd<?php echo $k ?>" name="prebid_std_code[]" value="<?php echo $Tvalue['std']; ?>" placeholder="STD">
                                                </div>
                                                <div class="col-md-8">
                                                    <input class="form-control txtQty mobile-valid" type="text" id="prebidlandnum<?php echo $k ?>" name="prebid_land_phone[]" value="<?php echo $Tvalue['land_no']; ?>" placeholder="Enter Land Phone No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <p> <b>Email Address</b> </p> 
                                                <input class="form-control email" type="text" name="prebid_email[]" value="<?php echo $Tvalue['email_id']; ?>" placeholder="Enter Email Id"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
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
                                   
                                     <div class="card clearfix" >
                                     <div class="header">
                                        <h2> Bidder Information </h2>
                                     </div>
                                     <div class="body">
                                   
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><b>Bidder Ref No/Name</b> <span class="col-pink">*</span></b> </p>
                                                <input class="form-control bidderrefno" type="text" id="biddername<?php echo $k ?>" name="bidder_name[]" placeholder="Bidder Name"  value="<?php echo set_value('bidder_name[0]'); ?>" >

                                                <?php echo form_error('bidder_name[]', '<div class="error">', '</div>'); ?>
                                            </div>

                                            <div class="col-md-4">
                                                <p> <b>Country</b> </p>
                                            
                                                <select  class="form-control" name="prebid_country[]" id="country_1" onchange="statefunc(1)">
                                                <option value="0">Select Country</option>
                                                 <?php 
                                                       foreach($fetch_country as $country)
                                                       {
                                                       echo '<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                                                       }

                                                 ?>   
                                            </select>
                                                
                                            </div>

                                            <div class="col-md-4">
                                                <p> <b>State</b> </p>
                                            
                                                <select  class="form-control" id="state_id_1" name="prebid_state[]">
                                                  <option value="0">Select State</option>
                                               </select>
                                                
                                            </div>
                                         </div>
                                           <div class="row">
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                       <p></p> <br/>
                                                        <select  class="form-control" name="prebid_salutation[]">
                                                            <option value="0">Select</option>
                                                            <option value="Mr" <?php echo set_select('prebid_salutation[0]','Mr'); ?>>Mr</option>
                                                            <option value="Mrs" <?php echo set_select('prebid_salutation[0]','Mrs'); ?>>Mrs</option>
                                                            <option value="Ms" <?php echo set_select('prebid_salutation[0]','Ms'); ?>>Ms</option>   
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p> <b>First Name</b> </p>
                                                        <input class="form-control" type="text" name="prebid_first_name[]"  placeholder="First Name"  value="<?php echo set_value('prebid_first_name[0]'); ?>" >
                                                        
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <p> <b>Middle Name</b> </p>
                                                    <input class="form-control" type="text" name="prebid_middle_name[]"  placeholder="Middle Name"
                                                    value="<?php echo set_value('prebid_middle_name[0]'); ?>">
                                                    </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <p> <b>Last Name</b> </p>
                                                    <input class="form-control" type="text" name="prebid_last_name[]"  placeholder="Last Name"
                                                     value="<?php echo set_value('prebid_last_name[0]'); ?>">
                                                    </div>
                                                </div>
                                             </div>
                                           </div>
                                           

                                           <div class="row">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p> <b>Mobile Number</b> </p>
                                                            <input class="form-control txtQty mobile-valid" type="text" name="prebid_mobile[]" id="prebidmobile<?php echo $k ?>"  placeholder="Enter Mobile No."

                                                            value="<?php echo set_value('prebid_mobile[0]'); ?>">
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                         <p class="col-md-12"><b>Land Phone Number</b> </p>
                                                        <div class="col-md-4">
                                                            <input class="form-control txtQty mobile-valid" type="text" id="prebidlstd<?php echo $k ?>" name="prebid_std_code[]"  placeholder="STD" value="<?php echo set_value('prebid_std_code[0]'); ?>">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control txtQty mobile-valid" type="text" id="prebidlandnum<?php echo $k ?>" name="prebid_land_phone[]"  placeholder="Enter Land Phone No." value="<?php echo set_value('prebid_land_phone[0]'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p> <b>Email Address</b> </p>
                                                            <input class="form-control email" type="text" name="prebid_email[]"  placeholder="Enter Email Id" value="<?php echo set_value('prebid_email[0]'); ?>">
                                                       </div>
                                                    </div>
                                                </div>
                                               
                                           </div>   
                                           <div class="col-md-12 text-right">
                                              <button class="btn btn-success btn-circle waves-effect waves-circle waves-float bidder-details-add" type="button"><i class="material-icons">add</i></button>
                                          </div>  

                                    </div>
                                </div>

                                     

                                 <?php } ?>
                    </div>
              
                </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="card clearfix">
                             <div class="header">
                                 <h2> Attachment-Pre-Bid  </h2>
                             </div>
                            <div class="body clearfix">
                                <div class="clearfix  m-b-15">
                                
                                    
                                    <div class="upload-clarification-container">

                                   <?php
                                     if(!empty($prebid_file)){
                                    ?>

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt2 = count($prebid_file);
                              
                                      foreach ($prebid_file as $filenamevalue) {
                                      if($k == 1){
                            
                                    ?>
                                      <div class="row">
                                             <div class="col-md-6 p-0">
                                                <p><b>Upload Pre-bid Clarifications</b>(File type pdf,jpg,gif,docs and max file size 50mb)
                                                </p>
                                                <input  class="form-control upload_file" type="file" name="prebid_doc[]"  id="uploadFile<?php echo $k ?>">
                                                   <?php if (!empty($filenamevalue['document_name'])) { ?>
                                                    <a href="<?php echo base_url();?>uploads/files/prebid/<?php echo $filenamevalue['document_name']; ?>" title="Download" download>
                                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                  <?php } ?>

                                                  <input type="hidden" name="prebid_doc_hidden[]" value="<?php echo $filenamevalue['document_name']; ?>" />
                                            </div>
                                            <div class="col-md-1 p-0">
                                            </div>

                                            <div class="col-md-3 p-0">

                                              <p> <b>Corrigendum / Addendum Issuance Date</b> <span class="col-pink">*</span></p>
                                                <input class="datepicker form-control corrissuedate" type="text" placeholder="Please Choose a Date..." name="corrigendum_issue_date[]" id="corrigendum_issue<?php echo $k ?>" value="<?php if(empty($filenamevalue)){ echo set_value('corrigendum_issue_date'); }?><?php echo $filenamevalue['corrigendum_issuance_date'] ?>">
                                                <!--  <input type="text" name="corrigendum_issuance_date_hidden[]" value="<?php echo $filenamevalue['corrigendum_issuance_date']; ?>" /> -->
                                            </div>


                                            <div class="col-md-2 p-t-45">
                                                <button class="btn btn-success btn-circle waves-effect waves-circle waves-float upload-clarification-add" type="button"><i class="material-icons">add</i></button>
                                            </div>
                                        </div>
                                <?php 
                                 }
                                else{
                                 ?>

                                  <div id="upload-clarification-row">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <input class="form-control upload_file" type="file" name="prebid_doc[]" id="uploadFile<?php echo $k ?>">
                                             <?php if (!empty($filenamevalue['document_name'])) { ?>
                                                        <a href="<?php echo base_url();?>uploads/files/prebid/<?php echo $filenamevalue['document_name']; ?>" title="Download" download>
                                                          <i class="fa fa-download fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                      <?php } ?>
                                              <input type="hidden" name="prebid_doc_hidden[]" value="<?php echo $filenamevalue['document_name']; ?>" />
                                        </div>
                                        <div class="col-md-1 p-0">
                                        </div>

                                         <div class="col-md-3 p-0">
                                          
                                            <input class="datepicker form-control corrissuedate" type="text" placeholder="Please Choose a Date..." name="corrigendum_issue_date[]" id="corrigendum_issue<?php echo $k ?>" value="<?php if(empty($filenamevalue)){ echo set_value('corrigendum_issue_date'); }?><?php echo $filenamevalue['corrigendum_issuance_date'] ?>">
                                            <!-- <input type="text" name="corrigendum_issuance_date_hidden[]" value="<?php echo $filenamevalue['corrigendum_issuance_date']; ?>" /> -->
                                        </div>

                                        <div class="col-md-2"> 
                                            <button class="btn btn-default btn-circle waves-effect waves-circle waves-float upload-clarification-remove" type="button"><i class="material-icons col-pink">delete</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                    

                                <?php } ?>


                                <?php $k++; 

                                  }

                                  ?>
                               
                                  <?php } ?>

                                <!-- =============== -->
                                 <?php
                                   if(empty($prebid_file)){
                                  ?>
                                  <?php 
                                      $k = 1;
                                       if($k == 1){
                                  ?>
                                      <div class="col-md-6 p-0">
                                         <p><b>Upload Pre-bid Clarifications</b>(File type pdf,jpg,gif,docs and max file size 50mb)
                                        </p>
                                        <input  class="form-control upload_file" type="file" name="prebid_doc[]" id="uploadFile<?php echo $k ?>" >
                                          
                                      </div>
                                      <div class="col-md-1 p-0">
                                            </div>

                                            <div class="col-md-3 p-0">

                                              <p> <b>Corrigendum / Addendum Issuance Date</b> <span class="col-pink">*</span></p>
                                                <input class="datepicker form-control corrissuedate" type="text" placeholder="Please Choose a Date..." name="corrigendum_issue_date[]"
                                               >
                                            </div>

                                      <div class="col-md-2 p-t-45">
                                        <button class="btn btn-success btn-circle waves-effect waves-circle waves-float upload-clarification-add" type="button"><i class="material-icons">add</i></button>
                                      </div> 

                                <?php $k++;  }?>

                                <?php } ?>

                                </div>
                                <!-- <div class="col-md-4 p-0" id="corr_issue_date">
                                    <div class="col-md-12 p-0">
                                        <p> <b>Corrigendum / Addendum Issuance Date</b> <span class="col-pink">*</span></p>
                                        <input class="datepicker form-control corrissuedate" type="text" placeholder="Please choose a date..." name="corrigendum_issue_date"
                                        value="<?php if(empty($get_prebid)){ echo set_value('corrigendum_issue_date'); }?><?php echo $get_prebid[0]['corrigendum_issuance_date'] ?>">
                                    </div>
                                </div> -->
                                </div>

                            </div>
                            
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                        <div class="card clearfix">
                             <div class="header">
                                 <h2> Progress Update </h2>
                             </div>
                            <div class="body clearfix">
                                <div class="clearfix cloneBox1 m-b-15">
                                
                                 <div class="row clearfix">  
                                
                                     <div class="col-md-4" id="prebid_meeting_date">
                                         <div class="col-md-12 p-0">
                                            <p> <b>Prebid Meeting Date</b><span class="col-pink">*</span></p>

                                         <input type="text" name="approval_date"  id="meeting_date" value="<?php echo ($get_prebid[0]['approval_date'] != '0000-00-00') ? $get_prebid[0]['approval_date'] : '' ?>" class="datepicker form-control meetingdate" placeholder="Please choose a date...">                                  

                                       </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                         <p> <b>Pre-bid Completed</b> </p>
                                         <select  class="form-control" name="approval_status" id="prebid_conf">
                                                <option value="">Select..</option>
                                                <option value="Y" <?php echo set_select('approval_status','Y', ( !empty($get_prebid[0]['approval_status']) && $get_prebid[0]['approval_status'] == "Y" ? TRUE : FALSE )); ?>>Yes</option>
                                                <option value="P" <?php echo set_select('approval_status','P', ( !empty($get_prebid[0]['approval_status']) && $get_prebid[0]['approval_status'] == "P" ? TRUE : FALSE )); ?>>No</option>
                                            </select>
                                         
                                    </div>

                                     <div class="col-md-4">
                                        <p> <b> Remarks </b></p>
                                        <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                        <textarea class="form-control no-resize" maxlength="250" name="remarks" id="maxremarks" rows="3" placeholder="Please type what you want..."><?php if(empty($get_prebid)){ echo set_value('remarks'); }?><?php echo $get_prebid[0]['remarks'] ?></textarea>
                                      <span id="warning-message" style='color:#ff0000'></span>
                                    </div>


                                </div>
                                </div>
                                <?php  if(!empty($prebid_bidder_data)) { ?>
                                <div class="col-md-12 align-center">
                                    <a href="<?php echo base_url();?>published_tender/pp_pre_bid" class="btn btn-warning waves-effect">CANCEL</a>
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"   type="submit">Update</button>
                                    
                                </div>
                              <?php }
                              else
                              {
                              ?>
                                 <div class="col-md-12 align-center">
                                     <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit" onclick="checkSubmitStatus(event );"   type="submit">Submit</button>
                                    
                                </div>
                             <?php } ?>

                                <div class="clearfix"></div>
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

<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
   

<script type="text/javascript">
    $(document).ready(function() {
        $('.fade-message').delay(5000).fadeOut(5000);
    });
</script>


<script type="text/javascript">

    <?php
         if($get_same_datacnt > 1) { ?>
            var divid = <?php echo $get_same_datacnt; ?>;
            <?php
         }
         else {
            ?>
            var divid = 1;
            <?php
         }
    ?>

     //Contact add remove
     
     var optionValues = $("#hidden_state_fetch").html();
     $(".bidder-details-add").click(function () {
         divid++;
         //alert(divid);
        
        $(".bidder-details-container").append('<div id="bidder-details-row"><div class="card clearfix"><div class="body"><div class="row"><div class="col-md-4"><p><b>Bidder Ref No/Name</b><span class="col-pink">*</span></p> <input class="form-control bidderrefno" type="text" name="bidder_name[]" id="biddername_'+divid+'" placeholder="Bidder Name" ></div><div class="col-md-4"><p> <b>Country</b></p> <select class="form-control" name="prebid_country[]" id="country_'+divid+'" onchange="statefunc('+divid+');">'+optionValues+'</select></div><div class="col-md-4"><p> <b>State</b></p><select class="form-control" name="prebid_state[]" id="state_id_'+divid+'"><option value="0">Select..</option></select></div></div><div class="row"><div class="col-md-4"><div class="row"><div class="col-md-4"><p></p> <br/> <select  class="form-control" name="prebid_salutation[]"><option value="0">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option> <option value="Ms">Ms</option></select></div> <div class="col-md-8"> <p> <b>First Name</b> </p> <input class="form-control" type="text" name="prebid_first_name[]" placeholder="First Name"></div></div></div><div class="col-md-4"><div class="row"><div class="col-md-12"><p> <b>Middle Name</b> </p> <input class="form-control" type="text" name="prebid_middle_name[]" placeholder="Middle Name"></div></div></div><div class="col-md-4"><div class="row"> <div class="col-md-12"><p> <b>Last Name</b> </p> <input class="form-control" type="text" name="prebid_last_name[]" placeholder="Last Name"></div> </div></div></div><div class="row"><div class="col-md-4"> <div class="row"><div class="col-md-12"><p> <b>Mobile Number</b> </p><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" name="prebid_mobile[]" id="prebidmobile_'+divid+'" placeholder="Enter Mobile No."></div> </div></div><div class="col-md-4"><div class="row"><p class="col-md-12"><b>Land Phone Number</b> </p> <div class="col-md-4"><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" id="prebidlstd_'+divid+'" name="prebid_std_code[]"  placeholder="STD"></div><div class="col-md-8"><input class="form-control txtQty_'+divid+' mobile-valid_'+divid+'" type="text" name="prebid_land_phone[]" id="prebidlandnum_'+divid+'" placeholder="Enter Land Phone No."></div></div></div><div class="col-md-4"><div class="row"> <div class="col-md-12"><p> <b>Email Address</b> </p> <input class="form-control email_'+divid+'" type="text" name="prebid_email[]" placeholder="Enter Email Id"> </div></div></div></div></div><div class="col-md-12 text-right"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float bidder-details-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');
         

$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidmobile_'+divid+'').val();
    if(phone.indexOf('0')==0){
     //alert('First number must not be 0');
     swal(" ", "First number must not be 0", "error");
     $('#prebidmobile_'+divid+'').val('');
    }
   if(phone.length>10){
    // alert('Please put 10  digit mobile number');
     swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidmobile_'+divid+'').val('');
   }

});


$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidlandnum_'+divid+'').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First Land line Number must not be 0", "error");
     $('#prebidlandnum_'+divid+'').val('');
    }
   if(phone.length>10){
     swal(" ", "Please put 10  Land line Number", "error");
     $('#prebidlandnum_'+divid+'').val('');
   }

});

$(document).on('input','.mobile-valid_'+divid+'',function(){
    var phone=$('#prebidlstd'+divid+'').val();
    if(phone.length>10){
     swal(" ", "Please put 10 digit STD Code", "error");
     $('#prebidlstd'+divid+'').val('');
   }

});
    //==============

    $('#biddername_'+divid+'').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9&-/_ ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
      }
   });


     $('.txtQty_'+divid+'').keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));        
     });

    $('.email_'+divid+'').change(function () {    
    var inputvalues = $(this).val();    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
    if(!regex.test(inputvalues)){    
    //alert("Enter valid Email ID"); 
    swal(" ", "Enter valid Email Id", "error"); 
    $('.email_'+divid+'').val('');  
    return regex.test(inputvalues);    
        }    
    });
    //===============

    });
    $("body").on("click", ".bidder-details-remove", function() {
    $(this).closest('#bidder-details-row').remove();
    });
    //Upload clarification add remove 
    //var divid = 1;
    $(".upload-clarification-add").click(function () {
       divid++; 
       $(".upload-clarification-container").append('<div id="upload-clarification-row"><div class="col-md-6 p-0"><input class="form-control" type="file" name="prebid_doc[]"  id="uploadFile_'+divid+'"></div><div class="col-md-1 p-0"></div><div class="col-md-3 p-0"><input class="datepicker form-control corrissuedate" type="date" placeholder="Please Choose a Date..." name="corrigendum_issue_date[]" id="corrigendum_date_'+divid+'"></div><div class="col-md-2"><button class="btn btn-default btn-circle waves-effect waves-circle waves-float upload-clarification-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div>');

//===============

  $('#uploadFile_'+divid+'').change(function () {
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

  
//===============

    });
    $("body").on("click", ".upload-clarification-remove", function() {
    $(this).closest('#upload-clarification-row').remove();
    });

    
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


$(document).ready(function () {        
    
    $(".email").change(function () {    
    var inputvalues = $(this).val();    
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
    if(!regex.test(inputvalues)){    
    //alert("Enter valid Email ID");  
     swal(" ", "Enter valid Email Id", "error");
    $('.email').val('');  
    return regex.test(inputvalues);    
    }    
    });    
    
 });



$(document).on('input','#prebidmobile',function(){
    var phone=$('#prebidmobile').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First number must not be 0", "error");
     $('#prebidmobile').val('');
    }
   if(phone.length>10){
    swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidmobile').val('');
   }

});


$(document).on('input','#prebidlandnum',function(){
    var phone=$('#prebidlandnum').val();
    if(phone.indexOf('0')==0){
     swal(" ", "First number must not be 0", "error");
     $('#prebidlandnum').val('');
    }
   if(phone.length>10){
    swal(" ", "Please put 10  digit mobile number", "error");
     $('#prebidlandnum').val('');
   }

});

$(document).on('input','#prebidlstd',function(){
    var phone=$('#prebidlstd').val();
   if(phone.length>10){
    swal(" ", "Please put 10  digit STD Code", "error");
     $('#prebidlstd').val('');
   }

});



var biddercount = $(".upload_file").length;

    for (let i = 1; i <= biddercount; i++) {
    $('#uploadFile'+ i).change(function (){
            var fileExtension = ['png','pdf','jpg','docx','doc','docs'];
            var MAX_FILE_SIZE = 50 * 1024 * 1024;
             if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
               swal(" ", "Only png,pdf,jpg,docx,doc,docs format is allowed", "error");
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

var biddermobnumbercount = $(".mobile-valid").length;

    for (let i = 1; i <= biddermobnumbercount; i++) {

    $(document).on('input','#prebidmobile'+ i,function(){
        var phone=$('#prebidmobile'+ i).val();
        if(phone.indexOf('0')==0){
        swal(" ", "First number must not be 0", "error");
         $('#prebidmobile'+ i).val('');
        }
       if(phone.length>10){
         swal(" ", "Please put 10  digit mobile number", "error");
         $('#prebidmobile'+ i).val('');
       }

    });
}



var bidderlandnumbercount = $(".mobile-valid").length;

    for (let i = 1; i <= bidderlandnumbercount; i++) {

    $(document).on('input','#prebidlandnum'+ i,function(){
        var phone=$('#prebidlandnum'+ i).val();
        if(phone.indexOf('0')==0){
        swal(" ", "First number must not be 0", "error");
         $('#prebidlandnum'+ i).val('');
        }
       if(phone.length>10){
         swal(" ", "Please put 10  digit mobile number", "error");
         $('#prebidlandnum'+ i).val('');
       }

    });
}



var bidderstdcount = $(".mobile-valid").length;

    for (let i = 1; i <= bidderstdcount; i++) {

    $(document).on('input','#prebidlstd'+ i,function(){
       var phone=$('#prebidlstd'+ i).val();
       if(phone.length>10){
         swal(" ", "Please put 10  digit STD Code", "error");
         $('#prebidlstd'+ i).val('');
       }

    });
}




// ===================

   function checkSubmitStatus( event ){
       $('.error').hide();
       
        $('#bidder_ref_number').find('.bidderrefno').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Enter Bidder Ref No/Name.</span>");
                event.preventDefault();
            }

        });

        $('#corr_issue_date').find('.corrissuedate').each(function (i, input) {

            var $input = $(input);

            if ($(input).val() == '') {
                $(input).after("<span class='error' style='color:#ff0000'>Please Enter Corrigendum / Addendum Issuance Date.</span>");
                event.preventDefault();
            }
        });

        var bidconfirm = $('#prebid_conf').val();
        var bidvalue = $('#meeting_date').val();

        if(bidconfirm == 'Y' && bidvalue == '') {
        $('#meeting_date').after("<span class='error' style='color:#ff0000'>Please Enter Prebid Meeting date.</span>");
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

</script>

<script type="text/javascript">
   
    function statefunc(divid) {
    var value = $('#country_'+divid).val();
    
     if (value != 0)
        {
        $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Pre_bid_conference/getstate_list",
        datatype : 'json',
        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","countryId": value },
        
        success: function(data){
             
        var parsed_data = JSON.parse(data);
        $("#state_id_"+divid).empty();
        
          $val_selec ='';
          var listItems= "";

              if(parsed_data.all_states.length > 0){
                $("#state_id_"+divid).append("<option  value='0'>" +'Select  State' + "</option>");
               for (var i = 0; i < parsed_data.all_states.length; i++)
                   {
                        $("#state_id_"+divid).append(
                            "<option  value='" + parsed_data.all_states[i].state_id  + "'>" + parsed_data.all_states[i]. state_name + "</option>");

                          $val_selec ='';
                    } 
                }

                else
                {
                $("#state_id_"+divid).append("<option  value='0'>" +'Select  State' + "</option>");
                
                  $val_selec =''; 
                }

            }
        });
        }
}
</script>

<style type="text/css">
  .error {
    color: red;
    padding-bottom: 10px;
    font-weight: bold;
  }
</style>


