<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
    <tbody>
    <?php if(count($project_history) == 0 ){
        echo "No History Found";
    }?>
    <?php foreach ($project_history as $key => $history) { ?>

                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <tbody>
                    <tr>
                        <td><i class="fas fa-info"></i> <span>Status :</span></td>
                        <td><?php if($history['approval_status'] == 'P') { ?>
                                <span class="label label-default">Pending</span>

                            <?php }else if($history['approval_status'] == 'N'){ ?>
                                <span class="label label-warning">Rejected</span>
                            <?php }else if($history['approval_status'] == 'Y'){ ?>
                                <span class="label label-success">Approved</span>
                            <?php }  ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="250px"><i class="fas fa-calendar-check"></i> <span>

                                <?php if( $history['approval_status'] == 'P' ){ ?>
                                    Project Approve/Reject Date :
                                <?php } ?>
                                <?php if( $history['approval_status'] == 'N' ){ ?>
                                    Project Reject Date :
                                <?php } ?>
                                <?php if( $history['approval_status'] == 'Y' ){ ?>
                                    Project Approve Date :
                                <?php } ?>

                            </span></td>

                        <td> <?php if( $history['approval_status'] == 'P' ) {
                                echo "NA";
                            }else{
                                $date = date_create($history['rfp_publishing_dates']);
                                echo date_format($date, "F d Y");

                            }
                         ?> </td>
                    </tr>
                    <tr>
                        <td width="250"><i class="fa fa-user-circle" aria-hidden="true"></i>

                            <span>
                               <?php if( $history['approval_status'] == 'P' ){ ?>
                                    Approve/Rejected By :
                                <?php } ?>
                                <?php if( $history['approval_status'] == 'N' ){ ?>
                                    Rejected By :
                                <?php } ?>
                                <?php if( $history['approval_status'] == 'Y' ){ ?>
                                    Approved By :
                                <?php } ?>
                            </span>

                        </td>
                        <td>
                            <?php

                            if( !empty($history['approver_details']['firstname'])) {

                                echo $history['approver_details']['firstname']. "- ".$history['approver_details']['lastname'];
                            }else{
                                echo $history['approver_details']['name'];
                            }
                            ?>
                        </td>

                    </tr>
                    <tr>
                        <td><i class="fa fa-comments" aria-hidden="true"></i><span>Remarks</span></td>
                        <td> <?php echo $history['remarks']; ?> </td>

                    </tr>

                    <?php if( !empty($history['attachment']) ){ ?>
                    <tr>
                        <td><i class="fa fa-user-circle" aria-hidden="true"></i><span>Attachment</span></td>

                        <td> <?php echo $history['attachment']; ?>
                            <a href="<?php echo base_url()."uploads/attachment/".$history['attachment'] ?> " download>
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>

                        </td>

                    </tr>
                    <?php } ?>
                    </tbody>
                </table>





    <?php } ?>


    </tbody>
</table>