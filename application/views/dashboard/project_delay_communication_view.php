<div class="messaging">
                        <div class="inbox_msg">
                          <div class="header bg-cyan">
                                <h2> <i class="fa fa-bell"></i> Notification History </h2>
                            </div>
                           <div class="mesgs">
                              <div class="msg_history">
                                <?php
                                if(is_array($get_communication_data)){
                                  foreach($get_communication_data as $val){
                                    $created_at_date = new DateTime($val->created_at);
                                    $sent_date = $created_at_date->format("g:i A | F j, Y ");
                                  if($val->sent_to == 0){
                                ?>
                                <div class="incoming_msg">
                                  <div class="incoming_msg_img"> <img src="<?php echo base_url().'assets/'; ?>images/user2.png" alt="sunil"> </div>
                                  <div class="received_msg">
                                    <div class="received_withd_msg">
                                      <div class=" col-md-12 m-0">
                                           <div class=" col-lg-6 col-md-6 col-xs-6 col-sm-6 send_by p-0"> Form: <?php echo $val->sent_by_first_name.' '.$val->sent_by_last_name; ?></div>
                                        </div>
                                      <br clear="all">
                                      <p><?php echo $val->remarks; ?></p>
                                      <span class="time_date"> <?php echo $sent_date; ?></span></div>
                                  </div>
                                </div>
                              <?php }else{ ?>
                                <div class="outgoing_msg">
                                    <div class="outgoing_msg_img"> <img src="<?php echo base_url().'assets/'; ?>images/user3.png" alt="sunil"> </div>
                                  <div class="sent_msg">
                                      <div class=" col-md-12 m-0">
                                           <div class=" col-lg-6 col-md-6 col-xs-6 col-sm-6 send_by p-0"> Form: <?php echo $val->sent_by_first_name.' '.$val->sent_by_last_name; ?></div>
                                           <div class=" col-lg-6 col-md-6 col-xs-6 col-sm-6 send_to p-0"> To: <?php echo $val->sent_to_first_name.' '.$val->sent_to_last_name; ?></div>
                                        </div>
                                      <br clear="all">
                                    <p><?php echo $val->remarks; ?></p>
                                    <span class="time_date"> <?php echo $sent_date; ?></span>
                                  </div>
                                    
                                </div>
                              <?php } } }else{ echo 'No Conversation Yet !!'; } ?>
                                
                              </div>
                           </div>
                        </div>
                    </div>