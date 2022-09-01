<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
            
           <div class="col-md-6">
				<div class="block-header">
					<h4>Master Manager</h4>
				</div>
            </div>
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   
                        
                        <div class="body">
                            <div class="row">
                                <?php 
                                if(is_array($accessData)){
                                    foreach ($accessData as $key) {
                                        if($key->linked_table){
                                          $total_count = $CI->get_organization_access_count($key->linked_table);  
                                      }else{
                                        $total_count = '';
                                      }
                                 
                                 
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                   <div class="info-box-4 hover-zoom-effect">
                                    <a href="<?php echo site_url().'/'.$key->moduleUrl; ?>" >
                                        <div class="icon">
                                           <?php echo $key->menu_icon; ?>
                                        </div>
                                        <div class="content">
                                            <div class="text"><?php echo $key->moduleLabel; ?></div>
                                            <div class="number"><?php echo $total_count; ?></div>
                                        </div>
                                    </a> 
                                    </div>
                                   
                                </div>
                            <?php }  } ?>
                            </div>
                            <!-- #END# Hover Zoom Effect -->
                            
                        </div>
                    
                </div>
            </div>
            <!-- #END# Basic Examples -->
       
			
    <!-- START WELCOME MODAL MESSAGE  -->
    		<div id="welcome-modal" class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">


</div>	
	<!-- End WELCOME MODAL MESSAGE  -->
        </div>
    </section>
    
    <script type="text/javascript">
        <?php
	 $login_type = $_GET['type'];
	 
	if ($login_type == "login"){
	?>
	 $(document).ready(function() {

    
	load_details();
	//$('#initial_modal').modal('show');
	 });
	<?php
	} 
	?>
	</script>
    
    <script type="text/javascript">
function load_details()
{
         var Rurl = "<?php echo base_url();?>Userdashboard/modalwelcomemsgDetails";
        $.ajax({
            type: 'GET',
            url: Rurl,
            success: function (output) {
            $('#welcome-modal').html(output).modal('show');//now its working
            },
            error: function(output){
            alert("fail");
            }
	 });
	
 
}
</script>
