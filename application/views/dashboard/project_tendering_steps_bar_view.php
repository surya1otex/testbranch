
<!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    <?php //echo $whole_url;  ?>
                    <li class="<?php if($whole_url == 'Pre_bid_conference/manage'){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['prebid_status'] == 1 && $stepData['astatus'] != "Y"){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['prebid_status'] == "1" && $stepData['astatus'] == "Y"){ echo 'completed'; }
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-window-restore"></i></span>
                          <span class="label"> Pre Bid</span>
                    </li>
                    
                    <!-- <li class="<?php //if(is_numeric($step_project_id) && $preparation_status == true){ echo 'completed'; }else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-users"></i></span>
                          <span class="label">Identified Stackholders</span>
                    </li> -->
                    <li class="<?php if($whole_url == 'Technical_Evalution/manage'){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['techeva_status'] == 1 && $stepData['astatus'] != "Y"){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['techeva_status'] == 1 && $stepData['astatus'] == "Y"){ echo 'completed'; }
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-cogs"></i></span>
                          <span class="label">Technical Evalution</span>
                    </li>
                    <li class="<?php if($whole_url == 'Financial_Evalution/manage'){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['fineva_status'] == 1 && $stepData['astatus'] != "Y"){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['fineva_status'] == 1 && $stepData['astatus'] == "Y"){ echo 'completed'; }
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-chart-line"></i></span>
                          <span class="label">Financial Evalution</span>
                    </li>
                    <li class="<?php if($whole_url == 'Negotiation/manage'){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['negoti_status'] == 1 && $stepData['astatus'] != "Y"){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['negoti_status'] == 1 && $stepData['astatus'] == "Y"){ echo 'completed'; }
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-handshake"></i></span>
                          <span class="label">Negotiation</span>
                    </li>
                    
                    
                    <li class="<?php if($whole_url == 'Issue_of_LoA/manage'){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['issue_status'] == 1 && $stepData['astatus'] != "Y"){ echo 'active'; }
									elseif(is_numeric($step_project_id) && $stepData['issue_status'] == 1 && $stepData['astatus'] == "Y"){ echo 'completed'; }
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-tasks"></i></span>
                          <span class="label">Issue of LOA</span>
                    </li>
                    
                    <li class="<?php if($whole_url == 'project_agreement/manage'){ echo 'completed'; }
									else if(is_numeric($step_project_id) && $stepData['astatus'] == "Y"){ echo 'completed'; }
									
									else{ echo 'gray'; } ?>">
                          <span class="circle"><i class="fas fa-list-alt"></i></span>
                          <span class="label">Project Agreement</span>
                    </li>
                    
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end --> 