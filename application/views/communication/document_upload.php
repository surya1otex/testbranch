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

    <?php
       
        if($user_id == $get_communication[0]['entered_by']) { ?>
          <?php echo form_open_multipart('Document_upload/manage', array('name' => 'document_upload','id' => 'document_upload'));
       }

        else {
          echo form_open_multipart('Issue_create/manage', array('name' => 'document_upload','id' => 'document_upload')); 
      }
      ?>
        <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Create Issue </h2>

                        </div>
                        <div class="body">
                            <div class="m-b-15">
                                <div class="row">
                                 <div class="col-md-4">
                                        <p><b>Communication Subject</b></p>
                                        <input class="form-control" type="text" name="issue_name" value="<?php echo $get_communication[0]['issue_name']; ?>" placeholder="Issue Name">
                                        <?php echo form_error('issue_name', '<div class="error">', '</div>'); ?>
                                    </div>
                                 <div class="col-md-4">
                                        <p><b>Issuer Name</b></p>
                                        <input class="form-control" type="text" name="issuer_name" value="<?php echo $get_communication[0]['issuer_name']; ?>" placeholder="Issuer Name">
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Communication Type</b></p>
                                        <select  class="form-control" name="communication_type">
                                            <option value="0">All Communications</option>
                                          <?php 
                                               foreach($communications as $com)
                                              { ?>
                                               <option value="<?php echo $com->id; ?>" <?php if ((!empty($get_communication[0]['communication_type']) && $get_communication[0]['communication_type'] == $com->id) || $_REQUEST['communication_type'] == $com->id) {
                                            echo "selected";
                                        } ?>><?php echo $com->communication_type; ?></option>';
                                               <?php
                                              }

                                           ?>
                                        </select>
                                    </div>

                                  </div>
                                  <div class="row">
                                    <div class="col-md-4">
                                        <p><b>Address Name</b></p>
                                        <input type="text" class="form-control" maxlength="250" id="address" name="addressee_name" placeholder="Please type what you want..." value="<?php echo $get_communication[0]['addressee_name']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Timeline (If Mentioned)</b></p>
                                        <input class="datepicker form-control" type="text" name="timeline" value="<?php echo $get_communication[0]['timeline']; ?>" placeholder="Optional">
                                    </div>

                                    <div class="col-md-4">
                                    <p><b>Synopsis Of The Communication</b></p>
                                    <textarea class="form-control no-resize" name="synopsis" rows="1" placeholder="Please type what you want..."><?php echo $get_communication[0]['synopsis']; ?></textarea>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">

                  

                        <?php
                                     if(!empty($get_documents)){
                                    ?>

 

                                    <?php 
                                      $k = 1;
                                      $get_same_datacnt = count($get_documents);
                              
                                      foreach ($get_documents as $documents) {
                                      if($k == 1){
                            
                                    ?>
                                <div class="doc-details-container m-b-15">
                                 <div class="row">
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">Select Owner</option>

                                          <?php 
                                               foreach($doc_owner as $owner)
                                              {
                                                ?>

                                              <option value="<?php echo $owner->id; ?>"><?php echo $owner->username; ?></option>
                                               <?php 
                                              }

                             ?>
                        </select>
                                    <div class="col-md-4">
                                        <p><b>Document Name</b></p>
                                        <input class="form-control" type="text" name="document_name[]" value="<?php echo $documents->document_name; ?>" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-3" style="display: none;">
                                        <p><b>Document Owner</b></p>
                                        <select  class="form-control" name="document_owner[]">
                                             <option value="0">Select Owner</option>
                                          <?php 
                                               foreach($doc_owner as $owner)
                                              { 
                                                ?>

                                          <option value="<?php echo $owner->id; ?>" <?php if ((!empty($documents->document_owner) && $documents->document_owner == $owner->id) || $_REQUEST['document_owner'] == $owner->id) {
                                            echo "selected";
                                        } ?>><?php echo $owner->username; ?></option>
                                                <?php
                                              }

                                           ?>
                                        </select>
                                    </div> 
                                    <div class="col-md-4">
                                        <p><b>Upload Document</b></p>
                                        <input type="file" name="files[]" multiple="" class="form-control upload_file" id="uploadFile1">
                                        <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                        <?php
                                         if(!empty($documents->communication_file)) {
                                            ?>
                                         <a href="<?php echo base_url();?>uploads/files/doc_upload/<?php echo str_replace(' ', '_', $documents->communication_file); ?>" title="Download" download>
                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i></a>
                                      <?php
                                         }
                                        ?>
                                        <input type="hidden" name="file_hidden[]" value="<?php echo $documents->communication_file ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Document Date</b></p>
                                        <input type="text" id="approve" name="date[]" class="datepicker form-control" value="<?php echo $documents->document_date; ?>" placeholder="Please choose a date...">
                                    </div> 
                                    <div class="col-md-1 p-t-25">
                                        <button class="btn btn-success btn-circle waves-effect waves-circle waves-float doc-add" type="button"><i class="material-icons">add</i></button>
                                    </div>
                                </div>

 

                                 
                                <?php 
                                 }
                                else{
                                 ?>
                            <div id="doc-details-row">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" placeholder="Document Name" name="document_name[]" value="<?php echo $documents->document_name; ?>">
                                    </div>
                                    <div class="col-md-3" style="display: none;"> 
                                        <select class="form-control" name="document_owner[]">
                                             <option value="0">Select Owner</option>
                                          <?php 
                                               foreach($doc_owner as $owner)
                                              {
                                                ?>
                                               <option value="<?php echo $owner->id; ?>" <?php if ((!empty($documents->document_owner) && $documents->document_owner == $owner->id) || $_REQUEST['document_owner'] == $owner->id) {
                                            echo "selected";
                                        } ?>><?php echo $owner->username; ?></option>
                                               <?php
                                              }

                                           ?>
                                      </select>
                                         </div>
                                         <div class="col-md-4"> 
                                            <input type="file" name="files[]" multiple="" class="form-control upload_file" id="uploadFile<?php echo $k; ?>">
                                            <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                        <?php
                                         if(!empty($documents->communication_file)) {
                                            ?>
                                         <a href="<?php echo base_url();?>uploads/files/doc_upload/<?php echo str_replace(' ', '_', $documents->communication_file); ?>" title="Download" download>
                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i></a>
                                      <?php
                                         }
                                        ?>
                                        <input type="hidden" name="file_hidden[]" value="<?php echo $documents->communication_file ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"  class="datepicker form-control" name="date[]" value="<?php echo $documents->document_date; ?>" placeholder="Please choose a date...">
                                        </div>
                                        <div class="col-md-1">
                                         <button class="btn btn-default btn-circle waves-effect waves-circle waves-float doc-remove" type="button"><i class="material-icons col-pink">delete</i>
                                         </button>
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
                                <div class="doc-details-container m-b-15">
                                 <div class="row">
                                    <div class="col-md-4">
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">Select Owner</option>

                                          <?php 
                                               foreach($doc_owner as $owner)
                                              {
                                               echo '<option value="'.$owner->id.'">'.$owner->username.'</option>';
                                              }

                             ?>
                        </select>
                                        <p><b>Document Name</b></p>
                                        <input class="form-control" type="text" name="document_name[]" value="<?php echo $documents->document_name; ?>" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-3" style="display:none">
                                        <p><b>Document Owner</b></p>
                                        <select  class="form-control" name="document_owner[]">
                                             <option value="0">Select Owner</option>
                                          <?php 
                                               foreach($doc_owner as $owner)
                                              {
                                               echo '<option value="'.$owner->id.'">'.$owner->username.'</option>';
                                              }

                                           ?>
                                        </select>
                                    </div> 
                                    <div class="col-md-4">
                                        <p><b>Upload Document</b></p>
                                        <input type="file" name="files[]" multiple="" class="form-control upload_file" id="uploadFile1">
                                        <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Document Date</b></p>
                                        <input type="text" id="approve" name="date[]" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div> 
                                    <div class="col-md-1 p-t-25">
                                        <button class="btn btn-success btn-circle waves-effect waves-circle waves-float doc-add" type="button"><i class="material-icons">add</i></button>
                                    </div>
                                </div>   
 

                                 <?php } ?>


                        
                            </div>




                            <div class="col-md-12 align-center">
                            <button class="btn btn-primary waves-effect" name="submit" id="submit_btn" value="Submit" type="submit">SAVE</button>
                            </div>
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
<script>
    //Bidder details add remove 
    var optionValues = $("#hidden_dist_fetch").html();
    var k = 1;
    $(".doc-add").click(function () {

      k++;

       // $('.datepicker').bootstrapMaterialDatePicker();


        $(".doc-details-container").append('<div id="doc-details-row"><div class="row"><div class="col-md-4"><input class="form-control" type="text" placeholder="Document Name" name="document_name[]"></div><div class="col-md-4"><input type="file" name="files[]" id="uploadFile'+k+'" multiple="" class="form-control upload_file"><p>(File type pdf,jpg,gif,docs and max file size 50mb)</p></div><div class="col-md-2"><input type="text" id="approve" class="datepicker form-control" name="date[]" placeholder="Please choose a date..."></div><div class="col-md-1"> <button class="btn btn-default btn-circle waves-effect waves-circle waves-float doc-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');

    $('.datepicker').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true,
        minDate:new Date()
      });

    $('#uploadFile'+ k).change(function (){
      var fileExtension = ['png','pdf','jpg','docs'];
      var MAX_FILE_SIZE = 50 * 1024 * 1024;
       if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
        swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
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

});
    
     $("body").on("click", ".doc-remove", function() {
     $(this).closest('#doc-details-row').remove();
     });

</script>
<script type="text/javascript">
var maxLength = 250;
  $(document).ready(function(){
    $('#address').on('keydown keyup change', function(){
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


var biddercount = $(".upload_file").length;

//alert(biddercount);
for (let i = 1; i <= biddercount; i++) {
$('#uploadFile'+i).change(function (){
   var fileExtension = ['png','pdf','jpg','docs'];
   var MAX_FILE_SIZE = 50 * 1024 * 1024;
     if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1){
      swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
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
</style>
</html>