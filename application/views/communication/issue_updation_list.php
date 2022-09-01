<section class="content">
        <div class="container-fluid">
           <div class="col-md-12">
				<div class="block-header">
					<h4>Issue List</h4>
				</div>
            </div>
            <!-- Basic Examples -->
<?php include("include/project_information.php");?> 
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <table id="issue-list" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Issue Name</th>
                                            <th>Issuer Name</th>
                                            <th>Added By</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        //print_r($issue_list);
                                        //echo $project_id;
                                        $slno = 1;
                                        foreach($issue_list as $issue) { ?> 
                                        <tr>
                                            <td><?php echo $slno; ?></td>
                                            <td><?php echo $issue->issue_name; ?>
                                            <td><?php echo $issue->issuer_name; ?>
                                             </td>
                                            <td>OBCC</td>
                                            <td>

                                              <?php
                                              if($user_id == $issue->entered_by) { ?>

                                                 <a href="<?php echo base_url(); ?>Document_upload/manage?project_id=<?php echo base64_encode($project_id); ?>&id=<?php echo $issue->id; ?>" class="btn btn-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Modify</a>

                                               <?php } else {
                                                ?>
                                                <a href="<?php echo base_url(); ?>Document_upload/document_details?project_id=<?php echo base64_encode($project_id); ?>&id=<?php echo $issue->id; ?>" class="btn btn-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Details</a>
                                                <?php

                                               } ?>


                                                <!-- <a href="#" class="btn btn-danger waves-effect" title=""><i class="fa fa-trash"></i> Delete</a> -->
                                            </td>
                                        </tr>

                                    <?php  $slno++; } ?>
<!--                                         <tr>
                                            <td>02</td>
                                            <td>Sample Project 01 </td>
                                            <td>ESTPL</td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>Issues/view_issue_details" class="btn btn-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Details</a>
                                                <a href="#" class="btn btn-danger waves-effect" title="" disabled=""><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>Sample Project 01 </td>
                                            <td>CMMA</td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>Issues/view_issue_details" class="btn btn-primary waves-effect" title=""><i class="fa fa-pencil-alt"></i> Details</a>
                                                <a href="#" class="btn btn-danger waves-effect" title="" disabled=""><i class="fa fa-trash"></i> Delete</a>
                                            </td>
                                        </tr> -->
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