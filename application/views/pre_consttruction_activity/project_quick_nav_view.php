 <!-- Quick Nav   -->
   <?php $CI =& get_instance(); ?>         
 <div class="card clearfix">
    <div class="header">
        <h2>Quick Navigation </h2>
    </div>
    
    <div class="col-md-4">
      <div class="row ">
        <div class="body">
            <ul class="list-unstyled">
                <?php
                if($project_pre_construction_setting[0]['land_schedule'] == 'Y'){
                    
                    $chk_no = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_land_schedule','project_id',$project_id);
                    if($chk_no > 0){
                        $cls = 'col-teal';
                    }else{
                       $cls = 'col-pink'; 
                    }
                ?>
                <li class="m-b-10"><a href="land_schedule?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls; ?> mb-20"><i class="fas fa-angle-right"></i> Land Schedule </a></li>
            <?php } 
                if($project_pre_construction_setting[0]['govt_land_alienation'] == 'Y'){

                    $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_govt_land_alienation','project_id',$project_id);
                    $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_govt_land_alienation','project_id',$project_id,'progress_%');
                    if(!empty($progress2)){
                        $progress2 = '('.$progress2.'%)';
                    }
                        if($chk_no2 > 0){
                            $cls2 = 'col-teal';
                        }else{
                           $cls2 = 'col-pink'; 
                        }
                ?>


                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_government_land_alienation/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Government Land Alienation <?php echo $progress2; ?> </a></li>
                <?php } 
                    if($project_pre_construction_setting[0]['private_land_direct_purchase'] == 'Y'){

                        $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_pvt_land_direct_purchase','project_id',$project_id);
                        $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_pvt_land_direct_purchase','project_id',$project_id,'progress_%');
                        if(!empty($progress2)){
                            $progress2 = '('.$progress2.'%)';
                        }
                            if($chk_no2 > 0){
                                $cls2 = 'col-teal';
                            }else{
                               $cls2 = 'col-pink'; 
                            }
                    ?>


                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_private_land_dp/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Private Land - Direct Purchase <?php echo $progress2; ?> </a></li>

                 <?php } 
                    if($project_pre_construction_setting[0]['private_land_acquisition'] == 'Y'){

                        $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_pvt_land_acquistion','project_id',$project_id);
                        $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_pvt_land_acquistion','project_id',$project_id,'progress_%');
                        if(!empty($progress2)){
                            $progress2 = '('.$progress2.'%)';
                        }
                            if($chk_no2 > 0){
                                $cls2 = 'col-teal';
                            }else{
                               $cls2 = 'col-pink'; 
                            }
                    ?>

                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_private_land_la/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Private Land - Land Acquisition <?php echo $progress2; ?> </a></li>
            <?php } ?>
            </ul>
         </div>
       </div>
     </div>

     <div class="col-md-4">
       <div class="row ">
        <div class="body">
            <ul class="list-unstyled"> 
                <?php if($project_pre_construction_setting[0]['forest_land'] == 'Y'){
                    $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_forest_land','project_id',$project_id);
                    $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_forest_land','project_id',$project_id,'progress_%');
                    if(!empty($progress2)){
                        $progress2 = '('.$progress2.'%)';
                    }
                        if($chk_no2 > 0){
                            $cls2 = 'col-teal';
                        }else{
                           $cls2 = 'col-pink'; 
                        }
                ?>
                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_forest_land/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Forest Land <?php echo $progress2; ?></a></li>
                <?php }
                    if($project_pre_construction_setting[0]['tree_cutting'] == 'Y'){
                        $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_tree_cutting','project_id',$project_id);
                    $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_tree_cutting','project_id',$project_id,'progress_%');
                    if(!empty($progress2)){
                        $progress2 = '('.$progress2.'%)';
                    }
                        if($chk_no2 > 0){
                            $cls2 = 'col-teal';
                        }else{
                           $cls2 = 'col-pink'; 
                        }
                ?>

                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_tree_cutting/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Tree Cutting <?php echo $progress2; ?></a></li>

                <?php }
                                        if($project_pre_construction_setting[0]['environmental_clearance'] == 'Y'){

                                            $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_environment_clearance','project_id',$project_id);
                                        //$progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_tree_cutting','project_id',$project_id,'progress_%');
                                        // if(!empty($progress2)){
                                        //     $progress2 = '('.$progress2.'%)';
                                        // }
                                            if($chk_no2 > 0){
                                                $cls2 = 'col-teal';
                                            }else{
                                               $cls2 = 'col-pink'; 
                                            }
                                    ?>

                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_environmental_clearance/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Environmental Clearance</a></li>

                <?php }
                if($project_pre_construction_setting[0]['utility_shifting_electrical'] == 'Y'){
                    $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_electrical','project_id',$project_id);
                    $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_utility_shifting_electrical','project_id',$project_id,'progress_%');
                    if(!empty($progress2)){
                        $progress2 = '('.$progress2.'%)';
                    }
                        if($chk_no2 > 0){
                            $cls2 = 'col-teal';
                        }else{
                           $cls2 = 'col-pink'; 
                        }



            ?>

                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_electrical/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Utility Shifting - Electrical <?php echo $progress2; ?> </a></li>
            <?php } ?>
            </ul>
         </div>
       </div>
     </div>
    
    <div class="col-md-4">
       <div class="row ">
        <div class="body">
            <ul class="list-unstyled"> 
                <?php if($project_pre_construction_setting[0]['utility_shifting_PH'] == 'Y'){

                    $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_ph','project_id',$project_id);
                    $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_utility_shifting_ph','project_id',$project_id,'progress_%');
                    if(!empty($progress2)){
                        $progress2 = '('.$progress2.'%)';
                    }
                        if($chk_no2 > 0){
                            $cls2 = 'col-teal';
                        }else{
                           $cls2 = 'col-pink'; 
                        }
            ?>
                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_ph/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Utility Shifting - PH <?php echo $progress2; ?> </a></li>

                <?php }
                    if($project_pre_construction_setting[0]['utility_shifting_RWSS'] == 'Y'){

                        $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_utility_shifting_rwss','project_id',$project_id);
                            $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_utility_shifting_rwss','project_id',$project_id,'progress_%');
                            if(!empty($progress2)){
                                $progress2 = '('.$progress2.'%)';
                            }
                                if($chk_no2 > 0){
                                    $cls2 = 'col-teal';
                                }else{
                                   $cls2 = 'col-pink'; 
                                }
                    ?>

                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_utility_shifting_rwss/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Utility Shifting - RWSS <?php echo $progress2; ?> </a></li>
                <?php } if($project_pre_construction_setting[0]['encroachment_eviction'] == 'Y'){

                $chk_no2 = $CI->Pre_con_act_quick_nav_model->check_pre_construction_quick_nav_value_exist_or_not_in_tbl('pre_construction_activities_encroachment_eviction','project_id',$project_id);
                        $progress2 = $CI->Pre_con_act_quick_nav_model->get_quick_nav_data_against_value('pre_construction_activities_encroachment_eviction','project_id',$project_id,'progress_%');
                        if(!empty($progress2)){
                            $progress2 = '('.$progress2.'%)';
                        }
                            if($chk_no2 > 0){
                                $cls2 = 'col-teal';
                            }else{
                               $cls2 = 'col-pink'; 
                            }
                ?>
                <li class="m-b-10"><a href="<?php echo base_url(); ?>Pre_consttruction_activity_encroachment_eviction/manage?project_id=<?php echo base64_encode($project_id); ?>" class="font-underline <?php echo $cls2; ?>"><i class="fas fa-angle-right"></i> Encroachment Eviction <?php echo $progress2; ?></a></li>

                <?php } ?>
            </ul>
         </div>
       </div>
     </div>
    
</div> 
            
<!-- Quick Nav end -->   