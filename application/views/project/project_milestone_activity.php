<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>Milestone Activity Management</h4>
                </div>
            </div>
           
            <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>Project Information</h2>
				        </div>
                        <div class="body table-responsive">
                           
                        <?php
						/*echo "<pre>";
						print_r($milestone_deatail);
						echo "</pre>";*/
						
						
                                                $project_area= $CI->project_area($project_deatail[0]['project_area']);
                                                $project_type= $CI->project_type($project_deatail[0]['project_type']);
						
						?>
                            <table class="table table-hover table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Project Name :</th>
                                        <td><?php echo $project_deatail[0]['project_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Area:</th>
                                        <td><?php echo !empty($project_area) ? $project_area[0]['name']: "--"?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Type:</th>
                                        <td><?php echo !empty($project_type) ? $project_type[0]['project_type'] : "--"?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Start Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_start_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date:</th>
                                        <td><?php $from_date = new DateTime($project_aggrement_deatail[0]['project_end_date']); echo $from_date->format('jS M Y'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <span> <strong>Milestone Name :</strong>  <span class="label label-info" style="font-size:13px"><?php echo !empty($milestone_deatail) ? $milestone_deatail[0]['milestone'] : "--"?></span> </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>Add New Activity</h2>
                            
                
                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
				        </div>
                        
                    <?php echo form_open('Planning/add_project_activity',array('name'=> 'add_project_activity','id'=>'add_project_activity')); ?>
                    <input type="hidden" name="project_id" value="<?php echo (!empty($project_deatail[0]['id'])? base64_encode($project_deatail[0]['id']):''); ?>" /> 
                    <input type="hidden" name="milestone_id" value="<?php echo (!empty($milestone_deatail[0]['id'])? base64_encode($milestone_deatail[0]['id']):''); ?>" />
                    <input type="hidden" name="activity_id" value="<?php echo (!empty($milestone_activity_deatail[0]['id'])? base64_encode($milestone_activity_deatail[0]['id']):''); ?>" />
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p> <b>Activity Name <span class="col-pink">* </span></b> </p>
                                    <input type="text" class="form-control" placeholder="Activity Name" name="activity" required value="<?php echo (!empty($milestone_activity_deatail[0]['particulars'])? $milestone_activity_deatail[0]['particulars']:''); ?>" />  
                                    <span id="err_span" style='color:#ff0000'>
                                    <?php echo $this->session->flashdata('Aerror_message'); ?>
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <p> <b>Weightage <span class="col-pink">* </span></b>
                                        <span class="ntip">
                                            <i class="fa fa-info-circle" title=""></i>
                                            <span class="ntiptext">Weightage in % </span>
                                        </span>
                                    </p>
                                    <input type="text" class="form-control"  name="weightage" placeholder="Weightage" value="<?php echo (!empty($milestone_activity_deatail[0]['weightage'])? $milestone_activity_deatail[0]['weightage']:''); ?>" oninput="this.value=this.value.replace(/[^0-9\.]/g,'');" required />
                                      <span id="err_span" style='color:#ff0000'>
                                    <?php echo $this->session->flashdata('AWerror_message'); ?>
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <p><b>End Date (dd/mm/yyyy) <span class="col-pink">* </span></b></p>
                                    <input type="text" id="end_date" name="end_date" class="datepicker form-control" value="<?php echo (!empty($milestone_activity_deatail[0]['end_date'])? $milestone_activity_deatail[0]['end_date']:''); ?>" placeholder="Please choose a date..." required>
                                </div>
                            </div>
                        </div>
                        
                       <br clear="all">
                        <div class="col-md-12 align-center">
                            <div class=" cloneBox1"></div>
                            
                   <?php if(!empty($milestone_activity_deatail)){ ?>
                        <button class="btn  btn-primary waves-effect m-b-20" type="submit" name="submit" value="update">  Update</button>
                        <?php }else { ?>
                        <button class="btn  btn-primary waves-effect m-b-20" type="submit" name="submit" value="add">  Add</button>
                        <?php } ?>
                        </div>
                        
                        </form>
                        <div class="clearfix"></div> 
                        
                    </div>
                </div>
            </div>
          
            
            <div class="row clearfix ">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                        <h2>Milestone Activity Lists</h2>
                    </div> 
                        <div class="body table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr style="background:#ccc">
                                        <th>Sl No</th>
                                        <th>Activity Name</th>
                                        <th>Weightage </th>
                                        <th>End Date </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php if(!empty($project_milestone_activity)){
						 $i=1; 
						 // print_r($project_milestone_activity);
						  
                           foreach($project_milestone_activity as $activity_deatail){
						  ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $activity_deatail['particulars']?></td>
                                        <td><span class="subtot" ><?php echo $activity_deatail['weightage']?></span>%</td>
                                        <td><?php $end_date = new DateTime($activity_deatail['end_date']); echo $end_date->format('jS M Y'); ?></td>
                                        <td>
                                            <a href="<?php echo base_url();?>planning/add_project_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']);?>&milestone_id=<?php echo base64_encode($activity_deatail['milstone_id']);?>&activity_id=<?php echo base64_encode($activity_deatail['id']);?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>
                                            <a href="<?php echo base_url();?>planning/del_milestone_activity?project_id=<?php echo base64_encode($activity_deatail['project_id']);?>&milestone_id=<?php echo base64_encode($activity_deatail['milstone_id']);?>&activity_id=<?php echo base64_encode($activity_deatail['id']);?>" onclick="return confirm('Are you sure want to Delete this Activity?')" class="m-r-10 col-black"> <i class="fas fa-trash"></i> </a> 
                                        </td>
                                    </tr>
                                    
                                    
                                   <?php
								$i++;	
						   }
						   
						   
						   ?>
                             <tr>
                                        <td colspan="2" class="align-center"><strong>TOTAL </strong></td>
                                        <td colspan="3"><h4 class="m-0"><span id="amnt_total" class="label label-info total-combat"></span></h4></td>
                                    </tr>
                           
                           <?php
									 }
									 else {
									 
									 ?>  
                                     
                                       <tr>
                                        <td colspan="5" class="align-center"><strong>No record Found </strong></td>
                                    </tr> 
                                     <?php
									 }
									 ?>
                                    
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right m-b-20" style="margin-top: -21px;">
               <a href="<?php echo base_url();?>planning/project_milestone?project_id=<?php echo base64_encode($project_deatail[0]['id']);?>" class="btn bg-indigo waves-effect">
                  <span>BACK</span>
               </a>
            </div>
        </div>
    </section>
     <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);
		  //$("#datadiv").load();
		 // var div=$('#datadiv').html();
		  // $('#datadiv').html(div);
	
	//TOTAL Weightage calculation
	var sum = 0
    $(this).find('.subtot').each(function () {
      var combat = $(this).text();
	  
      if (!isNaN(combat) && combat.length !== 0) {
        sum += parseFloat(combat);
      }
    });
    $('.total-combat', this).html(sum+'%');

    });
	</script>