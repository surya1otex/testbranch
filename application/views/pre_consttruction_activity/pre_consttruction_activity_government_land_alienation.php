   <?php $CI =& get_instance(); ?>

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
                <h4>Pre Project Initiation </h4>
            </div>
            
          <!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">Concept Creation</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>
                    <li class="completed">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>
                    <li class="active">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li>
                    
                    <li class="gray">
                          <span class="circle"><i class="fas fa-list"></i></span>
                          <span class="label">Tender</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end --> 
                             
            
<!--    Project_Information -->
                   
                  
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 
                   
 <!--    Project_Information End -->  
            
            
             
 <!-- Quick Nav   -->
            
	<?php project_quick_nav($project_id);  ?>  
            
<!-- Quick Nav end -->            
<?php echo form_open_multipart('Pre_consttruction_activity_government_land_alienation/manage', array('name' => 'Pre_consttruction_activity_government_land_alienation','id' => 'Pre_consttruction_activity_government_land_alienation')); ?>
    <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>" />
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Government Land Alienation </h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                               <div class="col-md-4">
                                    <p>
                                        <b>Total Area To Be Alienated ( In Acres ) <span class="col-pink">*</span></b>
                                    </p>
                                    
                                    <input type="hidden" name="landalination_id" value="<?php echo $get_landalienation[0]['id'] ?>">
                                    
                                    <input class="form-control txtQty"  name="total_area" id="total_area" type="text" value="<?php if(empty($get_landalienation)){ echo set_value('total_area'); }?><?php echo $get_landalienation[0]['total_land'] ?>"  placeholder="Total Area">
                                    <input type="hidden" id="total_area_hidden">
                                    <?php echo form_error('total_area', '<div class="error">', '</div>'); ?>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Departments That Own The Land </b>
                                    </p>
                                    <?php echo form_error('department_id', '<div class="error">', '</div>'); ?>
                                    <input class="form-control chronly" name="department_id" type="text" value="<?php if(empty($get_landalienation)){ echo set_value('department_id'); }?><?php echo $get_landalienation[0]['department_id'] ?>" placeholder="Departments">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Target End Date </b>
                                    </p>
                                    <?php echo form_error('target_end_date', '<div class="error">', '</div>'); ?>
                                     <input type="text" name="target_end_date" value="<?php if(empty($get_landalienation)){ echo set_value('target_end_date'); }?><?php echo $get_landalienation[0]['target_end_date'] ?>" class="datepicker form-control" placeholder="Please choose a date...">
                                </div>

                             </div>
                        </div>
                    </div>
                        
                        
                    <div class="card">
                        <div class="header">
                            <h2> Location Details </h2>
                        </div>

                        <div class="body">
                           <div class="col-md-3" style="display: none;">
                             <div class="form-group">
                        <select name="new"  id="hidden_dist_fetch">
                           <option value="0">All District</option>

                             <?php 
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }

                             ?>
                        </select>
                         </div>
                       </div>


                        <?php
                   if(!empty($alianation_location_data)){
                    ?>
                    

                   <div id="container1" class="row clearfix">
                         <?php 
                      $k = 1;
              $get_same_datacnt = count($alianation_location_data);
              
                foreach ($alianation_location_data as $sameD) {
                  if($k == 1){
            
                ?>
                   
                                <div class="col-md-4">
                                    <p>
                                        <b>District Names </b>
                                        
                                    </p>
                      <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);ulbFunc(1);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>



                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils Covered <!-- <span class="col-pink">* </span> --></b>
                                       
                                    </p>
                                    <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple" >
                           <?php
                           echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
                            ?>
                        </select>
                                </div>


                                <div class="col-md-2 p-t-25">
<button   id="newField_<?php echo $get_same_datacnt; ?>" name="submit" class="btn btn-success btn-circle waves-effect  waves-float" type="button">
<i class="material-icons">add</i>
</button>
</div>

             <?php

              }

             else{ ?>
                         
                              <div id="newAdd_<?php echo $k; ?>">
                                <div class="col-md-12 p-0 mt-10px">
                                
                                <div class="col-md-4">
                                    <p>
                                        <!-- <b>Districts Name <span class="col-pink">* </span></b> -->
                                        
                                    </p>
                                   <select name="dist_id[]" id="dist_id_<?php echo $k; ?>" class="form-control" onchange="tehsilFunc(<?php echo $k; ?>);ulbFunc(<?php echo $k; ?>);">
                           <option value="0">All District</option>

                              <?php   foreach ($districts as  $Tvalue){?>
                                      <option value="<?php echo $Tvalue->id; ?>"  <?php if($Tvalue->id == $sameD->district_id){ echo "selected"; } ?> ><?php echo $Tvalue->district_name; ?></option>

                              <?php } ?>
                        </select>
                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <!-- <b>Tehsils covered </b> -->
                                       
                                    </p>
                                    <select name="tehsil_id[<?php echo $k - 1; ?>][]" id="tehsil_id_<?php echo $k; ?>" class="form-control select2" multiple="multiple" >
                           <?php
                            echo $CI->gettehsilSelection_data($sameD->district_id,$sameD->tahsils_id);
              
                            ?>
                           
                        </select>
                                </div>

                                
                                <div class="col-md-2">
<button   id="removefld_<?php echo $k; ?>" data-id="<?php echo $k; ?>" name="submit" type="button"class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i>
</button>
</div>
                                </div>
                                
                                </div>
                           
                           
                    <?php } ?>


                   <?php $k++; 

                 }

                  ?>
                                
                             </div>
        




                             
                    <?php 

                  } else { 

                    ?>
                            <div id="container1" class="row clearfix addrow">
                              <?php
                              //$get_same_datacnt = count($alianation_location_data);
                              ?>
                                <div class="col-md-4">
                                    <p>
                                        <b>District Names </b>
                                       
                                    </p>
                              <select name="dist_id[]" id="dist_id_1" class="form-control" onchange="tehsilFunc(1);">
                                  <option value="0">Please select</option>
                                            <?php
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }
                                     ?>
                                </select>
                                <?php echo form_error('dist_id', '<div class="error">', '</div>'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Tehsils Covered <!-- <span class="col-pink">* </span> --></b>
                                       
                                    </p>
                  <select name="tehsil_id[0][]" id="tehsil_id_1" class="form-control select2" multiple="multiple">
                                      
                                    </select>
                                </div>
                                <div class="col-md-2 p-t-25">
<button id="newField_1" class="add-data btn btn-success btn-circle waves-effect waves-circle waves-float" name="submit" type="button">
<i class="material-icons">add</i>
</button>
</div>
                                
                             </div>
                      <?php } ?>
                        
                        </div>
                    </div>
                    <div class="card">    
                          <div class="header">
                            <h2> Status Of Key Milestones</h2>
                          </div>  
                         
                        <div class="body"> 
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <p> <b>Alienation Proposed To Tahsildar </b> </p>
                                     <select class="form-control show-tick" name="status_alienation_proposed">
                             <option value="Yes" <?php echo set_select('status_alienation_proposed','Yes', ( !empty($get_landalienation[0]['status_alienation_proposed']) &&
                                      $get_landalienation[0]['status_alienation_proposed'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_alienation_proposed','No', ( !empty($get_landalienation[0]['status_alienation_proposed']) &&
                                      $get_landalienation[0]['status_alienation_proposed'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                     <option value="In Progress" <?php echo set_select('status_alienation_proposed','In Progress', ( !empty($get_landalienation[0]['status_alienation_proposed']) &&
                                      $get_landalienation[0]['status_alienation_proposed'] == "In Progress" ? TRUE : FALSE )); ?> >In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_alienation_proposed','N.A', ( !empty($get_landalienation[0]['status_alienation_proposed']) &&
                                      $get_landalienation[0]['status_alienation_proposed'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p><b>Documents / Alienation Proposal </b></p>
                                    <?php echo form_error('file_alienation_proposed', '<div class="error">', '</div>'); ?>
                                     <input  type="file" name="file_alienation_proposed" id="uploadFile1" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
            <?php if (!empty($get_landalienation[0]['file_alienation_proposed'])) { ?>
      <a href="<?php echo base_url();?>uploads/files/land_alienation/<?php echo  str_replace(' ','',$get_landalienation[0]['file_alienation_proposed']); ?>" title="Download" download><i class="fa fa-download fa-2x" aria-hidden="true"></i></a>
    <?php } ?>
                                </div>
                           
                                
                                <div class="col-md-3">
                                    <p><b>Relinquishment Proposal Submitted </b> </p>
                                    <select class="form-control show-tick" name="status_relinquishment_proposal">
                                        <option value="Yes" <?php echo set_select('status_relinquishment_proposal','Yes', ( !empty($get_landalienation[0]['status_relinquishment_proposal']) &&
                                      $get_landalienation[0]['status_relinquishment_proposal'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('status_relinquishment_proposal','No', ( !empty($get_landalienation[0]['status_relinquishment_proposal']) &&
                                      $get_landalienation[0]['status_relinquishment_proposal'] == "No" ? TRUE : FALSE )); ?>>No</option>

                                        <option value="In Progress" <?php echo set_select('status_relinquishment_proposal','In Progress', ( !empty($get_landalienation[0]['status_relinquishment_proposal']) &&
                                      $get_landalienation[0]['status_relinquishment_proposal'] == "In Progress" ? TRUE : FALSE )); ?>>In Progress</option>

                                        <option value="N.A" <?php echo set_select('status_relinquishment_proposal','N.A', ( !empty($get_landalienation[0]['status_relinquishment_proposal']) &&
                                      $get_landalienation[0]['status_relinquishment_proposal'] == "N.A" ? TRUE : FALSE )); ?>>N.A.</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <p><b>Documents / Relinquishment Proposal </b> </p>
                                    <?php echo form_error('file_relinquishment_proposal', '<div class="error">', '</div>'); ?>
                                     <input  type="file" name="file_relinquishment_proposal" value="fileupload" id="uploadFile2" accept=".png, .jpg, .jpeg,.txt,.pdf,.doc,.docx,.gif">
                                     <p>(File type pdf,jpg,gif,docs and max file size 50mb)</p>
            <?php if (!empty($get_landalienation[0]['file_relinquishment_proposal'])) { ?>
                                     <a href="<?php echo base_url();?>uploads/files/land_alienation/<?php echo $get_landalienation[0]['file_relinquishment_proposal']; ?>" title="Download" download>
                                      <i class="fa fa-download fa-2x" aria-hidden="true"></i></a>
            <?php } ?>
        <input type="hidden" name="file_alienation_proposed_hidden" value="<?php echo $get_landalienation[0]['file_alienation_proposed']; ?>" />

        <input type="hidden" name="file_relinquishment_proposal_hidden" value="<?php echo $get_landalienation[0]['file_relinquishment_proposal']; ?>" />
                                </div>
                            </div>
                        </div>
                      </div>
                  
                        
                      <div class="card">   
                        <div class="header">
                          <h2> Status Of Progress</h2>
                        </div>
                        
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Alienated So Far ( In Acres ) </b>
                                    </p>
                                    <?php echo form_error('progress_land_alienated', '<div class="error">', '</div>'); ?>
                                     <input class="form-control txtQty" name="progress_land_alienated" id="progress_land_alienated" type="text" value="<?php if(empty($get_landalienation)){ echo set_value('progress_land_alienated'); }?><?php echo $get_landalienation[0]['progress_land_alienated'] ?>" placeholder="Land alienated">
                                </div>

                               <div class="col-md-4">
                                    <p>
                                        <b>Progress %</b>
                                    </p>
                                    <?php echo form_error('progress', '<div class="error">', '</div>'); ?>
                                     <input class="form-control txtQty limittxt_progress" name="progress" type="text" value="<?php if(empty($get_landalienation)){ echo set_value('progress'); }?><?php echo $get_landalienation[0]['progress_%'] ?>" placeholder="Progress">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Land Required For A/A Alienated </b>
                                    </p>
                                     <select class="form-control show-tick" name="land_required_aa">
                                        <option value="Yes" <?php echo set_select('land_required_aa','Yes', ( !empty($get_landalienation[0]['progress_land_required_aa']) &&
                                      $get_landalienation[0]['progress_land_required_aa'] == "Yes" ? TRUE : FALSE )); ?>>Yes</option>

                                        <option value="No" <?php echo set_select('land_required_aa','No', ( !empty($get_landalienation[0]['progress_land_required_aa']) &&
                                      $get_landalienation[0]['progress_land_required_aa'] == "No" ? TRUE : FALSE )); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                             
                              
                            <div class="row clearfix">
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Amount Utilized </b>
                                    </p>
                                    <?php echo form_error('amount_utilised', '<div class="error">', '</div>'); ?>
                                    <input class="form-control txtQty" name="amount_utilised" value="<?php if(empty($get_landalienation)){ echo set_value('amount_utilised'); }?><?php echo number_format($get_landalienation[0]['progress_amount_utilised'],2) ?>" type="text" placeholder="Amount">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> % of Pre-Construction Fund Utilized </b>
                                    </p>
                                    <?php echo form_error('fund_utilised', '<div class="error">', '</div>'); ?>
                                     <input class="form-control txtQty limittxt_progress" name="fund_utilised"  type="text" value="<?php if(empty($get_landalienation)){ echo set_value('fund_utilised'); }?><?php echo $get_landalienation[0]['progress_fund_utilised'] ?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b> Remarks </b>
                                    </p>
                                    <?php echo form_error('remarks', '<div class="error">', '</div>'); ?>
                                    <textarea class="form-control no-resize" name="remarks" rows="3" id="maxremarks" placeholder="Please type what you want..."><?php if(empty($get_landalienation)){ echo set_value('remarks'); }?><?php echo $get_landalienation[0]['remarks'] ?></textarea>
                                      
                                    <span id="warning-message" style='color:#ff0000'></span>
                                </div>
                           </div> 
                          </div>
                            
                          <div class="col-md-12  align-center">
                          <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-warning waves-effect">CANCEL</a>
                              <button class="btn btn-primary waves-effect " name="submit" id="submit_btn" value="Submit"  type="submit">
                              <?php echo (empty($get_landalienation)) ? 'SAVE' : 'Update' ?>
                            </button>

                           </div>
                           <div class="clearfix"></div>   
                        
                      </div>

                    </div>
                 </div>
                

            <!-- Select -->
            </div>
        </form>
        </div>
    </section>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- Select2 -->
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- #Main Content -->
        <?php
          if(empty($alianation_location_data)){
            $cnt6 = 1;
          }else{
              $cnt6 = $get_same_datacnt;
            }
          ?>

            <script type="text/javascript">
    $(document).ready(function() {




        $('.fade-message').delay(5000).fadeOut(5000);
    
   var dividcnt = <?php echo $cnt6; ?>;
   
   var i = <?php echo $cnt6; ?>;
for (i = 1; i <= <?php echo $cnt6; ?>; i++) {
   
$('#tehsil_id_'+i).select2({dropdownAutoWidth : true});
$('#ulb_id_'+i).select2({dropdownAutoWidth : true});
  
}
    

});


  $("#total_area").keyup(function() {
    //alert($(this).val());
    var land_total_area = $(this).val();
    $("#total_area_hidden").val(land_total_area);
    //alert(land_total_area);
  });


    var approval_date = "<?php echo $approval_date; ?>";
    //alert(approval_date);

    $('.datepicker').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true,
        minDate: approval_date
      });

  
  $(".txtQty").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));        
 });
  $(".chronly").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\w\s]/gi, ''));        
});
var ex_val = $('.limittxt_progress').val();
if(ex_val > 100) {
    $('.limittxt_progress').val('0');
}
$('.limittxt_progress').keyup(function(){
  if ($(this).val() > 100){
    alert("No numbers above 100");
    $(this).val(ex_val);
  }
});

