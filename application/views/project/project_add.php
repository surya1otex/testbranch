<?php $CI =& get_instance();?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy'});

    $("#area").change(function(){
        var area_id=$('#area :selected').val();
        $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>Project/get_destination",
           data: {area_id:area_id},
           success: function (msg) {
               $("#destination").html(msg);
           }
        }); 
    });
    <?php if(!empty($project_id)){ ?>
        var area_id=$('#area :selected').val();
        $.ajax({
           type: "POST",
           url: "<?php echo base_url();?>Project/get_destination",
           data: {area_id:area_id},
           success: function (msg) {
               $("#destination").html(msg);
           }
        }); 
    <?php } ?>
  });

  $( document ).ready(function() {
      $('#add_project_form').submit(function (event){
        var startDate = $('#start_date').val();
        var splitStartDate = startDate.split("-");
        var newStartDate = new Date(splitStartDate[2] + "-" + splitStartDate[1] + "-" + splitStartDate[0]);
      
        var endDate = $('#end_date').val();
        var splitEndDate = endDate.split("-");
        var newEndDate = new Date(splitEndDate[2] + "-" + splitEndDate[1] + "-" + splitEndDate[0]);
      
        if(newStartDate>=newEndDate){
          alert("From date should be less than to date");
          event.preventDefault();
        }
      });
  });   
  </script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4><?php if(empty($project_id)){ echo "ADD NEW"; }else{ echo "UPADATE";} ?> SUB PROJECT</h4>
            </div>
            <!-- Input -->

            <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>Sub Project Details</h2>

                        </div>
                        <div class="body">
                           <div class="section_clone">
                            
                            <?php echo form_open('Project/project_add',array('name'=> 'project','id'=>'add_project_form')); ?>
                              <input type="hidden" name="project_id" value="<?php echo base64_encode($project_id); ?>">  
                              <div class="row clearfix cloneBox1">
                                  <div class="col-sm-12">
                                       <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                             Sub Project Name<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                        <div class="col-md-10">
                                          <div class="form-line">
                                            <input type="text" name="project_name" class="form-control" placeholder="Project name" required="" value="<?php echo (!empty($project_deatail[0]['project_name'])?$project_deatail[0]['project_name']:"");?>"/>
                                          </div>
                                        </div>
                                  </div>

                                   <div class="col-sm-12">
                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Code<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <div class="form-line">
                                            <input type="text" name="project_unique_no" class="form-control" placeholder="Project ID" required="" value="<?php echo (!empty($project_deatail[0]['project_unique_no'])?$project_deatail[0]['project_unique_no']:"");?>"/>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Destination<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="project_destination" required="" id="destination">
                                            
                                         </select>
                                        </div>
                                  </div>
                                   
                                  
                                  <div class="col-sm-12">
                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Area<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="project_area" required="" id="area">
                                            <option value="">Select Project Area</option>
                                            <?php foreach($project_area as $area){?>
                                                    <option value="<?php echo $area['id']?>"
                                                    <?php
                                                     if(!empty($project_deatail[0]['project_area']) && $project_deatail[0]['project_area']==$area['id']){echo "selected";}
                                                    ?>><?php 
                                                    echo $area['name']?></option>
                                            <?php } ?>
                                            
                                           </select>
                                        </div>


                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Estimated Cost (&#x20B9;)<span style="color: red;">*</span>:
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <div class="form-line">
                                            <input type="text" name="display_amount" class="form-control" placeholder="Display Amount" required="" value="<?php echo (!empty($project_deatail[0]['display_amount'])?$project_deatail[0]['display_amount']:"");?>"/>
                                          </div>
                                        </div>
                                        
                                        
                                  </div>
                                  
                                  <div class="col-sm-12">
                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Project Type<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="project_type" required="">
                                            <option value="" >Select Project Type</option>
                                            <?php foreach($project_type as $type){?>
                                                    <option value="<?php echo $type['id']?>"
                                                     <?php
                                                      if(!empty($project_deatail[0]['project_type']) && $project_deatail[0]['project_type']==$type['id']){echo "selected";}
                                                     ?>><?php 
                                                    echo $type['project_type']?></option>
                                            <?php } ?>
                                         </select>
                                        </div>
                                        
                                        <div class="col-md-2 p-r-0 ">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Contract Amount(&#x20B9;)<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4 ">
                                          <div class="form-line">
                                            <input type="text" name="project_amount" class="form-control" placeholder="Project Contract Amount"  required="" value="<?php echo (!empty($project_deatail[0]['estimate_total_cost'])?$project_deatail[0]['estimate_total_cost']:"");?>"/>
                                          </div>
                                        </div>
                                        
                                  </div>
                                  
                                  <div class="col-sm-12">
                                       
                                       <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            TSU<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="tsu" required="">
                                            <option value="">Select TSU</option>
                                            <?php foreach($project_tsu as $tsu){?>
                                                    <option value="<?php echo $tsu['id']?>"
                                                      <?php
                                                      if(!empty($project_deatail[0]['project_tsu']) && $project_deatail[0]['project_tsu']==$tsu['id']){echo "selected";}
                                                      ?>><?php echo $tsu['name']?></option>
                                            <?php } ?>
                                         </select>
                                        </div>
                                       
                                        <div class="col-md-2 p-r-0">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Implementing Entity<span style="color: red;">*</span>:
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="agency" required="">
                                            <option value="">Select Agency</option>
                                            <?php foreach($project_agency as $agency){?>
                                                    <option value="<?php echo $agency['id']?>"
                                                      <?php
                                                      if(!empty($project_deatail[0]['project_implementing_agency']) && $project_deatail[0]['project_implementing_agency']==$agency['id']){echo "selected";}
                                                      ?>
                                                    ><?php 
                                                    echo $agency['name']?></option>
                                            <?php } ?>
                                         </select>
                                        </div>

                                  </div>
                                  
                                  
                                  <div class="col-md-12">
                                    <div class="col-md-2 p-r-0">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Designing Superviser (PMC)<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="superviser" required="">
                                            <option value="">Select Superviser</option>
                                            <?php foreach($project_supervisor as $supervisor){?>
                                                    <option value="<?php echo $supervisor['id']?>"
                                                      <?php
                                                      if(!empty($project_deatail[0]['project_supervisor']) && $project_deatail[0]['project_supervisor']==$supervisor['id']){echo "selected";}
                                                      ?>><?php echo $supervisor['name']?></option>
                                            <?php } ?>
                                         </select>
                                        </div>
                                        
                                        <div class="col-md-2 p-r-0">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            NGO<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <select class="form-control show-tick" name="ngo" required="">
                                            <option value="">Select NGO</option>
                                            <?php foreach($project_ngo as $ngo){?>
                                                    <option value="<?php echo $ngo['id']?>"
                                                     <?php
                                                      if(!empty($project_deatail[0]['project_ngo']) && $project_deatail[0]['project_ngo']==$ngo['id']){echo "selected";}
                                                     ?>
                                                    ><?php echo $ngo['name']?></option>
                                            <?php } ?>
                                         </select>
                                        </div>
                                  </div>
                                  
                                  <div class="col-md-12">
                                        
                                      <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class=" input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Start date<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <div class="form-line">
                                            <input type="text" class="datepicker form-control" placeholder="Start date" name="start_date" id="start_date" required="" value="<?php echo (!empty($project_deatail[0]['project_start_date'])?date('d-m-Y' ,strtotime($project_deatail[0]['project_start_date'])):"");?>">
                                          </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                          <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                             End date<span style="color: red;">*</span> :
                                          </label>
                                        </div>
                                       
                                        <div class="col-md-4">
                                          <div class="form-line">
                                            <input type="text" class="datepicker form-control" placeholder="End date" name="end_date" id="end_date" required=""  value="<?php echo (!empty($project_deatail[0]['project_end_date'])?date('d-m-Y' ,strtotime($project_deatail[0]['project_end_date'])):"");?>" >
                                          </div>
                                          <?php if($project_deatail[0]['project_end_date'] != $project_deatail[0]['project_original_end_date']){?>
                                                <span style=" color: red;">Extended project completion date</span>: <b><?php echo date('d-m-Y' ,strtotime($project_deatail[0]['project_end_date'])) ?></b>
                                          <?php } ?>

                                        </div>

                                        
                                  </div>
                               </div>
                                <div class="col-md-2 col-md-offset-5" style="margin-top: -21px;">
                                   
                                   <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                </div>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->

            <!-- Select -->

        </div>
    </section>