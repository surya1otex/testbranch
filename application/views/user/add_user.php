<?php $CI =& get_instance();?>
<section class="content">
  <div class="container-fluid">
        <div class="col-md-6">
          <div class="block-header">
            <?php $this->session->flashdata('message'); ?>

              <?php if(!empty($userId)){ 
              ?>
                  <h4> Update User</h4>
              <?php }else{ ?>
                  <h4>Add User</h4>
              <?php }?>
            <div style=" color: red;"><?php echo $this->session->flashdata('message'); ?>
            </div>
          </div>
        </div>
            <!-- Basic Examples -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <?php 
           if(empty($userId)){
           echo form_open('User/add_user',array('name'=> 'add_user','id'=>'add_user_form')); 
         }else{
           echo form_open('User/add_user?user_id='.base64_encode($userId),array('name'=> 'add_user','id'=>'add_user_form'));
         }
         ?>
           <input id="existingUserId" name="existingUserId" type="hidden" value="<?php if(!empty($userId)){ echo $userId; }else{ echo 0 ; } ?>" >

            <div class="card">
              <div class="header">
                <h2>Personal Info</h2>
              </div>
              <div class="body">
                <div class="section_clone">

                          <div class="row clearfix cloneBox1">
                            <div class="col-sm-12">
                              <div class="col-md-2">
                                <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                    First Name <span style="color: red;">*</span> :
                                </label>
                              </div>
                              <div class="col-md-4">
                                <div class="form-line">
                                  <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php if(!empty($userId)){ echo $user_details[0]['firstname']; } ?>" required=""/>
                                </div>
                                <?php echo form_error('firstname'); ?>
                              </div>
                              <div class="col-md-2">
                                  <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">Last Name <span style="color: red;">*</span> :</label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                                  <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php if(!empty($userId)){ echo $user_details[0]['lastname']; } ?>" required=""/>
                                </div>
                                <?php echo form_error('lastname'); ?>
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-md-2">
                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                        User Type<span style="color: red;">*</span> :
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-line">
                                        <select class="form-control show-tick" name="user_type" required="">
                                            <option value="">Select User Type</option>
                                            <?php foreach($userType as $userType){?>
                                                <option value="<?php echo $userType['id']?>"
                                                    <?php
                                                    if(!empty($user_details[0]['designation_id']) && $user_details[0]['designation_id']==$userType['id']){echo "selected";}
                                                    ?>><?php echo $userType['designation']?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <?php echo form_error('user_type'); ?>
                                </div>
                              <div class="col-md-2">
                                <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                    Email:
                                </label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(!empty($userId)){ echo $user_details[0]['email']; } ?>"/>
                                </div>
                                <?php echo form_error('email'); ?>
                              </div>


                            </div>
                              <div class="col-sm-12">
                              <div class="col-md-2">
                                  <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                      Mobile:
                                  </label>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-line">
                                      <input type="text" name="mobile" onkeypress="allowNumbersOnly(event)" class="form-control" placeholder="Mobile" value="<?php if(!empty($userId)){ echo $user_details[0]['mobile']; } ?>"/>
                                  </div>
                                  <?php echo form_error('mobile'); ?>
                              </div>
                                  <div class="col-md-2">
                                      <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                          Username<span style="color: red;">*</span> :
                                      </label>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-line">
                                          <input type="text" name="username" class="form-control" placeholder="Username" required="" value="<?php if(!empty($userId)){ echo $user_details[0]['username']; } ?>"/>
                                      </div>
                                      <?php echo form_error('username'); ?>
                                  </div>
                              </div>
                              <div class="col-sm-12">

                                <div class="col-md-2">
                                <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;" required="">
                                    User Role<span style="color: red;">*</span> :
                                </label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                               <select class="form-control" name="user_role" id="user_role" required>
                               
                                  <option value="">Select User Role</option>
                                     <?php foreach($userRole as $userrole){?>
                                                <option value="<?php echo $userrole['id']?>"
                                                    <?php
                                                    if(!empty($user_details[0]['role_id']) && $user_details[0]['role_id']==$userrole['id']){echo "selected";}
                                                    ?>><?php echo $userrole['role']?></option>
                                            <?php } ?>
                    
                     
                  </select>
                                </div>
                                 <?php echo form_error('user_role'); ?>
                              </div>
                              
                                <div class="col-md-2">
                                <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                    Password<span style="color: red;">*</span> :
                                </label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                                  <input type="password" name="password" class="form-control" <?php if(empty($userId)){ echo "required='required'"; } else { ""; } ?> value="" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$"
                                         onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must contain Minimum 8 characters at least 1 Alphabet, 1 Number and 1 Special Character' : '');" placeholder="<?php if(!empty($userId)){ echo "Enter New Password, Skip Otherwise"; } ?>" autocomplete="off"/>
                                </div>
                                <?php echo form_error('password'); ?>
                              </div>


                              <div class="col-md-2">
                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;" required="">
                                    Project Circle<span style="color: red;">*</span> :
                                </label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                                  
                                    <select name="project_circle_user" id="circle_id" class="form-control show-tick" onchange="divisionfunc(1)">
                                        <option value="0">Select project Circle</option>
                                        <?php foreach ($circles as $circle) { ?>
                                            <option value="<?php echo $circle['id'] ?>"
                                                <?php
                                                if (!empty($user_details[0]['circle_id']) && $user_details[0]['circle_id'] == $circle['id'])  {
                                                    echo "selected";
                                                } ?> ><?php
                                                echo $circle['wing_name'] ?></option>
                                        <?php } ?>
                                       
                                    </select>
                                </div>

                                <?php echo form_error('project_circle_user'); ?>
                              </div>

                              <div class="col-md-2">
                                    <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;" required="">
                                    Project Division<span style="color: red;">*</span> :
                                </label>
                              </div>

                              <div class="col-md-4">
                                <div class="form-line">
                                  
                                    <select name="project_division_user" id="division_id" class="form-control show-tick">
                                        <option value="0">Select project Division</option>
                                         <?php
                                          echo $CI->getdivision_data($user_details[0]['circle_id'],$user_details[0]['division_id']);
                                                    ?>
                                       
                                    </select>
                                </div>

                                <?php echo form_error('project_division_user'); ?>
                              </div>


                             


                            </div>
                          </div>
                </div>

                
                
                
          <div id="role_assign_view"></div>

                  <div class="col-md-2 col-md-offset-5"
                       style="margin-top: -21px;">
                      <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                  </div>
              </div>
            </div>
            <!-- #END# Basic Examples -->
           </form>
          </div>
        </div>
  </div>
</section>

<script type="text/javascript">

   $("#user_role").change(function(){
    //alert($(this).val());
    var value = $(this).val();
    if (value != "")
    {
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>User/get_role_access_list",
    datatype : 'json',
    //data:'lodgeDesID='+$(this).val(),
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","role_id": value },
    
    success: function(response){
            $('#role_assign_view').html('').append(response);
                              
                            
      }
    });
    }
  else {
     $('#role_assign_view').html('');
  }
  });
  
   var user_rolevalue = $("#user_role").val();
   var user_ID = $("#existingUserId").val();
    if (user_rolevalue != "")
    {
     $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>User/get_role_access_list",
    datatype : 'json',
    //data:'lodgeDesID='+$(this).val(),
    data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","role_id": user_rolevalue,"action_val": "edit","userid": user_ID },
    
    success: function(response){
            $('#role_assign_view').html('').append(response);
                              
                            
      }
    });
  }
  else {
     $('#role_assign_view').html('');
  }
  
  </script>

  <script>
    function allowNumbersOnly(e) {
        var code = (e.which) ? e.which : e.keyCode;
        if (code > 31 && (code < 48 || code > 57)) {
            e.preventDefault();
        }
    }
</script>


<script type="text/javascript">
   
    function divisionfunc() {
        var value = $('#circle_id').val();
        
         if (value != 0)
            {
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>User/getdivision_list",
            datatype : 'json',
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","circleId": value },
            
                success: function(data){
                     
                var parsed_data = JSON.parse(data);
                $("#division_id").empty();
                
                  $val_selec ='';
                  var listItems= "";

                      if(parsed_data.all_divisions.length > 0){
                        $("#division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                       for (var i = 0; i < parsed_data.all_divisions.length; i++)
                           {
                                $("#division_id").append(
                                    "<option  value='" + parsed_data.all_divisions[i].id  + "'>" + parsed_data.all_divisions[i]. division_name + "</option>");

                                  $val_selec ='';
                            } 
                        }

                        else
                        {
                        $("#division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                        
                          $val_selec =''; 
                        }

                    }
            });
            }
     }
</script>