<section class="content">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="block-header">
                <h4>Master <?php echo ucfirst(str_replace("_"," ",$this->uri->segment(3))); ?> List</h4>
            </div>
        </div>
        <div class="col-md-6">
            <?php

            //$add_link = strtolower($this->uri->segment(3));
            if($this->uri->segment(3) != ''){
                $add_link = site_url()."/Master/".strtolower($this->uri->segment(3));
            }
            ?>

            <a href="<?php echo $add_link; ?>"  class="btn bg-indigo waves-effect pull-right">
                <i class="fas fa-plus"></i>
                <span>ADD <?php echo strtoupper(str_replace("_"," ",$this->uri->segment(3))); ?> </span>
            </a>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>

                                    <th><?php echo ucfirst(str_replace("_"," ",$this->uri->segment(3))); ?> Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($lists as $list) {?>
                                    <?php
                                        $edit_link = site_url()."/Master/".strtolower($this->uri->segment(3))."/".md5($list['id']);
                                        $view_link = site_url()."/Master/view/".strtolower($this->uri->segment(3))."/".md5($list['id']);
                                        $name = empty($list['name'] ) ? $list['type'] : $list['name'];

                                    ?>
                                    <input type="hidden" id="ajax_base" value="<?php echo $href; ?>" >
                                    <tr>
                                        <td><?php echo $name; ?></td>
                                        <td>
                                            <a href="<?php echo $edit_link; ?>" class="btn btn-primary waves-effect" title="Other Settings"> <i class="fas fa-cog"></i></a>
                                            <?php $checked=''; if($list['status'] == 'Y'){ $checked = "checked";}?>
                                            <span class="switch" >
                                                        <label><input type="checkbox" id="status_check_bx#<?php echo $org['id']; ?>"  <?php echo $checked; ?>><span class="lever"></span></label>
                                                    </span>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php echo $links;  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->

    </div>
</section>
