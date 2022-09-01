<?php $CI =& get_instance();?>
<div class="card">
                        <div class="header">
                          <h2>Role Based Access</h2>
                        </div>
                        <div class="body">
                          <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                          <tr style="background: #333; color: white">
                                             <th style="width: 50%; text-align:center;">Module</th>
                                             <th style="width: 15%; text-align:center;">Access</th>
                                             <!-- <th style="width: 15%; text-align:center;">Manage</th> -->
                                          </tr>
                                        </thead>
                                            <tbody>
                                            <?php
                                            if($action_val=="edit"){ // For edit
                                                // echo '<pre>';
                                                // print_r($module_details);


                                                if(!empty($module_details)){
                                                    foreach ($module_details as $key => $value) {
                                                        $CI->load->model('User_model');
                                                       // $moduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$value['id']);

                                                        $moduleAccessByUserAr = $CI->getModuleAccessByUser($User_id,$value['id']);
                                                            $module_permission = $CI->User_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?></td>

                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" id="view<?php echo $value['id'];?>" class="filled-in" <?php if(!empty($moduleAccessByUserAr[0]['view']) && ($moduleAccessByUserAr[0]['view'] >0 )){ echo "checked"; } ?> />
                                                                <?php } ?>
                                                                    <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                            

                                                        </tr>

                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->User_model->getSubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {
														 /* echo "<pre>";
print_r($sub_module);
echo "<pre>";*/
														  ?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {
																  
																 // echo $val['id'];
																  
																  ?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('User_model');
                                                            $module_permission = $CI->User_model->get_module_permission($val['id']); 
                                                            $moduleAccessByUserAr = $CI->User_model->getModuleAccessInfoByUser($User_id,$val['id']);
                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{
																	
																	//echo "sdfsdfsdf";
																	//print_r($moduleAccessByUserAr);
																	
																	 ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>" <?php if(!empty($moduleAccessByUserAr[0]['view']) && ($moduleAccessByUserAr[0]['view'] >0 )){ echo "checked"; } ?> onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                            


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->

                                                        <?php
                                                    }
                                                } 

                                                ?>


                                           <!--      common module permission  -->
                                           <?php 
                                           if(!empty($common_module_details)){
                                                    foreach ($common_module_details as $key => $value) {
                                                        $CI->load->model('User_model');
                                                       // $moduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$value['id']);

                                                        $moduleAccessByUserAr = $CI->getModuleAccessByUser($User_id,$value['id']);
                                                            $module_permission = $CI->User_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?></td>

                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" id="view<?php echo $value['id'];?>" class="filled-in" <?php if(!empty($moduleAccessByUserAr[0]['view']) && ($moduleAccessByUserAr[0]['view'] >0 )){ echo "checked"; } ?> />
                                                                <?php } ?>
                                                                    <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                            

                                                        </tr>

                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->User_model->getCommon_SubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {
                                                         /* echo "<pre>";
print_r($sub_module);
echo "<pre>";*/
                                                          ?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {
                                                                  
                                                                 // echo $val['id'];
                                                                  
                                                                  ?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('User_model');
                                                            $module_permission = $CI->User_model->get_module_permission($val['id']); 
                                                            $moduleAccessByUserAr = $CI->User_model->getModuleAccessInfoByUser($User_id,$val['id']);
                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{
                                                                    
                                                                    //echo "sdfsdfsdf";
                                                                    //print_r($moduleAccessByUserAr);
                                                                    
                                                                     ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>" <?php if(!empty($moduleAccessByUserAr[0]['view']) && ($moduleAccessByUserAr[0]['view'] >0 )){ echo "checked"; } ?> onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                           


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->

                                                        <?php
                                                    }
                                                } 

                                                ?>

                                           <!-- End common module permission -->
                                                


                                           <?php  }else{ // For Add
                                            //echo "<pre>";

                                            // print_r($module_details);
                                            // die();

                                                if(!empty($module_details)){
                                                    foreach ($module_details as $key => $value) {
                                                        $CI->load->model('User_model');
                                                        $moduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$value['id']);

                                                        
                                                            $module_permission = $CI->User_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?> </td>

                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" id="view<?php echo $value['id'];?>" class="filled-in" <?php if(!empty($moduleAccessByRoleAr[0]['view']) && ($moduleAccessByRoleAr[0]['view'] >0 )){ echo "checked"; } ?> />
                                                                <?php } ?>
                                                                    <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                            

                                                        </tr>

                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->User_model->getSubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('User_model');
                                                            $module_permission = $CI->User_model->get_module_permission($val['id']); 
                                                            $submoduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$val['id']);

                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>" <?php if(!empty($submoduleAccessByRoleAr[0]['view']) && ($submoduleAccessByRoleAr[0]['view'] >0 )){ echo "checked"; } ?> onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                            


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->

                                                        <?php
                                                    }
                                                }
                                                ?>

                                               <!--  for common module -->
                                               <?php 
                                               if(!empty($common_module_details)){
                                                    foreach ($common_module_details as $key => $value) {
                                                        $CI->load->model('User_model');
                                                        $moduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$value['id']);

                                                        
                                                            $module_permission = $CI->User_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?> </td>

                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" id="view<?php echo $value['id'];?>" class="filled-in" <?php if(!empty($moduleAccessByRoleAr[0]['view']) && ($moduleAccessByRoleAr[0]['view'] >0 )){ echo "checked"; } ?> />
                                                                <?php } ?>
                                                                    <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                           

                                                        </tr>

                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->User_model->getCommon_SubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('User_model');
                                                            $module_permission = $CI->User_model->get_module_permission($val['id']); 
                                                            $submoduleAccessByRoleAr = $CI->User_model->getModuleAccessByRole($role_id,$val['id']);

                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>" <?php if(!empty($submoduleAccessByRoleAr[0]['view']) && ($submoduleAccessByRoleAr[0]['view'] >0 )){ echo "checked"; } ?> onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                            


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->

                                                        <?php
                                                    }
                                                }
                                                ?>

                                               <!-- ENd common module -->

                                                
                                           <?php  }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>

                        </div>
                </div>