//var total_area = $("#total_area").val();
$('#progress_land_alienated').keyup(function(){
 var curval = $(this).val();
  var hidden_area = $("#total_area_hidden").val();
  if(hidden_area == '') {
     hidden_area = $("#total_area").val();
  }
  if ( parseFloat(curval) > parseFloat(hidden_area) ){
    alert("Progress Land Alienated value should less than Total Area");
    $(this).val(0);
  }
});

</script>


<script type="text/javascript">

var divid = <?php echo $cnt6; ?>;
var optionValues = $("#hidden_dist_fetch").html();
      $('#container1').on('click','#newField_' + divid, function () {
        divid++;
        var ndiv = divid -1;
          var newthing = '<div id="newAdd_'+divid+'"><div class="col-md-12 p-0 mt-10px"><div class="col-md-4"><div class=""><select name="dist_id[]" id="dist_id_'+divid+'" class="form-control" onchange="tehsilFunc('+divid+');">' +optionValues+ '</select></div></div><div class="col-md-4"><div class=""><select name="tehsil_id['+ndiv+'][]" id="tehsil_id_'+divid+'" multiple="multiple" class="form-control select2"></select></div></div><div class="col-md-4"><div class="text-left"><button type="button" id="removefld_'+divid+'" data-id="'+divid+'" name="submit" class="btn btn-default btn-circle remove waves-effect  waves-float mt-25px"><i class="material-icons remove col-pink">delete</i></button></div></div></div>';
      
      
                    

         $('#container1').append(newthing);
         $('.select2').select2();
    });

    $('#container1').on('click','.remove', function (e) {
        e.preventDefault();
        var $this = $(this);
        var id = $this.data('id');
        //$(this).parent().remove();
        $('#newAdd_'+id).remove();

    });



    function tehsilFunc(divid) {
    var value = $('#dist_id_'+divid).val();
//$("#ulb_id_"+divid).empty();


if (value != 0)
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>Pre_consttruction_activity_government_land_alienation/gettehsil_list",
    datatype : 'json',
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","distId": value },
    
    success: function(data){
      
      
                            var parsed_data = JSON.parse(data);
                            $("#tehsil_id_"+divid).empty();
                            
                              $val_selec ='';
                            var listItems= "";

                    if(parsed_data.all_tehsil.length > 0)
                    {
                               for (var i = 0; i < parsed_data.all_tehsil.length; i++)
                                      {
                    $("#tehsil_id_"+divid).append("<option  value='" + parsed_data.all_tehsil[i].id  + "'>" + parsed_data.all_tehsil[i]. tahsil_name + "</option>");
                   // $('#xamwise_subjectlist').html('').prepend();
                      $val_selec ='';
                                      } 
                    }

                    else
                    {
                    $("#tehsil_id_"+divid).append("<option  value=''>" +'Select Another District' + "</option>");
                    
                      $val_selec =''; 
                    }



                              
                            
      }
    });
    }
    //$('#tehsil_id_'+divid).select2({dropdownAutoWidth : true});
}

$('#uploadFile1').change(function () {
var fileExtension = ['png','pdf','jpg','docs'];
var MAX_FILE_SIZE = 50 * 1024 * 1024;
if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
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
$('#uploadFile2').change(function () {
var fileExtension = ['png','pdf','jpg','docs'];
var MAX_FILE_SIZE = 50 * 1024 * 1024;
if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
swal(" ", "Only png,pdf,jpg,docs format is allowed", "error");
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
      }
    </style>
