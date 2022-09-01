<?php   
$CI =& get_instance();
$menu_details = $CI->get_user_menu_acces_detail();


?>

<!-- Custom Css 
<link href="<?php echo base_url();?>assets/css/style_tooltip.css" rel="stylesheet">-->
<style>

</style>
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION </li>
                <?php 
                // ====== PAGE URL Maker ========
                $PageUrl = strtolower($this->uri->segment(1));
                    if($this->uri->segment(2)!='')
                    {
                        $PageUrl= strtolower($PageUrl."/".$this->uri->segment(2));
                    } 
                // ==============================
                foreach ($menu_details as $key => $menu)
                { 
                    //  ==== Fetch Parent Relationahip ID for Active Menu =======
                    //  ==== Check Whether Current URL Exist for  =======
                    $PageUrlParentId = $this->db->where('moduleUrl',$PageUrl)->where('status','Y')->where('parent_relation_id',$menu['module_id'])->get('module_master')->row();
                    
                    // Fetch Sub Menu Details for Parent ID
                    $sub_menu = $CI->get_submenu($menu['module_id']); ?>

                <?php if($menu['view'] > 0 || $menu['modify'] > 0 ){ ?>
                <?php if($menu['module_id'] == $PageUrlParentId->parent_relation_id) {?>
                <li class="active">
                    <?php } else { ?>  <li>  <?php } ?>
                <?php if( !empty($sub_menu)) { ?>
                <a href="javascript:void(0);" class="menu-toggle ">
                    <?php } else { ?>
                    <?php if( !empty($menu['moduleUrl'])){ ?>
                    <a href="<?php echo base_url().$menu['moduleUrl'];?>" class="waves-effect waves-block ">
                        <?php }else{ ?>
                        <a href="javascript:void(0);" class="waves-effect waves-block tooltip_hover">
                            <?php } ?>

                            <?php } ?>

                            <i class="fas <?php echo $menu['menu_icon'];?> fa-2x m-t-5"></i>

                            <span><?php echo $menu['moduleLabel']; ?></span>
                          
                            
                        </a>

                        <?php if( !empty($sub_menu)) { ?>
                        <ul class="ml-menu">
                            <?php $user_details = $CI->get_user_details();?>
                            
                            <?php 
                                //======Sub Menu Loop=======
                                foreach ( $sub_menu as $skey => $sub ){ ?>
                            <?php if($sub['view'] > 0 || $sub['modify'] > 0 || $user_details[0]['user_type'] <= 2 ){ ?>
                            <?php $url = explode("/",$sub['moduleUrl']); ?>
                            <?php  if($this->router->fetch_method() == $url[1]){ ?>
                            <li class="active">
                                <?php } else { ?>
                            <li>
                                <?php } ?>
                                <?php if(! empty($sub['moduleUrl'])){ ?>
                                <a href="<?php echo base_url().$sub['moduleUrl'];?>" class="">
                                    <?php }else{ ?>
                                    <a href="javascript:void(0);">
                                        <?php } ?>
                                        <?php if( $this->router->fetch_method() != $url[1] ){?>
                                        <!--<i class="fas <?php echo $sub['menu_icon'];?> fa-2x m-t-10"></i>-->
                                        <i class="fa fa-angle-double-right m-t-5 "></i>
                                        <?php } ?>
                                        <span><?php echo $sub['moduleLabel']; ?></span>
                                    </a>
                                    </li>
                                <?php } } //End of Submenu 
                            ?>
                        </ul>
                        <?php } ?>
                        </li>
                    <?php } ?>

                    <?php } ?>




                    </ul>
                </div>
            <!-- #Menu -->
            </aside>
        <!-- #END# Left Sidebar -->
        </section>

<script>
       var tooltips = document.querySelectorAll('.tooltip_hover .tool_box');
      //var tooltipSpan = document.getElementById('tooltip_hover-span');

        window.onmousemove = function (e) {
            var x = (e.clientX + 20) + 'px',
                y = (e.clientY + 20) + 'px';
            for (var i = 0; i < tooltips.length; i++) {
                tooltips[i].style.top = y;
                tooltips[i].style.left = x;
            }
        };    
    </script>