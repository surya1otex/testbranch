<style type="text/css">
a:link { text-decoration: none; }
a:visited { text-decoration: none; }
a:hover { text-decoration: none; }
a:active { text-decoration: none; }
</style>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                       
                            <div class="header"><h2>Project Summary</h2></div>
                            <div class="body">
                                <div class="row">
                                    <div class=""> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a onclick="project_summary_list('Total Projects');">   
                                        <div class="info-box bg-pink hover-expand-effect pointer">
                                            <div class="icon">
                                            <i class="fas fa-cog"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Total Projects</div>
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_project[0]['total_project']; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                    
                                  </a>
                                </div>
                            </div>
                            <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a onclick="project_summary_list('Ongoing Projects');">
                                        
                                            <div class="info-box bg-cyan hover-expand-effect pointer">
                                                <div class="icon">
                                                    <i class="fas fa-tasks "> </i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Ongoing Projects</div>
                                                    <?php
    												
    												?>
                                                    <div class="number count-to" data-from="0" data-to="<?php echo $total_ongoing_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                                </div>
                                            </div>
                                        
                                    </a>
                                    </div>
                            </div>
                            <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        
                    <a  onclick="project_summary_list('Completed Projects');">  
                                    <div class="info-box bg-light-green hover-expand-effect pointer">
                                        <div class="icon">
                                            <i class="fas fa-wrench"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">Completed Projects</div>
                                            <div class="number count-to" data-from="0" data-to="<?php echo COUNT($completed_project); ?>" data-speed="1000" data-fresh-interval="1"></div>
                                        </div>
                                    </div>
                                
                                </a>
                                </div>
                            </div>
                                </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-orange hover-expand-effect m-b-0">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Indicative Cost . (&#8377; <?php echo $all_project_budget_suffix; ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo str_replace(",", "", $all_project_budget_number); ?>" data-speed="1000" data-fresh-interval="5"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-deep-purple hover-expand-effect m-b-10">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Contract Amt. (&#8377; <?php echo ucfirst($all_project_agreement_suffix); ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo str_replace(",", "", $all_project_agreement_number); ?>" data-speed="1000" data-fresh-interval="10"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box bg-brown hover-expand-effect m-b-10">
                                    <div class="icon">
                                        <i class="fas fa-rupee-sign"> </i>
                                    </div>
                                    <div class="content">
                                        <div class="text">Expenditure Amt. (&#8377; <?php echo ucfirst($all_project_expen_suffix); ?>)</div>
                                        <div class="number count-to" data-from="0" data-to="<?php echo str_replace(",", "", $all_project_expen_number); ?>" data-speed="1000" data-fresh-interval="4"></div>
                                    </div>
                                </div>
                            </div>
                       <!-- =================================== -->

                       <?php  if($this->session->userdata('circle_id') == 0){ ?>
                       <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a onclick="project_summary_list('Circle1');">
                                        
                                        <div class="info-box bg-circle1 hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Circle1</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_circle1_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>

                              <?php } else{  ?>


                           <?php } ?>


                            <?php  if($this->session->userdata('circle_id') == 0){ ?>

                              <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a onclick="project_summary_list('Circle2');">
                                        
                                        <div class="info-box bg-pink hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Circle2</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_circle2_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>

                              <?php } else{  ?>


                           <?php } ?>

                         <?php  if($this->session->userdata('circle_id') == 0){ ?>
                              <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a onclick="project_summary_list('Circle3');">
                                        
                                        <div class="info-box bg-blue hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Circle3</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_circle3_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>

                              <?php } else{  ?>


                           <?php } ?>
                          
                         <!-- <div class="">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a onclick="project_summary_list('CGM1');">
                                        
                                        <div class="info-box bg-yellow hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">CGM</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_cgm1_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>

                              <div class="">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a onclick="project_summary_list('Sr.CGM');">
                                        
                                        <div class="info-box bg-pink hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Sr.CGM</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_srcgm_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div> -->

                               <div class="">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a onclick="project_summary_list_cnt('Closed Issue');">
                                        
                                        <div class="info-box bg-green hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Closed Issue</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_closeissue_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>


                               <div class="">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a onclick="project_summary_list_cnt('Open Issue');">
                                        
                                        <div class="info-box bg-red hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Open Issue</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_openissue_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div>

                              <!-- <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                   <a onclick="project_summary_list('CGM3');">
                                        
                                        <div class="info-box bg-red hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">CGM3</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_cgm3_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                              </div> -->

                               
                         <?php  if($this->session->userdata('circle_id') == 0){?>


                             <div class="" >

                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <a onclick="project_summary_list('puri Projects');">
                                        
                                        <div class="info-box bg-cyan hover-expand-effect pointer">
                                            <div class="icon">
                                                <i class="fas fa-tasks "> </i>
                                            </div>
                                            <div class="content">
                                                <div class="text">Puri Projects</div>
                                                
                                                <div class="number count-to" data-from="0" data-to="<?php echo $total_puri_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                            </div>
                                        </div>
                                        
                                        </a>
                                    </div>
                                </div>

                           <?php } else{  ?>


                           <?php } ?>


                           <?php  if($this->session->userdata('circle_id') == 0){?>


                                    <div class="">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <a onclick="project_summary_list('nonpuri Projects');">
                                            
                                            <div class="info-box bg-blue hover-expand-effect pointer">
                                                <div class="icon">
                                                    <i class="fas fa-tasks "> </i>
                                                </div>
                                                <div class="content">
                                                    <div class="text">Non-Puri Projects</div>
                                                    
                                                    <div class="number count-to" data-from="0" data-to="<?php echo $total_nonpuri_project; ?>" data-speed="1000" data-fresh-interval="1"></div>
                                                </div>
                                            </div>
                                            
                                            </a>
                                        </div>
                                  </div>

                           <?php } else{  ?>


                           <?php } ?>
                     <!-- =================================== -->

                            </div>
                                    
                        </div>
                    </div>
                    


<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/js/pages/index.js"></script>
          <script type="text/javascript">
        function project_summary_list_cnt(type){
            
                //var project_group_id = $('#project_group_id').val();
                //var project_category_id = $('#project_category_id').val();
                //var project_area_id = $('#project_area_id').val();
                //var project_wing_id = $('#project_wing_id').val();
                //var project_division_id = $('#project_division_id').val();
               
                $.redirect("<?php echo base_url('project_summary_list'); ?>", {'project_list_type': type},"POST","_blank");         
          }
          </script>