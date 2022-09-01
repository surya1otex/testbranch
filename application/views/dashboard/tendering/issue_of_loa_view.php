<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2>Issue Of LOA </h2>
        </div>

<?php 
if(!empty($issue_of_loa)){


?>

    <div class="table-responsive">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Successful Bidder Ref No/Name</td>
                        <td><?php echo $issue_of_loa[0]['successful_bidder_ref_no']; ?></td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Negotiation Meeting date</td>
                        <td><?php 
                              if($issue_of_loa[0]['negotiation_meeting_date']=='0000-00-00'){
                                  echo $issue_of_loa[0]['negotiation_meeting_date']='';
                               }

                               else
                               {
                                echo $issue_of_loa[0]['negotiation_meeting_date'];
                               }
                               
                         ?></td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Accepted Offer Value</td>
                        <td><?php echo number_format($issue_of_loa[0]['negotiation_bid_value'],2); ?></td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> LoA Issue Date</td>
                        <td><?php 
                              if($issue_of_loa[0]['negotiation_meeting_date']=='0000-00-00'){
                                  echo $issue_of_loa[0]['negotiation_meeting_date']='';
                               }

                               else
                               {
                                echo $issue_of_loa[0]['negotiation_meeting_date'];
                               }
                               
                         ?></td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Issue of LOA Date</td>
                        <td><?php 
                              if($issue_of_loa[0]['approval_date']=='0000-00-00'){
                                  echo $issue_of_loa[0]['approval_date']='';
                               }

                               else
                               {
                                echo $issue_of_loa[0]['approval_date'];
                               }
                               
                         ?></td>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                        <td><?php echo $issue_of_loa[0]['remarks']; ?></td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Upload LoA</td>

                        <td><a href="<?php echo base_url();?>uploads/files/loa/<?php echo $issue_of_loa[0]['loa_document']; ?>" title="Download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a></td>
                       <td>&nbsp;   </td>
                       <td>&nbsp;   </td>
                  </tr>
                </tbody>
         </table>
    </div>




   

  



<?php }else {
        echo 'No data availbale!!';
    } ?>
</div>