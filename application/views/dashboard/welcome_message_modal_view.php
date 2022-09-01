  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content modal_scroll">
      <?php
	  /*echo "<pre>";
					print_r($user_details);
					echo "</pre>";
	  echo "<pre>";
					print_r($role_details);
					echo "</pre>";*/
	  
	  ?>
        
                        <div class="modal-header">
                            <h4 class="modal-title" id="largeModalLabel">Hey <?php echo $user_details[0]['firstname']; ?>  <?php echo $user_details[0]['lastname']; ?>,</h4><h5> Welcome to Project Monitoring Dashboard</h5> <h5> You have logged in as <span class="col-pink" ><?php echo $role_details[0]['role']; ?>. </span></h5>
                        </div>
                        <div class="modal-body p-t-0">
                        <?php echo urldecode($role_details[0]['role_description']); ?>
                                                
                        </div>
                        <div class="modal-footer">
                         
                        
                        <button class="btn bg-blue waves-effect" type="button" data-dismiss="modal" onclick="window.location.href='<?php echo base_url(); ?><?php echo $role_details[0]['default_page']; ?>'">
<i class="material-icons">verified_user</i>
<span>CONTINUE</span>
</button>
                       
                        <button class="btn btn-danger waves-effect" type="button" onclick="window.location.href='<?php echo base_url();?>userdashboard/logout'">
<i class="material-icons">cancel</i>
<span>CLOSE</span>
</button>
                            
                        </div>
     
    </div>
  </div>
