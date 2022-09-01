    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
             <h4>Pre Construction Activities Settings </h4>
          </div>
    <!-- Alert Message -->
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
    <!-- End Alert Message -->
          

            
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
            
            
      <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Applicable Pre-Construction Activities  </h2>
                        </div>

                        <div class="body">
                          <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
  
                  <?php
                  if (isset($getsettings[0]['project_id'])) { 
                         echo form_open('Pre_consttruction_activity/updatesettings',array('name'=> 'Pre_consttruction_activity'));
                       }
                       else {
                         echo form_open('Pre_consttruction_activity/savesettings',array('name'=> 'Pre_consttruction_activity'));
                          }
                        ?>
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                              <div class="col-md-12">   
                                <h2 class="card-inside-title"> Select All Applicable Pre-Construction Activities </h2>  
                                 <div class="row clearfix">
                                  <div class="col-md-4 m-t-15">
                                    <label class="lbl-txt">Land Related</label>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="gov_land" id="basic_checkbox_3" class="filled-in" value="Y" <?php echo ($getsettings[0]['govt_land_alienation']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_3"> Government Land Alienation   </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="pri_land_direct" id="basic_checkbox_4" class="filled-in" value="Y" <?php echo ($getsettings[0]['private_land_direct_purchase']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_4"> Private Land ( Direct Purchase )  </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="pri_land_land" id="basic_checkbox_5" class="filled-in" value="Y" <?php echo ($getsettings[0]['private_land_acquisition']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_5"> Private Land ( Land Acquisition ) </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="forest_land" id="basic_checkbox_6" class="filled-in" value="Y" <?php echo ($getsettings[0]['forest_land']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_6"> Forest Land  </label>
                                    </div>
                                  </div>
                                <div class="col-md-4 m-t-15">
                                  <label class="lbl-txt">Utility Shifting</label>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="utility_shift" id="basic_checkbox_9" class="filled-in" value="Y" <?php echo ($getsettings[0]['utility_shifting_electrical']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_9"> Utility Shifting ( Electrical ) </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="utili_shft_ph" id="basic_checkbox_10" class="filled-in" value="Y" <?php echo ($getsettings[0]['utility_shifting_PH']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_10"> Utility Shifting ( PH ) </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="utili_shft_rwss" id="basic_checkbox_11" class="filled-in" value="Y" <?php echo ($getsettings[0]['utility_shifting_RWSS']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_11"> Utility Shifting ( RWSS ) </label>
                                    </div>
                                </div>
                                  <div class="col-md-4 m-t-15">
                                    <label class="lbl-txt">Others</label>
                                   <div class="demo-checkbox">
                              <input type="checkbox" name="tree_cut" id="basic_checkbox_7" class="filled-in" value="Y" <?php echo ($getsettings[0]['tree_cutting']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_7"> Tree Cutting  </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="env_clearance" id="basic_checkbox_8" class="filled-in" value="Y" <?php echo ($getsettings[0]['environmental_clearance']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_8"> Environmental Clearance </label>
                                    </div>   

                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="encroach_evic" id="basic_checkbox_12" class="filled-in" value="Y" <?php echo ($getsettings[0]['encroachment_eviction']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_12">  Encroachment Eviction </label>
                                    </div>
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="special_act" id="basic_checkbox_13" class="filled-in" value="Y" <?php echo ($getsettings[0]['special_activity']== 'Y' ? 'checked' : '');?> />
                                        <label for="basic_checkbox_13">Special Activity</label>
                                    </div>
                                  </div>
                                 </div>
                                </div>
                                
                             </div>
                          </div>
                            
                          <div class="col-md-12  align-center">
                              <a href="<?php echo base_url();?>project_list/pip_pre_construction_activities" class="btn btn-primary waves-effect">CANCEL</a>
                              <?php 
                              if (isset($getsettings[0]['project_id'])) { ?>
                              <button class="btn btn-success waves-effect"  type="submit">UPDATE</button>
                              <?php } 


                           else { ?>
                            <button class="btn btn-success waves-effect "  type="submit">SAVE</button>
                          <?php } ?>
                           </div>
                       </form>
                           <div class="clearfix"></div>  
                            
                        </div>
                    </div>

                 </div>
                

            <!-- Select -->
            </div>
        </div>
    </section>
<style type="text/css">
  label.lbl-txt {
    color: #003c23;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 15px;
}
</style>
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
    });
</script>
?>
    
    




 
    
    