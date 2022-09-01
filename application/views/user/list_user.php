<?php $CI =& get_instance(); ?>
<section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <div class="block-header">
                    <h4>USER LIST</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <a href="<?php echo base_url(); ?>User/add_user"  class="btn bg-indigo waves-effect pull-right">
                  <i class="fas fa-plus"></i>
                  <span>ADD USER </span>
                </a>
            </div>
            <!-- Basic Examples -->
            <!-- Alert Message -->
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } if($this->session->flashdata('danger')){ ?>
        <div class="alert alert-danger alert-dismissible text-center fade-message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <?php echo $this->session->flashdata('danger'); ?>
          </div>
      <?php } ?>
        </div>        
        
    </div>
    <!-- End Alert Message -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($userList)){
                                              $i=1;
                                              foreach($userList as $userlist){
                                                $user_type= $CI->user_type($userlist['user_type']);
                                      ?>
                                        <tr>
                                            <td style="width: 10%"><?php echo $i;?></td>
                                            <td style="width: 30%"><?php echo $userlist['firstname']." ".$userlist['lastname']?></td>
                                            <td style="width: 20%"><?php echo $userlist['username'];?></td>
                                            <td style="width: 20%"><?php echo $userlist['type'];?></td>
                                            <td style="width: 20%">
                                               <a href="<?php echo base_url(); ?>User/add_user?user_id=<?php echo base64_encode($userlist['user_id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                      <?php $i++;}}else{?>
                                        <tr><td colspan="5">No data found</td></tr>
                                      <?php } ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>

    <!-- Alert Page js for hide alert  -->
<script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

});
</script>
<!-- ENd Alert Page js for hide alert  -->




    <!-- Jquery DataTable Plugin Js -->
    <!-- <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script> -->


