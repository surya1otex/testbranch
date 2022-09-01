<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>Master Sector List Form</h4>
        </div>
        <!-- Input -->
        <div class="row clearfix ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> <?php echo (!empty($sector_id)) ? 'Update' : 'Add' ?> Sector Form  </h2>
                        <div style=" color: red;"><?php echo $this->session->flashdata('message'); ?></div>
                    </div>
                    <?php echo form_open('Master/sector_submit',array('name'=> 'Master')); ?>
                  <?php if(!empty($sector_id)) {?>
                      <input type="hidden" name="token" value="<?php echo $sector_id; ?>" />

                   <?php } ?>

                    <div class="body">
                        <div class="section_clone">
                            <div class="row clearfix cloneBox1">
                                <div class="col-sm-12">
                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Sector Name :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">



                                            <?php $val = (!empty($_REQUEST['name'])) ? $_REQUEST['name'] : $result['name']; ?>
                                            <input type="text" name="name"  value="<?php echo $val;?>" class="form-control" placeholder=" Sector Name" />
                                            <span style='color:#ff0000'><?php echo ( form_error('name') ) ? form_error('name') : $error_msg ; ?></span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="SmeUserMasterMiddleName" class="input-xlarge"  style="vertical-align:middle; padding-top:8px;">
                                            Status :
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-line">

                                            <span class="switch" >
                                                <?php $checked=''; if($result['status'] == 'Y'){ $checked = "checked";}?>
                                            <label><input name="status" type="checkbox" <?php echo $checked; ?> >
                                                <span class="lever"></span></label>
                                            </span>
                                            <span style='color:#ff0000'><?php echo form_error('status'); ?></span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-2 col-md-offset-5" style="margin-top: -21px;">
                                <?php $btnName = "CREATE";  if(!empty($sector_id)) { $btnName = "UPDATE"; }?>
                                <button class="btn bg-indigo waves-effect" type="submit"> <?php echo $btnName; ?></button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- #END# Input -->

        <!-- Select -->

    </div>
</section>

