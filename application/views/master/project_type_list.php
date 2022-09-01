<?php
$CI =& get_instance();
//echo "<pre>"; print_r($ar_work_item_type_master_details); die();
?>
<section class="content">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="block-header">
                <?php $this->session->flashdata('message'); ?>
                <h4>Project Type Master Management</h4>
                <div style=" color: red;"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="header">
                        <h2>Add a Project Type</h2>
                    </div>
                    <div class="body">
                        <?php echo form_open('Master/add_project_type',array('name'=> 'add_project_type','id'=>'add_project_type')); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example-area-master dataTable">
                                <thead>
                                <tr>
                                    <!-- <th>AOC Component Name </th>-->
                                    <th>Name<span style="color: red;">*</span> </th>
                                    <th>Status<span style="color: red;">*</span> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" name="project_type_id" value="<?php echo base64_encode($project_type_id); ?>">

                                        <input type="text" class="form-control" placeholder="Name" required="" name="name" value="<?php if(!empty($unit_detail_edit[0]['project_type'])){echo $unit_detail_edit[0]['project_type'];}else{echo "";}?>"/>
                                    </td>

                                    <td>
                                        <select class="form-control show-tick" name="status" required="">
                                            <option value="Y" <?php if(!empty($unit_detail_edit) &&($unit_detail_edit[0]['status']=="Y")){echo "selected";}?>>Active</option>
                                            <option value="N" <?php if(!empty($unit_detail_edit) &&($unit_detail_edit[0]['status']=="N")){echo "selected";}?>>Inactive</option>
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
                            <table class="table table-bordered table-striped table-hover js-basic-example-unit-master dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Sl No</th>
                                    <th style="text-align: center; vertical-align: middle;">Proejct Type Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($ar_unit_details)){
                                    $i=1;
                                    foreach($ar_unit_details as $unit_details){
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $unit_details['project_type'];?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="<?php echo site_url(); ?>/Master/project_type?project_type_id=<?php echo base64_encode($unit_details['id']); ?>" class="m-r-10 col-black"> <i title="Edit Item" class="fas fa-edit"></i> </a>
                                                <!--<a href="<?php /*echo base_url(); */?>Master/delete_unit?unit_id=<?php /*echo base64_encode($unit_details['id']); */?>" class="col-black" onclick="return confirm('Are you sure?')"> <i title="Delete Unit" class="fas fa-trash"></i> </a>-->

                                                &nbsp;&nbsp;&nbsp;
                                                <?php if($unit_details['status']=='Y'){?>
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