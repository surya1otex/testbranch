<!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="<?php if($whole_url == 'project/project_conceptualisation'){ echo 'active'; }elseif(is_numeric($step_project_id) && $stepData['concept_status'] == 1){ echo 'completed'; }else{ echo 'active'; } ?>">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label"> Concept Creation</span>
                    </li>
                    
                    <!-- <li class="<?php //if(is_numeric($step_project_id) && $preparation_status == true){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-users"></i></span>
                          <span class="label">Identified Stackholders</span>
                    </li> -->
                    <li class="<?php if($whole_url == 'project_dpr/project_dpr'){
                      echo 'active';
                    }elseif(is_numeric($step_project_id) && $stepData['dpr_status'] == 1){ echo 'completed'; }
                    else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-braille"></i></span>
                          <span class="label">DPR</span>
                    </li>


                    <li class="<?php if($whole_url == 'project_administrative_approval/manage'){
                      echo 'active';
                    }elseif(is_numeric($step_project_id) && $stepData['aa_status'] == 1){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-check"></i></span>
                          <span class="label">Administrative Approval</span>
                    </li>

                    
<!--                     <li class="<?php if($whole_url == 'pre_consttruction_activity/settings'){
                      echo 'active';
                    }elseif(is_numeric($step_project_id) &&  $stepData['pre_cons_status'] == 1){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-adjust"></i></span>
                          <span class="label">Pre Construction Activities</span>
                    </li> -->
                    
                    <?php // echo $whole_url; 
					
					
					
					?>
                    <li class="<?php if($whole_url == 'project_tender_publishing/manage'){
                      echo 'active';
                    }elseif(is_numeric($step_project_id) && $stepData['aa_status'] == 1){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-list"></i></span>
                          <span class="label">Tender Publishing</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end --> 