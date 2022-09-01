<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="header">
                            <h2>Project Overview</h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos camelcase">
                                    <thead>
                                        <tr>
                                            <th>Project Phase</th>
                                            <th>No of projects</th>
                                            <th>Amount</th>
                                            <th>Type of Amount</th>
                                            
                                            <!--<th>Status</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Planning Projects');">Planning</a></td>
                                            <td><?php echo $planning_cnt; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i> <?php echo $concept_amt; ?></td>
                                            <td>Planning Amount</td>
                                            
                                           
                                        </tr>

                                        <tr>
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Tendering Projects');">Tendering</a></td>
                                            <td><?php echo $tendering_cnt; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i>  <?php echo $tender_amnt; ?></td>
                                            <td>Tendering Cost</td>
                                            
                                            
                                        </tr>

                                       
                                        
                                        <tr>
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Construction Projects');">Construction </a></td>
                                            <td><?php echo $Construction_count; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i>  <?php echo $construction_amnt; ?></td>
                                            <td>Construction Cost</td>
                                            
                                           
                                        </tr>
                                        <!-- <tr>
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Pre Construction');">Pre Construction </a></td>
                                            <td><?php echo $preConstruction_count; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i>  <?php echo $preconstruction_amnt; ?></td>
                                            <td>Fund Utilised</td> 
                                        </tr> -->
                                        <tr>
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Completed Projects');">Completed </a></td>
                                            <td><?php echo $completed_count; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i>  <?php echo $completed_amnt; ?></td>
                                            <td>Completed Cost</td>
                                            
                                           
                                        </tr>
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                       <!--    ===================== -->
                      <?php  if($this->session->userdata('division_id') != 0){?>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos camelcase">
                                    <thead>
                                        <tr>
                                            <th>Division name</th>
                                            <th>No of projects</th>
                                            <th>Amount</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
 
                                        <tr>
                                           
                                            <!-- <td><?php echo $this->session->userdata('division_user_name'); ?></td> -->
                                            <td class="cursors"><a class="pointer" onclick="project_summary_list('Overview Division Projects');"><?php  echo $division_name; ?> </a></td>
                                            <td> <?php echo $division_count; ?></td>
                                            <td><i class="fa fa-rupee-sign"></i> <?php echo number_format($division_amount,2); ?></td>
                                             
                                        </tr>
                                     
                                    </tbody>
                                </table>
                            </div>
                        </div>

                          <?php } else{  ?>


                           <?php } ?>
                        <!--    ===================== -->
    

					</div>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/charts/jquery-knob.js"></script>