<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h3>Issue Details</h3>
				</div>
            </div>
            <div class="col-md-6">
				<!--<a href="#"  class="btn bg-indigo waves-effect pull-right">
				  <i class="fas fa-plus"></i>
				  <span>ADD PROJECT </span>
			    </a>-->
			</div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6 p-0 card card-m">
                        <div class="body">
                            <div class="">
                                <h4>Issue Information</h4>
                                <?php //print_r($get_communication); ?>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td><strong>Issue Name</strong></td>
                                            <td><?php echo $get_communication[0]['issue_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Communication Type</strong></td>
                                            <td>Comm Type 1</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issuer Name</strong></td>
                                            <td><?php echo $get_communication[0]['issuer_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Addressee Name</strong></td>
                                            <td><?php echo $get_communication[0]['addressee_name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Timeline</strong></td>
                                            <td><?php echo $get_communication[0]['timeline']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Synopsis of Communication</strong></td>
                                            <td><?php echo $get_communication[0]['synopsis']; ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 p-0 card">
                        <div class="body issue-docs">

                        <?php
                        if(empty($get_documents)) {
                            echo '<h4>No documents found for this issue.</h4>';
                        }
                        else {
                        foreach($get_documents as $documents) { ?>
                            <div class="">
                                <h4>Issue Documents</h4>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td><strong>Document Name</strong></td>
                                            <td><?php echo $documents->document_name ?> </td>
                                        </tr>
                                        <tr>
                    <td><strong>Documents</strong></td>
    <td><a href="<?php echo base_url();?>uploads/files/doc_upload/<?php echo str_replace(' ','_',$documents->communication_file); ?>" title="Download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issue Date</strong></td>
                                            <td><?php echo $documents->document_date ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php }  } ?>


                            <hr/>

<!--                             <div class="">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td><strong>Issue Name</strong></td>
                                            <td>Issue 2</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issue Owner</strong></td>
                                            <td>CMMA</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Documents</strong></td>
                                            <td><a href="#" class="btn btn-primary waves-effect" title=""><i class="fa fa-download"></i> Download</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issue Date</strong></td>
                                            <td>26/05/2020</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr/>
                            <div class="">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                        <tr>
                                            <td><strong>Issue Name</strong></td>
                                            <td>Issue 3</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issue Owner</strong></td>
                                            <td>Obcc_ee</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Documents</strong></td>
                                            <td><a href="#" class="btn btn-primary waves-effect" title=""><i class="fa fa-download"></i> Download</a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Issue Date</strong></td>
                                            <td>28/05/2020</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->


                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>