

  <?php $CI =& get_instance();?>


  <?php
            
    if(!empty($role_id)){
      $frm_action = base_url().'roles/create?roleId='.base64_encode($role_id);
      $pageTitle = 'Update Roles & Permission';
       $btnName = 'Update';
    }else{
      $frm_action = base_url().'roles/create';
      $pageTitle = 'Create Roles & Permission';
     
      $btnName = 'Save';
    }
    
    ?>
    <style>
.ntip {
  position: relative;
  display: inline-block;
  cursor:pointer;
}

.ntip .ntiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}


.ntip:hover .ntiptext {
  visibility: visible;
  opacity: 1;
}        
        
</style>


<script type="text/javascript" language="JavaScript">
<!--

function quesChars(entry) {
  //console.log(entry);
  //alert(entry);
  //exit;
   //temp = "" + entry; // temporary holder
  // document.getElementById('content').value = escape(temp);
   //temp = "" + entry; // temporary holder
   var ss = unescape(entry);
  //alert(ss);
   // $("#content").val(entry);
 document.getElementById('role_description').value = escape(entry);
   //$('#content').html(entry);
 //exit; 
}

-->
</script>
<!-- CK Editor -->
<script src="<?php echo base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>


<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>Roles & Permission </h4>
            </div>
  

            
            <form action="<?php echo $frm_action; ?>" method="POST" onsubmit="quesChars(CKEDITOR.instances.editor1.getData())" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $pageTitle; ?></h2>
                        </div>

                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>Role name <span class="col-pink">* </span></b>   <span class="ntip"><i class="fa fa-info-circle" title=""></i>
                                        <span class="ntiptext">Role name info</span>
                                        </span>
                                      
                                    </p>
                                    <input type="text" name="role" value="<?php echo $role; ?>" id="role" class="form-control" placeholder="Enter role's name" />
                                    <?php echo form_error('role'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Default Page <span class="col-pink">* </span></b> <span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">Default Page set for role</span>
                                        </span>
                                    </p>
                                    <select class="form-control show-tick" name="default_page" id="default_page">
                                        <option value="">Select Default Page</option>
                                        <?php
                                        if(is_array($defaultPageData)){
                                            foreach ($defaultPageData as $default) {
                                          
                                        ?>
                                        <option value="<?php echo $default->moduleUrl; ?>" <?php if($default->moduleUrl == $default_page){ echo 'selected'; } ?>> <?php echo $default->lebel; ?></option>

                                    <?php } } ?>
                                    </select>
                                    <?php echo form_error('default_page'); ?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Status <span class="col-pink">* </span></b><span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">Role Status</span>
                                        </span>
                                    </p>
                                    <select class="form-control show-tick" name="status" id="status">
                                        <option value="Y" <?php if($status == 'Y'){ echo 'selected'; } ?>>Active</option>
                                        <option value="N" <?php if($status == 'N'){ echo 'selected'; } ?>>Inactive</option>
                                    </select>
                                    <?php echo form_error('status'); ?>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p>
                                        <b>Description <span class="col-pink">* </span></b><span class="ntip"><i class="fa fa-info-circle" title=""></i> <span class="ntiptext">Role Description</span>
                                        </span>
                                    </p>
                                    <textarea class="textarea"  name="editor1" id="editor1" rows="10" cols="80">
                                                <?php if ($role_description) {  echo urldecode($role_description); } ?>   
                                                </textarea>
                                                <script type="text/javascript">
   CKEDITOR.replace( 'editor1', {
        height: 200,
    width:"100%",   
       // filebrowserUploadUrl: "/ckeditor_fileupload/ajaxfile.php?type=file",
     
       // filebrowserImageUploadUrl: "<?= base_url()?>assets/ckeditor_fileupload/quesajaxfile.php?type=image",

     } );
   
   
         </script>
                     <textarea name="role_description" id="role_description" style="visibility:hidden"></textarea>  
                     <?php echo form_error('role_description'); ?>


                                    
                                </div>
                                  
                                
                            </div>
                            
                        
                        <div class="clearfix"></div>
                        </div>

                          </div>
                      </div>
                  </div>
                  
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Permission</h2>
                        </div>

                        <div class="body">
                        <div class="cloneBox1 m-b-15">
                            
                            
                            <div class="row clearfix">
                              <?php
                                    if(form_error('view[]')){
                                        echo '<div class="col-pink">Atleast Check One view</div>';
                                    }

                                    if(form_error('modify[]')){
                                        echo '<div class="col-pink">Atleast Check One modify</div>';
                                    }
                                    ?>
                                <?php
                                //print_r($module_details);
                                ?>
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
                                            if(!empty($role_id)){ // For edit


                                                if(!empty($module_details)){
                                                    foreach ($module_details as $key => $value) {
                                                        $CI->load->model('Roles_model');
                                                        $moduleAccessByRoleAr = $CI->Roles_model->getModuleAccessByRole($role_id,$value['id']);

                                                        
                                                            $module_permission = $CI->Roles_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?></td>

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
                                                        <?php $sub_module = $CI->Roles_model->getSubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($val['id']); 
                                                            $submoduleAccessByRoleAr = $CI->Roles_model->getModuleAccessByRole($role_id,$val['id']);

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
                                                <!-- FOr common module -->
                                                <?php
                                                if(!empty($common_module_details)){
                                                    foreach ($common_module_details as $key => $value) {
                                                        $CI->load->model('Roles_model');
                                                        $moduleAccessByRoleAr = $CI->Roles_model->getModuleAccessByRole($role_id,$value['id']);

                                                        
                                                            $module_permission = $CI->Roles_model->get_module_permission($value['id']); 
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $value['moduleLabel']; ?></td>

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
                                                        <?php $sub_module = $CI->Roles_model->getCommon_SubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($val['id']); 
                                                            $submoduleAccessByRoleAr = $CI->Roles_model->getModuleAccessByRole($role_id,$val['id']);

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

                                                <!-- End FOr common module -->


                                            <?php }else{ // For Add
                                                if(!empty($module_details)){
                                                    $i=0;
                                                    foreach ($module_details as $key => $value) {
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $module_details[$key]['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($value['id']); 
                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id']; ?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1" />

                                                                <?php } ?>
                                                                <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                            


                                                        </tr>
                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->Roles_model->getSubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($val['id']); ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>"  value="1" onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                            


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->
                                                        <?php
                                                        $i++;}
                                                }

                                                ?>

                                               <!--  common module  -->

                                               <?php
                                               if(!empty($common_module_details)){
                                                    $i=0;
                                                    foreach ($common_module_details as $key => $value) {
                                                        ?>
                                                        <tr style="background: #eee">
                                                            <td scope="row" class="text-light-blue" style="vertical-align: middle; font-weight: bold"><?php echo $common_module_details[$key]['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($value['id']); 
                                                            ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id']; ?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $value['id']; ?>][]" class="filled-in" id="view<?php echo $value['id'];?>"  value="1" />

                                                                <?php } ?>
                                                                <label for="view<?php echo $value['id'];?>"></label>

                                                            </td>
                                                           


                                                        </tr>
                                                        <!-- Start Sub module -->
                                                        <?php $sub_module = $CI->Roles_model->getCommon_SubModule($value['id']); ?>
                                                      <?php if(!empty($sub_module)) {?>

                                                              <?php foreach( $sub_module as $m_id => $val )  {?>
                                                                <tr>
                                                            <td scope="row"><?php echo $val['moduleLabel']; ?></td>
                                                            <?php 
                                                            $CI->load->model('Roles_model');
                                                            $module_permission = $CI->Roles_model->get_module_permission($val['id']); ?>
                                                            <td>
                                                                <?php if($module_permission[0]['view'] == 0 ){?>
                                                                    <input type="checkbox" disabled="disabled" name="view[<?php echo $val['id']; ?>][]" class="filled-in" id="subview<?php echo $key.'_'.$m_id;?>"  value="1"/>
                                                                <?php }else{ ?>
                                                                    <input type="checkbox" name="view[<?php echo $val['id']; ?>][]" class="filled-in sub_view_<?php echo $val['id']; ?>" id="subview<?php echo $key.'_'.$m_id;?>"  value="1" onclick="changeSameViewParentData(<?php echo $value['id'].','.$val['id']; ?>)"/>

                                                                <?php } ?>
                                                                <label for="subview<?php echo $key.'_'.$m_id;?>"></label>

                                                            </td>
                                                            


                                                        </tr>




                                                        <?php } } ?>
                                                        <!-- Submodule end -->
                                                        <?php
                                                        $i++;}
                                                }

                                                ?>
                                               <!--  End  common module  -->
                                            <?php }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 align-center">

                        
                        <a href="<?php echo base_url().'roles/role_list'; ?>" class="btn btn-primary waves-effect">Cancel</a>
                        <button class="btn btn-success waves-effect" type="submit" name="submit" value="Submit"><?php echo $btnName; ?></button>
                        </div>
                        <div class="clearfix"></div>
                        </div>

                          </div>
                      </div>
                  </div>
              </form>


            <!-- Select -->

        </div>
    </section>
    <!-- #Main Content -->




<script type="text/javascript">
  
  // function checkSameParentManage(parentId){
  //   $(".chkedSubManage" + parentId).prop('checked', true);  
  //   $("#same_parent_view" + parentId).prop('checked', true);  
  //   $(".chkedSubView" + parentId).prop('checked', true);  
  // }

  // function checkSameParentView(parentId){
  //   $(".chkedSubView" + parentId).prop('checked', true);  
  // }

  function changeSameViewParentData(parentModuleId,subModuleId){
   // alert(parentModuleId);
    $("#view" + parentModuleId).prop('checked', true);  
  }

  function changeSameManageParentData(parentModuleId,subModuleId){
    //alert(parentModuleId);
     $("#manage" + parentModuleId).prop('checked', true);
     $("#view" + parentModuleId).prop('checked', true);
     $(".sub_view_"+ subModuleId).prop('checked', true);
     var cbs = document.querySelectorAll('input[type="checkbox"]:checked:disabled');
  for(var i = 0;i<cbs.length;i++){
    cbs[i].checked = 0;
  }
  }
</script>