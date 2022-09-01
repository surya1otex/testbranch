<?php 
  $CI =& get_instance();
  //echo "<pre>"; print_r($ar_work_item_type_master_details); die();
?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
        <div class="block-header">
          <?php $this->session->flashdata('message'); ?>
          <h4>Vendor Management</h4>
          <div style=" color: red;"><?php echo $this->session->flashdata('message'); ?></div>
        </div>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                  

                <div class="card">
                        <div class="header">
                          <h2>Add a Vendor</h2>
                        </div>
                        <div class="body">
                          <?php echo form_open('Master/add_vendor',array('name'=> 'add_vendor','id'=>'add_vendor')); ?>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                       <!-- <th>AOC Component Name </th>-->
                                            <th>Vendor Name<span style="color: red;">*</span> </th>
                                            <th>Status<span style="color: red;">*</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                              <!-- <input type="hidden" name="project_id" value="<?php //echo base64_encode($project_id); ?>"> -->
                                              <input type="hidden" name="vendor_id" value="<?php echo base64_encode($vendor_id); ?>">

                                              <input type="text" class="form-control" placeholder="Name" required="" name="title" value="<?php if(!empty($vendor_detail_edit[0]['vendor'])){echo $vendor_detail_edit[0]['vendor'];}else{echo "";}?>"/>
                                            </td>



                                            <td>
                                              <select class="form-control show-tick" name="status" required="">
                                                <option value="Y" <?php if(!empty($vendor_detail_edit) &&($vendor_detail_edit[0]['status']=="Y")){echo "selected";}?>>Active</option>
                                                <option value="N" <?php if(!empty($vendor_detail_edit) &&($vendor_detail_edit[0]['status']=="N")){echo "selected";}?>>Inactive</option>
                                              </select>
                                            </td>
                                        </tr>
                  </tbody>
                </table>
                              <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                   
                                   <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                   <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                              </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    
                    
                    <div class="card">
             <div class="body">
               <div class="table-responsive" style="overflow-x: hidden;">
                                <table class="table table-bordered table-striped table-hover js-basic-example-work-item-master dataTable">
                                   <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">Sl No</th>
                                            <th style="text-align: center; vertical-align: middle;">Work Item</th>
                                            <th style="text-align: center; vertical-align: middle;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($ar_vendor_master_details)){
                                                $i=1;
                                                foreach($ar_vendor_master_details as $vendor_details){
                                        ?>
                                                  <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $vendor_details['vendor'];?></td>

                                                    <td style="text-align: center; vertical-align: middle;">
                                                      <a href="<?php echo site_url(); ?>/Master/vendor?vendor_id=<?php echo base64_encode($vendor_details['id']); ?>" class="m-r-10 col-black"> <i title="Edit Item" class="fas fa-edit"></i> </a>
                                                      <a href="<?php echo site_url(); ?>/Master/delete_vendor?vendor_id=<?php echo base64_encode($vendor_details['id']); ?>" class="col-black" onclick="return confirm('Are you sure?')"> <i title="Delete Item" class="fas fa-trash"></i> </a>

                                                      &nbsp;&nbsp;&nbsp;
                                                      <?php if($vendor_details['status']=='Y'){?>
                                                        <i title="Current Status: Active" class="fas fa-check col-green"></i>
                                                      <?php }else{ ?>  
                                                        <i title="Current Status: Inactive" class="fas fa-times col-red"></i>
                                                      <?php } ?>  
                                                    </td>
                                                  </tr>

                                        <?php 
                                                 $i++;
                                                }
                                        ?>
                                        
                                       <?php }else{?> 
                                         <tr>
                                            <td colspan="3">No Record Available</td>
                                         </tr>
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