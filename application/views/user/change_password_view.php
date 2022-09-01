<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           
<?php
        $form_action = site_url().'/user/change_password/';
    ?>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

                    <div class="card">
                        <div class="header">
                            <h2> Change Password</h2>
                        </div>
                        <span style=" color: green;"><?php //echo $this->session->flashdata('message'); ?></span>
                        
                        <!-- Alert Message -->
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
            <?php if($this->session->flashdata('message')){ ?>
                <div class="alert alert-success alert-dismissible text-center fade-message">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('message'); ?>
                </div>
                <?php }  ?>
                
                </div>        
                
            </div>
            <!-- End Alert Message -->
                        
                        <div class="body">
                          <div class="clearfix"></div>

                          <div class="section_clone"> 
                          <form action="<?=$form_action ?>" method="POST"> 
                             <div class="row clearfix cloneBox1">

                               


                                <div class="col-sm-12">
                                    <div class="col-md-4">
                                      <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                         Old Password <span class="col-pink">* </span>:
                                      </label>
                                    </div>
                                   
                                    <div class="col-md-8">
                                       <div class="form-line">
                                          <input type="text" name="old_password" class="form-control" placeholder="Old Password" autocomplete="off" />
                                        </div>
                                        <?php echo form_error('old_password','<p class="text-red">**','</p>'); ?>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                         New Password <span class="col-pink">* </span>:
                                      </label>
                                    </div>
                                   
                                    <div class="col-md-8">
                                       <div class="form-line">
                                          <input type="password" name="password" class="form-control" placeholder="New Password" autocomplete="off" />
                                        </div>
                                        <?php echo form_error('password','<p class="text-red">**','</p>'); ?>
                                    </div>
                                    <div class="col-md-4">
                                      <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                         Confirm New Password <span class="col-pink">* </span>:
                                      </label>
                                    </div>
                                   
                                    <div class="col-md-8">
                                       <div class="form-line">
                                          <input type="password" name="confirm_password" class="form-control" placeholder="Confirm New Password" autocomplete="off" />
                                        </div>
                                        <?php echo form_error('confirm_password','<p class="text-red">**','</p>'); ?>
                                    </div>
                                  </div>




                                  </div>

                                    <div class="col-md-12 align-center" style="margin-top: -21px;">
                                      <!-- <a href="#"  class="btn bg-indigo waves-effect"><span> SAVE </span></a> -->
                                      <button type="submit" class="btn bg-indigo waves-effect" name="submit" value="Submit">Submit</button> 
                                    </div>
                                </form>
                                </div> 
                      
                              </div>
                          </div>
                      </div>
                  </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>
    <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>
<!-- ENd Alert Page js for hide alert  -->
