<link href="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <section class="content">
        <div class="container-fluid">


   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Issue Details </h2>

                        </div>
                        <div class="body">
                            <div class="m-b-15">
                               <table class="table">
                                <tr>
                                   <th>Sl No</th>
                                   <th>Issue Name</th>
                                   <th>Action Taken</th>
                                   <th>Status</th>
                                 </tr>
                                 <?php
                                   $slno = 1;
                                   foreach($issue_details as $isdetails) { ?>
                                      <tr>
                                         <td><?php echo $slno; ?></td>
                                         <td><?php echo $isdetails->issues; ?></td>
                                         <td><?php echo $isdetails->action_taken; ?></td>
                                         <td><?php echo ($isdetails->current_status == 'Y') ? 'Closed' : 'Open' ; ?></td>
                                      </tr>
                                  <?php  $slno++; }  ?>
                               </table>
                            </div>
                        </div>
                    </div>
            
                     </div>
                  </div>

            <!-- Select -->
        </div>
    </section>

    <!-- #Main Content -->
    
         <!-- Footer -->

</body>
<style type="text/css">
    #hidden_dist_fetch {
        display: none;
    }
      .error {
        color: red;
        padding-bottom: 10px;
      }
      #warning-message {
        color: red;
      }
      #warning-message2 {
        color: red;
      }
</style>
</html>